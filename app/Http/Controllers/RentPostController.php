<?php

namespace App\Http\Controllers;

use App\Models\RentPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentPostController extends Controller
{
    public function index()
    {
        return RentPost::where('user_id', Auth::id())->get();
    }

    public function create()
    {
        return view('rent.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'address' => 'required'
        ]);

        $data['user_id'] = Auth::id();

        RentPost::create($data);

        return redirect()->route('rent-posts.index');
    }

    public function show(RentPost $rentPost)
    {
        return $rentPost;
    }

    public function edit(RentPost $rentPost)
    {
        return view('rent.edit', compact('rentPost'));
    }

    public function update(Request $request, RentPost $rentPost)
    {
        $rentPost->update($request->all());
        return redirect()->route('rent-posts.index');
    }

    public function destroy(RentPost $rentPost)
    {
        $rentPost->delete();
        return back();
    }
}
