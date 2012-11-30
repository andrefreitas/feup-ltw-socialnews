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
		echo "                    <li><a href=\"#\">".$row."</a></li>\n";
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
			<select>
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
			Password <input type="password" name="password" class="password" required="required" placeholder="Leave empty to keep">
			Confirm Password <input type="password" name="password2" class="password" required="required" placeholder="Leave empty to keep">
			<button type="button">Save Changes</button>
		</form>
		<?php
		echo "</div>";
	}
}

?>