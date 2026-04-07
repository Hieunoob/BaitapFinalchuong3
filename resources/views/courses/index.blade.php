@extends('layouts.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Danh sách khóa học</h2>
        <div>
            <a href="{{ route('courses.create') }}" class="btn btn-primary">➕ Thêm khóa học</a>
            <a href="{{ route('courses.trashed') }}" class="btn btn-secondary">🗑️ Thùng rác</a>
        </div>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table border table-hover">
        <thead>
            <tr>
                <th>Ảnh</th>
                <th>Tên khóa học</th>
                <th>Giá</th>
                <th>Số bài học</th>
                <th>Trạng thái</th>
                <th>Thao tác</th> </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td><img src="{{ asset('storage/'.$course->image) }}" width="50" class="img-thumbnail"></td>
                <td>{{ $course->name }}</td>
                <td>{{ number_format($course->price) }} VNĐ</td>
                <td>{{ $course->lessons->count() }}</td>
                <td>
                    <span class="badge {{ $course->status == 'published' ? 'bg-success' : 'bg-warning' }}">
                        {{ ucfirst($course->status) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-sm btn-warning">Sửa</a>

                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa vào thùng rác?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $courses->links() }} 
@endsection