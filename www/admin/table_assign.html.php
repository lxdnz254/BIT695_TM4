<?php
echo '<table><thead>';
	echo ' <tr> <th id="cen">Event</th> <th>Name</th><th>Position</th> 
				<th>Date</th> <th>Notes</th> </tr></thead><tbody> ';
 	while ($row = $result->fetch_assoc())  {
				
 		echo '<tr><td id="cen" data-label="Event">' . $row['_event_name'];
		echo '</td><td data-label="Name">' . $row['_first_name'] . ' ' . $row['_family_name'];
		echo '</td><td data-label="Position">' . $row['_position'];
 		echo '</td><td data-label="Date">' . $row['_date'];
		echo '</td><td data-label="Notes">' . $row['_notes'];
 		echo '</td><td id="do"><a href="delete.php?assign&member=' . $row['_memberID'] . '&event=' . $row['_eventID'] . '">Delete Player</a>';
 		echo '</td><td id="do"><a href="edit.php?assign&member=' . $row['_memberID'] . '&event=' . $row['_eventID'] . '">Edit Player</a>'; 
 		echo '</td></tr>';
 	}
	echo '<tr>';
	$arr = array('Event', 'Name', 'Position', 'Date', 'Notes');
	for($i=0;$i<=4;$i++) {
	echo '<td style="border: 1px solid black; border-radius: 5px;" data-label="'.$arr[$i].'">&nbsp</td>';
	}
	echo '<td id ="do" colspan="2"><a href="show_form.php?assign">Assign Player</a></td></tr></tbody>';
	
 	echo '</table>';
?>