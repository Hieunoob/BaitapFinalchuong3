@extends('layouts.master')

@section('content')
<div class="container">
    <h3>Sửa bài học: {{ $lesson->title }}</h3>
    
    <form action="{{ route('lessons.update', $lesson->id) }}" method="POST">
        @csrf
        @method('PUT') <div class="mb-3">
            <label class="form-label">Khóa học</label>
            <select name="course_id" class="form-select">
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ $lesson->course_id == $course->id ? 'selected' : '' }}>
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tiêu đề bài học</label>
            <input type="text" name="title" class="form-control" value="{{ $lesson->title }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Thứ tự (Order)</label>
            <input type="number" name="order" class="form-control" value="{{ $lesson->order }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Video URL</label>
            <input type="url" name="video_url" class="form-control" value="{{ $lesson->video_url }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Nội dung</label>
            <textarea name="content" class="form-control" rows="5">{{ $lesson->content }}</textarea>
        </div>

        <button type="submit" class="btn btn-warning">Cập nhật thay đổi</button>
        <a href="{{ route('lessons.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection