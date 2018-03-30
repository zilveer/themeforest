<?php

/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 *
 * @package Yithemes
 * @author Your Inspiration Themes <info@yithemes.com>
 */

if (!defined('YIT')) exit('Direct access forbidden.');

/**
 * Add a panel submenu
 *
 * This class add a Theme Option Tabs in backend admin
 *
 * @class YIT_Panel_Submenu
 * @package	Yithemes
 */
class YIT_Panel_ThemeOptions extends YIT_Submenu {

    /**
     * Constructor
     *
     * @since 2.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    public function __construct() {
        $this->priority = 10;
        $this->slug = 'yit_panel';
        $this->page_title = __( 'Theme Options', 'yit' );
        $this->menu_title = __( 'Theme Options', 'yit' );
        $this->folder_options = 'theme-options';
    }

     /**
     * Abstract definition for callback function
     *
     * @since 2.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     * @return void
     *

    public function display_page() {
        $this->load_tabs();

        echo '<pre>';
        var_dump( $this->tabs );
        echo '</pre>';
    }
      */
}