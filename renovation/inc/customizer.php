<?php
/**
 * progression Theme Customizer
 *
 * @package progression
 */


$header_default = array(
	'width'         => 1800,
	'height'        => 600,
	'header-text'    => false,
	'default-image' => get_template_directory_uri() . '/images/page-title.jpg',
);
add_theme_support( 'custom-header', $header_default );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function progression_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'progression_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function progression_customize_preview_js() {
	wp_enqueue_script( 'progression_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'progression_customize_preview_js' );



/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
function progression_customizer( $wp_customize ) {
	
	// Adds abaillity to add text area
	if ( class_exists( 'WP_Customize_Control' ) ) { 
		# Adds textarea support to the theme customizer 
		class ProgressionTextAreaControl extends WP_Customize_Control { 
			public $type = 'textarea'; 
			public function __construct( $manager, $id, $args = array() ) { 
				$this->statuses = array( '' => __( 'Default', 'progression' ) ); 
				parent::__construct( $manager, $id, $args ); 
			}   
			
			public function render_content() { 
				echo '<label> 
				<span class="customize-control-title">' . esc_html( $this->label ) . '</span> 
				<textarea rows="5" style="width:100%;" '; $this->link(); echo '>' . esc_textarea( $this->value() ) . '</textarea> 
				</label>'; } 
			}   
		}
		
//Add Section Page of Theme Settings
    $wp_customize->add_section(
        'options_panel_progression',
        array(
            'title' => __('Theme Settings', 'progression'),
            'description' => __('Main Theme Settings', 'progression'),
            'priority' => 70,
        )
    );
	
	//Logo Uploader
	$wp_customize->add_setting( 
		'logo_upload' ,
		array(
	        'default' => get_template_directory_uri().'/images/logo.png',
			'sanitize_callback' => 'progression_sanitize_text',
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'logo_upload',
	        array(
	            'label' => __('Theme Logo', 'progression'), 
	            'section' => 'options_panel_progression',
	            'settings' => 'logo_upload',
					'priority'   => 5,
	        )
	    )
	);
	
	//Logo Width
	$wp_customize->add_setting( 
		'logo_width' ,
		array(
	        'default' => '180',
			'sanitize_callback' => 'progression_sanitize_text',
	    )
	);
	$wp_customize->add_control(
   'logo_width',
   	array(
	   	'label' => __('Logo Width', 'progression'), 
			'section' => 'options_panel_progression',
			'type' => 'text',
			'priority'   => 7,
	    )
	);
	
	
	//Comment Options
		$wp_customize->add_setting( 
			'logo_left_progression',
			array('sanitize_callback' => 'progression_sanitize_text',)
		);
		$wp_customize->add_control(
	   'logo_left_progression',
	   	array(
		   	'label' => __('Align logo to the left instead of center', 'progression'), 
				'section' => 'options_panel_progression',
				'type' => 'checkbox',
				'priority'   => 11,
		    )
		);

	

	
	//Comment Options
	$wp_customize->add_setting( 
		'header_fix_progression',
		array('sanitize_callback' => 'progression_sanitize_text',) 
	);
	$wp_customize->add_control(
   'header_fix_progression',
   	array(
	   	'label' => __('Set Navigation Fixed?', 'progression'), 
			'section' => 'options_panel_progression',
			'type' => 'checkbox',
			'priority'   => 11,
	    )
	);

	// Add Copyright Text
		$wp_customize->add_setting( 
			'copyright_textbox',
			array (
			'default' => 'Developed by ProgressionStudios',
			'sanitize_callback' => 'progression_sanitize_text',
			)
		);
	$wp_customize->add_control(
   'copyright_textbox',
   	array(
	   	'label' => __('Copyright Text', 'progression'), 
			'section' => 'options_panel_progression',
			'settings'   => 'copyright_textbox',
			'type' => 'text',
			'priority'   => 12,
	    )
	);
	
	
	
	//Footer Column
	$wp_customize->add_setting( 
		'footer_cols' ,
		array(
	        'default' => '4',
			'sanitize_callback' => 'progression_sanitize_text',
	    )
	);
	$wp_customize->add_control(
   'footer_cols',
   	array(
	   	'label' => __('Footer Column Count (1-4)', 'progression'), 
			'section' => 'options_panel_progression',
			'type' => 'text',
			'priority'   => 15,
	    )
	);
	
	
	//Comment Options
	$wp_customize->add_setting( 
		'comment_progression' ,
		array('sanitize_callback' => 'progression_sanitize_text',)
	);
	$wp_customize->add_control(
   'comment_progression',
   	array(
	   	'label' => __('Display comments for pages?', 'progression'), 
			'section' => 'options_panel_progression',
			'type' => 'checkbox',
			'priority'   => 20,
	    )
	);
	
	
	
	
	
	
	
	
	
	
	//Portfolio Categories
	$wp_customize->add_setting( 
		'portfolio_col_progression' ,
		array(
	        'default' => '3',
			'sanitize_callback' => 'progression_sanitize_text',
	    )
	);
	$wp_customize->add_control(
   'portfolio_col_progression',
   	array(
	   	'label' => __('Portfolio posts per column (2-4)', 'progression'), 
			'section' => 'options_panel_progression',
			'type' => 'text',
			'priority'   => 40,
	    )
	);
	
	
	//Portfolio Pagination
	$wp_customize->add_setting( 
		'portfolio_pages_progression' ,
		array(
	        'default' => '12',
			'sanitize_callback' => 'progression_sanitize_text',
	    )
	);
	$wp_customize->add_control(
   'portfolio_pages_progression',
   	array(
	   	'label' => __('Portfolio posts per page', 'progression'), 
			'section' => 'options_panel_progression',
			'type' => 'text',
			'priority'   => 45,
	    )
	);
	

	//Portfolio Categories
	$wp_customize->add_setting( 
		'testimonial_col_progression' ,
		array(
	        'default' => '2',
			'sanitize_callback' => 'progression_sanitize_text',
	    )
	);
	$wp_customize->add_control(
   'testimonial_col_progression',
   	array(
	   	'label' => __('Testimonial posts per column (2-4)', 'progression'), 
			'section' => 'options_panel_progression',
			'type' => 'text',
			'priority'   => 50,
	    )
	);
	
	
	//Portfolio Pagination
	$wp_customize->add_setting( 
		'testimonial_pages_progression' ,
		array(
	        'default' => '12',
			'sanitize_callback' => 'progression_sanitize_text',
	    )
	);
	$wp_customize->add_control(
   'testimonial_pages_progression',
   	array(
	   	'label' => __('Testimonial posts per page', 'progression'), 
			'section' => 'options_panel_progression',
			'type' => 'text',
			'priority'   => 52,
	    )
	);
	
	//Portfolio Categories
	$wp_customize->add_setting( 
		'service_col_progression' ,
		array(
	        'default' => '2',
			'sanitize_callback' => 'progression_sanitize_text',
	    )
	);
	$wp_customize->add_control(
   'service_col_progression',
   	array(
	   	'label' => __('Services posts per column (2-4)', 'progression'), 
			'section' => 'options_panel_progression',
			'type' => 'text',
			'priority'   => 60,
	    )
	);
	
	
	//Portfolio Pagination
	$wp_customize->add_setting( 
		'service_pages_progression' ,
		array(
	        'default' => '12',
			'sanitize_callback' => 'progression_sanitize_text',
	    )
	);
	$wp_customize->add_control(
   'service_pages_progression',
   	array(
	   	'label' => __('Services posts per page', 'progression'), 
			'section' => 'options_panel_progression',
			'type' => 'text',
			'priority'   => 62,
	    )
	);
	
	//Shop Column Count
	$wp_customize->add_setting( 
		'shop_col_progression' ,
		array(
	        'default' => '3',
			'sanitize_callback' => 'progression_sanitize_text',
	    )
	);
	$wp_customize->add_control(
   'shop_col_progression',
   	array(
	   	'label' => __('Shop posts per column (2-4)', 'progression'), 
			'section' => 'options_panel_progression',
			'settings'   => 'shop_col_progression',
			'type' => 'text',
			'priority'   => 65,
	    )
	);


	

//Add Section Page of Background Colors
    $wp_customize->add_section(
        'progression_background_colors',
        array(
            'title' => __('Background Colors', 'progression'),
            'description' => 'Adjust background colors for the theme!',
            'priority' => 72,
        )
    );
	

	
	
	
	$wp_customize->add_setting('nav_bg', array(
	    'default'     => '#252536',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'nav_bg', array(
		'label'        => __( 'Header Background Color', 'progression' ),
		'section'    => 'progression_background_colors',
		'settings'   => 'nav_bg',
		'priority'   => 8,
	)));
	
	$wp_customize->add_setting('nav_border_pro', array(
	    'default'     => '#f6c606',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'nav_border_pro', array(
		'label'        => __( 'Navigation Border Bottom Color', 'progression' ),
		'section'    => 'progression_background_colors',
		'settings'   => 'nav_border_pro',
		'priority'   => 9,
	)));
	

	$wp_customize->add_setting('navigation_hover_color', array(
	    'default'     => '#1e1e2b',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'navigation_hover_color', array(
		'label'        => __( 'Navigation Hover Background Color', 'progression' ),
		'section'    => 'progression_background_colors',
		'settings'   => 'navigation_hover_color',
		'priority'   => 10,
	)));
	
	
	$wp_customize->add_setting('page_title_bg', array(
	    'default'     => '#f5be05',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'page_title_bg', array(
		'label'        => __( 'Page Title Background Color', 'progression' ),
		'section'    => 'progression_background_colors',
		'settings'   => 'page_title_bg',
		'priority'   => 11,
	)));

	
	$wp_customize->add_setting('body_bg_progression', array(
	    'default'     => '#ffffff',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'body_bg_progression', array(
		'label'        => __( 'Body Background Color', 'progression' ),
		'section'    => 'progression_background_colors',
		'settings'   => 'body_bg_progression',
		'priority'   => 15,
	)));
	

	
	
	
	$wp_customize->add_setting('footer_border_progression', array(
	    'default'     => '#f1f1f1',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_border_progression', array(
		'label'        => __( 'Footer Widget Background Color', 'progression' ),
		'section'    => 'progression_background_colors',
		'settings'   => 'footer_border_progression',
		'priority'   => 18,
	)));
	
	$wp_customize->add_setting('footer_bg_progression', array(
	    'default'     => '#eaeaea',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_bg_progression', array(
		'label'        => __( 'Footer Background Color', 'progression' ),
		'section'    => 'progression_background_colors',
		'settings'   => 'footer_bg_progression',
		'priority'   => 19,
	)));
	
	

	$wp_customize->add_setting('button_bg_progression', array(
	    'default'     => '#f6c606',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'button_bg_progression', array(
		'label'        => __( 'Button Background Color', 'progression' ),
		'section'    => 'progression_background_colors',
		'settings'   => 'button_bg_progression',
		'priority'   => 25,
	)));
	
	

	$wp_customize->add_setting('button_hover_bg_progression', array(
	    'default'     => '#ffdb4d',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'button_hover_bg_progression', array(
		'label'        => __( 'Button Hover Background Color', 'progression' ),
		'section'    => 'progression_background_colors',
		'settings'   => 'button_hover_bg_progression',
		'priority'   => 30,
	)));
	
	
	
	
	$wp_customize->add_setting('slide_bg_button', array(
	    'default'     => '#2a2a3d',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'slide_bg_button', array(
		'label'        => __( 'Slider/Secondary Button Background', 'progression' ),
		'section'    => 'progression_background_colors',
		'settings'   => 'slide_bg_button',
		'priority'   => 32,
	)));
	
	$wp_customize->add_setting('slide_bg_hover_button', array(
	    'default'     => '#383851',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'slide_bg_hover_button', array(
		'label'        => __( 'Slider/Secondary Hover Button Background', 'progression' ),
		'section'    => 'progression_background_colors',
		'settings'   => 'slide_bg_hover_button',
		'priority'   => 34,
	)));
	

	$wp_customize->add_setting('tax_bg_button_pro', array(
	    'default'     => '#f6c606',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'tax_bg_button_pro', array(
		'label'        => __( 'Pagination Highlight Background', 'progression' ),
		'section'    => 'progression_background_colors',
		'settings'   => 'tax_bg_button_pro',
		'priority'   => 40,
	)));
	
	
	$wp_customize->add_setting('pagination_bg_button_pro', array(
	    'default'     => '#d1a805',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'pagination_bg_button_pro', array(
		'label'        => __( 'Pagination Highlight Border', 'progression' ),
		'section'    => 'progression_background_colors',
		'settings'   => 'pagination_bg_button_pro',
		'priority'   => 41,
	)));


	

//Add Section Page of Background Colors
    $wp_customize->add_section(
        'progression_font_colors',
        array(
            'title' => __('Font Colors', 'progression'),
            'description' => 'Adjust font colors for the theme!',
            'priority' => 74,
        )
    );

	$wp_customize->add_setting('body_font_progression', array(
	    'default'     => '#757575',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'body_font_progression', array(
		'label'        => __( 'Body Font Color', 'progression' ),
		'section'    => 'progression_font_colors',
		'settings'   => 'body_font_progression',
		'priority'   => 5,
	)));
	
	
	$wp_customize->add_setting('page_font_progression', array(
	    'default'     => '#ffffff',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'page_font_progression', array(
		'label'        => __( 'Page Title Font Color', 'progression' ),
		'section'    => 'progression_font_colors',
		'settings'   => 'page_font_progression',
		'priority'   => 6,
	)));
	
	
	
	$wp_customize->add_setting('body_link_progression', array(
	    'default'     => '#e18a00',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'body_link_progression', array(
		'label'        => __( 'Main Link Color', 'progression' ),
		'section'    => 'progression_font_colors',
		'settings'   => 'body_link_progression',
		'priority'   => 7,
	)));
	
	
	$wp_customize->add_setting('body_link_hover_progression', array(
	    'default'     => '#e18a00',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'body_link_hover_progression', array(
		'label'        => __( 'Main Hover Link Color', 'progression' ),
		'section'    => 'progression_font_colors',
		'settings'   => 'body_link_hover_progression',
		'priority'   => 9,
	)));
	
	$wp_customize->add_setting('navigation_menu_color', array(
	    'default'     => '#cbcbcf',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'navigation_menu_color', array(
		'label'        => __( 'Navigation Link Color', 'progression' ),
		'section'    => 'progression_font_colors',
		'settings'   => 'navigation_menu_color',
		'priority'   => 10,
	)));

	
	
	$wp_customize->add_setting('navigation_font_hover_color', array(
	    'default'     => '#ffffff',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'navigation_font_hover_color', array(
		'label'        => __( 'Navigation Current/Hover Color', 'progression' ),
		'section'    => 'progression_font_colors',
		'settings'   => 'navigation_font_hover_color',
		'priority'   => 13,
	)));
	
	
	$wp_customize->add_setting('headering_font_pro', array(
	    'default'     => '#3f3f3f',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'headering_font_pro', array(
		'label'        => __( 'Headings Font Color', 'progression' ),
		'section'    => 'progression_font_colors',
		'settings'   => 'headering_font_pro',
		'priority'   => 16,
	)));

	
	$wp_customize->add_setting('button_font_pro', array(
	    'default'     => '#393939',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'button_font_pro', array(
		'label'        => __( 'Button Font Color', 'progression' ),
		'section'    => 'progression_font_colors',
		'settings'   => 'button_font_pro',
		'priority'   => 20,
	)));
	
	
	$wp_customize->add_setting('button_hover_font_pro', array(
	    'default'     => '#393939',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'button_hover_font_pro', array(
		'label'        => __( 'Button Hover Font Color', 'progression' ),
		'section'    => 'progression_font_colors',
		'settings'   => 'button_hover_font_pro',
		'priority'   => 22,
	)));
	
	
	$wp_customize->add_setting('second_button_font_pro', array(
	    'default'     => '#ffffff',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'second_button_font_pro', array(
		'label'        => __( 'Slider/Secondary Button Font Color', 'progression' ),
		'section'    => 'progression_font_colors',
		'settings'   => 'second_button_font_pro',
		'priority'   => 24,
	)));
	
	
	$wp_customize->add_setting('hover_second_button_font_pro', array(
	    'default'     => '#ffffff',
		'sanitize_callback' => 'progression_sanitize_text',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'hover_second_button_font_pro', array(
		'label'        => __( 'Slider/Secondary Button Hover Font Color', 'progression' ),
		'section'    => 'progression_font_colors',
		'settings'   => 'hover_second_button_font_pro',
		'priority'   => 26,
	)));
	
	

	
	
}
add_action( 'customize_register', 'progression_customizer' );


function progression_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}


function progression_customize_css()
{
    ?>
<style type="text/css">
	<?php if (get_theme_mod( 'comment_progression')) : ?><?php else: ?>body.page #respond {display:none;}<?php endif ?>
	body #logo, body #logo img {width:<?php echo get_theme_mod('logo_width', '180'); ?>px;}
	header #logo-pro { margin-left:-<?php echo get_theme_mod('logo_width', '180') / 2; ?>px;}
	header#logo-left #primary-left-nav {margin-left:<?php echo get_theme_mod('logo_width', '180') + 20; ?>px;}
	.logo_container {width:<?php echo get_theme_mod('logo_width', '180') / 2; ?>px;}
	header { background-color:<?php echo get_theme_mod('nav_bg', '#252536'); ?>; }
	body {background-color:<?php echo get_theme_mod('body_bg_progression', '#ffffff'); ?>; }
	body #page-title, body #page-title-portfolio {background-color:<?php echo get_theme_mod('page_title_bg', '#f5be05'); ?>;}
	#widget-area {background-color: <?php echo get_theme_mod('footer_border_progression', '#f1f1f1'); ?>;}
	footer {background-color: <?php echo get_theme_mod('footer_bg_progression', '#eaeaea'); ?>;}
	.page-numbers span.current, .page-numbers a:hover {	 background:<?php echo get_theme_mod('tax_bg_button_pro', '#f6c606'); ?>; border-color:<?php echo get_theme_mod('pagination_bg_button_pro', '#d1a805'); ?>;}
	.sf-menu a { color:<?php echo get_theme_mod('navigation_menu_color', '#cbcbcf'); ?>; }
    .sf-menu li.sfHover a:after, .sf-menu li.sfHover a:visited:after, .sf-menu a:hover:after, .sf-menu li.current-menu-item a:after {	background: <?php echo get_theme_mod('nav_border_pro', '#f6c606'); ?>;}
	.sf-menu a:hover, .sf-menu li.current-menu-item a, .sf-menu a:hover, .sf-menu li a:hover, .sf-menu a:hover, .sf-menu a:visited:hover, .sf-menu li.sfHover a, .sf-menu li.sfHover a:visited { background:<?php echo get_theme_mod('navigation_hover_color', '#1e1e2b'); ?>;  color:<?php echo get_theme_mod('navigation_font_hover_color', '#ffffff'); ?>; }
	#widget-area h6, h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {color: <?php echo get_theme_mod('headering_font_pro', '#3f3f3f'); ?>;}
	.woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle {
		 background:<?php echo get_theme_mod('button_bg_progression', '#f6c606'); ?>; 
	}
	.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content {  
		background:#cccccc; 
	}
	body #main .width-container .place-order input.button,
	body #main .width-container .wc-proceed-to-checkout a.button,
	body #main .width-container .summary button,
	body #main .width-container ul.products li.product a.button,
	body a.more-link, body a.progression-button, body input.wpcf7-submit, body input#submit, body a.ls-sc-button.default { background:<?php echo get_theme_mod('button_bg_progression', '#f6c606'); ?>; color:<?php echo get_theme_mod('button_font_pro', '#393939'); ?>; }
	body a.ls-sc-button.default span { color:<?php echo get_theme_mod('button_font_pro', '#393939'); ?>;}
	
	body #main .width-container .place-order input.button:hover,
	body #main .width-container .wc-proceed-to-checkout a.button:hover,
	body #main .width-container .summary button:hover,
	body #main .width-container ul.products li.product a.button:hover,
	body a.more-link:hover, body a.progression-button:hover, body input.wpcf7-submit:hover, body input#submit:hover, body a.ls-sc-button.default:hover { background: <?php echo get_theme_mod('button_hover_bg_progression', '#ffdb4d'); ?>; color:<?php echo get_theme_mod('button_hover_font_pro', '#393939'); ?>; }
	body a.ls-sc-button.default:hover {opacity:1; color:<?php echo get_theme_mod('button_hover_font_pro', '#393939'); ?>;}
 	body, .light-fonts-pro.testimonial-posts-home .testimonial-content { color:<?php echo get_theme_mod('body_font_progression', '#757575'); ?>; }
	#page-title h1, #page-title-description { color:<?php echo get_theme_mod('page_font_progression', '#ffffff'); ?>; }
	.sticky .container-blog h2 a, a, h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover {color:<?php echo get_theme_mod('body_link_progression', '#f69906'); ?>;}
	a:hover {color:<?php echo get_theme_mod('body_link_hover_progression', '#e18a00'); ?>;}
	.renovation-button a, body a.ls-sc-button.secondary { background-color:<?php echo get_theme_mod('slide_bg_button', '#2a2a3d'); ?>; color: <?php echo get_theme_mod('second_button_font_pro', '#ffffff'); ?>; }
	body a.ls-sc-button.secondary span { color:<?php echo get_theme_mod('second_button_font_pro', '#ffffff'); ?>; }
	.renovation-button a:hover, body a.ls-sc-button.secondary:hover { color:<?php echo get_theme_mod('hover_second_button_font_pro', '#ffffff'); ?>; background-color: <?php echo get_theme_mod('slide_bg_hover_button', '#383851'); ?>; }
	body a.ls-sc-button.secondary:hover { opacity:1; color:<?php echo get_theme_mod('hover_second_button_font_pro', '#ffffff'); ?>; }
</style>
    <?php
}
add_action('wp_head', 'progression_customize_css');