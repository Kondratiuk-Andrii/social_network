<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Inertia\Response;

class PostController extends Controller
{
    public function index(): Response
    {
        $posts = PostResource::collection(Post::all())->resolve();

        return inertia('Post/Index', compact('posts'));
    }

    public function create(): Response
    {
        return inertia('Post/Create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {

        $data = $request->validated();

        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->put('/images', $request['image']);
            $data['image'] = $path;
        }
        $data['user_id'] = auth()->user()->id;

        Post::create($data);

        return redirect()->back()->with('message', 'Post created successfully');

    }

    public function show(Post $post): Response
    {
        $post = (new PostResource($post))->resolve();

        return inertia('Post/Show', compact('post'));
    }

    public function edit(Post $post): Response
    {
        $post = (new PostResource($post))->resolve();

        return inertia('Post/Edit', compact('post'));
    }

    public function update(UpdateRequest $request, Post $post): RedirectResponse
    {
        $post->update($request->validated());

        return redirect()->route('post.index');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('post.index');
    }
}
