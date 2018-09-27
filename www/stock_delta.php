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

?>