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
                    <?php if($siteListing != null) { 
                        echo '<h1>Lista podstron</h1>'; 
                        include ('table/site_list_table.php');
                    } else {
                        echo '<h1>Brak podstron</h1>'; 
                    }
                    ?>
                </section>
            </div>
        </div>
    </body>
</html>