<?php

include_once('../includes/helpers.inc.php');

include('connect.php');
 
if (isset($_GET['Player'])) {
	
	$id = $_GET['Player'];
// Connect to the database

$conn=connect_db($host,$uid,$pwd,$database);
$sql = "select * from {$table1} WHERE _memberID = {$id}";
$result = statement_prep($conn, $sql);

if ($result->num_rows > 0) {
	
	// code for window confirming delete action
	$row = $result-> fetch_assoc();
	
	$vars = array('{{firstname}}'=>$row['_first_name'], 
				'{{familyname}}'=>$row['_family_name'],
				'{{email}}'=>$row['_email'], 
				'{{phone}}'=>$row['_phone'],
				'{{Register}}' =>'Update Player',
				'{{action}}'=>'update.php?player&id='.$row['_memberID']);
				
	$template = file_get_contents('table1_form_template.html', true);

	echo replace_tags($template, $vars);
	
	
} else {
	echo "Did not find player";
}

$conn->close();
}

if (isset($_GET['game'])) {
	
	$id = $_GET['game'];
// Connect to the database

$conn=connect_db($host,$uid,$pwd,$database);
$sql = "select * from {$table2} WHERE _boardgameID = {$id}";
$result = statement_prep($conn, $sql);

if ($result->num_rows > 0) {
	
	// code for window confirming delete action
	$row = $result-> fetch_assoc();
	
	$bID = $row['_boardgameID'];
	$bGame = $row['_boardgame'];
	$ownID = $row['_ownerID'];
	$playing = $row['_playing'];
	$numPlayers= $row['_number_of_players'];
		
} else {
	echo "Did not find player";
}
// second sql statement for the template
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

$vars = array('{{game}}'=>$bGame, 
				'{{id}}'=>$ownID,
				'{{playing}}'=>$playing,
				'{{v}}'=>$numPlayers,
				'{{Register}}' =>'Update Game',
				'{{action}}'=>'update.php?game&id='.$bID);
				
	$template = file_get_contents('games_form.html.php', true);
	$replace = replace_tags($template, $vars);
	
	/*make a temporary file*/
	$file = 'editgameform.php';
	$aFile = temporaryFile($file, $replace);
	/*output the temporary file */
	include($aFile);
	
}

if (isset($_GET['assign'])) {
	
	if (isset($_GET['member'])) {
		$mID = $_GET['member'];
	}
	if (isset($_GET['event'])) {
		$eID = $_GET['event']; 
		}
// Connect to the database

$conn=connect_db($host,$uid,$pwd,$database);
$sql = "select * from {$table3} WHERE _memberID = {$mID} AND _eventID = {$eID}";
$result = statement_prep($conn, $sql);

if ($result->num_rows > 0) {
	
	// code for window confirming delete action
	$row = $result-> fetch_assoc();
	
	$eventID = $row['_eventID'];
	$memberID = $row['_memberID'];
	$notes = $row['_notes'];
	$position = $row['_position'];
	$date = $row['_date'];
	
} else {
	echo "Did not find player";
}

// second sql statement
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
		
	// third sql array	
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

//close the connection
$conn->close();

$vars = array('{{eid}}'=>$eventID, 
				'{{pid}}'=>$memberID,
				'{{notes}}'=>$notes, 
				'{{position}}'=>$position,
				'{{date}}'=>$date,
				'{{Register}}' =>'Update Assignee',
				'{{action}}'=>'update.php?assign&mid='.$mID.'&eid='.$eID);
				
	$template = file_get_contents('assign_form.html.php', true);

	$replace = replace_tags($template, $vars);
	/*make a temporary file*/
	$file = 'editassignform.php';
	$aFile = temporaryFile($file, $replace);
	/*output the temporary file */
	include($aFile);
}

if (isset($_GET['events'])) {
	
	$id = $_GET['events'];
// Connect to the database

$conn=connect_db($host,$uid,$pwd,$database);
$sql = "select * from {$table4} WHERE _eventID = {$id}";
$result = statement_prep($conn, $sql);

if ($result->num_rows > 0) {
	
	// code for window confirming delete action
	$row = $result-> fetch_assoc();
	
	$eventID = $row['_eventID'];
	$eventName = $row['_event_name'];
	$venue = $row['_venue'];
	$dstart = $row['_date_start'];
	$dfinish = $row['_date_finish'];
	$tstart = $row['_time_start'];
	$tfinish = $row['_time_finish'];
	$bID = $row['_boardgameID'];
	$reg = $row['_registered_players'];
	
	
} else {
	echo "Did not find player";
}

// second sql statement
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
	$vars = array('{{event}}'=>$eventName,
				'{{venue}}'=>$venue,
				'{{id}}'=>$bID,
				'{{dstart}}'=>$dstart,
				'{{tstart}}'=>$tstart,
				'{{dfinish}}'=>$dfinish,
				'{{tfinish}}'=>$tfinish,
				'{{reg}}'=>$reg,
				'{{Register}}'=>'Update Event',
				'{{action}}'=>'update.php?event&id='.$eventID);
				
	$template = file_get_contents('event_form.html.php', true);

	$replace = replace_tags($template, $vars);
	/*make a temporary file*/
	$file = 'editeventsform.php';
	$aFile = temporaryFile($file, $replace);
	/*output the temporary file */
	include($aFile);
}

if (isset($_GET['scores'])) {
	
	if (isset($_GET['member'])) {
		$mID = $_GET['member'];
	}
	if (isset($_GET['event'])) {
		$eID = $_GET['event'];
	}
// Connect to the database

$conn=connect_db($host,$uid,$pwd,$database);
$sql = "select * from {$table5} WHERE _memberID = {$mID} AND _eventID = {$eID}";
$result = statement_prep($conn, $sql);

if ($result->num_rows > 0) {
	
	// code for window confirming delete action
	$row = $result-> fetch_assoc();
	
	$eventID = $row['_eventID'];
	$memberID = $row['_memberID'];
	$curScore = $row['_current_score'];
	$finScore = $row['_final_score'];
	$date = $row['_date'];
	
} else {
	echo "Did not find player";
}

// second sql statement
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
		
	// third sql array	
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

$conn->close();

$vars = array('{{eid}}'=>$eventID, 
				'{{pid}}'=>$memberID,
				'{{curscore}}'=>$curScore, 
				'{{finscore}}'=>$finScore,
				'{{Register}}' =>'Update Score',
				'{{action}}'=>'update.php?score&mid='.$memberID.'&eid='.$eID);
				
	$template = file_get_contents('scores_form.html.php', true);

	$replace = replace_tags($template, $vars);
	/*make a temporary file*/
	$file = 'editscoreform.php';
	$aFile = temporaryFile($file, $replace);
	/*output the temporary file */
	include($aFile);
}
?>
