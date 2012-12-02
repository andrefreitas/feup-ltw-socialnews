<!DOCTYPE html>
<html>
    <head>
        <title> Search results</title>
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
                        <?php if(isset($_GET['word'])){ ?>
                        <h1>Search results...</h1>
                        <?php printSearchResults($_GET['word']); }?>

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