@extends('layouts.admin')


@section('content')

<div class="container">

    <div class="row">

    <div class="col-sm-3">
        <img src="{{$user->photo ? $user->photo->getProfilePic($user->photo->file) : asset('images/placeholder.png')}}" alt="" class="img-responsive img-rounded">
    </div>

    <div class="col-sm-9">
    <h1>Edit User</h1>

    {!! Form::model($user, ['method' => 'PATCH', 'action' => ['AdminUsersController@update', $user->id], 'files' => true]) !!}
    {{csrf_field()}}
    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', 'Email:') !!}
        {!! Form::email('email', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('role_id', 'Role:') !!}
        {!! Form::select('role_id', [''=>'Choose Options'] + $roles , null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('is_active', 'Status:') !!}
        {!! Form::select('is_active', array(1 => 'Active', 0 => 'Not Active' ), null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('photo_id', 'Photo:') !!}
        {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password', 'Password:') !!}
        {!! Form::password('password', ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Create User', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
    </div>

    </div>


    <div class="row">
        <div class="col-sm-4 col-sm-offset-3">
            @include('includes.form_error')
        </div>
    </div>

</div>

@stop