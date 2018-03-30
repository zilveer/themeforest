<?php
/**
 * The template for displaying single messages
 *
 *
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
						<div id="content" role="main">
							<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
								<div class="entry-content">
									<div class="fwrapper" style="margin-bottom: 30px;">
										<div class="finfo">
											<?php 
											$past = get_post_meta(get_the_ID(), 'netlabs_preacher' , true); 
											$evnt = get_post_meta(get_the_ID(), 'netlabs_messevent' , true);
											$dte = get_post_meta(get_the_ID(), 'netlabs_messagedate' , true);
											$pssg = get_post_meta(get_the_ID(), 'netlabs_passage' , true);
											$yout = get_post_meta(get_the_ID(), 'netlabs_messyoutube' , true);  
											$vimeo = get_post_meta(get_the_ID(), 'netlabs_messvimeo' , true); 
											$mplink = get_post_meta(get_the_ID(), 'netlabs_uploadlink' , true);      
											?>
											<p style="padding-top: 20px;"><?php echo $past; ?>
											<?php if ($evnt) {?>
					 						at  <?php echo $evnt; ?>
											<?php } ?>
											<?php if ($dte) {?>
					 						- <?php echo $dte; ?>
					 						<?php } ?>
					 						</p>
											<p><?php echo book_replace($pssg); ?></p>
										</div>
										<div class="ftd">
											<img class="loader" src="<?php echo get_template_directory_uri(); ?>/images/ajl2.gif">	
											<?php if ($yout) {?>	
											<div class="fvid" rel="<?php the_ID(); ?>">
												<a class="vid" href="http://www.youtube.com/watch?v=<?php echo $yout; ?>"><?php _e( 'video', 'wp-church' ); ?></a>
											</div>
											<?php } ?>
											<?php if ($vimeo) {?>	
											<div class="fvid" rel="<?php the_ID(); ?>">
												<a class="vim" href="http://vimeo.com/<?php echo $vimeo; ?>"><?php _e( 'video', 'wp-church' ); ?></a>
											</div>
											<?php } 
										 if ($mplink) {
											echo '<div rel="' . $mplink . '" class="fmp"></div>';
										} else {											
										 get_mpt(get_the_ID());
										}
										 
										?>									
										</div>
										<div class="clear"></div>
										<div class="infoholder" ></div>
									</div>
									<?php the_content(); ?>
									<?php netstudio_get_social(); ?>
								</div><!-- .entry-content -->
							</div><!-- #post-## -->

							<?php comments_template( '', true ); ?>

							<?php endwhile; ?>
						</div><!-- #content -->
					</div><!-- #container -->
					<?php get_sidebar(); ?>
					<?php get_footer(); ?>
