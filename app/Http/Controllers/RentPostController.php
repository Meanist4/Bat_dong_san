<?php

namespace App\Http\Controllers;

use App\Models\RentPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;



class RentPostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    // Hiển thị danh sách tin của user
    public function index()
    {
        $rentPosts = RentPost::where('user_id', Auth::id())->paginate(10);
        return view('rent-posts.index', compact('rentPosts'));
    }

    // Show form tạo tin
    public function create()
    {
        return view('rent-posts.create');
    }

    // Lưu tin mới
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'address' => 'required|string|max:255',
            'description' => 'required|string|min:10',
        ], [
            'title.required' => 'Tiêu đề không được để trống',
            'price' => 'required|numeric|min:0|max:9223372036854775807',
            'address.required' => 'Địa chỉ không được để trống',
            'description.required' => 'Mô tả không được để trống',
            'description.min' => 'Mô tả phải có ít nhất 10 ký tự',
        ]);

        RentPost::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'price' => $validated['price'],
            'address' => $validated['address'],
            'description' => $validated['description'],
            'status' => 'pending',
        ]);

        return redirect()->route('rent-posts.index')->with('success', 'Tạo tin thành công, chờ admin duyệt');
    }


    // Show chi tiết tin
    public function show($id)
    {
        $rentPost = RentPost::findOrFail($id);
        return view('rent-posts.show', compact('rentPost'));
    }

    // Show form edit
    public function edit($id)
    {
        $rentPost = RentPost::findOrFail($id);

        // Kiểm tra chỉ user tạo mới được edit
        if ($rentPost->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền sửa tin này');
        }

        return view('rent-posts.edit', compact('rentPost'));
    }

    // Cập nhật tin
    public function update(Request $request, $id)
    {
        $rentPost = RentPost::findOrFail($id);

        // Kiểm tra authorization
        if ($rentPost->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền sửa tin này');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'address' => 'required|string|max:255',
            'description' => 'required|string|min:10',
        ], [
            'title.required' => 'Tiêu đề không được để trống',
            'price.required' => 'Giá không được để trống',
            'address.required' => 'Địa chỉ không được để trống',
            'description.required' => 'Mô tả không được để trống',
            'description.min' => 'Mô tả phải có ít nhất 10 ký tự',
        ]);

        $rentPost->update($validated);

        return redirect()->route('rent-posts.index')->with('success', 'Cập nhật tin thành công');
    }



    // Xóa tin
    public function destroy($id)
    {
        $rentPost = RentPost::findOrFail($id);

        // Kiểm tra authorization
        if ($rentPost->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền xóa tin này');
        }

        $rentPost->delete();

        return redirect()->route('rent-posts.index')->with('success', 'Xóa tin thành công');
    }
}