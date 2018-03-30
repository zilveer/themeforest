<?php
if ( ! class_exists( 'BT_Customize_Default' ) ) {

	class BT_Customize_Default {

		// GENERAL SETTINGS

		public static $favicon = ''; // 32x32

		public static $logo = '';
		public static $retina_logo = '';
		
		public static $mobile_touch_icon = ''; // 196x196
		
		public static $centered_logo = false;
		
		public static $sticky_header = false;
		
		public static $show_social = false;
		
		public static $sidebar = 'no_sidebar';
		
		public static $slider = true;
		
		public static $accent_color = '';
		
		public static $body_font = 'no_change';
		public static $heading_font = 'no_change';

		public static $custom_css = '';
		public static $custom_js_top = '';
		public static $custom_js_bottom = '';
		
		// BLOG
		
		public static $blog_featured_image_slider = true;
		public static $blog_author = true;
		public static $blog_date = true;
		public static $blog_number_comments = true;
		public static $blog_author_info = false;
		public static $blog_share_facebook = true;
		public static $blog_share_twitter = true;
		public static $blog_share_google_plus = true;
		public static $blog_share_linkedin = true;
		public static $blog_share_vk = true;
		public static $blog_share_on_grid = false;
		public static $sticky_in_grid = false;
		
		// ABOUT
		
		public static $about_photo = '';
		public static $about_text = '';
		
		// FOOTER / SOCIAL
		
		public static $contact_facebook = '';
		public static $contact_twitter = '';
		public static $contact_google_plus = '';
		public static $contact_linkedin = '';
		public static $contact_pinterest = '';
		public static $contact_vk = '';
		public static $contact_slideshare = '';
		public static $contact_instagram = '';
		public static $contact_youtube = '';
		public static $contact_vimeo = '';
		
		public static $custom_text = '';
	}
}

if ( ! function_exists( 'bt_get_option' ) ) {
	function bt_get_option( $opt, $index = false ) {

		global $bt_options;
		global $bt_page_options;
		
		if ( $index ) $bt_page_options = null;
		
		if ( $bt_page_options !== null && array_key_exists( BTPFX . '_' . $opt, $bt_page_options ) && $bt_page_options[ BTPFX . '_' . $opt ] === 'null' ) {
			return BT_Customize_Default::$$opt;
		}
		if ( $bt_page_options !== null && array_key_exists( BTPFX . '_' . $opt, $bt_page_options ) ) {
			$ret = $bt_page_options[ BTPFX . '_' . $opt ];
			if ( $ret === 'true' ) {
				$ret = true;
			} else if ( $ret === 'false' ) {
				$ret = false;
			}
			return $ret;
		}
		if ( $bt_options !== null && $bt_options !== false && array_key_exists( $opt, $bt_options ) ) {
			$ret = $bt_options[ $opt ];
			if ( $ret === 'true' ) {
				$ret = true;
			} else if ( $ret === 'false' ) {
				$ret = false;
			}
			return $ret;		
		} else { 
			if ( $bt_options !== null ) {
				return BT_Customize_Default::$$opt;
			} else {
				$bt_options = get_option( BTPFX . '_theme_options' );
				if ( array_key_exists( $opt, $bt_options ) ) {
					$ret = $bt_options[ $opt ];
					if ( $ret === 'true' ) {
						$ret = true;
					} else if ( $ret === 'false' ) {
						$ret = false;
					}
					return $ret;
				} else {
					return BT_Customize_Default::$$opt;
				}
			}
		}

	}
}

if ( ! function_exists( 'bt_logo' ) ) {
	function bt_logo( $footer = false ) {
		
		$logo = bt_get_option( 'logo' );
		if ( strpos( $logo, '/wp-content' ) === 0 ) $logo = get_site_url() . $logo;

		$retina_logo = bt_get_option( 'retina_logo' );
		if ( strpos( $retina_logo, '/wp-content' ) === 0 ) $retina_logo = get_site_url() . $retina_logo;
		$retina_logo_width = 0;
		$retina_logo_height = 0;

		if ( $retina_logo != '' ) {
			$img_size = getimagesize( $retina_logo );
			$retina_logo_width = $img_size[0];
			$retina_logo_height = $img_size[1];
		}

		$home_link = home_url();
		
		$retina_logo_width = floor( $retina_logo_width * .5 );
		$retina_logo_height = floor( $retina_logo_height * .5 );
		
		if ( $footer ) {
			if ( $retina_logo != '' ) {
				echo '<a href="' . esc_url( $home_link ) . '"><img src="' . esc_url( $retina_logo ) . '" width="' . esc_attr( $retina_logo_width ) . '" height="' . esc_attr( $retina_logo_height ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '"></a>';
			} else if ( $logo != '' ) {
				echo '<a href="' . esc_url( $home_link ) . '"><img src="' . esc_url( $logo ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '"></a>';
			}		
		} else {
			if ( $retina_logo != '' ) {
				echo '<a href="' . esc_url( $home_link ) . '"><span class="bt_logo_helper"></span><img src="' . esc_url( $retina_logo ) . '" width="' . esc_attr( $retina_logo_width ) . '" height="' . esc_attr( $retina_logo_height ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '"></a>';		
			} else if ( $logo != '' ) {
				echo '<a href="' . esc_url( $home_link ) . '"><span class="bt_logo_helper"></span><img src="' . esc_url( $logo ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '"></a>';
			}
		}
	}
}

if ( ! function_exists( 'bt_image_reloaded' ) ) {
	function bt_image_reloaded() {
		class BT_Customize_Image_Reloaded_Control extends WP_Customize_Image_Control {
			/**
			 * Constructor.
			 *
			 * @since 3.4.0
			 * @uses WP_Customize_Image_Control::__construct()
			 *
			 * @param WP_Customize_Manager $manager
			 */
			private $my_controller;
			public function __construct( $manager, $id, $args = array() ) {
				parent::__construct( $manager, $id, $args );
				
				$this->add_tab( 'library',   __( 'Media Library', 'bt_theme' ), array( $this, 'my_library_tab' ));
				$this->my_controller = $id;
			}
			
			function my_library_tab() {
				
				?>
				
				<a class="choose-from-library-link button" data-controller = "<?php echo esc_attr( $this->my_controller ); ?>">
					<?php _e( 'Open Library', 'bt_theme' ); ?>
				</a>			 
				
				<?php
				
			}   
			
			/**
			 * Search for images within the defined context
			 */
			public function tab_uploaded() {
				return; // removes tab; optional
				$my_context_uploads = get_posts( array(
					'post_type'  => 'attachment',
					'meta_key'   => '_wp_attachment_context',
					'meta_value' => $this->context,
					'orderby'    => 'post_date',
					'nopaging'   => true,
				));
				?>
			
				<div class="uploaded-target"></div>
				
				<?php
				if ( empty( $my_context_uploads ) ) {
					return;
				}
				foreach ( (array) $my_context_uploads as $my_context_upload ) {
					$this->print_tab_image( esc_url_raw( $my_context_upload->guid ));
				}
			}
		}
		
		class BT_Customize_Textarea_Control extends WP_Customize_Control {
			public function render_content() {
				?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<textarea rows="5" style="width:98%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value()); ?></textarea>
				</label>
				<?php
			}
		}
		
		class BT_Reset_Control extends WP_Customize_Control {
			public function render_content() {
				?>
				<div style="margin: 5px 0px 10px 0px">
				<label><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span></label>			
					<input type="submit" onclick="var c = confirm('<?php echo esc_js( __( 'Reset theme settings to default values?', 'bt_theme' ) ); ?>'); if (c != true) return false;var href=window.location.href;if (href.indexOf('?') > -1) {window.location.replace(href + '&bt_reset=reset')} else {window.location.replace(href + '?bt_reset=reset')};return false;" name="bt_reset" id="bt_reset" class="button" value="Reset">
				</div>
				<?php
			}
		}
	}
}
add_action( 'customize_register', 'bt_image_reloaded' );

if ( ! function_exists( 'bt_customize_register' ) ) {
	function bt_customize_register( $wp_customize ) {
		global $wpdb;
		if ( isset( $_GET['bt_reset'] ) && $_GET['bt_reset'] == 'reset' ) {
			$wpdb->query( 'delete from ' . $wpdb->options . ' where option_name = "' . BTPFX . '_theme_options"' );
			header( 'Location: ' . wp_customize_url());
		}

		$wp_customize->remove_section( 'colors' );
		$wp_customize->remove_section( 'title_tagline' );
		$wp_customize->remove_section( 'nav' );
		$wp_customize->remove_section( 'static_front_page' );
		
		$wp_customize->add_section( BTPFX . '_general_section' , array(
			'title'      => __( 'General Settings', 'bt_theme' ),
			'priority'   => 10,
		));
		$wp_customize->add_section( BTPFX . '_background_section' , array(
			'title'      => __( 'Background', 'bt_theme' ),
			'priority'   => 30,
		));		
		$wp_customize->add_section( BTPFX . '_blog_section' , array(
			'title'      => __( 'Blog', 'bt_theme' ),
			'priority'   => 50,
		));
		$wp_customize->add_section( BTPFX . '_about_section' , array(
			'title'      => __( 'About', 'bt_theme' ),
			'priority'   => 55,
		));	
		$wp_customize->add_section( BTPFX . '_footer_section' , array(
			'title'      => __( 'Footer / Social', 'bt_theme' ),
			'priority'   => 60,
		));	
		
		/* GENERAL SETTINGS */
		
		// FAVICON
		$wp_customize->add_setting( BTPFX . '_theme_options[favicon]', array(
			'default'           => BT_Customize_Default::$favicon,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control(
			new BT_Customize_Image_Reloaded_Control(
				$wp_customize,
				'favicon',
				array(
					'label'    => __( 'Favicon', 'bt_theme' ),
					'section'  => BTPFX . '_general_section',
					'settings' => BTPFX . '_theme_options[favicon]',
					'priority' => 10,
					'context'  => BTPFX . '_favicon'
				)
			)
		);
		
		// LOGO
		$wp_customize->add_setting( BTPFX . '_theme_options[logo]', array(
			'default'           => BT_Customize_Default::$logo,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control(
			new BT_Customize_Image_Reloaded_Control(
				$wp_customize,
				'logo',
				array(
					'label'    => __( 'Logo', 'bt_theme' ),
					'section'  => BTPFX . '_general_section',
					'settings' => BTPFX . '_theme_options[logo]',
					'priority' => 20,
					'context'  => BTPFX . '_logo'
				)
			)
		);
		
		// RETINA LOGO
		$wp_customize->add_setting( BTPFX . '_theme_options[retina_logo]', array(
			'default'           => BT_Customize_Default::$retina_logo,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control(
			new BT_Customize_Image_Reloaded_Control(
				$wp_customize,
				'retina_logo',
				array(
					'label'    => __( 'Retina Logo', 'bt_theme' ),
					'section'  => BTPFX . '_general_section',
					'settings' => BTPFX . '_theme_options[retina_logo]',
					'priority' => 30,
					'context'  => BTPFX . '_retina_logo'
				)
			)
		);
		
		// MOBILE TOUCH ICON
		$wp_customize->add_setting( BTPFX . '_theme_options[mobile_touch_icon]', array(
			'default'           => BT_Customize_Default::$mobile_touch_icon,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control(
			new BT_Customize_Image_Reloaded_Control(
				$wp_customize,
				'mobile_touch_icon',
				array(
					'label'    => __( 'Mobile Touch Icon', 'bt_theme' ),
					'section'  => BTPFX . '_general_section',
					'settings' => BTPFX . '_theme_options[mobile_touch_icon]',
					'priority' => 35,
					'context'  => BTPFX . '_logo'
				)
			)
		);
		
		// CENTERED LOGO
		$wp_customize->add_setting( BTPFX . '_theme_options[centered_logo]', array(
			'default'           => BT_Customize_Default::$centered_logo,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'centered_logo', array(
			'label'    => __( 'Centered Logo', 'bt_theme' ),
			'section'  => BTPFX . '_general_section',
			'settings' => BTPFX . '_theme_options[centered_logo]',
			'priority' => 70,
			'type'     => 'checkbox'
		));
		
		// STICKY HEADER
		$wp_customize->add_setting( BTPFX . '_theme_options[sticky_header]', array(
			'default'           => BT_Customize_Default::$sticky_header,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'sticky_header', array(
			'label'    => __( 'Sticky Header', 'bt_theme' ),
			'section'  => BTPFX . '_general_section',
			'settings' => BTPFX . '_theme_options[sticky_header]',
			'priority' => 80,
			'type'     => 'checkbox'
		));
		
		// SHOW SOCIAL
		$wp_customize->add_setting( BTPFX . '_theme_options[show_social]', array(
			'default'           => BT_Customize_Default::$show_social,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'show_social', array(
			'label'    => __( 'Show Social Icons Without Dropdown on Large Screens', 'bt_theme' ),
			'section'  => BTPFX . '_general_section',
			'settings' => BTPFX . '_theme_options[show_social]',
			'priority' => 85,
			'type'     => 'checkbox'
		));
		
		// SIDEBAR
		$wp_customize->add_setting( BTPFX . '_theme_options[sidebar]', array(
			'default'           => 'no_sidebar',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'sidebar', array(
			'label'     => __( 'Sidebar', 'bt_theme' ),
			'section'   => BTPFX . '_general_section',
			'settings'  => BTPFX . '_theme_options[sidebar]',
			'priority'  => 93,
			'type'      => 'select',
			'choices'   => array(
				'no_sidebar' => __( 'No Sidebar', 'bt_theme' ),
				'left'       => __( 'Left', 'bt_theme' ),
				'right'      => __( 'Right', 'bt_theme' )
			)
		));
		
		// FRONT PAGE SLIDER
		$wp_customize->add_setting( BTPFX . '_theme_options[slider]', array(
			'default'           => BT_Customize_Default::$slider,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'slider', array(
			'label'    => __( 'Front Page Slider', 'bt_theme' ),
			'section'  => BTPFX . '_general_section',
			'settings' => BTPFX . '_theme_options[slider]',
			'priority' => 94,
			'type'     => 'checkbox'
		));
	
		// ACCENT COLOR
		$wp_customize->add_setting( BTPFX . '_theme_options[accent_color]', array(
			'default'        	   => BT_Customize_Default::$accent_color,
			'type'           	   => 'option',
			'capability'     	   => 'edit_theme_options',
			'sanitize_callback'    => 'sanitize_text_field'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
			'label'    => __( 'Accent Color', 'bt_theme' ),
			'section'  => BTPFX . '_general_section',
			'settings' => BTPFX . '_theme_options[accent_color]',
			'priority' => 95
		)));
		
		global $bt_fonts;
		get_template_part( 'php/web_fonts' );
		$choices = array( 'no_change' => __( 'No Change', 'bt_theme' ) );
		foreach ( $bt_fonts as $font ) {
			$choices[$font['css-name']] = $font['font-name'];
		}

		// BODY FONT
		$wp_customize->add_setting( BTPFX . '_theme_options[body_font]', array(
			'default'           => 'no_change',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'body_font', array(
			'label'     => __( 'Body Font', 'bt_theme' ),
			'section'   => BTPFX . '_general_section',
			'settings'  => BTPFX . '_theme_options[body_font]',
			'priority'  => 97,
			'type'      => 'select',
			'choices'   => $choices
		));
		
		// HEADING FONT
		$wp_customize->add_setting( BTPFX . '_theme_options[heading_font]', array(
			'default'           => 'no_change',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'heading_font', array(
			'label'     => __( 'Heading Font', 'bt_theme' ),
			'section'   => BTPFX . '_general_section',
			'settings'  => BTPFX . '_theme_options[heading_font]',
			'priority'  => 100,
			'type'      => 'select',
			'choices'   => $choices
		));		

		// CUSTOM CSS
		$wp_customize->add_setting( BTPFX . '_theme_options[custom_css]', array(
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( new BT_Customize_Textarea_Control( 
			$wp_customize, 
			'custom_css', array(
				'label'    => __( 'Custom CSS', 'bt_theme' ),
				'section'  => BTPFX . '_general_section',
				'priority' => 104,
				'settings' => BTPFX . '_theme_options[custom_css]'
			)
		));
		
		// CUSTOM JS TOP
		$wp_customize->add_setting( BTPFX . '_theme_options[custom_js_top]', array(
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'bt_custom_js'
		));
		$wp_customize->add_control( new BT_Customize_Textarea_Control( 
			$wp_customize, 
			'custom_js_top', array(
				'label'    => __( 'Custom JS (Top)', 'bt_theme' ),
				'section'  => BTPFX . '_general_section',
				'priority' => 105,
				'settings' => BTPFX . '_theme_options[custom_js_top]'
			)
		));
		
		// CUSTOM JS BOTTOM
		$wp_customize->add_setting( BTPFX . '_theme_options[custom_js_bottom]', array(
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'bt_custom_js'
		));
		$wp_customize->add_control( new BT_Customize_Textarea_Control( 
			$wp_customize, 
			'custom_js_bottom', array(
				'label'    => __( 'Custom JS (Bottom)', 'bt_theme' ),
				'section'  => BTPFX . '_general_section',
				'priority' => 110,
				'settings' => BTPFX . '_theme_options[custom_js_bottom]'
			)
		));

		// RESET
		$wp_customize->add_setting( BTPFX . '_theme_options[reset]', array(
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( new BT_Reset_Control( 
			$wp_customize, 
			'reset', array(
				'label'    => __( 'Reset Theme Settings', 'bt_theme' ),
				'section'  => BTPFX . '_general_section',
				'priority' => 130,
				'settings' => BTPFX . '_theme_options[reset]'
			)
		));	
		
		/* BLOG */
		
		// AUTHOR INFO
		$wp_customize->add_setting( BTPFX . '_theme_options[blog_featured_image_slider]', array(
			'default'           => BT_Customize_Default::$blog_featured_image_slider,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'blog_featured_image_slider', array(
			'label'    => __( 'Featured Image Slider', 'bt_theme' ),
			'section'  => BTPFX . '_blog_section',
			'settings' => BTPFX . '_theme_options[blog_featured_image_slider]',
			'priority' => 3,
			'type'     => 'checkbox'
		));

		// AUTHOR
		$wp_customize->add_setting( BTPFX . '_theme_options[blog_author]', array(
			'default'           => BT_Customize_Default::$blog_author,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'blog_author', array(
			'label'    => __( 'Show Author', 'bt_theme' ),
			'section'  => BTPFX . '_blog_section',
			'settings' => BTPFX . '_theme_options[blog_author]',
			'priority' => 4,
			'type'     => 'checkbox'
		));

		// DATE
		$wp_customize->add_setting( BTPFX . '_theme_options[blog_date]', array(
			'default'           => BT_Customize_Default::$blog_date,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'blog_date', array(
			'label'    => __( 'Show Post Date', 'bt_theme' ),
			'section'  => BTPFX . '_blog_section',
			'settings' => BTPFX . '_theme_options[blog_date]',
			'priority' => 5,
			'type'     => 'checkbox'
		));
		
		// NUMBER OF COMMENTS
		$wp_customize->add_setting( BTPFX . '_theme_options[blog_number_comments]', array(
			'default'           => BT_Customize_Default::$blog_number_comments,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'blog_number_comments', array(
			'label'    => __( 'Show Number of Comments', 'bt_theme' ),
			'section'  => BTPFX . '_blog_section',
			'settings' => BTPFX . '_theme_options[blog_number_comments]',
			'priority' => 6,
			'type'     => 'checkbox'
		));
		
		// AUTHOR INFO
		$wp_customize->add_setting( BTPFX . '_theme_options[blog_author_info]', array(
			'default'           => BT_Customize_Default::$blog_author_info,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'blog_author_info', array(
			'label'    => __( 'Show Author Information', 'bt_theme' ),
			'section'  => BTPFX . '_blog_section',
			'settings' => BTPFX . '_theme_options[blog_author_info]',
			'priority' => 9,
			'type'     => 'checkbox'
		));	

		// SHARE ON FACEBOOK
		$wp_customize->add_setting( BTPFX . '_theme_options[blog_share_facebook]', array(
			'default'           => BT_Customize_Default::$blog_share_facebook,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'blog_share_facebook', array(
			'label'    => __( 'Share on Facebook', 'bt_theme' ),
			'section'  => BTPFX . '_blog_section',
			'settings' => BTPFX . '_theme_options[blog_share_facebook]',
			'priority' => 10,
			'type'     => 'checkbox'
		));
		
		// SHARE ON TWITTER
		$wp_customize->add_setting( BTPFX . '_theme_options[blog_share_twitter]', array(
			'default'           => BT_Customize_Default::$blog_share_twitter,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'blog_share_twitter', array(
			'label'    => __( 'Share on Twitter', 'bt_theme' ),
			'section'  => BTPFX . '_blog_section',
			'settings' => BTPFX . '_theme_options[blog_share_twitter]',
			'priority' => 20,
			'type'     => 'checkbox'
		));

		// SHARE ON GOOGLE PLUS
		$wp_customize->add_setting( BTPFX . '_theme_options[blog_share_google_plus]', array(
			'default'           => BT_Customize_Default::$blog_share_google_plus,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'blog_share_google_plus', array(
			'label'    => __( 'Share on Google Plus', 'bt_theme' ),
			'section'  => BTPFX . '_blog_section',
			'settings' => BTPFX . '_theme_options[blog_share_google_plus]',
			'priority' => 30,
			'type'     => 'checkbox'
		));

		// SHARE ON LINKEDIN
		$wp_customize->add_setting( BTPFX . '_theme_options[blog_share_linkedin]', array(
			'default'           => BT_Customize_Default::$blog_share_linkedin,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'blog_share_linkedin', array(
			'label'    => __( 'Share on LinkedIn', 'bt_theme' ),
			'section'  => BTPFX . '_blog_section',
			'settings' => BTPFX . '_theme_options[blog_share_linkedin]',
			'priority' => 40,
			'type'     => 'checkbox'
		));
		
		// SHARE ON VK
		$wp_customize->add_setting( BTPFX . '_theme_options[blog_share_vk]', array(
			'default'           => BT_Customize_Default::$blog_share_vk,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'blog_share_vk', array(
			'label'    => __( 'Share on VK', 'bt_theme' ),
			'section'  => BTPFX . '_blog_section',
			'settings' => BTPFX . '_theme_options[blog_share_vk]',
			'priority' => 50,
			'type'     => 'checkbox'
		));
		
		// SHARE BUTTONS ON GRID LAYOUT
		$wp_customize->add_setting( BTPFX . '_theme_options[blog_share_on_grid]', array(
			'default'           => BT_Customize_Default::$blog_share_on_grid,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'blog_share_on_grid', array(
			'label'    => __( 'Share Buttons on Grid Layout', 'bt_theme' ),
			'section'  => BTPFX . '_blog_section',
			'settings' => BTPFX . '_theme_options[blog_share_on_grid]',
			'priority' => 55,
			'type'     => 'checkbox'
		));
		
		// STICKY POSTS IN GRID/TILES
		$wp_customize->add_setting( BTPFX . '_theme_options[sticky_in_grid]', array(
			'default'           => BT_Customize_Default::$sticky_in_grid,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'sticky_in_grid', array(
			'label'    => __( 'Sticky Posts in Grid/Tiles', 'bt_theme' ),
			'section'  => BTPFX . '_blog_section',
			'settings' => BTPFX . '_theme_options[sticky_in_grid]',
			'priority' => 60,
			'type'     => 'checkbox'
		));
		
		/* ABOUT */
		
		// ABOUT PHOTO
		$wp_customize->add_setting( BTPFX . '_theme_options[about_photo]', array(
			'default'           => BT_Customize_Default::$about_photo,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control(
			new BT_Customize_Image_Reloaded_Control(
				$wp_customize,
				'about_photo',
				array(
					'label'    => __( 'Photo', 'bt_theme' ),
					'section'  => BTPFX . '_about_section',
					'settings' => BTPFX . '_theme_options[about_photo]',
					'priority' => 10,
					'context'  => BTPFX . '_logo'
				)
			)
		);
		
		// ABOUT TEXT
		$wp_customize->add_setting( BTPFX . '_theme_options[about_text]', array(
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( new BT_Customize_Textarea_Control( 
			$wp_customize, 
			'about_text', array(
				'label'    => __( 'Text', 'bt_theme' ),
				'section'  => BTPFX . '_about_section',
				'priority' => 20,
				'settings' => BTPFX . '_theme_options[about_text]'
			)
		));	
		
		/* FOOTER / SOCIAL */
		
		// CONTACT FB
		$wp_customize->add_setting( BTPFX . '_theme_options[contact_facebook]', array(
			'default'           => BT_Customize_Default::$contact_facebook,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'contact_facebook', array(
			'label'    => __( 'Facebook', 'bt_theme' ),
			'section'  => BTPFX . '_footer_section',
			'settings' => BTPFX . '_theme_options[contact_facebook]',
			'priority' => 40,
			'type'     => 'text'
		));

		// CONTACT TWITTER
		$wp_customize->add_setting( BTPFX . '_theme_options[contact_twitter]', array(
			'default'           => BT_Customize_Default::$contact_twitter,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'contact_twitter', array(
			'label'    => __( 'Twitter', 'bt_theme' ),
			'section'  => BTPFX . '_footer_section',
			'settings' => BTPFX . '_theme_options[contact_twitter]',
			'priority' => 50,
			'type'     => 'text'
		));
		
		// CONTACT GOOGLE PLUS
		$wp_customize->add_setting( BTPFX . '_theme_options[contact_google_plus]', array(
			'default'           => BT_Customize_Default::$contact_google_plus,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'contact_google_plus', array(
			'label'    => __( 'Google Plus', 'bt_theme' ),
			'section'  => BTPFX . '_footer_section',
			'settings' => BTPFX . '_theme_options[contact_google_plus]',
			'priority' => 60,
			'type'     => 'text'
		));

		// CONTACT LINKEDIN
		$wp_customize->add_setting( BTPFX . '_theme_options[contact_linkedin]', array(
			'default'           => BT_Customize_Default::$contact_linkedin,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'contact_linkedin', array(
			'label'    => __( 'LinkedIn', 'bt_theme' ),
			'section'  => BTPFX . '_footer_section',
			'settings' => BTPFX . '_theme_options[contact_linkedin]',
			'priority' => 70,
			'type'     => 'text'
		));

		// CONTACT PINTEREST
		$wp_customize->add_setting( BTPFX . '_theme_options[contact_pinterest]', array(
			'default'           => BT_Customize_Default::$contact_pinterest,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'contact_pinterest', array(
			'label'    => __( 'Pinterest', 'bt_theme' ),
			'section'  => BTPFX . '_footer_section',
			'settings' => BTPFX . '_theme_options[contact_pinterest]',
			'priority' => 80,
			'type'     => 'text'
		));
		
		// CONTACT VK
		$wp_customize->add_setting( BTPFX . '_theme_options[contact_vk]', array(
			'default'           => BT_Customize_Default::$contact_vk,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'contact_vk', array(
			'label'    => __( 'VK', 'bt_theme' ),
			'section'  => BTPFX . '_footer_section',
			'settings' => BTPFX . '_theme_options[contact_vk]',
			'priority' => 85,
			'type'     => 'text'
		));
		
		// CONTACT SLIDESHARE
		$wp_customize->add_setting( BTPFX . '_theme_options[contact_slideshare]', array(
			'default'           => BT_Customize_Default::$contact_slideshare,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'contact_slideshare', array(
			'label'    => __( 'SlideShare', 'bt_theme' ),
			'section'  => BTPFX . '_footer_section',
			'settings' => BTPFX . '_theme_options[contact_slideshare]',
			'priority' => 90,
			'type'     => 'text'
		));
		
		// CONTACT INSTAGRAM
		$wp_customize->add_setting( BTPFX . '_theme_options[contact_instagram]', array(
			'default'           => BT_Customize_Default::$contact_instagram,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'contact_instagram', array(
			'label'    => __( 'Instagram', 'bt_theme' ),
			'section'  => BTPFX . '_footer_section',
			'settings' => BTPFX . '_theme_options[contact_instagram]',
			'priority' => 95,
			'type'     => 'text'
		));		
		
		// CONTACT YOUTUBE
		$wp_customize->add_setting( BTPFX . '_theme_options[contact_youtube]', array(
			'default'           => BT_Customize_Default::$contact_youtube,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'contact_youtube', array(
			'label'    => __( 'YouTube', 'bt_theme' ),
			'section'  => BTPFX . '_footer_section',
			'settings' => BTPFX . '_theme_options[contact_youtube]',
			'priority' => 100,
			'type'     => 'text'
		));

		// CONTACT VIMEO
		$wp_customize->add_setting( BTPFX . '_theme_options[contact_vimeo]', array(
			'default'           => BT_Customize_Default::$contact_vimeo,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'contact_vimeo', array(
			'label'    => __( 'Vimeo', 'bt_theme' ),
			'section'  => BTPFX . '_footer_section',
			'settings' => BTPFX . '_theme_options[contact_vimeo]',
			'priority' => 105,
			'type'     => 'text'
		));
		
		// CUSTOM TEXT
		$wp_customize->add_setting( BTPFX . '_theme_options[custom_text]', array(
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'bt_custom_text'
		));
		$wp_customize->add_control( new BT_Customize_Textarea_Control( 
			$wp_customize, 
			'custom_text', array(
				'label'    => __( 'Custom Text/HTML', 'bt_theme' ),
				'section'  => BTPFX . '_footer_section',
				'priority' => 110,
				'settings' => BTPFX . '_theme_options[custom_text]'
			)
		));	
	}
}
add_action( 'customize_register', 'bt_customize_register' );

if ( ! function_exists( 'bt_js_bottom' ) ) {
	function bt_js_bottom() {
		$js = bt_get_option( 'custom_js_bottom' );
		if ( strpos( $js, '<script>' ) === 0 && strpos( $js, '</script>' ) !== false ) {
			echo $js;
		} else {
			echo '<script>' . $js . '</script>';
		}
	}
}

if ( ! function_exists( 'bt_customize_css_js' ) ) {
	function bt_customize_css_js() {

		echo '<style>';
		
		if ( bt_get_option( 'custom_css' ) != '' ) {
			echo bt_get_option( 'custom_css' );
		}
		
		echo '</style>';
		
		if ( bt_get_option( 'custom_js_top' ) != '' ) {
			$js = bt_get_option( 'custom_js_top' );
			if ( strpos( $js, '<script>' ) === 0 && strpos( $js, '</script>' ) !== false ) {
				echo $js;
			} else {
				echo '<script>' . $js . '</script>';
			}
		}

		if ( bt_get_option( 'custom_js_bottom' ) != '' ) {
			add_action( 'wp_footer', 'bt_js_bottom' );
		}
		
	}
}
add_action( 'wp_head', 'bt_customize_css_js' );

if ( ! function_exists( 'bt_custom_text' ) ) {
	function bt_custom_text( $text ) {
		return $text;
	}
}

if ( ! function_exists( 'bt_custom_js' ) ) {
	function bt_custom_js( $js ) {
		return trim( $js );
	}
}