<div class="user">
    <h3>User Area</h3>
    <?php 
    if(!isset($_SESSION['user'])){ ?>
    <form action="login.php" method="post" class="login">
        <input type="text" name="email" placeholder="your email" class="email"/>
        <input type="password" name="password" placeholder="your password" class="password"/><br/>
        <input type="submit" class="button" value="Login"/> 
    </form>
    <div class="register">
        <a href="register.php">Not registered yet? Click here</a>
    </div>
    <?php } else {?>
    <div class="loggedin">
        Hello <?php echo $_SESSION['user']['name']; ?>
        <ul>
            <?php if($data->userCan($_SESSION['privilegeid'],"createNews")){ ?><li class="article"><a href="createarticle.php">Create article</a></li> <?php }?>
            <?php if($data->userCan($_SESSION['privilegeid'],"editOwnProfile")){ ?><li class="myprofile"><a href="editprofile.php">My Profile</a></li> <?php }?>
            <?php if($data->userCan($_SESSION['privilegeid'],"seeFavoriteNews")){ ?><li class="favoritenews"><a href="myfavorites.php">My Favorite News</a></li> <?php }?>
            <?php if($data->userCan($_SESSION['privilegeid'],"createNews")){ ?><li class="mynews"><a href="newsbyauthor.php">My News</a></li> <?php }?>
            <?php if($data->userCan($_SESSION['privilegeid'],"editUsers")){ ?><li class="users"><a href="manageusers.php">Manage Users</a></li> <?php }?>
            <?php if($data->userCan($_SESSION['privilegeid'],"editNews") and false){ ?><li class="managenews"><a href="managenews.php">Manage News</a></li> <?php }?>
            <?php if($data->userCan($_SESSION['privilegeid'],"editNews")){ ?><li class="remoteservers"><a href="remoteservers.php">Remote Servers</a></li> <?php }?>
        </ul>
        </ul>
      <form action="logout.php" method="post">
   
        <input type="submit" class="button" value="Logout"/>
    </form>
   </div>
    <?php } ?>
</div>