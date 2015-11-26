<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
        return view('pages.dropbox')->with('dropboxData',$folderMetadata);
        
        
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

}
