@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mt-4">
                <div class="card-header bg-primary text-white">
                    <h4>Thêm khóa học mới</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                      <div class="alert alert-danger">
                         <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                        </ul>
                      </div>
                    @endif
                    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Tên khóa học</label>
                            <input type="text" name="name" class="form-control" required placeholder="Nhập tên khóa học">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Đường dẫn (Slug)</label>
                            <input type="text" name="slug" class="form-control" required placeholder="vi-du-khoa-hoc-laravel">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Giá (VNĐ)</label>
                            <input type="number" name="price" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mô tả</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ảnh khóa học</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Trạng thái</label>
                            <select name="status" class="form-control">
                                <option value="draft">Bản nháp (Draft)</option>
                                <option value="published">Công khai (Published)</option>
                            </select>
                        </div>

                        <div class="text-end">
                            <a href="{{ route('courses.index') }}" class="btn btn-secondary">Hủy</a>
                            <button type="submit" class="btn btn-success">Lưu khóa học</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection