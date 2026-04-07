@extends('layouts.master')

@section('content')
    <h2>Sửa khóa học: {{ $course->name }}</h2>
    <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <input type="text" name="name" value="{{ $course->name }}" class="form-control">
        <input type="text" name="slug" value="{{ $course->slug }}" class="form-control">
        <input type="number" name="price" value="{{ $course->price }}" class="form-control">
        
        <p>Ảnh hiện tại:</p>
        <img src="{{ asset('storage/' . $course->image) }}" width="100">
        <input type="file" name="image" class="form-control mt-2">

        <button type="submit" class="btn btn-primary mt-3">Cập nhật</button>
    </form>
@endsection