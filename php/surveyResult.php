<?php
/****************************************************************
* This class is used to connect to the db and Insert the        *
* survey results into the DB for CNMT-310 Sprint 1              *
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
require_once("../classes/DB.class.php");
require_once("../classes/Template.php");
$page = new Template("Survey Results Page");
$page->addHeadElement('<link rel="stylesheet" type="text/css" href="../css/stylesheet.css">');
$page->finalizeTopSection();
$page->finalizeBottomSection();
print $page->getTopSection();
//convert the session variables to a $_POST
foreach ($_SESSION as $key => $value) {
			${$key} = $value;
			$_POST[$key] = $value;
		}//end if
session_destroy(); //destroys the Session
extract($_POST); //needed to extract the $_POST for the checkbox consistency check to boolean values
include("topNavBar.php");

if(isset($_POST['email'])) { //and the email variable is set
	//New datbase connection
	$con = new DB(); 
	//Check the connection
	if (!$con->getConnStatus()) {
		print "\n\nAn error has occurred with connection\n";
		exit;
	}else{
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
		$emailS = $con->dbESC($_POST['email']);
		$emailSafe = filter_var($emailS, FILTER_SANITIZE_EMAIL);
		$major1S = $con->dbESC($major1);
		$major1Safe = filter_var($major1S, FILTER_SANITIZE_STRING);
		$major2S = $con->dbESC($major2);
		$major2Safe = filter_var($major2S, FILTER_SANITIZE_STRING);
		$major3S = $con->dbESC($major3);
		$major3Safe = filter_var($major3S, FILTER_SANITIZE_STRING);
		$major4S = $con->dbESC($major4);
		$major4Safe = filter_var($major4S, FILTER_SANITIZE_STRING);
		$major5S = $con->dbESC($major5);
		$major5Safe = filter_var($major5S, FILTER_SANITIZE_STRING);
		$major6S = $con->dbESC($major6);
		$major6Safe = filter_var($major6S, FILTER_SANITIZE_STRING);
		$gradeS = $con->dbESC($_POST['grade']);
		$gradeSafe = filter_var($gradeS, FILTER_SANITIZE_STRING);
		$pizzaToppingS = $con->dbESC($_POST['pizzaTopping']);
		$pizzaToppingSafe = filter_var($pizzaTopping, FILTER_SANITIZE_STRING);
		$clientIPS = $con->dbESC($clientIP);
		$clientIPSafe =filter_var($clientIPS, FILTER_VALIDATE_IP);
		$insertTimeSafe = $con->dbESC($insertTime);
		//Insert Record into the DB	
		$query = "INSERT into surveys (email, major1, major2, major3, major4, major5, major6, grade, pizzaTopping, insertTime, clientIP) 
			VALUES ('{$emailSafe}', '{$major1Safe}', '{$major2Safe}', '{$major3Safe}', '{$major4Safe}', '{$major5Safe}', '{$major6Safe}', '{$gradeSafe}', '{$pizzaToppingSafe}', '{$insertTimeSafe}', '{$clientIPSafe}')";
		$result = $con->dbCall($query);
		//Check for DB Insert Errors
		if (!$result) {
			print 'There was an Error processing your survey<br>Please contact the Website Admin';
		}else{
			print	'<div class="content">
			<h3 class="action"> Thank you for submitting your survey answers! </h3>
			<h4>Your email address is: "'; print $email; print '"</h4>';
				if (count($major) == 1) {
					print '<h4>Your major is: "';
				}else{
					print '<h4>Your majors are: "';
				}//end if
				$last = count($major) - 1;
				foreach($major as $index => $value) {
					if($index == $last) {
						echo $value . '.';
					}else{
						echo $value . ', ';
					}//end if
				}//end foreach
				print'</h4>
				<h4>You expect to earn a "'; print $grade; print '" in your CNMT-310 Class.</h4>
				<h4>"'; print $pizzaTopping; print '" is your favorite Pizza Topping.</h4><hr><br>
				1 record successfully submitted.<br><br><h4>Click Survey on the menu bar to complete another survey.</h4>								
				</div>';
		  $result = false;//Reset result when done with it to prevent interfering with later calls.
		  unset($_POST); //removes the values of $_POST so the user can submit another survey
		}//end if
	}// end if
}// end isset				
print $page->getBottomSection();
?>