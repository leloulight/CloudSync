@extends('layouts.homeDefault')
@section('content')
<div id="content-wrapper" class="large-12 columns">


    <div class="large-5 columns cloud-type" >  
      <?php 
     
     // if( $dropboxData == null || !isset($dropboxData) ) {?>
        <img src="img/dropbox-icon.png" alt="Dropbox"/>
        
        <a href="dropbox/login" id="btn-dropbox" class="button">ADD</a>   
      
         
         
    </div>   
    <div class="large-5 columns cloud-type" >  

        <img src="img/skydrive-icon.png" alt="Skydrive/Onedrive"/>   
        <a href="#" class="button">ADD</a>
    </div>   

</div>    
@stop

