<?php
if(isset($_GET['username_input']) && isset($_GET['pass_input'])) {
    $admin_account = $_GET['username_input'];
    $pass = $_GET['pass_input'];

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "admin";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to check if username and password match
    $sql = "SELECT * FROM admin_account WHERE account_name='$admin_account' AND pass='$pass'";
    $result = $conn->query($sql);

    // Check if any rows were returned
    if ($result->num_rows == 1) {
        // Username and password match, redirect to another page
        header("Location: admin.php");
        exit();
    } else {
        // Username and password do not match, show an alert
        echo "<script>alert('Wrong Account name or Password');</script>";
        echo "<script>window.location.href = 'login_admin.php';</script>";
    }

    // Close connection
    $conn->close();
} else {
    echo "Please provide both username and password.";
}
