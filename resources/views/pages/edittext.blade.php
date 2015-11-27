@extends('layouts.homeDefault')
@section('content')
<?php
use Illuminate\Support\Facades\Facade;


//if ($_POST) {
//  file_put_contents($path."\\temp\\tempEdit.txt",$_POST['text']);
//  //header ("Location: ".$_SERVER['PHP_SELF']);
//  //echo $path;
//  
//}
//$path = storage_path();
//$text = htmlspecialchars(file_get_contents($path."\\temp\\tempEdit.txt"));
//
////Editor::view();
?>

<form method="POST" action="save">
    
<textarea  id="text" name="text" cols="100" rows="15" style="width: 700px; height: 500px"><?php echo $fileData ;?></textarea>

<input type="submit" value = "Save File">



</form>

@stop