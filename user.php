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
            <button class="btn btn-back">Back</button>
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

        <div class="env_container">
            <div class="temp_container">
                <img src="./assets/symbol/low_temp.png" alt="" class="temp_img" width="100px">
                <img src="./assets/symbol/nor_temp.png" alt="" class="temp_img hide" width="100px">
                <img src="./assets/symbol/high_temp.png" alt="" class="temp_img hide" width="100px">
                <span class="temp_value">&deg;C</span>
            </div>

            <div class="hum_container">
                <img src="./assets/symbol/hum.png" alt="" class="hum_img" width="100px">
                <span class="hum_value">%</span>
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

        const btn_back = $(".btn-back")

        const temp_img = $$(".temp_img")
        const temp_val = $(".temp_value")
        const hum_val = $(".hum_value")

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
            set(ref(database, `UsersData/${apiKey}/Writings/Fan`), status)
                .then(() => {
                    console.log('Fan status updated successfully');
                })
                .catch((error) => {
                    console.error('Error updating fan status:', error);
                });
        }

        function updateLightStatus(status) {
            // Update light status under the specific apiKey node
            set(ref(database, `UsersData/${apiKey}/Writings/Light`), status)
                .then(() => {
                    console.log('Light status updated successfully');
                })
                .catch((error) => {
                    console.error('Error updating light status:', error);
                });
        }

        async function getFanStatus() {
            try {
                // Retrieve fan status from the database
                const fanSnapshot = await get(ref(database, `UsersData/${apiKey}/Writings/Fan`));

                // Extract the fan status value
                const fanStatus = fanSnapshot.val();

                if (fanStatus == false) {
                    fan_btn[1].classList.add('hide')
                    fan_btn[0].classList.remove('hide')
                } else {
                    fan_btn[0].classList.add('hide')
                    fan_btn[1].classList.remove('hide')
                }
            } catch (error) {
                console.error('Error fetching fan status:', error);
                throw error; // Rethrow the error to handle it elsewhere if needed
            }
        }

        async function getLightStatus() {
            try {
                // Retrieve light status from the database
                const lightSnapshot = await get(ref(database, `UsersData/${apiKey}/Writings/Light`));

                // Extract the light status value
                const lightStatus = lightSnapshot.val();

                if (lightStatus == false) {
                    light_btn[1].classList.add('hide')
                    light_btn[0].classList.remove('hide')
                } else {
                    light_btn[0].classList.add('hide')
                    light_btn[1].classList.remove('hide')
                }
            } catch (error) {
                console.error('Error fetching light status:', error);
                throw error; // Rethrow the error to handle it elsewhere if needed
            }
        }

        async function getTempValue() {
            try {
                // Retrieve light status from the database
                const tempSnapshot = await get(ref(database, `UsersData/${apiKey}/readings/temp`));

                // Extract the light status value
                const tempValue = tempSnapshot.val();

                if (tempValue <= 20) {
                    temp_img[0].classList.remove('hide')
                    temp_img[1].classList.add('hide')
                    temp_img[2].classList.add('hide')
                } else if (tempValue >= 30) {
                    temp_img[2].classList.remove('hide')
                    temp_img[0].classList.add('hide')
                    temp_img[1].classList.add('hide')
                } else {
                    temp_img[1].classList.remove('hide')
                    temp_img[0].classList.add('hide')
                    temp_img[2].classList.add('hide')
                }

                temp_val.innerHTML = tempValue + "&deg;C"

            } catch (error) {
                console.error('Error fetching light status:', error);
                throw error; // Rethrow the error to handle it elsewhere if needed
            }
        }

        async function getHumpValue() {
            try {
                // Retrieve light status from the database
                const humSnapshot = await get(ref(database, `UsersData/${apiKey}/readings/hum`));

                // Extract the light status value
                const humValue = humSnapshot.val();

                hum_val.innerHTML = humValue + "%"

            } catch (error) {
                console.error('Error fetching light status:', error);
                throw error; // Rethrow the error to handle it elsewhere if needed
            }
        }

        getFanStatus()
        getLightStatus()
        // Run the function once every second
        setInterval(getTempValue, 1000);
        setInterval(getHumpValue, 1000);

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

        btn_back.onclick = () => {
            window.location.href = "login_user.php"
        }
    </script>
    <!-- <script type="module" src="./call_to_firebase.js"></script> -->
    <script src="./user_script.js"></script>
</body>

</html>