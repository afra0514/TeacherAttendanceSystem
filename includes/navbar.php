<nav class="top-navbar">
    <!-- Left Side: Automatic Page Title -->
    <div class="nav-left">
        <div class="breadcrumb-container">  
            <span class="parent-page">Pages / </span>
            <span class="current-page">
                <?php  
                    // Get current filename and format it
                    $current_file = basename($_SERVER['PHP_SELF'], ".php");
                    $page_title = ucfirst(str_replace('_', ' ', $current_file));
                    
                    // Displaying the formatted title
                    echo $page_title;
                ?>
            </span>
        </div>
    </div>

    <!-- Right Side: Date and Admin Profile -->
    <div class="nav-right">  
        
        <!-- Date Display -->
        <div class="nav-date">
            <i class="far fa-calendar-alt"></i>
            <span><?php echo date('d M, Y'); ?></span>
        </div>

        <!-- Admin Profile -->
        <div class="nav-profile">
            <div class="user-text">
                <h4 class="user-name">Admin</h4>
                <span class="user-role">
                    <i class="fas fa-crown" style="font-size: 9px; color: #fbc02d;"></i> System Manager
                </span>
            </div>

            <div class="user-avatar-wrapper">
                <div class="user-avatar">
                    <i class="fas fa-user-shield"></i>
                </div>  
                <!-- Online Status Dot -->
                <span class="status-dot"></span>
            </div>
        </div>
    </div>
</nav>