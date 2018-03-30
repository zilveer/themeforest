<?php
/**
 * Admin menu page customization
 * @author SeventQueen
 */

if (!class_exists('Walker_Nav_Menu_Edit')) {
    require_once(ABSPATH . 'wp-admin/includes/nav-menu.php');
}


class kleo_custom_menu {

    /*--------------------------------------------*
     * Constructor
     *--------------------------------------------*/

    function __construct() {

        // add custom menu fields to menu
        add_filter( 'wp_setup_nav_menu_item', array( $this, 'kleo_add_custom_nav_fields' ) );

        // save menu custom fields
        add_action( 'wp_update_nav_menu_item', array( $this, 'kleo_update_custom_nav_fields'), 10, 3 );

        // edit menu walker
        add_filter( 'wp_edit_nav_menu_walker', array( $this, 'kleo_edit_walker'), 10, 2 );

        //load extra scripts
        add_action('admin_print_scripts', array( $this, 'sq_load_scripts' ));


    } // end constructor

    /**
     * Load necessary JavaScript and CSS files
     */
    public function sq_load_scripts() {

        $screen = get_current_screen();

        if ( is_object($screen) && $screen->base == 'nav-menus') {
            wp_enqueue_script( 'wp-color-picker', false, array(), false, true );
            wp_enqueue_style( 'wp-color-picker' );
        }

    }


    /**
     * Add custom fields to $item nav object
     * in order to be used in custom Walker
     *
     * @access      public
     * @since       1.0
     * @return      void
     */
    function kleo_add_custom_nav_fields( $menu_item ) {

        $menu_item->icon = get_post_meta( $menu_item->ID, '_menu_item_icon', true );
        $menu_item->icon_color = get_post_meta( $menu_item->ID, '_menu_item_icon_color', true );
        $menu_item->extra = get_post_meta( $menu_item->ID, '_menu_item_extra', true );
        return $menu_item;

    }

    /**
     * Save menu custom fields
     *
     * @access      public
     * @since       1.0
     * @return      void
     */
    function kleo_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {

        // Check if  icons element is properly sent
        if ( isset( $_REQUEST['menu-item-icon'] ) && is_array( $_REQUEST['menu-item-icon']) && isset( $_REQUEST['menu-item-icon'][$menu_item_db_id] ) ) {
            $icon_value = $_REQUEST['menu-item-icon'][$menu_item_db_id];
            update_post_meta( $menu_item_db_id, '_menu_item_icon', $icon_value );
        } else {
            update_post_meta( $menu_item_db_id, '_menu_item_icon', null );
        }

        if ( isset( $_REQUEST['menu-item-icon-color'] ) && is_array( $_REQUEST['menu-item-icon-color']) && isset( $_REQUEST['menu-item-icon-color'][$menu_item_db_id] ) ) {
            $icon_color_value = $_REQUEST['menu-item-icon-color'][$menu_item_db_id];
            update_post_meta( $menu_item_db_id, '_menu_item_icon_color', $icon_color_value );
        } else {
            update_post_meta( $menu_item_db_id, '_menu_item_icon_color', null );
        }

        if ( isset( $_REQUEST['menu-item-extra'] ) && is_array( $_REQUEST['menu-item-extra']) && isset( $_REQUEST['menu-item-extra'][$menu_item_db_id] ) ) {
            $icon_value = $_REQUEST['menu-item-extra'][$menu_item_db_id];
            update_post_meta( $menu_item_db_id, '_menu_item_extra', $icon_value );
        } else {
            update_post_meta( $menu_item_db_id, '_menu_item_extra', null );
        }

    }

    /**
     * Define new Walker edit
     *
     * @access      public
     * @since       1.0
     * @return      void
     */
    function kleo_edit_walker($walker,$menu_id = null) {

        return 'Kleo_Walker_Nav_Menu_Edit';

    }

}

if ( !class_exists('Kleo_Walker_Nav_Menu_Edit') ) {
    /**
     *
     * Create HTML list of nav menu input items.
     *
     * @package WordPress
     * @since 3.0.0
     * @uses Walker_Nav_Menu
     */
    class Kleo_Walker_Nav_Menu_Edit extends Walker_Nav_Menu_Edit  {
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

            parent::start_el( $output, $item, $depth, $args, $id );

            $item_id = esc_attr( $item->ID );
            $to_add = '';

            $icon_opts = '';
            $select_icons = kleo_icons_array( '', array( '', '-none-' ));

            foreach ( $select_icons as $icon ) {
                $selected_icon = $item->icon == $icon ? ' selected="selected"' : '';
                $icon_opts .= '<option value="' . $icon . '"' . $selected_icon . '>' . $icon . '</option> ';
            }


            $to_add .= '<p class="menu-item-icons description description-thin">'
                . '<label for="edit-menu-item-icons-' . $item_id . '">'
                . esc_html__( 'Choose Icon', 'buddyapp' )
                . ' <br><select id="edit-menu-item-icon-'. $item_id . '" name="menu-item-icon[' . $item_id . ']" style="width:100%;">'
                . $icon_opts
                . '</select>'
                . '</label>'
                . '</p>';

            $to_add .= '<p class="menu-item-icons description description-thin">'
                . '<label>'
                . esc_html__( 'Icon Color', 'buddyapp' )
                . '<br><span style="position:absolute;margin-top:2px;">'
                . '<input type="text" name="menu-item-icon-color[' . $item_id . ']" value="'.$item->icon_color.'" class="menu-icon-color-picker">'
                . '</span>'
                . '</label>'
                . '</p>'
                . '<script>jQuery(document).ready(function($){ $(".menu-icon-color-picker:not(\'.wp-color-picker\')").wpColorPicker(); });</script>';

            $to_add .= '<p class="menu-item-extra description description-wide">'
                . '<label for="edit-menu-item-extra-' . $item_id . '">'
                . esc_html__( 'Extra Data to show under a menu item', 'buddyapp' )
                . ' <br><textarea class="widefat edit-menu-item-extra" id="edit-menu-item-extra-'. $item_id . '" name="menu-item-extra[' . $item_id . ']">'
                . $item->extra
                . '</textarea>'
                . '<span class="description">' . esc_html__( 'You can add shortcodes here and all the data will be added in a dropdown to the current item', 'buddyapp' ) . '</span>'
                . '</label>'
                . '</p>';
            ob_start();

            // action for other plugins
            do_action( 'wp_nav_menu_item_custom_fields', $item_id, $item, $depth, $args );

            $to_add .= ob_get_clean();

            $output = str_replace('<label for="edit-menu-item-target-'.$item_id.'">', '</p>' . $to_add . '<div class="clear"></div><p class="field-link-target description"><label for="edit-menu-item-target-'.$item_id.'">', $output);

        }
    }
}
// instantiate the custom menu class
$GLOBALS['kleo_custom_menu'] = new kleo_custom_menu();
