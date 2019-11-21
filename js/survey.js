function validateForm() 
{
	let hasEmail = false;
	let hasMajor = false;
	let hasLetterGrade = false;
	let hasPizzaTopping = false;
	
	//email validation
	let email = document.forms["survey"]["email"].value;
    if (email == "") {
       //alert("JS - Email must be filled out");
	   document.getElementById("emailError").innerHTML ="<b style='color: red'></b>";
	   document.getElementById("emailError").innerHTML ="<b style='color: red'>This is a required field</b>";
	   //return false;
	   event.preventDefault();
    } else {
        hasEmail = true;
		document.getElementById("emailError").innerHTML ="<b style='color: red'></b>";

    }	
 
    
 
    //Reference all the CheckBoxes in the div.
    var checkBoxes = document.getElementById("Majors").getElementsByTagName("INPUT");
 
    // Loop and push the checked CheckBox value in Array.
    for (var i = 0; i < checkBoxes.length; i++) {
        if (checkBoxes[i].checked) {
            hasMajor = true;
			document.getElementById("checkBoxError").innerHTML ="<b style='color: red'></b>";
        }//endif
    }//endfor
	if (hasMajor == false) {
		
		document.getElementById("checkBoxError").innerHTML ="<b style='color: red'></b>";

		document.getElementById("checkBoxError").innerHTML ="<b style='color: red'>This is a required field</b>";
		event.preventDefault();
		//alert("JS - You must declare a major");
	}//endif
	
	//grade validation
    let grade = document.forms["survey"]["grade"];
    for (let i = 0; i < grade.length; i++) {
        if (grade[i].checked) {
            hasLetterGrade = true;
			document.getElementById("gradeError").innerHTML ="<b style='color: red'></b>";
        }
    }
    if (hasLetterGrade == false) {
        
		document.getElementById("gradeError").innerHTML ="<b style='color: red'></b>";
		document.getElementById("gradeError").innerHTML ="<b style='color: red'>This is a required field</b>";
		event.preventDefault();		
    }
	
	//pizza topping validation
    let pizza = document.forms["survey"]["pizzaTopping"];
    for (let i = 0; i < pizza.length; i++) {
        if (pizza[i].checked) {
            hasPizzaTopping = true;
			document.getElementById("pizzaError").innerHTML ="<b style='color: red'></b>";
        }
    }
    if (hasPizzaTopping == false) {
        
		document.getElementById("pizzaError").innerHTML ="<b style='color: red'></b>";

		document.getElementById("pizzaError").innerHTML ="<b style='color: red'>This is a required field</b>";

		event.preventDefault();
		
    }
	
}
