@extends('layouts.default')
@section('content')
<div class="container-fluid">
    <div class="row">
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
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>
                <div class="panel-body">
     
             
                     {!! Form::open(array('url' => '/password/reset','method' => 'POST' )) !!}
                     
                      <div class="form-group">
                  <span>Email</span>
                    {!! Form::text('email', $value = old('email'), ['class' => 'form-control']) !!}
                </div>
                     
                     <div class="form-group">
                    <span>Password</span>
                    {!! Form::password('password', null, ['class' => 'form-control']) !!}
                </div>
                     
                     <div class="form-group">
                    <span>Confirm Password</span>
                    {!! Form::password('password_confirmation', null, ['class' => 'form-control']) !!}
                </div>
                     
                      <div class="form-group">
                     {!! Form::submit('Reset Password', ['class' =>'button']) !!} </div>
                     
                     {!! Form::close() !!}
              <!--      <form class="form-horizontal" role="form" method="POST" action="/password/reset">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="token" value="{{ $token }}">
    
                        <div class="form-group">
                            <label class="col-md-4 control-label">E-Mail Address</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>
     
                        <div class="form-group">
                            <label class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>
      
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="button">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                    </form>  -->
     
                </div>
            </div>
        </div>
    </div>
</div>
    
@stop