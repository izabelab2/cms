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
                    <h1><?php echo $blogCategoryTitle; ?></h1>

                    <div class="add_new">
                        <form method="post" action="?page=blog-category-save<?php echo $blogCategoryId; ?>">
                            <input type="text" name="title" placeholder="nazwa kategorii" class="inputs" <?php echo $blogCategoryValueName; ?> />

                            <br /><br /><br />

                            <input type="submit" name="<?php echo $blogCategorySubmit; ?>" class="click" value="<?php echo $blogCategoryTitle; ?>" />
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </body>
</html>