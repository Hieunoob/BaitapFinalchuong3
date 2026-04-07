# BaitapFinalchuong3
📚 Course Management System (CMS) - Laravel Project
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
📚 Course Management System (CMS) - Laravel Project
Dự án Xây dựng hệ thống quản lý khóa học trực tuyến. Hệ thống cho phép quản lý nội dung khóa học, bài học và thống kê doanh thu, học viên trên Dashboard.

🛠 Hướng dẫn cài đặt và chạy dự án
Để chạy dự án này trên máy cục bộ (Localhost), Hieu hãy thực hiện theo các bước sau:

1. Chuẩn bị môi trường
PHP: >= 8.2

Composer: Phiên bản mới nhất

Database: MySQL (XAMPP hoặc Laragon)

Server: Apache hoặc Nginx

2. Các bước cài đặt
Bước 1: Clone dự án từ GitHub

Bash
git clone https://github.com/Hieunoob/Baitapthuchanhchuong3_2.git
cd Baitapthuchanhchuong3_2
Bước 2: Cài đặt các thư viện PHP (Vendor)

Bash
composer install
Bước 3: Cấu hình file môi trường (.env)

Tạo file .env từ file mẫu:

Bash
cp .env.example .env
Mở file .env lên và cấu hình thông tin Database:

Đoạn mã
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ten_database
DB_USERNAME=root
DB_PASSWORD=
Bước 4: Tạo App Key

Bash
php artisan key:generate
Bước 5: Chạy Migration để tạo bảng dữ liệu

Bash
php artisan migrate
Bước 6: Tạo liên kết thư mục Storage (Để hiện ảnh khóa học)

Lưu ý: Bước này cực kỳ quan trọng để các ảnh Hieu upload trong Admin hiện ra được ở Dashboard.

Bash
php artisan storage:link
Bước 7: Khởi động Server

Bash
php artisan serve
Sau đó,truy cập: http://127.0.0.1:8000/dashboard

Frontend: Blade Template, Bootstrap 5, FontAwesome (Icons)

Kiến thức áp dụng: * Eloquent ORM (Relationships: hasMany, belongsTo, withCount)

Optimization: Giải quyết vấn đề N+1 Query bằng Eager Loading (with).

Validation: Sử dụng Form Request để kiểm soát dữ liệu đầu vào.
