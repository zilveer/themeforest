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
                            <article>
								
								<div class="post-body">
									<h1 class="post-title"><?php the_title( ); ?></h1>
									<?php
										$speakers_display_job = $theme_option['speakers_display_job'];
										$speakers_display_intro_description = $theme_option['speakers_display_intro_description'];
	
										$speaker_job = get_post_meta(get_the_id(), "_cmb_speaker_job", true);
										$speakers_layout = $theme_option['speakers_layout'];
										$speakers_speaker_link = $theme_option['speakers_speaker_link'];
										

										$speaker_mail_address = get_post_meta(get_the_id(), "_cmb_speaker_mail_address", true);
										$speaker_facebook_address = get_post_meta(get_the_id(), "_cmb_speaker_facebook_address", true);
										$speaker_twitter_address = get_post_meta(get_the_id(), "_cmb_speaker_twitter_address", true);
										$speaker_linkedin_address = get_post_meta(get_the_id(), "_cmb_speaker_linkedin_address", true);
										$speaker_pinterest_address = get_post_meta(get_the_id(), "_cmb_speaker_pinterest_address", true);
										$speaker_googleplus_address = get_post_meta(get_the_id(), "_cmb_speaker_googleplus_address", true);
										$speaker_tumblr_address = get_post_meta(get_the_id(), "_cmb_speaker_tumblr_address", true);
										$speaker_instagram_address = get_post_meta(get_the_id(), "_cmb_speaker_instagram_address", true);
										$speaker_vk_address = get_post_meta(get_the_id(), "_cmb_speaker_vk_address", true);
										$speaker_flickr_address = get_post_meta(get_the_id(), "_cmb_speaker_flickr_address", true);
										$speaker_mySpace_address = get_post_meta(get_the_id(), "_cmb_speaker_mySpace_address", true);
										$speaker_youtube_address = get_post_meta(get_the_id(), "_cmb_speaker_youtube_address", true);
										
											
										  
									?>
									<?php
									if($speakers_display_job){
									?>
									<p><?php echo wp_kses($speaker_job,true); ?></p>
									<?php }?>
									<?php
									$html = '';
										$html .= '<ul class="social-line list-inline ">';

										 if($speaker_mail_address){
													$html .= '<li><a target="_blank" href="mailto:'.$speaker_mail_address.'" class="facebook"><i class="fa fa-envelope"></i></a></li>';
												}
												if($speaker_facebook_address){
													$html .= '<li><a target="_blank" href="'.$speaker_facebook_address.'" class="twitter"><i class="fa fa-facebook"></i></a></li>';
												}
												if($speaker_twitter_address){
													$html .= '<li><a target="_blank" href="'.$speaker_twitter_address.'" class="google"><i class="fa fa-twitter"></i></a></li>';
												}
												if($speaker_linkedin_address){
													$html .= '<li><a target="_blank" href="'.$speaker_linkedin_address.'" class="linkedin"><i class="fa fa-linkedin"></i></a></li>';
												}
												if($speaker_pinterest_address){
													$html .= '<li><a target="_blank" href="'.$speaker_pinterest_address.'" class="instagram"><i class="fa fa-pinterest"></i></a></li>';
												}
												if($speaker_googleplus_address){
													$html .= '<li><a target="_blank" href="'.$speaker_googleplus_address.'" class="instagram"><i class="fa fa-google-plus"></i></a></li>';
												}
												if($speaker_tumblr_address){
													$html .= '<li><a target="_blank" href="'.$speaker_tumblr_address.'" class=""><i class="fa fa-tumblr"></i></a></li>';
												}
												if($speaker_instagram_address){
													$html .= '<li><a target="_blank" href="'.$speaker_instagram_address.'" class=""><i class="fa fa-instagram"></i></a></li>';
												}
												if($speaker_vk_address){
													$html .= '<li><a target="_blank" href="'.$speaker_vk_address.'" class=""><i class="fa fa-vk"></i></a></li>';
												}
												if($speaker_flickr_address){
													$html .= '<li><a target="_blank" href="'.$speaker_flickr_address.'" class=""><i class="fa fa-flickr"></i></a></li>';
												}
												if($speaker_mySpace_address){
													$html .= '<li><a target="_blank" href="'.$speaker_mySpace_address.'" class=""><i class="fa fa-users"></i></a></li>';
												}
												if($speaker_youtube_address){
													$html .= '<li><a target="_blank" href="'.$speaker_youtube_address.'" class=""><i class="fa fa-youtube"></i></a></li>';
												}


									  $html .= '</ul>';
									  echo wp_kses($html,true);
									?>
									
								</div>								
							</article>
							</div>		
							<div class="col-md-12">							
								<div class="post-excerpt">
									<?php the_content();
										wp_link_pages();                
									?>
								</div>
							</div>
                        <?php endwhile; ?>
                		<?php else: ?>
                    		<h1><?php _e('Nothing Found Here!', TEXT_DOMAIN); ?></h1>
                <?php endif; ?>	    
			    
                

			</section>
			<!-- Content -->

			<?php if($show_sidebar == 'yes'){ ?>

				<hr class="page-divider transparent visible-xs"/>\
				<aside id="sidebar" class="sidebar <?php echo esc_attr($sidebar_col); ?>">
					<?php dynamic_sidebar('sidebar-right' ); ?>
				</aside>

			<?php } ?>				
			

		</div>
	</div>
</section>
<!-- /PAGE BLOG -->

<?php get_footer(); ?>
