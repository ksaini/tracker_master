<?php
		session_start();
		$_SESSION["servername"] = "localhost";
		$_SESSION["username"] = "root";
		$_SESSION["password"] = "";
		//$_SESSION["dbname"] = "trackingapp";
		$_SESSION["dbname"] = "gb_track";
		$_SESSION["baseurl"] = "http://localhost/pgexample/appSample/www/";
		//$_SESSION["baseurl"] = "http://localhost/bot/";
		//$_SESSION["logged"] = false;
	
		
	
	function runQuery($q){
	$servername = $_SESSION["servername"];
		$username = $_SESSION["username"];
		$password = $_SESSION["password"];
		$dbname = $_SESSION["dbname"];

	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	
	if (!$conn) {
		header('Location: $url');
		die("Connection failed: " . mysqli_connect_error());
	}
	
	$sql = $q;
	
	$result = $conn->query($sql);
	$data = array();

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			array_push($data,$row);
		}
	} 
	mysqli_close($conn);
	return $data;	
	}
	
	function toDate($ymd){
	
	//Convert it into a timestamp.
	$timestamp = strtotime($ymd);
	
	//Convert it to DD-MM-YYYY
	$dmy = date("Y-m-d", $timestamp);
	
	return $dmy;
}

function getQ($k)
{
	$str = file_get_contents('querymap.json');
	$json = json_decode($str,true);
	
	if (strpos($k, '__!') !== false) {
		$exp = explode(',', $k);
		$k = $exp[0];
		$p1 = $exp[1];
		$p2 = '';
		if(isset($exp[2]))
			$p2 = $exp[2];
		
		if(isset($json[0][$k])){
			$v = str_replace("?",$p1,$json[0][$k]);
			$v = str_replace("@",$p2,$v);
			
		}
		else
			$v = $k;
		
	}
	else{	
		if(isset($json[0][$k]))
			$v = $json[0][$k];
		else
			$v = $k;//return key if value is not there
		
		
		//print_r($json);
		return $v;
	}
	return $v;
}

function insertdata($q)
	{
        $servername = $_SESSION["servername"];
        $username   = $_SESSION["username"];
        $password   = $_SESSION["password"];
        $dbname     = $_SESSION["dbname"];
		$result =0;
        
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        if ($conn->multi_query($q) === TRUE) {
            $result = 1; 
        } else {
            echo "Error: In Inserting data";
			echo "Error: " . $q . "<br>" . $conn->error;
        }
        
        $conn->close();
		
		return $result;
        
    }
function escape($value) {
    $return = '';
    for($i = 0; $i < strlen($value); ++$i) {
        $char = $value[$i];
        $ord = ord($char);
        if($char !== "'" && $char !== "\"" && $char !== '\\' && $ord >= 32 && $ord <= 126)
            $return .= $char;
        else
            $return .= '';//'\\x' . dechex($ord);
    }
    return $return;
}


function distance($lat1, $lon1, $lat2, $lon2) {

  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = "K";

  if ($unit == "K") {
    return ($miles * 1.609344);
  } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
        return $miles;
      }
}

?>