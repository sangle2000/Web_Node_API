import { initializeFirebase } from "./call_to_firebase.js";

const $ = document.querySelector.bind(document)
const $$ = document.querySelectorAll.bind(document)

const light_btn = $$(".light")
const fan_btn = $$(".fan")

const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const apiKey = urlParams.get('api_key');

const database = initializeFirebase(apiKey);

function updateFanStatus(status) {
    // Update fan status under the specific apiKey node
    database.ref(`${apiKey}/fan`).set(status)
        .then(() => {
            console.log('Fan status updated successfully');
        })
        .catch((error) => {
            console.error('Error updating fan status:', error);
        });
}

function updateLightStatus(status) {
    // Update light status under the specific apiKey node
    database.ref(`${apiKey}/light`).set(status)
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

for (let i = 0; i < light_btn.length; i++){
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

for (let i = 0; i < fan_btn.length; i++){
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