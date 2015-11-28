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

        //var_dump($_GET);

        $dbxClient = new dbx\Client($accessToken, "PHP-Example/1.0");
        $accountInfo = $dbxClient->getAccountInfo();


        // Saving Access Token and usernifno to dropbox table
        $dropboxObject = new Dropbox();
        $dropboxObject->userId = 1;
        $dropboxObject->username = $accountInfo["display_name"];
        $dropboxObject->accessToken = $accessToken;
        $dropboxObject->uId = $accountInfo["uid"];

        $dropboxObject->save();

        //die();

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
//            print_r($folderMetadata);
//            echo '</pre>';
//            
//            die();
            return view('pages.dropbox')->with('dropboxData', $folderMetadata);
        } catch (Exception $exception) {
            return Response::make('User Not Found' . $exception->getCode());
        }
    }

}
