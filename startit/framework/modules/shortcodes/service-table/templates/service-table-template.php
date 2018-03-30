<thead>
<tr>
    <?php
        foreach($table_titles as $title) { ?>
           <th><?php echo esc_attr($title); ?></th>
    <?php } ?>
</tr>
</thead>
<tbody>
    <?php foreach($table_rows as $row) { ?>
        <tr>
            <td class="qodef-service-table-feature-title"><?php echo esc_attr($row['title']) ?></td>
            <?php foreach($row['features_enabled'] as $feature) { ?>
                <td> <?php if($feature == 'yes') { ?>
                    <span class="qodef-mark qodef-checked ion-checkmark"></span>
                <?php } else { ?>
                    <span class="qodef-mark ion-close"></span>
                <?php } ?>
                </td>
            <?php } ?>
        </tr>
    <?php } ?>
</tbody>