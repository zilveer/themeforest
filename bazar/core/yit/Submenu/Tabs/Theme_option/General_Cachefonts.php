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
 * Class to print fields in the tab General -> Cache & Google Fonts
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_General_Cachefonts extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_general_newsletter
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
                'id' => 'google_fonts_subsets',
                'type' => 'checklist',
                'name' => __( 'Google Fonts Subsets', 'yit' ),
                'desc' => __( 'Using many subsets can slow down your webpage, so only select the subsets that you actually need on your webpage. Make sure the fonts you\'re using supports the subsets chosen. More info on <a href="http://www.google.com/webfonts">Google Web Fonts</a>.', 'yit' ),
                'std' => apply_filters( 'yit_newsletter-action_std', '' ),
                'value' => array(
                    'latin'        => __( 'Latin', 'yit' ),
                    'latin-ext'    => __( 'Latin Extended', 'yit' ),
                    'cyrillic'     => __( 'Cyrillic', 'yit' ),
                    'cyrillic-ext' => __( 'Cyrillic Extended', 'yit' ),
                    'greek'        => __( 'Greek', 'yit' ),
                    'greek-ext'    => __( 'Greek Extended', 'yit' ),
                    'khmer'        => __( 'Khmer', 'yit' ),
                    'vietnamese'   => __( 'Vietnamese', 'yit' )
                ),
            )
        );
    }
}