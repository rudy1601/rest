<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function list()
    {
        $posts = Post::get()->map(function ($item) {
            $data['id']     = $item->id;
            $data['title']  = $item->title;
            $data['body']   = $item->body;
            $data['author'] = $item->user->name;

            return $data;
        });
        return response()->json($posts, 200);
    }
}
