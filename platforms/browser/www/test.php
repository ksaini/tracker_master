<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

include_once("variables.php");

$now     = date('Y/m/d', time());
$agentid = $_POST['agentid'];
$did = mt_rand(100000,999900);

$firm = $_POST['firm'];
$addr = $_POST['addr'];
$gstn = $_POST['gstn'];
$contacts = json_decode($_POST['contacts']);
$products = json_decode($_POST['products']);
$lat = json_decode($_POST['lat']);
$long = json_decode($_POST['long']);
$compete = $_POST['compete'];
$remark = $_POST['remark'];

$firm = escape(trim($firm));
$addr = escape($addr);
$compete = escape($compete);
$remark = escape($remark);
$result=0;

$sql="INSERT into t_dealer_tbl (did,firmname,addr,gstn,reg_dt,agentid,lat,longitude,competitor, comments) VALUE (".$did.",'".$firm."','".$addr."',".$gstn.",'".$now."',".$agentid.",".$lat.",".$long.",'".$compete."','".$remark."') ";

// Insert basic info
$result += insertdata($sql);

$sql = "INSERT into t_contact_tbl (did,name,designation,mobile) VALUES ";
$flg=0;
foreach($contacts as $contact){
	if(strlen(trim($contact->name))>1){
		if($flg!=0)
			$sql .= ",";
		
		$sql .=  '('.$did.',"'.$contact->name.'","'.$contact->designation.'","'.$contact->mob.'")';
		
		$flg=1;
	}
}
$sql .= ";";

//insert contact info
if($flg==1)
	$result += insertdata($sql);
else
	$result++;

$sql = "INSERT into t_product_tbl (did,product,qty,turnover) VALUES ";
$flg=0;
foreach($products as $product){
	if(strlen(trim($product->item))>1){
		if($flg!=0)
			$sql .= ",";
		
		$sql .=  '('.$did.',"'.$product->item.'","'.escape($product->turnover).'","'.$product->price.'")';
		
		$flg=1;
	}
}
$sql .= ";";

//insert product info
if($flg==1)
	$result += insertdata($sql);
else
	$result++;


echo $did;


//echo json_encode($sql);


?>