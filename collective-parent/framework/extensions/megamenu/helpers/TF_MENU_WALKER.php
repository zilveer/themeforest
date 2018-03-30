<?php

if (!defined('TFUSE'))
    exit('Direct access forbidden.');

class TF_FRONT_END_MENU_WALKER extends Walker_Nav_Menu {
    // the maximum depth allowed
    // for megafied sub menus
    const MEGAFIED_DEPTH = 2;

    // the maximum depth allowed
    // for non megafied sub menus
    const USUAL_DEPTH = 10;

    // will be used as a holder for
    // the currenct maximum depth
    private $current_max_depth;

    // the meta key under which megamenu
    // options are saved in the postmeta table
    private $mm_meta_key = 'tf_megamenu_options';
    private $mm_prefix = 'tf_megamenu_';
    private $mm_ext_name = 'MEGAMENU';
    private $mm_magic_depth = 1; // the depth where the magic happens
    private $children_holder = null;
    private $megafied_navs_ids;
    private $megafied_parent_li_css_classes;
    private $megafied_child_li_css_classes;

    function __construct() {
        $this->megafied_navs_ids = $this->get_megafied_nav_ids();
        $this->megafied_parent_li_css_classes = TF_MEGAMENU_OPTHELP::get_megafied_parent_li_css_classes();
        $this->megafied_child_li_css_classes = TF_MEGAMENU_OPTHELP::get_megafied_child_li_css_classes();
    }

    /**
     * Selects from the db all nav items that have 'tf_megamenu_options'
     * post meta and creates an array of the id's of nav elements that have
     * the options 'tf_megamenu_is_mega' set to true
     *
     * @uses $wpdb
     * @return array The id's array
     */
    private function get_megafied_nav_ids() {
        global $wpdb;

        $sql = (
            "SELECT post_id, meta_value"
            . " FROM " . $wpdb->postmeta
            . " WHERE meta_key = '" . $this->mm_meta_key . "'"
        );
        $query_rez = $wpdb->get_results($sql);

        $return_arr = array(
            'depth_0' => array(),
            'depth_1' => array()
        );
        foreach ($query_rez as $q) {
            $mega_opts = unserialize($q->meta_value);
            if (
                isset($mega_opts[$this->mm_prefix . 'is_mega'])
                && $mega_opts[$this->mm_prefix . 'is_mega'] == 'true'
            ) {
                $return_arr['depth_0'][$q->post_id] = $mega_opts;
            } else {
                $return_arr['depth_1'][$q->post_id] = $mega_opts;
            }
        }

        return $return_arr;
    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $is_megafied_parent_li = array_key_exists($item->ID, $this->megafied_navs_ids['depth_0']);
        $is_megafied_child_li = (
            $depth == $this->mm_magic_depth
            && array_key_exists($item->ID, $this->megafied_navs_ids['depth_1'])
        );

        // filling the extra css classes from config to megafied li
        if ($is_megafied_parent_li) {
            $item->classes = array_merge($item->classes, $this->megafied_parent_li_css_classes);
        } else if ($is_megafied_child_li) {
            $item->classes = array_merge($item->classes, $this->megafied_child_li_css_classes);
        }

        $class_names = $value = '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names .'>';

        if ($is_megafied_child_li) {
            global $TFUSE;
            $megamenu_meta = $this->megafied_navs_ids['depth_1'][$item->ID];
            $megamenu_meta['item_settings'] = array(
                'item_title' => esc_attr($item->title),
                'attr_title' => esc_attr($item->attr_title),
                'target' => esc_attr($item->target),
                'xfn' => esc_attr($item->xfn),
                'url' => esc_attr($item->url),
                'object' => array(
                    'object_id' => $item->object_id,
                    'object' => $item->object,
                    'type' => $item->type,
                    'type_label' => $item->type_label
                 ),
            );

            // generating children array
            $megamenu_meta = array_merge($megamenu_meta, $this->get_all_children_of_nav($item->ID, array()));

            $item_output = $TFUSE->load->ext_tc_view(
                $this->mm_ext_name,
                $megamenu_meta[$this->mm_prefix . 'menu_template'],
                '',
                array('settings' => $megamenu_meta),
                true
            );
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        } else {
            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }
    }

    private function get_all_children_of_nav($nav_id, $accumulator) {
        if (!isset($this->children_holder[$nav_id])) {
            return array_merge($accumulator, array('children' => array()));
        } else {
            $accumulator['children'] = array();
            foreach ($this->children_holder[$nav_id] as $child) {
                array_push($accumulator['children'], $this->get_all_children_of_nav($child->ID, (array) $child));
            }

            return $accumulator;
        }
    }

    function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
        if ($this->children_holder === null) {
            $this->children_holder = $children_elements;
        }

        // change the depth depending on if the
        // menu branch is or is not megafied
        if (array_key_exists($element->ID, $this->megafied_navs_ids['depth_0'])) {
            $this->current_max_depth = self::MEGAFIED_DEPTH;
        } elseif ($depth == 0) {
            $this->current_max_depth = self::USUAL_DEPTH;
        }

        parent::display_element($element, $children_elements, $this->current_max_depth, $depth, $args, $output);
    }
}

class TF_ADMIN_MENU_WALKER extends Walker_Nav_Menu {

    public function __construct()
    {
        $this->framework =& get_instance();
    }

    function start_lvl(&$output, $depth = 0, $args = array() ) {
    }

    function end_lvl(&$output, $depth = 0, $args = array() ) {
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {
        global $_wp_nav_menu_max_depth;
        $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        ob_start();
        $item_id = esc_attr( $item->ID );
        $parent_id = esc_attr( $item->menu_item_parent );
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
            'menu-item-edit-' . ( ( $this->framework->request->isset_GET('edit-menu-item') && $item_id == $this->framework->request->GET('edit-menu-item') ) ? 'active' : 'inactive'),
        );

        $title = $item->title;

        if ( ! empty( $item->_invalid ) ) {
            $classes[] = 'menu-item-invalid';
            /* translators: %s: title of menu item which is invalid */
            $title = sprintf( __( '%s (Invalid)', 'tfuse' ), $item->title );
        } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
            $classes[] = 'pending';
            /* translators: %s: title of menu item in draft status */
            $title = sprintf( __('%s (Pending)', 'tfuse'), $item->title );
        }

        $title = empty( $item->label ) ? $title : $item->label;

        ?>
        <li id="menu-item-<?php echo $item_id;?>" class="<?php echo implode(' ', $classes);?>">
            <dl class="menu-item-bar">
                <dt class="menu-item-handle">
                    <span class="item-title"><?php echo esc_html($title);?></span>
                    <span class="item-controls">
                        <span class="item-type"><?php echo esc_html($item -> type_label);?></span>
                        <span class="item-order hide-if-js">
                            <a href="<?php
                            echo wp_nonce_url(add_query_arg(array('action' => 'move-up-menu-item', 'menu-item' => $item_id, ), remove_query_arg($removed_args, admin_url('nav-menus.php'))), 'move-menu_item');
                            ?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up', 'tfuse');?>">&#8593;</abbr></a>
                            |
                            <a href="<?php
                            echo wp_nonce_url(add_query_arg(array('action' => 'move-down-menu-item', 'menu-item' => $item_id, ), remove_query_arg($removed_args, admin_url('nav-menus.php'))), 'move-menu_item');
                            ?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down', 'tfuse');?>">&#8595;</abbr></a>
                        </span>
                        <a class="item-edit" id="edit-<?php echo $item_id;?>" title="<?php esc_attr_e('Edit Menu Item', 'tfuse');?>" href="<?php
                            echo ( $this->framework->request->isset_GET('edit-menu-item') && $item_id == $this->framework->request->GET('edit-menu-item') ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) ) );
                        ?>"><?php _e('Edit Menu Item', 'tfuse');?></a>
                    </span>
                </dt>
            </dl>

            <div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id;?>">
                <?php if( 'custom' == $item->type ) : ?>
                    <p class="field-url description description-wide">
                        <label for="edit-menu-item-url-<?php echo $item_id;?>">
                            <?php _e('URL', 'tfuse');?><br />
                            <input type="text" id="edit-menu-item-url-<?php echo $item_id;?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id;?>]" value="<?php echo esc_attr($item -> url);?>" />
                        </label>
                    </p>
                <?php endif;?>
                <p class="description description-thin">
                    <label for="edit-menu-item-title-<?php echo $item_id;?>">
                        <?php _e('Navigation Label', 'tfuse');?><br />
                        <input type="text" id="edit-menu-item-title-<?php echo $item_id;?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id;?>]" value="<?php echo esc_attr($item -> title);?>" />
                    </label>
                </p>
                <p class="description description-thin">
                    <label for="edit-menu-item-attr-title-<?php echo $item_id;?>">
                        <?php _e('Title Attribute', 'tfuse');?><br />
                        <input type="text" id="edit-menu-item-attr-title-<?php echo $item_id;?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id;?>]" value="<?php echo esc_attr($item -> post_excerpt);?>" />
                    </label>
                </p>
                <p class="field-link-target description">
                    <label for="edit-menu-item-target-<?php echo $item_id;?>">
                        <input type="checkbox" id="edit-menu-item-target-<?php echo $item_id;?>" value="_blank" name="menu-item-target[<?php echo $item_id;?>]"<?php checked($item -> target, '_blank');?> />
                        <?php _e('Open link in a new window/tab', 'tfuse');?>
                    </label>
                </p>
                <p class="field-css-classes description description-thin">
                    <label for="edit-menu-item-classes-<?php echo $item_id;?>">
                        <?php _e('CSS Classes (optional)', 'tfuse');?><br />
                        <input type="text" id="edit-menu-item-classes-<?php echo $item_id;?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id;?>]" value="<?php echo esc_attr(implode(' ', $item -> classes));?>" />
                    </label>
                </p>
                <p class="field-xfn description description-thin">
                    <label for="edit-menu-item-xfn-<?php echo $item_id;?>">
                        <?php _e('Link Relationship (XFN)', 'tfuse');?><br />
                        <input type="text" id="edit-menu-item-xfn-<?php echo $item_id;?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id;?>]" value="<?php echo esc_attr($item -> xfn);?>" />
                    </label>
                </p>
                <p class="field-description description description-wide">
                    <label for="edit-menu-item-description-<?php echo $item_id;?>">
                        <?php _e('Description', 'tfuse');?><br />
                        <textarea id="edit-menu-item-description-<?php echo $item_id;?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id;?>]"><?php echo esc_html($item -> description);
                            // textarea_escaped
 ?></textarea>
                        <span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.', 'tfuse');?></span>
                    </label>
                </p>

                <!-- THEMEFUSE MEGAMENU OPTIONS -->
                <?php do_action('tf_ext_megamenu_admin_nav_options', $depth, $item_id);?>
                <!-- END MEGAMENU OPTIONS -->

                <div class="menu-item-actions description-wide submitbox">
                    <?php if( 'custom' != $item->type && $original_title !== false ) : ?>
                        <p class="link-to-original">
                            <?php printf(__('Original: %s', 'tfuse'), '<a href="' . esc_attr($item -> url) . '">' . esc_html($original_title) . '</a>');?>
                        </p>
                    <?php endif;?>
                    <a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id;?>" href="<?php
                    echo wp_nonce_url(add_query_arg(array('action' => 'delete-menu-item', 'menu-item' => $item_id, ), remove_query_arg($removed_args, admin_url('nav-menus.php'))), 'delete-menu_item_' . $item_id);
 ?>"><?php _e('Remove', 'tfuse');?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo $item_id;?>" href="<?php    echo esc_url(add_query_arg(array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg($removed_args, admin_url('nav-menus.php'))));?>#menu-item-settings-<?php echo $item_id;?>"><?php _e('Cancel', 'tfuse');?></a>
                </div>

                <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id;?>]" value="<?php echo $item_id;?>" />
                <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id;?>]" value="<?php echo esc_attr($item -> object_id);?>" />
                <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id;?>]" value="<?php echo esc_attr($item -> object);?>" />
                <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id;?>]" value="<?php echo esc_attr($item -> menu_item_parent);?>" />
                <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id;?>]" value="<?php echo esc_attr($item -> menu_order);?>" />
                <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id;?>]" value="<?php echo esc_attr($item -> type);?>" />
            </div><!-- .menu-item-settings-->
            <ul class="menu-item-transport"></ul>
        <?php
        $output .= ob_get_clean();
    }
}

