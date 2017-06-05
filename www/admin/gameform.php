<?php include_once('../includes/helpers.inc.php'); ?>
<!-- Games form template -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="../css/form.css">

</head>

<!--calls to validate.js to check the form on non-html5 compatible browsers. 
	to test this on HTML5 compliant browsers add 'novalidate' to the form tag -->
<script type="text/javascript" src="../js/validate.js"></script>
 
<form id="form_box" name="game" method="POST" enctype="application/x-www-form-urlencoded"
	action="add.php?games" onsubmit="return checkForm(this)" target="_self"> 

	<table>
		<!-- All forms title="" entry is error message displayed for invalid entry -->
		
		<!-- Game should not be empty and should be a string not a number -->
		<tr>
			<td id="form_text">Game: </td>
			<td>
				<input type="text" name="boardgame" id="board_game" size="35" 
						maxlength="50" required pattern="^[a-zA-Z][a-zA-Z ]*[a-zA-Z]$"
						value="" title="Please enter letters only!"
						placeholder="Board game name" tabindex="4"/>
			</td>
		</tr>

		<!-- Name should reference the list of players as called from database -->
		<tr>
			<td id="form_text">Owner:</td>
			<td> 
				<select name="owner" id="owner" tabindex="5"/>
				
					<?php foreach ($players as $player): ?>
					<option value="<?php htmlout($player['id']); ?>"><?php htmlout($player['name']); ?></option>
					<?php endforeach; ?>
				</select>
				
			</td>
		</tr>

		<!-- Checkbox is checked to inidicate the game is being played currently  -->
		<tr>
			<td id="form_text">Playing:</td>
			<td> 
				<input type="checkbox" name="playing" id="playing" 
						value="0" 
						placeholder="Check if game is in play" tabindex="6"/>
			</td>
		</tr>

		<!-- Number will be selected by spinner, will always have a result -->
		<tr>
			<td id="form_text">Maximum players:</td>
			<td> 
				<input type="number" name="max_players" id="max_players" size="5" min="2" max="20" 
					 tabindex="7"/>
			</td>
		</tr>

	</table>

	<p id="register"><input type="submit" name="submit" 
						value="Add Game" tabindex="8"></p>

</form>

</html>