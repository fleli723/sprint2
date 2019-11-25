<?php
/****************************************************************
* This class is used to connect to the db and evaluate user     *
Credentials											            *
* @author Tim, Filip and Corbin                                 * 
* @FileName: loginResult.php                                    *
*                                                               *

*                                                               *
****************************************************************/
session_destroy;
session_start();

require_once("classes/DB.class.php");
	if(isset($_POST['usernameInput']) && ($_POST['passwordInput'])){
		
		
		
		
		$dataJson = json_encode($_POST['usernameInput']);
		$contentLength = strlen($dataJson);
		
		
		
		
		
		$header = array(
		'Content-Type: application/json',
        'Accept: application/json',
		'Content-Length: ' . $contentLength
	);
	$url = "http://cnmtsrv2.uwsp.edu/~cvida526/sprint2/loginProcessing.php";
	
	
		
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
		if (property_exists($resultObject,"result")) {
				print "works";
		}

		if (property_exists($resultObject->result,"ErrorMessage")) 
		{ 
			print '<h2>' .  $resultObject->result->ErrorMessage . ' </h2>';
		}
		
		
		
	////////////////////////////////////////////////////////////////////////
		
		
		
		//if (!$con->getConnStatus()) {
			//print "\n\nAn error has occurred with connection\n";
			//print $page->getBottomSection();
			//exit;
		else{
			$safeUserName = $con->dbEsc($userNameInput);
			$safePassword = $con->dbEsc($passWordInput);			
			$query = "Select username, userpass, realname, userstatus from user where username = '{$safeUserName}'";			
			$result = $con->dbCall($query);				
			if (!$result) {
				$_SESSION['userNameError'] = true;
				header('Location: index.php');
			}else{
				foreach ($result as $row) {			
					if(password_verify($safePassword,$row['userpass'])) {
						$_SESSION['realname'] = $row['realname'];
						$_SESSION['userId'] = $row['id'];
						$_SESSION['username'] = $row['username'];
						$_SESSION['userstatus'] = $row['userstatus'];
						header('Location: index.php');				
					}//end if
					else{
						$_SESSION['passwordError'] = true;
						header('Location: index.php');
					}//end if					 
				}//endforeach				
			}//end if			
		}//end if con
	//end ifset

?>