@extends('layouts.front')


@section('content')
    <div class="content-wrap well">
        <h4>{{$post->subject}}</h4>
        <hr>

        <div class="thread-details">
            {!! \Michelf\Markdown::defaultTransform($post->post)  !!}
        </div>
        <br>

        {{--@if(auth()->user()->id == $thread->user_id)--}}
        <div class="actions">
            <button class="btn btn-default btn-xs" id="{{$post->id}}-count" >{{$post->likes()->count()}}</button>
            <span  class="btn btn-default btn-xs  {{$post->isLiked()?"liked":""}}" onclick="PostlikeIt('{{$post->id}}',this)"><span class="glyphicon glyphicon-heart"></span></span>

            @can('update',$post)
                <a href="/posts/{{$post->id}}/edit" class="btn btn-info btn-xs">Edit</a>

                {{--//delete form--}}
                <form action="/posts/{{$post->id}}" method="POST" class="inline-it">
                    @csrf
                    @method('DELETE')
                    <input class="btn btn-xs btn-danger" type="submit" value="Delete">
                </form>
            @endcan
        </div>
        {{--@endif--}}
    </div>
    <hr>
    <br>

    {{--Answer/comment--}}
    @foreach($post->comments as $comment)
        <div class="comment-list well well-lg">
           <h4>{{$comment->comment}} </h4>
           <lead>{{$comment->user->name}}</lead>
           <div class="actions">
                <button class="btn btn-default btn-xs" id="{{$comment->id}}-countt" >{{$comment->likes()->count()}}</button>
                <span  class="btn btn-default btn-xs  {{$comment->isLiked()?"liked":""}}" onclick="CommentlikeIt('{{$comment->id}}',this)"><span class="glyphicon glyphicon-heart"></span></span>
                {{--//<a href="/comment/{{$comment->id}}/edit" class="btn btn-info btn-xs">Edit</a>--}}
                {{--//edit form--}}
                @can('update',$comment)
                    <a class="btn btn-primary btn-xs" data-toggle="modal" href="#{{$comment->id}}">edit</a>
                    <div class="modal fade" id="{{$comment->id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                                    </button>
                                    <h4 class="modal-title">Modal title</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="comment-form">

                                        <form action="/comment/{{$comment->id}}" method="post" role="form">
                                            @csrf
                                            @method('PATCH')
                                            <legend>Edit comment</legend>

                                            <div class="form-group">
                                                <input type="text" class="form-control" name="comment" id=""
                                                       placeholder="Input..." value="{{$comment->comment}}">
                                            </div>


                                            <button type="submit" class="btn btn-primary">Comment</button>
                                        </form>

                                    </div>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                    {{--//delete form--}}
                    <form action="/comment/{{$comment->id}}" method="POST" class="inline-it">
                        @csrf
                        @method('DELETE')
                        <input class="btn btn-xs btn-danger" type="submit" value="Delete">
                    </form>
                @endcan
            </div>
        </div>
        <hr>

        {{--reply to comment--}}
        <button class="btn btn-xs btn-default" onclick="toggleReply('{{$comment->id}}')">reply</button>
        <br>

        {{--//reply form--}}
        <div style="margin-left: 50px" class="reply-form-{{$comment->id}} hidden">

            <form action="/reply/create/{{$comment->id}}" method="post" role="form">
                @csrf
                <legend>Create Reply</legend>

                <div class="form-group">
                    <input type="text" class="form-control" name="comment" id="" placeholder="Reply...">
                </div>


                <button type="submit" class="btn btn-primary">Reply</button>
            </form>
        </div>
        <br>
        {{-- //'reply-list'--}}
        @foreach($comment->comments as $reply)
            <div class="small well text-info reply-list" style="margin-left: 40px">
                <p>{{$reply->comment}}</p>
                <lead> by {{$reply->user->name}}</lead>

                <div class="actions">
                    <button class="btn btn-default btn-xs" id="{{$reply->id}}-countt" >{{$reply->likes()->count()}}</button>
                    <span  class="btn btn-default btn-xs  {{$reply->isLiked()?"liked":""}}" onclick="CommentlikeIt('{{$reply->id}}',this)"><span class="glyphicon glyphicon-heart"></span></span>
                    {{--Edit reply--}}
                    @can('update',$comment = $reply)
                        <a class="btn btn-primary btn-xs" data-toggle="modal" href="#{{$reply->id}}">edit</a>
                        <div class="modal fade" id="{{$reply->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                                        </button>
                                        <h4 class="modal-title">Modal title</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="comment-form">

                                            <form action="/comment/{{$reply->id}}" method="post" role="form">
                                                @csrf
                                                @method('PATCH')
                                                <legend>Edit comment</legend>

                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="comment" id=""
                                                           placeholder="Input..." value="{{$reply->comment}}">
                                                </div>


                                                <button type="submit" class="btn btn-primary">Reply</button>
                                            </form>
                                        </div>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                   
                        {{--//delete reply form--}}
                        <form action="/comment/{{$reply->id}}" method="POST" class="inline-it">
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-xs btn-danger" type="submit" value="Delete">
                        </form>
                    @endcan
                </div>
            </div>
        @endforeach
    @endforeach  
    <br><br>

    {{--comment-form--}}
    <div class="comment-form">

    <form action="/comment/create/{{$post->id}}" method="post" role="form">
        @csrf
        <legend>Create comment</legend>

        <div class="form-group">
            <input type="text" class="form-control" name="comment" id="" placeholder="Input...">
        </div>


        <button type="submit" class="btn btn-primary">Comment</button>
    </form>

</div>
@endsection

@section('js')

    <script>
        function toggleReply(commentId){
            $('.reply-form-'+commentId).toggleClass('hidden');
        }

        function PostlikeIt(postId,elem){
            var csrfToken='{{csrf_token()}}';
            var likesCount=parseInt($('#'+postId+"-count").text());
            $.post('{{route('PosttoggleLike')}}', {postId: postId,_token:csrfToken}, function (data) {
                console.log(data);
               if(data.message==='liked'){
                   //$(elem).addClass('liked');
                   $('#'+postId+"-count").text(likesCount+1);
                    $(elem).css({color:'red'});
               }else{
                   $(elem).css({color:'black'});
                   $('#'+postId+"-count").text(likesCount-1);
                   $(elem).removeClass('liked');
               }
            });
        }

        function CommentlikeIt(commentId,elem){
            var csrfToken='{{csrf_token()}}';
            var likesCount=parseInt($('#'+commentId+"-countt").text());
            $.post('{{route('CommenttoggleLike')}}', {commentId: commentId,_token:csrfToken}, function (data) {
                console.log(data);
               if(data.message==='liked'){
                   //$(elem).addClass('liked');
                   $('#'+commentId+"-countt").text(likesCount+1);
                    $(elem).css({color:'red'});
               }else{
                   $(elem).css({color:'black'});
                   $('#'+commentId+"-countt").text(likesCount-1);
                   $(elem).removeClass('liked');
               }
            });
        }
    </script>

@endsection