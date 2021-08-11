<?php

// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host_name = 'localhost';
$user_name = 'root';
$password = '';
$db_name = 'hospital_db';

$connection = mysqli_connect($host_name,$user_name,$password,$db_name);

if(!$connection){
    die('Could not connect to db'. mysqli_connect_error());
}