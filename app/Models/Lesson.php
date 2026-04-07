<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    // Các cột có thể chèn dữ liệu (Mass Assignment)
    protected $fillable = [
        'course_id',
        'title',
        'content',
        'video_url',
        'order'
    ];

    /**
     * 2.2: Quan hệ BelongsTo
     * Mỗi bài học phải thuộc về một Khóa học cụ thể.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * 2.3: Scope sắp xếp theo thứ tự (order)
     * Giúp bạn luôn lấy bài học theo đúng số thứ tự đã định.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
}