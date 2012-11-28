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
		if(strpos($_SERVER['HTTP_REFERER'],"?")){
			$_SERVER['HTTP_REFERER']=explode("?",$_SERVER['HTTP_REFERER']);
			$_SERVER['HTTP_REFERER']=$_SERVER['HTTP_REFERER'][0];
		}

		 header('Location: ' . $_SERVER['HTTP_REFERER']."?_alert=Invalid Login");
	}
}
?>