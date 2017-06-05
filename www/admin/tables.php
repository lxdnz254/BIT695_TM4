<?php

/* database function */
include('connect.php');

/* Prepare stements for all tables */
function statement_prep($connection, $sql) {
	
	if($stmt = $connection->prepare($sql)) {
		
		/*No Bind params */
		
		/*execute statement*/
		$stmt->execute();
		
		/*get result*/
		$result=$stmt->get_result();
		
		$stmt->close();
		
	} else {
			$result=null;
			echo 'Prepared statement error: %s\n'. $connection->error;
	}
	
	return $result;
}

/* sql for the player table */ 
function select_all($connection, $table) {

	$sql = "select * from {$table}";
	$result = statement_prep($connection, $sql);	
	
    return $result;
}

/* sql for the games table */
function select_games($connection, $table, $table2) {
	
	$sql="SELECT {$table}.*, {$table2}._first_name, 
			{$table2}._family_name FROM {$table} JOIN 
			{$table2} ON {$table}._ownerID = {$table2}._memberID";
	
	$result = statement_prep($connection, $sql);
	
	return $result;
}

/* sql for the events table */
function select_events($connection, $table, $table2) {
	
	$sql = "SELECT {$table}.* , {$table2}._boardgame FROM
		{$table} JOIN {$table2} ON {$table2}._boardgameID = 
			{$table}._boardgameID";
	
	$result = statement_prep($connection, $sql);
	
	return $result;
}

/* sql for the assign table */
function select_assign($connection, $table, $table2, $table3) {
	
	$sql = "SELECT {$table}.* , {$table2}._event_name , 
				{$table3}._first_name , {$table3}._family_name 
				FROM {$table} JOIN {$table2} ON {$table2}._eventID
				= {$table}._eventID JOIN {$table3} ON {$table3}._memberID
				= {$table}._memberID ORDER BY {$table}._eventID, {$table}._position";
				
	$result = statement_prep($connection, $sql);
	
	return $result;
}

/*sql for the scores table */
function select_score($connection, $table, $table2, $table3) {
	
	$sql = "SELECT {$table}.* , {$table2}._event_name , 
				{$table3}._first_name , {$table3}._family_name 
				FROM {$table} JOIN {$table2} ON {$table2}._eventID
				= {$table}._eventID JOIN {$table3} ON {$table3}._memberID
				= {$table}._memberID ORDER BY {$table}._eventID, {$table}._current_score DESC";
				
	$result = statement_prep($connection, $sql);
	
	return $result;
}

/* Get the player table */
if (isset($_GET['player'])) {
// Query the database

$conn = connect_db($host,$uid,$pwd,$database);
$result = select_all($conn, $table1);

if ($result->num_rows > 0) {

 // Output the table
	include('header.php');
 	include('table_player.html.php');
		
 } else  echo '0 results';

$conn->close();
}

/* Get the games table */
if (isset($_GET['games'])) {
// Query the database

$conn = connect_db($host,$uid,$pwd,$database);
$result = select_games($conn, $table2, $table1);

if ($result->num_rows > 0) {

	// Output the games table
	include('header.php');
	include('table_games.html.php');
	
} else echo '0 results';

$conn->close();
	
}

/* Get the assign table */
if (isset($_GET['assign'])) {
// Query the database

$conn = connect_db($host,$uid,$pwd,$database);
$result = select_assign($conn, $table3, $table4, $table1);

if ($result->num_rows > 0) {

	// Output the assign table
	include('header.php');
	include('table_assign.html.php');
	
} else echo '0 results';

$conn->close();
	
}

/* Get the Events table */
if (isset($_GET['schedule'])) {
// Query the database

$conn = connect_db($host,$uid,$pwd,$database);
$result = select_events($conn, $table4, $table2);

if ($result->num_rows > 0) {

	// Output the schedule table
	include('header.php');
	include('table_schedule.html.php');
	
} else echo '0 results';

$conn->close();
	
}

/* Get the scores table */
if (isset($_GET['scores'])) {
// Query the database

$conn = connect_db($host,$uid,$pwd,$database);
$result = select_score($conn, $table5, $table4, $table1);

if ($result->num_rows > 0) {
	
	//Output the scores table
	include('header.php');
	include('table_scores.html.php');
	
} else echo '0 results';

$conn->close();	
}

?>
