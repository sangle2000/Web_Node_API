<?php
session_start();

// Check if user is logged in
if(isset($_SESSION['user_full_name'])) {
    // User's full name is available in session
    $userFullName = $_SESSION['user_full_name'];
    echo $userFullName; // Output the user's full name
} else {
    // User is not logged in or full name is not available
    echo "Guest"; // Output a default value or handle as needed
}
