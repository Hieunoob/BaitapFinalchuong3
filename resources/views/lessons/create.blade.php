@extends('layouts.master')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Thêm bài học mới</h3>
        <a href="{{ route('lessons.index') }}" class="btn btn-secondary btn-sm">Quay lại</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card p-4">
        <form action="{{ route('lessons.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Chọn khóa học <span class="text-danger">*</span></label>
                <select name="course_id" class="form-select" required>
                    <option value="">-- Chọn khóa học --</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                            {{ $course->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Tiêu đề bài học <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required placeholder="Ví dụ: Giới thiệu về PHP">
            </div>

            <div class="mb-3">
                <label class="form-label">Thứ tự hiển thị (Order)</label>
                <input type="number" name="order" class="form-control" value="{{ old('order', 1) }}" min="1">
            </div>

            <div class="mb-3">
                <label class="form-label">Đường dẫn Video (URL)</label>
                <input type="url" name="video_url" class="form-control" value="{{ old('video_url') }}" placeholder="https://youtube.com/...">
            </div>

            <div class="mb-3">
                <label class="form-label">Nội dung bài học</label>
                <textarea name="content" class="form-control" rows="5">{{ old('content') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Lưu bài học</button>
        </form>
    </div>
</div>
@endsection