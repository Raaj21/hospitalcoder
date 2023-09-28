<?php 
require_once 'includes/connection.php'; 
require_once 'includes/utility-class.php'; 

if(isset($_GET['file']))
{
	$file = $_GET['file'];
}
else{
	$file = 'index';
}

if(isset($_GET['folder']))
{
	$folder = $_GET['folder'];
}
else{
	$folder = '';
}

header("Location:".""."$file.php"); 