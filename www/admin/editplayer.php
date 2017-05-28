<?php

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
	
	function replace_tags($template, $placeholders){
    $placeholders = array_merge($placeholders, array('<?'=>'', '?>'=>''));
	
    return str_replace(array_keys($placeholders), $placeholders, $template);
}

	$vars = array('{{firstname}}'=>$row['_first_name'], 
				'{{familyname}}'=>$row['_family_name'],
				'{{email}}'=>$row['_email'], 
				'{{phone}}'=>$row['_phone'],
				'{{Register}}' =>'Update',
				'{{action}}'=>'update.php?id='.$row['_memberID']);
				
	$template = file_get_contents('table1_form_template.html', true);

	echo replace_tags($template, $vars);
	
	
} else {
	echo "Did not find player";
}

$conn->close();

?>
