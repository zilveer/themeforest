<?php get_header(); ?>

<?php
/* Queue the first post, that way we know
 * what author we're dealing with (if that is the case).
 *
 * We reset this later so we can run the loop
 * properly with a call to rewind_posts().
 */
the_post();
?>


<!-- #page-header -->
<div id="page-header" class="clearfix">
<div class="ht-container">
<h1><?php the_author() ?></h1>
<p><?php printf( __( 'Posts by %s', 'framework' ), '<span class="vcard">' . get_the_author() . '</span>' ); ?></p>
</div>
</div>
<!-- /#page-header --> 

<!-- #primary -->
<div id="primary" class="sidebar-right clearfix">
<div class="ht-container">
<!-- #content -->
<section id="content" role="main">


<?php if ( have_posts() ) : ?>		

			<?php
				/* Since we called the_post() above, we need to
				 * rewind the loop back to the beginning that way
				 * we can run the loop properly, in full.
				 */
				rewind_posts();
			?>

			<?php
			// If a user has filled out their description, show a bio on their entries.
			if ( get_the_author_meta( 'description' ) ) : ?>
			<div class="author-info">
				<div class="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), 120, '', get_the_author_meta( 'display_name' ) ); ?>
				</div><!-- .author-avatar -->
				<div class="author-description entry-content">
					<h2><?php printf( __( 'About %s', 'twentytwelve' ), get_the_author() ); ?></h2>
					<p><?php the_author_meta( 'description' ); ?></p>
				</div><!-- .author-description	-->
			</div><!-- .author-info -->
			<?php endif; ?>

			<?php /* Start the Loop */ ?>

			<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', get_post_format() ); ?>

			<?php endwhile; ?>

			<?php st_content_nav( 'nav-below' ); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

  </section>
  <!-- /#content -->
  
<?php get_sidebar(); ?>

</div>
</div>
<!-- /#primary -->

<?php get_footer(); ?>