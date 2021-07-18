<?php
  require('config/dbconn.php');
  require('validator/userValidator.php');

  if(isset($_POST['submit'])){
    // validate entries
    $validation = new UserValidator($_POST);
    $errors = $validation->validateForm();
    
  }

  $err2 = $err3 = '';

  if (isset($_POST['submit'])) {
    if ($_POST['email'] !== '' && $_POST['username'] !== '' && $_POST['password'] != '') {
      $_SESSION['username'] = $_POST['username'];
      $_SESSION['password'] = $_POST['password'];

    if($_POST['password'] !== $_POST['rpassword']) {
      $err3 = 'Passwords do not match';
    }else{
      $email = mysqli_escape_string($conn, $_POST['email']);
      $username = mysqli_escape_string($conn, $_POST['username']);
      $sql = "SELECT * FROM users WHERE Email = '$email' OR Username = '$username';";
      $result = mysqli_query($conn, $sql);
      
      if(mysqli_fetch_assoc($result)){
        $err2 = 'Username or email already taken';
      } else {
        $email = mysqli_escape_string($conn, $_POST['email']);
        $username = mysqli_escape_string($conn, $_POST['username']);
        $password = mysqli_escape_string($conn, $_POST['password']);
        $sql = "INSERT INTO users (Email, Username, Password) VALUES ('$email', '$username', '$password');";
        if(mysqli_query($conn, $sql)){
          header('location:home.php');
        }else {
          echo 'query error: ' . mysqli_error($conn);
        }
        
      }
    }
  }
}

?>



<html lang="en">
<head>
    <title>Sign Up</title>
</head>

<?php include('temps/header.php'); ?>

<section class="container grey-text">
    <h4 class="center">Create Account</h4>
    <p><span class="error"><?php echo $err2 ?></span></p>
    <form class="white" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
      <label>Your Email:</label>
      <span class="error">* <?php echo $errors['email']?? '' ?></span>
      <input type="text" name="email" value="<?php echo htmlspecialchars($_POST['email']?? '') ?>">
      <label>Username:</label>
      <span class="error">* <?php echo $errors['username']?? '' ?></span>
      <input type="text" name="username" value="<?php echo htmlspecialchars($_POST['username']?? '') ?>">
      <label>Password:</label>
      <span class="error">* <?php echo $errors['password']?? '' ?></span>
      <input type="password" name="password">
      <label>Re-enter Password:</label>
      <span class="error">* <?php echo $errors['password']?? '' ?></span><span class="error"><?php echo $err3 ?></span>
      <input type="password" name="rpassword">
      <div class="center">
        <input type="submit" name="submit" value="Sign Up" class="btn"> 
      </div>
    </form>
</section>


<?php include('temps/footer.php'); ?>
</html>