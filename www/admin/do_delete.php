<?php

include('connect.php');
 
if (isset($_GET['player'])) { 

	// get the passed variable(s)
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}
	else {
		echo "on Delete Player ID not received";
		exit;
	}
	
	// Connect to the database
	$conn=connect_db($host,$uid,$pwd,$database);
	$sql= "DELETE FROM {$table1} WHERE _memberID = ?";
	
	if ($stmt = $conn->prepare($sql)) {
		/*Bind value */
		$stmt->bind_param("i", $bindID);
		$bindID = $id;
		$stmt->execute();
		$del_result = $stmt->affected_rows;
		$stmt->close();
	}
	else {
		$del_result = false;
		echo "Error in prepared statement: %s\n".$conn->error;
	}
	
	if ($del_result>0) {
			echo "...OK";
			header("Location: tables.php?player");
		} else { echo "...Error!";}

	// Close connection on Error.	
	$conn->close();
}

if (isset($_GET['game'])) { 

	// get the passed variable(s)
	$id = $_GET['id'];
	// Connect to the database
	$conn=connect_db($host,$uid,$pwd,$database);
	$sql= "DELETE FROM {$table2} WHERE _boardgameID = ?";
	
	if ($stmt = $conn->prepare($sql)) {
		/*Bind value */
		$stmt->bind_param("i", $bindID);
		$bindID = $id;
		$stmt->execute();
		$del_result = $stmt->affected_rows;
		$stmt->close();
	}
	else {
		$del_result = false;
		echo "Error in prepared statement: %s\n".$conn->error;
	}
	
	if ($del_result>0) {
			echo "...OK";
			header("Location: tables.php?games");
		} else { echo "...Error!";}

	// Close connection on Error.	
	$conn->close();
}

if (isset($_GET['event'])) { 

	// get the passed variable(s)
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}
	else {
		echo "On Delete eventID not received";
		exit;
	}
	
	// Connect to the database
	$conn=connect_db($host,$uid,$pwd,$database);
	$sql= "DELETE FROM {$table4} WHERE _eventID = ?";
	
	if ($stmt = $conn->prepare($sql)) {
		/*Bind value */
		$stmt->bind_param("i", $bindID);
		$bindID = $id;
		$stmt->execute();
		$del_result = $stmt->affected_rows;
		$stmt->close();
	}
	else {
		$del_result = false;
		echo "Error in prepared statement: %s\n".$conn->error;
	}
	
	if ($del_result>0) {
			echo "...OK";
			header("Location: tables.php?schedule");
		} else { echo "...Error!";}

	// Close connection on Error.	
	$conn->close();
}

if (isset($_GET['assign'])) { 

	// get the passed variable(s)
	if (isset($_GET['mid'])) {
		$mID = $_GET['mid'];
	}
	if (isset($_GET['eid'])) {
		$eID = $_GET['eid'];
	}
	// Connect to the database
	$conn=connect_db($host,$uid,$pwd,$database);
	$sql= "DELETE FROM {$table3} WHERE _memberID = ? AND _eventID = ?";
	
	if ($stmt = $conn->prepare($sql)) {
		/*Bind value */
		$stmt->bind_param("ii", $memberID, $eventID);
		$memberID = $mID;
		$eventID = $eID;
		$stmt->execute();
		$del_result = $stmt->affected_rows;
		$stmt->close();
	}
	else {
		$del_result = false;
		echo "Error in prepared statement: %s\n".$conn->error;
	}
	
	if ($del_result>0) {
			echo "...OK";
			header("Location: tables.php?assign");
		} else { echo "...Error!";}

	// Close connection on Error.	
	$conn->close();
}

if (isset($_GET['score'])) { 

	// get the passed variable(s)
	if (isset($_GET['mid'])) {
		$mID = $_GET['mid'];
	}
	if (isset($_GET['eid'])) {
		$eID = $_GET['eid'];
	}
		
	// Connect to the database
	$conn=connect_db($host,$uid,$pwd,$database);
	$sql= "DELETE FROM {$table5} WHERE _memberID = ? AND _eventID = ?";
	
	if ($stmt = $conn->prepare($sql)) {
		/*Bind value */
		$stmt->bind_param("ii", $memberID, $eventID);
		$memberID = $mID;
		$eventID = $eID;
		$stmt->execute();
		$del_result = $stmt->affected_rows;
		$stmt->close();
	}
	else {
		$del_result = false;
		echo "Error in prepared statement: %s\n".$conn->error;
	}
	
	if ($del_result>0) {
			echo "...OK";
			header("Location: tables.php?scores");
		} else { echo "...Error!";}

	// Close connection on Error.	
	$conn->close();
}
?>