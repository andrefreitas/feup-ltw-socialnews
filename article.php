<!DOCTYPE html>
<html>
    <head>
        <?php
            include_once  'view.php';

            $news=$data->getNewsByUrl($_GET['url']);
            echo "<title>".$news['title']."</title>";
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
    					
    					echo "<h1>".$news['title'];

                        // Print favorite icon
                        if(isset($_SESSION['user']['id'])){
                        echo "<img src=\"imgs/favorite";
                        if($data->isfavorite($_SESSION['user']['id'], $news['id']))
                            echo "yes";
                        else echo "no";
                        echo ".png\" class=\"favoriteicon\" onclick=\"favoriteNews(this,".$_SESSION['user']['id'].",".$news['id'].")\">";
                        }
                        echo "</h1>";
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
                    <?php include_once 'commentsbox.php'; ?> 
                </div>
            </div>

        </div>
        <?php include_once 'footer.php'; ?>  
    </body>
</html>