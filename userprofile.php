<!DOCTYPE html>
<html>
    <head>
        <title>User profile</title>
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
                        <?php if(isset($_GET['id'])){ ?>

                        <h1>User profile</h1>
                        <?php 
                        printUserProfile($_GET['id']);
                        } ?>
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