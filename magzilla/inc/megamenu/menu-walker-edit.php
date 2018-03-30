<?php

/*********************
CUSTOM WALKER
*********************/
if ( ! function_exists( 'fave_menu_children' ) ) {
    function fave_menu_children ($object){

        $fave_with_children = array();

        foreach ( $object as $menu ) {

            $fave_current_obj = $menu->menu_item_parent;

            if ( $fave_current_obj != '0' ) {
                $fave_with_children[] .= $menu->menu_item_parent;
            }
        }

        foreach ( $object as $menu ) {

            $fave_current_obj = $menu->ID;

            if ( in_array( $fave_current_obj, $fave_with_children ) ) {
                $menu->classes[] = "dropdown";
            }
        }
        return $object;
    }
}
add_filter( 'wp_nav_menu_objects', 'fave_menu_children' );


/*********************
CUSTOM WALKER EDIT
*********************/
if ( ! class_exists( 'fave_walker_backend' ) ) {
    class fave_walker_backend extends Walker_Nav_Menu {

        function start_lvl( &$output, $depth = 0, $args = array() ) {}
        function end_lvl( &$output, $depth = 0, $args = array() ) {}

        function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
            global $_wp_nav_menu_max_depth;
            $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;
  

            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

            ob_start();
            $item_id = esc_attr( $item->ID );
            if ( empty( $item->favemenutype[0]) ) {
                $fave_item_menutype = NULL;
            } else {
                $fave_item_menutype = esc_attr ( $item->favemenutype[0] );
            }
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
                $title = sprintf( __( '%s (Invalid)' , 'cubell' ), $item->title );
            } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
                $classes[] = 'pending';
                /* translators: %s: title of menu item in draft status */
                $title = sprintf( __('%s (Pending)' , 'cubell'), $item->title );
            }

            $title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

            $submenu_text = '';
            if ( 0 == $depth )
                $submenu_text = 'style="display: none;"';

            ?>
            <li id="menu-item-<?php echo esc_attr( $item_id ); ?>" class="<?php echo implode(' ', $classes ); ?>">
                <dl class="menu-item-bar">
                    <dt class="menu-item-handle">
                        <span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo esc_attr( $submenu_text ); ?>>sub item</span></span>
                        <span class="item-controls">
                            <span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
                            <span class="item-order hide-if-js">
                                <a href="<?php
                                    echo wp_nonce_url(
                                        add_query_arg(
                                            array(
                                                'action' => 'move-up-menu-item',
                                                'menu-item' => $item_id,
                                            ),
                                            remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                        ),
                                        'move-menu_item'
                                    );
                                ?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up', 'magzilla'); ?>">&#8593;</abbr></a>
                                |
                                <a href="<?php
                                    echo wp_nonce_url(
                                        add_query_arg(
                                            array(
                                                'action' => 'move-down-menu-item',
                                                'menu-item' => $item_id,
                                            ),
                                            remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                        ),
                                        'move-menu_item'
                                    );
                                ?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down', 'magzilla'); ?>">&#8595;</abbr></a>
                            </span>
                            <a class="item-edit" id="edit-<?php echo esc_attr( $item_id ); ?>" title="<?php esc_attr_e('Edit Menu Item', 'magzilla'); ?>" href="<?php
                                echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
                            ?>"><?php _e( 'Edit Menu Item', 'magzilla' ); ?></a>
                        </span>
                    </dt>
                </dl>

                <div class="menu-item-settings" id="menu-item-settings-<?php echo esc_attr( $item_id ); ?>">
                    <?php if( 'custom' == $item->type ) : ?>
                        <p class="field-url description description-wide">
                            <label for="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>">
                                <?php _e( 'URL', 'magzilla' ); ?><br />
                                <input type="text" id="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
                            </label>
                        </p>
                    <?php endif; ?>
                    <p class="description description-thin">
                        <label for="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>">
                            <?php _e( 'Navigation Label', 'magzilla' ); ?><br />
                            <input type="text" id="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
                        </label>
                    </p>
                    <p class="description description-thin">
                        <label for="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>">
                            <?php _e( 'Title Attribute', 'magzilla' ); ?><br />
                            <input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
                        </label>
                    </p>
                    <p class="field-link-target description">
                        <label for="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>">
                            <input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr( $item_id ); ?>]"<?php checked( $item->target, '_blank' ); ?> />
                            <?php _e( 'Open link in a new window/tab', 'magzilla' ); ?>
                        </label>
                    </p>
                    <p class="field-css-classes description description-thin">
                        <label for="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>">
                            <?php _e( 'CSS Classes (optional)', 'magzilla' ); ?><br />
                            <input type="text" id="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
                        </label>
                    </p>
                    <p class="field-xfn description description-thin">
                        <label for="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>">
                            <?php _e( 'Link Relationship (XFN)', 'magzilla' ); ?><br />
                            <input type="text" id="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
                        </label>
                    </p>

                    <?php
                    if ( $depth == 0) { ?>
                
                    <p class="field-favemenutype description description-thin">
                         <label for="edit-menu-item-favemenutype-<?php echo esc_attr( $item_id ); ?>">Magazilla Megamenu Type</label>
                         <select id="edit-menu-item-favemenutype-<?php echo esc_attr( $item_id ); ?>" name="menu-item-favemenutype[<?php echo esc_attr( $item_id ); ?>]">
                            <option value="1" <?php if ( ( $fave_item_menutype == '1' ) || ( $fave_item_menutype == NULL ) ) echo 'selected="selected"'; ?>>Disable</option>
                            <?php //if ( $item->object == 'category' || $item->object == 'page' ) { ?>
                                <option value="3" <?php if ( $fave_item_menutype == '3' ) echo 'selected="selected"'; ?>>Category/Posts Megamenu</option>
                           <?php //} ?>
                           <option value="2" <?php if ( $fave_item_menutype == '2' ) echo 'selected="selected"'; ?>>Text Columns Megamenu</option>
                         </select>
                    </p>

                    <p class="field-favemegamenu description description-thin">
                         <label for="edit-menu-item-favemegamenu-<?php echo esc_attr( $item_id ); ?>">Show Category Megamenu</label>
                         <select id="edit-menu-item-favemegamenu-<?php echo esc_attr( $item_id ); ?>" name="menu-item-favemegamenu[<?php echo esc_attr( $item_id ); ?>]">
                           
                           <?php $fave_mega_menu_cat = get_post_meta($item->ID, 'fave_mega_menu_cat', true ); ?>
                           <?php $fave_category_tree = array_merge (array(' - Select Category - ' => ''), fave_get_category_id_array(false)); ?>

                           <?php foreach ($fave_category_tree as $category => $category_id) {
                                
                                echo '<option value="' . $category_id . '"' . selected( $fave_mega_menu_cat, $category_id, false) . '>' . $category . '</option>';
                           
                            } ?>

                         </select>
                    </p>
                    <p class="field-nav_no_of_posts description description-thin">
                        <label for="edit-menu-item-nav_no_of_posts-<?php echo esc_attr( $item_id ); ?>">
                            <?php _e( 'Number of posts to show', 'magzilla' ); ?><br />
                            
                            <select id="edit-menu-item-nav_no_of_posts-<?php echo esc_attr( $item_id ); ?>" name="menu-item-nav_no_of_posts[<?php echo esc_attr( $item_id ); ?>]">
                                
                                <?php for( $i = 4; $i <= 20; $i++ ) { ?>
                                <option value="<?php echo $i; ?>" <?php selected( $item->nav_no_of_posts, $i ); ?>><?php echo $i; ?></option>
                                <?php } ?>

                            </select>
                        </label>
                    </p>
                    <?php
                    
                    }
                    ?>
                    <p class="field-description description description-wide">
                        <label for="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>">
                            <?php _e( 'Description', 'magzilla' ); ?><br />
                            <textarea id="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr( $item_id ); ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
                            <span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it. ', 'magzilla'); ?></span>
                        </label>
                    </p>

                    <p class="field-move hide-if-no-js description description-wide">
                        <label>
                            <span><?php _e( 'Move', 'magzilla' ); ?></span>
                            <a href="#" class="menus-move-up"><?php _e( 'Up one', 'magzilla' ); ?></a>
                            <a href="#" class="menus-move-down"><?php _e( 'Down one', 'magzilla' ); ?></a>
                            <a href="#" class="menus-move-left"></a>
                            <a href="#" class="menus-move-right"></a>
                            <a href="#" class="menus-move-top"><?php _e( 'To the top', 'magzilla' ); ?></a>
                        </label>
                    </p>

                    <div class="menu-item-actions description-wide submitbox">
                        <?php if( 'custom' != $item->type && $original_title !== false ) : ?>
                            <p class="link-to-original">
                                <?php printf( __('Original: %s', 'magzilla'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
                            </p>
                        <?php endif; ?>
                        <a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr( $item_id ); ?>" href="<?php
                        echo wp_nonce_url(
                            add_query_arg(
                                array(
                                    'action' => 'delete-menu-item',
                                    'menu-item' => $item_id,
                                ),
                                admin_url( 'nav-menus.php' )
                            ),
                            'delete-menu_item_' . $item_id
                        ); ?>"><?php _e( 'Remove', 'magzilla' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo esc_attr( $item_id ); ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
                            ?>#menu-item-settings-<?php echo esc_attr( $item_id ); ?>"><?php _e('Cancel' , 'magzilla'); ?></a>
                    </div>

                    <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item_id ); ?>" />
                    <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
                    <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
                    <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
                    <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
                    <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
                </div><!-- .menu-item-settings-->
                <ul class="menu-item-transport"></ul>
            <?php
            $output .= ob_get_clean();
        }


    }
}

if ( ! function_exists( 'fave_megamenu_walker' ) ) {
    function fave_megamenu_walker($walker) {
        if ( $walker === 'Walker_Nav_Menu_Edit' ) {
            $walker = 'fave_walker_backend';
        }
       return $walker;
    }
}
add_filter( 'wp_edit_nav_menu_walker', 'fave_megamenu_walker');

if ( ! function_exists( 'fave_megamenu_walker_save' ) ) {
    function fave_megamenu_walker_save($menu_id, $menu_item_db_id) {

        if  ( isset($_POST['menu-item-favemegamenu'][$menu_item_db_id]) ) {
                update_post_meta( $menu_item_db_id, 'fave_mega_menu_cat', $_POST['menu-item-favemegamenu'][$menu_item_db_id]);
        } else {
            update_post_meta( $menu_item_db_id, 'fave_mega_menu_cat', '0' );
        }

        if  ( isset($_POST['menu-item-favemenutype'][$menu_item_db_id]) ) {
                update_post_meta( $menu_item_db_id, 'fave_megamenu_type', $_POST['menu-item-favemenutype'][$menu_item_db_id]);
        } else {
            update_post_meta( $menu_item_db_id, 'fave_megamenu_type', '0' );
        }

        if  ( isset($_POST['menu-item-nav_no_of_posts'][$menu_item_db_id]) ) {
                update_post_meta( $menu_item_db_id, 'fave_nav_no_of_posts', $_POST['menu-item-nav_no_of_posts'][$menu_item_db_id]);
        } else {
            update_post_meta( $menu_item_db_id, 'fave_nav_no_of_posts', '4' );
        }

    }
}
add_action( 'wp_update_nav_menu_item', 'fave_megamenu_walker_save', 10, 2 );

if ( ! function_exists( 'fave_megamenu_walker_loader' ) ) {
    function fave_megamenu_walker_loader($menu_item) {
            $menu_item->favemegamenu = get_post_meta($menu_item->ID, 'fave_mega_menu_cat', true);
            $menu_item->favemenutype = get_post_meta($menu_item->ID, 'fave_megamenu_type', true);
            $menu_item->nav_no_of_posts = get_post_meta($menu_item->ID, 'fave_nav_no_of_posts', true);
            return $menu_item;
     }
}

add_filter( 'wp_setup_nav_menu_item', 'fave_megamenu_walker_loader' );



/* Add class to menu category item when mega menu is detected */
if ( !function_exists( 'fave_add_class_to_menu' ) ):
function fave_add_class_to_menu( $classes, $item ) {

    /*if ( $item->object == 'category' && !$item->menu_item_parent && isset( $item->mega_menu_cat ) && $item->mega_menu_cat ) {
        $classes[] = 'fave-mega-cat';
    }*/

    if ( $item->object == 'page') {
        $classes[] = 'fave-menu-page-'.$item->object_id;
    }
    if ( $item->object == 'category') {
        $classes[] = 'fave-menu-cat-'.$item->object_id;
    }
    if ( $item->object == 'video-categories') {
        $classes[] = 'fave-menu-video-cat-'.$item->object_id;
    }
    if ( $item->object == 'gallery-categories') {
        $classes[] = 'fave-menu-gallery-cat-'.$item->object_id;
    }

    if ( $item->favemenutype == 3 ) {
        if ( $item->favemegamenu ) {
            $classes[] = 'dropdown yamm-fw';
        }
    }

    if ( $item->favemenutype == 2 ) {
          $classes[] = 'dropdown yamm-fw favethemes-links-megamenu';
    }


    return $classes;

}
endif;

add_filter( 'nav_menu_css_class', 'fave_add_class_to_menu', 10, 2 );
?>
