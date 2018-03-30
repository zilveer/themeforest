<?php
/**
 * The Template for displaying all single posts.
 *
 */
$settings = get_option( "ntl_theme_settings" );
get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	
	

	<div class="outer">
		<div class="frameset container clear">
			<?php if ($settings['ntl_disable_audio'] != 'off'){	?>
			<div class="clear headtop">	
				<div class="page-title" >
					<h1 class="vfont"><?php the_title(); ?></h1>
				</div>
										
				<?php echo lets_get_albumselector(); ?>						
				<?php echo lets_get_musicplayer(); ?>
					
			</div>				
			<?php } else { ?>
			
			<div class="clear headtop" style="height: auto;">					
				<div class="page-title" style="width: 100%; margin-bottom: 40px;">
					<h1 class="vfont"><?php the_title(); ?></h1>
				</div>			
			</div>
			
			<?php } ?>
			
			<?php if (!$settings['ntl_show_timer']) { ?>
				<div class="cdowntop">	
				<?php echo get_for_timer(''); ?>
			<?php } else { ?>
				<div class="cdownnone">
			<?php }	?>

<div class="bodymid hfeed hpage">
	<?php if ($settings['ntl_disable_audio'] != 'off'){	?>
		<div class="drawer">&nbsp;</div>
	<?php } ?>
	<div id="main">
		<div id="content" role="main">
			<div class="container clear">
				<div class="grid8 first">
					<div id="content" role="main">
						<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
							<div class="inner">
								<div class="entry-content">						
									<?php the_content(); ?>						
									<div class="socialcontent">
										<?php netstudio_get_social(); ?>
									</div>
								</div><!-- .entry-content -->
							</div>
						</div><!-- #post-## -->
						<?php comments_template( '', true ); ?>
						<?php endwhile; // end of the loop. ?>
					</div><!-- #content -->
				</div><!-- #container -->
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</div>
</div>

<?php lets_make_carousel(); ?>


<?php get_footer(); ?>
