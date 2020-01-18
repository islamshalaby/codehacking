<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;

class PostsController extends Controller
{
    //

    public function post($id)
    {
        $post = Post::findOrFail($id);
        $comments = $post->comments()->whereIsActive(1)->get();
        return view('post', compact(['post', 'comments']));
    }
}
