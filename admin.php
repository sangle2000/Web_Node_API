<?php

require_once('connection.php');

$query = "SELECT * FROM user_list";
$result = mysqli_query($conn, $query)

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/admin_page.css">
</head>

<body>
    <div class="header_container">
        <form action="insert_data.php" method="post" autocomplete="off">
            <div class="create_form">
                <input class="username_input" name="user_name" type="text" placeholder="Type User Name" required>
                <input class="password_input" name="pass" type="text" placeholder="Type User Password" required>
                <input class="fullname_input" name="user_full_name" type="text" placeholder="Type User Full Name" required>
                <button class="create_btn" type="submit">Success Create User
                    Account</button>
            </div>
        </form>
    </div>

    <div class="card_body">
        <table class="table table-bordered text-center">
            <tr class="bg-dark text-white">
                <td>User ID</td>
                <td>User Name</td>
                <td>Password</td>
                <td>User Full Name</td>
                <td>API Key</td>
            </tr>

            <tr>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['user_name']; ?></td>
                    <td><?php echo $row['pass']; ?></td>
                    <td><?php echo $row['user_full_name']; ?></td>
                    <td><?php echo $row['api_key']; ?></td>
            </tr>
        <?php
                }
        ?>
        </table>
    </div>
</body>

</html>