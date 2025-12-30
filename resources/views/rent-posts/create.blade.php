@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 pt-4 pb-0 text-center">
                    <h1 class="h3 font-weight-bold text-primary">Tạo tin cho thuê mới</h1>
                    <p class="text-muted">Điền đầy đủ thông tin bên dưới để đăng tin của bạn</p>
                </div>

                <div class="card-body p-4 p-md-5">
                    @if ($errors->any())
                    <div class="alert alert-danger border-0 rounded-3 shadow-sm mb-4">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('rent-posts.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="title" class="form-label fw-bold">Tiêu đề tin đăng</label>
                            <input type="text" name="title" id="title"
                                class="form-control form-control-lg border-2 rounded-3 @error('title') is-invalid @enderror"
                                placeholder="Ví dụ: Căn hộ cao cấp 2PN trung tâm Quận 1" value="{{ old('title') }}"
                                required>
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="price" class="form-label fw-bold">Giá cho thuê (VNĐ/tháng)</label>
                                <div class="input-group">
                                    <input type="number" name="price" id="price"
                                        class="form-control border-2 rounded-start-3 @error('price') is-invalid @enderror"
                                        placeholder="5000000" value="{{ old('price') }}" min="0" required>
                                    <span class="input-group-text bg-light border-2">đ</span>
                                </div>
                                @error('price')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="address" class="form-label fw-bold">Địa chỉ</label>
                                <input type="text" name="address" id="address"
                                    class="form-control border-2 rounded-3 @error('address') is-invalid @enderror"
                                    placeholder="Quận, Huyện, Thành phố..." value="{{ old('address') }}" required>
                                @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">Mô tả chi tiết</label>
                            <textarea name="description" id="description"
                                class="form-control border-2 rounded-3 @error('description') is-invalid @enderror"
                                rows="6" placeholder="Mô tả về tiện nghi, diện tích, đối tượng cho thuê..."
                                required>{{ old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5">
                            <a href="{{ route('rent-posts.index') }}" class="btn btn-light btn-lg px-4 border">Hủy
                                bỏ</a>
                            <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm">
                                <i class="bi bi-send-fill me-2"></i> Đăng tin ngay
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Một chút CSS để làm đẹp thêm */
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
    }

    .card {
        transition: transform 0.3s ease;
    }

    label {
        color: #495057;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>
@endsection