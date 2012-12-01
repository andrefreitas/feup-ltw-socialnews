<?php
	chdir('..');
	include  'datacontroller.php';
	header('Content-type: application/json');

	if(isset($_GET['apikey']) and $_GET['apikey']==$_apikey and isset($_GET['serverid']) and isset($_GET['title']) and isset($_GET['url'])){
		$data->addRemoteNews($_GET['serverid'],$_GET['title'],$_GET['url']);
		echo json_encode(Array("Answer"=>"Ok"));
	}else {
		echo json_encode(Array("Answer"=>"Error"));
	}
?>
