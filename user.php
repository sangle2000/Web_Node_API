<?php
session_start();

// Check if the API key is set in the session
if (isset($_SESSION['api_key'])) {
    // API key is available in session
    $apiKey = $_SESSION['api_key'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/user.css">
    <title>Control Light</title>
</head>

<body>
    <div class="header">
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="#">
                <img src="./assets/image/logo.jpg" width="80" height="80" class="d-inline-block align-top" alt="">
            </a>
            <div id="userFullNamePlaceholder"></div>
        </nav>
    </div>

    <div class="content_container">
        <div class="control_container">
            <div class="light_control_container">
                <img class="light" src="./assets/symbol/light_off.png" alt="light off" srcset="">
                <img class="light hide" src="./assets/symbol/light_on.png" alt="light on" srcset="">
            </div>

            <div class="fan_control_container">
                <img class="fan" src="./assets/symbol/fan_off.png" alt="fan off" srcset="">
                <img class="fan hide" src="./assets/symbol/fan_on.png" alt="fan on" srcset="">
            </div>
        </div>
    </div>
    <!-- <button class="turnOnButton">Turn On</button>
        <button class="turnOffButton">Turn Off</button> -->
    <script type="module">
        const apiKey = "<?php echo $apiKey; ?>";
        const $ = document.querySelector.bind(document)
        const $$ = document.querySelectorAll.bind(document)

        const light_btn = $$(".light")
        const fan_btn = $$(".fan")
        import {
            initializeApp
        } from "https://www.gstatic.com/firebasejs/10.11.1/firebase-app.js";
        import {
            getDatabase,
            ref,
            set,
            get
        } from "https://www.gstatic.com/firebasejs/10.11.1/firebase-database.js";

        const firebaseConfig = {
            apiKey: "AIzaSyA4feu6WUo9gA34NfCoSA-R3QTxtK4EPLk",
            authDomain: "smart-home-d16f8.firebaseapp.com",
            projectId: "smart-home-d16f8",
            storageBucket: "smart-home-d16f8.appspot.com",
            databaseURL: "https://smart-home-d16f8-default-rtdb.asia-southeast1.firebasedatabase.app",
            messagingSenderId: "212130358513",
            appId: "1:212130358513:web:3253125ef635df6e5f3550",
            measurementId: "G-2EHSQLLKFC"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const database = getDatabase();

        function updateFanStatus(status) {
            // Update fan status under the specific apiKey node
            set(ref(database, `${apiKey}/fan`), status)
                .then(() => {
                    console.log('Fan status updated successfully');
                })
                .catch((error) => {
                    console.error('Error updating fan status:', error);
                });
        }

        function updateLightStatus(status) {
            // Update light status under the specific apiKey node
            set(ref(database, `${apiKey}/light`), status)
                .then(() => {
                    console.log('Light status updated successfully');
                })
                .catch((error) => {
                    console.error('Error updating light status:', error);
                });
        }

        // Function to fetch initial values from the database
        async function fetchInitialValues() {
            const fanSnapshot = await database.ref(`${apiKey}/fan`).once('value');
            const lightSnapshot = await database.ref(`${apiKey}/light`).once('value');

            const fanStatus = fanSnapshot.val();
            const lightStatus = lightSnapshot.val();
        }

        for (let i = 0; i < light_btn.length; i++) {
            light_btn[i].onclick = () => {
                if (i == 0) {
                    light_btn[i].classList.add('hide')
                    light_btn[i + 1].classList.remove('hide')
                    updateLightStatus(true);
                } else {
                    light_btn[i].classList.add('hide')
                    light_btn[i - 1].classList.remove('hide')
                    updateLightStatus(false);
                }
            }
        }

        for (let i = 0; i < fan_btn.length; i++) {
            fan_btn[i].onclick = () => {
                if (i == 0) {
                    fan_btn[i].classList.add('hide')
                    fan_btn[i + 1].classList.remove('hide')
                    updateFanStatus(true);
                } else {
                    fan_btn[i].classList.add('hide')
                    fan_btn[i - 1].classList.remove('hide')
                    updateFanStatus(false);
                }
            }
        }
    </script>
    <!-- <script type="module" src="./call_to_firebase.js"></script> -->
    <script src="./user_script.js"></script>
</body>

</html>