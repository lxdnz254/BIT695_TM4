<?php

// get the passed variable(s)

$id = $_GET['Player'];

include('connect.php');
 
function select_player($connection, $table, $member) {

	$sql = "select * from {$table} WHERE _memberID = {$member}";
    $result = $connection -> query($sql);

    return $result;
}

// Connect to the database

$conn=connect_db($host,$uid,$pwd,$database);
$result = select_player($conn, $table1, $id);


if ($result->num_rows > 0) {
	
	// code for window confirming delete action
	$row = $result-> fetch_assoc();
		
	echo 'Deleting player named '.$row['_first_name']. ' ' .$row['_family_name'].'!';	
	echo '<p></p>';
	echo '<td width=15% align=middle>';
	// pass _memberID to actual delete action 
	echo '<a href="do_delete.php?id='.$row['_memberID'].'">';
	echo '<input type="button" name="yes" value="Yes"></a>';	
	echo '</td><td width=15% align=middle>';
	// return to player table with no delete
	echo '<a href="player_table.php">';
	echo '<input type="button" name="no" value="No"></a></td>';
} else {
	echo "Could not find player on database table";
}

// Close the connection on Error.
	$conn->close();

?>