@extends('layouts.homeDefault')
@section('content')

<div id="content-wrapper" class="large-12 columns">
<?php
//session_start();
 echo '<h2>Dropbox</h2><table><tr><th></th><th>File Name</th> <th>Size</th><th></th></tr>';
          foreach($dropboxData['contents'] as $data){
              $isMime = 0;
             // var_dump($data['mime_type']);
              if($data['is_dir'] == true){
                  echo '<tr><td>Folder</td>';
                  $isMime = 0;
              }
              else{
                  echo '<td>File</td>';
                  $isMime = 1;
              }
               $pos = strrpos($data['path'], '/');
               $fileName = $pos === false ? $data['path'] : substr($data['path'], $pos + 1);
               echo '<td>'.$fileName.'</td>';
               echo '<td>'.$data['size'].'</td>';
               echo "<td>";
               if($isMime == 1 && $data['mime_type'] == 'text/plain'){
               echo "<form method='post' action='dropbox/edit'>";
               echo "<input type='hidden' name='hidden-edit-path' value='".$data['path']."' >";
               echo "<input type='submit' value='Edit' name='edit'>";
               echo "</form></td>";
              }
               
             echo '</tr>';  
          }
          echo '</table>';
          
      
      ?>
</div>
@stop

