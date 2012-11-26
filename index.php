<?php
	include_once  'view.php';
	$latestnews=$data->getLatestNews();
	$topnews=$data->getTopNews();
	@session_start();
	if(!isset($_SESSION['user'])){
		$_SESSION['privilegeid']=4;
	}
?>
<!DOCTYPE html>
<html>
	<head>
    	<title>Socialus social news for everyone</title>
        <link href="css/template.css" rel="stylesheet" type="text/css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script> 
        <script src="js/scripts.js"></script> 
        <?php loadLatestNewsTimes($latestnews); ?>
        <meta charset="utf-8">
        <link href="imgs/favicon.ico" rel="icon" type="image/x-icon" />
    </head>
    <body>
    	<?php include_once 'header.php'; ?>  
        <?php include_once 'menu.php'; ?>

        <div id="main">
        	<div class="container">
            	<div class="news">
                	<div class="latestNews">
                    	<h3>Latest News</h3>
                        <ul>
                        	<?php
							printLatestNews($latestnews);
							?>
                        </ul>
                    </div>
                    <script>
					updateLatestNewsTimes();
					</script>
                    <div class="mostPopular">
                    	<h3>Most popular</h3>
                        <?php
							printTopNews($topnews);
						?>
                        
                    </div>
                </div>
                <div class="sidebar">
                	<?php include_once 'userbox.php'; ?>  
                    <div class="comments">
                    	<h3>Comments</h3>
                    </div>
                </div>
            </div>
        </div>
        
    </body>
</html>