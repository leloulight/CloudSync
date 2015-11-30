<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use Validator;
use Redirect;
use Mail;

class ShareController extends Controller {

    public function ShareViewMethod() {
        echo "inside";
//        $this->validate($request, [
//            'emaill' => 'required|email'
//                ]
//        );
//        $inputs = $request->all();
//        return Redirect('pages.ShareLink');
        //$postData = Input::all();
// var_dump($postData);
//
//        $messages = [
//            'email1' => 'Enter a valid email address',
//        ];
//
//        $rules = [
//            'email1' => 'email',
//        ];
//        $validator = Validator::make($postData, $rules, $messages);
//        if ($validator->fails()) {
//            // send back to the page with the input data and errors
//            return View('pages.shareLink')->withInput(Input::all());
//        } else {
//            // Do your stuff here.
//            // send back to the page with success message
//            return View('pages.shareLink');
//        }

        $email1 = $_POST['email1'];
        $email2 = $_POST['email2'];
        $email3 = $_POST['email3'];
        $email4 = $_POST['email4'];
        $email5 = $_POST['email5'];

        $emailAddresses = array();
        if ($email1!= "") {
            $emailAddresses[sizeof($emailAddresses)] = $email1;
        }
        if ($email2!= "") {
            $emailAddresses[sizeof($emailAddresses)] = $email2;
        }
        if ($email3!= "")  {
            $emailAddresses[sizeof($emailAddresses)] = $email3;
        }
        if ($email4!= "")  {
            $emailAddresses[sizeof($emailAddresses)] = $email4;
        }
        if ($email5!= "")  {
            $emailAddresses[sizeof($emailAddresses)] = $email5;
        }

               
        Mail::send('pages.shareLink', [], function($message) use ($emailAddresses) {
            $message->to($emailAddresses)->subject('This is test e-mail');
        });
        var_dump(Mail:: failures());
        exit;
    }

    public function SendEmail(Request $request) {

        $email1 = $_POST['email1'];
        $email2 = isset($_POST['email2']);
        $email3 = isset($_POST['email3']);
        $email4 = isset($_POST['email4']);
        $email5 = isset($_POST['email5']);
        echo $email1;
        echo $email2;
        echo $email3;
        echo $email4;
        echo $email5;
    }

}
