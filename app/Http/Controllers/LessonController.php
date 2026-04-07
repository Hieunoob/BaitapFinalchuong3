<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Hiển thị danh sách bài học theo từng khóa học (Yêu cầu 2.3)
     */
    public function index(Request $request)
{
    // 1. Lấy ID khóa học từ thanh địa chỉ (nếu có bấm Lọc)
    $courseId = $request->input('course_id');

    // 2. Query danh sách bài học, kèm theo thông tin khóa học (Eager Loading)
    $query = \App\Models\Lesson::with('course');

    // 3. Nếu có chọn khóa học cụ thể, thì lọc theo khóa đó
    if ($courseId) {
        $query->where('course_id', $courseId);
    }

    $lessons = $query->paginate(10);
    
    // 4. Lấy tất cả khóa học để đổ vào ô Select (Bộ lọc)
    $courses = \App\Models\Course::all();

    // 5. Truyền $lessons và $courses sang View
    return view('lessons.index', compact('lessons', 'courses'));
}
    public function create()
    {
        $courses = Course::all();
        return view('lessons.create', compact('courses'));
    }

    /**
     * Lưu bài học mới (Yêu cầu 2.3)
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title'     => 'required|string|max:255',
            'content'   => 'required',
            'video_url' => 'nullable|url',
            'order'     => 'required|integer|min:0',
        ]);

        Lesson::create($request->all());

        return redirect()->route('lessons.index', ['course_id' => $request->course_id])
                         ->with('success', 'Thêm bài học thành công!');
    }

    /**
     * Xóa bài học (Yêu cầu 2.3)
     */
    public function destroy($id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->delete();

        return back()->with('success', 'Đã xóa bài học thành công!');
    }
    // 1. Hàm hiển thị form sửa (GET: lessons/1/edit)
public function edit($id)
{
    $lesson = \App\Models\Lesson::findOrFail($id);
    $courses = \App\Models\Course::all(); // Lấy danh sách khóa học để đổi khóa nếu muốn
    
    return view('lessons.edit', compact('lesson', 'courses'));
}

// 2. Hàm lưu dữ liệu sau khi sửa (PUT: lessons/1)
public function update(Request $request, $id)
{
    $lesson = \App\Models\Lesson::findOrFail($id);

    $request->validate([
        'course_id' => 'required|exists:courses,id',
        'title'     => 'required|string|max:255',
        'order'     => 'nullable|integer|min:1',
        'video_url' => 'nullable|url',
        'content'   => 'required',
    ]);

    $lesson->update($request->all());

    return redirect()->route('lessons.index')->with('success', 'Cập nhật bài học thành công!');
}
}