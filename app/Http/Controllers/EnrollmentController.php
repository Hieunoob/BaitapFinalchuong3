<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnrollmentController extends Controller
{
    /**
     * Hiển thị danh sách học viên đăng ký theo từng khóa (Yêu cầu 2.4)
     */
    public function index()
    {
        // 3.4: Tối ưu truy vấn N+1 bằng Eager Loading (with)
        $enrollments = Enrollment::with(['course', 'student'])
            ->latest()
            ->paginate(15);

        // Lấy tổng số học viên (Yêu cầu 2.4)
        $totalStudents = Student::count();

        return view('enrollments.index', compact('enrollments', 'totalStudents'));
    }

    /**
     * Hiển thị form đăng ký khóa học
     */
    public function create()
    {
        $courses = Course::published()->get(); // Sử dụng scopePublished từ bài trước
        return view('enrollments.create', compact('courses'));
    }

    /**
     * Xử lý đăng ký khóa học (Yêu cầu 2.4)
     */
    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'student_name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        // Sử dụng Transaction để đảm bảo an toàn dữ liệu khi lưu vào 2 bảng
        DB::beginTransaction();
        try {
            // 1. Kiểm tra học viên đã tồn tại chưa, nếu chưa thì tạo mới
            $student = Student::firstOrCreate(
                ['email' => $request->email],
                ['name' => $request->student_name]
            );

            // 2. Tạo bản ghi đăng ký (Enrollment)
            Enrollment::create([
                'course_id' => $request->course_id,
                'student_id' => $student->id,
                'enrolled_at' => now(),
            ]);

            DB::commit();
            return redirect()->route('enrollments.index')->with('success', 'Đăng ký khóa học thành công!');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}