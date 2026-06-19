<?php 
// 1. Include database connection and header layout
include '../config/db.php'; 
include '../includes/header.php'; 

// 2. Add SweetAlert2 library for nice pop-up messages
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

// 3. Check if the user clicked the Submit button
if(isset($_POST['add_teacher'])) {
    
    // Clean user inputs to prevent security issues (SQL Injection)
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);

    // SQL query to save instructor details into the database
    $sql = "INSERT INTO instructors (name, email, phone, designation) VALUES ('$name', '$email', '$phone', '$designation')";
    
    if(mysqli_query($conn, $sql)) {
        // If save is successful, show a success popup
        echo "
        <script>
            Swal.fire({
                title: 'Success!',
                text: 'Teacher has been registered successfully.',
                icon: 'success',
                confirmButtonColor: '#4318ff',
                confirmButtonText: 'Done'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send the user to the list page
                    window.location.href = 'view_instructor.php';
                }
            });
        </script>";
    } else {
        // If there is an error, show an error popup
        echo "
        <script>
            Swal.fire({
                title: 'Error!',
                text: 'Something went wrong. Please try again.',
                icon: 'error',
                confirmButtonColor: '#ee5d50'
            });
        </script>";
    }
}
?>

<!-- Header Section: Title and Instruction -->
<div class="dashboard-header" style="text-align: center; margin-top: 30px; margin-bottom: 30px;"> 
    <h1 style="color: var(--text-main); font-weight: 700;">Add New Instructor</h1>
    <p style="color: var(--text-grey); font-size: 14px;">Enter teacher details to register in the system</p>
</div>

<!-- Form Container: Styled box for inputs -->
<div class="form-container" style="margin: 0 auto; max-width: 550px; background: #fff; padding: 35px; border-radius: 20px; box-shadow: var(--shadow);">
    <form action="" method="POST">
        
        <!-- Input for Full Name -->
        <div class="form-group" style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-main);">Full Name</label>
            <input type="text" name="name" placeholder="Ex: John Doe" required style="width: 100%; padding: 12px; border: 1px solid #e0e5f2; border-radius: 12px; outline: none;">
        </div>

        <!-- Input for Email -->
        <div class="form-group" style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-main);">Email Address</label>
            <input type="email" name="email" placeholder="example@mail.com" required style="width: 100%; padding: 12px; border: 1px solid #e0e5f2; border-radius: 12px; outline: none;">
        </div>

        <!-- Input for Phone Number -->
        <div class="form-group" style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-main);">Phone Number</label>
            <input type="text" name="phone" placeholder="017XXXXXXXX" required style="width: 100%; padding: 12px; border: 1px solid #e0e5f2; border-radius: 12px; outline: none;">
        </div>

        <!-- Dropdown for Designation Selection -->
        <div class="form-group" style="margin-bottom: 30px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-main);">Designation</label>
            <select name="designation" required style="width: 100%; padding: 12px; border: 1px solid #e0e5f2; border-radius: 12px; outline: none; background: #fff; cursor: pointer;">
                <option value="">Select Designation</option>
                <option value="Professor">Professor</option>
                <option value="Lecturer">Lecturer</option>
                <option value="Assistant Professor">Assistant Professor</option>
                <option value="Senior Lecturer">Senior Lecturer</option>
            </select>
        </div>

        <!-- Modern Submit Button -->
        <div style="text-align: center;">
            <button type="submit" name="add_teacher" class="btn-submit-modern">
                <i class="fas fa-paper-plane"></i> Submit
            </button>
        </div>
    </form>
</div>

<!-- Bottom Navigation: Link to go back to the dashboard -->
<div style="text-align: center; margin-top: 40px; margin-bottom: 20px;">
    <a href="../dashboard.php" class="btn-home">
        <i class="fas fa-arrow-left"></i> Back to Dashboard
    </a>
</div>

<?php 
// Include the footer file
include '../includes/footer.php'; 
?>