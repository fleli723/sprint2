var $ = function(id) {	return document.getElementById(id);	}//end $	
window.onload = function() {	
	$("txtSearchBar").focus();//Gives the search field the FOCUS on load			 
}//end window.onload
 
/*validateSearch will validate the search bar */
function validateSearch() {	   
	var ptr = $("txtSearchBar");
	if (ptr.value == "")   {
		alert("Entry cannot be empty");		
	}
	else if(ptr.value == " "){
		alert("Entry only contained a space");		
	}	
	else
	{
		return true;
	}//end if 	
}//end validateSearch

/*validateForm will call the validateSearch and the noShortCircuitAnd functions when 
the user clicks the submit button */
function validateForm() {	 
	if (noShortCircuitAnd (
			validateSearch())) {  
		return true;   //Go ahead and submit form
	}else {
		//alert("Please correct the designated errors and submit again.");
		event.preventDefault();
		
		return false;  //Cancel the form submit
	}//end if
}

function noShortCircuitAnd() {
	var result = true;		//The function returns True if all the conditions are true, but does not short-circuit
							//(quit when false is found).
	
		for (var i=0; i<arguments.length; i++)
			result = result && arguments[i];	
			//go through each argument and AND it with the previous
		return result;
}//end noShortCircuitAnd
	
	