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

	$data = array("search" => $email,$major,$grade,$pizzaTopping);
	

	//web services
	$dataJson = json_encode($data);
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

	
		//if (!$result) {
		//	print 'There was an Error processing your survey<br>Please contact the Website Admin';
		//}
		//else
		//{
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
				
		  //$result = false;//Reset result when done with it to prevent interfering with later calls.
		  //unset($_POST); //removes the values of $_POST so the user can submit another survey
		  
		  
		//}//end if
	//}// end if
}// end isset
else
{

	print 	'<div class="content">
				<h2>Please fill out the form entirely</h2>'; 

	print 	'<form class="formStyle" name="frmSurveyResults" id="surveyResults" method ="post" action="survey.php">
				<button type="submit" class="button" id="btnSubmit" name="btnSubmit">Search Again</button>	
			</form>
			</div>';
}	
print $page->getBottomSection();
?>