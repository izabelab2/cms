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
                    <?php if($photoListing != null) { 
                        echo '<h1>Lista zdjęć</h1>'; 
                        include ('table/photo_list_table.php');
                    } else {
                        echo '<h1>Brak zdjęć</h1>'; 
                    }
                    ?>
                </section>
            </div>
        </div>
    </body>
</html>