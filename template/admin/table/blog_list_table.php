<table class="site_listing_table" data-name="blog">
    <tr class="site_listing_names">
        <th>LP</th>
        <th>Tytuł</th>
        <th>Data</th>
        <th>Widoczny</th>
        <th>Kasowanie</th>
        <th>Edycja</th>
    </tr>

    <?php 
        $i = 1;
        foreach ($blogListing as $blog) {
            echo '<tr data-aln="'.$blog['id'].'">';
                echo '<td>'.$i.'</td>';
                echo '<td>'.$blog['name'].'</td>';
                echo '<td>'.date('j-m-Y', strtotime($blog['date'])).'</td>';

                if ($blog['visible'] == 1) {
                    echo '<td class="visibility_wrapper"><input type="checkbox" name="visible" checked class="visible_blog" data-id="'.$blog['id'].'" /></td>';
                } else {
                    echo '<td class="visibility_wrapper"><input type="checkbox" name="visible" class="visible_blog" data-id="'.$blog['id'].'" /></td>';
                }
                echo '<td><a class="click delete_button" href="" data-id="'.$blog['id'].'">Kasuj</a></td>';
                echo '<td><a class="click edit_button" href="?page=blog-edit&id='.$blog['id'].'">Edytuj</a></td>';
            echo '</tr>';
            $i++;
        }
    ?>				
</table>