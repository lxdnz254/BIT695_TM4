<?php

function replace_tags($template, $placeholders){
    	
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

/* stores a temporary file on users device */
function temporaryFile($name, $content)
{
    $file = trim(sys_get_temp_dir(), DIRECTORY_SEPARATOR) .
            DIRECTORY_SEPARATOR .
            ltrim($name, DIRECTORY_SEPARATOR);

    file_put_contents($file, $content);

    register_shutdown_function(function() use($file) {
        unlink($file);
    });

    return $file;
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
	
	// close the connection
	$conn->close();

	/*create the output from the template */
	$vars = array('{{game}}'=>'',
				'{{Register}}'=>'Add Game',
				'{{action}}'=>'add.php?games');
					
	$template = file_get_contents('games_form.html.php', true);	
	$replace = replace_tags($template, $vars);
	
	/*make a temporary file*/
	$file = 'gameform.php';
	$aFile = temporaryFile($file, $replace);
	/*output the temporary file */
	include($aFile);
}

/* Get event form */
if (isset($_GET['event'])) {
	
	include('connect.php');
	
	// Connect to the database

	$conn=connect_db($host,$uid,$pwd,$database);
	$sql = "SELECT _boardgameID, _boardgame FROM {$table2}";

	$result = statement_prep($conn, $sql);
	
	if ($result->num_rows > 0) {
		
		foreach($result as $row) {
			$games[] = array('id' => $row['_boardgameID'], 'game' => $row['_boardgame']);
		}
		
	} else {
		echo 'Error getting database information'; 
		exit();
		}
	
	// close the connection
	$conn->close();

	/*create the output from the template */
	$vars = array('{{event}}'=>'',
				'{{venue}}'=>'',
				'{{dstart}}'=>'2017-06-01',
				'{{tstart}}'=>'12:00',
				'{{dfinish}}'=>'2017-06-01',
				'{{tfinish}}'=>'12:00',
				'{{Register}}'=>'Add Event',
				'{{action}}'=>'add.php?event');
					
	$template = file_get_contents('event_form.html.php', true);	
	$replace = replace_tags($template, $vars);
	
	/*make a temporary file*/
	$file = 'eventform.php';
	$aFile = temporaryFile($file, $replace);
	/*output the temporary file */
	include($aFile);
}

/* Get assign form */
if (isset($_GET['assign'])) {
	
	include('connect.php');
	
	// Connect to the database

	$conn=connect_db($host,$uid,$pwd,$database);
	// First sql array
	$sql = "SELECT t._memberID, t._first_name, t._family_name
			FROM {$table1} t ";

	$result = statement_prep($conn, $sql);
	
	if ($result->num_rows > 0) {
		
		foreach($result as $row) {
			$players[] = array('id' => $row['_memberID'], 'name' => $row['_first_name'].' '.$row['_family_name']);
		}
		
	} else {
		echo 'Error getting database information'; 
		exit();
		}
		
	// Second sql array	
	$sql = "SELECT t._eventID, t._event_name
			FROM {$table4} t ";

	$result = statement_prep($conn, $sql);
	
	if ($result->num_rows > 0) {
		
		foreach($result as $row) {
			$events[] = array('id' => $row['_eventID'], 'event' => $row['_event_name']);
		}
		
	} else {
		echo 'Error getting database information'; 
		exit();
		}
	
	// close the connection	
	$conn->close();

	/*create the output from the template */
	$vars = array('{{notes}}'=>'',
				'{{position}}'=>'',
				'{{date}}'=>'2017-06-01',
				'{{Register}}'=>'Assign Player',
				'{{action}}'=>'add.php?assign');
					
	$template = file_get_contents('assign_form.html.php', true);	
	$replace = replace_tags($template, $vars);
	
	/*make a temporary file*/
	$file = 'assignform.php';
	$aFile = temporaryFile($file, $replace);
	/*output the temporary file */
	include($aFile);
}

/* Get scores form */
if (isset($_GET['scores'])) {
	
	include('connect.php');
	
	// Connect to the database

	$conn=connect_db($host,$uid,$pwd,$database);
	// First sql array
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
		
	// Second sql array
	$sql = "SELECT _eventID, _event_name FROM {$table4}";

	$result = statement_prep($conn, $sql);
	
	if ($result->num_rows > 0) {
		
		foreach($result as $row) {
			$events[] = array('id' => $row['_eventID'], 'event' => $row['_event_name']);
		}
		
	} else {
		echo 'Error getting database information'; 
		exit();
		}	
	
	// close the connection
	$conn->close();

	/*create the output from the template */
	$vars = array('{{curscore}}'=>'',
				'{{finscore}}'=>'',
				'{{Register}}'=>'Add Score',
				'{{action}}'=>'add.php?scores');
					
	$template = file_get_contents('scores_form.html.php', true);	
	$replace = replace_tags($template, $vars);
	
	/*make a temporary file*/
	$file = 'scoreform.php';
	$aFile = temporaryFile($file, $replace);
	/*output the temporary file */
	include($aFile);
}

?>