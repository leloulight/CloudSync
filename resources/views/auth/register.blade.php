@extends('layouts.indexDefault')
@section('content')
    
     
  
<div class="container-fluid" >
<div class="row">
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
    <div class="large-10 columns">
        <div class="panel panel-default">
            <p class="welcome"> Register!</p>
                
     
            
             {!! Form::open(array('url' => '/auth/register','method' => 'POST' )) !!}
                <div class="row collapse">
                    <div class="small-2 columns">
                      <span class="prefix">Name<i class="fi-mail"></i></span>
                     </div>
                    <div class="small-10  columns">
                          {!! Form::text('name', $value = old('name'), ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="row collapse">
                  <div class="small-2 columns">
                             <span class="prefix">Email<i class="fi-mail"></i></span>
                     </div>
                    <div class="small-10  columns">
                    {!! Form::text('email', $value = old('email'), ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="row collapse">
                    <div class="small-2 columns">
                   <span class="prefix">Password<i class="fi-mail"></i></span> </div>
                    <div class="small-10  columns">
                    {!! Form::password('password', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="row collapse">
                     <div class="small-2 columns">
                          <span class="prefix">Confirm Password<i class="fi-mail"></i></span>
                     </div>
                    <div class="small-10  columns">
                    {!! Form::password('password_confirmation', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                 <div class="row collapse">
                     {!! Form::submit('Register', ['class' =>'button']) !!} </div>
                         
                {!! Form::close() !!}
            
     
            
            <p>Already have an account? <a href="/CloudSync/public/auth/login">Login here &raquo</a></p>
        </div>
    </div>
</div>
    
  </div>  
  
@stop