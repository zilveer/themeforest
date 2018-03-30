<?php
/**
 * The template for displaying group Archive pages.
 *
 */
$settings = get_option( "ntl_theme_settings" );
get_header(); ?>



	<div class="outer">
		<div class="frameset container clear">
			<?php if ($settings['ntl_disable_audio'] != 'off'){	?>
			<div class="clear headtop">	
				<div class="page-title" >
					<h1 class="vfont"><?php single_cat_title(); ?></h1>
				</div>
										
				<?php echo lets_get_albumselector(); ?>						
				<?php echo lets_get_musicplayer(); ?>
					
			</div>				
			<?php } else { ?>
			
			<div class="clear headtop" style="height: auto;">					
				<div class="page-title" style="width: 100%; margin-bottom: 40px;">
					<h1 class="vfont"><?php single_cat_title(); ?></h1>
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
				<div class="groupcat grid8 first" style="margin-top: 0px;">							
					<?php $counter = 1; ?>
					<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<?php if ($counter % 2 != 0 ) {?>
					<div class="grid4 first" style="margin: 0px;">
					<?php } else { ?>
					<div class="grid4">
					<?php } ?>
						<h4 class="h0 smallfont galfont"><?php the_title(); ?></h4>
						<div class="entry-content gal-content">
							<div class="imgblock">
								<div class="imlk imgoverlink6">
									<?php the_post_thumbnail('imlink'); ?> 
									<span class="imgblockover imgoverlink6 galinvoke galcat" rel="<?php the_ID(); ?>">click</span>
								</div>
							</div> 
						</div><!-- .entry-content -->
					</div><!-- #post-## -->	
					<?php $counter++; ?>								
					<?php endwhile; ?>
					<div class="clear"></div>
					<?php adminace_paging(); ?>
				</div>	
				<?php get_sidebar(); ?>							
			</div>
		</div>
	</div>
</div>
</div>

<?php lets_make_carousel(); ?>



<?php get_footer(); ?>
