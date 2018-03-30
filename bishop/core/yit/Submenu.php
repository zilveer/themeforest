<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if (!defined('YIT')) exit('Direct access forbidden.');

/**
 * Add a Submenu Page
 *
 * @class YIT_Submenu
 * @package	Yithemes
 * @author Your Inspiration Themes
 */
abstract class YIT_Submenu extends YIT_Object {

    /**
     * Panel Priority
     *
     * @var int Higher numbers will be put lower
     */
    public $priority = 10;

    /**
     * A string cointains Slug, a few words that describe a page
     *
     * @var string
     */
    public $slug;

    /**
     * Page Title
     *
     * @var string Set the page title in admin panel
     */
    public $page_title;

    /**
     * Menu Title
     *
     * @var string Set the menu tab title
     */
    public $menu_title;

    /**
     * Folder Options
     *
     * @var string The folder in which options are saved
     */
    public $folder_options = null;

    /**
     * Array Tabs name.
     *
     * @var array An array with Tabs name for the options page
     */
    public $tabs = array();


    /**
     * Callback function
     *
     * @since 2.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    public function display_page() {
        $theme   = wp_get_theme();
        $tabs    = $this->load_tabs();
        $type    = $this->getModel('type');
        $form_id = $this->slug;

        yit_get_template('admin/panel/header.php',
            array(
                'theme' => $theme->Name,
                'version' => $theme->Version
            )
        );

        yit_get_template('admin/panel/form.php',            array( 'form_id' => $form_id ));
        yit_get_template('admin/panel/menu.php',            array( 'tabs' => $tabs ));
        yit_get_template('admin/panel/content-options.php', array( 'tabs' => $tabs, 'type' => $type ));
        yit_get_template('admin/panel/footer.php',          array( 'form' => true, 'tab_slug' => $this->folder_options ));
    }

    /**
     * Load tabs from $folder_options index of YIT_Panel::panel array.
     *
     * @since 2.0.0
     * @return array()
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    public function load_tabs() {

        if( isset( $this->folder_options ) && $this->folder_options ) {
            $panel = $this->tabs = $this->getModel('panel')->get_panel();
            if( isset( $panel[ $this->folder_options ] ) ){
                $this->tabs = $panel[ $this->folder_options ];
            }
        }

        return $this->tabs;
    }
}