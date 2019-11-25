<?php
session_start();
require_once("classes/Template.php");
$page = new Template("Search Page");
//$page->addHeadElement('<script src="js/search.js"></script>');
$page->addHeadElement('<link rel="stylesheet" type="text/css" href="css/stylesheet.css">');
$page->finalizeTopSection();
$page->finalizeBottomSection();
print $page->getTopSection();
include("topNavBar.php");
print	'
<div class="content">
	<form name="userSearchBarForm" action="searchResult.php"  method="post">
		<div class="formboxes">
			<span>Search: </span><br><br>
			<input type="text" id="txtSearchBar" name="SearchBarName" placeholder="Title or Artist Name..."><br>
		</div><br>	
		<span id="searchError"</span>
		<input class="button" type="submit" value="Submit" id="BtnSubmit" onclick="validateSearch()" >
	</form>
</div>';
print $page->getBottomSection();
?>
