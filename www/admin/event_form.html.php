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
 
<form id="form_box" name="event" method="POST" enctype="application/x-www-form-urlencoded"
	action="{{action}}" onsubmit="return checkForm(this)" target="_self"> 

	<table>
		<!-- All forms title="" entry is error message displayed for invalid entry -->
		
		<!-- Game should not be empty and should be a string not a number -->
		<tr>
			<td id="form_text">Event: </td>
			<td>
				<input type="text" name="eventname" id="event_name" size="35" 
						maxlength="50" required pattern="^[a-zA-Z][a-zA-Z ]*[a-zA-Z]$"
						value="{{event}}" title="Please enter letters only!"
						placeholder="Event name" tabindex="4"/>
			</td>
		</tr>
		
		<tr>
			<td id="form_text">Venue: </td>
			<td>
				<input type="text" name="venuename" id="venue_name" size="35" 
						maxlength="50" required pattern="^[a-zA-Z][a-zA-Z ]*[a-zA-Z]$"
						value="{{venue}}" title="Please enter letters only!"
						placeholder="Venue name" tabindex="5"/>
			</td>
		</tr>

		<!-- Select should reference the list of boardgames as called from database -->
		<tr>
			<td id="form_text">Boardgame:</td>
			<td> 
				<select name="boardgame" id="games" tabindex="6"/>
				
					<?php foreach ($games as $game): ?>
					<option value="<?php htmlout($game['id']); ?>"><?php htmlout($game['game']); ?></option>
					<?php endforeach; ?>
				</select>
				
			</td>
		</tr>

		<!-- Date start selection  -->
		<tr>
			<td id="form_text">Date start:</td>
			<td> 
				<input type="date" name="dstart" id="date" 
						value="{{dstart}}" 
						placeholder="Select the start date" tabindex="7"/>
			</td>
		</tr>
		
		<!-- Time start selection  -->
		<tr>
			<td id="form_text">Time start:</td>
			<td> 
				<input type="time" name="tstart" id="time" 
						value="{{tstart}}" 
						placeholder="Select the start time" tabindex="8"/>
			</td>
		</tr>
		
		<!-- Date finish selection  -->
		<tr>
			<td id="form_text">Date finish:</td>
			<td> 
				<input type="date" name="dfinish" id="date" 
						value="{{dfinish}}" 
						placeholder="Select the finish date" tabindex="9"/>
			</td>
		</tr>
		
		<!-- Time finish selection  -->
		<tr>
			<td id="form_text">Time finish:</td>
			<td> 
				<input type="time" name="tfinish" id="time" 
						value="{{tfinish}}" 
						placeholder="Select the finish time" tabindex="10"/>
			</td>
		</tr>

		<!-- Number will be selected by spinner, will always have a result -->
		<tr>
			<td id="form_text">Registered players:</td>
			<td> 
				<input type="number" name="reg_players" id="max_players" size="5" min="0" max="20" 
					 tabindex="11"/>
			</td>
		</tr>

	</table>

	<p id="register"><input type="submit" name="submit" 
						value="{{Register}}" tabindex="12"></p>

</form>

</html>