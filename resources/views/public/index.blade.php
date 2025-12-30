@extends('layouts.app')

@section('content')


<div class="container">
    <h1 class="mb-4">Danh Sách Cho Thuê</h1>

    <!-- Search Form -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('home') }}" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Tìm kiếm..."
                        value="{{ request('search') }}">
                </div>

                <div class="col-md-3">
                    <input type="number" name="min_price" class="form-control" placeholder="Giá tối thiểu"
                        value="{{ request('min_price') }}">
                </div>

                <div class="col-md-3">
                    <input type="number" name="max_price" class="form-control" placeholder="Giá tối đa"
                        value="{{ request('max_price') }}">
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Tìm kiếm</button>
                </div>
            </form>
        </div>
    </div>

    @if ($rentPosts->isEmpty())
    <div class="alert alert-info">Không tìm thấy tin nào phù hợp.</div>
    @else
    <div class="row">
        @foreach ($rentPosts as $post)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">
                        <strong>Giá:</strong> {{ number_format($post->price, 0, ',', '.') }} VNĐ<br>
                        <strong>Địa chỉ:</strong> {{ $post->address }}<br>
                        <small class="text-muted">{{ $post->created_at->format('d/m/Y') }}</small>
                    </p>
                    <p class="card-text text-truncate">{{ $post->description }}</p>
                </div>
                <div class="card-footer bg-white">
                    <a href="{{ route('public.rent-posts.show', $post->id) }}" class="btn btn-primary btn-sm w-100">Xem
                        Chi Tiết</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $rentPosts->links() }}
    </div>
    @endif
</div>
@endsection