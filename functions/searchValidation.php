<?php
function validateDBSearch() {
	extract($_POST);
	
	//Validate Major (Make sure at least one major is selected in the checkbox array.)
	if (!isset($Search_Bar_Name)) {
			$errors['search'] = "PHP - You must enter a search term.";
	}//end if
}//end validateSurveyData
?> 