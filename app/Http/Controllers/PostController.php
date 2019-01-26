<?php

namespace App\Http\Controllers;

use App\post;
use App\tag;
//use App\comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PostController extends Controller
{
    function __construct()
    {
        return $this->middleware('auth')->except('welcome');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('tags'))
        {
            $tag = Tag::find($request->tags);
            $posts = $tag->posts;
        }else{
            $posts = post::paginate(10);
        }

        //$posts = post::orderby('created_at', 'desc')->paginate(15);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $posts = post::all();

        return view('posts.create', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*public function store()
    {
        $validate = request()->validate([
            'subject' => 'required',
            'post' => 'required'
        ]);

        //post::create($validate + ['user_id'=>auth()->id()]);

        auth()->user()->posts()->create($validate);

        //return back()->withMessage('post created');

        return redirect('/home');
    }*/

    public function store(Request $request)
    {
        //validate
        $this->validate($request, [
            'subject' => 'required',
            'tags'    => 'required',
            'post'  => 'required',
//            'g-recaptcha-response' => 'required|captcha'
        ]);
        //store
        $post = auth()->user()->posts()->create($request->all());
        $post->tags()->attach($request->tags);
        //redirect
        return back()->withMessage('post Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = post::all();

        $post = post::findorfail($id);

        //$this->authorize('update', $post);

        return view('posts.show', compact('post', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = post::all();

        $post = post::findorfail($id);

        abort_if($post->user_id !== auth()->id(), 403);

        return view('posts.edit', compact('post', 'posts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $post = post::findorfail($id);

        abort_if($post->user_id !== auth()->id(), 403);

        $validate = request()->validate([
            'subject'=>'required',
            'post'=>'required'
        ]);

        $post->update($validate);

        //return back()->withMessage('post updated');

        return redirect()->route('posts.show', $post->id)->withMessage('post updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = post::findorfail($id);

        abort_if($post->user_id !== auth()->id(), 403);

        $post->delete();

        return redirect('/home');
    }
}
