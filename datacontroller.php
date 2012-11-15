<?php

define('DBPATH','data/');

class DataController{
	
	protected $dataBase;
	
	public function __construct($dataBase){
		$dbPath='sqlite:'.DBPATH.$dataBase;
		$this->dataBase = new PDO($dbPath);
	}
	
	public function getNews(){
		return $this->dataBase->query('SELECT * FROM news');
	}
	
	public function getComments($newsId){
		return $this->dataBase->query('SELECT * FROM comment where newsid='.$newsId);
	}
	
	public function getNewsAuthor($newsId){
		$author=$this->dataBase->query('SELECT userid FROM news where id='.$newsId);
	}
};

$obj=new DataController('server.db');
$result=$obj->getNews();
$result=$obj->getComments(2);
foreach( $result as $row) {
	echo '<b>' . $row['content'] . ' </b><br/>';
	}
	
?>