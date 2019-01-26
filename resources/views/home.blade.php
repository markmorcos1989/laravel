@extends('layouts.front')

@section('title')
    <h1>posts</h1>
@endsection

{{--@section('category')   
    {{--@include('layouts.partials.categories')
    <br>
    <h4>Tags</h4>
    <ul class="list-group">
        <a href="{{route('posts.index')}}" class="list-group-item">
            <span class="badge">{{$posts->count()}}</span>
            All Threads
        </a>
        @foreach($tags as $tag)
            <a href="{{route('posts.index',['tags'=>$tag->id])}}" class="list-group-item">
                <span class="badge">{{$tag->posts()->count()}}</span>
                {{$tag->id}}
            </a>
        @endforeach
    </ul>
@endsection--}}

@section('content')
    <div class="list-group">
        @forelse($posts as $post)
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><a href="/posts/{{$post->id}}"> {{$post->subject}}</a></h3>
                </div>
                <div class="panel-body">
                    <p>{{str_limit($post->post,100) }}
                        <br>
                        Posted by <a href="/user/profile/{{$post->user->name}}">{{$post->user->name}}</a> {{$post->created_at->diffForHumans()}}
                    </p>
                </div>
            </div>

        @empty
            <h5>No threads</h5>

        @endforelse
    </div>
@endsection
