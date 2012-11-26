<div class="user">
    <h3>User Area</h3>
    <?php 
    if(!isset($_SESSION['user'])){ ?>
    <form action="login.php" method="post" class="login">
        <input type="text" name="email" placeholder="your email" class="email"/>
        <input type="password" name="password" placeholder="your password" class="password"/><br/>
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