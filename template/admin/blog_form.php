<?php
    require('include/head.php'); 
?>

    <body class="">
        <?php
            require('include/header.php'); 
        ?>
        <div class="wrapper">
            <?php
                require('include/menu_left.php'); 
            ?>
            <div class="a_right_side">
                <section>
                    <h1><?php echo $blogTitle; ?></h1>

                    <div class="add_new">
                        <form method="post" enctype="multipart/form-data" action="?page=blog-save<?php echo $blogId; ?>">
                            <input type="text" name="title" placeholder="tytuł wpisu" class="inputs" <?php echo $blogValueName; ?> />
                            <input type="text" name="text_mini" class="inputs"  placeholder="zajawka max 200znaków" maxlength="200" <?php echo $blogMiniText; ?>  />
                            <textarea name="text" class="textareas"><?php echo $blogValueText; ?></textarea>
                            <?php 
                                if(isset($blogEditing)) {
                                    if ($blogEditing['visible'] == 1) {
                                        $check = 'checked';
                                    } else {
                                        $check = '';
                                    }
                                } else {
                                    $check = '';
                                }
                            ?>
                            <div class="visibility_wrap">
                                <input type="checkbox" name="visible" <?php echo $check; ?> />
                                <label for="visible">Widoczny</label>
                            </div>

                            <?php   
                                if (empty($blogEditing['foto'])) {
                                    $img = '<div class="edit_img"><img src="" alt="" style="max-width:100%; height:auto" id="blah"  />';
                                } else {
                                    $img = '<div class="edit_img"><img src="'.$blogEditing['foto'].'" alt="" style="max-width:100%; height:auto" id="blah"  /></div>';
                                    $delete_photo = '<a href="?page=foto-delete&id='.$blogEditing['id'].'" class="click" data-id_site="'.$blogEditing['id'].'">Skasuj zdjęcie</a>';
                                }
                            ?>

                            <div class="change_foto">
                                <?php
                                    echo $img;
                                ?>
                            </div>

                            <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
                            <input type="file" name="file" onchange="readURL(this);" />

                            <br /><br /><br />

                            <input type="text" name="foto_alt" placeholder="alt do zdjęcia" class="inputs" <?php echo $blogFotoAlt; ?> />
                            <br /><br /><br />
                            
                            
                            <?php
                            var_dump($blogCheckedCategories);
                               /* $checkedCategories[] = '';
                                foreach ($blogCheckedCategories as $categories){
                                    var_dump($categories);
                                    $checkedCategories[] = $categories['id_category'];
                                }
                                echo '<br />';
                                var_dump($checkedCategories);*/
                                if(!empty($blogCategories)) {
                                    echo '<p>Lista kategorii kategorii:</p>';
                                    foreach($blogCategories as $category) {
                                        
                                        echo '<input type="checkbox" name="category[]" value="'.$category['id'].'" />';
                                        echo '<label for="category[]">'.$category['name'].'</label><br />';

                                    }
                                }
                            ?>

                            <br /><br /><br />
                            <input type="submit" name="<?php echo $blogSubmit; ?>" class="click" value="<?php echo $blogTitle; ?>" />
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </body>
</html>