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
                    <?php if($blogCategoriesListing != null) { 
                        echo '<h1>Lista wpisów</h1>'; 
                        include ('table/blog_categories_list_table.php');
                    } else {
                        echo '<h1>Brak wpisów</h1>'; 
                    }
                    ?>
                </section>
            </div>
        </div>
    </body>
</html>