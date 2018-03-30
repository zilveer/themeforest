<?php
/**
 * @package WordPress
 * @subpackage AllAround Theme
 * @author Shindiri Studio (http://www.shindiristudio.com) & http://www.mihajlovicnenad.com/
 */

// Run 'after_setup_theme' setup. Sets up theme defaults and registers support for WordPress features 
add_action( 'after_setup_theme', 'allaround_init' );
if ( ! function_exists( 'allaround_init' ) ) :
function allaround_init() {

	// Make theme available for translation. Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'allaround', get_template_directory() . '/languages' );
	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) ) require_once( $locale_file );

	// Adds featured images thumbnails
	add_filter( 'manage_posts_columns', 'allaround_posts_columns', 5 );
	add_action( 'manage_posts_custom_column', 'allaround_posts_custom_columns', 5, 2 );
	function allaround_posts_columns( $defaults ) {
		$defaults['post_thumbs'] = __( 'Featured image', 'allaround' );
		return $defaults;
	}
	function allaround_posts_custom_columns( $column_name, $id ) {
		if( $column_name === 'post_thumbs' ) {
			echo the_post_thumbnail( array( 60, 60 ) );
		}
	}

	// Add Theme Options Link
	function allaround_add_options_link() {
		global $wp_admin_bar;
		$wp_admin_bar -> add_menu( array(
			'parent' => 'site-name',
			'id' => 'allaround_options',
			'title' => __('AllAround Theme Options', 'allaround'),
			'href' => admin_url( 'themes.php?page=optionsframework' ),
			'meta' => false
		));
	}
	add_action( 'wp_before_admin_bar_render', 'allaround_add_options_link' );

	// Content width
	if ( ! isset( $content_width ) ) $content_width = 960;

	// Adds editor style
	add_editor_style();
	
	// Add Custom Background
	add_custom_background();
	
	// Post thumbnails
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'blog-full', 888, 317, true );
	add_image_size( 'blog-231', 231, 231, true );
	add_image_size( 'blog-148', 148, 148, true );
	add_image_size( 'products-500', 500, 500, true );

	// Add WooCommerce support

	add_theme_support( 'woocommerce' );	

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Register menu
	function allaround_menu_init() {
		register_nav_menus( array(
			'primary' => __( 'Primary Navigation', 'allaround' ),
		) );
	}
	add_action( 'init', 'allaround_menu_init' );		
	
	// Register widget areas
	
	function allaround_widgets_init() {
		global $allaround_data;
		$footer_widget_areas = $allaround_data['footer_sidebar'];

		for ( $i = 1; $i <= 4; $i++ ) {
			register_sidebar( array (
				'name' => __( 'Footer', 'allaround' ) . $i ,
				'id' => 'footer-' . $i,
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => "</aside>",
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			) );
		}
		if ( $allaround_data['sidebar-blog'] == 1 ) {
			register_sidebar( array (
				'name' => __('Blog Archive Sidebar', 'allaround'),
				'id' => 'sidebar-blog',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => "</aside>",
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			) );
		}
		if ( $allaround_data['sidebar-woocommerce'] == 1 ) {
			register_sidebar( array (
				'name' => __('Woocommerce Sidebar', 'allaround'),
				'id' => 'woocommerce',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => "</aside>",
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			) );
		}
		if ( $allaround_data['sidebar'] && $allaround_data['sidebar'][1]['title'] !== '' ) : $sidebars = $allaround_data['sidebar']; 
		foreach ( $sidebars as $sidebar ) {
			$title = sanitize_title( $sidebar['title'] );
			register_sidebar( array (
				'name' => $sidebar['title'] ,
				'id' => $title,
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => "</aside>",
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			) );
		}	
		endif;	
	}
	add_action( 'init', 'allaround_widgets_init' );	

	add_filter('jpeg_quality', 'allaround_quality');
	add_filter('wp_editor_set_quality', 'allaround_quality');
	function allaround_quality( $quality ) {
		return 95;
	}

}
endif;

/**
 * Nav Menu Dropdown
 */
 
class Walker_Nav_Menu_Dropdown extends Walker_Nav_Menu {
	function start_lvl(&$output, $depth=0, $args=array()){
		$indent = str_repeat("\t", $depth);
	}

	function end_lvl(&$output, $depth=0, $args=array()){
		$indent = str_repeat("\t", $depth);
	}

	function start_el(&$output, $item, $depth=0, $args=array(), $current_object_id = 0) {
		( $item->url == get_permalink() ) ? $selected = 'selected' : $selected = '';
		if ( $item->url !== '#' ) $output .= '<option value="' . $item->url . '" ' . $selected . '>' . $item->title . '</option>';
	}	

	function end_el(&$output, $item, $depth=0, $args=array()){
	}
}

// String limit by char
if ( ! function_exists('string_limit_words'))
{
	function string_limit_words($str, $n = 500, $end_char = '&#8230;')
	{
		if (strlen($str) < $n)
		{
			return $str;
		}

		$str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $str));

		if (strlen($str) <= $n)
		{
			return $str;
		}

		$out = "";
		foreach (explode(' ', trim($str)) as $val)
		{
			$out .= $val.' ';

			if (strlen($out) >= $n)
			{
				$out = trim($out);
				return (strlen($out) == strlen($str)) ? $out : $out.$end_char;
			}
		}
	}
}

// wp_nav_menu() fallback, wp_list_pages_custom()
function wp_list_pages_custom(){
	echo '<ul id="allaround_menu">';
	wp_list_pages( array( 'title_li' => '', 'depth' => '1' ));
	echo '</ul>';
	return;
}

// Pagiantion
function allaround_pagination($pages = '', $page = '', $ajax = '') {  
	if ( $page == '' ) {
		global $paged;
		if ( empty( $paged ) ) $paged = 1;
	}
	else {
	$paged = $page;
	}
	$next_page = $paged + 1;
	$prev_page = $paged - 1;
	$showitems = 5;  
	$out = '';

     if ( $pages == '' ) {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if ( !$pages ) {
             $pages = 1;
         }
     } 
	 
	 if ( $ajax !== '' && $ajax !== 'no' ) {
		 $ajaxload = 'onclick="allaround_ajaxload(jQuery(this)); return false;"';
	 }
	 else {
		 $ajaxload = '';
	 }
     
	if ( 1 != $pages ) {
		$out .= "<div class='pagination_wrapper'><div class=\"pagination\">";
		if ( $paged > 1 )$out .= "<a title=\"" . __('View newer posts', 'allaround') . "\" href=\"" . get_pagenum_link( $paged - 1 ) . "\" class=\"previous\" " . $ajaxload . ">". $prev_page ."</a>";
		for ( $i = 1; $i <= $pages; $i++ ) {
			if ( 1 != $pages && ( !( $i >= $paged + 3 || $i <= $paged - 3) || $pages <= $showitems ) ) {
				$out .= ( $paged == $i ) ? "<span class=\"current customColor1\">" . $i . "</span>" : "<a title='" . __( 'View page number', 'allaround' ) . " " . $i . "' href='" . get_pagenum_link( $i ) . "' class=\"inactive\" " .$ajaxload . ">" . $i . "</a>";
			}
			elseif ( $i == $paged + 3 ) {
				$out .= '<a>...</a>';
			}
			elseif ( $i == $paged - 3 ) {
				$out .= '<a>...</a> ';
			}

		}
		if ( $paged < $pages ) $out .= "<a title=\"" . __( 'View earlier posts', 'allaround' ) . "\" href=\"" . get_pagenum_link( $paged + 1 ) . "\" class=\"next\" " . $ajaxload . ">". $next_page ."</a>";
		$out .= "</div><div class=\"clear\"></div></div>";
	}
	return $out;
}

// iCarousel
function allaround_icarousel() {
	global $post;
	global $allaround_postmeta;
	$html = '';
	$html .= '<div id="featured" data-caption-animation="1" data-bg-color="" data-slider-height="" data-animation-speed="500" data-advance-speed="6500" data-autoplay="1"> ';
	$slides = $allaround_postmeta['slides'];
	foreach( $slides as $slide ) {
		$html .= '<div class="slide orbit-slide "><article style="background-image: url(' . $slide['url'] . ')"><div class="container"><div class="col span_12"><div class="post-title"><h2><span>' . $slide['title'] . '</span></h2></div><!--/post-title--></div></div></article></div>';
	}
	$html .= '</div>';
	echo $html;
}

// ThreeDSlider
function allaround_threedslider() {
	global $post;
	global $allaround_postmeta;
	$html = '';
	$html .= '<section id="dg-container" class="dg-container"><div class="dg-wrapper">';
	$slides = $allaround_postmeta['slides'];
	foreach( $slides as $slide ) {
		$html .= '<a href="#"><img class="slid-bord" src="' . $slide['url'] . '" alt="' . $slide['title'] . '"></a>';
	}
	$html .= '</div><nav><span class="dg-prev">&lt;</span><span class="dg-next">&gt;</span></nav></section>';
	echo $html;}


// Ajax load posts
function allaround_ajaxload_send() {
	$out = '';
	$top = ' top';
	$firstrow = 0;
	$post_counter = 0;
	$out = '';
	$query_string = $_POST['data'];
	$current_page = allaround_get_between($query_string, 'paged=', '&');
	$type = $_POST['type'];
	$page = $_POST['page'];
	$ajax = $_POST['ajax'];
	$query_string = str_replace('paged='.$current_page.'&', 'paged='.$page.'&', $query_string);
	$allaround_posts = new WP_Query( $query_string );
	if ( $allaround_posts->have_posts() ) :
		$out .= "<div class='blog_content {$type}' data-string='{$query_string}'>";
		switch( $type ) {
			case 'type-1' :
			$columns = 1;
			$class = '';
			$words = 512;
			while( $allaround_posts->have_posts() ): $allaround_posts->the_post();
				$post_counter++;
				$excerpt = get_the_excerpt();
				if ( is_sticky() ) $sticky = __('<span>Sticky</span> - ', 'allaround'); else $sticky = '';
				if ( $post_counter == $columns ) { $post_counter = 0; $last = ' last'; $clear = '<div class="clear"></div>'; } else { $last = ''; $clear = ''; }
				if ( !has_post_thumbnail()) $has_thumbail = ' no_thumbnail'; else $has_thumbail = '';
				$out .= '<div class="blog_post' . $class . $last . $has_thumbail . '">';
				$out .= '<div class="blog_post_wrapper">';
				$out .= '<h3><a href="' . get_permalink() . '">'. $sticky . get_the_title() .'</a></h3>';
				$out .= '<div class="blog_post_main_content">';
				if ( get_comments_number() == 1 ) $comments = __('Comment', 'allaround'); else $comments = __('Comments', 'allaround');
				$out .= '<div class="author_date_comments"><span class="author">' . get_the_author_meta('nickname') . '</span><span class="date">' . get_the_date() . '</span><span class="comments">' . get_comments_number() . ' ' . $comments . '</span></div><!-- author_date_comments -->';
				 if ( has_post_thumbnail()) {
					$out .= '<div class="blog_image_wrap"><div class="date_bubble_holder"><div class="date customColorBg"><span>' . get_the_date('d') . '<span>' . get_the_date('M') . '</span></span></div><!-- date --><div class="comments customColorBg"><a href="' . get_permalink() . '" title="' . __('Comment on this post', 'allaround') . '">' . get_comments_number() . '</a></div><!-- comments --></div><!-- date_bubble_holder -->';
					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large');
					$out .= '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" rel="prettyPhoto">';
					$out .= get_the_post_thumbnail(get_the_ID(), 'blog-full', array('class' => 'blog_post_image')); 
					$out .= '</a>';
					$out .= '</div><!-- blog_image_wrap -->';
				 }
				$out .= '<span class="blog_post_text">' . string_limit_words( $excerpt, $words ) . '</span><div class="clear"></div><!-- clear --></div><!-- blog_post_main_content --><div class="clear"></div><!-- clear --></div><!-- blog_post_wrapper -->';
				$out .= '<a href="' . get_permalink() . '" title="' . __('View', 'allaround') . ' ' . get_the_title() . '" class="read_more float_right button_hover_effect">' . __('Read More', 'allaround') . '</a><!-- read_more --><div class="clear"></div><!-- clear --></div><!-- blog_post -->';
			endwhile;
			break;
			case 'type-2' :
			$columns = 1;
			$class = ' blog2';
			$words = 256;
			while( $allaround_posts->have_posts() ): $allaround_posts->the_post();
				$post_counter++;
				$excerpt = get_the_excerpt();
				if ( is_sticky() ) $sticky = __('<span>Sticky</span> - ', 'allaround'); else $sticky = '';
				if ( $post_counter == $columns ) { $post_counter = 0; $last = ' last'; $clear = '<div class="clear"></div>'; } else { $last = ''; $clear = ''; }
				if ( !has_post_thumbnail()) $has_thumbail = ' no_thumbnail'; else $has_thumbail = '';
				$out .= '<div class="blog_post' . $class . $last . $has_thumbail . '">';
				if ( has_post_thumbnail()) {
					$out .= '<div class="image_wrapper">';
					$out .= get_the_post_thumbnail(get_the_ID(), 'blog-231', array('class' => 'content_image'));
					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large');
					$out .= '<div class="image_socials">
							<a href="http://www.facebook.com/sharer.php?u=' . get_permalink() . '&amp;t=' . get_the_title() . '" class="facebook-like fb" data-href="' . get_permalink() . '" data-send="false" data-layout="button_count" data-width="60" data-show-faces="false" rel="nofollow" target="_blank"><span><img src="' . get_template_directory_uri() . '/images/home/socials/facebook.png" alt="fb" /></span></a>
							<a href="http://pinterest.com/pin/create/button/?url=' . get_permalink() . '&amp;media=' . $large_image_url[0] . '&amp;description=' . get_the_title() . '" class="pinterest-pinit pin" data-count-layout="horizontal" rel="nofollow" ><span><img src="' . get_template_directory_uri() . '/images/home/socials/pinterest.png" alt="pin" /></span></a>
							<a href="http://twitter.com/home/?status=' . get_the_title() . ' ' . get_permalink() . '" class="twitter-share tw" data-count-layout="horizontal" rel="nofollow" target="_blank"><span><img src="' . get_template_directory_uri() . '/images/home/socials/twitter.png" alt="tw" /></span></a>
							</div><!-- image_socials -->';

					$out .= '<div class="image_more_info"><a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" rel="prettyPhoto">';
					$out .= '<img src="' . get_template_directory_uri() . '/images/home/more.png" alt="" class="customColorBg"/>'; 
					$out .= '</a></div><!-- image_more_info -->';
					$out .= '<div class="date_bubble_holder"><div class="date customColorBg"><span>' . get_the_date('d') . '<span>' . get_the_date('M') . '</span></span></div><!-- date --><div class="comments customColorBg"><a href="' . get_permalink() . '" title="' . __('Comment on this post', 'allaround') . '">' . get_comments_number() . '</a></div><!-- comments --></div><!-- date_bubble_holder -->';
					$out .= '</div><!-- image_wrapper -->';
				}
				$out .= '<div class="blog_post_main_content">';
				$out .= '<h3><a href="' . get_permalink() . '">'. $sticky . get_the_title() .'</a></h3>';
				if ( get_comments_number() == 1 ) $comments = __('Comment', 'allaround'); else $comments = __('Comments', 'allaround');
				$out .= '<div class="author_date_comments"><span class="author">' . get_the_author_meta('nickname') . '</span><span class="date">' . get_the_date() . '</span><span class="comments">' . get_comments_number() . ' ' . $comments . '</span></div><!-- author_date_comments -->';
				$out .= '<span class="blog_post_text">' . string_limit_words( $excerpt, $words ) . '</span><div class="clear"></div><!-- clear -->';				
				$out .= '<a href="' . get_permalink() . '" title="' . __('View', 'allaround') . ' ' . get_the_title() . '" class="read_more button_hover_effect">' . __('Read More', 'allaround') . '</a><!-- read_more --><div class="clear"></div><!-- clear --></div><!-- blog_post_main_content --><div class="clear"></div><!-- clear --></div><!-- blog_post blog2 -->';
				$out .= $clear;
			endwhile;
			break;
			case 'type-3' :
			$columns = 1;
			$class = ' blog2 blog3';		
			$words = 256;
			while( $allaround_posts->have_posts() ): $allaround_posts->the_post();
				$post_counter++;
				$excerpt = get_the_excerpt();
				if ( is_sticky() ) $sticky = __('<span>Sticky</span> - ', 'allaround'); else $sticky = '';
				if ( $post_counter == $columns ) { $post_counter = 0; $last = ' last'; $clear = '<div class="clear"></div>'; } else { $last = ''; $clear = ''; }
				if ( !has_post_thumbnail()) $has_thumbail = ' no_thumbnail'; else $has_thumbail = '';
				$out .= '<div class="blog_post' . $class . $last . $has_thumbail . '">';
				if ( has_post_thumbnail()) {
					$out .= '<div class="image_wrapper">';
					$out .= get_the_post_thumbnail(get_the_ID(), 'blog-148', array('class' => 'content_image'));
					$out .= '<div class="date_bubble_holder"><div class="comments customColorBg"><a href="' . get_permalink() . '" title="' . __('Comment on this post', 'allaround') . '">' . get_comments_number() . '</a></div><!-- comments --></div><!-- date_bubble_holder -->';
					
					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large');
					$out .= '<div class="image_more_info small"><a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" rel="prettyPhoto">';
					$out .= '<img src="' . get_template_directory_uri() . '/images/home/more.png" alt="" class="customColorBg" />'; 
					$out .= '</a></div><!-- image_more_info --></div><!-- image_wrapper -->';
				}
				if ( get_comments_number() == 1 ) $comments = __('Comment', 'allaround'); else $comments = __('Comments', 'allaround');
				$out .= '<div class="blog_post_main_content">';
				$out .= '<span class="category">' . get_the_category_list(', ') . '</span>';
				$out .= '<h3><a href="' . get_permalink() . '">'. $sticky . get_the_title() .'</a></h3>';
				$out .= '<div class="author_date_comments"><span class="author">' . get_the_author_meta('nickname') . '</span><span class="date">' . get_the_date() . '</span><span class="comments">' . get_comments_number() . ' ' . $comments . '</span></div><!-- author_date_comments -->';

				$out .= '<span class="blog_post_text">' . string_limit_words( $excerpt, $words ) . '</span><div class="clear"></div><!-- clear -->';				
				$out .= '<a href="' . get_permalink() . '" title="' . __('View', 'allaround') . ' ' . get_the_title() . '" class="read_more button_hover_effect">' . __('Read More', 'allaround') . '</a><!-- read_more --><div class="clear"></div><!-- clear --></div><!-- blog_post_main_content --><div class="clear"></div><!-- clear --></div><!-- blog_post blog2 blog3 -->';
				$out .= $clear;
			endwhile;
			break;
			case 'type-4' :
			$columns = 2;
			$class = ' blog2 blog2-2col';		
			$words = 256;
			while( $allaround_posts->have_posts() ): $allaround_posts->the_post();
				$post_counter++;
				$excerpt = get_the_excerpt();
				if ( is_sticky() ) $sticky = __('<span>Sticky</span> - ', 'allaround'); else $sticky = '';
				if ( $post_counter == $columns ) { $post_counter = 0; $last = ' last'; $clear = '<div class="clear"></div>'; } else { $last = ''; $clear = ''; }
				if ( !has_post_thumbnail()) $has_thumbail = ' no_thumbnail'; else $has_thumbail = '';
				$out .= '<div class="blog_post' . $class . $last . $has_thumbail . '">';
				if ( has_post_thumbnail()) {
					$out .= '<div class="image_wrapper">';
					$out .= get_the_post_thumbnail(get_the_ID(), 'blog-231', array('class' => 'content_image'));
					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large');
					$out .= '<div class="image_socials">
							<a href="http://www.facebook.com/sharer.php?u=' . get_permalink() . '&amp;t=' . get_the_title() . '" class="facebook-like fb" data-href="' . get_permalink() . '" data-send="false" data-layout="button_count" data-width="60" data-show-faces="false" rel="nofollow" target="_blank"><span><img src="' . get_template_directory_uri() . '/images/home/socials/facebook.png" alt="fb" /></span></a>
							<a href="http://pinterest.com/pin/create/button/?url=' . get_permalink() . '&amp;media=' . $large_image_url[0] . '&amp;description=' . get_the_title() . '" class="pinterest-pinit pin" data-count-layout="horizontal" rel="nofollow" ><span><img src="' . get_template_directory_uri() . '/images/home/socials/pinterest.png" alt="pin" /></span></a>
							<a href="http://twitter.com/home/?status=' . get_the_title() . ' ' . get_permalink() . '" class="twitter-share tw" data-count-layout="horizontal" rel="nofollow" target="_blank"><span><img src="' . get_template_directory_uri() . '/images/home/socials/twitter.png" alt="tw" /></span></a>
							</div><!-- image_socials -->';
					
					$out .= '<div class="image_more_info"><a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" rel="prettyPhoto">';
					$out .= '<img src="' . get_template_directory_uri() . '/images/home/more.png" alt="" class="customColorBg" />'; 
					$out .= '</a></div><!-- image_more_info -->';
					$out .= '<div class="date_bubble_holder"><div class="date customColorBg"><span>' . get_the_date('d') . '<span>' . get_the_date('M') . '</span></span></div><!-- date --><div class="comments customColorBg"><a href="' . get_permalink() . '" title="' . __('Comment on this post', 'allaround') . '">' . get_comments_number() . '</a></div><!-- comments --></div><!-- date_bubble_holder -->';
					$out .= '</div><!-- image_wrapper -->';
				}
				if ( get_comments_number() == 1 ) $comments = __('Comment', 'allaround'); else $comments = __('Comments', 'allaround');
				$out .= '<div class="blog_post_main_content">';
				$out .= '<h3><a href="' . get_permalink() . '">'. $sticky . get_the_title() .'</a></h3>';
				$out .= '<div class="author_date_comments"><span class="author">' . get_the_author_meta('nickname') . '</span><span class="date">' . get_the_date() . '</span><span class="comments">' . get_comments_number() . ' ' . $comments . '</span></div><!-- author_date_comments -->';

				$out .= '<span class="blog_post_text">' . string_limit_words( $excerpt, $words ) . '</span><div class="clear"></div><!-- clear -->';				
				$out .= '<a href="' . get_permalink() . '" title="' . __('View', 'allaround') . ' ' . get_the_title() . '" class="read_more button_hover_effect">' . __('Read More', 'allaround') . '</a><!-- read_more --><div class="clear"></div><!-- clear --></div><!-- blog_post_main_content --><div class="clear"></div><!-- clear --></div><!-- blog_post blog2 blog4-->';
				$out .= $clear;
			endwhile;
			break;
			case 'type-5' :
			$columns = 3;
			$class = ' index_preview blog2 blog2-2col';		
			$words = 192;
			while( $allaround_posts->have_posts() ): $allaround_posts->the_post();
				$post_counter++;
				$excerpt = get_the_excerpt();
				if ( is_sticky() ) $sticky = __('<span>Sticky</span> - ', 'allaround'); else $sticky = '';
				if ( $post_counter == $columns ) { $post_counter = 0; $last = ' last'; $clear = '<div class="clear"></div>'; } else { $last = ''; $clear = ''; }
				if ( !has_post_thumbnail()) $has_thumbail = ' no_thumbnail'; else $has_thumbail = '';
				$out .= '<div class="blog_post' . $class . $last . $has_thumbail . '">';
				if ( has_post_thumbnail()) {
					$out .= '<div class="image_wrapper">';
					$out .= get_the_post_thumbnail(get_the_ID(), 'blog-231', array('class' => 'content_image'));
					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large');
					$out .= '<div class="image_socials">
							<a href="http://www.facebook.com/sharer.php?u=' . get_permalink() . '&amp;t=' . get_the_title() . '" class="facebook-like fb" data-href="' . get_permalink() . '" data-send="false" data-layout="button_count" data-width="60" data-show-faces="false" rel="nofollow" target="_blank"><span><img src="' . get_template_directory_uri() . '/images/home/socials/facebook.png" alt="fb" /></span></a>
							<a href="http://pinterest.com/pin/create/button/?url=' . get_permalink() . '&amp;media=' . $large_image_url[0] . '&amp;description=' . get_the_title() . '" class="pinterest-pinit pin" data-count-layout="horizontal" rel="nofollow" ><span><img src="' . get_template_directory_uri() . '/images/home/socials/pinterest.png" alt="pin" /></span></a>
							<a href="http://twitter.com/home/?status=' . get_the_title() . ' ' . get_permalink() . '" class="twitter-share tw" data-count-layout="horizontal" rel="nofollow" target="_blank"><span><img src="' . get_template_directory_uri() . '/images/home/socials/twitter.png" alt="tw" /></span></a>
							</div><!-- image_socials -->';
					
					$out .= '<div class="image_more_info"><a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" rel="prettyPhoto">';
					$out .= '<img src="' . get_template_directory_uri() . '/images/home/more.png" alt="" class="customColorBg" />'; 
					$out .= '</a></div><!-- image_more_info -->';
					$out .= '<div class="date_bubble_holder"><div class="date customColorBg"><span>' . get_the_date('d') . '<span>' . get_the_date('M') . '</span></span></div><!-- date --><div class="comments customColorBg"><a href="' . get_permalink() . '" title="' . __('Comment on this post', 'allaround') . '">' . get_comments_number() . '</a></div><!-- comments --></div><!-- date_bubble_holder -->';
					$out .= '</div><!-- image_wrapper -->';
				}
				if ( get_comments_number() == 1 ) $comments = __('Comment', 'allaround'); else $comments = __('Comments', 'allaround');
				$out .= '<div class="blog_post_main_content">';
				$out .= '<h3><a href="' . get_permalink() . '">'. $sticky . get_the_title() .'</a></h3>';
				$out .= '<div class="author_date_comments"><span class="author">' . get_the_author_meta('nickname') . '</span><span class="date">' . get_the_date() . '</span><span class="comments">' . get_comments_number() . ' ' . $comments . '</span></div><!-- author_date_comments -->';

				$out .= '<span class="blog_post_text">' . string_limit_words( $excerpt, $words ) . '</span><div class="clear"></div><!-- clear -->';				
				$out .= '<a href="' . get_permalink() . '" title="' . __('View', 'allaround') . ' ' . get_the_title() . '" class="read_more button_hover_effect">' . __('Read More', 'allaround') . '</a><!-- read_more --><div class="clear"></div><!-- clear --></div><!-- blog_post_main_content --><div class="clear"></div><!-- clear --></div><!-- blog_post blog2 blog4-->';
				$out .= $clear;
			endwhile;
			break;
			case 'type-6' :
			$class = ' blog2 blog3 blog3-2col';
			$columns = 2;
			$words = 256;
			while( $allaround_posts->have_posts() ): $allaround_posts->the_post();
				$post_counter++;
				$excerpt = get_the_excerpt();
				if ( is_sticky() ) $sticky = __('<span>Sticky</span> - ', 'allaround'); else $sticky = '';
				if ( $firstrow == 0 ) { $top = ' top'; } else $top = '';
				if ( $post_counter == $columns ) { $post_counter = 0; $firstrow = 1; $last = ' last'; $clear = '<div class="clear"></div>'; } else { $last = ''; $clear = ''; }
				if ( !has_post_thumbnail()) $has_thumbail = ' no_thumbnail'; else $has_thumbail = '';
				$out .= '<div class="blog_post' . $class . $last . $has_thumbail . $top .'">';
				$out .= '<div class="blog_post_main_content">';
				if ( has_post_thumbnail()) {
					$out .= '<div class="image_wrapper">';
					$out .= get_the_post_thumbnail(get_the_ID(), 'blog-148', array('class' => 'content_image'));
					$out .= '<div class="date_bubble_holder"><div class="comments customColorBg"><a href="' . get_permalink() . '" title="' . __('Comment on this post', 'allaround') . '">' . get_comments_number() . '</a></div><!-- comments --></div><!-- date_bubble_holder -->';
					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large');
					$out .= '<div class="image_more_info small"><a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" rel="prettyPhoto">';
					$out .= '<img src="' . get_template_directory_uri() . '/images/home/more.png" alt="" class="customColorBg" />'; 
					$out .= '</a></div><!-- image_more_info --></div><!-- image_wrapper -->';
				}
				if ( get_comments_number() == 1 ) $comments = __('Comment', 'allaround'); else $comments = __('Comments', 'allaround');
				
				$out .= '<span class="category">' . get_the_category_list(', ') . '</span>';
				$out .= '<h3><a href="' . get_permalink() . '">'. $sticky . get_the_title() .'</a></h3>';
				$out .= '<div class="clear"></div>';

				$out .= '<span class="blog_post_text"><div class="author_date_comments"><span class="author">' . get_the_author_meta('nickname') . '</span><span class="date">' . get_the_date() . '</span><span class="comments">' . get_comments_number() . ' ' . $comments . '</span></div><!-- author_date_comments -->' . string_limit_words( $excerpt, $words ) . '</span><div class="clear"></div><!-- clear -->';				
				$out .= '<a href="' . get_permalink() . '" title="' . __('View', 'allaround') . ' ' . get_the_title() . '" class="read_more button_hover_effect">' . __('Read More', 'allaround') . '</a><!-- read_more --><div class="clear"></div><!-- clear --></div><!-- blog_post_main_content --><div class="clear"></div><!-- clear --></div><!-- blog_post blog2 blog3 -->';
				$out .= $clear;
			endwhile;
			break;
			case 'type-7' :
			$class = ' blog2 blog3 blog3-3col';
			$columns = 3;
			$words = 256;
			while( $allaround_posts->have_posts() ): $allaround_posts->the_post();
				$post_counter++;
				$excerpt = get_the_excerpt();
				if ( is_sticky() ) $sticky = __('<span>Sticky</span> - ', 'allaround'); else $sticky = '';
				if ( $firstrow == 0 ) { $top = ' top'; } else $top = '';
				if ( $post_counter == $columns ) { $post_counter = 0; $firstrow = 1; $last = ' last'; $clear = '<div class="clear"></div>'; } else { $last = ''; $clear = ''; }
				if ( !has_post_thumbnail()) $has_thumbail = ' no_thumbnail'; else $has_thumbail = '';
				$out .= '<div class="blog_post' . $class . $last . $has_thumbail . $top . '">';
				if ( $firstrow == 1 ) $top = '';
				if ( has_post_thumbnail()) {
					$out .= '<div class="image_wrapper">';
					$out .= get_the_post_thumbnail(get_the_ID(), 'blog-148', array('class' => 'content_image'));
					$out .= '<div class="date_bubble_holder"><div class="comments customColorBg"><a href="' . get_permalink() . '" title="' . __('Comment on this post', 'allaround') . '">' . get_comments_number() . '</a></div><!-- comments --></div><!-- date_bubble_holder -->';
					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large');
					$out .= '<div class="image_more_info small"><a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" rel="prettyPhoto">';
					$out .= '<img src="' . get_template_directory_uri() . '/images/home/more.png" alt="" class="customColorBg" />'; 
					$out .= '</a></div><!-- image_more_info --></div><!-- image_wrapper --><div class="clear"></div><!-- clear -->';
				}
				if ( get_comments_number() == 1 ) $comments = __('Comment', 'allaround'); else $comments = __('Comments', 'allaround');
				$out .= '<div class="blog_post_main_content">';
				$out .= '<span class="category">' . get_the_category_list(', ') . '</span>';
				$out .= '<h3><a href="' . get_permalink() . '">'. $sticky . get_the_title() .'</a></h3>';
				$out .= '<div class="author_date_comments"><span class="author">' . get_the_author_meta('nickname') . '</span> | <span class="date">' . get_the_date() . '</span> | <span class="comments">' . get_comments_number() . ' ' . $comments . '</span></div><!-- author_date_comments -->';

				$out .= '<span class="blog_post_text">' . string_limit_words( $excerpt, $words ) . '</span><div class="clear"></div><!-- clear -->';				
				$out .= '<a href="' . get_permalink() . '" title="' . __('View', 'allaround') . ' ' . get_the_title() . '" class="read_more button_hover_effect">' . __('Read More', 'allaround') . '</a><!-- read_more --><div class="clear"></div><!-- clear --></div><!-- blog_post_main_content --><div class="clear"></div><!-- clear --></div><!--  blog_post blog2 blog3 -->';
				$out .= $clear;
			endwhile;
			break;
		}
		$out .=  '<div class="clear"></div>';		
		$out .= allaround_pagination($allaround_posts->max_num_pages, $page, $ajax);
		$out .=  '</div><div class="clear"></div>';
	endif;
	wp_reset_query();	
  	die($out);
	exit;
}
add_action('wp_ajax_nopriv_allaround_ajaxload_send', 'allaround_ajaxload_send');
add_action('wp_ajax_allaround_ajaxload_send', 'allaround_ajaxload_send');

// Ajax load Products posts
function allaround_ajaxload_products_send() {
	if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	    return;
	}
	$query_string = $_POST['data'];
	$current_page = allaround_get_between($query_string, 'paged=', '&');
	$type = $_POST['type'];
	$page = $_POST['page'];
	$ajax = $_POST['ajax'];
	$query_string = str_replace('paged='.$current_page.'&', 'paged='.$page.'&', $query_string);

	switch ( $type ) {
		case 'related_products' :
		$product_category = (object) array('name' => __('Related Products', 'allaround'), 'description' => __('Check out these related products.', 'allaround'));
		break;
		case 'upsells_products' :
		$product_category = (object) array('name' => __('Interesting Products', 'allaround'), 'description' => __('You might also like this products.', 'allaround'));
		break;
		case 'category_products' :
		preg_match_all("#terms%5D=([0-9]+)#is", $query_string, $matches);
		$matches = $matches[1];
		$product_category = (object) get_term_by('id', $matches[0], 'product_cat');
		break;
		case 'all_products' :
		$product_category = (object) array('name' => __('All Products', 'allaround'), 'description' => __('All Products are listed.', 'allaround'));
		break;
	}
	
	$out = '';
	$product_sidebar = '';
	$product_entry = '';
	$post_counter = 0;
	$class = $type;
	$allaround_posts = new WP_Query( $query_string );
		if ( $allaround_posts->have_posts() ) :
			$out .= '<div class="products_wrapper '. $class .'" data-string="'. $query_string .'">';
			while( $allaround_posts->have_posts() ): $allaround_posts->the_post();
				global $product;
				$post_counter++;
				
				if ( $product->get_price() == '' ) :

					$add_to_cart = '';
					
				elseif ( ! $product->is_in_stock() ) : 

				$add_to_cart = '';

				else :

					$link = array(
						'url'   => '',
						'label' => '',
						'class' => ''
					);

					$handler = apply_filters( 'woocommerce_add_to_cart_handler', $product->product_type, $product );

					switch ( $handler ) {
						case "variable" :
							$link['url'] 	= apply_filters( 'variable_add_to_cart_url', get_permalink( $product->id ) );
							$link['label'] 	= apply_filters( 'variable_add_to_cart_text', __( 'Select options', 'allaround' ) );
						break;
						case "grouped" :
							$link['url'] 	= apply_filters( 'grouped_add_to_cart_url', get_permalink( $product->id ) );
							$link['label'] 	= apply_filters( 'grouped_add_to_cart_text', __( 'View options', 'allaround' ) );
						break;
						case "external" :
							$link['url'] 	= apply_filters( 'external_add_to_cart_url', get_permalink( $product->id ) );
							$link['label'] 	= apply_filters( 'external_add_to_cart_text', __( 'Read More', 'allaround' ) );
						break;
						default :
							if ( $product->is_purchasable() ) {
								$link['url'] 	= apply_filters( 'add_to_cart_url', esc_url( $product->add_to_cart_url() ) );
								$link['label'] 	= apply_filters( 'add_to_cart_text', __( 'Add to cart', 'allaround' ) );
								$link['class']  = apply_filters( 'add_to_cart_class', 'add_to_cart_button' );
							} else {
								$link['url'] 	= apply_filters( 'not_purchasable_url', get_permalink( $product->id ) );
								$link['label'] 	= apply_filters( 'not_purchasable_text', __( 'Read More', 'allaround' ) );
							}
						break;
					}

					$add_to_cart =  apply_filters( 'woocommerce_loop_add_to_cart_link', sprintf('<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="%s button product_type_%s">%s</a>', esc_url( $link['url'] ), esc_attr( $product->id ), esc_attr( $product->get_sku() ), esc_attr( $link['class'] ), esc_attr( $product->product_type ), esc_html( $link['label'] ) ), $product, $link );

				endif;

				if ( $post_counter == 3 ) { $post_counter = 0; $last = ' last'; $clear = '<div class="clear"></div>'; } else { $last = ''; $clear = ''; }
				$excerpt = get_the_excerpt();
				$product_sidebar .= '<li><div class="dot customColorBg"></div><a href="' . get_permalink() . '">' .  get_the_title() . '</a><div class="clear"></div><span>' . string_limit_words( $excerpt, 50 ) . '</span></li>';
				
				$product_entry .= '<div class="product_block' . $last . '"><div class="image_wrapper prod">' . get_the_post_thumbnail(get_the_ID(), 'blog-231', array('class' => 'content_image')) . '<div class="image_more_info">';
				$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'product-500');

				if ( $price_html = $product->get_price_html() ) { $price_html = '<span class="price">' . $price_html . '</span>'; } else $price_html = '';
				$product_entry .= '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" rel="prettyPhoto"><img src="' . get_template_directory_uri() . '/images/home/more.png" alt=""  class="customColorBg" /></a>
					</div><!-- image_more_info --><div class="image_read_more_wrapper"><div class="image_read_more"><a href="' . get_permalink() . '">' . __( 'Read More', 'allaround' ) . '</a></div></div><!-- image_read_more_wrapper -->' . $price_html . $add_to_cart . '</div><!-- image_wrapper --><h3><a href="' . get_permalink() . '">' .  get_the_title() . '</a></h3><span>' . string_limit_words( $excerpt, 50 ) . '</span></div><!-- product-block -->' . $clear;

			endwhile;
			$out .= '<div class="products_sidebar products"><h3>' . $product_category->name . '</h3><span class="subtitle customColor">' . $product_category->description . '</span><ul>';
			$out .= $product_sidebar;
			$out .= '</ul></div><!-- products_sidebar --><div class="products_content">';
			$out .= $product_entry;
			$out .= '</div><!-- products_content -->';
			
			$out .= '<div class="clear"></div>';
			$out .= allaround_pagination($allaround_posts->max_num_pages, $page, $ajax);
			$out .=  '</div>';
		endif;
	wp_reset_query();
  	die($out);
	exit;
}
add_action('wp_ajax_nopriv_allaround_ajaxload_products_send', 'allaround_ajaxload_products_send');
add_action('wp_ajax_allaround_ajaxload_products_send', 'allaround_ajaxload_products_send');

    /*
    Plugin Name: Shortcode empty Paragraph fix
    Plugin URI: http://www.johannheyne.de/wordpress/shortcode-empty-paragraph-fix/
    Description: Fix issues when shortcodes are embedded in a block of content that is filtered by wpautop.
    Author URI: http://www.johannheyne.de
    Version: 0.1
    Put this in /wp-content/plugins/ of your Wordpress installation
    */


    add_filter('the_content', 'shortcode_empty_paragraph_fix');
    function shortcode_empty_paragraph_fix($content)
    {   
        $array = array (
            '<p>[' => '[', 
            ']</p>' => ']', 
            ']<br />' => ']',
			']<br>' => ']'
        );

        $content = strtr($content, $array);

		return $content;
    }

// Sidebars init
function allaround_sidebar_init() {
	global $allaround_postmeta;	
	
	if ( isset($allaround_postmeta['override-sidebar-right']) ) { $selected_sidebar = $allaround_postmeta['override-sidebar-right']; } else { $selected_sidebar = 'None'; }
	if ( $selected_sidebar == 'None' ) $sidebar_class = 'no-sidebar'; else $sidebar_class = '';

	$out = array();
	$out['right'] = $selected_sidebar;
	$out['sidebarclass'] = $sidebar_class;
	return $out;
}

// Breadcrumbs
function allaround_breadcrumbs() {
  $showOnHome = 0;
  $delimiter = '/';
  $homeLink = home_url( '/' );
  $home = __('Home', 'allaround');
  $showCurrent = 1;
  $before = '<span class="customColor3">';
  $after = '</span>';
  global $post;
    echo '<span class="bread_crumps">' . __('You are here', 'allaround') . ': <a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

	if ( is_page() OR is_single() ) {
		if ( !$post->post_parent ) {
		  if ( $post->post_type == 'post' ) echo __('Blog', 'allaround') . ' ' . $delimiter . ' ';
		  if ( $post->post_type == 'allaround_portfolio' ) echo __('Portfolio', 'allaround') . ' ' . $delimiter . ' ';
		  if ( $showCurrent == 1 ) echo $before . get_the_title() . $after;
		} elseif ( $post->post_parent ) {
		  $parent_id  = $post->post_parent;
		  $breadcrumbs = array();
		  while ( $parent_id ) {
			$page = get_page( $parent_id );
			$breadcrumbs[] = '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>';
			$parent_id  = $page->post_parent;
		  }
		  $breadcrumbs = array_reverse( $breadcrumbs );
		  for ( $i = 0; $i < count($breadcrumbs); $i++ ) {
			echo $breadcrumbs[$i];
			if ( $i != count( $breadcrumbs ) - 1 ) echo ' ' . $delimiter . ' ';
		  }
		  if ( $showCurrent == 1 ) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
		}
	}
	elseif ( is_category() OR is_tag() ) {
		echo __('Archives', 'allaround') . ' ' . $delimiter . ' ' . single_cat_title( '', false );	
	}
	elseif ( is_month() ) {
		echo __('Archives', 'allaround') . ' ' . $delimiter . ' ' . get_the_date('F');	
	}
	elseif ( is_year() ) {
		echo __('Archives', 'allaround') . ' ' . $delimiter . ' ' . get_the_date('Y');	
	}
	elseif ( is_date() ) {
		echo __('Archives', 'allaround') . ' ' . $delimiter . ' ' . get_the_date('l');	
	}
	elseif ( is_search() ) {
		echo __('Search', 'allaround') . ' ' . $delimiter . ' ' . get_search_query();	
	}
	elseif ( is_404() ) {
		echo __('404 Page', 'allaround');	
	}
	elseif ( ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && is_product()) ) {
		echo '<a href="'. get_permalink( woocommerce_get_page_id( 'shop' ) ).'">' . __('Products', 'allaround') . '</a> ' . $delimiter . ' ' . get_the_title();	
	}
	elseif ( ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && is_shop()) ) {
		$_name = woocommerce_get_page_id( 'shop' ) ? get_the_title( woocommerce_get_page_id( 'shop' ) ) : '';
		echo $_name;
	}
	elseif ( ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && ( is_product_category() or is_product_tag() ) ) ) {
		$current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		echo $current_term->name;
	}
	else {
		echo __('Blog', 'allaround');	
	}
    echo '</span>';
}

// Time ago function
function allaround_time_ago($date) {
	$chunks = array(
		array( 60 * 60 * 24 * 365 , __( 'year', 'allaround' ), __( 'years', 'allaround' ) ),
		array( 60 * 60 * 24 * 30 , __( 'month', 'allaround' ), __( 'months', 'allaround' ) ),
		array( 60 * 60 * 24 * 7, __( 'week', 'allaround' ), __( 'weeks', 'allaround' ) ),
		array( 60 * 60 * 24 , __( 'day', 'allaround' ), __( 'days', 'allaround' ) ),
		array( 60 * 60 , __( 'hour', 'allaround' ), __( 'hours', 'allaround' ) ),
		array( 60 , __( 'minute', 'allaround' ), __( 'minutes', 'allaround' ) ),
		array( 1, __( 'second', 'allaround' ), __( 'seconds', 'allaround' ) )
	);
	if ( !is_numeric( $date ) ) {
		$time_chunks = explode( ':', str_replace( ' ', ':', $date ) );
		$date_chunks = explode( '-', str_replace( ' ', '-', $date ) );
		$date = gmmktime( (int)$time_chunks[1], (int)$time_chunks[2], (int)$time_chunks[3], (int)$date_chunks[1], (int)$date_chunks[2], (int)$date_chunks[0] );
	}
	$current_time = current_time( 'mysql', $gmt = 0 );
	$newer_date = strtotime( $current_time );
	$since = $newer_date - $date;
	if ( 0 > $since )
		return __( 'sometime', 'allaround' );
	for ( $i = 0, $j = count($chunks); $i < $j; $i++) {
		$seconds = $chunks[$i][0];
		if ( ( $count = floor($since / $seconds) ) != 0 )
			break;
	}
	$output = ( 1 == $count ) ? '1 <span class="text-ago">'. $chunks[$i][1] : $count . ' <span class="text-ago">' . $chunks[$i][2];
	if ( !(int)trim($output) ){
		$output = '0' . __( 'seconds', 'allaround' );
	}
	$output .= __(' ago</span>', 'allaround');
	return $output;
}

// Contact form
function allaround_contact_form( $users = '1' ) {
	global $allaround_data, $allaround_contact_form_id;

	if ( isset( $allaround_data['contact'] ) ) $contact_options = $allaround_data['contact'];
	if ( isset ( $allaround_contact_form_id ) == false ) { global $allaround_contact_form_id; $allaround_contact_form_id = 1; }
	if( isset( $_POST['submitted-' . $allaround_contact_form_id] ) ) {
		if( trim( $_POST['contactName'] ) === '' ) {
			$nameError = '<small>' . __( 'Please enter your name', 'allaround' ) . '</small>';
			$hasError = true;
		} else {
			$name = trim( $_POST['contactName'] );
		}
		if( trim( $_POST['contactEmail'] ) === '' ) {
			$emailError = '<small>' . __( 'Please enter your email address', 'allaround' ) . '</small>';
			$hasError = true;
		} else if ( !preg_match( "/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim( $_POST['contactEmail'] ) ) ) {
			$emailError = '<small>' . __('You entered an invalid email address', 'allaround') . '</small>';
			$hasError = true;
		} else {
			$email = trim( $_POST['contactEmail'] );
		}
		if( trim( $_POST['commentsText'] ) === '' ) {
			$commentError = '<small>' . __( 'Please enter a message', 'allaround' ) . '</small>';
			$hasError = true;
		} else {
			if ( function_exists( 'stripslashes' ) ) {
				$comments = stripslashes( trim( $_POST['commentsText'] ) );
			} else {
				$comments = trim( $_POST['commentsText'] );
			}
		}
		if ( !isset( $hasError ) ) {
		if ( $_POST['contactEmailSend'] == 'main' ) : $emailTo = $allaround_data['main_contact']['email']; else : $emailTo = $contact_options[$_POST['contactEmailSend']]['email']; endif;
			$subject = 'From ' . $name;
			$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
			$headers = 'From: ' . $name . ' <' . $emailTo . '>' . "\r\n" . 'Reply-To: ' . $email;
			wp_mail( $emailTo, $subject, $body, $headers );
			$emailSent = true;
		}
	}
	$output = '';
	$contactName = '';
	$contactEmail = '';
	$commentsText = '';
	$output .= '<h3 class="contact_form_header">' . __('Send Us A Message Here', 'allaround') . '</h3>';
	if( isset( $emailSent ) && $emailSent == true ) {
		$output .= do_shortcode('[aa_greenbox]'. __( 'Thanks, your email was sent successfully!', 'allaround' ) . '[/aa_greenbox]');
	}
	else {
		if( isset( $hasError ) || isset( $captchaError ) ) {
			$output .= do_shortcode('[aa_redbox]'. __( 'Sorry, an error occured', 'allaround' ) . '[/aa_redbox]');
		}
		$permlink = get_permalink();
		$output .= '<form action="'. $permlink .'" class="contactForm" method="post"><div class="input_column_wrapper">';
		
		$output .= '<div class="input_wrapper"><span class="input_title">'. __( 'Send To', 'allaround' ) .'</span><select name="contactEmailSend" class="input_field" >';
		if ( $allaround_data['contact'] ) :
			$i = 1;
			$users_array = explode( ',', $users );
			if ( !is_array ( $users_array ) ) { $users_array[] = $users; }			
			foreach ( $contact_options as $option ) {
				if ( in_array ( $i, $users_array ) ) { $output .= '<option value="'. $i .'">'. $option['name'] .'</option>'; }
				$i++;
			}
		endif;
		$output .= '</select><div class="clear"></div><!-- clear --></div><!-- input_wrapper -->';
		
		$output .= '<div class="input_wrapper"><span class="input_title">'. __( 'Name', 'allaround' ) .'</span>';
		if ( isset( $_POST['contactName'] ) ) $contactName = $_POST['contactName'];
		$output .= '<input type="text" name="contactName" value="'. $contactName .'" class="input_field" placeholder="' . __('Enter your name...', 'allaround') . '"/>';
		if( isset( $nameError ) ) {
			$output .= '<span class="error">'. $nameError .'</span>';
		}
		$output .= '<div class="clear"></div><!-- clear --></div><!-- input_wrapper -->';		
		
		$output .= '<div class="input_wrapper"><span class="input_title">'. __( 'Email', 'allaround' ) .'</span>';
		if ( isset( $_POST['contactEmail'] ) )  $contactEmail = $_POST['contactEmail'];
		$output .= '<input type="text" name="contactEmail" value="'. $contactEmail .'" class="input_field" placeholder="' . __('Enter your e-mail...', 'allaround') . '"/>';
		if( isset( $emailError ) ) {
			$output .= '<span class="error">'. $emailError .'</span>';
		}
		$output .= '<div class="clear"></div><!-- clear --></div><!-- input_wrapper --></div><!-- input_column_wrapper -->';
		
		$output .= '<div class="textarea_wrapper"><span class="textarea_title">'. __('Message', 'allaround') .'</span>';
		if( isset( $_POST['commentsText'] ) ) { if ( function_exists( 'stripslashes' ) ) { $commentsText = stripslashes( $_POST['commentsText'] ); } else { $commentsText = $_POST['commentsText']; } }
		$output .= '<textarea name="commentsText" class="textarea_field">'. $commentsText .'</textarea>';
		if( isset( $commentError ) ) {
			$output .= '<p class="error">'. $commentError .'</p>';
		}
		$output .= '</div><!-- textarea_wrapper --><div class="clear"></div><!-- clear -->';
		
		$output .= '<input type="hidden" name="submitted-'. $allaround_contact_form_id .'" value="true" /><input class="submit_button button_hover_effect" type="submit" value="'.__('Send Email', 'allaround').'" />';

		$output .= '</form>';
	}
	$allaround_contact_form_id++;	
	return $output;		
}

// Contacts
function allaround_contacts( $users = '1' ) {
	global $allaround_data;
	if ( is_array( $allaround_data['contact'] ) ) $contacts = $allaround_data['contact']; else return;
	$users_array = explode( ',', $users );
	if ( !is_array ( $users_array ) ) { $users_array[] = $users; }

	$counter = 0;
	$counter_clear = 0;
	$out = '';
	foreach ( $contacts as $contact ) {
		$counter++;
		$contact_networks = $contact['contact'];
		if ( in_array ( $counter, $users_array ) ) {
			$counter_clear++;
			$contact_name = $contact['name'];
			$contact_description = $contact['description'];
			$contact_url = $contact['url'];
			$contact_job = $contact['job'];
			if ( $counter_clear == 3 ) { $class_add = 'column-last'; } else { $class_add = ''; }
		 	$out .= "<div class='column-1-3 column120 margin-bottom48 our_team {$class_add}'>";
			$out .= "<div class='image_wrapper'><img src='{$contact_url}' alt='image' class='content_image' /><div class='image_wrapper_arrow'></div><!-- image_wrapper_arrow -->";
			$out .= "<div class='image_socials'>";
			foreach ( $contact_networks as $contact_network ) {
				$out .= '<a href="'. $contact_network['socialnetworksurl'] .'" ><span><img width="32px" height="32px" src="' . get_bloginfo ( 'template_directory' ) . '/images/socialnetworks/' . $contact_network['socialnetworks'] . '" /></span></a>';
			}
			$out .= '</div>';
			$out .= "<div class='image_more_info'><a href='{$contact_url}' rel='prettyPhoto'><img src='" . get_template_directory_uri() . "/images/home/more.png' class='customColorBg' alt='' /></a></div><!-- image_more_info --></div><!-- image_wrapper --><h3 class='no-margin-bottom'>{$contact_name}</h3><span class='our_team_sub_header'>{$contact_job}</span><div class='separator2'></div><!-- separator2 --><span class='margin-top10 margin-bottom10'>{$contact_description}</span><div class='separator2'></div><!-- separator2 --><div class='clear'></div><!--clear --></div><!-- column-1-3 -->";
			if ( $counter_clear == 3 ) { $out .= '<div class="clear"></div>'; $counter_clear = 0; }
		}
	}
	return $out;
}

// Twitted Feed
function allaround_twitter_feed($user = 'twitter', $count = '5'){
    $i = 1;
    $transient_key = $user . "_twitter_" . $count;
    $cached = get_transient( $transient_key );
	
    if ( false !== $cached ) {
    	return $cached .= "\n" . '<!-- Returned from cache -->';
    }
	$twitteruser = $user;
	$notweets = $count;
	$consumerkey = "AGe8ghUGGXL4YJJiFSs5g";
	$consumersecret = "SRmMGR0H1cVmN9pLamvswQw5tD8d18cm2Eai27vRNo";
	$accesstoken = "966576138-VU8cxTPMk128tMAcp7neZZ4Hds45OS9Ty1MwSZIV";
	$accesstokensecret = "OoW3Gj9jN7y2cJpQgECLzbPy4V1coMI6JUVs7uRV7Qg";
	 
	function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
	  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
	  return $connection;
	}
	$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
	$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);
    $data = json_decode( json_encode($tweets) );
    $output = '<div class="twitter">';
	if ( is_array( $data ) ) :
	while ( $i <= $count ) {
        if( isset( $data[$i-1] ) ) {
        	$feed = $data[( $i - 1 )]->text;
        	$feed = str_pad( $feed, 3, ' ', STR_PAD_LEFT );
        	$startat = stripos( $feed, '@' );
        	$numat = substr_count( $feed, '@' );
       		$numhash = substr_count( $feed, '#' );
      		$numhttp = substr_count( $feed, 'http' );
  			$feed = preg_replace( "#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $feed );
     		$feed = preg_replace( "#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $feed );
        	$feed = preg_replace( "/@(\w+)/", "<a href=\"http://www.twitter.com/\\1\" target=\"_blank\">@\\1</a>", $feed );
            $feed = preg_replace( "/#(\w+)/", "<a href=\"http://search.twitter.com/search?q=\\1\" target=\"_blank\">#\\1</a>", $feed );
          	$output .= "<div class=\"inner_wrap\"><img src=\"" . get_template_directory_uri() ."/images/twitter_banner.png\" alt=\"twitter_image\" /><div class=\"text_wrap\"><div class=\"twitter_link\"><a href=\"http://www.twitter.com/{$user}\">@{$user}</a> - " . allaround_time_ago( strtotime( $data[($i-1)]->created_at ) ) . "</div><!-- twitter_link --><div class=\"twitt\">{$feed}</div><!-- twitt --></div><!-- text_wrap --><div class=\"clear\"></div></div><!-- inner_wrap -->";
        }
        $i++;
    }
	$output .= '</div>';
    set_transient( $transient_key, $output, 3600 );
	set_transient( $transient_key.'_backup', $output );
    return $output;
	else :
    $cached = get_transient( $transient_key.'_backup' );
    if ( false !== $cached ) {
    	return $cached .= "\n" . '<!-- Returned from backup cache -->';
    }
	else {
		return 'Twitter unaviable';	
	}
	endif;
}

// Add menu class
function menu_set_dropdown( $sorted_menu_items, $args ) {
    $last_top = 0;
    foreach ( $sorted_menu_items as $key => $obj ) {
        // it is a top lv item?
        if ( 0 == $obj->menu_item_parent ) {
            // set the key of the parent
            $last_top = $key;
        } else {
            $sorted_menu_items[$last_top]->classes['dropdown'] = 'dropdown';
        }
    }
    return $sorted_menu_items;
}
add_filter( 'wp_nav_menu_objects', 'menu_set_dropdown', 10, 2 );

// Adjust Brightness
function allaround_adjust_brightness($hex, $steps) {
    $steps = max(-255, min(255, $steps));

    $hex = str_replace('#', '', $hex);
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
    }

    $r = hexdec(substr($hex,0,2));
    $g = hexdec(substr($hex,2,2));
    $b = hexdec(substr($hex,4,2));

    $r = max(0,min(255,$r + $steps));
    $g = max(0,min(255,$g + $steps));  
    $b = max(0,min(255,$b + $steps));

    $r_hex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
    $g_hex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
    $b_hex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);

    return '#'.$r_hex.$g_hex.$b_hex;
}

// IMAGE REPLACE COLOR
function allaround_con_replace_color() {
	
	header('Content-Type: image/png');
	
	$imgpath = $_GET['imgpath'];
	$imgcolor = $_GET['imgcolor'];
	
	$red = substr($imgcolor,0,2);
	$red = hexdec($red);
	$green = substr($imgcolor,2,2);
	$green = hexdec($green);
	$blue = substr($imgcolor,4,2);
	$blue = hexdec($blue);
		
	
	$im = imagecreatefrompng ($imgpath);
	
	imagealphablending($im, false);
	for ($x = imagesx($im); $x--;) {
	    for ($y = imagesy($im); $y--;) {
	        $rgb = imagecolorat($im, $x, $y);
	        $c = imagecolorsforindex($im, $rgb);
	        if ($c['red'] > 40 && $c['green'] > 40 && $c['blue'] > 40) { // dark colors
	            // here we use the new color, but the original alpha channel
	            $colorB = imagecolorallocatealpha($im, $red, $green, $blue, $c['alpha']);
	            imagesetpixel($im, $x, $y, $colorB);
	        }
	    }
	}
	imageAlphaBlending($im, true);
	imageSaveAlpha($im, true);		
	imagepng($im); // echo png image
	imagedestroy($im);
	
	die();
}
add_action('wp_ajax_con_replace_color', 'allaround_con_replace_color');
add_action('wp_ajax_nopriv_con_replace_color', 'allaround_con_replace_color');


// get_between. string function
function allaround_get_between($content,$start,$end){
	$r = explode($start, $content);
	if (isset($r[1])){
		$r = explode($end, $r[1]);
		return $r[0];
	}
return '';
}

// Gravatar Filter
add_filter('get_avatar','allaround_change_avatar_css');

function allaround_change_avatar_css($class) {
$class = str_replace("class='avatar", "class='avatar content_image ", $class) ;
return $class;
}

/**
 * is_edit_page 
 * function to check if the current page is a post edit page
 * 
 * @author Ohad Raz <admin@bainternet.info>
 * 
 * @param  string  $new_edit what page to check for accepts new - new post page ,edit - edit post page, null for either
 * @return boolean
 */
function is_edit_page($new_edit = null){
    global $pagenow;
    //make sure we are on the backend
    if (!is_admin()) return false;


    if($new_edit == "edit")
        return in_array( $pagenow, array( 'post.php',  ) );
    elseif($new_edit == "new") //check for new post page
        return in_array( $pagenow, array( 'post-new.php' ) );
    else //check for either new or edit
        return in_array( $pagenow, array( 'post.php', 'post-new.php' ) );
}

// Template for comments and pingbacks
if ( !function_exists( 'allaround_comment' ) ) :
function allaround_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
	
		case '' : ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	<div id="comment-<?php comment_ID(); ?>">
	<div class="comment_image_wrapper">
		<div class="img_border"><?php echo get_avatar( $comment, 80 ); ?></div><!-- img_border -->
		<div class="joined_date">
			<?php _e('Joined', 'allaround'); ?>:<div><?php the_author_meta( 'user_registered' ); ?></div>
			</div><!-- joined_date -->
	</div><!-- comment_image_wrapper -->
	<div class="comment_text_wrapper">
	<div class="author"><?php printf( __( '%s', 'allaround' ), sprintf( '%s', get_comment_author_link() ) ); ?></div>
		<div class="date"><?php printf( __( '%1$s', 'allaround' ), get_comment_date() ); ?></div>
		<div class="rank"><?php the_author_meta( 'nickname' ); ?></div>
		<span class="text">
		<?php
			comment_text();
			if ( $comment->comment_approved == '0' ) :
		?>
		<p class="moderation">
			<?php _e( 'Your comment is awaiting moderation.', 'allaround' ); ?>
		</p>
		<?php endif; ?>
		</span>
		<?php 
			comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
			edit_comment_link( __( 'Edit &rarr;', 'allaround' ), ' ' );
		?>
		</div><!-- comment_text_wrapper -->
		<div class="clear"></div><!-- clear -->
		</div>
	<?php
		break;
		case 'pingback'  :
	?>
<li class="post pingback">
	<p>
	<?php 
		_e( 'Pingback:', 'allaround' );
		comment_author_link();
		edit_comment_link( __('(Edit)', 'allaround'), ' ' );
	?>
	</p>    <?php
		break;
		case 'trackback' :
	?>
<li class="post pingback">
	<p>
	<?php 
		_e( 'Pingback:', 'allaround' );
		comment_author_link();
		edit_comment_link( __('(Edit)', 'allaround'), ' ' );
	?>
	</p>
	<?php
		break;
		endswitch;
	}
	endif;
?>