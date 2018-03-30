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
 * Class to print fields in the tab General -> Settings
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_General_Integration extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_general_integration
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
        	/* === START LOGO === */
            10 => array(
                'id'   => 'tabs-sep',
                'type' => 'title',
                'name' => __('Twitter API Configuration', 'yit'),
                'desc' => __('Insert your Twitter API created from <a href="https://dev.twitter.com/apps">https://dev.twitter.com/apps</a>', 'yit')
            ),
            20 => array(
                'id'   => 'twitter-username',
                'type' => 'text',
                'name' => __( 'Twitter Username', 'yit' ),
                'desc' => __( 'Enter the username of Twitter.', 'yit' ),
            ),
            30 => array(
                'id'   => 'twitter-consumer-key',
                'type' => 'text',
                'name' => __( 'Twitter Consumer key', 'yit' ),
                'desc' => __( 'Enter the Consumer key of Twitter.', 'yit' ),
            ),
            40 => array(
                'id'   => 'twitter-consumer-secret',
                'type' => 'text',
                'name' => __( 'Twitter Consumer secret', 'yit' ),
                'desc' => __( 'Enter the Consumer secret of Twitter.', 'yit' ),
            ),
            50 => array(
                'id'   => 'twitter-access-token',
                'type' => 'text',
                'name' => __( 'Twitter Access Token', 'yit' ),
                'desc' => __( 'Enter the Access Token of Twitter.', 'yit' ),
            ),
            60 => array(
                'id'   => 'twitter-access-token-secret',
                'type' => 'text',
                'name' => __( 'Twitter Access Token secret', 'yit' ),
                'desc' => __( 'Enter the Access Token secret of Twitter.', 'yit' ),
            ),
            70 => array(
                'id'   => 'open-graph-title',
                'type' => 'title',
                'name' => __('Open Graph', 'yit'),
            ),
            80 => array(
                'id'   => 'enable-open-graph',
                'type' => 'onoff',
                'name' => __( 'Enable Open Graph', 'yit' ),
                'desc' => __('Enable open graph or use your own plugin.', 'yit'),
                'std'  => true
            ),

        );
    }
}