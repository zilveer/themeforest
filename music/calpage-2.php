<?php
/**
 * The template for displaying the calendar page
 *
 */
 
 /**
Template Name: Calendar(Upcomming)
 */
$settings = get_option( "ntl_theme_settings" );
get_header(); ?>


<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	
	<?php update_option( 'ntl_calpage', get_the_ID() ); ?> 

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
			

<div class="bodymid hfeed hpage" style="padding-bottom: 60px;">
	<?php if ($settings['ntl_disable_audio'] != 'off'){	?>
		<div class="drawer">&nbsp;</div>
	<?php } ?>

	<div id="main">
		<div id="content" role="main">
			<div class="container clear">
			</div>
			<div class="container clear calselect">
				
				<div id="post-<?php the_ID(); ?>" class="page">									
					<div class="calentries"><?php echo get_the_upcommings(30); ?></div>		
				</div><!-- #post-## -->
				<?php endwhile; ?>
			</div>
		</div>
	</div>
</div>
</div>
<?php lets_make_carousel(); ?>


						
<?php get_footer(); ?>
