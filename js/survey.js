
function validateForm() 
{
	
	
	let hasEmail = false;
	let hasMajor = false;
	let hasLetterGrade = false;
	let hasPizzaTopping = false;
	
	//email validation
	let email = document.forms["survey"]["email"].value;
    if (email == "") {
		document.getElementById("errorEmail").innerHTML ="<b style='color: red'>This is a required field</b>";	
		
    } else {
		document.getElementById("errorEmail").innerHTML ="<b style='color: red'></b>";
        hasEmail = true;
    }
	
	//major validation
	var checked = 0;    
 
    //Reference the checkbox form div.
    var Majors = document.getElementById("Majors");
 
    //Reference all the CheckBoxes in the div.
    var chks = Majors.getElementsByTagName("INPUT");
 
    // Loop and push the checked CheckBox value in Array.
    for (var i = 0; i < chks.length; i++) {
        if (chks[i].checked) {
            hasMajor = true;
			document.getElementById("errorMajors").innerHTML ="<b style='color: red'></b>";
        }//endif
    }//endfor
	if (hasMajor == false) 
	{
		//document.getElementById("errorMajors").innerHTML ="<b style='color: red'></b>";
		document.getElementById("errorMajors").innerHTML ="<b style='color: red'>Select a Major</b>";			
		
	}//endif
	
	//grade validation
    let grade = document.forms["survey"]["grade"];
    for (let i = 0; i < grade.length; i++) {
        if (grade[i].checked) {
            hasLetterGrade = true;
			document.getElementById("errorGrade").innerHTML ="<b style='color: red'></b>";
        }
    }
    if (hasLetterGrade == false) {
		
		document.getElementById("errorGrade").innerHTML ="<b style='color: red'>This is a required field</b>";		
		
        //alert("JS - What grade do you expect to get?");
    }
	
	//pizza topping validation
    let pizza = document.forms["survey"]["pizzaTopping"];
    for (let i = 0; i < pizza.length; i++) {
        if (pizza[i].checked) {
            hasPizzaTopping = true;
			document.getElementById("errorPizza").innerHTML ="<b style='color: red'></b>";
        }
    }
    if (hasPizzaTopping == false) {
		document.getElementById("errorPizza").innerHTML ="<b style='color: red'>What your favorite pizza topping is of upmost importance!</b>";		
		
        
    }
	if((hasEmail && hasMajor)== false || (hasLetterGrade && hasPizzaTopping) == false)
	{
		return false;
	}
	
}
