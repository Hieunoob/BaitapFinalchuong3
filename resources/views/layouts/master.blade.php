<!DOCTYPE html>
<html>
<head>
    <title>Course Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 sidebar bg-light">
                <ul class="nav flex-column">
                     <li class="nav-item">
                         <a class="nav-link" href="{{ route('dashboard') }}">🏠 Dashboard</a>
                     </li>

                      <li class="nav-item">
                           <a class="nav-link" href="{{ route('courses.index') }}">📚 Courses</a>
                     </li>

                     <li class="nav-item">
                          <a class="nav-link" href="{{ route('lessons.index') }}">📖 Lessons</a>
                     </li>

                     <li class="nav-item">
                          <a class="nav-link" href="{{ route('enrollments.index') }}">👤 Enrollments</a>
                     </li>
                 </ul>
            </nav>
            <main class="col-md-10">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>