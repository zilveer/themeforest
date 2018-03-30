<?php 

get_header(); ?>
				
	<div class="swm_container <?php echo swm_page_post_layout_type(); ?>" >	
			<div class="swm_column swm_custom_two_third">	

				<section class="swm_sermons sermons_single">		

				<?php
				if (have_posts()) :
					while (have_posts()) : the_post();

						$postid = get_the_id();						
						$permalink = get_permalink( $postid  );
						$title = get_the_title( $postid  );
						$swm_sermons_video = rwmb_meta('swm_sermons_video');
						$swm_sermons_audio = rwmb_meta('swm_sermons_audio');
						$swm_sermons_pdf = rwmb_meta('swm_sermons_pdf');
						$swm_sermons_text = rwmb_meta('swm_sermons_text');
						$swm_sermons_img = get_the_post_thumbnail($postid,'medium');
						?>

						<article class="swm_sermons_item">
						
							<div class="swm_sermons_top">
								
								<div class="swm_sermons_date_meta">
									<div class="swm_sermons_date">
										<span class="sermon_date"><?php echo get_the_date('d'); ?></span>
										<span class="sermon_day"><?php echo get_the_date('M'); ?></span>					
									</div>
									<div class="swm_sermons_meta">
										<ul>											
											<?php

											if ( $swm_sermons_video ) {
												echo '<li><a href="#" class="tipUp playSermonVideo" title="'. apply_filters( 'swm_sermons_video_text', __( 'Video', 'swmtranslate' ) ) . '"><i class="fa fa-video-camera"></i></a></li>';
											}

											if ( $swm_sermons_audio ) {
												echo '<li><a href="#" class="tipUp playSermonAudio" title="'. apply_filters( 'swm_sermons_audio_text', __( 'Audio', 'swmtranslate' ) ) . '"><i class="fa fa-headphones"></i></a></li>';
											}

											if ( $swm_sermons_pdf ) {
												echo '<li><a href="'.$swm_sermons_pdf.'" class="tipUp" title="'. apply_filters( 'swm_sermons_pdf_text', __( 'PDF', 'swmtranslate' ) ) . '" target="_blank"><i class="fa fa-download"></i></a></li>';
											}

											if ( $swm_sermons_text ) {
												echo '<li><a href="'.$swm_sermons_text.'" class="tipUp" title="'. apply_filters( 'swm_sermons_more_details_text', __( 'More Details', 'swmtranslate' ) ) . '" target="_blank"><i class="fa fa-book"></i></a></li>';
											}
											?>
										</ul>					
									</div>
								</div>								
								
							</div>
							<div class="swm_sermons_content">
								<div class="swm_sermons_title">
									<h2><?php echo $title; ?></h2>
									<div class="swm_sermons_text">

										<?php if ( $swm_sermons_video || $swm_sermons_audio ) { ?>	

											<div class="swm_sermons_audioVideo">

												<?php if ( $swm_sermons_video ) { ?>
													<div class="fitVids swm_sermon_video">
														<?php echo $swm_sermons_video; ?>
													</div>
												<?php } ?>

												<?php if ( $swm_sermons_audio ) { ?>
													<div class="swm_sermon_audio">
														<audio id="player2"  class="sermonAudio" src="<?php echo $swm_sermons_audio; ?>" type="audio/mp3" controls="controls"></audio>					
													</div>
												<?php } ?>

											</div>	

										<?php } ?>								

										<?php if ( get_theme_mod('swm_sermons_single_image',1) && $swm_sermons_img != '' ) {	?>
											<div class="swm_sermons_img">
												<a href="<?php echo $permalink; ?>" title="<?php echo $title; ?>">
												<?php echo $swm_sermons_img; ?>										
												</a>
											</div>
										<?php } ?>
										<?php the_content(); ?>
									</div>														
								</div>
							</div>
									
						</article> <!-- swm_sermons_box -->
						<?php
					endwhile;					
				endif;
				?>

				</section>

				<div class="clear"></div>

				<?php 

					$swm_sermons_comments = get_theme_mod('swm_sermons_comments',0);		
					if ($swm_sermons_comments) {						
						comments_template('', true); 						
					}	

				?>
			
				<div class="clear"></div>
			</div>			
		
		<?php get_sidebar(); ?>

	</div>	<?php
 
get_footer();