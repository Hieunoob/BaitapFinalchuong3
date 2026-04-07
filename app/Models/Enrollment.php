<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    // Khai báo các cột có thể chèn dữ liệu (Mass Assignment)
    protected $fillable = [
        'course_id',
        'student_id',
        'enrolled_at'
    ];
    protected $casts = [
        'enrolled_at' => 'datetime',
    ];
    /**
     * 2.2: Quan hệ BelongsTo - Mỗi dòng đăng ký thuộc về một Khóa học
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * 2.2: Quan hệ BelongsTo - Mỗi dòng đăng ký thuộc về một Học viên
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}