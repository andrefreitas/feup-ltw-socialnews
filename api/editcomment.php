<?php
	chdir('..');

	include_once 'datacontroller.php';
	include_once  'config.php';
	if(isset($_GET['apikey']) and $_GET['apikey']==$_apikey and isset($_GET['id']) and isset($_GET['content'])){
		$data->editComment($_GET['id'],$_GET['content']);
		echo json_encode(Array("Answer"=>"Ok"));
	} else {
		echo json_encode(Array("Answer"=>"Error"));
	}
?>