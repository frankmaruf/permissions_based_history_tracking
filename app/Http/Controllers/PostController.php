<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->authorizeResource(Post::class, 'post');
    }
    public function index(Post $post){
        // $this->authorize('index',$post);
        $posts = $post::status()->get();
        // $posts = Post::with('users')->get();
        // return View::make()->with()
        return response()->json($posts);
    }
    public function update(Post $post){
        // $this->authorize('update',$post,$user);
    }
}
