<?php
/* Template Name: Staff */

// Get staff
$staff_query = new WP_Query( array(
	'post_type'			=> 'risen_staff',
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

		<div id="content-inner"<?php if ( risen_sidebar_enabled( 'staff' ) ) : ?> class="has-sidebar"<?php endif; ?>>
			
			<section>
			
				<?php if ( $content_title ) : // this comes from header-page.php; empty if no title should show at top of content ?>	
				<header>
					<h1 class="page-title"><?php echo $content_title; ?></h1>
				</header>
				<?php endif; ?>
				
				<?php if ( trim( strip_tags( $post->post_content ) ) ) : // has content ?>
					<div class="post-content">
						<?php the_content(); ?>
					</div>
				<?php endif; ?>
				
				<?php get_template_part( 'loop', 'staff' ); // loop and show each, if any ?>

				<?php risen_posts_nav( $staff_query, __( '<span>&larr;</span> Previous Staff', 'risen' ), __( 'Next Staff <span>&rarr;</span>', 'risen' ) ); ?>
				
				<?php if ( ! $staff_query->have_posts() ) : // show message if no posts ?>
				<p><?php _e( 'Sorry, there are no staff members to show.', 'risen' ); ?></p>
				<?php endif; ?>

			</section>

		</div>

	</div>

</article>

<?php risen_show_sidebar( 'staff' ); ?>

<?php endwhile; ?>

<?php get_footer(); ?>
