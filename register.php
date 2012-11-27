<!DOCTYPE html>
<html>
    <head>
        <title>New user registration</title>

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
                        <?php 
                            if(isset($_POST['name']) and isset($_POST['email']) and isset($_POST['password'])){
                                $status=$data->addUser($_POST['name'],$_POST['email'], $_POST['password'],"user");
                                if($status==-1){
                                    echo "<h1>User already exists!</h1>";
                                }
                                else {
                                    echo "<h1>Registered with success!</h1>";
                                } 

                            }
                            else{
                        ?>
                        <h1>New user registration</h1>
                        Please take 1 minute to register and fill all data.
                        <form name="register" action="register.php" method="post" onsubmit="return validateRegistration()">
                            <table>
                                <tr><td>Your Name</td> <td><input type="text" name="name" required="required"/></td> </tr>
                                <tr><td>Your Email</td> <td><input type="text" name="email" required="required"/></td> </tr>
                                <tr><td>Password</td> <td><input type="password" name="password" required="required"/></td> </tr>
                                <tr><td>Password Again&nbsp;</td><td><input type="password" name="passwordcheck" required="required"/></td> </tr>
                                <tr><td colspan="2"><input type="submit" value="Register" class="button"/></td></tr>
                            </table>
                        </form>
                        <?php }?>
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