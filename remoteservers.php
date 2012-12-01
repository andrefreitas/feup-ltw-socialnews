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
                        <?php if($data->userCan($_SESSION['privilegeid'],"doallNewsServers")){ ?>
                        <h1>Remote servers</h1>
                        Here you can manage remote servers, search news and import them.
                            
                        <div class="addserver">
                            <form>
                                Server Name <input type="text" name="servername" class="servernamei" style="height:20px" />
                                Server API URL <input type="text" name="serverurl" class="serverurli" style="height:20px" />
                                <button type="button" onclick="addServer(this)" >Add New Server</button>
                            </form>
                        </div>

                        <div class="serverlist">
                            <?php 
                             $servers=$data->getServers();
                            printServers($servers); 
                            ?>
                        </div>
                        <?php } else {?>
                         <h1>You can't manage remote servers</h1>
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