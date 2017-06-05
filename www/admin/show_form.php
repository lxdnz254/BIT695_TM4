<?php

function replace_tags($template, $placeholders){
    $placeholders = array_merge($placeholders, array('<?'=>'<?', '?>'=>'?>'));
	
    return str_replace(array_keys($placeholders), $placeholders, $template);
}

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

/* Get player form */
if (isset($_GET['player'])) {
	
	$vars = array('{{firstname}}'=>'', 
				'{{familyname}}'=>'',
				'{{email}}'=>'', 
				'{{phone}}'=>'',
				'{{Register}}' =>'Add Player',
				'{{action}}'=>'add.php?player');
				
	$template = file_get_contents('table1_form_template.html', true);

	echo replace_tags($template, $vars);
}

/* Get games form */
if (isset($_GET['games'])) {
	
	include('connect.php');
	
	// Connect to the database

	$conn=connect_db($host,$uid,$pwd,$database);
	$sql = "SELECT _memberID, _first_name, _family_name FROM {$table1}";

	$result = statement_prep($conn, $sql);
	

	if ($result->num_rows > 0) {
		
		foreach($result as $row) {
			$players[] = array('id' => $row['_memberID'], 'name' => $row['_first_name'].' '.$row['_family_name']);
		}
		
	} else {
		echo 'Error getting database information'; 
		exit();
		}
		
	$conn->close();

	$vars = array('{{game}}'=>'',
				'{{Register}}'=>'Add Game',
				'{{action}}'=>'add.php?games');
				
	$file = 'gameform.php';
	$template = file_get_contents('games_form.html.php', true);
	
	$replace = replace_tags($template, $vars);
	
	file_put_contents($file, "\xEF\xBB\xBF".$replace);
	
	include($file);
	
	
}

?>