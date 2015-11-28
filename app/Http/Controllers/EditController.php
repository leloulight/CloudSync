<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use File;

class EditController extends Controller {

    public function openDropBoxEditor() {
       
       
       // $text = htmlspecialchars(file_get_contents($path . "\\temp\\tempEdit1.txt"));
       $filePath=$text;
        File::put($text, '');
        return view('pages.edittext')->with('fileData', $text);
       createNewFile();
    }

    public function closeEditor() {
        $path = storage_path();
  file_put_contents($path."\\temp\\tempEdit.txt",$_POST['text']);
    return view('pages.edittext') ->with('fileData', $_POST['text']);
}        

public function deleteFile($user){
    File::deleted($path);
   
}

public function createNewFile(){
     $path = storage_path();
     $fileName=$path."\\temp\\tempEdit1.txt";
   Storage::disk('local')->put('file.txt', 'Contents');
    if(!File::exists($fileName)){
        File::put($fileName, '');
    }
}
    public function downloadFile() {
         $path = storage_path();
     $text = $path."\\Dropbox\\User1\\temp\\tempEdit.txt";
        $f = fopen($text, "w+b");
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
