<?php
/**
 * @package Grace - Religious WordPress Theme
 * @subpackage grace
 * @author Theme Blossom - www.themeblossom.net
 */
 
/*-----------------------------------------------------------------------------------*/
/* PARENT/CHILD THEME
/* CONSTANTS
/* FRAMEWORK
/* STYLESHEETS
/* DYNAMIC THEME OPTIONS
/* SCRIPTS
/* THEME SETUP
/* EXCERPT
/* COMMENTS
/* POST
/* HEADER FUNCTIONS
/* LOGO
/* NAVIGATION
/* CONTENT
/* SIDEBAR
/* FOOTER
/* GOOGLE FONTS
/* PLUGINS
/* THEMEBLOSSOM FUNCTIONS AND TWEAKS
/* CUSTOM POST TYPES
/* WIDGETS
/* SHORTCODES
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Set Proper Parent/Child theme paths for inclusion
/*-----------------------------------------------------------------------------------*/

@define( 'PARENT_DIR', get_template_directory() );
@define( 'CHILD_DIR', get_stylesheet_directory() );

@define( 'PARENT_URL', get_template_directory_uri() );
@define( 'CHILD_URL', get_stylesheet_directory_uri() );


/*-----------------------------------------------------------------------------------*/
/* CONSTANTS
/*-----------------------------------------------------------------------------------*/

include('lib/const.php');

/*-----------------------------------------------------------------------------------*/
/* Initialize the Options Framework
/* http://wptheming.com/options-framework-theme/
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'optionsframework_init' ) ) {

    //define('OPTIONS_FRAMEWORK_URL', PARENT_URL . '/admin/');
    define('OPTIONS_FRAMEWORK_DIRECTORY', PARENT_URL . '/admin/');

	require_once (PARENT_DIR . '/admin/options-framework.php');

}

$themeOptions = of_get_all_options();

/*-----------------------------------------------------------------------------------*/
// STYLESHEETS
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'st_registerstyles' ) ) {

add_action('get_header', 'st_registerstyles');

function st_registerstyles() {
	$theme  = wp_get_theme();
	$themeName = $theme['Name'];
	$version = $theme['Version'];
  	$stylesheets = wp_enqueue_style('skeleton', PARENT_URL . '/skeleton.css', false, $version, 'screen, projection');
    $stylesheets .= wp_enqueue_style('theme', PARENT_URL . '/style.css', false, $version, 'screen, projection');
  	$stylesheets .= wp_enqueue_style('layout', PARENT_URL . '/css/layout.css', false, $version, 'screen, projection');
    $stylesheets .= wp_enqueue_style('formalize', PARENT_URL . '/css/formalize.css', false, $version, 'screen, projection');
    $stylesheets .= wp_enqueue_style('superfish', PARENT_URL . '/css/superfish.css', false, $version, 'screen, projection');
    $stylesheets .= wp_enqueue_style('prettyPhoto', PARENT_URL . '/css/prettyPhoto.css', false, $version, 'screen, projection');
    $stylesheets .= wp_enqueue_style('iconmoon', PARENT_URL . '/css/iconmoon.css', false, $version, 'screen, projection');
	$stylesheets .= wp_enqueue_style( 'wp-color-picker' );
	

	echo apply_filters ('child_add_stylesheets',$stylesheets);
}

}

/*-----------------------------------------------------------------------------------*/
/* DYNAMIC THEME OPTIONS
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'production_stylesheet' )) {

function production_stylesheet($public_query_vars) {
    $public_query_vars[] = 'get_styles';
    return $public_query_vars;
}
add_filter('query_vars', 'production_stylesheet');
}

if ( !function_exists( 'tb_theme_css' ) ) {

add_action('template_redirect', 'tb_theme_css');
function tb_theme_css(){
    $css = get_query_var('get_styles');
    if ($css == 'css'){
        include_once (PARENT_DIR . '/style.php');
        exit;  //This stops WP from loading any further
    }
}

}

/*-----------------------------------------------------------------------------------*/
/* SCRIPTS
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'st_header_scripts' ) ) {
	add_action('wp_enqueue_scripts', 'st_header_scripts');
	function st_header_scripts() {
		global $post;
		
		if (isset($post)) $postID = $post->ID;
		
	 	wp_enqueue_script('jquery');
	 	wp_enqueue_script('custom', PARENT_URL . "/javascripts/app.js",array('jquery'),'1.2.3',true);
		wp_enqueue_script('superfish', PARENT_URL . "/javascripts/superfish.js",array('jquery'),'1.4.8', false);
		wp_enqueue_script('formalize', PARENT_URL . "/javascripts/jquery.formalize.min.js",array('jquery'),'1.2.3',true);
		wp_enqueue_script('prettyPhoto', PARENT_URL . "/javascripts/jquery.prettyPhoto.js",array('jquery'),'3.1.6',true);
		wp_enqueue_script('selectNav', PARENT_URL . "/javascripts/selectnav.min.js", false,'0.1',true);
		
		$pageTemplate = isset($postID) ? get_post_meta($postID, '_wp_page_template', true) : FALSE;
		
		if (is_tax(TB_GALLERY_TAX) || (($pageTemplate == 'page-gallery.php'))) {
			wp_enqueue_script('tb_isotope', PARENT_URL . "/javascripts/jquery.isotope.min.js",array('jquery'),'1.5.25',false);
			wp_enqueue_script('tb_imagesloaded', PARENT_URL . "/javascripts/jquery.imagesloaded.min.js",array('jquery'),'2.1.1',false);
		}
		
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script('tb',  PARENT_URL . "/javascripts/themeblossom.js",array('jquery'),'1.0',true);
	}
}

/*-----------------------------------------------------------------------------------*/
/* THEME SETUP
/* To override skeleton_setup() in a child theme, add your own skeleton_setup to your child theme's
/* functions.php file.
/*-----------------------------------------------------------------------------------*/
add_action( 'after_setup_theme', 'skeleton_setup' );

if ( ! function_exists( 'skeleton_setup' ) ):
function skeleton_setup() {
	
	add_editor_style();
	
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'grace', PARENT_DIR . '/languages' );
	
	// Content width
	if ( ! isset( $content_width ) ) $content_width = 900;

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );
	add_image_size('article_thumbnail', 940, 350, true);
	add_image_size('article_thumbnail_high', 940, 3500, true);
	add_image_size('bio_thumbnail', 180, 240, true);
	add_image_size('tb_gallery_big', 600, 223, true);
	add_image_size('tb_gallery_small', 437, 279, true);

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
	
	// Register the available menus
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'grace' ),
	));
}
endif;

/*-----------------------------------------------------------------------------------*/
/* EXCERPT
/*-----------------------------------------------------------------------------------*/
// excerpt length
if ( !function_exists( 'skeleton_excerpt_length' ) ) {

function skeleton_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'skeleton_excerpt_length' );

}

// Read more link
if ( !function_exists( 'skeleton_continue_reading_link' ) ) {

function skeleton_continue_reading_link() {
	return '<p class="center" style="margin-top: 15px;"><a class="button extraRounded" href="'. get_permalink() . '">' . __('READ MORE', 'grace') . '</a></p>';
}
}

// Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and skeleton_continue_reading_link().
 if ( !function_exists( 'skeleton_auto_excerpt_more' ) ) {

function skeleton_auto_excerpt_more( $more ) {
	return ' &hellip;' . skeleton_continue_reading_link();
}
add_filter( 'excerpt_more', 'skeleton_auto_excerpt_more' );

}

// get_the_excerpt()
if ( !function_exists( 'skeleton_custom_excerpt_more' ) ) {

function skeleton_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= skeleton_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'skeleton_custom_excerpt_more' );

}

/*-----------------------------------------------------------------------------------*/
/* REMOVE MORE LINK
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'remove_more_jump_link' ) ) {

function remove_more_jump_link($link) { 
	$offset = strpos($link, '#more-');
	if ($offset) {
	$end = strpos($link, '"',$offset);
	}
	if ($end) {
	$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
	}
	add_filter('the_content_more_link', 'remove_more_jump_link');

}

/*-----------------------------------------------------------------------------------*/
/* COMMENTS
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'st_comments' ) ) :
function st_comments($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
			<div id="comment-<?php comment_ID(); ?>" class="single-comment clearfix">
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, $size='64' ); ?>
					<?php comment_reply_link(array_merge( $args, array('reply_text' => __('Reply','grace'),'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
				</div>
				
				<div class="comment-meta commentmetadata">
						<?php if ($comment->comment_approved == '0') : ?>
						<em><?php echo __('Comment is awaiting moderation','grace');?></em> <br />
						<?php endif; ?>
						<div class="comment-meta">
						<cite><?php echo get_comment_author_link(); ?></cite>
						<span><?php echo __('Posted on','grace') . ' ' . get_comment_date(). '  at  ' . get_comment_time(); ?></span>
						</div>
						<?php comment_text() ?>
						<?php edit_comment_link(__('Edit comment','grace'),'  ',''); ?>
				</div>
		</div>
<!-- </li> -->
<?php  }
endif;

/*-----------------------------------------------------------------------------------*/
/* POST
/*-----------------------------------------------------------------------------------*/
// posted on
if ( ! function_exists( 'skeleton_posted_on' ) ) :
function skeleton_posted_on() {

	printf( __( '<div class="tb_date_box"><span class="day">%1$s</span><span class="month">%2$s</span></div>', 'grace'), get_the_date('d'), get_the_date('M') );
}

endif;

// posted in
if ( ! function_exists( 'skeleton_posted_in' ) ) :
function skeleton_posted_in($show = 1) {
	// Retrieves tag list of current post, separated by commas.
	if ($show) $tag_list = get_the_tag_list( '', ', ' );
	if ( isset($tag_list) && $tag_list) {
		$posted_in = __( 'Categories: %1$s<br>Tags: %2$s.', 'grace' );
		// Prints the string, replacing the placeholders.
		printf(
			$posted_in,
			get_the_category_list( ', ' ),
			$tag_list,
			get_permalink(),
			the_title_attribute( 'echo=0' )
		);
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'Categories: %1$s.', 'grace' );
		printf(
			$posted_in,
			get_the_category_list( ', ' ),
			get_permalink(),
			the_title_attribute( 'echo=0' )
		);
	} else {
	}
}

endif;


/*-----------------------------------------------------------------------------------*/
/* HEADER FUNCTIONS
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'st_above_header' ) ) {

function st_above_header() {
    do_action('st_above_header');
}

}

if ( !function_exists( 'st_header' ) ) {

function st_header() {
  do_action('st_header');
}

}


// Opening #header div with flexible grid
if ( !function_exists( 'st_header_open' ) ) {

function st_header_open() {
	echo "<div id=\"header\" class=\"sixteen columns\">\n<div class=\"inner\">\n";
}

}
add_action('st_header','st_header_open', 1);


/*-----------------------------------------------------------------------------------*/
/* LOGO
/* Child Theme Override: child_logo();
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'st_logo' ) ) {

function st_logo($layout = 'box') {
	// Displays H1 or DIV based on whether we are on the home page or not (SEO)
	$heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div';
	if (of_get_option('use_logo_image')) {
		$class="graphic";
	} else {
		$class="text"; 		
	}
	// echo of_get_option('header_logo')
	$st_logo  = '<'.$heading_tag.' id="site-title" class="'.$class.'"><a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo('name','display')).'">'.get_bloginfo('name').'</a></'.$heading_tag.'>'. "\n";
	
	if ($layout == 'box') $st_logo .= '<span class="site-desc '.$class.'">'.get_bloginfo('description').'</span>'. "\n";
	echo apply_filters ( 'child_logo' , $st_logo);
}
}
add_action('st_header','st_logo', 3);



if ( !function_exists( 'logostyle' ) ) {

function logostyle() {
	if (of_get_option('use_logo_image')) {
	echo '<style type="text/css">
	#site-title.graphic a {background-image: url('.of_get_option('header_logo').');width: '.of_get_option('logo_width').'px;height: '.of_get_option('logo_height').'px;}</style>';
	}
}

}
add_action('wp_head', 'logostyle');



if ( !function_exists( 'st_header_close' ) ) {

function st_header_close() {
	echo "</div></div><!--/#header-->";
}
}
add_action('st_header','st_header_close', 4);


if ( !function_exists( 'st_below_header' ) ) {

function st_below_header() {
    do_action('st_below_header');
}

}

/*-----------------------------------------------------------------------------------*/
// NAVIGATION (MENU)
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'st_navbar' ) ) {

function st_navbar($layout = 'box') {
	if ($layout == 'wide') {
	
		$logoOption = of_get_option('logo_style', 'default');
		
		$showNavigationSearch = of_get_option('show_search_in_navigation', 'show');
		
		echo '<div id="navigationarea" class="' . $logoOption . '">';
		
		if ($logoOption != 'default') {
			echo '<div class="container">';
			echo '<div id="logoArea" class="sixteen columns wide">';
			st_logo($layout);
			
			
		
			if ($showNavigationSearch == 'show' && $logoOption == 'above2') {
				?>
				
				<div id="navigationSearchForm">
					<form action="" method="GET" role="search">
						<input type="text" name="s" value="<?php echo NAVIGATION_SEARCH_VALUE; ?>" onfocus="if(this.value == '<?php echo NAVIGATION_SEARCH_VALUE; ?>') this.value = ''" onblur="if(this.value == '') this.value = '<?php echo NAVIGATION_SEARCH_VALUE; ?>'">
						<button type="submit" id="navigationSearch"><span aria-hidden="true" class="icon-search"></span></button>
					</form>
				</div>
				<?php
			}
			
			echo '</div></div><div id="logoAreaBorder"></div>';
		}
		
		echo '<div class="container">';
		
		echo '<div id="navigation" class="sixteen columns wide">';
		
		if ($logoOption == 'default') st_logo($layout);
		
		if ($showNavigationSearch == 'show' && $logoOption != 'above2') {
			?>
			<div id="navigationSearch"><span aria-hidden="true" class="icon-search"></span></div>
			<div id="navigationSearchForm">
				<form action="" method="GET" role="search">
					<input type="text" name="s" value="<?php echo NAVIGATION_SEARCH_VALUE; ?>" onfocus="if(this.value == '<?php echo NAVIGATION_SEARCH_VALUE; ?>') this.value = ''" onblur="if(this.value == '') this.value = '<?php echo NAVIGATION_SEARCH_VALUE; ?>'">
				</form>
			</div>
			<?php
		}
		
		wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary', 'fallback_cb' => 'tb_primary_navigation'));
		
		echo '</div></div></div><!--/#navigation-->';
		
	} else {
		echo '<div id="navigationarea"><div id="navigation" class="row sixteen columns">';
		
		$showNavigationSearch = of_get_option('show_search_in_navigation', 1);
		
		if ($showNavigationSearch) {
			?>
			<div id="navigationSearch"><span aria-hidden="true" class="icon-search"></span></div>
			<div id="navigationSearchForm">
				<form action="" method="GET" role="search">
					<input type="text" name="s" value="<?php echo NAVIGATION_SEARCH_VALUE; ?>" onfocus="if(this.value == '<?php echo NAVIGATION_SEARCH_VALUE; ?>') this.value = ''" onblur="if(this.value == '') this.value = '<?php echo NAVIGATION_SEARCH_VALUE; ?>'">
				</form>
			</div>
			<?php
		}
		
		wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary', 'fallback_cb' => 'tb_primary_navigation'));
		
		echo '</div></div><!--/#navigation-->';
			
	}
	
}

}

// fallback function
if (!function_exists('tb_primary_navigation')) {
	function tb_primary_navigation() {	
		echo '<div class="menu-header"><ul id="menu-primary" class="menu">';
		wp_list_pages('title_li=');
		echo '</ul></div>';
	}
}

/*-----------------------------------------------------------------------------------*/
/* CONTENT
// Before Content - st_before_content($columns);
// Child Theme Override: child_before_content();
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'st_before_content' ) ) {

	function st_before_content($columns, $content = 'content') {
	
	// Specify the number of columns in conditional statements
	// See http://codex.wordpress.org/Conditional_Tags for a full list
	//
	// If necessary, you can pass $columns as a variable in your template files:
	// st_before_content('six');
	//
	// Set the default
	
	if (empty($columns)) {
		$columns = 'eleven';
	} else {
		$columns = $columns;
	}
	
	if (is_page_template('page-wide.php')) {
		$columns = 'sixteen';
	}

	// Apply the markup
	echo "<div id=\"$content\" class=\"$columns columns\">";
	}
}

if (! function_exists('st_after_content'))  {
    function st_after_content() {
    	echo "\t\t</div><!-- /.columns (#content) -->\n";
    }
}

/*-----------------------------------------------------------------------------------*/
/* SIDEBAR
/*-----------------------------------------------------------------------------------*/
// Before Sidebar
if ( !function_exists( 'before_sidebar' ) ) {
	
	function before_sidebar($columns) {
		if (empty($columns)) {
			$columns = 'five';
		} else {
			$columns = $columns;
		}
		echo '<div id="sidebar" class="'.$columns.' columns" role="complementary">';
	}
}
add_action( 'st_before_sidebar', 'before_sidebar');  

// After Sidebar
if ( !function_exists( 'after_sidebar' ) ) {
	function after_sidebar() {
	   echo '</div><!-- #sidebar -->';
	}
}
add_action( 'st_after_sidebar', 'after_sidebar');  

/*-----------------------------------------------------------------------------------*/
/* FOOTER
/*-----------------------------------------------------------------------------------*/
// Before Footer
if (!function_exists('st_before_footer'))  {
    function st_before_footer($layout = 'box') {
	
		if ($layout == 'wide') {
			echo '<div class="clear"></div>';
			$show_ornament_line = of_get_option('show_ornament_line');
			if ($show_ornament_line) {
				echo '<div class="ornamentLine"></div>' . "\n";
			}
			echo '<div id="footer" class="width100"><div class="container"><div class="sixteen columns">';
			
		} else {
			echo '<div class="clear"></div>';
			$show_ornament_line = of_get_option('show_ornament_line');
			if ($show_ornament_line) {
				echo '<div class="ornamentLine"></div>' . "\n";
			}
			echo '<div id="footer"><div class="sixteen columns">';
			
		}
    }
}

// Footer
if ( !function_exists( 'st_footer' ) ) {

	do_action('st_footer');
	
	function st_footer($layout = 'box') {

		get_sidebar( 'footer' );
		
		if ($layout == 'wide') {

			echo "</div></div></div><!--/#footer-->" . "\n";

			echo '<div id="credits" class="width100"><div class="container"><div class="sixteen columns">';
			echo apply_filters('the_content', of_get_option('footer_text'));
			echo '</div></div></div>';

		} else {

			echo "</div></div><!--/#footer-->" . "\n";

			echo '<div id="credits"><div class="sixteen columns">';
			echo apply_filters('the_content', of_get_option('footer_text'));
			echo '</div></div>';
			
		}	
	}

}


// After Footer
if (!function_exists('st_after_footer'))  {
	
    function st_after_footer($layout = 'box') {
		// Footer Scripts
		if (of_get_option('footer_scripts') <> "" ) {
			echo '<script type="text/javascript">'.stripslashes(of_get_option('footer_scripts')).'</script>';
		}
    }
}

if (!function_exists('tb_custom_footer_scripts')) {
	add_action('wp_footer', 'tb_custom_footer_scripts', 1000);
	do_action('tb_custom_footer_scripts');
	
	function tb_custom_footer_scripts() {
	
	?>

	<!-- RESPONSIVE NAVIGATION -->

	<?php
	$mainMenuSlug = 'menu-' . ag_get_theme_menu_slug('primary');
	
	if ($mainMenuSlug == 'menu-') {
	$mainMenuSlug = 'menu-primary';
	}
	
	?>

	<script>
	selectnav('<?php echo $mainMenuSlug; ?>', {
	  label: '<?php echo __("Menu", "grace"); ?>',
	  nested: true,
	  indent: '-'
	});
	</script>

	<?php
	}
	
}
//


/*-----------------------------------------------------------------------------------*/
// GOOGLE FONTS
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'options_typography_google_fonts' ) ) {
	function options_typography_google_fonts() {
		$all_google_fonts = array_keys( of_recognized_gfont_faces() );
		
		$use_google_fonts = of_get_option('use_google_fonts');
		$use_navigation_google_fonts = of_get_option('use_navigation_google_fonts');
		
		$h1 = of_get_option('h1_typography', DEFAULT_FONT);
		$h2 = of_get_option('h2_typography', DEFAULT_FONT);
		$h3 = of_get_option('h3_typography', DEFAULT_FONT);
		$h4 = of_get_option('h4_typography', DEFAULT_FONT);
		$h5 = of_get_option('h5_typography', DEFAULT_FONT);
		$h3c = of_get_option('h3_typography_comments', DEFAULT_FONT);
		$navigation = of_get_option('navigation_typography', DEFAULT_FONT);
		$blockquote_typography = of_get_option('blockquote_typography', DEFAULT_QUOTE_FONT);
		$quote_typography = of_get_option('quote_typography', DEFAULT_QUOTE_FONT);
		$button_typography = of_get_option('button_typography', DEFAULT_FONT);
		$date_typography = of_get_option('date_typography', DEFAULT_FONT);
		
		$selected_fonts = array();
		
		if ($use_google_fonts) {
			$selected_fonts[] = $h1['face'];
			$selected_fonts[] = $h2['face'];
			$selected_fonts[] = $h3['face'];
			$selected_fonts[] = $h4['face'];
			$selected_fonts[] = $h5['face'];
			$selected_fonts[] = $h3c['face'];
			$selected_fonts[] = $blockquote_typography['face'];
			$selected_fonts[] = $quote_typography['face'];
			//$selected_fonts[] = $button_typography['face'];
			//$selected_fonts[] = $date_typography['face'];
		}
		
		if ($use_navigation_google_fonts) {
			$selected_fonts[] = $navigation['face'];
		}

		$selected_fonts = array_unique($selected_fonts);

		foreach ( $selected_fonts as $font ) {
			if ( in_array( $font, $all_google_fonts ) ) {
				options_typography_enqueue_google_font($font);
			}
		}
	}
}
add_action( 'wp_enqueue_scripts', 'options_typography_google_fonts' );

// Enqueues the Google $font that is passed
function options_typography_enqueue_google_font($font) {
	$font = explode(',', $font);
	$font = $font[0];
	$font = str_replace(" ", "+", $font);
	
	if (strtolower($font) != 'default') wp_enqueue_style( "options_typography_$font", "http://fonts.googleapis.com/css?family=$font", false, null, 'all' );
}

// return font
function options_typography_return_google_font($face, $default, $use = 0) {
	if ($use && ( strtolower($face) != 'default') ) {
		$font = $face . ', ' . $default;
	} else {
		$font = $default;
	}
	
	return $font;
}

/*-----------------------------------------------------------------------------------*/
/* PLUGINS
/*-----------------------------------------------------------------------------------*/

/* Custom Metaboxes and Fields */
// Initialize the metabox class
include('lib/plugins/metabox/custom_meta.php');
include_once('lib/plugins/sidebars/sidebars.php');
include_once('lib/plugins/sidebars/sidebar_generator.php');

/*-----------------------------------------------------------------------------------*/
/* THEME BLOSSOM FUNCTIONS AND TWEAKS
/*-----------------------------------------------------------------------------------*/
include('lib/tb_help.php');
include('lib/tb_tweaks.php');

/*-----------------------------------------------------------------------------------*/
/* THEME BLOSSOM CUSTOM POST TYPES
/*-----------------------------------------------------------------------------------*/
tb_include_files('/lib/post_types/');

/*-----------------------------------------------------------------------------------*/
/* THEME BLOSSOM WIDGETS
/*-----------------------------------------------------------------------------------*/
tb_include_files('/lib/widgets/');

/*-----------------------------------------------------------------------------------*/
/* THEME BLOSSOM SHORTCODES
/*-----------------------------------------------------------------------------------*/
tb_include_files('/lib/shortcodes/');

?>