<?php

echo '<table><thead>';
	echo ' <tr> <th id="cen">Member ID</th> <th>First Name</th><th>Family Name</th> 
				<th>E-mail</th> <th>Phone</th> </tr></thead><tbody> ';
 	while ($row = $result->fetch_assoc())  {
				
 		echo '<tr><td id="cen" data-label="Member ID">' . $row['_memberID'];
		echo '</td><td data-label="First Name">' . $row['_first_name'];
		echo '</td><td data-label="Family Name">' . $row['_family_name'];
 		echo '</td><td data-label="Email">' . $row['_email'];
		echo '</td><td data-label="Phone">' . $row['_phone'];
 		echo '</td><td id="do"><a href="deleteplayer.php?Player=' . $row['_memberID'] . '">Delete Player</a>';
 		echo '</td><td id="do"><a href="editplayer.php?Player=' . $row['_memberID'] . '">Edit Player</a>'; 
 		echo '</td></tr>';
 	}
	echo '<tr>';
	$arr = array('Member ID', 'First Name', 'Family Name', 'Email', 'Phone');
	for($i=0;$i<=4;$i++) {
	echo '<td style="border: 1px solid black; border-radius: 5px;" data-label="'.$arr[$i].'">&nbsp</td>';
	}
	echo '<td id ="do" colspan="2"><a href="show_form.php">Add Player</a></td></tr></tbody>';
	
 	echo '</table>';



?>