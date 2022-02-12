<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Services\PostService;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->authorizeResource(Post::class);
        $this->postService = $postService;
    }

    public function index()
    {
        $posts = Post::get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request)
    {

        $post = $this->postService->store($request);
        return redirect()->route('posts.index')->withSuccess(__('post.store.success', ['post' => $post->postname]));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $post = $this->postService->update($request, $post);
        return redirect()->route('posts.index')->withSuccess(__('post.update.success', ['post' => $post->postname]));
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->withSuccess(__('post.delete.success', ['post' => $post->postname]));
    }
}
