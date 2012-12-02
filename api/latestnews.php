<?php
	chdir('..');
	header('Content-type: application/json');
	include_once 'datacontroller.php';
	include_once  'config.php';
	if(isset($_GET['apikey']) and $_GET['apikey']==$_apikey and isset($_GET['len'])){
	

		$news= $data->getLatestNews();
		$news=array_slice($news,0,$_GET['len']);

		echo json_encode(Array("Answer"=>"Ok","Data"=>$news));

	} else {
		echo json_encode(Array("Answer"=>"Error"));
	}
?>