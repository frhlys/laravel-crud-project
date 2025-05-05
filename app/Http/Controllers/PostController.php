<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function actuallyUpdatePost(Post $post, Request $request){

    }
    
    public function showEditScreen(Post $post){

        return view('edit-post', ['post' =>$post]);
    }
    public function createPost(Request $request) {

        $incomingCalls = $request->validate ([
            'title' => 'required',
            'body' => 'required'
        ]);
    $incomingCalls['title'] = strip_tags($incomingCalls['title']);
    $incomingCalls['body'] = strip_tags($incomingCalls['body']);
    $incomingCalls['user_id'] = auth()->id();
    Post::create($incomingCalls); //create post model in terminal - php artisan make:model Post
    return redirect ('/');
    }
}
 