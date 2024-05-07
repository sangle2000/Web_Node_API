<?php
session_start();

if(isset($_GET['username_input']) && isset($_GET['pass_input'])) {
    $user_account = $_GET['username_input'];
    $pass = $_GET['pass_input'];

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "user";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to check if username and password match
    $sql = "SELECT * FROM user_list WHERE user_name='$user_account' AND pass='$pass'";
    $result = $conn->query($sql);

    // Check if any rows were returned
    if ($result->num_rows == 1) {
        // Username and password match, retrieve additional user data
        $row = $result->fetch_assoc();

        $_SESSION['user_full_name'] = $row['user_full_name'];
        $_SESSION['api_key'] = $row['api_key'];

        // Redirect to user page
        header("Location: user.php");
        exit();
    } else {
        // Username and password do not match, show an alert
        echo "<script>alert('Wrong Account name or Password');</script>";
        echo "<script>window.location.href = 'login_user.php';</script>";
    }

    // Close connection
    $conn->close();
} else {
    echo "Please provide both username and password.";
}
