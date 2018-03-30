<?php
/* Template Name: Locations */

// Get locations
$locations_query = new WP_Query( array(
	'post_type'			=> 'risen_location',
	'posts_per_page'	=> -1, /* show all */
	'orderby'			=> 'menu_order',
	'order'				=> 'ASC'
) );

// Header
get_template_part( 'header', 'page' ); // this makes $content_title available

?>

<?php while ( have_posts() ) : the_post(); ?>

<article>

	<div id="content">

		<div id="content-inner"<?php if ( risen_sidebar_enabled( 'locations' ) ) : ?> class="has-sidebar"<?php endif; ?>>
			
			<section>
			
				<?php if ( $content_title ) : // this comes from header-page.php; empty if no title should show at top of content ?>	
				<header>
					<h1 class="page-title"><?php echo $content_title; ?></h1>
				</header>
				<?php endif; ?>
				
				<?php if ( trim( strip_tags( $post->post_content ) ) ) : // has content ?>
					<div class="post-content"> <!-- confines heading font to this content -->
						<?php the_content(); ?>
					</div>
				<?php endif; ?>
				
				<?php get_template_part( 'loop', 'locations' ); // loop and show each, if any ?>

				<?php risen_posts_nav( $locations_query, __( '<span>&larr;</span> Previous Locations', 'risen' ), __( 'Next Locations <span>&rarr;</span>', 'risen' ) ); ?>
				
				<?php if ( ! $locations_query->have_posts() ) : // show message if no posts ?>
				<p><?php _e( 'Sorry, there are no locations to show.', 'risen' ); ?></p>
				<?php endif; ?>

			</section>

		</div>

	</div>

</article>

<?php risen_show_sidebar( 'locations' ); ?>

<?php endwhile; ?>

<?php get_footer(); ?>