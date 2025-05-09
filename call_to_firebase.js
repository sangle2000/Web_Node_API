const $ = document.querySelector.bind(document)
const $$ = document.querySelectorAll.bind(document)

const light_btn = $$(".light")
const fan_btn = $$(".fan")

import { initializeApp } from "https://www.gstatic.com/firebasejs/10.11.1/firebase-app.js";
import { getDatabase, ref, set, get } from "https://www.gstatic.com/firebasejs/10.11.1/firebase-database.js";

// Initialize Firebase with apiKey obtained from PHP login
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
const app = firebase.initializeApp(firebaseConfig);
const database = firebase.database();

function updateFanStatus(status) {
    // Update fan status under the specific apiKey node
    database.ref(`${window.apiKey}/fan`).set(status)
        .then(() => {
            console.log('Fan status updated successfully');
        })
        .catch((error) => {
            console.error('Error updating fan status:', error);
        });
}

function updateLightStatus(status) {
    // Update light status under the specific apiKey node
    database.ref(`${window.apiKey}/light`).set(status)
        .then(() => {
            console.log('Light status updated successfully');
        })
        .catch((error) => {
            console.error('Error updating light status:', error);
        });
}

// Function to fetch initial values from the database
async function fetchInitialValues() {
    const fanSnapshot = await database.ref(`${window.apiKey}/fan`).once('value');
    const lightSnapshot = await database.ref(`${window.apiKey}/light`).once('value');

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