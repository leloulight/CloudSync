@extends('layouts.homeDefault')
@section('content')
<form method="POST" action="save">
    
<textarea  id="text" name="text" cols="100" rows="15" style="width: 700px; height: 500px"><?php echo $fileData[0] ;?></textarea>
<!-- <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> -->
<input type="hidden" name="LocalAddress" value="<?php echo $fileData[1]; ?>" >
<input type="hidden" name="LocalName" value="<?php echo $fileData[2]; ?>" >
<input type="hidden" name="DropBoxFile" value="<?php echo $fileData[3]; ?>" >

<input type="submit" value = "Save File">



</form>

@stop