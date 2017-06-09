<?php
include_once('../includes/helpers.inc.php');
include_once('connect.php');

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
		
	// Recieve the assign posts
if (isset($_GET['assign'])) {
	
	if (isset($_POST['player'])) {
		$memberID = $_POST['player'];
	}
	
	// get the checked events
	foreach ($events as $event){
		
		if (isset($_POST['check'.$event['id']])) {
			$checkedArray[] = array('checked' => $event['id']);
		}	
	}
	
	$confirmString = 'choose.php?confirm&mid='.$memberID;
	
	foreach ($checkedArray as $eventID) {
		// check if already assigned
		$sql = "SELECT _memberID, _eventID FROM {$table3}"
				." WHERE _memberID={$memberID} AND _eventID={$eventID['checked']}";
		$result = statement_prep($conn, $sql);
		
		if ($result->num_rows == 0) {
			//add the assigned event to member
			$sql = "INSERT INTO {$table3} ( _memberID, _eventID ) VALUES ({$memberID}, {$eventID['checked']})";
			// no result returned for INSERT
			statement_prep($conn, $sql);
			$confirmString .= '&check'.$eventID['checked'].'=on';
			}
		
	}
	header('Location: '.$confirmString);
	
}

// Build a confirmation output
if (isset($_GET['confirm'])) {
	
	// Get the player ID
	if (isset($_GET['mid'])) {
		$memberID = $_GET['mid'];
	}
	
	$checkCount = 0;
	// get the checked events
	foreach ($events as $event){
		
		if (isset($_GET['check'.$event['id']])) {
			$checkedArray[] = array('checked' => $event['id']);
			$checkCount++;
		}	
	}
	
	// Get player name from ID and start building string
	$name = $players[$memberID - 1]['name'];
	$output = $name; 
	$output .= ' has been assigned to ';
	
	if ($checkCount > 0) {
		
		foreach ($checkedArray as $eventID) {
			
			$sql = "SELECT _event_name FROM {$table4} WHERE _eventID={$eventID['checked']}";
			$result = statement_prep($conn, $sql);
			
			if ($result->num_rows > 0) {
				
				foreach($result as $row) {
					$output .= $row['_event_name'].', ';
				}
				
			} else {
				echo "Error getting database information";
				exit();
			}
		}
		$output .= 'press OK to continue.';
	} else {
		$output .= 'no new events!';
	}
	
	header('Location: confirm.php?output='.$output);
}

$conn->close();

?>
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		

	</head>
	<body>
	<form id="form-box" method="POST" enctype="application/x-www-form-urlencoded" action="choose.php?assign"  target="_self">
	<table style="margin:0px auto; width:75%;">
		<thead>
			<tr>
				<th>Player Select</th>
				<th>Assign Events</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<select name="player">
						<?php foreach ($players as $player): ?>
					<option value="<?php htmlout($player['id']); ?>"><?php htmlout($player['name']); ?></option>
					<?php endforeach; ?>
					</select>
				</td>
				<?php foreach ($events as $event): ?>
				<td><?php htmlout($event['event']); ?></td>
				<td><input type="checkbox" name="check<?php htmlout($event['id']); ?>"></td></tr><td></td>
				<?php endforeach; ?>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td></td>
				<td>
					<p id="register">
					<input type="submit" value="Assign Events" style="margin:1px auto; width: 100%;">
					</p>
				</td>
			</tr>
	</table>
	</form>
	</body>


</html>

