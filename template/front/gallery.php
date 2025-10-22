<?php 
    include 'include/head.php';
?>

<body>
    <?php 
        include 'include/menu_top.php';
    ?>

    <div class="wrapper">
        <?php if($photoListing != null) { 
            echo '<h1>Galeria</h1>'; 
            echo '<div class="gallery_site_wrapper">';
                foreach ($photoListing as $photo) {
                    echo '<div class="gallery_site_sigle"><img src="'.$photo['foto'].'" alt="" /></div>';
                } 
            echo '</div>';
        } else {
            echo '<h1>Brak zdjęć</h1>'; 
        }
        ?>
    </div>
</body>
</html>