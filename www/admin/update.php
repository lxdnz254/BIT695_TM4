<?php


include('validate.php');
include('connect.php');


	
/* Update a player */
if (isset($_GET['player'])) {
	
/* 	check post received  and initialise post variables */ 
/* Start validation. Server-side validation in case the data 
	gets corrupted during the POST method. */ 
	if (isset($_GET['id'])) {
		$mID = $_GET['id'];
	}else {
		echo "GET member ID not received";
		exit;
	}

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
if ($stmt = $conn->prepare("UPDATE "."$table1"
					." SET _first_name=?, _family_name=?, _email=?, _phone=? WHERE _memberID=?"))
					{
						/* Bind the params */
						$stmt->bind_param('ssssi', $fName, $famName, $eMail, $phoneNum, $id);
						
						/* Set the params */
						$fName = $firstName;
						$famName = $familyName;
						$eMail = $email;
						$phoneNum = $phone;
						$id = $mID;
						
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

/* Update a game */
if (isset($_GET['game'])) {
	
	/*validate GET variable */
	if (isset($_GET['id'])) {
		$gID = $_GET['id'];
	}
	else{
		echo "GET GameID not received";
		exit;
	}
	
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
	
	// receives the maximum player value
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
if ($stmt = $conn->prepare("UPDATE "."$table2"
							." SET _boardgame=?, _ownerID=?, _playing=?, _number_of_players=?"
							." WHERE _boardgameID=?"))
							{
								/* Bind the params */
								$stmt->bind_param("siiii", $bGame, $ownID, $isPlay, $numPlay, $id);
								
								$bGame = $boardGame;
								$ownID = $ownerID;
								$isPlay = $playing;
								$numPlay = $maxPlayer;
								$id = $gID;
								
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

/* Update an event */
if (isset($_GET['event'])) {
	
	/* validate the GET variables */
	if (isset($_GET['id'])) {
		$eID = $_GET['id'];
	}
	else {
		echo "Event ID not received.";
		exit;
	}
	
/* validate posted variables and perform the sql insert */
	
	/* check the boardgame value */
	if (isset($_POST['boardgame'])) {
		$boardGame = $_POST['boardgame'];
	/* 	check the "boardGame" */
	if ($boardGame != null) {
		$result = is_numeric($boardGame);
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
	
	/* check the eventname */
	if (isset($_POST['eventname'])) {
		$eventName = $_POST['eventname'];
	/* 	check the "venueName" */
	if ($eventName != null) {
		$result = checkGame($eventName);
		if (!$result) {
			echo "Event name not valid.";
			exit;
		} else {	}
	} else {
		echo "Event name not received";
		exit;
	}
} else {
	echo "Event name not posted"; 
	exit;
	}
	
	/* check the venuename */
	if (isset($_POST['venuename'])) {
		$venueName = $_POST['venuename'];
	/* 	check the "venueName" */
	if ($venueName != null) {
		$result = checkGame($venueName);
		if (!$result) {
			echo "Venue name not valid.";
			exit;
		} else {	}
	} else {
		echo "Venue name not received";
		exit;
	}
} else {
	echo "Venue name not posted"; 
	exit;
	}
	
	/* check the Start date */
	if (isset($_POST['dstart'])) {
		$dateStart = $_POST['dstart'];
	/* 	check the "dateStart" */
	if ($dateStart != null) {
		$result = validateDate($dateStart);
		if (!$result) {
			echo "Start date not valid.";
			exit;
		} else {	}
	} else {
		echo "Start date not received";
		exit;
	}
} else {
	echo "Start date not posted"; 
	exit;
	}
	
	/* check the Finish date */
	if (isset($_POST['dfinish'])) {
		$dateFinish = $_POST['dfinish'];
	/* 	check the "dateFinish" */
	if ($dateFinish != null) {
		$result = validateDate($dateFinish);
		if (!$result) {
			echo "Finish date not valid.";
			exit;
		} else {	}
	} else {
		echo "Finish date not received";
		exit;
	}
} else {
	echo "Start date not posted"; 
	exit;
	}
	
	/* check the Start time */
	if (isset($_POST['tstart'])) {
		$timeStart = $_POST['tstart'];
	/* 	check the "timeStart" */
	if ($timeStart != null) {
		$timeStartCheck = date("H:i:s", strtotime($timeStart));
		$result = validateTime($timeStartCheck);
		if (!$result) {
			echo "Start time not valid.";
			exit;
		} else {$timeStart = $timeStartCheck;	}
	} else {
		echo "Start time not received";
		exit;
	}
} else {
	echo "Start time not posted"; 
	exit;
	}
	
	/* check the Finish time */
	if (isset($_POST['tfinish'])) {
		$timeFinish = $_POST['tfinish'];
	/* 	check the "timeFinish" */
	if ($timeFinish != null) {
		$timeFinishCheck = date("H:i:s", strtotime($timeFinish));
		$result = validateTime($timeFinishCheck);
		if (!$result) {
			echo "Finish time not valid.";
			exit;
		} else {$timeFinish = $timeFinishCheck;	}
	} else {
		echo "Finish time not received";
		exit;
	}
} else {
	echo "Finish time not posted"; 
	exit;
	}
	
	/* check the registered players
	- if number not received then set as null */
	if (isset($_POST['reg_players'])) {
		$regPlayers = $_POST['reg_players'];
	/* check the "regPlayers" */
	if ($regPlayers != null) {
		$result = is_numeric($regPlayers);
		if (!$result) {
			echo "Registered players number not valid.";
			exit;
		} else {	}
	} else {
		$regPlayers = null;
	}
} else {
	$regPlayers = null;
	}
	/* Validation complete */

// Connect to the database
$conn = connect_db($host,$uid,$pwd,$database);

/* prepare statement */
if ($stmt = $conn->prepare("UPDATE "."$table4"
							." SET _event_name=?, _venue=?, _date_start=?, _date_finish=?,
								_time_start=?, _time_finish=?, _boardgameID=?, _registered_players=?"
							." WHERE _eventID=?"))
							{
								/* Bind the params */
								$stmt->bind_param("ssssssiii", $event, $venue, $dSt, $dFn,
													$tSt, $tFn, $bID, $reg, $id);
								
								$event = $eventName;
								$venue = $venueName;
								$dSt = $dateStart;
								$dFn = $dateFinish;
								$tSt = $timeStart;
								$tFn = $timeFinish;
								$bID = $boardGame;
								$reg = $regPlayers;
								$id = $eID;
								
								/* execute the statement */
								$stmt->execute();
								
								/*Close the statement */
								$stmt->close();
								header('Location: tables.php?schedule');
							}
							else 
							{
								echo "Prepared Statement error: %s\n". $conn->error;
							}
/* close the connection */
$conn->close();	
	
}

/* Update an Assigned player to a game */
if (isset($_GET['assign'])) {
	
	if (isset($_GET['eid'])) {
		$eID = $_GET['eid'];
	}
	else {
		echo "GET eID not received";
		exit;
	}
	
	if (isset($_GET['mid'])) {
		$mID = $_GET['mid'];
	}
	else {
		echo "GET mID not received";
		exit;
	}
	
	/* validate posted variables and perform the sql insert */
	
	/* check the event value */
	if (isset($_POST['event'])) {
		$eventID = $_POST['event'];
	/* 	check the "eventID" */
	if ($eventID != null) {
		$result = is_numeric($eventID);
		if (!$result) {
			echo "eventID not valid.";
			exit;
		} else {	}
	} else {
		echo "eventID not received";
		exit;
	}
} else {
	echo "eventID not posted"; 
	exit;
	}
	
	/* check the member value */
	if (isset($_POST['member'])) {
		$memberID = $_POST['member'];
	/* 	check the "memberID" */
	if ($memberID != null) {
		$result = is_numeric($memberID);
		if (!$result) {
			echo "memberID not valid.";
			exit;
		} else {	}
	} else {
		echo "memberID not received";
		exit;
	}
} else {
	echo "memberID not posted"; 
	exit;
	}
	
	/* check the notes .. remove possiblity of SQL injection before validation */
	if (isset($_POST['notes'])) {
		$notes = htmlspecialchars($_POST['notes']);
	/* 	check the "venueName" */
	if ($notes != null || $notes != "") {
		$result = checkNotes($notes);
		if (!$result) {
			echo "Notes not valid.";
			exit;
		} else {	}
	} else {
		// not essential sql input so can avoid error here.
		$notes = null;
	}
} else {
	// not essential sql input so can avoid error here.
	$notes = null;
	}
	
	/* check the position
	- if number not received then set as null */
	if (isset($_POST['position'])) {
		$position = $_POST['position'];
	/* check the "position" */
	if ($position != null) {
		$result = is_numeric($position);
		if (!$result) {
			echo "Position number not valid.";
			exit;
		} else {	}
	} else {
		// not essential for sql input, so can avoid error here.
		$postion = null;
	}
} else {
	// not essential for sql input, so can avoid error here.
	$postion = null;
	}
	
	/* check the date */
	if (isset($_POST['date'])) {
		$date = $_POST['date'];
	/* 	check the "date" */
	if ($date != null) {
		$result = validateDate($date);
		if (!$result) {
			echo "Date not valid.";
			exit;
		} else {	}
	} else {
		echo "Date not received";
		exit;
	}
} else {
	echo "Date not posted"; 
	exit;
	}
	
	/* Validation complete, Insert the data */
	
// Connect to the database
$conn = connect_db($host,$uid,$pwd,$database);

/* prepare statement */
if ($stmt = $conn->prepare("UPDATE "."$table3"
							." SET _eventID=?, _memberID=?, _position=?, _notes=?, _date=?"
							." WHERE _eventID=? AND _memberID=?"))
							{
								/* Bind the params */
								$stmt->bind_param("iiissii", $event, $member, $pos, $n, $dt, $id1, $id2);
										
								$event = $eventID;
								$member = $memberID;
								$pos = $position;
								$n = $notes;
								$dt = $date;
								$id1 = $eID;
								$id2 = $mID;
								
								/* execute the statement */
								$stmt->execute();
								
								/*Close the statement */
								$stmt->close();
								header('Location: tables.php?assign');
							}
							else 
							{
								echo "Prepared Statement error: %s\n". $conn->error;
							}
/* close the connection */
$conn->close();	
	
}

/* Update a score */
if (isset($_GET['score'])) {
	
	/* validate GET params */
	if (isset($_GET['eid'])) {
		$eID = $_GET['eid'];
	}
	else {
		echo "GET eventID not received";
		exit;
	}
	
	if (isset($_GET['mid'])) {
		$mID = $_GET['mid'];
	}
	else {
		echo "GET memberID not received";
		exit;
	}
	
	/* validate posted variables and perform the sql insert */
	
	/* check the event value */
	if (isset($_POST['event'])) {
		$eventID = $_POST['event'];
	/* 	check the "eventID" */
	if ($eventID != null) {
		$result = is_numeric($eventID);
		if (!$result) {
			echo "eventID not valid.";
			exit;
		} else {	}
	} else {
		echo "eventID not received";
		exit;
	}
} else {
	echo "eventID not posted"; 
	exit;
	}
	
	/* check the member value */
	if (isset($_POST['member'])) {
		$memberID = $_POST['member'];
	/* 	check the "memberID" */
	if ($memberID != null) {
		$result = is_numeric($memberID);
		if (!$result) {
			echo "memberID not valid.";
			exit;
		} else {	}
	} else {
		echo "memberID not received";
		exit;
	}
} else {
	echo "memberID not posted"; 
	exit;
	}
	
	/* check the current score .. this is essential for sql */
	if (isset($_POST['curscore'])) {
		$curScore = ($_POST['curscore']);
	/* 	check the "curScore" */
	if ($curScore != null || $curScore != "") {
		$result = is_numeric($curScore);
		if (!$result) {
			echo "Current score not valid.";
			exit;
		} else {	}
	} else {
		echo "Current score not received";
		exit;
	}
} else {
	echo "Current score not posted";
	exit;
	}
	
	/* check the final score
	- if number not received then set as null */
	if (isset($_POST['finscore'])) {
		$finScore = $_POST['finscore'];
	/* check the "finScore" */
	if ($finScore != null || $finScore != "") {
		$result = is_numeric($finScore);
		if (!$result) {
			echo "Final score number not valid.";
			exit;
		} else {	}
	} else {
		// not essential for sql input, so can avoid error here.
		$finScore = null;
	}
} else {
	// not essential for sql input, so can avoid error here.
	$finScore = null;
	}
	
	
	/* Validation complete, Insert the data */
	
// Connect to the database
$conn = connect_db($host,$uid,$pwd,$database);

/* prepare statement */
if ($stmt = $conn->prepare("UPDATE "."$table5"
							." SET _eventID=?, _memberID=?, _current_score=?, _final_score=?"
							." WHERE _eventID=? and _memberID=?"))
							{
								/* Bind the params */
								$stmt->bind_param("iiiiii", $event, $member, $cur, $fin, $id1, $id2);
										
								$event = $eventID;
								$member = $memberID;
								$cur = $curScore;
								$fin = $finScore;
								$id1 = $eID;
								$id2 = $mID;
		
								/* execute the statement */
								$stmt->execute();
								
								/*Close the statement */
								$stmt->close();
								header('Location: tables.php?scores');
							}
							else 
							{
								echo "Prepared Statement error: %s\n". $conn->error;
							}
/* close the connection */
$conn->close();	
	
}
	
?>