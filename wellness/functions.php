<?php
	
	// Add RSS links to <head> section
	add_theme_support( 'automatic-feed-links' );
	
	// Include a Theme Options panel
	require_once ( get_template_directory() . '/bwpanel/bw-theme-options.php' );
	
	// Leverage Theme Customizer for custom colors
	require_once ( get_template_directory() . '/bwpanel/bw-theme-customizer.php' );
		
	// Register Custom Recent Articles Widget
	require_once ( get_template_directory() . '/inc/bw_recentarticlewidget.php' );
	
	// Include Shortcode library
	require_once ( get_template_directory() . '/inc/bw_shortcodes.php' );
	
	// Load textdomain for localizing
 	load_theme_textdomain( 'bw_themes', get_template_directory() . '/languages' );

	// Include Plugin Activation
	require_once ( get_template_directory() . '/inc/class-tgm-plugin-activation.php' );
	require_once ( get_template_directory() . '/inc/plugin-activation.php' );
	
	//Set max content width
	if ( ! isset( $content_width ) ) $content_width = 900;
	
	//Enable Custom Header Image
	$args = array(
		'flex-width'    => true,
		'width'         => 145,
		'flex-height'    => true,
		'height'        => 54,
		'default-image' => get_template_directory_uri() . '/images/logo.png',
		'uploads'       => true,
	);
	add_theme_support( 'custom-header', $args );
	
	//enable post thumbnails
	add_theme_support( 'post-thumbnails' ); 
	set_post_thumbnail_size( 100, 100, true ); // default Post Thumbnail dimensions (cropped)
	add_image_size( 'recent-thumbnails', 55, 55, true ); // Sets Recent Posts Thumbnails
	
	//Custom Excerpt format
	function bw_excerpt_more( $more ) {
	global $post;
	return '';
	}
	add_filter('excerpt_more', 'bw_excerpt_more');

	//make custom menus
	function register_my_menus() {
	register_nav_menus(
		array(
		'main-menu' => 'Main Menu'
		)
	);
	}
	add_action( 'init', 'register_my_menus' );
		

 /* Setup blog comment style 
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Eleven 1.0
 */
function bw_twentyeleven_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php echo 'Pingback: '; comment_author_link(); ?><?php edit_comment_link( 'Edit', '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment">
			<div class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf('%1$s on %2$s <span class="says">'.__('said','bw_themes').':</span>',
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s">%3$s</a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( '%1$s at %2$s', get_comment_date(), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link(__('Edit','bw_themes'), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.','bw_themes'); ?></em>
					<br />
				<?php endif; ?>

			</div>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __('Reply','bw_themes'), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</div><!-- #comment-## -->
		
	<?php
			break;
	endswitch;
}
		// Load styles
	
		function load_bw_styles() {
			if (!is_admin()) { 
				$template_url = get_stylesheet_directory_uri();
				$parent_template = get_template_directory_uri();				
				wp_register_style('commoncss', ($parent_template."/style.css"), 'all');
				wp_enqueue_style('commoncss');
				//Skin CSS's
				$style = bwthemes_option('color_radio');
				if ($style == 'choice1') {
					wp_register_style('skin1css', ($parent_template."/skins/skin1.css"), 'all');
					wp_enqueue_style('skin1css');				
					}
				elseif ($style == 'choice2') {
					wp_register_style('skin2css', ($parent_template."/skins/skin2.css"), 'all');
					wp_enqueue_style('skin2css');
					}
				elseif ($style == 'choice3') {
					wp_register_style('skin3css', ($parent_template."/skins/skin3.css"), 'all');
					wp_enqueue_style('skin3css');
					}
				elseif ($style == 'choice4') {
					wp_register_style('skin4css', ($parent_template."/skins/skin4.css"), 'all');
					wp_enqueue_style('skin4css');				
					}
				wp_register_style('buttoncss', ($parent_template."/css/buttons.css"), 'all');
				wp_enqueue_style('buttoncss');
				wp_register_style('googlefont', "http://fonts.googleapis.com/css?family=Signika:400,600,700", 'all');
				wp_enqueue_style('googlefont');
				wp_register_style('fancyboxcss', ($parent_template."/fancybox/jquery.fancybox-1.3.4.css"), 'all');
				wp_enqueue_style('fancyboxcss');
				wp_register_style('superfishcss', ($parent_template."/css/superfish.css"), 'all');
				wp_enqueue_style('superfishcss');
				wp_register_style('superfishnavcss', ($parent_template."/css/superfish-navbar.css"), 'all');
				wp_enqueue_style('superfishnavcss');
				wp_register_style('superfishvertcss', ($parent_template."/css/superfish-vertical.css"), 'all');
				wp_enqueue_style('superfishvertcss');
				wp_register_style('mobilecss', ($parent_template."/css/mobile.css"), false, '1.0' ,'screen and (max-width: 767px)');
				wp_enqueue_style('mobilecss');
			}
		}
	
	add_action('wp_enqueue_scripts', 'load_bw_styles');
	
	
	// Load jQuery + scripts
	
		function load_bw_scripts() {
			if (!is_admin()) { 
				$template_url = get_template_directory_uri(); 
				wp_enqueue_script('jquery-ui-core');		   
				wp_enqueue_script('jquery-ui-accordion', false);
				wp_enqueue_script('jquery-ui-tabs', false);
				wp_enqueue_script('jquery-ui-datepicker', false);
				wp_register_script('timepicker', ($template_url."/js/jquery.timepicker.js"), false);
				wp_enqueue_script('timepicker');
				wp_register_script('fancybox', ($template_url."/fancybox/jquery.fancybox-1.3.4.pack.js"), false);
				wp_enqueue_script('fancybox');
				wp_register_script('hoverintent', ($template_url."/js/hoverIntent.js"), false);
				wp_enqueue_script('hoverintent');
				wp_register_script('jquery-bgiframe', ($template_url."/js/jquery.bgiframe.min.js"), false);
				wp_enqueue_script('jquery-bgiframe');
				wp_register_script('superfish', ($template_url."/js/superfish.js"), false);
				wp_enqueue_script('superfish');
				wp_register_script('supersubs', ($template_url."/js/supersubs.js"), false);
				wp_enqueue_script('supersubs');	
				wp_register_script('bxslider', ($template_url."/js/jquery.bxSlider.min.js"), false);
				wp_enqueue_script('bxslider');
				wp_register_script('wellness', ($template_url."/js/wellness.settings.js"), false);
				wp_enqueue_script('wellness');

			}
		}
	
	add_action('wp_enqueue_scripts', 'load_bw_scripts');
	
function dimox_breadcrumbs() {
 
  $delimiter = '&raquo;'; // delimiter between crumbs
  $home = 'Home'; // text for the 'Home' link
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
 
  global $post;
  $homeLink = home_url();
  
    echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
      echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
 
    } elseif ( is_search() ) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        echo $cats;
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
      }
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo 'Page ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</div>';
 
} // end dimox_breadcrumbs()
	
	
	// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
	
	
	
    // Apply Fancybox style
	add_filter('the_content', 'addfancyboxclass', 12);
	add_filter('get_comment_text', 'addfancyboxclass');
	function addfancyboxclass ($content) {   
	global $post;
		$pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
		$replacement = '<a$1href=$2$3.$4$5 rel="fancyimg"$6>$7</a>';
		$content = preg_replace($pattern, $replacement, $content);
		return $content;
	}

	// Register Sidebar Widget
    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => 'Sidebar Widgets',
    		'id'   => 'sidebar-widgets',
    		'description'   => 'These are widgets for the sidebar.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h3>',
    		'after_title'   => '</h3>'
    	));
    }

	
	// Register Footer Widget 1
	register_sidebar(array(
		'name' => 'Footer Column 1',
		'id'        => 'footer-widgets1',
		'description' => 'Footer Widgets Content Area',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2><span>',
		'after_title' => '</span></h2>',
	));
	
	// Register Footer Widget 2
	register_sidebar(array(
		'name' => 'Footer Column 2',
		'id'        => 'footer-widgets2',
		'description' => 'Footer Widgets Content Area',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2><span>',
		'after_title' => '</span></h2>',
	));
	
	// Register Footer Widget 3
	register_sidebar(array(
		'name' => 'Footer Column 3',
		'id'        => 'footer-widgets3',
		'description' => 'Footer Widgets Content Area',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2><span>',
		'after_title' => '</span></h2>',
	));
	
	// Register Footer Widget 4
	register_sidebar(array(
		'name' => 'Footer Column 4',
		'id'        => 'footer-widgets4',
		'description' => 'Footer Widgets Content Area',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2><span>',
		'after_title' => '</span></h2>',
	));
?>
