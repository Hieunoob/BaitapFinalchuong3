@extends('layouts.master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Quản lý Bài học</h3>
    <a href="{{ route('lessons.create') }}" class="btn btn-primary btn-sm">Thêm bài học mới</a>
</div>

<div class="card mb-3 p-3">
    <form action="{{ route('lessons.index') }}" method="GET" class="row g-3 align-items-center">
        <div class="col-auto">
            <label>Lọc theo khóa học:</label>
        </div>
        <div class="col-auto">
            <select name="course_id" class="form-select form-select-sm">
                <option value="">-- Tất cả khóa học --</option>
                @foreach($courses as $c)
                    <option value="{{ $c->id }}" {{ request('course_id') == $c->id ? 'selected' : '' }}>
                        {{ $c->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-sm btn-secondary">Lọc</button>
            @if(request('course_id'))
                <a href="{{ route('lessons.index') }}" class="btn btn-sm btn-outline-danger">Xóa lọc</a>
            @endif
        </div>
    </form>
</div>

<table class="table table-striped border">
    <thead>
        <tr>
            <th>Tên khóa học</th> <th>Thứ tự</th>
            <th>Tiêu đề</th>
            <th>Video URL</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach($lessons as $lesson)
        <tr>
            <td><strong>{{ $lesson->course->name ?? 'N/A' }}</strong></td>
            <td>{{ $lesson->order }}</td> <td>{{ $lesson->title }}</td>
            <td><a href="{{ $lesson->video_url }}" target="_blank">Xem Video</a></td>
            <td>
                <a href="{{ route('lessons.edit', $lesson->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                <form action="{{ route('lessons.destroy', $lesson->id) }}" method="POST" style="display:inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Xóa bài học này?')">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-3">
    {{ $lessons->appends(request()->all())->links() }}
</div>
@endsection