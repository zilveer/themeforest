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
						if( !is_tax('cause_category') && !is_tax('portfolio_category') && !is_tax('portfolio_tag') ){		
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
							echo '<div class="clear"></div>';
							echo '</div>';
							remove_filter('excerpt_length', 'gdlr_set_excerpt_length');
							
							$paged = (get_query_var('paged'))? get_query_var('paged') : 1;
							echo gdlr_get_pagination($wp_query->max_num_pages, $paged);													
						
						}else if( is_tax('cause_category') ){
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
							global $wp_query;
							gdlr_include_portfolio_scirpt();
							
							echo'<div class="portfolio-item-holder" >';
							if($theme_option['archive-portfolio-style'] == 'detail-portfolio'){
								echo gdlr_get_detail_portfolio($wp_query, $theme_option['archive-portfolio-thumbnail-size'], $theme_option['archive-portfolio-num-excerpt']);
							}else if($theme_option['archive-portfolio-style'] == 'classic-portfolio'){
								echo gdlr_get_classic_portfolio($wp_query, str_replace('1/', '', $theme_option['archive-portfolio-size']), 
											$theme_option['archive-portfolio-thumbnail-size'], 'fitRows' );
							}else if($theme_option['archive-portfolio-style'] == 'modern-portfolio'){	
								echo gdlr_get_modern_portfolio($wp_query, str_replace('1/', '', $theme_option['archive-portfolio-size']), 
											$theme_option['archive-portfolio-thumbnail-size'], 'fitRows' );
							}
							echo '<div class="clear"></div>';
							echo '</div>';
							
							$paged = (get_query_var('paged'))? get_query_var('paged') : 1;
							echo gdlr_get_pagination($wp_query->max_num_pages, $paged);	
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