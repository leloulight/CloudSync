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

use App\GoogleDrive;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Google_Client;
use Google_Service_Drive;
use Google_Http_Request;
use DB;


define('APPLICATION_NAME', 'Drive API PHP Quickstart');
define('CREDENTIALS_PATH', '~/.credentials/drive-php-quickstart.json');
define('CLIENT_SECRET_PATH', __DIR__ . '/client_secret.json');
define('SCOPES', 'https://www.googleapis.com/auth/drive');

class GoogleDriveController extends Controller {

    //put your code here
    public $client = "";

    public function __construct() {
        $this->client = new Google_Client();
    }

    public function googleDriveAuth() {
        $this->client = new Google_Client();
        $this->client->setApplicationName(APPLICATION_NAME);
        $this->client->setScopes(SCOPES);
        $this->client->setAuthConfigFile(CLIENT_SECRET_PATH);
       
        $this->client->setClientId('61413088518-nvuqb0gr82a47stea9os5cctnu35ssp6.apps.googleusercontent.com');
        $this->client->setClientSecret('eEY5p3_oq3L1w7rrVWB6Odw8');
        $this->client->setRedirectUri('http://localhost:8080/CloudSync/public/GoogleDriveModel.php');
        $this->client->setAccessType('offline');
        $this->client->setApprovalPrompt('force');

        header('Location: ' . filter_var($this->client->createAuthUrl(), FILTER_SANITIZE_URL));
        exit();
    }

    public function userAlreadyExists($clientObj) {

        $client = $clientObj;

        $drive_service = new Google_Service_Drive($client);

        $result = array();
        $pageToken = NULL;

        do {
            try {
                $parameters = array();
                if ($pageToken) {
                    $parameters['pageToken'] = $pageToken;
                }
                $children = $drive_service->children->listChildren("root", $parameters);


                $pageToken = $children->getNextPageToken();
            } catch (Exception $e) {
                print "An error occurred: " . $e->getMessage();
                $pageToken = NULL;
            }
        } while ($pageToken);


        $fileList = array();



        foreach ($children->getItems() as $child) {
            $file = $drive_service->files->get($child->getId());
            $driveObject = new GoogleDrive();



            if (strpos($file->getMimeType(), '.folder') !== FALSE) {

                $driveObject->setFileType("Folder");
            } else {
                $driveObject->setFileType("File");
            }

            $driveObject->setTitle($file->getTitle());
            $driveObject->setFileSize($file->getFileSize());
            $driveObject->setDirectDownloadUrl($file->getWebContentLink());
            $driveObject->setDownloadUrl($file->getDownloadUrl());


            array_push($fileList, $driveObject);
        }

        return view('pages.googledrive')->with('googleDriveData', $fileList);
    }

    public function googleDriveSuccess(Request $request) {


        $userId = GoogleDrive::where('userId', 1)->first();
        $client = new Google_Client();
        $client->setApplicationName(APPLICATION_NAME);
        $client->setScopes(SCOPES);
        $client->setAuthConfigFile(CLIENT_SECRET_PATH);
        $client->setAccessType('offline');
        $client->setClientId('61413088518-nvuqb0gr82a47stea9os5cctnu35ssp6.apps.googleusercontent.com');
        $client->setClientSecret('eEY5p3_oq3L1w7rrVWB6Odw8');

        if ($userId) {
            $access_token = $userId->access_token;

            $client->setAccessToken($access_token);
           
           /* To check whether access token is expired or not */
            if ($client->isAccessTokenExpired()) {
             
                $refreshToken = $userId->refresh_token;
                //Here's where the magical refresh_token comes into play
                $client->refreshToken($refreshToken);
                
                 /* Setting new Access Token */
                $client->setAccessToken($client->getAccessToken());
                
                /* Update the database with new Access Token and refresh token */
               DB::table('googleDrive')->where('driveId',$userId->driveId)
                       ->update(['access_token' => $client->getAccessToken(),'refresh_token' => $client->getRefreshToken()]);                
            }
            $this->userAlreadyExists($client);
        } else {

            $client->authenticate($_GET['code']);
            $access_token = $client->getAccessToken();

            $googleDriveObject = new GoogleDrive();
            $googleDriveObject->userId = 1;
            $googleDriveObject->access_token = $access_token;
            $googleDriveObject->refresh_token = $client->getRefreshToken();


            $googleDriveObject->save();

            $client->setAccessToken($access_token);
        }
        $drive_service = new Google_Service_Drive($client);

        $result = array();
        $pageToken = NULL;

        do {
            try {
                $parameters = array();
                if ($pageToken) {
                    $parameters['pageToken'] = $pageToken;
                }
                $children = $drive_service->children->listChildren("root", $parameters);


                $pageToken = $children->getNextPageToken();
            } catch (Exception $e) {
                print "An error occurred: " . $e->getMessage();
                $pageToken = NULL;
            }
        } while ($pageToken);


        $fileList = array();



        foreach ($children->getItems() as $child) {
            $file = $drive_service->files->get($child->getId());
            $driveObject = new GoogleDrive();



            if (strpos($file->getMimeType(), '.folder') !== FALSE) {

                $driveObject->setFileType("Folder");
            } else {
                $driveObject->setFileType("File");
            }

            $driveObject->setTitle($file->getTitle());
            $driveObject->setFileSize($file->getFileSize());
            $driveObject->setDirectDownloadUrl($file->getWebContentLink());
            $driveObject->setDownloadUrl($file->getDownloadUrl());


            array_push($fileList, $driveObject);
        }

        return view('pages.googledrive')->with('googleDriveData', $fileList);
    }

    public function googleDriveFolder() {
        $googleDriveObject = GoogleDrive::findOrNew(1);

        $access_token = $googleDriveObject->access_token;
    }

    public function sendToDropbox(Request $request) {

        $filePath = $request->input('filePath');


        $client = new Google_Client();
        $client->setApplicationName(APPLICATION_NAME);
        $client->setScopes(SCOPES);
        $client->setAuthConfigFile(CLIENT_SECRET_PATH);
        $client->setAccessType('online');
        $client->setClientId('61413088518-nvuqb0gr82a47stea9os5cctnu35ssp6.apps.googleusercontent.com');
        $client->setClientSecret('eEY5p3_oq3L1w7rrVWB6Odw8');

        $requestObject = new Google_Http_Request($filePath, 'GET', null, null);
       
        $client->getAuth()->sign($requestObject);
        $io = $client->getIo();
        $httpRequest = $io->makeRequest($requestObject);

        var_dump($httpRequest->getUrl());

 
        file_put_contents(public_path() . '/FileDownload.docx', fopen("https://doc-04-as-docs.googleusercontent.com/docs/securesc/q7l4c05lpj5o4gi5emv4774n42k8lt1b/q8r20eahb4np30dqii88n8a9opa4h8ui/1448409600000/03138148639522860790/03138148639522860790/0B-pqJX87z9lfSGhyNTA5Q3o2Y2c?e=download&gd=true", 'r'));

    }

}
