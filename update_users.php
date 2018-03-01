<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
/*
thiss PHP script retreives the posted data connects to the database and update the users table.
*/
//server info
$servername = "";
$username = "";
$password = "";
$dbname = "";
//Make new sql connection
$con = mysqli_connect($servername, $username, $password, $dbname);
//check whether connection was successful or not
if(!$con)
{
	die("connection failed: " . mysqli_connect_error());
}
$json = file_get_contents('php://input'); //read the json data
$json_data = json_decode($json); //pull the information from the json input
//get uers' data
$id_user = (int) $json_data->id_user; //user information
$points = (int) $json_data->points; //the number of points the user has
$sqli = "UPDATE Users SET totalPoints = $points WHERE idUsers= $id_user";
$result = mysqli_query($con, $sqli); //result holds true or false
//if there is an error it will print out what it is
if($result===false)
{
	printf("error: %s\n", mysqli_error($con));
}


