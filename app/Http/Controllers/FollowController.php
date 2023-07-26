<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;

class FollowController extends Controller
{
    //
    public function follow(User $user)
    {
        $follow = Follow::create([
            'follower_id' => auth()->user()->id,
            'following_id' => $user->id,
        ]);
        $message ='Followed ' . $user->name . ' Successfully!';
        // dd($follow);
        return redirect()->back()->with('success', $message);
    }

    public function unfollow(User $user)
    {
        $follow = Follow::where('follower_id', auth()->user()->id)
            ->where('following_id', $user->id)
            ->first();

        if ($follow) {
            $follow->delete();
            $message = 'Unfollowed ' . $user->name . ' Successfully!';
        }
        return redirect()->back()->with('success', $message);
    }
}
