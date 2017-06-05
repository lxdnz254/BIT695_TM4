<?php

/* Will execute the appropriate add loop depending on the $_GET post. */

/* database function */
 
 include('connect.php');

/* validation functions */

include('validate.php');

/* Add a player */
 
if (isset($_GET['player'])) {
/* 	check post received  and initialise post variables */ 
/* Start validation. Server-side validation in case the data 
	gets corrupted during the POST method. */ 

if (isset($_POST['firstname'])) {
	
	$firstName = $_POST['firstname'];
	
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
} else {
	echo "First name not posted"; 
	exit;
	}

if (isset($_POST['familyname'])) {
	$familyName = $_POST['familyname'];
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
} else {
	echo "Family name not posted"; 
	exit;
	}

if (isset($_POST['email'])) {
	$email = $_POST['email'];
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
} else {
	echo 'Email not posted'; exit;}

if (isset($_POST['phone'])) {
	$phone = $_POST['phone'];
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
} else {echo 'Phone not posted'; exit;}
 
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
						$fName = $firstName;
						$famName = $familyName;
						$eMail = $email;
						$phoneNum = $phone;
						
						/* Execute the prepared statement */
						$stmt->execute();
						
						/* Echo results */
						echo "Inserted {$fName} {$famName} into database\n";
								
						/* Close the statement */
						$stmt->close();
						header('Location: tables.php?player');
					}
					else
					{
						/* Error */
						echo "Prepared Statement Error: %s\n". $conn->error;
					}
/* 	close the connection */
$conn->close();
}

/* Add a game */
if (isset($_GET['games'])) {
	/* validate posted variables and perform the sql insert */
	if (isset($_POST['boardgame'])) {
		$boardGame = $_POST['boardgame'];
	/* 	check the "boardGame" */
	if ($boardGame != null) {
		$result = checkGame($boardGame);
		if (!$result) {
			echo "board game not valid.";
			exit;
		} else {	}
	} else {
		echo "board game not recieved";
		exit;
	}
} else {
	echo "board game not posted"; 
	exit;
	}
	
	// only posts the ID of the owner
	if (isset($_POST['owner'])) {
		$ownerID = $_POST['owner'];
		if ($ownerID == null) {
			echo "Owner ID not received!";
			exit;
		}
	} else {echo "owner not posted"; exit;}
	
	// only receives the checkbox result if is checked, otherwise no post happens
	if (isset($_POST['playing']) && $_POST['playing'] == "0") {
		$playing = true;
	} else {$playing = false; }
	
	// recieves the maximum player value
		if (isset($_POST['max_players'])) {
			$maxPlayer = $_POST['max_players'];
			if ($maxPlayer == null) {
				echo "Max players not received!";
			exit;
			}
		} else {echo "max players not posted"; exit;}
			
	// validation done for new game. ready to INSERT into database.
	
// Connect to the database
$conn = connect_db($host,$uid,$pwd,$database);

/* prepare statement */
if ($stmt = $conn->prepare("INSERT INTO "."$table2"
							." ( _boardgame, _ownerID, _playing, _number_of_players) "
							."VALUES (?, ?, ?, ?)"))
							{
								/* Bind the params */
								$stmt->bind_param("siii", $bGame, $ownID, $isPlay, $numPlay);
								
								$bGame = $boardGame;
								$ownID = $ownerID;
								$isPlay = $playing;
								$numPlay = $maxPlayer;
								
								/* execute the statement */
								$stmt->execute();
								
								/*Close the statement */
								$stmt->close();
								header('Location: tables.php?games');
							}
							else 
							{
								echo "Prepared Statement error: %s\n". $conn->error;
							}
/* close the connection */
$conn->close();
									
}

/* Add an event */
if (isset($_GET['event'])) {
	
}

/* Assign a player to game */
if (isset($_GET['assign'])) {
	
}

/* Add score to table */
if (isset($_GET['score'])) {
	
}

?>