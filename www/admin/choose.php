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
		}
		
	}
	
}

$conn->close();

?>
<html>
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

