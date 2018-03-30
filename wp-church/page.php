<?php
/**
 * The template for displaying all pages.
 *
 *
 */

get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<div class="lastmess">
	<div class="container">
		<div class="grid10 first">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</div>
		<div class="grid2 dirr">
			<?php if (get_option('nets_reassdir')){ ?>
			<a href="<?php echo get_option('nets_reassdir'); ?>"><span><?php echo get_option('nets_sptdir'); ?></span></a>
			<?php } else { ?>
				<a class="vmp" href="#"><span><?php echo get_option('nets_sptdir'); ?></span></a>
			<?php } ?>
		</div>
	</div>
</div>
<div class="bodymid">
	<div class="stripetop">
		<div class="stripebot">
			<div class="container">
				<div class="mapdiv"></div>
				<div class="clear"></div>
				<div id="main">
					<div class="grid8 first">	
						<div id="content" role="main">
							<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	

								<div class="entry-content">
									<?php the_content(); ?>
									<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'wp-church' ), 'after' => '</div>' ) ); ?>
									<?php edit_post_link( __( 'Edit', 'wp-church' ), '<span class="edit-link">', '</span>' ); ?>
								</div><!-- .entry-content -->
							</div><!-- #post-## -->
							<?php if (get_option('nets_commpage')  == 'true') {?>
							<?php comments_template( '', true ); ?>
							<?php } ?>
							<?php endwhile; ?>

						</div><!-- #content -->
					</div><!-- #container -->

					<?php get_sidebar(); ?>
					<?php get_footer(); ?>