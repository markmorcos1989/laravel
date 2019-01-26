<?php

namespace App\Http\Controllers;

use App\comment;
use App\post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function addPostComment($id)
    {
        $post = post::findorfail($id);

        $validate = request()->validate([
            'comment' => 'required'
        ]);

        $post->comments()->create($validate + ['user_id'=>auth()->id()]+['commentable_subject'=>$post->subject]);

        return back()->withMessage('comment created');
    }

    public function addReplyComment($id)
    {
        $comment = comment::findorfail($id);

        $validate = request()->validate([
            'comment' => 'required'
        ]);

        $comment->comments()->create($validate + ['user_id'=>auth()->id()]+['commentable_subject'=>$comment->comment]);

        return back()->withMessage('reply created');
    }
   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $comment = comment::findorfail($id);

        abort_if($comment->user_id !== auth()->id(), 403);

        $validate = request()->validate([
            'comment' => 'required'
        ]);

        $comment->update($validate);

        return back()->withMessage('comment updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = comment::findorfail($id);

        abort_if($comment->user_id !== auth()->id(), 403);

        $comment->delete();

        return back()->withMessage('comment deleted');
    }
}
