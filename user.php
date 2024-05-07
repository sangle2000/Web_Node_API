<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
            integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
            crossorigin="anonymous">
        <link rel="stylesheet" href="./assets/css/user.css">
        <title>Control Light</title>
    </head>
    <body>
        <div class="header">
            <nav class="navbar navbar-light bg-light">
                <a class="navbar-brand" href="#">
                  <img src="./assets/image/logo.jpg" width="80" height="80" class="d-inline-block align-top" alt="">
                </a>
              </nav>

              <div id="userFullNamePlaceholder"></div>
        </div>

        <div class="content_container">
            <div class="control_container">
                <div class="light_control_container">
                    <img class="light" src="./assets/symbol/light_off.png" alt="light on" srcset="">
                    <img class="light hide" src="./assets/symbol/light_on.png" alt="light on" srcset="">
                </div>

                <div class="fan_control_container">
                    <img class="fan" src="./assets/symbol/fan_off.png" alt="fan on" srcset="">
                    <img class="fan hide" src="./assets/symbol/fan_on.png" alt="fan on" srcset="">
                </div>
            </div>
        </div>
        <!-- <button class="turnOnButton">Turn On</button>
        <button class="turnOffButton">Turn Off</button> -->
        <script type="module" src="./call_to_firebase.js"></script>
        <script src="./user_script.js"></script>
    </body>
</html>
