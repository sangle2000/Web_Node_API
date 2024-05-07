<?php
$conn = mysqli_connect("localhost", "root", "", "user");

if(!$conn){
    die("". mysqli_connect_error());
}