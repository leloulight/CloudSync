<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;

use \Dropbox as dbx ;

class EditController extends Controller {

    public function openEditor(Request $request) {
        
        $dropboxFilePath = $request->input('hidden-edit-path');
        $dropboxObject = Dropbox::where('userId',1)->firstOrFail();          
        $access_token = $dropboxObject->accessToken;
        
        $dbxClient = new dbx\Client($access_token, "PHP-Example/1.0");
        
        
        $path = storage_path();
        $text = htmlspecialchars(file_get_contents($path . "\\temp\\tempEdit.txt"));
        return view('pages.edittext')->with('fileData', $text);
    }

    public function closeEditor() {
        $path = storage_path();
  file_put_contents($path."\\temp\\tempEdit.txt",$_POST['text']);
    return view('pages.edittext') ->with('fileData', $_POST['text']);
}        


    public function downloadFile() {
        $f = fopen("working-draft.txt", "w+b");
        $fileMetadata = $dbxClient->getFile("/working-draft.txt", $f);
        fclose($f);
        print_r($fileMetadata);
    }

    public function uploadFile() {
        $f = fopen("working-draft.txt", "rb");
        $result = $dbxClient->uploadFile("/working-draft.txt", dbx\WriteMode::add(), $f);
        fclose($f);
        print_r($result);
    }

}
