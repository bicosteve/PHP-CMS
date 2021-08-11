<?php 
session_start();
session_unset();
session_destroy();

//Sending to Login Page
header('location: ../book.php');