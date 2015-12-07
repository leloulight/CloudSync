@extends('layouts.homeDefault')
@section('content')
<h2>Settings</h2>


<div class="large-12 columns panel callout radius">

<table>
    <tr>
        <td><h5>Username</h5></td>
        <td><h5>Dropbox</h5></td>
        
     <?php    if (isset($userConfig)) {

           
            if ($userConfig[0] == 0) { ?>
        <td><button class='button' name='dropbox'>Login</button> </td>
     <?php  } else if ($userConfig[0] == 1) { ?>
        <td><button class='alert button' name='dropbox'>Logout</button> </td>
       <?php } ?>
    </tr>

 <tr>
     <td><h5>Username</h5></td>
     <td><h5>Google Drive</h5></td>
     <?php if ($userConfig[1] == 0) { ?>
        <td> <button class="button" name='drive'>Login</button></td>
       <?php  } else if ($userConfig[0] == 1) { ?>
        <td><button class='alert button' name='drive'>Logout</button> </td>
     <?php } } ?>  
    </tr>
        
</table>

</div>

@stop