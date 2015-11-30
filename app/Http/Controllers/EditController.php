<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use File;
use \Dropbox as dbx;
use App\Dropbox;

class EditController extends Controller {

    public function openEditor(Request $request) {

        $dropboxFilePath = $request->input('hidden-edit-path');
        $dropboxFileName = $request->input('hidden-edit-name');
        $dropboxObject = Dropbox::where('userId', 1)->firstOrFail();
        $access_token = $dropboxObject->accessToken;

        $dbxClient = new dbx\Client($access_token, "PHP-Example/1.0");

        $path = storage_path();
        $localAddress = $path . "\\Dropbox\\User1\\temp\\" . $dropboxFileName;
        $f = fopen($localAddress, "w+b");
        $fileMetadata = $dbxClient->getFile($dropboxFilePath, $f);
        fclose($f);

        $editContent = array();

        $editContent[0] = htmlspecialchars(file_get_contents($localAddress));
        $editContent[1] = $localAddress;
        $editContent[2] = $dropboxFileName;
        $editContent[3] = $dropboxFilePath;
        return view('pages.edittext')->with('fileData', $editContent);

        //print_r($fileMetadReata);
    }

    public function closeEditor(Request $request) {

        $dropboxObject = Dropbox::where('userId', 1)->firstOrFail();
        $access_token = $dropboxObject->accessToken;

        $dbxClient = new dbx\Client($access_token, "PHP-Example/1.0");

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
}
