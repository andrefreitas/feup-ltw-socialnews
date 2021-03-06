<?php

include_once './config.php';

class DataController{
	
	protected $dataBase;
	protected $siteurl;
	
	public function __construct($dataBase,$_siteurl){
		$dbPath='sqlite:'.DBPATH.$dataBase;
		$this->dataBase = new PDO($dbPath);
		$this->siteurl=$_siteurl;
	}
	
	public function getNews(){
		$news=$this->dataBase->query('SELECT * FROM news');
		return $news->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getUsers(){
		$users=$this->dataBase->query('SELECT * FROM user');
		return $users->fetchAll(PDO::FETCH_ASSOC);
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

	public function getNewsById($id){
		$news=$this->dataBase->query('SELECT * FROM news where id='.$id);
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
	
	public function getCategoryNewsById($categoryid){
		$news=$this->dataBase->query('SELECT * from news where categoryid='.$categoryid);
		$news=$news->fetchAll(PDO::FETCH_ASSOC);
		return $news;
	}

	public function getActiveCategories(){
		$categories=$this->dataBase->query('SELECT * from activecategories');
		$categories=$categories->fetchAll(PDO::FETCH_ASSOC);
		return $categories;
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
		$actionid=$this->dataBase->query('select id from useraction where name=\''.$action.'\'');
		$actionid=$actionid->fetch(PDO::FETCH_ASSOC);
		$actionid=$actionid['id'];
		$can=$this->dataBase->query('select * from userActionPrivilege where privilegeId='.$privilegeid.' and userActionId='.$actionid);
		$can=$can->fetch(PDO::FETCH_ASSOC);
		return $can!=NULL;
	}

	public function userExists($email){
		$user=$this->dataBase->query('select id from user where email=\''.$email.'\'');
		$user=$user->fetch(PDO::FETCH_ASSOC);
		return $user!=NULL;
	}

	public function addUser($name,$email, $password,$privilegename){

		$privilegename=strtolower($privilegename);
		$privilegeid=$this->dataBase->query('select id from privilege where lower(name)=\''.$privilegename.'\'');
		$privilegeid=$privilegeid->fetch(PDO::FETCH_ASSOC);
		$privilegeid=$privilegeid['id'];
		$password=sha1($password);

		if($this->userExists($email))
		{
			return -1;
		}
		
		$this->dataBase->query("insert into user(name, email, password,privilegeId) 
	    						values(\"".$name."\",\"".$email."\",\"".$password."\",".$privilegeid.")");

	}

	public function searchNews($keyword,&$sqlnews=NULL){
		$keyword=strtolower($keyword);
		$topnews=$this->getTopNews();

		if(strlen($keyword)==0) return Array();

		$newsfound=Array();
		foreach($topnews as $row){
				// All to lowercase
				$content=strtolower($row['content']);
				$title=strtolower($row['title']);

				// Split in keywords array
				$contentArray=preg_split("/[\s,]+/",$content);
				$titleArray=preg_split("/[\s,]+/",$title);

				$substringfound="NONE";
				$foundkeyword=0;

				// Check if found and fetch the substring
				if(strpos($title,$keyword)){
					$pos=strpos($title,$keyword);
					$startpos=$pos-15;
					if($startpos<0) $startpos=0;
					$len=$pos+strlen($keyword)+15 - $startpos + 1;
					if($len>strlen($title)) $len=strlen($keyword);
					//echo substr($title,$startpos,$len);
					//echo"<br>";
					$substringfound=substr($title,$startpos,$len);
					$foundkeyword=1;
				}
				else if(strpos($content,$keyword)){
					$pos=strpos($content,$keyword);
					$startpos=$pos-15;
					if($startpos<0) $startpos=0;
					$len=$pos+strlen($keyword)+15 - $startpos + 1;
					if($len>strlen($content)) $len=strlen($keyword);
					//echo substr($content,$startpos,$len);
					//echo"<br>";
					$substringfound=substr($content,$startpos,$len);
					$foundkeyword=1;
				}

				// If found put in the result
				if($foundkeyword){
					$found=Array();
					$found['url']="article.php?url=".$row['url'];
					$found['title']=$row['title'];
					$found['excerpt']=$substringfound;
					$newsfound[]=$found;
					// Standard row format
					$sqlnews[]=$row;
					
				}
		}
		return $newsfound;
	}

	function getPrivilegeName($privilegeid){
		$privilege=$this->dataBase->query('select name from privilege where id='.$privilegeid);
		$privilege=$privilege->fetch(PDO::FETCH_ASSOC);
		return $privilege['name'];
	}

	function getPrivileges(){
		$privileges=$this->dataBase->query('select name from privilege');
		$privileges=$privileges->fetchAll(PDO::FETCH_ASSOC);
		$aux=Array();
		foreach($privileges as $row){
			$aux[]=$row['name'];
		}
		return $aux;
	}

	function deleteUserById($id){
		$this->dataBase->query('delete from user where id='.$id);
	}

	function getPrivilegeId($name){
		$id=$this->dataBase->query('select id from privilege where name=\''.$name.'\'');
		$id=$id->fetch(PDO::FETCH_ASSOC);
		$id=$id['id'];
		return $id;
	}
	function editUser($id,$name,$password,$email,$privilege,$about){
		$privilegeid=$this->getPrivilegeId($privilege);
		if($privilege!=NULL){
			$this->dataBase->query('update user set privilegeid=\''.$privilegeid.'\' where id='.$id);
		}

		if($name!=NULL){
			$this->dataBase->query('update user set name=\''.$name.'\' where id='.$id);
		}

		if($password!=NULL){
			$password=sha1($password);
			$this->dataBase->query('update user set password=\''.$password.'\' where id='.$id);
		}

		if($email!=NULL){
			$this->dataBase->query('update user set email=\''.$email.'\' where id='.$id);
		}

		if($about!=NULL){
			$this->dataBase->query('update user set about=\''.$about.'\' where id='.$id);
		}

	}

	function addServer($servername, $serverurl){
		$this->dataBase->query('insert into newsserver(name, apiurl) values(\''.$servername.'\',\''.$serverurl.'\')');
		$serverid= $this->dataBase->query('select seq from sqlite_sequence where name=\'newsServer\'');
		$serverid=$serverid->fetch(PDO::FETCH_ASSOC);
		$serverid=$serverid['seq'];
		return $serverid;
	}

	function getServers(){
		$servers=$this->dataBase->query('select * from newsserver');
		$servers=$servers->fetchAll(PDO::FETCH_ASSOC);
		return $servers;
	}

	function getServerURL($serverid){
		$serverurl=$this->dataBase->query('select apiurl from newsserver where serverId='.$serverid);
		$serverurl=$serverurl->fetch(PDO::FETCH_ASSOC);
		return $serverurl['apiurl'];
	}

	function addRemoteNews($serverid,$title,$url){
		$this->dataBase->query("insert into remotenews(remoteserverid,title,url) values(".$serverid.",\"".$title."\",\"".$url."\")");
	}

	function getRemoteNews(){
		$news=$this->dataBase->query('select * from remotenews');
		$news=$news->fetchAll(PDO::FETCH_ASSOC);
		return $news;
	}

	function isfavorite($userid, $newsid){
		$favorite=$this->dataBase->query("select * from favorite where userid=".$userid." and newsid=".$newsid);
		$favorite=$favorite->fetch(PDO::FETCH_ASSOC);
		return $favorite!=NULL;
	}

	function favoriteNews($userid, $newsid){
		$this->dataBase->query("insert into favorite(userid,newsid) values(".$userid.",".$newsid.")");
	}

	function unfavoriteNews($userid, $newsid){
		$this->dataBase->query("delete from favorite where userid=".$userid." and newsid=".$newsid);
	}

	function getFavoriteNews($userid){
		$news=$this->dataBase->query("select * from news where id in(select newsid from favorite where userid=".$userid.")");
		$news=$news->fetchAll(PDO::FETCH_ASSOC);
		return $news;
	}

	function addComment($userid,$newsid,$content){
		$date= new DateTime();
		$date= $date->format('Y-m-d\TH:i:s');
		$query="insert into comment(userId,newsId,datePosted,content) values (".$userid.",".$newsid.",\"".$date."\",\"".$content."\")";
		$this->dataBase->query($query);

		// Get commentid
		$id=$this->dataBase->query('select seq from sqlite_sequence where name=\'comment\'');
		$id=$id->fetch(PDO::FETCH_ASSOC);
		$id=$id['seq'];
		return $id;
	}

	function deleteComment($id){
		$this->dataBase->query("delete from comment where id=".$id);

	}

	function getNewsComments($newsid){
		$comments=$this->dataBase->query("select * from comment where newsid=".$newsid);
		$comments=$comments->fetchAll(PDO::FETCH_ASSOC);
		return $comments;
	}

	function getCommentAuthor($id){
		$authorid=$this->dataBase->query('SELECT userid FROM comment where id='.$id);
		$authorid=$authorid->fetch(PDO::FETCH_ASSOC);
		$author=$this->dataBase->query('SELECT * from user where id='.$authorid['userId']);
		return $author->fetch(PDO::FETCH_ASSOC);
	}

	function editComment($id,$content){
		$this->dataBase->query("update comment set content=\"".$content."\" where id=".$id);
	}

	function deleteServer($id){
		$this->dataBase->query("delete from newsserver where serverid=".$id);
		$this->dataBase->query("delete from remotenews where remoteserverid=".$id);
	}

	function editNews($id,$title,$content,$tagslist,$category){
		if($title!=NULL)  $this->dataBase->query("update news set title=\"".$title."\" where id=".$id);
		if($content!=NULL)  $this->dataBase->query("update news set content=\"".$content."\" where id=".$id);
		if($tagslist!=NULL){
			$this->dataBase->query("delete from newstag where newsId=".$id);
			$tagsArray=explode(",", $tagslist);
			foreach($tagsArray as $tag){
				if(!$this->tagExists($tag)){
					$this->insertTag($tag);
				}
				$tagid=$this->getTagId($tag);
				
				$this->dataBase->query('insert into newstag(newsId,tagId) values('.$id.','.$tagid.')');
				
			}
		}
		if($category!=NULL){
			$categoryid= $this->getCategoryId($category);
			$this->dataBase->query("update news set categoryid=\"".$categoryid."\" where id=".$id);
		}


	}

	function deleteNews($id){
		$this->dataBase->query("delete from news where id=".$id);
	}

	function getAllNewsFromAuthor($id){
		$news=$this->dataBase->query('SELECT * from news where userid='.$id);
		$news=$news->fetchAll(PDO::FETCH_ASSOC);
		return $news;
	}

 	function getUserByid($id){
		$user=$this->dataBase->query('SELECT * FROM user where id='.$id);
		$user=$user->fetch(PDO::FETCH_ASSOC);
		return $user;

 	}

 	function getUserComments($userid){
 		$comments=$this->dataBase->query('SELECT * FROM comment where userid='.$userid);
		$comments=$comments->fetchAll(PDO::FETCH_ASSOC);
		return $comments;
 	}

 	function getCommentNews($commentid){
 		$newsid=$this->dataBase->query('SELECT newsid FROM comment where id='.$commentid);
		$newsid=$newsid->fetch(PDO::FETCH_ASSOC);
		$newsid=$newsid['newsId'];
		return $this->getNewsById($newsid);
 	}

 	function getLastComments(){
 		$comments=$this->dataBase->query("SELECT * FROM latestComments");
		$comments=$comments->fetchAll(PDO::FETCH_ASSOC);
		return $comments;
 	}

};
$data=new DataController($_database,$_siteurl);
?>