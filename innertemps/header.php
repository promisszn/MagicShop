<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style type="text/css">
        body {
            font-family: verdana;
        }

        .brand-text {
            color: #00bfa5 !important;
        }

        .error {
            color: #ff0000;
        }
    </style>
</head>

<body class="grey lighten-4">
    <nav class="teal lighten-4 z-depth-1">
        <div class="nav-wrapper">
            <a href="home.php" class="brand-logo brand-text">DASHBOARD</a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="home.php">Home</a></li>
                <li><a href="allproducts.php">All Products</a></li>
                <li><a href="resetpassword.php">Reset Password</a></li>
                <li><a href="index.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <ul class="sidenav" id="mobile-demo">
    <li><a href="home.php" class="btn">Home</a></li>
        <li><a href="allproducts.php" class="btn">All Products</a></li>
        <li><a href="resetpassword.php" class="btn">Reset Password</a></li>
        <li><a href="index.php" class="btn">Logout</a></li>
    </ul>