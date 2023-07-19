<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\Saved;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
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
        // dd($like);
        return redirect()->back();
    }

    public function unlike(Post $post)
    {
        $like = Like::where('user_id', auth()->user()->id)
            ->where('post_id', $post->id)
            ->first();

        if ($like) {
            $like->delete();
        }

        return redirect()->back();
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
        // dd($like);
        return redirect()->back();
    }

    public function unsave(Post $post)
    {
        $save = Saved::where('user_id', auth()->user()->id)
            ->where('post_id', $post->id)
            ->first();

        if ($save) {
            $save->delete();
        }

        return redirect()->back();
    }
}
