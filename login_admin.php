<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="./assets/css/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'
      rel='stylesheet'>
  </head>
  <body>
    <div class="wrapper">
      <form action="get_admin_data.php" method="get">
        <h1 class="login-title">Login Admin</h1>
        <div class="input-box">
          <input class="username_input" type="text" placeholder="Username"
            name="username_input" required>
          <i class='bx bxs-user'></i>
        </div>
        <div class="input-box">
          <input class="pass_input" type="password" placeholder="Password"
            name="pass_input" required>
          <i class='bx bxs-lock-alt'></i>
        </div>
        <div class="remember-forgot">
          <label><input type="checkbox">Remember Me</label>
          <a href="#">Forgot Password</a>
        </div>
        <button type="submit" class="btn btn_login">Login</button>
        <button type="button" class="btn btn_back">Back</button>
        <div class="register-link">
          <p>Don't have an account? <a href="#">Register</a></p>
        </div>
      </form>
    </div>
    <script src="./login.js"></script>
  </body>
</html>