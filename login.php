<?php $currentPage = 'Login'; ?>

<?php

require_once 'views/db.view.php';


$username = $email = $password = '';
$errors = [];

if(isset($_POST['login']) == 'POST'){
    $email = mysqli_real_escape_string($connection,trim($_POST['email']));
    $password = mysqli_real_escape_string($connection,trim($_POST['password']));

    if(empty(trim($email))){
        $email_err = 'Email is required';
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $bad_email_err = 'Please fill corrct email format';
    }

    if(empty($password)){
        $password_err = 'Password is required!';
    } 
    
    $result = mysqli_query($connection,"SELECT * FROM doctors WHERE email='$email'");
    $user = mysqli_fetch_assoc($result);

    if($user){
      if(password_verify($password,$user['password']) == false){
        $mismatch_err = 'Your login email/password do not match';
      }

      if(!isset($email_err) && !isset($bad_email_err) && !isset($password_err) && !isset($mismatch_err)){
        session_start();
        $_SESSION['username'] = $user['username'];
        $_SESSION['doctorid'] = $user['doctorid'];
        $_SESSION['msg'] = 'You are now logged in';
        $_SESSION['msg_type'] = 'success';
        header('location: list.php');
        exit();
      }  

    }
    mysqli_close($connection);
}

?>

<?php require 'includes/header.php'; ?>

<div class="container my-2">
  <div class="row align-items-center">
    <div class="col-sm-6 offset-sm-3">
      <div class="login__form__container">
        <div class="login__form__header">
          <h2>Doctor Login</h2>
          <p>A few clicks away from creating your doclink account</p>
        </div>
        <form class="login__form" action="login.php" method="POST">
          <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" autocomplete="off" type="text" name="email" id="email" />
            <?php echo isset($email_err)?"<span class='text-danger'>{$email_err}</span>":"" ?>
            <?php echo isset($bad_email_err)?"<span class='text-danger'>{$bad_email_err}</span>":"" ?>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" autocomplete="off" type="password" name="password" id="password" />
            <?php echo isset($password_err)?"<span class='text-danger'>{$password_err}</span>":"" ?>
            <?php echo isset($mismatch_err)?"<span class='text-danger'>{$mismatch_err}</span>":"" ?>
          </div>
          <div class="form-group">
            <button class="form-control btn btn-primary login__button" name="login" type="submit">
              Login
            </button>
          </div>
        </form>
        <small class="small__tag">Don't have an account?
          <span class="text-muted"><a class="text-primary" href="register.php">Register</a></span>
        </small>
      </div>
    </div>
  </div>
</div>

<?php require 'includes/footer.php'; ?>