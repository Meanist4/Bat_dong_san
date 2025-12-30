@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Tin của tôi</h1>
        <a href="{{ route('rent-posts.create') }}" class="btn btn-primary">+ Tạo tin mới</a>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if ($rentPosts->isEmpty())
    <div class="alert alert-info">Bạn chưa tạo tin nào. <a href="{{ route('rent-posts.create') }}">Tạo tin ngay</a>
    </div>
    @else
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>Tiêu đề</th>
                <th>Giá</th>
                <th>Địa chỉ</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rentPosts as $post)
            <tr>
                <td>
                    <a href="{{ route('rent-posts.show', $post->id) }}">{{ $post->title }}</a>
                </td>
                <td>{{ number_format($post->price, 0, ',', '.') }} VNĐ</td>
                <td>{{ $post->address }}</td>
                <td>
                    @if ($post->status === 'pending')
                    <span class="badge bg-warning">Chờ duyệt</span>
                    @elseif ($post->status === 'approved')
                    <span class="badge bg-success">Đã duyệt</span>
                    @else
                    <span class="badge bg-danger">{{ $post->status }}</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('rent-posts.edit', $post->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                    <form action="{{ route('rent-posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Bạn chắc chứ?')">Xóa</button>
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