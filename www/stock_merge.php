<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

include_once("variables.php");
$servername = $_SESSION["servername"];
$username = $_SESSION["username"];
$password = $_SESSION["password"];
$dbname = $_SESSION["dbname"];

$dt = $_GET['dt'];


$disql = "UPDATE t_stock_delta set approved=1 where st_dt = $dt;"; // sql to set approved=1 t_stock_delta
$isql = "";  // merger and update item count in stock table

// Get production sheet for given $dt
$deltas =	runQuery("SELECT pid,qty from t_stock_delta where approved=0 and st_dt = $dt; ");

// Now merge and update stock table
foreach($deltas as $delta){
	$isql .= "UPDATE t_item_tbl set stock = stock + $delta['qty'] where id = $delta['pid'] ;";
}
echo $isql ;

?>