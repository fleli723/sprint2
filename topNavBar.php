<?php
print 	'<div class="topbar"> 
			<div class ="login">
				<h1> CNMT 310 Sprint 2 Assignment</h1> ';
			
//SWITCH MODE TO SESSION
$mode = 2;

//print login
if ($mode ==1) 
{
	print  '<form name="userSearchBarForm" class = "login" action="searchResult.php"  method="post">
				<input type="text" class = "loginText" id="username" name="usernameInput" placeholder="Username">
				<input type="password" class = "loginText" id="password" name="passwordInput" placeholder="Password">
				<input class="buttonLog" type="submit" value="Login" id="BtnSubmit">
			</form>
			</div>';	
}

if ($mode == 2) 
{
	print	'<form name="userSearchBarForm" action="index.php"  method="post">
					<span>Welcome, ' . $mode . ' </span>
					<input class="buttonLog" type="submit" value="Logout" id="BtnSubmit">
				</form>
			</div>';	
}

//print logout					
					
print		'<ul class="nav">
				<li><a href="index.php">Home</a></li>		
				<li><a href="survey.php">Survey</a></li>
				<li><a href="privacy.php">Privacy Policy</a></li>
				<li><a href="search.php">Search</a></li>';




						
print		'</ul>
		</div>';
?>