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
use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;
use App\GoogleDrive;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


define('APPLICATION_NAME', 'Drive API PHP Quickstart');
define('CREDENTIALS_PATH', '~/.credentials/drive-php-quickstart.json');
define('CLIENT_SECRET_PATH', __DIR__ . '/client_secret.json');
define('SCOPES', 'https://www.googleapis.com/auth/drive');

class DropboxController extends Controller {

    //put your code here

    public function dropboxSuccess() {
        session_start();
        $appInfo = dbx\AppInfo::loadFromJsonFile(__DIR__ . "\app-info.json");
        $csrfTokenStore = new dbx\ArrayEntryStore($_SESSION, 'dropbox-auth-csrf-token');
        $webAuth = new dbx\WebAuth($appInfo, "PHP-Example/1.0", 'http://localhost:8080/CloudSync/public/FacebookModel.php', $csrfTokenStore);

        list($accessToken,$dropboxUserId) = $webAuth->finish($_GET);

        $dbxClient = new dbx\Client($accessToken, "PHP-Example/1.0");
        $accountInfo = $dbxClient->getAccountInfo();

        // Saving Access Token and usernifno to dropbox table
        $dropboxObject = new Dropbox();
        $dropboxObject->userId = Auth::id();
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
            $dropboxObject = Dropbox::where('userId', Auth::id())->firstOrFail();
            $access_token = $dropboxObject->accessToken;
            $dropboxClient = new dbx\Client($access_token, "PHP-Example/1.0");
            $folderMetadata = $dropboxClient->getMetadataWithChildren("/");
            
            return view('pages.dropbox')->with('dropboxData', $folderMetadata);
        } catch (Exception $exception) {
            return Response::make('User Not Found' . $exception->getCode());
        }
    }
    
    public function sendToGoogleDrive(Request $request){
        $client = $this->getDropboxClient();
        $filePath = $request->input('hidden-file-path');
        $mimeType = $request->input('hidden-mime-type');
        
        $pos = strrpos($filePath, '/');
        $fileName = $pos === false ? $filePath: substr($filePath, $pos + 1);
     
        $dropboxDownloadPath = $this->downloadDropboxFile($client,$filePath);
        
        $service = $this->getGoogleDriveClient();
        
        $file = new Google_Service_Drive_DriveFile();
        $file->setTitle($fileName);
        $file->setDescription('A test document');
        $file->setMimeType($mimeType);

    $data = file_get_contents($dropboxDownloadPath);

    $createdFile = $service->files->insert($file, array(
          'data' => $data,
          'mimeType' => $mimeType,
          'uploadType' => 'media'
          
        ));
 
        Session::flash('fileSendSuccess', 'File '.$fileName.' Sent to Your Google Drive Account'); 
        Session::flash('alert-class', 'success radius'); 
        return redirect('dropboxFolder');
     //print_r($createdFile);
     //die();
    }
    
    
    public function getGoogleDriveClient(){
        $userId = GoogleDrive::where('userId',Auth::id())->first();
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
            //$this->userAlreadyExists($client);
        } else {

            $client->authenticate($_GET['code']);
            $access_token = $client->getAccessToken();

            $googleDriveObject = new GoogleDrive();
            $googleDriveObject->userId = Auth::id();
            $googleDriveObject->access_token = $access_token;
            $googleDriveObject->refresh_token = $client->getRefreshToken();


            $googleDriveObject->save();

            $client->setAccessToken($access_token);
        }
        $drive_service = new Google_Service_Drive($client);
        
        return $drive_service;
    }
    
    public function createShareLink(Request $request){
        
          
             
            $filePath = $request->input('hidden-file-path');
            
            $dropboxObject = Dropbox::where('userId',Auth::id())->firstOrFail();
            $access_token = $dropboxObject->accessToken;
            $dropboxClient = new dbx\Client($access_token, "PHP-Example/1.0");
            $url = $dropboxClient->createShareableLink($filePath);
            
            $data = array(
            'public_url'=>$url,
            'userName'=>$dropboxObject->username,
            );
            
            return View("pages.shareLink")->with('publicLink',$data);
            //die();
    }
    
    public function getDropboxClient(){
        $dropboxObject = Dropbox::where('userId',Auth::id())->firstOrFail();
        $access_token = $dropboxObject->accessToken;

        $dbxClient = new dbx\Client($access_token, "PHP-Example/1.0");
        
        return $dbxClient;
    }
    
    public function downloadDropboxFile($dbxClient,$dropboxFilPath){
        
            $pos = strrpos($dropboxFilPath, '/');
            $dropboxFileName = $pos === false ? $dropboxFilPath: substr($dropboxFilPath, $pos + 1);
        
        $path = storage_path();
        $localAddress = $path . "\\Dropbox\User1\\temp\\" . $dropboxFileName;
        $f = fopen($localAddress, "w+b");
        $fileMetadata = $dbxClient->getFile($dropboxFilPath, $f);
        fclose($f);
        
        return $localAddress;
    }
    

   
}
