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
use App\Http\Controllers\Controller;
use \Dropbox as dbx;

include 'FacebookIncludes.php';

//include(app_path() . '\FacebookIncludes.php');
//use app\FacebookIncludes.php;
session_start();
class DropboxController extends Controller {

    //put your code here

    public function dropboxSuccess() {
        $appInfo = dbx\AppInfo::loadFromJsonFile(__DIR__ . "\app-info.json");
        $csrfTokenStore = new dbx\ArrayEntryStore($_SESSION, 'dropbox-auth-csrf-token');
        $webAuth = new dbx\WebAuth($appInfo, "PHP-Example/1.0", 'http://localhost:8080/CloudSync/public/FacebookModel.php', $csrfTokenStore);

        
        list($accessToken, $dropboxUserId) = $webAuth->finish($_GET);
        $dbxClient = new dbx\Client($accessToken, "PHP-Example/1.0");
        //$accountInfo = $dbxClient->getAccountInfo();
        
        $folderMetadata = $dbxClient->getMetadataWithChildren("/");
        foreach($folderMetadata['contents'] as $data){
            
            var_dump($data['path']);
//            $str = preg_replace('/\\\\/', '', $data['path']);
//            if($data['is_dir'] == 1){
//                //$string = rtrim($data['path'], '/');
//                 echo "Directory :".$str."<br />";
//            }
//            else{
//            echo $str."<br />";
//            }
       }
        //print_r($folderMetadata['contents']);
        //print_r($accountInfo);
       // var_dump($accessToken);
    }

    public function dropboxAuth() {

//echo app_path();
        $appInfo = dbx\AppInfo::loadFromJsonFile(__DIR__ . "\app-info.json");
        $csrfTokenStore = new dbx\ArrayEntryStore($_SESSION, 'dropbox-auth-csrf-token');
        $webAuth = new dbx\WebAuth($appInfo, "PHP-Example/1.0", 'http://localhost:8080/CloudSync/public/FacebookModel.php', $csrfTokenStore);
//var_dump($webAuth->);
        $authorizeUrl = $webAuth->start();
        header('Location: ' . $authorizeUrl);
        exit();
        if (isset($_POST['auth_code'])) {
            //$this->saveAuthorizationCode($_POST['auth_code']);
            list($accessToken, $dropboxUserId) = $webAuth->finish($_POST['auth_code']);
            var_dump($accessToken);
        }

//exit();
//$authCode = $webAuth->finish($_GET);
//var_dump($authCode);
//exit();
//$authCode = \trim(\readline("**A-WALID-KEY-HERE**"));
//list($accessToken, $dropboxUserId) = $webAuth->finish($authCode);
//print "Access Token: " . $accessToken . "\n";

        $dbxClient = new dbx\Client($accessToken, "PHP-Example/1.0");
        $accountInfo = $dbxClient->getAccountInfo();
        print_r($accountInfo);
    }

}
