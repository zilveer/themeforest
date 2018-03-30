<?php
/**
 * The template for displaying the calendar page
 *
 */
 
 /**
Template Name: Calendar
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
							<div id="content" role="main" class="calselect">
								<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>				
									<div class="calmonth">
										<div class="monthselect">
											<?php echo prevlink('' , ''); ?>
											<span>|</span> 
											<?php echo nextlink('' , ''); ?>
										</div>
										<h1><?php echo monthname('',''); ?></h1>
										
									</div>	
									<div class="calentries"><?php echo get_the_calendar(date('n'),date('Y')); ?></div>				
									
									<div class="entry-content">
										<?php the_content(); ?>

									</div><!-- .entry-content -->
								</div><!-- #post-## -->
								<?php endwhile; ?>
							</div>
						</div>

						<?php if (get_option('nets_calside') == 'normal sidebar') { 
						get_sidebar();
						} else {
						get_sidebar( 'calendar' );
						} ?>
						
						<?php get_footer(); ?>
