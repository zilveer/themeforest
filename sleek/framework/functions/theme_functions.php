<?php

/*------------------------------------------------------------
 * Theme Functions
 *------------------------------------------------------------*/




// Remove the <div> surrounding the dynamic navigation to cleanup markup
add_filter('wp_nav_menu_args', 'sleek_wp_nav_menu_args');

if( !function_exists( 'sleek_wp_nav_menu_args' ) ){
	function sleek_wp_nav_menu_args($args = '') {
		$args['container'] = false;
		return $args;
	}
}



// Remove invalid rel attribute values in the categorylist
add_filter('the_category', 'sleek_remove_category_rel_from_category_list');

if( !function_exists( 'sleek_remove_category_rel_from_category_list' ) ){
	function sleek_remove_category_rel_from_category_list($thelist) {
		return str_replace('rel="category tag"', 'rel="tag"', $thelist);
	}
}



/*------------------------------------------------------------
 * Body Classes
 *------------------------------------------------------------*/

add_filter('body_class', 'sleek_add_body_classes');

if( !function_exists( 'sleek_add_body_classes' ) ){
	function sleek_add_body_classes($classes) {
		global $post;
		$theme_settings = sleek_theme_settings();

		// add theme-name class
		$classes[] = sanitize_html_class('theme-sleek');

		// page slug to body class
		if (is_home()) {
			$key = array_search('blog', $classes);
			if ($key > -1) {
				unset($classes[$key]);
			}
		} elseif (is_page()) {
			$classes[] = sanitize_html_class($post->post_name);
		} elseif (is_singular()) {
			$classes[] = sanitize_html_class($post->post_name);
		}

		// post navigation true/false
		if( $theme_settings->posts['post_navigation'] ){
			$classes[] = 'post-navigation-true';
		}else{
			$classes[] = 'post-navigation-false';
		}

		// ajax page load true/false
		if( $theme_settings->general['ajax_load_pages'] ){
			$classes[] = 'js-ajax-load-pages';
		}else{
			$classes[] = 'js-ajax-load-pages--false';
		}

		// init preloader true/false
		if( $theme_settings->general['init_load_animation'] ){
			$classes[] = 'init-load-animation--true';
		}

		// layout style
		if( $theme_settings->layout['independent_sidebar'] ){
			$classes[] = 'independent-sidebar--true';
		}else{
			$classes[] = 'independent-sidebar--false';
		}

		// post centered
		if( $theme_settings->posts['post_centralized'] ){
			$classes[] = 'post-centered--true';
		}else{
			$classes[] = 'post-centered--false';
		}

		return $classes;
	}
}



/*------------------------------------------------------------
 * Layout Classes [significant for AJAX loading and page overrides]
 *------------------------------------------------------------*/

if( !function_exists( 'sleek_layout_classes' ) ){
	function sleek_layout_classes(){
		$theme_settings = sleek_theme_settings();
		$layout_classes = '';

		foreach( get_body_class() as $body_class ){
			$layout_classes .= ' ' . $body_class;
		}

		if($theme_settings->layout['use_sidebar']){
			$layout_classes .= ' sidebar--true';
		}else{
			$layout_classes .= ' sidebar--false';
		}

		if( get_post_meta( get_the_ID(), 'is_full_width', true ) ){
			$layout_classes .= ' full-width--true';
		}else{
			$layout_classes .= ' full-width--false';
		}

		return $layout_classes;
	}
}



// Remove wp_head() injected Recent Comment styles
add_action('widgets_init', 'sleek_my_remove_recent_comments_style');

if( !function_exists( 'sleek_my_remove_recent_comments_style' ) ){
	function sleek_my_remove_recent_comments_style() {
		global $wp_widget_factory;
		remove_action('wp_head', array(
			$wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
			'recent_comments_style'
		));
	}
}


/*------------------------------------------------------------
 * Skip wrapping p around custom shortcodes
 *
 * Source: https://gist.github.com/bitfade/4555047
 * Envato approves: http://themeforest.net/forums/thread/how-to-add-shortcodes-in-wp-themes-without-being-rejected/98804?page=4&message_id=996848#996848
 *------------------------------------------------------------*/

add_filter('the_content', 'sleek_shortcodes_formatter');
add_filter('widget_text', 'sleek_shortcodes_formatter');

if( !function_exists( 'sleek_shortcodes_formatter' ) ){
	function sleek_shortcodes_formatter($content) {
		$block = join( "|", array( "row", "column", "title", "separator", "slider", "image_slider", "blog", "progress_bar", "social", "highlighted-p" ) );

		$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
		$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)/","[/$2]",$rep);

		return $rep;
	}
}



/*------------------------------------------------------------
 * WP Posts: Pagination
 *------------------------------------------------------------*/

if( !function_exists( 'sleek_wp_pagination' ) ){
	function sleek_wp_pagination() {
		global $wp_query;

		$max_num_pages = $wp_query->max_num_pages;
		$current_page = get_query_var('paged') > 1 ? get_query_var('paged') : 1;

		// create classic pagination
		$big = 999999999;
		echo paginate_links(array(
			'base' => str_replace($big, '%#%', get_pagenum_link($big)),
			'format' => '?paged=%#%',
			'current' => max(1, $current_page),
			'total' => $max_num_pages,
			'prev_text'    => '<i class="icon-arrow-'.sleek_get_rtl('left').'"></i>' . __('Previous', 'sleek'),
			'next_text'    => __('Next', 'sleek') . '<i class="icon-arrow-'.sleek_get_rtl('right').'"></i>'
		));
	}
}



/*------------------------------------------------------------
 * WP Posts: Load More
 *------------------------------------------------------------*/

if( !function_exists( 'sleek_wp_load_more' ) ){
	function sleek_wp_load_more( $type = 'load_more' ){
		global $wp_query;

		$max_num_pages = $wp_query->max_num_pages;
		$current_page = get_query_var('paged') > 1 ? get_query_var('paged') : 1;

		// classes based on loading type
		if( $type == 'load_more' ){
			// if load more button
			$type_classes = ' pagination--load-more js-load-more--wp-loop';
		}else{
			// if auto load more
			$type_classes = ' pagination--load-more pagination--auto js-load-more--wp-loop js-auto-load-more--wp-loop';
		}

		// create load more button with universal markup for AJAX load
		$link = explode('"', get_next_posts_link());
		if( count($link)>1 ){
			echo '<a class="pagination js-skip-ajax '.$type_classes.'" href="'.$link[1].'" data-max="'.$max_num_pages.'" data-current="'.$current_page.'">'.__('Load More Posts','sleek').'</a>';
			echo '<div class="sleek-loader"></div>';
			echo '<div class="pagination-message">'. __('NO MORE POSTS', 'sleek').'</div>';
		}
	}
}



/*------------------------------------------------------------
 * Custom Excerpts
 *------------------------------------------------------------*/

// Create 20 Word Callback for Index page Excerpts, call using sleek_wp_excerpt('sleek_wp_index');
if( !function_exists( 'sleek_excerpt_length' ) ){
	function sleek_excerpt_length($length) {
		return 20;
	}
}

// Print the Custom Excerpts callback
if( !function_exists( 'sleek_wp_excerpt' ) ){
	function sleek_wp_excerpt( $length_callback = '', $use_more = true ) {
		$output = sleek_get_wp_excerpt($length_callback, $use_more);
		echo $output;
	}
}

// Create the Custom Excerpts callback and return only
if( !function_exists( 'sleek_get_wp_excerpt' ) ){
	function sleek_get_wp_excerpt( $length_callback = '', $use_more = true ) {
		global $post;
		if (function_exists($length_callback)) {
			add_filter('excerpt_length', $length_callback);
		}

		if( $use_more ){
			$more ='&nbsp;<a class="read-more" title="'.$post->post_title.'" href="' . get_permalink($post->ID) . '"></a>';
		}else{
			$more = '';
		}

		$output = get_the_excerpt();
		$output = apply_filters('wptexturize', $output);
		$output = apply_filters('convert_chars', $output);

		if( $output && $output != '' ){
			$output = '<p class="excerpt">' . $output . $more . '</p>';
			return $output;
		}
	}
}



// Custom View Article link to Post
add_filter('excerpt_more', 'sleek_view_article');

if( !function_exists( 'sleek_view_article' ) ){
	function sleek_view_article($more) {
		global $post;
		return '';
	}
}



// Remove 'text/css' from our enqueued stylesheet
add_filter('style_loader_tag', 'sleek_style_remove');

if( !function_exists( 'sleek_style_remove' ) ){
	function sleek_style_remove($tag) {
		return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
	}
}



// Remove width and height dynamic attributes to thumbnails
add_filter('post_thumbnail_html', 'sleek_remove_thumbnail_dimensions', 10);

if( !function_exists( 'sleek_remove_thumbnail_dimensions' ) ){
	function sleek_remove_thumbnail_dimensions( $html ) {
		$html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
		return $html;
	}
}



// Custom Gravatar in Settings > Discussion
add_filter('avatar_defaults', 'sleek_gravatar');

if( !function_exists( 'sleek_gravatar' ) ){
	function sleek_gravatar ($avatar_defaults) {
		$myavatar = THEME_IMG_URI . '/gravatar.jpg';
		$avatar_defaults[$myavatar] = "Custom Gravatar";
		return $avatar_defaults;
	}
}




/* Threaded Comments
 *------------------------------------------------------------*/

add_action('get_header', 'sleek_enable_threaded_comments');

if( !function_exists( 'sleek_enable_threaded_comments' ) ){
	function sleek_enable_threaded_comments() {
		if(
			!is_admin()
			&& is_singular()
			&& comments_open()
			&& ( get_option('thread_comments') == 1 )
		){
			wp_enqueue_script('comment-reply');
		}
	}
}



/* Ajax Post Comments
 *------------------------------------------------------------*/

add_action('comment_post', 'ajaxComment', 20, 2);

if( !function_exists( 'ajaxComment' ) ){
	function ajaxComment($comment_ID, $comment_status) {
		// If it's an AJAX-submitted comment
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

			// Get the comment data
			$comment = get_comment($comment_ID);

			// Default $args
			$args = array(
				'walker' => '',
				'max_depth' => '5',
				'style' => 'ul',
				'callback' => 'sleek_comments',
				'end-callback' =>'',
				'type' => 'comment',
				'page' => '0',
				'per_page' => '0',
				'avatar_size' => '32',
				'reverse_top_level' => '',
				'reverse_children' => '',
				'format' => 'xhtml',
				'short_ping' => '',
				'echo' => '1',
				'has_children' => ''
			);

			// Get the comment HTML with default $args and $depth = 1
			$comment_content = sleek_comments($comment, $args, 1);
			// Kill the script, returning the comment HTML
			die($comment_content.'</li>');
		}
	}
}



/*------------------------------------------------------------
 * If featured posts active, exclude/remove them from main loop on homepage
 *------------------------------------------------------------*/

add_action( 'pre_get_posts', 'sleek_remove_featured_posts_from_homepage_loop' );

if( !function_exists( 'sleek_remove_featured_posts_from_homepage_loop' ) ){
	function sleek_remove_featured_posts_from_homepage_loop($query){
		$theme_settings = sleek_theme_settings();
		$featured_count = (int)$theme_settings->posts['featured_count'];

		if($featured_count == 0){
			$featured_count = -1;
		}

		if (
			$theme_settings->posts['featured_category']
			&& $theme_settings->posts['featured_exclude']
			&& $query->is_home()
			&& $query->is_main_query()
		){

			// Get the exact posts displayed as featured
			$featured_post_ids = get_posts( array(
					'numberposts'	=> $featured_count,
					'category'		=> $theme_settings->posts['featured_category'],
					'fields'			=> 'ids', // Only get post IDs
			));

			// Exclude the exact featured posts
			$query->set( 'post__not_in', $featured_post_ids );
		}

	}
}



/*------------------------------------------------------------
 * Split background setting
 *------------------------------------------------------------*/

if( !function_exists( 'sleek_split_bg_setting' ) ){
	function sleek_split_bg_setting($string, $attr){
		$matches = explode('; background-size:', $string);
		$bg = $matches[0];
		if(count($matches)>1){
			$bg_size = $matches[1];
		}else{
			$bg_size = 'auto,auto';
		}

		if($attr == 'bg'){
			// if bg empty, return transparent for valid css
			$bg = $bg == '' ? 'transparent' : $bg;
			return $bg;
		}

		if($attr == 'bg_size'){
			return $bg_size;
		}
	}
}



/*------------------------------------------------------------
 * Split font style into weight and style
 *------------------------------------------------------------*/

if( !function_exists( 'sleek_split_font_style' ) ){
	function sleek_split_font_style($string, $attr){
		$matches = preg_split('#(?<=\d)(?=[a-z])#i', $string);

		if(count($matches)>1){
			$weight = $matches[0];
			$style = $matches[1];
		}else{
			if(($matches[0]=='italic')||($matches[0]=='regular')){
				$weight = '400';
				$style = $matches[0];
			}else{
				$weight = $matches[0];
				$style = 'regular';
			}
		}

		if($attr == 'weight'){
			return $weight;
		}

		if($attr == 'style'){
			if($style=='regular'){
				$style = 'normal';
			}
			return $style;
		}
	}
}



/*------------------------------------------------------------
 * Combine google font settings into URL for enqueue
 *------------------------------------------------------------*/

if( !function_exists( 'sleek_get_google_fonts_embed_url' ) ){
	function sleek_get_google_fonts_embed_url(){
		$theme_settings = sleek_theme_settings();
		$request_url = '';
		$request_url .= '//fonts.googleapis.com/css?family=';

		foreach($theme_settings->typo as $key => $value){

			if( !$value[0] ){ return; }

			$request_url .= str_replace(' ', '+', $value[0]);
			$request_url .= ':';
			$request_url .= $value[1];

			// on body font add additional styles for general usage
			if($key == 'body'){
				$request_url .= ',100,100italic,200,200italic,300,300italic,regular,italic,700,700italic';
			}

			$request_url .= '|';
		}

		$request_url .= sleek_google_font_subset();
		return $request_url;
	}
}

/* Customize google font character sets
 *------------------------------------------------------------*/

if( !function_exists( 'sleek_google_font_subset' ) ){
	function sleek_google_font_subset(){
		$subset = '';

		// this was used to manually extend the function via child-theme
		// $subset .= '&subset=latin,greek-ext,greek';

		// new theme option: set character sets
		$theme_settings = sleek_theme_settings();
		$subset .= str_replace(' ', '', '&subset='.$theme_settings->character_sets);

		return $subset;
	}
}



/*------------------------------------------------------------
 * Add ID Column in admin panel and style it
 *------------------------------------------------------------*/

add_filter('manage_posts_columns', 'sleek_posts_columns_id', 10);
add_action('manage_posts_custom_column', 'sleek_posts_custom_id_columns', 10, 2);
add_filter('manage_pages_columns', 'sleek_posts_columns_id', 10);
add_action('manage_pages_custom_column', 'sleek_posts_custom_id_columns', 10, 2);
add_filter('manage_media_columns', 'sleek_posts_columns_id', 10);
add_action('manage_media_custom_column', 'sleek_posts_custom_id_columns', 10, 2);
add_action('admin_head', 'sleek_posts_columns_id_style');

if( !function_exists( 'sleek_posts_columns_id' ) ){
	function sleek_posts_columns_id($columns){
		return array_merge( $columns, array('post_id' => __('ID', 'sleek')) );
	}
}

if( !function_exists( 'sleek_posts_custom_id_columns' ) ){
	function sleek_posts_custom_id_columns($column_name, $post_id){
		if($column_name === 'post_id'){
			echo $post_id;
		}
	}
}

if( !function_exists( 'sleek_posts_columns_id_style' ) ){
	function sleek_posts_columns_id_style() {
		echo '<style type="text/css">th#post_id{width:60px;}</style>';
	}
}



/*------------------------------------------------------------
 * Add Social Links for Authors
 *------------------------------------------------------------*/

add_filter('user_contactmethods','sleek_contactmethods',10,1);

if( !function_exists( 'sleek_contactmethods' ) ){
	function sleek_contactmethods( $contactmethods ) {
		$contactmethods['soc_shortcode'] = __( 'Social Links Shortcode', 'sleek' );
		return $contactmethods;
	}
}



/*------------------------------------------------------------
 * Wrap oEmbed into sleek custom container for responsive embeds
 *------------------------------------------------------------*/

add_filter('embed_oembed_html', 'sleek_wrap_oembed', 10, 3);

if( !function_exists( 'sleek_wrap_oembed' ) ){
	function sleek_wrap_oembed($html, $url, $attr) {

		preg_match( "/^(?:https?)?(?::?\/\/)?(?:(?:www)?\.?)(.*)\.(?:com|io|net|org|de|uk|tv|co)/", $url, $matches );

		$class = $matches[1] ? 'domain-'.$matches[1] : '';

		return '<div class="sleek-embed-container '.$class.'">'.$html.'</div>';
	}
}



/*------------------------------------------------------------
 * Support Empty Widget Title
 *------------------------------------------------------------*/

add_filter('widget_title','sleek_empty_widget_title');

if( !function_exists( 'sleek_empty_widget_title' ) ){
	function sleek_empty_widget_title($title){
		$titleNew = trim($title);
		if( !$titleNew || $titleNew == ''){
			return null;
		}else{
			return $title;
		}
	}
}



/*------------------------------------------------------------
 * Return correct left/right based on is_rtl()
 *------------------------------------------------------------*/

if( !function_exists( 'sleek_get_rtl' ) ){
	function sleek_get_rtl( $dir ) {

		if( is_rtl() ){
			if( $dir == 'left' ){
				$dir = 'right';
			}elseif( $dir == 'right' ){
				$dir = 'left';
			}
		}

		return $dir;
	}
}



/*------------------------------------------------------------
 * Open Graph Facebook Meta Tags
 *------------------------------------------------------------*/

add_action( 'wp_head', 'sleek_open_graph_meta' );

if( !function_exists( 'sleek_open_graph_meta' ) ){
	function sleek_open_graph_meta() {

		$theme_settings = sleek_theme_settings();

		// Facebook meta
		if( is_single() && $theme_settings->general['open_graph_use'] ){

			$title = get_the_title();
			$excerpt = get_the_excerpt();
			$url = get_the_permalink();

			$imgs = array();
			$feat_img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'xl' );

			if($feat_img){
				$imgs[] = $feat_img[0];
			}else{
				$content = apply_filters('the_content',get_post()->post_content);
				preg_match_all('/<img.*src=[\'\"](.*?)[\'\"]/', $content, $matches);
				$imgs = array_merge($imgs, $matches[1]);
			}

		?>
			<meta property="og:title" content="<?php echo $title; ?>" />
			<meta property="og:description" content="<?php echo $excerpt; ?>" />
			<meta property="og:url" content="<?php echo $url; ?>" />
		<?php
			foreach($imgs as $img){
				echo "<meta property='og:image' content='{$img}' />";
			}
		}
	}
}




/*------------------------------------------------------------
 * Include inline scripts
 *------------------------------------------------------------*/

add_action( 'wp_head', 'sleek_inline_js', 1 );

if( !function_exists( 'sleek_inline_js' ) ){
	function sleek_inline_js(){

		// Pass the base site url to sleek's javascript
		$base_url = get_site_url();
		echo '<script>if( typeof sleek === "undefined" ){ var sleek = {}; } sleek.baseUrl = "'. $base_url .'";</script>' . "\n";
	}
}
