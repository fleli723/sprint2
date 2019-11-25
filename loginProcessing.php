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
			$con = new DB();
	//Check the connection
	if (!$con->getConnStatus()) {
		print "\n\nAn error has occurred with connection\n";
		print $page->getBottomSection();
		exit;
	}
	else
	{
		$userNameInput = $_POST['usernameInput'];
		$passWordInput = $_POST['passwordInput'];
		
		//$result = $con->dbCall($query);
		//Check for DB Insert Errors
		//query the db for the search results	
		$safeUserName = $con->dbEsc($userNameInput);
			$safePassword = $con->dbEsc($passWordInput);			
			$query = "Select username, userpass, realname, userstatus from user where username = '{$safeUserName}'";
			$result = $con->dbCall($query);
		//print json_encode(array("result" => $result);
		print json_encode($result);
	}

}

?>