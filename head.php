<?php
	@session_start();
	if(!isset($_SESSION['user'])){
		$_SESSION['privilegeid']=4;
    }

?>
	
	<link href="imgs/favicon.ico" rel="icon" type="image/x-icon" />
	<link href="css/template.css" rel="stylesheet" type="text/css">
	<link href="css/edit.css" rel="stylesheet" type="text/css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script> 
	<script src="js/livesearch.js"></script> 
	<script src="js/scripts.js"></script> 
	<meta charset="utf-8">