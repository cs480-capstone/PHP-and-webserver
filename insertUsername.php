<?php

    $servername = "testdatabase.c2uw4uu5co9m.us-west-2.rds.amazonaws.com";
    $username = "lukewarm11";
    $password = "Leel1995!";
    $dbname = "testdb";
    
    $con = mysqli_connect($servername, $username, $password, $dbname);

    if(isset($_REQUEST['username'])) {
        $username = $_POST['username'];

        $query ="INSERT INTO Users (username) VALUES ('$username')";

        $result = mysqli_query($con, $query);

        
    }

    $con->close();

?>