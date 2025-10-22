<table class="site_listing_table" data-name="site">
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
        foreach ($siteListing as $site) {
            echo '<tr data-aln="'.$site['id'].'">';
                echo '<td>'.$i.'</td>';
                echo '<td>'.$site['name'].'</td>';
                echo '<td>'.date('j-m-Y', strtotime($site['date'])).'</td>';

                if ($site['visible'] == 1) {
                    echo '<td class="visibility_wrapper"><input type="checkbox" name="visible" checked class="visible_site" data-id="'.$site['id'].'" /></td>';
                } else {
                    echo '<td class="visibility_wrapper"><input type="checkbox" name="visible" class="visible_site" data-id="'.$site['id'].'" /></td>';
                }
                //echo '<td><a class="click delete_button" href="?page=site-delete&id='.$site['id'].'">Kasuj</a></td>';
                echo '<td><a class="click delete_button" href="" data-id="'.$site['id'].'">Kasuj</a></td>';
                echo '<td><a class="click edit_button" href="?page=site-edit&id='.$site['id'].'">Edytuj</a></td>';
            echo '</tr>';
            $i++;
        }
    ?>				
</table>