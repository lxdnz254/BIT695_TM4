<?php

include('connect.php');
 
function select_all($connection, $table) {

	$sql = "select * from {$table}";
    $result = $connection -> query($sql);

    return $result;
}

function select_games($connection, $table, $table2) {
	
	$sql="SELECT {$table}.*, {$table2}._first_name, 
			{$table2}._family_name FROM {$table} JOIN 
			{$table2} ON {$table}._ownerID = {$table2}._memberID";
	
	$result = $connection -> query($sql);
	
	return $result;
}

function select_events($connection, $table, $table2) {
	
	$sql = "SELECT {$table}.* , {$table2}._boardgame FROM
		{$table} JOIN {$table2} ON {$table2}._boardgameID = 
			{$table}._boardgameID";
	
	$result = $connection -> query($sql);
	
	return $result;
}

function select_assign($connection, $table, $table2, $table3) {
	
	$sql = "SELECT {$table}.* , {$table2}._event_name , 
				{$table3}._first_name , {$table3}._family_name 
				FROM {$table} JOIN {$table2} ON {$table2}._eventID
				= {$table}._eventID JOIN {$table3} ON {$table3}._memberID
				= {$table}._memberID ORDER BY {$table}._eventID, {$table}._position";
				
	$result = $connection -> query($sql);
	
	return $result;
}

function select_score($connection, $table, $table2, $table3) {
	
	$sql = "SELECT {$table}.* , {$table2}._event_name , 
				{$table3}._first_name , {$table3}._family_name 
				FROM {$table} JOIN {$table2} ON {$table2}._eventID
				= {$table}._eventID JOIN {$table3} ON {$table3}._memberID
				= {$table}._memberID ORDER BY {$table}._eventID, {$table}._current_score DESC";
				
	$result = $connection -> query($sql);
	
	return $result;
}

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
