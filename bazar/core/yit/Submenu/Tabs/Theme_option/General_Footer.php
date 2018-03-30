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
 * Class to print fields in the tab General -> Footer
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_General_Footer extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_general_footer
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
        	/* === START FOOTER TYPE === */            
            10 => array(
                'id'      => 'footer-type',
                'type'    => 'select',
                'name'    => __( 'Footer type', 'yit' ),
                'desc'    => __( 'Select the footer type for the theme.', 'yit' ),
                'options' => apply_filters( 'yit_footer-type_options', array(
                    'normal'     => __( 'Two Columns Footer', 'yit' ),
                    'centered' => __( 'Centered Footer', 'yit' ),
                    'big-normal'     => __( 'Big Footer + Two Columns', 'yit' ),
                    'big-centered' => __( 'Big Footer + Centered', 'yit' )
                ) ),
                'std'     => apply_filters( 'yit_footer-type_std', 'normal' )
            ),
            /* === END FOOTER TYPE === */
            /* === START BIG FOOTER === */            
            20 => array(
                'id'      => 'footer-rows',
                'type'    => 'slider',
                'name'    => __( 'Footer rows', 'yit' ),
                'desc'    => __( 'Select the number of widget area you\'d like to use. Note: It will work only if you\'ve chosen one of Big Footer types above.', 'yit' ),
                'min'     => 1,
                'max'     => 4,
                'step'    => 1,
                'std'     => 1,
                'deps'    => array(
					'ids' => 'footer-type',
					'values' => 'big-normal,big-centered'
				)
            ),
            /* === END BIG FOOTER === */
            /* === START WIDGET NUMBER === */            
            30 => array(
                'id'      => 'footer-columns',
                'type'    => 'slider',
                'name'    => __( 'Widgets in each footer row', 'yit' ),
                'desc'    => __( 'Select the number of widget you\'d like to use in each footer widget area. Note: It will work only if you\'ve chosen one of Big Footer types above.', 'yit' ),
                'min'     => 1,
                'max'     => 4,
                'step'    => 1,
                'std'     => 1,
                'deps'    => array(
					'ids' => 'footer-type',
					'values' => 'big-normal,big-centered'
				)
            ),
            /* === END WIDGET NUMBER === */
            /* === START FOOTER TEXT === */ 
            40 => array(
                'id' => 'footer-center-text',
                'type' => 'textarea',
                'name' => __( 'Footer centered text', 'yit' ),
                'desc' => __( 'Enter text used in centered footer. It can be HTML.', 'yit' ),
                'std' => '',
                'deps' => apply_filters( 'yit_footer-centered-text_deps', array(
                    'ids' => 'footer-type',
                    'values' => 'centered,big-centered'
                ) )
            ),
            50 => array(
                'id' => 'footer-left-text',
                'type' => 'textarea',
                'name' => __( 'Footer copyright text Left', 'yit' ),
                'desc' => __( 'Enter text used in the left side of the footer. It can be HTML. NB: not figured on "centered footer"', 'yit' ),
                'std' => 'Copyright <a href="%site_url%"><strong>%site_name%</strong></a> 2016',
                'deps' => apply_filters( 'yit_footer-left-text_deps', array(
                    'ids' => 'footer-type',
                    'values' => 'normal,big-normal'
                ) )
            ),
            60 => array(
                'id' => 'footer-right-text',
                'type' => 'textarea',
                'name' => __( 'Footer copyright text Right', 'yit' ),
                'desc' => __( 'Enter text used in the right side of the footer. It can be HTML. NB: not figured on "centered footer"', 'yit' ),
                'std' => '<a href="http://yithemes.com/" rel="nofollow"><img src="http://yithemes.com/cdn/images/various/footer_yith_grey.png" alt="Your Inspiration Themes" style="position:relative; top:9px; margin: -11px 5px 0 0;" /></a> Powered by <a href="http://yithemes.com/" title="free themes wordpress"><strong>Your Inspiration Themes</strong></a>',
                'deps' => apply_filters( 'yit_footer-right-text_deps', array(
                    'ids' => 'footer-type',
                    'values' => 'normal,big-normal'
                ) )
            ),
            /* === END FOOTER TEXT === */
        );
    }
}