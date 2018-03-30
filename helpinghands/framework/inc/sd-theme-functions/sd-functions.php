<?php
/**
 * Theme SD Functions
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

// Theme Menus
require_once( SD_FRAMEWORK_INC . 'sd-theme-functions/sd-theme-menus.php' );
	
// Theme Sidebars
require_once( SD_FRAMEWORK_INC . 'sd-theme-functions/sd-theme-sidebars.php' );
	
// Custom TinyMce Styles
require_once( SD_FRAMEWORK_INC . 'sd-theme-functions/sd-custom-tinymce-styles.php' );
	
// Custom Pagination
require_once( SD_FRAMEWORK_INC . 'sd-theme-functions/sd-custom-pagination.php' );
	
// Custom Comments Callback
require_once( SD_FRAMEWORK_INC . 'sd-theme-functions/sd-comments.php' );

// Font Awesome Fonts Array
require_once( SD_FRAMEWORK_INC . 'sd-theme-functions/sd-font-awesome.php' );

// Extend Demo Importer
require_once( SD_FRAMEWORK_INC . 'sd-theme-functions/sd-extend-demo-importer.php' );

// Array Column Fallback
if ( ! function_exists( 'array_column') ) {
	require_once( SD_FRAMEWORK_INC . 'extra/array_column.php' );
}

// Crowdfunding Functions

// Check if EDD and Crowdfunding plugin are active
if ( !function_exists( 'sd_is_crowdfunding' ) ) {
	function sd_is_crowdfunding() {
		return ( class_exists( 'Easy_Digital_Downloads' ) && class_exists( 'ATCF_Campaign' ) );
	}
}
if ( sd_is_crowdfunding() ) {
	require_once( SD_FRAMEWORK_INC . 'sd-theme-functions/sd-crowdfunding.php' );
}

// WooCommerce Functions
if ( class_exists( 'WooCommerce' ) ) {
	require_once( SD_FRAMEWORK_INC . 'sd-theme-functions/sd-woocommerce.php' );
}
if ( !function_exists( 'sd_is_woo' ) ) {
	function sd_is_woo() {
		if ( class_exists( 'WooCommerce' ) ) { 
			return true; 
		} else {
			return false;
		}
	}
}

// Check if Max Mega Menu is active
if ( class_exists( 'Mega_Menu_Style_Manager' ) ) {
	require_once( SD_FRAMEWORK_INC . 'sd-theme-functions/sd-extend-megamenu.php' );
}


// Add support for WP 2.9+ post thumbnails
if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 189, 189, true ); // default Post Thumbnail dimensions
	add_image_size( 'sd-blog-thumbs', 770, 400, true ); // blog thumbs
	add_image_size( 'sd-latest-blog', 360, 200, true ); // latest blog thumbs
	add_image_size( 'sd-campaign-grid', 366, 220, true ); // campaign grid thumbs
	add_image_size( 'sd-recent-blog-widget', 75, 70, true ); // recent blog widget thumbs
	add_image_size( 'sd-testimonials', 85, 85, true ); // testimonials thumbs
	add_image_size( 'sd-staff-thumbs', 366, 350, true ); // staff thumbs
	add_image_size( 'sd-events-thumbs', 266, 135, true ); // event thumbs
	add_image_size( 'sd-event-upcoming-thumb', 555, 305, true ); // upcoming events thumb
	add_image_size( 'sd-single-event', 570, 340, true ); // single event thumb
}
	
// Add rel PrettyPhoto to images in post
if ( !function_exists( 'sd_rel_prettyphoto' ) ) {
	function sd_rel_prettyphoto( $content ) {
		global $post;
	
		$sd_post_id = ( isset( $post->ID ) ? get_the_ID() : NULL );
		$pattern ="/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
		$replacement = '<a$1href=$2$3.$4$5 rel="PrettyPhoto[' . $sd_post_id . ']"$6>';
		$content = preg_replace( $pattern, $replacement, $content );

		return $content;
	}
	add_filter( 'the_content', 'sd_rel_prettyphoto' );
}
	// Add title tag
	add_theme_support( "title-tag" );

	// Add feed links to header
	add_theme_support( 'automatic-feed-links' );
	
	// Add post formats WP 3.1+
	add_theme_support( 'post-formats', array( 'video', 'audio', 'gallery') );

	// Run shortcodes in widgets
	add_filter( 'widget_text', 'do_shortcode' );
 
	// Change WP admin logo
if ( !function_exists( 'sd_custom_login_logo' ) ) {
	function sd_custom_login_logo() { 
		global $sd_data;
	
		if ( !empty( $sd_data['sd_admin_logo_upload'] ) ) {
?>
		
			<style type="text/css">
				body.login div#login h1 a {
					background-image: url(<?php echo $sd_data['sd_admin_logo_upload']['url']; ?>);
					background-size: auto;
					<?php if ( !empty( $sd_data['sd_admin_logo_height'] ) ) {
						echo 'height: ' . $sd_data['sd_admin_logo_height']['height'] . ';';
					} ?>
					padding-bottom: 30px;
					width: auto;
				}
			</style>
		<?php 
		}
	}
add_action( 'login_enqueue_scripts', 'sd_custom_login_logo' );
}

// Custom admin logo url
if ( !function_exists( 'sd_custom_login_logo_url' ) ) {
	function sd_custom_login_logo_url() {
		global $sd_data;
		
		if ( !empty( $sd_data['sd_admin_url'] ) ) {
	    	return esc_url( $sd_data['sd_admin_url'] );
		
		} else {
			return esc_url( home_url() );	
		}
			
	}
	add_filter( 'login_headerurl', 'sd_custom_login_logo_url' );
}
	
// Add editor style
if ( !function_exists( 'sd_add_editor_styles' ) ) {
	function sd_add_editor_styles() {
    	add_editor_style( 'editor-styles.css' );
	}
	
	add_action( 'init', 'sd_add_editor_styles' );
}

// Custom Youtube Embed
if ( !function_exists( 'sd_customize_youtube' ) ) {
	function sd_customize_youtube( $html, $url, $args ) {
 
	/* Modify video parameters. */
		if ( strstr( $html,'youtube.com/embed/' ) ) {
			$html = str_replace( '?feature=oembed', '?feature=oembed&amp;hd=1;rel=0;showinfo=0&amp;controls=2&amp;theme=light&amp;modestbranding=1', $html );
		}
	
    	return $html;
	}
	
	add_filter( 'oembed_result', 'sd_customize_youtube', 10, 3 );
}
	
// Filter tag clould output so that it can be styled by CSS
if ( !function_exists( 'sd_style_tag_cloud' ) ) {	
	function sd_style_tag_cloud( $tags ) {
	    $tags = preg_replace_callback( "|(class='tag-link-[0-9]+)('.*?)(style='font-size: )([0-9]+)(pt;')|",
        create_function(
            '$match',
            '$low=1; $high=5; $sz=($match[4]-8.0)/(22-8)*($high-$low)+$low; return "{$match[1]} tagsz-{$sz}{$match[2]}";'
        ),
        $tags );
    	return $tags;
	}
 	add_action( 'wp_tag_cloud', 'sd_style_tag_cloud' );
}
 
	
// Remove width and height from featured images
if ( !function_exists( 'sd_remove_width_height' ) ) {
	function sd_remove_width_height( $html ) {
		$html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
		
		return $html;
	}
	add_filter( 'post_thumbnail_html', 'sd_remove_width_height', 10 );
}
 
// Excerpt limit

if ( !function_exists( 'sd_excerpt_length' ) ) {	
	function sd_excerpt_length( $length ) {
		
		global $post;
		
		$post_type = get_post_type( $post );
		
		if ( $post_type == 'events' ) {
			return 30;
		} elseif ( $post_type == 'download' ) {
			return 15;
		} else {
			return 50;
		}

	}
	add_filter( 'excerpt_length', 'sd_excerpt_length', 999 );
}


// Excerpt more
if ( !function_exists( 'sd_excerpt_more' ) ) {	
	function sd_excerpt_more( $output ) {
		
		global $post;
		
		$post_type = get_post_type( $post );
		
		if ( $post_type !== 'case_studies' && $post_type !== 'download' && $post_type !== 'events' ) {

			return $output . '<p><a class="sd-more sd-all-trans" href="'. get_permalink( get_the_ID() ) . '#more-' . get_the_ID() . '">' . __( 'Read More', 'sd-framework' ) . '</a></p>';
			
		} else {
			return $output;
		}

	}
	add_filter( 'get_the_excerpt', 'sd_excerpt_more' );
}

// Change "more" text

if ( !function_exists( 'sd_new_excerpt_more' ) ) {	
	function sd_new_excerpt_more( $more ) {
		return '';
	}
	add_filter('excerpt_more', 'sd_new_excerpt_more');
}

if ( !function_exists( 'sd_more_text' ) ) {
function sd_more_text( $excerpt ) {
	global $post;
	if ( !get_post_type( $post ) == 'staff' ) {
		$excerpt .= '<a class="sd-more" href="' . get_permalink( get_the_ID() ) . '" title="' . esc_attr( __( 'Read More', 'sd-framework' ) ) . '">' . __( 'Read More', 'sd-framework' ) . '</a>';		
	}
	return $excerpt;
}
	add_filter('the_excerpt', 'sd_more_text');
}

// Exclude professors from tax archive

add_action( 'pre_get_posts', 'sd_exclude_professors' );

if ( !function_exists( 'sd_exclude_professors' ) ) {	
	function sd_exclude_professors( $query ) {
    	if ( $query->is_tax( 'course_discipline' ) ) {
        	$query->set( 'post_type', array( 'courses' ) );
	    }
    return $query;
	}
}

// Custom styling of widget titles in widget panel
if ( !function_exists( 'sd_custom_widgets_style' ) ) {
	function sd_custom_widgets_style() {
    	echo '
			 <style type="text/css">
			div.widget[id*=_tweets_widget-] .widget-top, div.widget[id*=_popular_posts_widget-] .widget-top, div.widget[id*=_recent_comments_widget-] .widget-top, div.widget[id*=_social_icons_widget-] .widget-top, div.widget[id*=_recent_posts_widget-] .widget-top, div.widget[id*=_flickr_widget-] .widget-top, div.widget[id*=_sd_tabbed_widget-] .widget-top, div.widget[id*=_sd_upcoming_events_widget-] .widget-top {
	color: #00adee;
	}
			</style>
';
	}
	add_action('admin_print_styles-widgets.php', 'sd_custom_widgets_style');
}
	
// Add PrettyPhoto rel to flexslider
if ( !function_exists( 'sd_prettphoto' ) ) {
	function sd_prettphoto ( $content ) {
		$content = preg_replace( "/<a/","<a rel=\"prettyPhoto[flexslider]\"", $content, 1 );
		return $content;
	}
	add_filter( 'wp_get_attachment_link', 'sd_prettphoto' );
}
	
// Alter Author Contact Fields
if ( !function_exists( 'sd_author_bio' ) ) {
	function sd_author_bio( $contactmethods ) {
		// Add Google Plus
		$contactmethods['facebook'] = __( 'Facebook', 'sd-framework' );
		$contactmethods['twitter'] = __( 'Twitter', 'sd-framework' );
		$contactmethods['googleplus'] = __( 'Google +', 'sd-framework' );
		$contactmethods['linkedin'] = __( 'Linked In', 'sd-framework' );
		
		return $contactmethods;
	}
	add_filter( 'user_contactmethods', 'sd_author_bio');
}

/* Add custom favicon
if ( !function_exists( 'sd_custom_favicon' ) ) {
	function sd_custom_favicon() {

		global $sd_data;

		if ( !empty( $sd_data['sd_favicon_upload']['url'] ) ) {
	        echo '<link rel="shortcut icon" href="'.  $sd_data['sd_favicon_upload']['url']  .'"/>'."\n";
	    } else { 
?>
		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/framework/images/favicon.ico" />
<?php   }
	}
	add_action( 'wp_head', 'sd_custom_favicon' );
}
*/
// Custom CSS
if ( !function_exists( 'sd_custom_css' ) ) {
	function sd_custom_css() {
		
		global $sd_data;
		
		$output = '';
		
		$custom_css = ( !empty($sd_data['sd_custom_css'] ) ? $sd_data['sd_custom_css'] : '' );
		
		if ( $custom_css <> '' ) {
			$output .= $custom_css . "\n";
		}
		
		// Output styles
		
		if ( $output <> '' ) {

			$output = "\n<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";

			echo $output;
		}
	}
		add_action( 'wp_head', 'sd_custom_css' );
}

// Maintenance Mode 

if ( !function_exists ( 'sd_maintenance' ) ) {
	function sd_maintenance() {
		
		global $sd_data;
		
		$sd_logo = ( !empty( $sd_data['sd_logo_upload']['url'] ) ? '<img src="'. esc_url( $sd_data['sd_logo_upload']['url'] ) . '" alt="' . __( 'Scheduled Maintenance', 'sd-framework') . '" style="display: block; margin: 0 auto;"/>' : NULL );
		
		if ( $sd_data['sd_maintenance'] == 1 ) {
		
			if ( !current_user_can( 'edit_themes' ) || !is_user_logged_in() ) {
				wp_die( $sd_logo . '<h1 style="text-align: center;">' . __( "WE'LL BE RIGHT BACK", 'sd-framework' ) . '</h1><p style="text-align:center;">'.__('We are currently performing scheduled maintenance. We should be back online shortly.', 'sd-framework').'</p>', get_bloginfo( 'name' ));
			}
			
		}
	}
	add_action('get_header', 'sd_maintenance');
}

// WP title for home
if ( !function_exists ( 'sd_wp_title_for_home' ) ) {
function sd_wp_title_for_home( $title ) {
  if( empty( $title ) && ( is_home() || is_front_page() ) ) {
    return __( 'Home', 'sd-framework' ) . ' | ' . get_bloginfo( 'description' );
  }
  return $title;
}
	add_filter( 'wp_title', 'sd_wp_title_for_home' );
}

// Disable Revolution Slider Update Notice
if ( function_exists( 'set_revslider_as_theme' ) ) {
	function sd_set_revslider_as_theme() {
		set_revslider_as_theme();
	}
	add_action( 'init', 'sd_set_revslider_as_theme' );
}

// Disable Ultimate VC Addons Notice
if( class_exists( 'Ultimate_VC_Addons' ) ) {
	define('ULTIMATE_NO_EDIT_PAGE_NOTICE', true);	
	define('ULTIMATE_NO_PLUGIN_PAGE_NOTICE', true);
}