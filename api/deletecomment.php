<?php
	chdir('..');

	include_once 'datacontroller.php';
	include_once  'config.php';
	if(isset($_GET['apikey']) and $_GET['apikey']==$_apikey and isset($_GET['id'])){
		$data->deleteComment($_GET['id']);
		echo json_encode(Array("Answer"=>"Ok"));
	} else {
		echo json_encode(Array("Answer"=>"Error"));
	}
?>