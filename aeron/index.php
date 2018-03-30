<?php 

get_header();

$cat_id = get_query_var('cat');
$cat_data = get_option("category_$cat_id"); 
$read_more = __('Read More','ABdev_aeron').' <i class="whhg-share"></i>';

global $ABdev_aeron_title_bar_title;

if(is_category()){
	$thisCat = get_category(get_query_var('cat'), false);
	$ABdev_aeron_title_bar_title = $thisCat -> name;
}

get_template_part('title_breadcrumb_bar'); 

?>
	
	<section>
		<div class="container">

			
			<?php if($cat_data['sidebar_position']=='timeline'): 
				$i = 0;
			?>
				<div id="timeline_posts" class="clearfix">
				<?php if (have_posts()) :  while (have_posts()) : the_post(); 
					$i++;
					$classes = array();
					$classes[0] = 'timeline_post';
					if($i==1){
						$classes[1] = 'timeline_post_first';
					}
				?>
					<div <?php post_class($classes); ?>>
						<?php
						$custom = get_post_custom();

						if(isset($custom['ABdevFW_selected_media'][0]) && $custom['ABdevFW_selected_media'][0]=='soundcloud' && isset($custom['ABdevFW_soundcloud'][0]) && $custom['ABdevFW_soundcloud'][0]!=''){
							echo '<iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F'.$custom['ABdevFW_soundcloud'][0].'"></iframe>';
						}
						elseif(isset($custom['ABdevFW_selected_media'][0]) && $custom['ABdevFW_selected_media'][0]=='youtube' && isset($custom['ABdevFW_youtube_id'][0]) && $custom['ABdevFW_youtube_id'][0]!=''){
							echo '<div class="videoWrapper-youtube"><iframe src="http://www.youtube.com/embed/'.$custom['ABdevFW_youtube_id'][0].'?showinfo=0&amp;autohide=1&amp;related=0" frameborder="0" allowfullscreen></iframe></div>';
						}
						elseif(isset($custom['ABdevFW_selected_media'][0]) && $custom['ABdevFW_selected_media'][0]=='vimeo' && isset($custom['ABdevFW_vimeo_id'][0]) && $custom['ABdevFW_vimeo_id'][0]!=''){
							echo '<div class="videoWrapper-vimeo"><iframe src="http://player.vimeo.com/video/'.$custom['ABdevFW_vimeo_id'][0].'?title=0&amp;byline=0&amp;portrait=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
						}
						else{
							the_post_thumbnail('full');
							$postclass_out = 'timeline_postmeta_default';
						}
						?>
						<div class="timeline_postmeta">
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<i class="whhg-calendar"></i> <span class="date"><?php the_date(); ?></span> 
							<i class="whhg-useralt"></i> <?php the_author_posts_link(); ?>
							<?php the_tags( '<i class="whhg-tags"></i>',', ', ' '); ?>
						</div>
						<div class="timeline_content">
							<?php the_content($read_more);?>
						</div>
					</div>
				<?php endwhile; 
				else: ?>
					<p><?php _e('No posts were found. Sorry!', 'ABdev_aeron'); ?></p>
				<?php endif; ?>
				</div>
				<div id="timeline_loading" data-category="<?php echo esc_attr($cat_id); ?>"></div>


			<?php else: ?>
				<div class="row">

					<div class="<?php echo (isset($cat_data['sidebar_position']) && $cat_data['sidebar_position']=='none')?'span12':'span9';?> <?php echo (isset($cat_data['sidebar_position']) && $cat_data['sidebar_position']=='left')?'content_with_left_sidebar':'content_with_right_sidebar';?>">
						<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
							<?php 
							$custom = get_post_custom();
							$icon = 'icon-featheralt-write';
							if(isset($custom['ABdevFW_selected_media'][0])){
								switch ($custom['ABdevFW_selected_media'][0]){
									case 'soundcloud':
										$icon = 'whhg-microphonealt';
										break;
									case 'youtube':
										$icon = 'whhg-video';
										break;
									case 'vimeo':
										$icon = 'whhg-video';
										break;
									default:
										$icon = 'whhg-featheralt';
								}
							} ?>
								<div <?php post_class('post_wrapper clearfix'); ?>>
									<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
									<div class="post_content">
										<div class="post_badges">
											<div class="post_type"><i class="<?php echo $icon; ?>"></i></div>
											<div class="post_comments">
												<span class="number"><?php echo comments_number('0','1','%');?></span>
												<span class="text"><?php echo comments_number(__('Comments', 'ABdev_aeron'), __('Comment', 'ABdev_aeron'), __('Comments', 'ABdev_aeron')); ?></span>
											</div>
										</div>
										<div class="post_main">
											<?php

											if(isset($custom['ABdevFW_selected_media'][0]) && $custom['ABdevFW_selected_media'][0]=='soundcloud' && isset($custom['ABdevFW_soundcloud'][0]) && $custom['ABdevFW_soundcloud'][0]!=''){
												echo '<iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F'.$custom['ABdevFW_soundcloud'][0].'"></iframe>';
											}
											elseif(isset($custom['ABdevFW_selected_media'][0]) && $custom['ABdevFW_selected_media'][0]=='youtube' && isset($custom['ABdevFW_youtube_id'][0]) && $custom['ABdevFW_youtube_id'][0]!=''){
												echo '<div class="videoWrapper-youtube"><iframe src="http://www.youtube.com/embed/'.$custom['ABdevFW_youtube_id'][0].'?showinfo=0&amp;autohide=1&amp;related=0" frameborder="0" allowfullscreen></iframe></div>';
											}
											elseif(isset($custom['ABdevFW_selected_media'][0]) && $custom['ABdevFW_selected_media'][0]=='vimeo' && isset($custom['ABdevFW_vimeo_id'][0]) && $custom['ABdevFW_vimeo_id'][0]!=''){
												echo '<div class="videoWrapper-vimeo"><iframe src="http://player.vimeo.com/video/'.$custom['ABdevFW_vimeo_id'][0].'?title=0&amp;byline=0&amp;portrait=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
											}
											else{
												the_post_thumbnail();
											}
											?>
											<div class="postmeta-under">
												 <i class="whhg-calendar"></i> <span class="date"><?php the_date(); ?></span> 
												 <i class="whhg-useralt"></i> <?php the_author_posts_link(); ?>
												 <?php the_tags( '<i class="whhg-tags"></i>',', ', ' '); ?>
											</div>
											<?php the_content($read_more);?>
										</div>
									</div>
								</div>
								
							
						<?php endwhile; 
						else: ?>
							<p><?php _e('No posts were found. Sorry!', 'ABdev_aeron'); ?></p>
						<?php endif; ?>
						
						
					</div><!-- end span8 main-content -->
					
					<?php if (!isset($cat_data['sidebar_position']) || (isset($cat_data['sidebar_position']) && $cat_data['sidebar_position'] != 'none')):?>
						<aside class="span3 sidebar <?php echo (isset($cat_data['sidebar_position']) && $cat_data['sidebar_position']=='left')?'sidebar_left':'';?>">
							<?php 
							if(isset($cat_data['sidebar']) && $cat_data['sidebar']!=''){
								$selected_sidebar=$cat_data['sidebar'];
							}
							else{
								$selected_sidebar=__( 'Primary Sidebar', 'ABdev_aeron');
							}
							dynamic_sidebar($selected_sidebar);
							?>
						</aside><!-- end span4 sidebar -->
					<?php endif; ?>

				</div><!-- end row -->

			<?php endif; ?>
		</div>
	</section>

	<?php 
	if($cat_data['sidebar_position']!='timeline'){
		get_template_part( 'pagination' );
	}
	?>

<?php get_footer();