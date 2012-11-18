<?php
	include_once  'dataprint.php';
	include_once  'datacontroller.php';
	$categories=$data->getActiveCategories();
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
        <meta charset="utf-8">
        <link href="imgs/favicon.ico" rel="icon" type="image/x-icon" />
    </head>
    <body>

    
    	<div id="header">
        	<div class="container">
            	<div class="logoContainer">
                	<img src="imgs/logo.png" alt="Socialus - social news for everyone" class="logo"/>
                </div>
                <div class="searchContainer">
                    <form class="search-form cf">
                        <input type="text" placeholder="Search an article here..." required>
                        <button type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div id="menu">
        	<div class="container">
                <ul>
                    <li><a href="index.php">Home</a></li>
					<?php printCategories($categories); ?>
                 </ul>
            </div>
        </div>
        
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
                	<div class="user">
                    	<h3>User Area</h3>
                        <?php 
						if(!isset($_SESSION['user'])){ ?>
                        <form action="login.php" method="post" class="login">
                        	<input type="text" name="email" placeholder="your email" class="email"/>
                            <input type="password" name="password" placeholder="your password" class="password"/>
                            <input type="submit" class="button" value="Login"/>
                        </form>
                        <?php } else {?>
                        <div class="loggedin">
                        	Hello <?php echo $_SESSION['user']['name']; ?>
                            <ul>
                            	<li class="article"><a href="createarticle.php">Create article</a></li>
                            </ul>
                          <form action="logout.php" method="post">
                       
                            <input type="submit" class="button" value="Logout"/>
                        </form>
                       </div>
                        <?php } ?>
                    </div>
                    <div class="comments">
                    	<h3>Comments</h3>
                    </div>
                </div>
            </div>
        </div>
        
    </body>
</html>