<?php
if(basename( $_SERVER['PHP_SELF']) == "nav-menus.php" ) {
    add_action('admin_menu', 'mom_mega_menu_style');
}

function mom_mega_menu_style()
{
                    wp_enqueue_style(  'mom_mega_menu_style', MOM_URI. '/framework/menus/admin_menu.css'); 
		    wp_enqueue_media();
                    wp_enqueue_style(  'thickbox'); 
                    wp_enqueue_script(  'thickbox');
                    wp_enqueue_style( 'wp-color-picker' );
                    wp_enqueue_script( 'wp-color-picker' );
                    wp_enqueue_script(  'mom_mega_menu', MOM_URI. '/framework/menus/admin_menu.js'); 
}

/**
 * @package nav-menu-custom-fields
 * @version 0.1.0
 */
/*
Plugin Name: Nav Menu Custom Fields
*/

/*
 * Saves new field to postmeta for navigation
 */
add_action('wp_update_nav_menu_item', 'custom_nav_update',10, 3);
function custom_nav_update($menu_id, $menu_item_db_id, $args ) {
    if (isset($_REQUEST['menu-item-mtype']) ) {
        if ( is_array($_REQUEST['menu-item-mtype']) ) {
            $custom_value = $_REQUEST['menu-item-mtype'][$menu_item_db_id];
            update_post_meta( $menu_item_db_id, '_menu_item_mtype', $custom_value );
        }
    }

    if (isset($_REQUEST['menu-item-mcats_layout']) ) {
        if ( is_array($_REQUEST['menu-item-mcats_layout']) ) {
            $custom_value = $_REQUEST['menu-item-mcats_layout'][$menu_item_db_id];
            update_post_meta( $menu_item_db_id, '_menu_item_mcats_layout', $custom_value );
        }
    }

    if (isset($_REQUEST['menu-item-mcustom']) ) {
        if ( is_array($_REQUEST['menu-item-mcustom']) ) {
            $custom_value = $_REQUEST['menu-item-mcustom'][$menu_item_db_id];
            update_post_meta( $menu_item_db_id, '_menu_item_mcustom', $custom_value );
        }
    }


    if (isset($_REQUEST['menu-item-micon']) ) {
        if ( is_array($_REQUEST['menu-item-micon']) ) {
            $icon_value = $_REQUEST['menu-item-micon'][$menu_item_db_id];
            update_post_meta( $menu_item_db_id, '_menu_item_micon', $icon_value );
        }
    }

    if (isset($_REQUEST['menu-item-mdisplay']) ) {
        if ( is_array($_REQUEST['menu-item-mdisplay']) ) {
            $icon_value = $_REQUEST['menu-item-mdisplay'][$menu_item_db_id];
            update_post_meta( $menu_item_db_id, '_menu_item_mdisplay', $icon_value );
        }
    }
    

}

/*
 * Adds value of new field to $item object that will be passed to     Walker_Nav_Menu_Edit_Custom
 */
add_filter( 'wp_setup_nav_menu_item','custom_nav_item' );
function custom_nav_item($menu_item) {
    $menu_item->mtype = get_post_meta( $menu_item->ID, '_menu_item_mtype', true );
    $menu_item->mcats_layout = get_post_meta( $menu_item->ID, '_menu_item_mcats_layout', true );
    $menu_item->mcustom = get_post_meta( $menu_item->ID, '_menu_item_mcustom', true );
    $menu_item->micon = get_post_meta( $menu_item->ID, '_menu_item_micon', true );
    $menu_item->mdisplay = get_post_meta( $menu_item->ID, '_menu_item_mdisplay', true );
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
function start_lvl(&$output, $depth = 0, $args = Array()) {}

/**
 * @see Walker_Nav_Menu::end_lvl()
 * @since 3.0.0
 *
 * @param string $output Passed by reference.
 */
function end_lvl(&$output, $depth = 0, $args = Array()) {
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
function start_el(&$output, $item, $depth = 0, $args = Array(), $id = 0) {
    global $_wp_nav_menu_max_depth;
    $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

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
        $title = sprintf( __( '%s (Invalid)' ), $item->title );
    } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
        $classes[] = 'pending';
        /* translators: %s: title of menu item in draft status */
        $title = sprintf( __('%s (Pending)'), $item->title );
    }

    $title = empty( $item->label ) ? $title : $item->label;

    ?>
    <li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>">
        <dl class="menu-item-bar">
            <dt class="menu-item-handle">
                <span class="item-title"><?php echo esc_html( $title ); ?></span>
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
                        ?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up'); ?>">&#8593;</abbr></a>
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
                        ?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down'); ?>">&#8595;</abbr></a>
                    </span>
                    <a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e('Edit Menu Item'); ?>" href="<?php
                        echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
                    ?>"><?php _e( 'Edit Menu Item' ); ?></a>
                </span>
            </dt>
        </dl>

        <div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
            <?php if( 'custom' == $item->type ) : ?>
                <p class="field-url description description-wide">
                    <label for="edit-menu-item-url-<?php echo $item_id; ?>">
                        <?php _e( 'URL' ); ?><br />
                        <input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
                    </label>
                </p>
            <?php endif; ?>
            <p class="description description-thin">
                <label for="edit-menu-item-title-<?php echo $item_id; ?>">
                    <?php _e( 'Navigation Label' ); ?><br />
                    <input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
                </label>
            </p>
            <p class="description description-thin">
                <label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
                    <?php _e( 'Title Attribute' ); ?><br />
                    <input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
                </label>
            </p>
            <p class="field-link-target description">
                <label for="edit-menu-item-target-<?php echo $item_id; ?>">
                    <input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
                    <?php _e( 'Open link in a new window/tab' ); ?>
                </label>
            </p>
            <p class="field-css-classes description description-thin">
                <label for="edit-menu-item-classes-<?php echo $item_id; ?>">
                    <?php _e( 'CSS Classes (optional)' ); ?><br />
                    <input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
                </label>
            </p>
            <p class="field-xfn description description-thin">
                <label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
                    <?php _e( 'Link Relationship (XFN)' ); ?><br />
                    <input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
                </label>
            </p>
            <p class="field-description description description-wide">
                <label for="edit-menu-item-description-<?php echo $item_id; ?>">
                    <?php _e( 'Description' ); ?><br />
                    <textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
                    <span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.'); ?></span>
                </label>
            </p>        
            <?php
            /*
             * This is the added fields
             */
            ?>      
            <p class="field-mtype description description-wide">
                <label for="edit-menu-item-mtype-<?php echo $item_id; ?>">
                    <?php _e( 'Dropdown Menu Type', 'theme' ); ?><br />
                    <select id="edit-menu-item-mtype-<?php echo $item_id; ?>" class="widefat code edit-menu-item-mtype" name="menu-item-mtype[<?php echo $item_id; ?>]">
                        <option value="" <?php selected( $item->mtype, '' ); ?>><?php _e( 'Default', 'theme' ); ?></option>
                        <option value="mega" <?php selected( $item->mtype, 'mega' ); ?>><?php _e( 'Mega Menu', 'theme' ); ?></option>
                        <option value="cats" <?php selected( $item->mtype, 'cats' ); ?>><?php _e( 'Category Menu', 'theme' ); ?></option>
                        <option value="custom" <?php selected( $item->mtype, 'custom' ); ?>><?php _e( 'Custom Mega Menu', 'theme' ); ?></option>
                    </select>
                </label>
            </p>
            
            <p class="field-mcats_layout description description-wide hide">
                <label for="edit-menu-item-mcats_layout-<?php echo $item_id; ?>">
                    <?php _e( 'Ctaegories Posts layout', 'theme' ); ?><br />
                    <select id="edit-menu-item-mcats_layout-<?php echo $item_id; ?>" class="widefat code edit-menu-item-mcats_layout" name="menu-item-mcats_layout[<?php echo $item_id; ?>]">
                        <option value="" <?php selected( $item->mcats_layout, '' ); ?>><?php _e( 'Vertical', 'theme' ); ?></option>
                        <option value="horz" <?php selected( $item->mcats_layout, 'horz' ); ?>><?php _e( 'Horizontal', 'theme' ); ?></option>
                    </select>
                </label>
            </p>
            
            <p class="field-mcustom description description-wide hide">
                <label for="edit-menu-item-mcustom-<?php echo $item_id; ?>">
                    <?php _e( 'Custom Mega Menu Content', 'theme' ); ?><br />
                    <textarea id="edit-menu-item-mcustom-<?php echo $item_id; ?>" class="widefat edit-menu-item-mcustom" rows="3" cols="20" name="menu-item-mcustom[<?php echo $item_id; ?>]"><?php echo $item->mcustom; ?></textarea>
                    <small><?php _e('custom text, HTML or Shortcodes note: all items under this menu will disappear', 'theme'); ?></small>
                </label>
            </p>
            
            <p class="field-micon description description-wide">
                <label for="edit-menu-item-micon-<?php echo $item_id; ?>">
             
             <?php _e( 'Menu Item Icon', 'theme' ); ?><br />
		<div class="mom_icons_selector">
                        <a class="mom_select_icon_menu button" data-id="<?php echo $item_id; ?>"><?php _e('Select Icon','framework'); ?></a> <span class="or">or</span> <a class="mom_upload_icon_menu button simptip-position-top simptip-movable simptip-multiline" data-tooltip="<?php _e('Best Icon sizes is : 24px for icon only and 18px for icon with label', 'framework'); ?>" data-id="<?php echo $item_id; ?>"><?php _e('Upload Custom Icon','framework'); ?></a>

		<span class="mom_icon_prev"><i></i><a href="#" class="remove_icon enotype-icon-cross2" title="Remove Icon"></a></span>
</span>
                    <input type="text" id="edit-menu-item-micon-<?php echo $item_id; ?>" class="widefat code edit-menu-item-micon mom_icon_holder" name="menu-item-micon[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->micon ); ?>" \>
                </div>
                </label>
            </p>
            <p class="field-mdisplay description description-wide">
                <label for="edit-menu-item-mdisplay-<?php echo $item_id; ?>">
                    <?php _e( 'Display', 'theme' ); ?><br />
                    <select id="edit-menu-item-mdisplay-<?php echo $item_id; ?>" class="widefat code edit-menu-item-mdisplay" name="menu-item-mdisplay[<?php echo $item_id; ?>]">
                        <option value="" <?php selected( $item->mdisplay, '' ); ?>><?php _e( 'All (label & icon)', 'theme' ); ?></option>
                        <option value="icon" <?php selected( $item->mdisplay, 'icon' ); ?>><?php _e( 'Icon Only', 'theme' ); ?></option>
                        <option value="none" <?php selected( $item->mdisplay, 'none' ); ?>><?php _e( 'None (hide icon and label)', 'theme' ); ?></option>
                    </select>
                </label>
            </p>
            

            <?php
            /*
             * end added field
             */
            ?>

             <p class="field-move hide-if-no-js description description-wide">
                    <label>
                            <span><?php _e( 'Move' ); ?></span>
                            <a href="#" class="menus-move-up"><?php _e( 'Up one' ); ?></a>
                            <a href="#" class="menus-move-down"><?php _e( 'Down one' ); ?></a>
                            <a href="#" class="menus-move-left"></a>
                            <a href="#" class="menus-move-right"></a>
                            <a href="#" class="menus-move-top"><?php _e( 'To the top' ); ?></a>
                    </label>
            </p>

            
            
            <div class="menu-item-actions description-wide submitbox">
                <?php if( 'custom' != $item->type && $original_title !== false ) : ?>
                    <p class="link-to-original">
                        <?php printf( __('Original: %s'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
                    </p>
                <?php endif; ?>
                <a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
                echo wp_nonce_url(
                    add_query_arg(
                        array(
                            'action' => 'delete-menu-item',
                            'menu-item' => $item_id,
                        ),
                        remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                    ),
                    'delete-menu_item_' . $item_id
                ); ?>"><?php _e('Remove'); ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) );
                    ?>#menu-item-settings-<?php echo $item_id; ?>"><?php _e('Cancel'); ?></a>
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

/**
 * Custom Walker
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/
class mom_custom_walker extends Walker_Nav_Menu
{
        var $columns = 0;
        var $max_columns = 0;
        var $rows = 1;
        var $rowsCount = array();
        private $in_sub_menu = 0;
        
     
     
       /**
         * @see Walker::start_lvl()
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param int $depth Depth of page. Used for padding.
         */
        function start_lvl(&$output, $depth = 0, $args = array()) {
            $indent = str_repeat("\t", $depth);
            
            $output .= "\n$indent<ul class=\"sub-menu {locate_class}\">\n";
        }
        
        /**
         * @see Walker::end_lvl()
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param int $depth Depth of page. Used for padding.
         */
        function end_lvl(&$output, $depth = 0, $args = array()) {
            $indent = str_repeat("\t", $depth);
            $output .= "$indent</ul>\n";
            
            if($depth === 0) 
            {
                if($this->mom_mega == 'mega')
                {
                    $output = str_replace("{locate_class}", "mom_mega_wrap mom_mega_col_".$this->max_columns."", $output);
                    
                    foreach($this->rowsCount as $row => $columns)
                    {
                        $output = str_replace("{current_row_".$row."}", "mom_megamenu_columns_".$columns, $output);
                    }
                    
                    $this->columns = 0;
                    $this->max_columns = 0;
                    $this->rowsCount = array();
                    
                }
                else
                {
                    $output = str_replace("{locate_class}", "", $output);
                }
            }
        }    
    
    function start_el(&$output, $item, $depth = 0, $args = Array(), $id = 0)
      {
           global $wp_query;

        // Detect first child of submenu then add class active
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
           $class_names = $value = '';
           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

           $mega_class ='';
            $menu_icon = '';
           if ($depth === 0 && $item->mtype === 'mega') {
            $mega_class = ' mom_mega';
           } elseif ($depth === 0 && $item->mtype === 'cats') {
            $mega_class = ' mom_mega_cats';
           } elseif ($depth === 0 && $item->mtype === 'custom') {
            $mega_class = ' mom_mega';
           } else {
            $mega_class = ' mom_default_menu_item';
           }
        
        if ($depth === 1 && $this->mom_mega === 'mega') {
            $mega_class = ' mega_column mega_col_title';
        }
        
        $icon_class = '';
        if ($item->mdisplay == 'icon') {
            $icon_class = ' menu-item-iconsOnly';
        }
        
        if( $depth == 1 ) {
            if( ! $this->in_sub_menu ) {
                $mega_class .= ' active'; 
                $this->in_sub_menu = 1;
            }
        }
        if( $depth == 0 ) {
            $this->in_sub_menu = 0;
        }// End addition of active class for first item 




           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names.$mega_class.$icon_class." menu-item-depth-".$depth  ) . '"';
           $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

           $prepend = '';
           $append = '';
           $description  = '';
           if($depth != 0)
           {
	           $description = $append = $prepend = "";
           }
           $menu_color = '';
            if($depth === 0)
            {   
                $this->mom_mega = get_post_meta( $item->ID, '_menu_item_mtype', true);
                $menu_color  = '<span class="menu_bl" style="background:'.esc_attr( $item->mcolor ).';"></span>';

            }
            if($depth === 1 && $this->mom_mega === 'mega')
            {
                $this->columns ++;
                

                $this->rowsCount[$this->rows] = $this->columns;
                
                if($this->max_columns < $this->columns) $this->max_columns = $this->columns;
                
                $title = apply_filters( 'the_title', $item->title, $item->ID );

                if($title != "-" && $title != '"-"')
                {
            //display
                if ($item->mdisplay == 'icon') {
		    if (!empty( $item->micon )) {
			if (0 === strpos($item->micon, 'http')) {
			    $menu_icon = '<i class="icon_only img_icon" style="background-image: url('.esc_attr( $item->micon ).')"></i>';
			} else {
                            $menu_icon  = '<i class="icon_only '.esc_attr( $item->micon ).'"></i>';
			}
		    }                        $the_link = '<span class="icon_only_label">'.$args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append.$args->link_after.'</span>';
                } elseif ($item->mdisplay == 'none') {
                        $menu_icon  = '';
                        $the_link = '';
                } else {
		    if (!empty( $item->micon )) {
			if (0 === strpos($item->micon, 'http')) {
			    $menu_icon = '<i class="img_icon" style="background-image: url('.esc_attr( $item->micon ).')"></i>';
			} else {
                            $menu_icon  = '<i class="'.esc_attr( $item->micon ).'"></i>';
			}
		    }
                    $the_link = $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append.$args->link_after;
                }

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
            $item_output = $args->before;
            if ($item->mdisplay != 'none') {
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $menu_icon.$the_link;
            $item_output .= '</a>';
            }
            $item_output .= $args->after;
                }
                
                $column_class  = ' {current_row_'.$this->rows.'}';
                
                if($this->columns == 1)
                {
                    $column_class  .= " mom_mega_first_column";
                }
            } else {

            //display
            
                if ($item->mdisplay == 'icon') {
		    if (!empty( $item->micon )) {
			if (0 === strpos($item->micon, 'http')) {
			    $menu_icon = '<i class="icon_only img_icon" style="background-image: url('.esc_attr( $item->micon ).')"></i>';
			} else {
                            $menu_icon  = '<i class="icon_only '.esc_attr( $item->micon ).'"></i>';
			}
		    }
                    $the_link = '<span class="icon_only_label">'.$args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append.$args->link_after.'</span>';
                } elseif ($item->mdisplay == 'none') {
                        $menu_icon  = '';
                        $the_link = '';
                } else {

		    if (!empty( $item->micon )) {
			if (0 === strpos($item->micon, 'http')) {
			    $menu_icon = '<i class="img_icon" style="background-image: url('.esc_attr( $item->micon ).')"></i>';
			} else {
                            $menu_icon  = '<i class="'.esc_attr( $item->micon ).'"></i>';
			}
		    }
                        
                        if ($depth !== 0 && empty( $item->micon ) && $this->mom_mega === 'mega') {
                            if (is_rtl()) {
                                $menu_icon = '<i class="enotype-icon-arrow-left6 mega_menu_arrow_holder"></i>';
                            } else {
                                $menu_icon = '<i class="enotype-icon-arrow-right6 mega_menu_arrow_holder"></i>';
                            }
                        }
                        $the_link = $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append.$args->link_after;
                }
                

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

            $item_output = $args->before;
            if ($item->mdisplay != 'none') {
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $menu_icon.$the_link;
            $item_output .= '</a>';
            }
            $item_output .= $args->after;
            }
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
                        if( $depth == 0 ) {
                if ($item->mtype =='cats') {
                                    if ($item->mcats_layout == 'horz') {
                                        $layout_class = 'mom_cats_horizontal';
                                    } else {
                                        $layout_class = '';
                                    }
                    $output .= "<div class='cats-mega-wrap ".$layout_class."'>\n";
                    $output .= "<div class=\"cats-mega-inner\">\n";
                } 
            }
            if ($item->mtype =='custom') {
                    $output .= "<div class='mom_custom_mega mom_mega_wrap'>\n";
            }

    } // start el
    
function end_el( &$output, $item, $depth = 0, $args = array() ) {
		if($depth==0){
                                if ($item->mtype =='cats') {
			$output .= "<div class='subcat'>";
			
		for ($i=0; $i<count($item->children);$i++) {
			$child = $item->children[$i];
			$output .="<div class='".(($i===0)?'active':'')." mom-cat-latest' id='mn-latest-".$child->ID."'>";
			$output .="<ul id='mn-ul-latest-".$child->ID."'>";
				if($child->object == 'category'){
                                    if ($item->mcats_layout == 'horz') {
                                        $post_count = 3;
                                        $sep = '';
                                        $img_size = 'cats_horz_menu';
                                    } else {
                                        $post_count = 4;
                                        $sep = '';
                                        $img_size = 'small-wide';
                                    }


			        $r = new WP_Query( apply_filters( 'widget_posts_args', 
			            array( 
			                'posts_per_page'    => $post_count, 
			                'no_found_rows'         => true, 
			                'post_status'           => 'publish', 
			                'cat'              =>      $child->object_id
			            ) ) );

			          if ($r->have_posts()) :
			          		while ( $r->have_posts() ) {
				                    $r->the_post();
							$output.= "<li ";
							if( has_post_thumbnail()) {
							 $output.= "class='has-thumbnail' ";
							}
							$output.= "><div class='subcat-thumbnail'><a href='".get_permalink()."' title='".get_the_title()."'><img src='".mom_post_image($img_size)."' alt=''></a></div><div class='subcat-title'><a href='".get_permalink()."' title='".get_the_title()."'> ".get_the_title()."</a><span> ".$sep." ". human_time_diff( get_the_time('U'), current_time('timestamp') ) ." " . __('ago', 'theme'). "</span></div></li>";
					            } 
					        // Reset the global $the_post as this query will have stomped on it
					        wp_reset_postdata();

				        endif;

				}
			  $output .= "</ul>";
			  $output .= "<a href='".$child->url."' title='".$child->attr_title."' class='view_all_posts'>".__('View all', 'theme')."<i class='long-arrow-icon'></i></a>";
			  $output .= "</div>";
			}
			
			$output .= "</div> \n</div>\n</div>\n";
                                }
		}
		else{

		}
           if ($depth == 0 && $item->mtype =='custom') {
                    $output .= do_shortcode($item->mcustom);
                    $output .= "</div>\n";
            }
            if ($item->children) {
		$output .= "<i class='responsive-caret'></i>\n";
            }
		$output .= "</li>\n";
	}

    
} //end of walker class

add_filter( 'wp_nav_menu_objects', 'add_menu_child_items' );
function add_menu_child_items( $items ) {
	
	$parents = array();
	foreach ( $items as $item ) {
		$item->children = array();
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}
	}
	
	foreach ( $items as $item ) {
		if ( in_array( $item->ID, $parents ) ) {
			$item->classes[] = 'menu-parent-item'; 
	
			foreach ( $items as $citem ) {
				if ( $citem->menu_item_parent && $citem->menu_item_parent == $item->ID ) {
					$item->children[] = $citem;
				}
			}
		}
	}
	
	return $items;    
}

class mom_topmenu_custom_walker extends Walker_Nav_Menu {
    	function end_el( &$output, $item, $depth = 0, $args = array() ) {
            if ($item->children) {
		$output .= "<i class='responsive-caret'></i>\n";
            }
            $output .= "</li>\n";
	}
}