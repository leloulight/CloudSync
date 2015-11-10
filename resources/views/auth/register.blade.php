@extends('layouts.default')
@section('content')
    
    
    
<div class="row">
    <div class="large-6 columns">
        <div class="signup-panel">
            <p class="welcome"> Register!</p>
                
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form role="form" method="POST" action="/auth/register">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row collapse">
                    <div class="small-2  columns">
                        <span class="prefix"><i class="fi-torso-female"></i></span>
                    </div>
                    <div class="small-10  columns">
                        <input type="text" placeholder="username" value="{{ old('name') }}">
                    </div>
                </div>
                <div class="row collapse">
                    <div class="small-2 columns">
                        <span class="prefix"><i class="fi-mail"></i></span>
                    </div>
                    <div class="small-10  columns">
                        <input type="text" placeholder="email" value="{{ old('email') }}">
                    </div>
                </div>
                <div class="row collapse">
                    <div class="small-2 columns ">
                        <span class="prefix"><i class="fi-lock"></i></span>
                    </div>
                    <div class="small-10 columns ">
                        <input type="text" placeholder="password">
                    </div>
                        
                </div>
                <div class="row collapse">
                    <div class="small-2 columns ">
                        <span class="prefix"><i class="fi-lock"></i></span>
                    </div>
                    <div class="small-10 columns ">
                        
                        <input type="password" placeholder="Confirm Password" name="password_confirmation">
                            
                    </div>
                        
                </div>
                    
            </form>
            <button type="submit" class="button">
                Register
            </button>
            <p>Already have an account? <a href="/CloudSync/public/auth/login">Login here &raquo</a></p>
        </div>
    </div>
</div>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
<!--
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                                
                            @endforeach
                        </ul>
                            
                    </div>
                    @endif
                        
                    <form class="form-horizontal" role="form" method="POST" action="/auth/register">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            
                        <div class="form-group">
                            <label class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                Name:
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                        </div>
                            
                        <div class="form-group">
                            <label class="col-md-4 control-label">E-Mail Address</label>
                            <div class="col-md-6">
                                Email:
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                        </div>
                            
                        <div class="form-group">
                            Password:
                            <label class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>
                            
                        <div class="form-group">
                            Confirm Password:
                            <label class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>
                            
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                                
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
-->
@stop