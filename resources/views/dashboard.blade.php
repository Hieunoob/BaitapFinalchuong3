@extends('layouts.master')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 fw-bold">Dashboard Thống kê</h1>
    
    <div class="row g-3 mb-5">
        <div class="col-md-4">
            <div class="card bg-primary text-white shadow-sm border-0 p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1">Tổng khóa học</p>
                        <h3 class="mb-0 fw-bold">{{ $totalCourses }}</h3>
                    </div>
                    <i class="fas fa-book-open fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white shadow-sm border-0 p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1">Tổng học viên</p>
                        <h3 class="mb-0 fw-bold">{{ $totalStudents }}</h3>
                    </div>
                    <i class="fas fa-users fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-info text-white shadow-sm border-0 p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1">Tổng doanh thu</p>
                        <h3 class="mb-0 fw-bold">{{ number_format($totalRevenue) }} đ</h3>
                    </div>
                    <i class="fas fa-money-bill-wave fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <h2 class="h4 mb-4 fw-bold">Danh sách khóa học</h2>
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
        @foreach($courses as $course)
        <div class="col">
            <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden">
                <img src="{{ $course->image ? asset('storage/' . $course->image) : 'https://via.placeholder.com/300x180' }}" 
                     class="card-img-top" alt="{{ $course->name }}" style="height: 180px; object-fit: cover;">
                
                <div class="card-body">
                    <h5 class="card-title fw-bold text-uppercase mb-1" style="font-size: 1rem;">
                        {{ $course->name }}
                    </h5>
                    <p class="card-text text-muted mb-2">
                        {{ number_format($course->price) }} đ
                    </p>
                    
                    @if($course->status == 'published')
                        <span class="badge rounded-pill bg-success px-3">published</span>
                    @else
                        <span class="badge rounded-pill bg-secondary px-3">draft</span>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection