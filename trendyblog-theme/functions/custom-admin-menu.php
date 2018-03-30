<?php 

add_action('wp_update_nav_menu_item', 'custom_nav_update',10, 3);
function custom_nav_update($menu_id, $menu_item_db_id, $args ) {
    if (isset($_REQUEST['menu-item-color']) && is_array($_REQUEST['menu-item-color']) ) {
        if(isset($_REQUEST['menu-item-color'][$menu_item_db_id])) {
            $custom_value = $_REQUEST['menu-item-color'][$menu_item_db_id];
            update_post_meta( $menu_item_db_id, '_menu_item_color', $custom_value );    
        } else {
            update_post_meta( $menu_item_db_id, '_menu_item_color', null );  
        }

    }
    if (isset($_REQUEST['menu-item-menu_type']) && is_array($_REQUEST['menu-item-menu_type']) ) {
        if(isset($_REQUEST['menu-item-menu_type'][$menu_item_db_id])) {
            $custom_value = $_REQUEST['menu-item-menu_type'][$menu_item_db_id];
            update_post_meta( $menu_item_db_id, '_menu_item_menu_type', $custom_value );    
        } else {
            update_post_meta( $menu_item_db_id, '_menu_item_menu_type', null );  
        }

    }
    if (isset($_REQUEST['menu-item-menu_sidebar']) && is_array($_REQUEST['menu-item-menu_sidebar']) ) {
        if(isset($_REQUEST['menu-item-menu_sidebar'][$menu_item_db_id])) {
            $custom_value = $_REQUEST['menu-item-menu_sidebar'][$menu_item_db_id];
            update_post_meta( $menu_item_db_id, '_menu_item_menu_sidebar', $custom_value );    
        } else {
            update_post_meta( $menu_item_db_id, '_menu_item_menu_sidebar', null );  
        }

    }

}

/*
 * Adds value of new field to $item object that will be passed to     Walker_Nav_Menu_Edit_Custom
 */
add_filter( 'wp_setup_nav_menu_item','custom_nav_item' );
function custom_nav_item($menu_item) {
    $menu_item->color = get_post_meta( $menu_item->ID, '_menu_item_color', true );
    $menu_item->menu_type = get_post_meta( $menu_item->ID, '_menu_item_menu_type', true );
    $menu_item->menu_sidebar = get_post_meta( $menu_item->ID, '_menu_item_menu_sidebar', true );
    $menu_item->icon = get_post_meta( $menu_item->ID, '_menu_item_icon', true );
    return $menu_item;
}

add_filter( 'wp_edit_nav_menu_walker', 'custom_nav_edit_walker',10,2 );
function custom_nav_edit_walker($walker,$menu_id) {
    return 'Walker_Nav_Menu_Edit_Custom';
}

/**
 * Copied from Walker_Nav_Menu_Edit class in core
 * 
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class Walker_Nav_Menu_Edit_Custom extends Walker_Nav_Menu  {
/**
 * @see Walker_Nav_Menu::start_lvl()
 * @since 3.0.0
 *
 * @param string $output Passed by reference.
 */
function start_lvl(&$output, $depth = 0, $args = array()) {}

/**
 * @see Walker_Nav_Menu::end_lvl()
 * @since 3.0.0
 *
 * @param string $output Passed by reference.
 */
function end_lvl(&$output, $depth = 0, $args = array()) {
}

/**
 * @see Walker::start_el()
 * @since 3.0.0
 *
 * @param string $output Passed by reference. Used to append additional content.
 * @param object $item Menu item data object.
 * @param int $depth Depth of menu item. Used for padding.
 * @param object $args
 */
function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
    global $_wp_nav_menu_max_depth;
    $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

    ob_start();
    $item_id = esc_attr__( $item->ID );
    $removed_args = array(
        'action',
        'customlink-tab',
        'edit-menu-item',
        'menu-item',
        'page-tab',
        '_wpnonce',
    );

    $original_title = '';
    if ( 'taxonomy' == $item->type ) {
        $original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
        if ( is_wp_error( $original_title ) )
            $original_title = false;
    } elseif ( 'post_type' == $item->type ) {
        $original_object = get_post( $item->object_id );
        $original_title = $original_object->post_title;
    }

    $classes = array(
        'menu-item menu-item-depth-' . $depth,
        'menu-item-' . esc_attr__( $item->object ),
        'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
    );

    $title = $item->title;

    if ( ! empty( $item->_invalid ) ) {
        $classes[] = 'menu-item-invalid';
        /* translators: %s: title of menu item which is invalid */
        $title = sprintf( esc_html__( '%s (Invalid)', THEME_NAME ), $item->title );
    } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
        $classes[] = 'pending';
        /* translators: %s: title of menu item in draft status */
        $title = sprintf( esc_html__('%s (Pending)', THEME_NAME), $item->title );
    }

    $title = empty( $item->label ) ? $title : $item->label;

    ?>
    <li id="menu-item-<?php echo esc_attr__($item_id); ?>" class="<?php echo esc_attr__(implode(' ', $classes )); ?>">
        <dl class="menu-item-bar">
            <dt class="menu-item-handle">
                <span class="item-title"><?php echo esc_html__( $title ); ?></span>
                <span class="item-controls">
                    <span class="item-type"><?php echo esc_html__( $item->type_label ); ?></span>
                    <span class="item-order hide-if-js">
                        <a href="<?php
                            echo esc_url(wp_nonce_url(
                                add_query_arg(
                                    array(
                                        'action' => 'move-up-menu-item',
                                        'menu-item' => $item_id,
                                    ),
                                    remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                ),
                                'move-menu_item'
                            ));
                        ?>" class="item-move-up"><abbr title="<?php esc_html_e('Move up'); ?>">&#8593;</abbr></a>
                        |
                        <a href="<?php
                            echo esc_url(wp_nonce_url(
                                add_query_arg(
                                    array(
                                        'action' => 'move-down-menu-item',
                                        'menu-item' => $item_id,
                                    ),
                                    remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                ),
                                'move-menu_item'
                            ));
                        ?>" class="item-move-down"><abbr title="<?php esc_html_e('Move down'); ?>">&#8595;</abbr></a>
                    </span>
                    <a class="item-edit" id="edit-<?php echo esc_attr__($item_id); ?>" title="<?php esc_html_e('Edit Menu Item'); ?>" href="<?php
                        echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
                    ?>"><?php esc_html_e( 'Edit Menu Item', THEME_NAME ); ?></a>
                </span>
            </dt>
        </dl>

        <div class="menu-item-settings wp-clearfix" id="menu-item-settings-<?php echo esc_attr__($item_id); ?>">
            <?php if( 'custom' == $item->type ) : ?>
                <p class="field-url description description-wide">
                    <label for="edit-menu-item-url-<?php echo esc_attr__($item_id); ?>">
                        <?php esc_html_e( 'URL', THEME_NAME ); ?><br />
                        <input type="text" id="edit-menu-item-url-<?php echo esc_attr__($item_id); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr__($item_id); ?>]" value="<?php echo esc_attr__( $item->url ); ?>" />
                    </label>
                </p>
            <?php endif; ?>
            <p class="description description-thin">
                <label for="edit-menu-item-title-<?php echo esc_attr__($item_id); ?>">
                    <?php esc_html_e( 'Navigation Label', THEME_NAME ); ?><br />
                    <input type="text" id="edit-menu-item-title-<?php echo esc_attr__($item_id); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr__($item_id); ?>]" value="<?php echo esc_attr__( $item->title ); ?>" />
                </label>
            </p>
            <p class="description description-thin">
                <label for="edit-menu-item-attr-title-<?php echo esc_attr__($item_id); ?>">
                    <?php esc_html_e( 'Title Attribute', THEME_NAME ); ?><br />
                    <input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr__($item_id); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr__($item_id); ?>]" value="<?php echo esc_attr__( $item->post_excerpt ); ?>" />
                </label>
            </p>
            <p class="field-link-target description">
                <label for="edit-menu-item-target-<?php echo esc_attr__($item_id); ?>">
                    <input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr__($item_id); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr__($item_id); ?>]"<?php checked( $item->target, '_blank' ); ?> />
                    <?php esc_html_e( 'Open link in a new window/tab', THEME_NAME ); ?>
                </label>
            </p>
            <p class="field-css-classes description description-thin">
                <label for="edit-menu-item-classes-<?php echo esc_attr__($item_id); ?>">
                    <?php esc_html_e( 'CSS Classes (optional)', THEME_NAME ); ?><br />
                    <input type="text" id="edit-menu-item-classes-<?php echo esc_attr__($item_id); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr__($item_id); ?>]" value="<?php echo esc_attr__( implode(' ', $item->classes ) ); ?>" />
                </label>
            </p>
            <p class="field-xfn description description-thin">
                <label for="edit-menu-item-xfn-<?php echo esc_attr__($item_id); ?>">
                    <?php esc_html_e( 'Link Relationship (XFN)', THEME_NAME ); ?><br />
                    <input type="text" id="edit-menu-item-xfn-<?php echo esc_attr__($item_id); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr__($item_id); ?>]" value="<?php echo esc_attr__( $item->xfn ); ?>" />
                </label>
            </p>
            <p class="field-description description description-wide">
                <label for="edit-menu-item-description-<?php echo esc_attr__($item_id); ?>">
                    <?php esc_html_e( 'Description', THEME_NAME ); ?><br />
                    <textarea id="edit-menu-item-description-<?php echo esc_attr__($item_id); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr__($item_id); ?>]"><?php echo esc_textarea( $item->description ); // textarea_escaped ?></textarea>
                    <span class="description"><?php esc_html_e('The description will be displayed in the menu if the current theme supports it.', THEME_NAME); ?></span>
                </label>
            </p>        
            <?php
            /*
             * This is the added field
             */

            ?> 
              
            <p class="field-custom description description-wide">
                <label for="edit-menu-item-color-<?php echo esc_attr__($item_id); ?>">
                    <input type="checkbox" id="edit-menu-item-color-<?php echo esc_attr__($item_id); ?>" value="yes" name="menu-item-color[<?php echo esc_attr__($item_id); ?>]"<?php checked( $item->color, 'yes' ); ?> />
                    <?php esc_html_e( 'Show The Color Line In Main Menu Parent Item (Only Pages/Categories)', THEME_NAME ); ?>
                </label>
            </p>  
            
            <p class="field-custom description description-wide">
                <label for="edit-menu-menu_type-<?php echo esc_attr__($item_id); ?>">
                    <?php _e( 'Main menu type ( only menu parent item )', THEME_NAME ); ?><br/>
                    <select id="edit-menu-menu_type-<?php echo esc_attr__($item_id); ?>" name="menu-item-menu_type[<?php echo esc_attr__($item_id); ?>]">
                        <option value="1"<?php if($item->menu_type=="1") echo ' selected="selected"'; ?>><?php esc_html_e('Default', THEME_NAME ); ?></option>
                        <option value="2"<?php if($item->menu_type=="2") echo ' selected="selected"'; ?>><?php esc_html_e('Mega Menu With Widgets', THEME_NAME ); ?></option>
                    </select>
                </label>
            </p>     
            <p class="field-custom description description-wide df-sidebar-field">
                <label for="edit-menu-menu_sidebar-<?php echo esc_attr__($item_id); ?>">
                    <?php esc_html_e( 'Sidebar for widget mega menu', THEME_NAME ); ?><br/>
                    <?php 
                        $sidebar_names = df_get_option( THEME_NAME."_sidebar_names" );
                        $sidebar_names = explode( "|*|", $sidebar_names );
                    ?>
                    <select id="edit-menu-menu_sidebar-<?php echo esc_attr__($item_id); ?>" name="menu-item-menu_sidebar[<?php echo esc_attr__($item_id); ?>]">
                        <option value="default" ><?php esc_html_e("Default", THEME_NAME);?></option>
                        <?php
                            foreach ($sidebar_names as $sidebar_name) {
                                if ( $item->menu_sidebar == $sidebar_name ) {
                                    $selected="selected=\"selected\"";
                                } else { 
                                    $selected="";
                                }
                                        
                                if ( $sidebar_name != "" ) {
                        ?>
                                <option value="<?php echo esc_attr__($sidebar_name);?>" <?php echo esc_html__($selected);?>><?php echo esc_html__($sidebar_name);?></option>
                        <?php
                                }
                            }
                        ?>
                    </select>
                </label>
            </p>     

            <?php

            /*
             * end added field
             */
            ?>
            <div class="menu-item-actions description-wide submitbox">
                <?php if( 'color' != $item->type && $original_title !== false ) : ?>
                    <p class="link-to-original">
                        <?php printf( esc_html__('Original: %s', THEME_NAME), '<a href="' . esc_url( $item->url ) . '">' . esc_html__( $original_title ) . '</a>' ); ?>
                    </p>
                <?php endif; ?>
                <a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr__($item_id); ?>" href="<?php
                echo esc_url(wp_nonce_url(
                    add_query_arg(
                        array(
                            'action' => 'delete-menu-item',
                            'menu-item' => $item_id,
                        ),
                        remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                    )),
                    'delete-menu_item_' . $item_id
                ); ?>"><?php esc_html_e('Remove', THEME_NAME); ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo esc_attr__($item_id); ?>" href="<?php echo esc_url( add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) );
                    ?>#menu-item-settings-<?php echo esc_attr__($item_id); ?>"><?php esc_html_e('Cancel', THEME_NAME); ?></a>
            </div>

            <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr__($item_id); ?>]" value="<?php echo esc_attr__($item_id); ?>" />
            <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr__($item_id); ?>]" value="<?php echo esc_attr__( $item->object_id ); ?>" />
            <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr__($item_id); ?>]" value="<?php echo esc_attr__( $item->object ); ?>" />
            <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr__($item_id); ?>]" value="<?php echo esc_attr__( $item->menu_item_parent ); ?>" />
            <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr__($item_id); ?>]" value="<?php echo esc_attr__( $item->menu_order ); ?>" />
            <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr__($item_id); ?>]" value="<?php echo esc_attr__( $item->type ); ?>" />
        </div><!-- .menu-item-settings-->
        <ul class="menu-item-transport"></ul>
    <?php
    $output .= ob_get_clean();
    }
}

?>