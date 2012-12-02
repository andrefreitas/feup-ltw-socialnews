<!DOCTYPE html>
<html>
    <head>
    	<title>Socialus social news for everyone</title>
        <?php
            include_once  'view.php';
            include_once  'head.php';
            $tags=$data->getTags();
            $cats=$data->getCategories();
        ?>
        <link rel="stylesheet" href="css/tinyeditor.css">
        <script src="js/tiny.editor.packed.js"></script>
        
    </head>
    <body>

    
        <?php include_once 'header.php'; ?>  
        <?php include_once 'menu.php'; ?>
        
        <div id="main">
        	<div class="container">
            	<div class="edit">
                <?php 
				
					if($data->userCan($_SESSION['privilegeid'],"createNews") and isset($_POST['title']) and isset($_POST['content']) and isset($_POST['category']) and isset($_POST['tags'])){
						$data->insertNews($_SESSION['user']['id'],$_POST['title'],$_POST['content'],$_POST['tags'],$_POST['category']);
						echo "<h1>News created successfuly. </h1>";
						
					} else {
						if(!$data->userCan($_SESSION['privilegeid'],"createNews")) echo "<h1>You can't create news</h1>";
						else {
				?>
                
                <h1>Create a new article</h1>
                Please fill the following fields with data
         
                <form action="createarticle.php" onClick="editor.post()" method="post">
               		<input type="text" name="title" class="title" placeholder="Insert title here" required="required"/><br/>
                    <textarea id="content" name="content" style="width: 400px; height: 200px" required="required"></textarea>
       			
                	<div class="selectItens">
                     Category:
                     <select name="category">
                     	<?php
							foreach($cats as $row){
								echo "<option value=\"".$row."\"> ".$row."</option>\n";
							}
						?>
                     </select><br/>
                     </div>
                       Tags(ex. world,sports): <input name="tags" id="mySingleField" name="tags" value="" required="required"> 
                	<input type="submit" class="button" value="Create Article" >
                </form>
                
                <script>
				 var editor = new TINY.editor.edit('editor', {
                        id: 'content',
                        width: 655,
                        height: 175,
                        cssclass: 'tinyeditor',
                        controlclass: 'tinyeditor-control',
                        rowclass: 'tinyeditor-header',
                        dividerclass: 'tinyeditor-divider',
                        controls: ['bold', 'italic', 'underline', 'strikethrough', '|', 'subscript', 'superscript', '|',
                            'orderedlist', 'unorderedlist', '|', 'outdent', 'indent', '|', 'leftalign',
                            'centeralign', 'rightalign', 'blockjustify', '|', 'unformat', '|', 'undo', 'redo', 'n',
                            'font', 'size', 'style', '|', 'image', 'hr', 'link', 'unlink', '|', 'print'],
                        footer: true,
                        fonts: ['Segoe UI','Verdana','Arial','Georgia','Trebuchet MS'],
                        xhtml: false,
                        bodyid: 'editor',
                        footerclass: 'tinyeditor-footer',
                        toggle: {text: 'source', activetext: 'wysiwyg', cssclass: 'toggle'},
                        resize: {cssclass: 'resize'}
                    });
				</script>
                
                <?php }}?>
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