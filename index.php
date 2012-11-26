<!DOCTYPE html>
<html>
	<head>
    	<title>Socialus Home</title>
        <?php 
            include_once 'head.php';
            include_once  'view.php';

            $latestnews=$data->getLatestNews();
            $topnews=$data->getTopNews();
            loadLatestNewsTimes($latestnews); 
        ?>

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