@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h1>{{ $rentPost->title }}</h1>
                    <hr>
                    <p><strong>Giá:</strong> <span
                            class="text-danger fs-5">{{ number_format($rentPost->price, 0, ',', '.') }} VNĐ</span></p>
                    <p><strong>Địa chỉ:</strong> {{ $rentPost->address }}</p>
                    <p><strong>Ngày đăng:</strong> {{ $rentPost->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Người đăng:</strong> {{ $rentPost->user->name }}</p>
                    <hr>
                    <h4>Mô tả</h4>
                    <p>{!! nl2br($rentPost->description) !!}</p>
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
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Thông tin liên hệ</h5>
                </div>
                <div class="card-body">
                    <p><strong>Người liên hệ:</strong> {{ $rentPost->user->name }}</p>
                    <p><strong>Email:</strong> {{ $rentPost->user->email }}</p>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('home') }}" class="btn btn-secondary mt-4">← Quay lại</a>
</div>
@endsection