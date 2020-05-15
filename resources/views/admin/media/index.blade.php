@extends('layouts.admin')

@section('content')
    <h1>Media</h1>

    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Created</th>
            <th>Remove Media</th>
        </tr>
        </thead>
        <tbody>
        @if($media)
            @foreach($media as $photo)
                <tr>
                    <td>{{$photo->id}}</td>
                    <td><img height="100x" src="{{$photo->getProfilePic($photo->file)}}"></td>
                    <td>{{$photo->created_at->diffForhumans()}}</td>

                    <td>
                        {!! Form::open(['method' => 'DELETE', 'action' => ['AdminMediaController@destroy', $photo->id]]) !!}
                        {{csrf_field()}}

                        <div class="form-group">
                            {!! Form::submit('Delete Category', ['class'=>'btn btn-danger']) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@stop