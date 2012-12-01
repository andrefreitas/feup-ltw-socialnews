<?php
	chdir('..');

	include_once 'datacontroller.php';
	include_once  'config.php';
	if(isset($_GET['apikey']) and $_GET['apikey']==$_apikey and isset($_GET['userid']) and isset($_GET['newsid']) and isset($_GET['content'])){
		$id=$data->addComment($_GET['userid'],$_GET['newsid'],$_GET['content']);
		echo json_encode(Array("Answer"=>"Ok","id"=>$id));
	} else {
		echo json_encode(Array("Answer"=>"Error"));
	}
?>