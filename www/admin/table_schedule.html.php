<?php
echo '<table><thead>';
	echo ' <tr> <th id="cen">Event</th> <th>Venue</th><th>Start</th> 
				<th>Finish</th> <th>Game</th><th>No. Entered</th> </tr></thead><tbody> ';
 	while ($row = $result->fetch_assoc())  {
				
 		echo '<tr><td id="cen" data-label="Event">' . $row['_event_name'];
		echo '</td><td data-label="Venue">' . $row['_venue'];
		echo '</td><td data-label="Start">' . timeset($row['_date_start'], $row['_time_start']);
 		echo '</td><td data-label="Finish">' . timeset($row['_date_finish'], $row['_time_finish']);
		echo '</td><td data-label="Game">' . $row['_boardgame'];
		echo '</td><td data-label="Entered">' . $row['_registered_players'];
 		echo '</td><td id="do"><a href="delete.php?event=' . $row['_eventID'] . '">Delete Event</a>';
 		echo '</td><td id="do"><a href="edit.php?event=' . $row['_eventID'] . '">Edit Event</a>'; 
 		echo '</td></tr>';
 	}
	echo '<tr>';
	$arr = array('Event', 'Venue', 'Start', 'Finish', 'Game', 'No. Entered');
	for($i=0;$i<=5;$i++) {
	echo '<td style="border: 1px solid black; border-radius: 5px;" data-label="'.$arr[$i].'">&nbsp</td>';
	}
	echo '<td id ="do" colspan="2"><a href="show_form.php?event">Add Event</a></td></tr></tbody>';
	
 	echo '</table>';
	
function timeset($date,$time) {
	
	$change = strtotime($date .' '. $time);
	$output = date("D d M g:i A", $change);
	
	return $output;
}
?>