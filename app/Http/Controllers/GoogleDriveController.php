<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GoogleDriveController
 *
 * @author AshirwadTank
 */
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;


//require app_path().'/includes/vendor/autoload.php';
use Google_Client; 
use Google_Service_Drive;

//echo app_path();

define('APPLICATION_NAME', 'Drive API PHP Quickstart');
define('CREDENTIALS_PATH', '~/.credentials/drive-php-quickstart.json');
define('CLIENT_SECRET_PATH', __DIR__ . '/client_secret.json');
define('SCOPES', 'https://www.googleapis.com/auth/drive');



class GoogleDriveController extends Controller{
    //put your code here
    
    public function googleDriveAuth(){
  $client = new Google_Client();
  $client->setApplicationName(APPLICATION_NAME);
  $client->setScopes(SCOPES);
  $client->setAuthConfigFile(CLIENT_SECRET_PATH);
  $client->setAccessType('online');
  $client->setClientId('61413088518-nvuqb0gr82a47stea9os5cctnu35ssp6.apps.googleusercontent.com');
  $client->setClientSecret('eEY5p3_oq3L1w7rrVWB6Odw8');
  $client->setRedirectUri('http://localhost:8080/CloudSync/public/GoogleDriveModel.php');
 // $client->setAccessType('offline');
  $client->setApprovalPrompt('force');
  $tmpUrl = parse_url($client->createAuthUrl());
  var_dump($tmpUrl);
  header('Location: ' . filter_var($client->createAuthUrl(), FILTER_SANITIZE_URL));
  exit();
    }
    
    
    public function googleDriveSuccess(){
        
    }
 }
