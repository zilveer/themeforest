<?php
/**
 * The template for displaying Category Archive pages.
 *
 */
$settings = get_option( "ntl_theme_settings" );
get_header(); ?>


	<div class="outer">
		<div class="frameset container clear">
			<?php if ($settings['ntl_disable_audio'] != 'off'){	?>
			<div class="clear headtop">	
				<div class="page-title" >
					<h1 class="vfont"><?php printf( __( 'Search Results for:', 'localize' ), '<p>' . get_search_query() . '</>' ); ?> <?php printf( __( ' %s ', 'localize' ), get_search_query() ); ?></h1>
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

<div class="bodymid hfeed hpage" style="padding-bottom: 30px;">
	<?php if ($settings['ntl_disable_audio'] != 'off'){	?>
		<div class="drawer">&nbsp;</div>
	<?php } ?>
	<div id="main">
		<div id="content" role="main">
			<div class="container clear">
				<div class="grid8 first sres">		
					<div id="content" role="main">
						<?php get_template_part( 'loop', 'category' ); ?>				
						<?php adminace_paging(); ?>
					</div>
				</div>
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</div>
</div>

<?php lets_make_carousel(); ?>


<?php get_footer(); ?>
