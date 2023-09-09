<?php

namespace App\Http\Controllers;

use App\Models\Commision;
use Illuminate\Http\Request;

class CommisionController extends Controller
{
    //

    public function create()
    {
        return view('commision.create');
    }

    public function store(Request $request , Commision $commision)
    {
        $request->validate([
            'title' => 'required|max:255',
            'status' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);

        $commision = Commision::create([
            'title' => ucfirst($request->title),
            'description' => ucfirst($request->description),
            'user_id' => auth()->user()->id,
            'status' => $request->status,
            'price' => $request->price,
        ]);

        // dd($commision->toArray());
        return redirect()->route('profile.layanan',auth()->user()->name)->with('success', 'Commision created successfully!');
    }

    public function edit(Commision $commision)
    {
        return view('commision.edit', compact('commision'));
    }

    public function update(Request $request, Commision $commision)
    {
        $request->validate([
            'title' => 'required|max:255',
            'status' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);

        $commision->update([
            'title' => ucfirst($request->title),
            'user_id' => auth()->user()->id,
            'status' => $request->status,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->route('profile.layanan',auth()->user()->name)->with('success', 'Commision updated successfully!');
    }

    public function destroy(Commision $commision)
    {
        $commision->delete();
        return redirect()->route('profile.layanan',auth()->user()->name)->with('success', 'Commision deleted successfully!');
    }
}
