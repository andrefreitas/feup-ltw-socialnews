<?php
	include_once  'dataprint.php';
	include_once  'datacontroller.php';
	$categories=$data->getActiveCategories();
	$tags=$data->getTags();
	$cats=$data->getCategories();
?>

<!DOCTYPE html>
<html>
	<head>
    	<title>Socialus social news for everyone</title>
        
        <link href="css/template.css" rel="stylesheet" type="text/css">
        <link href="css/edit.css" rel="stylesheet" type="text/css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script> 
        <script>
		var sampleTags = <?php echo json_encode($tags); ?>

		</script>
        <script src="js/scripts.js"></script> 
        
        <link rel="stylesheet" href="css/tinyeditor.css">
		<script src="js/tiny.editor.packed.js"></script>
        
   
        <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/flick/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="css/tagit/jquery.tagit.css">
    
        <!-- This is an optional CSS theme that only applies to this widget. Use it in addition to the jQuery UI theme. -->
        <link href="css/tagit/tagit.ui-zendesk.css" rel="stylesheet" type="text/css">
    
        <!-- jQuery and jQuery UI are required dependencies. -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
    
        <!-- The real deal -->
        <script src="js/tag-it.js" type="text/javascript" charset="utf-8"></script>
		
    
        <meta charset="utf-8">
        <link href="imgs/favicon.ico" rel="icon" type="image/x-icon" />
    </head>
    <body>

    
    	<div id="header">
        	<div class="container">
            	<div class="logoContainer">
                	<img src="imgs/logo.png" alt="Socialus - social news for everyone" class="logo"/>
                </div>
                <div class="searchContainer">
                    <form class="search-form cf">
                        <input type="text" placeholder="Search an article here..." required>
                        <button type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div id="menu">
        	<div class="container">
                <ul>
                    <li><a href="index.php">Home</a></li>
					<?php printCategories($categories); ?>
                 </ul>
            </div>
        </div>
        
        <div id="main">
        	<div class="container">
            	<div class="edit">
                <h1>Create a new article</h1>
                Please fill the following fields with data
                <script>
				//-------------------------------
            // Single field
            //-------------------------------
		    $('#singleFieldTags').tagit({
			    availableTags: sampleTags,
			    // This will make Tag-it submit a single form value, as a comma-delimited field.
			    singleField: true,
                singleFieldNode: $('#mySingleField')
		    });

            // singleFieldTags2 is an INPUT element, rather than a UL as in the other 
            // examples, so it automatically defaults to singleField.
		    $('#singleFieldTags2').tagit({
			    availableTags: sampleTags
		    });
				</script>
                <?php 
				
					if(isset($_POST)) print_r($_POST);
				?>
                <form action="createarticle.php" onClick="editor.post()" method="post">
               		<input type="text" name="title" class="title" placeholder="Insert title here"/><br/>
                    <textarea id="content" name="content" style="width: 400px; height: 200px"></textarea>
       			
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
                     <input name="tags" id="mySingleField" name="tags" value="" hidden="true"> 
                     Tags:
                     <ul id="singleFieldTags"></ul>
                	<input type="submit" class="button" >
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
                        xhtml: true,
                        bodyid: 'editor',
                        footerclass: 'tinyeditor-footer',
                        toggle: {text: 'source', activetext: 'wysiwyg', cssclass: 'toggle'},
                        resize: {cssclass: 'resize'}
                    });
				</script>
                </div>
                <div class="sidebar">
                	<div class="user">
                    	<h3>User Area</h3>
                    </div>
                    <div class="comments">
                    	<h3>Comments</h3>
                    </div>
                </div>
            </div>
        </div>
        
    </body>
</html>