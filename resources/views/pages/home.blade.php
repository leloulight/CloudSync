@extends('layouts.homeDefault')
@section('content')
<div id="content-wrapper" class="large-12 columns">


    <div class="large-5 columns cloud-type" >  
        <?php
        // if( $dropboxData == null || !isset($dropboxData) ) {

        if (isset($userConfig)) {

            var_dump($userConfig[0]);
            if ($userConfig[0] == 0) {
                ?>
                <img src="img/dropbox-icon.png" alt="Dropbox"/>

                <a href="dropbox/login" id="btn-dropbox" class="button">ADD</a>   
                <?php
            } else if ($userConfig[0] == 1) {
                echo 'here';
                ?>
                <a href="dropboxFolder" id="btn-dropbox" class="button">GO to Dropbox Folder</a>   
            <?php } ?>    
        </div>   
        <div class="large-5 columns cloud-type" >  

    <?php if ($userConfig[1] == 0) { ?>

                <img src="img/skydrive-icon.png" alt="Skydrive/Onedrive"/> 

                <a href="/googleDrive" class="button">ADD</a>
    <?php
    } else if ($userConfig[1] == 1) {
        ?>
                <a href="googleDrive/googleDrivefolder" id="btn-dropbox" class="button">GO to Google Drive Folder</a>   
            <?php } ?> 

            ?>

        </div>   
<?php } ?>
</div>    
@stop

