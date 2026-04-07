<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // Các cột cho phép nhập liệu (Mass Assignment)
    protected $fillable = [
        'name',
        'email',
    ];

    /**
     * 2.2: Quan hệ Nhiều-Nhiều (Many-to-Many)
     * Một học viên có thể đăng ký nhiều khóa học.
     * Quan hệ này thông qua bảng trung gian 'enrollments'.
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments')
                    ->withTimestamps() // Tự động quản lý created_at/updated_at cho bảng trung gian
                    ->withPivot('enrolled_at'); // Lấy thêm cột phụ từ bảng trung gian nếu cần
    }

    /**
     * 2.2: Quan hệ 1-Nhiều với Enrollment
     * Một học viên có nhiều bản ghi đăng ký.
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}