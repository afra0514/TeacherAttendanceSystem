<?php 
// 1. Include files for database and site design
include '../config/db.php'; 
include '../includes/header.php'; 

// 2. Add SweetAlert2 for nice animated messages
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

// 3. Fetch the current data of the instructor
if(isset($_GET['id'])) {
    // Clean the ID from the URL for security
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Get the specific instructor's information from the database
    $res = mysqli_query($conn, "SELECT * FROM instructors WHERE id=$id");
    $data = mysqli_fetch_assoc($res);
    
    // If the instructor ID doesn't exist, go back to the list page
    if(!$data) { 
        header("Location: view_instructor.php"); 
        exit; 
    }
}

// 4. Process the update when the "Update" button is clicked
if(isset($_POST['update_teacher'])) {
    // Clean the text typed by the user to prevent hacking (SQL Injection)
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);

    // Update the row in the 'instructors' table
    $sql = "UPDATE instructors SET name='$name', email='$email', phone='$phone', designation='$designation' WHERE id=$id";
    
    if(mysqli_query($conn, $sql)) {
        // Show success popup if update worked
        echo "
        <script>
            Swal.fire({
                title: 'Updated!',
                text: 'Instructor details have been updated successfully.',
                icon: 'success',
                confirmButtonColor: '#4318ff',
                confirmButtonText: 'Great'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send the user back to the list page
                    window.location.href = 'view_instructor.php';
                }
            });
        </script>";
    } else {
        // Show error popup if something went wrong
        echo "
        <script>
            Swal.fire({
                title: 'Error!',
                text: 'Update failed. Please try again.',
                icon: 'error',
                confirmButtonColor: '#ee5d50'
            });
        </script>";
    }
}
?>

<!-- Header Section: Page title and ID number -->
<div class="dashboard-header" style="text-align: center; margin-top: 30px; margin-bottom: 30px;"> 
    <h1 style="color: var(--text-main); font-weight: 700;">Update Instructor Details</h1>
    <p style="color: var(--text-grey); font-size: 14px;">Modify the information for ID: #<?php echo $id; ?></p>
</div>

<!-- Form Section: Pre-filled with current instructor information -->
<div class="form-container" style="margin: 0 auto; max-width: 550px; background: #fff; padding: 35px; border-radius: 20px; box-shadow: var(--shadow);">
    <form action="" method="POST">
        
        <!-- Name Input: 'value' shows the current name -->
        <div class="form-group" style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-main);">Full Name</label>
            <input type="text" name="name" value="<?php echo $data['name']; ?>" required style="width: 100%; padding: 12px; border: 1px solid #e0e5f2; border-radius: 12px; outline: none;">
        </div>

        <!-- Email Input -->
        <div class="form-group" style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-main);">Email Address</label>
            <input type="email" name="email" value="<?php echo $data['email']; ?>" required style="width: 100%; padding: 12px; border: 1px solid #e0e5f2; border-radius: 12px; outline: none;">
        </div>

        <!-- Phone Input -->
        <div class="form-group" style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-main);">Phone Number</label>
            <input type="text" name="phone" value="<?php echo $data['phone']; ?>" required style="width: 100%; padding: 12px; border: 1px solid #e0e5f2; border-radius: 12px; outline: none;">
        </div>

        <!-- Designation Selection: PHP checks which one was previously selected -->
        <div class="form-group" style="margin-bottom: 30px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-main);">Designation</label>
            <select name="designation" required style="width: 100%; padding: 12px; border: 1px solid #e0e5f2; border-radius: 12px; outline: none; background: #fff; cursor: pointer;">
                <option value="Professor" <?php if($data['designation'] == 'Professor') echo 'selected'; ?>>Professor</option>
                <option value="Associate Professor" <?php if($data['designation'] == 'Associate Professor') echo 'selected'; ?>>Associate Professor</option>
                <option value="Assistant Professor" <?php if($data['designation'] == 'Assistant Professor') echo 'selected'; ?>>Assistant Professor</option>
                <option value="Lecturer" <?php if($data['designation'] == 'Lecturer') echo 'selected'; ?>>Lecturer</option>
                <option value="Senior Lecturer" <?php if($data['designation'] == 'Senior Lecturer') echo 'selected'; ?>>Senior Lecturer</option>
            </select>
        </div>
        
        <!-- Update Button -->
        <div style="text-align: center;">
            <button type="submit" name="update_teacher" class="btn-submit-modern">
                <i class="fas fa-check-circle"></i> Update Information
            </button>
        </div>
    </form>
</div>

<!-- Navigation: Link to go back to the main dashboard -->
<div style="text-align: center; margin-top: 40px; margin-bottom: 20px;">
    <a href="../dashboard.php" class="btn-home">
        <i class="fas fa-arrow-left"></i> Back to Dashboard
    </a>
</div>

<?php 
// 5. Include the footer file
include '../includes/footer.php'; 
?>