<?php
/**
 * Search Results Template
 */

// Multiple post types
query_posts(
	array_merge( // change original query
		$wp_query->query,
		array(
			'post_type' => array(
				'post',
				'page',
				'risen_multimedia',
				'risen_gallery',
				'risen_event',
				'risen_staff',
				'risen_location'
			)
		)
	)
);

// Header
get_header();

?>

<div id="content">

	<div id="content-inner"<?php if ( is_active_sidebar( 'search' ) ) : ?> class="has-sidebar"<?php endif; ?>>

		<section>

			<header class="title-with-right">
				<h1 class="page-title">
					<?php
					//$title = str_ireplace( '[keyword]', get_search_query(), risen_option( 'blog_search_title' ) ); // title format from Theme Options
					$title = sprintf( __( "Search results for '%s'", 'risen' ), get_search_query() );
					echo apply_filters( 'the_title', $title );
					?>
				</h1>
				<div class="page-title-right"><?php risen_post_count_message(); ?></div>
				<div class="clear"></div>
			</header>

			<div id="risen-search-results-form">
				<?php get_search_form(); ?>
			</div>
			
			<?php get_template_part( 'loop', 'search' ); // loop through posts, if any ?>

			<?php risen_posts_nav(); // prev/next page links ?>
			
			<?php if ( ! have_posts() ) : // show message if no posts ?>
			<p><?php _e( 'Sorry, your search did not return any results.', 'risen' ); ?></p>
			<?php endif; ?>
		
		</section>
		
	</div>

</div>

<?php get_sidebar( 'search' ); ?>

<?php get_footer(); ?>