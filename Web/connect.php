<?php
    $hostname = "localhost";
    $username = "id20863698_ptud";
    $password = "Hl@m123456";
    $database = "id20863698_ptud";

    $conn = mysqli_connect($hostname, $username, $password, $database);

    if (!$conn) {
        die("Connect Failed: " . mysqli_connect_error());
    }
   
    
    ?>