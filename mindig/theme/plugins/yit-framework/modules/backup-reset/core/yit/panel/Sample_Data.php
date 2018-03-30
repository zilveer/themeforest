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
 * @class      YIT_Panel_Sample_Data
 * @package    Yithemes
 * @since      2.0.0
 * @author     Your Inspiration Themes
 *
 */
class YIT_Panel_Sample_Data extends YIT_Submenu {

    public function __construct() {
        $this->menu_title = __( 'Sample Data', 'yit' );
        $this->page_title = __( 'Sample Data', 'yit' );
        $this->priority = 80;
        $this->slug = 'yit_panel_sample_data';
        $this->folder_options = 'sample-data';
    }

}