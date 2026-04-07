@extends('layouts.master')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Danh sách học viên đăng ký</h3>
        <div class="alert alert-info py-1 px-3 mb-0">
            <strong>Tổng số học viên:</strong> {{ $totalStudents }}
        </div>
        <a href="{{ route('enrollments.create') }}" class="btn btn-primary">Đăng ký mới</a>
    </div>

    <table class="table table-bordered table-hover shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>STT</th>
                <th>Tên học viên</th>
                <th>Email</th>
                <th>Khóa học đăng ký</th>
                <th>Ngày đăng ký</th>
            </tr>
        </thead>
        <tbody>
            @forelse($enrollments as $key => $enrollment)
            <tr>
                <td>{{ $enrollments->firstItem() + $key }}</td>
                <td>{{ $enrollment->student->name }}</td>
                <td>{{ $enrollment->student->email }}</td>
                <td>
                    <span class="badge bg-secondary">{{ $enrollment->course->name }}</span>
                </td>
                <td>{{ $enrollment->enrolled_at->format('d/m/Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Chưa có dữ liệu đăng ký.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $enrollments->links() }}
    </div>
</div>
@endsection