# BaitapFinalchuong3
Course Management System (CMS) - Laravel Project
Dự án Xây dựng hệ thống quản lý khóa học trực tuyến sử dụng Laravel Framework. Hệ thống cho phép quản lý nội dung khóa học, bài học và theo dõi học viên đăng ký với giao diện Dashboard trực quan.

🚀 Chức năng chính
1. Quản lý Khóa học (Courses)
CRUD đầy đủ: Thêm, sửa, xóa và xem danh sách khóa học.

Tự động sinh Slug: Slug thân thiện với SEO dựa trên tên khóa học.

Upload hình ảnh: Xử lý lưu trữ ảnh bìa khóa học vào storage.

Soft Deletes: Chức năng xóa mềm và khôi phục (Restore) từ thùng rác.

Phân trang: Sử dụng paginate(10) để tối ưu hiển thị.

2. Quản lý Bài học (Lessons) & Học viên
Quan hệ 1-N: Một khóa học chứa nhiều bài học, quản lý theo thứ tự (order).

Đăng ký học viên: Lưu trữ thông tin học viên và kết nối với khóa học qua bảng trung gian enrollments.

3. Dashboard Thống kê
Tổng hợp các chỉ số: Tổng khóa học, Tổng học viên, Tổng doanh thu.

Hiển thị Khóa học Hot nhất (có số lượng học viên đông nhất).

Danh sách các khóa học mới cập nhật dưới dạng Card UI chuyên nghiệp.

🛠 Công nghệ sử dụng
Backend: Laravel 12.x, PHP 8.2

Database: MySQL

Frontend: Blade Template, Bootstrap 5, FontAwesome (Icons)

Kiến thức áp dụng: * Eloquent ORM (Relationships: hasMany, belongsTo, withCount)

Optimization: Giải quyết vấn đề N+1 Query bằng Eager Loading (with).

Validation: Sử dụng Form Request để kiểm soát dữ liệu đầu vào.
