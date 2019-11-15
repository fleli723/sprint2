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
		$userNameInput = $_POST['usernameInput'];
		$passWordInput = $_POST['passwordInput'];
		
		$con = new DB();
		if (!$con->getConnStatus()) {
			print "\n\nAn error has occurred with connection\n";
			print $page->getBottomSection();
			exit;
		}else{
			$safeUserName = $con->dbEsc($userNameInput);
			$safePassword = $con->dbEsc($passWordInput);			
			$query = "Select username, userpass, realname, userstatus from users where username = '{$safeUserName}'";			
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
	}else{
		$_SESSION['userNameError'] = true;
		$_SESSION['passwordError'] = true;
		header('Location: index.php');
	}//end ifset

?>