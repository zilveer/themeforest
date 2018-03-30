<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'YIT' ) ) {
    exit( 'Direct access forbidden.' );
}

/**
 * Theme Option -> Custom Login
 *
 * @class      YIT_Backup
 * @package    Yithemes
 * @since      2.0.0
 * @author     Your Inspiration Themes
 *
 */
class YIT_Panel_Admin_Settings extends YIT_Submenu {

    public function __construct() {
        $this->menu_title = __( 'Admin Settings', 'yit' );
        $this->page_title = __( 'Admin Settings', 'yit' );
        $this->priority = 15;
        $this->slug = 'yit_panel_admin_settings';
        $this->folder_options = 'admin-settings';
    }

}