<?php
/** The main template file **/
global $theme_option;
global $wp_query;

get_header();

$show_sidebar =  get_post_meta($wp_query->get_queried_object_id(), "_cmb_show_sidebar", true) ? get_post_meta($wp_query->get_queried_object_id(), "_cmb_show_sidebar", true) : 'yes';
if($show_sidebar == 'yes'){
	$main_col = 'col-sm-8 col-md-9';
	$sidebar_col = 'col-sm-4 col-md-3';
}else{
	$main_col = 'col-sm-12';
}

?>

<!-- PAGE BLOG -->
<section class="page-section with-sidebar sidebar-right">
	<div class="container">
		<div class="row">

			<!-- Content -->
			<section id="content" class="content <?php echo esc_attr($main_col); ?>">
				<?php  if(have_posts()) : while(have_posts()) : the_post(); ?>
							<div class="col-md-4">
								<div class="post-media1">
									<?php echo get_the_post_thumbnail(get_the_id(), 'medium'); ?>
								</div><br/>
							</div>
							<div class="col-md-8">
								<?php
								$html = '';
								$filter_orderby = $theme_option['schedule_order_by'];
								$filter_order = $theme_option['schedule_order'];
								$schedule_display_thumbnail = $theme_option['schedule_display_thumbnail'];
								$schedule_display_time = $theme_option['schedule_display_time'];    
								$schedule_display_button_cricle = $theme_option['schedule_display_button_cricle'];
								$schedule_display_author = $theme_option['schedule_display_author'];
								$schedule_display_author_job = $theme_option['schedule_display_author_job'];    
								$schedule_display_desc = $theme_option['schedule_display_desc'];
								$schedule_count_word = $theme_option['schedule_count_word'];
								
							  $schedule_timetext = get_post_meta(get_the_id(), "_cmb_schedule_timetext", true);
							  $schedule_author = get_post_meta(get_the_id(), "_cmb_schedule_author", true);
							  $schedule_author_job = get_post_meta(get_the_id(), "_cmb_schedule_author_job", true);							  
							  $schedule_mail_address = get_post_meta(get_the_id(), "_cmb_schedule_mail_address", true);
							  $schedule_facebook_address = get_post_meta(get_the_id(), "_cmb_schedule_facebook_address", true);
							  $schedule_twitter_address = get_post_meta(get_the_id(), "_cmb_schedule_twitter_address", true);
							  $schedule_linkedin_address = get_post_meta(get_the_id(), "_cmb_schedule_linkedin_address", true);
							  $schedule_pinterest_address = get_post_meta(get_the_id(), "_cmb_schedule_pinterest_address", true);
							  $schedule_googleplus_address = get_post_meta(get_the_id(), "_cmb_schedule_googleplus_address", true);
							  $schedule_tumblr_address = get_post_meta(get_the_id(), "_cmb_schedule_tumblr_address", true);
							  $schedule_instagram_address = get_post_meta(get_the_id(), "_cmb_schedule_instagram_address", true);
							  $schedule_vk_address = get_post_meta(get_the_id(), "_cmb_schedule_vk_address", true);
							  $schedule_flickr_address = get_post_meta(get_the_id(), "_cmb_schedule_flickr_address", true);
							  $schedule_mySpace_address = get_post_meta(get_the_id(), "_cmb_schedule_mySpace_address", true);
							  $schedule_youtube_address = get_post_meta(get_the_id(), "_cmb_schedule_youtube_address", true);
							  
								$html .= '
								  <article class="post-wrap" data-animation="fadeInUp" data-animation-delay="300">
									  <div class="media">';										  
										  $html .= '<div class="media-body">
											  <div class="post-header">
												  <div class="post-meta"><h1 class="post-title">'.get_the_title().'</h1>';												  
													  if($schedule_display_time){
														$html .= '<span class="post-date"><i class="fa fa-clock-o"></i> '.$schedule_timetext.'</span>';
													  }
												  $html .= '</div>
											  </div>';
											  
											  $html .='
											  <div class="post-footer">
												  <span class="post-readmore">';
													  if($schedule_display_author){
														$html .= '<i class="fa fa-microphone"></i> <strong>'.$schedule_author.'</strong> / ';
														if($schedule_display_author_job){
														  $html .= $schedule_author_job.'&nbsp;&nbsp;';    
														}
													  }                                                                  

													  if($schedule_mail_address){
														  $html .= '<a target="_blank" href="mailto:'.$schedule_mail_address.'" ><i class="fa fa-envelope">&nbsp;</i></a>';
													  }
													  if($schedule_facebook_address){
														  $html .= '<a target="_blank" href="'.$schedule_facebook_address.'" ><i class="fa fa-facebook">&nbsp;</i></a>';
													  }
													  if($schedule_twitter_address){
														  $html .= '<a target="_blank" href="'.$schedule_twitter_address.'" ><i class="fa fa-twitter">&nbsp;</i></a>';
													  }
													  if($schedule_linkedin_address){
														  $html .= '<a target="_blank" href="'.$schedule_linkedin_address.'" ><i class="fa fa-linkedin">&nbsp;</i></a>';
													  }
													  if($schedule_pinterest_address){
														  $html .= '<a target="_blank" href="'.$schedule_pinterest_address.'" ><i class="fa fa-pinterest">&nbsp;</i></a>';
													  }
													  if($schedule_googleplus_address){
														  $html .= '<a target="_blank" href="'.$schedule_googleplus_address.'" ><i class="fa fa-google-plus">&nbsp;</i></a>';
													  }
													  if($schedule_tumblr_address){
														  $html .= '<a target="_blank" href="'.$schedule_tumblr_address.'" ><i class="fa fa-tumblr">&nbsp;</i></a>';
													  }
													  if($schedule_instagram_address){
														  $html .= '<a target="_blank" href="'.$schedule_instagram_address.'" ><i class="fa fa-instagram">&nbsp;</i></a>';
													  }
													  if($schedule_vk_address){
														  $html .= '<a target="_blank" href="'.$schedule_vk_address.'" ><i class="fa fa-vk">&nbsp;</i></a>';
													  }
													  if($schedule_flickr_address){
														  $html .= '<a target="_blank" href="'.$schedule_flickr_address.'" ><i class="fa fa-flickr">&nbsp;</i></a>';
													  }
													  if($schedule_mySpace_address){
														  $html .= '<a target="_blank" href="'.$schedule_mySpace_address.'" ><i class="fa fa-users">&nbsp;</i></a>';
													  }
													  if($schedule_youtube_address){
														  $html .= '<a target="_blank" href="'.$schedule_youtube_address.'" ><i class="fa fa-youtube">&nbsp;</i></a>';
													  }

												  $html .= '</span>
											  </div>
										  </div>                                                      
									  </div>
								  </article>';
								  echo wp_kses($html,true);  
								?>
							
							
							
							</div>
							<div class="col-md-12">
	                            <article>
									
									<div class="post-body">
										
										<div class="post-excerpt">
											<?php the_content();
												wp_link_pages();                
											?>
										</div>
									</div>								
								</article>
							</div>							
                        <?php endwhile; ?>
                		<?php else: ?>
                    		<h1><?php _e('Nothing Found Here!', TEXT_DOMAIN); ?></h1>
                <?php endif; ?>	    
			    
                

			</section>
			<!-- Content -->

			<?php if($show_sidebar == 'yes'){ ?>

				<hr class="page-divider transparent visible-xs"/>
				<aside id="sidebar" class="sidebar <?php echo esc_attr($sidebar_col); ?>">
					<?php dynamic_sidebar('sidebar-right' ); ?>
				</aside>

			<?php } ?>					
			

		</div>
	</div>
</section>
<!-- /PAGE BLOG -->

<?php get_footer(); ?>
