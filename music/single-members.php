<?php
/**
 * The template for displaying about page with members
 *
 *
 */

$settings = get_option( "ntl_theme_settings" );
get_header(); ?>

<?php 

	unset($arr1);
	$arr1 = array();
	unset($arr2);
	$arr2 = array();
	$counter = 1;
	
	$linkposts = get_posts('numberposts=10000&post_type=members');
	foreach($linkposts as $linkentry) :
	if ($counter%2 == 0) {
		$arr2[] = $linkentry->ID;
	} else {
		$arr1[] = $linkentry->ID;
	}
	$counter++;
	endforeach;	
	?>
	

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

<div class="bodymid hfeed hpage" style="padding-bottom: 30px;">
	<?php if ($settings['ntl_disable_audio'] != 'off'){	?>
		<div class="drawer">&nbsp;</div>
	<?php } ?>
	<div id="main">
		<div id="content" role="main">
			<div class="container clear">
				<div class="grid2 first mpage">
					<?php foreach($arr1 as $barr){
						echo '<h5 class="smallfont">' . get_the_title($barr) . '</h5><div class="mdiv"><a href="'. get_permalink($barr) .'">';
						echo get_the_post_thumbnail($barr,'teamthumb');
						echo '</a></div>';
						
					}
					?>
				</div>
				<div class="grid8 mdivmain" style="width: 580px;">
					<div id="content" role="main">
						<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
							<div class="inner">
								<div class="entry-content">													
									<?php the_content(); ?>						
								</div><!-- .entry-content -->
							</div>
						</div><!-- #post-## -->
						<?php endwhile; // end of the loop. ?>
					</div><!-- #content -->
				</div><!-- #container -->					
				<div class="grid2 mpage">
					<?php foreach($arr2 as $carr){
						$a_meta = get_post_meta($carr, 'netlabs_memtitle' , true); 
						echo '<h5 class="smallfont">' . get_the_title($carr) . '</h5><div class="mdiv"><a href="'. get_permalink($carr) .'">';
						echo get_the_post_thumbnail($carr,'teamthumb');
						echo '</a></div>';						
					}
					?>
				</div>			
			</div>
		</div>
	</div>
</div>
</div>

<?php lets_make_carousel(); ?>


<?php get_footer(); ?>