<?php
	chdir('..');
	header('Content-type: application/json');
	include_once 'datacontroller.php';
	include_once  'config.php';
	if(isset($_GET['apikey']) and $_GET['apikey']==$_apikey and isset($_GET['id']) ){
		$id=$_GET['id'];
		$title=NULL;
		$content=NULL;
		$tagslist=NULL;
		$category=NULL;

		if(isset($_GET['title'])) $title=$_GET['title'];
		if(isset($_GET['content'])) $content=$_GET['content'];
		if(isset($_GET['tagslist'])) $tagslist=$_GET['tagslist'];
		if(isset($_GET['category'])) $category=$_GET['category'];

		$data->editNews($id,$title,$content,$tagslist,$category);

		echo json_encode(Array("Answer"=>"Ok"));

	} else {
		echo json_encode(Array("Answer"=>"Error"));
	}
?>