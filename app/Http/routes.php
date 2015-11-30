<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\Dropbox;
use App\GoogleDrive;
use Illuminate\Support\Facades\Auth;



Route::get('/', function () {
    return view('pages.index');
});

Route::get('/home', function () {
    
    $userConfig = array();
    
    $dropboxId = Dropbox::where('userId',1)->count();
    
    //var_dump($dropboxId);
    $googleDriveId = GoogleDrive::where('userId',1)->count();
    
    if($dropboxId == 1){
        $userConfig[0] = 1;
    }
    else{
        $userConfig[0] = 0;
    }
          
    if($googleDriveId == 1){
         $userConfig[1] = 1;
    }
    else{
        $userConfig[1] = 0;
    }
    
    return view('pages.home')->with('userConfig',$userConfig);
});

Route::post('/save', 'EditController@closeEditor');

Route::post('edit', 'EditController@openEditor');

Route::get('/dropbox', function () {
    return view('pages.dropbox');
});
Route::get('sendemail', function () {
    $emails = array("prannoy23@gmail.com", "rvyas303@gmail.com");
Mail::send('pages.email', [], function($message) use ($emails)
{    
    $message->to($emails)->subject('This is test e-mail');    
});
var_dump( Mail:: failures());
exit;
});

//Route::post('share', function() {
//    
//$data = Request::all();
//$publicUrl = $data["hidden-file-path"];
//var_dump($publicUrl);
//die();
//return view('pages.shareLink');
//    
//});
Route::post('ShareView','ShareController@ShareViewMethod');

Route::get('faq',  function () {
    
    return view('pages.faq');
    
});

Route::get('computername',  function () {
    
    return view('pages.computername');
    
});


// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');




// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::get('dropbox/login',"DropboxController@dropboxAuth");
Route::get('FacebookModel.php',"DropboxController@dropboxSuccess");
Route::get('googleDrive/login',"GoogleDriveController@googleDriveAuth");
Route::get('GoogleDriveModel.php','GoogleDriveController@googleDriveSuccess');

Route::get('googleDrivefolder','GoogleDriveController@googleDriveSuccess');


Route::post('share','DropboxController@createShareLink');
Route::post('sendToGoogleDrive','DropboxController@sendToGoogleDrive');



Route::post('googledrive/send','GoogleDriveController@sendToDropbox');
Route::get('googleDrive/googleDriveFolder','GoogleDriveController@googleDriveFolder');
Route::get('dropboxFolder','DropboxController@dropboxFolder');

Route::get('register/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'RegistrationController@confirm'
]);
