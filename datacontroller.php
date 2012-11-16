<?php

require("./config.php");
 
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
	
	public function getNewsFilter($tags,$start_date,$end_date){
		// First fetch all news ids
		$news=$this->dataBase->query('SELECT * FROM news WHERE datetime(datePosted)>=datetime(\''.$start_date.'\') and datetime(datePosted)<=datetime(\''.$end_date.'\')');
		$news=$news->fetchAll(PDO::FETCH_ASSOC);
		//print_r($news);
		// If the filter is empty return all
		if(empty($tags)) return $news;
		
		// Check tags for every news
		$filteredNews=Array();
		foreach($news as $row){
			$newsTags=$this->getNewsTags($row['id']);
			// Intersect tags given and news tags arrays
			$commonTags=array_intersect($newsTags, $tags);
			if(!empty($commonTags)) $filteredNews[]=$row;
		}
		return $filteredNews;
	}
	
	public function getNewsTags($newsId){
		$tagsIds=$this->dataBase->query('SELECT tagId FROM newsTag where newsId='.$newsId);
		$tagsIds=$tagsIds->fetchAll(PDO::FETCH_ASSOC);
		
		$tags=Array();
		foreach($tagsIds as $row){
			$tagsId=$row['tagId'];
			$tagName=$this->dataBase->query('SELECT name FROM tag where id='.$tagsId);
			$tagName=$tagName->fetch(PDO::FETCH_ASSOC);
			$tagName=$tagName['name'];
			$tags[]=$tagName;
		}
		return $tags;
	}
	
	public function getNewsByUrl($url){
		$news=$this->dataBase->query('SELECT * FROM news where url=\''.$url.'\'');
		$news=$news->fetch(PDO::FETCH_ASSOC);
		return $news;
	}
};

/* test */
$obj=new DataController($database);

$result=$obj->getNews();
$result=$obj->getComments(2);
$result=$obj->getNewsAuthor(1);
$result=$obj->getNewsFilter(Array('Sociedade','Desporto'),'2010-10-03T00:00:00','2012-10-03T20:00:00');
$result=$obj->getNewsTags(1);
$result=$obj->getNewsByUrl('time-to-say-danke');
print_r($result);
?>