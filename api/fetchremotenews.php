<?php
	chdir('..');
	include  'datacontroller.php';
	header('Content-type: application/json');
	// Handle Errors
	$allErrors=Array("Missing start_date","Missing end_date", "Missing tags","start_date can't be greater or equal than end_date","start_date invalid format","end_date invalid format","Missing serverid");
	$error=NULL;
	$errorcode=NULL;
	if(!isset($_GET['serverid'])){
		$error=$allErrors[6];
		$errorcode=7;
	}

	else if(empty($_GET['start_date'])){
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
	} else{
		// Prepare
		$serverid=$_GET['serverid'];
		$tags=$_GET['tags'];
		$start_date=$_GET['start_date'];
		$end_date=$_GET['end_date'];
		$apiurl=$data->getServerURL($serverid);

		// Fetch news
		$remotenews=file_get_contents($apiurl."?start_date=".$start_date."&end_date=".$end_date."&tags=".$tags);
		echo $remotenews;

	}

?>