<?php

namespace App\Services;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\TemporaryFile;
use Illuminate\Support\Str;

class PostService
{
    public function store(StorePostRequest $request) : Post
    {
        $data = [
            'slug' => Str::slug($request->title),
            'title' => $request->title,
            'content' => $request->content
        ];

        $post = Post::create($data);

        $temporaryFile = TemporaryFile::whereFolder($request->image)->first();

        if($temporaryFile) {
            $post->addMedia(
                storage_path("app/public/files/tmp/$request->image/$temporaryFile->filename")
            )->toMediaCollection('posts');
            rmdir(storage_path("app/public/files/tmp/$request->image"));
            $temporaryFile->delete();
        }

        return $post;
    }

    public function update(UpdatePostRequest $request, Post $post) : Post
    {
        $data = [
            'slug' => Str::slug($request->title),
            'title' => $request->title,
            'content' => $request->content
        ];

        if($request->image) {

            $temporaryFile = TemporaryFile::whereFolder($request->image)->first();

            if($temporaryFile) {
                $post->addMedia(
                    storage_path("app/public/files/tmp/$request->image/$temporaryFile->filename")
                )->toMediaCollection('posts');
                rmdir(storage_path("app/public/files/tmp/$request->image"));
                $temporaryFile->delete();
            }
        }

        $post->update($data);

        return $post;
    }
}
