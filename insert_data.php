<?php

require 'vendor/autoload.php'; // Include Composer's autoloader
require 'connection.php'; 

use GuzzleHttp\Client;

// Function to generate a random API key
function generateApiKey($currentId, $desiredLength = 10)
{
    // Generate a random hexadecimal string
    $randomPart = bin2hex(random_bytes(($desiredLength - strlen($currentId)) / 2));
    // Ensure that the total length of the API key is 10 characters
    return substr($currentId . "_" . $randomPart, 0, $desiredLength);
}

// Function to get the next ID
function getNextId($conn)
{
    // Get the maximum ID from user_list table
    $query = "SELECT MAX(id) AS max_id FROM user_list";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Get the maximum ID
    $maxId = $row['max_id'];

    // If $maxId is null or empty, set it to 0
    if (empty($maxId)) {
        $maxId = 0;
    }

    // Increment by 1 to get the next ID
    return $maxId + 1;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from POST
    $user_name = $_POST["user_name"];
    $pass = $_POST["pass"];
    $full_name = $_POST["user_full_name"];

    // Check if the username already exists
    $checkQuery = "SELECT * FROM user_list WHERE user_name = '$user_name'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        echo "<script>alert('Username already exists. Please choose a different username.');</script>";
        echo "<script>window.location.href = 'admin.html';</script>";
        exit(); // Stop further execution
    }

    // Get the next ID
    $nextId = getNextId($conn);

    // Generate the API key
    $api_key = generateApiKey($nextId);

    // Initialize Guzzle client
    $client = new Client();

    // Set the new key with the desired structure in Firebase
    $response = $client->request('PUT', 'https://smart-home-d16f8-default-rtdb.asia-southeast1.firebasedatabase.app/UsersData/'.$api_key.'/Writings.json', [
        'json' => [
            'Fan' => false,
            'Light' => false
        ]
    ]);

    // Insert user data into your database
    $query = "INSERT INTO user_list (id, user_name, pass, user_full_name, api_key) VALUES ('$nextId', '$user_name', '$pass', '$full_name', '$api_key')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data Inserted Successfully');</script>";
        // Redirect to admin page
        header("Location: admin.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
