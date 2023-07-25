<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Post;
use App\Models\Saved;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use function Pest\Laravel\post;

class ProfileController extends Controller
{
    public function index(): View
    {
        $user = User::with(['posts' => function ($query) {
            // Menggunakan with untuk mengambil data relasi 'category', dan 'type'
            $query->with('category', 'type');
        }])
            ->where('id', auth()->user()->id)
            ->get();
        // dd($user->toArray());
        return view('profile.index', compact('user'));
    }

    public function tersimpan(): View
    {
        // $user = User::with(['saveds' => function ($query) {
        //     $query->with(['post' => function ($query) {
        //         // $query->with(['user' => function($query){
        //         //     $query->withCount('following', 'followers');
        //         // }]);
        //         $query->with('user','type', 'category');
        //     }]);
        // }])
        // ->where('id', auth()->user()->id)
        // ->get();

        // $profileUser = User::where('id', auth()->user()->id)
        //     ->withCount('followers', 'following','posts')
        //     ->get();
        // $user = auth()->user()->withCount('');
        // $user = $request->user()
        //     ->withCount('followers', 'following', 'posts')
        //     ->get();

        $saveds = Saved::where('user_id', auth()->user()->id)
            ->with('user', 'post', 'post.type', 'post.category', 'post.user')
            ->get();

        // dd($profileUsers);
        // dd($saveds->toArray());
        return view('profile.tersimpan', compact('saveds'));
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
