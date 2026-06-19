<?php 
// Include the database connection file
include '../config/db.php'; 

// Check if the ID is present in the URL
if(isset($_GET['id'])) {
    
    // Clean the ID to prevent SQL Injection (security step)
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Create the SQL command to delete the record from the attendance table
    $query = "DELETE FROM attendance WHERE id = $id";
    
    // Run the query in the database
    if(mysqli_query($conn, $query)) {
        // If the delete is successful, go back to the view page with a success message
        header("Location: view_attendance.php?msg=deleted");
        exit();
    } else {
        // If there is an error, show the error message
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    // If no ID was found in the URL, just send the user back to the list page
    header("Location: view_attendance.php");
    exit();
}
?>