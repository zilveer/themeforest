<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Listable
 */

if ( ! function_exists( 'listable_get_option' ) ) {
	/**
	 * Get option from the database
	 *
	 * @param string
	 *
	 * @return mixed
	 */
	function listable_get_option( $option, $default = null ) {
		global $pixcustomify_plugin;

		// if there is set an key in url force that value
		if ( isset( $_GET[ $option ] ) && ! empty( $option ) ) {

			return $_GET[ $option ];

		} elseif ( $pixcustomify_plugin !== null ) {

			$customify_value = $pixcustomify_plugin->get_option( $option, $default );

			return $customify_value;
		}

		return $default;
	} //end function
} // end if listable_get_option exists


/**
 * Function to display the logo added by the theme support 'custom-logo'.
 * This was implemented in 4.5, to use the old logo install jetpack
 */

if ( ! function_exists( 'listable_display_logo' ) ) {
	function listable_display_logo() {
		// Display the inverted logo if all the requirements are met
		$logo_invert = wp_get_attachment_image_src( listable_get_option('logo_invert') );
		$header_transparent = listable_get_option( 'header_transparent' );
		if ( $header_transparent && ! empty( $logo_invert[0] ) && is_page_template( 'page-templates/front_page.php' ) ) {
			$html = sprintf( '<div class="site-branding  site-branding--image"><a href="%1$s" class="custom-logo-link  custom-logo-link--light" rel="home" itemprop="url">%2$s</a></div>',
				esc_url( home_url( '/' ) ),
				wp_get_attachment_image( listable_get_option('logo_invert'), 'full', false, array(
					'class'    => 'custom-logo',
					'itemprop' => 'logo',
				) )
			);

			echo $html;
		}
		// or else display the regular logo
		elseif ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			// For transferring existing site logo from Jetpack -> Core
			if ( ! get_theme_mod( 'custom_logo' ) && $jp_logo = get_option( 'site_logo' ) ) {
				set_theme_mod( 'custom_logo', $jp_logo['id'] );
				delete_option( 'site_logo' );
			}

			echo '<div class="site-branding  site-branding--image">';
			the_custom_logo();
			echo '</div>';
		}
		// or else display the text logo.
		else { ?>
			<div class="site-branding">
				<h1 class="site-title  site-title--text"><a class="site-logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			</div><!-- .site-branding -->
		<?php }
	}
}


if ( ! function_exists( 'listable_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function listable_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			'<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		);
		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
	}
endif;

if ( ! function_exists( 'listable_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function listable_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'listable' ) );
			if ( $categories_list && listable_categorized_blog() ) {
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'listable' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'listable' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'listable' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'listable' ), esc_html__( '1 Comment', 'listable' ), esc_html__( '% Comments', 'listable' ) );
			echo '</span>';
		}
//
//	edit_post_link(
//		sprintf(
//			/* translators: %s: Name of current post */
//			esc_html__( 'Edit %s', 'listable' ),
//			the_title( '<span class="screen-reader-text">"', '"</span>', false )
//		),
//		'<span class="edit-link">',
//		'</span>'
//	);
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function listable_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'listable_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'listable_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so listable_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so listable_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in listable_categorized_blog.
 */
function listable_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'listable_categories' );
}

add_action( 'edit_category', 'listable_category_transient_flusher' );
add_action( 'save_post', 'listable_category_transient_flusher' );

function listable_display_term_icon( $term_id = null, $size = 'thumbnail' ) {

	$img_src = listable_get_term_icon_url( $term_id, $size );

	if ( ! empty( $img_src ) ) { ?>
		<div class="icon_wrapper">
			<img src="<?php echo $img_src; ?>">
		</div>
	<?php }

}

/**
 * @param null $post_id
 * @param int $decimalsdisplays the rating score for the current post
 */
function display_average_listing_rating( $post_id = null, $decimals = 2 ) {

	if ( empty( $post_id ) ) {
		global $post;
		$post_id = $post->ID;
	}

	global $pixreviews_plugin;

	if ( method_exists( $pixreviews_plugin, 'get_average_rating' ) ) {
		$rating = $pixreviews_plugin->get_average_rating( $post_id, $decimals );
	}

	if ( empty( $rating ) ) {
		return;
	} ?>
	<a href="#comments" class="single-rating review_rate display-only" data-pixrating="<?php echo $rating ?>" itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
		<span class="rating-value">(<span itemprop="reviewCount"><?php echo get_comments_number() ?></span>)</span>
		<meta itemprop="ratingValue" content = "<?php echo $rating ?>">
	</a>
	<?php
}

/**
 * Returns the rating score for the current post
 *
 * @param null $post_id
 * @param int $decimals
 *
 * @return bool
 */
function get_average_listing_rating( $post_id = null, $decimals = 2 ) {

	if ( empty( $post_id ) ) {
		global $post;
		$post_id = $post->ID;
	}

	global $pixreviews_plugin;
	if ( method_exists( $pixreviews_plugin, 'get_average_rating' ) ) {
		return $pixreviews_plugin->get_average_rating( $post_id, $decimals );
	}

	return false;
}

if ( ! function_exists( 'shape_comment' ) ) :
	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @since Listable
	 */
	function shape_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' : ?>
				<li class="post pingback">
				<p><?php esc_html_e( 'Pingback:', 'listable' ); ?><?php comment_author_link(); ?><?php edit_comment_link( esc_html__( '(Edit)', 'listable' ), ' ' ); ?></p>
				<?php
				break;
			default :
				if ( 'job_listing' == get_post_type() ) : ?>
					<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>" itemprop="review" itemscope itemtype="http://schema.org/Review">
					<div class="comment-wrapper">
						<header class="comment-header">
							<div class="comment-author vcard" itemprop="author" itemscope itemtype="http://schema.org/Person">
								<?php
								echo get_avatar( $comment, 75 );
								echo sprintf( '<span class="fn">%s</span>', get_comment_author_link() ); ?>
							</div><!-- .comment-author .vcard -->
							<?php if ( $comment->comment_approved == '0' ) : ?>
								<em><?php esc_html_e( 'Your comment is awaiting moderation.', 'listable' ); ?></em>
								<br/>
							<?php endif; ?>
						</header>
						<div class="comment-content" itemprop="reviewBody">
							<?php comment_text(); ?>
						</div>
						<div class="reply">
							<?php comment_reply_link( array_merge( $args, array(
								'depth'     => $depth,
								'max_depth' => $args['max_depth']
							) ) ); ?>
						</div><!-- .reply -->
					</div>
				<?php else : ?>
					<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
					<div class="comment-wrapper">
						<div class="comment-avatar"><?php echo get_avatar( $comment, 75 ); ?></div>
						<header class="comment-header">
							<div class="comment-author vcard">
								<?php echo sprintf( '<span class="fn">%s</span>', get_comment_author_link() ); ?>
							</div><!-- .comment-author .vcard -->
							<?php if ( $comment->comment_approved == '0' ) : ?>
								<em><?php esc_html_e( 'Your comment is awaiting moderation.', 'listable' ); ?></em>
								<br/>
							<?php endif; ?>
							<div class="comment-meta commentmetadata">
								<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
									<time pubdate datetime="<?php comment_time( 'c' ); ?>">
										<?php printf( esc_html__( 'on %1$s', 'listable' ), get_comment_date() ); ?>
									</time>
								</a><?php edit_comment_link( esc_html__( '(Edit)', 'listable' ), ' ' ); ?>
							</div>
						</header>
						<div class="comment-content">
							<?php comment_text(); ?>
						</div>
						<div class="reply">
							<?php comment_reply_link( array_merge( $args, array(
								'depth'     => $depth,
								'max_depth' => $args['max_depth']
							) ) ); ?>
						</div><!-- .reply -->
					</div>
				<?php endif;
				break;
		endswitch;
	}
endif; // ends check for shape_comment()


function listable_move_comment_date( $comment_content ) {
	global $comment;

	$commentDateTime = new DateTime( $comment->comment_date );
	$commentIsoDate = $commentDateTime->format(DateTime::ISO8601);

	ob_start(); ?>
	<div class="comment-meta commentmetadata" itemprop="datePublished" content = "<?php echo $commentIsoDate; ?>">
<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>"><?php
		/* translators: 1: date, 2: time */
		printf( esc_html__( 'on %1$s', 'listable' ), get_comment_date() ); ?></time>
	</a><?php edit_comment_link( esc_html__( '(Edit)', 'listable' ), ' ' ); ?></div><?php

	return ob_get_clean() . $comment_content;
}

/**
 * Due to the fact that we need a wrapper for center aligned images and for the ones with alignnone, we need to wrap the images without a caption
 * The images with captions already are wrapped by the figure tag
 *
 * @param string $content
 *
 * @return string
 */
function listable_wrap_images_in_figure( $content ) {
	$classes = array( 'aligncenter', 'alignnone' );

	foreach ( $classes as $class ) {

		//this regex basically tells this
		//match all the images that are not in captions and that have the X class
		//when an image is wrapped by an anchor tag, match that too
		$regex = '~\[caption[^\]]*\].*\[\/caption\]|((?:<a[^>]*>\s*)?<img.*class="[^"]*' . $class . '[^"]*[^>]*>(?:\s*<\/a>)?)~i';

		// php 5.2 valid
		$callback = new ListableWrapImagesInFigureCallback( $class );
		$content = preg_replace_callback(
				$regex,
				// in the callback function, if Group 1 is empty,
				// set the replacement to the whole match,
				// i.e. don't replace
				array( $callback, 'callback' ),
				$content );
	}

	return $content;
}

//We need to use a class so we can pass the $class variable to the callback function
class ListableWrapImagesInFigureCallback {
	private $class;
	function __construct( $class ) {
		$this->class = $class;
	}
	public function callback( $match ) {
		if ( empty( $match[1] ) ) {
			return $match[0];
		}
		return '<span class="' . $this->class . '">' . $match[1] . '</span>';
	}
}

add_filter( 'the_content', 'listable_wrap_images_in_figure' );

function listable_display_frontpage_listing_categories( $default_count = 7 ) {
	$term_list = array();

	//first let's do only one query and get all the terms - we will reuse this info to avoid multiple queries
	$query_args = array( 'orderby' => 'count', 'order' => 'DESC', 'hide_empty' => false, 'hierarchical' => true, 'pad_counts' => true );

	$all_terms = get_terms(
			'job_listing_category',
			$query_args
	);

	//bail if there was an error
	if ( is_wp_error( $all_terms ) ) {
		return;
	}

	//now create an array with the category slug as key so we can reference/search easier
	$all_categories = array();
	foreach ( $all_terms as $key => $term ) {
		$all_categories[ $term->slug ] = $term;
	}

	$categories             = get_post_meta( get_the_ID(), 'frontpage_listing_categories', true );
	$custom_category_labels = array();

	//if we have received a list of categories to display (their slugs and optional label), use that
	if ( ! empty( $categories ) ) {
		$categories = explode( ',', $categories );
		foreach ( $categories as $key => $category ) {
			if ( strpos( $category, '(' ) !== false ) {
				$category  = explode( '(', $category );
				$term_slug = trim( $category[0] );

				if ( substr( $category[1], - 1, 1 ) == ')' ) {
					$custom_category_labels[ $term_slug ] = trim( substr( $category[1], 0, - 1 ) );
				}

				if ( array_key_exists( $term_slug, $all_categories ) ) {
					$term_list[] = $all_categories[ $term_slug ];
				}
			} else {
				$term_slug   = trim( $category );

				if ( array_key_exists( $term_slug, $all_categories ) ) {
					$term_list[] = $all_categories[ $term_slug ];
				}
			}
		}
	} else {
		//it seems we will have to figure out ourselves what categories to display

		$term_list = array_slice( $all_categories, 0, $default_count);
	}

	foreach ( $term_list as $key => $term ) :
		if ( ! $term || ( is_array( $term ) && isset( $term['invalid_taxonomy'] ) ) ) {
			continue;
		} ?>

		<a href="<?php echo esc_url( get_term_link( $term ) ); ?>">

			<?php
			$url = listable_get_term_icon_url( $term->term_id );
			$attachment_id = listable_get_term_icon_id( $term->term_id );
			if ( ! empty( $url ) ) : ?>

				<span class="cat__icon"><?php listable_display_image( $url, '', true, $attachment_id ); ?></span>

			<?php endif; ?>

			<span class="cat__text"><?php echo isset( $custom_category_labels[ $term->slug ] ) ? $custom_category_labels[ $term->slug ] : $term->name; ?></span>
		</a>

	<?php endforeach;

	if ( $term_list ) {
		echo '<div style="position: relative;"><span class="cta-text">' . esc_html__( 'Or browse the highlights', 'listable' ) . '</span></div>';
	}
}

function listabe_get_the_password_form( $post = 0 ) {
	$post = get_post( $post );
	$label = 'pwbox-' . ( empty($post->ID) ? rand() : $post->ID );
	$check_pass = listable_is_password_protected();

	if ( ! empty( $check_pass['error'] ) ) {
		echo '<h4 class="text--error">';
		echo  $check_pass['error'];
		echo '</h4>';
	}

	$output = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post">
	<p>' . esc_html__( 'This content is password protected. To view it please enter your password below:', 'listable' ) . '</p>
	<p><label for="' . $label . '">' . esc_html__( 'Password:', 'listable' ) . ' <input name="post_password" id="' . $label . '" type="password" size="20" /></label> <input type="submit" name="Submit" value="' . esc_attr__( 'Submit', 'listable' ) . '" /></p></form>
	';

	return $output;
}

/**
 * Filter the HTML output for the protected post password form.
 *
 * If modifying the password field, please note that the core database schema
 * limits the password field to 20 characters regardless of the value of the
 * size attribute in the form input.
 *
 * @since 2.7.0
 *
 * @param string $output The password form HTML output.
 */
add_filter( 'the_password_form', 'listabe_get_the_password_form' );

function listable_get_listings_page_url( $default_link = null  ) {
	//if there is a page set in the Listings settings use that
	$listings_page_id = get_option( 'job_manager_jobs_page_id', false );
	if ( ! empty( $listings_page_id ) ) {
		return get_permalink( $listings_page_id );
	}

	if ( $default_link !== null ) {
		return $default_link;
	}
	return get_post_type_archive_link( 'job_listing' );
}
