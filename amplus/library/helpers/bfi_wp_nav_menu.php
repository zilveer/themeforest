<?php

/**
 * Displays a custom menu, displays the default menu with 4 items only
 * if custom is not available, use this instead of WP's wp_nav_menu
 *
 * @param array $args the normal arguments for wp_nav_menu
 * @return null
 */
function bfi_wp_nav_menu($args) {
    if (!array_key_exists('theme_location', $args)) $args['theme_location'] = 'primary';
    if (!array_key_exists('container_id', $args)) $args['container_id'] = '';
    if (!array_key_exists('container_class', $args)) $args['container_class'] = '';
    
    if (has_nav_menu($args['theme_location'])) {
        wp_nav_menu($args);
    } else {
        ?>
        <div id='<?php echo $args['container_id'] ?>' class='<?php echo $args['container_class'] ?>'>
            <ul id='menu-<?php echo $args['container_id'] ?>'>
                <li class="page_item <?php if (is_front_page()) echo( 'current_page_item'); ?>"><a href='<?php echo home_url() ?>'><?php _e('Home', BFI_I18NDOMAIN)?></a>
                <?php wp_list_pages( 'title_li=&post_type=page&post_status=publish&number=4' ); ?>
            </ul>
        </div>
        <?php
    }
}
?>