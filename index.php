<?php
	include_once  'datacontroller.php';
	$categories=$data->getActiveCategories();
	$latestnews=$data->getLatestNews();
	$latestnewsMaxTitleLen=45;
?>
<!DOCTYPE html>
<html>
	<head>
    	<title>Socialus - social news for everyone</title>
        <link href="css/template.css" rel="stylesheet" type="text/css">
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
                    <li><a href="#">Home</a></li>
					<?php foreach($categories as $row){
						echo "<li><a href=\"category.php?name=".$row."\">".$row."</a></li>\n";
					}
					?>
                 </ul>
            </div>
        </div>
        
        <div id="main">
        	<div class="container">
            	<div class="news">
                	<div class="latestNews">
                    	<h3>Latest News</h3>
                        <ul>
                        	<?php
							for($i=0; $i<sizeof($latestnews) and $i<10;$i++){
								$title=$latestnews[$i]['title'];
								if(strlen($title)>$latestnewsMaxTitleLen){
									$title=substr($title,0,$latestnewsMaxTitleLen-3).'...';
								}
								echo " <li><a href=\"#\">".$title."</a><span class=\"time\">2m</span></li>";
							}
							?>
                        </ul>
                    </div>
                </div>
                <div class="sidebar">
                	<div class="user">
                    	<h3>User Area</h3>
                    </div>
                    <div class="comments">
                    	<h3>Comments</h3>
                    </div>
                </div>
            </div>
        </div>
        
    </body>
</html>