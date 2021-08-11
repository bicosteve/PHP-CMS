<?php $currentPage = 'Home' ?>

<?php 

require_once 'views/db.view.php';

$doctorName = '';

if(isset($_POST['search']) == 'POST'){
  $doctorName = mysqli_real_escape_string($connection,trim($_POST['doctor-name']));
  
  if(empty($doctorName)){
        $doctorName_err = 'You must have a search parameter to search!';
  } elseif(!preg_match('/^[a-zA-Z]*$/',$doctorName)){
        $doctorName_err = 'Doctor"s name can only have letters!'; 
  }

  $result = mysqli_query($connection,"SELECT * FROM doctors WHERE username='$doctorName'");
}

?>

<?php require_once 'includes/header.php'; ?>

<div class="container mt-2">
  <div class="reserve">
    <p>
      Reserve your consultation now in one minute by with a group of best doctors in
      all specialization
    </p>
  </div>

  <!--Doctor Search Form-->
  <div class="search__doctor">
    <form action="index.php" method="POST">
      <div class="form-group">
        <input class="form-control" type="text" name="doctor-name" placeholder="Doctor's name" />
      </div>
      <div class="form-group">
        <button class="doctor__search__button" type="search">Search</button>
      </div>
    </form>
  </div>
</div>

<!---Image sections-->
<div class="doctors">
  <div class="row no-gutters">
    <div class="col-sm-4">
      <div class="image__container">
        <img class="img-fluid" src="images/teeth-doctor.jpg" alt="teeth-doctor" />
      </div>
    </div>
    <div class="col-sm-4">
      <div class="image__container">
        <img class="img-fluid" src="images/outpatient.jpg" alt="outpatient" />
      </div>
    </div>
    <div class="col-sm-4">
      <div class="image__container">
        <img class="img-fluid" src="images/gynocologist.jpg" alt="gynocologist" />
      </div>
    </div>
  </div>
</div>

<?php require 'includes/footer.php'; ?>