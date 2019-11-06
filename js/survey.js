function validateForm() 
{
	let hasEmail = false;
	let hasMajor = false;
	let hasLetterGrade = false;
	let hasPizzaTopping = false;
	
	//email validation
	let email = document.forms["survey"]["email"].value;
    if (email == "") {
        alert("JS - Email must be filled out");
    } else {
        hasEmail = true;
    }
	
	//major validation
	var checked = 0;
    //Create an Array.
    var selected = new Array();
 
    //Reference the checkbox form div.
    var Majors = document.getElementById("Majors");
 
    //Reference all the CheckBoxes in the div.
    var chks = Majors.getElementsByTagName("INPUT");
 
    // Loop and push the checked CheckBox value in Array.
    for (var i = 0; i < chks.length; i++) {
        if (chks[i].checked) {
            hasMajor = true;
        }//endif
    }//endfor
	if (hasMajor == false) {
		alert("JS - You must declare a major");
	}//endif
	
	//grade validation
    let grade = document.forms["survey"]["grade"];
    for (let i = 0; i < grade.length; i++) {
        if (grade[i].checked) {
            hasLetterGrade = true;
        }
    }
    if (hasLetterGrade == false) {
        alert("JS - What grade do you expect to get?");
    }
	
	//pizza topping validation
    let pizza = document.forms["survey"]["pizzaTopping"];
    for (let i = 0; i < pizza.length; i++) {
        if (pizza[i].checked) {
            hasPizzaTopping = true;
        }
    }
    if (hasPizzaTopping == false) {
        alert("JS - What your favorite pizza topping is of upmost importance!");
    }
}