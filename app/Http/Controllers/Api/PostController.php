<?php

namespace App\Http\Controllers\Api;
use  App\Http\Resources\PostResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use Illuminate\Http\Request;
use App\Models\Post;
class PostController extends Controller
{
    // public function index()
    // {
    //     return Post::all();
    // }

    // public function show($id)
    // {
    //     return Post::findOrFail($id);
    // }

    // public function store(StorePostRequest $request)
    // {
    //     $title = request()->title;
    //     $description = request()->description;
    //     $user_id = request()->post_creator;

    //     $post = Post::create([
    //         'title' => $title,
    //         'description' => $description,
    //         'user_id' => $user_id,
    //     ]);

    //     return $post;
    // }
    public function index()
    {
        return Post::all();
        $posts = Post::all();

        return PostResource::collection($posts);
    }

    public function show($id)
    {
        return Post::findOrFail($id);
        $post = Post::findOrFail($id);

        return new PostResource($post);
    }

    public function store(StorePostRequest $request)
    {
        $title = request()->title;
        $description = request()->description;
        $user_id = request()->post_creator;

        $post = Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $user_id,
        ]);

        return $post;
        return new PostResource($post);
    }


}
