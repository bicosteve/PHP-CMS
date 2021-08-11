<?php $currentPage = 'Edit Patient'; ?>
<?php

require_once 'views/db.view.php';

$date ='';
$date_err = $incorrectDate_er = '';
$editid = 0;

if(isset($_POST['update']) == 'POST'){
  $date = mysqli_real_escape_string($connection,trim($_POST['date']));
  $editid = mysqli_escape_string($connection,$_POST['id']);
  $id = (int) $editid;  
  
  mysqli_query($connection,"UPDATE patients SET appointment_date='$date' WHERE patientid=$id");
  header('location: list.php');
  exit(); 
}

if(isset($_GET['edit'])){
  $id = mysqli_escape_string($connection,$_GET['edit']);
  $query = "SELECT * FROM patients WHERE patientid=$id";
        
  $result = mysqli_query($connection,$query);

  if(!$result){
    die(mysqli_error($connection));
  }

  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result)){
      $patientid = (int) $row['patientid'];
      $edit_date = $row['appointment_date'];

    }
  }
}
mysqli_close($connection);
?>

<?php require 'includes/header.php'; ?>

<div class="container my-2">
  <div class="row align-items-center">
    <div class="col-sm-6 offset-sm-3">
      <div class="booking__form__container">
        <h5 id="patient__form__header">Edit Appointment</h5>
        <form class="booking__form" action="editpatient.php" method="POST">
          <input class="form-control" id="id" type="hidden" name="id" value="<?php echo $patientid; ?>">
          <div class="form-group">
            <label for="date">New Date</label>
            <input class="form-control" value="<?php echo $edit_date; ?>" type="date" name="date" id="date" />
            <?php echo isset($date_err)?"<span class='text-danger'>{$date_err}</span>":"" ?>
            <?php echo isset($incorrectDate_err)?"<span class='text-danger'>{$incorrectDate_err}</span>":"" ?>
          </div>
          <div class="form-group">
            <button class="form-control btn btn-primary book__button" type="submit" name="update">
              Update
            </button>
          </div>
          <small class="">
            <span class="text-muted">
              Patient List<a href="list.php" class="text-primary ml-1">Patients</a>
            </span>
          </small>
        </form>
      </div>
    </div>
  </div>
</div>