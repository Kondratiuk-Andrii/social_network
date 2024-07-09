<?php

namespace App\Http\Controllers;

use App\Http\Resources\Post\PostResource;
use App\Models\Post;

class PersonalController extends Controller
{
    public function index()
    {

        $posts = PostResource::collection(Post::all())->resolve();

        return inertia('Personal/Index', [
            'posts' => $posts,
        ]);
    }
}
