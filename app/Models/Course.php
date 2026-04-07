<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // THIẾU DÒNG NÀY
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model {
    use SoftDeletes; // Kích hoạt tính năng xóa mềm
    use HasFactory;

    protected $fillable = ['name', 'slug', 'price', 'description', 'image', 'status'];

    // Quan hệ 1-n: Một khóa học có nhiều bài học
    public function lessons() {
        return $this->hasMany(Lesson::class)->orderBy('order');
    }

    // Quan hệ n-n: Một khóa học có nhiều sinh viên (qua bảng trung gian enrollments)
    public function students() {
        return $this->belongsToMany(Student::class, 'enrollments');
    }

    // Query Scope cho yêu cầu nâng cao
    public function scopePublished($query)
{
    // Cách an toàn nhất: Trả về chính nó để không lọc gì cả, xem có hiện không
    return $query; 
    
    // Hoặc nếu muốn lọc đúng cột 'published' (giả sử giá trị là 1):
    // return $query->where('published', 1);
}
    public function scopeSearch($query, $keyword) {
        if ($keyword) {
            return $query->where('name', 'like', "%$keyword%");
        }
    }

    public function scopePriceBetween($query, $min, $max) {
        return $query->whereBetween('price', [$min, $max]);
    }
}