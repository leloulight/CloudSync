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
       
         Session::flash('message',Auth::user()->name . ', Thank you for registering! Please Verify your email !!! '); 
        Session::flash('alert-class', 'success radius'); 
        
        $temppathdrive = '/drive/'.Auth::id().'/temp';
         $sendpathdrive = '/drive/'.Auth::id().'/send';
       // File::makeDirectory($path, $mode = 0777, true, true);
         $temppathdrop = '/dropbox/'.Auth::id().'/temp';
         $sendpathdrp = '/dropbox/'.Auth::id().'/send';
         
        Storage::disk('local')->makeDirectory($temppathdrive);
        Storage::disk('local')->makeDirectory($sendpathdrive);
        
        Storage::disk('local')->makeDirectory($temppathdrop);
        Storage::disk('local')->makeDirectory($temppathdrop);
        return redirect($this->redirectPath());
    }
    
    
  
}
