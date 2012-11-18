<?php

include_once './config.php';
class DataController{
	
	protected $dataBase;
	
	public function __construct($dataBase){
		$dbPath='sqlite:'.DBPATH.$dataBase;
		$this->dataBase = new PDO($dbPath);
	}
	
	public function getNews(){
		return $this->dataBase->query('SELECT * FROM news')->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function getTopNews(){
		return $this->dataBase->query('SELECT * FROM topnews')->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function getLatestNews(){
		return $this->dataBase->query('SELECT * FROM latestNews')->fetchAll(PDO::FETCH_ASSOC);
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
	
	public function getServerName(){
		$servername=$this->dataBase->query('SELECT name from serverinfo');
		$servername=$servername->fetch(PDO::FETCH_ASSOC);
		return $servername['name'];
	}
	
	public function getCategoryNews($category){
		$categoryid=$this->dataBase->query('SELECT id from category where name=\''.$category.'\'');
		$categoryid=$categoryid->fetch(PDO::FETCH_ASSOC);
		$categoryid=$categoryid['id'];
		$news=$this->dataBase->query('SELECT * from news where categoryid='.$categoryid);
		
		$news=$news->fetchAll(PDO::FETCH_ASSOC);
		return $news;
	}
	
	public function getActiveCategories(){
		$categories=$this->dataBase->query('SELECT name from activecategories');
		$categories=$categories->fetchAll(PDO::FETCH_ASSOC);
		$aux=Array();
		foreach($categories as $row){
			$aux[]=$row['name'];
		}
		return $aux;
	}
	
	public function getNewsCategory($newsid){
		$catid=$this->dataBase->query('SELECT categoryid from news where id='.$newsid);
		$catid=$catid->fetch(PDO::FETCH_ASSOC);
		$catid=$catid['categoryId'];

		$category=$this->dataBase->query('SELECT name from category where id='.$catid);
		$category=$category->fetch(PDO::FETCH_ASSOC);
		return $category['name'];
	}
	
	public function getTags(){
		$tags=$this->dataBase->query('SELECT name from tag');
		$tags=$tags->fetchAll(PDO::FETCH_ASSOC);
		$aux=Array();
		foreach($tags as $row){
			$aux[]=$row['name'];
		}
		return $aux;
	}
	
	public function getCategories(){
		$cat=$this->dataBase->query('SELECT name from category');
		$cat=$cat->fetchAll(PDO::FETCH_ASSOC);
		$aux=Array();
		foreach($cat as $row){
			$aux[]=$row['name'];
		}
		return $aux;
	}
	
	private function seoUrl($string) {
		// Copyright: http://forum.codecall.net/topic/59486-php-create-seo-friendly-url-titles-slugs/#axzz2CahaTGrG
        //Unwanted:  {UPPERCASE} ; / ? : @ & = + $ , . ! ~ * ' ( )
        $string = strtolower($string);
        //Strip any unwanted characters
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        //Clean multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);
        //Convert whitespaces and underscore to dash
        $string = preg_replace("/[\s_]/", "-", $string);
        return $string;
	}

	public function getCategoryId($categoryname){
		$catid=$this->dataBase->query('SELECT id from category where name=\''.$categoryname.'\'');
		$catid=$catid->fetch(PDO::FETCH_ASSOC);
		return $catid['id'];
	}
	public function tagExists($tagname){
		$tagname=strtolower($tagname);
		$tag=$this->dataBase->query('SELECT * from tag tag where lower(name)=\''.$tagname.'\'');
		$tag=$tag->fetch(PDO::FETCH_ASSOC);
		return $tag!=NULL;
	}
	
	public function getTagId($tagname){
		$tagname=strtolower($tagname);
		$tag=$this->dataBase->query('SELECT id from tag tag where lower(name)=\''.$tagname.'\'');
		$tag=$tag->fetch(PDO::FETCH_ASSOC);
		return $tag['id'];
	}
	
	public function insertTag($tagname){
		$tagname=strtolower($tagname);
		$tag=$this->dataBase->query('INSERT into tag(name) values(\''.$tagname.'\')');
	}
	
	public function insertNews($authorid,$title,$content,$tagslist,$categoryname){
		
		$url=$this->seoUrl($title);
		$date= new DateTime();
		$date= $date->format('Y-m-d\TH:i:s');
		$categoryid= $this->getCategoryId($categoryname);
		
		// Insert news
		$this->dataBase->query('INSERT into news(title, url, datePosted,categoryId,userId,content) values(\''.$title.'\',\''.$url.'\',\''.$date.'\','.$categoryid.','.$authorid.',\''.$content.'\')');
		
		$newsid= $this->dataBase->query('select seq from sqlite_sequence where name=\'news\'');
		$newsid=$newsid->fetch(PDO::FETCH_ASSOC);
		$newsid=$newsid['seq'];
		// Handle tags
		$tagsArray=explode(",", $tagslist);
		foreach($tagsArray as $tag){
			if(!$this->tagExists($tag)){
				$this->insertTag($tag);
			}
			$tagid=$this->getTagId($tag);
			
			$this->dataBase->query('insert into newstag(newsId,tagId) values('.$newsid.','.$tagid.')');
			
		}
			
	}
	public function getUserPassword($email){
		$password=$this->dataBase->query('SELECT password from user where email=\''.$email.'\'');
		$password=$password->fetch(PDO::FETCH_ASSOC);
		return $password['password'];
	}
	public function auth($email,$password){
		$storepassword=$this->getUserPassword($email);
		return sha1($password)==$storepassword;
	}
	
	public function getUserByEmail($email){
		$user=$this->dataBase->query('select * from user where email=\''.$email.'\'');
		$user=$user->fetch(PDO::FETCH_ASSOC);
		return $user;
	}
	
	public function userCan($privilegeid,$action){
		
	}
};

$data=new DataController($_database);
?>