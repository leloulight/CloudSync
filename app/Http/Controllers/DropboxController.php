<?php

/**
 * Description of DropboxController
 *
 * @author AshirwadTank
 */

namespace App\Http\Controllers;

use App\Dropbox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use \Dropbox as dbx;

class DropboxController extends Controller {

    //put your code here

    public function dropboxSuccess() {
        session_start();
        $appInfo = dbx\AppInfo::loadFromJsonFile(__DIR__ . "\app-info.json");
        $csrfTokenStore = new dbx\ArrayEntryStore($_SESSION, 'dropbox-auth-csrf-token');
        $webAuth = new dbx\WebAuth($appInfo, "PHP-Example/1.0", 'http://localhost:8080/CloudSync/public/FacebookModel.php', $csrfTokenStore);

        list($accessToken, $dropboxUserId) = $webAuth->finish($_GET);

        $dbxClient = new dbx\Client($accessToken, "PHP-Example/1.0");
        $accountInfo = $dbxClient->getAccountInfo();

        // Saving Access Token and usernifno to dropbox table
        $dropboxObject = new Dropbox();
        $dropboxObject->userId = 1;
        $dropboxObject->username = $accountInfo["display_name"];
        $dropboxObject->accessToken = $accessToken;
        $dropboxObject->uId = $accountInfo["uid"];

        $dropboxObject->save();

        $folderMetadata = $dbxClient->getMetadataWithChildren("/");

        return view('pages.dropbox')->with('dropboxData', $folderMetadata);
    }

    public function dropboxAuth() {
        session_start();
        $appInfo = dbx\AppInfo::loadFromJsonFile(__DIR__ . "\app-info.json");
        $csrfTokenStore = new dbx\ArrayEntryStore($_SESSION, 'dropbox-auth-csrf-token');
        $webAuth = new dbx\WebAuth($appInfo, "PHP-Example/1.0", 'http://localhost:8080/CloudSync/public/FacebookModel.php', $csrfTokenStore);
        $authorizeUrl = $webAuth->start();
        header('Location: ' . $authorizeUrl);
        exit();
    }

    public function dropboxFolder() {
        try {
            $dropboxObject = Dropbox::where('userId', 1)->firstOrFail();
            $access_token = $dropboxObject->accessToken;
            $dropboxClient = new dbx\Client($access_token, "PHP-Example/1.0");
            $folderMetadata = $dropboxClient->getMetadataWithChildren("/");
            
//            echo '<pre>';
//            echo print_r($folderMetadata);
//            echo '</pre>';
//            
//            die();
            return view('pages.dropbox')->with('dropboxData', $folderMetadata);
        } catch (Exception $exception) {
            return Response::make('User Not Found' . $exception->getCode());
        }
    }
    
    public function sendToGoogleDrive(Request $request){
        
    }

    public function saveFileToDrive($path) {
        $f = fopen($path . "\\temp\\tempEdit.txt", "rb");
        $result = $dbxClient->uploadFile("/working-draft.txt", dbx\WriteMode::add(), $f);
        fclose($f);
        print_r($result);
    }

    public function readFileToDrive($path) {
        $f = fopen($path . "\\temp\\tempEdit.txt", "w+b");
        $fileMetadata = $dbxClient->getFile("/working-draft.txt", $f);
        fclose($f);
        print_r($fileMetadata);
    }

}
