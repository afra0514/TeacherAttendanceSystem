<?php 
// 1. Include files for database connection and page header
include '../config/db.php'; 
include '../includes/header.php'; 

// 2. Add SweetAlert2 library for pop-up messages
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

// 3. Process the form when the "Submit Attendance" button is clicked
if(isset($_POST['save_attendance'])) {
    $date = $_POST['attendance_date'];
    $attendance_data = $_POST['status']; // This is an array of statuses (Present/Absent)

    // Loop through each instructor's attendance status
    foreach($attendance_data as $instructor_id => $status) {
        /* 
           This query does two things:
           - If it's a new entry, it INSERTS it.
           - If attendance for this person on this date already exists, it UPDATES the status.
        */
        $query = "INSERT INTO attendance (instructor_id, attendance_date, status) 
                  VALUES ('$instructor_id', '$date', '$status') 
                  ON DUPLICATE KEY UPDATE status = '$status'";
        
        mysqli_query($conn, $query);
    }
    
    // Show a success popup after saving everything
    echo "
    <script>
        Swal.fire({
            title: 'Attendance Saved!',
            text: 'Daily attendance has been recorded successfully.',
            icon: 'success',
            confirmButtonColor: '#4318ff',
            confirmButtonText: 'View History'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the attendance list page
                window.location.href = 'view_attendance.php';
            }
        });
    </script>";
}
?>

<!-- Header Section: Page Title and Instructions -->
<div class="dashboard-header" style="text-align: center; margin-top: 20px; margin-bottom: 30px;"> 
    <h1 style="color: var(--text-main); font-weight: 700;">Mark Daily Attendance</h1>
    <p style="color: var(--text-grey); font-size: 14px;">Select date and check status for each instructor</p>
</div>

<div class="table-container" style="max-width: 900px; margin: 0 auto;">
    <form method="POST">
        
        <!-- Date Selection: Defaults to today's date -->
        <div style="display: flex; justify-content: center; margin-bottom: 30px;">
            <div class="form-group" style="width: 300px; text-align: center;">
                <label style="font-weight: 600; color: var(--text-main); display: block; margin-bottom: 8px;">Attendance Date</label>
                <input type="date" name="attendance_date" value="<?php echo date('Y-m-d'); ?>" required style="width: 100%; padding: 12px; border: 1px solid #e0e5f2; border-radius: 12px; outline: none; text-align: center;">
            </div>
        </div>

        <!-- Attendance Table -->
        <table>
            <thead>
                <tr>
                    <th>Instructor Name</th>
                    <th>Designation</th>
                    <th style="text-align: center;">Attendance Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Get all instructors from the database
                $teachers = mysqli_query($conn, "SELECT * FROM instructors ORDER BY name ASC");
                
                while($row = mysqli_fetch_assoc($teachers)) {
                    ?>
                    <tr>
                        <td><strong style="color: var(--text-main);"><?php echo $row['name']; ?></strong></td>
                        <td style="color: var(--text-grey);"><?php echo $row['designation']; ?></td>
                        <td style="text-align: center;">
                            <!-- Radio buttons: "Present" is selected by default -->
                            <label style="margin-right: 20px; cursor:pointer; color: #05cd99; font-weight:700;">
                                <input type="radio" name="status[<?php echo $row['id']; ?>]" value="Present" checked> Present
                            </label>
                            
                            <label style="cursor:pointer; color: #ee5d50; font-weight:700;">
                                <input type="radio" name="status[<?php echo $row['id']; ?>]" value="Absent"> Absent
                            </label>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>

        <!-- Form Submit Button -->
        <div style="text-align: center; margin-top: 40px;">
            <button type="submit" name="save_attendance" class="btn-submit-modern" style="padding: 15px 60px;">
                <i class="fas fa-check-double"></i> Submit Attendance
            </button>
        </div>
    </form>
</div>

<!-- Back Link: Return to dashboard -->
<div style="text-align: center; margin-top: 40px; margin-bottom: 20px;">
    <a href="../dashboard.php" class="btn-home">
        <i class="fas fa-arrow-left"></i> Back to Dashboard
    </a>
</div>

<?php 
// Include the footer file
include '../includes/footer.php'; 
?>