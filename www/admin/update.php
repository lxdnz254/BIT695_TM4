<?php

// get the posted variables

$id = $_GET['id'];
$firstname = $_POST['firstname'];
$famname = $_POST['familyname'];
$email = $_POST['email'];
$phone = $_POST['phone'];

include('connect.php');
  
// Connect to the database

$conn=connect_db($host,$uid,$pwd,$database);

// set validation code and perform validation

include('validate.php');

/* Start validation. Server-side validation in case the data 
	gets corrupted during the POST method. */ 

/* 	check the "firstname" */
if ($firstname != null) {
	$result = checkName($firstname);
	if (!$result) {
		echo "first name not valid";
		exit;
	} else {	}
} else {
	echo "first name not received";
	exit;
}

/* 	check the "familyName" */
if ($famname != null) {
	$result = checkName($famname);
	if (!$result) {
		echo "family name not valid.";
		exit;
	} else {	}
} else {
	echo "family name not recieved";
	exit;
}

/* 	check email address */
if ($email != null ) {
	$result = checkEmail($email);
	if (!$result) {
		echo "email address is invalid!!";
		exit;
	} else {	}
} else {
	echo "email not received!";
	exit;
}

/* 	check phone number */
if ($phone != null) {
	if (!checkPhone($phone)) {
		echo "phone number is invalid!!";
		exit;
	} else {	}
} else {
	echo "phone number not received!";
	exit;
}

/* 	End of data validation.
	If the program reaches here, the POST data is valid. 
	*/

// perform the update and return to table if OK
		
/* 	using the prepared statement method */

/* 	Create the prepared statement */
if ($stmt = $conn->prepare("UPDATE "."$table1"
					." SET _first_name=?, _family_name=?, _email=?, _phone=? WHERE _memberID=?"))
					{
						/* Bind the params */
						$stmt->bind_param('ssssi', $fName, $famName, $eMail, $phoneNum, $id);
						
						/* Set the params */
						$fName = $_POST['firstname'];
						$famName = $_POST['familyname'];
						$eMail = $_POST['email'];
						$phoneNum = $_POST['phone'];
						$id = $_GET['id'];
						
						/* Execute the prepared statement */
						$stmt->execute();
						
						/* Echo results */
						echo "Updated {$fName} {$famName} succesfully\n";
						
						
						/* Close the statement */
						$stmt->close();
						header('Location: player_table.php');
					}
					else
					{
						/* Error */
						echo "Update Prepared Statement Error: %s\n". $conn->error;
					}
/* 	close the connection */
$conn->close();
		
?>