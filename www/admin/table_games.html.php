<?php
echo '<table><thead>';
	echo ' <tr> <th id="cen">Board Game</th> <th>Owner</th><th>In Play</th> 
				<th>Maximum Players</th></tr></thead><tbody> ';
 	while ($row = $result->fetch_assoc())  {
				
 		echo '<tr><td id="cen" data-label="BoardGame">' . $row['_boardgame'];
		echo '</td><td data-label="Owner">' . $row['_first_name'].' '.$row['_family_name'];
		
		echo '</td><td data-label="InPlay"><input type="checkbox" ' . ($row['_playing'] == 1 ? 'checked="checked"' :'').' value="0" disabled/>';
 		echo '</td><td data-label="MaxPlayers">' . $row['_number_of_players'];
 		echo '</td><td id="do"><a href="delete.php?game=' . $row['_boardgameID'] . '">Delete Game</a>';
 		echo '</td><td id="do"><a href="edit.php?game=' . $row['_boardgameID'] . '">Edit Game</a>'; 
 		echo '</td></tr>';
 	}
	echo '<tr>';
	$arr = array('BoardGame', 'Owner', 'InPlay', 'MaxPlayers');
	for($i=0;$i<=3;$i++) {
	echo '<td style="border: 1px solid black; border-radius: 5px;" data-label="'.$arr[$i].'">&nbsp</td>';
	}
	echo '<td id ="do" colspan="2"><a href="show_form.php?games">Add Game</a></td></tr></tbody>';
	
 	echo '</table>';
	

?>