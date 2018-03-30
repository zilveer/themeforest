<?php
/**
 * The template for displaying Archive pages.
 *
 */

get_header(); ?>


<?php
	if ( have_posts() )
		the_post();
?>
<div class="lastmess">
	<div class="container">
		<div class="grid10 first">
			<h1 class="entry-title">
			<?php if ( is_day() ) : ?>
			<?php printf( __( 'Daily Archives: <span>%s</span>', 'wp-church' ), get_the_date() ); ?>
			<?php elseif ( is_month() ) : ?>
			<?php printf( __( 'Monthly Archives: <span>%s</span>', 'wp-church' ), get_the_date('F Y') ); ?>
			<?php elseif ( is_year() ) : ?>
			<?php printf( __( 'Yearly Archives: <span>%s</span>', 'wp-church' ), get_the_date('Y') ); ?>
			<?php else : ?>
			<?php _e( 'Blog Archives', 'wp-church' ); ?>
			<?php endif; ?>			
			</h1>
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

<?php rewind_posts(); ?>


<div class="bodymid">
	<div class="stripetop">
		<div class="stripebot">
			<div class="container">
				<div class="mapdiv"></div>
					<div class="clear"></div>
					<div id="main">
						<div class="grid8 first">		
							<div id="content" role="main">
								<?php get_template_part( 'loop', 'archive' ); ?>				
								<?php adminace_paging(); ?>

							</div>
						</div>

						<?php get_sidebar(); ?>
						<?php get_footer(); ?>
