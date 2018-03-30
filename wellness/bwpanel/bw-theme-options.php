<?php

class BW_Theme_Options {
	
	private $sections;
	private $checkboxes;
	private $settings;
	
	
	/**
	 * Construct
	 */
	public function __construct() {
		
		// This will keep track of the checkbox options for the validate_settings function.
		$this->checkboxes = array();
		$this->settings = array();
		$this->get_bwsettings();
		
		$this->sections['general']      = __('Theme Settings', 'bw_themes');
		/*$this->sections['appearance']   = __('Appearance', 'bw_themes');
		$this->sections['customcss']    = __('Custom CSS', 'bw_themes');
		$this->sections['reset']        = __('Reset to Defaults', 'bw_themes');
		$this->sections['about']        = __('About', 'bw_themes');*/
		
		add_action( 'admin_menu', array( &$this, 'add_pages' ) );
		add_action( 'admin_init', array( &$this, 'register_settings' ) );
		
		if ( ! get_option( 'bwthemes_options' ) )
			$this->initialize_settings();
		
	}
	
	/**
	 * Add options page
	 */
	public function add_pages() {
		
		$admin_page = add_theme_page( 'BW Theme Options' , 'BW Theme Options' , 'manage_options', 'bwthemes-options', array( &$this, 'display_page' ) );
		
		add_action( 'admin_print_scripts-' . $admin_page, array( &$this, 'scripts' ) );
		add_action( 'admin_print_styles-' . $admin_page, array( &$this, 'styles' ) );
		
	}
	
	/**
	 * Create settings field
	 */
	public function create_setting( $args = array() ) {
		
		$defaults = array(
			'id'      => 'default_field',
			'title'   => 'Default Field',
			'desc'    => 'This is a default description.',
			'std'     => '',
			'type'    => 'text',
			'section' => 'general',
			'choices' => array(),
			'class'   => ''
		);
			
		extract( wp_parse_args( $args, $defaults ) );
		
		$field_args = array(
			'type'      => $type,
			'id'        => $id,
			'desc'      => $desc,
			'std'       => $std,
			'choices'   => $choices,
			'label_for' => $id,
			'class'     => $class
		);
		
		if ( $type == 'checkbox' )
			$this->checkboxes[] = $id;
		
		add_settings_field( $id, $title, array( $this, 'display_setting' ), 'bwthemes-options', $section, $field_args );
	}
	
	/**
	 * Display options page
	 */
	public function display_page() {
		
		echo '<div class="wrap">
	<div class="icon32" id="icon-tools"></div>
	<h2>Theme Options Panel</h2>';
	
		if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] == true )
			echo '<div class="updated fade"><p>Theme options updated.</p></div>';
		
		echo '<form action="options.php" method="post">';
	
		settings_fields( 'bwthemes_options' );
		echo '<div class="ui-tabs">
			<ul class="ui-tabs-nav">';
		
		foreach ( $this->sections as $section_slug => $section )
			echo '<li><a href="#' . $section_slug . '">' . $section . '</a></li>';
		
		echo '</ul>';
		do_settings_sections( $_GET['page'] );
		
		echo '</div>
		<p class="submit"><input name="Submit" type="submit" class="button-primary" value="Save Changes" /></p>
		
	</form>';
	
	echo '<script type="text/javascript">
		jQuery(document).ready(function($) {
			var sections = [];';
			
			foreach ( $this->sections as $section_slug => $section )
				echo "sections['$section'] = '$section_slug';";
			
			echo 'var wrapped = $(".wrap h3").wrap("<div class=\"ui-tabs-panel\">");
			wrapped.each(function() {
				$(this).parent().append($(this).parent().nextUntil("div.ui-tabs-panel"));
			});
			$(".ui-tabs-panel").each(function(index) {
				$(this).attr("id", sections[$(this).children("h3").text()]);
				if (index > 0)
					$(this).addClass("");
			});
			$(".ui-tabs").tabs({
				fx: { opacity: "toggle", duration: "fast" }
			});
			
			$("input[type=text], textarea").each(function() {
				if ($(this).val() == $(this).attr("placeholder") || $(this).val() == "")
					$(this).css("color", "#999");
			});
			
			$("input[type=text], textarea").focus(function() {
				if ($(this).val() == $(this).attr("placeholder") || $(this).val() == "") {
					$(this).val("");
					$(this).css("color", "#000");
				}
			}).blur(function() {
				if ($(this).val() == "" || $(this).val() == $(this).attr("placeholder")) {
					$(this).val($(this).attr("placeholder"));
					$(this).css("color", "#999");
				}
			});
			
			$(".wrap h3, .wrap table").show();
			
			// This will make the "warning" checkbox class really stand out when checked.
			// I use it here for the Reset checkbox.
			$(".warning").change(function() {
				if ($(this).is(":checked"))
					$(this).parent().css("background", "#c00").css("color", "#fff").css("fontWeight", "bold");
				else
					$(this).parent().css("background", "none").css("color", "inherit").css("fontWeight", "normal");
			});
			
			// Browser compatibility
			if ($.browser.mozilla) 
			         $("form").attr("autocomplete", "off");
		});
	</script>
</div>';
		
	}
	
	/**
	 * Description for section
	 */
	public function display_section() {
		// code
	}
	
	/**
	 * Description for About section
	 */
	public function display_about_section() {
		
		
		echo '<p>Want the latest news about our Templates? Connect with us at <a href="http://themeforest.net/user/BWThemes">BWThemes</a>, or follow us on <a href="https://twitter.com/BWThemes">Twitter</a></p>';
		
	}
	
	/**
	 * HTML output for text field
	 */
	public function display_setting( $args = array() ) {
		
		extract( $args );
		
		$options = get_option( 'bwthemes_options' );
		
		if ( ! isset( $options[$id] ) && $type != 'checkbox' )
			$options[$id] = $std;
		elseif ( ! isset( $options[$id] ) )
			$options[$id] = 0;
		
		$field_class = '';
		if ( $class != '' )
			$field_class = ' ' . $class;
		
		switch ( $type ) {
			
			case 'heading':
				echo '</td></tr><tr valign="top"><td colspan="2"><h4>' . $desc . '</h4>';
				break;
			
			case 'checkbox':
				
				echo '<input class="checkbox' . $field_class . '" type="checkbox" id="' . $id . '" name="bwthemes_options[' . $id . ']" value="1" ' . checked( $options[$id], 1, false ) . ' /> <label for="' . $id . '">' . $desc . '</label>';
				
				break;
			
			case 'select':
				echo '<select class="select' . $field_class . '" name="bwthemes_options[' . $id . ']">';
				
				foreach ( $choices as $value => $label )
					echo '<option value="' . esc_attr( $value ) . '"' . selected( $options[$id], $value, false ) . '>' . $label . '</option>';
				
				echo '</select>';
				
				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>';
				
				break;
			
			case 'radio':
				$i = 0;
				foreach ( $choices as $value => $label ) {
					echo '<input class="radio' . $field_class . '" type="radio" name="bwthemes_options[' . $id . ']" id="' . $id . $i . '" value="' . esc_attr( $value ) . '" ' . checked( $options[$id], $value, false ) . '> <label for="' . $id . $i . '">' . $label . '</label>';
					if ( $i < count( $options ) - 1 )
						echo '<br />';
					$i++;
				}
				
				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>';
				
				break;
			case 'colorradio':
				$i = 0;
				foreach ( $choices as $value => $label ) {
					echo '<div class="color-scheme-item" style="float: left; margin-right: 14px; margin-bottom: 10px; position:relative;"><label for="' . $id . $i . '">' . $label['name'] . '</label><br /><input class="radio' . $field_class . '" type="radio" name="bwthemes_options[' . $id . ']" id="' . $id . $i . '" value="' . esc_attr( $value ) . '" ' . checked( $options[$id], $value, false ) . '><br /><img src="' . $label['preview'] . '"</img></div>';
					if ( $i < count( $options ) - 1 )
						//echo '<br />';
					$i++;
				}
				
				if ( $desc != '' )
					echo '<br class="clear" /><span class="description">' . $desc . '</span>';
				
				break;
			
			case 'textarea':
				echo '<textarea class="' . $field_class . '" id="' . $id . '" name="bwthemes_options[' . $id . ']" placeholder="' . $std . '" rows="5" cols="30">' . format_for_editor( $options[$id] ) . '</textarea>';
				
				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>';
				
				break;
			
			case 'password':
				echo '<input class="regular-text' . $field_class . '" type="password" id="' . $id . '" name="bwthemes_options[' . $id . ']" value="' . esc_attr( $options[$id] ) . '" />';
				
				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>';
				
				break;
			
			case 'text':
			default:
		 		echo '<input class="regular-text' . $field_class . '" type="text" id="' . $id . '" name="bwthemes_options[' . $id . ']" placeholder="' . esc_attr($std) . '" value="' . esc_attr( $options[$id] ) . '" />';
		 		
		 		if ( $desc != '' )
		 			echo '<br /><span class="description">' . $desc . '</span>';
		 		
		 		break;
		 	
		}
		
	}
	
	/**
	 * Settings and defaults
	 */
	public function get_bwsettings() {
	
		
		
		/* General Settings
		===========================================*/

		
		$this->settings['google_analytics_code'] = array(
			'title'   => 'Google Analytics',
			'desc'    => 'Enter your Google Analytics ID. Ex. UA-xxxxxx-x',
			'std'     => '',
			'type'    => 'text',
			'section' => 'general'
		);
		
		$this->settings['phone_checkbox'] = array(
			'section' => 'general',
			'title'   => 'Use Phone Number?',
			'desc'    => 'Check this if you wish to use Telephone Number below in your header',
			'type'    => 'checkbox',
			'std'     => 1 // Set to 1 to be checked by default, 0 to be unchecked by default.
		);
		
		$this->settings['phone_number'] = array(
			'title'   => 'Telephone Number',
			'desc'    => 'Enter your telephone number to be displayed in your website header',
			'std'     => '123-555-5555',
			'type'    => 'text',
			'section' => 'general'
		);
		
		$this->settings['footer_slogan'] = array(
			'title'   => 'Footer Slogan / Copyright',
			'desc'    => 'Enter your footer slogan or copyright information',
			'std'     => 'A wordpress theme from BWThemes',
			'type'    => 'text',
			'section' => 'general'
		);
		
		/* Social Icons Separator */
		
		$this->settings['social_heading'] = array(
			'section' => 'general',
			'title'   => '', // Not used for headings.
			'desc'    => 'Social Icons',
			'type'    => 'heading'
		);
		
		/* Social Icons Array */
		
		$this->settings['twitter_url'] = array(
			'title'   => 'Twitter',
			'desc'    => 'Enter URL to your Twitter account. ie. http://twitter.com',
			'std'     => '',
			'type'    => 'text',
			'section' => 'general'
		);
		$this->settings['facebook_url'] = array(
			'title'   => 'Facebook',
			'desc'    => 'Enter URL to your Facebook account. ie. http://facebook.com',
			'std'     => '',
			'type'    => 'text',
			'section' => 'general'
		);
		$this->settings['youtube_url'] = array(
			'title'   => 'YouTube',
			'desc'    => 'Enter URL to your YouTube account. ie. http://youtube.com',
			'std'     => '',
			'type'    => 'text',
			'section' => 'general'
		);
		$this->settings['linkedin_url'] = array(
			'title'   => 'LinkedIn',
			'desc'    => 'Enter URL to your LinkedIn account. ie. http://linkedin.com',
			'std'     => '',
			'type'    => 'text',
			'section' => 'general'
		);
		$this->settings['googleplus_url'] = array(
			'title'   => 'Google+',
			'desc'    => 'Enter URL to your Google+ account. ie. http://plus.google.com',
			'std'     => '',
			'type'    => 'text',
			'section' => 'general'
		);
		$this->settings['pinterest_url'] = array(
			'title'   => 'Pinterest',
			'desc'    => 'Enter URL to your Pinterest account. ie. http://pinterest.com',
			'std'     => '',
			'type'    => 'text',
			'section' => 'general'
		);
		$this->settings['instagram_url'] = array(
			'title'   => 'Instagram',
			'desc'    => 'Enter URL to your Instagram account. ie. http://instagram.com',
			'std'     => '',
			'type'    => 'text',
			'section' => 'general'
		);
		$this->settings['rss_checked'] = array(
			'title'   => 'RSS 2.0 Feed',
			'desc'    => 'Check this if you wish to include RSS feed alongside social icons',
			'std'     => 1,
			'type'    => 'checkbox',
			'section' => 'general'
		);

		

		
		/* Appearance
		===========================================*/
		/* Appearance Separator */
		
		$this->settings['about_heading'] = array(
			'section' => 'general',
			'title'   => '', // Not used for headings.
			'desc'    => 'Appearance',
			'type'    => 'heading'
		);
		
		$this->settings['logobg_checkbox'] = array(
			'section' => 'general',
			'title'   => 'Enable Logo Background?',
			'desc'    => 'Check this if you wish to have the color background behind your logo',
			'type'    => 'checkbox',
			'std'     => 1 // Set to 1 to be checked by default, 0 to be unchecked by default.
		);
		
		$this->settings['favicon'] = array(
			'section' => 'general',
			'title'   => 'Favicon',
			'desc'    => 'Enter the URL to your custom favicon. It should be 16x16 pixels in size.',
			'type'    => 'text',
			'std'     => '/favicon.ico'
		);
		/* Color Scheme Separator */
		
		$this->settings['color_heading'] = array(
			'section' => 'general',
			'title'   => '', 
			'desc'    => 'Color Scheme',
			'type'    => 'heading'
		);
		
		$this->settings['color_radio'] = array(
			'section' => 'general',
			'title'   => 'Color Scheme',
			'desc'    => 'Please choose the color scheme for your theme',
			'type'    => 'colorradio',
			'std'     => 'choice1',
			'choices' => array(
				'choice1' => array(
						'name' => 'Pastel Sunshine',
						'preview' => get_template_directory_uri() . '/skins/thumb-skin1.jpg'
						),
				'choice2' => array(
						'name' => 'Classic Medical',
						'preview' => get_template_directory_uri() . '/skins/thumb-skin2.jpg'
						),
				'choice3' => array(
						'name' => 'Forest Retreat',
						'preview' => get_template_directory_uri() . '/skins/thumb-skin3.jpg'
						),
				'choice4' => array(
						'name' => 'The Beach',
						'preview' => get_template_directory_uri() . '/skins/thumb-skin4.jpg'
						),
				'choice5' => array(
						'name' => 'Custom Skin',
						'preview' => get_template_directory_uri() . '/skins/thumb-custom.jpg'
						)
			)
			
		);

			
		/* Custom CSS
		===========================================*/
		/* CustomCSS Separator */
		
		$this->settings['css_heading'] = array(
			'section' => 'general',
			'title'   => '', // Not used for headings.
			'desc'    => 'Custom CSS',
			'type'    => 'heading'
		);
		$this->settings['bw_custom_css'] = array(
			'section' => 'general',
			'title'   => 'Custom CSS',
			'type'    => 'textarea',
			'desc'    => 'Use this area to enter any Custom CSS overrides you wish to include. This will not be over-written when the theme is updated.'
		);
							
		/* Reset
		===========================================*/
		/* Reset Separator */
		
		$this->settings['reset_heading'] = array(
			'section' => 'general',
			'title'   => '', // Not used for headings.
			'desc'    => 'Theme Reset',
			'type'    => 'heading'
		);
		$this->settings['reset_theme'] = array(
			'section' => 'general',
			'title'   => 'Reset theme',
			'type'    => 'checkbox',
			'std'     => 0,
			'class'   => 'warning', // Custom class for CSS
			'desc'    => 'Check this box and click "Save Changes" below to reset theme options to their defaults.'
		);
		
	}
	
	/**
	 * Initialize settings to their default values
	 */
	public function initialize_settings() {
		
		$default_settings = array();
		foreach ( $this->settings as $id => $setting ) {
			if ( $setting['type'] != 'heading' )
				$default_settings[$id] = $setting['std'];
		}
		
		update_option( 'bwthemes_options', $default_settings );
		
	}
	
	/**
	* Register settings
	*/
	public function register_settings() {
		
		register_setting( 'bwthemes_options', 'bwthemes_options', array ( &$this, 'validate_settings' ) );
		
		foreach ( $this->sections as $slug => $title ) {
			if ( $slug == 'about' )
				add_settings_section( $slug, $title, array( &$this, 'display_about_section' ), 'bwthemes-options' );
			else
				add_settings_section( $slug, $title, array( &$this, 'display_section' ), 'bwthemes-options' );
		}
		
		$this->get_bwsettings();
		
		foreach ( $this->settings as $id => $setting ) {
			$setting['id'] = $id;
			$this->create_setting( $setting );
		}
		
	}
	
	/**
	* jQuery Tabs
	*/
	public function scripts() {
		
		wp_print_scripts( 'jquery-ui-tabs' );
		//Media Uploader Scripts
		//wp_enqueue_script('media-upload');
		//wp_enqueue_script('thickbox');
		//wp_register_script('my-upload', get_stylesheet_directory_uri() . '/js/uploader.js', array('jquery','media-upload','thickbox'));
		//wp_enqueue_script('my-upload');

		
	}
	
	/**
	* Styling for the theme options page
	*/
	public function styles() {
		
		wp_register_style( 'bwtheme-admin', get_template_directory_uri() . '/bwpanel/bw-theme-options.css' );
		wp_enqueue_style( 'bwtheme-admin' );
		//Media Uploader Style
		wp_enqueue_style('thickbox');
		
	}
	
	/**
	* Validate settings
	*/
	public function validate_settings( $input ) {
		
		if ( ! isset( $input['reset_theme'] ) ) {
			$options = get_option( 'bwthemes_options' );
			
			foreach ( $this->checkboxes as $id ) {
				if ( isset( $options[$id] ) && ! isset( $input[$id] ) )
					unset( $options[$id] );
			}
			
			return $input;
		}
		return false;
		
	}
	
}

$theme_options = new BW_Theme_Options();

function bwthemes_option( $option ) {
	$options = get_option( 'bwthemes_options' );
	if ( isset( $options[$option] ) )
		return $options[$option];
	else
		return false;
}
?>