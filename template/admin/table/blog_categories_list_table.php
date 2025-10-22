<table class="site_listing_table" data-name="blog-category">
    <tr class="site_listing_names">
        <th>LP</th>
        <th>Nazwa kategorii</th>
        <th>Kasowanie</th>
        <th>Edycja</th>
    </tr>

    <?php 
        $i = 1;
        foreach ($blogCategoriesListing as $blogCategory) {
            echo '<tr data-aln="'.$blogCategory['id'].'">';
                echo '<td>'.$i.'</td>';
                echo '<td>'.$blogCategory['name'].'</td>';
                echo '<td><a class="click delete_button" href="" data-id="'.$blogCategory['id'].'">Kasuj</a></td>';
                echo '<td><a class="click edit_button" href="?page=blog-category-edit&id='.$blogCategory['id'].'">Edytuj</a></td>';
            echo '</tr>';
            $i++;
        }
    ?>				
</table>