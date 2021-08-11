<?php 
session_start();
require_once 'views/db.view.php';

$id = 0;

if(isset($_GET['delete'])){
  $id = mysqli_escape_string($connection,$_GET['delete']);

  $result = mysqli_query($connection,"DELETE FROM patients WHERE patientid=$id");
  
  if($result == false){
    $_SESSION['message'] = 'Patient not deleted';
    $_SESSION['msg_type'] = 'danger'; 
  } else {
    header('location: list.php');
    exit();
    $_SESSION['message'] = 'Patient deleted';
    $_SESSION['mgs_type'] = 'success';
  }

}

mysqli_close($connection);