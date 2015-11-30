@extends('layouts.homeDefault')
@section('content')
<h2>Settings</h2>


<div class="large-12 columns panel callout radius">

<table>
    <tr>
        <td><h5>Username</h5></td>
        <td><h5>Dropbox</h5></td>
        <td><button class='button' name='dropbox'>Login</button> </td>
    </tr>

 <tr>
     <td><h5>Username</h5></td>
     <td><h5>Google Drive</h5></td>
        <td> <button class="button" name='drive'>Login</button></td>
    </tr>
        
</table>

</div>

@stop