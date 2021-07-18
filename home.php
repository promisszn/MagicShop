<?php
    require('config/dbconn.php');

    $username = $_SESSION['username'];

    $name = $price = '';
    $errors = array('name' => '', 'price' => '');

    $sql = "SELECT * FROM products";
    $result = mysqli_query($conn, $sql);
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $sql2 = "SELECT UserId from users WHERE Username = '$username';";
    $result2 = mysqli_query($conn, $sql2);
    $userId = mysqli_fetch_all($result2, MYSQLI_ASSOC);
    $userid = $userId[0]['UserId'];


    if(isset($_POST['submit'])){
		
		// check name
		if(empty($_POST['name'])){
			$errors['name'] = 'A name is required';
		} else{
			$name = $_POST['name'];
			if(!preg_match('/^[a-z0-9 .\-]+$/i', $name)){
				$errors['name'] = 'Name must be letters, numbers and spaces only';
			}
		}

		// check price
		if(empty($_POST['price'])){
			$errors['price'] = 'Price cannot be empty';
		} else{
			$price = $_POST['price'];
			if (!preg_match('/^[0-9]*$/', $price)){
				$errors['price'] = 'Price must be numbers only';
			}
		}

        
        if(array_filter($errors)){
			//echo 'errors in form';
		} else {

            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $price = mysqli_real_escape_string($conn, $_POST['price']);
            
            
            $sql = "INSERT INTO products(ProductName, ProductPrice, UserId) VALUES('$name', '$price', '$userid')";

            if(mysqli_query($conn, $sql)){
                //sucess
                header('Location: home.php');
            } else {
                echo 'query error: ' . mysqli_error($conn);
            }

		}

		
	}

    if(isset($_GET['del'])){
        $id = mysqli_real_escape_string($conn, $_GET['del']);
        $sql = "DELETE FROM products WHERE id = $id";
        
        if(mysqli_query($conn, $sql)){
            header('Location: home.php');
        }else {
            echo 'query error: ' . mysqli_error($conn);
        }
    }


        
    //make sql
    $sql3 = "SELECT * from products WHERE UserId = '$userid';";
    
    //get the query result
    $result3 = mysqli_query($conn, $sql3);
    
    //fetch result in array format
    $products = mysqli_fetch_all($result3, MYSQLI_ASSOC);
        
    mysqli_free_result($result); 
    mysqli_close($conn);
    


?>

<html lang="en">

<head>
    <title>Magic Shop||Home</title>
</head>

<?php include('innertemps/header.php'); ?>

<h5 class="grey-text">WELCOME <?php echo $username; ?></h5>
<h4 class="center grey-text">ADD PRODUCTS</h4>
<div class="row container">
    <form class="col s12" action="home.php" method="POST">
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">style</i>
                <input id="icon_prefix" type="text" name="name">
                <div class="red-text"><?php echo $errors['name']; ?></div>
                <label for="icon_prefix">Product Name</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">euro_symbol</i>
                <input id="price" type="number" name="price">
                <div class="red-text"><?php echo $errors['price']; ?></div>
                <label for="price">Price</label>
            </div>
        </div>
        <div class="center">
            <input type="submit" name="submit" value="Add" class="btn">
        </div>
    </form>
</div>

<h4 class="center grey-text">MY PRODUCTS</h4>
<div class="container">
    <div class="row">
        <?php
                foreach($products as $p){ ?>

        <div class="col s6 md3">
            <div class="card">
                <div class="card-content center">
                    <h6><?php echo htmlspecialchars($p['ProductName']) ?></h6>
                    <p>Price: €<?php echo date($p['ProductPrice']); ?></p>
                </div>
                <form action="edit.php" method="POST" class="card-action center">
                    <a class="btn" href="edit.php?id=<?php echo $p['id'] ?>">Edit</a>
                    <a class="btn" href="home.php?del=<?php echo $p['id'] ?>">Delete</a>
                </form>
            </div>
        </div>

        <?php  }  ?>

    </div>
</div>

<?php include('innertemps/footer.php'); ?>

</html>