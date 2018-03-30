<?php
add_action( 'after_setup_theme', 'cr3ativ_conference_setup' );

function cr3ativ_conference_setup() {
    
////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////              WP Title           /////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
add_filter( 'wp_title', 'cr3_hack_wp_title_for_home' );
function cr3_hack_wp_title_for_home( $title )
{
  if( empty( $title ) && ( is_home() || is_front_page() ) ) {
    return get_bloginfo( 'name' ) . ' | ' . get_bloginfo( 'description' );
  }
  return $title;
}


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     WP Tag Cloud     //////////////////////////////////////////////// 
////////////////////////////////////////////////////////////////////////////////////////////
add_filter( 'wp_tag_cloud', 'cr3ativ_remove_tag_cloud', 10, 2 );

function cr3ativ_remove_tag_cloud ( $return, $args )
{
        return false;
}

function cr3ativ_tags() {
			
$tags = get_tags();
foreach ($tags as $tag) {
$tag_link = get_tag_link($tag->term_id);
$html = '<div class="button_tag">';
$html .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
$html .= "{$tag->name}</a>";
$html .= '</div>';
echo $html;
}
}
	
add_filter('widget_tag_cloud_args', 'cr3ativ_tags');


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////         WP Core Functionality        ////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
add_theme_support( 'post-thumbnails' );

add_theme_support( 'custom-background' );

add_theme_support( 'custom-header' );

add_theme_support( 'automatic-feed-links' );

function cr3ativ_theme_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'init', 'cr3ativ_theme_add_editor_styles' );

add_post_type_support( 'attachment:audio', 'thumbnail' );
add_post_type_support( 'attachment:video', 'thumbnail' );


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Post Format     /////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
add_theme_support( 'post-formats', array( 'audio', 'link', 'gallery', 'video', 'quote' ) );


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     2 WP Nav Menus     //////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
register_nav_menus( array(  
  'primary' => __( 'Primary Navigation', 'cr3_attend_theme' ), 
  'responsive' => __( 'Primary Responsive Menu', 'cr3_attend_theme' )
) );  	


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////              Theme Options              /////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
function cr3ativ_conference_theme_customizer( $wp_customize ) {
    
    $wp_customize->add_section( 'cr3ativ_conference_setup_section' , array(
    'title'       => __( 'Cr3ativ Attend Theme Setup', 'cr3_attend_theme' ),
    'priority'    => 1,
    'description' => __('Here are some specific settings for the Cr3ativ Attend theme', 'cr3_attend_theme' )) );
    
    $wp_customize->add_setting( 'cr3ativ_conference_logo',
    array ( 'default' => '',
    'sanitize_callback' => 'cr3ativ_esc_url_raw'
    ));
    
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cr3ativ_conference_logo', 
    array(
    'label'    => __( 'Logo', 'cr3_attend_theme' ),
    'section'  => 'cr3ativ_conference_setup_section',
    'settings' => 'cr3ativ_conference_logo',
    'description' => __('Upload a logo to replace the default site name and description in the header.', 'cr3_attend_theme' ),
    'priority' => 2,
    ) ) );
    
    $wp_customize->add_setting( 'cr3ativ_conference_favicon',
    array ( 'default' => '',
    'sanitize_callback' => 'cr3ativ_esc_url_raw'
    ));
    
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cr3ativ_conference_favicon', 
    array(
    'label'    => __( 'Favicon', 'cr3_attend_theme', 'cr3_attend_theme' ),
    'section'  => 'cr3ativ_conference_setup_section',
    'settings' => 'cr3ativ_conference_favicon',
    'description' => __('Upload 16px X 16px transparent .png favicon.', 'cr3_attend_theme' ),
    'priority' => 3,
    ) ) );
    
    $wp_customize->add_setting( 'cr3ativ_conference_analytics',
    array ( 'default' => '',
    'sanitize_callback' => 'cr3ativ_sanitize_text'
    ));
    
    $wp_customize->add_control('cr3ativ_conference_analytics', 
	array(
		'label'    => __( 'Paste analytics code', 'cr3_attend_theme', 'cr3_attend_theme' ),
		'section'  => 'cr3ativ_conference_setup_section',
		'settings' => 'cr3ativ_conference_analytics',
        'description' => __('Copy/Paste analytics code here.', 'cr3_attend_theme'),
		'type'     => 'textarea',
        'priority' => 4,
	) );
    
    $wp_customize->add_setting( 'cr3ativ_conference_customcss',
    array ( 'default' => '',
    'sanitize_callback' => 'cr3ativ_sanitize_text'
    ));
    
    $wp_customize->add_control('cr3ativ_conference_customcss', 
	array(
		'label'    => __( 'Custom CSS', 'cr3_attend_theme' ),
		'section'  => 'cr3ativ_conference_setup_section',
		'settings' => 'cr3ativ_conference_customcss',
		'description' => __('Enter any custom CSS you want to appear to over ride the stylesheet.', 'cr3_attend_theme' ),
        'type'     => 'textarea',
        'priority' => 5,
	) );
    
    $wp_customize->add_setting( 'cr3ativ_conference_defaultimg',
    array ( 'default' => '',
    'sanitize_callback' => 'cr3ativ_esc_url_raw'
    ));
    
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cr3ativ_conference_defaultimg', 
    array(
    'label'    => __( 'Default Top Image', 'cr3_attend_theme' ),
    'section'  => 'cr3ativ_conference_setup_section',
    'settings' => 'cr3ativ_conference_defaultimg',
    'description' => __('Default image to be used at top of page without a featured image or a dynamic page.', 'cr3_attend_theme' ),
    'priority' => 6,
    ) ) );
    
    $wp_customize->add_setting( 'cr3ativ_conference_homeimg1',
    array ( 'default' => '',
    'sanitize_callback' => 'cr3ativ_esc_url_raw'
    ));

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cr3ativ_conference_homeimg1', 
    array(
    'label'    => __( 'Home Top Image', 'cr3_attend_theme' ),
    'section'  => 'cr3ativ_conference_setup_section',
    'settings' => 'cr3ativ_conference_homeimg1',
    'description' => __('Upload poster to show if using a full screen image for homepage.', 'cr3_attend_theme' ),
    'priority' => 7,
    ) ) );
    
    $wp_customize->add_setting( 'cr3ativ_conference_url',
    array ( 'default' => '',
    'sanitize_callback' => 'cr3ativ_esc_url_raw'
    ));
    
    $wp_customize->add_control('cr3ativ_conference_url', 
	array(
		'label'    => __( 'Url Top of Page Button', 'cr3_attend_theme' ),
		'section'  => 'cr3ativ_conference_setup_section',
		'settings' => 'cr3ativ_conference_url',
        'description' => __('Url to button that appears on every page in top right corner above content.  If you do not enter a url here, nothing will display.', 'cr3_attend_theme' ),
		'type'     => 'text',
        'sanitize_callback' => 'cr3ativ_esc_url_raw',
        'priority' => 8,
	) );
    
    $wp_customize->add_setting( 'cr3ativ_conference_url_text',
    array ( 'default' => '',
    'sanitize_callback' => 'cr3ativ_sanitize_text'
    ));
    
    $wp_customize->add_control('cr3ativ_conference_url_text', 
	array(
		'label'    => __( 'Url Text Top of Page Button', 'cr3_attend_theme' ),
		'section'  => 'cr3ativ_conference_setup_section',
		'settings' => 'cr3ativ_conference_url_text',
        'description' => __('Url text for the above mentioned button.', 'cr3_attend_theme' ),
		'type'     => 'text',
        'priority' => 9,
	) );
    
    $wp_customize->add_setting( 'cr3ativ_conference_color1',
    array ( 'default' => '',
    'sanitize_callback' => 'cr3ativ_sanitize_hex_color'
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cr3ativ_conference_color1', array(
        'label' => __( 'Color 1', 'cr3_attend_theme' ),
        'section' => 'cr3ativ_conference_setup_section',
        'settings' => 'cr3ativ_conference_color1',
        'priority' => 10,
    ) ) );
    
    $wp_customize->add_setting( 'cr3ativ_conference_color2',
    array ( 'default' => '',
    'sanitize_callback' => 'cr3ativ_sanitize_hex_color'
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cr3ativ_conference_color2', array(
        'label' => __( 'Color 2', 'cr3_attend_theme' ),
        'section' => 'cr3ativ_conference_setup_section',
        'settings' => 'cr3ativ_conference_color2',
        'priority' => 11,
    ) ) );
    
    $wp_customize->add_setting( 'cr3ativ_conference_color3',
    array ( 'default' => '',
    'sanitize_callback' => 'cr3ativ_sanitize_hex_color'
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cr3ativ_conference_color3', array(
        'label' => __( 'Color 3', 'cr3_attend_theme' ),
        'section' => 'cr3ativ_conference_setup_section',
        'settings' => 'cr3ativ_conference_color3',
        'priority' => 12,
    ) ) );
    
    $wp_customize->add_setting( 'cr3ativ_conference_color4',
    array ( 'default' => '',
    'sanitize_callback' => 'cr3ativ_sanitize_hex_color'
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cr3ativ_conference_color4', array(
        'label' => __( 'Color 4', 'cr3_attend_theme' ),
        'section' => 'cr3ativ_conference_setup_section',
        'settings' => 'cr3ativ_conference_color4',
        'priority' => 13,
    ) ) );
    
    $wp_customize->add_setting( 'cr3ativ_conference_color6',
    array ( 'default' => '',
    'sanitize_callback' => 'cr3ativ_sanitize_hex_color'
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cr3ativ_conference_color6', array(
        'label' => __( 'Color 5', 'cr3_attend_theme' ),
        'section' => 'cr3ativ_conference_setup_section',
        'settings' => 'cr3ativ_conference_color6',
        'priority' => 15,
    ) ) );
    
    $wp_customize->add_setting( 'cr3ativ_conference_videomp4',
    array ( 'default' => '',
    'sanitize_callback' => 'cr3ativ_esc_url_raw'
    ));
    
    $wp_customize->add_control('cr3ativ_conference_videomp4', 
	array(
		'label'    => __( 'Url mp4 video', 'cr3_attend_theme' ),
		'section'  => 'cr3ativ_conference_setup_section',
		'settings' => 'cr3ativ_conference_videomp4',
		'type'     => 'text',
        'sanitize_callback' => 'cr3ativ_esc_url_raw',
        'priority' => 19,
	) );
    
    $wp_customize->add_setting( 'cr3ativ_conference_videowebm',
    array ( 'default' => '',
    'sanitize_callback' => 'cr3ativ_esc_url_raw'
    ));
    
    $wp_customize->add_control('cr3ativ_conference_videowebm', 
	array(
		'label'    => __( 'Url webm video', 'cr3_attend_theme' ),
		'section'  => 'cr3ativ_conference_setup_section',
		'settings' => 'cr3ativ_conference_videowebm',
		'type'     => 'text',
        'sanitize_callback' => 'cr3ativ_esc_url_raw',
        'priority' => 20,
	) );
    

}

add_action('customize_register', 'cr3ativ_conference_theme_customizer');


    
function cr3ativ_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}    
    
    
function cr3ativ_esc_url_raw( $url, $protocols = null ) {
	return esc_url( $url, $protocols, 'db' );
}            
    
function cr3ativ_sanitize_hex_color( $color ) {
	if ( '' === $color )
		return '';

	// 3 or 6 hex digits, or the empty string.
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
		return $color;

	return null;
}
            
    
////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Load JS & Stylesheet Scripts     ////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
include_once( 'functions/theme-scripts.php' );

/*  Enqueue css
/* ------------------------------------ */ 
function cr3ativ_styles()
{
    wp_enqueue_style( 'style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'cr3ativ_styles' ); 


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Theme Options for widget     ////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
include_once( 'functions/theme-options-widgets.php' );


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Comments     ////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
function cr3ativ_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

<div class="comment-main">

<div class="comment-meta">
    
<div class="comment-author-avatar">
    
<?php echo get_avatar($comment, 101); ?>
    
</div>

<?php printf(__('<span class="comment-author">%s</span>', 'cr3_attend_theme'), get_comment_author_link()) ?>

<span class="comment-date"><?php printf(__('%1$s at %2$s', 'cr3_attend_theme'), get_comment_date(),  get_comment_time()) ?></span>

</div>  

<div class="comment-content">      
<?php if ($comment->comment_approved == '0') : ?>
<p><em><?php _e('Your comment is awaiting moderation.', 'cr3_attend_theme') ?></em></p>
<?php comment_text() ?>

<?php else : { ?>

<?php comment_text() ?>  

<?php } ?>  
    
<div class="button"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>

<?php endif; ?>

</div> 

</div>

<?php }
				
	
////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Content width set     ///////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
if ( ! isset( $content_width ) ) 
    $content_width = 1200;
		

////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Text Domain     /////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
load_theme_textdomain ('cr3_attend_theme');


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Multi Language Ready     ////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
load_theme_textdomain( 'cr3_attend_theme', get_template_directory().'/languages' );

$locale = get_locale();
$locale_file = get_template_directory()."/languages/$locale.php";
if ( is_readable($locale_file) )
	require_once($locale_file);


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Allow Shortcodes in Widgets     /////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
add_filter('widget_text', 'do_shortcode');

}

?>