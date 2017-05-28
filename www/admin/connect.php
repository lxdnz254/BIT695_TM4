<?php

/* 	.... initialise database variables .... 
	these should be altered to suit match the server */

$uid = "root";
$pwd = "root";
$database = "act5";
$host = '127.0.0.1:3306';
$table1 = "players";
$table2 = "board_games";

/* create database functions */

function connect_db($host, $uid, $pwd, $database) {  	
	$conn=mysqli_connect($host, $uid, $pwd, $database)
	or die('connection problem:' . mysqli_connect_error());

 	return $conn;
 }
 
?>