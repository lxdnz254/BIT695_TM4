<?php

// get the passed variable(s)

$id = $_GET['id'];

include('connect.php');
 
 function delete_player($connection, $table, $member) {
	
	$sql = "DELETE FROM {$table} WHERE _memberID = {$member}";
	$result = $connection -> query($sql);
	
	return $result;
}
 
// Connect to the database

$conn=connect_db($host,$uid,$pwd,$database);
$del_result = delete_player($conn, $table1, $id);
		
if ($del_result === TRUE) {
		echo "...OK";
		header("Location: player_table.php");
	} else { echo "...Error!";}

// Close connection on Error.	
$conn->close();

?>