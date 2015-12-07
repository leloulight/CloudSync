<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Http\Controllers;
/**
 * Description of RegistrationController
 *
 * @author Crusty
 */
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class RegistrationController extends Controller {
    public function confirm($confirmation_code)
    {
        if( ! $confirmation_code)
        {
            throw new InvalidConfirmationCodeException;
        }

        $user = User::where('confirmation_code',$confirmation_code)->first();

        if (!$user)
        {
            throw new InvalidConfirmationCodeException;
        }

        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();

      
        if(Auth::user()!=null){
            Session::flash('message',Auth::user()->name . ', Your email has been verified! '); 
                Session::flash('alert-class', 'success radius'); 
        }
        else {
                 Session::flash('message','Your email has been verified! '); 
               Session::flash('alert-class', 'success radius'); 
        }
        
        

        return response()->view('auth.login');
    }
}
