<?php
/****************************************************************
* This class is used to connect to the db and evaluate user 
Credentials											            *
* @author Tim, Filip and Corbin                                 * 
* @FileName: loginResult.php                                  *
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
include("topNavBar.php");

	if(isset($_POST['usernameInput']) && $_POST['usernameInput'] != "" && $_POST['passwordInput'] && isset($_POST['passwordInput']) != "")
	{
		$userNameInput = $_POST['usernameInput'];
		$passwordInput = $_POST['passwordInput'];
		
		$con = new DB();
		
		if (!$con->getConnStatus()) 
		{
			print "\n\nAn error has occurred with connection\n";
			print $page->getBottomSection();
			exit;
		}else{
			
			$safeName = $con->dbEsc($userNameInput);
			$safePassword = $con->dbEsc($passwordInput);			
			$query = "Select username, userpass, realname, userstatus from user where username = '{$safeName}'";			
			$result = $con->dbCall($query);			
			if (!$result) {
				print '<div class="content">
				<h2>Credentials are incorrect</h2></div>';
			}
			else //if its good
			{
				foreach ($result as $row) {			
					
					if(password_verify($safePassword,$row['userpass'])) {
						$_SESSION['realname'] = $row['realname'];
						$_SESSION['userId'] = $row['id'];				
						header('Location: index.php');				
					}//end if
					else{
						print '<div class="content">
						<h2>Credentials are incorrect</h2></div>';
					}//end if					 
				}//endforeach				
			}//end if			
		}//end if con
	}
	else{
		print '<div class="content">
		<h2>Credentials are incorrect</h2></div>';
	}//end ifset
	
	
	
print $page->getBottomSection();
		
		
	
?>