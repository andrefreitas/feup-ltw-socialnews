<?php
	chdir('..');

	include_once 'datacontroller.php';
	include_once  'config.php';
	if(isset($_GET['apikey']) and $_GET['apikey']==$_apikey and isset($_GET['userid']) and isset($_GET['newsid']) and isset($_GET['action'])){
		if($_GET['action']==1)
			$data->favoriteNews($_GET['userid'], $_GET['newsid']);
		else 
			$data->unfavoriteNews($_GET['userid'], $_GET['newsid']);
		echo json_encode(Array("Answer"=>"Ok"));
	} else {
		echo json_encode(Array("Answer"=>"Error"));
	}
?>