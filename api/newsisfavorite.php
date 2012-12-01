<?php
	chdir('..');

	include_once 'datacontroller.php';
	include_once  'config.php';
	if(isset($_GET['apikey']) and $_GET['apikey']==$_apikey and isset($_GET['userid']) and isset($_GET['newsid'])){
		if($data->isfavorite($_GET['userid'], $_GET['newsid']))
		echo json_encode(Array("Answer"=>"yes"));
		else echo json_encode(Array("Answer"=>"no"));
	} else {
		echo json_encode(Array("Answer"=>"Error"));
	}
?>