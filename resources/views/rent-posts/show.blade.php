@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>{{ $rentPost->title }}</h1>

            <div class="card mt-4">
                <div class="card-body">
                    <p><strong>Giá:</strong> {{ number_format($rentPost->price, 0, ',', '.') }} VNĐ</p>
                    <p><strong>Địa chỉ:</strong> {{ $rentPost->address }}</p>
                    <p><strong>Trạng thái:</strong>
                        @if ($rentPost->status === 'pending')
                        <span class="badge bg-warning">Chờ duyệt</span>
                        @elseif ($rentPost->status === 'approved')
                        <span class="badge bg-success">Đã duyệt</span>
                        @endif
                    </p>
                    <p><strong>Mô tả:</strong></p>
                    <p>{{ $rentPost->description }}</p>
                </div>
            </div>

            @auth
            @if (Auth::id() === $rentPost->user_id)
            <div class="mt-4">
                <a href="{{ route('rent-posts.edit', $rentPost->id) }}" class="btn btn-warning">Sửa</a>
                <form action="{{ route('rent-posts.destroy', $rentPost->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn chắc chứ?')">Xóa</button>
                </form>
            </div>
            @endif
            @endauth

            <a href="{{ route('rent-posts.index') }}" class="btn btn-secondary mt-4">Quay lại</a>
        </div>
    </div>
</div>
@endsection