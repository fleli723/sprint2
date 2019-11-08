<?php
function validateDBSearch() {
	extract($_POST);
	$errors= array();	 //All the error messages in an Array
	
	//Validate Major (Make sure at least one major is selected in the checkbox array.)
	if (!isset($Search_Bar_Name)) {
			$errors['search'] = "PHP - You must enter a search term.";
	}//end if
	return $errors; //Returns the PHP Validation Errors array to the calling class
}//end validateSurveyData
?> 