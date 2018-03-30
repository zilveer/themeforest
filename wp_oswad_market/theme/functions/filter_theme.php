<?php 

function head_callback_on_bg(  ) {
}
/********** Remove Invalid p,br tag cause by wp editor **********/

add_filter('the_content', 'wd_shortcode_empty_fix');
function wd_shortcode_empty_fix($content){
	// array of custom shortcodes requiring the fix 
	$block = join("|",array("alert","accordion_item","align","badge","button","button_group","checklist","dropcap","code","one_half"
					,"one_third","one_fourth","one_fifth","one_sixth","two_third","three_fourth","two_fifth","four_fifth"
					,"three_fifth","five_sixth","one_half_last","one_third_last","one_fourth_last","one_fifth_last"
					,"one_sixth_last","two_third_last","three_fourth_last","two_fifth_last","three_fifth_last"
					,"four_fifth_last","five_sixth_last","heading","hidden_phone","label","progress","bar","quote"
					,"slideshow","tabs","tab_item","accordions"));
	// opening tag
	$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
		
	// closing tag
	$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
 
	return $rep;
}

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function theme_filter_wp_title( $title, $sep ){
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged;

	// Add the blog name.
	$title .= bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= ' | ' . sprintf( __( 'Page %s', 'wpdance' ), max( $paged, $page ) );
		
	return $title;
}
add_filter( 'wp_title', 'theme_filter_wp_title', 10, 2 );


/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since WD_Responsive
 */
function theme_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'theme_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since WD_Responsive
 * @return int
 */
function theme_excerpt_length( $length ) {
	return 450;
}
add_filter( 'excerpt_length', 'theme_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since WD_Responsive
 * @return string "Continue Reading" link
 */
function theme_continue_reading_link() {
	return '';
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'wpdance' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and wpdance_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since WD_Responsive
 * @return string An ellipsis
 */
function theme_auto_excerpt_more( $more ) {
	return '';
	return ' &hellip;' . theme_continue_reading_link();
}
add_filter( 'excerpt_more', 'theme_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since WD_Responsive
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function theme_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= theme_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'theme_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in style.css. This is just
 * a simple filter call that tells WordPress to not use the default styles.
 *
 * @since WD_Responsive
 */
add_filter( 'use_default_gallery_style', '__return_false' );

function theme_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
// Backwards compatibility with WordPress 3.0.
if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
	add_filter( 'gallery_style', 'theme_remove_gallery_css' );
	
if ( ! function_exists( 'theme_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own wpdance_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since WD_Responsive
 */
function theme_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	<div id="comment-<?php comment_ID(); ?>"  class="divcomment">
		<div class="divcomment-inner">
			<div class="comment-body"><?php comment_text(); ?></div>
			
			<div class="detail">
				<div class="avarta">
					<?php echo get_avatar( $comment, 68, get_template_directory_uri() . '/images/mycustomgravatar.png' ); ?>
				</div>
				<div class="detail_info">
					<div class="comment-author vcard">
						<?php printf( __( '%s', 'wpdance' ), sprintf( '<cite class="fn"><a href="%1$s" rel="external nofollow" class="url">%2$s</a></cite>', get_comment_author_url(),get_comment_author() ) ); ?>
					</div><!-- .comment-author .vcard -->	
					<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<?php
							/* translators: 1: date, 2: time */
							printf( __( '%1$s', 'wpdance' ), get_comment_date() ); ?></a>
							<?php edit_comment_link( __( '(Edit)', 'wpdance' ), ' ' );
						?>
					</div><!-- .comment-meta .commentmetadata -->
				</div>
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'wpdance' ); ?></em>
				
				<?php endif; ?>
				
				<div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->						
			</div>
		</div>
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'wpdance' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'wpdance' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

function theme_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'theme_remove_recent_comments_style' );	

// Custom search form
function my_search_form( $form ) {
	$rand_id = "-".rand();
    $form = '<form role="search" method="get" id="searchform'.$rand_id.'" action="' . home_url( '/' ) . '" >
    <div><label class="screen-reader-text" for="s'.$rand_id.'">' . __('Search for:','wpdance') . '</label>
    <div class="bg_search">
	<div class="bg_search_1">
	<input type="text" value="' . get_search_query() . '" name="s" id="s'.$rand_id.'" class="search-input" required="required" placeholder="'.__('search entire store ...','wpdance').'"/>
    <input type="submit" id="searchsubmit'.$rand_id.'" value="'. esc_attr__('Search','wpdance') .'" title="'.esc_attr__('Search','wpdance').'" />';
	if( in_array( "woocommerce/woocommerce.php", apply_filters( 'active_plugins', get_option( 'active_plugins' )  ) ) ){
		$form .= '<input type="hidden" name="post_type" value="product" />';
	}
    $form .= '</div></div></div>
    </form>';

    return $form;
}

add_filter( 'get_search_form', 'my_search_form' );

// Custom comment reply link
function my_replylink($c='',$post=null) {

  global $comment;

  // bypass

  if (!comments_open() || $comment->comment_type == "trackback" || $comment->comment_type == "pingback") return $c;

  // patch

  $id = $comment->comment_ID;

  $reply = __('Reply','wpdance');

  $o = '<a class="comment-reply-link" rel="prettyPhoto" id="'.$id.'" href="'.get_permalink().'?replytocom='.$id.'#respond"><span><span>'.$reply.'</span></span></a>';

  return $o;

}
//add_filter('comment_reply_link', 'my_replylink');


	function WD_get_featured_image($post_ID) {  
		$post_thumbnail_id = get_post_thumbnail_id($post_ID);  
		if ($post_thumbnail_id) {  
			$post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'thumbnail');  
			return $post_thumbnail_img[0];  
		}  
	} 


	
	

	function mobileMenu(){
		$locations = get_nav_menu_locations();
		$timeNow = time();
		$myMenu = wp_nav_menu( array( 'container_id' => "id-menu-mobile{$timeNow}",'container_class' => 'div-menu-mobile','theme_location' => 'primary','echo'=>false) );
		$foundPreg = preg_match('/^(<div(.*?)>)(.*?)<\/div>/ism',$myMenu,$match);
		if($foundPreg){
			$needReplace = $match[2];
			$toReplace = $needReplace.' data-role="content" role="main"';
			$finishDiv = str_replace ( $needReplace , $toReplace , $match[1] );
			$myMenu = str_replace ( $match[1] , $finishDiv , $myMenu );
			$ulContent  = $match[3];
			$foundPreg = preg_match('/^(<ul(.*?)>)(.*?)<\/ul>/ism',$ulContent,$match);
			if($foundPreg){
				$needReplace = $match[2];
				$toReplace = $needReplace.' data-role="listview" data-inset="true"';
				$finishUl= str_replace ( $needReplace , $toReplace , $match[1] );
				$myMenu = str_replace ( $match[1] , $finishUl , $myMenu );
			}

		}
		
		echo $myMenu;
	}

	/******************** Start Custom Stylesheet for less-css loading ********************/
	
	function enqueue_less_styles($tag, $handle) {
		global $wp_styles;		
		$match_pattern = '/\.less$/U';
		if ( preg_match( $match_pattern, $wp_styles->registered[$handle]->src ) ) {
			$handle = $wp_styles->registered[$handle]->handle;
			$media = $wp_styles->registered[$handle]->args;
			$_version = ( strlen($wp_styles->registered[$handle]->ver) > 0 )? $wp_styles->registered[$handle]->ver : $wp_styles->default_version;
			$href = $wp_styles->registered[$handle]->src . '?ver=' . $_version ;
			$rel = isset($wp_styles->registered[$handle]->extra['alt']) && $wp_styles->registered[$handle]->extra['alt'] ? 'alternate stylesheet' : 'stylesheet';
			$title = isset($wp_styles->registered[$handle]->extra['title']) ? "title='" . esc_attr( $wp_styles->registered[$handle]->extra['title'] ) . "'" : '';

			$tag = "<link rel='stylesheet/less' id='{$handle}' {$title} href='{$href}' type='text/less' media='{$media}' />\n";
		}
		return $tag;
	}
	add_filter( 'style_loader_tag', 'enqueue_less_styles', 5, 2);
	
	/******************** End Custom Stylesheet for less-css loading ********************/	
	
	
if ( ! function_exists( 'wd_print_heading' ) ) {
	function wd_print_heading(){
	
		$textlogo = get_option('text_logo');
		$logo = get_option(THEME_SLUG.'logo','');
		$tag_line = get_bloginfo('description');
		$_echo_out_string = strlen($textlogo) > 0 ? $textlogo : $tag_line;	
	
		if( is_home() || is_front_page() ){
			$_home_button_text = get_option(THEME_SLUG.'_home_button_text','Learn More');
			$_home_button_link = get_option(THEME_SLUG.'promotion_button_uri','http://wpdance.com');			
			echo '<div class="ads-info">';
			echo '<h2 class="tag_line site-title">'.$_echo_out_string.'</h2>';
			echo '<a class="read_more" href="'.$_home_button_link.'">'.$_home_button_text.'</a>';
			echo '</div>';
		}else{
			if ( is_category() ) {
				echo "<h1 class=\"page-title archive-title catagory-title site-title\">";
				printf( __( 'Category :%s', 'wpdance' ), single_cat_title( '', false ) );
				echo "</h1>";
			}
			elseif ( is_search() ) {
				echo '<h1 class="search-title page-title site-title">';
				printf( __( 'Search Results for: %s', 'wpdance' ), get_search_query() );
				echo '</h1>';
		 
			}elseif ( is_day() ) {
				echo '<h1 class="page-title archive-title site-title">';
				printf( __( 'Day : %s', 'wpdance' ), get_the_date() );
				echo '</h1>';
			} elseif ( is_month() ) {
				echo '<h1 class="page-title archive-title  site-title">';
				printf( __( 'Month : %s', 'wpdance' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'wpdance' ) ) ); 
				echo '</h1>';
		 
			} elseif ( is_year() ) {
				echo '<h1 class="page-title archive-title site-title">';
				printf( __( 'Year : %s', 'wpdance' ), get_the_date( _x( 'Y', 'yearly archives date format', 'wpdance' ) ) ); 
				echo '</h1>';
		 
			} elseif ( is_single() && !is_attachment() ) {
				echo '<div class="ads-info">';
				echo '<h1 class="post-title single-title site-title">';
				echo $_echo_out_string;
				echo '</h1>';
				$_home_button_text = get_option(THEME_SLUG.'_home_button_text','Learn More');
				$_home_button_link = get_option(THEME_SLUG.'promotion_button_uri','http://wpdance.com');					
				echo '<a class="read_more" href="'.$_home_button_link.'">'.$_home_button_text.'</a>';
				echo "</div>";
			} elseif ( is_page() ) {
				echo '<h1 class="page-title single-title site-title">';
				the_title();
				echo '</h1>';
			} elseif ( is_attachment() ) {
				echo '<h1 class="attachment-title single-title site-title">';
				the_title();
				echo '</h1>';
			} elseif ( is_tag() ) {
				echo '<h1 class="tag-title archive-title site-title">';
				printf( __( 'Tag: %s', 'wpdance' ), single_tag_title( '', false ) );
				echo '</h1>';
		 
			} elseif ( is_author() ) {	
				global $author;
				$userdata = get_userdata($author);
				echo '<h1 class="author-title archive-title site-title">';
				//printf( __( 'Author : %s', 'wpdance' ), "<span class='vcard'><a class='url fn n' href='" . get_author_posts_url( $userdata->ID  ) . "' title='" . esc_attr( $userdata->display_name ) . "' rel='me'>" . $userdata->display_name . "</a></span>" );
				printf( __( 'Author : %s', 'wpdance' ), $userdata->display_name );
				echo '</h1>';
		 
			} elseif ( is_404() ) {
				echo '<h1 class="title-404 page-title site-title">';
				_e( 'OOPS! FILE NOT FOUND', 'wpdance' );
				echo '</h1>';
			} elseif( is_archive() ){
				echo '<h1 class="attachment-title single-title site-title">';
				_e( 'Archive', 'wpdance' );
				echo '</h1>';
			}
		
		}
	}
}	

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
function my_theme_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme
		array(
			'name'     				=> 'WooCommerce', // The plugin name
			'slug'     				=> 'woocommerce', // The plugin slug (typically the folder name)
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
		)
		,array(
			'name'     				=> 'WPBakery Visual Composer', // The plugin name
			'slug'     				=> 'js_composer', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/theme/includes/plugins/js_composer.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '4.12', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		)
		,array(
			'name'     				=> 'WooCommerce Grid / List toggle', // The plugin name
			'slug'     				=> 'woocommerce-grid-list-toggle', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		)
		,array(
			'name'     				=> 'Feature By Woothemes', // The plugin name
			'slug'     				=> 'features-by-woothemes', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		)
		,array(
			'name'     				=> 'Testimonials By Woothemes', // The plugin name
			'slug'     				=> 'testimonials-by-woothemes', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		)
		,array(
			'name'     				=> 'Yith Woocommerce Compare', // The plugin name
			'slug'     				=> 'yith-woocommerce-compare', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		)
		,array(
			'name'     				=> 'Yith Woocommerce Wishlist', // The plugin name
			'slug'     				=> 'yith-woocommerce-wishlist', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		)
		,array(
			'name'     				=> 'Contact Form 7', // The plugin name
			'slug'     				=> 'contact-form-7', // The plugin slug (typically the folder name)
			'required' 				=> false, 
		)
		,array(
			'name'     				=> 'Revolution Slider', // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/theme/includes/plugins/revslider.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '5.2.6', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		)
		,array(
			'name'     				=> 'Regenerate Thumbnails', // The plugin name
			'slug'     				=> 'regenerate-thumbnails', // The plugin slug (typically the folder name)
			'source'   				=> 'https://downloads.wordpress.org/plugin/regenerate-thumbnails.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '2.2.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		)
		,array(
			'name'     				=> 'Quickshop By Wpdance', // The plugin name
			'slug'     				=> 'wd_quickshop', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/theme/includes/plugins/wd_quickshop.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.0.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		)
		,array(
			'name'     				=> 'Product Color By Wpdance', // The plugin name
			'slug'     				=> 'wd_product-color', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/theme/includes/plugins/wd_product-color.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.0.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		)
		,array(
			'name'     				=> 'WD ShortCode', // The plugin name
			'slug'     				=> 'wd_shortcode', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/theme/includes/plugins/wd_shortcode.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.2.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		)
		,array(
			'name'     				=> 'WD Slide', // The plugin name
			'slug'     				=> 'wd_slide', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/theme/includes/plugins/wd_slide.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		)
		,array(
			'name'     				=> 'WD Portfolio', // The plugin name
			'slug'     				=> 'wd_portfolio', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/theme/includes/plugins/wd_portfolio.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		)
		,array(
			'name'     				=> 'WD Custom bbPress', // The plugin name
			'slug'     				=> 'wd_custom_bbpress', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/theme/includes/plugins/wd_custom_bbpress.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		)
		,array(
			'name'     				=> 'WD Team', // The plugin name
			'slug'     				=> 'wd_team', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/theme/includes/plugins/wd_team.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		)
	);

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> 'wpdance',         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', 'wpdance' ),
			'menu_title'                       			=> __( 'Install Plugins', 'wpdance' ),
			'installing'                       			=> __( 'Installing Plugin: %s', 'wpdance' ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', 'wpdance' ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', 'wpdance' ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'wpdance' ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'wpdance' ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}

?>
