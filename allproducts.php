<?php
    require('config/dbconn.php');

    $sql = "SELECT * FROM products";
    $result = mysqli_query($conn, $sql);
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<html lang="en">

<head>
    <title>All products</title>
</head>

<?php include('innertemps/header.php'); ?>

<h4 class="center grey-text">ALL PRODUCTS</h4>
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
                <form action="allproducts.php" method="POST" class="card-action center">
                    <a class="btn" href="allproducts.php?id=<?php echo $p['id'] ?>">Buy</a>
                </form>
            </div>
        </div>

        <?php  }  ?>

    </div>
</div>

<?php include('innertemps/footer.php'); ?>

</html>