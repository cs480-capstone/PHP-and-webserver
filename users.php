<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
/*
This PHP script connects to the database and queries the Trees table to pull latitude, longitude, deocrators array, Special Events, and whether or not the tree is hidden and puts it into a json file.
*/
//server info
$servername = "";
$username = "";
$password = "";
$dbname = "";
//Make new sql connection
$con = mysqli_connect($servername, $username, $password, $dbname);
//check whether connection was succesful or not
if(!$con)
{
	die("connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM Users ORDER BY totalpoints"; //the actual query, pulls everything from Users
$result = mysqli_query($con, $sql); //holds whether the query was successful
//if the result was successful then pull the information needed from database and put it into an array
if(mysqli_num_rows($result) > 0) 
{
	while($row = mysqli_fetch_assoc($result))
	{
		$user_id = $row['idUsers'];
		$username = $row['username'];
		$totalPoints = (int)$row['totalPoints'];
		$trees = (int)$row['trees'];
		$users[] = array('user_id'=>$user_id, 'username' => $username, 'totalPoints' => $totalPoints, 'trees' => $trees);
		
	}
}
echo json_encode($users);

mysqli_close($con); //close the connection
?>
