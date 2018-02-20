<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

include_once("variables.php");
$servername = $_SESSION["servername"];
$username = $_SESSION["username"];
$password = $_SESSION["password"];
$dbname = $_SESSION["dbname"];

$discussion = json_decode($_POST['discussion']);
$order = $_POST['order'];
$visit = json_decode($_POST['visit']);
$lat = json_decode($_POST['lat']);
$long = json_decode($_POST['long']);
$did = $_POST['did'];

// calculate distance between dealer's location and agents location
$pos = runQuery("SELECT lat,longitude from t_dealer_tbl where did=$did;" );
$dis = distance($pos[0]['lat'],$pos[0]['longitude'],$lat,$long);



$sql = "INSERT into t_meeting_tbl (did,contact,discussion,ordr,nxtmeet,todo,lat,longitude,d) VALUES ($did,'".escape($discussion[1])."','".escape($discussion[0])."','".$order."','".$visit[0]."','".escape($visit[1])."','".$lat."','".$long."',$dis);";

$result=0;
$result = insertdata($sql);

if($result==1)
	echo "Success";
 
 
//echo json_encode($sql );

?>