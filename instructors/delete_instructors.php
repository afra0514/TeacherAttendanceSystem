<?php 
// 1. Include the database connection file
include '../config/db.php'; 

// 2. Check if an ID was sent through the URL (Example: delete_instructor.php?id=5)
if(isset($_GET['id'])) {
    
    // Clean the ID to prevent security issues (SQL Injection)
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // SQL command to delete the instructor with this specific ID
    $query = "DELETE FROM instructors WHERE id=$id";
    
    // 3. Try to delete the record from the database
    if(mysqli_query($conn, $query)) {
        // If it works, send the user back to the list page with a "deleted" message
        header("Location: view_instructor.php?status=deleted");
        exit(); // Stop the script here
    } else {
        // If something goes wrong, show the error message
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // If no ID was found in the URL, just go back to the list page
    header("Location: view_instructor.php");
    exit();
}
?>