<table class="site_listing_table" data-name="photo">
    <tr class="site_listing_names">
        <th>LP</th>
        <th>Tytuł</th>
        <th>Zdjęcie</th>
        <th>Data</th>
        <th>Widoczny</th>
        <th>Kasowanie</th>
    </tr>

    <?php 
        $i = 1;
        foreach ($photoListing as $photo) {

            if ($photo['foto'] !== null) {
                $img = '<img src="'.$photo['foto'].'" alt="" />';
            } else {
                $img = '';
            }

            echo '<tr data-aln="'.$photo['id'].'">';
                echo '<td>'.$i.'</td>';
                echo '<td>'.$photo['name'].'</td>';
                echo '<td class="cms_gallery_photo_single">'.$img.'</td>';
                echo '<td>'.date('j-m-Y', strtotime($photo['date'])).'</td>';

                if ($photo['visible'] == 1) {
                    echo '<td class="visibility_wrapper"><input type="checkbox" name="visible" checked class="visible_site" data-id="'.$photo['id'].'" /></td>';
                } else {
                    echo '<td class="visibility_wrapper"><input type="checkbox" name="visible" class="visible_site" data-id="'.$photo['id'].'" /></td>';
                }
                echo '<td><a class="click delete_button" href="" data-id="'.$photo['id'].'">Kasuj</a></td>';

            echo '</tr>';
            $i++;
        }
    ?>				
</table>