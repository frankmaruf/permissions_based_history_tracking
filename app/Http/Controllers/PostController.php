<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
        // $this->middleware('auth:api');
        $this->authorizeResource(Post::class, 'post');
        // $this->authorizeResource(Post::class, 'post');
    }
    public function index(Post $post){
        // $this->authorize('index',$post);
        $posts = $post::status()->get();
        // $posts = Post::with('users')->get();
        // return View::make()->with()
        return response()->json($posts);
    }
    public function create(Request $request,Post $post){
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->status = 0;
        $post->user_id = Auth::user()->id;
        $post->save();
        return response()->json($post);
    }
    public function update(Post $post){
        // $this->authorize('update',$post,$user);
    }
}
