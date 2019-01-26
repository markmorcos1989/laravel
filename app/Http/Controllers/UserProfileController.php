<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\User;
use App\like;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index(User $user)
    {
       $posts=post::where('user_id',$user->id)->latest()->get();
       $comments=Comment::where('user_id',$user->id)->where('commentable_type','App\Post')->get();
       $replys=Comment::where('user_id',$user->id)->where('commentable_type','App\Comment')->get();
       $likes_post=like::where('user_id',$user->id)->where('likable_type','App\post')->get();
       $likes_comment=like::where('user_id',$user->id)->where('likable_type','App\comment')->get();

       return view('profile.index',compact('posts','comments','user', 'replys', 'likes_post', 'likes_comment'));
    }
}
