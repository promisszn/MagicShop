<?php
  require('config/dbconn.php');
  require('validator/loginValidator.php');

  if(isset($_POST['submit'])){
    // validate entries
    $validation = new UserValidator($_POST);
    $errors = $validation->validateForm();
    
  }

  $err2 = '';

  
  if (isset($_POST['submit'])) {
    if ($_POST['username'] !== '' && $_POST['password'] !== '') {
      $_SESSION['username'] = $_POST['username'];
      $_SESSION['password'] = $_POST['password'];

      $username = mysqli_escape_string($conn, $_POST['username']);
      $password = mysqli_escape_string($conn, $_POST['password']);
      $sql = "SELECT * FROM users WHERE Username = '$username' OR Password = '$password';";
      $result = mysqli_query($conn, $sql);

      if($row = mysqli_fetch_assoc($result)){
        header('location:home.php');
      }else{
        $err2 = 'Invalid Username or Password. Signup to create account';
      }
    }
  }
?>

<html lang="en">
<head>
    <title>Login</title>
</head>

<?php include('temps/header.php'); ?>

<section class="container grey-text">
  <h4 class="center">Log In</h4>
  <p><span class="error"><?php echo $err2 ?></span></p>
  <form class="white" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
    <label>Username:</label>
    <span class="error">* <?php echo $errors['username']?? '' ?></span>
    <input type="text" name="username" value="<?php echo htmlspecialchars($_POST['username']?? '') ?>">
    <label>Password:</label>
    <span class="error">* <?php echo $errors['password']?? '' ?></span>
    <input type="password" name="password">
    <div class="center">
      <input type="submit" name="submit" value="Login" class="btn">
    </div>
  </form>
</section>
<div class="center">
  <span>DON'T HAVE AN ACCOUNT YET?</span><br>
  <span>Click here to <a href="signup.php">Sign Up</a></span><br><br>
  <span>Forgot Password? <a href="resetpassword.php">Click here</a></span>
</div>

<?php include('temps/footer.php'); ?>

</html>