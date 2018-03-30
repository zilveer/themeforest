<?php
/**
 * The Sidebar containing the main widget area
 */
?>
<?php $current_position = function_exists('fw_ext_sidebars_get_current_position') ? fw_ext_sidebars_get_current_position() : 'right'; ?>
<?php if ( $current_position !== 'full' && $current_position !== null ) : ?>
    <aside>
        <?php if ( $current_position === 'left' or $current_position === 'right' ) : ?>
            <?php if(function_exists('fw_ext_sidebars_show')) echo fw_ext_sidebars_show('blue'); else dynamic_sidebar('sidebar-1'); ?>
        <?php endif; ?>
    </aside>
<?php endif; ?>