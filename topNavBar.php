<?php
print 	'<div class="topbar"> 
			<div class ="login">
				<h1> CNMT 310 Sprint 2 Assignment</h1>';
if(!isset($_SESSION['userstatus'])) {
	if(isset($_SESSION['passwordError'])) {
		$loginError = "Invalid Password";
	}//endif
	if(isset($_SESSION['userNameError'])) {
		$loginError = "User not found";
	}//endif
	//Show the Login Form
	print 	'<form name="userSearchBarForm" class = "login" action="loginResult.php"  method="post">
				<input type="text" class = "loginText" id="username" name="usernameInput" value= "'; /*echo $loginError;*/ print '" placeholder="Username">
				<input type="password" class = "loginText" id="password" name="passwordInput" placeholder="Password">
				<input class="buttonLog" type="submit" value="Login" id="BtnSubmit">
			</form>
			</div>
			<ul class="nav">
				<li><a href="index.php">Home</a></li>		
				<li><a href="privacy.php">Privacy Policy</a></li>
				<li><a href="search.php">Search</a></li>
				<li><a href="survey.php">Survey</a></li>
			</ul>';		
}else{
	//Show the Log out form
	print 	'<form name="userSearchBarForm" action="logout.php"  method="post">
				<span>Welcome ' . $_SESSION['realname'] . ' </span>&nbsp;&nbsp;
				<input class="buttonLog" type="submit" value="Logout" id="BtnSubmit">
			</form>
			</div>
			<ul class="nav">
				<li><a href="index.php">Home</a></li>
				<li><a href="privacy.php">Privacy Policy</a></li>
				<li><a href="search.php">Search</a></li>
				<li><a href="survey.php">Survey</a></li>';
				//If user isAdmin, show the Survey list menu item
				if(($_SESSION['userstatus']) === "A") {
					print '<li><a href="surveyList.php">Survey Results</a></li>';
				}//end if
			print '</ul>';			
}//endif
print '</div>';
?>
