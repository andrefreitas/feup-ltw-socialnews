<?php

define('DBPATH','data/');

class DataController{
	
	protected $dataBase;
	
	public function __construct($dataBase){
		$dbPath='sqlite:'.DBPATH.$dataBase;
		$this->dataBase = new PDO($dbPath);
	}
	
	public function getNews(){
		return $this->dataBase->query('SELECT * FROM news')->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function getComments($newsId){
		return $this->dataBase->query('SELECT * FROM comment where newsid='.$newsId)->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function getNewsAuthor($newsId){
		$authorid=$this->dataBase->query('SELECT userid FROM news where id='.$newsId);
		$authorid=$authorid->fetch(PDO::FETCH_ASSOC);
		$author=$this->dataBase->query('SELECT * from user where id='.$authorid['userId']);
		return $author->fetch(PDO::FETCH_ASSOC);
	}
	
	
};

$obj=new DataController('server.db');
$result=$obj->getNews();
$result=$obj->getComments(2);
$result=$obj->getNewsAuthor(1);
	
?>