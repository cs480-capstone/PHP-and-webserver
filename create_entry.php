<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
/*
this PHP script connects to the database and inserts the collected data from the collectedData.json file.
*/
//server info
$servername = "testdatabase.c2uw4uu5co9m.us-west-2.rds.amazonaws.com";
$username = "lukewarm11";
$password = "Leel1995!";
$dbname = "testdb";
//Make new sql connection
$con = mysqli_connect($servername, $username, $password, $dbname);
//check whether connection was successful or not
if(!$con){
	die("connection failed: " . mysqli_connect_error());
}
$json = file_get_contents("php://input"); //read json data
$json_data = json_decode($json); //pull the information from the json file and put it into an array
//data that will be the same for each type of tree
$user = (int)$json_data->user; //user information
$tree = (int)$json_data->tree; //tree id
$type = $json_data->type; //tree type either evergreen or flowering 
$time = $json_data->time; //the time that the collection occured
//if statment for the type of tree
if($type == "Evergreen"){
	//each of these variables holds a different data type for the evergreen trees
	$breaking = (int)$json_data->breaking; //breaking needle buds: integer
	$young = (int)$json_data->young; //Young needles: integer
	$pollen = (int)$json_data->pollen; //Pollen cones: integer
	$open = (int)$json_data->open; //Open pollen cones: percentage
	$release = (int)$json_data->release; //Pollen release: Little, some, lots
	$unripe = (int)$json_data->unripe; //Unripe seed cones: integer 
	$ripe = (int)$json_data->ripe; //Ripe seed cones: integer
	$recent = (int)$json_data->recent; //Recent cone or seed drop: integer
	//the sql query that puts the right information into each column for the database 
	$sqli = "INSERT INTO Entry (User, Tree, Timedate, Breaking_needle_buds, Young_needles, Pollen_cones, Open_pollen_cones, Pollen_release, Unripe_seed_cones, Ripe_seed_cones, Recent_cone_seed_drop) VALUES ($user, $tree, '$time', $breaking, $young, $pollen, $open, $release, $unripe, $ripe, $recent)";
	$result = mysqli_query($con, $sqli); //result holds true or false
	//if there is an error it will print out what it is
	if($result===false){
		printf("error: %s\n", mysqli_error($con));
	}
} else {
	//each of these variables holds a different data type for the flowering trees 
	$buds = (int)$json_data->buds; //Breaking leaf buds: integer
	$unfolding = (int)$json_data->unfolding; //Leaves unfolding: percentage
	$full = (int)$json_data->full; //Full-sized leaves: percentage
	$color = (int)$json_data->color; //Colored leaves: percentage
	$falling = (int)$json_data->falling; //falling leaves: integer
	$flowers = (int)$json_data->flowers	; //Flowers or flower buds: percentage
	$openFlowers = (int)$json_data->openFlowers; //Open flowers: percentage
	$fruit = (int)$json_data->fruit; //Fruits: integer
	$ripeFruit = (int)$json_data->ripeFruit; //Ripe fruits: percentage
	$recentFruit = (int)$json_data->recentFruit; //recent fruit or seed drop: integer
	//the sql that will put the information into each column in the database 
	$sqli = "INSERT INTO Entry (User, Tree, Timedate, Breaking_leaf_buds, Leaves_unfolding, Full_sized_leaves, Colored_leaves, Falling_leaves, Flowers_flower_buds, Open_flowers, Fruits, Ripe_fruits, Recent_fruit_seed_drop) VALUES ($user, $tree, $time, $buds, $unfolding, $full, $color, $falling, $flowers, $openFlowers, $fruit, $ripeFruit, $recentFruit)";
	$result = mysqli_query($con, $sqli);//result holds whether the query was succesful or not
	//if it was not successful then it will print out the error
	if($result===false){
		printf("error: %s\n", mysqli_error($con));
	}
}
?>
