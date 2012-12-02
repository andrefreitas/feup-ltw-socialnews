<?php
include_once  'datacontroller.php';
include_once 'config.php';

function limitLen($string,$limit){
	if(strlen($string)>$limit)
		$string=substr($string,0,$limit-3).'...';
	return $string;
}
	
function GetMonthString($n){
   	$timestamp = mktime(0, 0, 0, $n, 1, 2005);
    return date("M", $timestamp);
}


function printCategories($categories){
	echo"\n";
	foreach($categories as $row){
		echo "                    <li><a href=\"categorynews.php?id=".$row['id']."\">".$row['name']."</a></li>\n";
	}
}
function printTopNews($topnews){
	 global $data,$_thumbspath;
	
	for($i=0; $i<sizeof($topnews) and $i<4;$i++){						
		$news=$topnews[$i];
		$thumbnail=$_thumbspath.$news['thumbnail'];
		$title=$news['title'];
		$title=limitLen($title,40);
		$category=$data->getNewsCategory($news['id']);
		$date= new DateTime($news['datePosted']);
		$day=$date->format('d');
		$month=$date->format('m');
		$month=GetMonthString($month);
								
		echo "<div class=\"latestnewsentry\">\n";
		echo " <div class=\"thumbnail\" style=\"background: url('".$thumbnail."')\">";
		echo "<div class=\"title\"><a href=\"article.php?url=".$news['url']."\">".$title."</a>";
		echo "<br/><span class=\"category\"> in ".$category."</span>";
		echo " </div>";
		echo " </div>";
		echo " <div class=\"tnside\">";
		echo "<div class=\"day\">".$day."</div>";
		echo "<div class=\"month\">".substr($month,0,3)."</div>";
		echo "</div>";
		echo "\n</div>";
	} 
}

function printLatestNews($latestnews){
	for($i=0; $i<sizeof($latestnews) and $i<14;$i++){
		$title=$latestnews[$i]['title'];
		$dateposted=$latestnews[$i]['datePosted'];
		//echo "<script> latestNewsTimes.push(\"".$dateposted."\");
		$title=limitLen($title,42);
		echo " <li><a href=\"article.php?url=".$latestnews[$i]['url']."\">".$title."</a><span class=\"time\">2m</span></li>";
	}
}

function loadLatestNewsTimes($latestnews){
	echo "\n\t<script>\n";
	for($i=0; $i<sizeof($latestnews) and $i<14;$i++){
		$dateposted=$latestnews[$i]['datePosted'];
		echo "\t\tlatestNewsTimes.push(\"".$dateposted."\");\n";
	}
	echo "\t</script>";
}


function printUsers($users){
	global $data;
	$i=0;
	foreach($users as $user){
		$i++;
		$role=$data->getPrivilegeName($user['privilegeId']);
		echo "<div class=\"userrow "; if($i%2==0) echo " gray"; echo "\">";
		echo "<span class='rname'>".$user['name']."</span>";
		echo "<span class='rrole ";
		echo $role."tag"; 
		echo "'>".$role."</span>";
		//echo "<span class='remail'>".$user['email']."</span>";
		echo "<span class='redit'> <a href='#'>Edit User</a></span>";
		echo "<span class='deleteuser' onclick=\"deleteUser";
		echo "(".$user['id'].",this)"; 
		echo "\"> <a href='#'>Delete</a></span>";
		echo "</div>\n";
		echo"<div class='edituser'>";
		?>
		<form>
			Name <input type="text" name="name" class="name" required="required" value="<?php echo $user['name']?>">
			Email <input type="text" name="email" class="email" required="required" value="<?php echo $user['email']?>">
			Role 
			<select name="privilege">
			<?php 
				$privileges=$data->getPrivileges();
				foreach($privileges as $row){
					if($row!="guest"){
						echo "<option ";
						if($row==$role) echo "selected";
						echo ">";
						echo $row;
						echo "</option>\n";
					}
				}
			?>
			</select>
			<br/>
			Password <input type="password" name="password" class="password" placeholder="Leave empty to keep">
			Confirm Password <input type="password" name="password2" class="password" placeholder="Leave empty to keep">
			<button type="button" onclick="editUser(<?php echo $user['id'];?>,this)" >Save Changes</button>
		</form>
		<?php
		echo "</div>";
	}
}

function printServers($servers){
	$i=0;
	foreach($servers as $server){
		echo "<div class=\"serveritem\">";
		echo "<span class=\"servname\">".$server['name']."</span> <span class=\"servurl\">".$server['apiurl']."</span><span class=\"deleteserver\" onclick=\"deleteServer(this,".$server['serverId'].")\"><a href=\"#\">Delete Server</a></span> <span class=\"importnews\" onclick=\"importNews(this,".$server['serverId'].")\"><a href=\"#\">Import News</a></span>";
		echo "</div>";
	}

}


function printRemoteNews(){
	global $data;
	$remotenews=$data->getRemoteNews();

	
	foreach($remotenews as $row){
		echo "<div class=\"remotenewsi\">";
		echo "<h5>".$row['title']."</h5>";
		echo "<a href=\"".$row['url']."\">".$row['url']."</a>";
		echo "</div>\n";
	}
}

function printNewsList($news){
	global $data;
	echo "<div class=\"newslist\">";
	foreach($news as $row ){
		echo "<div class=\"newsi\">";
		echo "<span class=\"newstitlei\"><a href=\"article.php?url=".$row['url']."\">".$row['title']."</a></span>";

        if(isset($_SESSION['user']['id'])){
        echo "<img src=\"imgs/favorite";
        if($data->isfavorite($_SESSION['user']['id'], $row['id']))
        echo "yes";
        else echo "no";
        echo ".png\" class=\"favoriteicon\" onclick=\"favoriteNews(this,".$_SESSION['user']['id'].",".$row['id'].")\">";
        }
        $author= $data->getNewsAuthor($row['id']);
        if($data->userCan($_SESSION['privilegeid'],"editNews") or (isset($_SESSION['user']['id']) and $_SESSION['user']['id']==$author['id'])){
            echo "<span class=\"editarticlel\"><a href=\"editarticle.php?id=".$row['id']."\">Edit Article</a></span> <span class=\"deletearticlel\" onclick=\"deleteArticle(this,".$row['id'].")\">Delete</span>";
        }


		echo "</div>\n";
	}
	echo "</div>";
}

function printFavoriteNews($userid){
	global $data;
	$news=$data->getFavoriteNews($userid);
    printNewsList($news);
}

function printComments($newsid){
	global $data;
	$comments=$data->getNewsComments($newsid);
	$comments=array_reverse($comments);

	echo "<h4 class=\"commentstitle\">Comments</h4>";
	// New Comment
	if($data->userCan($_SESSION['privilegeid'],"createComment")){
	echo "<form><textarea rows=\"4\" cols=\"50\" placeholder=\"Insert a new comment\" class=\"newcomment\" name=\"content\">";
    echo "</textarea>"; 
    echo "<button type=\"button\" class=\"addcommentbt\" onclick=\"addComment(this,".$newsid.",".$_SESSION['user']['id'].",'".$_SESSION['user']['name']."')\"> Add comment </button></form>";
	}

	$newsauthor=$data->getNewsAuthor($newsid);

    // Comment list
    echo "<div class=\"commentslist\">\n";
	foreach($comments as $row){
		$datetime= new DateTime($row['datePosted']);
		$author=$data->getCommentAuthor($row['id']);

		echo "<div class=\"commenti\">";
		echo "<span class=\"commentauthor\"><a href=\"userprofile.php?id=".$author['id']."\">".$author['name']."</a></span>";
		echo "<span class=\"commentdate\"> at ".$datetime->format('Y/m/d H:i:s')."</span>";

		if(isset($_SESSION['user']) and ($data->userCan($_SESSION['privilegeid'],"editAllComments") or $_SESSION['user']['id']==$author['id'] or $_SESSION['user']['id']==$newsauthor['id'])){
		echo "<span class=\"editcomment\" onclick=\"editComment(this,".$row['id'].")\">Edit</span>";
		echo "<span class=\"deletecomment\" onclick=\"deleteComment(this,".$row['id'].")\">Delete</span><br/>";
		}

		echo "<div class=\"commentcont\">".$row['content']."</div>";
		echo "</div>";
	}
	echo "</div>";
}

function printCategoryNews($id){
	global $data;
	$news= $data->getCategoryNewsById($id);
	printNewsList($news);
}

function printAuthorNews($id){
	global $data;
	$news= $data->getAllNewsFromAuthor($id);
	printNewsList($news);
}

function printSearchResults($word){
	global $data;
	$news=Array();
	$data->searchNews($word,$news);
	printNewsList($news);
}

function printCommentsList($comments){
	global $data;
	echo "<div class=\"commentlist\"/>";
	foreach($comments as $row){
		$news=$data->getCommentNews($row['id']);
		echo "<div class=\"commenti\">";
		echo "<span class=\"ccontent\">\"".$row['content']."\"</span><br/>";
		echo "<span class=\"where\"> At <a href=\"article.php?url=".$news['url']."\">".$news['title']."</a></span>";
		echo "</div>\n";
	}
	echo "</div>";
}

function printUserProfile($id){
	global $data;
	$user=$data->getUserByid($id);
	$role=$data->getPrivilegeName($user['privilegeId']);
	$comments=$data->getUserComments($id);
	$articles=$data->getAllNewsFromAuthor($id);
	$favorites=$data->getFavoriteNews($id);
	// User 

	echo "<div class=\"profilebox\"><form>";
	echo "<div class=\"rolethumb\"><img src=\"imgs/role".$role.".png\"/></div>";
	
	// Stats
	echo "<div class=\"profiledata\">\n";
	echo "<h3>".$user['name'];

	if(isset($_SESSION['user']) and ($data->userCan($_SESSION['privilegeid'],"editUsers") or $_SESSION['user']['id']==$id)){
		echo "<button type=\"button\" onclick=\"editProfile(this,$id)\">Edit Profile</button>";
	}


	echo "</h3>";
	echo "<span class=\"email\">".$user['email']."</span><br/>";
	echo "<div class=\" stat totalcomments\">".sizeof($comments)." commentaries</div>";
	echo "<div class=\"stat totalarticles\">".sizeof($articles)." articles written</div>";
	echo "<div class=\"stat totalfavorites\">".sizeof($favorites)." favorite news</div>";
	echo "</div>";

	// About me
	echo "<div class=\"aboutme\"> <h3>About me </h3>".$user['about']."</div>";
	echo "</form>";
	echo "</div>";

	// Print Comments
	echo "<h3>Latest comments</h3>";
	printCommentsList($comments);
}


?>