<?php global $pmc_data, $sitepress;
wp_enqueue_script('pmc_bxSlider');	
?>
<script type="text/javascript">
jQuery(document).ready(function($){
	jQuery('.bxslider').bxSlider({
		auto: true,
		speed: 600,
		pause: 6000,
		pager :false,
		easing : 'easeInOutQuint',
		prevText : '<i class="fa fa-angle-left"></i>',
		nextText : '<i class="fa fa-angle-right"></i>',	  
	});
});	
</script>
<!-- top bar with breadcrumb with portfolio navigation--> 
<!-- main content start -->
<div class="mainwrap">
	<div class="main clearfix portsingle">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php  $portfolio = get_post_custom($post->ID); ?>
	
	<div class="pad"></div>
	<div class="content fullwidth">
		<div class="blogpost postcontent port" >
			<div class="projectdetails">	
					<div class = "imageFrame"></div>
						<div class="blogsingleimage">	
						<?php 
						if(isset($portfolio['show_video'][0]) && $portfolio['show_video'][0]){
						
							$video_arg  = '';
							$video = wp_oembed_get( $portfolio['video'][0], $video_arg );		
							$video = preg_replace('/width=\"(\d)*\"/', 'width="700"', $video);			
							$video = preg_replace('/height=\"(\d)*\"/', 'height="500"', $video);	
							echo $video;
							} else { 
								$args = array(
									'post_type' => 'attachment',
									'numberposts' => null,
									'post_status' => null,
									'post_parent' => $post->ID,
									'orderby' => 'menu_order',
									'order' => 'ASC'
								);
								$attachments = get_posts($args);
								if ($attachments) {?>
									<div id="slider" >
										<ul class="bxslider">
											<?php
												foreach ($attachments as $attachment) {
													//echo apply_filters('the_title', $attachment->post_title);
													$image =  wp_get_attachment_image_src( $attachment->ID, 'sinbgleport' ); ?>	
														<li>
															<img class="check" src="<?php echo $image[0] ?>" />				
																	
														</li>
														
														<?php 
														$i++;
														} ?>
								
										</ul>
									</div>
								  <?php } else { ?>
									<a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_the_id() )) ?>" rel="lightbox[port]" title="<?php the_title() ?>"><?php echo pmc_getImage(get_the_id(),'sinbgleport'); ?></a>
								  <?php } 
							} ?>						
						</div>	
						
					<div class="bottomborder"></div>
			</div>
			<div class="projectdescription">
				
				<div class="datecomment">
					<p>
						<div class = "project-section">
							<?php if($portfolio['customer'][0] !='') {?>
								<i class="fa fa-user"></i><?php _e('Client','pmc-themes'); ?> <span class="author port"><?php echo $portfolio['customer'][0] ?></span><br>
							<?php } ?>
						</div>
						
						<div class = "project-section">
							<?php if($portfolio['date'][0] !='') {?>
								<i class="fa fa-calendar"></i><?php _e('Date of completion','pmc-themes');  ?> <span class="posted-date port"><?php echo $portfolio['date'][0] ?></span><br>
							<?php } ?>
						</div>
						
						<div class = "project-section">
							<?php if($portfolio['author'][0] !='') {?>
								<i class="fa fa-user"></i><?php _e('Project designer','pmc-themes');  ?> <span class="authorp port"><?php echo $portfolio['author'][0] ?></span><br>
							<?php } ?>
						</div>
						
						<div class="single-portfolio-skils">
					<?php
					if(isset($portfolio['skils'][0])){
					echo '<ul>';
					foreach(explode("\n", $portfolio['skils'][0]) as $line) {
						echo '<li><i class="fa fa-check-square"></i>'.$line.'</li>';
					} 
					echo '</ul>';
					}?>
				</div>
						<div class = "project-section last">
							<?php if($portfolio['detail_active'][0]) {
								if($portfolio['detail_active'][0]) { ?>
								   <span class="link"><a target="_blank" href="http://<?php echo $portfolio['website_url'][0] ?>" title="project url"> <?php _e('VIEW THE PROJECT','pmc-themes');  ?></a></span>  </br>
							<?php } else { ?>
								   <span class="link"><a title="project url"> <?php _e('VIEW THE PROJECT','pmc-themes');  ?></a></span> 
							<?php }  ?>
						
							<?php } ?>
						</div>
														
					</p>
						
				</div>	
				
				<div class="socialsingle"><?php pmc_socialLinkSingle() ?></div>	
						
				
				
				
								
			</div>
				
			</div>
		
			<div class="posttext"> 
				<div> <?php  the_content(); ?> </div>	
			</div>
			
			<div class = "portnavigation">
								
				<span><?php next_post_link('%link','<div class="portprev-single">'. __('Previous Project','pmc-themes') .'<div class="link-title-next">%title</div></div>',false,''); ?> </span>
				<span><a href=" <?php echo $pmc_data['portfolio_icon_link'] ?>" class="portfolio-grid"><i class="fa fa-th"></i></a></span>
				<span><?php previous_post_link('%link', '<div class="portnext-single">'. __('Next Project','pmc-themes') .'<div class="link-title-previous">%title</div></div>' ,false,''); ?> </span>
			
			
			
			</div>
			
	</div>	
	
	
					
	<?php endwhile; else: ?>
	
	<?php endif; ?>
		<div class="portfolio">		
			
			<h2 class="h3border"><?php _e('Related <span>project</span>','pmc-themes'); ?></h2>
			<div class="titleborder"></div>		
			<div id="portitems4">
				<?php pmc_portfolio('port3',3,'port',3,'','false','','','','homePort',0,'related') ?>	
				
			</div>
		</div>	
	</div>
</div>