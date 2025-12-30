<?php

namespace App\Http\Controllers;

use App\Models\RentPost;
use Illuminate\Http\Request;

class AdminRentPostController extends Controller
{
    public function index()
    {
        $rentPosts = RentPost::where('status', 'pending')->paginate(10);
        return view('admin.rent-posts.index', compact('rentPosts'));
    }

    public function approve($id)
    {
        $rentPost = RentPost::findOrFail($id);
        $rentPost->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Duyệt tin thành công');
    }
}
