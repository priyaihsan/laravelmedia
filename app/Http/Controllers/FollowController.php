<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    //
    public function follow(User $user)
    {
        $follow = Follow::create([
            'follower_id' => auth()->user()->id,
            'following_id' => $user->id,
        ]);
        // dd($follow);
        return redirect()->back();
    }

    public function unfollow(User $user)
    {
        $follow = Follow::where('follower_id',auth()->user()->id)
                        ->where('following_id',$user->id)
                        ->first();

        if($follow){
            $follow->delete();
        }
        return redirect()->back();
    }
}
