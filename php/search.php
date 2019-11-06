<?php
 
require_once("../classes/Template.php");
require_once("../classes/searchValidation.php");

$page = new Template("Search Page");
$page->addHeadElement('<script src="../js/search.js"></script>');
$page->addHeadElement('<link rel="stylesheet" type="text/css" href="../css/stylesheet.css">');
$page->finalizeTopSection();
$page->finalizeBottomSection();

print $page->getTopSection();

include("topNavBar.php");

print	'
<div class="content">
	<form name="userSearchBarForm" action="searchResult.php"  method="post">
	
		<div class="formboxes">
			<span>Search: </span><br><br>
			<input type="text" id="txtSearchBar" name="Search_Bar_Name" placeholder="Title or Artist Name...">
			<br>
		</div>
			
		<br>	
		<input class="button" type="submit" value="Submit" id="BtnSubmit" onclick="validateForm()" >
		
	</form>
</div>	
';

print $page->getBottomSection();

?>