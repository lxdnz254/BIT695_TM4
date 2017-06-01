<?php

include('connect.php');

 
function select_all($connection, $table) {

	$sql = "select * from {$table}";
    $result = $connection -> query($sql);

    return $result;
}

//if (isset($_GET['']) or isset($_GET['player'])) {
// Query the database

$conn=connect_db($host,$uid,$pwd,$database);
$result = select_all($conn, $table1);


if ($result->num_rows > 0) {

 // Output the table
	include('header.php');
 	include('table_player.html.php');
	
	
 } else  echo '0 results';

$conn->close();
//}
?>
