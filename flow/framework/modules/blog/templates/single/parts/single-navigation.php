<?php
if(isset($post_id)){
	$id = $post_id;
}else{
	$id = get_the_ID();
}
	 
if(flow_elated_options()->getOptionValue('blog_single_navigation') == 'yes'){
	
	$prev_post = get_previous_post($id);
	$next_post = get_next_post($id);
	$navigation_blog_through_category = flow_elated_options()->getOptionValue('blog_navigation_through_same_category');
?>
<div class="eltd-blog-single-navigation">
	<div class="eltd-blog-single-navigation-inner clearfix">
		<?php if(get_previous_post($id) != ""){ ?>
			<div class="eltd-blog-single-prev-holder">
				
				<?php if(has_post_thumbnail($prev_post->ID)){?>
						<div class="eltd-blog-single-prev">
							<?php
							$prev_post_image = get_the_post_thumbnail($prev_post->ID, array(600,400));
							if($navigation_blog_through_category == 'yes'){
								previous_post_link('%link',$prev_post_image, true,'','category');
							} else {
								previous_post_link('%link',$prev_post_image);
							}
							?>
						</div>
				<?php } ?>
				
				<div class = "eltd-blog-single-prev-info">
					<div class="eltd-blog-navigation-info-holder clearfix">
						<a href ="<?php echo esc_attr(get_permalink($prev_post->ID))?>" >
							<span class="arrow_carrot-left eltd-navigation-icon"></span>
							<span class ="eltd-blog-navigation-info">
								<?php esc_html_e( 'Previous post', 'flow' )?>
							</span>
						</a>
					</div>					
					<a class="eltd-blog-single-nav-title" href="<?php echo esc_attr(get_permalink($prev_post->ID))?>">
						<?php echo esc_attr(get_the_title($prev_post->ID))?>
					</a>	
				</div>
			</div>
		<?php } ?>
		<?php if(get_next_post($id) != ""){ ?>
		<div class="eltd-blog-single-next-holder">
			<div class = "eltd-blog-single-next-info clearfix">
				<div class="eltd-blog-navigation-info-holder clearfix">
					<a href ="<?php echo esc_attr(get_permalink($next_post->ID))?>" >
						<span class ="eltd-blog-navigation-info">
							<?php esc_html_e( 'Next post', 'flow' )?>
						</span>
						<span class="arrow_carrot-right eltd-navigation-icon"></span>
					</a>
				</div>	
				<a href="<?php echo esc_attr(get_permalink($next_post->ID))?>" class="eltd-blog-single-nav-title">
					<?php echo esc_attr(get_the_title($next_post->ID))?>
				</a>
			</div>
			<?php if(has_post_thumbnail($next_post->ID)){?>
				<div class="eltd-blog-single-next">
					<?php
					$next_post_image = get_the_post_thumbnail($next_post->ID, array(600,400));

					if($navigation_blog_through_category == 'yes'){
						next_post_link('%link',$next_post_image, true,'','category');
					} else {
						next_post_link('%link',$next_post_image);
					}
					?>
				</div>
			<?php } ?>
		</div>

		<?php } ?>
	</div>
</div>
<?php } ?>