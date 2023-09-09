<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Like;
use App\Models\Post;
use App\Models\Saved;
use App\Models\Type;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category', 'type', 'likes','saveds')
        ->with('user', function ($query) {
            $query->withCount('followers', 'followings');
        })
        ->get();
        // dd($posts->toArray());
        return view('post.home', compact('posts'));
    }

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'type_id' => 'required|nullable',
            'category_id' => 'required|nullable',
            'content_url' => 'required|nullable|file',
        ]);

        // dd($request->toArray());

        // Mengunggah dan menyimpan file di folder simbolik
        if ($request->hasFile('content_url')) {
            $file = $request->file('content_url');
            $path = $file->store('post-images'); // Ganti 'folder-simbolik' sesuai dengan folder yang Anda inginkan
        } else {
            $path = null;
        }

        $post = Post::create([
            'title' => ucfirst($request->title),
            'user_id' => auth()->user()->id,
            'type_id' => $request->type_id,
            'category_id' => $request->category_id,
            'content_url' => $path,
        ]);

        return redirect()->route('profile.index',auth()->user()->name)->with('success', 'Post created successfully!');
    }

    public function create()
    {
        $categories = Category::all();
        $types = Type::all();
        return view('post.create', compact('categories', 'types'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $types = Type::all();
        return view('post.edit', compact('post', 'categories', 'types'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'type_id' => 'required|nullable',
            'category_id' => 'required|nullable',
        ]);

        $post->update([
            'title' => ucfirst($request->title),
            'user_id' => auth()->user()->id,
            'type_id' => $request->type_id,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('profile.index')->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        if (auth()->user()->id == $post->user_id) {
            $post->delete();
            // tinggal kasih event berhasil
            return redirect()->route('profile.index')->with('success', 'Post deleted successfully!');
        }
    }

    public function message()
    {
        return view('pesan.index');
    }

    public function notification()
    {
        return view('notifikasi.index');
    }


    public function like(Post $post)
    {
        // $like =  new Like();
        // $like->user_id = auth()->user()->id;
        // $like->post_id = $post->id;
        // $like->save();


        $like = Like::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
        ]);
        $message = $post->title . ' Liked Successfully!';
        // dd($like);
        // dd($post->toArray());
        return redirect()->back()->with('success', $message);
    }

    public function unlike(Post $post)
    {
        $like = Like::where('user_id', auth()->user()->id)
            ->where('post_id', $post->id)
            ->first();

        if ($like) {
            $like->delete();
            $message = $post->title . ' Unliked Successfully!';
        }

        return redirect()->back()->with('success', $message);
    }

    public function save(Post $post)
    {
        // $save =  new Saved();
        // $save->user_id = auth()->user()->id;
        // $save->post_id = $post->id;
        // $save->save();

        $like = Saved::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
        ]);
        $message = $post->title . ' Saved Successfully!';
        // dd($like);
        return redirect()->back()->with('success', $message);
    }

    public function unsave(Post $post)
    {
        $save = Saved::where('user_id', auth()->user()->id)
            ->where('post_id', $post->id)
            ->first();

        if ($save) {
            $save->delete();
            $message = $post->title . ' Unsaved Successfully!';
        }

        return redirect()->back()->with('success', $message);
    }
}
