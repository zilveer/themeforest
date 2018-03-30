<?php
/**
*	functions.php
*
*	The theme's functions and definitions
*/


/**
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*	1.0 - Define constants
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*/
define( 'FAVE_THEMEROOT', get_stylesheet_directory_uri() );
define( 'FAVE_IMAGES', FAVE_THEMEROOT . '/images' );
define( 'THEME_NAME', 'Magzilla' );
define( 'THEME_SLUG', 'magzilla' );
define( 'THEME_VERSION', '1.3.0' );
define( 'FAVE_SCRIPTS', FAVE_THEMEROOT . '/js' );
define( 'FAVE_FRAMEWORK', get_template_directory() . '/framework'  );
define( 'FAVE_FUNCTION', get_template_directory() . '/inc'  );
define( 'FAVE_ADMIN', get_template_directory() . '/admin'  );

/**
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*	2.0 - Load the framework
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*/
require_once( FAVE_FRAMEWORK . '/init.php' );


/**
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*	3.0 - Set up the content width value based on the theme's design.
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*/
if ( ! isset( $content_width ) ) {
	$content_width = 1170;
}


/**
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*	4.0 - Set up theme default and register various supported features.
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*/
if ( ! function_exists( 'fave_setup' ) ) {
	function fave_setup() {
		/**
		*	Make the theme available for translation.
		*/
		$lang_dir = FAVE_THEMEROOT . '/languages';
		load_theme_textdomain( 'magzilla', $lang_dir );

		/**
		*	Add support for post formats. 
		*/
		add_theme_support( 'post-formats',
			array(
				'gallery',
				'quote',
				'video',
				'audio'
			)
		);

		/**
		*	Add support for automatic feed links. 
		*/
		add_theme_support( 'automatic-feed-links' );

		/**
		*	Add support for post thumbnails. 
		*/
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 672, 372, true );
		add_image_size( 'single-big-size', 1170, 550, true );
		/*add_image_size( 'size1170_9999', 1170, 427, false );

		add_image_size( 'size570_427', 570, 427, true );

		add_image_size( 'size770_400', 770, 400, true );
		add_image_size( 'size370_277', 370, 277, true );*/

		/**
		*	Register nav menus. 
		*/
		register_nav_menus(
			array(
				'main-menu' => __( 'Main Menu', 'magzilla' ),
				'top-menu' => __( 'Top Menu', 'magzilla' ),
				'footer-menu' => __( 'Footer Menu', 'magzilla' ),
				'mobile-menu' => __( 'Mobile Menu', 'magzilla' )
			)
		);

		//remove gallery style css
		add_filter( 'use_default_gallery_style', '__return_false' );


	}

	add_action( 'after_setup_theme', 'fave_setup' );

}


/*-----------------------------------------------------------------------------------*/
/*	Thumbnails
/*-----------------------------------------------------------------------------------*/
add_image_size('gal-thumb', 120, 90, true);
//small height, 1 col wide
add_image_size('gal-big',  800, 530, true);


/*
	Menu Icons
*/
if ( ! function_exists( 'fave_add_menu_icons_styles' ) ) {
	function fave_add_menu_icons_styles(){?>
	 
	<style type="text/css">
	#adminmenu .menu-icon-video div.wp-menu-image:before {
	content: "\f126";
	}
	#adminmenu .menu-icon-gallery div.wp-menu-image:before{
		content: "\f161";
	}
	</style>
	 
	<?php
	}
	add_action( 'admin_head', 'fave_add_menu_icons_styles' );
}


/*-----------------------------------------------------
 * Insert ads after spefic paragraph of single post content.
 *-----------------------------------------------------*/

if ( ! function_exists( 'fave_insert_post_ads' ) ) {

	add_filter( 'the_content', 'fave_insert_post_ads' );

	function fave_insert_post_ads( $content ) {

		global $ft_option;

		$article_inline_state = isset( $ft_option['article_inline_state'] ) ? $ft_option['article_inline_state'] : 0;
		$ad_code = isset( $ft_option['article_ad_inline'] ) ? $ft_option['article_ad_inline'] : '';
		$ad_position_content = isset( $ft_option['ad_position_content'] ) ? $ft_option['ad_position_content'] : 'left';
		$paragraph_id = isset( $ft_option['paragraph_no'] ) ? $ft_option['paragraph_no'] : '';


		if ( !empty( $ad_code) && $article_inline_state != 0 ) {

			switch( $ad_position_content ) {

				case 'left':
					$ad_code = '<div class="favethemes-content-ad-inline-left">'.$ad_code.'</div>';
					break;

				case 'right':
					$ad_code = '<div class="favethemes-content-ad-inline-right">'.$ad_code.'</div>';
					break;

				default:
					$ad_code = '<div class="favethemes-content-ad-inline">'.$ad_code.'</div>';
					break;
			}

			if ( is_single() && ! is_admin() ) {
				return favethemes_insert_after_paragraph( $ad_code, $paragraph_id, $content );
			}
		} // End Ad inline

		
		return $content;
	}
}
 
// Parent Function that makes the magic happen 
function favethemes_insert_after_paragraph( $insertion, $paragraph_id, $content ) {

	$content_buffer = '';

	$content_parts = preg_split('/(<p.*>)/U', $content, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

	foreach ($content_parts as $content_part_index => $content_part) {
		if (!empty($content_part)) {

            if ($paragraph_id == $content_part_index / 2) {

            	$content_buffer .= $insertion;
            }
            $content_buffer .=  $content_part;

        }

	}

	$content = $content_buffer;

	return $content;
}

/*-----------------------------------------------------
 * Insert ads top of single post content.
 *-----------------------------------------------------*/

if ( ! function_exists( 'fave_insert_post_ads_top' ) ) {

	add_filter( 'the_content', 'fave_insert_post_ads_top' );

	function fave_insert_post_ads_top( $content ) {

		global $ft_option;

		$article_top_state = isset( $ft_option['article_top_state'] ) ? $ft_option['article_top_state'] : 0;
		$ad_top_code = isset( $ft_option['article_ad_top'] ) ? $ft_option['article_ad_top'] : '';

		// Top Ad
		if ( !empty( $ad_top_code) && $article_top_state != 0 ) {
			
			if ( is_single() && ! is_admin() ) {
				$content = '<div class="favethemes-content-ad-top">'.$ad_top_code.'</div>' . $content;
			}
		}
		
		return $content;
	}
}

/*-----------------------------------------------------
 * Insert ads bottom of single post content.
 *-----------------------------------------------------*/

if ( ! function_exists( 'fave_insert_post_ads_bottom' ) ) {

	add_filter( 'the_content', 'fave_insert_post_ads_bottom' );

	function fave_insert_post_ads_bottom( $content ) {

		global $ft_option;

		$article_bottom_state = isset( $ft_option['article_bottom_state'] ) ? $ft_option['article_bottom_state'] : 0;
		$ad_bottom_code = isset( $ft_option['article_ad_bottom'] ) ? $ft_option['article_ad_bottom'] : '';

		// Top Ad
		if ( !empty( $ad_bottom_code) && $article_bottom_state != 0 ) {
			
			if ( is_single() && ! is_admin() ) {
				$content = $content . '<div class="favethemes-content-ad-bottom">'.$ad_bottom_code.'</div>';
			}
		}
		
		return $content;
	}
}

/* --------------------------------------------------------------------------
 * Hex to RGB values
 ---------------------------------------------------------------------------*/

 if ( ! function_exists( 'fave_hex2rgb' ) ) {
	 function fave_hex2rgb($hex) {

	//$hex = str_replace("#", "", $hex);

	 	$hex = preg_replace("/#/", "", $hex );

	 	$color = array();

	 	if(strlen($hex) == 3) {
	 		$color['r'] = hexdec(substr($hex, 0, 1) );
	 		$color['g'] = hexdec(substr($hex, 1, 1) );
	 		$color['b'] = hexdec(substr($hex, 2, 1) );
	 	} else {
	 		$color['r'] = hexdec(substr($hex, 0, 2) );
	 		$color['g'] = hexdec(substr($hex, 2, 2) );
	 		$color['b'] = hexdec(substr($hex, 4, 4) );
	 	}

	 	return $color;
	 }
}


/* --------------------------------------------------------------------------
 * Open Graph
 ---------------------------------------------------------------------------*/

if ( ! function_exists( 'fave_add_opengraph' ) ) {

	function fave_add_opengraph() {
		global $post; // Ensures we can use post variables outside the loop

		// Start with some values that don't change.
		echo "<meta property='og:site_name' content='". get_bloginfo('name') ."'/>"; // Sets the site name to the one in your WordPress settings
		echo "<meta property='og:url' content='" . get_permalink() . "'/>"; // Gets the permalink to the post/page

		if (is_singular()) { // If we are on a blog post/page
	        echo "<meta property='og:title' content='" . get_the_title() . "'/>"; // Gets the page title
	        echo "<meta property='og:type' content='article'/>"; // Sets the content type to be article.
	        if( has_post_thumbnail( $post->ID )) { // If the post has a featured image.
				$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
				echo "<meta property='og:image' content='" . esc_attr( $thumbnail[0] ) . "'/>"; // If it has a featured image, then display this for Facebook
			}
			echo "<meta property='og:description' content='".wp_html_excerpt($post->post_content, 100 )."'/>"; // Sets the content type to be article.
	    } elseif(is_front_page() or is_home()) { // If it is the front page or home page
	    	echo "<meta property='og:title' content='" . get_bloginfo("name") . "'/>"; // Get the site title
	    	echo "<meta property='og:type' content='website'/>"; // Sets the content type to be website.
	    }

	}


	if ( !defined('WPSEO_VERSION') && !class_exists('NY_OG_Admin')) {
		add_action( 'wp_head', 'fave_add_opengraph', 5 );
	}
}



/* --------------------------------------------------------------------------
 
/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since Magzilla 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
if ( ! function_exists( 'fave_wp_title' ) ) {

	function fave_wp_title( $title, $sep ) {
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
			$title = "$title $sep " . sprintf( __( 'Page %s', 'magzilla' ), max( $paged, $page ) );

		return $title;
	}
	add_filter( 'wp_title', 'fave_wp_title', 10, 2 );
}

/**
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*	MagZilla Options link in admin bar
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'fave_admin_render' ) ) {

	function fave_admin_render() {
		global $wp_admin_bar;

		$wp_admin_bar->add_menu( array(

			'parent' => false, // use 'false' for a root menu, or pass the ID of parent menu
			'id' => 'smof_options',  // link ID, default ta a sanitized title value
			'title' => __('Magzilla Options', 'magzilla' ), // link title
			'href' => admin_url( 'themes.php?page=optionsframework' ),
			'meta' => false, 

		));

	}
	add_action( 'wp_before_admin_bar_render', 'fave_admin_render' );
}


/**
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*	MagZilla Change the columns for the edit CPT screen
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*/
function fave_change_columns( $cols ) {
	$cols = array(
			"cb" => '<input type="checkbox" />',
			"title" => __( "Title", "magzilla" ),
			"author" => __( "Author", "magzilla" ),
			"categories" => __( "Categories", "magzilla" ),
			"magzilla_featured" => __( "Featured", "magzilla" ),
			"tags" => __( "Tags", "magzilla" ),
			"comments" => __( "Comments", "magzilla" ),
			"date" => __( "Date", "magzilla" )
			
		);
	return $cols;
}
add_filter( "manage_posts_columns", "fave_change_columns" );

function fave_custom_columns( $column, $post_id ) {
	global $ft_option;
	
	switch ( $column ) {
		case "magzilla_featured":
			if( get_post_meta( $post_id, 'fave_featured', true ) == 1 ) {
					echo "Yes";
			} else {
				echo "-";
			}
		break;
	}
}

add_action( "manage_posts_custom_column", "fave_custom_columns", 10, 2 );



/**
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*	Add filter to posts for featured and reviews
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*/
add_action( 'restrict_manage_posts', 'fave_admin_posts_filter_restrict_manage_posts' );

function fave_admin_posts_filter_restrict_manage_posts(){
    $type = 'post';
    if (isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }

    
    if ('post' == $type){
        
        $values = array(
            'Featured Posts' => 'fave_featured',
            'Review Posts' => 'fave_review_checkbox',
        );
        ?>
        <select name="magzilla_custom_field">
        <option value=""><?php _e('Filter By Custom Fields', 'magzilla'); ?></option>
        <?php
            $current_v = isset($_GET['magzilla_custom_field'])? $_GET['magzilla_custom_field']:'';
            foreach ($values as $label => $value) {
                printf
                    (
                        '<option value="%s"%s>%s</option>',
                        $value,
                        $value == $current_v? ' selected="selected"':'',
                        $label
                    );
                }
        ?>
        </select>
        <?php
    }
}


add_filter( 'parse_query', 'fave_posts_filter' );


function fave_posts_filter( $query ){
    global $pagenow;
    $type = 'post';
    if (isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }
    if ( 'post' == $type && is_admin() && $pagenow=='edit.php' && isset($_GET['magzilla_custom_field']) && $_GET['magzilla_custom_field'] != '') {
        $query->query_vars['meta_key'] = $_GET['magzilla_custom_field'];
        $query->query_vars['meta_value'] = 1 ;
    }
}

/*-----------------------------------------------------------------------------------*/
/*	Get category slug by category ID
/*-----------------------------------------------------------------------------------*/

if( !function_exists('get_cat_slug') ) {
	function get_cat_slug( $cat_id ) {
		$cat_id   = (int) $cat_id;
		$category = &get_category( $cat_id );

		return $category->slug;
	}
}

/*-----------------------------------------------------------------------------------*/
/*	Register blog sidebar, footer and custom sidebar
/*-----------------------------------------------------------------------------------*/
	


add_action( 'widgets_init', 'magzilla_widgets_init' );

function magzilla_widgets_init() {
    register_sidebar(array(
        'name' => 'Default Sidebar',
        'id' => 'default-sidebar',
        'description' => 'Widgets in this area will be shown in the sidebar.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => 'Page Sidebar',
        'id' => 'page-sidebar',
        'description' => 'Widgets in this area will be shown in the sidebar of any page.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => 'bbpress Sidebar',
        'id' => 'bbpress-sidebar',
        'description' => 'Widgets in this area will be shown in the sidebar of bbpress page.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => 'Category Sidebar',
        'id' => 'category-sidebar',
        'description' => 'Widgets in this area will be shown in the sidebar of any category page.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => 'Video Sidebar',
        'id' => 'video-sidebar',
        'description' => 'Widgets in this area will be shown in the sidebar for video post type.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => 'Gallery Sidebar',
        'id' => 'gallery-sidebar',
        'description' => 'Widgets in this area will be shown in the sidebar for gallery post type.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => 'Author Page Sidebar',
        'id' => 'author-sidebar',
        'description' => 'Widgets in this area will be shown in the sidebar of author page.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => 'Search Page Sidebar',
        'id' => 'search-sidebar',
        'description' => 'Widgets in this area will be shown in the search page.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => 'Footer Col 1',
        'id' => 'footer-col-1',
        'description' => 'Widgets in this area will be shown in the footer col 1.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => 'Footer Col 2',
        'id' => 'footer-col-2',
        'description' => 'Widgets in this area will be shown in the footer col 2.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => 'Footer Col 3',
        'id' => 'footer-col-3',
        'description' => 'Widgets in this area will be shown in the footer col 3.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => 'Footer Col 4',
        'id' => 'footer-col-4',
        'description' => 'Widgets in this area will be shown in the footer col 4s.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

}

/* Translation for .po .mo file */
load_theme_textdomain( 'magzilla', get_template_directory() . '/languages' );
$locale = get_locale();
$locale_file = get_template_directory() . "/languages/$locale.php";
if ( is_readable($locale_file) ) require_once($locale_file);

add_action( 'vc_before_init', 'magzilla_vcSetAsTheme' );
function magzilla_vcSetAsTheme() {
	vc_set_as_theme( $disable_updater = false );
}

?>