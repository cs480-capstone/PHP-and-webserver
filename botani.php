<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
/*
This PHP script connects to the database and queries the Trees table to pull latitude, longitude, deocrators array, Special Events, and whether or not the tree is hidden and puts it into a json file.
*/
//server info
$servername = "testdatabase.c2uw4uu5co9m.us-west-2.rds.amazonaws.com";
$username = "lukewarm11";
$password = "Leel1995!";
$dbname = "testdb";
//Make new sql connection
$con = mysqli_connect($servername, $username, $password, $dbname);
//check whether connection was succesful or not
if(!$con){
	die("connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM Trees"; //the actual query, pulls everything from Trees
$result = mysqli_query($con, $sql); //holds whether the query was successful
//if the result was successful then pull the information needed from database and put it into an array
if(mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)){
		$lat = (float)$row[latitude];
		$long = (float)$row[longitude];
		$decs = $row['Decorators'];
		$special = $row['SpecialEvents'];
		if($row[hidden] == '1')
			$hidden = true; 
		else
			$hidden = false;
		$trees[] = array('lat' => $lat, 'long' => $long, 'Decs' => $decs, 'Special' => $special, 'hidden' => $hidden);
		//$trees[] = $row;
	}
}
$response['trees'] = $trees; //creates array of the trees
echo json_encode($trees);
//return json_encode($response);

//encodes json data and creates a file called trees.json to store this data
//$json_data = json_encode($response, JSON_PRETTY_PRINT); 
//file_put_contents('trees.json', $json_data);
mysqli_close($con); //close the connection
?>
