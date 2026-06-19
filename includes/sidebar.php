<?php
// Get the name of the current file (for example: 'dashboard.php')
// This is used to highlight the link for the page you are currently on
$current_page = basename($_SERVER['PHP_SELF']);
?>

<div class="sidebar">
    <div class="sidebar-header">
        <!-- The title/logo of your system -->
        <div class="sidebar-logo">
            <h2>Attendance Management</h2>
        </div>
        
        <!-- Toggle Button: Used to shrink or hide the sidebar when clicked -->
        <button id="sidebarToggle" class="sidebar-toggle-btn">
            <i class="fas fa-chevron-left" id="toggleIcon"></i>
        </button>
    </div>

    <ul class="sidebar-menu">
        <!-- Dashboard Link -->
        <li>
            <a href="/TeacherAttendanceSystem/dashboard.php" class="<?= ($current_page == 'dashboard.php') ? 'active' : ''; ?>">
                <i class="fas fa-th-large"></i> <span>Dashboard</span>
            </a>
        </li>

        <!-- Instructors Link: This stays "active" if you are viewing, adding, or editing instructors -->
        <li>
            <a href="/TeacherAttendanceSystem/instructors/view_instructor.php" class="<?= ($current_page == 'view_instructor.php' || $current_page == 'add_instructor.php' || $current_page == 'edit_instructor.php') ? 'active' : ''; ?>">
                <i class="fas fa-user-tie"></i> <span>Instructors</span>
            </a>
        </li>

        <!-- Mark Attendance Link -->
        <li>
            <a href="/TeacherAttendanceSystem/attendance/mark_attendance.php" class="<?= ($current_page == 'mark_attendance.php') ? 'active' : ''; ?>">
                <i class="fas fa-calendar-check"></i> <span>Mark Attendance</span>
            </a>
        </li>

        <!-- History Link -->
        <li>
            <a href="/TeacherAttendanceSystem/attendance/view_attendance.php" class="<?= ($current_page == 'view_attendance.php') ? 'active' : ''; ?>">
                <i class="fas fa-history"></i> <span>History</span>
            </a>
        </li>

        <!-- Reports Link -->
        <li>
            <a href="/TeacherAttendanceSystem/reports/attendance_report.php" class="<?= ($current_page == 'attendance_report.php') ? 'active' : ''; ?>">
                <i class="fas fa-chart-bar"></i> <span>Reports</span>
            </a>
        </li>
    </ul>
</div>