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
		print "\n\nAn error has occurred with connection\n";
		exit;
	}
	else
	{
		//Sanitize the user input
		$search = json_decode($userData);
		$searchTerm = $con->dbESC($search);
		//query the db for the search results	
		$query = "SELECT * FROM albums WHERE albums.albumArtist LIKE '%$searchTerm%' or albums.AlbumTitle LIKE '%$searchTerm%'";
		
		//$result = $con->dbCall($query);
		print json_encode(array("result" => $con->dbCall($query));
	}

}

?>