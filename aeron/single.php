<?php
get_header();

get_template_part('title_breadcrumb_bar');

?>
	<section>
		<div class="container">

			<div class="row">

				<div class="span9 content_with_right_sidebar">
					<?php if (have_posts()) :  while (have_posts()) : the_post(); 
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
						}
						?>
							<h2 class="post_excerpt"><?php the_excerpt(); ?></h2>
							<div class="post_content">
								<div class="post_badges">
									<div class="post_type"><i class="<?php echo $icon; ?>"></i></div>
									<div class="post_comments">
										<span class="number"><?php echo comments_number('0','1','%');?></span>
										<span class="text"><?php echo comments_number(__('Comments', 'ABdev_aeron'), __('Comment', 'ABdev_aeron'), __('Comments', 'ABdev_aeron')); ?></span>
									</div>
								</div>
								<div <?php post_class('post_main'); ?>>
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
									<?php the_content();?>
									<?php wp_link_pages(); ?>
								</div>
							</div>
							
						
					<?php endwhile; 
					else: ?>
						<p><?php _e('No posts were found. Sorry!', 'ABdev_aeron'); ?></p>
					<?php endif; ?>
					
					<?php if(!get_theme_mod('hide_comments', 'false')):?>
						<section id="comments_section" class="section_border_top">
							<?php comments_template(); ?> 
						</section>
					<?php endif; ?>

				</div><!-- end span8 main-content -->
				
				<aside class="span3 sidebar">
					<?php get_sidebar();?>
				</aside><!-- end span4 sidebar -->

			</div><!-- end row -->

		</div>
	</section>

	<section id="post_pagination" class="clearfix">
		<div class="container">
			<span class="prev"><?php previous_post_link('%link','&laquo; %title'); ?></span>
			<span class="next"><?php next_post_link('%link','%title &raquo;'); ?></span>
		</div>
	</section>

<?php get_footer();