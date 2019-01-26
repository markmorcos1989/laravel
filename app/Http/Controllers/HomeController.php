<?php

namespace App\Http\Controllers;

use App\post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = post::orderby('created_at', 'desc')->paginate(15);
        return view('home', compact('posts'));
    }
}
