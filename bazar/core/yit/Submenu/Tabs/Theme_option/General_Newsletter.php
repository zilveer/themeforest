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
 * Class to print fields in the tab General -> Newsletter
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_General_Newsletter extends YIT_Submenu_Tabs_Abstract {
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
                'id' => 'newsletter-action',
                'type' => 'text',
                'name' => __( 'Form action', 'yit' ),
                'desc' => __( 'The attribute "action" of the form.', 'yit' ),
                'std' => apply_filters( 'yit_newsletter-action_std', '' )
            ),
            20 => array(
                'id' => 'newsletter-request',
                'type' => 'select',
                'options' => array(
                    'post' => 'POST',
                    'get' => 'GET'
                ),
                'name' => __( 'Request method', 'yit' ),
                'desc' => __( 'The attribute "method" of the form.', 'yit' ),
                'std' => apply_filters( 'yit_newsletter-method_std', 'post' )
            ),
            30 => array(
                'id' => 'newsletter-email-label',
                'type' => 'text',
                'desc' => '',
                'name' => __( 'Email field label', 'yit' ),
                'std' => apply_filters( 'yit_newsletter-email-label_std', __( 'Email', 'yit' ) )
            ),
            40 => array(
                'id' => 'newsletter-email-name',
                'type' => 'text',
                'name' => __( 'Email "name"', 'yit' ),
                'desc' => __( 'The attribute "name" of the email address field.<br><small>( NOTE: Mailchimp needs this attribute "EMAIL" uppercased )</small>', 'yit' ),
                'std' => apply_filters( 'yit_newsletter-email-name_std', '' )
            ),
            50 => array(
                'id' => 'newsletter-submit-label',
                'type' => 'text',
                'name' => __( 'Submit button label', 'yit' ),
                'desc' => __( 'This field is not always used. Depends on the style of the form.', 'yit' ),
                'std' => apply_filters( 'yit_newsletter-submit-label_std', '' )
            ),
            60 => array(
                'id' => 'newsletter-hidden',
                'type' => 'text',
                'name' => __( 'Hidden fiels', 'yit' ),
                'desc' => __( 'Type here all hidden fields names and values in serializate way. Example: <strong>name1=value1&amp;name2=value2</strong>.', 'yit' ),
                'std' => apply_filters( 'yit_newsletter-hidden_std', '' )
            ),
        );
    }
}