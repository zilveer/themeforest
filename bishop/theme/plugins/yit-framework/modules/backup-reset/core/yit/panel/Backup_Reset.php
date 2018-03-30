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
 * Theme Option -> Backup & Reset Section
 *
 * @class      YIT_Backup
 * @package    Yithemes
 * @since      2.0.0
 * @author     Your Inspiration Themes
 *
 */
class YIT_Panel_Backup_Reset extends YIT_Submenu {

    public function __construct() {
        $this->menu_title = __( 'Backup &amp; Reset', 'yit' );
        $this->page_title = __( 'Backup &amp; Reset', 'yit' );
        $this->priority = 90;
        $this->slug = 'yit_panel_backup_and_reset';
        $this->folder_options = 'backup-and-reset';
    }
}