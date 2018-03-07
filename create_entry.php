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
$username = (int)$json_data->username; //user information
$tree = (int)$json_data->tree; //tree id
$time = date('y/m/d h:i:sa'); //the time that the collection occured
$openPollenConesValue = (int)$json_data->openPollenConesValue; //breaking needle buds: integer
$unfoldingLeavesValue = (int)$json_data->unfoldingLeavesValue; //Young needles: integer
$fullSizedLeavesValue = (int)$json_data->fullSizedLeavesValue; //Pollen cones: integer
$coloredLeavesValue = (int)$json_data->coloredLeavesValue; //Open pollen cones: percentage
$openedFlowersValue = (int)$json_data->openedFlowersValue; //Pollen release: Little, some, lots
$ripeFruitsValue = (int)$json_data->ripeFruitsValue; //Unripe seed cones: integer 
$breakingNeedleBudsValue = (int)$json_data->breakingNeedleBudsValue; //Ripe seed cones: integer
$youngNeedlesValue = (int)$json_data->youngNeedlesValue; //Recent cone or seed drop: integer
$freshPollenConesValue = (int)$json_data->freshPollenConesValue; //Pollen release: Little, some, lots
$unripeSeedConesValue = (int)$json_data->unripeSeedConesValue; //Unripe seed cones: integer 
$ripeSeedConesValue = (int)$json_data->ripeSeedConesValue; //Ripe seed cones: integer
$droppedSeedConesValue = (int)$json_data->droppedSeedConesValue; //Recent cone or seed drop: integer
$breakingLeafBudsValue = (int)$json_data->breakingLeafBudsValue; //Pollen release: Little, some, lots
$flowerBudsValue = (int)$json_data->flowerBudsValue; //Unripe seed cones: integer 
$fruitsValue = (int)$json_data->fruitsValue; //Ripe seed cones: integer
$droppedFruitsValue = (int)$json_data->droppedFruitsValue; //Recent cone or seed drop: integera
$openPollenConesRadioValue = $json_data->openPollenConesRadioValue;//
$coloredLeavesRadioValue = $json_data->coloredLeavesRadioValue;//





	//the sql that will put the information into each column in the database 
	$sqli = "INSERT INTO Entry (Username, Tree, Timedate, openPollenConesValue, unfoldingLeavesValue, fullSizedLeavesValue, coloredLeavesValue, openedFlowersValue, ripeFruitsValue, breakingNeedleBudsValue, youngNeedlesValue, freshPollenConesValue, unripeSeedConesValue, ripeSeedConesValue, droppedSeedConesValue, breakingLeafBudsValue, flowerBudsValue, fruitsValue, droppedFruitsValue, openPollenConesRadioValue, coloredLeavesRadioValue  ) VALUES ($username, $tree, '$time', $openPollenConesValue, $unfoldingLeavesValue, $fullSizedLeavesValue, $coloredLeavesValue, $openedFlowersValue, $ripeFruitsValue, $breakingNeedleBudsValue, $youngNeedlesValue, $freshPollenConesValue, $unripeSeedConesValue, $ripeSeedConesValue, $droppedSeedConesValue, $breakingLeafBudsValue, $flowerBudsValue, $fruitsValue, $droppedFruitsValue, '$openPollenConesRadioValue', '$coloredLeavesRadioValue'  )";
	$result = mysqli_query($con, $sqli);//result holds whether the query was succesful or not
	//if it was not successful then it will print out the error
	if($result===false){
		printf("error: %s\n", mysqli_error($con));
	}

?>
