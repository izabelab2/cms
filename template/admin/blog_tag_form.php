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
                    <h1><?php echo $blogTagTitle; ?></h1>

                    <div class="add_new">
                        <form method="post" action="?page=blog-tag-save<?php echo $blogTagId; ?>">
                            <input type="text" name="title" placeholder="nazwa tagu" class="inputs" <?php echo $blogTagValueName; ?> />

                            <br /><br /><br />

                            <input type="submit" name="<?php echo $blogTagSubmit; ?>" class="click" value="<?php echo $blogTagTitle; ?>" />
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </body>
</html>