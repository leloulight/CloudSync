<?php

/**
 * Description of DropboxController
 *
 * @author AshirwadTank
 */

namespace App\Http\Controllers;

//require_once "../../../vendor/dropbox/dropbox-sdk/lib/Dropbox/autoload.php";

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use \Dropbox as dbx;

//include 'FacebookIncludes.php';
//include(app_path() . '\FacebookIncludes.php');
//use app\FacebookIncludes.php;

class DropboxController extends Controller {

    //put your code here

    public function dropboxSuccess() {
        session_start();
        $appInfo = dbx\AppInfo::loadFromJsonFile(__DIR__ . "\app-info.json");
        $csrfTokenStore = new dbx\ArrayEntryStore($_SESSION, 'dropbox-auth-csrf-token');
        $webAuth = new dbx\WebAuth($appInfo, "PHP-Example/1.0", 'http://localhost:8080/CloudSync/public/FacebookModel.php', $csrfTokenStore);


        list($accessToken, $dropboxUserId) = $webAuth->finish($_GET);
        $dbxClient = new dbx\Client($accessToken, "PHP-Example/1.0");
        //$accountInfo = $dbxClient->getAccountInfo();

        $folderMetadata = $dbxClient->getMetadataWithChildren("/");


        //return Redirect::route('pages.home')->with('dropboxData', $folderMetadata);
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

        $dbxClient = new dbx\Client($accessToken, "PHP-Example/1.0");
        $accountInfo = $dbxClient->getAccountInfo();
        //print_r($accountInfo);
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
