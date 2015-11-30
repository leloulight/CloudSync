<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use File;
use \Dropbox as dbx;
use App\Dropbox;

class EditController extends Controller {

    public function openEditor(Request $request) {

        $dropboxFilePath = $request->input('hidden-edit-path');
        $dropboxFileName = $request->input('hidden-edit-name');
        
        $dbxClient = $this->getDropboxClient();

        $path = storage_path();
        $localAddress = $path . "\\Dropbox\\".Auth::user()->id."\\temp\\" . $dropboxFileName;
        $f = fopen($localAddress, "w+b");
        $fileMetadata = $dbxClient->getFile($dropboxFilePath, $f);
        fclose($f);

        $editContent = array();

        $editContent[0] = htmlspecialchars(file_get_contents($localAddress));
        $editContent[1] = $localAddress;
        $editContent[2] = $dropboxFileName;
        $editContent[3] = $dropboxFilePath;
        return view('pages.edittext')->with('fileData', $editContent);

        
    }
    
    public function getDropboxClient(){
        $dropboxObject = Dropbox::where('userId', 1)->firstOrFail();
        $access_token = $dropboxObject->accessToken;

        $dbxClient = new dbx\Client($access_token, "PHP-Example/1.0");
        
        return $dbxClient;
    }
    
    public function downloadDropboxFile(){
        
        $path = storage_path();
        $localAddress = $path . "\\Dropbox\\".Auth::user()->id."\\temp\\" . $dropboxFileName;
        $f = fopen($localAddress, "w+b");
        $fileMetadata = $dbxClient->getFile($dropboxFilePath, $f);
        fclose($f);
    }
    
    
   

    public function closeEditor(Request $request) {

         $dbxClient = $this->getDropboxClient();

        $LocalAddress = $request->input('LocalAddress');
        $LocalName = $request->input('LocalName');
        $DropBoxFile = $request->input('DropBoxFile');
        // $dropboxFileName = $request->input('fileName');

        file_put_contents($LocalAddress, $_POST['text']);

        $editContent = array();

        $editContent[0] = htmlspecialchars($_POST['text']); //updated text
        $editContent[1] = $LocalAddress; // full local folder name with location
        $editContent[2] = $LocalName; //full local file name
        $editContent[3] = $DropBoxFile; //full dropbox path with name
        $LocalName = str_replace(' ', '', $LocalName);
        $f = fopen($editContent[1], "rb");
        $result = $dbxClient->uploadFile($editContent[3], dbx\WriteMode::force(), $f);
        fclose($f);

        $dropboxObject = Dropbox::where('userId', 1)->firstOrFail();
        $access_token = $dropboxObject->accessToken;
        $dropboxClient = new dbx\Client($access_token, "PHP-Example/1.0");
        $folderMetadata = $dropboxClient->getMetadataWithChildren("/");
        $this->deleteFile($LocalAddress);

        return view('pages.dropbox')->with('dropboxData', $folderMetadata);
    }

    public function deleteFile($localFile) {
        File::delete($localFile);
    }

    public function createNewFile() {
        $path = storage_path();
        $fileName = $path . "\\temp\\tempEdit1.txt";
        Storage::disk('local')->put('file.txt', 'Contents');
        if (!File::exists($fileName)) {
            File::put($fileName, '');
        }
    }
}
