
function checkForm(form)
	{
		re = /^[a-zA-Z]+$/;
		
		// test the first_name
		if(form.first_name.value == "") {
			
			alert("Error: First name cannot be blank!");
			form.first_name.focus();
			return false;
		}
		
		if(!form.first_name.value.match(re)) {
				alert("Error: First name must contain only letters!");
				form.first_name.focus();
				return false;
			} 
		
		// test the family_name
		if(form.family_name.value == "") {
			
		  alert("Error: Family name cannot be blank!");
		  form.family_name.focus();
		  return false;
		}
		
		if(!form.family_name.value.match(re)) {
				alert("Error: Family name must contain only letters!");
				form.family_name.focus();
				return false;
			}
		
		
		// test the email address
		if(form.e_mail.value != "") {
			if(!checkEmail(form.e_mail.value)) {
				alert("The email you have entered is not valid!");
				form.e_mail.focus();
				return false;
			}
		} else {
			alert("Error: Please enter an email address!");
			form.e_mail.focus();
			return false;
		}
		
		//test the phone number
		if(form.phone_num.value != "") {
			if(!checkPhone(form.phone_num.value)) {
				alert("The phone number you have entered is not valid!");
				form.phone_num.focus();
				return false;
			}
		} else {
			alert("Error: Please enter a phone number!");
			form.phone_num.focus();
			return false;
		}
		
		// test the board game field
		if(form.board_game.value == "") {
			 alert("Error: Board Games must be filled out!");
			 form.board_game.focus();
			 return false;
		}
		
		if(!form.board_game.value.match(re)) {
			alert("Error: Board Game field must contain letters only!");
			form.board_game.focus();
			return false;
		}
		
	/*	
		// Save this for later if we need password validation
		
		if(form.pwd1.value != "" && form.pwd1.value == form.pwd2.value) {
		  if(!checkPassword(form.pwd1.value)) {
			alert("The password you have entered is not valid!");
			form.pwd1.focus();
			return false;
		  }
		} else {
		  alert("Error: Please check that you've entered and confirmed your password!");
		  form.pwd1.focus();
		  return false;
	   
		}
	*/
		return true;
	}
	
function checkPassword(str)
	{
		/* 
		This RegExp expects minimum of 6 characters, at least one number, one uppercase letter
		and one lowercase letter.
		*/
		var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{6,}$/;
		return re.test(str);
	}
  
function checkEmail(str)
	{
		/* 
		RegExp for email This expression matches email addresses, and checks that
		they are of the proper form. It checks to ensure the top level domain is 
		between 2 and 4 characters long, but does not check the specific domain against a list
		*/
		  var re = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
		  return re.test(str);
	}
  
function checkPhone(str)
	{
		/*
		RegExp for NZ phones. the expression matches +64 7 123 1234, 07-123-1234, 
		071231234 or NZ mobile numbers  021, 022, 027, 029 instead of the area code.
		*/
		
		var re = /^(0|(\+64(\s|-)?)){1}(\d{1}|(21|22|27|29){1})(\s|-)?\d{3}(\s|-)?\d{4}$/;
		return re.test(str);
	}
	
	