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
 
<form id="form_box" name="assign" method="POST" enctype="application/x-www-form-urlencoded"
	action="{{action}}" onsubmit="return checkForm(this)" target="_self"> 

	<table>
		<!-- All forms title="" entry is error message displayed for invalid entry -->
		
		<!-- Game should not be empty and should be a string not a number -->
		<tr>
			<td id="form_text">Event: </td>
			<td>
				<select name="event" id="event" tabindex="4"/>
				
					<?php foreach ($events as $event): ?>
					<option value="<?php htmlout($event['id']); ?>"><?php htmlout($event['event']); ?></option>
					<?php endforeach; ?>
				</select>
			</td>
		</tr>
		
		<tr>
			<td id="form_text">Member: </td>
			<td>
				<select name="member" id="member" tabindex="5"/>
				
					<?php foreach ($players as $player): ?>
					<option value="<?php htmlout($player['id']); ?>"><?php htmlout($player['name']); ?></option>
					<?php endforeach; ?>
				</select>
			</td>
		</tr>

		<!-- Number spinner to select position -->
		<tr>
			<td id="form_text">Position:</td>
			<td> 
				<input type="number" name="position" id="position" value="{{position}}" size="5" min="0" max="20" tabindex="6"/>			
			</td>
		</tr>

		<!-- Textbox for notes  -->
		<tr>
			<td id="form_text">Notes:</td>
			<td> 
				<input type="textbox" name="notes" id="notes" 
						value="{{notes}}" rows="4" cols="50"
						placeholder="Write notes about the game" tabindex="7"/>
			</td>
		</tr>
			
		
		<!-- Date selection  -->
		<tr>
			<td id="form_text">Date:</td>
			<td> 
				<input type="date" name="date" id="date" 
						value="{{date}}" 
						placeholder="Select the date" tabindex="9"/>
			</td>
		</tr>

	</table>

	<p id="register"><input type="submit" name="submit" 
						value="{{Register}}" tabindex="12"></p>

</form>

</html>