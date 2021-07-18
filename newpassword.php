<?php
    require('config/dbconn.php');
    $username = $_SESSION['username'];

    $password = $err3 = '';
    $errors = array('password' => '');

    if(isset($_POST['submit'])){
		
		// check password
		if(empty($_POST['password'])){
			$errors['password'] = 'Password cannot be empty';
		} else{
			$password = $_POST['password'];
			if (strlen($_POST["password"]) <= '6'){
				$errors['email'] = "Your Password Must Contain At Least 6 Characters!";
			}
		}
    }

    if(isset($_POST['submit'])){
        if ($_POST['password'] != '') {
            $_SESSION['password'] = $_POST['password'];
      
          if($_POST['password'] !== $_POST['rpassword']) {
            $err3 = 'Passwords do not match';
          }else{
            $password = mysqli_escape_string($conn, $_POST['password']);
            $sql = "UPDATE users SET Password = '$password' WHERE Username = '$username'";

            if(mysqli_query($conn, $sql)){
                function phpAlert($msg) {
                    echo '<script type="text/javascript">alert("' . $msg . '")</script>'; 
                }
            
                phpAlert('Password successfully changed');
              }else {
                echo 'query error: ' . mysqli_error($conn);
              }
          }
        }
    }
?>

<html lang="en">

<head>
    <title>New Password</title>
</head>

<?php include('innertemps/header.php'); ?>

<section class="container grey-text">
    <h4 class="center">Enter New Password</h4>
    <form class="white" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
    <label>Password:</label>
      <span class="error">* <?php echo $errors['password']?? '' ?></span>
      <input type="password" name="password">
      <label>Re-enter Password:</label>
      <span class="error">* <?php echo $errors['password']?? '' ?></span><span class="error"><?php echo $err3 ?></span>
      <input type="password" name="rpassword">
      <div class="center">
        <input type="submit" name="submit" value="Proceed" class="btn"> 
      </div>
    </form>
</section>

<?php include('innertemps/footer.php'); ?>

</html>