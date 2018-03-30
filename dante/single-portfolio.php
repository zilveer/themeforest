<?php get_header(); ?>
	
<?php
	global $sf_pb_active;
	$fw_override = false;
	
	$options = get_option('sf_dante_options');
	$enable_portfolio_stickydetails = false;
	if ( isset($options['enable_portfolio_stickydetails']) ) {
	$enable_portfolio_stickydetails = $options['enable_portfolio_stickydetails'];
	}
	
	$portfolio_data = sf_get_post_meta($post->ID, 'portfolio', true);
	$current_item_id = $post->ID;
	$pb_active = sf_get_post_meta($post->ID, '_spb_js_status', true);
	
    $portfolio_page = __($options['portfolio_page'], 'swiftframework');
    
    $same_category_navigation = false;
    if ( isset($options['same_category_navigation']) ) {
    	$same_category_navigation = $options['same_category_navigation'];
    }
    
    $page_title = get_the_title();
    $fw_media_display = sf_get_post_meta($post->ID, 'sf_fw_media_display', true);
    $use_thumb_content = sf_get_post_meta($post->ID, 'sf_thumbnail_content_main_detail', true);
    $media_type = "";
    if ($use_thumb_content) {
    $media_type = sf_get_post_meta($post->ID, 'sf_thumbnail_type', true);
    } else {
    $media_type = sf_get_post_meta($post->ID, 'sf_detail_type', true);
	}
	$hide_details = sf_get_post_meta($post->ID, 'sf_hide_details', true);
	$show_social = sf_get_post_meta($post->ID, 'sf_social_sharing', true);
	$item_link = sf_get_post_meta($post->ID, 'sf_portfolio_external_link', true);
?>

<?php if (have_posts()) : the_post(); ?>
	
	<?php 
		
		//
		// FULL WIDTH MEDIA DISPLAY
		// 
		
		if ($fw_media_display == "fw-media" && $media_type != "none") {
		
		if ( !$sf_pb_active ) {
			$fw_override = true;
		}
	?>
	
	<div class="full-width-display-wrap">
	
		<div class="container">
			<div class="portfolio-options-bar row">
				
				<ul class="pagination-wrap bar-styling portfolio-pagination clearfix">
					<li class="prev"><?php next_post_link('%link', '<i class="ss-navigateleft"></i>', $same_category_navigation); ?></li>
					<?php if ($portfolio_page) { ?>
					<li class="index"><a href="<?php echo get_permalink($portfolio_page); ?>"><i class="ss-layergroup"></i></a></li>
					<?php } ?>
					<li class="next"><?php previous_post_link('%link', '<i class="ss-navigateright"></i>', $same_category_navigation); ?></li>
				</ul>
				
				<?php if ($show_social) { ?>
					<?php sf_portfolio_social_links(); ?>
				<?php } ?>
			</div>
		</div>
									
		<?php sf_portfolio_detail_media('fw-media-wrap'); ?>
	
	</div>
		
	<?php } ?>
	
	
	<div class="inner-page-wrap has-no-sidebar portfolio-type-<?php echo $fw_media_display; ?> row clearfix">
			
		<!-- OPEN article -->
		<article <?php post_class('portfolio-article col-sm-12 clearfix'); ?> id="<?php the_ID(); ?>" itemscope itemtype="http://schema.org/CreativeWork">
			
			<div class="entry-title"><?php echo $page_title; ?></div>
			
			<?php if ($fw_media_display == "fw-media") { ?>
							
				<section class="article-body-wrap row">
										
					<?php if (!$hide_details) { ?>
					
						<?php if ( $sf_pb_active || $fw_override ) { ?>
						<div class="container">
						<?php } ?>
						
							<section class="portfolio-detail-description col-sm-9">
								<div class="body-text clearfix" itemprop="description">
									<?php the_content(); ?>
								</div>
							</section>
						
							<?php if ($enable_portfolio_stickydetails) { ?>
								<?php sf_portfolio_details('sticky-details col-sm-3'); ?>
							<?php } else { ?>
								<?php sf_portfolio_details('col-sm-3'); ?>
							<?php } ?>
						
						<?php if ( $sf_pb_active || $fw_override ) { ?>
						</div>
						<?php } ?>
					
					<?php } else { ?>
					
						<?php if ($pb_active != "true" || ($pb_active == "true" && $fw_media_display == "split")) { ?>
						<div class="container">
						<?php } ?>
						
							<section class="portfolio-detail-description col-sm-12">
								<div class="body-text clearfix" itemprop="description">
									<?php the_content(); ?>
								</div>
							</section>
						
						<?php if ($pb_active != "true" || ($pb_active == "true" && $fw_media_display == "split")) { ?>
						</div>
						<?php } ?>
					
					<?php } ?>
					
				</section>
						
			<?php } else { ?>
				
				<?php if ( $sf_pb_active || $fw_override ) { ?>
				<div class="container">
				<?php } ?>
				
					<div class="portfolio-options-bar">
						
						<ul class="pagination-wrap bar-styling portfolio-pagination clearfix">
							<li class="prev"><?php next_post_link('%link', '<i class="ss-navigateleft"></i>', $same_category_navigation, '', 'portfolio-category'); ?></li>
							<?php if ($portfolio_page) { ?>
							<li class="index"><a href="<?php echo get_permalink($portfolio_page); ?>"><i class="ss-layergroup"></i></a></li>
							<?php } ?>
							<li class="next"><?php previous_post_link('%link', '<i class="ss-navigateright"></i>', $same_category_navigation, '', 'portfolio-category'); ?></li>
						</ul>
						
						<?php if ($show_social) { ?>
							<?php sf_portfolio_social_links(); ?>
						<?php } ?>
					</div>
				
				<?php if ( $sf_pb_active || $fw_override ) { ?>
				</div>
				<?php } ?>
								
				<div class="portfolio-item-content">
								
					<?php if ($media_type != "none" && $fw_media_display == "split") { ?>
						
						<div class="container">	
						
							<?php sf_portfolio_detail_media('col-sm-9'); ?>
							
							<section class="article-body-wrap col-sm-3">
							
								<section class="portfolio-detail-description">
									<div class="body-text clearfix" itemprop="description">
										<?php the_content(); ?>
										<?php if ($item_link) { ?>
										<a class="item-link" href="<?php echo $item_link; ?>" target="_blank"><i class="ss-link"></i><?php _e("View Project", "swiftframework"); ?></a>
										<?php } ?>
									</div>
								</section>
								
								<?php if (!$hide_details) { ?>						
									<?php sf_portfolio_details(); ?>
								<?php } ?>
								
							</section>
							
						</div>
						
					<?php } else if ($fw_media_display == "standard" && $hide_details) { ?>
					
						<?php if ( $sf_pb_active || $fw_override ) { ?>
						<div class="container port-detail-media-container"><!-- OPEN .container -->
						<?php } ?>
						
							<?php sf_portfolio_detail_media('col-sm-12'); ?>
						
						<?php if ( $sf_pb_active || $fw_override ) { ?>
						</div><!-- CLOSE .container -->
						<?php } ?>
																	
						<section class="article-body-wrap col-sm-12">
						
							<section class="portfolio-detail-description">
								<div class="body-text clearfix" itemprop="description">
									<?php the_content(); ?>
									<?php if ($item_link) { ?>
									<a class="item-link" href="<?php echo $item_link; ?>" target="_blank"><i class="ss-link"></i><?php _e("View Project", "swiftframework"); ?></a>
									<?php } ?>
								</div>
							</section>
							
						</section>
					
					<?php } else if ($fw_media_display == "standard") { ?>
					
						<?php if ( $sf_pb_active || $fw_override ) { ?>
						<div class="container port-detail-media-container"><!-- OPEN .container -->
						<?php } ?>
						
							<?php sf_portfolio_detail_media('col-sm-12'); ?>
						
						<?php if ( $sf_pb_active || $fw_override ) { ?>
						</div><!-- CLOSE .container -->
						<?php } ?>
					
						<?php if ( $sf_pb_active || $fw_override ) { ?>
						<div class="container port-detail-body-container">
						<?php } ?>
											
							<section class="article-body-wrap col-sm-9">
								<section class="portfolio-detail-description">
									<div class="body-text clearfix" itemprop="description">
										<?php the_content(); ?>
									</div>
								</section>
							</section>
								
							<?php if ($enable_portfolio_stickydetails) { ?>
								<?php sf_portfolio_details('sticky-details col-sm-3'); ?>
							<?php } else { ?>
								<?php sf_portfolio_details('col-sm-3'); ?>
							<?php } ?>
						
						<?php if ( $sf_pb_active || $fw_override ) { ?>
						</div>
						<?php } ?>
								
					<?php } else { ?>
						
						<?php if ( $sf_pb_active || $fw_override ) { ?>
						<div class="container port-detail-media-container"><!-- OPEN .container -->
						<?php } ?>
						
							<?php sf_portfolio_detail_media('col-sm-12'); ?>
						
						<?php if ( $sf_pb_active || $fw_override ) { ?>
						</div><!-- CLOSE .container -->
						<?php } ?>
					
						<section class="article-body-wrap col-sm-12">
							<section class="portfolio-detail-description">
								<div class="body-text clearfix" itemprop="description">
									<?php the_content(); ?>
									<?php if ($item_link) { ?>
									<a class="item-link" href="<?php echo $item_link; ?>" target="_blank"><i class="ss-link"></i><?php _e("View Project", "swiftframework"); ?></a>
									<?php } ?>
								</div>
							</section>
							
							<?php if (!$hide_details) { ?>
							
								<?php sf_portfolio_details(); ?>
							
							<?php } ?>
							
						</section>
					
					<?php } ?>
				
				</div>
			
			<?php } ?>
			
			<?php sf_portfolio_related(); ?>
			
		<!-- CLOSE article -->
		</article>
	
	</div>
	
	
<?php endif; ?>

<!--// WordPress Hook //-->
<?php get_footer(); ?>