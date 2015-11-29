<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

trait RegistersUsers
{
    use RedirectsUsers;

    var $confirmation_code = "";
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        
        Auth::login($this->create($request->all()));
       
         Session::flash('message',Auth::user()->name . ', Thank you for registering! :) '); 
        Session::flash('alert-class', 'success radius'); 
        
        $temppath = '/drive/'.Auth::id().'/temp';
         $sendpath = '/drive/'.Auth::id().'/send';
       // File::makeDirectory($path, $mode = 0777, true, true);
        
        Storage::disk('local')->makeDirectory($temppath);
        Storage::disk('local')->makeDirectory($sendpath);
        return redirect($this->redirectPath());
    }
    
  
}
