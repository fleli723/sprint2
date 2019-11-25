<?php
/****************************************************************
* This class is used to connect to the db and display the       *
* search results for CNMT-310 Sprint 1                          *
*                                                                *
* @author Tim, Filip and Corbin                                 *
* @FileName: searchResults.php                                  *
*                                                               *
* Changelog:                                                    *
* 20190926 - Original code constructed                          *
* 20191031 - included the DB Class, connection error checking,  *
*            sanitization                                       *
* 20191107 - corrected php catch                                *
****************************************************************/
session_start();
require_once("classes/DB.class.php");
require_once("classes/Template.php");
$page = new Template("Action Page");
$page->addHeadElement('<link rel="stylesheet" type="text/css" href="css/stylesheet.css">');
$page->addHeadElement('<link rel="stylesheet" type="text/css" href="css/searchResultTables.css">');
$page->finalizeTopSection();
$page->finalizeBottomSection();
print $page->getTopSection();
include("topNavBar.php");





//checks if post is set, and not an empty string or a single space
if(isset($_POST['Search_Bar_Name']) && $_POST['Search_Bar_Name'] != '' && $_POST['Search_Bar_Name'] != ' ') {
	print 	'<div class="content">';
	
	
	//web services
	$dataJson = json_encode($_POST['Search_Bar_Name']);
	$contentLength = strlen($dataJson);
	
	$header = array(
		'Content-Type: application/json',
        'Accept: application/json',
		'Content-Length: ' . $contentLength
	);
	$url = "http://cnmtsrv2.uwsp.edu/~fleli723/sprint2/searchProcessing.php";
	
	$ch = curl_init();
	// Set options for curl
	curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch,CURLOPT_POSTFIELDS, $dataJson);
	curl_setopt($ch,CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch,CURLOPT_URL, $url);
	
	$return = curl_exec($ch);
	
	// Check HTTP Status
	$httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	if($httpStatus != 200)
	{
		print "Something went wrong with your request";
		print $httpStatus;
		curl_close($ch);
	}
	$resultObject = json_decode($return);

	
	//if(!is_object($resultObject))
	//{
	//print "Something went wrong with decoding the return";
	//print $httpStatus;
	//curl_close($ch);
	//exit;
	//}

	
		//change if to reflect web services change
		//if (!property_exists($resultObject,"result")) {
		//		print "works";
		//		$resultss = property_exists($resultObject,"result");
		//		print $resultss;
		//}
		//
		//if (property_exists($resultObject->result,"ErrorMessage")) 
		//{ 
		//	print '<h2>' .  $resultObject->result->ErrorMessage . ' </h2>';
		//}
		//else
		//{
			print '<table id="t01">
			<caption><h2>Search Results:</h2></caption>
			<thead>
			<tr>
				<th class = "r1">ID#</th>
				<th class = "r2">Album Artist</th>
				<th class = "r3">Album Title</th>
				<th class = "r4">Album Duration</th>
				<th class = "r5"></th>
			</tr>
			</thead><tbody>
			<tbody>';
			
			foreach ($resultObject as $row) {
				
			print '<tr>
				<td class = "r1">';echo $row->albumId;              print '</td>';
				print ' <td class = "r2">';echo $row->albumArtist; print'</td>';
				print ' <td class = "r3">';echo $row->albumTitle;  print' </td>';
				print ' <td class = "r4">';echo $row->duration;  print' </td>';
				print ' <td class = "r5"> <a href="'; echo $row->albumLink;  print' target = "_blank"><img src="images/amazon-badge.png" width="150px" height="20px" title ="Buy at Amazon" alt="Buy at Amazon"></a> </td>';
				print' </tr>';
			}//end foreach

			print '</tbody>
			</table><br>';
			
		//}//end if
		
		//$resultObject = false; //Reset result when done with it to prevent interfering with later calls.
}//end if
else
{
	print '<div class="content">
	<h2> Please click "Search" from the top bar and fill out the field to search</h2>';
}
//Show the button to search again
print '<form class="formStyle" name="frmSearchResults" id="searchResults" method ="Post" action="search.php">
		<button type="submit" class="button" id="btnSubmit" name="btnSubmit">Search Again</button>	
		</form>
</div>';
print $page->getBottomSection();
?>