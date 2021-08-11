<?php $currentPage = 'Booking' ?>
<?php
require_once 'views/db.view.php';

$firstName = $lastName =$email = $date='';
$mobileNumber = 0;
$doctorId = 0;

if(isset($_POST['book']) == 'POST'){
    $firstName = mysqli_real_escape_string($connection,trim($_POST['first-name']));
    $lastName = mysqli_real_escape_string($connection,trim($_POST['last-name']));
    $mobileNumber = mysqli_real_escape_string($connection,trim($_POST['mobile-number']));
    $email = mysqli_real_escape_string($connection,trim($_POST['email']));
    $doctorId = mysqli_real_escape_string($connection,$_POST['doctor']);
    $date = mysqli_real_escape_string($connection,trim($_POST['date']));
    
    if(empty($firstName)){
      $first_name_err = 'First name is required!';
    } elseif(!preg_match('/^[a-zA-Z]*$/',$firstName)){
      $first_name_err = 'Last name can only have letters!'; 
    }

    if(empty($lastName)){
      $last_name_err = 'Last name is required!';
    } elseif(!preg_match('/^[a-zA-Z]*$/',$lastName)){
      $last_name_err = 'Last name can only have letters!';
    }

    if(empty($mobileNumber)){
      $mobile_number_err = 'Mobile number is required!';
    } elseif(!preg_match('/^[0-9]*$/',$mobileNumber) && strlen($mobileNumber) < 10 ){
      $mobile_number_err = 'Can only be numbers and atleast ten digits!';
    }

    if(empty($email)){
      $email_err = 'Email is required'; 
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $email_err = 'Please fill corrct email format';
    }

    if(empty($date)){
      $date_err = 'Booking date is required';
    } 

    if($date < date('Y-m-d',strtotime('today'))){
        $incorrectDate_err = 'You cannot book past dates';
    }
    
    $result = mysqli_query($connection,"SELECT * FROM patients WHERE email='$email'");
    $patient = mysqli_fetch_assoc($result);

    if($patient){
      if($patient['appointment_date'] == $date){
        $date_err = 'You are already booked for this day';
      }
    }

    if(!isset($first_name_err) && !isset($last_name_err) && !isset($mobile_number_err) && !isset    ($email_err) && !isset($date_err) && !isset($date_err) && !isset($incorrectDate_er)){
      
      $booking_query = "INSERT INTO patients(first_name,last_name,mobile_number,email,doctorid,appointment_date) VALUES ('$firstName','$lastName',$mobileNumber,'$email',$doctorId,'$date')";
      
      mysqli_query($connection,$booking_query);
      session_start();
      header('location: mybookings.php');
      exit();
    }

    mysqli_close($connection);
}

?>

<?php require 'includes/header.php'; ?>

<div class="container my-2">
  <div class="row align-items-center">
    <div class="col-sm-6 offset-sm-3">
      <div class="booking__form__container">
        <h5 id="patient__form__header">Patient Form</h5>
        <form class="booking__form" action="book.php" method="POST">
          <div class="form-group">
            <input class="form-control" placeholder="Your First Name..." type="text" name="first-name"
              id="first-name" />
            <?php echo isset($first_name_err)?"<span class='text-danger'>{$first_name_err}</span>":"" ?>
          </div>
          <div class="form-group">
            <input class="form-control" placeholder="Your Last Name..." type="text" name="last-name" id="last-name" />
            <?php echo isset($last_name_err)?"<span class='text-danger'>{$last_name_err}</span>":"" ?>
          </div>
          <div class="form-group">
            <input class="form-control" placeholder="Your Mobile Number..." type="text" name="mobile-number"
              id="mobile-number" />
            <?php echo isset($mobile_number_err)?"<span class='text-danger'>{$mobile_number_err}</span>":"" ?>
          </div>
          <div class="form-group">
            <input class="form-control" placeholder="Your Email Address..." type="text" name="email" id="email" />
            <?php echo isset($email_err)?"<span class='text-danger'>{$email_err}</span>":"" ?>
          </div>
          <div class="form-group">
            <label for="doctorid">Select Your Doctor</label>
            <select class="form-control" name="doctor" id="doctor">
              <?php $results = mysqli_query($connection,"SELECT DISTINCT username,doctorid FROM doctors");?>
              <?php while ($row = mysqli_fetch_array($results)): ?>
              <option value="<?php echo $row['doctorid'];  ?>"><?php echo $row['username']; ?>
              </option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="date">Appointment Date</label>
            <input class="form-control" type="date" name="date" id="date" />
            <?php echo isset($date_err)?"<span class='text-danger'>{$date_err}</span>":"" ?>
            <?php echo isset($incorrectDate_err)?"<span class='text-danger'>{$incorrectDate_err}</span>":"" ?>
          </div>
          <div class="form-group">
            <button class="form-control btn btn-primary book__button" type="submit" name="book">
              Book
            </button>
          </div>
          <div class="form-group">
            <button class="form-control btn btn-success book__button" type="submit" name="">
              <a class="reset-button text-white" href="book.php">Reset</a>
            </button>
          </div>
          <small class="">
            <span class="text-muted">
              Already booked<a href="mybookings.php" class="text-primary ml-1">Check Status</a>
            </span>
          </small>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require 'includes/footer.php'; ?>