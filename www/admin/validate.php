<?php

/* create validation functions */

function checkName($name)
{
	return preg_match("/[a-zA-Z]/", $name);
}

function checkEmail($mail)
{
	return preg_match("/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/", $mail);
}

function checkPhone($num)
{
	return preg_match("/^(0|(\+64(\s|-)?)){1}(\d{1}|(21|22|27|29){1})(\s|-)?\d{3}(\s|-)?\d{4}$/", $num);
}

function checkGame($game)
{
	return preg_match("/^[a-zA-Z][a-zA-Z ]*[a-zA-Z]$/", $game);
}

?>