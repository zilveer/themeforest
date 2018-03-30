<?php get_header(); ?>
<div class="gdlr-content">

	<?php 
		global $gdlr_sidebar, $theme_option;
		$gdlr_sidebar = array(
			'type'=>$theme_option['archive-sidebar-template'],
			'left-sidebar'=>$theme_option['archive-sidebar-left'], 
			'right-sidebar'=>$theme_option['archive-sidebar-right']
		); 
		$gdlr_sidebar = gdlr_get_sidebar_class($gdlr_sidebar);
	?>
	<div class="with-sidebar-wrapper">
		<div class="with-sidebar-container container">
			<div class="with-sidebar-left <?php echo $gdlr_sidebar['outer']; ?> columns">
				<div class="with-sidebar-content <?php echo $gdlr_sidebar['center']; ?> gdlr-item-start-content columns">
					<?php
						if( have_posts() ){
							if( !empty($_GET['post_type']) && $_GET['post_type'] == 'cause' ){
								global $wp_query;
								
								if( !empty($theme_option['archive-cause-num-excerpt']) ){
									global $gdlr_excerpt_length; $gdlr_excerpt_length = $theme_option['archive-cause-num-excerpt'];
									add_filter('excerpt_length', 'gdlr_set_excerpt_length');
								} 								

								if( $theme_option['archive-cause-style'] == 'medium' ){
									echo gdlr_get_cause_medium($wp_query, $theme_option['archive-cause-thumbnail-size'], 
										$theme_option['archive-cause-num-excerpt']);			
								}else if( $theme_option['archive-cause-style'] == 'full' ){
									echo gdlr_get_cause_full($wp_query, $theme_option['archive-cause-thumbnail-size'], 
										$theme_option['archive-cause-num-excerpt']);
								}else{
									$gdlr_excerpt_read_more = false;
									$theme_option['archive-cause-style'] = str_replace('1/', '', $theme_option['archive-cause-style']);
									echo gdlr_get_cause_grid($wp_query, $theme_option['archive-cause-style'], 
												$theme_option['archive-cause-thumbnail-size'], 'fitRows', $theme_option['archive-cause-num-excerpt']);
									$gdlr_excerpt_read_more = true;
								}	

								remove_filter('excerpt_length', 'gdlr_set_excerpt_length');
							}else{
								// set the excerpt length
								if( !empty($theme_option['archive-num-excerpt']) ){
									global $gdlr_excerpt_length; $gdlr_excerpt_length = $theme_option['archive-num-excerpt'];
									add_filter('excerpt_length', 'gdlr_set_excerpt_length');
								} 

								global $wp_query, $gdlr_post_settings;
								$gdlr_lightbox_id++;
								$gdlr_post_settings['excerpt'] = intval($theme_option['archive-num-excerpt']);
								$gdlr_post_settings['thumbnail-size'] = $theme_option['archive-thumbnail-size'];			
								$gdlr_post_settings['blog-style'] = $theme_option['archive-blog-style'];							
							
								echo '<div class="blog-item-holder">';
								if($theme_option['archive-blog-style'] == 'blog-full'){
									$gdlr_post_settings['blog-info'] = array('date', 'author', 'comment', 'category');
									echo gdlr_get_blog_full($wp_query);
								}else if($theme_option['archive-blog-style'] == 'blog-medium'){
									$gdlr_post_settings['blog-info'] = array('date', 'author', 'comment', 'category');
									echo gdlr_get_blog_medium($wp_query);			
								}else{
									$gdlr_post_settings['blog-info'] = array('date', 'comment');
									
									$blog_size = str_replace('blog-1-', '', $theme_option['archive-blog-style']);
									echo gdlr_get_blog_grid($wp_query, $blog_size, 'fitRows');
								}
								echo '</div>';
								remove_filter('excerpt_length', 'gdlr_set_excerpt_length');
								
								$paged = (get_query_var('paged'))? get_query_var('paged') : 1;
								echo gdlr_get_pagination($wp_query->max_num_pages, $paged);
							}
						}else{
?>
<div class="gdlr-item page-not-found-item">							
	<div class="page-not-found-block" >
		<div class="page-not-found-icon">
			<i class="icon-frown"></i>
		</div>
		<div class="page-not-found-title">
			<?php _e('Not Found', 'gdlr_translate'); ?>
		</div>
		<div class="page-not-found-caption">
			<?php _e('Nothing matched your search criteria. Please try again with different keywords.', 'gdlr_translate'); ?>
		</div>
		<div class="page-not-found-search">
			<?php get_search_form(); ?>
		</div>
	</div>							
</div>							
<?php
						}
					?>
				</div>
				<?php get_sidebar('left'); ?>
				<div class="clear"></div>
			</div>
			<?php get_sidebar('right'); ?>
			<div class="clear"></div>
		</div>				
	</div>				

</div><!-- gdlr-content -->
<?php get_footer(); ?>