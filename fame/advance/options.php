<?php

/*
 * TYPES:
 * fieldset
 * radio
 * wp_dropdown_galleries
 * input
 * textarea
 * color
 * upload
 * select
 * slider
 * social
 *
 * */

	function apollo13_settings_options(){

		$opt = array(
            array(
                'name' => __be( 'Front page' ),
                'type' => 'fieldset',
                'default' => 1,
                'id' => 'fieldset_front_page',
                'help' => '#!/what_to_show_on_front_page'
            ),
            array(
                'name' => __be( 'What to show on front page?' ),
                'desc' => __be( 'If you choose <strong>Page</strong> then make sure that in Settings->Reading->Front page displays'
                                . ' you selected <strong>A static page</strong>, that you wish to use.<br />' ),

                'id' => 'fp_variant',
                'default' => 'page',
                'options' => array(
                    'page'          => __be( 'Page' ),
                    'blog'          => __be( 'Blog' ),
                    'works_list'    => __be( 'Works list' ),
                    'galleries_list'    => __be( 'Galleries list' ),
                    'gallery'       => __be( 'Selected gallery' ),
                ),
                'type' => 'select',
            ),
            array(
                'name' => __be( 'Select gallery to use as front page' ),
                'desc' => '',
                'id' => 'fp_gallery',
                'default' => '',
                'type' => 'wp_dropdown_galleries',
            ),


			array(
				'name' => __be( 'Woocommerce theme settings' ),
				'type' => 'fieldset',
                'default' => 1,
                'id' => 'fieldset_woocommerce'
			),
			array(
				'name' => __be( 'Search in products instead of pages' ),
				'desc' => __be( 'It will change wordpress default search function to make shop search. So when this is activated search function in header or serach widget will act as woocommerece search widget.' ),
				'id' => 'shop_search',
				'default' => 'off',
				'options' => array(
					'on'    => __be( 'On' ),
					'off'   => __be( 'Off' ),
				),
				'type' => 'radio',
			),



			array(
				'name' => __be( 'Google Analytics' ),
				'type' => 'fieldset',
                'default' => 1,
                'id' => 'fieldset_google_anal'
			),
			array(
				'name' => __be( 'Enter code here from GA here:' ),
                'desc' => __be( 'Enter whole code that beggins with <code>&lt;script type="text/javascript"&gt;</code> and ends with <code>&lt;/script&gt;</code>.' ),
				'id' => 'ga_code',
				'default' => '',
				'type' => 'textarea',
			),
		);

		return $opt;
	}

	function apollo13_appearance_options(){
        $cursors = array();
        $dir = A13_TPL_GFX_DIR.'/cursors';
        if( is_dir( $dir ) ) {
            //The GLOB_BRACE flag is not available on some non GNU systems, like Solaris. So we use merge:-)
            foreach ( (array)glob($dir.'/*.png') as $file ){
                $cursors[ basename($file) ] = basename($file);
            }
        }

		$opt = array(
            array(
                'name' => __be( 'Main Settings' ),
                'type' => 'fieldset',
                'default' => 0,
                'id' => 'fieldset_main_app_settings',
                'help' => '#!/main_appearance_settings'
            ),
            array(
                'name' => __be( 'Layout style' ),
                'desc' => __be( 'It affects layout in wide resolutions.' ),
                'id' => 'layout_style',
                'default' => 'wide',
                'options' => array(
                    'narrow' => __be( 'Narrow' ),
                    'wide' => __be( 'Wide' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Predefined colors' ),
                'desc' => __be( 'It changes colors of various links, buttons and interactive elements. Some of these can be overwritten with other settings.' ),
                'id' => 'predefined_colors',
                'default' => '#3498db',
                'options' => array(
                    'custom'        => __be( 'Custom color' ),
                    '#d3ac13'       => __be( 'Default' ),
                    '#27ae60'       => __be( 'Green' ),
                    '#1abc9c'       => __be( 'Green (Turquoise)' ),
                    '#3498db'       => __be( 'Blue' ),
                    '#475577'       => __be( 'Dark Blue' ),
                    '#9365B8'       => __be( 'Violet' ),
                    '#f39c12'       => __be( 'Orange' ),
                    '#e67e22'       => __be( 'Carrot' ),
                    '#e74c3c'       => __be( 'Red' ),
                    '#75706B'       => __be( 'Iron Grey' ),
                    '#A38F84'       => __be( 'Light Brown' ),
                ),
                'type' => 'select',
                'switch' => true,
            ),
            array(
                'name' => 'custom',
                'type' => 'switch-group'
            ),
            array(
                'name' => __be( 'Custom color' ),
                'desc' => '',
                'id' => 'predefined_color_custom',
                'default' => '',
                'type' => 'color'
            ),
            array(
                /*'name' => 'custom',*/
                'type' => 'switch-group-end'
            ),
            array(
                /*'id' => 'predefined_colors',  just for readability */
                'type' => 'end-switch',
            ),
            array(
                'name' => __be( 'Favicon' ),
                'desc' =>__be( 'Enter an URL or upload an image for favicon. It will appear in adress bar or on tab in browser. Image should be square (16x16px or 32x32px). Paste the full URL (include <code>http://</code>).' ),
                'id' => 'favicon',
                'default' => get_template_directory_uri().'/images/defaults/favicon.png',
                'button_text' => __be('Upload/Select Image'),
                'media_button_text' => __be('Insert favicon'),
                'type' => 'upload'
            ),
            array(
                'name' => __be( 'Custom background image' ),
                'desc' =>__be( 'Enter an URL or upload an image for background. Paste the full URL (include <code>http://</code>).' ),
                'id' => 'body_image',
                'default' => '',
                'button_text' => __be('Upload/Select Image'),
                'type' => 'upload'
            ),
            array(
                'name' => __be( 'How to fit background image' ),
                'desc' => __be( 'In Internet Explorer 8 and lower whatever you will choose(except <em>repeat</em>) it will look like "Just center"' ),
                'id' => 'body_image_fit',
                'default' => 'cover',
                'options' => array(
                    'cover'     => __be( 'Cover' ),
                    'contain'   => __be( 'Contain' ),
                    'fitV'      => __be( 'Fit Vertically' ),
                    'fitH'      => __be( 'Fit Horizontally' ),
                    'center'    => __be( 'Just center' ),
                    'repeat'    => __be( 'Repeat' ),
                ),
                'type' => 'select',
            ),
            array(
                'name' => __be( 'Background color' ),
                'desc' => '',
                'id' => 'body_bg_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Background attachment' ),
                'desc' => '',
                'id' => 'body_bg_attachment',
                'default' => 'fixed',
                'options' => array(
                    'fixed' => __be( 'fixed' ),
                    'scroll' => __be( 'scroll' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Mouse cursor' ),
                'desc' => '',
                'id' => 'custom_cursor',
                'default' => 'default',
                'options' => array(
                    'default' => __be( 'Use normal' ),
                    'select'  => __be( 'Use one of predefined' ),
                    'custom' => __be( 'Use custom' ),
                ),
                'type' => 'radio',
                'switch' => true,
            ),
            array(
                'name' => 'select',
                'type' => 'switch-group'
            ),
            array(
                'name' => __be( 'Cursors' ),
                'desc' => '',
                'id' => 'cursor_select',
                'default' => 'empty_black_white.png',
                'options' => $cursors,
                'type' => 'select',
            ),
            array(
                /*'name' => 'select',*/
                'type' => 'switch-group-end'
            ),
            array(
                'name' => 'custom',
                'type' => 'switch-group'
            ),
            array(
                'name' => __be( 'Custom cursor image' ),
                'desc' =>__be( 'Enter an URL or upload an image for cursor. Paste the full URL (include <code>http://</code>).' ),
                'id' => 'cursor_image',
                'default' => '',
                'button_text' => __be('Upload/Select Image'),
                'media_button_text' => __be('Insert cursor'),
                'type' => 'upload'
            ),
            array(
                /*'name' => 'custom',*/
                'type' => 'switch-group-end'
            ),
            array(
                /*'id' => 'custom_cursor',  just for readability */
                'type' => 'end-switch',
            ),



            array(
                'name' => __be( 'Page preloader' ),
                'type' => 'fieldset',
                'default' => 0,
                'id' => 'fieldset_page_preloader',
            ),
            array(
                'name' => __be( 'Page preloader' ),
                'desc' => __be( 'CSS animations used in preloader works best in modern browsers.' ),
                'id' => 'preloader',
                'default' => 'on',
                'type' => 'radio',
                'options' => array(
                    'on' => __be( 'On' ),
                    'off'    => __be( 'Turn it off' ),
                ),
                'switch' => true,
            ),
            array(
                'name' => 'on',
                'type' => 'switch-group'
            ),
			array(
				'name' =>  a13__be( 'Hide event' ),
				'desc' =>  a13__be( '<strong>On load</strong> is called when whole site with all images are loaded, what can take lot of time on heavier sites, and even more on mobile. Also it can sometimes hang and never hide, when there is problem with some resource. <br /><strong>On DOM ready</strong> is called when whole HTML with CSS is loaded, so after preloader will hide, you can still see loading images.' ),
				'id' => 'preloader_hide_event',
				'default' => 'ready',
				'type' => 'radio',
				'options' => array(
					'load' =>  a13__be( 'On load' ),
					'ready'    =>  a13__be( 'On DOM ready' ),
				),
			),
			array(
                'name' => __be( 'Background color' ),
                'desc' =>'',
                'id' => 'preloader_bg_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Type' ),
                'desc' => '',
                'id' => 'preloader_type',
                'default' => 'indicator',
                'options' => array(
                    'none' => __be( 'none' ),
                    'atom' => __be( 'Atom' ),
                    'flash' => __be( 'Flash' ),
                    'indicator' => __be( 'Indicator' ),
                    'radar' => __be( 'Radar' ),
                ),
                'type' => 'select',
            ),
            array(
                'name' => __be( 'Animation color' ),
                'desc' =>'',
                'id' => 'preloader_color',
                'default' => '#2299dd',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Loading text' ),
                'desc' => '',
                'id' => 'preloader_text',
                'default' => 'Loading site contents, please don\'t hold your breath :-)',
                'type' => 'input'
            ),
            array(
                'name' => __be( 'Text color' ),
                'desc' =>'',
                'id' => 'preloader_text_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Font size' ),
                'desc' => '',
                'id' => 'preloader_font_size',
                'default' => '20px',
                'unit' => 'px',
                'type' => 'slider'
            ),
            array(
                'name' => __be( 'Font weight' ),
                'desc' => '',
                'id' => 'preloader_text_weight',
                'default' => 'normal',
                'options' => array(
                    'normal' => __be( 'Normal' ),
                    'bold' => __be( 'Bold' ),
                ),
                'type' => 'radio',
            ),
            array(
                /*'name' => 'on',*/
                'type' => 'switch-group-end'
            ),
            array(
                /*'id' => 'preloader',  just for readability */
                'type' => 'end-switch',
            ),



            array(
                'name' => __be( 'Logo' ),
                'type' => 'fieldset',
                'default' => 0,
                'id' => 'fieldset_logo_settings',
                'help' => '#!/customize_logo'
            ),
            array(
                'name' => __be( 'Logo type' ),
                'desc' => '',
                'id' => 'logo_type',
                'default' => 'image',
                'options' => array(
                    'image' => __be( 'Image' ),
                    'text' => __be( 'Text' ),
                ),
                'type' => 'radio',
                'switch' => true,
            ),
            array(
                'name' => 'image',
                'type' => 'switch-group'
            ),
            array(
                'name' => __be( 'Logo image' ),
                'desc' => __be( 'Upload an image for logo.' ),
                'id' => 'logo_image',
                'default' => get_template_directory_uri().'/images/defaults/logo.png',
                'button_text' => __be('Upload/Select Image'),
                'media_button_text' => __be('Insert logo'),
                'type' => 'upload'
            ),
            array(
                'name' => __be( 'Logo image for HIGH DPI screen' ),
                'desc' => __be( 'For example Retina(iPhone/iPad) screen is HIGH DPI.' ).' '. __be( 'Upload an image for logo.' ),
                'id' => 'logo_image_high_dpi',
                'default' => get_template_directory_uri().'/images/defaults/logo@2x.png',
                'button_text' => __be('Upload/Select Image'),
                'media_button_text' => __be('Insert logo'),
                'type' => 'upload'
            ),
            array(
                'name' => 'HIGH DPI logo sizes',
                'desc' => '',
                'id' => 'logo_image_high_dpi_sizes',
                'default' => '224|86',
                'type' => 'hidden'
            ),
            array(
                'name' => __be( 'Logo hover opacity' ),
                'desc' => '',
                'id' => 'logo_image_opacity',
                'default' => '40%',
                'unit' => '%',
                'min' => 0,
                'max' => 100,
                'type' => 'slider'
            ),
            array(
                /*'name' => 'image',*/
                'type' => 'switch-group-end'
            ),
            array(
                'name' => 'text',
                'type' => 'switch-group'
            ),
            array(
                'name' => __be( 'Text in your logo' ),
                'desc' => __be( 'If you use more then one word in logo, then you might want to use <code>&amp;nbsp;</code> instead of white space, so words wont break in many lines.' ),
                'id' => 'logo_text',
                'default' => 'Fame',
                'type' => 'input'
            ),
            array(
                'name' => __be( 'Logo text color' ),
                'desc' =>'',
                'id' => 'logo_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Logo hover text color' ),
                'desc' =>'',
                'id' => 'logo_color_hover',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Logo font size' ),
                'desc' => '',
                'id' => 'logo_font_size',
                'default' => '26px',
                'unit' => 'px',
                'type' => 'slider'
            ),
            array(
                'name' => __be( 'Logo font weight' ),
                'desc' => '',
                'id' => 'logo_weight',
                'default' => 'normal',
                'options' => array(
                    'normal' => __be( 'Normal' ),
                    'bold' => __be( 'Bold' ),
                ),
                'type' => 'radio',
            ),
            array(
                /*'name' => 'text',*/
                'type' => 'switch-group-end'
            ),
            array(
                /*'id' => 'logo_type',  just for readability */
                'type' => 'end-switch',
            ),
            array(
                'name' => __be( 'Logo top/bottom padding' ),
                'desc' => '',
                'id' => 'logo_padding',
                'default' => '',
                'unit' => 'px',
                'min' => 0,
                'max' => 50,
                'type' => 'slider'
            ),



            array(
                'name' => __be( 'Buttons' ),
                'type' => 'fieldset',
                'default' => 0,
                'id' => 'fieldset_buttons_settings',
            ),
            array(
                'name' => __be( 'Button background color' ),
                'desc' => '',
                'id' => 'button_bg_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Button border color' ),
                'desc' => '',
                'id' => 'button_border_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Button text color' ),
                'desc' => '',
                'id' => 'button_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Button hover background color' ),
                'desc' => '',
                'id' => 'button_hover_bg_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Button hover border color' ),
                'desc' => '',
                'id' => 'button_hover_border_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Button hover text color' ),
                'desc' => '',
                'id' => 'button_hover_color',
                'default' => '',
                'type' => 'color'
            ),



            array(
                'name' => __be( 'Header - Top Bar' ),
                'type' => 'fieldset',
                'default' => 0,
                'id' => 'fieldset_header_top_bar'
            ),
            array(
                'name' => __be( 'Top bar of header' ),
                'desc' => '',
                'id' => 'header_top_bar',
                'default' => 'on',
                'options' => array(
                    'on' => __be( 'Enable' ),
                    'off' => __be( 'Disable' ),
                ),
                'type' => 'radio',
                'switch' => true,
            ),
            array(
                'name' => 'on',
                'type' => 'switch-group'
            ),
            array(
                'name' => __be( 'Background color' ),
                'desc' => '',
                'id' => 'top_bar_bgcolor',
                'default' => '',
                'type' => 'color',
            ),
            array(
                'name' => __be( 'Text color' ),
                'desc' => __be( 'Text in message/cookie info.' ),
                'id' => 'top_bar_text_color',
                'default' => '',
                'type' => 'color',
            ),
            array(
                'name' => __be( 'Title color' ),
                'desc' => __be( 'Title in message/cookie info.' ),
                'id' => 'top_bar_title_color',
                'default' => '',
                'type' => 'color',
            ),
            array(
                'name' => __be( 'Links color' ),
                'desc' => __be( 'Links in message/cookie info.' ),
                'id' => 'top_bar_link_color',
                'default' => '',
                'type' => 'color',
            ),
            array(
                'name' => __be( 'Links hover color' ),
                'desc' => __be( 'Links in message/cookie info.' ),
                'id' => 'top_bar_link_hover_color',
                'default' => '',
                'type' => 'color',
            ),
            array(
                'name' => __be( 'Line color' ),
                'desc' => __be( 'Line at end of message/cookie info.' ),
                'id' => 'top_bar_line_color',
                'default' => '',
                'type' => 'color',
            ),
            array(
                'name' => __be( 'Options color' ),
                'desc' => '',
                'id' => 'top_bar_option_color',
                'default' => '',
                'type' => 'color',
            ),
            array(
                'name' => __be( 'Options hover color' ),
                'desc' => '',
                'id' => 'top_bar_option_hover_color',
                'default' => '',
                'type' => 'color',
            ),
            array(
                'name' => __be( 'Options highlight color' ),
                'desc' => '',
                'id' => 'top_bar_option_hl_color',
                'default' => '',
                'type' => 'color',
            ),
            array(
                'name' => __be( 'Sub-options background color' ),
                'desc' => '',
                'id' => 'top_bar_sub_option_bgcolor',
                'default' => '',
                'type' => 'color',
            ),
            array(
                'name' => __be( 'Sub-options hover background color' ),
                'desc' => '',
                'id' => 'top_bar_sub_option_hover_bgcolor',
                'default' => '',
                'type' => 'color',
            ),
            array(
                'name' => __be( 'Sub-options separator color' ),
                'desc' => '',
                'id' => 'top_bar_sub_sep_color',
                'default' => '',
                'type' => 'color',
            ),
            array(
                'name' => __be( 'Options font weight' ),
                'desc' => '',
                'id' => 'top_bar_option_weight',
                'default' => 'bold',
                'options' => array(
                    'normal' => __be( 'Normal' ),
                    'bold' => __be( 'Bold' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Options text transform' ),
                'desc' => '',
                'id' => 'top_bar_option_transform',
                'default' => 'uppercase',
                'options' => array(
                    'none' => __be( 'None' ),
                    'uppercase' => __be( 'Uppercase' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Top bar message' ),
                'desc' => '',
                'id' => 'header_top_message',
                'default' => 'off',
                'options' => array(
                    'on' => __be( 'Enable' ),
                    'off' => __be( 'Disable' ),
                ),
                'type' => 'radio',
                'switch' => true,
            ),
            array(
                'name' => 'on',
                'type' => 'switch-group'
            ),
            array(
                'name' => __be( 'Message menu link' ),
                'desc' => '',
                'id' => 'top_bar_title',
                'default' => '',
                'type' => 'input',
            ),
            array(
                'name' => __be( 'Message text' ),
                'desc' => __be( 'You can use HTML here.' ),
                'id' => 'top_bar_text',
                'default' => '',
                'type' => 'textarea',
            ),
            array(
                'name' => __be( 'New message?' ),
                'desc' => __be( 'Click button so it will create new cookie for this message. If user hidden previous message and you want it to be visible on load, then this is option for you;-). You still need to save changes to make it work.' ),
                'id' => 'top_bar_new_message',
                'default' => 'some_rand_string',
                'button_text' => __be('Reset cookie'),
                'type' => 'special_button',
            ),
            array(
                'name' => __be( 'Visible on load?' ),
                'desc' => '',
                'id' => 'top_bar_msg_visible',
                'default' => '0',
                'options' => array(
                    '1' => __be( 'Yes' ),
                    '0' => __be( 'No' ),
                ),
                'type' => 'radio',
            ),
            array(
                /*'name' => 'on',*/
                'type' => 'switch-group-end'
            ),
            array(
                /*'id' => 'header_top_message',  just for readability */
                'type' => 'end-switch',
            ),
            array(
                'name' => __be( 'Top bar cookie info' ),
                'desc' => '',
                'id' => 'header_top_cookie',
                'default' => 'on',
                'options' => array(
                    'on' => __be( 'Enable' ),
                    'off' => __be( 'Disable' ),
                ),
                'type' => 'radio',
                'switch' => true,
            ),
            array(
                'name' => 'on',
                'type' => 'switch-group'
            ),
            array(
                'name' => __be( 'Cookies text' ),
                'desc' => __be( 'You can use HTML here.' ),
                'id' => 'top_bar_cookie_text',
                'default' => '<h1>Do you like cookies?</h1>
We have placed cookies on your computer to help make this website better. <br />
<b>This message will not appear again when you close it!</b> You can also disable this message in the admin panel.',
                'type' => 'textarea',
            ),
            array(
                /*'name' => 'on',*/
                'type' => 'switch-group-end'
            ),
            array(
                /*'id' => 'header_top_cookie',  just for readability */
                'type' => 'end-switch',
            ),

            array(
                'name' => __be( 'Options links right side' ),
                'desc' => '',
                'id' => 'top_bar_right_options',
                'default' => 'woo',
                'options' => array(
                    'woo' => __be( 'Use woocommerce links(if activated)' ),
                    'menu' => sprintf(__be( 'Use menu from <em>%s</em> position.' ), __be('Alternative short top menu' )),
                ),
                'type' => 'radio',
            ),

            array(
                /*'name' => 'on',*/
                'type' => 'switch-group-end'
            ),
            array(
                /*'id' => 'header_top_bar',  just for readability */
                'type' => 'end-switch',
            ),



            array(
                'name' => __be( 'Header - Main Settings' ),
                'type' => 'fieldset',
                'default' => 0,
                'id' => 'fieldset_header_app'
            ),
            array(
                'name' => __be( 'Header variant' ),
                'desc' => '',
                'id' => 'header_style',
                'default' => 'centered-logo',
                'options' => array(
                    'normal' => __be( 'Variant 1(logo left, menu below)' ),
                    'centered-logo' => __be( 'Variant 2(logo centered)' ),
                    'centered' => __be( 'Variant 3(everything centered)' ),
                    'one-line' => __be( 'Variant 4(one line, no socials)' ),
                ),
                'type' => 'select',
            ),
            array(
                'name' => __be( 'Background color' ),
                'desc' =>'',
                'id' => 'header_bg_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Custom background image' ),
                'desc' =>__be( 'Enter an URL or upload an image for background. Paste the full URL (include <code>http://</code>).' ),
                'id' => 'header_bg_image',
                'default' => '',
                'button_text' => __be('Upload/Select Image'),
                'type' => 'upload'
            ),
            array(
                'name' => __be( 'How to fit background image' ),
                'desc' => __be( 'In Internet Explorer 8 and lower whatever you will choose(except <em>repeat</em>) it will look like "Just center"' ),
                'id' => 'header_bg_fit',
                'default' => 'cover',
                'options' => array(
                    'cover'     => __be( 'Cover' ),
                    'contain'   => __be( 'Contain' ),
                    'fitV'      => __be( 'Fit Vertically' ),
                    'fitH'      => __be( 'Fit Horizontally' ),
                    'center'    => __be( 'Just center' ),
                    'repeat'    => __be( 'Repeat' ),
                ),
                'type' => 'select',
            ),
            array(
                'name' => __be( 'Fixed header' ),
                'desc' => __be( 'If enabled, header will remain fixed while scrolling page.' ),
                'id' => 'fixed_header',
                'default' => 'on',
                'options' => array(
                    'on' => __be( 'Enable' ),
                    'off' => __be( 'Disable' ),
                ),
                'type' => 'radio',
                'switch' => true,
            ),
            array(
                'name' => 'on',
                'type' => 'switch-group'
            ),
            array(
                'name' => __be( 'Fixed header background color' ),
                'desc' =>__be( 'By default fixed header will inherit normal header background color, but if set <strong>Menu bar background color</strong> it will be used instead. If none of this colors works well with your fixed header, use this option to set it proper:-)' ),
                'id' => 'fixed_header_bg_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                /*'name' => 'on',*/
                'type' => 'switch-group-end'
            ),
            array(
                /*'id' => 'fixed_header',  just for readability */
                'type' => 'end-switch',
            ),

            array(
                'name' => __be( 'Lines color' ),
                'desc' => __be( 'Line above menu, border of cart and border of search.' ),
                'id' => 'header_lines_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Icons color' ),
                'desc' => __be( 'Empty cart and search.' ),
                'id' => 'header_icons_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Switch on/off header search form' ),
                'desc' => '',
                'id' => 'header_search',
                'default' => 'on',
                'options' => array(
                    'on' => __be( 'Enable' ),
                    'off' => __be( 'Disable' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Theme social icons' ),
                'desc' => '',
                'id' => 'header_socials',
                'default' => 'on',
                'options' => array(
                    'on' => __be( 'Enable' ),
                    'off' => __be( 'Disable' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Social icons color' ),
                'desc' => '',
                'id' => 'header_socials_color',
                'default' => 'light-bg',
                'options' => array(
                    'dark-bg'   => __be( 'White' ),
                    'light-bg'  => __be( 'Black' ),
                ),
                'type' => 'radio',
            ),



            array(
                'name' => __be( 'Header - Menu' ),
                'type' => 'fieldset',
                'default' => 0,
                'id' => 'fieldset_header_menu_app'
            ),
            array(
                'name' => __be( 'Menu bar background color' ),
                'desc' => __be( 'It will have no effect in Variant 3 of header.' ),
                'id' => 'menu_bg_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Menu Top Border' ),
                'desc' => '',
                'id' => 'menu_top_border',
                'default' => 'on',
                'options' => array(
                    'on' => __be( 'Enable' ),
                    'off' => __be( 'Disable' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Menu main links font size' ),
                'desc' => '',
                'id' => 'menu_font_size',
                'default' => '',
                'unit' => 'px',
                'min' => 10,
                'max' => 30,
                'type' => 'slider'
            ),
            array(
                'name' => __be( 'Menu main links side padding' ),
                'desc' => '',
                'id' => 'menu_element_padding',
                'default' => '',
                'unit' => 'px',
                'min' => 0,
                'max' => 50,
                'type' => 'slider'
            ),
            array(
                'name' => __be( 'Menu links color' ),
                'desc' =>'',
                'id' => 'menu_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Menu links hover/active color' ),
                'desc' =>'',
                'id' => 'menu_hover_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Menu font weight' ),
                'desc' => '',
                'id' => 'menu_weight',
                'default' => 'normal',
                'options' => array(
                    'normal' => __be( 'Normal' ),
                    'bold' => __be( 'Bold' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Menu text transform' ),
                'desc' => '',
                'id' => 'menu_transform',
                'default' => 'uppercase',
                'options' => array(
                    'none' => __be( 'None' ),
                    'uppercase' => __be( 'Uppercase' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Submenu/mega menu links color' ),
                'desc' =>'',
                'id' => 'submenu_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Submenu/mega menu links hover/active color' ),
                'desc' =>'',
                'id' => 'submenu_hover_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Submenu/mega menu background color' ),
                'desc' =>'',
                'id' => 'submenu_bg_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Submenu/mega menu hover/active background color' ),
                'desc' =>'',
                'id' => 'submenu_hover_bg_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Submenu/mega menu separator color' ),
                'desc' =>'',
                'id' => 'submenu_sep_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Submenu/mega menu links font size' ),
                'desc' => '',
                'id' => 'submenu_font_size',
                'default' => '',
                'unit' => 'px',
                'type' => 'slider'
            ),
            array(
                'name' => __be( 'Submenu/mega menu font weight' ),
                'desc' => '',
                'id' => 'submenu_weight',
                'default' => 'normal',
                'options' => array(
                    'normal' => __be( 'Normal' ),
                    'bold' => __be( 'Bold' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Submenu/mega menu text transform' ),
                'desc' => '',
                'id' => 'submenu_transform',
                'default' => 'none',
                'options' => array(
                    'none' => __be( 'None' ),
                    'uppercase' => __be( 'Uppercase' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Mega menu group title font size' ),
                'desc' => '',
                'id' => 'mm_group_font_size',
                'default' => '16px',
                'unit' => 'px',
                'min' => 10,
                'max' => 30,
                'type' => 'slider'
            ),
            array(
                'name' => __be( 'Custom label color' ),
                'desc' =>'',
                'id' => 'menu_label_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Custom label submenu color' ),
                'desc' =>'',
                'id' => 'submenu_label_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Menu Item Bottom Line' ),
                'desc' => '',
                'id' => 'menu_bottom_line',
                'default' => 'on',
                'options' => array(
                    'on' => __be( 'Enable' ),
                    'off' => __be( 'Disable' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Submenu/mega menu Top Line' ),
                'desc' => '',
                'id' => 'submenu_top_line',
                'default' => 'on',
                'options' => array(
                    'on' => __be( 'Enable' ),
                    'off' => __be( 'Disable' ),
                ),
                'type' => 'radio',
            ),



            array(
                'name' => __be( 'Title Bar' ),
                'type' => 'fieldset',
                'default' => 0,
                'id' => 'fieldset_title_bar'
            ),
            array(
                'name' => __be( 'Variant' ),
                'desc' => '',
                'id' => 'title_bar_variant',
                'default' => 'centered',
                'options' => array(
                    'left' => __be( 'Left' ),
                    'centered' => __be( 'Centered' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Custom background image' ),
                'desc' =>__be( 'Enter an URL or upload an image for background. Paste the full URL (include <code>http://</code>).' ),
                'id' => 'title_bar_image',
                'default' => get_template_directory_uri().'/images/defaults/pattern.jpg',
                'button_text' => __be('Upload/Select Image'),
                'type' => 'upload'
            ),
            array(
                'name' => __be( 'How to fit background image' ),
                'desc' => __be( 'In Internet Explorer 8 and lower whatever you will choose(except <em>repeat</em>) it will look like "Just center"' ),
                'id' => 'title_bar_image_fit',
                'default' => 'repeat',
                'options' => array(
                    'cover'     => __be( 'Cover' ),
                    'contain'   => __be( 'Contain' ),
                    'fitV'      => __be( 'Fit Vertically' ),
                    'fitH'      => __be( 'Fit Horizontally' ),
                    'center'    => __be( 'Just center' ),
                    'repeat'    => __be( 'Repeat' ),
                ),
                'type' => 'select',
            ),
            array(
                'name' => __be( 'Background color' ),
                'desc' => '',
                'id' => 'title_bar_bg_color',
                'default' => '#f9f9f9',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Title color' ),
                'desc' => '',
                'id' => 'title_bar_title_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Custom color 1' ),
                'desc' => __be('Used in breadcrumbs and post meta.'),
                'id' => 'title_bar_color_1',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Custom color 2' ),
                'desc' => __be('Used in breadcrumbs and post meta.'),
                'id' => 'title_bar_color_2',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Space in top and bottom' ),
                'desc' =>  '',
                'id' => 'title_bar_space_width',
                'default' => '55px',
                'unit' => 'px',
                'min' => 0,
                'max' => 200,
                'type' => 'slider'
            ),
            array(
                'name' => __be( 'Breadcrumbs / Post meta text transform' ),
                'desc' => '',
                'id' => 'title_bar_small_transform',
                'default' => 'none',
                'options' => array(
                    'none' => __be( 'None' ),
                    'uppercase' => __be( 'Uppercase' ),
                ),
                'type' => 'radio',
            ),



            array(
                'name' => __be( 'Pages' ),
                'type' => 'fieldset',
                'default' => 0,
                'id' => 'fieldset_pages'
            ),
            array(
                'name' => __be( 'Page sidebar' ),
                'desc' => __be( 'It affects look of pages. You can change it in each page settings.' ),
                'id' => 'page_sidebar',
                'default' => 'off',
                'options' => array(
                    'left-sidebar'              => __be( 'Sidebar on the left' ),
                    'left-sidebar_and_nav'      => __be( 'Children Navigation + sidebar on the left' ),
                    'left-nav'                  => __be( 'Only children Navigation on the left' ),
                    'right-sidebar'             => __be( 'Sidebar on the right' ),
                    'right-sidebar_and_nav'     => __be( 'Children Navigation + sidebar on the right' ),
                    'right-nav'                 => __be( 'Only children Navigation on the right' ),
                    'off'                       => __be( 'Off' ),
                ),
                'type' => 'select',
            ),




            array(
                'name' => __be( 'Footer widgets part' ),
                'type' => 'fieldset',
                'default' => 0,
                'id' => 'fieldset_footer_widgets'
            ),
            array(
                'name' => __be( 'Background color' ),
                'desc' =>'',
                'id' => 'footer_widgets_bg_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Line color' ),
                'desc' => __be( 'Line above widgets area' ),
                'id' => 'footer_widgets_border_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Widget title font color' ),
                'desc' =>'',
                'id' => 'footer_widget_title_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Widget title font size' ),
                'desc' => '',
                'id' => 'footer_widget_title_font_size',
                'default' => '',
                'unit' => 'px',
                'type' => 'slider'
            ),
            array(
                'name' => __be( 'Widget title line color' ),
                'desc' => __be( 'Line under each widget title' ),
                'id' => 'footer_widgets_title_border_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Font color' ),
                'desc' =>'',
                'id' => 'footer_widgets_font_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Font size' ),
                'desc' => '',
                'id' => 'footer_widgets_font_size',
                'default' => '',
                'unit' => 'px',
                'type' => 'slider'
            ),
            array(
                'name' => __be( 'Links color' ),
                'desc' =>'',
                'id' => 'footer_widgets_link_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Links color hover' ),
                'desc' =>'',
                'id' => 'footer_widgets_link_hover_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Other color' ),
                'desc' => __be( 'It is color of some minor elements in different widgets, like: icons in contact widget, comments link, number in archives, etc.' ),
                'id' => 'footer_widgets_other_color',
                'default' => '',
                'type' => 'color'
            ),




            array(
                'name' => __be( 'Footer lower part' ),
                'type' => 'fieldset',
                'default' => 0,
                'id' => 'fieldset_footer_lower'
            ),
            array(
                'name' => __be( 'Background color' ),
                'desc' =>'',
                'id' => 'footer_lower_bg_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Custom background image' ),
                'desc' =>__be( 'Enter an URL or upload an image for background. Paste the full URL (include <code>http://</code>).' ),
                'id' => 'footer_lower_bg_image',
                'default' => get_template_directory_uri().'/images/defaults/footer_bg.jpg',
                'button_text' => __be('Upload/Select Image'),
                'type' => 'upload'
            ),
            array(
                'name' => __be( 'How to fit background image' ),
                'desc' => __be( 'In Internet Explorer 8 and lower whatever you will choose(except <em>repeat</em>) it will look like "Just center"' ),
                'id' => 'footer_lower_bg_fit',
                'default' => 'fitH',
                'options' => array(
                    'cover'     => __be( 'Cover' ),
                    'contain'   => __be( 'Contain' ),
                    'fitV'      => __be( 'Fit Vertically' ),
                    'fitH'      => __be( 'Fit Horizontally' ),
                    'center'    => __be( 'Just center' ),
                    'repeat'    => __be( 'Repeat' ),
                ),
                'type' => 'select',
            ),
            array(
                'name' => __be( 'Line color' ),
                'desc' => __be( 'Line above texts' ),
                'id' => 'footer_lines_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Font color' ),
                'desc' =>'',
                'id' => 'footer_font_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Font size' ),
                'desc' => '',
                'id' => 'footer_font_size',
                'default' => '',
                'unit' => 'px',
                'type' => 'slider'
            ),
            array(
                'name' => __be( 'Links color' ),
                'desc' =>'',
                'id' => 'footer_link_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Links color hover' ),
                'desc' =>'',
                'id' => 'footer_link_hover_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Footer image left' ),
                'desc' => '',
                'id' => 'footer_image_1',
                'default' => get_template_directory_uri().'/images/defaults/payment.png',
                'button_text' => __be('Upload/Select Image'),
                'media_button_text' => __be('Insert image'),
                'type' => 'upload'
            ),
            array(
                'name' => __be( 'Footer image center' ),
                'desc' => '',
                'id' => 'footer_image_2',
                'default' => get_template_directory_uri().'/images/defaults/footer_logo.png',
                'button_text' => __be('Upload/Select Image'),
                'media_button_text' => __be('Insert image'),
                'type' => 'upload'
            ),
            array(
                'name' => __be( 'Footer image right' ),
                'desc' => '',
                'id' => 'footer_image_3',
                'default' => get_template_directory_uri().'/images/defaults/payment2.png',
                'button_text' => __be('Upload/Select Image'),
                'media_button_text' => __be('Insert image'),
                'type' => 'upload'
            ),
            array(
                'name' => __be( 'Footer text' ),
                'desc' => __be( 'You can use HTML here.' ),
                'id' => 'footer_text',
                'default' => '&copy; 2014 Fame Premium Theme. Proudly made by <a target="_blank" href="http://themeforest.net/user/apollo13/portfolio">Apollo13</a>
Powered by <a target="_blank" href="http://wordpress.org/">WordPress&trade;</a> &#10084; Code is a poetry',
                'type' => 'textarea',
            ),
            array(
                'name' => __be( 'Theme social icons' ),
                'desc' => '',
                'id' => 'footer_socials',
                'default' => 'on',
                'options' => array(
                    'on' => __be( 'Enable' ),
                    'off' => __be( 'Disable' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Social icons color' ),
                'desc' => '',
                'id' => 'footer_socials_color',
                'default' => 'light-bg',
                'options' => array(
                    'dark-bg'   => __be( 'White' ),
                    'light-bg'  => __be( 'Black' ),
                ),
                'type' => 'radio',
            ),
		);

		return $opt;
	}

    function apollo13_fonts_options(){
        $classic_fonts = array(
            'default'           => __be( 'Defined in CSS' ),
            'arial'             => __be( 'Arial' ),
            'calibri'           => __be( 'Calibri' ),
            'cambria'           => __be( 'Cambria' ),
            'georgia'           => __be( 'Georgia' ),
            'tahoma'            => __be( 'Tahoma' ),
            'times new roman'   => __be( 'Times new roman' ),
        );

        $opt = array(
            array(
                'name' => __be( 'Fonts settings' ),
                'type' => 'fieldset',
                'default' => 1,
                'id' => 'fieldset_fonts',
                'help' => '#!/fonts_settings'
            ),
            array(
                'name' => __be( 'Font for top nav menu, interactive elements, short labels, etc.:' ),
                'desc' => __be( 'If you choose <strong>classic font</strong> then remember that this setting depends on fonts installed on client device.<br />'.
                    'If you choose <strong>google font</strong> then remember to choose needed variants and subsets. Read more in documentation.<br />'.
                    'For preview google font is loaded with variants regular and 700, and all available subsets.'),
                'id' => 'nav_menu_fonts',
                'default' => 'Oswald:regular,700',
                'options' => $classic_fonts,
                'type' => 'font',
            ),
            array(
                'name' => __be( 'Font for Titles/Headings:' ),
                'desc' => __be( 'If you choose <strong>classic font</strong> then remember that this setting depends on fonts installed on client device.<br />'.
                    'If you choose <strong>google font</strong> then remember to choose needed variants and subsets. Read more in documentation.<br />'.
                    'For preview google font is loaded with variants regular and 700, and all available subsets.'),
                'id' => 'titles_fonts',
                'default' => 'Oswald:regular,700',
                'options' => $classic_fonts,
                'type' => 'font',
            ),
            array(
                'name' => __be( 'Font for normal(content) text:' ),
                'desc' => __be( 'If you choose <strong>classic font</strong> then remember that this setting depends on fonts installed on client device.<br />'.
                    'If you choose <strong>google font</strong> then remember to choose needed variants and subsets. Read more in documentation.<br />'.
                    'For preview google font is loaded with variants regular and 700, and all available subsets.'),
                'id' => 'normal_fonts',
                'default' => 'Roboto Slab:regular,700',
                'options' => $classic_fonts,
                'type' => 'font',
            ),



            array(
                'name' => __be( 'Headings styles' ),
                'type' => 'fieldset',
                'default' => 0,
                'id' => 'fieldset_headings_styles',
            ),
            array(
                'name' => __be( 'Headings/Titles color' ),
                'desc' =>'',
                'id' => 'headings_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Headings/Titles color hover' ),
                'desc' =>'',
                'id' => 'headings_color_hover',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Headings/Titles font weight' ),
                'desc' => '',
                'id' => 'headings_weight',
                'default' => 'normal',
                'options' => array(
                    'normal' => __be( 'Normal' ),
                    'bold' => __be( 'Bold' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Headings/Titles text transform' ),
                'desc' => '',
                'id' => 'headings_transform',
                'default' => 'uppercase',
                'options' => array(
                    'none' => __be( 'None' ),
                    'uppercase' => __be( 'Uppercase' ),
                ),
                'type' => 'radio',
            ),



            array(
                'name' => __be( 'Content styles' ),
                'type' => 'fieldset',
                'default' => 0,
                'id' => 'fieldset_content_styles',
            ),
            array(
                'name' => __be( 'Font color' ),
                'desc' =>'',
                'id' => 'content_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                'name' => __be( 'Font size' ),
                'desc' => '',
                'id' => 'content_font_size',
                'default' => '14px',
                'unit' => 'px',
                'type' => 'slider'
            ),
            array(
                'name' => __be( 'First paragraph mark out' ),
                'desc' => __be( 'If enabled it marks out(font size and color) first paragraph in many places(blog, post, page). It will do nothing when using builder.' ),
                'id' => 'first_paragraph',
                'default' => 'on',
                'options' => array(
                    'on' => __be( 'Enable' ),
                    'off' => __be( 'Disable' ),
                ),
                'type' => 'radio',
                'switch' => true,
            ),
            array(
                'name' => 'on',
                'type' => 'switch-group'
            ),
            array(
                'name' => __be( 'First paragraph color' ),
                'desc' =>'',
                'id' => 'first_paragraph_color',
                'default' => '',
                'type' => 'color'
            ),
            array(
                /*'name' => 'on',*/
                'type' => 'switch-group-end'
            ),
            array(
                /*'id' => 'first_paragraph',  just for readability */
                'type' => 'end-switch',
            ),
        );

        return $opt;
    }

    function apollo13_blog_options(){

        $opt = array(
            array(
                'name' => __be( 'Blog, Search &amp; Archives appearance' ),
                'type' => 'fieldset',
                'default' => 1,
                'id' => 'fieldset_blog',
                'help' => '#!/blog_menu'
            ),
            array(
                'name' => __be( 'Type of post excerpts' ),
                'desc' => __be( 'In Manual mode excerpts are used only if you add more tag (&lt;!--more--&gt;).<br />' .
                    'In Automatic mode if you won\'t provide more tag or explicit excerpt, content of post will be cut automatic.<br />' .
                    'This setting only concerns blog list, archive list, search results. <br />' ),
                'id' => 'excerpt_type',
                'default' => 'auto',
                'options' => array(
                    'auto'      => __be( 'Automatic' ),
                    'manual'    => __be( 'Manual' ),
                ),
                'type' => 'radio',
                'switch' => true,
            ),
            array(
                'name' => 'auto',
                'type' => 'switch-group'
            ),
            array(
                'name' => __be( 'Number of words to cut post' ),
                'desc' => __be('After this many words post will be cut in automatic mode.'),
                'id' => 'excerpt_length',
                'default' => '10',
                'unit' => '',
                'min' => 10,
                'max' => 200,
                'type' => 'slider'
            ),
            array(
                /*'name' => 'auto',*/
                'type' => 'switch-group-end'
            ),
            array(
                /*'id' => 'excerpt_type',  just for readability */
                'type' => 'end-switch',
            ),
            array(
                'name' => __be( 'Blog appearance variant:' ),
                'desc' => __be( 'It affects look of main blog page.' ),
                'id' => 'blog_variant',
                'default' => 'variant_2',
                'options' => array(
                    'variant_1'             => __be( 'Classic 1: First title, next post media' ),
                    'variant_2'             => __be( 'Classic 2: First post media, next title' ),
                    'variant_3'             => __be( 'Classic 3: Everything centered' ),
                    'variant_short_list'    => __be( 'Short list' ),
                    'variant_masonry'       => __be( 'Masonry bricks' ),
                ),
                'type' => 'select',
                'switch' => true,
            ),
            array(
                'name' => 'variant_masonry',
                'type' => 'switch-group'
            ),
            array(
                'name' => __be( 'Brick width' ),
                'desc' => '',
                'id' => 'brick_width',
                'default' => '480px',
                'unit' => 'px',
                'min' => 200,
                'max' => 600,
                'type' => 'slider'
            ),
            array(
                'name' => __be( 'Brick margin' ),
                'desc' => '',
                'id' => 'brick_margin',
                'default' => '30px',
                'unit' => 'px',
                'min' => 0,
                'max' => 100,
                'type' => 'slider'
            ),
            array(
                /*'name' => 'variant_masonry',*/
                'type' => 'switch-group-end'
            ),
            array(
                /*'id' => 'blog_variant',  just for readability */
                'type' => 'end-switch',
            ),
            array(
                'name' => __be( 'Blog sidebar' ),
                'desc' => __be( 'It affects look of main blog page.' ),
                'id' => 'blog_sidebar',
                'default' => 'right-sidebar',
                'options' => array(
                    'left-sidebar'  => __be( 'Left' ),
                    'right-sidebar' => __be( 'Right' ),
                    'off'           => __be( 'Off' ),
                ),
                'type' => 'select',
            ),
            array(
                'name' => __be( 'Archive sidebar' ),
                'desc' => __be( 'It affects look of search and archive pages.' ),
                'id' => 'archive_sidebar',
                'default' => 'left-sidebar',
                'options' => array(
                    'left-sidebar'  => __be( 'Left' ),
                    'right-sidebar' => __be( 'Right' ),
                    'off'           => __be( 'Off' ),
                ),
                'type' => 'select',
            ),
            array(
                'name' => __be( 'RSS icon' ),
                'desc' => '',
                'id' => 'info_bar_rss',
                'default' => 'off',
                'options' => array(
                    'on'    => __be( 'On' ),
                    'off'   => __be( 'Off' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Display post Media' ),
                'desc' => __be( 'You can set to not display post media(featured image/video/slider) inside of post brick.' ),
                'id' => 'blog_media',
                'default' => 'on',
                'options' => array(
                    'on'    => __be( 'On' ),
                    'off'   => __be( 'Off' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Display of posts video' ),
                'desc' => __be( 'You can set to not display videos as featured media on posts list. This can speed up loading of page with many posts(blog, archive, search results) when videos are used.' ),
                'id' => 'blog_videos',
                'default' => 'on',
                'options' => array(
                    'on'    => __be( 'Show videos' ),
                    'off'   => __be( 'Show featured image' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Display of posts sliders' ),
                'desc' => __be( 'You can set to not display sliders as featured media on posts list. This can speed up loading of page with many posts(blog, archive, search results) when sliders are used.' ),
                'id' => 'blog_sliders',
                'default' => 'on',
                'options' => array(
                    'on'    => __be( 'Show sliders' ),
                    'off'   => __be( 'Show featured image' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Post meta: Date' ),
                'desc' => '',
                'id' => 'blog_date',
                'default' => 'on',
                'options' => array(
                    'on'    => __be( 'On' ),
                    'off'   => __be( 'Off' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Post meta: Author' ),
                'desc' => '',
                'id' => 'blog_author',
                'default' => 'on',
                'options' => array(
                    'on'    => __be( 'On' ),
                    'off'   => __be( 'Off' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Post meta: Comments number' ),
                'desc' => '',
                'id' => 'blog_comments',
                'default' => 'on',
                'options' => array(
                    'on'    => __be( 'On' ),
                    'off'   => __be( 'Off' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Post meta: Tags' ),
                'desc' => '',
                'id' => 'blog_tags',
                'default' => 'on',
                'options' => array(
                    'on'    => __be( 'On' ),
                    'off'   => __be( 'Off' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Post meta: Categories' ),
                'desc' => '',
                'id' => 'blog_cats',
                'default' => 'on',
                'options' => array(
                    'on'    => __be( 'On' ),
                    'off'   => __be( 'Off' ),
                ),
                'type' => 'radio',
            ),

            //------------------------------------
            array(
                'name' => __be( 'Post appearance' ),
                'type' => 'fieldset',
                'default' => 0,
                'id' => 'fieldset_post'
            ),
            array(
                'name' => __be( 'Post sidebar' ),
                'desc' => __be( 'It affects look of posts. You can change it in each post.' ),
                'id' => 'post_sidebar',
                'default' => 'right-sidebar',
                'options' => array(
                    'left-sidebar'  => __be( 'Left' ),
                    'right-sidebar' => __be( 'Right' ),
                    'off'           => __be( 'Off' ),
                ),
                'type' => 'select',
            ),
            array(
                'name' => __be( 'Display post Media' ),
                'desc' => __be( 'You can set to not display post media(featured image/video/slider) inside of post.' ),
                'id' => 'post_media',
                'default' => 'on',
                'options' => array(
                    'on'    => __be( 'On' ),
                    'off'   => __be( 'Off' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Author info in post' ),
                'desc' => __be( 'Will show information about author below post content. Not displayed in blog post list.' ),
                'id' => 'author_info',
                'default' => 'on',
                'options' => array(
                    'on'    => __be( 'On' ),
                    'off'   => __be( 'Off' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Related posts under content of post' ),
                'desc' => __be( 'Will show up to 3 related posts to current post.' ),
                'id' => 'posts_widget',
                'default' => 'on',
                'options' => array(
                    'on'    => __be( 'On' ),
                    'off'   => __be( 'Off' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Post meta: Date' ),
                'desc' => '',
                'id' => 'post_date',
                'default' => 'on',
                'options' => array(
                    'on'    => __be( 'On' ),
                    'off'   => __be( 'Off' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Post meta: Author' ),
                'desc' => '',
                'id' => 'post_author',
                'default' => 'on',
                'options' => array(
                    'on'    => __be( 'On' ),
                    'off'   => __be( 'Off' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Post meta: Comments number' ),
                'desc' => '',
                'id' => 'post_comments',
                'default' => 'on',
                'options' => array(
                    'on'    => __be( 'On' ),
                    'off'   => __be( 'Off' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Post meta: Tags' ),
                'desc' => '',
                'id' => 'post_tags',
                'default' => 'off',
                'options' => array(
                    'on'    => __be( 'On' ),
                    'off'   => __be( 'Off' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Post meta: Categories' ),
                'desc' => '',
                'id' => 'post_cats',
                'default' => 'on',
                'options' => array(
                    'on'    => __be( 'On' ),
                    'off'   => __be( 'Off' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Under post content categories and tags' ),
                'desc' => '',
                'id' => 'post_under_content_tags',
                'default' => 'on',
                'options' => array(
                    'on'    => __be( 'On' ),
                    'off'   => __be( 'Off' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Posts navigation' ),
                'desc' => __be( 'Links to next and prev post.' ),
                'id' => 'posts_navigation',
                'default' => 'on',
                'options' => array(
                    'on'    => __be( 'On' ),
                    'off'   => __be( 'Off' ),
                ),
                'type' => 'radio',
            ),
        );

        return $opt;
    }

	function apollo13_cpt_work_options(){

		$opt = array(
			array(
				'name' => __be( 'Single work settings' ),
				'type' => 'fieldset',
                'default' => 1,
                'id' => 'fieldset_works',
                'help' => '#!/works_menu'
			),
			array(
				'name' => __be( 'Work slug name' ),
				'desc' => __be( 'Don\'t change this if you don\'t have to. Remember that if you use nice permalinks(eg. <code>yoursite.com/page-about-me</code>, <code>yoursite.com/album/damn-empty/</code>) then <strong>NONE of your static pages</strong> should have same slug as this, or pagination will break and other problems may appear.' ),
				'id' => 'cpt_post_type_work',
				'default' => 'work',
				'type' => 'input',
			),
            array(
                'name' => __be( 'Related works under content of work' ),
                'desc' => __be( 'Will show up to 4 related works to current work.' ),
                'id' => 'posts_widget',
                'default' => 'on',
                'options' => array(
                    'on'    => __be( 'On' ),
                    'off'   => __be( 'Off' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Work navigation' ),
                'desc' => '',
                'id' => 'works_nav',
                'default' => 'on',
                'options' => array(
                    'on'    => __be( 'On' ),
                    'off'   => __be( 'Off' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Work meta: Date' ),
                'desc' => '',
                'id' => 'work_date',
                'default' => 'off',
                'options' => array(
                    'on'    => __be( 'On' ),
                    'off'   => __be( 'Off' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Work meta: Author' ),
                'desc' => '',
                'id' => 'work_author',
                'default' => 'off',
                'options' => array(
                    'on'    => __be( 'On' ),
                    'off'   => __be( 'Off' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Work meta: Comments number' ),
                'desc' => '',
                'id' => 'work_comments',
                'default' => 'off',
                'options' => array(
                    'on'    => __be( 'On' ),
                    'off'   => __be( 'Off' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Work meta: Categories' ),
                'desc' => '',
                'id' => 'work_cats',
                'default' => 'off',
                'options' => array(
                    'on'    => __be( 'On' ),
                    'off'   => __be( 'Off' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Categories in content.' ),
                'desc' => __be( 'They will appear under custom info fields.' ),
                'id' => 'genres',
                'default' => 'on',
                'options' => array(
                    'on'    => __be( 'On' ),
                    'off'   => __be( 'Off' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Comments' ),
                'desc' => '',
                'id' => 'comments',
                'default' => 'on',
                'options' => array(
                    'on'    => __be( 'On' ),
                    'off'   => __be( 'Off' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Navigate by categories' ),
                'desc' => __be( 'If enabled then navigation in single work will lead to next/previous work in same category.' ),
                'id' => 'navigate_by_categories',
                'default' => 'off',
                'options' => array(
                    'on'    => __be( 'On' ),
                    'off'   => __be( 'Off' ),
                ),
                'type' => 'radio',
            ),


			array(
				'name' => __be( 'Works list page settings' ),
				'type' => 'fieldset',
                'default' => 1,
                'id' => 'fieldset_works_list',
                'help' => '#!/works_menu'
			),
			array(
				'name' => __be( 'Works main page' ),
				'desc' => __be( 'Select page that is your Works list page. It will make working some features. If you setup Work list as your front page then you don\'t have to set any page here.' ),
				'id' => 'cpt_work_page',
				'default' => 0,
				'type' => 'wp_dropdown_pages',
			),
            array(
                'name' => __be( 'Work list page title' ),
                'desc' => '',
                'id' => 'works_list_title',
                'default' => __( 'Portfolio', 'fame' ),
                'type' => 'input',
            ),

            array(
                'name' => __be( 'Category filter' ),
                'desc' => '',
                'id' => 'categories_filter',
                'default' => 'on',
                'options' => array(
                    'on'  => __be( 'On' ),
                    'off' => __be( 'Off' ),
                ),
                'type' => 'radio',
                'switch' => true,
            ),
            array(
                'name' => 'on',
                'type' => 'switch-group'
            ),
            array(
                'name' => __be( 'Filter by default is' ),
                'desc' => '',
                'id' => 'filter_open',
                'default' => 'on',
                'options' => array(
                    'on' => __be( 'Open' ),
                    'off' => __be( 'Closed' ),
                ),
                'type' => 'radio',
            ),
            array(
                /*'name' => 'on',*/
                'type' => 'switch-group-end'
            ),
            array(
                /*'id' => 'categories_filter',  just for readability */
                'type' => 'end-switch',
            ),

            array(
                'name' => __be( 'Items displayed Full width' ),
                'desc' => __be( 'Part of layout with works items will be displayed on full width. In other case items will be displayed in standard layout "box".' ),
                'id' => 'full_width',
                'default' => 'off',
                'options' => array(
                    'on'  => __be( 'Enable' ),
                    'off' => __be( 'Disable' ),
                ),
                'type' => 'radio',
            ),

            array(
                'name' => __be( 'Works bricks sizes' ),
                'desc' => __be( 'It affects look of works list page.' ),
                'id' => 'works_size',
                'default' => 'medium',
                'options' => array(
                    'big'       => __be( 'Fixed size: Big' ),
                    'medium'    => __be( 'Fixed size: Medium' ),
                    'small'     => __be( 'Fixed size: Small' ),
                    'fluid'     => __be( 'Fluid size' ),
                ),
                'type' => 'select',
                'switch' => true,
            ),
            array(
                'name' => 'fluid',
                'type' => 'switch-group'
            ),
            array(
                'name' => __be( 'Brick width' ),
                'desc' => '',
                'id' => 'brick_width',
                'default' => '420px',
                'unit' => 'px',
                'min' => 50,
                'max' => 600,
                'type' => 'slider'
            ),
            array(
                'name' => __be( 'Brick height' ),
                'desc' => __be( 'If you want photo to not be cropped, set to 0.' ),
                'id' => 'brick_height',
                'default' => '300px',
                'unit' => 'px',
                'min' => 0,
                'max' => 600,
                'type' => 'slider'
            ),
            array(
                'name' => __be( 'Brick margin' ),
                'desc' => '',
                'id' => 'brick_margin',
                'default' => '0',
                'unit' => 'px',
                'min' => 0,
                'max' => 100,
                'type' => 'slider'
            ),
            array(
                /*'name' => 'fluid',*/
                'type' => 'switch-group-end'
            ),
            array(
                /*'id' => 'works_size',  just for readability */
                'type' => 'end-switch',
            ),

            array(
                'name' => __be( 'Show titles' ),
                'desc' => '',
                'id' => 'show_titles',
                'default' => 'on',
                'type' => 'radio',
                'options' => array(
                    'on'    => __be( 'On' ),
                    'off'   => __be( 'Off' ),
                ),
            ),
            array(
                'name' => __be( 'Show subtitles' ),
                'desc' => '',
                'id' => 'show_subtitles',
                'default' => 'on',
                'type' => 'radio',
                'options' => array(
                    'on'    => __be( 'On' ),
                    'off'   => __be( 'Off' ),
                ),
            ),
            array(
                'name' => __be( 'Hover Effect' ),
                'desc' => '',
                'id' => 'hover_type',
                'default' => 'cover-loop',
                'type' => 'radio',
                'options' => array(
                    'cover-loop' => __be( 'Cover' ),/* cause of CSS class collision */
                    'uncover' => __be( 'Uncover' )
                ),
            ),



            array(
                'name' => __be( 'Single work appearance(Scroller)' ),
                'type' => 'fieldset',
                'default' => 0,
                'id' => 'fieldset_work_app_sc'
            ),
            array(
                'name' => __be( 'Scroller height' ),
                'desc' => __be( 'Global for all works.' ),
                'id' => 'scroller_height',
                'default' => '500px',
                'unit' => 'px',
                'min' => 100,
                'max' => 700,
                'type' => 'slider'
            ),
            array(
                'name' => __be( 'Images size' ),
                'desc' => __be( 'You can use images that you have uploaded, or resized versions.' ),
                'id' => 'scroller_images',
                'default' => 'resized',
                'options' => array(
                    'full' => __be( 'Original' ),
                    'resized' => __be( 'Resized' ),
                ),
                'type' => 'radio',
            ),


            array(
                'name' => __be( 'Single work appearance(Slider)' ),
                'type' => 'fieldset',
                'default' => 0,
                'id' => 'fieldset_work_app_sl'
            ),
            array(
                'name' => __be( 'Slider height' ),
                'desc' => '',
                'id' => 'slider_height',
                'default' => '500px',
                'unit' => 'px',
                'min' => 100,
                'max' => 700,
                'type' => 'slider'
            ),
            array(
                'name' => __be( 'Images size' ),
                'desc' => __be( 'You can use images that you have uploaded, or resized versions.' ),
                'id' => 'slider_images',
                'default' => 'full',
                'options' => array(
                    'full' => __be( 'Original' ),
                    'resized' => __be( 'Resized' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Autoplay' ),
                'desc' => __be( 'If autoplay is on, slider will run on page load. Global setting, but you can change this in each work.' ),
                'id' => 'autoplay',
                'default' => '1',
                'options' => array(
                    '1' => __be( 'Enable' ),
                    '0' => __be( 'Disable' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Slide interval(ms)' ),
                'desc' => __be( 'Global for all works.' ),
                'id' => 'slide_interval',
                'default' => 7000,
                'unit' => '',
                'min' => 0,
                'max' => 15000,
                'type' => 'slider'
            ),
            array(
                'name' => __be( 'Transition type' ),
                'desc' =>__be( 'Animation between slides.' ),
                'id' => 'transition_type',
                'default' => '2',
                'options' => array(
                    '0' => __be( 'None' ),
                    '1' => __be( 'Fade' ),
                    '2' => __be( 'Carousel' ),
                ),
                'type' => 'select',
            ),
            array(
                'name' => __be( 'Transition speed(ms)' ),
                'desc' => __be( 'Speed of transition.' ) . ' ' . __be( 'Global for all works.' ),
                'id' => 'transition_time',
                'default' => 600,
                'unit' => '',
                'min' => 0,
                'max' => 10000,
                'type' => 'slider'
            ),
            array(
                'name' => __be( 'Titles' ),
                'desc' =>__be( 'Show image/video titles.' ) . ' ' . __be( 'Global for all works.' ),
                'id' => 'titles',
                'default' => 'off',
                'options' => array(
                    'on' => __be( 'Enable' ),
                    'off' => __be( 'Disable' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'List of slides(buttons)' ),
                'desc' => __be( 'Global for all works.' ),
                'id' => 'list',
                'default' => 'on',
                'options' => array(
                    'on' => __be( 'Enable' ),
                    'off' => __be( 'Disable' ),
                ),
                'type' => 'radio',
            ),
		);

		return $opt;
	}

    function apollo13_cpt_gallery_options(){
        $opt = array(
            array(
                'name' => __be( 'Single gallery settings' ),
                'type' => 'fieldset',
                'default' => 1,
                'id' => 'fieldset_gallery_single',
                'help' => '#!/works_menu'
            ),
            array(
                'name' => __be( 'Gallery meta: Date' ),
                'desc' => '',
                'id' => 'gallery_date',
                'default' => 'off',
                'options' => array(
                    'on'    => __be( 'On' ),
                    'off'   => __be( 'Off' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Gallery meta: Author' ),
                'desc' => '',
                'id' => 'gallery_author',
                'default' => 'off',
                'options' => array(
                    'on'    => __be( 'On' ),
                    'off'   => __be( 'Off' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Breadcrumbs' ),
                'desc' => '',
                'id' => 'breadcrumbs',
                'default' => 'on',
                'type' => 'radio',
                'options' => array(
                    'on' => __be( 'On' ),
                    'off'    => __be( 'Off' ),
                ),
            ),
//            array(
//                'name' => __be( 'Gallery meta: Categories' ),
//                'desc' => '',
//                'id' => 'gallery_cats',
//                'default' => 'on',
//                'options' => array(
//                    'on'    => __be( 'On' ),
//                    'off'   => __be( 'Off' ),
//                ),
//                'type' => 'radio',
//            ),



            array(
                'name' => __be( 'Galleries list page settings' ),
                'type' => 'fieldset',
                'default' => 1,
                'id' => 'fieldset_galleries_list',
                'help' => '#!/galleries_menu'
            ),
            array(
                'name' => __be( 'Galleries main page' ),
                'desc' => __be( 'Select page that is your Galleries list page. It will make working some features. If you setup Galleries list as your front page then you don\'t have to set any page here.' ),
                'id' => 'cpt_gallery_page',
                'default' => 0,
                'type' => 'wp_dropdown_pages',
            ),
            array(
                'name' => __be( 'Galleries list page title' ),
                'desc' => '',
                'id' => 'galleries_list_title',
                'default' => __( 'Galleries', 'fame' ),
                'type' => 'input',
            ),

            array(
                'name' => __be( 'Category filter' ),
                'desc' => '',
                'id' => 'categories_filter',
                'default' => 'on',
                'options' => array(
                    'on'  => __be( 'On' ),
                    'off' => __be( 'Off' ),
                ),
                'type' => 'radio',
                'switch' => true,
            ),
            array(
                'name' => 'on',
                'type' => 'switch-group'
            ),
            array(
                'name' => __be( 'Filter by default is' ),
                'desc' => '',
                'id' => 'filter_open',
                'default' => 'on',
                'options' => array(
                    'on' => __be( 'Open' ),
                    'off' => __be( 'Closed' ),
                ),
                'type' => 'radio',
            ),
            array(
                /*'name' => 'on',*/
                'type' => 'switch-group-end'
            ),
            array(
                /*'id' => 'categories_filter',  just for readability */
                'type' => 'end-switch',
            ),

            array(
                'name' => __be( 'Items displayed Full width' ),
                'desc' => __be( 'Part of layout with galleries items will be displayed on full width. In other case items will be displayed in standard layout "box".' ),
                'id' => 'full_width',
                'default' => 'off',
                'options' => array(
                    'on' => __be( 'Enable' ),
                    'off' => __be( 'Disable' ),
                ),
                'type' => 'radio',
            ),

            array(
                'name' => __be( 'Galleries bricks sizes' ),
                'desc' => __be( 'It affects look of galleries list page.' ),
                'id' => 'galleries_size',
                'default' => 'fluid',
                'options' => array(
                    'big'       => __be( 'Fixed size: Big' ),
                    'medium'    => __be( 'Fixed size: Medium' ),
                    'small'     => __be( 'Fixed size: Small' ),
                    'fluid'     => __be( 'Fluid size' ),
                ),
                'type' => 'select',
                'switch' => true,
            ),
            array(
                'name' => 'fluid',
                'type' => 'switch-group'
            ),
            array(
                'name' => __be( 'Bricks width' ),
                'desc' => '',
                'id' => 'gl_brick_width',
                'default' => '420px',
                'unit' => 'px',
                'min' => 50,
                'max' => 600,
                'type' => 'slider'
            ),
            array(
                'name' => __be( 'Bricks height' ),
                'desc' => __be( 'If you want photo to not be cropped, set to 0.' ),
                'id' => 'gl_brick_height',
                'default' => '320px',
                'unit' => 'px',
                'min' => 0,
                'max' => 600,
                'type' => 'slider'
            ),
            array(
                'name' => __be( 'Bricks margin' ),
                'desc' => '',
                'id' => 'gl_brick_margin',
                'default' => '5px',
                'unit' => 'px',
                'min' => 0,
                'max' => 100,
                'type' => 'slider'
            ),
            array(
                /*'name' => 'fluid',*/
                'type' => 'switch-group-end'
            ),
            array(
                /*'id' => 'galleries_size',  just for readability */
                'type' => 'end-switch',
            ),

            array(
                'name' => __be( 'Show titles' ),
                'desc' => '',
                'id' => 'show_titles',
                'default' => 'on',
                'type' => 'radio',
                'options' => array(
                    'on'    => __be( 'On' ),
                    'off'   => __be( 'Off' ),
                ),
            ),
            array(
                'name' => __be( 'Show subtitles' ),
                'desc' => '',
                'id' => 'show_subtitles',
                'default' => 'on',
                'type' => 'radio',
                'options' => array(
                    'on'    => __be( 'On' ),
                    'off'   => __be( 'Off' ),
                ),
            ),
            array(
                'name' => __be( 'Hover Effect' ),
                'desc' => '',
                'id' => 'gl_hover_type',
                'default' => 'cover-loop',
                'type' => 'radio',
                'options' => array(
                    'cover-loop' => __be( 'Cover' ),/* cause of CSS class collision */
                    'uncover' => __be( 'Uncover' )
                ),
            ),



            array(
                'name' => __be( 'Gallery appearance(Bricks theme)' ),
                'type' => 'fieldset',
                'default' => 1,
                'id' => 'fieldset_gallery_bricks_app',
                'help' => '#!/galleries_menu'
            ),
            array(
                'name' => __be( 'Brick width' ),
                'desc' => __be( 'Global for all galleries.' ),
                'id' => 'brick_width',
                'default' => '340px',
                'unit' => 'px',
                'min' => 50,
                'max' => 600,
                'type' => 'slider'
            ),
            array(
                'name' => __be( 'Brick height' ),
                'desc' => __be( 'If you want photo to not be cropped, set to 0.' ) . ' ' . __be( 'Global for all galleries.' ),
                'id' => 'brick_height',
                'default' => '260px',
                'unit' => 'px',
                'min' => 0,
                'max' => 600,
                'type' => 'slider'
            ),
            array(
                'name' => __be( 'Brick margin' ),
                'desc' => __be( 'Global for all galleries.' ),
                'id' => 'brick_margin',
                'default' => '8px',
                'unit' => 'px',
                'min' => 0,
                'max' => 100,
                'type' => 'slider'
            ),


            array(
                'name' => __be( 'Gallery appearance(Slider theme)' ),
                'type' => 'fieldset',
                'default' => 0,
                'id' => 'fieldset_gallery_slider'
            ),
            array(
                'name' => __be( 'Slider height' ),
                'desc' => '',
                'id' => 'slider_height',
                'default' => '640px',
                'unit' => 'px',
                'min' => 100,
                'max' => 700,
                'type' => 'slider'
            ),
            array(
                'name' => __be( 'Images size' ),
                'desc' => __be( 'You can use images that you have uploaded, or resized versions.' ),
                'id' => 'slider_images',
                'default' => 'full',
                'options' => array(
                    'full' => __be( 'Original' ),
                    'resized' => __be( 'Resized' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Autoplay' ),
                'desc' => __be( 'If autoplay is on, slider will run on page load. Global setting, but you can change this in each gallery.' ),
                'id' => 'autoplay',
                'default' => '1',
                'options' => array(
                    '1' => __be( 'Enable' ),
                    '0' => __be( 'Disable' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'Slide interval(ms)' ),
                'desc' =>__be( 'Time between slide transitions.' ) . ' ' . __be( 'Global for all galleries.' ),
                'id' => 'slide_interval',
                'default' => 7000,
                'unit' => '',
                'min' => 0,
                'max' => 15000,
                'type' => 'slider'
            ),
            array(
                'name' => __be( 'Transition type' ),
                'desc' =>__be( 'Animation between slides.' ),
                'id' => 'transition_type',
                'default' => '2',
                'options' => array(
                    '0' => __be( 'None' ),
                    '1' => __be( 'Fade' ),
                    '2' => __be( 'Carousel' ),
                ),
                'type' => 'select',
            ),
            array(
                'name' => __be( 'Transition speed(ms)' ),
                'desc' =>__be( 'Speed of transition.' ) . ' ' . __be( 'Global for all galleries.' ),
                'id' => 'transition_time',
                'default' => 1000,
                'unit' => '',
                'min' => 0,
                'max' => 10000,
                'type' => 'slider'
            ),
            array(
                'name' => __be( 'Titles and descriptions' ),
                'desc' =>__be( 'Show image/video titles and descriptions.' ) . ' ' . __be( 'Global for all galleries.' ),
                'id' => 'titles',
                'default' => 'on',
                'options' => array(
                    'on' => __be( 'Enable' ),
                    'off' => __be( 'Disable' ),
                ),
                'type' => 'radio',
            ),
            array(
                'name' => __be( 'List of slides(buttons).' ),
                'desc' => __be( 'Global for all galleries.' ),
                'id' => 'list',
                'default' => 'on',
                'options' => array(
                    'on' => __be( 'Enable' ),
                    'off' => __be( 'Disable' ),
                ),
                'type' => 'radio',
            ),
		);

		return $opt;
	}

    function apollo13_sidebars_options(){

        $opt = array(
            array(
                'name' => __be( 'Add custom sidebars' ),
                'type' => 'fieldset',
                'default' => 1,
                'id' => 'fieldset_sidebars',
//                'help' => '#!/advanced_menu'
            ),
            array(
                'name' => __be( 'New sidebar name' ),
                'desc' => __be( 'Choose name for new sidebar and click <b>Save Changes</b> to add it.' ),
                'id' => 'custom_sidebars',
                'default' => '',
                'placeholder' => 'New sidebar name',
                'type' => 'sidebars',
            ),
        );

        return $opt;
    }

	function apollo13_socials_options(){
		$socials = array(
			'500px' => array(
                'name' => '500px',
                'value' => '',
				'pos'  => 0
            ),
			'aim' => array(
                'name' => 'Aim',
                'value' => '',
				'pos'  => 0
            ),
			'behance' => array(
                'name' => 'Behance',
                'value' => '',
				'pos'  => 0
            ),
			'blogger' => array(
                'name' => 'Blogger',
                'value' => '#',
				'pos'  => 0
            ),
			'delicious' => array(
                'name' => 'Delicious',
                'value' => '',
				'pos'  => 0
            ),
			'deviantart' => array(
                'name' => 'Deviantart',
                'value' => '',
				'pos'  => 0
            ),
			'digg' => array(
                'name' => 'Digg',
                'value' => '',
				'pos'  => 0
            ),
			'dribbble' => array(
                'name' => 'Dribbble',
                'value' => '',
				'pos'  => 0
            ),
			'evernote' => array(
                'name' => 'Evernote',
                'value' => '',
				'pos'  => 0
            ),
			'facebook' => array(
                'name' => 'Facebook',
                'value' => '#',
				'pos'  => 0
            ),
			'flickr' => array(
                'name' => 'Flickr',
                'value' => '',
				'pos'  => 0
            ),
			'forrst' => array(
                'name' => 'Forrst',
                'value' => '',
				'pos'  => 0
            ),
			'foursquare' => array(
                'name' => 'Foursquare',
                'value' => '',
				'pos'  => 0
            ),
			'github' => array(
                'name' => 'Github',
                'value' => '',
				'pos'  => 0
            ),
			'googleplus' => array(
                'name' => 'Google Plus',
                'value' => '',
				'pos'  => 0
            ),
			'instagram' => array(
                'name' => 'Instagram',
                'value' => '',
				'pos'  => 0
            ),
			'lastfm' => array(
                'name' => 'Lastfm',
                'value' => '',
				'pos'  => 0
            ),
			'linkedin' => array(
                'name' => 'Linkedin',
                'value' => '',
				'pos'  => 0
            ),
			'paypal' => array(
                'name' => 'Paypal',
                'value' => '',
				'pos'  => 0
            ),
			'pinterest' => array(
                'name' => 'Pinterest',
                'value' => '',
				'pos'  => 0
            ),
			'quora' => array(
                'name' => 'Quora',
                'value' => '',
				'pos'  => 0
            ),
			'rss' => array(
                'name' => 'RSS',
                'value' => '',
				'pos'  => 0
            ),
			'sharethis' => array(
                'name' => 'Sharethis',
                'value' => '',
				'pos'  => 0
            ),
			'skype' => array(
                'name' => 'Skype',
                'value' => '',
				'pos'  => 0
            ),
			'stumbleupon' => array(
                'name' => 'Stumbleupon',
                'value' => '#',
				'pos'  => 0
            ),
			'tumblr' => array(
                'name' => 'Tumblr',
                'value' => '',
				'pos'  => 0
            ),
			'twitter' => array(
                'name' => 'Twitter',
                'value' => '',
                'pos'  => 0
            ),
			'vimeo' => array(
                'name' => 'Vimeo',
                'value' => '',
                'pos'  => 0
            ),
			'wordpress' => array(
                'name' => 'Wordpress',
                'value' => '',
                'pos'  => 0
            ),
			'yahoo' => array(
                'name' => 'Yahoo',
                'value' => '',
                'pos'  => 0
            ),
			'yelp' => array(
                'name' => 'Yelp',
                'value' => '',
                'pos'  => 0
            ),
			'youtube' => array(
                'name' => 'Youtube',
                'value' => '',
                'pos'  => 0
            ),
		);

		$opt = array(
			array(
				'name' => __be( 'Social settings' ),
				'type' => 'fieldset',
                'default' => 1,
                'id' => 'fieldset_social',
                'help' => '#!/social_menu'
			),
            array(
                'name' => __be( 'Type of icons' ),
                'desc' => '',
                'id' => 'socials_variant',
                'default' => 'squares',
                'options' => array(
                    'squares' => __be( 'Squares' ),
                    'circles' => __be( 'Circles' ),
                    'icons-only' => __be( 'Only icons' ),
                ),
                'type' => 'radio',
            ),



			array(
				'name' => __be( 'Social services' ),
				'type' => 'fieldset',
                'default' => 1,
                'id'   => 'sortable-socials'
			),
			array(
				'name' => __be( 'Social services' ),
				'desc' => __be( 'If you face problems with saving this options, then please remove <code>http://</code> from your social links.<br />It will be converted to proper links on front-end, so don\'t worry;-)' ),
				'id' => 'social_services',
				'default' => '',
				'type' => 'social',
				'options' => $socials
			),
		);

		return $opt;
	}

    function apollo13_contact_options(){
        $opt = array(
            array(
                'name' => __be( 'Map settings' ),
                'type' => 'fieldset',
                'default' => 1,
                'id' => 'fieldset_contact',
                'help' => '#!/contact_page_menu'
            ),
            array(
                'name' => __be( 'Contact page map' ),
                'desc' => '',
                'id' => 'contact_map',
                'default' => 'on',
                'options' => array(
                    'on' => __be( 'On' ),
                    'off' => __be( 'Off' ),
                ),
                'type' => 'radio',
                'switch' => true,
            ),
            array(
                'name' => 'on',
                'type' => 'switch-group'
            ),
            array(
                'name' => __be( 'Google map drop area' ),
                'desc' => __be( 'Paste here your google map link(see documentation for more info), and everything will be filled automatically.' ),
                'id' => 'contact_drop_area',
                'default' => '',
                'type' => 'textarea',
            ),
            array(
                'name' => __be( 'Latitude, Longitude' ),
                'desc' => __be( 'Use format Latitude, Longitude (ex. 50.854817, 20.644566)' ),
                'id' => 'contact_ll',
                'default' => '',
                'placeholder' => '40.715241,-74.003026',
                'type' => 'input',
            ),
            array(
                'name' => __be( 'Map type' ),
                'desc' => '',
                'id' => 'contact_map_type',
                'default' => 'ROADMAP',
                'options' => array(
                    'ROADMAP' =>    __be( 'Road map' ),
                    'SATELLITE' =>  __be( 'Satellite' ),
                    'HYBRID' =>     __be( 'Hybrid' ),
                    'TERRAIN' =>    __be( 'Terrain' ),
                ),
                'type' => 'select',
            ),
            array(
                'name' => __be( 'Zoom level' ),
                'desc' => '',
                'id' => 'contact_zoom',
                'default' => '15',
                'unit' => '',
                'min' => 1,
                'max' => 19,
                'type' => 'slider'
            ),
            array(
                'name' => __be( 'Marker title' ),
                'desc' => __be( 'Will show while hovering mouse cursor over marker' ),
                'id' => 'contact_title',
                'default' => 'Fame Inc.',
                'type' => 'input',
            ),
            array(
                'name' => __be( 'Info window content' ),
                'desc' => __be( 'Will show up after clicking in marker' ),
                'id' => 'contact_content',
                'default' => '<strong>Fame Inc.</strong><br />
1299 N Tamiami Trl <br />
Columbus, OH 43232-4831',
                'type' => 'textarea',
            ),
            array(
                /*'name' => 'on',*/
                'type' => 'switch-group-end'
            ),
            array(
                /*'id' => 'contact_map',  just for readability */
                'type' => 'end-switch',
            ),
        );

        return $opt;
    }

	function apollo13_advanced_options(){

		$opt = array(
			array(
				'name' => __be( 'Miscellaneous settings' ),
				'type' => 'fieldset',
                'default' => 1,
                'id' => 'fieldset_misc',
                'help' => '#!/advanced_menu'
			),
			array(
				'name' => __be( 'Comments validation' ),
				'desc' => __be( 'If you wish to use some plugin for validation in <strong>comments form</strong> then you should turn off build in theme validation' ),
				'id' => 'apollo_validation',
				'default' => 'on',
				'options' => array(
                    'on' => __be( 'Enable' ),
                    'off' => __be( 'Disable' ),
				),
				'type' => 'radio',
			),
			array(
				'name' =>  a13__be( 'Theme lightbox' ),
				'desc' =>  a13__be( 'If you wish to use some other plugin/script for images and items switch it off.' ),
				'id' => 'apollo_lightbox',
				'default' => '',
				'options' => array(
					'jackbox' =>  a13__be( 'Jackbox' ),
					'magnific-popup' =>  a13__be( 'Magnific popup' ),
					'off' =>  a13__be( 'Disable' ),
				),
				'type' => 'select',
			),
		);

        global $apollo13;
        if($apollo13->is_home_server()){
            $opt[] = array(
                'name' => __be( 'Demo switcher' ),
                'desc' => '',
                'id' => 'demo_switcher',
                'default' => 'off',
                'options' => array(
                    'on' => __be( 'Enable' ),
                    'off' => __be( 'Disable' ),
                ),
                'type' => 'radio',
            );
        }

		return $opt;
	}

	function apollo13_import_options(){
		$demo_sets = array('none' => '');
		$dir = A13_TPL_ADV_DIR.'/demo_settings';
		if( is_dir( $dir ) ) {
			foreach ( (array)glob($dir.'/*') as $file ){
				$name = basename($file);
				if($name === '_order'){
					continue;
				}
				$demo_sets[ basename($name) ] = basename($name);
			}
		}

		$opt = array(
			array(
				'name' => a13__be( 'Import demo data' ),
				'type' => 'fieldset',
				'default' => 1,
				'id' => 'fieldset_import_demo_data',
				'no_save_button' => true
			),
			array(
				'name' => a13__be( 'Import demo data' ),
				'desc' => a13__be( 'This will import demo data as seen on our demo page. It will also, probably, wipe any pages, posts and other theme settings that are in your site. So it is best to use on fresh Wordpress installation.' ),
				'id' => 'import_demo_data',
				'default' => '',
				'type' => 'import_demo_data',
			),



			array(
				'name' =>  a13__be( 'Import/export theme options' ),
				'type' => 'fieldset',
				'default' => 1,
				'id' => 'fieldset_import',
				'no_save_button' => true
			),
			array(
				'name' => 'Import info',
				'desc' => '',
				'id' => 'import_page',
				'default' => 'yes',
				'type' => 'hidden'
			),
			array(
				'name' =>  a13__be( 'Predefined demo sets' ),
				'desc' =>  a13__be( 'You can select one of our demo sets. It will overwrite all theme settings you have made in panel.' ),
				'id' => 'import_options_select',
				'default' => '',
				'options' => $demo_sets,
				'type' => 'import_set_select',
			),
			array(
				'name' =>  a13__be( 'Import' ),
				'desc' =>  a13__be( 'Depending is it whole or partial import, it will overwrite current theme options.' ),
				'id' => 'import_options_field',
				'default' => '',
				'type' => 'import_textarea',
			),
			array(
				'name' =>  a13__be( 'Export' ),
				'desc' =>  a13__be( 'If you care about your current theme settings: copy and save above string in file before importing anything.' ),
				'id' => 'export_options_field',
				'default' => '',
				'type' => 'export_textarea',
			),
			array(
				'name' =>  a13__be( 'Reset to default' ),
				'desc' =>  a13__be( "It will reset theme options to default. It doesn't change any pages, or other content that is not set by theme options." ),
				'id' => 'reset_options',
				'default' => 'off',
				'options' => array(
					'on' =>  a13__be( 'Reset' ),
					'off' =>  a13__be( 'Do nothing' ),
				),
				'type' => 'import_radio_reset',
			),
		);

		global $a13_apollo13;
		if($a13_apollo13->is_home_server()){
			$demo_data_export_options = array(
				array(
					'name' => a13__be( 'Export demo data options' ),
					'type' => 'fieldset',
					'default' => 1,
					'id' => 'fieldset_demo_data_export',
					'no_save_button' => true
				),
				array(
					'name' => a13__be( 'site_config file' ),
					'desc' => '',
					'id' => 'export_site_config',
					'default' => '',
					'type' => 'export_site_config',
				),
			);

			$opt = array_merge($opt, $demo_data_export_options);
		}

		return $opt;
	}

    function apollo13_customize_options(){

		$opt = array(
            array(
                'name' => __be( 'Custom CSS' ),
                'type' => 'fieldset',
                'default' => 1,
                'id' => 'fieldset_custom_css',
                'help' => '#!/modification_of_theme_custom_css'
            ),
            array(
                'name' => __be( 'Custom CSS' ),
                'desc' => '',
                'id' => 'custom_css',
                'default' => '',
                'type' => 'textarea',
            ),
		);

		return $opt;
	}
