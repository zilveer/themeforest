<?php
/*
 * Gallery Category Taxonomy Template
 *
 * Posts per page is set with option_posts_per_page filter (see functions.php), not by modifying query here
 * Refer to this for reason: http://wordpress.org/support/topic/custom-post-type-taxonomy-pagination
 */

// Get ID of page to inherit header image / sidebar setup from
$gallery_page_id = risen_option( 'gallery_page_id' );

// Taxonomy term
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); // category slug

// Header
get_template_part( 'header', 'gallery-archive' );

?>

<div id="content">

	<div id="content-inner"<?php if ( risen_sidebar_enabled( 'gallery', $gallery_page_id, 'gallery_page_inherit_archives' ) ) : ?> class="has-sidebar"<?php endif; ?>>

		<section>
		
			<header class="title-with-right">
				<h1 class="page-title">
					<?php
					$title = str_ireplace( '[category]', $term->name, risen_option( 'gallery_category_title' ) ); // title format from Theme Options
					echo apply_filters( 'the_title', $title );
					?>
				</h1>
				<div class="page-title-right"><?php risen_post_count_message(); ?></div>
				<div class="clear"></div>
			</header>
			
			<?php if ( ! empty( $term->description ) ) : ?>
			<?php echo wpautop( $term->description ); ?>
			<?php endif; ?>
			
			<?php get_template_part( 'loop', 'gallery' ); // loop and show each item ?>

			<?php risen_posts_nav( $gallery_query, _x( '<span>&larr;</span> Newer Items', 'gallery', 'risen' ), _x( 'Older Items <span>&rarr;</span>', 'gallery', 'risen' ) ); ?>
			
			<?php if ( ! have_posts() ) : // show message if no posts ?>
			<p><?php _e( 'Sorry, there are no items to show.', 'risen' ); ?></p>
			<?php endif; ?>
			
		</section>
		
	</div>

</div>

<?php risen_show_sidebar( 'gallery', $gallery_page_id, 'gallery_page_inherit_archives' ); ?>

<?php get_footer(); ?>