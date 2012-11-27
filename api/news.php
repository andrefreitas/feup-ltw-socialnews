<?php
	chdir('..');
	include  'datacontroller.php';
	header('Content-type: application/json');
	// Handle Errors
	$allErrors=Array("Missing start_date","Missing end_date", "Missing tags","start_date can't be greater or equal than end_date","start_date invalid format","end_date invalid format");
	$error=NULL;
	$errorcode=NULL;
	if(empty($_GET['start_date'])){
		$error=$allErrors[0];
		$errorcode=1;
	} else if(empty($_GET['end_date'])){
		$error=$allErrors[1];
		$errorcode=2;
	} else if (empty($_GET['tags'])){
		$error=$allErrors[2];
		$errorcode=3;
	} else if(!empty($_GET['start_date']) and !empty($_GET['end_date'])){
		// Check dates format and interval between
		$wrongFormat=false;
		try{
			$d1=new DateTime($_GET['start_date']);
		}
		catch(Exception $e){
  			$error=$allErrors[4];
		    $errorcode=5;
			$wrongFormat=true;
  		}
		
		try{
			$d2=new DateTime($_GET['end_date']);
		}
		catch(Exception $e){
  			$error=$allErrors[5];
		    $errorcode=6;
			$wrongFormat=true;
  		}
		
		if($wrongFormat==false and $d2<=$d1){
			$error=$allErrors[3];
			$errorcode=4;
		}
	}

	
	// If error found -->
	if($error!=NULL){
		$errorArray=Array("result"=>'error',"reason"=>$error,"code"=>$errorcode);
		$errorJson=json_encode($errorArray);
		echo $errorJson;
	} else {
	
	// Else -->
	
	$start_date=$_GET["start_date"];
	$end_date=$_GET["end_date"];
	$tags=explode(' ',$_GET["tags"]);
	$servername=$data->getServerName();
	
	$newsJson=Array("result"=>"success","serve_name"=>$servername,"data"=>Array());
	// Handle news
	$news=$data->getNewsFilter($tags,$start_date,$end_date);
	foreach($news as $row){
		$newsurl=$_siteurl."/article.php?url=".$row['url'];
		$author=$data->getNewsAuthor($row['id']);
		$author=$author['name'];
		$tags=$data->getNewsTags($row['id']);
		$newsJson['data'][]=Array("id"=>$row["id"],"title"=>$row["title"],"date"=>$row["datePosted"],"text"=>$row["content"],"posted_by"=>$author,"url"=>$newsurl,"tags"=>$tags);
	}
	echo json_encode($newsJson);
	

	}
	
?>