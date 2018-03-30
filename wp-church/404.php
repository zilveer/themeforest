<?php
/**
 * The template for displaying the 404 page
 *
 *
 */

get_header(); ?>


<div class="lastmess">
	<div class="container">
		<div class="grid10 first">
			<h1 class="entry-title"><?php _e( 'Not Found', 'wp-church' ); ?></h1>
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
									<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'wp-church' ); ?></p>
								</div>
							</div>
						</div>
					</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>