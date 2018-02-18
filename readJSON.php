<?php

/*
This PHP script connects to the database and inserts the collected data from the collectedData.json file.
*/

//server info
$servername = "";
$username = "";
$password = "";
$dbname = "";

//Make new sql connection
$con = mysqli_connect($servername, $username, $password, $dbname);

//check whether connection was successful or not
if(!$con){
	die("connection failed: " . mysqli_connect_error());
}


$json = file_get_contents("collectedData.json"); //read the json file
$json_data = json_decode($json, true); //pull the information from the json file and put it into an array

//data that will be the same for each type of tree
$user = $json_data[0]['User']; //user information
$tree = $json_data[0]['tree']; //tree id
$type = $json_data[0]['type']; //tree type either evergreen or flowering 
$time = $json_data[0]['Time']; //the time that the collection occured

//if statment for the type of tree
if($type == "Evergreen"){

	//each of these variables holds a different data type for the evergreen trees
	$breaking = $json_data[0]['Breaking needle buds']; //breaking needle buds: integer
	$young = $json_data[0]['Young needles']; //Young needles: integer
	$pollen = $json_data[0]['Pollen cones']; //Pollen cones: integer
	$open = $json_data[0]['Open pollen cones']; //Open pollen cones: percentage
	$release = $json_data[0]['Pollen release']; //Pollen release: Little, some, lots
	$unripe = $json_data[0]['Unripe seed cones']; //Unripe seed cones: integer 
	$ripe = $json_data[0]['Ripe seed cones']; //Ripe seed cones: integer
	$recent = $json_data[0]['Recent cone or seed drop']; //Recent cone or seed drop: integer
	//the sql query that puts the right information into each column for the database 
	$sqli = "INSERT INTO Entry (User, Tree, Timedate, Breaking_needle_buds, Young_needles, Pollen_cones, Open_pollen_cones, Pollen_release, Unripe_seed_cones, Ripe_seed_cones, Recent_cone_seed_drop) VALUES ('$user', '$tree', '$time', '$breaking', '$young', '$pollen', '$open', '$release', '$unripe', '$ripe', '$recent')";
	$result = mysqli_query($con, $sqli); //result holds true or false
	//if there is an error it will print out what it is
	if($result===false){
		printf("error: %s\n", mysqli_error($con));
	}
} else {

	//each of these variables holds a different data type for the flowering trees 
	$buds = $json_data[0]['Breaking leaf buds']; //Breaking leaf buds: integer
	$unfolding = $json_data[0]['Leaves unfolding']; //Leaves unfolding: percentage
	$full = $json_data[0]['Full-sized leaves']; //Full-sized leaves: percentage
	$color = $json_data[0]['Colored leaves']; //Colored leaves: percentage
	$falling = $json_data[0]['Falling leaves']; //falling leaves: integer
	$flowers = $json_data[0]['Flowers or flower buds']; //Flowers or flower buds: percentage
	$openFlowers = $json_data[0]['Open flowers']; //Open flowers: percentage
	$fruit = $json_data[0]['Fruits']; //Fruits: integer
	$ripeFruit = $json_data[0]['Ripe fruits']; //Ripe fruits: percentage
	$recentFruit = $json_data[0]['Recent fruit or seed drop']; //recent fruit or seed drop: integer

	//the sql that will put the information into each column in the database 
	$sqli = "INSERT INTO Entry (User, Tree, Timedate, Breaking_leaf_buds, Leaves_unfolding, Full_sized_leaves, Colored_leaves, Falling_leaves, Flowers_flower_buds, Open_flowers, Fruits, Ripe_fruits, Recent_fruit_seed_drop) VALUES ('$user', '$tree', '$time', '$buds', '$unfolding', '$full', '$color', '$falling', '$flowers', '$openFlowers', '$fruit', '$ripeFruit', '$recentFruit')";
	$result = mysqli_query($con, $sqli);//result holds whether the query was succesful or not
	//if it was not successful then it will print out the error
	if($result===false){
		printf("error: %s\n", mysqli_error($con));
	}
}

?>
