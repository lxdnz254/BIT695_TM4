<?php
echo '<table><thead>';
	echo ' <tr> <th id="cen">Event</th> <th>Name</th><th>Score</th> 
				<th>Final</th>  </tr></thead><tbody> ';
 	while ($row = $result->fetch_assoc())  {
				
 		echo '<tr><td id="cen" data-label="Event">' . $row['_event_name'];
		echo '</td><td data-label="Name">' . $row['_first_name'] . ' ' . $row['_family_name'];
		echo '</td><td data-label="Score">' . $row['_current_score'];
 		echo '</td><td data-label="Final">' . $row['_final_score'];
 		echo '</td><td id="do"><a href="delete.php?scores&member=' . $row['_memberID'] . '&event=' . $row['_eventID'] . '">Delete Player</a>';
 		echo '</td><td id="do"><a href="edit.php?scores&member=' . $row['_memberID'] . '&event=' . $row['_eventID'] . '">Edit Player</a>'; 
 		echo '</td></tr>';
 	}
	echo '<tr>';
	$arr = array('Event', 'Name', 'Score', 'Final Score');
	for($i=0;$i<=3;$i++) {
	echo '<td style="border: 1px solid black; border-radius: 5px;" data-label="'.$arr[$i].'">&nbsp</td>';
	}
	echo '<td id ="do" colspan="2"><a href="show_form.php?scores">Add Score</a></td></tr></tbody>';
	
 	echo '</table>';
?>