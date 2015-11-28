@extends('layouts.default')
@section('content')
    
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>
                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
        
                    @if (count($errors) > 0)
                    <div class="alert-box alert radius">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    
                     {!! Form::open(array('url' => '/password/email','method' => 'POST' )) !!}
                          <div class="form-group">
                  <span>Email</span>
                    {!! Form::text('email', $value = old('email'), ['class' => 'form-control']) !!}
                </div>
                     
                      <div class="form-group">
                     {!! Form::submit('Send Password Reset Link', ['class' =>'button']) !!} </div>
                     
                     {!! Form::close() !!}
                  <!--  <form class="form-horizontal" role="form" method="POST" action="/password/email">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
                        <div class="form-group">
                            <label class="col-md-4 control-label">E-Mail Address</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                        </div>
    
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form> -->
    
                </div>
            </div>
        </div>
    </div>
</div>
    
@stop