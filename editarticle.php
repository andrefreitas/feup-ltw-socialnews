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


                if(isset($_GET['id'])){
                        $article=$data->getNewsById($_GET['id']);
                        $catname=$data->getNewsCategory($_GET['id']);
                        $tags=$data->getNewsTags($_GET['id']);
                        $tags=implode(",", $tags);
                        $author=$data->getNewsAuthor($_GET['id']);
                        if($data->userCan($_SESSION['privilegeid'],"editNews") or (isset($_SESSION['user']['id']) and $_SESSION['user']['id']==$author['id'])){
                    ?>

                <h1>Edit Article</h1>
                Please fill the following fields with data
         
                <form action="editarticle.php" onClick="editor.post()" method="post">
                    <input type="text" name="title" class="title" placeholder="Insert title here" value="<?php echo $article['title'] ;?>"/><br/>
                    <textarea id="content" name="content" style="width: 400px; height: 200px"><?php echo $article['content'] ;?></textarea>
                
                    <div class="selectItens">
                     Category:
                     <select name="category">
                        <?php
                            foreach($cats as $row){
                                echo "<option value=\"".$row."\"";
                                if($row==$catname) echo "selected";
                                echo "> ".$row."</option>\n";
                            }
                        ?>
                     </select><br/>
                     </div>
                    Tags: <input name="tags" id="mySingleField" name="tags" value="<?php  echo($tags);?>"> 
                    <input type="submit" class="button" value="Edit Article" >
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
                <?php }} ?>
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