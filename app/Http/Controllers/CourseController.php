<?php
namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Http\Requests\CourseRequest; // Yêu cầu 3.6

class CourseController extends Controller {
    
    public function index(Request $request) {
        // 3.1 & 3.4: Tìm kiếm + Eager Loading tránh N+1
        $courses = Course::with(['lessons'])
            ->withCount('students') // Đếm số học viên (count relationship)
            ->when($request->search, function($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%");
            })
            ->latest()
            ->paginate(10);

        return view('courses.index', compact('courses'));
    }

    // 2.7: Dashboard Thống kê
    // 2.7: Dashboard Thống kê
public function dashboard() {
    $totalCourses = Course::count();
    $totalStudents = Student::count();
    
    // Tính tổng doanh thu bằng cách join
    $totalRevenue = Course::join('enrollments', 'courses.id', '=', 'enrollments.course_id')
                          ->sum('courses.price');
    
    // Tìm khóa học hot nhất (nhiều học viên nhất)
    $hotCourse = Course::withCount('students')
                       ->orderBy('students_count', 'desc')
                       ->first();

    // --- PHẦN THÊM MỚI ĐỂ HIỆN CARD ---
    // Lấy tất cả khóa học để hiển thị danh sách Card bên dưới thống kê
    $courses = Course::latest()->get(); 

    // Truyền thêm biến 'courses' vào view
    return view('dashboard', compact('totalCourses', 'totalStudents', 'totalRevenue', 'hotCourse', 'courses'));
}
    public function create()
{
    return view('courses.create'); // Trỏ đến file resources/views/courses/create.blade.php
}

public function store(Request $request)
{
    // 1. Validation: Thêm kiểm tra file ảnh (Yêu cầu 3.3)
    $request->validate([
        'name'        => 'required|string|max:255',
        'slug'        => 'required|unique:courses,slug', // Nên có slug duy nhất
        'price'       => 'required|numeric|min:1',
        'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        'status'      => 'required|in:draft,published',
    ]);

    // 2. Lấy toàn bộ dữ liệu từ form
    $data = $request->all();

    // 3. Xử lý Upload ảnh (Quan trọng nhất)
    if ($request->hasFile('image')) {
        // Lưu ảnh vào thư mục: storage/app/public/courses
        // Hàm store() này sẽ trả về đường dẫn file, ví dụ: "courses/abc.jpg"
        $path = $request->file('image')->store('courses', 'public');
        
        // Gán đường dẫn này vào mảng data để lưu vào DB
        $data['image'] = $path;
    }

    // 4. Lưu vào Database
    Course::create($data);

    return redirect()->route('courses.index')->with('success', 'Thêm khóa học thành công!');
}
public function edit($id)
{
    $course = Course::findOrFail($id);
    return view('courses.edit', compact('course'));
}

public function update(Request $request, $id)
{
    $course = Course::findOrFail($id);

    $request->validate([
        'name' => 'required',
        'slug' => 'required|unique:courses,slug,' . $id, // Cho phép trùng với chính nó
        'price' => 'required|numeric|min:1',
    ]);

    $data = $request->all();

    // Xử lý ảnh mới nếu có upload
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('courses', 'public');
        $data['image'] = $path;
    }

    $course->update($data);

    return redirect()->route('courses.index')->with('success', 'Cập nhật thành công!');
}
// Xóa mềm (Đưa vào thùng rác)
public function destroy($id)
{
    $course = Course::findOrFail($id);
    $course->delete(); // Vì Model đã có SoftDeletes nên nó sẽ tự điền deleted_at

    return redirect()->route('courses.index')->with('success', 'Đã chuyển khóa học vào thùng rác!');
}

// Xem danh sách các khóa học đã xóa (Thùng rác)
public function trashed()
{
    $courses = Course::onlyTrashed()->get();
    return view('courses.trashed', compact('courses'));
}

// Khôi phục khóa học
public function restore($id)
{
    $course = Course::withTrashed()->findOrFail($id);
    $course->restore();

    return redirect()->route('courses.index')->with('success', 'Khôi phục khóa học thành công!');
}

}