
//var $ = function(id) {	return document.getElementById(id);	}//end $	
window.onload = function() {	
	///$("txtSearchBar").focus();//Gives the search field the FOCUS on load			 
}//end window.onload
 
/*validateSearch will validate the search bar */
function validateSearch() {
	
	let userSearch = document.forms["userSearchBarForm2"]["SearchBarName"].value;	
	var ptr = $("txtSearchBar");
	if (userSearch == "" || userSearch == null || ptr.value =="")   {
		
		document.getElementById("searchError").innerHTML ="<b style='color: red'></b>";
		
		//alert("its empty");
		event.preventDefault();
		return false;		
	}
	else if(ptr.value == " "){
		document.getElementById("searchError").innerHTML ="<b style='color: red'>Empty 2</b>";
		
		alert("its empty 2");		
	}	
	else
	{
		event.preventDefault();
		//alert("the else");
		document.getElementById("searchError").innerHTML ="<b style='color: red'>Empty </b>";
		//return true;
		return false;
	}//end if 	
}//end validateSearch

/*validateForm will call the validateSearch and the noShortCircuitAnd functions when 
the user clicks the submit button */
function validateForm() {	 
	if (noShortCircuitAnd (
			validateSearch())) {  
		return true;   //Go ahead and submit form
	}else {
		
		event.preventDefault();
		alert("the else");
		
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
	
	
