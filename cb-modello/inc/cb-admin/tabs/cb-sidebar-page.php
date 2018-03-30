<?php
/**
 * User: cb-theme
 * Date: 11.10.13
 * Time: 13:25
 * cb-theme Admin Sidebars
 */

if (function_exists('is_admin')) {

    if (is_admin()) {
        /**
         * add admin submenu page (Sidebars)
         */
        add_action('admin_menu', 'add_sidebar_page');
        function add_sidebar_page(){
            add_submenu_page( 'cb-admin', 'Modello Sidebars', 'Sidebars', 'manage_options', 'cb-sidebars', 'open_sidebar_details');

        }

    }
} else echo 'no cheatin!';
/**
 * Sidebars Page
 */
function open_sidebar_details(){
    ?>
    <h2><img src="<?php echo WP_THEME_URL; ?>/inc/images/admin_images/4.png" align="absmiddle"
             style="padding-right:10px;"><?php _e('Sidebars','cb-modello'); ?></h2>
    <div class="cl"></div>



<?php
}