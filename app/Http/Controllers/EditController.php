<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;

class EditController extends Controller {

    public function openEditor() {
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
