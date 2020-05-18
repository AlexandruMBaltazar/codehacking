@extends('layouts.admin')

@section('content')
    <h1>Posts</h1>

    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Owner</th>
            <th>Category</th>
            <th>Photo</th>
            <th>Title</th>
            <th>Body</th>
            <th>Live Post</th>
            <th>View Comments</th>
            <th>Created</th>
            <th>Updated</th>
        </tr>
        </thead>
        <tbody>
        @if($posts)
            @foreach($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->user->name}}</a></td>
                    <td>{{$post->category ? $post->category->name : "No Category"}}</td>
                    <td>
                        @if($post->photo)
                            <img height="50" src="{{$post->photo->getProfilePic($post->photo->file)}}">
                        @else
                            <img height="50" src="{{asset('images/placeholder.png')}}">
                        @endif
                    </td>
                    <td>{{$post->title}}</td>
                    <td>{{str_limit($post->body, 30)}}</td>
                    <td><a class="btn btn-info" href="{{route('home.post', $post->id)}}">View Post</a></td>
                    <td><a class="btn btn-info" href="{{route('admin.comments.show', $post->id)}}">View Comments</a></td>
                    <td>{{$post->created_at->diffForhumans()}}</td>
                    <td>{{$post->updated_at->diffForhumans()}}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@stop