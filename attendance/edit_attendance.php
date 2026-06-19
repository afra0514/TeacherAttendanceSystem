<?php 
// 1. Include necessary files for database and layout
include '../config/db.php'; 
include '../includes/header.php'; 

// 2. Add SweetAlert2 library for nice pop-up messages
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

// 3. Check if an ID is provided in the URL
if(isset($_GET['id'])) {
    // Clean the ID to prevent security issues (SQL Injection)
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Get attendance data and join with instructors table to get the name
    $res = mysqli_query($conn, "SELECT a.*, i.name FROM attendance a JOIN instructors i ON a.instructor_id = i.id WHERE a.id=$id");
    $data = mysqli_fetch_assoc($res);
    
    // If no record is found with that ID, go back to the view page
    if(!$data) { 
        header("Location: view_attendance.php"); 
        exit; 
    }
}

// 4. Check if the user clicked the "Update" button
if(isset($_POST['update_attendance'])) {
    $status = $_POST['status'];
    $date = $_POST['attendance_date'];

    // Update the record in the database
    $sql = "UPDATE attendance SET status='$status', attendance_date='$date' WHERE id=$id";
    
    if(mysqli_query($conn, $sql)) {
        // Show success popup if update worked
        echo "
        <script>
            Swal.fire({
                title: 'Record Updated!',
                text: 'Attendance status has been changed successfully.',
                icon: 'success',
                confirmButtonColor: '#4318ff',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send user back to the list page
                    window.location.href = 'view_attendance.php';
                }
            });
        </script>";
    } else {
        // Show error popup if update failed
        echo "
        <script>
            Swal.fire({
                title: 'Error!',
                text: 'Could not update the record. Please try again.',
                icon: 'error',
                confirmButtonColor: '#ee5d50'
            });
        </script>";
    }
}
?>

<!-- Header Section: Shows the Title and the person's name -->
<div class="dashboard-header" style="text-align: center; margin-top: 30px; margin-bottom: 30px;"> 
    <h1 style="color: var(--text-main); font-weight: 700;">Edit Attendance Status</h1>
    <p style="color: var(--text-grey); font-size: 14px;">Updating record for: <strong><?php echo $data['name']; ?></strong></p>
</div>

<!-- Form Section: Where the user changes the data -->
<div class="form-container" style="margin: 0 auto; max-width: 500px; background: #fff; padding: 35px; border-radius: 20px; box-shadow: var(--shadow);">
    <form action="" method="POST">
        
        <!-- Date Input Field -->
        <div class="form-group" style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-main);">Attendance Date</label>
            <input type="date" name="attendance_date" value="<?php echo $data['attendance_date']; ?>" required style="width: 100%; padding: 12px; border: 1px solid #e0e5f2; border-radius: 12px; outline: none;">
        </div>

        <!-- Status Dropdown Field -->
        <div class="form-group" style="margin-bottom: 30px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-main);">Attendance Status</label>
            <select name="status" required style="width: 100%; padding: 12px; border: 1px solid #e0e5f2; border-radius: 12px; outline: none; background: #fff; cursor: pointer;">
                <!-- Check which option was previously saved and select it -->
                <option value="Present" <?php if($data['status'] == 'Present') echo 'selected'; ?>>Present</option>
                <option value="Absent" <?php if($data['status'] == 'Absent') echo 'selected'; ?>>Absent</option>
            </select>
        </div>

        <!-- Submit Button -->
        <div style="text-align: center;">
            <button type="submit" name="update_attendance" class="btn-submit-modern">
                <i class="fas fa-sync-alt"></i> Update Attendance
            </button>
        </div>
    </form>
</div>

<!-- Footer Navigation: Link to go back to dashboard -->
<div style="text-align: center; margin-top: 40px; margin-bottom: 20px;">
    <a href="../dashboard.php" class="btn-home">
        <i class="fas fa-arrow-left"></i> Back to Dashboard
    </a>
</div>

<?php 
// Include the footer file
include '../includes/footer.php'; 
?>