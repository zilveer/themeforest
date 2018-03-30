<?php

if (!defined('TFUSE'))
    exit('Direct access forbidden.');

class TF_MEGAMENU extends TF_TFUSE {
    public  $_standalone = TRUE;
    public  $_the_class_name = 'MEGAMENU';

    private $max_depth = 1;
    private $magic_depth = 1;   // the depth where the template options come
    private $admin_menu_walker_class = 'TF_ADMIN_MENU_WALKER';

    public function __construct() {
        parent::__construct();
    }

    public function __init() {
        $disabled_extensions = apply_filters('tfuse_get_disabled_extensions', null);

        // Do not load extension if no folder exists in theme_config/
        if (
            !$this->load->ext_file_exists($this->_the_class_name, '')
            || in_array(strtolower($this->_the_class_name), $disabled_extensions)
        ) {
            return;
        }

        $this->load_helpers();

        if (is_admin()) {
            $this->register_ajax();
            $this->add_admin_actions();
        }
    }

    private function load_helpers() {
        $this->load->ext_helper($this->_the_class_name, 'TF_MENU_WALKER');
        $this->load->ext_helper($this->_the_class_name, 'TF_MEGAMENU_OPTHELP');
    }

    private function register_ajax() {
        $this->ajax->_add_action('tfuse_ajax_megamenu', $this);
    }

    private function add_admin_actions() {
        add_action('admin_menu', array($this, 'init_admin_menu_walker'));

        // load admin js & css
        add_action('admin_print_styles-nav-menus.php', array($this, 'load_megamenu_admin_js'));
        add_action('admin_print_styles-nav-menus.php', array($this, 'load_megamenu_admin_css'));

        // will display megamenu options in the admin menu builder
        add_action('tf_ext_megamenu_admin_nav_options', array($this, 'render_megamenu_options'), 10, 3);

        // save custom options to db
        add_action('wp_update_nav_menu_item', array($this , 'save_megamenu_options'), 10, 3);
    }

    public function init_admin_menu_walker() {
        add_filter('wp_edit_nav_menu_walker', array($this, 'get_admin_menu_walker_class'), 2000);
    }

    public function get_admin_menu_walker_class() {
        return $this->admin_menu_walker_class;
    }

    public function load_megamenu_admin_js() {
        $this->include->register_type(
            'ext_megamenu_js',
            TFUSE_EXT_DIR . '/' . strtolower($this->_the_class_name) . '/static/js'
        );
        $this->include->js('megamenu_admin', 'ext_megamenu_js','tf_head', 10, '1.1');

        do_action('tf_ext_megamenu_load_admin_js');
    }

    public function load_megamenu_admin_css() {
        $this->include->register_type(
            'ext_megamenu_css',
            TFUSE_EXT_DIR . '/' . strtolower($this->_the_class_name) . '/static/css'
        );
        $this->include->css('megamenu_admin', 'ext_megamenu_css');

        do_action('tf_ext_megamenu_load_admin_css');
    }

    /**
     * Renders appropriate megamenu options in the admin menu builder
     *
     * @param int $depth The depth of the navigation item
     * @param int $nav_id The id of the navigation item
     * @param int $nav_parent_id The id of the item's parent or 0 if none
     */
    public function render_megamenu_options($depth, $nav_id) {
        echo '<div class="clear"></div>';
        echo '<div class="tf_megamenu_optcontainer">';

        echo '<div class="tf_megamenu_commun_opts">';
        if ($depth <= $this->max_depth)
            echo TF_MEGAMENU_OPTHELP::generate_commun_options_html($depth, $nav_id);
        echo '<div class="clear"></div>';
        echo '</div>';

        echo '<div class="tf_megamenu_uncommun_opts">';

        if ($depth === $this->magic_depth) {
            $template = TF_MEGAMENU_OPTHELP::get_needed_template($nav_id);
            if ($template !== '') {
                echo $this->generate_template_options_html($template, $nav_id);
            }
        }

        echo '</div>';  // end .tf_megamenu_uncommun_opts div

        echo '</div>';  // end .tf_megamenu_optcontainer div
    }

    /**
     * Saves megamenu data to postmeta table
     *
     * @param int $menu_id The menu id
     * @param int $nav_item_id The menu item item
     * @param array $args The data that comes with the nav item before saving
     */
    public function save_megamenu_options($menu_id, $nav_item_id, $args) {
        /* echo "menu id: " . $menu_id;
         echo "<br/>";
        echo "nav_item_id: " . $nav_item_id;
        tf_print($this->request->POST(), true); */

        // if the nav item doesn't have megamenu options do nothing
        if (!$this->request->isset_POST('tf_megamenu_options.'.$nav_item_id) ) {
            tf_delete_post_meta($nav_item_id, 'tf_megamenu_options');
            return;
        }

        // if we have a depth 0 nav item and tf_is_mega option is selected
        // or we have a depth 1 nav item and it's parent's tf_is_mega option is selected
        // then we save the megamenu data to post_meta table
        // if not we delete the megamenu tf_megamenu_options metadata if it exists
        $needs_to_be_saved = ($args['menu-item-parent-id'] == 0
            && $this->request->POST('tf_megamenu_options.'.$nav_item_id.'.tf_megamenu_is_mega') == 'true')
            || ($this->request->isset_POST('tf_megamenu_options.'.$args['menu-item-parent-id']) && $this->request->POST('tf_megamenu_options.'.$args['menu-item-parent-id'].'.tf_megamenu_is_mega') == 'true');

        if ($needs_to_be_saved)
            tf_update_post_meta($nav_item_id, 'tf_megamenu_options', $this->request->POST('tf_megamenu_options.'.$nav_item_id));
        else
            tf_delete_post_meta($nav_item_id, 'tf_megamenu_options');
    }

    /**
     * Ajax handler for admin menu template chooser dropdown
     * @ajax
     */
    public function ajax_template_chooser() {
        if (!tf_current_user_can(array('manage_options', 'edit_theme_options'), false))
            die(__('Access denied', 'tfuse'));

        $template = $this->request->POST('tf_megamenu_template');
        $nav_id = $this->request->POST('tf_megamenu_nav_id');

        // echo TF_MEGAMENU_OPTHELP::generate_template_options_html($template, $nav_id);
        echo $this->generate_template_options_html($template, $nav_id);
        die();
    }

    private function generate_template_options_html($template, $nav_id) {
        return TF_MEGAMENU_OPTHELP::generate_template_options_html($template, $nav_id);
    }

    /**
     * Gets the default html for depths 0 & 1.
     * Used for dynamic tf_megamenu_optcontainer
     * html substitution when reordering the
     * admin nav menu builder
     * @ajax
     */
    public function ajax_optcontainer_defaults()
    {
        if (!tf_current_user_can(array('manage_options', 'edit_theme_options'), false))
            die(__('Access denied', 'tfuse'));

        $arr = TF_MEGAMENU_OPTHELP::get_optcontainer_defaults();
        echo json_encode($arr);
        die();
    }

    /**
     * Ajax handler is triggered when
     * something is added to the nav menu
     * @ajax
     */
    public function ajax_add_menu_item() {
        if (!tf_current_user_can(array('manage_options', 'edit_theme_options'), false))
            die('-1');

        check_ajax_referer( 'add-menu_item', 'menu-settings-column-nonce' );

        require_once ABSPATH . 'wp-admin/includes/nav-menu.php';

        // For performance reasons, we omit some object properties from the checklist.
        // The following is a hacky way to restore them when adding non-custom items.

        $menu_items_data = array();
        if ($this->request->POST('menu-item'))
            foreach ( (array)$this->request->POST('menu-item') as $menu_item_data ) {
            if (
                ! empty( $menu_item_data['menu-item-type'] ) &&
                'custom' != $menu_item_data['menu-item-type'] &&
                ! empty( $menu_item_data['menu-item-object-id'] )
            ) {
                switch( $menu_item_data['menu-item-type'] ) {
                    case 'post_type' :
                        $_object = get_post( $menu_item_data['menu-item-object-id'] );
                        break;

                    case 'taxonomy' :
                        $_object = get_term( $menu_item_data['menu-item-object-id'], $menu_item_data['menu-item-object'] );
                        break;
                }

                $_menu_items = array_map( 'wp_setup_nav_menu_item', array( $_object ) );
                $_menu_item = array_shift( $_menu_items );

                // Restore the missing menu item properties
                $menu_item_data['menu-item-description'] = $_menu_item->description;
            }

            $menu_items_data[] = $menu_item_data;
        }

        $item_ids = wp_save_nav_menu_items( 0, $menu_items_data );
        if ( is_wp_error( $item_ids ) )
            die('-1');

        foreach ( (array) $item_ids as $menu_item_id ) {
            $menu_obj = get_post( $menu_item_id );
            if ( ! empty( $menu_obj->ID ) ) {
                $menu_obj = wp_setup_nav_menu_item( $menu_obj );
                $menu_obj->label = $menu_obj->title; // don't show "(pending)" in ajax-added items
                $menu_items[] = $menu_obj;
            }
        }

        if ( ! empty( $menu_items ) ) {
            $args = array(
                'after' => '',
                'before' => '',
                'link_after' => '',
                'link_before' => '',
                'walker' =>	new TF_ADMIN_MENU_WALKER,
            );

            echo walk_nav_menu_tree( $menu_items, 0, (object) $args );
        }

        die();
    }
}