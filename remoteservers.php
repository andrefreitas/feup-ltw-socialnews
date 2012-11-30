<!DOCTYPE html>
<html>
    <head>
        <title> Remote Servers</title>
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
                <h1>Remote servers</h1>
                Here you can manage remote servers, search news and import them.
                    <div class="addserver">
                        <form>
                            Server<input type="text" name="servername">
                        </form>
                    </div>

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