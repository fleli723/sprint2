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
require_once("classes/DB.class.php");
require_once("classes/Template.php");

$page = new Template("Survey Results Page");
$page->addHeadElement('<link rel="stylesheet" type="text/css" href="css/stylesheet.css">');
$page->addHeadElement('<link rel="stylesheet" type="text/css" href="css/surveyResultTables.css">');
$page->finalizeTopSection();
$page->finalizeBottomSection();
print $page->getTopSection();

extract($_POST); //needed to extract the $_POST for the checkbox consistency check to boolean values
include("topNavBar.php");
if(isset($email) && filter_var($email,FILTER_VALIDATE_EMAIL) && !empty($major) && !empty($grade) && !empty($pizzaTopping)) { //and the email variable is set
	//New datbase connection
	$con = new DB();
	//Check the connection
	if (!$con->getConnStatus()) {
		print "\n\nAn error has occurred with connection\n";
		print $page->getBottomSection();
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
			VALUES ('{$emailSafe}', '{$major1Safe}', '{$major2Safe}', '{$major3Safe}', '{$major4Safe}', '{$major5Safe}', '{$major6Safe}', '{$gradeSafe}', '{$pizzaToppingSafe}', '{$insertTimeSafe}', '{$clientIPSafe}')";
		$result = $con->dbCall($query);
		//Check for DB Insert Errors
		if (!$result) {
			print 'There was an Error processing your survey<br>Please contact the Website Admin';
		}
		else
		{
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
				print'"</h4>
				<h4>You expect to earn a "'; print $grade; print '" in your CNMT-310 Class.</h4>
				<h4>"'; print $pizzaTopping; print '" is your favorite Pizza Topping.</h4><hr><br>
				1 record successfully submitted.<br><br><h4>Click Survey on the menu bar to complete another survey.</h4>								
				</div>';
		  $result = false;//Reset result when done with it to prevent interfering with later calls.
		  unset($_POST); //removes the values of $_POST so the user can submit another survey
		  
		  
		}//end if
	}// end if
}// end isset
else
{
	//$errors = NULL;  //sets our survey errors to an array
	//var_dump($_POST);
	//print_r($_POST);
	//$email = "";
	//print 'THIS IS OUR EMAIL :' . $email . ':';
	//$email = $_POST['email'];
	
	//check for errors
	//Validate E-mail (Make sure it is not blank and a valid E-mail Address.)
	//if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
	//if(isset($email)) {
	//	$errors['email']= "PHP - Enter a valid email address";
	//}//end if
	//
	////Validate the Major checkboxes
	//if (empty($major)) {
	//	$errors['major']= "PHP - You must select at least one major.";
	//}//end if
	//
	////Validate the Grade Radio Buttons
	//if (empty($grade)) {
	//	$errors['grade']= "PHP - You must select a grade.";
	//}//end if
	//
	////Validate the Pizza Topping radio buttons.
	//if (empty($pizzaTopping)) {
	//	$errors['pizzaTopping']= "PHP - You must select a pizza topping.";
	//}//end if
	//echo '<script>alert(" '.implode("\\n", $errors).' "); </script>';
	//echo '<script>alert("Please fill out the form entirely"); </script>';
	print 	'<div class="content">
				<h2>Please fill out the form entirely</h2>'; 
				
		//display table if admin
		 

	print 	'<form class="formStyle" name="frmSurveyResults" id="surveyResults" method ="post" action="survey.php">
				<button type="submit" class="button" id="btnSubmit" name="btnSubmit">Search Again</button>	
			</form>
			</div>';
}	
print $page->getBottomSection();
?>