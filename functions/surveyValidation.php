<?php
function validateSurvey() {
	$errors = array();  //sets our survey errors to an array
	//check for errors
	//Validate E-mail (Make sure it is not blank and a valid E-mail Address.)
	if(($_POST['email'])=="") {
		$errors['email']= "PHP - E-mail Address is a required field.";
	}elseif(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
		$errors['email']= "PHP - Enter a valid email address";
	}//end if
	
	//Validate the Major checkboxes
	if (empty($_POST['major'])) {
		$errors['major']= "PHP - You must select at least one major.";
	}//end if
	
	//Validate the Grade Radio Buttons
	if (empty($_POST['grade'])) {
		$errors['grade']= "PHP - You must select a grade.";
	}//end if
	
	//Validate the Pizza Topping radio buttons.
	if (empty($_POST['pizzaTopping'])) {
		$errors['pizzaTopping']= "PHP - You must select a pizza topping.";
	}//end if
	
	return $errors;
}//end validateSurvey

?>