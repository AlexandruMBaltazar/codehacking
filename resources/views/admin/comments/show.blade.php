@extends('layouts.admin')

@section('content')
    <h1>Comments For This Post</h1>

    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Email</th>
            <th>Body</th>
            <th>Live Post</th>
            <th>Comment Moderation</th>
        </thead>
        <tbody>
        @if($comments)
            @foreach($comments as $comment)
                <tr>
                    <td>{{$comment->id}}</td>
                    <td>{{$comment->author}}</td>
                    <td>{{$comment->email}}</td>
                    <td>{{$comment->body}}</td>
                    <td><a class="btn btn-primary" href="{{route('home.post', $comment->post->id)}}">View Post</a></td>
                    <td>
                        @if($comment->is_active == 1)
                            {!! Form::open(['method' => 'PATCH', 'action' => ['PostCommentsController@update', $comment->id] ]) !!}
                            {{csrf_field()}}
                            <input type="hidden" name="is_active" value="0">

                            <div class="form-group">
                                {!! Form::submit('Un-approve', ['class'=>'btn btn-info']) !!}
                            </div>
                            {!! Form::close() !!}

                        @else
                            {!! Form::open(['method' => 'PATCH', 'action' => ['PostCommentsController@update', $comment->id] ]) !!}
                            {{csrf_field()}}
                            <input type="hidden" name="is_active" value="1">

                            <div class="form-group">
                                {!! Form::submit('Approve', ['class'=>'btn btn-success']) !!}
                            </div>
                            {!! Form::close() !!}
                        @endif
                    </td>

                    <td>
                        {!! Form::open(['method' => 'DELETE', 'action' => ['PostCommentsController@destroy', $comment->id] ]) !!}
                        {{csrf_field()}}

                        <div class="form-group">
                            {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                        </div>
                    {!! Form::close() !!}
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>


@stop