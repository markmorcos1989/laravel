@extends('layouts.front')

@section('category')
    <div class="col-md-3" >
    <div class="dp">
    <img src="https://dummyimage.com/300x200/000/fff" alt="">
    </div>
        <h3>
            {{$user->name}}
        </h3>

    </div>

@endsection

@section('content')
<div>
    
    <h3>{{$user->name}}'s latest posts</h3>

    @forelse($posts as $post)
        <h5>{{$post->subject}}</h5>

    @empty
        <h5>No tposts yet</h5>

    @endforelse
    <br>
    <hr>

    <h3>{{$user->name}}'s latest Comments</h3>

    @forelse($comments as $comment)
        <h5>{{$user->name}} commented on <a href="/posts/{{$comment->commentable->id}}">{{$comment->commentable->subject}}</a>  {{$comment->created_at->diffForHumans()}}</h5>
    @empty
    <h5>No comments yet</h5>
    @endforelse
    <br>
    <hr>

    <h3>{{$user->name}}'s latest liked posts</h3>

    @forelse($likes_post as $like)
        <h5>{{$user->name}} liked <a href="/posts/{{$like->likable->id}}">{{$like->likable->subject}}</a>  {{$like->created_at->diffForHumans()}}</h5>
    @empty
    <h5>No likes yet</h5>
    @endforelse
    <br>
    <hr>

    <h3>{{$user->name}}'s latest liked comments</h3>

    @forelse($likes_comment as $like)
       @if($like->likable->commentable_type == 'App\post')
            <h5>{{$user->name}} liked comment "{{$like->likable->comment}}" of post <a href="/posts/{{$like->likable->commentable_id}}">{{$like->likable->commentable_subject}}</a> {{$like->created_at->diffForHumans()}}</h5>
        @else
            <h5>{{$user->name}} liked reply "{{$like->likable->comment}}" of comment "{{$like->likable->commentable_subject}}"  {{$like->created_at->diffForHumans()}}</h5>
        @endif
    @empty
    <h5>No likes yet</h5>
    @endforelse
</div>

@endsection