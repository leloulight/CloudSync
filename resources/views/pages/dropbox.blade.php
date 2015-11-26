@extends('layouts.homeDefault')
@section('content')

<div id="content-wrapper" class="large-12 columns">
<?php
//session_start();
 echo '<h2>Dropbox</h2><table><tr><th></th><th>File Name</th> <th>Size</th></tr>';
          foreach($dropboxData['contents'] as $data){
              if($data['is_dir'] == true){
                  echo '<tr><td>Folder</td>';
              }
              else{
                  echo '<tr><td>File</td>';
              }
               echo '<td>'.$data['path'].'</td>';
               echo '<td>'.$data['size'].'</td></tr>';
          }
          echo '</table>';
          
      
      ?>
</div>
@stop

