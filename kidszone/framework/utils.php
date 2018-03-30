<?php
/** dt_theme_public_title()
 * Objective:
 *		Outputs the value for <title></title> in front end.
 *
 **/
function dt_theme_public_title() {
	
	$status = dt_theme_is_plugin_active('all-in-one-seo-pack/all_in_one_seo_pack.php') || dt_theme_is_plugin_active('wordpress-seo/wp-seo.php');
	
	if (!$status) :
		#CODE STARTS
		global $post;
		$doctitle = '';
		$separator = dt_theme_option ( 'seo', 'title-delimiter' );
		$split = true;
		
		if (! empty ( $post )) :
			$author_meta = get_the_author_meta ( $post->post_author );
			$nickname = get_the_author_meta ( 'nickname', $post->post_author );
			$first_name = get_the_author_meta ( 'first_name', $post->post_author );
			$last_name = get_the_author_meta ( 'last_name', $post->post_author );
			$display_name = get_the_author_meta ( 'display_name', $post->post_author );
		
		endif;
		
		$args = array (
				"blog_title" => preg_replace ( "~(?:\[/?)[^/\]]+/?\]~s", '', get_option ( 'blogname' ) ),
				"blog_description" => get_bloginfo ( 'description' ),
				"post_title" => ! empty ( $post ) ? $post->post_title : NULL,
				"post_author_nicename" => ! empty ( $nickname ) ? ucwords ( $nickname ) : NULL,
				"post_author_firstname" => ! empty ( $first_name ) ? ucwords ( $first_name ) : NULL,
				"post_author_lastname" => ! empty ( $last_name ) ? ucwords ( $last_name ) : NULL,
				"post_author_dsiplay" => ! empty ( $display_name ) ? ucwords ( $display_name ) : NULL 
		);
		$args = array_filter ( $args );
		// ome
		if (is_home () || is_front_page ()) :
			$doctitle = "";
			if ((get_option ( 'page_on_front' ) != 0) && (get_option ( 'page_on_front' ) == $post->ID))
				$doctitle = trim ( get_post_meta ( $post->ID, '_seo_title', true ) );
			$doctitle = ! empty ( $doctitle ) ? trim ( $doctitle ) : $args ["blog_title"] . ' ' . $separator . ' ' . $args ["blog_description"];
			$split = false;
			
	
		// age
		elseif (is_page ()) :
			$doctitle = get_post_meta ( $post->ID, '_seo_title', true );
			if (empty ( $doctitle )) :
				$options = is_array ( dt_theme_option ( 'seo', 'page-title-format' ) ) ? dt_theme_option ( 'seo', 'page-title-format' ) : array ();
				foreach ( $options as $option ) :
					if (array_key_exists ( $option, $args ))
						$doctitle .= $args [$option] . ' ' . $separator . ' ';
				endforeach
				;
			
					endif;
			// ost
		elseif (is_single ()) :
			$doctitle = get_post_meta ( $post->ID, '_seo_title', true );
			if (empty ( $doctitle )) :
				// o add categories in $args
				$categories = get_the_category ();
				$c = '';
				foreach ( $categories as $category ) :
					$c .= $category->name . ' ' . $separator . ' ';
				endforeach
				;
				$c = substr ( trim ( $c ), "0", strlen ( trim ( $c ) ) - 1 );
				$args ["category_title"] = $c;
				// nd of adding categories in $args
				
				// o add tags in $args
				$posttags = get_the_tags ();
				$ptags = '';
				if ($posttags) :
					foreach ( $posttags as $posttag ) :
						$ptags .= $posttag->name . $separator;
					endforeach
					;
					$ptags = substr ( trim ( $ptags ), "0", strlen ( trim ( $ptags ) ) - 1 );
					$args ["tag_title"] = $ptags;
				
				endif;
				// nd of adding tags in $args
				$options = is_array ( dt_theme_option ( 'seo', 'post-title-format' ) ) ? dt_theme_option ( 'seo', 'post-title-format' ) : array ();
				foreach ( $options as $option ) :
					if (array_key_exists ( $option, $args )) :
						$doctitle .= $args [$option] . ' ' . $separator . ' ';
					
						endif;
				endforeach
				;
			
						endif;
			// s_category()
		elseif (is_category ()) :
			$categories = get_the_category ();
			// o add category description into $args
			$args ["category_title"] = $categories [0]->name;
			$args ["category_desc"] = $categories [0]->description;
			// nd of adding category description into $args
			
			$options = is_array ( dt_theme_option ( 'seo', 'category-page-title-format' ) ) ? dt_theme_option ( 'seo', 'category-page-title-format' ) : array ();
			foreach ( $options as $option ) :
				if (array_key_exists ( $option, $args ))
					$doctitle .= $args [$option] . ' ' . $separator . ' ';
			endforeach
			;
			// s_tag()
		elseif (is_tag ()) :
			$args ["tag"] = wp_title ( "", false );
			$options = is_array ( dt_theme_option ( 'seo', 'tag-page-title-format' ) ) ? dt_theme_option ( 'seo', 'tag-page-title-format' ) : array ();
			foreach ( $options as $option ) :
				if (array_key_exists ( $option, $args ))
					$doctitle .= $args [$option] . ' ' . $separator . ' ';
			endforeach
			;
			
	
		// s_archive()
		elseif (is_archive ()) :
			$args ["date"] = wp_title ( "", false );
			$options = is_array ( dt_theme_option ( 'seo', 'archive-page-title-format' ) ) ? dt_theme_option ( 'seo', 'archive-page-title-format' ) : array ();
			foreach ( $options as $option ) :
				if (array_key_exists ( $option, $args ))
					$doctitle .= $args [$option] . ' ' . $separator . ' ';
			endforeach;
		// s_date()
		elseif (is_date ()) :
	
		// s_search()
		elseif (is_search ()) :
			$args ["search"] = __ ( "Search results for", 'iamd_text_domain' ) . ' "' . $_REQUEST ['s'] . '"'; // dding search text into the default args
			$options = is_array ( dt_theme_option ( 'seo', 'search-page-title-format' ) ) ? dt_theme_option ( 'seo', 'search-page-title-format' ) : array ();
			foreach ( $options as $option ) :
				if (array_key_exists ( $option, $args ))
					$doctitle .= $args [$option] . ' ' . $separator . ' ';
			endforeach;
			// s_404()
		elseif (is_404 ()) :
			$options = is_array ( dt_theme_option ( 'seo', '404-page-title-format' ) ) ? dt_theme_option ( 'seo', '404-page-title-format' ) : array ();
			foreach ( $options as $option ) :
				if (array_key_exists ( $option, $args ))
					$doctitle .= $args [$option] . ' ' . $separator . ' ';
			endforeach;
			$doctitle = $doctitle . __ ( 'Page not found', 'iamd_text_domain' );
			$split = false;
		endif;
		
		if ($split) :
			if (strrpos ( $doctitle, $separator )) :
				$doctitle = str_split ( $doctitle, strrpos ( $doctitle, $separator ) );
				$doctitle = $doctitle [0];
					endif;
					endif;
		echo $doctitle;
	else :
		wp_title("|", true);
	endif;
}

/**
 * dt_theme_canonical()
 * Objective:
 * Generate the Canonical url
 * This function called at register_public.php via dt_theme_seo_meta();
 */
function dt_theme_canonical() {
	$canonical = false;
	if (is_singular () || is_single ()) :
		$canonical = get_permalink ( get_queried_object () );
		
		// Fix paginated pages
		if (get_query_var ( 'paged' ) > 1) :
			global $wp_rewrite;
			if (! $wp_rewrite->using_permalinks ()) :
				$canonical = add_query_arg ( 'paged', get_query_var ( 'paged' ), $canonical );
			 else :
				$canonical = user_trailingslashit ( trailingslashit ( $canonical ) . 'page/' . get_query_var ( 'paged' ) );
			endif;
		
	endif;
	 else :
		if (is_front_page ()) :
			$canonical = home_url ( '/' );
		 elseif (is_home () && "page" == get_option ( 'show_on_front' )) :
			$canonical = get_permalink ( get_option ( 'page_for_posts' ) );
		 elseif (is_tax () || is_tag () || is_category ()) :
			$term = get_queried_object ();
			$canonical = get_term_link ( $term, $term->taxonomy );
		 elseif (function_exists ( 'get_post_type_archive_link' ) && is_post_type_archive ()) :
			$canonical = get_post_type_archive_link ( get_post_type () );
		 elseif (is_author ()) :
			$canonical = get_author_posts_url ( get_query_var ( 'author' ), get_query_var ( 'author_name' ) );
		 elseif (is_archive ()) :
			if (is_date ()) :
				if (is_day ()) :
					$canonical = get_day_link ( get_query_var ( 'year' ), get_query_var ( 'monthnum' ), get_query_var ( 'day' ) );
				 elseif (is_month ()) :
					$canonical = get_month_link ( get_query_var ( 'year' ), get_query_var ( 'monthnum' ) );
				 elseif (is_year ()) :
					$canonical = get_year_link ( get_query_var ( 'year' ) );
				endif;
			endif;
		endif;
		
		if ($canonical && get_query_var ( 'paged' ) > 1) :
			global $wp_rewrite;
			if (! $wp_rewrite->using_permalinks ())
				$canonical = add_query_arg ( 'paged', get_query_var ( 'paged' ), $canonical );
			else
				$canonical = user_trailingslashit ( trailingslashit ( $canonical ) . trailingslashit ( $wp_rewrite->pagination_base ) . get_query_var ( 'paged' ) );
		
		
		endif;
	endif;
	return $canonical;
}
// # --- **** dt_theme_canonical() *** --- ###

/**
 * show_fblike()
 * Objective:
 * Outputs the facebook like button in post and page.
 */
function show_fblike($arg = 'post') {
	$fb = dt_theme_option ( 'integration', "{$arg}-fb_like" );
	$output = "";
	if (! empty ( $fb )) :
		$layout = dt_theme_option ( 'integration', "{$arg}-fb_like-layout" );
		$scheme = dt_theme_option ( 'integration', "{$arg}-fb_like-color-scheme" );
		$output .= do_shortcode ( "[fblike layout='{$layout}' colorscheme='{$scheme}' /]" );
		echo $output;
	endif;
}
// # --- **** show_googleplus() *** --- ###
/**
 * show_googleplus()
 * Objective:
 * Outputs the facebook like button in post and page.
 */
function show_googleplus($arg = 'post') {
	$googleplus = dt_theme_option ( 'integration', "{$arg}-googleplus" );
	$output = "";
	if (! empty ( $googleplus )) :
		$layout = dt_theme_option ( 'integration', "{$arg}-googleplus-layout" );
		$lang = dt_theme_option ( 'integration', "{$arg}-googleplus-lang" );
		$output .= do_shortcode ( "[googleplusone size='{$layout}' lang='{$lang}' /]" );
		echo $output;
	endif;
}
// # --- **** show_googleplus() *** --- ###

// # --- **** show_twitter() *** --- ###
/**
 * show_twitter()
 * Objective:
 * Outputs the Twitter like button in post and page.
 */
function show_twitter($arg = 'post') {
	$twitter = dt_theme_option ( 'integration', "{$arg}-twitter" );
	$output = "";
	if (! empty ( $twitter )) :
		$layout = dt_theme_option ( 'integration', "{$arg}-twitter-layout" );
		$lang = dt_theme_option ( 'integration', "{$arg}-twitter-lang" );
		$username = dt_theme_option ( 'integration', "{$arg}-twitter-username" );
		$output .= do_shortcode ( "[twitter layout='{$layout}' lang='{$lang}' username='{$username}' /]" );
		echo $output;
	endif;
}
// # --- **** show_twitter() *** --- ###

// # --- **** show_stumbleupon() *** --- ###
/**
 * show_stumbleupon()
 * Objective:
 * Outputs the Stumbleupon like button in post and page.
 */
function show_stumbleupon($arg = 'post') {
	$stumbleupon = dt_theme_option ( 'integration', "{$arg}-stumbleupon" );
	$output = "";
	if (! empty ( $stumbleupon )) :
		$layout = dt_theme_option ( 'integration', "{$arg}-stumbleupon-layout" );
		$output .= do_shortcode ( "[stumbleupon layout='{$layout}' /]" );
		echo $output;
	endif;
}
// # --- **** show_stumbleupon() *** --- ###

// # --- **** show_linkedin() *** --- ###
/**
 * show_linkedin()
 * Objective:
 * Outputs the LinkedIn like button in post and page.
 */
function show_linkedin($arg = 'post') {
	$linkedin = dt_theme_option ( 'integration', "{$arg}-linkedin" );
	$output = "";
	if (! empty ( $linkedin )) :
		$layout = dt_theme_option ( 'integration', "{$arg}-linkedin-layout" );
		$output .= do_shortcode ( "[linkedin layout='{$layout}' /]" );
		echo $output;
	endif;
}
// # --- **** show_linkedin() *** --- ###

// # --- **** show_delicious() *** --- ###
/**
 * show_delicious()
 * Objective:
 * Outputs the Delicious like button in post and page.
 */
function show_delicious($arg = 'post') {
	$delicious = dt_theme_option ( 'integration', "{$arg}-delicious" );
	$output = "";
	if (! empty ( $delicious )) :
		$text = dt_theme_option ( 'integration', "{$arg}-delicious-text" );
		$output .= do_shortcode ( "[delicious text='{$text}' /]" );
		echo $output;
	endif;
}
// # --- **** show_delicious() *** --- ###

// # --- **** show_pintrest() *** --- ###
/**
 * show_pintrest()
 * Objective:
 * Outputs the Pintrest like button in post and page.
 */
function show_pintrest($arg = 'post') {
	$delicious = dt_theme_option ( 'integration', "{$arg}-pintrest" );
	$output = "";
	if (! empty ( $delicious )) :
		$layout = dt_theme_option ( 'integration', "{$arg}-pintrest-layout" );
		$output .= do_shortcode ( "[pintrest layout='{$layout}' prompt='true' /]" );
		echo $output;
	endif;
}
// # --- **** show_pintrest() *** --- ###

// # --- **** show_digg() *** --- ###
/**
 * show_digg()
 * Objective:
 * Outputs the Digg like button in post and page.
 */
function show_digg($arg = 'post') {
	$digg = dt_theme_option ( 'integration', "{$arg}-digg" );
	$output = "";
	if (! empty ( $digg )) :
		$layout = dt_theme_option ( 'integration', "{$arg}-digg-layout" );
		$output .= do_shortcode ( "[digg layout='{$layout}' /]" );
		echo $output;
	endif;
}
// # --- **** show_digg() *** --- ###

/**
 * dt_theme_footer_widgetarea()
 * Objective:
 * 1.
 * To Generate Footer Widget Areas
 * Args: $count = No of widget areas
 */
function dt_theme_footer_widgetarea($count) {
	$name = __ ( "Footer Column", 'iamd_text_domain' );
	if ($count <= 4) :
		for($i = 1; $i <= $count; $i ++) :
			register_sidebar ( array (
					'name' => $name . "-{$i}",
					'id' => "footer-sidebar-{$i}",
					'description' => 'Appears in the footer section of the site.',
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget' => '</aside>',
					'before_title' => '<h3 class="widgettitle">',
					'after_title' => '<span></span></h3>' 
			) );
		endfor
		;
	 elseif ($count == 5 || $count == 6) :
		$a = array (
				"1-4",
				"1-4",
				"1-2" 
		);
		$a = ($count == 5) ? $a : array_reverse ( $a );
		foreach ( $a as $k => $v ) :
			register_sidebar ( array (
					'name' => $name . "-{$v}",
					'id' => "footer-sidebar-{$k}-{$v}",
					'description' => 'Appears in the footer section of the site.',
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget' => '</aside>',
					'before_title' => '<h3 class="widgettitle">',
					'after_title' => '<span></span></h3>'
			) );
		endforeach
		;
	 elseif ($count == 7 || $count == 8) :
		$a = array (
				"1-4",
				"3-4" 
		);
		$a = ($count == 7) ? $a : array_reverse ( $a );
		foreach ( $a as $k => $v ) :
			register_sidebar ( array (
					'name' => $name . "-{$v}",
					'id' => "footer-sidebar-{$k}-{$v}",
					'description' => 'Appears in the footer section of the site.',
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget' => '</aside>',
					'before_title' => '<h3 class="widgettitle">',
					'after_title' => '<span></span></h3>'
			) );
		endforeach
		;
	 elseif ($count == 9 || $count == 10) :
		$a = array (
				"1-3",
				"2-3" 
		);
		$a = ($count == 9) ? $a : array_reverse ( $a );
		foreach ( $a as $k => $v ) :
			register_sidebar ( array (
					'name' => $name . "-{$v}",
					'id' => "footer-sidebar-{$k}-{$v}",
					'description' => 'Appears in the footer section of the site.',
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget' => '</aside>',
					'before_title' => '<h3 class="widgettitle">',
					'after_title' => '<span></span></h3>'
			) );
		endforeach
		;
	endif;
}
// # --- **** dt_theme_footer_widgetarea() *** --- ###

// # --- **** dt_theme_show_footer_widgetarea() *** --- ###
/**
 * dt_theme_show_footer_widgetarea()
 * Objective:
 * Outputs the Footer section widget area.
 */
function dt_theme_show_footer_widgetarea($count) {
	$classes = array (
			"1" => "dt-sc-one-column",
			"dt-sc-one-half",
			"dt-sc-one-third",
			"dt-sc-one-fourth",
			"1-2" => "dt-sc-one-half",
			"1-3" => "dt-sc-one-third",
			"1-4" => "dt-sc-one-fourth",
			"3-4" => "dt-sc-three-fourth",
			"2-3" => "dt-sc-two-third" 
	);
	
	if ($count <= 4) :
		for($i = 1; $i <= $count; $i ++) :
			$class = $classes [$count];
			$first = ($i == 1) ? "first" : "";
			echo "<div class='column {$class} {$first}'>";
			if (function_exists ( 'dynamic_sidebar' ) && dynamic_sidebar ( "footer-sidebar-{$i}" )) : endif;
			echo "</div>";
		endfor;
	 elseif ($count == 5 || $count == 6) :
		$a = array (
				"1-4",
				"1-4",
				"1-2" 
		);
		$a = ($count == 5) ? $a : array_reverse ( $a );
		foreach ( $a as $k => $v ) :
			$class = $classes [$v];
			$first = ($k == 0) ? "first" : "";
			echo "<div class='column {$class} {$first}'>";
			if (function_exists ( 'dynamic_sidebar' ) && dynamic_sidebar ( "footer-sidebar-{$k}-{$v}" )) : endif;
			echo "</div>";
		endforeach;
	 

	elseif ($count == 7 || $count == 8) :
		$a = array (
				"1-4",
				"3-4" 
		);
		
		$a = ($count == 7) ? $a : array_reverse ( $a );
		foreach ( $a as $k => $v ) :
			$class = $classes [$v];
			$first = ($k == 0) ? "first" : "";
			echo "<div class='column {$class} {$first}'>";
			if (function_exists ( 'dynamic_sidebar' ) && dynamic_sidebar ( "footer-sidebar-{$k}-{$v}" )) :endif;
			echo "</div>";
		endforeach;
		
	 elseif ($count == 9 || $count == 10) :
		$a = array (
				"1-3",
				"2-3" 
		);
		$a = ($count == 9) ? $a : array_reverse ( $a );
		foreach ( $a as $k => $v ) :
			$class = $classes [$v];
			$first = ($k == 0) ? "first" : "";
			echo "<div class='column {$class} {$first}'>";
			if (function_exists ( 'dynamic_sidebar' ) && dynamic_sidebar ( "footer-sidebar-{$k}-{$v}" )) :endif;
			echo "</div>";
		endforeach;
	endif;
}
// # --- **** dt_theme_show_footer_widgetarea() *** --- ###

// # --- **** dt_theme_is_plugin_active() *** --- ###
/**
 * dt_theme_is_plugin_active()
 * Objective:
 * Check the plugin is activated
 */
function dt_theme_is_plugin_active($plugin) {
	if (is_multisite ()) :
		$plugins = array ();
		$c_plugins = is_array ( get_site_option ( 'active_sitewide_plugins' ) ) ? get_site_option ( 'active_sitewide_plugins' ) : array ();
		foreach ( array_keys ( $c_plugins ) as $c_plugin ) :
			$plugins [] = $c_plugin;
		endforeach;
		return in_array ( $plugin, $plugins );
	 else :
		return in_array ( $plugin, ( array ) get_option ( 'active_plugins', array () ) );
	endif;
}
// # --- **** dt_theme_is_plugin_active() *** --- ###

// # --- **** check_slider_revolution_responsive_wordpress_plugin() *** --- ###
/**
 * check_slider_revolution_responsive_wordpress_plugin()
 * Objective:
 * Check the "Revolution Responsive WordPress Plugin" is activated
 */
function check_slider_revolution_responsive_wordpress_plugin() {
	$sliders = false;
	if (dt_theme_is_plugin_active ( 'revslider/revslider.php' )) :
		global $wpdb;
		// table_prefix = WP_ALLOW_MULTISITE ? $wpdb->base_prefix : $wpdb->prefix;
		$table_prefix = $wpdb->prefix;
		$table_name = $table_prefix . "revslider_sliders";
		
		if ($wpdb->get_var ( "SHOW TABLES LIKE '$table_name'" ) == $table_name) :
			$resultset = $wpdb->get_results ( "SELECT title,alias FROM $table_name" );
			foreach ( $resultset as $rs ) :
				$sliders [$rs->alias] = $rs->title;
			endforeach;
			return $sliders;
		 else :
			return $sliders;
		endif;
	 else :
		return $sliders;
	endif;
}
// # --- **** dt_theme_is_plugin_active() *** --- ###

// # --- **** dt_theme_social_bookmarks() *** --- ###
/**
 * dt_theme_social_bookmarks()
 * Objective:
 * To show social shares
 */
function dt_theme_social_bookmarks($arg = 'sb-post') {
	global $post;
	
	$title = $post->post_title;
	$url = get_permalink ( $post->ID );
	$excerpt = $post->post_excerpt;
	$data = "";
	
	$fb = dt_theme_option ( 'integration', "{$arg}-fb_like" );
	$data .= ! empty ( $fb ) ? "<li><a href='http".dt_theme_ssl()."://www.facebook.com/sharer.php?u=$url&amp;t=" . urlencode ( $title ) . "' class='fa fa-facebook'></a></li>" : "";
	
	$twitter = dt_theme_option ( 'integration', "{$arg}-twitter" );
	$t_url = ! empty ( $twitter ) ? $url : '';
	$data .= ! empty ( $twitter ) ? "<li><a href='http".dt_theme_ssl()."://twitter.com/home/?status=" . urlencode ( $title ) . ":$t_url' class='fa fa-twitter'></a></li>" : "";
	
	$googleplus = dt_theme_option ( 'integration', "{$arg}-googleplus" );
	$data .= ! empty ( $googleplus ) ? "<li><a href=\"https://plus.google.com/share?url=$url\"  onclick=\"javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;\" class='fa fa-google-plus'></a></li>" : '';
	
	$linkedin = dt_theme_option ( 'integration', "{$arg}-linkedin" );
	$data .= ! empty ( $linkedin ) ? "<li><a href='http".dt_theme_ssl()."://www.linkedin.com/shareArticle?mini=true&amp;title=".urlencode($title)."&amp;url=$url' title='Share On LinkedIn' class='fa fa-linkedin'></a></li>" : "";
	
	$pintrest = dt_theme_option ( 'integration', "{$arg}-pintrest" );
	$media = wp_get_attachment_url ( get_post_thumbnail_id ( $post->ID ) );
	$data .= ! empty ( $pintrest ) ? "<li><a href='http".dt_theme_ssl()."://pinterest.com/pin/create/button/?url=" . urlencode ( $url ) . "&amp;media=$media' class='fa fa-pinterest'></a></li>" : "";
	
	$data = ! empty ( $data ) ? "<ul class='social-media'>{$data}</ul>" : "";
	echo $data;
}
// # --- **** dt_theme_social_bookmarks() *** --- ###

// # --- **** is_dt_theme_moible_view() *** --- ###
/**
 * dt_is_moible_view()
 * Objective:
 * If you eanble responsive mode in theme , this will add view port at the head
 */
function is_dt_theme_moible_view(){
	$dt_theme_options = get_option(IAMD_THEME_SETTINGS);
	$dt_theme_mobile = !empty($dt_theme_options['mobile']) ? $dt_theme_options['mobile'] : "";
	if(isset($dt_theme_mobile['is-theme-responsive']))
		echo "<meta name='viewport' content='width=device-width, initial-scale=1' />\r";
}
// # --- **** is_dt_theme_moible_view() *** --- ###

// load basic css : default,shortcode & skin css
function dt_theme_front_css() {
	
	$dt_theme_options = get_option(IAMD_THEME_SETTINGS);
	$dt_theme_general = $dt_theme_options ['general'];
	$template_uri = get_template_directory_uri();

	if( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ):
		if (isset ( $dt_theme_general ['enable-favicon'] )) :
			$url = ! empty ( $dt_theme_general ['favicon-url'] ) ? $dt_theme_general ['favicon-url'] : $template_uri . "/images/favicon.png";
			echo "<link href='$url' rel='shortcut icon' type='image/x-icon' />\n";
	
			$phone_url = ! empty ( $dt_theme_general ['apple-favicon'] ) ? $dt_theme_general ['apple-favicon'] : $template_uri . "/images/apple-touch-icon.png";
			echo "<link href='$phone_url' rel='apple-touch-icon-precomposed'/>\n";
	
			$phone_retina_url = ! empty ( $dt_theme_general ['apple-retina-favicon'] ) ? $dt_theme_general ['apple-retina-favicon'] : $template_uri . "/images/apple-touch-icon-114x114.png";
			echo "<link href='$phone_retina_url' sizes='114x114' rel='apple-touch-icon-precomposed'/>\n";
	
			$ipad_url = ! empty ( $dt_theme_general ['apple-ipad-favicon'] ) ? $dt_theme_general ['apple-ipad-favicon'] : $template_uri . "/images/apple-touch-icon-72x72.png";
			echo "<link href='$ipad_url' sizes='72x72' rel='apple-touch-icon-precomposed'/>\n";
	
			$ipad_retina_url = ! empty ( $dt_theme_general ['apple-ipad-retina-favicon'] ) ? $dt_theme_general ['apple-ipad-retina-favicon'] : $template_uri . "/images/apple-touch-icon-144x144.png";
			echo "<link href='$ipad_retina_url' sizes='144x144' rel='apple-touch-icon-precomposed'/>\n";
		endif;
	endif;	

	wp_enqueue_style('default', get_stylesheet_uri());

	//RTL...
	if(is_rtl())
		wp_enqueue_style('rtl-css', $template_uri.'/rtl.css');

	#Buddypress inline css...
	if (function_exists('bp_add_cover_image_inline_css')) {
		$inline_css = bp_add_cover_image_inline_css( true );
		wp_add_inline_style( 'bp-parent-css', strip_tags( $inline_css['css_rules'] ) );
	}

	//SHORTCODES...
	wp_enqueue_style('shortcode', $template_uri.'/css/shortcode.css');
	
	//SKIN...
	if($theme = dt_theme_option('appearance','skin'))
		wp_enqueue_style("skin", $template_uri."/skins/$theme/style.css", array(), false, 'all');
	else
		wp_enqueue_style("skin", $template_uri."/skins/ferngreen/style.css", array(), false, 'all');

	$dt_theme_mobile = !empty($dt_theme_options['mobile']) ? $dt_theme_options['mobile'] : "";

	//SLIDER DISABLE...
    if(isset($dt_theme_mobile['is-slider-disabled'])):
		$out =	'<style type="text/css">';
		$out .=	'@media only screen and (max-width:320px), (max-width: 479px), (min-width: 480px) and (max-width: 767px), (min-width: 768px) and (max-width: 959px),
		 (max-width:1200px) { .banner { display:none !important; } }';
		$out .=	'</style>';
		echo $out;
	endif;

	wp_enqueue_style('animations', $template_uri.'/css/animations.css');
	wp_enqueue_style('isotope', $template_uri.'/css/isotope.css');

	if(!is_singular('product')) {
		wp_enqueue_style('prettyphoto', $template_uri.'/css/prettyPhoto.css');
	}
	wp_enqueue_style('style.fontawesome', $template_uri.'/css/font-awesome.min.css');

	//WOOCOMMERCE...
	if(dt_theme_is_plugin_active('woocommerce/woocommerce.php'))
		wp_enqueue_style('stylewoo', $template_uri.'/framework/woocommerce/css/style.css');

	//RESPONSIVE STYLES...
	if(dt_theme_option('mobile', 'is-theme-responsive'))
		wp_enqueue_style("responsive", $template_uri."/css/responsive.css");

	//WP JQUERY...
	wp_enqueue_script('modernizr-script', $template_uri.'/framework/js/public/modernizr-2.6.2.min.js');	
	wp_enqueue_script('jquery');
}
add_action( 'wp_enqueue_scripts', 'dt_theme_front_css', 20 );

function hex2rgb($hex) {
	$hex = str_replace ( "#", "", $hex );
	
	if (strlen ( $hex ) == 3) :
		$r = hexdec ( substr ( $hex, 0, 1 ) . substr ( $hex, 0, 1 ) );
		$g = hexdec ( substr ( $hex, 1, 1 ) . substr ( $hex, 1, 1 ) );
		$b = hexdec ( substr ( $hex, 2, 1 ) . substr ( $hex, 2, 1 ) );
	 else :
		$r = hexdec ( substr ( $hex, 0, 2 ) );
		$g = hexdec ( substr ( $hex, 2, 2 ) );
		$b = hexdec ( substr ( $hex, 4, 2 ) );
	endif;
	$rgb = array (
			$r,
			$g,
			$b 
	);
	return $rgb;
}
// ##########################################
// PAGINATION
// ##########################################
function dt_theme_pagination($class='',$pages = '', $wp_query){
	$out = NULL;
	$paged = $wp_query->query_vars['paged'];
	if(empty($paged))$paged = 1;
	$prev = $paged - 1;							
	$next = $paged + 1;	
	$range = 10; // only edit this if you want to show more page-links
	$showitems = ($range * 2)+1;
	if($pages == '') {	
		$pages = $wp_query->max_num_pages;
		if(!$pages)	{
			$pages = 1;
		}
	}
	
	$out .= '<span>'.__('Page', 'iamd_text_domain').' '.$paged.' '.__('of', 'iamd_text_domain').' '.$pages.'</span>';
	$out .= '<ul class="pagination">';
		if(1 != $pages){
			for ($i=1; $i <= $pages; $i++){
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
					if( $class == "ajax-load"):
						$c =  ($paged == $i) ? "active-page" : "";
						$out .= "<li><a href='".get_pagenum_link($i)."' class='".$c."'>".$i."</a></li>";
					else: 
						$out .=  ($paged == $i)? "<li class='active-page'>".$i."</li>":"<li><a href='".get_pagenum_link($i)."' class='inactive'>".$i."</a></li>"; 
					endif;
				}
			}
		}
	$out .= '</ul>';
	return $out;
}

function arr_strfun(&$item, $key) {
	$item = str_replace(" ", "-", strtolower($item));
}

function theme_chk_pp() {
	previous_posts_link("Prev");
	next_posts_link("Next");
}
//LIKE PLUGIN ACTION...
add_action('activated_plugin', 'dt_like_plugin_hook', 1);
function dt_like_plugin_hook() {
	if(dt_theme_is_plugin_active('roses-like-this/likethis.php')) {
		update_option("no_likes", "0");
		update_option("one_like", "%");
		update_option("some_likes", "%");
	}
}

//Filter for oembed_result...
function slt_wmode_opaque( $html, $url, $args ) {	
if( strrpos($url,"youtube") !== false || strrpos($url,"youtu.") !== false ) {
        $patterns[] = '/src="(.*?)"/';
        $replacements[] = 'src="${1}&wmode=opaque"';
        $html =  preg_replace($patterns, $replacements, $html);
        $html = str_replace('</iframe>)', '</iframe>', $html);
        
 }elseif( strrpos($url, "soundcloud.com") !== false ) {
         $patterns[] = '/height="(.*?)"/';
         $replacements[] = 'height="189"';
         $html =  preg_replace($patterns, $replacements, $html);
         
         $patterns[] = '/width="(.*?)"/';
         $replacements[] = 'width="100%"';
         $html =  preg_replace($patterns, $replacements, $html);
         
         $patterns[] = '/visual=true&/';
         $replacements[] = '';
         $html =  preg_replace($patterns, $replacements, $html);
 }
return $html;
}
add_filter( 'oembed_result', 'slt_wmode_opaque', 10, 3 );

#Show Sidebar Function...
function dt_theme_show_sidebar($type, $id, $sidebar = 'left'){

	if( $type === 'post'){
		$settings = get_post_meta($id,'_dt_post_settings',TRUE);
	}elseif( $type === 'page' ){
		$settings = get_post_meta($id,'_tpl_default_settings',TRUE);
	}elseif( $type === 'dt_galleries' ){
		$settings = get_post_meta($id,'_gallery_settings',TRUE);
	}

	$settings = is_array($settings) ? $settings  : array();

	if ( !array_key_exists('disable-everywhere-sidebar-'.$sidebar,$settings) ):
		if(function_exists('dynamic_sidebar') && dynamic_sidebar(('display-everywhere-sidebar-'.$sidebar)) ): endif;
	endif;	

	if( array_key_exists('widget-area-'.$sidebar, $settings)):

		foreach ($settings['widget-area-'.$sidebar] as $widget ) {
			$id = mb_convert_case($widget, MB_CASE_LOWER, "UTF-8");
			if(function_exists('dynamic_sidebar') && dynamic_sidebar($id) ): endif;
		}
	endif;

}

// Avoid a problem with Events Calendar PRO 4.2 which can inadvertently
// break oembeds.
function dt_theme_undo_recurrence_oembed_logic() {

	if ( ! class_exists( 'Tribe__Events__Pro__Main' ) ) return;
 
	$pro_object = Tribe__Events__Pro__Main::instance();
	$pro_callback = array( $pro_object, 'oembed_request_post_id_for_recurring_events' );
 
	remove_filter( 'oembed_request_post_id', $pro_callback );
}
add_action( 'init', 'dt_theme_undo_recurrence_oembed_logic' );

//Update for page builder latest version
add_action( 'wp_ajax_dt_theme_update_pagebuilder_contents', 'dt_theme_update_pagebuilder_contents' );
add_action( 'wp_ajax_nopriv_dt_theme_update_pagebuilder_contents', 'dt_theme_update_pagebuilder_contents' );
function dt_theme_update_pagebuilder_contents() {
	
	// Script to update pages
	$page_args = array('post_type' => 'page' ,'post_status' => 'publish' , 'posts_per_page' =>'-1');
	
	$page_datas = new WP_Query( $page_args );
	if( $page_datas->have_posts() ):
		while( $page_datas->have_posts() ):
			$page_datas->the_post();
				
				$current_page_id = get_the_ID();
				
				$builder_layout = get_post_meta( $current_page_id, '_dt_builder_settings', true );
				$builder_layout = is_array( $builder_layout ) ? $builder_layout  : array();
				$layout_html = array_key_exists('layout_html',$builder_layout ) ? $builder_layout['layout_html'] : '';
				$layout_shortcode = array_key_exists('layout_shortcode',$builder_layout ) ? $builder_layout['layout_shortcode'] : '';
				$layout_parsed = array_key_exists('layout_parsed',$builder_layout ) ? $builder_layout['layout_parsed'] : 'false';
				
				if($layout_parsed != 'true') {
				
					$layout_html_new = str_replace('<span class="dt_add_module_column" title="Add Module" style="display:none;">A</span>', '', $layout_html);
					$layout_html_new = str_replace('<div data-option_name="content" class="content', '<div data-option_name="title_content" class="title_content', $layout_html_new);
					$layout_html_new = str_replace('dt_fullwidth_section_container', 'dt_modules_holder dt_fullwidth_section_container', $layout_html_new);
					$layout_html_new = str_replace('dt_modules_container', 'dt_modules_holder dt_modules_container', $layout_html_new);
					
					
					$doc = new DomDocument();
					$file = @$doc->loadHTML($layout_html_new);
					
					$divtag = $doc->getElementsByTagName('div');
					foreach($divtag AS $item)
					{
					
						$item_class = $item->getAttribute('class');
						$item_class_arr = explode(' ', $item_class);
						
						if(in_array('dt_m_column', $item_class_arr)) {
						
							$add_module_div = $doc->createElement('div', '');
							$add_module_div_class = $doc->createAttribute('class');
							$add_module_div_class->value = 'dt_show_modules_in_popup dt_popup_from_column';
							$add_module_div_title = $doc->createAttribute('title');
							$add_module_div_title->value = 'Add Module';
							
							$add_module_div->appendChild($add_module_div_class);
							$add_module_div->appendChild($add_module_div_title);
							
							$item->appendChild($add_module_div);
							
						}
					
						if(in_array('dt_fullwidth_section', $item_class_arr)) {
						
							$add_module_div = $doc->createElement('div', '');
							$add_module_div_class = $doc->createAttribute('class');
							$add_module_div_class->value = 'dt_show_modules_in_popup dt_popup_from_section';
							$add_module_div_title = $doc->createAttribute('title');
							$add_module_div_title->value = 'Add Module';
							
							$add_module_div->appendChild($add_module_div_class);
							$add_module_div->appendChild($add_module_div_title);
							
							$item->appendChild($add_module_div);
							
						}
					
					}
					
					$layout_html_new = @$doc->saveHTML();
					
					$layout_html_new = str_replace('<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">', '', $layout_html_new);
					$layout_html_new = str_replace('<html><body>', '', $layout_html_new);
					$layout_html_new = str_replace('</body></html>', '', $layout_html_new);
					
					$output = array();
					$output['layout_html'] = $layout_html_new;
					$output['layout_shortcode'] = $layout_shortcode;
					$output['layout_parsed'] = 'true';
					
					update_post_meta($current_page_id, '_dt_builder_settings', $output);
				
				}
				
		endwhile;
	endif;
	
	// Script to update posts
	$post_args = array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' =>'-1');
	
	$post_datas = new WP_Query( $post_args );
	if( $post_datas->have_posts() ):
		while( $post_datas->have_posts() ):
			$post_datas->the_post();
				
				$current_page_id = get_the_ID();
				
				$builder_layout = get_post_meta( $current_page_id, '_dt_builder_settings', true );
				$builder_layout = is_array( $builder_layout ) ? $builder_layout  : array();
				$layout_html = array_key_exists('layout_html',$builder_layout ) ? $builder_layout['layout_html'] : '';
				$layout_shortcode = array_key_exists('layout_shortcode',$builder_layout ) ? $builder_layout['layout_shortcode'] : '';
				$layout_parsed = array_key_exists('layout_parsed',$builder_layout ) ? $builder_layout['layout_parsed'] : 'false';
				
				if($layout_parsed != 'true') {
				
					$layout_html_new = str_replace('<span class="dt_add_module_column" title="Add Module" style="display:none;">A</span>', '', $layout_html);
					$layout_html_new = str_replace('<div data-option_name="content" class="content', '<div data-option_name="title_content" class="title_content', $layout_html_new);
					$layout_html_new = str_replace('dt_fullwidth_section_container', 'dt_modules_holder dt_fullwidth_section_container', $layout_html_new);
					$layout_html_new = str_replace('dt_modules_container', 'dt_modules_holder dt_modules_container', $layout_html_new);
					
					
					$doc = new DomDocument();
					$file = @$doc->loadHTML($layout_html_new);
					
					$divtag = $doc->getElementsByTagName('div');
					foreach($divtag AS $item)
					{
					
						$item_class = $item->getAttribute('class');
						$item_class_arr = explode(' ', $item_class);
						
						if(in_array('dt_m_column', $item_class_arr)) {
						
							$add_module_div = $doc->createElement('div', '');
							$add_module_div_class = $doc->createAttribute('class');
							$add_module_div_class->value = 'dt_show_modules_in_popup dt_popup_from_column';
							$add_module_div_title = $doc->createAttribute('title');
							$add_module_div_title->value = 'Add Module';
							
							$add_module_div->appendChild($add_module_div_class);
							$add_module_div->appendChild($add_module_div_title);
							
							$item->appendChild($add_module_div);
							
						}
					
						if(in_array('dt_fullwidth_section', $item_class_arr)) {
						
							$add_module_div = $doc->createElement('div', '');
							$add_module_div_class = $doc->createAttribute('class');
							$add_module_div_class->value = 'dt_show_modules_in_popup dt_popup_from_section';
							$add_module_div_title = $doc->createAttribute('title');
							$add_module_div_title->value = 'Add Module';
							
							$add_module_div->appendChild($add_module_div_class);
							$add_module_div->appendChild($add_module_div_title);
							
							$item->appendChild($add_module_div);
							
						}
					
					}
					
					$layout_html_new = @$doc->saveHTML();
					
					$layout_html_new = str_replace('<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">', '', $layout_html_new);
					$layout_html_new = str_replace('<html><body>', '', $layout_html_new);
					$layout_html_new = str_replace('</body></html>', '', $layout_html_new);
					
					$output = array();
					$output['layout_html'] = $layout_html_new;
					$output['layout_shortcode'] = $layout_shortcode;
					$output['layout_parsed'] = 'true';
					
					update_post_meta($current_page_id, '_dt_builder_settings', $output);
				
				}
				
		endwhile;
	endif;
	
	$bp_data = get_option(IAMD_THEME_SETTINGS);
	$bp_data['pagebuilder_update'] = 'done';
	update_option(IAMD_THEME_SETTINGS, $bp_data);
	
	die('1');
	
}

/* ---------------------------------------------------------------------------
 * SSL | Attachments
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'dt_theme_ssl_attachments' ) )
{
	function dt_theme_ssl_attachments( $url ){
		if( is_ssl() ){
			return str_replace('http://', 'https://', $url);
		}
		return $url;
	}
}
add_filter( 'wp_get_attachment_url', 'dt_theme_ssl_attachments' );

/* ---------------------------------------------------------------------------
 * Site SSL Compatibility
 * --------------------------------------------------------------------------- */
if(!function_exists('dt_theme_ssl')) 
{
	function dt_theme_ssl( $echo = false ){
		$ssl = '';
		if( is_ssl() ) $ssl = 's';
		if( $echo ){
			echo esc_html($ssl);
		}
		return $ssl;
	}
}?>