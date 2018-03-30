<?php
/* Customizations for mega menu */
/**
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class A13_Admin_Edit_Menu_Walker extends Walker_Nav_Menu {
    /**
     * Starts the list before the elements are added.
     *
     * @see Walker_Nav_Menu::start_lvl()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   Not used.
     */
    function start_lvl( &$output, $depth = 0, $args = array() ) {}

    /**
     * Ends the list of after the elements are added.
     *
     * @see Walker_Nav_Menu::end_lvl()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   Not used.
     */
    function end_lvl( &$output, $depth = 0, $args = array() ) {}

    /**
     * Start the element output.
     *
     * @see Walker::start_el()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Menu item data object.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     * @param int    $id     Current item ID.
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $_wp_nav_menu_max_depth;
        static $mega_menu_enabled = false;
        $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

        ob_start();
        $item_id = esc_attr( $item->ID );
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
            $original_title = get_the_title( $original_object->ID );
        }

        $classes = array(
            'menu-item menu-item-depth-' . $depth,
            'menu-item-' . esc_attr( $item->object ),
            'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
        );

        $title = $item->title;

        if ( ! empty( $item->_invalid ) ) {
            $classes[] = 'menu-item-invalid';
            /* translators: %s: title of menu item which is invalid */
            $title = sprintf( a13__be( '%s (Invalid)' ), $item->title );
        } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
            $classes[] = 'pending';
            /* translators: %s: title of menu item in draft status */
            $title = sprintf( a13__be('%s (Pending)'), $item->title );
        }

        $title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

        $submenu_text = '';
        if ( 0 == $depth )
            $submenu_text = 'style="display: none;"';

        //mega menu check
        if( $depth === 0 ){
            if($item->a13_mega_menu){
                $mega_menu_enabled = true;
                $classes[] = 'mega-menu-enabled';
            }
            else{
                $mega_menu_enabled = false;
            }
        }
        if( $depth === 1 && $mega_menu_enabled){
            $classes[] = 'mega-menu-enabled';
        }
        ?>


    <li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>">
    <dl class="menu-item-bar">
        <dt class="menu-item-handle">
            <span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo $submenu_text; ?>><?php a13_be( 'sub item' ); ?></span></span>
					<span class="item-controls">
						<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
						<span class="item-order hide-if-js">
							<a href="<?php
                                echo esc_url( wp_nonce_url(
                                    add_query_arg(
                                        array(
                                            'action' => 'move-up-menu-item',
                                            'menu-item' => $item_id,
                                        ),
                                        remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                    ),
                                    'move-menu_item'
                                ) );
                                ?>" class="item-move-up"><abbr title="<?php esc_attr_e( __be('Move up')); ?>">&#8593;</abbr></a>
							|
							<a href="<?php
                                echo esc_url( wp_nonce_url(
                                    add_query_arg(
                                        array(
                                            'action' => 'move-down-menu-item',
                                            'menu-item' => $item_id,
                                        ),
                                        remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                    ),
                                    'move-menu_item'
                                ) );
                                ?>" class="item-move-down"><abbr title="<?php esc_attr_e(__be('Move down')); ?>">&#8595;</abbr></a>
						</span>
						<a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e(__be('Edit Menu Item')); ?>" href="<?php
                            echo esc_url( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) ) );
                            ?>"><?php a13_be( 'Edit Menu Item' ); ?></a>
					</span>
        </dt>
    </dl>

    <div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
        <?php if( 'custom' == $item->type ) : ?>
        <p class="field-url description description-wide">
            <label for="edit-menu-item-url-<?php echo $item_id; ?>">
                <?php a13_be( 'URL' ); ?><br />
                <input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
            </label>
        </p>
        <?php endif; ?>
        <p class="description description-thin">
            <label for="edit-menu-item-title-<?php echo $item_id; ?>">
                <?php a13_be( 'Navigation Label' ); ?><br />
                <input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
            </label>
        </p>
        <p class="description description-thin">
            <label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
                <?php a13_be( 'Title Attribute' ); ?><br />
                <input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
            </label>
        </p>
        <p class="field-link-target description">
            <label for="edit-menu-item-target-<?php echo $item_id; ?>">
                <input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
                <?php a13_be( 'Open link in a new window/tab' ); ?>
            </label>
        </p>
        <p class="field-css-classes description description-thin">
            <label for="edit-menu-item-classes-<?php echo $item_id; ?>">
                <?php a13_be( 'CSS Classes (optional)' ); ?><br />
                <input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
            </label>
        </p>
        <p class="field-xfn description description-thin">
            <label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
                <?php a13_be( 'Link Relationship (XFN)' ); ?><br />
                <input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
            </label>
        </p>
        <p class="field-description description description-wide">
            <label for="edit-menu-item-description-<?php echo $item_id; ?>">
                <?php a13_be( 'Description' ); ?><br />
                <textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
                <span class="description"><?php a13_be('The description will be displayed in the menu if the current theme supports it.'); ?></span>
            </label>
        </p>


        <!-- Apollo 13 Theme enhancement options-->

        <fieldset class="a13-theme-enhancement-options"><legend><?php _be( 'Theme enhancement options' ); ?></legend>
            <p class="field-a13_item_icon description">
                <label for="edit-menu-item-a13_item_icon-<?php echo $item_id; ?>">
                    <?php _be( 'Item icon' ); ?><br />
                    <input type="text" id="edit-menu-item-a13_item_icon-<?php echo $item_id; ?>" class="widefat code edit-menu-item-a13_item_icon a13-fa-icon" name="menu-item-a13_item_icon[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->a13_item_icon ); ?>" />
                </label>
            </p>
            <p class="field-a13_custom_label description">
                <label for="edit-menu-item-a13_custom_label-<?php echo $item_id; ?>">
                    <?php _be( 'Custom label' ); ?><br />
                    <input type="text" id="edit-menu-item-a13_custom_label-<?php echo $item_id; ?>" class="widefat code edit-menu-item-a13_custom_label" name="menu-item-a13_custom_label[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->a13_custom_label ); ?>" />
                </label>
            </p>
        </fieldset>

        <!-- Apollo 13 Mega menu settings-->

        <fieldset class="a13-megamenu-options"><legend><?php _be( 'Mega menu options' ); ?></legend>
            <p class="field-enable-a13_mega_menu description level-0">
                <label for="edit-menu-item-a13_mega_menu-<?php echo $item_id; ?>">
                    <input type="checkbox" class="enable-mega-menu" id="edit-menu-item-a13_mega_menu-<?php echo $item_id; ?>" name="menu-item-a13_mega_menu[<?php echo $item_id; ?>]"<?php checked( $item->a13_mega_menu ); ?> />
                    <?php _be( 'Enable mega menu?' ); ?>
                </label>
            </p>

            <p class="field-a13_mm_columns description level-0 if-mm-enabled">
                <label for="edit-menu-item-a13_mm_columns-<?php echo $item_id; ?>">
                    <?php _be( 'Number of columns' ); ?><br />
                    <select name="menu-item-a13_mm_columns[<?php echo $item_id; ?>]" id="edit-menu-item-a13_mm_columns-<?php echo $item_id; ?>">
                        <?php
                            $column_options =  array( 2, 3, 4 );
                            foreach($column_options as $val){
                                echo '<option value="'.esc_attr($val).'" '.selected($val, $item->a13_mm_columns).'>'.esc_html($val).'</option>';
                            }
                        ?>
                    </select>
                </label>
            </p>

            <p class="field-a13_mm_remove_item level-1">
                <label for="edit-menu-item-a13_mm_remove_item-<?php echo $item_id; ?>">
                    <input id="edit-menu-item-a13_mm_remove_item-<?php echo $item_id; ?>" type="checkbox" name="menu-item-a13_mm_remove_item[<?php echo $item_id; ?>]" <?php checked( $item->a13_mm_remove_item ); ?>/>
                    <?php _be( 'Don\'t show this item in mega menu. Show only descendants.' ); ?>
                </label>
            </p>

            <p class="field-a13_mm_unclickable level-1">
                <label for="edit-menu-item-a13_mm_unclickable-<?php echo $item_id; ?>">
                    <input id="edit-menu-item-a13_mm_unclickable-<?php echo $item_id; ?>" type="checkbox" name="menu-item-a13_mm_unclickable[<?php echo $item_id; ?>]" <?php checked( $item->a13_mm_unclickable ); ?>/>
                    <?php _be( 'Make this item unclickable in mega menu.' ); ?>
                </label>
            </p>
        </fieldset><!-- .a13-megamenu-options-->

        <?php do_action( 'dt_edit_menu_walker_print_item_settings', $item, $depth, $args, $id, $item_id ); ?>

        <p class="field-move hide-if-no-js description description-wide">
            <label>
                <span><?php a13_be( 'Move' ); ?></span>
                <a href="#" class="menus-move-up"><?php a13_be( 'Up one' ); ?></a>
                <a href="#" class="menus-move-down"><?php a13_be( 'Down one' ); ?></a>
                <a href="#" class="menus-move-left"></a>
                <a href="#" class="menus-move-right"></a>
                <a href="#" class="menus-move-top"><?php a13_be( 'To the top' ); ?></a>
            </label>
        </p>

        <div class="menu-item-actions description-wide submitbox">
            <?php if( 'custom' != $item->type && $original_title !== false ) : ?>
            <p class="link-to-original">
                <?php printf( a13__be('Original: %s'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
            </p>
            <?php endif; ?>
            <a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
                echo esc_url( wp_nonce_url(
                    add_query_arg(
                        array(
                            'action' => 'delete-menu-item',
                            'menu-item' => $item_id,
                        ),
                        admin_url( 'nav-menus.php' )
                    ),
                    'delete-menu_item_' . $item_id
                ) ); ?>"><?php a13_be( 'Remove' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
            ?>#menu-item-settings-<?php echo $item_id; ?>"><?php a13_be('Cancel'); ?></a>
        </div>

        <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo $item_id; ?>" />
        <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
        <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
        <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
        <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
        <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
    </div><!-- .menu-item-settings-->
    <ul class="menu-item-transport"></ul>
    <?php
        $output .= ob_get_clean();
    }

}

function a13_admin_change_walker_class( $walker, $menu_id ) {
    return 'A13_Admin_Edit_Menu_Walker';
}

function a13_admin_add_custom_menu_fields( $menu_item ) {
    //mega menu
    $menu_item->a13_mega_menu       = get_post_meta( $menu_item->ID, '_a13_mega_menu', true );
    $menu_item->a13_mm_columns      = get_post_meta( $menu_item->ID, '_a13_mm_columns', true );
    $menu_item->a13_mm_remove_item  = get_post_meta( $menu_item->ID, '_a13_mm_remove_item', true );
    $menu_item->a13_mm_unclickable  = get_post_meta( $menu_item->ID, '_a13_mm_unclickable', true );

    //theme enhancement
    $menu_item->a13_item_icon       = get_post_meta( $menu_item->ID, '_a13_item_icon', true );
    $menu_item->a13_custom_label    = get_post_meta( $menu_item->ID, '_a13_custom_label', true );

    return $menu_item;
}

function a13_admin_update_custom_menu_fields( $menu_id, $menu_item_db_id, $args ) {
    //mega menu
    $value = isset($_REQUEST['menu-item-a13_mega_menu'], $_REQUEST['menu-item-a13_mega_menu'][$menu_item_db_id]);
    update_post_meta( $menu_item_db_id, '_a13_mega_menu', $value );

    $value = isset($_REQUEST['menu-item-a13_mm_remove_item'], $_REQUEST['menu-item-a13_mm_remove_item'][$menu_item_db_id]);
    update_post_meta( $menu_item_db_id, '_a13_mm_remove_item', $value );

    $value = isset($_REQUEST['menu-item-a13_mm_unclickable'], $_REQUEST['menu-item-a13_mm_unclickable'][$menu_item_db_id]);
    update_post_meta( $menu_item_db_id, '_a13_mm_unclickable', $value );

    if ( isset($_REQUEST['menu-item-a13_mm_columns']) && is_array( $_REQUEST['menu-item-a13_mm_columns'] ) ) {
        $columns = absint($_REQUEST['menu-item-a13_mm_columns'][$menu_item_db_id]);
        update_post_meta( $menu_item_db_id, '_a13_mm_columns', $columns );
    }

    //theme enhancement
    $value = isset($_REQUEST['menu-item-a13_item_icon'], $_REQUEST['menu-item-a13_item_icon'][$menu_item_db_id])? $_REQUEST['menu-item-a13_item_icon'][$menu_item_db_id] : '';
    update_post_meta( $menu_item_db_id, '_a13_item_icon', $value );

    $value = isset($_REQUEST['menu-item-a13_custom_label'], $_REQUEST['menu-item-a13_custom_label'][$menu_item_db_id])? $_REQUEST['menu-item-a13_custom_label'][$menu_item_db_id] : '';
    update_post_meta( $menu_item_db_id, '_a13_custom_label', $value );
}



add_filter( 'wp_edit_nav_menu_walker', 'a13_admin_change_walker_class', 10, 2 );
add_filter( 'wp_setup_nav_menu_item', 'a13_admin_add_custom_menu_fields' );
add_action( 'wp_update_nav_menu_item', 'a13_admin_update_custom_menu_fields', 10, 3 );

