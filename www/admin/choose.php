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
		
		
	$conn->close();

?>
<html>
	<table>
		<thead>
			<tr>
				<th>Player Select</th>
				<th>Assign Games</th>
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
				<?php foreach ($games as $game): ?>
				<td><?php htmlout($game['game']); ?></td>
				<td><input type="checkbox" value="<?php htmlout($game['id']); ?>"></td></tr><td></td>
				<?php endforeach; ?>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="3">
					<input type="submit" value="Assign Games">
				</td>
			</tr>
	</table>


</html>