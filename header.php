
        <div id="header">
            <div class="container">
                <div class="logoContainer">
                    <img src="imgs/logo.png" alt="Socialus - social news for everyone" class="logo"/>
                </div>
                <div class="searchContainer">
                    <form class="search-form cf" action="searchnews.php">
                        <input type="text" name="word" class="word" placeholder="Search an article here..."  required>
                        <button type="submit">Search</button>
                    </form>
                    <div class="searchresults">
                        <ul>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <?php  // Display Messages
             if(isset($_GET['_alert'])){
                echo "<div class=\"alert\">";
                echo $_GET['_alert'];
                echo "</div>\n";
            }