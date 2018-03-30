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
class YIT_Submenu_Tabs_Theme_option_Popup_Newsletter extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_general_settings
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
		$config = YIT_Config::load();
	
        return array( 
			10 => array(
                'id'   => 'popup_news_url',
                'type' => 'text',
                'name' => __('Newsletter subscribe URL', 'yit'),
                'desc' => __( 'The Newsletter subscribe url', 'yit' ),
                'std'  => '',
            ),
			20 => array(
                'id'   => 'popup_news_email',
                'type' => 'text',
                'name' => __( 'Email "name"', 'yit' ),
                'desc' => __( 'The attribute "name" of the email address field.<br><small>( NOTE: Mailchimp needs this attribute "EMAIL" uppercased )</small>', 'yit' ),
                'std'  => 'email',
            ),
			30 => array(
                'id'   => 'popup_email_icon',
                'type' => 'selecticon',
                'name' => __('Email icon', 'yit'),
                'desc' => __( 'Select an email icon', 'yit' ),
                'options'  => 	$config['awesome_icons'],
				'std' => "icon-envelope",
            ),
			40 => array(
                'id'   => 'popup_news_email_label',
                'type' => 'text',
                'name' => __( 'Email field label', 'yit' ),
                'desc' => '',
                'std'  => __( 'Enter your mail address...', 'yit' ),
            ),
			50 => array(
                'id'   => 'popup_submit_text',
                'type' => 'text',
                'name' => __( 'Submit button label', 'yit' ),
                'desc' => __( 'Submit button label', 'yit' ),
                'std'  => 'ADD ME TO MAILING LIST',
            ),
			60 => array(
                'id'   => 'popup_hidden_fields',
                'type' => 'text',
                'name' => __('Hidden fields', 'yit'),
                'desc' => __( 'Type here all hidden fields names and values in serializate way. Example: <strong>name1=value1&amp;name2=value2</strong>.', 'yit' ),
                'std'  => '',
            ),
			70 => array(
                'id'   => 'popup_method',
                'type' => 'select',
                'name' => __( 'Request method', 'yit' ),
                'desc' => __( 'The attribute "method" of the form.', 'yit' ),
                'options'  => 	array(
					'post' => __('POST', 'yit'),
					'get' => __('GET', 'yit')
				),
				'std' => "post",
            ),
        );
    }
}