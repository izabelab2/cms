<table class="site_listing_table" data-name="blog-tag">
    <tr class="site_listing_names">
        <th>LP</th>
        <th>Nazwa tagu</th>
        <th>Kasowanie</th>
        <th>Edycja</th>
    </tr>

    <?php 
        $i = 1;
        foreach ($blogTagsListing as $blogTag) {
            echo '<tr data-aln="'.$blogTag['id'].'">';
                echo '<td>'.$i.'</td>';
                echo '<td>'.$blogTag['name'].'</td>';
                echo '<td><a class="click delete_button" href="" data-id="'.$blogTag['id'].'">Kasuj</a></td>';
                echo '<td><a class="click edit_button" href="?page=blog-tag-edit&id='.$blogTag['id'].'">Edytuj</a></td>';
            echo '</tr>';
            $i++;
        }
    ?>				
</table>