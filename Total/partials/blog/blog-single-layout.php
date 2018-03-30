<?php
/**
 * Single blog post layout
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.3.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<article class="single-blog-article clr"<?php wpex_schema_markup( 'blog_post' ); ?>>

	<?php
	// Get single blog layout blocks
	$post_format       = get_post_format();
	$password_required = post_password_required();

	/*-----------------------------------------------------------------------------------*/
	/*  - Blog post layout
	/*  - All blog elements can be re-ordered via the WP Customizer so don't edit this
	/*  - file unless you really have to.
	/*-----------------------------------------------------------------------------------*/

	// Quote format is completely different
	if ( 'quote' == $post_format ) :

		get_template_part( 'partials/blog/blog-single-quote' );

		return;

	// Blog Single Post Composer
	else :

		// Get layout blocks
		$layout_blocks = wpex_blog_single_layout_blocks();

		// Loop through blocks
		foreach ( $layout_blocks as $block ) :

			// Post title
			if ( 'title' == $block ) {

				get_template_part( 'partials/blog/blog-single-title' );

			}

			// Post meta
			elseif ( 'meta' == $block ) {

				get_template_part( 'partials/blog/blog-single-meta' );

			}

			// Featured Media - featured image, video, gallery, etc
			elseif ( 'featured_media' == $block ) {

				if ( ! $password_required && ! get_post_meta( get_the_ID(), 'wpex_post_media_position', true ) ) {

					$post_format = $post_format ? $post_format : 'thumbnail';
					
					get_template_part( 'partials/blog/media/blog-single', $post_format );

				}
				
			}

			// Post Series
			elseif ( 'post_series' == $block ) {
				
				get_template_part( 'partials/blog/blog-single-series' );

			}

			// Get post content
			elseif ( 'the_content' == $block ) {

				get_template_part( 'partials/blog/blog-single-content' );

			}

			// Post Tags
			elseif ( 'post_tags' == $block && ! $password_required ) {

				get_template_part( 'partials/blog/blog-single-tags' );

			}

			// Social sharing links
			elseif ( 'social_share' == $block
					&& wpex_global_obj( 'has_social_share' )
					&& ! $password_required
			) {
				
				get_template_part( 'partials/social-share' );
			   
			}

			// Author bio
			elseif ( 'author_bio' == $block
					&& get_the_author_meta( 'description' )
					&& 'hide' != get_post_meta( get_the_ID(), 'wpex_post_author', true )
					&& ! $password_required
			) {

				get_template_part( 'author-bio' );

			}

			// Displays related posts
			elseif ( 'related_posts' == $block ) {

				get_template_part( 'partials/blog/blog-single-related' );

			}

			// Get the post comments & comment_form
			elseif ( 'comments' == $block ) {

				comments_template();

			}

			// Custom Blocks
			else {

				get_template_part( 'partials/blog/blog-single', $block );

			}

		endforeach;

	endif; ?>

</article><!-- .entry -->