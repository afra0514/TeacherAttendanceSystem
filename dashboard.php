<?php 
// 1. Connect to the database
include 'config/db.php'; 

// 2. Include the Header (The sidebar is usually inside the header)
include 'includes/header.php'; 

// --- DATA LOGIC: Calculate numbers for the Dashboard ---

// 3. Get total number of teachers
$res_total = mysqli_query($conn, "SELECT COUNT(*) as total FROM instructors");
// Store the count in a variable. If nothing is found, use 0.
$total_teachers = mysqli_fetch_assoc($res_total)['total'] ?? 0;

// 4. Get total number of teachers Present Today
$today = date('Y-m-d'); // Get current date in Year-Month-Day format
$res_present = mysqli_query($conn, "SELECT COUNT(*) as total FROM attendance WHERE attendance_date = '$today' AND status = 'Present'");
$present_today = mysqli_fetch_assoc($res_present)['total'] ?? 0;

// 5. Get total number of teachers Absent Today
$res_absent = mysqli_query($conn, "SELECT COUNT(*) as total FROM attendance WHERE attendance_date = '$today' AND status = 'Absent'");
$absent_today = mysqli_fetch_assoc($res_absent)['total'] ?? 0;
?>

<!-- Main Content Area: Where the charts and stats are displayed -->
<div class="main-content"> 
    
    <!-- Dashboard Heading -->
    <div class="dashboard-header" style="text-align: center; margin-top: 50px; margin-bottom: 30px;">
        <h1 style="color: var(--text-main); font-weight: 700;">Admin Dashboard</h1>
        <p style="color: var(--text-grey);">Overview of the current system status</p>
    </div>

    <!-- Stats Cards Section: Showing the numbers visually -->
    <div class="card-container">
        <!-- Card 1: Total Teachers -->
        <div class="card card-total">
            <h3>Total Instructors</h3>
            <h2><?php echo $total_teachers; ?></h2>
        </div>

        <!-- Card 2: Teachers Present Today -->
        <div class="card card-present">
            <h3>Present Today</h3>
            <h2><?php echo $present_today; ?></h2>
        </div>

        <!-- Card 3: Teachers Absent Today -->
        <div class="card card-absent">
            <h3>Absent Today</h3>
            <h2><?php echo $absent_today; ?></h2>
        </div>
    </div>

    <!-- Quick Action Section: Fast links to important pages -->
    <div class="table-container" style="margin-top: 30px; text-align: center;">
        <h3 style="margin-bottom: 20px; color: var(--text-main);">Quick Management</h3>
        <hr style="border: 0.5px solid #f1f1f1; margin-bottom: 20px;">
        
        <div class="quick-manage-btns">
            <!-- Link to Take Attendance Page -->
            <a href="attendance/mark_attendance.php" class="btn-quick">Take Attendance</a>
            
            <!-- Link to Add New Instructor Page -->
            <a href="instructors/add_instructor.php" class="btn-quick">Add Instructor</a>
            
            <!-- Link to View Statistics/Reports Page -->
            <a href="reports/attendance_report.php" class="btn-quick">View Reports</a>
        </div>
    </div>

    <!-- Home Navigation: Button to return to the landing page -->
    <div style="text-align: center; margin-top: 50px; margin-bottom: 30px;">
        <a href="index.php" class="btn-home">
            <i class="fas fa-home"></i> Back to Home
        </a>
    </div>

</div> <!-- End of main-content -->

<?php 
// 6. Include the Footer to close the HTML tags and load scripts
include 'includes/footer.php'; 
?>