<?php 
// 1. Include database connection and the site header
include '../config/db.php'; 
include '../includes/header.php'; 
?>

<!-- Header Section: Title for the report page -->
<div class="dashboard-header" style="text-align: center; margin-top: 20px; margin-bottom: 30px;"> 
    <h1 style="color: var(--text-main); font-weight: 700;">Attendance Report</h1>
    <p style="color: var(--text-grey); font-size: 14px;">Detailed overview of teacher attendance statistics</p>
</div>

<!-- Table Container: Displays the calculated statistics -->
<div class="table-container" style="max-width: 1000px; margin: 0 auto;">
    <table>
        <thead>
            <tr>
                <th>Instructor Name</th>
                <th>Designation</th>
                <th>Total Present</th>
                <th>Total Absent</th>
                <th>Attendance %</th>
            </tr>
        </thead>
        <tbody>
            <?php
            /* 
               2. SQL Query Logic:
               - We join 'instructors' (i) and 'attendance' (a) tables.
               - SUM(CASE...) counts 1 if the status matches, and 0 if it doesn't.
               - LEFT JOIN ensures we see all teachers, even if they have no attendance records yet.
               - GROUP BY i.id calculates these numbers for each teacher individually.
            */
            $query = "SELECT i.name, i.designation, 
                      SUM(CASE WHEN a.status = 'Present' THEN 1 ELSE 0 END) AS total_present,
                      SUM(CASE WHEN a.status = 'Absent' THEN 1 ELSE 0 END) AS total_absent
                      FROM instructors i
                      LEFT JOIN attendance a ON i.id = a.instructor_id
                      GROUP BY i.id 
                      ORDER BY i.name ASC";
            
            $result = mysqli_query($conn, $query);

            // 3. Loop through the database results
            while($row = mysqli_fetch_assoc($result)) {
                // Calculate the total number of days (Present + Absent)
                $total_days = $row['total_present'] + $row['total_absent'];
                
                // 4. Calculate Percentage: (Present Days / Total Days) * 100
                // If total_days is 0, we set percentage to 0 to avoid a mathematical error
                $percentage = ($total_days > 0) ? round(($row['total_present'] / $total_days) * 100, 2) : 0;
                
                // 5. Display the data in table rows
                echo "<tr>
                    <td style='font-weight:600; color: var(--text-main);'>{$row['name']}</td>
                    <td style='color: var(--text-grey);'>{$row['designation']}</td>
                    <td style='color: #05cd99; font-weight: 700;'>{$row['total_present']}</td> <!-- Green for Present -->
                    <td style='color: #ee5d50; font-weight: 700;'>{$row['total_absent']}</td>  <!-- Red for Absent -->
                    <td>
                        <strong style='color: var(--text-main);'>{$percentage}%</strong>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Navigation: Back to Dashboard button -->
<div style="text-align: center; margin-top: 40px; margin-bottom: 20px;">
    <a href="../dashboard.php" class="btn-home">
        <i class="fas fa-arrow-left"></i> Back to Dashboard
    </a>
</div>

<?php 
// 6. Include the site footer
include '../includes/footer.php'; 
?>