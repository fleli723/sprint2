<?php
/****************************************************************
* This class is used to connect to the db and retrieve and the  *
* display the survey results into the DB for CNMT-310 Sprint 1  *
*                                                               *
* @author Tim, Filip and Corbin                                 * 
* @FileName: surveyResults.php                                  *
*                                                               *
* Changelog:                                                    *
* 20190926 - Original code constructed                          *
* 20191031 - included the DB Class, connection error checking,  *
*            sanitization, Isset search variable                *
* 20191101 - Added Session Variables                            *
*                                                               *
****************************************************************/
session_start();
require_once("classes/DB.class.php");
require_once("classes/Template.php");
$page = new Template("Survey List Page");
$page->addHeadElement('<meta name="viewport" content="width=500, initial-scale=1">');
$page->addHeadElement('<link rel="stylesheet" type="text/css" href="css/stylesheet.css">');
$page->addHeadElement('<link rel="stylesheet" type="text/css" href="css/surveyResultTables.css">');
$page->finalizeTopSection();
$page->finalizeBottomSection();
print $page->getTopSection();
include("topNavBar.php");

		
		if(!isset($_SESSION['username']))
		{
			print "NOT AUTHORIZED";
			
			exit;
			
		}
		if(!(isset($_SESSION))|| $_SESSION['userstatus'] != "A" || $_SESSION['userstatus'] == null || $_SESSION['userstatus'] == "" )
		{
			print "NOT AUTHORIZED To non-Admins";
			exit;
			
		}

			$con = new DB();
			//Check the connection
			if (!$con->getConnStatus()) {
				print "\n\nAn error has occurred with connection\n";
				print $page->getBottomSection();
				exit;
			}
			//query the db for the search results	
			$query = "SELECT * FROM surveys";
			$result = $con->dbCall($query);
			if (!$result) { 
				print '<h2>No results match your query</h2>';
			}else{
				print '<table id="t01">
				<caption><h2>Survey Results:</h2></caption>
				<thead>
				<tr>
					<th class = "r1">ID</th>
					<th class = "r2">Email</th>
					<th class = "r1">Major 1</th>
					<th class = "r1">Major 2</th>
					<th class = "r1">Major 3</th>
					<th class = "r1">Major 4</th>
					<th class = "r1">Major 5</th>
					<th class = "r1">Major 6</th>
					<th class = "r1">Grade</th>
					<th class = "r2">Pizza Topping</th>
					<th class = "r2">Insert Time</th>
					<th class = "r2">Client IP</th>
				</tr>
				</thead><tbody>
				<tbody>';
				foreach ($result as $row) {	
				print '<tr>
					<td class = "r1">';echo $row["surveyId"];       print '</td>';
					print ' <td class = "r2">';echo $row["email"];  print'</td>';
					print ' <td class = "r1">';echo $row["major1"]; print'</td>';
					print ' <td class = "r1">';echo $row["major2"]; print'</td>';
					print ' <td class = "r1">';echo $row["major3"]; print'</td>';
					print ' <td class = "r1">';echo $row["major4"]; print'</td>';
					print ' <td class = "r1">';echo $row["major5"]; print'</td>';
					print ' <td class = "r1">';echo $row["major6"]; print'</td>';
					print ' <td class = "r1">';echo $row["grade"];  print'</td>';
					print ' <td class = "r2">';echo $row["pizzaTopping"]; print'</td>';
					print ' <td class = "r2">';echo $row["insertTime"]; print'</td>';
					print ' <td class = "r2">';echo $row["clientIP"]; print'</td>';
					print' </tr>';
				}//end foreach
				print '</tbody>
				</table><br>';
			}//end if
			$result = false; //Reset result when done with it to prevent interfering with later calls.
print $page->getBottomSection();
?>
