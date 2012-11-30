<!DOCTYPE html>
<html>
    <head>
        <title> User Management</title>

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
                       <?php if($data->userCan($_SESSION['privilegeid'],"editUsers")) { ?>
                       <h1>Manage Users</h1>
                       Here you can manage the users and promote them to admin and editors.
                       <div class="userlist">
                        <?php printUsers($data->getUsers()); ?>
                       </div>
                       <?php } else {?>
                        <h1>You can't edit users</h1>
                       <?php }?>
    				</div>
                </div>
                <div class="sidebar">
                	<?php include_once 'userbox.php'; ?>  
                    <?php include_once 'commentsbox.php'; ?> 
                </div>
            </div>

        </div>
         <script>
        $(".redit").click(function () {
            $(".edituser").fadeOut(2);
            $useredit=$(this).parent().next();
            if ($useredit.is(":hidden")) {
            $useredit.slideDown();
            } else {
            $useredit.slideUp();
            }
        }); 

        </script>

        <?php include_once 'footer.php'; ?>  
    </body>
</html>