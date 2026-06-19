<?php 
// 1. Include the database connection and the page header
include '../config/db.php'; 
include '../includes/header.php'; 
?>

<!-- Header Section: Contains the page title and a button to add new attendance -->
<div class="table-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
    <div>
        <h1 style="color: var(--text-main); font-weight: 700;">Attendance History</h1>
    </div>
    <!-- Button to go to the page where you mark daily attendance -->
    <a href="mark_attendance.php" class="btn-add-teacher">
        <i class="fas fa-calendar-check"></i> Mark New Attendance
    </a>
</div>

<!-- Table Container: Displays all attendance records -->
<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Instructor Name</th>
                <th>Designation</th>
                <th>Status</th>
                <th style="text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // 2. SQL Query: Combine 'attendance' and 'instructors' tables to get names and dates
            // We order by Date (newest first) and then by Name
            $query = "SELECT attendance.*, instructors.name, instructors.designation 
                      FROM attendance 
                      JOIN instructors ON attendance.instructor_id = instructors.id 
                      ORDER BY attendance.attendance_date DESC, instructors.name ASC";
            
            $result = mysqli_query($conn, $query);

            // 3. Check if any records were found in the database
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    
                    // Logic to choose a CSS class based on status (Present = Green, Absent = Red)
                    $statusClass = ($row['status'] == 'Present') ? 'badge-present' : 'badge-absent';
                    
                    // Format the date to look like "15 Oct, 2023"
                    $formattedDate = date('d M, Y', strtotime($row['attendance_date']));
                    
                    echo "<tr>
                        <td><span style='font-weight: 600; color: var(--text-main);'>$formattedDate</span></td>
                        <td><strong style='color: var(--text-main);'>{$row['name']}</strong></td>
                        <td>{$row['designation']}</td>
                        <td><span class='badge {$statusClass}'>{$row['status']}</span></td>
                        <td style='text-align: center;'>
                            <!-- Link to Edit page -->
                            <a href='edit_attendance.php?id={$row['id']}' class='action-link edit-link'>
                                <i class='fas fa-edit'></i> Edit
                            </a>
                            <!-- Link to Delete with a confirmation popup -->
                            <a href='delete_attendance.php?id={$row['id']}' class='action-link delete-link' onclick='deleteConfirm(event, this.href)'>
                                <i class='fas fa-trash'></i> Delete
                            </a>
                        </td>
                    </tr>";
                }
            } else {
                // 4. Message to show if the database table is empty
                echo "<tr><td colspan='5' style='text-align:center; padding: 30px; color: var(--text-grey);'>No attendance records found. Start marking attendance to see them here.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Navigation Section: A link to go back to the main dashboard -->
<div style="text-align: center; margin-top: 40px; margin-bottom: 20px;">
    <a href="../dashboard.php" class="btn-home">
        <i class="fas fa-arrow-left"></i> Back to Dashboard
    </a>
</div>

<?php 
// 5. Include the page footer
include '../includes/footer.php'; 
?>