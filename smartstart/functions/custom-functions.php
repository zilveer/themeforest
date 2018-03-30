<?php

/* ---------------------------------------------------------------------- */
/*	Show main navigation
/* ---------------------------------------------------------------------- */

if( !function_exists('ss_framework_main_navigation') ) {

	function ss_framework_main_navigation() {

		global $post, $wp_query;

		$defaults = array(
			'container'      => false,
			'theme_location' => 'primary_nav',
			'walker'         => new ss_framework_description_walker()
		);

		if ( get_query_var('post_type') == 'portfolio' || get_query_var('taxonomy') == 'portfolio-categories' ) {

			$temp_post = $post;
			$temp_query = $wp_query;
			$wp_query = null;

			$wp_query = new WP_Query();
			$wp_query->query( array( 'page_id' => of_get_option('ss_portfolio_parent') ) );
			wp_nav_menu( $defaults );

			$wp_query = null;
			$wp_query = $temp_query;
			$post = $temp_post;

		} else {

			wp_nav_menu( $defaults );
			
		}

	}

}

/* ---------------------------------------------------------------------- */
/*	Create main navigation descriptions
/* ---------------------------------------------------------------------- */

class ss_framework_description_walker extends Walker_Nav_Menu {

	function start_el(&$output, $item, $depth, $args) {

		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';

		$attributes  = !empty( $item->attr_title )                                         ? ' title="'            . esc_attr( $item->attr_title  ) .'"' : '';
		$attributes .= !empty( $item->target )                                             ? ' target="'           . esc_attr( $item->target      ) .'"' : '';
		$attributes .= !empty( $item->xfn )                                                ? ' rel="'              . esc_attr( $item->xfn         ) .'"' : '';
		$attributes .= !empty( $item->url )                                                ? ' href="'             . esc_attr( $item->url         ) .'"' : '';
		$attributes .= !empty( $item->description ) && strlen( $item->description ) <= 100 ? ' data-description="' . esc_attr( $item->description ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

	}

}

/* ---------------------------------------------------------------------- */
/*	The current post—date/time
/* ---------------------------------------------------------------------- */

if( !function_exists('ss_framework_posted_on') ) {

	function ss_framework_posted_on() {

		return sprintf( __( '<a href="%1$s" title="%2$s" rel="bookmark"><time datetime="%3$s" pubdate>%4$s</time></a>', 'ss_framework' ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( get_option('time_format') ) ),
			esc_html( get_the_date( get_option('date_format') ) )
		);

	}

}

/* ---------------------------------------------------------------------- */
/*	Template for comments and pingbacks
/* ---------------------------------------------------------------------- */

if( !function_exists('ss_framework_comments') ) {

	function ss_framework_comments($comment, $args, $depth) {

		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>
		<li class="post pingback">
			<p><?php _e( 'Pingback:', 'ss_framework' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'ss_framework' ), ' ' ); ?></p>
		<?php
				break;
			default :
		?>

		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

			<article id="comment-<?php comment_ID(); ?>">

				<?php echo get_avatar( $comment, 50 ); ?>

				<div class="comment-meta">

					<h5 class="author">
						<?php printf( __('%s', 'ss_framework'), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
						<?php comment_reply_link( array_merge( array('before' => ' - '), array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</h5>

					<p class="date">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<time pubdate datetime="<?php comment_time( 'c' ); ?>">
								<?php printf( __( '%1$s at %2$s', 'ss_framework' ), get_comment_date(), get_comment_time() ); ?>
							</time>
						</a>
					</p>
					
				</div><!-- end .comment-meta -->

				<div class="comment-body">
				
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<p><em><?php _e('Your comment is awaiting moderation.', 'ss_framework'); ?></em></p>
					<?php endif; ?>
					
					<?php comment_text(); ?>
					
					<?php edit_comment_link( __( '(Edit)', 'ss_framework' ), ' ' ); ?>
					
				</div><!-- end .comment-body -->

			</article><!-- end #comment -->

		</li>

		<?php
				break;
		endswitch;
	}

}

/* ---------------------------------------------------------------------- */
/*	Show the post content
/* ---------------------------------------------------------------------- */

if( !function_exists('ss_framework_post_content') ) {

	function ss_framework_post_content() {

		global $post, $user_ID;

		get_currentuserinfo();

		if ( !isset( $GLOBALS['post-carousel'] ) && ( is_singular() || get_post_format() == 'aside' ) ) {

			$content = get_the_content();
			$content = apply_filters( 'the_content', $content );
			$content = str_replace( ']]>', ']]&gt;', $content );

			$output = $content;

			$output .= wp_link_pages( array( 'echo' => false ) );

		} else {

			if( get_post_format() != 'quote' )
				$output = get_the_excerpt();

		}

		if( user_can( $user_ID, 'edit_posts' ) )
			$output .= '<p><a title="' . __('Edit Post', 'ss_framework') . '" href="' . get_edit_post_link( $post->ID ) . '" class="post-edit-link">' . __('Edit', 'ss_framework') . '</a></p>';

		return $output;

	}

}

/* ---------------------------------------------------------------------- */
/*	Show the post meta (permalink, date, tags, categories & comments)
/* ---------------------------------------------------------------------- */

if( !function_exists('ss_framework_post_meta') ) {

	function ss_framework_post_meta() {

		global $post;

		if( isset( $GLOBALS['post-carousel'] ) ) {

			$output = '<a href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'ss_framework' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"><span class="post-format ' . get_post_format() . '">' . __('Permalink', 'ss_framework') . '</span></a>';
			
			if ( of_get_option('ss_post_date') == '1' )
				$output .= '<span class="date">' . ss_framework_posted_on() . '</span>';

		} else {

			$output = '<ul>';

				$output .= '<li><a href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'ss_framework' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"><span class="post-format ' . get_post_format() . '">' . __('Permalink', 'ss_framework') . '</span></a></li>';

				if ( of_get_option('ss_post_date') == '1' )
					$output .= '<li><span class="title">' . __('Posted:', 'ss_framework') . '</span> ' . ss_framework_posted_on() . '</li>';

				if( of_get_option('ss_post_categories') == '1' && get_the_category_list() )
					$output .= '<li><span class="title">' . __('Categories:', 'ss_framework') . '</span> ' . get_the_category_list( ', ', '', $post->ID ) . '</li>';

				if( of_get_option('ss_post_tags') == '1' && get_the_tags() )
					$output .= '<li><span class="title">' . __('Tags:', 'ss_framework') . '</span> ' . get_the_tag_list('', ', ', '') . '</li>';

				if ( of_get_option('ss_post_comments') == '1' && ( comments_open() || ( '0' != get_comments_number() && !comments_open() ) ) )
					$output .= '<li><span class="title">' . __('Comments:', 'ss_framework') . '</span> <a title="Comment on ' . get_the_title() . '" href="' . get_comments_link() . '">' . get_comments_number() . '</a></li>';

				if ( of_get_option('ss_post_author') == '1' )
					$output .= '<li><span class="title">' . __('Author:', 'ss_framework') . '</span> <span class="author vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" title="' . sprintf( __( 'View all posts by %s', 'ss_framework' ), get_the_author() ) . '" rel="author">' . get_the_author() . '</a></span></li>';

			$output .= '</ul>';

		}

		return $output;

	}

}

/* ---------------------------------------------------------------------- */
/*	Get featured image path
/* ---------------------------------------------------------------------- */

if ( !function_exists('ss_framework_get_featured_image_link') ) {

	function ss_framework_get_featured_image_link( $size ){

		global $post;

		$get_featured_image_link = get_the_post_thumbnail( $post->ID, $size );
		preg_match("/(?<=src=['|\"])[^'|\"]*?(?=['|\"])/i", $get_featured_image_link, $thePath);

		return $get_featured_image_link_final = $thePath[0];

	}

}

/* ---------------------------------------------------------------------- */
/*	Get post thumbnail data
/* ---------------------------------------------------------------------- */

if ( !function_exists('ss_framework_get_the_post_thumbnail_data') ) {

	function ss_framework_get_the_post_thumbnail_data( $post_id = 0 ) {	

		if( $post_id == 0 )
			return $post_id;

		if( !get_the_post_thumbnail( $post_id ) )
			return null;

		$objDom = new SimpleXMLElement( get_the_post_thumbnail( $post_id ) );
		$arrDom = (array)$objDom;

		return (array)$arrDom['@attributes'];

	}

}

/* ---------------------------------------------------------------------- */
/*	Get attachment ID
/* ---------------------------------------------------------------------- */

if ( !function_exists('ss_framework_get_attachment_id') ) {

	function ss_framework_get_attachment_id( $url ) {

		$dir = wp_upload_dir();
		$dir = trailingslashit( $dir['baseurl'] );

		if( false === strpos( $url, $dir ) )
			return false;

		$file = basename( $url );

		$query = array(
			'post_type' => 'attachment',
			'fields' => 'ids',
			'meta_query' => array(
				array(
					'value' => $file,
					'compare' => 'LIKE',
				)
			)
		);

		$query['meta_query'][0]['key'] = '_wp_attached_file';
		$ids = get_posts( $query );
		
		foreach( $ids as $id ) {

			if( $url == array_shift(wp_get_attachment_image_src( $id, 'full' ) ) )
				return $id;

		}

		$query['meta_query'][0]['key'] = '_wp_attachment_metadata';
		$ids = get_posts( $query );

		foreach( $ids as $ids ) {

			$meta = wp_get_attachment_metadata( $id );

			if( is_array( $meta ) )
				foreach( $meta['sizes'] as $size => $values ) {

					if( $values['file'] == $file && $url == array_shift( wp_get_attachment_image_src( $id, $size ) ) ) {
						//$this->attachment_size = $size;
						return $id;
					}

				}

		}

		return false;

	}

}

/* ---------------------------------------------------------------------- */
/*	Get Custom Field
/* ---------------------------------------------------------------------- */

if ( !function_exists('ss_framework_get_custom_field') ) {

	function ss_framework_get_custom_field( $key, $post_id = null ) {

		global $wp_query;

		$post_id = $post_id ? $post_id : $wp_query->get_queried_object()->ID;

		return get_post_meta( $post_id, $key, true );

	}

}

/* ---------------------------------------------------------------------- */
/*	Return template part
/* ---------------------------------------------------------------------- */

if ( !function_exists('ss_framework_load_template_part') ) {

	function ss_framework_load_template_part( $template_name, $part_name = null ) {

		ob_start();

		get_template_part( $template_name, $part_name );

		$output = ob_get_contents();

		ob_end_clean();

		return $output;

	}

}

/* ---------------------------------------------------------------------- */
/*	Blog navigation
/* ---------------------------------------------------------------------- */

if ( !function_exists('ss_framework_pagination') ) {

	function ss_framework_pagination( $pages = '', $range = 2 ) {

		$showitems = ( $range * 2 ) + 1;

		global $paged, $wp_query;

		if( empty( $paged ) )
			$paged = 1;

		if( $pages == '' ) {

			$pages = $wp_query->max_num_pages;

			if( !$pages )
				$pages = 1;

		}

		if( 1 != $pages ) {

			$output = '<nav class="pagination">';

			// if( $paged > 2 && $paged >= $range + 1 /*&& $showitems < $pages*/ )
				// $output .= '<a href="' . get_pagenum_link( 1 ) . '" class="next">&laquo; ' . __('First', 'ss_framework') . '</a>';

			if( $paged > 1 /*&& $showitems < $pages*/ )
				$output .= '<a href="' . get_pagenum_link( $paged - 1 ) . '" class="next">&larr; ' . __('Next', 'ss_framework') . '</a>';

			for ( $i = 1; $i <= $pages; $i++ )  {

				if ( 1 != $pages && ( !( $i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems ) )
					$output .= ( $paged == $i ) ? '<span class="current">' . $i . '</span>' : '<a href="' . get_pagenum_link( $i ) . '">' . $i . '</a>';

			}

			if ( $paged < $pages /*&& $showitems < $pages*/ )
				$output .= '<a href="' . get_pagenum_link( $paged + 1 ) . '" class="prev">' . __('Previous', 'ss_framework') . ' &rarr;</a>';

			// if ( $paged < $pages - 1 && $paged + $range - 1 <= $pages /*&& $showitems < $pages*/ )
				// $output .= '<a href="' . get_pagenum_link( $pages ) . '" class="prev">' . __('Last', 'ss_framework') . ' &raquo;</a>';

			$output .= '</nav>';

			return $output;

		}

	}

}

/* ---------------------------------------------------------------------- */
/*	Check page layout
/* ---------------------------------------------------------------------- */

if ( !function_exists('ss_framework_check_page_layout') ) {

	function ss_framework_check_page_layout( $single_project = null, $portfolio_category = null ) {

		$page_layout = ss_framework_get_custom_field('ss_page_layout');

		if( $single_project )
			$page_layout = ss_framework_get_custom_field('ss_project_page_layout');

		if( $portfolio_category )
			$page_layout = ss_framework_get_custom_field( 'ss_page_layout', of_get_option('ss_portfolio_parent') );

		$site_structure = of_get_option('ss_site_structure');

		if( ( $page_layout == '2cl' || $page_layout == '2cr' ) || ( $page_layout != '1col' && ( $site_structure == '2cl' || $site_structure == '2cr' ) ) )
			return true;

		return false;

	}
	
}
/* ---------------------------------------------------------------------- */
/*	Check sidebar position
/* ---------------------------------------------------------------------- */

if ( !function_exists('ss_framework_check_sidebar_position') ) {

	function ss_framework_check_sidebar_position( $single_project = null, $portfolio_category = null ) {

		$page_layout = ss_framework_get_custom_field('ss_page_layout');

		if( $single_project )
			$page_layout = ss_framework_get_custom_field('ss_project_page_layout');

		if( $portfolio_category )
			$page_layout = ss_framework_get_custom_field( 'ss_page_layout', of_get_option('ss_portfolio_parent') );

		$site_structure = of_get_option('ss_site_structure');

		if( $page_layout == '2cl' || ( $page_layout == '' && $site_structure == '2cl' ) )
			return 'sidebar-left';

		return null;

	}
	
}

/* ---------------------------------------------------------------------- */
/*	Check if user is using either IE7 or IE8
/* ---------------------------------------------------------------------- */

if ( !function_exists('ss_framework_detect_ie') ) {
	
	function ss_framework_detect_ie( $ie7_check = true, $ie8_check = true ) {

		$ie7 = ($ie7_check == true) ? strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 7.0') : false;
		$ie8 = ($ie8_check == true) ? strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 8.0') : false;
		if ($ie7 !== false || $ie8 !== false) {
			return true;
		} else {
			return false;
		}

	}

}

/* ---------------------------------------------------------------------- */
/*	Convert hex color value to rgb
/* ---------------------------------------------------------------------- */

if ( !function_exists('ss_framework_hex2rgb') ) {
	
	function ss_framework_hex2rgb( $colour ) {

		if ( $colour[0] == '#' )
			$colour = substr( $colour, 1 );

		if ( strlen( $colour ) == 6 ) {
			list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
		} elseif ( strlen( $colour ) == 3 ) {
			list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
		} else {
			return false;
		}

		$r = hexdec( $r );
		$g = hexdec( $g );
		$b = hexdec( $b );

		return array( 'red' => $r, 'green' => $g, 'blue' => $b );

	}

}

/* ---------------------------------------------------------------------- */
/*	Get up-to-date Google web fonts
/* ---------------------------------------------------------------------- */

if ( !function_exists('ss_framework_get_google_fonts') ) {
	
	function ss_framework_get_google_fonts() {

		// Some settings
		$fonts_url  = 'http://demo.samuli.me/google-web-fonts/get.php';
		$cache_file = SS_BASE_DIR . 'functions/admin/cache/google-web-fonts.txt';
		$cache_time = 60 * 60 * 24 * 7;

		$cache_file_created = @file_exists( $cache_file ) ? @filemtime( $cache_file ) : 0;

		// Make sure curl is enabled
		if( is_callable('curl_init') && ini_get('allow_url_fopen') ) {

			// Update only once a week
			if( time() - $cache_time > $cache_file_created ) {

				// Fetch fonts
				$ch = curl_init();
				curl_setopt( $ch, CURLOPT_URL, $fonts_url );
				curl_setopt( $ch, CURLOPT_HEADER, 0 );
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
				$data = curl_exec( $ch );
				curl_close( $ch );

				// Update cache file
				$file = fopen( $cache_file , 'w');
				fwrite( $file, $data );
				fclose( $file );

			}

		}

		$fonts = unserialize( @file_get_contents( $cache_file ) );

		return $fonts;

	}

}

/* ---------------------------------------------------------------------- */
/*	Check the current post for the existence of a short code 
/* ---------------------------------------------------------------------- */

if ( !function_exists('ss_framework_has_shortcode') ) {

	function ss_framework_has_shortcode($shortcode = '') {

		global $post;

		$post_obj = get_post( $post->ID );

		$found = false;

		if ( !$shortcode )
			return $found;

		if ( stripos( $post_obj->post_content, '[' . $shortcode ) !== false )
			$found = true;

		// return our final results  
		return $found;

	}
}

/* ---------------------------------------------------------------------- */
/*	Single project slider
/* ---------------------------------------------------------------------- */

if ( !function_exists('ss_framework_single_project_slider') ) {

	function ss_framework_single_project_slider( $post_id ) {

		$project_slider = get_post_meta( $post_id, 'ss_project_slider' );
		$slide_types    = array_count_values( $project_slider[0][0] );

		$disable_project_slider = get_post_meta( $post_id, 'ss_disable_project_slider' );
		$disable_project_slider = $disable_project_slider[0] == '1' ? 'disabled' : null;

		$lightbox = of_get_option('ss_single_project_lightbox');

		$slider_effect  = of_get_option('ss_project_slider_effect');
		$slider_speed   = of_get_option('ss_use_custom_project_slider_speed')   ? of_get_option('ss_custom_project_slider_speed')   : of_get_option('ss_project_slider_speed');
		$slider_timeout = of_get_option('ss_use_custom_project_slider_timeout') ? of_get_option('ss_custom_project_slider_timeout') : of_get_option('ss_project_slider_timeout');

		if( $slide_types[null] <= 8 || !$slide_types ) {

			$output = '<div class="image-gallery-slider ' . $disable_project_slider . '">';

				$output .= '<ul data-effect="' . $slider_effect . '" data-speed="' . $slider_speed . '" data-timeout="' .  $slider_timeout . '" data-mode="' . $disable_project_slider . '">';

					foreach( $project_slider[0] as $i => $slide ) {

						$output .= '<li>';

						if( $slide['slide-type'] == 'image' ) {
						
							$attachment_title = ss_framework_get_attachment_id( $slide['slide-img-src'] ) ? get_the_title( ss_framework_get_attachment_id( $slide['slide-img-src'] ) ) : '';							

							if( $lightbox == '1' )
								$output .= '<a href="' . $slide['slide-img-src'] . '" class="image-gallery" rel="single-project-' . $post_id . '" title="' . $attachment_title . '">';
								
								$output .= '<img src="' . $slide['slide-img-src'] . '" alt="' . $attachment_title . '">';

							if( $lightbox == '1' )
								$output .= '</a>';

						} elseif( $slide['slide-type'] == 'video' ) {

							$video_shortcode = '[video';

								if( $slide['slide-video-mp4'] )
									$video_shortcode .= ' mp4="' . $slide['slide-video-mp4'] . '"';

								if( $slide['slide-video-webm'] )
									$video_shortcode .= ' webm="' . $slide['slide-video-webm'] . '"';

								if( $slide['slide-video-ogg'] )
									$video_shortcode .= ' ogg="' . $slide['slide-video-ogg'] . '"';

								if( $slide['slide-video-preview'] )
									$video_shortcode .= ' poster="' . $slide['slide-video-preview'] . '"';

								if( $slide['slide-video-aspect-ratio'] )
									$video_shortcode .= ' aspect_ratio="' . $slide['slide-video-aspect-ratio'] . '"';

							$video_shortcode .= ']';

							$output .= do_shortcode( $video_shortcode );

						} elseif( $slide['slide-type'] == 'audio' ) {

							$audio_shortcode = '[audio';

								if( $slide['slide-audio-mp3'] )
									$audio_shortcode .= ' mp3="' . $slide['slide-audio-mp3'] . '"';

								if( $slide['slide-audio-ogg'] )
									$audio_shortcode .= ' ogg="' . $slide['slide-audio-ogg'] . '"';

							$audio_shortcode .= ']';

							$output .= do_shortcode( $audio_shortcode );

						} elseif( $slide['slide-type'] == 'custom' ) {

							$output .= do_shortcode( $slide['slide-custom'] );

						}

						$output .= '</li>';
					
					}
					
				$output .= '</ul>';
				
			$output .= '</div><!-- end .image-gallery-slider -->';

			return $output;

		}

		return false;

	}

}

/* ---------------------------------------------------------------------- */
/*	Insert portfolio filter
/* ---------------------------------------------------------------------- */

if ( !function_exists('ss_framework_portfolio_filter') ) {

	function ss_framework_portfolio_filter() {

		if( ss_framework_has_shortcode('portfolio') || is_tax('portfolio-categories') ) {
		
			if( ss_framework_has_shortcode('portfolio') ) {
						
				global $post;

				$post_obj = get_post( $post->ID );
				
				$shortcode_categories = preg_match( '/\[portfolio.+categories="/', $post_obj->post_content );
				
				if( $shortcode_categories ) {

					$shortcode_categories = preg_replace( array('/(.|\s)*\[portfolio.+categories="/', '/".+](.|\s)*/'), '', $post_obj->post_content );

					$shortcode_categories = explode( ',', $shortcode_categories );
				
				}

			}
			
			if( is_tax('portfolio-categories') ) {
			
				global $wp_query;
				
				$current_category = $wp_query->get_queried_object();

			}

			$categories = get_terms('portfolio-categories');

			$output = '<ul id="portfolio-items-filter" class="' . ( is_tax('portfolio-categories') ? 'single-category' : '' ) . ' ' . ( of_get_option('ss_portfolio_category_filter') ? 'open' : '' ) . '">';

			$output .= '<li>' . __('Showing', 'ss_framework') . '</li>';
			$output .= '<li class="all"><a data-categories="*" href="' . get_permalink( of_get_option('ss_portfolio_parent') ) . '">' . __('All', 'ss_framework') . '</a></li>';
		
			foreach ( $categories as $category ) {
			
				$current_item = isset( $current_category ) && $current_category->term_id == $category->term_id ? ' class="current"' : '';
				
				if( isset( $portfolio_categories ) && in_array( $category->term_id, $portfolio_categories ) || !isset( $portfolio_categories ) )
					$output .= '<li' . $current_item . '><a href="' . get_term_link( $category->slug, 'portfolio-categories' ) . '" data-categories="' . $category->slug . '">' . $category->name . '</a></li>';

			}

			$output .= '</ul><!-- end #portfolio-items-filter -->';

			echo $output;

		}

	}
	add_action('ss_framework_portfolio_filter', 'ss_framework_portfolio_filter');

}

/* ---------------------------------------------------------------------- */
/*	Twitter Feed widget
/* ---------------------------------------------------------------------- */

if ( !function_exists('ss_framework_twitter_feed') ) {

	function ss_framework_twitter_feed( $username, $tweet_count, $ignore_replies = true, $widget_id ) {

		// A flag so we know if the feed was successfully parsed
		$tweet_found = false;

		// Get tweets
		$tweets = get_transient( 'ss_framework_twitter_feed-' . $widget_id );

		// Show file from cache if still valid
		if ( $tweets === false  ) {

			// Fetch the RSS feed from Twitter
			$rss_feed = wp_remote_get("http://api.twitter.com/1/statuses/user_timeline.rss?screen_name=$username");

			// Parse the RSS feed to an XML object
			$rss_feed = @simplexml_load_string( $rss_feed['body'] );

			if( !is_wp_error( $rss_feed ) && isset( $rss_feed ) ) {

				// Error check: Make sure there is at least one item
				if( count( $rss_feed->channel->item ) ) {

					// Open the twitter wrapping element
					$tweets = '<ul class="tweets-feed">';
					 
					$tweets_count = 0;
					$tweet_found = true;

					// Iterate over tweets.
					foreach( $rss_feed->channel->item as $tweet ) {

						// Twitter feeds begin with the username, "e.g. User name: Blah"
						// so we need to strip that from the front of our tweet
						$tweet_desc = substr( $tweet->description, strpos( $tweet->description, ':' ) + 2 );
						$tweet_desc = htmlspecialchars( $tweet_desc );
						$tweet_first_char = substr( $tweet_desc, 0, 1 );

						// If we are not gnoring replies, or tweet is not a reply, process it
						if ( $tweet_first_char != '@' || $ignore_replies == false ) {

							$tweets_count++;

							// Add hyperlink html tags to any urls, twitter ids or hashtags in the tweet
							$tweet_desc = preg_replace( '/(https?:\/\/[^\s"<>]+)/', '<a href="$1">$1</a>', $tweet_desc );
							$tweet_desc = preg_replace( '/(^|[\n\s])@([^\s"\t\n\r<:]*)/is', '$1<a href="http://twitter.com/$2">@$2</a>', $tweet_desc );
							$tweet_desc = preg_replace( '/(^|[\n\s])#([^\s"\t\n\r<:]*)/is', '$1<a href="http://twitter.com/search?q=%23$2">#$2</a>', $tweet_desc );

							// Convert Tweet display time to a UNIX timestamp. Twitter timestamps are in UTC/GMT time
							$tweet_time = strtotime( $tweet->pubDate );
							
							// Current UNIX timestamp.
							$current_time = time();
							$time_diff = abs( $current_time - $tweet_time );

							switch ( $time_diff ) {

								case ( $time_diff < 60 ):

									$display_time = $time_diff . __(' seconds ago', 'ss_framework');

									break;

								case ( $time_diff >= 60 && $time_diff < 3600 ):

									$min = floor( $time_diff/60 );
									$display_time = $min . __(' minute', 'ss_framework');
									if ( $min > 1 )
										$display_time .= __('s', 'ss_framework');
									$display_time .= __(' ago', 'ss_framework');

									break;

								case ( $time_diff >= 3600 && $time_diff < 86400 ):

									$hour = floor( $time_diff/3600 );
									$display_time = __('about ', 'ss_framework') . $hour . __(' hour', 'ss_framework');
									if ( $hour > 1 )
										$display_time .= __('s', 'ss_framework');
									$display_time .= __(' ago', 'ss_framework');

									break;

								case ( $time_diff >= 86400 && $time_diff < 604800 ):

									$day = floor( $time_diff/86400 );
									$display_time = __('about ', 'ss_framework') . $day . __(' day', 'ss_framework');
									if ( $day > 1 )
										$display_time .= __('s', 'ss_framework');
									$display_time .= __(' ago', 'ss_framework');

									break;

								case ( $time_diff >= 604800 && $time_diff < 2592000 ):

									$week = floor( $time_diff/604800 );
									$display_time = __('about ', 'ss_framework') . $week . __(' week', 'ss_framework');
									if ( $week > 1 )
										$display_time .= __('s', 'ss_framework');
									$display_time .= __(' ago', 'ss_framework');

									break;

								case ( $time_diff >= 2592000 && $time_diff < 31536000 ):

									$month = floor( $time_diff/2592000 );
									$display_time = __('about ', 'ss_framework') . $month . __(' month', 'ss_framework');
									if ( $month > 1 )
										$display_time .= __('s', 'ss_framework');
									$display_time .= __(' ago', 'ss_framework');

									break;

								case ( $time_diff > 31536000 ):

									$display_time = __('more than a year ago', 'ss_framework');

									break;

								default:
									$display_time = date( get_option('date_format'), $tweet_time );
									break;

							}
								
							// Render the tweet
							$tweets .= "<li>$tweet_desc<span class='date'><a href='$tweet->link' target='_blank'>($display_time)</a></span></li>\n";

						}
		 
						// If we have processed enough tweets, stop
						if ($tweets_count >= $tweet_count)
							break;

					}

					// Close the twitter wrapping element
					$tweets .= '</ul><!-- end .tweets-feed -->';

					// Tweets will be updated every hour
					set_transient( 'ss_framework_twitter_feed-' . $widget_id, $tweets, 60 * 60 );

				}
				
			}

			// In case the RSS feed did not parse or load correctly, show a link to the Twitter account.
			if ( !$tweet_found )
				$tweets = "<ul class='tweets-feed'><li>" . __('Oops, our Twitter feed is unavailable at the moment.', 'ss_framework') . " - <a href='http://twitter.com/$username/' target='_blank'>" . __('Follow us on Twitter!', 'ss_framework') . "</a></li></ul><!-- end .tweets-feed -->";

		}

		return $tweets;
		
	}

}

/* ---------------------------------------------------------------------- */
/*	Flickr Feed widget
/* ---------------------------------------------------------------------- */

if ( !function_exists('ss_framework_flickr_feed') ) {

	function ss_framework_flickr_feed( $flickr_id, $image_count, $widget_id ) {

		// A flag so we know if the feed was successfully parsed
		$image_found = false;

		// Get tweets
		$images = get_transient( 'ss_framework_flickr_feed-' . $widget_id );

		// Show file from cache if still valid
		if ( $images === false ) {

			// Fetch the RSS feed from Twitter
			$rss_feed = wp_remote_get("http://api.flickr.com/services/feeds/photos_public.gne?id=$flickr_id&format=rss");

			// Parse the RSS feed to an XML object
			$rss_feed = @simplexml_load_string( $rss_feed['body'] );

			if( !is_wp_error( $rss_feed ) && isset( $rss_feed ) ) {

				$image = $rss_feed->channel->item;

				// Error check: Make sure there is at least one item
				if( count( $image ) ) {

					// Open the flickr wrapping element
					$images = '<ul class="flickr-feed">';

					$image_found = true;

					for( $i = 0; $i < $image_count; $i++ ) {

						// Get thumbnail size
						preg_match( '/<img[^>]*>/i', $image[$i]->description, $image_tag );
						preg_match( '/(?<=src=[\'|"])[^\'|"]*?(?=[\'|"])/i', $image_tag[0], $image_src );
						
						if ( preg_match( '/(_m.jpg)$/',$image_src[0] ) ){
							$thumb = preg_replace('/(_m.jpg)$/', '_s.jpg', $image_src[0] );
						} elseif( preg_match( '/(_m.png)$/',$image_src[0] ) ){
							$thumb = preg_replace('/(_m.png)$/', '_s.png', $image_src[0] );
						} elseif( preg_match( '/(_m.gif)$/',$image_src[0] ) ){
							$thumb = preg_replace( '/(_m.gif)$/', '_s.gif', $image_src[0] );
						}

						$image_link = $image[$i]->link;
						$image_title = $image[$i]->title;

						$images .= "<li><a href='$image_link' title='$image_title' target='_blank'><img src='$thumb' alt='$image_title'></a></li>\n";

					}

					// Close the twitter wrapping element
					$images .= '</ul><!-- end .flickr-feed -->';

					// Tweets will be updated every hour
					set_transient( 'ss_framework_flickr_feed-' . $widget_id, $images, 60 * 60 );

				}
			
			}

			// In case the RSS feed did not parse or load correctly, show a link to the Flickr account
			if ( !$image_found ){
				$images = "<ul class='flickr-feed'><li>Oops, our Flickr feed is unavailable at the moment - <a href='http://flickr.com/$flickr_id/' target='_blank'>Check our images on Flickr!</a></li></ul><!-- end .flickr-feed -->";
			}

		}

		return $images;
		
	}

}

/* ---------------------------------------------------------------------- */
/*	Insert all custom CSS styles
/* ---------------------------------------------------------------------- */

if ( !function_exists('ss_framework_insert_custom_styles') ) {

	function ss_framework_insert_custom_styles() {

		$typography = of_get_option('ss_typography');

		$background = of_get_option('ss_background');
		$background_rgb = ss_framework_hex2rgb( $background['color'] ); 
		$background_rgb = $background_rgb['red'] . ',' . $background_rgb['green']. ',' . $background_rgb['blue'];

		$color_scheme_rgb = ss_framework_hex2rgb( of_get_option('ss_color_scheme') );
		$color_scheme_rgb = $color_scheme_rgb['red'] . ',' . $color_scheme_rgb['green']. ',' . $color_scheme_rgb['blue'];

		$main_heading_font = '';
		$blockquote_heading_font = '';

		if( of_get_option('ss_main_heading_font') ){
			$main_heading_font = preg_split( '/:/', of_get_option('ss_main_heading_font') );
			$main_heading_font = '"' . str_replace('+', ' ', $main_heading_font[0]) . '",';
		}

		if( of_get_option('ss_blockquote_heading_font') ){
			$blockquote_heading_font = preg_split( '/:/', of_get_option('ss_blockquote_heading_font') );
			$blockquote_heading_font = '"' . str_replace('+', ' ', $blockquote_heading_font[0]) . '",';
		}

		$if_ie7 = ss_framework_detect_ie( $ie7_check = true, $ie8_check = true );

		?>

<style>
/* Main styles */
body {
	color: <?php echo $typography['color']; ?>;
	font: <?php echo $typography['style']; ?> <?php echo $typography['size']; ?>/1.7 <?php echo $typography['face']; ?>;
}

::-moz-selection { background: <?php echo of_get_option('ss_color_scheme'); ?>; color: <?php echo $background['color']; ?>; text-shadow: none; }
::selection { background: <?php echo of_get_option('ss_color_scheme'); ?>; color: <?php echo $background['color']; ?>; text-shadow: none; }

/* Background (hex) */
body { background: <?php echo $background['color']; ?> url(<?php echo $background['image']; ?>) <?php echo $background['repeat']; ?> <?php echo $background['position']; ?> <?php echo $background['attachment']; ?>; }

.ss-slider, .ss-slider .slide-images-container,
.ss-slider .slide-bg-image, .ss-slider .buttons-container,
.projects-carousel img, #portfolio-items article img,
.comment .avatar,
.not-ie #footer:before { background-color: <?php echo $background['color']; ?>; }

@media only screen and (max-width: 767px) { .ss-slider.fully-loaded, .ss-slider.fully-loaded .slide-images-container { background-color: <?php echo $background['color']; ?>; } }

/* Background (rgb) */
.single-image .zoom, .image-gallery .zoom, .iframe .zoom,
.no-js .single-image:before, .no-js .image-gallery:before, .no-js .iframe:before {
	background: rgb(<?php echo $background_rgb; ?>);
	background: rgba(<?php echo $background_rgb; ?>, 0.4);
}

/* Main heading font*/
h1, h2, h3, h4, h5, h6,
.button, input[type="submit"], input[type="reset"], button,
.dropcap,
label, input, textarea, select,
th,
#main-nav a,
.ss-slider .slide-button h5,
.projects-carousel, #portfolio-items,
.entry-meta { font-family: <?php echo $main_heading_font; ?> <?php echo $typography['face']; ?>; }

#main-nav ul ul a, .entry-form label { font-family: <?php echo $typography['face']; ?>; }

@media only screen and (max-width: 959px) { .extended-pricing-table .features li:before { font-family: <?php echo $main_heading_font ?> <?php echo $typography['face']; ?>; } }

/* Blockquote font */
blockquote { font-family: <?php echo $blockquote_heading_font; ?> <?php echo $typography['face']; ?>; }

/* Color scheme (hex) */
.button, input[type="submit"], input[type="reset"], button,
.not-ie #main-nav .current_page_item:after, .not-ie #main-nav .current-menu-item:after, .not-ie #main-nav .current_page_parent:after,
.not-ie #main-nav .current_page_ancestor:after, .not-ie #main-nav .current-menu-ancestor:after,
#main-nav ul ul a:hover, #main-nav ul ul .hover > a,
#main-nav ul ul .current_page_item > a, #main-nav ul ul .current_page_item > a:hover,
#main-nav ul ul .current_page_parent > a, #main-nav ul ul .current_page_parent > a:hover,
#main-nav ul ul .current-menu-item > a, #main-nav ul ul .current-menu-item > a:hover,
#main-nav ul ul .current_page_ancestor > a, #main-nav ul ul .current-menu-ancestor > a:hover,
.ss-slider .active-slide-bar,
.not-ie .projects-carousel a:hover:after, #portfolio-items > article:hover:after,
.not-ie .team-member:hover:after,
#portfolio-items-filter a { background: <?php echo of_get_option('ss_color_scheme'); ?>; }

a:hover, a > *:hover,
.button.no-bg:hover,
#main-nav a:hover, #main-nav .hover > a,
#main-nav .current_page_item > a, #main-nav .current-menu-item > a, #main-nav .current_page_parent > a,
#main-nav .current_page_ancestor > a, #main-nav .current-menu-ancestor > a,
.acc-trigger a:hover, .acc-trigger.active a, .acc-trigger.active a:hover,
.tabs-nav li a:hover, .tabs-nav li.active a,
.ss-slider .slide-button:hover, .ss-slider.fully-loaded .slide-button.active,
.ss-slider.fully-loaded .slide-button.active h5,
.ss-slider .slide-content a,
.projects-carousel a:hover .title, #portfolio-items > article:hover .title,
.entry-meta a:hover, .entry-meta a:hover time,
a:hover > .post-format,
.comment .author a:hover,
.comment .date a:hover, .comment .date a:hover time,
.pagination a:hover, .comments-pagination a:hover,
.single-portfolio .page-header a:hover,
.widget li a:hover,
.widget_nav_menu .current_page_item > a, .widget_nav_menu .current-menu-item > a,
#sidebar .tweets-feed li a, #footer .tweets-feed li a,
#footer a:hover, #footer-bottom a:hover  { color: <?php echo of_get_option('ss_color_scheme'); ?>; }

.button:hover .arrow,
#back-to-top:hover, .touch-device #back-to-top:active,
.jcarousel-next:hover, .jcarousel-next:focus, .jcarousel-next:active,
.jcarousel-prev:hover, .jcarousel-prev:focus, .jcarousel-prev:active,
.not-ie .projects-carousel a:hover:after, .not-ie #portfolio-items > article:hover:after,
a:hover > .post-format { background-color: <?php echo of_get_option('ss_color_scheme'); ?>; }

#main-nav a:hover, #main-nav .hover > a,
#main-nav .current_page_item > a, #main-nav .current-menu-item > a, #main-nav .current_page_parent > a,
#main-nav .current_page_ancestor > a, #main-nav .current-menu-ancestor > a,
.projects-carousel a:hover, #portfolio-items > article:hover,
.team-member:hover  { border-bottom-color: <?php echo of_get_option('ss_color_scheme'); ?>; }

#main-nav a:hover, #main-nav .hover > a,
#main-nav .current_page_item > a, #main-nav .current-menu-item > a, #main-nav .current_page_parent > a,
#main-nav .current_page_ancestor > a, #main-nav .current-menu-ancestor > a,
.tabs-nav li.active a { border-top-color: <?php echo of_get_option('ss_color_scheme'); ?>; }

@media only screen and (max-width: 959px) { .ss-slider.fully-loaded .slide-button.active { border-top-color: <?php echo of_get_option('ss_color_scheme'); ?>; } }
@media only screen and (max-width: 767px) { #main-nav > ul > .current:last-child a { border-bottom-color: <?php echo of_get_option('ss_color_scheme'); ?>; } }

/* Color scheme (rgb) */
.image-gallery-slider-nav a, .ss-slider .pagination-container a {
	<?php if( $if_ie7 ) echo 'background-color: rgb(' . $color_scheme_rgb . ');'; ?>
	<?php if( !$if_ie7 ) echo 'background-color: rgba(' . $color_scheme_rgb . ', 0.6);'; ?>
}

.image-gallery-slider-nav a:hover, .image-gallery-slider-nav a:active,
.ss-slider .pagination-container a:hover, .ss-slider.show-content-onhover:hover .pagination-container a:hover {
	<?php if( $if_ie7 ) echo 'background-color: rgb(' . $color_scheme_rgb . ');'; ?>
	<?php if( !$if_ie7 ) echo 'background-color: rgba(' . $color_scheme_rgb . ', 1);'; ?>
}

@media only screen and (max-width: 767px) {
	.ss-slider .pagination-container a, .ss-slider .pagination-container a:hover {
		<?php if( $if_ie7 ) echo 'background-color: rgb(' . $color_scheme_rgb . ');'; ?>
		<?php if( !$if_ie7 ) echo 'background-color: rgba(' . $color_scheme_rgb . ', 0.6);'; ?>
	}
}

<?php
	if( of_get_option('ss_custom_css') )
		echo of_get_option('ss_custom_css');
?>

</style>

		<?php

	}
	add_action('wp_head', 'ss_framework_insert_custom_styles');

}

/* ---------------------------------------------------------------------- */
/*	Insert custom JS
/* ---------------------------------------------------------------------- */

if ( !function_exists('ss_framework_insert_custom_js') ) {

	function ss_framework_insert_custom_js() {
		
		if( of_get_option('ss_custom_js') )
			echo "\n" . '<script>' . of_get_option('ss_custom_js') . '</script>' . "\n";		
	
	}
	add_action('wp_footer', 'ss_framework_insert_custom_js');

}

/* ---------------------------------------------------------------------- */
/*	VideoJS Flash fallback url
/* ---------------------------------------------------------------------- */

if ( !function_exists('ss_framework_videojs_fallback') ) {

	function ss_framework_videojs_fallback() {
		?>

<script>
_V_.options.flash.swf = '<?php echo SS_BASE_URL; ?>js/video-js.swf';
</script>

		<?php

	}
	add_action('wp_head', 'ss_framework_videojs_fallback');

}

/* ---------------------------------------------------------------------- */
/*	Insert all sliders' scripts
/* ---------------------------------------------------------------------- */

if ( !function_exists('ss_framework_insert_sliders') ) {

	function ss_framework_insert_sliders_scripts() {

		global $wpdb;

		$query = "SELECT post_id
				  FROM $wpdb->postmeta
				  WHERE meta_key = 'ss_slider_slides'";

		$sliders = $wpdb->get_results( $query );

		foreach ( $sliders as $slider ):

			$post_obj = get_post( $slider->post_id );

			// Check that slider actually exist, so we don't insert unnecessary code
			if( !ss_framework_has_shortcode('slider') && get_post_type() != 'slider' )
				continue;

			// Check that slider is published
			if( $post_obj->post_status != 'publish' )
				continue;

		?>

<script>

(function( $ ) {

	var $slider = $('#ss-<?php echo $post_obj->post_name; ?>');

	if( $slider.length ) {

		// Prevent multiple initialization
		if( $slider.data('init') === true )
			return false;
		
		$slider.data( 'init', true )
			   .smartStartSlider({
			   	   pos                : <?php echo ss_framework_get_custom_field('ss_slider_first_slide', $slider->post_id ); ?>,
				   width              : <?php echo ss_framework_get_custom_field('ss_slider_width', $slider->post_id ); ?>,
				   height             : <?php echo ss_framework_get_custom_field('ss_slider_height', $slider->post_id ); ?>,
				   contentSpeed       : <?php echo ss_framework_get_custom_field('ss_slider_content_speed', $slider->post_id ); ?>,
				   showContentOnhover : <?php echo ss_framework_get_custom_field('ss_slider_show_content_onhover', $slider->post_id ); ?>,
				   hideContent        : <?php echo ss_framework_get_custom_field('ss_slider_hide_content', $slider->post_id ); ?>,
				   contentPosition    : "<?php echo ss_framework_get_custom_field('ss_slider_content_position', $slider->post_id ); ?>",
				   timeout            : <?php echo ss_framework_get_custom_field('ss_slider_autoplay', $slider->post_id ); ?>,
				   pause              : <?php echo ss_framework_get_custom_field('ss_slider_stop_on_click', $slider->post_id ); ?>,
				   pauseOnHover       : <?php echo ss_framework_get_custom_field('ss_slider_pause_on_hover', $slider->post_id ); ?>,
				   hideBottomButtons  : <?php echo ( ss_framework_get_custom_field('ss_slider_hide_bottom_buttons', $slider->post_id ) ? ss_framework_get_custom_field('ss_slider_hide_bottom_buttons', $slider->post_id ) : 0 ); ?>,
				   type               : {
					   mode           : "<?php echo ss_framework_get_custom_field('ss_slider_transition', $slider->post_id ); ?>",
					   speed          : <?php echo ss_framework_get_custom_field('ss_slider_speed', $slider->post_id ); ?>,
					   easing         : "<?php echo ss_framework_get_custom_field('ss_slider_easing', $slider->post_id ); ?>",
					   seqfactor      : <?php echo ss_framework_get_custom_field('ss_slider_seq_factor', $slider->post_id ); ?>
				   }
			   });

		// Detect swipe gestures support
		if( Modernizr.touch ) {

			function swipeFunc( e, dir ) {
			
				var $slider = $( e.currentTarget );
				
				if( dir === 'left' ) {
					$slider.find('.pagination-container .next').trigger('click');
				}
				
				if( dir === 'right' ) {
					$slider.find('.pagination-container .prev').trigger('click');
				}
				
			}
			
			$slider.swipe({
				swipeLeft       : swipeFunc,
				swipeRight      : swipeFunc,
				allowPageScroll : 'auto'
			});
			
		}

	}

})( jQuery );

</script>

		<?php

		endforeach;

	}
	add_action('ss_framework_custom_scripts', 'ss_framework_insert_sliders_scripts');

}