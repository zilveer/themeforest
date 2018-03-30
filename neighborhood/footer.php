<?php
							$options = get_option('sf_neighborhood_options');
							$enable_footer = $options['enable_footer'];
							$enable_footer_divider = $options['enable_footer_divider'];
							$enable_copyright = $options['enable_copyright'];
							$enable_copyright_divider = $options['enable_copyright_divider'];
							$show_backlink = $options['show_backlink'];
							$page_layout = $options['page_layout'];
							$footer_config = $options['footer_layout'];
							$copyright_text = __($options['footer_copyright_text'], 'swiftframework');
							$go_top_text = __($options['footer_gotop_text'], 'swiftframework');
							
							$footer_class = $copyright_class = "";
							
							if ($enable_footer_divider) { $footer_class = "footer-divider"; }
							if ($enable_copyright_divider) { $copyright_class = "copyright-divider"; }
						?>
					
					<!--// CLOSE #page-wrap //-->			
					</div>
				
				<?php
					// Page container handling
					$pb_fw_mode = false;
					if ($post) {
						$sidebar_config = sf_get_post_meta($post->ID, 'sf_sidebar_config', true);
						if (isset($_GET['sidebar'])) {
							$sidebar_config = $_GET['sidebar'];
						}
						$pb_active = sf_get_post_meta($post->ID, '_spb_js_status', true);
						if ($sidebar_config != "no-sidebars" || post_password_required() ) {
							$pb_fw_mode = false;
						} else if ($pb_active == "true") {
							$pb_fw_mode = true;
						}
						if ( function_exists('is_product') && is_product() && $sidebar_config == "no-sidebars" ) {
							$pb_fw_mode = true;
						}
					}
					
					// Check if page should be enabled in full width mode
					if ($pb_fw_mode) { ?>
					<!--// CLOSE .pb-fw-wrap //-->
					</div>
					<?php } else { ?>
					<!--// CLOSE .container //-->
					</div>
				<?php } ?>

			<!--// CLOSE #main-container //-->
			</div>
			
			<?php if ($enable_footer) { ?>
			
			<!--// OPEN #footer //-->
			<section id="footer" class="<?php echo $footer_class; ?>">
				<div class="container">
					<div id="footer-widgets" class="row clearfix">
						<?php if ($footer_config == "footer-1") { ?>
						<div class="span3">
						<?php if ( function_exists('dynamic_sidebar') ) { ?>
							<?php dynamic_sidebar('footer-column-1'); ?>
						<?php } ?>
						</div>
						<div class="span3">
						<?php if ( function_exists('dynamic_sidebar') ) { ?>
							<?php dynamic_sidebar('footer-column-2'); ?>
						<?php } ?>
						</div>
						<div class="span3">
						<?php if ( function_exists('dynamic_sidebar') ) { ?>
							<?php dynamic_sidebar('footer-column-3'); ?>
						<?php } ?>
						</div>
						<div class="span3">
						<?php if ( function_exists('dynamic_sidebar') ) { ?>
							<?php dynamic_sidebar('footer-column-4'); ?>
						<?php } ?>
						</div>
						
						<?php } else if ($footer_config == "footer-2") { ?>
						
						<div class="span6">
						<?php if ( function_exists('dynamic_sidebar') ) { ?>
							<?php dynamic_sidebar('footer-column-1'); ?>
						<?php } ?>
						</div>
						<div class="span3">
						<?php if ( function_exists('dynamic_sidebar') ) { ?>
							<?php dynamic_sidebar('footer-column-2'); ?>
						<?php } ?>
						</div>
						<div class="span3">
						<?php if ( function_exists('dynamic_sidebar') ) { ?>
							<?php dynamic_sidebar('footer-column-3'); ?>
						<?php } ?>
						</div>
						
						<?php } else if ($footer_config == "footer-3") { ?>
						
						<div class="span3">
						<?php if ( function_exists('dynamic_sidebar') ) { ?>
							<?php dynamic_sidebar('footer-column-1'); ?>
						<?php } ?>
						</div>
						<div class="span3">
						<?php if ( function_exists('dynamic_sidebar') ) { ?>
							<?php dynamic_sidebar('footer-column-2'); ?>
						<?php } ?>
						</div>
						<div class="span6">
						<?php if ( function_exists('dynamic_sidebar') ) { ?>
							<?php dynamic_sidebar('footer-column-3'); ?>
						<?php } ?>
						</div>
						
						<?php } else if ($footer_config == "footer-4") { ?>
						
						<div class="span6">
						<?php if ( function_exists('dynamic_sidebar') ) { ?>
							<?php dynamic_sidebar('footer-column-1'); ?>
						<?php } ?>
						</div>
						<div class="span6">
						<?php if ( function_exists('dynamic_sidebar') ) { ?>
							<?php dynamic_sidebar('footer-column-2'); ?>
						<?php } ?>
						</div>
						
						<?php } else if ($footer_config == "footer-5") { ?>
						
						<div class="span4">
						<?php if ( function_exists('dynamic_sidebar') ) { ?>
							<?php dynamic_sidebar('footer-column-1'); ?>
						<?php } ?>
						</div>
						<div class="span4">
						<?php if ( function_exists('dynamic_sidebar') ) { ?>
							<?php dynamic_sidebar('footer-column-2'); ?>
						<?php } ?>
						</div>
						<div class="span4">
						<?php if ( function_exists('dynamic_sidebar') ) { ?>
							<?php dynamic_sidebar('footer-column-3'); ?>
						<?php } ?>
						</div>
						
						<?php } else if ($footer_config == "footer-6") { ?>
						
						<div class="span4">
						<?php if ( function_exists('dynamic_sidebar') ) { ?>
							<?php dynamic_sidebar('footer-column-1'); ?>
						<?php } ?>
						</div>
						<div class="span8">
						<?php if ( function_exists('dynamic_sidebar') ) { ?>
							<?php dynamic_sidebar('footer-column-2'); ?>
						<?php } ?>
						</div>
						
						<?php } else if ($footer_config == "footer-7") { ?>
						
						<div class="span8">
						<?php if ( function_exists('dynamic_sidebar') ) { ?>
							<?php dynamic_sidebar('footer-column-1'); ?>
						<?php } ?>
						</div>
						<div class="span4">
						<?php if ( function_exists('dynamic_sidebar') ) { ?>
							<?php dynamic_sidebar('footer-column-2'); ?>
						<?php } ?>
						</div>
						
						<?php } else if ($footer_config == "footer-8") { ?>
						
						<div class="span3">
						<?php if ( function_exists('dynamic_sidebar') ) { ?>
							<?php dynamic_sidebar('footer-column-1'); ?>
						<?php } ?>
						</div>
						<div class="span6">
						<?php if ( function_exists('dynamic_sidebar') ) { ?>
							<?php dynamic_sidebar('footer-column-2'); ?>
						<?php } ?>
						</div>
						<div class="span3">
						<?php if ( function_exists('dynamic_sidebar') ) { ?>
							<?php dynamic_sidebar('footer-column-3'); ?>
						<?php } ?>
						</div>
						
						<?php } else { ?>
												
						<div class="span12">
						<?php if ( function_exists('dynamic_sidebar') ) { ?>
							<?php dynamic_sidebar('footer-column-1'); ?>
						<?php } ?>
						</div>
						
						<?php } ?>
						
					</div>
				</div>	
			
			<!--// CLOSE #footer //-->
			</section>	
			<?php } ?>
			
			<?php
				$swiftideas_backlink = "";
				if ($show_backlink) {			
				$swiftideas_backlink =	apply_filters("swiftideas_link", " <a href='http://www.swiftideas.net'>Premium WordPress Themes by Swift Ideas</a>");
				}
			
			if ($enable_copyright) { ?>
			
			<!--// OPEN #copyright //-->
			<footer id="copyright" class="<?php echo $copyright_class; ?>">
				<div class="container">
					<p class="twelve columns"><?php echo do_shortcode(stripslashes($copyright_text)); ?><?php echo $swiftideas_backlink; ?></p>
					<div class="beam-me-up three columns offset-by-one"><a href="#"><?php echo do_shortcode(stripslashes($go_top_text)); ?><i class="fa-arrow-up"></i></a></div>
				</div>
			<!--// CLOSE #copyright //-->
			</footer>
			
			<?php } ?>
		
		<!--// CLOSE #container //-->
		</div>
		
		<?php
			// INCLUDED FUNCTIONALITY SETUP
			global $post, $has_portfolio, $has_blog, $has_products, $include_maps, $include_isotope, $include_carousel, $sf_include_parallax, $has_progress_bar, $has_chart, $has_team, $sf_has_imagebanner;
				
			$sf_inc_class = "";
			
			if ($has_portfolio) {
				$sf_inc_class .= "has-portfolio ";
			}
			if ($has_blog) {
				$sf_inc_class .= "has-blog ";
			}
			if ($has_products) {
				$sf_inc_class .= "has-products ";
			}
			
			if ($post) {
				$content = $post->post_content;
				
				if (function_exists('has_shortcode')) {
					if (has_shortcode( $content, 'product_category' ) || has_shortcode( $content, 'featured_products' ) || has_shortcode( $content, 'products' ) || has_shortcode( $content, 'recent_products' ) || has_shortcode( $content, 'product' )) {
						$sf_inc_class .= "has-products ";
						$include_isotope = true;
					}
				}
			}
			
			if ($include_maps) {
				$sf_inc_class .= "has-map ";
			}
			if ($include_carousel) {
				$sf_inc_class .= "has-carousel ";
			}
			if ($sf_include_parallax) {
				$sf_inc_class .= "has-parallax ";
			}
			if ($has_progress_bar) {
				$sf_inc_class .= "has-progress-bar ";
			}
			if ($has_chart) {
				$sf_inc_class .= "has-chart ";
			}
			if ($has_team) {
				$sf_inc_class .= "has-team ";
			}
			if ($sf_has_imagebanner) {
				$sf_inc_class .= "has-imagebanner ";
			}
			
			$options = get_option('sf_neighborhood_options');
			
			if (isset($options['enable_product_zoom'])) {	
				$enable_product_zoom = $options['enable_product_zoom'];	
				if ($enable_product_zoom) {
					$sf_inc_class .= "has-productzoom ";
				}
			}

		?>
				
		<!--// FRAMEWORK INCLUDES //-->
		<div id="sf-included" class="<?php echo $sf_inc_class; ?>"></div>
		
		<?php $tracking = $options['google_analytics']; ?>
		<?php if ($tracking != "") { ?>
		<?php echo $tracking; ?>
		<?php } ?>
			
		<!--// WORDPRESS FOOTER HOOK //-->
		<?php wp_footer(); ?>

	
	<!--// CLOSE BODY //-->
	</body>


<!--// CLOSE HTML //-->
</html>