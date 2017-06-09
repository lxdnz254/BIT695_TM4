<?php

include('connect.php');
 
function statement_prep($connection, $sql) {

	if($stmt = $connection->prepare($sql)) {
		
		$stmt->execute();
		$result = $stmt->get_result();
		$stmt->close();
	}
	else
	{
		$result=null;
		echo 'Prepared statement error: %s\n'. $connection->error;
	}
    return $result;
}

/* Deleting a player */
if (isset($_GET['Player'])) {
	
	// get the passed variable(s)
	$id = $_GET['Player'];

	// Connect to the database

	$conn=connect_db($host,$uid,$pwd,$database);
	$sql = "select * from {$table1} WHERE _memberID = {$id}";

	$result = statement_prep($conn, $sql);

	if ($result->num_rows > 0) {
		
		// code for window confirming delete action
		$row = $result-> fetch_assoc();
			
		echo 'Deleting player named '.$row['_first_name']. ' ' .$row['_family_name'].'!';	
		echo '<p></p>';
		echo '<td width=15% align=middle>';
		// pass _memberID to actual delete action 
		echo '<a href="do_delete.php?player&id='.$row['_memberID'].'">';
		echo '<input type="button" name="yes" value="Yes"></a>';	
		echo '</td><td width=15% align=middle>';
		// return to player table with no delete
		echo '<a href="tables.php?player">';
		echo '<input type="button" name="no" value="No"></a></td>';
	} else {
		echo "Could not find player on database table";
	}

	// Close the connection on Error.
	$conn->close();
}

if (isset($_GET['game'])) {
	// get the passed variable
	$id=$_GET['game'];
	// connect to the database
	$conn=connect_db($host,$uid,$pwd,$database);
	$sql = "SELECT * from {$table2} WHERE _boardgameID = {$id}";
	
	$result = statement_prep($conn, $sql);
	
	if ($result->num_rows >0) {
		
	// code for window confirming delete action
		$row = $result-> fetch_assoc();
			
		echo 'Deleting game named '.$row['_boardgame']. '!';	
		echo '<p></p>';
		echo '<td width=15% align=middle>';
		// pass _memberID to actual delete action 
		echo '<a href="do_delete.php?game&id='.$row['_boardgameID'].'">';
		echo '<input type="button" name="yes" value="Yes"></a>';	
		echo '</td><td width=15% align=middle>';
		// return to player table with no delete
		echo '<a href="tables.php?games">';
		echo '<input type="button" name="no" value="No"></a></td>';
	} else {
		echo "Could not find game on database table";
	}

	// Close the connection on Error.
	$conn->close();	
	
}

if (isset($_GET['events'])) {
	// get the passed variable
	$id=$_GET['events'];
	// connect to the database
	$conn=connect_db($host,$uid,$pwd,$database);
	$sql = "SELECT * from {$table4} WHERE _eventID = {$id}";
	
	$result = statement_prep($conn, $sql);
	
	if ($result->num_rows >0) {
		
	// code for window confirming delete action
		$row = $result-> fetch_assoc();
			
		echo 'Deleting event named '.$row['_event_name']. '!';	
		echo '<p></p>';
		echo '<td width=15% align=middle>';
		// pass _memberID to actual delete action 
		echo '<a href="do_delete.php?event&id='.$row['_eventID'].'">';
		echo '<input type="button" name="yes" value="Yes"></a>';	
		echo '</td><td width=15% align=middle>';
		// return to player table with no delete
		echo '<a href="tables.php?schedule">';
		echo '<input type="button" name="no" value="No"></a></td>';
	} else {
		echo "Could not find game on database table";
	}

	// Close the connection on Error.
	$conn->close();	
}

if (isset($_GET['assign'])) {
	// get the passed variable
	if (isset($_GET['member'])) {
	$mID = $_GET['member'];
	}
	
	if (isset($_GET['event'])) {
		$eID = $_GET['event'];
	}		
	
	// connect to the database
	$conn=connect_db($host,$uid,$pwd,$database);
	$sql = "SELECT t.*, p._first_name, p._family_name
			FROM {$table3} t 
			INNER JOIN {$table1} p ON p._memberID = t._memberID
			WHERE t._memberID = {$mID} AND t._eventID = {$eID}";
	
	$result = statement_prep($conn, $sql);
	
	if ($result->num_rows >0) {
		
	// code for window confirming delete action
		$row = $result-> fetch_assoc();
			
		echo 'Deleting assigned player named '.$row['_first_name'].' '.$row['_family_name'].'!';	
		echo '<p></p>';
		echo '<td width=15% align=middle>';
		// pass _memberID to actual delete action 
		echo '<a href="do_delete.php?assign&mid='.$row['_memberID'].'&eid='.$row['_eventID'].'">';
		echo '<input type="button" name="yes" value="Yes"></a>';	
		echo '</td><td width=15% align=middle>';
		// return to player table with no delete
		echo '<a href="tables.php?assign">';
		echo '<input type="button" name="no" value="No"></a></td>';
	} else {
		echo "Could not find game on database table";
	}

	// Close the connection on Error.
	$conn->close();	
}

if (isset($_GET['scores'])) {
	// get the passed variables
	if (isset($_GET['member'])) {
	$mID = $_GET['member'];
	}
	
	if (isset($_GET['event'])) {
		$eID = $_GET['event'];
	}		
	// connect to the database
	$conn=connect_db($host,$uid,$pwd,$database);
	$sql = "SELECT t.*, p._first_name, p._family_name 
		FROM {$table5} t 
		INNER JOIN {$table1} p ON p._memberID = t._memberID
		WHERE t._memberID = {$mID} AND t._eventID = {$eID}";
	
	$result = statement_prep($conn, $sql);
	
	if ($result->num_rows >0) {
		
	// code for window confirming delete action
		$row = $result-> fetch_assoc();
			
		echo 'Deleting scores for player named '.$row['_first_name'].' '.$row['_family_name']. '!';	
		echo '<p></p>';
		echo '<td width=15% align=middle>';
		// pass _memberID to actual delete action 
		echo '<a href="do_delete.php?score&mid='.$row['_memberID'].'&eid='.$row['_eventID'].'">';
		echo '<input type="button" name="yes" value="Yes"></a>';	
		echo '</td><td width=15% align=middle>';
		// return to player table with no delete
		echo '<a href="tables.php?scores">';
		echo '<input type="button" name="no" value="No"></a></td>';
	} else {
		echo "Could not find game on database table";
	}

	// Close the connection on Error.
	$conn->close();	
}

?>