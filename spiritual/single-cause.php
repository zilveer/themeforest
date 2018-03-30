<?php 

get_header(); ?>
				
	<div class="swm_container <?php echo swm_page_post_layout_type(); ?>" >	
			<div class="swm_column swm_custom_two_third">	

				<section class="swm_causes cause_single">		

				<?php
				if (have_posts()) :
					while (have_posts()) : the_post();

						$postid = get_the_id();						
						$permalink = get_permalink( $postid  );
						$title = get_the_title( $postid  );
						$swm_cause_raised = rwmb_meta('swm_cause_raised_amount');
						$swm_cause_goal = rwmb_meta('swm_cause_goal_amount');
						$swm_cause_donors = rwmb_meta('swm_cause_total_donors');
						$swm_cause_img = get_the_post_thumbnail($postid,'thumbnail');
						?>

						<article class="swm_cause_item">
						
							<div class="swm_cause_top">
							<?php if ( get_theme_mod('swm_cause_single_image',1) && $swm_cause_img != '' ) {	?>
								<div class="swm_cause_img">
									<a href="<?php echo wp_get_attachment_url(get_post_thumbnail_id($postid)) ?>" title="<?php echo $title; ?>">
									<?php echo $swm_cause_img; ?>										
									</a>
								</div>
							<?php } ?>
								<div class="swm_cause_meta">
									<ul>
										<li>
											<div class="swm_cause_bar">									
												<div class="swm_cause_bar_block">
													<span class="swm_cause_bar_out swm_dark_gradient" style="width:<?php echo swm_get_percentage($swm_cause_raised,$swm_cause_goal) ?>%">
														<span class="swm_cause_bar_in"></span>
													</span>
												</div>
												<div class="clear"></div>
											</div>
										</li>
										<li><span class="cause_meta_label"><?php echo apply_filters( 'swm_cause_raised_text',__( 'Raised', 'swmtranslate' ) );  ?></span><?php echo $swm_cause_raised; ?></li>
										<li><span class="cause_meta_label"><?php echo apply_filters( 'swm_cause_goal_text',__( 'Goal', 'swmtranslate' ) );  ?></span><?php echo $swm_cause_goal; ?></li>
										<li><span class="cause_meta_label"><?php echo apply_filters( 'swm_cause_donors_text',__( 'Donors', 'swmtranslate' ) );  ?></span><?php echo $swm_cause_donors; ?></li>
									</ul>							
								</div>
							</div>
							<div class="swm_cause_content">
								<div class="swm_cause_title">
									<h2><?php echo $title; ?></h2>
									<div class="swm_cause_text">
										<?php the_content('');?>										
									</div>														
								</div>
							</div>
									
						</article> <!-- swm_cause_box -->
						<?php
					endwhile;					
				endif;
				?>

				</section>

				<div class="clear"></div>

				<?php 

					$swm_cause_comments = get_theme_mod('swm_cause_comments',0);		
					if ($swm_cause_comments) {						
						comments_template('', true); 						
					}	

				?>
			
				<div class="clear"></div>
			</div>			
		
		<?php get_sidebar(); ?>

	</div>	<?php
 
get_footer();