<?php
        require('include/head.php'); 
    ?>

    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

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
                    <h1><?php echo $siteTitle; ?></h1>

                    <div class="add_new">
                        <form enctype="multipart/form-data" method="post" action="?page=photo-save<?php echo $photoId; ?>">
                            <input type="text" name="name" placeholder="tytuł zdjęcia" class="inputs" <?php echo $photoValueName; ?> />
                            
                            <?php 
                                if(isset($photoEditing)) {
                                    if ($photoEditing['visible'] == 1) {
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
                                if (empty($photoEditing['foto'])) {
                                    $img = '<div class="edit_img"><img src="" alt="" style="max-width:100%; height:auto" id="blah"  />';
                                } else {
                                    $img = '<div class="edit_img"><img src="'.$photoEditing['foto'].'" alt="" style="max-width:100%; height:auto" id="blah"  /></div>';
                                    $delete_photo = '<a href="?page=foto-delete&id='.$photoEditing['id'].'" class="click" data-id_site="'.$photoEditing['id'].'">Skasuj zdjęcie</a>';
                                }
                            ?>

                            <div class="change_foto">
                                <?php
                                    echo $img;
                                ?>
                            </div>

                            <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                            <input type="file" name="file" onchange="readURL(this);" />
                            <input type="submit" name="<?php echo $photoSubmit; ?>" class="click" value="<?php echo $siteTitle; ?>" />
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </body>
</html>