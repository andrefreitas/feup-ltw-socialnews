<?php
	chdir('..');
	header('Content-type: application/json');
	include_once 'datacontroller.php';
	include_once  'config.php';
	if(isset($_GET['apikey']) and $_GET['apikey']==$_apikey and isset($_GET['userid']) ){
		$userid=$_GET['userid'];
		$name=NULL;
		$email=NULL;
		$password=NULL;
		$privilege=NULL;

		if(isset($_GET['name'])) $name=$_GET['name'];
		if(isset($_GET['email'])) $email=$_GET['email'];
		if(isset($_GET['password'])) $password=$_GET['password'];
		if(isset($_GET['privilege'])) $privilege=$_GET['privilege'];

		$data->editUser($userid,$name,$password,$email,$privilege);

		echo json_encode(Array("Answer"=>"Ok"));

	} else {
		echo json_encode(Array("Answer"=>"Error"));
	}
?>