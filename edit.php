<?php
    require('config/dbconn.php');

    $name = $price = '';
    $errors = array('name' => '', 'price' => '');

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

    }

    if(isset($_GET['id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        
        //make sql
        $sql = "SELECT * FROM products WHERE id = $id";
        
        //get the query result
        $result = mysqli_query($conn, $sql);
    
        //fetch result in array format
        $products = mysqli_fetch_assoc($result);
        
        $pName = $products['ProductName'];
        $pPrice = $products['ProductPrice'];
        $id = $products['id'];
                
        mysqli_free_result($result); 
        mysqli_close($conn);

    }

    if(isset($_POST['submit'])){
        $id = mysqli_real_escape_string($conn, $_POST['idToEdit']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);

        $sql = "UPDATE products SET ProductName = '$name', ProductPrice = $price WHERE id = $id";


        if(mysqli_query($conn, $sql)){
            //success
            header('Location: home.php');
        }else {
            echo 'query error: ' . mysqli_error($conn);
        }
    }


?>

<html lang="en">

<head>
    <title>Edit</title>
</head>

<?php include('innertemps/header.php'); ?>

<div class="row container">
    <form class="col s12" action="edit.php" method="POST">
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">style</i>
                <input id="icon_prefix" type="text" name="name" value="<?php echo $pName; ?>">
                <div class="red-text"><?php echo $errors['name']; ?></div>
                <label for="icon_prefix">Product Name</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">euro_symbol</i>
                <input id="price" type="number" name="price" value="<?php echo $pPrice; ?>">
                <div class="red-text"><?php echo $errors['price']; ?></div>
                <label for="price">Price</label>
            </div>
        </div>
        <div class="center">
            <input type="hidden" name="idToEdit" value="<?php echo $products['id']; ?>">
            <input type="submit" name="submit" value="Update" class="btn">
        </div>
    </form>
</div>


<?php include('innertemps/footer.php'); ?>

</html>