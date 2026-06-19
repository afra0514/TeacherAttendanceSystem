<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic settings for the browser -->
    <meta charset="UTF-8">
    <!-- Makes the website responsive (looks good on mobile phones) -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Attendance System</title>
    
    <!-- External CSS: Connects the design file for this specific page -->
    <link rel="stylesheet" href="assets/css/index.css">
    
    <!-- Font Awesome 6: Loads icons like the graduation cap and arrow -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <!-- Main wrapper for the entire welcome screen -->
    <div class="welcome-screen">
        
        <!-- Background Decorations: These divs are styled in CSS to look like floating shapes -->
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>

        <!-- Main Engaging Card: The white box in the center of the screen -->
        <div class="welcome-box">
            
            <!-- Pulsing Icon: An animated circle containing a graduation cap icon -->
            <div class="icon-circle">
                <i class="fas fa-graduation-cap"></i>
            </div>

            <!-- Text Content -->
            <h1>Teacher Attendance</h1>
            <p>Empower your institution with our smart, automated attendance tracking and analytics system.</p>
            
            <!-- Action Button: Link to enter the main Dashboard -->
            <a href="dashboard.php" class="btn-start">
                Get Started <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>

</body>
</html>