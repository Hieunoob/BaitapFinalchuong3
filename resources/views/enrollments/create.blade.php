@extends('layouts.master')

@section('content')
<div class="container" style="max-width: 600px;">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Đăng ký khóa học</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('enrollments.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Chọn khóa học <span class="text-danger">*</span></label>
                    <select name="course_id" class="form-select @error('course_id') is-invalid @enderror" required>
                        <option value="">-- Chọn khóa học muốn học --</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                {{ $course->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('course_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label font-weight-bold">Tên học viên <span class="text-danger">*</span></label>
                    <input type="text" name="student_name" class="form-control @error('student_name') is-invalid @enderror" 
                           value="{{ old('student_name') }}" placeholder="Nhập họ tên đầy đủ" required>
                    @error('student_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label font-weight-bold">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                           value="{{ old('email') }}" placeholder="example@gmail.com" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success">Xác nhận đăng ký</button>
                    <a href="{{ route('enrollments.index') }}" class="btn btn-outline-secondary">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection