<nav class="top-navbar">
    <!-- Left Side: Shows the current page name automatically -->
    <div class="nav-left">
        <div class="breadcrumb-container">  
            <span class="current-page">
                <?php  
                    // Get the current file name (e.g., 'view_attendance.php')
                    $current_file = basename($_SERVER['PHP_SELF'], ".php");
                    
                    // Replace underscores (_) with spaces and capitalize the first letter
                    // Example: 'view_attendance' becomes 'View attendance'
                    $page_title = ucfirst(str_replace('_', ' ', $current_file));
                    
                    echo $page_title;
                ?><nav class="top-navbar">
    <!-- Left Side: Shows the current page name automatically -->
    <div class="nav-left">
        <div class="breadcrumb-container">  
            <span class="current-page">
                <?php  
                    // Get the current file name (e.g., 'view_attendance.php')
                    $current_file = basename($_SERVER['PHP_SELF'], ".php");
                    
                    // Replace underscores (_) with spaces and capitalize the first letter
                    // Example: 'view_attendance' becomes 'View attendance'
                    $page_title = ucfirst(str_replace('_', ' ', $current_file));
                    
                    echo $page_title;
                ?>
            </span>
        </div>
    </div>

    <!-- Right Side: Shows Date and Admin Profile -->
    <div class="nav-right">  
        
        <!-- Displays Today's Date (Example: 25 May, 2024) -->
        <div class="nav-date">
            <i class="far fa-calendar-alt"></i>
            <span><?php echo date('d M, Y'); ?></span>
        </div>

        <!-- User Profile Information -->
        <div class="nav-profile">
            <div class="user-text">
                <h4 class="user-name">Admin</h4>
                <span class="user-role">
                    <i style="font-size: 9px; color: #fbc02d;"></i> System Manager
                </span>
            </div>

            <!-- Profile Picture / Avatar Icon -->
            <div class="user-avatar-wrapper">
                <div class="user-avatar">
                    <!-- Shield icon representing an Admin -->
                    <i class="fas fa-user-shield"></i>
                </div>  
                <!-- Small green dot showing the user is online -->
                <span class="status-dot"></span>
            </div>
        </div>
    </div>
</nav>
            </span>
        </div>
    </div>

    <!-- Right Side: Shows Date and Admin Profile -->
    <div class="nav-right">  
        
        <!-- Displays Today's Date (Example: 25 May, 2024) -->
        <div class="nav-date">
            <i class="far fa-calendar-alt"></i>
            <span><?php echo date('d M, Y'); ?></span>
        </div>

        <!-- User Profile Information -->
        <div class="nav-profile">
            <div class="user-text">
                <h4 class="user-name">Admin</h4>
                <span class="user-role">
                    <i style="font-size: 9px; color: #fbc02d;"></i> System Manager
                </span>
            </div>

            <!-- Profile Picture / Avatar Icon -->
            <div class="user-avatar-wrapper">
                <div class="user-avatar">
                    <!-- Shield icon representing an Admin -->
                    <i class="fas fa-user-shield"></i>
                </div>  
                <!-- Small green dot showing the user is online -->
                <span class="status-dot"></span>
            </div>
        </div>
    </div>
</nav>