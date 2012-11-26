<!DOCTYPE html>
<html>
	<head>
    	<title>Socialus social news for everyone</title>
        <?php
            include_once 'head.php';
        ?>
    </head>
    <body>

        <?php include_once 'header.php'; ?>  
        <?php include_once 'menu.php'; ?>
        
        <div id="main">
        	<div class="container">
            	<div class="news">
                    <div class="article">
    				<?php
    					$news=$data->getNewsByUrl($_GET['url']);
    					echo "<h1>".$news['title']."</h1>";
    					$datetime= new DateTime($news['datePosted']);
    					$author= $data->getNewsAuthor($news['id']);
    					echo "<span class=\"info\"> Posted on ".$datetime->format('Y/m/d H:i:s')." by ".$author['name']."</span>";
    					echo "<div class=\"entry\"> ".$news['content']."</div>";
    					$tags=$data->getNewsTags($news['id']);
    					echo "<div class=\"alltags\">";
    					foreach($tags as $tag){
    						echo "<span class=\"tagbox\">".$tag."</span> ";
    					}
    					echo "</div>";
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