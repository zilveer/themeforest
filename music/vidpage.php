<?php
/**
 * The template for displaying about page with members
 *
 *
 */

/**
 Template Name: video
 */
$settings = get_option( "ntl_theme_settings" );
get_header(); ?>



	<div class="outer">
		<div class="frameset container clear">
			<?php if ($settings['ntl_disable_audio'] != 'off'){	?>
			<div class="clear headtop">	
				<div class="page-title" >
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<h1 class="vfont"><?php the_title(); ?></h1>
					<?php endwhile; // end of the loop. ?>
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
				<div class="grid12 first mdivmain">
					<div id="content" role="main">
						<div id="hentry">	
							<div class="inner">
								<div class="entry-content clear">
																		
									<?php 
									
									$args=array(
										'post_type'=>'videos',
										'showposts'=> 10000,
									);	
									
									$counter = 0;		
	
									$my_query = new WP_Query($args);
									if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post();
									
									$a_meta = get_post_meta(get_the_ID(), 'option1', true);
									$b_meta = get_post_meta(get_the_ID(), 'option2', true);
									$c_meta = get_post_meta(get_the_ID(), 'option3', true);
									$d_meta = get_post_meta(get_the_ID(), 'option4', true);
									
									
									if ($counter == 0){
										
										if ($b_meta == 'Youtube'){
											echo '<div class="vidplayerdiv"><iframe width="640" height="400" src="http://www.youtube.com/embed/' . $a_meta  .  '" frameborder="0" allowfullscreen></iframe></div>';
										}
										
										if ($b_meta == 'Vimeo'){
											echo '<div class="vidplayerdiv"><iframe src="http://player.vimeo.com/video/' . $a_meta  .  '?title=0&amp;byline=0&amp;portrait=0" width="640" height="400" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe></div>';
										}
										
										echo '
										<div class="vidstripouter">
										<a class="vidprev" href="#">previous</a>
										<div class="vidstrip"><div class="vidstripinner">	
										';
										
									}
																		
									if ($b_meta == 'Youtube'){
										echo '<div class="vidimg ytimg"><a href="#" rel="' .$a_meta.'" class="ytlink"><img src="' .$c_meta.'"></a></div>';
									}
										
									if ($b_meta == 'Vimeo'){
										echo '<div class="vidimg"><a href="#" rel="' .$a_meta.'" class="vmlink"><img src="' . $c_meta.'"></a></div>';
									}								
									$counter++;
									
									endwhile;
									else : endif;
									wp_reset_query();							
									?>	
									</div></div>
									<a class="vidnext" href="#">previous</a>
									</div>		
								</div><!-- .entry-content -->
							</div>
						</div><!-- #post-## -->
						
					</div><!-- #content -->
				</div><!-- #container -->					
						
			</div>
		</div>
	</div>
</div>
</div>

<?php lets_make_carousel(); ?>


<?php get_footer(); ?>