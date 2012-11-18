<?php
include 'datacontroller.php';
if(isset($_POST['email']) and isset($_POST['password'])){
	if($data->auth($_POST['email'],$_POST['password'])){
		 session_start();
		 $_SESSION['user'] = $data->getUserByEmail($_POST['email']);
		 $_SESSION['privilegeid']=$_SESSION['user']['privilegeId'];
		 header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	else {
		
	}
}
?>