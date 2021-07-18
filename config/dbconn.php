<?php
    session_start();

    $conn = mysqli_connect('localhost', 'promise', 'promisedan8', 'magicshop');

    if(!$conn) {
        echo 'Connection error: ' . mysqli_connect_error();
    }


?>