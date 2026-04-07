@extends('layouts.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Thùng rác (Khóa học đã xóa)</h2>
        <a href="{{ route('courses.index') }}" class="btn btn-primary">⬅️ Quay lại danh sách</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table border table-hover">
        <thead>
            <tr>
                <th>Ảnh</th>
                <th>Tên khóa học</th>
                <th>Ngày xóa</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @forelse($courses as $course)
            <tr>
                <td><img src="{{ asset('storage/'.$course->image) }}" width="50" class="img-thumbnail"></td>
                <td>{{ $course->name }}</td>
                <td>{{ $course->deleted_at->format('d/m/Y H:i') }}</td>
                <td>
                    <form action="{{ route('courses.restore', $course->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success">Khôi phục</button>
                    </form>

                    </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Thùng rác trống.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
@endsection