<?php
for ($i = 1; $i <= $placeholders; $i++) {
    ?>
    <div class="sidebars_placeholder_container">
        <div class="sidebars_placeholder_top sdb_<?php echo $colors[$i]; ?>"></div>
        <div class="sidebars_placeholder_contents sdb_<?php echo $colors[$i]; ?>">
            <ul class="sidebars_placeholder_box"></ul>
            <img class="sidebars_placeholder_empty" src="<?php echo tf_extimage($ext_name, 'sdb_placeholder.png'); ?>" />
            <img class="sidebars_placeholder_empty_clicked" src="<?php echo tf_extimage($ext_name, 'sdb_placeholder_clicked.png'); ?>" />
            <div></div>
        </div>
        <div class="sidebars_placeholder_bottom sdb_<?php echo $colors[$i]; ?>"></div>
    </div>
<?php } ?>