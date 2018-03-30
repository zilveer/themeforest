<?php
function dt_theme_bbpress_title(){
	global $bp;
	$doctitle = "";
	$separator = dttheme_option ( 'seo', 'title-delimiter' );
	$id = 0;

	if ( !empty( $bp->displayed_user->fullname ) ) {
		
		$blog_title = preg_replace ( "~(?:\[/?)[^/\]]+/?\]~s", '', get_option ( 'blogname' ));
		$title =  bp_current_component() === "profile" ? __("Profile","dt_themes") : __("Member","dt_themes");
		$subtitle = strip_tags( $bp->displayed_user->fullname );
		$doctitle = $blog_title.' '.$separator.' '.$title.' '.$separator.' '.$subtitle.' '.$separator;

	} elseif( function_exists('bp_is_members_component') && bp_is_members_component() ) {
		$id = $bp->pages->members->id;
	}elseif( function_exists('bp_is_activity_component') && bp_is_activity_component() ){
		$id = $bp->pages->activity->id;
	}elseif( function_exists('bp_current_component') && bp_current_component() === "groups" ) {
		$id = $bp->pages->groups->id;
	}elseif( function_exists('bp_current_component') && bp_current_component() === "register" ) {
		$id = $bp->pages->register->id;
	}elseif( function_exists('bp_current_component') && bp_current_component() === "activate" ) {
		$id = $bp->pages->activate->id;
	}
	if( $id > 0 ){
		global $post;
		$args = array (
			"blog_title" => preg_replace ( "~(?:\[/?)[^/\]]+/?\]~s", '', get_option ( 'blogname' ) ),
			"blog_description" => get_bloginfo ( 'description' ),
			"post_title" => ! empty ( $post ) ? $post->post_title : NULL,
			"post_author_nicename" => ! empty ( $nickname ) ? ucwords ( $nickname ) : NULL,
			"post_author_firstname" => ! empty ( $first_name ) ? ucwords ( $first_name ) : NULL,
			"post_author_lastname" => ! empty ( $last_name ) ? ucwords ( $last_name ) : NULL,
			"post_author_dsiplay" => ! empty ( $display_name ) ? ucwords ( $display_name ) : NULL );
		$args = array_filter ( $args );

		$doctitle = get_post_meta ( $id, '_seo_title', true );
		if (empty ( $doctitle )) :
			$options = is_array ( dttheme_option ( 'seo', 'page-title-format' ) ) ? dttheme_option ( 'seo', 'page-title-format' ) : array ();
			foreach ( $options as $option ) :
				if (array_key_exists ( $option, $args ))
					$doctitle .= $args [$option] . ' ' . $separator . ' ';
			endforeach;
		endif;

	}	
	
	return $doctitle;
}


/** dttheme_public_title()
 * Objective:
 *		Outputs the value for <title></title> in front end.
 *
 **/
function dttheme_public_title() {
	global $post;
	$doctitle = '';
	$separator = dttheme_option ( 'seo', 'title-delimiter' );
	$split = true;

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
	
	if (class_exists('BP_Core_user') && !bp_is_blog_page() ):
		$doctitle = dt_theme_bbpress_title();
	elseif ( function_exists( 'is_bbpress' ) && is_bbpress() ):
		$doctitle =  dt_theme_bbpress_title();
	elseif (is_home() || is_front_page()) :
		$doctitle = "";
		if ((get_option ( 'page_on_front' ) != 0) && (get_option ( 'page_on_front' ) == $post->ID))
		$doctitle = trim ( get_post_meta ( $post->ID, '_seo_title', true ) );
			
		$doctitle = ! empty ( $doctitle ) ? trim ( $doctitle ) : $args ["blog_title"];
		$doctitle =  array_key_exists("blog_description",$args ) ?  $doctitle.' '.$separator.' '.$args["blog_description"] : $doctitle;
		
		if( dttheme_option('onepage','seo-title') ):
			$doctitle = dttheme_option('onepage','seo-title');
		endif;
		
		$split = false;
	elseif (is_page()) :
		$doctitle = get_post_meta ( $post->ID, '_seo_title', true );
		if (empty ( $doctitle )) :
			$options = is_array ( dttheme_option ( 'seo', 'page-title-format' ) ) ? dttheme_option ( 'seo', 'page-title-format' ) : array ();
			foreach ( $options as $option ) :
				if (array_key_exists ( $option, $args ))
					$doctitle .= $args [$option] . ' ' . $separator . ' ';
			endforeach;
		endif;
	elseif (is_single()) :
		$doctitle = get_post_meta ( $post->ID, '_seo_title', true );
		if (empty ( $doctitle )) :
			// o add categories in $args
			$categories = get_the_category ();
			$c = '';
			foreach ( $categories as $category ) :
				$c .= $category->name . ' ' . $separator . ' ';
			endforeach;
			
			$c = substr ( trim ( $c ), "0", strlen ( trim ( $c ) ) - 1 );
			$args ["category_title"] = $c;
			// nd of adding categories in $args
			
			// o add tags in $args
			$posttags = get_the_tags ();
			$ptags = '';
			if ($posttags) :
				foreach ( $posttags as $posttag ) :
					$ptags .= $posttag->name . $separator;
				endforeach;
				$ptags = substr ( trim ( $ptags ), "0", strlen ( trim ( $ptags ) ) - 1 );
				$args ["tag_title"] = $ptags;
			
			endif;
			// nd of adding tags in $args
			$options = is_array ( dttheme_option ( 'seo', 'post-title-format' ) ) ? dttheme_option ( 'seo', 'post-title-format' ) : array ();
			foreach ( $options as $option ) :
				if (array_key_exists ( $option, $args )) :
					$doctitle .= $args [$option] . ' ' . $separator . ' ';
			    endif;
				
			endforeach;
		endif;
	elseif (is_category()) :
		$categories = get_the_category ();
		// o add category description into $args
		$args ["category_title"] = $categories [0]->name;
		$args ["category_desc"] = $categories [0]->description;
		// nd of adding category description into $args
		
		$options = is_array ( dttheme_option ( 'seo', 'category-page-title-format' ) ) ? dttheme_option ( 'seo', 'category-page-title-format' ) : array ();
		foreach ( $options as $option ) :
			if (array_key_exists ( $option, $args ))
				$doctitle .= $args [$option] . ' ' . $separator . ' ';
		endforeach;
	elseif (is_tag()) :
		$args ["tag"] = single_tag_title('',FALSE);
		$options = is_array ( dttheme_option ( 'seo', 'tag-page-title-format' ) ) ? dttheme_option ( 'seo', 'tag-page-title-format' ) : array ();
		foreach ( $options as $option ) :
			if (array_key_exists ( $option, $args )) {
				$doctitle .= $args [$option] . ' ' . $separator . '  ';
			}
		endforeach;
	elseif (is_archive()) :
		$title = wp_title ( " ", false );
		$find = $args['blog_title'];
		$title = preg_replace(strrev("/$find/"),strrev(""),strrev($title),1);
		$title = strrev($title);
		$args ["date"] = $title;
		$options = is_array ( dttheme_option ( 'seo', 'archive-page-title-format' ) ) ? dttheme_option ( 'seo', 'archive-page-title-format' ) : array ();
		foreach ( $options as $option ) :
			if (array_key_exists ( $option, $args ))
				$doctitle .= $args[$option] . ' ' . $separator . ' ';
		endforeach;
	elseif (is_date()) :
	elseif (is_search()) :
		$args ["search"] = __ ( "Search results for", 'dt_themes' ) . ' "' . $_REQUEST ['s'] . '"'; // dding search text into the default args
		$options = is_array ( dttheme_option ( 'seo', 'search-page-title-format' ) ) ? dttheme_option ( 'seo', 'search-page-title-format' ) : array ();
		foreach ( $options as $option ) :
			if (array_key_exists ( $option, $args ))
				$doctitle .= $args [$option] . ' ' . $separator . ' ';
		endforeach;
		
	elseif (is_404()) :
		$options = is_array ( dttheme_option ( 'seo', '404-page-title-format' ) ) ? dttheme_option ( 'seo', '404-page-title-format' ) : array ();
		foreach ( $options as $option ) :
			if (array_key_exists ( $option, $args ))
				$doctitle .= $args [$option] . ' ' . $separator . ' ';
		endforeach;
		
		$doctitle = $doctitle . __ ( 'Page not found', 'dt_themes' );
		$split = false;	

	endif;	

	if ($split) :
		if (strrpos ( $doctitle, $separator )) :
			$doctitle = str_split ( $doctitle, strrpos ( $doctitle, $separator ) );
			$doctitle = $doctitle [0];
		endif;
	endif;
	return $doctitle;
}

/**
 * dttheme_canonical()
 * Objective:
 * Generate the Canonical url
 * This function called at register_public.php via dttheme_seo_meta();
 */
function dttheme_canonical() {
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
// # --- **** dttheme_canonical() *** --- ###

/**
 * show_fblike()
 * Objective:
 * Outputs the facebook like button in post and page.
 */
function show_fblike($arg = 'post') {
	$fb = dttheme_option ( 'integration', "{$arg}-fb_like" );
	$output = "";
	if (! empty ( $fb )) :
		$layout = dttheme_option ( 'integration', "{$arg}-fb_like-layout" );
		$scheme = dttheme_option ( 'integration', "{$arg}-fb_like-color-scheme" );
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
	$googleplus = dttheme_option ( 'integration', "{$arg}-googleplus" );
	$output = "";
	if (! empty ( $googleplus )) :
		$layout = dttheme_option ( 'integration', "{$arg}-googleplus-layout" );
		$lang = dttheme_option ( 'integration', "{$arg}-googleplus-lang" );
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
	$twitter = dttheme_option ( 'integration', "{$arg}-twitter" );
	$output = "";
	if (! empty ( $twitter )) :
		$layout = dttheme_option ( 'integration', "{$arg}-twitter-layout" );
		$lang = dttheme_option ( 'integration', "{$arg}-twitter-lang" );
		$username = dttheme_wp_kses(dttheme_option ( 'integration', "{$arg}-twitter-username" ));
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
	$stumbleupon = dttheme_option ( 'integration', "{$arg}-stumbleupon" );
	$output = "";
	if (! empty ( $stumbleupon )) :
		$layout = dttheme_option ( 'integration', "{$arg}-stumbleupon-layout" );
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
	$linkedin = dttheme_option ( 'integration', "{$arg}-linkedin" );
	$output = "";
	if (! empty ( $linkedin )) :
		$layout = dttheme_option ( 'integration', "{$arg}-linkedin-layout" );
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
	$delicious = dttheme_option ( 'integration', "{$arg}-delicious" );
	$output = "";
	if (! empty ( $delicious )) :
		$text = dttheme_wp_kses(dttheme_option ( 'integration', "{$arg}-delicious-text" ));
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
	$delicious = dttheme_option ( 'integration', "{$arg}-pintrest" );
	$output = "";
	if (! empty ( $delicious )) :
		$layout = dttheme_option ( 'integration', "{$arg}-pintrest-layout" );
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
	$digg = dttheme_option ( 'integration', "{$arg}-digg" );
	$output = "";
	if (! empty ( $digg )) :
		$layout = dttheme_option ( 'integration', "{$arg}-digg-layout" );
		$output .= do_shortcode ( "[digg layout='{$layout}' /]" );
		echo $output;
	endif;
}
// # --- **** show_digg() *** --- ###

/**
 * dttheme_tweetbox_filter()
 * Objective:
 * Returns filtered tweets.
 * @args:
 * 1.text :	Tweets text to filter
 */
function dttheme_tweetbox_filter($text) {
	// Props to Allen Shaw & webmancers.com & Michael Voigt
	$text = preg_replace ( '/\b([a-zA-Z]+:\/\/[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i', "<a href=\"$1\" class=\"twitter-link\">$1</a>", $text );
	$text = preg_replace ( '/\b(?<!:\/\/)(www\.[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i', "<a href=\"http://$1\" class=\"twitter-link\">$1</a>", $text );
	$text = preg_replace ( "/\b([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})\b/i", "<a href=\"mailto://$1\" class=\"twitter-link\">$1</a>", $text );
	$text = preg_replace ( "/#(\w+)/", "<a class=\"twitter-link\" href=\"http://search.twitter.com/search?q=\\1\">#\\1</a>", $text );
	$text = preg_replace ( "/@(\w+)/", "<a class=\"twitter-link\" href=\"http://twitter.com/\\1\">@\\1</a>", $text );
	return $text;
}
// # --- **** dttheme_tweetbox_filter() *** --- ###

/**
 * dttheme_footer_widgetarea()
 * Objective:
 * 1.
 * To Generate Footer Widget Areas
 * Args: $count = No of widget areas
 */
function dttheme_footer_widgetarea($count) {
	$name = __ ( "Footer Column", 'dt_themes' );
	if ($count <= 4) :
		for($i = 1; $i <= $count; $i ++) :
			register_sidebar ( array (
					'name' => $name . "-{$i}",
					'id' => "footer-sidebar-{$i}",
					'description' => __("Appears in the footer section of the site.","dt_themes"),
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget' => '</aside>',
					'before_title' => '<h3 class="widgettitle">',
					'after_title' => '</h3>' 
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
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget' => '</aside>',
					'before_title' => '<h3 class="widgettitle">',
					'after_title' => '</h3>' 
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
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget' => '</aside>',
					'before_title' => '<h3 class="widgettitle">',
					'after_title' => '</h3>' 
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
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget' => '</aside>',
					'before_title' => '<h3 class="widgettitle">',
					'after_title' => '</h3>' 
			) );
		endforeach
		;
	endif;
}
// # --- **** dttheme_footer_widgetarea() *** --- ###

// # --- **** dttheme_show_footer_widgetarea() *** --- ###
/**
 * dttheme_show_footer_widgetarea()
 * Objective:
 * Outputs the Footer section widget area.
 */
function dttheme_show_footer_widgetarea($count) {
	$classes = array (
			"1" => "dt-sc-full-width",
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
			#$last = (end ( $a ) == $v) ? "last" : "";
			#echo "<div class='column {$class} {$last}'>";

			$first = ($k == 0 ) ? "first" : "";
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
			#$last = (end ( $a ) == $v) ? "last" : "";
			#echo "<div class='column {$class} {$last}'>";
			$first = ($k == 0 ) ? "first" : "";
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
			#$last = (end ( $a ) == $v) ? "last" : "";
			#echo "<div class='column {$class} {$last}'>";
			$first = ($k == 0 ) ? "first" : "";
			echo "<div class='column {$class} {$first}'>";
			if (function_exists ( 'dynamic_sidebar' ) && dynamic_sidebar ( "footer-sidebar-{$k}-{$v}" )) :endif;
			echo "</div>";
		endforeach;
	endif;
}
// # --- **** dttheme_show_footer_widgetarea() *** --- ###

// # --- **** dttheme_is_plugin_active() *** --- ###
/**
 * dttheme_is_plugin_active()
 * Objective:
 * Check the plugin is activated
 */
function dttheme_is_plugin_active($plugin) {
	return in_array ( $plugin, ( array ) get_option ( 'active_plugins', array () ) );
}
// # --- **** dttheme_is_plugin_active() *** --- ###

// # --- **** dttheme_check_slider_revolution_responsive_wordpress_plugin() *** --- ###
/**
 * dttheme_check_slider_revolution_responsive_wordpress_plugin()
 * Objective:
 * Check the "Revolution Responsive WordPress Plugin" is activated
 */
function dttheme_check_slider_revolution_responsive_wordpress_plugin() {
	$sliders = false;
	if (dttheme_is_plugin_active ( 'revslider/revslider.php' )) :
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
// # --- **** dttheme_is_plugin_active() *** --- ###

// # --- **** dttheme_social_bookmarks() *** --- ###
/**
 * dttheme_social_bookmarks()
 * Objective:
 * To show social shares
 */
function dttheme_social_bookmarks($arg = 'sb-post') {
	global $post;
	
	$title = $post->post_title;
	$url = get_permalink ( $post->ID );
	$excerpt = $post->post_excerpt;
	$data = "";
	
	$path = IAMD_BASE_URL . "images/sociable/share";
	
	$fb = dttheme_option ( 'integration', "{$arg}-fb_like" );
	$data .= ! empty ( $fb ) ? '<li><a href="http://www.facebook.com/sharer.php?u=$url&amp;t='.urlencode($title).'"><span class="hexagon2"><span class="corner1"></span><span class="corner2"></span><i class="fa fa-facebook"></i></span></a></li>' : '';
	
	$delicious = dttheme_option ( 'integration', "{$arg}-delicious" );
	$data .= ! empty ( $delicious ) ? '<li><a href="http://del.icio.us/post?url=$url&amp;title='.urlencode($title).'"><span class="hexagon2"><span class="corner1"></span><span class="corner2"></span><i class="fa fa-delicious"></i></span></a></li>' : '';
	
	$digg = dttheme_option ( 'integration', "{$arg}-digg" );
	$data .= ! empty ( $digg ) ? '<li><a href="http://digg.com/submit?phase=2&amp;url=$url&amp;title='.urlencode($title).'"><span class="hexagon2"><span class="corner1"></span><span class="corner2"></span><i class="fa fa-digg"></i></span></a></li>' : '';
	
	$stumbleupon = dttheme_option ( 'integration', "{$arg}-stumbleupon" );
	$data .= ! empty ( $stumbleupon ) ? '<li><a href="http://www.stumbleupon.com/submit?url=$url&amp;title='.urlencode($title).'"><span class="hexagon2"><span class="corner1"></span><span class="corner2"></span><i class="fa fa-stumbleupon"></i></span></a></li>' : '';
	
	$twitter = dttheme_option ( 'integration', "{$arg}-twitter" );
	$t_url = ! empty ( $twitter ) ? $url : '';
	$data .= ! empty ( $twitter ) ? '<li><a href="http://twitter.com/home/?status='.urlencode($title).':'.$t_url.'"><span class="hexagon2"><span class="corner1"></span><span class="corner2"></span><i class="fa fa-twitter"></i></span></a></li>' : '';
	
	$googleplus = dttheme_option ( 'integration', "{$arg}-googleplus" );
	$data .= ! empty ( $googleplus ) ? '<li><a href="https://plus.google.com/share?url='.$url.'"><span class="hexagon2"><span class="corner1"></span><span class="corner2"></span><i class="fa fa-google-plus"></i></span></a></li>' : '';
	
	$linkedin = dttheme_option ( 'integration', "{$arg}-linkedin" );
	$data .= ! empty ( $linkedin ) ? '<li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;title='.urlencode($title).'"><span class="hexagon2"><span class="corner1"></span><span class="corner2"></span><i class="fa fa-linkedin"></i></span></a></li>' : '';
	
	$pintrest = dttheme_option ( 'integration', "{$arg}-pintrest" );
	$media = wp_get_attachment_url ( get_post_thumbnail_id ( $post->ID ) );
	$data .= ! empty ( $pintrest ) ? '<li><a href="http://pinterest.com/pin/create/button/?url='.urlencode($url).'&amp;media='.$media.'"><span class="hexagon2"><span class="corner1"></span><span class="corner2"></span><i class="fa fa-pinterest"></i></span></a></li>' : '';
	
	$data = ! empty ( $data ) ? "<ul class='dt-sc-social-icons'>{$data}</ul>" : "";
	echo $data;
}
// # --- **** dttheme_social_bookmarks() *** --- ###

// # --- **** is_mytheme_moible_view() *** --- ###
/**
 * dttheme_is_mobile_view()
 * Objective:
 * If you eanble responsive mode in theme , this will add view port at the head
 */
function dttheme_is_mobile_view() {
	$dttheme_options = get_option ( IAMD_THEME_SETTINGS );
	$dttheme_mobile = array_key_exists("mobile",$dttheme_options ) ?  $dttheme_options ['mobile'] : array();
	if (isset ( $dttheme_mobile ['is-theme-responsive'] ))
		echo "<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1' />\r";
}
// # --- **** dttheme_is_mobile_view() *** --- ###

// o load basic css : default,shortcode & skin css
function dttheme_load_basic_css() {
	$dttheme_options = get_option ( IAMD_THEME_SETTINGS );
	$dttheme_general = $dttheme_options ['general'];
	
	if (isset ( $dttheme_general ['enable-favicon'] )) :
		$url = ! empty ( $dttheme_general ['favicon-url'] ) ? $dttheme_general ['favicon-url'] : IAMD_BASE_URL . "images/favicon.ico";
		echo "<link href='$url' rel='shortcut icon' type='image/x-icon' />\n";

		$phone_url = ! empty ( $dttheme_general ['apple-favicon'] ) ? $dttheme_general ['apple-favicon'] : IAMD_BASE_URL . "images/apple-touch-icon.ico";
		echo "<link href='$phone_url' rel='apple-touch-icon-precomposed'/>\n";

		$phone_retina_url = ! empty ( $dttheme_general ['apple-retina-favicon'] ) ? $dttheme_general ['apple-retina-favicon'] : IAMD_BASE_URL . "images/apple-touch-icon-114x114.ico";
		echo "<link href='$phone_retina_url' sizes='114x114' rel='apple-touch-icon-precomposed'/>\n";

		$ipad_url = ! empty ( $dttheme_general ['apple-ipad-favicon'] ) ? $dttheme_general ['apple-ipad-favicon'] : IAMD_BASE_URL . "images/apple-touch-icon-72x72.ico";
		echo "<link href='$ipad_url' sizes='72x72' rel='apple-touch-icon-precomposed'/>\n";


		$ipad_retina_url = ! empty ( $dttheme_general ['apple-ipad-retina-favicon'] ) ? $dttheme_general ['apple-ipad-retina-favicon'] : IAMD_BASE_URL . "images/apple-touch-icon-144x144.ico";
		echo "<link href='$ipad_retina_url' sizes='114x114' rel='apple-touch-icon-precomposed'/>\n";
	endif;
	
	wp_enqueue_style ( 'reset', IAMD_BASE_URL . 'css/reset.css' );
	wp_enqueue_style ( 'prettyphoto', IAMD_BASE_URL . 'css/prettyPhoto.css' );
	wp_enqueue_style ( 'meanmenu', IAMD_BASE_URL . 'css/meanmenu.css' );
	
	wp_enqueue_style ( 'citrus-default', get_stylesheet_uri () );
	
	wp_enqueue_style ( 'custom-font-awesome', IAMD_BASE_URL . 'css/font-awesome.min.css' );
	//wp_enqueue_style ( 'custom-font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css' );
	
	global $post;
	$tpl_header_styles = get_post_meta( $post->ID, '_tpl_default_settings', TRUE );
	$tpl_header_styles = isset( $tpl_header_styles['header-styles'] ) ? $tpl_header_styles['header-styles']  : '';

	if($tpl_header_styles == 'type2' || $tpl_header_styles == 'type3')
		wp_enqueue_style ( 'slidebars', IAMD_BASE_URL . 'css/slidebars.css' );

	wp_enqueue_style ( 'skin', IAMD_BASE_URL . "skins/" . $dttheme_options ['appearance'] ['skin'] . "/style.css" );

	if(dttheme_option("general","enable-dark-layout")) wp_enqueue_style ( 'darkskin-css', IAMD_BASE_URL.'css/dark-skin.css'); else wp_enqueue_style ( 'darkskin-css', '#');

	wp_enqueue_style( 'font-alegreya', '//fonts.googleapis.com/css?family=Alegreya+Sans:400,800,700,100,500,500italic,300,800italic,900,900italic' );
	wp_enqueue_style( 'font-sanspro', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900,900italic' );
	wp_enqueue_style( 'font-raleway', '//fonts.googleapis.com/css?family=Raleway:400,100,300,200,500,600,700,800,900' );
	wp_enqueue_style( 'font-opensans', '//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,300italic' );
	wp_enqueue_style( 'font-pacifico', '//fonts.googleapis.com/css?family=Pacifico' );
	
}
add_action( 'wp_enqueue_scripts', 'dttheme_load_basic_css', '100' );

// # --- **** dttheme_set_layout *** --- ###
function dttheme_set_layout() {
	if (dttheme_option ( "mobile", "is-theme-responsive" )) {
		wp_enqueue_style ( 'responsive', IAMD_BASE_URL . "responsive.css" );
	}
	
	$dttheme_options = get_option ( IAMD_THEME_SETTINGS );
	$dttheme_mobile = array_key_exists("mobile",$dttheme_options ) ?  $dttheme_options ['mobile'] : array();
	
	if (isset ( $dttheme_mobile ['is-slider-disabled'] )) :
		$out = '<style type="text/css">';
		$out .= '@media only screen and (max-width:320px), (max-width: 479px), (min-width: 480px) and (max-width: 767px), (min-width: 768px) and (max-width: 959px),
		 (max-width:1200px) { div#slider { display:none !important; } 	}';
		$out .= '</style>';
		echo $out;
	endif;
}
add_action( 'wp_enqueue_scripts', 'dttheme_set_layout', '100' );
// # --- **** dttheme_set_layout *** --- ###
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
	$rgb = array ( $r,$g,$b);
	return $rgb;
}

// ##########################################
// PAGINATION
// ##########################################
function dttheme_pagination($class = '', $pages = '') {
	$out = NULL;
	global $paged;
	if (empty ( $paged ))
		$paged = 1;
	$prev = $paged - 1;
	$next = $paged + 1;
	$range = 10; // only edit this if you want to show more page-links
	$showitems = ($range * 2) + 1;
	if ($pages == '') {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if (! $pages) {
			$pages = 1;
		}
	}
	if (1 != $pages) {
		$out .= "<ul class='$class'>";
		$out .= ($paged > 2 && $paged > $range + 1 && $showitems < $pages) ? "<li> <a href='" . get_pagenum_link ( 1 ) . "'>&laquo;</a></li>" : "";
		$out .= ($paged > 1 && $showitems < $pages) ? "<li> <a href='" . get_pagenum_link ( $prev ) . "'>&lsaquo;</a></li>" : "";
		
		for($i = 1; $i <= $pages; $i ++) {
			if (1 != $pages && (! ($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
				if ($class == "ajax-load") :
					$c = ($paged == $i) ? "active-page" : "";
					$out .= "<li><a href='" . get_pagenum_link ( $i ) . "' class='" . $c . "'>" . $i . "</a></li>";
				 else :
					$out .= ($paged == $i) ? "<li class='active-page'>" . $i . "</li>" : "<li><a href='" . get_pagenum_link ( $i ) . "' class='inactive'>" . $i . "</a></li>";
				endif;
			}
		}
		
		$out .= ($paged < $pages && $showitems < $pages) ? "<li> <a href='" . get_pagenum_link ( $next ) . "'>&rsaquo;</a> </li>" : "";
		$out .= ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages) ? "<li> <a href='" . get_pagenum_link ( $pages ) . "'>&raquo;</a></li>" : "";
		$out .= "</ul>";
	}
	return $out;
}

//LIKE PLUGIN ACTION...
add_action('activated_plugin', 'dt_like_plugin_hook', 1);
function dt_like_plugin_hook() {
	if(dttheme_is_plugin_active('roses-like-this/likethis.php')) {
		update_option("no_likes", "0");
		update_option("one_like", "%");
		update_option("some_likes", "%");
	}
}

function dttheme_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	return $title;
}
add_filter( 'wp_title', 'dttheme_wp_title', 10, 2 );

function dt_add_custom_types( $query ) {
    if( is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
        $post_types = get_post_types();
        $query->set( 'post_type', $post_types );
        return $query;
    }
}
add_filter( 'pre_get_posts', 'dt_add_custom_types' );

function slt_wmode_opaque( $html, $url, $args ) {
	
	if( (strrpos($url,"youtube") !== false)  || (strrpos($url,"youtu.") !== false) ) {
		
		$patterns[] = '/src="(.*?)"/';
		$replacements[] = 'src="${1}&wmode=opaque"';
		
		$html =  preg_replace($patterns, $replacements, $html);
		$html = str_replace('</iframe>)', '</iframe>', $html);
		
	}elseif( strrpos($url, "soundcloud.com") !== false ) {
		
		$patterns[] = '/height="(.*?)"/';
		$replacements[] = 'height="166"';
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


#Sidebars
function dttheme_show_sidebar($type, $id, $sidebar = 'left'){

	if( $type === 'post'){
		$settings = get_post_meta($id,'_dt_post_settings',TRUE);
	}elseif( $type === 'page' ){
		$settings = get_post_meta($id,'_tpl_default_settings',TRUE);
	}elseif( $type === "dt_courses" ){
		$settings = get_post_meta($id,'_course_settings',TRUE);
	}elseif( $type === "dt_lessons" ){
		$settings = get_post_meta($id,'_lesson_settings',TRUE);
	}elseif( $type === "dt_teachers" ){
		$settings = get_post_meta($id,'_teacher_settings',TRUE);
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

add_action("wp_ajax_dttheme_team_member", "dttheme_team_member");
add_action("wp_ajax_nopriv_dttheme_team_member", "dttheme_team_member");
function dttheme_team_member() {
	
	if ( !wp_verify_nonce( $_REQUEST['nonce'], "dt_team_member_nonce")) {
		exit();
	}
	$out = '';   

	$post_id = $_REQUEST['post_id'];
	$args = array('post_type' => 'dt_teachers', 'p' => $post_id);
	$the_query = new WP_Query($args);
	if($the_query->have_posts()):
		while($the_query->have_posts()): $the_query->the_post();
		
		
		$out .= '<div class="dt-team-member">';
			$out .= '<div class="dt-team-entry-left">';
				$out .= '<div class="dt-sc-team">';
					$out .= '<div class="dt-sc-entry-thumb">';
						$image =  get_the_post_thumbnail( $post_id, 'medium', array('title' => ''));
						$image = !empty( $image ) ? $image : "<img src='http://placehold.it/220x220&text=Teacher' alt=''  />";
						$out .= $image;
					$out .= '</div>';
					$out .= '<div class="dt-sc-entry-title">';
						$out .= '<h2>'.get_the_title().'</h2>';
						$ts = get_post_meta($post_id, '_teacher_settings', true);
						if($ts['role'] != "")
							$out .= '<h5>'.$ts['role'].'</h5>';
					$out .= '</div>';
				$out .= '</div>';
				
				if(function_exists('the_ratings')) { 
					$out .= do_shortcode('[ratings id="'.$post_id.'"]');
				}
				
			$out .= '</div>';
			
			$out .= '<div class="dt-team-entry-content">';
				
				$out .= '<h3>'.__('About Me', 'dt_themes').' </h3>';

				$out .= '<ul class="teachers-details">';
					$out .= '<li><strong>'.__('Experience', 'dt_themes').' :</strong>'.$ts['exp'].'</li>';
					$out .= '<li><strong>'.__('Courses Submitted', 'dt_themes').' :</strong>'.$ts['course'].'</li>';
					$out .= '<li><strong>'.__('Specialist in', 'dt_themes').' :</strong>'.$ts['special'].'</li>';
				$out .= '</ul>';
				
				$out .= '<div class="teachers-desc">';
					$out .= do_shortcode(get_the_excerpt());
				$out .= '</div>';
			
				$out .= '<a href="'.get_permalink().'" class="dt-sc-button small">'.__('Know More', 'dt_themes').'</a>';
			$out .= '</div>';
		
		$out .= '</div>';
		
		endwhile;
	endif;

	
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		echo $out;
	} 
	else {
		header("Location: ".$_SERVER["HTTP_REFERER"]);
	}
	die();
}

function dttheme_onepage_sections(){
	$sections = array();
	$locations = get_nav_menu_locations();
	if(isset($locations['header_menu'])):
		$menu = wp_get_nav_menu_object( $locations['header_menu'] );
		$items  = wp_get_nav_menu_items($menu->term_id);
		foreach((array) $items as $key => $menu_items){
			$classes = $menu_items->classes;
			if( $menu_items->menu_item_parent == 0 ) {
				if(('page' == $menu_items->object) && !in_array('external',$classes) ){
					$sections[$menu_items->ID] = $menu_items->object_id;
				}
			}
		}
	endif;
return $sections;
}

function dtthemes_ajax_pagination($per_page = 10, $page, $total, $post_id){ 

	$adjacents = "1";

	$page = ($page == 0 ? 1 : $page); 
	$start = ($page - 1) * $per_page; 

	$prev = $page - 1; 
	$next = $page + 1;
	$lastpage = ceil($total/$per_page);
	$lpm1 = $lastpage - 1;

	$pagination = "";
	if($lastpage > 1)
	{ 
		$pagination .= "<div class='pagination' data-postid='{$post_id}'>";
		if ($page >1){
			$pagination .= '<div class="prev-post"><a href="#" cpage="'.$page.'" class="dt-prev"><span class="fa fa-angle-double-left"></span> '.__('Prev', 'dt_themes').'</a></div>';
		}

		$pagination .= "<ul>";
		if ($lastpage < 7 + ($adjacents * 2))
		{ 
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<li class='active-page'>$counter</li>";
				else
					$pagination.= "<li><a href='#'>$counter</a></li>"; 
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))
		{
			if($page < 1 + ($adjacents * 2)) 
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li class='active-page'>$counter</li>";
					else
						$pagination.= "<li><a href='#'>$counter</a></li>"; 
				}
				$pagination.= "<li class='dot'>...</li>";
				$pagination.= "<li><a href='#'>$lpm1</a></li>";
				$pagination.= "<li><a href='#'>$lastpage</a></li>"; 
			}
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<li><a href='#'>1</a></li>";
				$pagination.= "<li><a href='#'>2</a></li>";
				$pagination.= "<li class='dot'>...</li>";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li class='active-page'>$counter</li>";
					else
						$pagination.= "<li><a href='#'>$counter</a></li>"; 
				}
				$pagination.= "<li class='dot'>..</li>";
				$pagination.= "<li><a href='#'>$lpm1</a></li>";
				$pagination.= "<li><a href='#'>$lastpage</a></li>"; 
			}
			else
			{
				$pagination.= "<li><a href='#'>1</a></li>";
				$pagination.= "<li><a href='#'>2</a></li>";
				$pagination.= "<li class='dot'>..</li>";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li class='active-page'>$counter</li>";
					else
						$pagination.= "<li><a href='#'>$counter</a></li>"; 
				}
			}
		}

		$pagination.= "</ul>"; 
		if ($page < $counter - 1){
			$pagination .= '<div class="next-post"><a href="#" cpage="'.$page.'"  class="dt-next">'.__('Next', 'dt_themes').' <span class="fa fa-angle-double-right"></span></a></div>';
		}
		$pagination.= "</div>\n"; 
	} 
	return $pagination;
	
} 


add_action( 'wp_ajax_get_course_subcategories', 'get_course_subcategories' );
add_action( 'wp_ajax_nopriv_get_course_subcategories', 'get_course_subcategories' );

function get_course_subcategories() {
	
	$cat_id = $_REQUEST['cat_id'];
	
	$out = '';
	
	if($cat_id > 0) {
		
		$out .= '<select name="subcoursetype" id="dt-subcoursetype">';
		$out .= '<option value="0">'.__("Sub Course Type","dt_themes").'</option>';
				$sub_course_types = get_categories("taxonomy=course_category&hide_empty=1&parent={$cat_id}");
				foreach ( $sub_course_types as $sub_course_type ) {
					$id = esc_attr( $sub_course_type->term_id );
					$title = esc_html( $sub_course_type->name );
					$selected = isset($_REQUEST['subcoursetype']) ? $_REQUEST['subcoursetype'] : '';
					$out .= "<option value='{$id}' ".selected ( $selected, $id, false )." >{$title}</option>";
				}        
		$out .= '</select>';
	
	} else {
	
		$out .= '<select name="subcoursetype" id="dt-subcoursetype">';
		$out .= '<option value="0">'.__("Sub Course Type","dt_themes").'</option>';
		$out .= '</select>';
		
	}
	
	echo $out;
	die();
}

add_action("wp_ajax_dt_ajax_load_portfolio_posts", "dt_ajax_load_portfolio_posts");
add_action("wp_ajax_nopriv_dt_ajax_load_portfolio_posts", "dt_ajax_load_portfolio_posts");
function dt_ajax_load_portfolio_posts() {

	$out = '';
	
	$postid = $_REQUEST['postid'];
	$postperpage = $_REQUEST['postperpage'];
	$page = $_REQUEST['page'];
	$pagelayout = $_REQUEST['pagelayout'];
	$tax = (!empty($_REQUEST['tax'])) ? explode(',', $_REQUEST['tax']) : '';
	
	$tpl_default_settings = get_post_meta( $postid, '_tpl_default_settings', TRUE );
	$tpl_default_settings = is_array( $tpl_default_settings ) ? $tpl_default_settings  : array();
	
	$allow_space  =  array_key_exists("grid_space",$tpl_default_settings) ? " with-space " : " no-space ";
	$post_layout  =	 isset( $tpl_default_settings['portfolio-post-layout'] ) ? $tpl_default_settings['portfolio-post-layout'] : "one-half-column";
	
	$page_layout  = array_key_exists( "layout", $tpl_default_settings ) ? $tpl_default_settings['layout'] : "content-full-width";
	
	if($pagelayout == 'fullwidth') {
		$page_layout = 'fullwidth';
	}
	
	switch($post_layout):
		case 'one-half-column';
			$post_class = "gallery column dt-sc-one-half ";
			$columns = 2;
			$post_thumbnail = 'portfolio-two-column';
		break;
		
		case 'one-third-column':
			$post_class = "gallery column dt-sc-one-third ";
			$columns = 3;
			$post_thumbnail = 'portfolio-three-column';
		break;
	
		case 'one-fourth-column':
			$post_class = "gallery column dt-sc-one-fourth";
			$columns = 4;
			$post_thumbnail = 'portfolio-four-column';
		break;
	endswitch;			
	
	if($page_layout == 'fullwidth') $post_thumbnail .= '-fullwidth';
	elseif($page_layout == 'with-left-sidebar' || $page_layout == 'with-right-sidebar') $post_thumbnail .= '-single-sidebar';
	elseif($page_layout == 'both-sidebar') $post_thumbnail .= '-both-sidebar';
	
	$post_class .= " all-sort ";
	
	if($tax != ''):
		$args = array('post_type' => 'dt_portfolios', 'paged' => $page, 'posts_per_page' => $postperpage, 'post_status' => 'publish', 'offset' => ($postperpage * ($page-1)), 'tax_query' => array( array( 'taxonomy' => 'portfolio_entries', 'field' => 'id', 'terms' => $tax )));
	else:
		$args = array( 'paged' => $page ,'posts_per_page' => $postperpage,'post_type' => 'dt_portfolios', 'post_status' => 'publish', 'offset' => ($postperpage * ($page-1)));
	endif;
	
	$the_query = new WP_Query($args);
	if($the_query->have_posts()): 
		$i = 1;
		while($the_query->have_posts()): $the_query->the_post();
	
			$temp_class = $post_class;

			$the_id = get_the_ID();

			$portfolio_item_meta = get_post_meta($the_id,'_portfolio_settings',TRUE);
			$portfolio_item_meta = is_array($portfolio_item_meta) ? $portfolio_item_meta  : array();

			#Find sort class by using the portfolio_entries
			$sort = " ";
			if( array_key_exists("filter",$tpl_default_settings) ):
				$item_categories = get_the_terms( $the_id, 'portfolio_entries' );
				if(is_object($item_categories) || is_array($item_categories)):
					foreach ($item_categories as $category):
						$sort .= $category->slug.'-sort ';
					endforeach;
				endif;
			 endif;
			 
			$out .= '<div id="portfolio-'.$the_id.'" class="'.$temp_class.$sort.$allow_space.'">
					<figure>';
						$popup = "http://placehold.it/1160";
						if( array_key_exists('items_name', $portfolio_item_meta) ) {
							$item =  $portfolio_item_meta['items_name'][0];
							$popup = $portfolio_item_meta['items'][0];

							if( "video" === $item ) {
								$items = array_diff( $portfolio_item_meta['items_name'] , array("video") );
								if( !empty($items) ) {
									$out .= '<img src="'.$portfolio_item_meta['items'][key($items)].'" width="1160" height="1160" alt="" />';	
								} else {
									$out .= '<img src="http://placehold.it/1160" width="1160" height="1160" alt="" />';
								}
							} else {
								$attachment_id = dt_get_attachment_id_from_url($portfolio_item_meta['items'][0]);
								$img_attributes = wp_get_attachment_image_src($attachment_id, $post_thumbnail);
                                $out .= "<img src='".$img_attributes[0]."' width='".$img_attributes[1]."' height='".$img_attributes[2]."' />";
							}
						} else {
							$out .= '<img src="'.$popup.'" width="1160" height="1160" alt="" />';
						}
							
						$out .= '<div class="image-overlay">
							<span class="white-box"></span>
							<div class="image-overlay-text">
								<h4><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h4> 
								<span class="small-line"></span>';
								if( array_key_exists("sub-title",$portfolio_item_meta) ):
									$out .= '<p><a href="'.get_permalink().'">'.$portfolio_item_meta["sub-title"].'</a></p>';
								endif;
								$out .= '<ul class="links">
									<li><a href="'.$popup.'" class="zoom" data-gal="prettyPhoto[gallery]" title="'.get_the_title().'"><span class="hexagon"><span class="corner1"></span><span class="corner2"></span><i class="fa fa-search"></i></span></a></li>
									<li><a href="'.get_permalink().'" class="link" title="'.get_the_title().'"><span class="hexagon"><span class="corner1"></span><span class="corner2"></span><i class="fa fa-external-link"></i></span></a></li>
								</ul>
							</div>
							<span class="border-line"></span>
						</div>
							
					</figure>
				</div>';

        endwhile;
    else:
        echo 'NoData';
    endif;
	
	
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		#$result = json_encode($result);
		echo $out;
	} 
	else {
		header("Location: ".$_SERVER["HTTP_REFERER"]);
	}
	die();

}


add_action("wp_ajax_dt_ajax_load_blog_posts", "dt_ajax_load_blog_posts");
add_action("wp_ajax_nopriv_dt_ajax_load_blog_posts", "dt_ajax_load_blog_posts");
function dt_ajax_load_blog_posts() {

	$out = '';
	
	$postid = $_REQUEST['postid'];
	$page = $_REQUEST['page'];
	
	$tpl_default_settings = get_post_meta( $postid, '_tpl_default_settings', TRUE );
	$tpl_default_settings = is_array( $tpl_default_settings ) ? $tpl_default_settings  : array();
	
	$post_layout  =	 isset( $tpl_default_settings['blog-post-layout'] ) ? $tpl_default_settings['blog-post-layout'] : "one-third-column";
	$post_per_page = isset($tpl_default_settings['blog-post-per-page']) ? $tpl_default_settings['blog-post-per-page'] : -1;
	$categories = isset($tpl_default_settings['blog-post-exclude-categories']) ? array_filter($tpl_default_settings['blog-post-exclude-categories']) : NULL;
	
	$hide_date_meta = isset( $tpl_default_settings['disable-date-info'] ) ? " hidden " : "";
	$hide_comment_meta = isset( $tpl_default_settings['disable-comment-info'] ) ? " hidden " : " comments ";
	$hide_author_meta = isset( $tpl_default_settings['disable-author-info'] ) ? " hidden " : "";
	$hide_category_meta = isset( $tpl_default_settings['disable-category-info'] ) ? " hidden " : "";
	$hide_tag_meta = isset( $tpl_default_settings['disable-tag-info'] ) ? " hidden " : "tags";
	
	switch($post_layout):
		case 'one-column':
			$post_class = " column dt-sc-one-column blog-fullwidth";
			$columns = 1;
			$post_thumbnail = 'blog-one-column';
		break;
	
		case 'one-half-column';
			$post_class = " column dt-sc-one-half";
			$columns = 2;
			$container_class = "apply-isotope";
			$post_thumbnail = 'blog-two-column';
		break;
	
		case 'one-third-column':
			$post_class = " column dt-sc-one-third";
			$columns = 3;
			$container_class = "apply-isotope";
			$post_thumbnail = 'blog-three-column';
		break;
	endswitch;
	
	$page_layout  = array_key_exists( "layout", $tpl_default_settings ) ? $tpl_default_settings['layout'] : "content-full-width";
	if($page_layout == 'with-left-sidebar' || $page_layout == 'with-right-sidebar') $post_thumbnail .= '-single-sidebar';
	elseif($page_layout == 'both-sidebar') $post_thumbnail .= '-both-sidebar';
	
	if(!empty($categories)):
		$args = array('post_type' => 'post', 'paged' => $page, 'posts_per_page' => $post_per_page, 'post_status' => 'publish', 'post__not_in' => get_option( 'sticky_posts' ), 'category__not_in' => $categories);
	else:
		$args = array('post_type' => 'post', 'paged' => $page, 'posts_per_page' => $post_per_page, 'post_status' => 'publish', 'post__not_in' => get_option( 'sticky_posts' ) );
	endif;
		
query_posts($args);
if( have_posts() ):
	$i = 1;
	while( have_posts() ):
		the_post();

		$temp_class = "";
		if($i == 1) $temp_class = $post_class." first"; else $temp_class = $post_class;
		if($i == $columns) $i = 1; else $i = $i + 1;

		$format = get_post_format(  get_the_id() );
		$format_icons = array( 'status' => 'fa-comment', 'quote' => 'fa-quote-left', 'gallery' => 'fa-camera', 'image' => 'fa-image', 'video' => 'fa-film', 'audio' => 'fa-music', 'link' => 'fa-link', 'aside' => 'fa-align-left', 'chat' => 'fa-comments' );
		
		if(isset($format_icons[$format])) $format_icon = $format_icons[$format]; else $format_icon = 'fa-pencil';

		$class = get_post_class("blog-entry",  get_the_id());
		$class = implode(" ",$class);
		
		$out .= '<div class="'.$temp_class.'">
			<article id="post-'.get_the_ID().'" class="'.$class.'">';
            
				$post_meta = get_post_meta(get_the_id() ,'_dt_post_settings',TRUE);
                $post_meta = is_array( $post_meta ) ? $post_meta  : array();
				$pholder = dttheme_option('general', 'disable-placeholder-images');
				
				if($format == 'quote') {
                    $out .= '<div class="black-box">  
                        <div class="entry-body">';
                        	if( array_key_exists('quote', $post_meta) ) {
                                $out .= '<p><a href="'.get_permalink().'">'.$post_meta['quote'].'</a></p>';
                                if( array_key_exists('quoteby', $post_meta) ) {
                                    $out .= '<span>- '.$post_meta['quoteby'].'</span>';
                                }
                            }
                        $out .= '</div>
                        <div class="entry-details">';
							if(is_sticky()):
                                $out .= '<div class="featured-post"> <span class="fa fa-trophy"> </span> <span class="text">'. __('Featured','dt_themes').'</span></div>';
                            endif;
                            $out .= '<div class="entry-metadata">
                                 <h6 class="date '.$hide_date_meta.'">
                                     <span class="hexagon2">
                                        <span class="corner1"></span>
                                        <span class="corner2"></span>
                                        <i class="fa fa-calendar"></i>
                                     </span> ';
                                     $out .= get_the_date('d M Y');
                                 $out .= '</h6>
                                 <h6 class="author '.$hide_author_meta.'"> 
                                     <span class="hexagon2">
                                        <span class="corner1"></span>
                                        <span class="corner2"></span>
                                        <i class="fa fa-user"></i>
                                     </span> 
                                     <a href="'.get_author_posts_url(get_the_author_meta('ID')).'" title='.__('View all posts by ', 'dt_themes').get_the_author().'">'.get_the_author().'</a>
                                 </h6>
                                 <h6 class="'.$hide_comment_meta.'">
                                     <span class="hexagon2">
                                        <span class="corner1"></span>
                                        <span class="corner2"></span>
                                        <i class="fa fa-comments"></i>
									</span>
									';
									if((wp_count_comments(get_the_id())->approved) == 0)	$commtext = '0';
									else $commtext = wp_count_comments(get_the_id())->approved;
									$out .= '<a title="'.get_the_title().'" href="'.get_permalink().'#respond">'.$commtext.'</a>
								 </h6>
                                 <h6 class="category '.$hide_category_meta.'"> 
                                     <span class="hexagon2">
                                        <span class="corner1"></span>
                                        <span class="corner2"></span>
                                        <i class="fa fa-sitemap"></i>
                                     </span>';
									 $sep = ', '; $cat = '';
									 foreach((get_the_category()) as $category) { 
										$cat .= '<a title="'.$category->cat_name.'" href="'.get_category_link( $category->term_id ).'">'.$category->cat_name.'</a>'.$sep;
									 } 
									 $out .= rtrim($cat, ", ");
									$out .= '</h6>
                                 <h6 class="tags <?php echo $hide_tag_meta;?>"> 
                                     <span class="hexagon2">
                                        <span class="corner1"></span>
                                        <span class="corner2"></span>
                                        <i class="fa fa-tags"></i>
                                     </span> 
									 '.get_the_tag_list('', ', ', '').'
                                 </h6>
                            </div>
                        </div>
                     </div>';
				
				} else {
					
					if( !empty($format) ) {
						$out .= '<div class="entry-thumb">';
								if( $format === "image" ):
									$out .= '<a href="'.get_permalink().'" title="'.get_the_title().'">';
										if( get_the_post_thumbnail(get_the_ID(), $post_thumbnail) != '' ):
											$attachment_id = get_post_thumbnail_id(get_the_id());
											$img_attributes = wp_get_attachment_image_src($attachment_id, $post_thumbnail);
											$out .= "<img src='".$img_attributes[0]."' width='".$img_attributes[1]."' height='".$img_attributes[2]."' />";
										elseif($pholder != 'on'):
											$out .= '<img src="http://placehold.it/1160x822&text='.get_the_title().'" alt="'.get_the_title().'" title="'.get_the_title().'" />';
										endif;
									$out .= '</a>';
								elseif( $format === "gallery" && array_key_exists("items", $post_meta)):
										$out .= '<ul class="entry-gallery-post-slider">';
										foreach ( $post_meta['items'] as $item ) { 
											$attachment_id = dt_get_attachment_id_from_url($item);
											$img_attributes = wp_get_attachment_image_src($attachment_id, $post_thumbnail);
											$out .= "<li><img src='".$img_attributes[0]."' width='".$img_attributes[1]."' height='".$img_attributes[2]."' /></li>";
										}
										$out .= '</ul>';
								  elseif( $format === "video" && ( array_key_exists('oembed-url', $post_meta) || array_key_exists('self-hosted-url', $post_meta) ) ):
										if( array_key_exists('oembed-url', $post_meta) ):
											$out .= '<div class="dt-video-wrap">'.wp_oembed_get($post_meta['oembed-url']).'</div>';
										elseif( array_key_exists('self-hosted-url', $post_meta) ):
											$out .= '<div class="dt-video-wrap">'.apply_filters( 'the_content', $post_meta['self-hosted-url'] ).'</div>';
										endif;
								  elseif( $format === "audio" && (array_key_exists('oembed-url', $post_meta) || array_key_exists('self-hosted-url', $post_meta)) ):
										if( array_key_exists('oembed-url', $post_meta) ):
											$out .= wp_oembed_get($post_meta['oembed-url']);
										elseif( array_key_exists('self-hosted-url', $post_meta) ):
											$out .= apply_filters( 'the_content', $post_meta['self-hosted-url'] );
										endif;
								  else:
									$out .= '<a href="'.get_permalink().'" title="'.get_the_title().'">';
										if( get_the_post_thumbnail(get_the_ID(), "full") != '' ):
											$attachment_id = get_post_thumbnail_id(get_the_id());
											$img_attributes = wp_get_attachment_image_src($attachment_id, $post_thumbnail);
											$out .= "<img src='".$img_attributes[0]."' width='".$img_attributes[1]."' height='".$img_attributes[2]."' />";
										elseif($pholder != 'on'):
											$out .= '<img src="http://placehold.it/1160x822&text='.get_the_title().'" alt="'.get_the_title().'" title="'.get_the_title().'" />';
										endif;
									$out .= '</a>';
								endif;
						$out .= '</div>';
					}
                                
                $out .= '<div class="entry-details">
                    <div class="entry-title">
                        <span class="hexagon">
                            <span class="corner1"></span>
                            <span class="corner2"></span>
                            <i class="fa '.$format_icon.'"></i>
                        </span>
                        <h4><a href="'.get_permalink().'">'.get_the_title().'</a> </h4>
                    </div>
                    <div class="entry-body">';
                        if( array_key_exists('blog-post-excerpt',$tpl_default_settings) ):
                            $out .= '<p>'.dttheme_excerpt($tpl_default_settings['blog-post-excerpt-length']).'</p>';
                         else:
                            $out .= '<p>'.get_the_excerpt().'</p>';
                         endif;
                    $out .= '</div>';
                    if(is_sticky()):
                        $out .= '<div class="featured-post"> <span class="fa fa-trophy"> </span> <span class="text"> '.__('Featured','dt_themes').'</span></div>';
                    endif;
                    $out .= '<div class="entry-metadata">
                         <h6 class="date '.$hide_date_meta.'">
                             <span class="hexagon2">
                                <span class="corner1"></span>
                                <span class="corner2"></span>
                                <i class="fa fa-calendar"></i>
                             </span> 
                             '.get_the_date('d M Y').'
                         </h6>
                         <h6 class="author '.$hide_author_meta.'"> 
                             <span class="hexagon2">
                                <span class="corner1"></span>
                                <span class="corner2"></span>
                                <i class="fa fa-user"></i>
                             </span> 
                             <a href="'.get_author_posts_url(get_the_author_meta('ID')).'" title="'.__('View all posts by ', 'dt_themes').get_the_author().'">'.get_the_author().'</a>
                         </h6>
                         <h6 class="'.$hide_comment_meta.'">
                             <span class="hexagon2">
                                <span class="corner1"></span>
                                <span class="corner2"></span>
                                <i class="fa fa-comments"></i>
                            </span>
                            ';
							if((wp_count_comments(get_the_id())->approved) == 0)	$commtext = '0';
							else $commtext = wp_count_comments(get_the_id())->approved;
							$out .= '<a title="'.get_the_title().'" href="'.get_permalink().'#respond">'.$commtext.'</a>
                         </h6>
                         <h6 class="category '.$hide_category_meta.'"> 
                             <span class="hexagon2">
                                <span class="corner1"></span>
                                <span class="corner2"></span>
                                <i class="fa fa-sitemap"></i>
                             </span> ';
							 $sep = ', '; $cat = '';
							 foreach((get_the_category()) as $category) { 
								$cat .= '<a title="'.$category->cat_name.'" href="'.get_category_link( $category->term_id ).'">'.$category->cat_name.'</a>'.$sep;
							 } 
							 $out .= rtrim($cat, ", ");
                         $out .= '</h6>
                         <h6 class="tags '.$hide_tag_meta.'"> 
                             <span class="hexagon2">
                                <span class="corner1"></span>
                                <span class="corner2"></span>
                                <i class="fa fa-tags"></i>
                             </span> 
							 '.get_the_tag_list('', ', ', '').'
                         </h6>
                    </div>
                 </div>';                 
                       
            }
                                            
			$out .= '</article>
		</div>';

	endwhile;
else:
	$out = 'NoData';
endif;


	
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		#$result = json_encode($result);
		echo $out;
	} 
	else {
		header("Location: ".$_SERVER["HTTP_REFERER"]);
	}
	die();

}


function dt_get_attachment_id_from_url( $attachment_url = '' ) {
 
	global $wpdb;
	$attachment_id = false;
 
	if ($attachment_url == '')
		return false;
 
	$upload_dir_paths = wp_upload_dir();
 
	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
 
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
 
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
 
	}
 
	return $attachment_id;
	
}

?>