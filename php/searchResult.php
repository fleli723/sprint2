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
*            sanitization,                                      *
*                                                               *
****************************************************************/
require_once("../classes/DB.class.php");
require_once("../classes/Template.php");
$page = new Template("Action Page");
$page->addHeadElement('<link rel="stylesheet" type="text/css" href="../css/stylesheet.css">');
$page->addHeadElement('<link rel="stylesheet" type="text/css" href="../css/searchResultTables.css">');
$page->finalizeTopSection();
$page->finalizeBottomSection();
print $page->getTopSection();
include("topNavBar.php");

if(isset($_POST['Search_Bar_Name'])) { //and the search variable is set
	//New datbase connection
	$con = new DB(); 
	//Check the connection
	if (!$con->getConnStatus()) {
		print "\n\nAn error has occurred with connection\n";
		exit;
	}else{
		//Sanitize the user input
		$unfilteredSearchTerm = $con->dbESC($_POST['Search_Bar_Name']);
		$searchTerm = filter_var($unfilteredSearchTerm, FILTER_SANITIZE_STRING);
		//query the db for the search results	
		$query = "SELECT * FROM albums WHERE albums.albumArtist LIKE '%$searchTerm%' or albums.AlbumTitle LIKE '%$searchTerm%'";
		$result = $con->dbCall($query);
		if (!$result) { 
			print '<h2>No results match your query</h2>';
		}else{
			print '<table id="t01">
			<caption><h2>Search Results:</h2></caption>
			<thead>
			<tr>
				<th class = "r1">ID#</th>
				<th class = "r2">Album Artist</th>
				<th class = "r3">Album Title</th>
				<th class = "r4">Album Duration</th>
			</tr>
			</thead><tbody>
			<tbody>';
			foreach ($result as $row) {	
			print '<tr>
				<td class = "r1">';echo $row["albumId"];              print '</td>';
				print ' <td class = "r2">';echo $row["albumArtist"]; print'</td>';
				print ' <td class = "r3">';echo $row["albumTitle"];  print' </td>';
				print ' <td class = "r4">';echo $row["duration"];  print' </td>';
				print' </tr>';
			}//end foreach
			print '</tbody>
			</table><br>';
		}//end if
		$result = false; //Reset result when done with it to prevent interfering with later calls.
	}//endif
}//end if
//Show the button to search again
print '<form class="formStyle" name="frmSearchResults" id="searchResults" method ="Post" action="search.php">
	<button type="submit" class="button" id="btnSubmit" name="btnSubmit">Search Again</button>	
</form>';
print $page->getBottomSection();
?>