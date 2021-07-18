<?php
  require('config/dbconn.php');
  $username = $_SESSION['username'];

	$email = $err2 = '';
	$errors = array('email' => '');

  if(isset($_POST['submit'])){
		
		// check email
		if(empty($_POST['email'])){
			$errors['email'] = 'An email is required';
		} else{
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors['email'] = 'Email must be a valid email address';
			}
		}

    if(array_filter($errors)){
			//echo 'errors in form';
		} else {
        if ($_POST['email'] !== '') {
          $_SESSION['email'] = $_POST['email'];
    
          $email = mysqli_escape_string($conn, $_POST['email']);
          
          $sql = "SELECT * FROM users WHERE Email = '$email' AND Username = '$username';";
          $result = mysqli_query($conn, $sql);
    
          if($row = mysqli_fetch_assoc($result)){
            header('location:newpassword.php');
          }else{
            $err2 = 'Email does not exist. Signup to create account';
          }
        }
      }
  }
?>


<html lang="en">

<head>
    <title>Reset Password</title>
</head>

<?php include('innertemps/header.php'); ?>

<section class="container grey-text">
    <h4 class="center">Reset Password</h4>
    <p><span class="error"><?php echo $err2 ?></span></p>
    <form class="white" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
      <label>Your Email:</label>
      <span class="error">* <?php echo $errors['email']?? '' ?></span>
      <input type="text" name="email" placeholder="Enter Email">
      <div class="center">
        <input type="submit" name="submit" value="Proceed" class="btn"> 
      </div>
    </form>
</section>

<?php include('innertemps/footer.php'); ?>

</html>