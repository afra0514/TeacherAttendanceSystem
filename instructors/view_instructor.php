<?php 
// 1. Connect to the database and load the page header
include '../config/db.php'; 
include '../includes/header.php'; 
?>

<!-- Header Section: Shows the page title and the 'Add' button -->
<div class="table-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
    <div> 
        <h1 style="color: var(--text-main); font-weight: 700;">Instructors List</h1>
        <p style="color: var(--text-grey); font-size: 14px;">Manage all registered teachers from here</p>
    </div>
    
    <!-- Link to the page where you can add a new teacher -->
    <a href="add_instructor.php" class="btn-add-teacher">
        <i class="fas fa-plus"></i> Add New Teacher
    </a>
</div>

<!-- Table Container: The box that holds the teacher data -->
<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Instructor Name</th>
                <th>Designation</th>
                <th>Email Address</th>
                <th>Phone Number</th>
                <th style="text-align: center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // 2. SQL Query: Get all instructors from the database, newest first
            $query = "SELECT * FROM instructors ORDER BY id DESC";
            $result = mysqli_query($conn, $query);

            // 3. Check if there are any teachers in the database
            if(mysqli_num_rows($result) > 0) {
                // Loop through every teacher and create a table row
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td><span style='color: var(--text-grey); font-weight: 600;'>#{$row['id']}</span></td>
                        <td><strong style='color: var(--text-main);'>{$row['name']}</strong></td>
                        <td>{$row['designation']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone']}</td>
                        <td style='text-align: center;'>
                            <!-- Edit Link -->
                            <a href='edit_instructor.php?id={$row['id']}' class='action-link edit-link'>
                                <i class='fas fa-user-edit'></i> Edit
                            </a>
                            <!-- Delete Link with a confirmation popup -->
                            <a href='delete_instructor.php?id={$row['id']}' class='action-link delete-link' onclick='deleteConfirm(event, this.href)'>
                                <i class='fas fa-trash-alt'></i> Delete
                            </a>
                        </td>
                    </tr>";
                }
            } else {
                // 4. Message to show if the list is empty
                echo "<tr><td colspan='6' style='text-align:center; padding: 30px; color: var(--text-grey);'>No instructors found. Click 'Add New Teacher' to get started.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Back Link: Returns to the main Dashboard -->
<div style="text-align: center; margin-top: 40px; margin-bottom: 20px;">
    <a href="../dashboard.php" class="btn-home">
        <i class="fas fa-arrow-left"></i> Back to Dashboard
    </a>
</div>

<?php 
// 5. Load the page footer
include '../includes/footer.php'; 
?>