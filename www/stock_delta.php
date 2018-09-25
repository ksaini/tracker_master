<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

include_once("variables.php");
$servername = $_SESSION["servername"];
$username = $_SESSION["username"];
$password = $_SESSION["password"];
$dbname = $_SESSION["dbname"];

$dt = $_GET['dt'];
$deltas = json_decode($_GET['delta']);
$approved = $_GET['approved'];

$isql = "";
$dsql = "DELETE from stock_delta where st_dt = $key;";

foreach($deltas as $key => $value){
	$isql .= "INSERT into stock_delta (st_dt,pid,qty,approved) VALUES ('$dt','$key',$value,$approved);";
}
echo $isql ;
/*
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$result = $conn->query($sql);
$data = array();

if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				array_push($data,$row);
			}
		} else {
			echo "0 results";
		}

mysqli_close($conn);
echo json_encode($data );
*/
?>