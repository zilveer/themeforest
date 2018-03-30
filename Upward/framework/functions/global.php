<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	1 - GLOBAL

		1.1 - Content width
		1.2 - Automatic RSS feeds
		1.3 - Localization
		1.4 - Thumbnails
		1.5 - Editor styles
		1.6 - Custom Background
		1.7 - Custom Header

	2 - FILTERS

		2.1 - Header meta
		2.2 - Favicon
		2.3 - Excerpt in search results
		2.4 - JS misc data
		2.5 - Browser name as body class

	3 - ACTIONS

		3.1 - Replace CSS class in Custom Menu widget
		3.2 - Tag widget fix
		3.3 - Remove rel attribute for validation

	4 - FUNCTIONS
		
		4.1 - Get post meta
		4.2 - Get post terms
		4.3 - Get page id by template
		4.4 - Get the Redirect page
		4.5 - Logo
		4.6 - Drop-down menu
		4.7 - Dummy data for Sidebar
		4.8 - Display Sidebar
		4.9 - Prev/Next post link
		4.10 - Post meta
		4.11 - Fallback theme notice

*/

/*= 1 ===========================================

	G L O B A L
	Required WordPress settings

===============================================*/

	global
		$st_Options,
		$st_Settings;



	/*-------------------------------------------
		1.1 - Content width
	-------------------------------------------*/

	$content_width = $st_Options['global']['content_width'];



	/*-------------------------------------------
		1.2 - Automatic RSS feeds
	-------------------------------------------*/

	if ( $st_Options['global']['rss'] ) {
		add_theme_support( 'automatic-feed-links' ); }



	/*-------------------------------------------
		1.3 - Localization
	-------------------------------------------*/

	function st_textdomain() {
	
		global
			$st_Options;
	
			if ( $st_Options['global']['lang'] ) {
				load_theme_textdomain( 'strictthemes', get_template_directory() . '/assets/lang' ); }
	
	}
	
	add_action( 'after_setup_theme', 'st_textdomain' );



	/*-------------------------------------------
		1.4 - Thumbnails
	-------------------------------------------*/

	// Thumbs
	if ( function_exists( 'add_image_size' ) ) {

		foreach ( $st_Options['global']['images'] as $key => $value ) {

			if ( $st_Options['global']['images'][$key]['status'] ) { 

				// Normal size	
				$st_['width'] = $st_Options['global']['images'][$key]['width'];
				$st_['height'] = $st_Options['global']['images'][$key]['height'];
				$st_['crop'] = $st_Options['global']['images'][$key]['crop'] ? true : false;
	
				add_image_size( $key, $st_['width'], $st_['height'], $st_['crop'] );

				// HiDPI size
				if ( function_exists( 'st_kit' ) ) {

					if ( $st_Options['panel']['misc']['hidpi'] && !isset( $st_Settings['hidpi'] ) || !empty( $st_Settings['hidpi'] ) != 'no' ) {
	
						$st_['width'] = $st_Options['global']['images'][$key]['width'] * 2;
						$st_['height'] = $st_Options['global']['images'][$key]['height'] * 2;
			
						add_image_size( $key . '-2x', $st_['width'], $st_['height'], $st_['crop'] );
	
					}

				}

			}

		}

	}

	add_theme_support( 'post-thumbnails' );



	/*-------------------------------------------
		1.5 - Editor styles
	-------------------------------------------*/

	function my_theme_add_editor_styles() {
		add_editor_style( 'style.css' );
	}

	add_action( 'init', 'my_theme_add_editor_styles' );



	/*-------------------------------------------
		1.6 - Custom Background
	-------------------------------------------*/

	if ( $st_Options['global']['custom-background'] ) {

		$st_['custom_background_cb'] = function_exists( 'st_custom_background_cb' ) ? 'st_custom_background_cb' : '_custom_background_cb';

		$st_['args'] = array(
			'default-color'			=> isset($st_Options['panel']['style']['general']['colors']['default']) ? $st_Options['panel']['style']['general']['colors']['default'] : $st_Options['panel']['style']['general']['colors']['primary']['hex'],
			'default-image'			=> !empty( $st_Options['panel']['style']['general']['background-image'] ) ? get_template_directory_uri() . '/assets/images/' . $st_Options['panel']['style']['general']['background-image'] : '',
			'wp-head-callback'		=> $st_['custom_background_cb'],
		);

		add_theme_support( 'custom-background', $st_['args'] );

	}



	/*-------------------------------------------
		1.7 - Custom Header
	-------------------------------------------*/

	if ( $st_Options['global']['custom-header'] ) {

		$st_['args'] = array();

		add_theme_support( 'custom-header', $st_['args'] );

	}



/*= 2 ===========================================

	F I L T E R S
	Permanent custom filters

===============================================*/

	/*-------------------------------------------
		2.1 - Header meta
	-------------------------------------------*/

	function st_head_meta() {

		$array = array (
			"<meta charset='UTF-8' />",
			"<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1' />",
			"<meta name='dcterms.audience' content='Global' />"
			);

		foreach ( $array as $key ) {
			echo $key . "\n"; }

	}

	add_filter( 'wp_head', 'st_head_meta', 1 );



	/*-------------------------------------------
		2.2 - Favicon
	-------------------------------------------*/

	function st_favicon() {

		global
			$st_Settings;

			$icon = !empty( $st_Settings['favicon'] ) ? $st_Settings['favicon'] : get_template_directory_uri() . '/favicon.ico';

			echo "<link rel='Shortcut Icon' href='" . $icon . "' type='image/x-icon' />\n";

	}

	add_filter( 'wp_head', 'st_favicon' );



	/*-------------------------------------------
		2.3 - Excerpt in search results
	-------------------------------------------*/

	if ( $st_Options['global']['excerpt-in-search'] && is_search() ) {

		function st_search_where( $where ) {

			return preg_replace( "/post_title\s+LIKE\s*(\'[^\']+\')/", "post_title LIKE $1) OR (post_excerpt LIKE $1", $where );

		}

		add_filter( 'posts_where', 'st_search_where' );

	}


	/*-------------------------------------------
		2.4 - JS misc data
	-------------------------------------------*/

	function st_js_data() {

		global
			$st_Options,
			$st_Settings;

			/*
				stData[0] - Primary color
				stData[1] - Secondary color
				stData[2] - Template URL
				stData[3] - Site URL
			*/

			/*--- Primary color ------------------------------*/

			$color = $st_Options['panel']['style']['general']['colors']['primary']['hex'];
				$primary = ( !empty( $st_Settings['color-primary'] ) && function_exists( 'st_kit' ) ) ? $st_Settings['color-primary'] : $color;

			/*--- Secondary color ------------------------------*/

			$color = $st_Options['panel']['style']['general']['colors']['secondary']['hex'];
				$secondary = ( !empty( $st_Settings['color-secondary'] ) && function_exists( 'st_kit' ) ) ? $st_Settings['color-secondary'] : $color;

			?><script type='text/javascript'>/* <![CDATA[ */var stData = new Array();
			stData[0] = "<?php echo $primary ?>";
			stData[1] = "<?php echo $secondary ?>";
			stData[2] = "<?php echo get_template_directory_uri() ?>";
			stData[3] = "<?php echo get_site_url() ?>";/* ]]> */</script><?php echo "\n";

	}

	add_filter( 'wp_footer', 'st_js_data' );



	/*-------------------------------------------
		2.5 - Browser name as body class
	-------------------------------------------*/

	function st_browser_body_class( $classes ) {

		global
			$is_lynx,
			$is_gecko,
			$is_IE,
			$is_opera,
			$is_NS4,
			$is_safari,
			$is_chrome,
			$is_iphone;

		if ( $is_lynx ) {
			$classes[] = 'lynx'; }

		elseif ( $is_gecko ) {
			$classes[] = 'gecko'; }

		elseif ( $is_opera ) {
			$classes[] = 'opera'; }

		elseif ( $is_NS4 ) {
			$classes[] = 'ns4'; }

		elseif ( $is_safari ) {
			$classes[] = 'safari'; }

		elseif ( $is_chrome ) {
			$classes[] = 'chrome'; }

		elseif ( $is_IE ) {
			$classes[] = 'ie'; }

		elseif ( $is_iphone ) {
			$classes[] = 'iphone'; }

		else {
			$classes[] = 'unknown'; }

		return
			$classes;

	}

	add_filter( 'body_class', 'st_browser_body_class' );



/*= 3 ===========================================

	A C T I O N S
	Permanent custom actions

===============================================*/

	/*-------------------------------------------
		3.1 - Replace CSS class in Custom Menu widget
	-------------------------------------------*/

	function st_class_custom_menu( $args = array() ) {

		$args['menu_class'] = 'widget_custom_menu';

		return $args;
	}

	add_action( 'wp_nav_menu_args', 'st_class_custom_menu' );



	/*-------------------------------------------
		3.2 - Tag widget fix
	-------------------------------------------*/

	function st_tag_cloud( $args = array() ) {

		global
			$st_Options;

			$args['smallest'] = $st_Options['global']['tag-cloud'];
			$args['largest'] = $st_Options['global']['tag-cloud'];
			$args['unit'] = 'px';
			$args['separator'] = '';
			$args['orderby'] = 'count';
			$args['order'] = 'DESC';

		return
			$args;

	}

	add_action( 'widget_tag_cloud_args', 'st_tag_cloud' );



	/*-------------------------------------------
		3.3 - Remove rel attribute for validation
	-------------------------------------------*/

	function remove_category_list_rel( $output ) {

		return str_replace( ' rel="category tag"', '', $output );

	}
	 
	add_filter( 'wp_list_categories', 'remove_category_list_rel' );
	add_filter( 'the_category', 'remove_category_list_rel' );



/*= 4 ===========================================

	F U N C T I O N S
	Permanent custom functions

===============================================*/

	/*-------------------------------------------
		4.1 - Get post meta
	-------------------------------------------*/

	function st_get_post_meta( $post_id, $key, $single, $default ) {

		$meta = get_post_meta( $post_id, $key, $single );
		$meta = $meta ? $meta : $default;

		return $meta;

	}



	/*-------------------------------------------
		4.2 - Get post terms
	-------------------------------------------*/

	function st_wp_get_post_terms( $post, $taxonomy, $link = true ) {

		$out = '';
		$terms = wp_get_post_terms( $post, $taxonomy );

		if ( is_array( $terms ) ) {

			foreach ( $terms as $term ) {

				if ( $link ) {
					$out .= '<a href="' . get_term_link( $term, $taxonomy ) . '">' . $term->name . '</a>, '; }

				else {
					$out .= $term->name . ', '; }

			}

			$out = substr( $out, 0, -2 ); // Cut last comma

		}

		return $out;

	}



	/*-------------------------------------------
		4.3 - Get page id by template
	-------------------------------------------*/

	function st_get_page_by_template( $filename ) {

		$pages = get_pages(
			array(
				'meta_key'		=> '_wp_page_template',
				'meta_value'	=> $filename . '.php'
				)
		);

		$id = '';

		foreach ( $pages as $page ) {
			$id = $page->ID; }

		return $id;

	}



	/*-------------------------------------------
		4.4 - Get the Redirect page
	-------------------------------------------*/

	function st_get_redirect_page_url() {

		$pages = get_pages(
			array(
				'meta_key'		=> '_wp_page_template',
				'meta_value'	=> 'go.php'
				)
		);
	
		foreach ( $pages as $page ) {
			$go_url = get_permalink( $page->ID ); }
	
		$go_url = isset( $go_url ) ? $go_url . '?' : get_template_directory_uri() . '/go.php?';

		return $go_url;

	}



	/*-------------------------------------------
		4.5 - Logo
	-------------------------------------------*/

	function st_logo() {

		if ( function_exists( 'st_kit' ) ) {

			global
				$st_Options,
				$st_Settings;
	
				$logo_type = !empty( $st_Settings['logo_type'] ) ? $st_Settings['logo_type'] : 'image';
				$text = !empty( $st_Settings['sitename'] ) ? $st_Settings['sitename'] : $st_Options['general']['label'];
				$logo = $logo_type == 'image' && !empty( $st_Settings['logo'] ) ? $st_Settings['logo'] : get_template_directory_uri() . '/assets/images/logo.png';

				if ( $st_Options['panel']['misc']['hidpi'] && !isset( $st_Settings['hidpi'] ) || !empty( $st_Settings['hidpi'] ) != 'no' ) {
					$logo2x = ' data-hidpi="' . ( !empty( $st_Settings['logo2x'] ) ? esc_url( $st_Settings['logo2x'] ) : get_template_directory_uri() . '/assets/images/logo2x.png' ) . '"'; }

				else {
					$logo2x = ''; }

				// Image
				if ( $logo_type == 'image' ) {
					echo '<h2><a href="' . home_url() . '"><img src="' . $logo . '"' . $logo2x . ' alt="' . $text . '"/></a></h2>'; }
	
				// Text or Default
				else {
					echo '<h2><a href="' . home_url() . '">' . $text . '</a></h2>'; }

		}

		else {

			// Standard Site name
			echo '<h2><a href="' . home_url() . '">' . get_bloginfo( 'sitename' ) . '</a></h2>';

		}

	}



	/*-------------------------------------------
		4.6 - Drop-down menu
	-------------------------------------------*/

	function st_the_menu_drop_down() {

		global
			$st_Settings;

			if ( !isset( $st_Settings['layout_type'] ) || !empty( $st_Settings['layout_type'] ) && $st_Settings['layout_type'] != 'standard' ) {
				st_menu_drop_down(); }

		return;

	}



	/*-------------------------------------------
		4.7 - Dummy data for Sidebar
	-------------------------------------------*/

	function st_sidebar_dummy( $tag, $name ) {

		echo
			"\n" . '<div class="widget">' .

				"\n" . '<'.$tag.'>' . $name . '</'.$tag.'>' .
	
				"\n" . '<p>' . sprintf( esc_attr__( 'Drop a widget on "%s" sidebar at Appearance > Widgets page.', 'strictthemes' ), $name ) . '</p>' .

			"\n" . '</div>';

	}



	/*-------------------------------------------
		4.8 - Display Sidebar
	-------------------------------------------*/

	function st_get_sidebar( $name ) {

		echo '<div id="sidebar"><div class="sidebar">';

			if ( function_exists('dynamic_sidebar') && dynamic_sidebar( $name ) );

		echo '</div></div>';

	}



	/*-------------------------------------------
		4.9 - Prev/Next post link
	-------------------------------------------*/

	function st_prev_next_post() {

		$prev = get_previous_post();
		$next = get_next_post();

		$prev_link = $prev ? '<a class="p tooltip" title="' . __( 'Previous', 'strictthemes' ) . '" href="' . get_permalink( $prev->ID ) . '">' . $prev->post_title . '</a>' : '';
		$next_link = $next ? '<a class="n tooltip" title="' . __( 'Next', 'strictthemes' ) . '" href="' . get_permalink( $next->ID ) . '">' . $next->post_title . '</a>' : '';

		if ( $prev_link || $next_link ) {
			return '<div id="pre_next_post">' . $prev_link . $next_link . '<div class="clear"><!-- --></div></div>'; }

		else {
			return; }

	}



	/*-------------------------------------------
		4.10 - Post meta
	-------------------------------------------*/

	function st_post_meta(
			$format		= true,
			$date		= true,
			$category	= true,
			$comments	= true,
			$tags		= true,
			$views		= false,
			$permalink	= false
		) {

		global
			$st_Options,
			$st_Settings,
			$post;

			$st_ = array();

			// Post type names
			$st_['st_post'] = !empty( $st_Settings['ctp_post'] ) ? $st_Settings['ctp_post'] : $st_Options['ctp']['post'];
			$st_['st_category'] = !empty( $st_Settings['ctp_category'] ) ? $st_Settings['ctp_category'] : $st_Options['ctp']['category'];
			$st_['st_tag'] = !empty( $st_Settings['ctp_tag'] ) ? $st_Settings['ctp_tag'] : $st_Options['ctp']['tag'];

			// Post format
			$st_['format'] = ( get_post_format( $post->ID ) && $st_Options['global']['post-formats'][get_post_format( $post->ID )]['status'] ) ? get_post_format( $post->ID ) : 'standard';

			?>

				<div class="meta">
			
					<?php
			
						// If meta enabled
						if ( !isset( $st_Settings['post_meta'] ) || !empty( $st_Settings['post_meta'] ) && $st_Settings['post_meta'] == 'yes' ) {


							/*-------------------------------------------
								4.10.1 - Post format
							-------------------------------------------*/

							if ( $format == true && function_exists( 'st_kit' ) ) {

								if ( $st_['format'] != 'standard' ) {

									$st_['format_label'] = $st_Options['global']['post-formats'][$st_['format']]['label'];

									echo '<span class="ico16 ico16-' . $st_['format'] . '"><a href="' . get_post_format_link( $st_['format'] ) . '">' . $st_['format_label'] . '</a></span>';

								}

							}


							/*-------------------------------------------
								4.10.2 - Date
							-------------------------------------------*/

							if ( $date == true ) {

								echo '<span class="ico16 ico16-calendar">';
				
									if ( !empty( $st_Settings['nice_time'] ) && $st_Settings['nice_time'] == 'yes' && function_exists( 'st_niceTime' ) ) {
										$st_['date'] = st_niceTime( $post->post_date_gmt ); }
				
									else {
										$st_['date'] = get_the_time( get_option('date_format'), $post->ID ); }
				
									if ( is_single() ) {
										echo $st_['date']; }

									else {
										echo '<a href="' . get_permalink() . '">' . $st_['date'] . '</a>'; }
				
								echo '</span>';

							}

				
							/*-------------------------------------------
								4.10.3 - Comments
							-------------------------------------------*/

							if ( $comments == true ) {
								if ( !empty( $st_Settings['post_comments'] ) && $st_Settings['post_comments'] == 'yes' && comments_open() ) { ?>
									<span class="ico16 ico16-comment-2"><?php comments_popup_link( __( 'Leave a reply', 'strictthemes' ), __( '1 Comment', 'strictthemes' ), __( '% Comments', 'strictthemes' ), '', '' ); ?></span><?php
								}
							}


							/*-------------------------------------------
								4.10.4/5 - Category & Tags
							-------------------------------------------*/

							if ( $post->post_type != 'page' ) {

								// If project
								if ( get_post_type() == $st_['st_post'] ){
	
									if ( $category == true && $st_['posted_in'] = st_wp_get_post_terms( $post->ID, $st_['st_category'] ) ) {
										echo '<span class="ico16 ico16-folder">' . $st_['posted_in'] . '</span>'; }
	
									if ( $tags == true && $st_['tagged_by'] = st_wp_get_post_terms( $post->ID, $st_['st_tag'] ) ) {
										echo '<span class="ico16 ico16-tag">' . $st_['tagged_by'] . '</span>'; }
	
								}
	
								// If post
								else {

									if ( $category == true ) { ?>
										<span class="ico16 ico16-folder"><?php the_category(', ') ?></span><?php }

									if ( $tags == true ) {
										the_tags('<span class="ico16 ico16-tag">', ', ', '</span>'); }
	
								}

							}


							/*-------------------------------------------
								4.10.6 - Views
							-------------------------------------------*/

							if ( $views == true ) {
								if ( !empty( $st_Settings['post_views'] ) && $st_Settings['post_views'] == 'yes' && function_exists( 'st_getPostViews' ) ) {
									echo '<span class="ico16 ico16-views">' . st_getPostViews( $post->ID ) . '</span>'; }
							}


							/*-------------------------------------------
								4.10.7 - Permalink
							-------------------------------------------*/

							if ( $permalink == true ) { ?>
								<span class="ico16 ico16-link"><a href="<?php the_permalink(); ?>"><?php the_permalink(); ?></a></span><?php }


						}
				
					?>
			
				</div><!-- .meta --><?php

	}



	/*-------------------------------------------
		4.11 - Fallback theme notice
	-------------------------------------------*/

	function st_fallback_theme_notice() {

		global
			$st_; ?>
	
			<div class="updated">
				<p>
					<?php echo !empty($st_['fallback_theme_notice']) ? $st_['fallback_theme_notice'] : ':)' ?>
				</p>
			</div><?php

	}


?>