@extends('layouts.default')
@section('content')
<?php
use Illuminate\Support\Facades\Facade;

$path = app_path();
echo $path;
var_dump(app_path());
if ($_POST) {
  file_put_contents("tempFile.txt",$_POST['text']);
  header ("Location: ".$_SERVER['PHP_SELF']);
  exit;
}
$text = htmlspecialchars(file_get_contents("tempFile.txt"));
Editor::view();
Editor::view($text);
?>
)
<form method="POST">
<textarea name="text"><?=$text?></textarea>
<input type="submit">
</form>

@stop