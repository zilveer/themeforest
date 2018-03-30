<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
 
/**
 * Class to print fields in the tab Home Portfolios -> Settings
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Portfolios_Settings extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_portfolios_settings
     * 
     * @param array $fields
     * @since 1.0.0
     */
    public function __construct() {
        $fields = $this->init();
        $this->fields = apply_filters( strtolower( __CLASS__ ), $fields );
    }
    
    /**
     * Set default values
     * 
     * @return array
     * @since 1.0.0
     */
    public function init() {  
        return array(
            10 => array(
                'id' => 'thumbnail-portfolios',
                'type' => 'select',
                'name' => __( 'Thumbnail click', 'yit' ),
                'desc' => __( 'Select what you want to do when you click in the item thumbnail (not valid for the portfolio filterable).', 'yit' ),
                'options' => array(
					'lightbox' => 'Open full image in a lightbox',
					'item-page' => 'Go to item single page',
					'nothing' => 'Don\'t do nothing'
				),
                'std' => 'nothing'
            ),
			20 => array(
                'id' => 'filters-link-portfolios',
                'type' => 'onoff',
                'name' => __( 'Link to single page in Portfolio Filterable', 'yit' ),
                'desc' => __( 'Select if you want to show the icon to go to the item single page, when you pass over the thumbnail in the portfolio filterable.', 'yit' ),
                'std' => true
            ),
        );
    }
}