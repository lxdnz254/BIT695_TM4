<?php
include_once('../includes/helpers.inc.php');

if (isset($_GET['output'])) {
	
	$output = $_GET['output'];
	
?>
	
<html>
	<body>
		<p><?php htmlout($output) ?></p>
		<a href="choose.php"><input type="button" name="OK" value="OK"></a>
	</body>
<html>
<?php

}
else {
	header('Location: choose.php');
}