<?php

/* 	initialise post variables */ 

$firstName = $_POST['firstname'];
$familyName = $_POST['familyname'];
$email = $_POST['email'];
$phone = $_POST['phone'];

/* 	.... initialise database variables .... 
	these should be altered to suit match the server */

$uid = "root";
$pwd = "root";
$database = "act5";
$host = '127.0.0.1:3306';
$table1 = "players";
$table2 = "board_games";

/* create validation functions */

function checkName($name)
{
	return preg_match("/^[a-zA-Z]+$/", $name);
}

function checkEmail($mail)
{
	return preg_match("/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/", $mail);
}

function checkPhone($num)
{
	return preg_match("/^(0|(\+64(\s|-)?)){1}(\d{1}|(21|22|27|29){1})(\s|-)?\d{3}(\s|-)?\d{4}$/", $num);
}

/* create database functions */

function connect_db($host, $uid, $pwd, $database) {  	$conn=mysqli_connect($host, $uid, $pwd, $database)
	or die('connection problem:' . mysqli_connect_error());

 	return $conn;
 }
 
 /* Start validation. Server-side validation in case the data 
	gets corrupted during the POST method. */ 

/* 	check the "firstname" */
if ($firstName != null) {
	$result = checkName($firstName);
	if (!$result) {
		echo "first name not valid";
		exit;
	} else {	}
} else {
	echo "first name not received";
	exit;
}

/* 	check the "familyName" */
if ($familyName != null) {
	$result = checkName($familyName);
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

	Now we can post the data to the database. Once again,
	validation is important here, to check the connections are true. 
*/

/* 	connect to the database */
$conn = connect_db($host,$uid,$pwd,$database);

/* 	using the prepared statement method */

/* 	Create the prepared statement */
if ($stmt = $conn->prepare("INSERT INTO "."$table1"
					." ( _first_name, _family_name, _email, _phone) "
					."VALUES (?, ?, ?, ?)"))
					{
						/* Bind the params */
						$stmt->bind_param('ssss', $fName, $famName, $eMail, $phoneNum);
						
						/* Set the params */
						$fName = $_POST['firstname'];
						$famName = $_POST['familyname'];
						$eMail = $_POST['email'];
						$phoneNum = $_POST['phone'];
						
						/* Execute the prepared statement */
						$stmt->execute();
						
						/* Echo results */
						echo "Inserted {$fName} {$famName} into database\n";
						
						
						/* Close the statement */
						$stmt->close();
						header('Location: player_table.php');
					}
					else
					{
						/* Error */
						echo "Prepared Statement Error: %s\n". $conn->error;
					}
/* 	close the connection */
$conn->close();

?>