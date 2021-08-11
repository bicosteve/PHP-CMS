<?php $currentPage = 'Register' ?>
<?php

require_once 'views/db.view.php';
// require_once 'views/functions.php';

//defining empty variables.
$username = $email = $password = $password2 = '';

if(isset($_POST['register']) == 'POST'){

    //Removing White Spaces On Inputs and preventing sql injections
    $username = mysqli_real_escape_string($connection,trim($_POST['username']));
    $email = mysqli_real_escape_string($connection,trim($_POST['email']));
    $password = mysqli_real_escape_string($connection,trim($_POST['password']));
    $password2 = mysqli_real_escape_string($connection,trim($_POST['password2']));
    
    //Validating username
    if(empty($username)){
        $username_err = "Username is required!";
    } elseif(!preg_match('/^[a-zA-Z0-9]*$/',$username)){
        $username_err = 'Username can only have letters and numbers!'; 
    }

    //validating email
    if(empty($email)){
        $email_err = 'Email is required';
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_err = 'Please fill corrct email format';
    }

    //comparing passwords
    if(empty($password)){
      $password_err = 'Password is required';
    }

    if(empty($password2)){
      $password2_err = 'Confirm password is required';
    }

    if($password !== $password2){
        $password2_err = 'Passwords do not match!';
    }

    //Preventing double email registeration.
    $sql = "SELECT * FROM doctors WHERE email='$email'";
    $result = mysqli_query($connection,$sql);
    $user = mysqli_fetch_assoc($result);

    if($user){
        if($user['email'] == $email){
            $userExist_err = 'This user already exist,please login.';
        }
    }
    
    //Check if there is no error in the inputs
    if(!isset($username_err) && !isset($email_err) && !isset($password_err) && !isset($password2_err) &&!isset($userExist_err)){
      $hashed_password = password_hash($password,PASSWORD_DEFAULT);
      $reqister_query = "INSERT INTO doctors(username,email,password) VALUES('$username','$email','$hashed_password')";
      mysqli_query($connection,$reqister_query);
      header('location: login.php');
      exit();
    }
    
    mysqli_close($connection);
}

?>

<?php require 'includes/header.php'; ?>

<div class="container my-2">
  <div class="row align-items-center">
    <div class="col-sm-6 offset-sm-3">
      <div class="register__form__container">
        <div class="registeration__form__header">
          <h2>Doctor Registration</h2>
        </div>
        <form class="register__form" action="register.php" method="POST">
          <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control" autocomplete="off" type="text" name="username" id="username" />
            <?php echo isset($username_err)?"<span class='text-danger'>{$username_err}</span>":"" ?>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" autocomplete="off" type="text" name="email" id="email" />
            <?php echo isset($email_err)?"<span class='text-danger'>{$email_err}</span>":"" ?>
            <?php echo isset($userExist_err)?"<span class='text-danger'>{$userExist_err}</span>":"" ?>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password" />
            <?php echo isset($password_err)?"<span class='text-danger'>{$password_err}</span>":"" ?>
          </div>
          <div class="form-group">
            <label for="confirm-password">Confirm Password</label>
            <input class="form-control" type="password" name="password2" id="confirm-password" />
            <?php echo isset($password2_err)?"<span class='text-danger'>{$password2_err}</span>":"" ?>
          </div>
          <div class="form-group">
            <button class="form-control btn btn-primary register__button" type="submit" name="register">
              Register
            </button>
          </div>
        </form>
        <small class="small__tag">Have an account?
          <span class="text-muted"><a class="text-primary" href="login.php">Login</a></span>
        </small>
      </div>
    </div>
  </div>
</div>

<?php require 'includes/footer.php'; ?>