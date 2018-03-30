<?php

//-----------------------------------  // Define Paths //-----------------------------------//
define('of_dir', get_template_directory_uri() . '/includes/options-framework/');

//-----------------------------------  // Load Scripts //-----------------------------------//

function cr_scripts_styles() {

	//Main Stylesheet
	wp_enqueue_style( 'style', get_stylesheet_uri());
	
	//Media Queries CSS
	wp_enqueue_style( 'media_queries_css', get_template_directory_uri() . "/media-queries.css", array(), '0.1', 'screen' );
	
	//Google Bitter
	wp_enqueue_style('google_bitter', 'http://fonts.googleapis.com/css?family=Bitter:400,700');

	//Google Niconne
	wp_enqueue_style('google_niconne', 'http://fonts.googleapis.com/css?family=Niconne');    
	
	//Google Open Sans
	wp_enqueue_style('google_opensans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,600');
	  
	//Fancybox CSS
	wp_enqueue_style( 'fancybox_css', get_template_directory_uri() . "/includes/js/fancybox/jquery.fancybox-1.3.4.css", array(), '0.1', 'screen' );
	
	//Flexslider CSS
	wp_enqueue_style( 'flex_css', get_template_directory_uri() . "/includes/js/flex/flexslider.css", array(), '0.1', 'screen' );
    
    //Custom Scroll CSS
	wp_enqueue_style( 'custom_scroll_css', get_template_directory_uri() . "/includes/js/scrollbar/mCustomScrollbar.css");
    
    //FontAwesome
	wp_enqueue_style('font-awesome', get_stylesheet_directory_uri().'/includes/fontawesome/font-awesome.css');
	
	//Register jQuery
	wp_enqueue_script('jquery');
	
	//Fancybox Easing
	wp_enqueue_script('fancybox_js', get_template_directory_uri() . '/includes/js/fancybox/jquery.fancybox-1.3.4.pack.js', array('jquery'), false, true);
	
	//FlexSlider
	wp_enqueue_script('flex_js', get_template_directory_uri() . '/includes/js/flex/jquery.flexslider.js', array('jquery'), false, true);
	
	//ToTop
	wp_enqueue_script('back-to-top', get_template_directory_uri().'/includes/js/jquery.ui.totop.min.js', array('jquery'), false, true);
    
    //Custom Scrollbar  
	wp_enqueue_script('customscroll', get_template_directory_uri().'/includes/js/scrollbar/mCustomScrollbar.min.js', array('jquery'), false, true);
    
    //MouseWheel
	wp_enqueue_script('mousewheel', get_template_directory_uri().'/includes/js/scrollbar/mousewheel.min.js', array('jquery'), false, true);
	
    //FitVids
	wp_enqueue_script('fitvids', get_template_directory_uri().'/includes/js/jquery.fitvids.js', array('jquery'), false, true);
    
    //Imagesloaded
	wp_enqueue_script('imagesloaded', get_template_directory_uri().'/includes/js/imagesloaded.pkgd.min.js', array('jquery'), false, true);
    
    //Isotope
	wp_enqueue_script('isotope', get_template_directory_uri().'/includes/js/isotope.pkgd.min.js', array('jquery'), false, true);
    
    //Custom JS
	wp_enqueue_script('custom_js', get_template_directory_uri() . '/includes/js/custom/custom.js', array('jquery'), false, true);
	
	//Jcustom
	wp_localize_script('custom_js', 'ajax_custom', array(
		'ajaxurl' => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('cr_ajax'),
		'loading' => __('Loading...', 'cr')
		));
	
}
add_action( 'wp_enqueue_scripts', 'cr_scripts_styles' );

//-----------------------------------  // Load Options Framework //-----------------------------------//

require_once(dirname(__FILE__) . "/includes/options-framework/options-framework.php");

/* 
 * Helper function to return the theme option value. If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 */

if ( !function_exists( 'of_get_option' ) ) {
function of_get_option($name, $default = false) {
	
	$optionsframework_settings = get_option('optionsframework');
	
	// Gets the unique option id
	$option_name = $optionsframework_settings['id'];
	
	if ( get_option($option_name) ) {
		$options = get_option($option_name);
	}
		
	if ( isset($options[$name]) ) {
		return $options[$name];
	} else {
		return $default;
	}
}
}

//-----------------------------------  // Add Custom Google Fonts //-----------------------------------//

if ( of_get_option('of_googlefontcode') == true) {
function cr_google_fonts() {
    echo of_get_option('of_googlefontcode', 'no entry');        
}
add_action('wp_head', 'cr_google_fonts');
}

//-----------------------------------  // Add Custom CSS To Header //-----------------------------------//

function customizer_css() {
    ?>
	<style type="text/css">
<?php 
if ( of_get_option('of_colorpicker') == true) { ?>
	a { color:<?php echo of_get_option('of_colorpicker'); ?>;}
	.scroll .flex-control-nav li a.active { background:<?php echo of_get_option('of_colorpicker'); ?>;}
<?php 
}
    
if ( of_get_option('of_backgroundcolor') == true) { ?>
	body { background:<?php echo of_get_option('of_backgroundcolor'); ?>;}
<?php 
}

if ( of_get_option('of_backgroundimage') == true) { ?>	
	#backgrimage{
		background: url('<?php echo of_get_option('of_backgroundimage'); ?>') fixed;
		background-position: center;
		<?php if ( of_get_option('of_backgroundrepeat')=="1") { ?>background-repeat: repeat;
		<?php } else { ?>background-repeat: no-repeat;
		background-size: cover;<?php } ?>}
<?php 
} 
    
if ( of_get_option('of_leftsidebarcolor') == true) { ?>
	#leftsidebar, .mobile-logo-wrap { background:<?php echo of_get_option('of_leftsidebarcolor'); ?>;}
<?php 
}
    
if (of_get_option('of_masonryswitchhome')=="1" && is_home()) { ?>	
	body.home #content{ width: 100% !important;
                           margin-bottom: 70px;}
<?php 
}    

if (of_get_option('of_masonryswitch')=="1" && !is_single()) { ?>	
	body.archive #content, body.search #content{ width: 100% !important;
                           margin-bottom: 70px;}
<?php 
} 
    
// Fonts Settings
if ( of_get_option('of_logofont') == true) { ?>
	.logo-text a{font-family: <?php echo of_get_option('of_logofont'); ?>;}
<?php 
}
    
if ( of_get_option('of_menufont') == true) { ?>
	.main-nav a, .secondary-menu li a{font-family: <?php echo of_get_option('of_menufont'); ?>;}
<?php 
}
    
if ( of_get_option('of_hdrsfont') == true) { ?>
	h1, h2, h3, h4, h5, h6{font-family: <?php echo of_get_option('of_hdrsfont'); ?>;}
<?php 
}
if ( of_get_option('of_posttitles') == true) { ?>
	#content .entry-title a{font-family: <?php echo of_get_option('of_posttitles'); ?>!important;}
<?php 
}

if ( of_get_option('of_postmeta') == true) { ?>
	.title-meta{font-family: <?php echo of_get_option('of_postmeta'); ?>;}
<?php 
}
    
if ( of_get_option('of_postfont') == true) { ?>
	p {font-family: <?php echo of_get_option('of_postfont'); ?>!important;}
<?php 
}
    
if ( of_get_option('of_logofontsize') == true) { ?>
	.logo-text a{font-size: <?php echo of_get_option('of_logofontsize'); ?>!important;}
<?php 
}
    
if ( of_get_option('of_menufontsize') == true) { ?>
	.main-nav a{font-size: <?php echo of_get_option('of_menufontsize'); ?>!important;}
<?php 
}

if ( of_get_option('of_titlefontsize') == true) { ?>
	#content .entry-title a{font-size: <?php echo of_get_option('of_titlefontsize'); ?>!important;}
<?php 
}
    
if ( of_get_option('of_postmetasz') == true) { ?>
	.title-meta{font-size: <?php echo of_get_option('of_postmetasz'); ?>;}
<?php 
}
    
if ( of_get_option('of_postmetaszmsnr') == true) { ?>
	.masonr .title-meta{font-size: <?php echo of_get_option('of_postmetaszmsnr'); ?>;}
<?php 
}
    
if ( of_get_option('of_postfontsize') == true) { ?>
	#content p{font-size: <?php echo of_get_option('of_postfontsize'); ?>!important;}
<?php 
}

if ( of_get_option('of_sharefontsize') == true) { ?>
	.bar .share i{font-size: <?php echo of_get_option('of_sharefontsize'); ?>!important;}
<?php 
}
    
if ( of_get_option('of_sharefontsizemas') == true) { ?>
	.masonr .bar .share i{font-size: <?php echo of_get_option('of_sharefontsizemas'); ?>!important;}
<?php 
}

// Color settings 
if ( of_get_option('of_logocolor') == true) { ?>
	.logo-text a{
        color: <?php echo of_get_option('of_logocolor'); ?>;}
<?php 
}

if ( of_get_option('of_logohovercolor') == true) { ?>
    .logo-text a:hover{
        color: <?php echo of_get_option('of_logohovercolor'); ?>;}
<?php 
}

if ( of_get_option('of_menucolor') == true) { ?>
	.main-nav a {color: <?php echo of_get_option('of_menucolor'); ?>;}
<?php 
}

if ( of_get_option('of_menuhovercolor') == true) { ?>
	.main-nav a:hover, .main-nav > li > a:hover, .main-nav li ul a:hover{color: <?php echo of_get_option('of_menuhovercolor'); ?>;}
<?php 
}
    
if ( of_get_option('of_menubgcolor') == true) { ?>
	.main-nav > li:hover > a{background: <?php echo of_get_option('of_menubgcolor'); ?>;}
<?php 
}

    
// Layout Settings
$page_layout = of_get_option('of_layout');
if ($page_layout == "left") {
    ?>
    #sidebar { float: left; margin-left: 0; margin-right: 2%;}
	#content { float: right;}
    <?php
} else if ($page_layout == "without") {
    ?>
    #sidebar { display: none;}
    <?php
}
    
if ( of_get_option('of_contentwidth') == true) { ?>
    @media screen and (min-width:1280px) {
        #content { width:<?php echo of_get_option('of_contentwidth'); ?>;}
    }
<?php 
}

if ( of_get_option('of_sidebarwidth') == true) { ?>
    @media screen and (min-width:1280px) {
        #sidebar { width:<?php echo of_get_option('of_sidebarwidth'); ?>;}
    }
<?php 
}

    
if ( of_get_option('of_buttonscolor') == true) { ?>
	a#load-more, .post-nav a, .prev-post a, .next-post a, .form-submit #submit, #submittedContact{
        background: <?php echo of_get_option('of_buttonscolor'); ?>;
        border-color: <?php echo of_get_option('of_buttonscolor'); ?>;
    }
<?php  
}

if ( of_get_option('of_buttonstextcolor') == true) { ?>
	.form-submit #submit, #submittedContact, a#load-more, .post-nav a, .prev-post a, .next-post a{color:<?php echo of_get_option('of_buttonstextcolor'); ?>;}
<?php 
}

if ( of_get_option('of_buttonshover') == true) { ?>
	.form-submit #submit:hover, #submittedContact:hover, a#load-more:hover, .post-nav a:hover, .prev-post a:hover, .next-post a:hover{
        background:<?php echo of_get_option('of_buttonshover'); ?>;
        border-color:<?php echo of_get_option('of_buttonshover'); ?>;
    }
<?php 
}

if ( of_get_option('of_buttonstexthovercolor') == true) { ?>
	.form-submit #submit:hover, #submittedContact:hover, a#load-more:hover, .post-nav a:hover, .prev-post a:hover, .next-post a:hover {
        color:<?php echo of_get_option('of_buttonstexthovercolor'); ?>;
    }
<?php 
}

if ( of_get_option('of_tagscolor') == true) { ?>
	.tagcloud a{color:<?php echo of_get_option('of_tagscolor'); ?>;}
<?php 
}
    
if ( of_get_option('of_tagsbgcolor') == true) { ?>
	.tagcloud a{background:<?php echo of_get_option('of_tagsbgcolor'); ?>;
                              border-color:<?php echo of_get_option('of_tagsbgcolor'); ?>;}
<?php 
}

if ( of_get_option('of_tagshovercolor') == true) { ?>
	.tagcloud a:hover, span.tags a:hover {color:<?php echo of_get_option('of_tagshovercolor'); ?>;
                       border-color:<?php echo of_get_option('of_tagshovercolor'); ?>;}
<?php 
}

if ( of_get_option('of_tagsbghvcolor') == true) { ?>
	.tagcloud a:hover{background:<?php echo of_get_option('of_tagsbghvcolor'); ?>;
                              border-color:<?php echo of_get_option('of_tagsbghvcolor'); ?>;}
<?php 
}

if ( of_get_option('of_sdbrbckgrndcol') == true) { ?>
	#sidebar .widget {background-color:<?php echo of_get_option('of_sdbrbckgrndcol'); ?>;}
<?php 
}

if ( of_get_option('of_sdbrtxtcol') == true) { ?>
	#sidebar {color:<?php echo of_get_option('of_sdbrtxtcol'); ?>;}
<?php 
}
    
if ( of_get_option('of_sdbrttlcol') == true) { ?>
	#sidebar .widgettitle{
        color:<?php echo of_get_option('of_sdbrttlcol'); ?>;
        border-color:<?php echo of_get_option('of_sdbrttlcol'); ?>;}
<?php 
}   
    
if ( of_get_option('of_ftrbgcol') == true) { ?>
	#footer {background:<?php echo of_get_option('of_ftrbgcol'); ?>;}
<?php 
}

if ( of_get_option('of_ftrtxtcol') == true) { ?>
	#footer {color:<?php echo of_get_option('of_ftrtxtcol'); ?>;}
<?php 
}

if ( of_get_option('of_ftrtitlecol') == true) { ?>
	#footer .widgettitle {
        color:<?php echo of_get_option('of_ftrtitlecol'); ?>;
        border-color:<?php echo of_get_option('of_ftrtitlecol'); ?>;}
<?php 
}
    
if ( of_get_option('of_postbgcolor') == true) { ?>
	.post, .comments {background:<?php echo of_get_option('of_postbgcolor'); ?>;}
<?php 
}

if ( of_get_option('of_postmetalinkscolor') == true) { ?>
	.title-meta a, .masonr .title-meta a {color:<?php echo of_get_option('of_postmetalinkscolor'); ?>;}
<?php 
}

if ( of_get_option('of_postlinkscolor') == true) { ?>
	.post-content a {color:<?php echo of_get_option('of_postlinkscolor'); ?>;}
<?php 
}

if ( of_get_option('of_posttextcolor') == true) { ?>
	#content {color:<?php echo of_get_option('of_posttextcolor'); ?>;}
<?php 
}

if ( of_get_option('of_posttitlecolor') == true) { ?>
	#content .entry-title a {color:<?php echo of_get_option('of_posttitlecolor'); ?>;}
<?php 
}

if ( of_get_option('of_posttitlehovercolor') == true) { ?>
	#content .entry-title a:hover {color:<?php echo of_get_option('of_posttitlehovercolor'); ?>;}
<?php 
}

if ( of_get_option('of_postbariconscolor') == true) { ?>
	.bar .share a {color:<?php echo of_get_option('of_postbariconscolor'); ?>;}
<?php 
}

if ( of_get_option('of_postbariconshovercolor') == true) { ?>
	.bar .share a:hover {color:<?php echo of_get_option('of_postbariconshovercolor'); ?>;}
<?php 
}

if ( of_get_option('of_theme_css')==true ) { echo of_get_option('of_theme_css'); } 
?>
	</style>
    <?php
}
add_action('wp_head', 'customizer_css');


//-----------------------------------  // Add Localization //-----------------------------------//
load_theme_textdomain( 'cr', get_template_directory() . '/includes/languages' );


//-----------------------------------  // Popular Posts Widget //-----------------------------------//
$popular_posts = $wpdb->get_results("SELECT id,post_title FROM {$wpdb->prefix}posts ORDER BY comment_count DESC LIMIT 0,5");
foreach($popular_posts as $post) {
	// Do something with the $post variable
}		


//-----------------------------------  // Add Metaboxes//-----------------------------------//
require_once(dirname(__FILE__) . "/includes/meta/meta-boxes.php");


//-----------------------------------  // Editor Styles and Shortcodes //-----------------------------------//
require_once(dirname(__FILE__) . "/includes/editor/add-styles.php");


//-----------------------------------  // Auto Feed Links //-----------------------------------//
add_theme_support( 'automatic-feed-links' );


//-----------------------------------  // Title Function //-----------------------------------//
function cr_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'cr' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'cr_wp_title', 10, 2 );


//-----------------------------------  // Gallery Support //-----------------------------------//
function cr_theme_setup(){
	add_theme_support('cr_themes_gallery_support');
}
add_action('after_setup_theme', 'cr_theme_setup');

//-----------------------------------  // Set Custom Exerpt //-----------------------------------//
function cr_excerpt_length($length) {
	if ( of_get_option('of_excerptlength') == true) {
	$exclength = of_get_option('of_excerptlength');
	return $exclength;
	}
}
add_filter('excerpt_length', 'cr_excerpt_length');

function my_custom_read_more($more){  
  
return '<p><a class="more-link" href="'. get_permalink( get_the_ID() ) . '">'.of_get_option('of_readmorename').'</a></p>';  
}  
  
add_filter( 'excerpt_more', 'my_custom_read_more' ); 

//-----------------------------------  // Add Post Format //-----------------------------------//

add_theme_support('post-formats', array( 'aside', 'gallery', 'image', 'quote', 'link', 'audio', 'video' ));


//-----------------------------------  // Custom Excerpt //-----------------------------------//

function string_limit_words($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}


//-----------------------------------  // Add Lightbox to Attachments //-----------------------------------//
add_filter( 'wp_get_attachment_link', 'gallery_lightbox');
		
function gallery_lightbox ($content) {
	$galleryid = get_the_ID();
	
	// adds a lightbox to single page elements
	if(is_single() || is_page()) {
	   return str_replace("<a", "<a class='lightbox' rel='gallery-$galleryid' " , $content);
	} else {}
}


//-----------------------------------  // Add Menus //-----------------------------------//
add_theme_support( 'menus' );
register_nav_menu('main', 'Main Menu');
register_nav_menu('custom', 'Custom Menu');


//-----------------------------------  // Thumbnail Sizes //-----------------------------------//
add_theme_support('post-thumbnails');
set_post_thumbnail_size( 150, 150, true ); // Default Thumb
add_image_size( 'large-image', 976, 9999, false ); // Large Post Image
add_image_size( 'medium-image', 565, 9999, false ); // Medium Post Image
add_image_size( 'blog-index-gallery', 976, 609, true );
add_image_size( 'medium-gallery', 565, 353, true );

if ( ! isset( $content_width ) ) $content_width = 976;


//-----------------------------------  // Custom Comments //-----------------------------------//
function cr_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class('clearfix'); ?> id="li-comment-<?php comment_ID() ?>">
		
		<div class="comment-block" id="comment-<?php comment_ID(); ?>">
			<div class="comment-info">
				
				
				<div class="comment-author vcard clearfix">
					<?php echo get_avatar( $comment->comment_author_email, 35 ); ?>
					
					<div class="comment-meta commentmetadata">
						<?php printf( '<cite class="fn">%s</cite>', get_comment_author_link()) ?>
						<div style="clear:both;"></div>
						<a class="comment-time" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf('%1$s at %2$s', get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)','cr'),'  ','') ?>
					</div>
				</div>
			<div style="clear:both;"></div>
			</div>
			
			<div class="comment-text">
				<?php comment_text() ?>
				<p class="reply">
				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</p>
			</div>
		
			<?php if ($comment->comment_approved == '0') : ?>
			<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'cr') ?></em>
			<?php endif; ?>    
		</div>
		 
<?php
}

function custom_comment_reply($content) {
	$content = str_replace('Reply', '+  Reply', $content);
	return $content;
}
add_filter('comment_reply_link', 'custom_comment_reply');



//-----------------------------------  // Register Widget Areas //-----------------------------------//
function cr_widgets_init() { 
    register_sidebar(array(
        'name' => 'Menu Sidebar',
        'description' => 'Sidebar below menu on left side.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>'
    ));

    register_sidebar(array(
        'name' => 'Sidebar',
        'description' => 'Widgets in this area will be shown on the sidebar of all pages.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>'
    ));

    register_sidebar(array(
        'name' => 'Footer Column 1',
        'description' => 'This widget area',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>'
    ));
    register_sidebar(array(
        'name' => 'Footer Column 2',
        'description' => 'This widget area',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>'
    ));
    register_sidebar(array(
        'name' => 'Footer Column 3',
        'description' => 'This widget area',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>'
    ));
    register_sidebar(array(
        'name' => 'Footer Column 4',
        'description' => 'This widget area',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>'
    ));
}
add_action( 'widgets_init', 'cr_widgets_init' );


//-----------------------------------  // Gallery //-----------------------------------  //
if ( !function_exists( 'cr_gallery' ) ) {
    function cr_gallery($postid, $imagesize) { ?>
        <script type="text/javascript">
    		jQuery(document).ready(function($){
                $('#slider-<?php echo $postid; ?>').imagesLoaded( function() {
        			$("#slider-<?php echo $postid; ?>").flexslider({
        			    slideshow: false,
                        controlNav: false,
                        prevText: '<?php echo '&larr; ' . __('Prev', 'cr'); ?>',
                        nextText: '<?php echo __('Next', 'cr') . ' &rarr;'; ?>',
                        namespace: 'cr-',
                        smoothHeight: true,
                        start: function(slider) {
                            slider.container.click(function(e) {
                                if( !slider.animating ) {
                                    slider.flexAnimate( slider.getTarget('next') );
                                }
                            
                            });
                        }
        			});
    			
        			$("#slider-<?php echo $postid; ?>").click(function(e){
    			    
        			});
    			});
    		});
    	</script>
    <?php 
        $loader = 'ajax-loader.gif';
        $thumbid = 0;
    
        // get the featured image for the post
        if( has_post_thumbnail($postid) ) {
            $thumbid = get_post_thumbnail_id($postid);
        }
        echo "<!-- BEGIN #slider-$postid -->\n<div id='slider-$postid' class='flexslider' data-loader='" . get_template_directory_uri() . "/images/$loader'>";
    
        $image_ids_raw = get_post_meta($postid, '_cr_image_ids', true);

        if( $image_ids_raw ) {
            // Using WP3.5; use post__in orderby option
            $image_ids = explode(',', $image_ids_raw);
            $temp_id = $postid;
            $postid = null;
            $orderby = 'post__in';
            $include = $image_ids;
        } else {
            $orderby = 'menu_order';
            $include = '';
        }
    
        // get first 2 attachments for the post
        $args = array(
            'include' => $include,
            'order' => 'ASC',
            'orderby' => $orderby,
            'post_type' => 'attachment',
            'post_parent' => $postid,
            'post_mime_type' => 'image',
            'post_status' => null,
            'numberposts' => -1
        );
        $attachments = get_posts($args);

        $postid = ( isset($temp_id) ) ? $temp_id : $postid;
        
        if( !empty($attachments) ) {
            echo '<ul class="slides">';
            $i = 0;
            foreach( $attachments as $attachment ) {
                $src = wp_get_attachment_image_src( $attachment->ID, $imagesize );
                $caption = $attachment->post_excerpt;
                $caption = ($caption) ? "<em class='image-caption'>$caption</em>" : '';
                $alt = ( !empty($attachment->post_content) ) ? $attachment->post_content : $attachment->post_title;
                echo "<li><img height='$src[2]' width='$src[1]' src='$src[0]' alt='$alt' />$caption</li>";
                $i++;
            }
            echo '</ul>';
        }
        echo "<!-- END #slider-$postid -->\n</div>";
    }
}


//-----------------------------------  // Featured Image to RSS //-----------------------------------//
function add_featured_image_to_feed($content) {
		global $post;
		if ( has_post_thumbnail( $post->ID ) ){
			$content = '' . get_the_post_thumbnail( $post->ID, 'large-image' ) . '' . $content;
		}
		return $content;
}
add_filter('the_excerpt_rss', 'add_featured_image_to_feed', 1000, 1);
add_filter('the_content_feed', 'add_featured_image_to_feed', 1000, 1);


//-----------------------------------  // Retina Support //-----------------------------------//
if( of_get_option('of_retina')=="1") {
add_action( 'wp_enqueue_scripts', 'retina_support_enqueue_scripts' );

function retina_support_enqueue_scripts() {
    wp_enqueue_script( 'retina_js', get_template_directory_uri() . '/includes/js/retina.js', '', '', true );
}

add_filter( 'wp_generate_attachment_metadata', 'retina_support_attachment_meta', 10, 2 );

function retina_support_attachment_meta( $metadata, $attachment_id ) {
    foreach ( $metadata as $key => $value ) {
        if ( is_array( $value ) ) {
            foreach ( $value as $image => $attr ) {
                if ( is_array( $attr ) )
                    retina_support_create_images( get_attached_file( $attachment_id ), $attr['width'], $attr['height'], true );
            }
        }
    }
 
    return $metadata;
}

function retina_support_create_images( $file, $width, $height, $crop = false ) {
    if ( $width || $height ) {
        $resized_file = wp_get_image_editor( $file );
        if ( ! is_wp_error( $resized_file ) ) {
            $filename = $resized_file->generate_filename( $width . 'x' . $height . '@2x' );
 
            $resized_file->resize( $width * 2, $height * 2, $crop );
            $resized_file->save( $filename );
 
            $info = $resized_file->get_size();
 
            return array(
                'file' => wp_basename( $filename ),
                'width' => $info['width'],
                'height' => $info['height'],
            );
        }
    }
    return false;
}

add_filter( 'delete_attachment', 'delete_retina_support_images' );

function delete_retina_support_images( $attachment_id ) {
    $meta = wp_get_attachment_metadata( $attachment_id );
    $upload_dir = wp_upload_dir();
    $path = pathinfo( $meta['file'] );
    foreach ( $meta as $key => $value ) {
        if ( 'sizes' === $key ) {
            foreach ( $value as $sizes => $size ) {
                $original_filename = $upload_dir['basedir'] . '/' . $path['dirname'] . '/' . $size['file'];
                $retina_filename = substr_replace( $original_filename, '@2x.', strrpos( $original_filename, '.' ), strlen( '.' ) );
                if ( file_exists( $retina_filename ) )
                    unlink( $retina_filename );
            }
        }
    }
}
} else {}


//-----------------------------------  // Load More AJAX Call //-----------------------------------  //
if(!function_exists('cr_load_more')){
	add_action('wp_ajax_cr_load_more', 'cr_load_more');
	add_action('wp_ajax_nopriv_cr_load_more', 'cr_load_more');
	function cr_load_more(){
		if(!wp_verify_nonce($_POST['nonce'], 'cr_ajax')) die('Invalid nonce');
		if( !is_numeric($_POST['page']) || $_POST['page']<0 ) die('Invalid page');

		$args = '';
		if(isset($_POST['archive']) && $_POST['archive']){
			$args = $_POST['archive'] .'&';
		}
		$args .= 'post_status=publish&posts_per_page='. get_option('posts_per_page') .'&paged='. $_POST['page'];
		
		if(isset($_POST['archive']) && $_POST['archive'] && strlen(strstr($_POST['archive'],'post-format'))>0){
			$args = array(
				'post_status' => 'publish',
				'tax_query' => array(
					array(
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => $_POST['archive']
					)
				),
				'posts_per_page' => get_option('posts_per_page'),
				'paged' => $_POST['page']
			);
		}
		
		ob_start();
		$query = new WP_Query($args);
		while( $query->have_posts() ){ $query->the_post();
		?>
		
		<div class="masonr">	
				
					<div <?php post_class('post'); ?>>
		<?php	
            if(!get_post_format()) {                       
                get_template_part('format', 'standard-small');
            } else {                
            $format = get_post_format();
            if ($format == 'image') {get_template_part('format', 'image-small');} 
            else if ($format == 'gallery') {get_template_part('format', 'gallery-small');}
            else {get_template_part('format', $format);}
            }                       
		?>
			</div><!-- post-->
				</div>	
			
		<?php
		}
		wp_reset_postdata();
		$content = ob_get_contents();
		ob_end_clean();

		
		echo json_encode(
			array(
				'pages' => $query->max_num_pages,
				'content' => $content
			)
		);
		exit;
	}
}
