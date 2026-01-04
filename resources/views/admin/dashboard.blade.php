@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Quản lý Tin Cho Thuê</h1>

    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if ($rentPosts->isEmpty())
    <div class="alert alert-info">Không có tin nào chờ duyệt.</div>
    @else
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tiêu đề</th>
                <th>Người đăng</th>
                <th>Giá</th>
                <th>Mô tả</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rentPosts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->user->name }}</td>
                <td>{{ number_format($post->price, 0, ',', '.') }} VNĐ</td>
                <td>{{ Str::limit($post->description, 50) }}</td>
                <td>
                    <a href="{{ route('public.rent-posts.show', $post->id) }}" class="btn btn-sm btn-info"
                        target="_blank">Xem</a>
                    <form action="{{ route('admin.rent-posts.approve', $post->id) }}" method="POST"
                        style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">Duyệt</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $rentPosts->links() }}
    @endif
</div>
@endsection