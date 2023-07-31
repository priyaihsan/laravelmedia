<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Post;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Saved;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function index(): View
    {
        // $user = User::with(['posts' => function ($query) {
        //     // Menggunakan with untuk mengambil data relasi 'category', dan 'type'
        //     $query->with('category', 'type');
        // }])
        //     ->where('id', auth()->user()->id)
        //     ->get();
        $user = User::where('id', auth()->user()->id)
            ->with('posts', 'posts.category', 'posts.type', 'posts.likes', 'posts.user', 'posts.saveds')
            ->withCount('followers', 'followings', 'posts')
            ->get();
        // dd($user->toArray());
        return view('profile.index', compact('user'));
    }

    public function tersimpan(): View
    {

        // $user = User::with(['saveds' => function ($query) {
        //     // Menggunakan with untuk mengambil data relasi 'category', dan 'type'
        //     $query->with('user', 'post', 'post.type', 'post.likes', 'post.category');
        //     $query->with(['post.user' => function ($query) {
        //         // Menggunakan with untuk mengambil data relasi 'category', dan 'type'
        //         $query->withCount('followers', 'following');
        //     }]);
        // }])
        //     ->withCount('followers', 'following', 'posts')
        //     ->where('id', auth()->user()->id)
        //     ->get();

        $user = User::where('id', auth()->user()->id)
            ->withCount('followers', 'followings', 'posts')
            ->get();

        // $user = auth()->user()->loadCount('followers', 'following', 'posts');

        $saveds = Saved::where('user_id', auth()->user()->id)
            ->with('user', 'post', 'post.type', 'post.likes', 'post.category')
            ->with(['post.user' => function ($query) {
                // Menggunakan with untuk mengambil data relasi 'category', dan 'type'
                $query->withCount('followers', 'followings');
            }])
            ->get();

        // dd($user->toArray());
        // dd($saveds->toArray());
        return view('profile.tersimpan', compact('user', 'saveds'));
    }

    public function melihat(User $user)
    {
        $user = User::where('id', $user->id)
            ->with('posts', 'posts.category', 'posts.type', 'posts.likes', 'posts.user', 'posts.saveds')
            ->withCount('followers', 'followings', 'posts')
            ->get();

        // dd($user->toArray());
        return view('profile.melihat', compact('user'));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // return view('profile.edit', [
        //     'user' => $request->user(),
        // ]);
        $user = User::where('id', $request->user()->id)
            ->with('roles')
            ->first();

        $roles = Role::all();

        // dd($user->toArray());
        // dd($roleUser->toArray());
        return view('profile.edit', compact('user', 'roles',));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        // $request->user()->fill($request->validated());

        // if ($request->user()->isDirty('email')) {
        //     $request->user()->email_verified_at = null;
        // }

        // $selectedRoles = $request->input('roles', []);
        // $user->roles()->sync($selectedRoles);


        $user = $request->user();

        // Update user attributes with validated data
        $user->fill($request->validated());

        // Clear email_verified_at if email is changed
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Save the user changes
        $user->save();

        // Update user roles
        $roleIds = $request->input('roles', []);

        // Loop melalui setiap ID peran yang ada dalam koleksi pengguna
        foreach ($user->roles as $role) {
            // Jika peran tidak ada dalam $roleIds, hapus peran tersebut
            if (!in_array($role->id, $roleIds)) {
                $user->roles()->detach($role->id);
            }
        }

        // Loop melalui setiap ID peran dalam $roleIds
        foreach ($roleIds as $roleId) {
            // Cek apakah relasi sudah ada, jika belum tambahkan data baru
            if (!$user->roles->pluck('id')->contains($roleId)) {
                $user->roles()->attach($roleId, ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
            }
        }
        // dd($selectedRoles);
        // dd($request->toArray());
        // $request->user()->save();

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
