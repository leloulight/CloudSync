@extends('layouts.homeDefault')
@section('content')

<div id="content-wrapper" class="large-12 columns">
 <?php   
    echo '<h2>Google Drive</h2><table><tr><th>File/Folder</th><th>File Name</th> <th>Size</th></tr>';
    foreach($googleDriveData as $data){ ?>
    <tr> 
        <td><?php echo $data->getFileType(); ?></td>
        <td><?php echo $data->getTitle(); ?></td>
        <td><?php echo $data->getFileSize(); ?></td>
        <?php if($data->getFileType() == 'File'){ ?>
        <td> <a href="<?php echo $data->getDirectDownloadUrl(); ?>" >Direct Download</a>  </td> 
        <td><form method="post" action="googledrive/send">
            <input type="submit" value="Send To Dropbox" name="driveToDropbox" />
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">   
            <input type="hidden" name="filePath" value="<?php echo $data->getDownloadUrl(); ?>" />
            </form></td>
    <?php     } ?>
    </tr>
        
 <?php   }
    
    
    echo '</table>';
    
    
    ?>
    </div>
@stop
