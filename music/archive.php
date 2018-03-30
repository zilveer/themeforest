<?php
/**
 * The template for displaying Archive pages.
 *
 */
$settings = get_option( "ntl_theme_settings" );
get_header(); ?>

<?php if ( have_posts() ) the_post();?>



	<div class="outer">
		<div class="frameset container clear">
			<?php if ($settings['ntl_disable_audio'] != 'off'){	?>
			<div class="clear headtop">	
				<div class="page-title">
					<h1 class="vfont">
						<?php if ( is_day() ) : ?>
						<?php printf( __( 'Daily Archives: <span>%s</span>', 'localize' ), get_the_date() ); ?>
						<?php elseif ( is_month() ) : ?>
						<?php printf( __( 'Monthly Archives: <span>%s</span>', 'localize' ), get_the_date('F Y') ); ?>
						<?php elseif ( is_year() ) : ?>
						<?php printf( __( 'Yearly Archives: <span>%s</span>', 'localize' ), get_the_date('Y') ); ?>
						<?php else : ?>
						<?php _e( 'Blog Archives', 'localize' ); ?>
						<?php endif; ?>							
					</h1>
				</div>
										
				<?php echo lets_get_albumselector(); ?>						
				<?php echo lets_get_musicplayer(); ?>
					
			</div>				
			<?php } else { ?>
			
			<div class="clear headtop" style="height: auto;">					
				<h1 class="vfont">
						<?php if ( is_day() ) : ?>
						<?php printf( __( 'Daily Archives: <span>%s</span>', 'localize' ), get_the_date() ); ?>
						<?php elseif ( is_month() ) : ?>
						<?php printf( __( 'Monthly Archives: <span>%s</span>', 'localize' ), get_the_date('F Y') ); ?>
						<?php elseif ( is_year() ) : ?>
						<?php printf( __( 'Yearly Archives: <span>%s</span>', 'localize' ), get_the_date('Y') ); ?>
						<?php else : ?>
						<?php _e( 'Blog Archives', 'localize' ); ?>
						<?php endif; ?>							
				</h1>			
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
				<?php rewind_posts(); ?>
				<div class="grid8 first">
					<div id="content" role="main">
						<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
							<div class="inner">
								<div class="entry-content">						
									<?php get_template_part( 'loop', 'archive' ); ?>				
									<?php adminace_paging(); ?>					
								</div><!-- .entry-content -->
							</div>
						</div><!-- #post-## -->
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