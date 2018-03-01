<?php
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
//data that will be the same for each type of tree
$id_user = (int) $json_data[0]['id_user']; //user information
$trees = (int)$json_data[0]['trees']; //user's trees
$username = $json_data[0]['username']; //username
$points =(int) $json_data[0]['points']; //the number of points the user has
$sqli = "UPDATE Users SET totalPoints = :points, trees = :trees WHERE idUsers = id_user ";
$result = mysqli_query($con, $sqli); //result holds true or false
//if there is an error it will print out what it is
if($result===false)
{
	printf("error: %s\n", mysqli_error($con));
}

?>
