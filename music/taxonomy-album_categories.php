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
				<?php $counter = 0; ?>
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<?php if (($counter % 3) == 0) {?>
				<div class="grid4 first">
				<?php } else { ?>
				<div class="grid4">
				<?php } ?>
					<h3 class="h0 smallfont stitle"><?php the_title(); ?></h3>
					<div class="entry-content menu-content">
						<div class="imgblock">
							<div class="imlk imgoverlink7 menimg" >
								<?php the_post_thumbnail('albmlink'); ?> 
								<a href="<?php the_permalink(); ?>" class="imgoverlink imgoverlink7 imgdown" /><span class="imgblockover imgoverlink7" >click</span></a>
							</div> 
						</div>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->	
				<?php $counter++; ?>								
				<?php endwhile; ?>
				<div class="clear"></div>
			</div>
			<?php adminace_paging(); ?>
		</div>
	</div>
</div>
</div>
<?php lets_make_carousel(); ?>


<?php get_footer(); ?>
