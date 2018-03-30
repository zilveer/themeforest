<?php

/*-----------------------------------------------------------------------------------*/
/*	Theme Customization Options
/*-----------------------------------------------------------------------------------*/
 
add_action( 'customize_register', 'themename_customize_register' );

function themename_customize_register($wp_customize) {

	$wp_customize->remove_section('colors');
	$wp_customize->remove_control('blogdescription');
	$wp_customize->get_section('static_front_page')->priority = 20;
	// $wp_customize->get_section('nav')->priority = 30;

	/*-----------------------------------------------------------------------------------*/
	/*	General Settings
	/*-----------------------------------------------------------------------------------*/

	$wp_customize->get_section('title_tagline')->priority = 10;
	
	$wp_customize->add_setting( 'oy_tagline', array(
	    'sanitize_callback' => 'onioneye_sanitize_textarea',
	) );

    $wp_customize->add_control( new Textarea_Custom_Control( $wp_customize, 'oy_ctrl_tagline', array(
        'label'     => __('Tagline', 'onioneye'),
        'section'   => 'title_tagline',
        'settings'  => 'oy_tagline',
    ) ) );
    
	/*-----------------------------------------------------------------------------------*/
	/*	Logo
	/*-----------------------------------------------------------------------------------*/
	
	$wp_customize->add_section('oy_logo', array(
	    'title'          => __('Logo', 'onioneye' ),
	    'priority'       => 20,
	));
	
	$wp_customize->add_setting('oy_logo', array(
	    'sanitize_callback' => 'onioneye_validate_url',
	) );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'oy_ctrl_logo', array(
        'label'   => __('Main Logo', 'onioneye'),
        'section' => 'oy_logo',
        'settings'   => 'oy_logo',
    ) ) );
    
    $wp_customize->add_setting('oy_is_logo_retina', array(
	    'sanitize_callback' => 'onioneye_validate_simple_checkbox',
	) );
    
    $wp_customize->add_control('oy_retina_ready', array(
	    'label'    => __('Make the logo retina ready? (This will &ldquo;squash&rdquo; the logo in half to make it look sharp on retina devices)', 'onioneye'),
	    'section'  => 'oy_logo',
	    'type'     => 'checkbox',
		'settings' => 'oy_is_logo_retina',
	) );
	
	/*-----------------------------------------------------------------------------------*/
	/*	Drop-down content
	/*-----------------------------------------------------------------------------------*/
	
	$wp_customize->add_section('oy_drop_down', array(
	    'title'          => __('Drop-down Content', 'onioneye' ),
	    'description'    => __('Choose one of the existent pages, whose content will be displayed in the top-right hand side of your site, as a drop-down page.', 'onioneye'),
	    'priority'       => 40,
	));
	
	$wp_customize->add_setting('oy_drop_down_page', array(
	    'sanitize_callback' => 'onioneye_sanitize_page_titles',
	) );
    
    $wp_customize->add_control('oy_ctrl_drop_down_page', array(
	    'section'  => 'oy_drop_down',
	    'type'     => 'dropdown-pages',
		'settings' => 'oy_drop_down_page',
	) );
		
	/*-----------------------------------------------------------------------------------*/
	/*	Client Logos Page
	/*-----------------------------------------------------------------------------------*/
	
	$wp_customize->add_section('oy_client_logos', array(
	    'title'          => __('Client Logos', 'onioneye'),
	    'description'    => __('Choose one of the existent pages, whose content will be displayed under the &ldquo;Clients&rdquo; section of the portfolio page. You can put your clients&rsquo; logos here, or any other type of content.', 'onioneye'),
	    'priority'       => 50,
	));
    
    $wp_customize->add_setting('oy_client_logos', array(
	    'sanitize_callback' => 'onioneye_sanitize_page_titles',
	) );
    
    $wp_customize->add_control('oy_ctrl_client_logos', array(
	    'section'  => 'oy_client_logos',
	    'type'     => 'dropdown-pages',
		'settings' => 'oy_client_logos',
	) );
	
	/*-----------------------------------------------------------------------------------*/
	/*	Blog Settings
	/*-----------------------------------------------------------------------------------*/
	
	$wp_customize->add_section('onioneye_blog', array(
	    'title'          => __('Blog Settings', 'onioneye' ),
	    'priority'       => 70,
	)); 
	
	$wp_customize->add_setting('oy_sidebar_enabled', array(
	    'sanitize_callback' => 'onioneye_validate_simple_checkbox',
	) );
    
    $wp_customize->add_control('oy_ctrl_sidebar', array(
	    'label'    => __('Enable sidebar in the blog?', 'onioneye'),
	    'section'  => 'onioneye_blog',
	    'type'     => 'checkbox',
		'settings' => 'oy_sidebar_enabled',
	));
	
	$wp_customize->add_setting('oy_post_content', array(
	    'default'    => 'excerpt',
	    'type'       => 'option',
	    'sanitize_callback' => 'onioneye_validate_post_content_radio',
	) );
	
	$wp_customize->add_control( 'oy_ctrl_post_content', array(
	    'label'      => __('Show excerpt or the whole post?', 'onioneye'),
	    'section'    => 'onioneye_blog',
	    'settings'   => 'oy_post_content',
	    'type'       => 'radio',
	    'choices'    => array(
	        'excerpt' => __('Post Excerpt', 'onioneye'),
	        'full' => __('Full Content', 'onioneye'),
	        ),
	));
	
	
	/*-----------------------------------------------------------------------------------*/
	/*	Typography Settings
	/*-----------------------------------------------------------------------------------*/
	
	$wp_customize->add_section('onioneye_typography', array(
	    'title'          => __('Typography', 'onioneye' ),
	    'description'    => __('Choose to load additional characters for Cyrillic, Greek, or Vietnamese language. Use this only if you need support for alphabets other than Latin.', 'onioneye'),
	    'priority'       => 73,
	)); 
	
	$wp_customize->add_setting('onioneye_extended_chars_enabled', array(
	    'sanitize_callback' => 'onioneye_validate_simple_checkbox',
	) );
    
    $wp_customize->add_control('onioneye_ctrl_extended_chars_enabled', array(
	    'label'    => __('Enable extended character sets for the theme&#8217;s fonts?', 'onioneye'),
	    'section'  => 'onioneye_typography',
	    'type'     => 'checkbox',
		'settings' => 'onioneye_extended_chars_enabled',
	));
	
	
	/*-----------------------------------------------------------------------------------*/
	/*	Social Networks
	/*-----------------------------------------------------------------------------------*/
    
    $wp_customize->add_section( 'oy_social_networks', array(
	    'title'          => __( 'Social Networks', 'onioneye' ),
	    'priority'       => 75,
	) ); 
	
	$wp_customize->add_setting('oy_facebook', array(
	    'sanitize_callback' => 'onioneye_validate_url',
	) );
    
    $wp_customize->add_control('oy_ctrl_facebook', array(
	    'label'    => __('FaceBook URL', 'onioneye'),
	    'section'  => 'oy_social_networks',
	    'type'     => 'text',
		'settings' => 'oy_facebook',
	) );
	
	$wp_customize->add_setting('oy_twitter', array(
	    'sanitize_callback' => 'onioneye_validate_url',
	) );
    
    $wp_customize->add_control('oy_ctrl_twitter', array(
	    'label'    => __('Twitter URL', 'onioneye'),
	    'section'  => 'oy_social_networks',
	    'type'     => 'text',
		'settings' => 'oy_twitter',
	) );
	
	$wp_customize->add_setting('oy_googleplus', array(
	    'sanitize_callback' => 'onioneye_validate_url',
	) );
    
    $wp_customize->add_control('oy_ctrl_googleplus', array(
	    'label'    => __('Google Plus URL', 'onioneye'),
	    'section'  => 'oy_social_networks',
	    'type'     => 'text',
		'settings' => 'oy_googleplus',
	) );
	
	$wp_customize->add_setting('oy_pinterest', array(
	    'sanitize_callback' => 'onioneye_validate_url',
	) );
    
    $wp_customize->add_control('oy_ctrl_pinterest', array(
	    'label'    => __('Pinterest URL', 'onioneye'),
	    'section'  => 'oy_social_networks',
	    'type'     => 'text',
		'settings' => 'oy_pinterest',
	) );
	
	$wp_customize->add_setting('oy_instagram', array(
	    'sanitize_callback' => 'onioneye_validate_url',
	) );
    
    $wp_customize->add_control('oy_ctrl_instagram', array(
	    'label'    => __('Instagram URL', 'onioneye'),
	    'section'  => 'oy_social_networks',
	    'type'     => 'text',
		'settings' => 'oy_instagram',
	) );
	
	$wp_customize->add_setting('oy_youtube', array(
	    'sanitize_callback' => 'onioneye_validate_url',
	) );
    
    $wp_customize->add_control('oy_ctrl_youtube', array(
	    'label'    => __('YouTube URL', 'onioneye'),
	    'section'  => 'oy_social_networks',
	    'type'     => 'text',
		'settings' => 'oy_youtube',
	) );
	
	$wp_customize->add_setting('oy_vimeo', array(
	    'sanitize_callback' => 'onioneye_validate_url',
	) );
    
    $wp_customize->add_control('oy_ctrl_vimeo', array(
	    'label'    => __('Vimeo URL', 'onioneye'),
	    'section'  => 'oy_social_networks',
	    'type'     => 'text',
		'settings' => 'oy_vimeo',
	) );
	
	$wp_customize->add_setting('oy_tumblr', array(
	    'sanitize_callback' => 'onioneye_validate_url',
	) );
    
    $wp_customize->add_control('oy_ctrl_tumblr', array(
	    'label'    => __('Tumblr URL', 'onioneye'),
	    'section'  => 'oy_social_networks',
	    'type'     => 'text',
		'settings' => 'oy_tumblr',
	) );
	
	$wp_customize->add_setting('oy_linkedin', array(
	    'sanitize_callback' => 'onioneye_validate_url',
	) );
    
    $wp_customize->add_control('oy_ctrl_linkedin', array(
	    'label'    => __('Linkedin URL', 'onioneye'),
	    'section'  => 'oy_social_networks',
	    'type'     => 'text',
		'settings' => 'oy_linkedin',
	) );
	
	$wp_customize->add_setting('oy_soundcloud', array(
	    'sanitize_callback' => 'onioneye_validate_url',
	) );
    
    $wp_customize->add_control('oy_ctrl_soundcloud', array(
	    'label'    => __('SoundCloud URL', 'onioneye'),
	    'section'  => 'oy_social_networks',
	    'type'     => 'text',
		'settings' => 'oy_soundcloud',
	) );
	
	$wp_customize->add_setting('oy_behance', array(
	    'sanitize_callback' => 'onioneye_validate_url',
	) );
    
    $wp_customize->add_control('oy_ctrl_behance', array(
	    'label'    => __('Behance URL', 'onioneye'),
	    'section'  => 'oy_social_networks',
	    'type'     => 'text',
		'settings' => 'oy_behance',
	) );
	
	$wp_customize->add_setting('oy_dribbble', array(
	    'sanitize_callback' => 'onioneye_validate_url',
	) );
    
    $wp_customize->add_control('oy_ctrl_dribbble', array(
	    'label'    => __('Dribbble URL', 'onioneye'),
	    'section'  => 'oy_social_networks',
	    'type'     => 'text',
		'settings' => 'oy_dribbble',
	) );

	
	/*-----------------------------------------------------------------------------------*/
	/*	Footer Settings
	/*-----------------------------------------------------------------------------------*/
		
	$wp_customize->add_section( 'oy_footer', array(
	    'title'          => __( 'Footer Settings', 'onioneye' ),
	    'priority'       => 80,
	) ); 
	
	$wp_customize->add_setting('oy_disable_widgetized_area', array(
	    'sanitize_callback' => 'onioneye_validate_simple_checkbox',
	) );    
	
    $wp_customize->add_control('oy_ctrl_disable_widgetized_area', array(
	    'label'    => __('Disable the Widgetized Footer Overlay?', 'onioneye'),
	    'section'  => 'oy_footer',
	    'type'     => 'checkbox',
		'settings' => 'oy_disable_widgetized_area',
	));
	
	$wp_customize->add_setting('oy_no_of_columns', array(
		'type'     => 'option',
		'default'  => 4,
		'sanitize_callback' => 'absint',
	));
	
	$wp_customize->add_control('oy_ctrl_no_of_columns', array(
	    'label'      => __('Number of Columns in the Widgetized Footer Overlay', 'onioneye'),
	    'section'    => 'oy_footer',
	    'settings'   => 'oy_no_of_columns',
	    'type'       => 'radio',
	    'choices'    => array(
	        1 => __('One', 'onioneye'),
	        2 => __('Two', 'onioneye'),
	        3 => __('Three', 'onioneye'),
	        4 => __('Four', 'onioneye'),
	    ),
	));
	
	
	/*-----------------------------------------------------------------------------------*/
	/*	Background Image
	/*-----------------------------------------------------------------------------------*/
		
	$wp_customize->get_section('background_image')->title = __('Background Settings', 'onioneye');
	
} 

/*-----------------------------------------------------------------------------------*/
/*	Option Validation 
/*-----------------------------------------------------------------------------------*/

function onioneye_validate_simple_checkbox($value) {
	return ($value === 1 || $value === true) ? 1 : 0;
}

function onioneye_validate_post_content_radio($value) {
	return ($value === 'excerpt') ? 'excerpt' : 'full';
}

function onioneye_validate_email($value) {
	$value = trim($value);
	$value = is_email($value) ? $value : '';

	return $value;
}

function onioneye_sanitize_textarea($value) {
	$value = $value ? wp_kses_post($value) : '';
	
	return $value;
}

function onioneye_sanitize_page_titles($value) {
	$value = $value ? sanitize_text_field($value) : '';
	
	return $value;
}

function onioneye_validate_url($value) {
	$value = $value ? esc_url_raw($value) : '';

	return $value;
}


/*-----------------------------------------------------------------------------------*/
/*	WP Customizer Extensions 
/*-----------------------------------------------------------------------------------*/

/**
 * Customize for textarea, extend the WP customizer
 *
 * @package    WordPress
 * @subpackage Wordpress-Theme-Customizer-Custom-Controls
 * @see        https://github.com/bueltge/Wordpress-Theme-Customizer-Custom-Controls
 * @since      10/16/2012
 * @author     Frank Bültge <frank@bueltge.de>
 */

if ( ! class_exists( 'WP_Customize_Control' ) )
	return NULL;

class Textarea_Custom_Control extends WP_Customize_Control {
	
	/**
	 * @access public
	 * @var    string
	 */
	public $type = 'textarea';
	
	/**
	 * @access public
	 * @var    array
	 */
	public $statuses;
	
	/**
	 * Constructor.
	 *
	 * If $args['settings'] is not defined, use the $id as the setting ID.
	 *
	 * @since   10/16/2012
	 * @uses    WP_Customize_Control::__construct()
	 * @param   WP_Customize_Manager $manager
	 * @param   string $id
	 * @param   array $args
	 * @return  void
	 */
	public function __construct( $manager, $id, $args = array() ) {
		
		$this->statuses = array( '' => __( 'Default', 'onioneye' ) );
		parent::__construct( $manager, $id, $args );
	}
	
	/**
	 * Render the control's content.
	 * 
	 * Allows the content to be overriden without having to rewrite the wrapper.
	 * 
	 * @since   10/16/2012
	 * @return  void
	 */
	public function render_content() {
		?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<textarea class="large-text" cols="20" rows="5" <?php $this->link(); ?>>
				<?php echo esc_textarea( $this->value() ); ?>
			</textarea>
		</label>
		<?php
	}
	
}

?>