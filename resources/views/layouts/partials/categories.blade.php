<div class="col-md-3">
    {{--<a class="btn btn-success form-control"  href="posts/create">Create post</a> <br><br>--}}
    <h4>languages</h4>
    <ul class="list-group">
        <a href="{{route('posts.index')}}" class="list-group-item">
            <span class="badge">{{$posts->count()}}</span>
            All posts
        </a>
        @foreach($tags as $tag)
            <a href="{{route('posts.index',['tags'=>$tag->id])}}" class="list-group-item">
                <span class="badge">{{$tag->posts()->count()}}</span>
                {{$tag->name}}
            </a>
        @endforeach
    </ul>
</div>