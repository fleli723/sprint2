<?php

session_start();
require_once("classes/DB.class.php");

$userData = file_get_contents("php://input");


if (is_null($userData) || empty($userData)) 
{
	print "You must enter valid values";
	exit;
}
else
{
	//New datbase connection
	$con = new DB();
	//Check the connection
	if (!$con->getConnStatus()) 
	{
		print json_encode(array("result" => array("ErrorMessage" => "There was a problem, please try again")));
		exit;
	}
	else
	{
		//Consistency check for the major checboxes
		$major1 = (isset($major[0])) ? 1 : 0;				
		$major2 = (isset($major[1])) ? 1 : 0;
		$major3 = (isset($major[2])) ? 1 : 0;
		$major4 = (isset($major[3])) ? 1 : 0;
		$major5 = (isset($major[4])) ? 1 : 0;
		$major6 = (isset($major[5])) ? 1 : 0;
		
		//Get the IP address of the Client
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$clientIP = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$clientIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$clientIP = $_SERVER['REMOTE_ADDR'];
		}//endif
		
		//Get the insert Time for the record
		$insertTime = date_create()->format('Y-m-d H:i:s');		
		
		//Sanitize the user input 
		$emailS = filter_var($email, FILTER_SANITIZE_EMAIL);
		$emailSafe = $con->dbEsc($emailS);
		
		$major1S = filter_var($major1, FILTER_SANITIZE_STRING);
		$major1Safe = $con->dbEsc($major1S);
		$major2S = filter_var($major2, FILTER_SANITIZE_STRING);
		$major2Safe = $con->dbEsc($major2S);
		$major3S = filter_var($major3, FILTER_SANITIZE_STRING);
		$major3Safe = $con->dbEsc($major3S);
		$major4S = filter_var($major4, FILTER_SANITIZE_STRING);
		$major4Safe = $con->dbEsc($major4S);
		$major5S = filter_var($major5, FILTER_SANITIZE_STRING);
		$major5Safe = $con->dbEsc($major5S);
		$major6S = filter_var($major6, FILTER_SANITIZE_STRING);
		$major6Safe = $con->dbEsc($major6S);
		$gradeS = filter_var($grade, FILTER_SANITIZE_STRING);
		$gradeSafe = $con->dbEsc($gradeS);
		$pizzaToppingS = filter_var($pizzaTopping, FILTER_SANITIZE_STRING);
		$pizzaToppingSafe = $con->dbEsc($pizzaToppingS);
		$clientIPS = filter_var($clientIP, FILTER_VALIDATE_IP);
		$clientIPSafe = $con->dbESC($clientIPS);
		$insertTimeSafe = $con->dbESC($insertTime);
		
		//Insert Record into the DB	
		$query = "INSERT into surveys (email, major1, major2, major3, major4, major5, major6, grade, pizzaTopping, insertTime, clientIP) 
			//VALUES ('{$emailSafe}', '{$major1Safe}', '{$major2Safe}', '{$major3Safe}', '{$major4Safe}', '{$major5Safe}', '{$major6Safe}', '{$gradeSafe}', '{$pizzaToppingSafe}', '{$insertTimeSafe}', '{$clientIPSafe}')";
		//Sanitize the user input
		$search = json_decode($userData);
		//print json_encode($search);
		
		$searchTerm = $con->dbESC($search);
		//query the db for the search results	
		//$query = "SELECT * FROM albums WHERE albums.albumArtist LIKE '%$searchTerm%' or albums.AlbumTitle LIKE '%$searchTerm%'";
		
		$query = "INSERT into surveys (email, major1, major2, major3, major4, major5, major6, grade, pizzaTopping, insertTime, clientIP) 
			VALUES ('{$emailSafe}', '{$major1Safe}', '{$major2Safe}', '{$major3Safe}', '{$major4Safe}', '{$major5Safe}', '{$major6Safe}', '{$gradeSafe}', '{$pizzaToppingSafe}', '{$insertTimeSafe}', '{$clientIPSafe}')";
		$result = $con->dbCall($query);
		
		$result = $con->dbCall($query);
		//print json_encode(array("result" => $result);
		print json_encode($result);
	}

}

?>