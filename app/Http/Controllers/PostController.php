<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = [
            ['id' => 1, 'title' => 'laravel', 'posted_by' => 'ahmed', 'created_at' => '2025-03-08 12:47:00'],
            ['id' => 2, 'title' => 'HTML', 'posted_by' => 'mohamed', 'created_at' => '2025-04-10 11:00:00'],
        ];

        return view('posts.index', ['posts' => $posts]);
    }

    public function show($id)
    {
        $post = [
            'id' => 1,
            'title' => 'laravel',
            'description' => 'some description',
            'posted_by' => [
                'name' => 'ahmed',
                'email' => 'test@gmail.com',
                'created_at' => 'Thursday 25th of December 1975 02:15:16 PM'
            ],
            'created_at' => '2025-03-08 12:47:00',
        ];

        return view('posts.show', ['post' => $post]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {

        $title = request()->title;
        $description = request()->description;

        return to_route('posts.show', 1);
    }

    public function edit($id)
    {
        $post = [
            'id' => $id,
            'title' => 'Laravel',
            'description' => 'Some description about Laravel',
            'name' => 'ahmed',
        ];

        return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request, $id)
    {
        $data = request()->all();

        return to_route('posts.index');
    }

    public function destroy($id)
    {
         dd($id);
        // return to_route('posts.index');
    }
}
