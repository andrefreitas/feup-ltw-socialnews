<?php
	chdir('..');
	include  'datacontroller.php';
	if(!empty($_GET['keywords'])){
		header('Content-type: application/json');
		$found=$data->searchNews($_GET['keywords']);
		$len=sizeof($found);
		$jsonAnswer=Array("results" =>$len,"data"=>$found);
		echo json_encode($jsonAnswer);
	}

?>