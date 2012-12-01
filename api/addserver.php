<?php
	chdir('..');
	header('Content-type: application/json');
	include_once 'datacontroller.php';
	include_once  'config.php';
	if(isset($_GET['apikey']) and $_GET['apikey']==$_apikey and isset($_GET['servername']) and isset($_GET['serverurl'])){
		$serverid= $data->addServer($_GET['servername'],$_GET['serverurl']);
		echo json_encode(Array("Answer"=>"OK","Serverid"=>$serverid));

	}  else {
		echo json_encode(Array("Answer"=>"Error"));
	}

?>