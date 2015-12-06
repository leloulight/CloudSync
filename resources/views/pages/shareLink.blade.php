@extends('layouts.homeDefault')
@section('content')
<h1>Enter Email Addresses to Share</h1>

<div class ="large-8 columns">
    {!! Form::open(array('action' => 'ShareController@ShareViewMethod', 'class' => 'form')) !!}
    {!! Form::hidden('publicUrl',$publicLink['public_url']) !!} 
    {!! Form::hidden('userName', $publicLink['userName'])!!}
    <div class="control-group">

        <div class="controls">
            {!! Form::label('E-mail Address 1:') !!}
            {!! Form::text('email1', null, 
            array('class'=>'form-control',
            'placeholder'=>'E-mail address 1')) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('E-mail Address 2:') !!}
        {!! Form::text('email2', null, 
        array( 
        'class'=>'form-control', 
        'placeholder'=>'E-mail address 2')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('E-mail Address 3:') !!}
        {!! Form::text('email3', null, 
        array( 
        'class'=>'form-control', 
        'placeholder'=>'E-mail address 3')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('E-mail Address 4:') !!}
        {!! Form::text('email4', null, 
        array( 
        'class'=>'form-control', 
        'placeholder'=>'E-mail address 4')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('E-mail Address 5:') !!}
        {!! Form::text('email5', null, 
        array(
        'class'=>'form-control', 
        'placeholder'=>'E-mail address 5')) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Send Link', 
        array('class'=>'success button')) !!}
    </div>
    {!! Form::close() !!}
</div>
@if ($errors->any())
<ul>
    @foreach($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
</ul>
@endif


@stop



