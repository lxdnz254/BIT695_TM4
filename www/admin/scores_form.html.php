<?php include_once('../includes/helpers.inc.php'); ?>
<!-- Scores form template -->
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
 
<form id="form_box" name="scores" method="POST" enctype="application/x-www-form-urlencoded"
	action="{{action}}" onsubmit="return checkForm(this)" target="_self"> 

	<table>
		<!-- All forms title="" entry is error message displayed for invalid entry -->
		
		<!-- Game should not be empty and should be a string not a number -->
		<tr>
			<td id="form_text">Event: </td>
			<td>
				<select name="event" id="event" tabindex="4"/>
				
					<?php foreach ($events as $event): ?>
					<option value="<?php htmlout($event['id']); ?>" <?php 
						if ($event['id'] == {{eid}}) {?> selected="selected" <?php } ?>
						><?php htmlout($event['event']); ?></option>
					<?php endforeach; ?>
				</select>
			</td>
		</tr>
		
		<tr>
			<td id="form_text">Member: </td>
			<td>
				<select name="member" id="member" tabindex="5"/>
				
					<?php foreach ($players as $player): ?>
					<option value="<?php htmlout($player['id']); ?>" <?php 
						if ($player['id'] == {{pid}}) {?> selected="selected" <?php } ?>
						><?php htmlout($player['name']); ?></option>
					<?php endforeach; ?>
				</select>
			</td>
		</tr>

		<!-- Number spinner to select current score -->
		<tr>
			<td id="form_text">Current Score:</td>
			<td> 
				<input type="number" name="curscore" id="score" value="{{curscore}}" size="5" min="0" max="2000" tabindex="6"/>			
			</td>
		</tr>

		<!-- Textbox for notes  -->
		<tr>
			<td id="form_text">Final Score:</td>
			<td> 
				<input type="number" name="finscore" id="score" value="{{finscore}}" size="5" min="0" max="2000" tabindex="7"/>
			</td>
		</tr>

	</table>

	<p id="register"><input type="submit" name="submit" 
						value="{{Register}}" tabindex="12"></p>

</form>

</html>