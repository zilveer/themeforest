<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Pile
 */

if ( ! function_exists( 'pile_posted_on' ) ) :

	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 *
	 * @since Pile 2.0
	 *
	 * @param int $post_ID Optional.
	 */
	function pile_posted_on( $post_ID = null) {
		//use the current post ID is none given
		if ( empty( $post_ID ) ) {
			$post_ID = get_the_ID();
		}

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published screen-reader-text" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c', $post_ID ) ),
			get_the_date( '', $post_ID ),
			//this more low level approach is needed so we can pass the post ID
			esc_attr( apply_filters( 'get_the_modified_date', get_post_modified_time( 'c', null, $post_ID, true ), 'c' ) ),
			apply_filters( 'get_the_modified_date', get_post_modified_time( get_option('date_format'), null, $post_ID, true ), '' )
		);

		echo '<span class="entry-time">' . $time_string . '</span>';

	} #function

endif;

if ( ! function_exists( 'pile_get_cats_list' ) ) :

	/**
	 * Returns HTML with comma separated category links
	 *
	 * @since Pile 2.0
	 *
	 * @param int $post_ID Optional. Post ID
	 *
	 * @return string
	 */
	function pile_get_cats_list( $post_ID = null ) {

		//use the current post ID is none given
		if ( empty( $post_ID ) ) {
			$post_ID = get_the_ID();
		}

		//obviously pages don't have categories
		if ( 'page' == get_post_type( $post_ID ) ) {
			return '';
		}

		$cats = '';
		/* translators: used between list items, it's just a space */
		$categories = get_the_terms( get_the_ID(), 'category' );
		if ( $categories && pile_categorized_blog() ) {
			$cats .= '<ul class="meta meta--post">' . PHP_EOL;
			foreach ( $categories as $category ) {
				$cats .= '<li><a href="' . get_term_link( $category->slug, $category->taxonomy ) . '" title="' . esc_attr( sprintf( __( "View all projects in %s", 'pile' ), $category->name ) ) . '" rel="tag">' . $category->name . '</a></li>' . PHP_EOL;
			}
			$cats .= '</ul>' . PHP_EOL;
		}

		return $cats;

	} #function

endif;

if ( ! function_exists( 'pile_cats_list' ) ) :

	/**
	 * Prints HTML with comma separated category links
	 *
	 * @since Pile 2.0
	 *
	 * @param int $post_ID Optional. Post ID
	 */
	function pile_cats_list( $post_ID = null ) {

		echo pile_get_cats_list( $post_ID );

	} #function

endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @since Pile 2.0
 *
 * @return bool
 */
function pile_categorized_blog() {
	$all_the_cool_cats = get_transient( 'pile_categories' );
	if ( false === $all_the_cool_cats ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'pile_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so pile_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so pile_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in pile_categorized_blog.
 *
 * @since Pile 2.0
 */
function pile_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'pile_categories' );
}
add_action( 'edit_category', 'pile_category_transient_flusher' );
add_action( 'save_post',     'pile_category_transient_flusher' );

if ( ! function_exists( 'pile_get_portfolio_cats_list' ) ) :

	/**
	 * Returns HTML with comma separated category links for portfolio projects
	 *
	 * @since Pile 2.0
	 *
	 * @param int|WP_Post $post_ID Optional. Post ID or post object.
	 *
	 * @return string
	 */
	function pile_get_portfolio_cats_list( $post_ID = null ) {

		//use the current post ID if none given
		if ( empty( $post_ID ) ) {
			$post_ID = get_the_ID();
		}

		//obviously pages don't have categories
		if ( 'page' == get_post_type( $post_ID ) ) {
			return '';
		}

		$cats = '';
		$categories = get_the_terms( get_the_ID(), 'pile_portfolio_categories' );
		if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) {
			$cats .= '<ul class="meta  meta--project">' . PHP_EOL;
			foreach ( $categories as $category ) {
				$cats .= '<li><a href="' . get_term_link( $category->slug, $category->taxonomy ) . '" title="' . esc_attr( sprintf( __( "View all projects in %s", 'pile' ), $category->name ) ) . '" rel="tag">' . $category->name . '</a></li>' . PHP_EOL;
			};
			$cats .= '</div>' . PHP_EOL;
		}

		return $cats;

	} #function

endif;

if ( ! function_exists( 'pile_portfolio_cats_list' ) ) :

	/**
	 * Prints HTML with comma separated category links for portfolio
	 *
	 * @since Pile 2.0
	 *
	 * @param int $post_ID Optional. Post ID
	 */
	function pile_portfolio_cats_list( $post_ID = null ) {

		echo pile_get_portfolio_cats_list( $post_ID );

	} #function

endif;

/**
 * Display the processed text content of a builder block
 *
 * @param string $content
 */
function pile_display_content( $content ) {

	global $wp_embed;

	$content = $wp_embed->autoembed( $content );

	$wptexturize     = apply_filters( 'wptexturize', $content );
	$convert_smilies = apply_filters( 'convert_smilies', $wptexturize );
	$convert_chars   = apply_filters( 'convert_chars', $convert_smilies );
	$content         = wpautop( $convert_chars );

	$content   = apply_filters( 'convert_chars', $content );

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

	if ( is_plugin_active( 'pixcodes/pixcodes.php' ) ) {
		$content = wpgrade_remove_spaces_around_shortcodes( $content );
	}

	$content = apply_filters( 'prepend_attachment', $content );

	echo do_shortcode( wp_unslash( $content ) );
}

/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @param WP_Query $the_query Optional.
 */
function pile_the_next_prev_nav( $the_query = null ) {
	global $wp_query;

	//use a custom query if given
	if (! empty( $the_query ) ) {
		$wp_query = $the_query;
	}

	// Don't print empty markup if there's only one page
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="pagination  pagination--archive" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Main navigation', 'pile' ); ?></h2>
		<div class="nav-links">

			<?php if ( get_previous_posts_link() ) : ?>
				<div class="nav-previous prev  nav-button"><?php previous_posts_link( '<span class="meta-nav">&larr;</span> ' . esc_html__( 'Prev', 'pile' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_next_posts_link() ) : ?>
				<div class="nav-next next  nav-button"><?php next_posts_link( esc_html__( 'Next', 'pile' ) . ' <span class="meta-nav">&rarr;</span> ' ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
	//cleanup
	if ( ! empty( $the_query ) ) {
		wp_reset_query();
	}
}

/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @param WP_Query $the_query Optional.
 */
function pile_the_older_newer_nav( $the_query = null) {
	global $wp_query;

	//use a custom query if given
	if ( ! empty( $the_query ) ) {
		$wp_query = $the_query;
	}

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="pagination  pagination--archive blog-nav" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Posts navigation', 'pile' ); ?></h2>
		<div class="nav-links">

			<?php if ( get_previous_posts_link() ) : ?>
				<div class="nav-previous prev nav-button"><?php previous_posts_link( '<span class="meta-nav">&larr;</span>' . esc_html__( 'Newer posts', 'pile' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_next_posts_link() ) : ?>
				<div class="nav-next next nav-button"><?php next_posts_link( esc_html__( 'Older posts', 'pile' ) . '<span class="meta-nav">&rarr;</span>' ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
	//cleanup
	if ( ! empty( $the_query ) ) {
		wp_reset_query();
	}
}

/**
 * @param null $attachment_ID
 * @param string $img_opacity
 *
 * @return bool
 */
function pile_the_hero_slide_background( $attachment_ID = null, $img_opacity = '100' ) {

	//do nothing if we have no ID
	if ( empty( $attachment_ID ) ) {
		return false;
	}

	$mime_type = get_post_mime_type( $attachment_ID );
	//bail if we couldn't get a mime type
	if ( empty( $mime_type ) ) {
		return false;
	}

	//sanitize the opacity
	//if is empty (probably because someone hasn't saved the project with the new metas) give it the default value
	if ( '' === $img_opacity ) {
		$img_opacity = '100';
	}

	//get the attachment meta data
	$attachment_fields = get_post_custom( $attachment_ID );

	$type = false;
	if ( false !== strpos( $mime_type, 'video' ) ) {
		// this is for sure an video
		$type = 'video';
	} elseif ( false !== strpos( $mime_type, 'image' ) ) { //we have some sort of image mime type
		if ( ! empty( $attachment_fields['_video_url'][0] ) ) {
			// the cruel, but interesting thing is that an image can be a video
			$type = 'video';
		} else {
			$type = 'image';
		}
	}

	//bail if we could not determine a type
	if ( empty( $type ) ) {
		return false;
	}

	switch ( $type ) {
		case 'video' :
			pile_the_hero_video( $attachment_ID, $img_opacity, false );
			break;

		case 'image' :
			pile_the_hero_image( $attachment_ID, $img_opacity );
			break;

		default :
			break;
	}

	//maybe someone is wondering if we have succeeded
	return true;
}

function pile_get_hero_description( $post = null, $link_project = false ) {

	if ( empty( $post ) ) {
		$post = get_queried_object();
	}

	//get the hero description alignment
	$hero_desc_position = get_post_meta( $post->ID, '_hero_description_alignment', true );

	ob_start();

	/* We have several cases that we need to treat separately due to their specific quirks */

	// First, we deal with the contact page that has a map as hero, hence some custom classes
	// also only the title is displayed (no description)
	if ( is_page( $post->ID ) && get_page_template_slug( $post->ID ) == 'page-templates/contact.php' ) { ?>

		<div class="hero-content <?php echo $hero_desc_position; ?>">
			<?php echo '<h1 class="hero-title  hero-title--map">' . get_the_title( $post ) . '</h1>'; ?>
		</div><!-- .hero-content -->

		<?php
		// Now for the rest of the bunch
	} else {
		$cover_description = get_post_meta( $post->ID, '_pile_header_cover_description', true );

		//legacy handling
		if ( empty( $cover_description ) && ! metadata_exists( 'post', $post->ID, '_pile_header_cover_description' ) ) {
			//this means that this meta doesn't exist in the database, hence the project was never saved, hence this is legacy content
			//in this case just add the project title
			// - we need the double quotes since the new line won't work inside single quotes
			$cover_description = "[project categories]\n<h1>" . get_the_title( $post->ID ) . '</h1>';
		} ?>

		<div class="hero-content <?php echo $hero_desc_position; ?>">

			<?php
			// First the hero cover content/description
			if ( ! empty( $cover_description ) ) {
				pile_display_content( $cover_description );
			}

			// Now for the View Project button, if that is the case
			if ( false !== $link_project ) {
				//we have been given something (even it is an empty string)
				//this means that someone wants us to show a button or an overlay link - something to link to the single post/project
				if ( ! empty( $link_project ) ) {
					echo '<a class="btn view-project-btn" href="' . esc_url( get_permalink( $post->ID ) ) . '">' . $link_project . '</a>';
				} else {
					// we need to link the project so we create a transparent overlay when there is no label
					echo '<a class="view-project-overlay" href="' . esc_url( get_permalink( $post->ID ) ) . '"></a>';
				}
			} ?>

		</div><!-- .hero-content -->

	<?php }

	return ob_get_clean();
}

function pile_the_hero_description ( $post = null, $link_project = false ){
	echo pile_get_hero_description( $post, $link_project );
}

function pile_has_hero_description ( $post = null, $link_project = false ){

	if ( empty( $post ) ) {
		$post = get_queried_object();
	}

	if ( is_page( $post->ID ) && get_page_template_slug( $post->ID ) == 'page-templates/contact.php' ) {
		return true;
	} elseif ( is_single( $post->ID ) && 'post' === get_post_type( $post->ID ) ) {
		return true;
	} else {
		$cover_description = get_post_meta( $post->ID, '_pile_header_cover_description', true );
		if ( ! empty( $cover_description ) ) {
			return true;
		}
	}

	return false;
}

/**
 * Display a hero video
 *
 * @param null $id
 * @param string $opacity
 * @param bool $ignore_video
 */
function pile_the_hero_video ($id = null, $opacity = 100, $ignore_video = false ) {

	//do nothing if we have no ID
	if ( empty( $id ) ) {
		return;
	}

	$mime_type = get_post_mime_type( $id );

	//sanitize the opacity
	if ( '' === $opacity ) {
		$opacity = 100;
	}

	$opacity = 'style="opacity: ' .(int) $opacity / 100 . ';"';

	$markup = '';
	$attachment = get_post( $id );

	if ( false !== strpos( $mime_type, 'video' ) ) {
		$mimetype = str_replace( 'video/', '', $mime_type );
		$image = "";
		if ( has_post_thumbnail( $id ) ) {
			$image = wp_get_attachment_url( get_post_thumbnail_id( $id ) );
		}
		echo '<div class="video-placeholder" data-src="' . $attachment->guid . '" data-poster="' . $image . '" ' . $opacity . '"></div>';
	} elseif ( false !== strpos( $mime_type, 'image' ) ) {

		$attachment_fields = get_post_custom( $id );
		$image_meta = get_post_meta( $id, '_wp_attachment_metadata', true );
		$image_full_size = wp_get_attachment_image_src( $id, 'full-size' );

		//prepare the attachment fields
		if ( ! isset( $attachment_fields['_wp_attachment_image_alt'] ) ) {
			$attachment_fields['_wp_attachment_image_alt'] = array('');
		} else {
			$attachment_fields['_wp_attachment_image_alt'][0] = trim( strip_tags( $attachment_fields['_wp_attachment_image_alt'][0] ) );
		}
		if ( ! isset( $attachment_fields['_video_autoplay'][0] ) ) {
			$attachment_fields['_video_autoplay'] = array('');
		}

		// prepare the video url if there is one
		$video_url = ( isset( $attachment_fields['_link_media_to'][0] ) && $attachment_fields['_link_media_to'][0] == 'custom_video_url' && isset( $attachment_fields['_video_url'][0] ) && ! empty( $attachment_fields['_video_url'][0]) ) ? esc_url( $attachment_fields['_video_url'][0] ) : '';

		if ( ! $ignore_video && ! empty( $video_url ) ) {
			// should the video auto play?
			$video_autoplay = ( $attachment_fields['_link_media_to'][0] == 'custom_video_url' && $attachment_fields['_video_autoplay'][0] === 'on' ) ? 'on' : '';
			$markup .= '<div class="' . ( ! empty( $video_url ) ? ' video' : '' ) . ( $video_autoplay == 'on' ? ' video_autoplay' : '' ) .'" itemscope itemtype="http://schema.org/ImageObject" ' . ( ! empty( $video_autoplay ) ? 'data-video_autoplay="'.$video_autoplay.'"' : '') . ' ' . $opacity . '>' . PHP_EOL;
			//the responsive image
			$image_markup = '<img data-rsVideo="'  . $video_url . '" class="rsImg" src="' . esc_url( $image_full_size[0] ) . '" alt="' . $attachment_fields['_wp_attachment_image_alt'][0] .'" />';
			$markup .= wp_image_add_srcset_and_sizes( $image_markup, $image_meta, $id ) . PHP_EOL;
			$markup .= '</div>';
		}
		echo $markup;
	}
}

/**
 * Display a hero single image
 *
 * @param null $id
 * @param string $opacity
 */
function pile_the_hero_image ($id = null, $opacity = 100 ) {

	// @todo move this in the loop function
	//if we have no ID then use the post thumbnail, if present
	if ( empty( $id ) ) {
		$id = get_post_thumbnail_id( get_the_ID() );
	}

	//do nothing if we have no ID
	if ( empty( $id ) ) {
		return;
	}

	//sanitize the opacity
	if ( '' === $opacity ) {
		$opacity = 100;
	}

	$opacity = 'style="opacity: ' .(int) $opacity / 100 . ';"';

	$markup = '';

	$image_meta = get_post_meta( $id, '_wp_attachment_metadata', true );
	$image_full_size = wp_get_attachment_image_src( $id, 'full-size' );

	//the responsive image
	$image_markup = '<img class="hero-bg hero-bg--image" itemprop="image" src="' . esc_url( $image_full_size[0] ) . '" alt="' . esc_attr( pile_get_img_alt( $id ) ) . '" '. $opacity . '>';
	$markup .= wp_image_add_srcset_and_sizes( $image_markup, $image_meta, $id ) . PHP_EOL;


	echo $markup;
}

/**
 * Display the inline style based on the current post's hero background color setting
 *
 * @param int $post_ID Optional. A post ID
 * @return void
 */
function pile_the_background_color_style( $post_ID = null ) {
	if ( empty( $post_ID ) ) {
		$post_ID = get_the_ID();
	}

	//bail if we don't have a post ID
	if ( empty( $post_ID ) ) {
		return;
	}

	$output = '';

	$background_color = trim( pile_get_the_hero_background_color( $post_ID ) );
	if ( ! empty( $background_color ) ) {
		$output .= 'style="background-color: ' . $background_color . ';"';
	}

	echo $output;
}

if ( ! function_exists('pile_please_select_a_menu') ) :

	/**
	 * When no menu is assigned to a certain menu area, display a message
	 */
	function pile_please_select_a_menu() {
		echo '<ul class="nav  nav--main sub-menu" >' . PHP_EOL;
		echo '<li><a href="' . admin_url( 'nav-menus.php?action=locations' ) . '">' . esc_html__( 'Please select a menu in this location', 'pile' ) . '</a></li>' . PHP_EOL;
		echo '</ul>' . PHP_EOL;
	}

endif;

if ( ! function_exists('pile_the_archive_title') ) :

	/**
	 * Display the archive title
	 */
	function pile_the_archive_title() {

		$object = get_queried_object();

		echo '<h1 class="page__title">';

		if ( is_home() ) {
			if ( isset( $object->post_title ) ) {
				echo $object->post_title;
			} else {
				esc_html_e( 'News', 'pile' );
			}
		} elseif ( is_search() ) {
			esc_html_e( 'Search Results for: ', 'pile' );
			echo get_search_query();
		} elseif ( is_tag() ) {
			echo single_tag_title( 'Tag: ', false );
		} elseif ( ! empty( $object ) && isset( $object->term_id ) ) {
			esc_html_e( 'Category: ', 'pile' );
			echo $object->name;
		} elseif ( is_day() ) {
			esc_html_e( 'Daily Archives: ', 'pile' );
			echo get_the_date();
		} elseif ( is_month() ) {
			esc_html_e( 'Monthly Archives: ', 'pile' );
			echo get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'pile' ) );
		} elseif ( is_year() ) {
			esc_html_e( 'Yearly Archives: ', 'pile' );
			echo get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'pile' ) );
		} else {
			esc_html_e( 'Archives', 'pile' );
		}

		echo '</h1>';
	}

endif;

//@todo CLEANUP refactor function
function wpgrade_better_excerpt( $text = '', $allowed_tags = '' ) {
	global $post;
	$raw_excerpt = '';

	//if the post has a manual excerpt ignore the content given
	if ( $text == '' && function_exists( 'has_excerpt' ) && has_excerpt() ) {
		$text        = get_the_excerpt();
		$raw_excerpt = $text;

		$text = strip_shortcodes( $text );
		$text = apply_filters( 'the_content', $text );
		$text = str_replace( ']]>', ']]&gt;', $text );

		// Removes any JavaScript in posts (between <script> and </script> tags)
		$text = preg_replace( '@<script[^>]*?>.*?</script>@si', '', $text );

		// Enable formatting in excerpts - Add HTML tags that you want to be parsed in excerpts
		if ( empty($allowed_tags) ) {
			$allowed_tags = '<p><a><strong><i><br><h1><h2><h3><h4><h5><h6><blockquote><ul><li><ol>';
		}
		$text         = strip_tags( $text, $allowed_tags );
		//		$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
		//		$text .= $excerpt_more;

	} else {

		if ( empty( $text ) ) {
			//need to grab the content
			$text = get_the_content();
		}

		$raw_excerpt = $text;
		$text        = strip_shortcodes( $text );
		$text        = apply_filters( 'the_content', $text );
		$text        = str_replace( ']]>', ']]&gt;', $text );

		// Removes any JavaScript in posts (between <script> and </script> tags)
		$text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);

		// Enable formatting in excerpts - Add HTML tags that you want to be parsed in excerpts
		if ( empty($allowed_tags) ) {
			$allowed_tags = '<p><a><em><strong><i><br><h1><h2><h3><h4><h5><h6><blockquote><ul><li><ol><iframe><embed><object><script>';
		}
		$text         = strip_tags( $text, $allowed_tags );

		// Set custom excerpt length - number of characters to be shown in excerpts
		if ( pile_option( 'blog_excerpt_length' ) ) {
			$excerpt_length = absint( pile_option( 'blog_excerpt_length' ) );
		} else {
			$excerpt_length = 180;
		}

		$excerpt_more = apply_filters( 'excerpt_more', ' ' . '[...]' );

		$options = array(
			'ending' => $excerpt_more,
			'exact'  => false,
			'html'   => true
		);
		$text    = truncate( $text, $excerpt_length, $options );

	}

	// IMPORTANT! Prevents tags cutoff by excerpt (i.e. unclosed tags) from breaking formatting
	$text = force_balance_tags( $text );

	return apply_filters( 'wp_trim_excerpt', $text, $raw_excerpt );
}

if ( ! function_exists('pile_body_attributes') ) :

	/**
	 * Display the <body> tag data attributes
	 */
	function pile_body_attributes() {
		$data_ajaxloading     = ( pile_option( 'use_ajax_loading' ) ) ? 'data-ajaxloading=""' : '';
		$data_main_color      = ( pile_option( 'main_color' ) ) ? 'data-color="' . pile_option( 'main_color' ) . '"' : '';

		// for a shop page we have a different parallax amount
		if ( class_exists( 'WooCommerce' ) && ( is_shop() || is_product_taxonomy() ) ) {
			$data_parallax_amount = 'data-parallax="' . pile_option( 'products_parallax_amount' ) . '"';
		} else {
			$data_parallax_amount = 'data-parallax="' . pile_option( 'parallax_amount' ) . '"';
		}

		//we use this so we can generate links with post id
		//right now we use it to change the Edit Post link in the admin bar
		$data_currentID         = '';
		$data_currentEditString = '';
		$data_currentTaxonomy   = '';
		if ( ( pile_option( 'use_ajax_loading' ) == 1 ) ) {
			global $wp_the_query;
			$current_object = $wp_the_query->get_queried_object();

			if ( ! empty( $current_object->post_type )
			     && ( $post_type_object = get_post_type_object( $current_object->post_type ) )
			     && current_user_can( 'edit_post', $current_object->ID )
			     && $post_type_object->show_ui && $post_type_object->show_in_admin_bar ) {

				$data_currentID = 'data-curpostid="' . $current_object->ID . '"';
				if ( isset( $post_type_object->labels ) && isset( $post_type_object->labels->edit_item ) ) {
					$data_currentEditString = 'data-curpostedit="' . $post_type_object->labels->edit_item . '"';
				}
			} elseif ( ! empty( $current_object->taxonomy )
			           && ( $tax = get_taxonomy( $current_object->taxonomy ) )
			           && current_user_can( $tax->cap->edit_terms )
			           && $tax->show_ui ) {

				$data_currentID       = 'data-curpostid="' . $current_object->term_id . '"';
				$data_currentTaxonomy = 'data-curtaxonomy="' . $current_object->taxonomy . '"';
				if ( isset( $tax->labels ) && isset( $tax->labels->edit_item ) ) {
					$data_currentEditString = 'data-curpostedit="' . $tax->labels->edit_item . '"';
				}
			} elseif ( is_page_template( 'page-templates/portfolio-archive.php' ) ) {
				$post_type_object = get_post_type_object( 'page' );
				$data_currentID = 'data-curpostid="' . $current_object->ID . '" ';
				if (isset($post_type_object->labels) && isset($post_type_object->labels->edit_item)) {
					$data_currentEditString = 'data-curpostedit="' . esc_attr( $post_type_object->labels->edit_item ) . '" ';
				}
			}
		}

		echo ' ' . $data_parallax_amount . ' ' . $data_ajaxloading . ' ' . $data_currentID . ' ' . $data_currentEditString . ' ' . $data_currentTaxonomy . ' ' . $data_main_color;
	}

endif;

/**
 * Display the hero class tag
 *
 * @param array $classes
 */
function pile_hero_classes( $classes = array() ) {

	if ( is_string( $classes ) ) {
		$classes = explode( ' ', $classes );
	}
	$classes = apply_filters( 'pile_hero_classes', $classes );

	if ( ! empty( $classes ) ) {
		echo 'class="' . join( ' ', $classes ) . '"';
	}
}

/**
 * Display the portfolio project list top wrapper class tag
 *
 * @param array $classes
 */
function pile_portfolio_classes( $classes = array() ) {

	if ( is_string( $classes ) ) {
		$classes = explode( ' ', $classes );
	}

	$classes = apply_filters( 'pile_portfolio_classes', $classes );

	if ( ! empty( $classes ) ) {
		echo 'class="' . join( ' ', $classes ) . '"';
	}
}

/**
 * Return the appropriate class depending on the size
 *
 * @param $size
 *
 * @return string
 */
function pile_get_block_size( $size ) {

	// just testing sizes
	switch ( (int) $size ) {
		case 1:
			$class = 'one-sixth';
			break;
		case 2:
			$class = 'two-sixths';
			break;
		case 3:
			$class = 'three-sixths';
			break;
		case 4:
			$class = 'four-sixths';
			break;
		case 5:
			$class = 'five-sixths';
			break;
		default:
			$class = 'one-whole';
			break;
	}

	return $class;
}