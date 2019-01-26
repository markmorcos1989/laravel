<?php

namespace App\Http\Controllers;

use App\Comment;
use App\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class LikeController extends Controller
{
    public function PostToggleLike()
   {
       $postId=Input::get('postId');
       $post=post::find($postId);
//        $usersLike= $comment->likes()->where('user_id',auth()->id())->where('likable_id',$commentId)->first();
        if(!$post->isLiked()){
            $post->likeIt();
            return response()->json(['status'=>'success','message'=>'liked']);
        }else{
            $post->unlikeIt();
            return response()->json(['status'=>'success','message'=>'unliked']);
        }
   }

   public function CommentToggleLike()
   {
       $commentId=Input::get('commentId');
       $comment=Comment::find($commentId);
//        $usersLike= $comment->likes()->where('user_id',auth()->id())->where('likable_id',$commentId)->first();
        if(!$comment->isLiked()){
            $comment->likeIt();
            return response()->json(['status'=>'success','message'=>'liked']);
        }else{
            $comment->unlikeIt();
            return response()->json(['status'=>'success','message'=>'unliked']);
        }
   }
}
