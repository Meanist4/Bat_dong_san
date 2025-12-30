<?php

namespace App\Http\Controllers;

use App\Models\RentPost;
use Illuminate\Http\Request;

class PublicRentPostController extends Controller
{
    // Danh sách tin công khai
    public function index(Request $request)
    {
        $query = RentPost::where('status', 'approved');

        // Search by title
        if ($request->has('search') && $request->search) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('address', 'like', '%' . $request->search . '%');
        }

        // Filter by price range
        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        $rentPosts = $query->orderBy('created_at', 'desc')->paginate(12);

        return view('public.index', compact('rentPosts'));
    }

    // Chi tiết tin công khai
    public function show($id)
    {
        $rentPost = RentPost::where('status', 'approved')->findOrFail($id);
        return view('public.show', compact('rentPost'));
    }
}
