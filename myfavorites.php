<!DOCTYPE html>
<html>
    <head>
        <title> My Favorite News</title>
        <?php
            include_once  'view.php';
            include_once 'head.php';
        ?>
    </head>
    <body>
        <?php include_once 'header.php'; ?>  
        <?php include_once 'menu.php'; ?>
        <div id="main">
        	<div class="container">
            	<div class="news">
                    <div class="box"> 
                        <?php if($data->userCan($_SESSION['privilegeid'],"seeFavoriteNews")){ ?>
                        <h1>My Favorite News</h1>
                        Here you can see all the news you like...
                         
                        <?php printFavoriteNews($_SESSION['user']['id']) ?>   
                        
                        <?php } else {?>
                         <h1>You can't see favorite news</h1>
                        <?php } ?>

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