<?php

    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: X-Requested-With');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

    $servername = "testdatabase.c2uw4uu5co9m.us-west-2.rds.amazonaws.com";
    $username = "lukewarm11";
    $password = "Leel1995!";
    $dbname = "testdb";
    
    $con = mysqli_connect($servername, $username, $password, $dbname);
    if(!$con)
    {
	die("connection failed: " . mysqli_connect_error());
    }
	$json = file_get_contents("php://input"); //read json data
        $json_data = json_decode($json); //pull the information from the json file and put it into an array
    
        $username = $json_data->username;
	$points = $json_data->points;
        $query = "INSERT INTO Users ( username, totalPoints) VALUES ( '$username', $points)";
        $result = mysqli_query($con, $query);
	//if it was not successful then it will print out the error
	if($result===false)
	{
		printf("error: %s\n", mysqli_error($con));
	}
        
    
    $con->close();
?>
