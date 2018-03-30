<?php

// Register Navigation Menu
register_nav_menus( array(
    'main_menu' => 'Main Menu',
    'top_nav' => 'Top Navigation',
    'view_switcher' => 'View Switcher'
));

/**
 * Class Name: wp_bootstrap_navwalker
 * GitHub URI: https://github.com/twittem/wp-bootstrap-navwalker
 * Description: A custom WordPress nav walker class to implement the Bootstrap 3 navigation style in a custom theme using the WordPress built in menu manager.
 * Version: 2.0.4
 * Author: Edward McIntyre - @twittem
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

if (!class_exists('wp_bootstrap_navwalker')) {
    class wp_bootstrap_navwalker extends Walker_Nav_Menu {

        /**
         * @see Walker::start_lvl()
         * @since 3.0.0
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param int $depth Depth of page. Used for padding.
         */
        public function start_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat( "\t", $depth );
            $output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu\">\n";
        }

        /**
         * @see Walker::start_el()
         * @since 3.0.0
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param object $item Menu item data object.
         * @param int $depth Depth of menu item. Used for padding.
         * @param int $current_page Menu item ID.
         * @param object $args
         */
        public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

            /**
             * Dividers, Headers or Disabled
             * =============================
             * Determine whether the item is a Divider, Header, Disabled or regular
             * menu item. To prevent errors we use the strcasecmp() function to so a
             * comparison that is not case sensitive. The strcasecmp() function returns
             * a 0 if the strings are equal.
             */
            if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
                $output .= $indent . '<li role="presentation" class="divider">';
            } else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {
                $output .= $indent . '<li role="presentation" class="divider">';
            } else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {
                $output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
            } else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {
                $output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
            } else {

                $class_names = $value = '';

                $classes = empty( $item->classes ) ? array() : (array) $item->classes;
                $classes[] = 'menu-item-' . $item->ID;

                $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

                if ( $args->has_children )
                    $class_names .= ' dropdown';

                if ( in_array( 'current-menu-item', $classes ) )
                    $class_names .= ' active';

                $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

                $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
                $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

                $output .= $indent . '<li' . $id . $value . $class_names .'>';

                $atts = array();
                $atts['title']  = ! empty( $item->title )    ? $item->title    : '';
                $atts['target'] = ! empty( $item->target )    ? $item->target    : '';
                $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn    : '';

                // If item has_children add atts to a.
                if ( $args->has_children && $depth === 0 ) {
                    $atts['href']           = '#';
                    $atts['data-toggle']    = 'dropdown';
                    $atts['class']            = 'dropdown-toggle';
                } else {
                    $atts['href'] = ! empty( $item->url ) ? $item->url : '';
                }

                $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

                $attributes = '';
                foreach ( $atts as $attr => $value ) {
                    if ( ! empty( $value ) ) {
                        $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                        $attributes .= ' ' . $attr . '="' . $value . '"';
                    }
                }

                $item_output = $args->before;

                /*
                 * Glyphicons
                 * ===========
                 * Since the the menu item is NOT a Divider or Header we check the see
                 * if there is a value in the attr_title property. If the attr_title
                 * property is NOT null we apply it as the class name for the glyphicon.
                 */
                if ( ! empty( $item->attr_title ) )
                    $item_output .= '<a'. $attributes .'><span class="menu-icon glyphicon ' . esc_attr( $item->attr_title ) . '"></span>';
                else
                    $item_output .= '<a'. $attributes .'>';

                $item_output .= '<span class="menu-label">'. $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after .'</span>';
                $item_output .= ( $args->has_children && 0 === $depth ) ? ' <span class="caret"></span></a>' : '</a>';
                //$item_output .= ( $args->has_children && 0 === $depth ) ? '</a>' : '</a>';
                $item_output .= $args->after;

                $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            }
        }

        /**
         * Traverse elements to create list from elements.
         *
         * Display one element if the element doesn't have any children otherwise,
         * display the element and its children. Will only traverse up to the max
         * depth and no ignore elements under that depth.
         *
         * This method shouldn't be called directly, use the walk() method instead.
         *
         * @see Walker::start_el()
         * @since 2.5.0
         *
         * @param object $element Data object
         * @param array $children_elements List of elements to continue traversing.
         * @param int $max_depth Max depth to traverse.
         * @param int $depth Depth of current element.
         * @param array $args
         * @param string $output Passed by reference. Used to append additional content.
         * @return null Null on failure with no changes to parameters.
         */
        public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
            if ( ! $element )
                return;

            $id_field = $this->db_fields['id'];

            // Display this element.
            if ( is_object( $args[0] ) )
                $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

            parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
        }

        /**
         * Menu Fallback
         * =============
         * If this function is assigned to the wp_nav_menu's fallback_cb variable
         * and a manu has not been assigned to the theme location in the WordPress
         * menu manager the function with display nothing to a non-logged in user,
         * and will add a link to the WordPress menu manager if logged in as an admin.
         *
         * @param array $args passed from the wp_nav_menu function.
         *
         */
        public static function fallback( $args ) {
            if ( current_user_can( 'manage_options' ) ) {

                extract( $args );

                $fb_output = null;

                if ( $container ) {
                    $fb_output = '<' . $container;

                    if ( $container_id )
                        $fb_output .= ' id="' . $container_id . '"';

                    if ( $container_class )
                        $fb_output .= ' class="' . $container_class . '"';

                    $fb_output .= '>';
                }

                $fb_output .= '<ul';

                if ( $menu_id )
                    $fb_output .= ' id="' . $menu_id . '"';

                if ( $menu_class )
                    $fb_output .= ' class="' . $menu_class . '"';

                $fb_output .= '>';
                $fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
                $fb_output .= '</ul>';

                if ( $container )
                    $fb_output .= '</' . $container . '>';

                echo $fb_output;
            }
        }
    }
}

// add custom menu fields to menu
add_filter( 'wp_setup_nav_menu_item', 'venedor_add_custom_nav_fields' );

function venedor_add_custom_nav_fields( $menu_item ) {
    $menu_item->nolink = get_post_meta( $menu_item->ID, '_menu_item_nolink', true );
    $menu_item->hide = get_post_meta( $menu_item->ID, '_menu_item_hide', true );
    $menu_item->cols = get_post_meta( $menu_item->ID, '_menu_item_cols', true );
    $menu_item->tip_label = get_post_meta( $menu_item->ID, '_menu_item_tip_label', true );
    $menu_item->tip_color = get_post_meta( $menu_item->ID, '_menu_item_tip_color', true );
    $menu_item->tip_bg = get_post_meta( $menu_item->ID, '_menu_item_tip_bg', true );
    $menu_item->popup_type = get_post_meta( $menu_item->ID, '_menu_item_popup_type', true );
    $menu_item->popup_pos = get_post_meta( $menu_item->ID, '_menu_item_popup_pos', true );
    $menu_item->popup_cols = get_post_meta( $menu_item->ID, '_menu_item_popup_cols', true );
    $menu_item->popup_style = get_post_meta( $menu_item->ID, '_menu_item_popup_style', true );
    $menu_item->block = get_post_meta( $menu_item->ID, '_menu_item_block', true );
    $menu_item->block_pos = get_post_meta( $menu_item->ID, '_menu_item_block_pos', true );
    return $menu_item;
}

// save menu custom fields
add_action( 'wp_update_nav_menu_item', 'venedor_update_custom_nav_fields', 10, 3 );

function venedor_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {
    $check = array('nolink', 'hide', 'cols', 'popup_type', 'popup_pos', 'popup_cols', 'popup_style', 'block', 'block_pos', 'tip_label', 'tip_color', 'tip_bg');

    foreach ( $check as $key )
    {
        if (!isset($_POST['menu-item-'.$key][$menu_item_db_id])){
            if (!isset($args['menu-item-'.$key]))
                $value = "";
            else
                $value = $args['menu-item-'.$key];
        } else {
            $value = $_POST['menu-item-'.$key][$menu_item_db_id];
        }

        update_post_meta( $menu_item_db_id, '_menu_item_'.$key, $value );
    }
}

// edit menu walker
add_filter( 'wp_edit_nav_menu_walker', 'venedor_edit_walker', 10, 2 );

function venedor_edit_walker($walker,$menu_id) {
    return 'Walker_Nav_Menu_Edit_Custom';
}

// Create HTML list of nav menu input items.
// Extend from Walker_Nav_Menu class
class Walker_Nav_Menu_Edit_Custom extends Walker_Nav_Menu  {
    /**
     * @see Walker_Nav_Menu::start_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference.
     */
    function start_lvl( &$output, $depth = 0, $args = array() ) {
    }

    /**
     * @see Walker_Nav_Menu::end_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference.
     */
    function end_lvl( &$output, $depth = 0, $args = array() ) {
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
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $_wp_nav_menu_max_depth;

        $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $item_id = esc_attr( $item->ID );
        $removed_args = array(
            'action',
            'customlink-tab',
            'edit-menu-item',
            'menu-item',
            'page-tab',
            '_wpnonce',
        );
        ob_start();
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
            $title = sprintf( '%s (Invalid)', $item->title );
        } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
            $classes[] = 'pending';
            /* translators: %s: title of menu item in draft status */
            $title = sprintf( '%s (Pending)', $item->title );
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
                            esc_url( add_query_arg(
                                array(
                                    'action' => 'move-up-menu-item',
                                    'menu-item' => $item_id,
                                ),
                                esc_url( remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) ) )
                            ) ),
                            'move-menu_item'
                        );
                        ?>" class="item-move-up"><abbr title="Move up">&#8593;</abbr></a>
                    |
                    <a href="<?php
                        echo wp_nonce_url(
                            esc_url( add_query_arg(
                                array(
                                    'action' => 'move-down-menu-item',
                                    'menu-item' => $item_id,
                                ),
                                esc_url( remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) ) )
                            ) ),
                            'move-menu_item'
                        );
                        ?>" class="item-move-down"><abbr title="Move down">&#8595;</abbr></a>
                </span>
                <a class="item-edit" id="edit-<?php echo $item_id; ?>" title="Edit Menu Item" href="<?php
                    echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] )
                        ? admin_url( 'nav-menus.php' )
                        : esc_url( add_query_arg( 'edit-menu-item', $item_id,
                            esc_url( remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) ) ) );
                    ?>"><?php echo 'Edit Menu Item'; ?></a>
            </span>
        </dt>
    </dl>

    <div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
        <?php if( 'custom' == $item->type ) : ?>
    <p class="description description-wide">
        <label for="edit-menu-item-url-<?php echo $item_id; ?>">
            <?php echo 'URL'; ?><br />
            <input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url"
                <?php if (esc_attr( $item->url )) : ?>
                   name="menu-item-url[<?php echo $item_id; ?>]"
                <?php endif; ?>
                   data-name="menu-item-url[<?php echo $item_id; ?>]"
                   value="<?php echo esc_attr( $item->url ); ?>" />
        </label>
    </p>
        <?php endif; ?>
    <p class="description description-wide">
        <label for="edit-menu-item-title-<?php echo $item_id; ?>">
            <?php echo 'Navigation Label'; ?><br />
            <input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title"
                <?php if (esc_attr( $item->title )) : ?>
                   name="menu-item-title[<?php echo $item_id; ?>]"
                <?php endif; ?>
                   data-name="menu-item-title[<?php echo $item_id; ?>]"
                   value="<?php echo esc_attr( $item->title ); ?>" />
        </label>
    </p>
    <p class="description">
        <label for="edit-menu-item-target-<?php echo $item_id; ?>">
            <input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank"
                <?php if ($item->target == '_blank') : ?>
                   name="menu-item-target[<?php echo $item_id; ?>]"
                <?php endif; ?>
                   data-name="menu-item-target[<?php echo $item_id; ?>]"
                <?php checked( $item->target, '_blank' ); ?> />
            <?php echo 'Open link in a new window/tab'; ?>
        </label>
    </p>
        <?php
        /* New fields insertion starts here */
        ?>
    <p class="description description-thin">
        <label for="edit-menu-item-nolink-<?php echo $item_id; ?>">
            <input type="checkbox" id="edit-menu-item-nolink-<?php echo $item_id; ?>" class="code edit-menu-item-custom" value="nolink"
                <?php if ($item->nolink == 'nolink') : ?>
                   name="menu-item-nolink[<?php echo $item_id; ?>]"
                <?php endif; ?>
                   data-name="menu-item-nolink[<?php echo $item_id; ?>]"
                <?php checked( $item->nolink, 'nolink' ); ?> />
            <?php echo "Don't link"; ?>
        </label>
    </p>
    <p class="description description-thin">
        <label for="edit-menu-item-hide-<?php echo $item_id; ?>">
            <input type="checkbox" id="edit-menu-item-hide-<?php echo $item_id; ?>" class="code edit-menu-item-custom" value="hide"
                <?php if ($item->hide == 'hide') : ?>
                   name="menu-item-hide[<?php echo $item_id; ?>]"
                <?php endif; ?>
                   data-name="menu-item-hide[<?php echo $item_id; ?>]"
                <?php checked( $item->hide, 'hide' ); ?> />
            <?php echo "Don't show a link"; ?>
        </label>
    </p>
    <p class="description description-thin">
        <label for="edit-menu-item-tip_label-<?php echo $item_id; ?>">
            <?php echo 'Tip Label'; ?><br />
            <input type="text" id="edit-menu-item-tip_label-<?php echo $item_id; ?>" class="widefat code edit-menu-item-tip_label"
                <?php if (esc_attr( $item->tip_label )) : ?>
                   name="menu-item-tip_label[<?php echo $item_id; ?>]"
                <?php endif; ?>
                   data-name="menu-item-tip_label[<?php echo $item_id; ?>]"
                   value="<?php echo esc_attr( $item->tip_label ); ?>" />
        </label>
    </p>
    <p class="description description-thin">
        <label for="edit-menu-item-tip_color-<?php echo $item_id; ?>">
            <?php echo 'Tip Text Color'; ?><br />
            <input type="text" id="edit-menu-item-tip_color-<?php echo $item_id; ?>" class="widefat code edit-menu-item-tip_color"
                <?php if (esc_attr( $item->tip_color )) : ?>
                   name="menu-item-tip_color[<?php echo $item_id; ?>]"
                <?php endif; ?>
                   data-name="menu-item-tip_color[<?php echo $item_id; ?>]"
                   value="<?php echo esc_attr( $item->tip_color ); ?>" />
        </label>
    </p>
    <p class="description description-thin">
        <label for="edit-menu-item-tip_bg-<?php echo $item_id; ?>">
            <?php echo 'Tip BG Color'; ?><br />
            <input type="text" id="edit-menu-item-tip_bg-<?php echo $item_id; ?>" class="widefat code edit-menu-item-tip_bg"
                <?php if (esc_attr( $item->tip_bg )) : ?>
                   name="menu-item-tip_bg[<?php echo $item_id; ?>]"
                <?php endif; ?>
                   data-name="menu-item-tip_bg[<?php echo $item_id; ?>]"
                   value="<?php echo esc_attr( $item->tip_bg ); ?>" />
        </label>
    </p><br/>
    <div class="edit-menu-item-popup-<?php echo $item_id; ?>" style="<?php if ($depth == 0) echo 'display:block;'; else echo 'display:none;' ?>">
        <div style="clear:both;"></div><br/>
        <p class="description description-thin description-thin-custom">
            <label for="edit-menu-item-type-menu-<?php echo $item_id; ?>">
                <?php echo 'Popup Type'; ?><br />
                <select id="edit-menu-item-type-menu-<?php echo $item_id; ?>"
                    <?php if (esc_attr($item->popup_type)) : ?>
                        name="menu-item-popup_type[<?php echo $item_id; ?>]"
                    <?php endif; ?>
                    data-name="menu-item-popup_type[<?php echo $item_id; ?>]"
                    >
                    <option value="" <?php if(esc_attr($item->popup_type) == ""){echo 'selected="selected"';} ?>><?php echo 'Narrow' ?></option>
                    <option value="wide" <?php if(esc_attr($item->popup_type) == "wide"){echo 'selected="selected"';} ?>><?php echo 'Wide' ?></option>
                </select>
            </label>
        </p>
        <p class="description description-thin description-thin-custom">
            <label for="edit-menu-item-popup_pos-<?php echo $item_id; ?>">
                <?php echo 'Popup Position'; ?><br />
                <select id="edit-menu-item-popup_pos-<?php echo $item_id; ?>"
                    <?php if (esc_attr($item->popup_pos)) : ?>
                        name="menu-item-popup_pos[<?php echo $item_id; ?>]"
                    <?php endif; ?>
                    data-name="menu-item-popup_pos[<?php echo $item_id; ?>]"
                >
                    <option value="" <?php if(esc_attr($item->popup_pos) == ""){echo 'selected="selected"';} ?>><?php echo 'Justify (only wide)' ?></option>
                    <option value="pos-left" <?php if(esc_attr($item->popup_pos) == "pos-left"){echo 'selected="selected"';} ?>><?php echo 'Left' ?></option>
                    <option value="pos-center" <?php if(esc_attr($item->popup_pos) == "pos-center"){echo 'selected="selected"';} ?>><?php echo 'Center (only wide)' ?></option>
                    <option value="pos-right" <?php if(esc_attr($item->popup_pos) == "pos-right"){echo 'selected="selected"';} ?>><?php echo 'Right' ?></option>
                </select>
            </label>
        </p>
        <p class="description description-thin description-thin-custom">
            <label for="edit-menu-item-popup_cols-<?php echo $item_id; ?>">
                <?php echo 'Popup Columns'; ?><br />
                <select id="edit-menu-item-popup_cols-<?php echo $item_id; ?>"
                    <?php if ($item->popup_cols) : ?>
                        name="menu-item-popup_cols[<?php echo $item_id; ?>]"
                    <?php endif; ?>
                    data-name="menu-item-popup_cols[<?php echo $item_id; ?>]"
                    >
                    <option value="col-4" <?php if(esc_attr($item->popup_cols) == "col-4"){echo 'selected="selected"';} ?>><?php echo '4 Columns' ?></option>
                    <option value="col-3" <?php if(esc_attr($item->popup_cols) == "col-3"){echo 'selected="selected"';} ?>><?php echo '3 Columns' ?></option>
                    <option value="col-2" <?php if(esc_attr($item->popup_cols) == "col-2"){echo 'selected="selected"';} ?>><?php echo '2 Columns' ?></option>
                    <option value="col-5" <?php if(esc_attr($item->popup_cols) == "col-5"){echo 'selected="selected"';} ?>><?php echo '5 Columns' ?></option>
                    <option value="col-6" <?php if(esc_attr($item->popup_cols) == "col-6"){echo 'selected="selected"';} ?>><?php echo '6 Columns' ?></option>
                </select>
            </label>
        </p>
        <p class="description description-wide">
            <label for="edit-menu-item-popup_style-<?php echo $item_id; ?>">
                <?php echo 'Popup Styles (only wide)'; ?><br />
                <textarea id="edit-menu-item-popup_style-<?php echo $item_id; ?>" class="widefat edit-menu-item-popup_style" rows="3" cols="20"
                    <?php if (esc_html( $item->popup_style )) : ?>
                        name="menu-item-popup_style[<?php echo $item_id; ?>]"
                    <?php endif; ?>
                          data-name="menu-item-popup_style[<?php echo $item_id; ?>]"
                    ><?php echo esc_html( $item->popup_style ); // textarea_escaped ?></textarea>
                <span class="description"><?php echo 'will be add in popup.'; ?></span>
            </label>
        </p>
    </div><br/>
    <div class="edit-menu-item-block-<?php echo $item_id; ?>" style="<?php if ($depth == 1) echo 'display:block;'; else echo 'display:none;' ?>">
        <div style="clear:both;"></div><br/>
        <p class="description description-wide">
            <label for="edit-menu-item-popup_style-<?php echo $item_id; ?>">
                <?php echo 'Popup Styles (only wide)'; ?><br />
                <textarea id="edit-menu-item-popup_style-<?php echo $item_id; ?>" class="widefat edit-menu-item-popup_style" rows="3" cols="20"
                    <?php if (esc_html( $item->popup_style )) : ?>
                        name="menu-item-popup_style[<?php echo $item_id; ?>]"
                    <?php endif; ?>
                          data-name="menu-item-popup_style[<?php echo $item_id; ?>]"
                    ><?php echo esc_html( $item->popup_style ); // textarea_escaped ?></textarea>
                <span class="description"><?php echo 'will be add in popup.'; ?></span>
            </label>
        </p>
        <p class="description description-wide">
            <label for="edit-menu-item-cols-<?php echo $item_id; ?>">
                <?php echo 'Columns'; ?><br />
                <input type="text" id="edit-menu-item-cols-<?php echo $item_id; ?>" class="widefat code edit-menu-item-cols"
                    <?php if (esc_attr( $item->cols )) : ?>
                       name="menu-item-cols[<?php echo $item_id; ?>]"
                    <?php endif; ?>
                       data-name="menu-item-cols[<?php echo $item_id; ?>]"
                       value="<?php echo esc_attr( $item->cols ); ?>" />
            </label>
            <?php echo 'default: 1, need this value when the popup type of the parent menu is "Wide"' ?>
        </p>
        <p class="description description-thin">
            <label for="edit-menu-item-block-<?php echo $item_id; ?>">
                <?php echo 'Block Name'; ?><br />
                <input type="text" id="edit-menu-item-poup_block-<?php echo $item_id; ?>" class="widefat edit-menu-item-block"
                    <?php if (esc_attr( $item->block )) : ?>
                       name="menu-item-block[<?php echo $item_id; ?>]"
                    <?php endif; ?>
                       data-name="menu-item-block[<?php echo $item_id; ?>]"
                       value="<?php echo esc_attr( $item->block ); // textarea_escaped ?>"/>
            </label>
        </p>
        <p class="description description-thin"><br/>
            <label for="edit-menu-item-block_pos-<?php echo $item_id; ?>">
                <input type="checkbox" id="edit-menu-item-block_pos-<?php echo $item_id; ?>" class="code edit-menu-item-custom" value="before"
                    <?php if ($item->block_pos == 'before') : ?>
                       name="menu-item-block_pos[<?php echo $item_id; ?>]"
                    <?php endif; ?>
                       data-name="menu-item-block_pos[<?php echo $item_id; ?>]"
                    <?php checked( $item->block_pos, 'before' ); ?> />
                <?php echo "Show block before a link"; ?>
            </label>
        </p>
    </div><br/>
        <?php
        /* New fields insertion ends here */
        ?><div style="clear:both;"></div><br/>
    <p class="description description-wide">
        <label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
            <?php echo 'Title Attribute'; ?><br />
            <input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title"
                <?php if (esc_attr( $item->post_excerpt )) : ?>
                   name="menu-item-attr-title[<?php echo $item_id; ?>]"
                <?php endif; ?>
                   data-name="menu-item-attr-title[<?php echo $item_id; ?>]"
                   value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
        </label>
        <?php echo 'input the icon class for <strong>Top Navigation, View Switcher</strong> Menu'; ?> ex. flag flag-us
    </p>
    <p class="description description-thin">
        <label for="edit-menu-item-classes-<?php echo $item_id; ?>">
            <?php echo 'CSS Classes (optional)'; ?><br />
            <input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes"
                <?php if (esc_attr( implode(' ', $item->classes ) )) : ?>
                   name="menu-item-classes[<?php echo $item_id; ?>]"
                <?php endif; ?>
                   data-name="menu-item-classes[<?php echo $item_id; ?>]"
                   value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
        </label>
    </p>
    <p class="description description-thin">
        <label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
            <?php echo 'Link Relationship (XFN)'; ?><br />
            <input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn"
                <?php if (esc_attr( $item->xfn )) : ?>
                   name="menu-item-xfn[<?php echo $item_id; ?>]"
                <?php endif; ?>
                   data-name="menu-item-xfn[<?php echo $item_id; ?>]"
                   value="<?php echo esc_attr( $item->xfn ); ?>" />
        </label>
    </p>
    <p class="description description-wide">
        <label for="edit-menu-item-description-<?php echo $item_id; ?>">
            <?php echo 'Description'; ?><br />
            <textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20"
                <?php if (esc_html( $item->description )) : ?>
                      name="menu-item-description[<?php echo $item_id; ?>]"
                <?php endif; ?>
                      data-name="menu-item-description[<?php echo $item_id; ?>]"
                    ><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
            <span class="description"><?php echo 'The description will be displayed in the menu if the current theme supports it.'; ?></span>
        </label>
    </p>

    <?php
    // Add this directly after the description paragraph in the start_el() method
    do_action( 'wp_nav_menu_item_custom_fields', $item_id, $item, $depth, $args );
    // end added section
    ?>

    <div class="menu-item-actions description-wide submitbox">
        <?php if( 'custom' != $item->type && $original_title !== false ) : ?>
        <p class="link-to-original">
            <?php printf( 'Original: %s', '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
        </p>
        <?php endif; ?>
        <a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
            echo wp_nonce_url(
                esc_url( add_query_arg(
                    array(
                        'action' => 'delete-menu-item',
                        'menu-item' => $item_id,
                    ),
                    esc_url( remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) ) )
                ) ),
                'delete-menu_item_' . $item_id
            ); ?>"><?php echo 'Remove'; ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), esc_url( remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) ) );
        ?>#menu-item-settings-<?php echo $item_id; ?>"><?php echo 'Cancel'; ?></a>
    </div>

    <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo $item_id; ?>" />
    <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
    <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
    <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
    <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
    <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
    </div><!-- .menu-item-settings-->
    <ul class="menu-item-transport"></ul>
    </li>
    <?php
        $output .= ob_get_clean();
    }
}

/* Top Navigation Menu */
if (!class_exists('venedor_top_navwalker')) {
    class venedor_top_navwalker extends Walker_Nav_Menu {

        // add classes to ul sub menus
        function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
            $id_field = $this->db_fields['id'];
            if ( is_object( $args[0] ) ) {
                $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
            }
            return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
        }

        // add popup class to ul sub-menus
        function start_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat("\t", $depth);
            $out_div = '';
            if ( $depth == 0 ) {
                $out_div = '<div class="popup"><div class="inner" style="'.$args->popup_style.'">';
            } else {
                $out_div = '';
            }
            $output .= "\n$indent$out_div<ul class=\"sub-menu\">\n";
        }

        function end_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat("\t", $depth);
            if ( $depth == 0 ) {
                $out_div = '</div></div>';
            } else {
                $out_div = '';
            }
            $output .= "$indent</ul>$out_div\n";
        }

        // add main/sub classes to li's and links
        function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
            global $wp_query;

            $sub = "";
            $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
            if ( $depth == 0 && $args->has_children )
                $sub = ' has-sub';

            if ( $depth == 1 && $args->has_children )
                $sub = ' sub';

            $active = "";

            // depth dependent classes
            if ( $item->current || $item->current_item_ancestor || $item->current_item_parent )
                $active = 'active';

            // passed classes
            $classes = empty( $item->classes ) ? array() : (array)$item->classes;

            $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

            // menu type, type, column class, popup style
            $menu_type = "";
            $popup_pos = "";
            $popup_cols = "";
            $popup_style = "";
            $tip_label = $item->tip_label;
            $tip_color = $item->tip_color;
            $tip_bg = $item->tip_bg;
            $cols = 1;

            if ($depth == 0) {
                if ($item->popup_type == "wide") {
                    $menu_type = " wide";
                    $popup_cols = " ". $item->popup_cols;
                    $popup_style = str_replace('"', '\'', $item->popup_style);
                } else {
                    $menu_type = " narrow";
                }
                $popup_pos = " ". $item->popup_pos;
            }

            // build html
            if ($depth == 1) {
                $sub_popup_style = '';
                if ($item->popup_style)
                    $sub_popup_style = ' style="'.str_replace('"', '\'', $item->popup_style).'"';
                if ($item->cols > 1)
                    $cols = (int)$item->cols;
                $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $class_names . ' ' . $active . $sub . $menu_type . $popup_pos . $popup_cols .'" data-cols="'.$cols.'"'.$sub_popup_style.'>';
            } else {
                $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $class_names . ' ' . $active . $sub . $menu_type . $popup_pos . $popup_cols .'">';
            }

            $current_a = "";

            // link attributes
            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

            if ( ( $item->current && $depth == 0 ) ||  ( $item->current_item_ancestor && $depth == 0 ) )
                $current_a .= ' current ';

            $attributes .= ' class="'. $current_a . '"';
            $item_output = $args->before;
            if ($item->block_pos != '' && $item->block)
                $item_output .= '<div class="menu-block menu-block-before">'.do_shortcode('[block name="'.$item->block.'"]').'</div>';
            if ( $item->hide == "" ) {
                if ( $item->nolink == "" ) {
                    $item_output .= '<a'. $attributes .'>';
                } else{
                    $item_output .= '<h5>';
                }
                $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
                $item_output .= $args->link_after;
                if ($item->tip_label) {
                    $item_style = '';
                    if ($item->tip_color)
                        $item_style .= 'color:'.$item->tip_color.';';
                    if ($item->tip_bg)
                        $item_style .= 'background:'.$item->tip_bg.';';
                    $item_output .= '<span class="tip" style="'.$item_style.'">'.__($item->tip_label, 'venedor').'</span>';
                }
                if ( $item->nolink == "" ) {
                    $item_output .= '</a>';
                } else {
                    $item_output .= '</h5>';
                }
            }
            if ($item->block_pos == '' && $item->block)
                $item_output .= '<div class="menu-block menu-block-after">'.do_shortcode('[block name="'.$item->block.'"]').'</div>';
            $item_output .= $args->after;
            $args->popup_style = $popup_style;

            // build html
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }
    }
}

/* Sidebar Menu */
if (!class_exists('venedor_sidebar_navwalker')) {
    class venedor_sidebar_navwalker extends Walker_Nav_Menu {

        // add classes to ul sub menus
        function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
            $id_field = $this->db_fields['id'];
            if ( is_object( $args[0] ) ) {
                $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
            }
            return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
        }

        // add popup class to ul sub-menus
        function start_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat("\t", $depth);
            $out_div = '';
            if ( $depth == 0 ) {
                $out_div = '<span class="arrow"></span><div class="popup"><div class="inner" style="'.$args->popup_style.'">';
            } else {
                $out_div = '';
            }
            $output .= "\n$indent$out_div<ul class=\"sub-menu\">\n";
        }

        function end_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat("\t", $depth);
            if ( $depth == 0 ) {
                $out_div = '</div></div>';
            } else {
                $out_div = '';
            }
            $output .= "$indent</ul>$out_div\n";
        }

        // add main/sub classes to li's and links
        function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
            global $wp_query;

            $sub = "";
            $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
            if ( $depth == 0 && $args->has_children )
                $sub = ' has-sub';

            if ( $depth == 1 && $args->has_children )
                $sub = ' sub';

            $active = "";

            if ( $item->current || $item->current_item_ancestor || $item->current_item_parent )
                $active = 'active';

            // passed classes
            $classes = empty( $item->classes ) ? array() : (array)$item->classes;

            $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

            // menu type, type, column class, popup style
            $menu_type = "";
            $popup_pos = "";
            $popup_cols = "";
            $popup_style = "";
            $tip_label = $item->tip_label;
            $tip_color = $item->tip_color;
            $tip_bg = $item->tip_bg;
            $cols = 1;

            if ($depth == 0) {
                if ($item->popup_type == "wide") {
                    $menu_type = " wide";
                    $popup_cols = " ". $item->popup_cols;
                    $popup_style = str_replace('"', '\'', $item->popup_style);
                } else {
                    $menu_type = " narrow";
                }
                $popup_pos = " ". $item->popup_pos;
            }

            // build html
            if ($depth == 1) {
                $sub_popup_style = '';
                if ($item->popup_style)
                    $sub_popup_style = ' style="'.str_replace('"', '\'', $item->popup_style).'"';
                if ($item->cols > 1)
                    $cols = (int)$item->cols;
                $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $class_names . ' ' . $active . $sub . $menu_type . $popup_pos . $popup_cols .'" data-cols="'.$cols.'"'.$sub_popup_style.'>';
            } else {
                $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $class_names . ' ' . $active . $sub . $menu_type . $popup_pos . $popup_cols .'">';
            }

            $current_a = "";

            // link attributes
            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

            if ( ( $item->current && $depth == 0 ) ||  ( $item->current_item_ancestor && $depth == 0 ) )
                $current_a .= ' current ';

            $attributes .= ' class="'. $current_a . '"';
            $item_output = $args->before;
            if ($item->block_pos != '' && $item->block)
                $item_output .= '<div class="menu-block menu-block-before">'.do_shortcode('[block name="'.$item->block.'"]').'</div>';
            if ( $item->hide == "" ) {
                if ( $item->nolink == "" ) {
                    $item_output .= '<a'. $attributes .'>';
                } else{
                    $item_output .= '<h5>';
                }
                $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
                $item_output .= $args->link_after;
                if ($item->tip_label) {
                    $item_style = '';
                    if ($item->tip_color)
                        $item_style .= 'color:'.$item->tip_color.';';
                    if ($item->tip_bg)
                        $item_style .= 'background:'.$item->tip_bg.';';
                    $item_output .= '<span class="tip" style="'.$item_style.'">'.__($item->tip_label, 'venedor').'</span>';
                }
                if ( $item->nolink == "" ) {
                    $item_output .= '</a>';
                } else {
                    $item_output .= '</h5>';
                }
            }
            if ($item->block_pos == '' && $item->block)
                $item_output .= '<div class="menu-block menu-block-after">'.do_shortcode('[block name="'.$item->block.'"]').'</div>';
            $item_output .= $args->after;
            $args->popup_style = $popup_style;

            // build html
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }
    }
}

/* Accordion Menu */
if (!class_exists('venedor_accordion_navwalker')) {
    class venedor_accordion_navwalker extends Walker_Nav_Menu {

        // add classes to ul sub menus
        function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
            $id_field = $this->db_fields['id'];
            if ( is_object( $args[0] ) ) {
                $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
            }
            return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
        }

        // add main/sub classes to li's and links
        function start_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat("\t", $depth);
            $output .= "\n$indent<ul class=\"sub-menu\">\n";
        }

        function end_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat("\t", $depth);
            $output .= "$indent</ul>\n";
        }

        // add main/sub classes to li's and links
        function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

            global $wp_query;

            $sub = "";
            $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
            if ( ( $depth >= 0 && $args->has_children ) || ( $depth >= 0 && $item->recentpost != "" ) )
                $sub = ' has-sub';

            $active = "";

            if ( $item->current || $item->current_item_ancestor || $item->current_item_parent )
                $active = 'active';

            // passed classes
            $classes = empty( $item->classes ) ? array() : (array) $item->classes;

            $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

            // build html
            $output .= $indent . '<li id="accordion-menu-item-'. $item->ID . '" class="' . $class_names . ' ' . $active . $sub .'">';

            $current_a = "";

            // link attributes
            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
            if ( ( $item->current && $depth == 0 ) || ( $item->current_item_ancestor && $depth == 0 ) )
                $current_a .= ' current ';

            $attributes .= ' class="'. $current_a . '"';
            $item_output = $args->before;
            $tip_label = $item->tip_label;
            $tip_color = $item->tip_color;
            $tip_bg = $item->tip_bg;

            if ($item->block_pos != '' && $item->block)
                $item_output .= '<div class="menu-block menu-block-before">'.do_shortcode('[block name="'.$item->block.'"]').'</div>';
            //if ( $item->hide == "" ) {
                if ( $item->nolink == "" ) {
                    $item_output .= '<a'. $attributes .'>';
                } else {
                    $item_output .= '<h5>';
                }
                $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
                $item_output .= $args->link_after;
                if ($item->tip_label) {
                    $item_style = '';
                    if ($item->tip_color)
                        $item_style .= 'color:'.$item->tip_color.';';
                    if ($item->tip_bg)
                        $item_style .= 'background:'.$item->tip_bg.';';
                    $item_output .= '<span class="tip" style="'.$item_style.'">'.__($item->tip_label, 'venedor').'</span>';
                }
                if ( $item->nolink == "" ) {
                    $item_output .= '</a><span class="arrow"></span>';
                } else {
                    $item_output .= '</h5><span class="arrow"></span>';
                }
            //}
            if ($item->block_pos == '' && $item->block)
                $item_output .= '<div class="menu-block menu-block-after">'.do_shortcode('[block name="'.$item->block.'"]').'</div>';
            $item_output .= $args->after;

            // build html
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }
    }
}



