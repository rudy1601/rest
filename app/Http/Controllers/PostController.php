<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function list()
    {
        $posts = Post::get()->map(function ($item) {
            return $this->singleRest($item);
        });
        
        return response()->json($posts, 200);
    }

    public function store(Request $request)
    {
        $post = Post::create([
            'title'     => $request->title,
            'body'      => $request->body,
            'user_id'    => $this->author()->id
        ]);
        
        return response()->json($this->singleRest($post),200);
    }

    private function author()
    {
        return User::first();
    }

    private function singleRest(Post $post)
    {
        return [
            'id'        => $post->id,
            'title'     => $post->title,
            'body'      => $post->body,
            'author'    => $post->user->name
        ];
    }
}
