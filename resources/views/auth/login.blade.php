@extends('layouts.indexDefault')
@section('content')


<div class="container-fluid">
         
<div class="row">
@if(Session::has('message'))
<p class="alert-box {{ Session::get('alert-class', 'success radius') }}">{{ Session::get('message') }}</p>
@endif
    <script>
       $(document).foundation();
       </script>
       @if (count($errors) > 0)
            <div data-alert class="alert-box alert radius">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                 <a href="#" class="close">&times;</a>
            </div>
  
            @endif
    <div class="col-md-6 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Login</div>
            <div class="panel-body">
                
                {!! Form::open(array('url' => '/auth/login','method' => 'POST' )) !!}
                
                <div class="form-group">
                  <span>Email</span>
                    {!! Form::text('email', $value = old('email'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <span>Password</span>
                    {!! Form::password('password', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <span> 
                    {!! Form::checkbox('name', 'Remeber Me', true) !!}
                    Remember Me
                    </span>
                </div>
                 <div class="form-group">
                     {!! Form::submit('Login', ['class' =>'button']) !!} </div>
                   <div class="form-group">
                       {!! link_to('/password/email', 'Forgot Your Password?') !!} </div>
                    
                    
                {!! Form::close() !!}
                    
             <!--    <form class="form-horizontal" role="form" method="POST" action="/public/auth/login"> 
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                    <div class="form-group">
                        <span>Email</span>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                        </div>
                    </div>
                        
                    <div class="form-group">
                       <span>Password</span>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="checkbox">
                                <span>
                                    <input type="checkbox" name="remember"> Remember Me
                                </span>
                            </div>
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                                Login
                            </button>
                                
                            <a href="/password/email">Forgot Your Password?</a>
                        </div>
                    </div>
                </form> -->
            </div>
        </div>
    </div>
        
</div>
</div>  
    
@stop