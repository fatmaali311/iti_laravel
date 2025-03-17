<?php
namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Jobs\PruneOldPostsJob;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        // $posts = Post::paginate(30);
        // $laravelpost=Post::where('title','=','laravel')->get();
        //  dd('$posts');
        $posts=Post::with('user')->paginate(10);
        return view('posts.index', ['posts' => $posts]);
    }
    public function trashedpostes()
    {
        $posts = Post::onlyTrashed()->get();

        return view('posts.trashedpostes', ['posts' => $posts]);
    }

    public function show($id)
    {
        $post = Post::find($id);

        return view('posts.show', ['post' => $post]);
    }

    public function create()
    {
        $users = User::all();

        return view('posts.create', ['users' => $users]);
    }

    public function store(StorePostRequest $request)
    {

        $data = [
            'title'       => $request->title,
            'description' => $request->description,
            'user_id'     => $request->user_id,
            'image'       => null,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadFile($request->image, 'posts');
        }

        $post = Post::create($data);
        if ($request->filled('tags')) {
            $tagsArray = array_map('trim', explode(',', $request->tags)); // Split and trim
            $post->attachTags($tagsArray); // Spatie method
        }
        return to_route('posts.show', $post->id);
    }
    //edit
    public function edit($id)
    {
        $post  = $post  = Post::find($id);
        $users = User::all();

        return view('posts.edit', ['post' => $post, 'users' => $users]);
    }
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = [
            'title'       => $request->title,
            'description' => $request->description,
            'user_id'     => $request->user_id,

        ];

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadFile($request->image, 'posts', $post->image);
        }

        $post->update($data);
        if ($request->filled('tags')) {
            $tagsArray = array_map('trim', explode(',', $request->tags));
            $post->syncTags($tagsArray); // replaces old tags
        }

        return to_route('posts.show', $post->id);
    }

    protected function uploadFile($file, $path, $oldFilePath = null)
    {
        if ($oldFilePath) {
            Storage::disk('public')->delete($oldFilePath);
        }

        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs($path, $filename, 'public');
        return $filename;
    }
    //soft delete
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return to_route('posts.index', $post->id);
    }
    // Restore
    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);

        $post->restore();

        return redirect()->route('posts.index');
    }

// Force Delete
    public function forcedelete($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->forceDelete();

        return redirect()->route('posts.trashed');
    }

    public function prunePosts()
    {
        PruneOldPostsJob::dispatch();
        return "Prune job dispatched!";
    }

}
