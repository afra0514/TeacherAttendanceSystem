<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic settings: tells the browser how to read characters and handle mobile screens -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Attendance System</title>
    
    <!-- CSS Links: We use absolute paths so these files load correctly even from subfolders -->
    <link rel="stylesheet" href="/TeacherAttendanceSystem/assets/css/style.css">
    <link rel="stylesheet" href="/TeacherAttendanceSystem/assets/css/dashboard.css">
    <link rel="stylesheet" href="/TeacherAttendanceSystem/assets/css/table.css">
    <link rel="stylesheet" href="/TeacherAttendanceSystem/assets/css/form.css">
    
    <!-- SweetAlert2: This library is required to show the nice popup boxes -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Google Fonts: Makes the text look modern and clean -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome: Used for showing icons (like trash cans, edit pencils, etc.) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<?php 
// 1. Include the Sidebar: This keeps the menu the same on every page
include 'sidebar.php'; 
?>

<!-- Start of the Main Content area: This sits next to the sidebar -->
<div class="main-content">

    <?php 
    // 2. Safely include the Navbar only if the file actually exists on the server
    if(file_exists(__DIR__ . '/navbar.php')) {
        include 'navbar.php'; 
    }
    ?>