<?php

/**
* CUSTOM WALKER
*---------------------------------------------------
*/ 


/*--- Frontend Walker ---*/
class BK_Walker extends Walker_Nav_Menu {
    
    function start_el( &$output, $object, $depth = 0, $args = array(), $id = 0) {
        parent::start_el( $output, $object, $depth, $args );
        
        global $bk_megamenu_carousel_el;
        
        $bk_cat_menu = $object->bkmegamenu;

        if ( $bk_cat_menu == NULL ) {
             $bk_cat_menu = '0'; 
        }    
        global $bk_option;
        if (isset($bk_option)):
            $fixed_nav = $bk_option['bk-fixed-nav-switch'];
            $rtl = $bk_option['bk-rtl-sw'];
        endif;
        $bk_output = $bk_posts = $bk_menu_featured = $bk_has_children = $bk_carousel_item_num = NULL;
        $bk_current_type = $object->object;
        $bk_current_classes = $object->classes;
        if ( in_array('menu-item-has-children', $bk_current_classes) ) { $bk_has_children = ' bk-with-sub'; }
        
        if (($object->menu_item_parent == '0')&($object->bkmegamenu == '1')) {
            $bk_carousel_id = "bk-carousel-".$object->ID;
            if ($bk_has_children == ' bk-with-sub') { 
                $bk_carousel_item_num = 4;
            } else { 
                $bk_carousel_item_num = 5;
            }
            $bk_megamenu_carousel_el[$bk_carousel_id] = $bk_carousel_item_num;
            wp_localize_script( 'customjs', 'megamenu_carousel_el', $bk_megamenu_carousel_el );
        }

        if ( ( $bk_cat_menu == 1 )  && ( $object->menu_item_parent == '0')) { 
            
            $output .= '<div class="bk-mega-menu ">';               
            $bk_cat_id = $object->object_id;
            $bk_qry_amount = 9;    
            $bk_args = array( 'cat' => $bk_cat_id,  'post_type' => 'post',  'post_status' => 'publish',  'posts_per_page' => $bk_qry_amount);
            $bk_qry_latest = $bk_img = $bk_cat_link = NULL;
            $bk_qry_latest = new WP_Query($bk_args);
            $i = 1;
            
            foreach ( $bk_qry_latest->posts as $bk_post ) {
                    setup_postdata( $bk_post ); 
                        
                    $bk_post_id = $bk_post->ID;
                                  
                    $bk_img = bk_get_thumbnail($bk_post_id, 'bk262_400');
                    $bk_permalink = get_permalink($bk_post_id);
                    $bk_cat_link = get_category_link($bk_cat_id);
                    $bk_cat_name = get_cat_name($bk_cat_id);
                    $bk_post_title = the_excerpt_limit($bk_post->post_title, 12);
                    $bk_review_score =  bk_review_score($bk_post_id);
                     
                    $bk_posts .= ' <li class="bk-sub-post">
                                    <div class="thumb">'. $bk_img.$bk_review_score.'</div>
                                    <div class="bk-meta">
                                        <h3 class="post-title post-title-card"><a href="'.$bk_permalink.'">'.$bk_post_title.'</a></h3>                        
                                    </div>
                                   </li>'; 
                    
                $i++;
            }
            wp_reset_postdata();  
        }       
        
        if ( ( $bk_cat_menu == 0 )  && ( $object->menu_item_parent == '0')&& ( in_array('menu-item-has-children', $bk_current_classes) ) ) { 
            $output .= '<div class="bk-dropdown-menu">';
        }

        
        if ( $bk_posts != NULL ) {
                 $output .= '<div id="'.$bk_carousel_id.'" class="bk-sub-posts'.$bk_has_children.' flexslider clear-fix">
                                <ul class="slides">'. $bk_posts .'</ul>
                             </div>'; 
        } 
        if ( ($bk_has_children == NULL) && ($object->bkmegamenu == '1') ) {
                $bk_closer = '</div>';
            } else {
                $bk_closer = NULL;
            }
        $output .= $bk_closer;

    
    }
    
    //start of the sub menu wrap
    function start_lvl( &$output, $depth=0, $args = array() ) {

        if ( $depth > 2 ) { return; }
        if ( $depth == 1 )  { $output .= '<ul class="bk-sub-sub-menu">'; }
        if ( $depth == 0 )  { $output .= '<ul class="bk-sub-menu">'; }
    }
 
    //end of the sub menu wrap
    function end_lvl( &$output, $depth=0, $args = array() ) {

        if ( $depth > 2 ) { return; }
        if ( $depth == 0 ) { $output .= '</ul></div>'; }
        if ( $depth == 1 ) { $output .= '</ul>'; }
        
    }    
}

/*--- Backend Walker ---*/
class bk_walker_backend extends Walker_Nav_Menu {
    function start_lvl( &$output, $depth = 0, $args = array() ) {}
    function end_lvl( &$output, $depth = 0, $args = array() ) {}
    
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $_wp_nav_menu_max_depth;
        $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        ob_start();
        $item_id = esc_attr( $item->ID );
        if (empty($item->bkmegamenu[0])) {
            $bk_item_megamenu = NULL;
        } else {
            $bk_item_megamenu = esc_attr ($item->bkmegamenu[0]);
        }
        $removed_args = array( 'action','customlink-tab', 'edit-menu-item', 'menu-item', 'page-tab',  '_wpnonce', );

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
            'menu-item-' . esc_attr( $item->object ),
            'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
        );

        $title = $item->title;

        if ( ! empty( $item->_invalid ) ) {
            $classes[] = 'menu-item-invalid';
            /* translators: %s: title of menu item which is invalid */
            $title = sprintf( __( '%s (Invalid)' , 'bkninja'), $item->title );
        } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
            $classes[] = 'pending';
            /* translators: %s: title of menu item in draft status */
            $title = sprintf( __('%s (Pending)' , 'bkninja'), $item->title);
        }

        $title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

        $submenu_text = '';
        if ( 0 == $depth )
            $submenu_text = 'style="display: none;"';

        ?>
        <li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>">
            <dl class="menu-item-bar">
                <dt class="menu-item-handle">
                    <span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo $submenu_text; ?>><?php _e( 'sub item' , 'bkninja'); ?></span></span>
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
                            ?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up', 'bkninja'); ?>">&#8593;</abbr></a>
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
                            ?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down', 'bkninja'); ?>">&#8595;</abbr></a>
                        </span>
                        <a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e('Edit Menu Item'); ?>" href="<?php
                            echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
                        ?>"><?php _e( 'Edit Menu Item' , 'bkninja'); ?></a>
                    </span>
                </dt>
            </dl>

            <div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
                <?php if( 'custom' == $item->type ) : ?>
                    <p class="field-url description description-wide">
                        <label for="edit-menu-item-url-<?php echo $item_id; ?>">
                            <?php _e( 'URL' , 'bkninja'); ?><br />
                            <input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
                        </label>
                    </p>
                <?php endif; ?>
                <p class="description description-thin">
                    <label for="edit-menu-item-title-<?php echo $item_id; ?>">
                        <?php _e( 'Navigation Label' , 'bkninja'); ?><br />
                        <input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
                    </label>
                </p>
                <p class="description description-thin">
                    <label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
                        <?php _e( 'Title Attribute' , 'bkninja' ); ?><br />
                        <input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
                    </label>
                </p>
                <p class="field-link-target description">
                    <label for="edit-menu-item-target-<?php echo $item_id; ?>">
                        <input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
                        <?php _e( 'Open link in a new window/tab' , 'bkninja'); ?>
                    </label>
                </p>
                <p class="field-css-classes description description-thin">
                    <label for="edit-menu-item-classes-<?php echo $item_id; ?>">
                        <?php _e( 'CSS Classes (optional)' , 'bkninja'); ?><br />
                        <input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
                    </label>
                </p>
                <p class="field-xfn description description-thin">
                    <label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
                        <?php _e( 'Link Relationship (XFN)' , 'bkninja'); ?><br />
                        <input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
                    </label>
                </p>
                <p class="field-bkmegamenu description">
                    <?php if ($depth == 0 && ($item->object == 'category')) { ?>
                    <label for="edit-menu-item-bkmegamenu-<?php echo $item_id; ?>">BK Megamenu</label>
                    <input type="checkbox" id="edit-menu-item-bkmegamenu-<?php echo $item_id; ?>" name="menu-item-bkmegamenu[<?php echo $item_id; ?>]" value="1" <?php checked( $bk_item_megamenu,1 ); ?> />
                    <?php } ?>
                </p>
                <p class="field-description description description-wide">
                    <label for="edit-menu-item-description-<?php echo $item_id; ?>">
                        <?php _e( 'Description' , 'bkninja'); ?><br />
                        <textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]">
                            <?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
                        <span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.' , 'bkninja'); ?></span>
                    </label>
                </p>  
                <p class="field-move hide-if-no-js description description-wide">
                    <label>
                        <span><?php _e( 'Move' , 'bkninja'); ?></span>
                        <a href="#" class="menus-move-up"><?php _e( 'Up one' , 'bkninja'); ?></a>
                        <a href="#" class="menus-move-down"><?php _e( 'Down one' , 'bkninja'); ?></a>
                        <a href="#" class="menus-move-left"></a>
                        <a href="#" class="menus-move-right"></a>
                        <a href="#" class="menus-move-top"><?php _e( 'To the top' , 'bkninja'); ?></a>
                    </label>
                </p>

                <div class="menu-item-actions description-wide submitbox">
                    <?php if( 'custom' != $item->type && $original_title !== false ) : ?>
                        <p class="link-to-original">
                            <?php printf( __('Original: %s' , 'bkninja'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
                        </p>
                    <?php endif; ?>
                    <a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
                    echo wp_nonce_url(
                        add_query_arg(
                            array(
                                'action' => 'delete-menu-item',
                                'menu-item' => $item_id,
                            ),
                            admin_url( 'nav-menus.php' )
                        ),
                        'delete-menu_item_' . $item_id
                    ); ?>"><?php _e( 'Remove' , 'bkninja'); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
                        ?>#menu-item-settings-<?php echo $item_id; ?>"><?php _e('Cancel' , 'bkninja'); ?></a>
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

if ( ! function_exists( 'bk_megamenu_walker' ) ) { 
    function bk_megamenu_walker($walker) {
            if ( $walker === 'Walker_Nav_Menu_Edit' ) {
                        $walker = 'bk_walker_backend';
                  }
           return $walker;
        }
}
add_filter( 'wp_edit_nav_menu_walker', 'bk_megamenu_walker');  

if ( ! function_exists( 'bk_megamenu_walker_save' ) ) { 
    function bk_megamenu_walker_save($menu_id, $menu_item_db_id) {

        if  (isset($_POST['menu-item-bkmegamenu'][$menu_item_db_id])) {
                update_post_meta( $menu_item_db_id, '_menu_item_bkmegamenu', $_POST['menu-item-bkmegamenu'][$menu_item_db_id]);
        } else {
            update_post_meta( $menu_item_db_id, '_menu_item_bkmegamenu', '0');
        }
    }
}
add_action( 'wp_update_nav_menu_item', 'bk_megamenu_walker_save', 10, 2 );

if ( ! function_exists( 'bk_megamenu_walker_loader' ) ) { 
    function bk_megamenu_walker_loader($menu_item) {
            $menu_item->bkmegamenu = get_post_meta($menu_item->ID, '_menu_item_bkmegamenu', true);
            return $menu_item;
     }
}
add_filter( 'wp_setup_nav_menu_item', 'bk_megamenu_walker_loader' );