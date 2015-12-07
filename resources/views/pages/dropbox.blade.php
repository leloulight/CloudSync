@extends('layouts.homeDefault')
@section('content')

<div id="content-wrapper" class="large-12 columns">

    
@if(Session::has('fileSendSuccess'))
<p id="file-send-success" class="alert-box {{ Session::get('alert-class', 'success radius') }}">{{ Session::get('fileSendSuccess') }}</p>
@endif    
    
    
<?php
    echo '<h2>Dropbox</h2><table class="hover"><tr><th></th><th>File Name</th> <th>Size</th><th></th><th></th><th></th></tr>';
    foreach ($dropboxData['contents'] as $data) {
        $isMime = 0;


        if ($data['is_dir'] == true) {
            ?>
            <tr><td><img src="{{asset('img/folder.png')}}" alt="Folder" /></td>
                <?php
                $isMime = 0;
            } else {
                ?>
                <td><img src="{{asset('img/file.png')}}" alt="file" /></td>
                <?php
                $isMime = 1;
            }
            $pos = strrpos($data['path'], '/');
            $fileName = $pos === false ? $data['path'] : substr($data['path'], $pos + 1);
            echo '<td>' . $fileName . '</td>';
            echo '<td>' . $data['size'] . '</td>';

            echo "<td>";
            if ($isMime == 1 && $data['mime_type'] == 'text/plain') {
                echo "<form method='post' action='edit'>";
                echo "<input type='hidden' name='hidden-edit-path' value='" . $data['path'] . "' >";
                echo "<input type ='hidden' name = 'hidden-edit-name' value ='" . $fileName . "' >";
                //echo "<input type='hidden' name='_token' value='".$csrf_token()."' >"; 
                echo "<input type='submit' value='Edit' name='edit' class='tiny button' />";
                echo "</form></td>";
            }

            
            echo "<td><form method='post' action='share'>";
            echo "<input type='hidden' name='hidden-file-path' value='" . $data['path'] . "' >";
            echo "<input type='submit' value='Share' name='share' class='success tiny  button' />";
            echo "</form></td>";
            
            if ($isMime == 1){
            echo "<td><form method='post' action='sendToGoogleDrive'>";
            echo "<input type='hidden' name='hidden-file-path' value='" . $data['path'] . "' >";
            echo "<input type='hidden' name='hidden-mime-type' value='" . $data['mime_type'] . "' >";
            echo "<input type='submit' value='Send to Google Drive' name='send' class='secondary tiny  button' />";
            echo "</form></td>";
            }

            echo '</tr>';
        }
        echo '</table>';
        ?>
</div>
@stop

