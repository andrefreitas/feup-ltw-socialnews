<?php 
	include_once  'view.php';
	$categories=$data->getActiveCategories();
?>

	<div id="menu">
	    <div class="container">
	        <ul>
	            <li><a href="index.php">Home</a></li>
	            <?php printCategories($categories); ?>
	        </ul>
	    </div>
	</div>
