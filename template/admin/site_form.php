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
                    <h1><?php echo $siteTitle; ?></h1>

                    <div class="add_new">
                        <form method="post" action="?page=site-save<?php echo $siteId; ?>">
                            <input type="text" name="name" placeholder="tytuł podstrony" class="inputs" <?php echo $siteValueName; ?> />
                            <textarea name="text" class="textareas"><?php echo $siteValueText; ?></textarea>
                            <?php 
                                if(isset($siteEditing)) {
                                    if ($siteEditing['visible'] == 1) {
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
                            <input type="submit" name="<?php echo $siteSubmit; ?>" class="click" value="<?php echo $siteTitle; ?>" />
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </body>
</html>