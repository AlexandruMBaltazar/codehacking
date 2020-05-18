@extends("layouts.blog-post")


@section('content')


    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{$post->photo->getProfilePic($post->photo->file)}}" alt="">

    <hr>

    <!-- Post Content -->
    <p>{{$post->body}}</p>

    <hr>

    @if(\Illuminate\Support\Facades\Session::has('comment_message'))
        {{session('comment_message')}}
    @endif

    <!-- Blog Comments -->
@if(\Illuminate\Support\Facades\Auth::check())
    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>

        {!! Form::open(['method' => 'POST', 'action' => 'PostCommentsController@store']) !!}
            {{csrf_field()}}
            <input type="hidden" name="post_id" value="{{$post->id}}">

            <div class="form-group">
                {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3]) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Submit Comment', ['class'=>'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}

    </div>
@endif
    <hr>

    <!-- Posted Comments -->
@if(count($comments) > 0)
    @foreach($comments as $comment)
    <!-- Comment -->
    <div class="media">
        <a class="pull-left" href="#">
            <img height="64" class="media-object" src="{{asset('images/'.$comment->photo)}}" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">{{$comment->author}}
                <small>{{$comment->created_at->diffForhumans()}}</small>
            </h4>
            {{$comment->body}}
        </div>
        <!-- Nested Comment -->
        @if($replies = $comment->replies()->get())
            @foreach($replies as $reply)
        <div id = "nested-comment" class="media">
            <a class="pull-left" href="#">
                <img height="64" class="media-object" src="{{asset('images/'.$reply->photo)}}" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading">{{$reply->author}}
                    <small>{{$reply->created_at->diffForhumans()}}</small>
                </h4>
                {{$reply->body}}
            </div>
            @endforeach
            {!! Form::open(['method' => 'POST', 'action' => 'CommentRepliesController@createReply']) !!}
            {{csrf_field()}}
                <input type="hidden" name="comment_id" value="{{$comment->id}}">
                <div class="form-group">
                    {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3]) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Reply', ['class'=>'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}


        </div>
        <!-- End Nested Comment -->
            @endif
    </div>
    @endforeach
@endif



@stop