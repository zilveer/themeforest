					<?php
						$options = get_option('sf_pinpoint_options');
						
						$enable_footer = $options['enable_footer'];
						$enable_copyright = $options['enable_copyright'];
						$show_backlink = $options['show_backlink'];
						$page_layout = $options['page_layout'];
						$footer_config = $options['footer_layout'];
						$copyright_text = __($options['footer_copyright_text'], 'swiftframework');
						$go_top_text = __($options['footer_gotop_text'], 'swiftframework');
						
						if (isset($_GET['layout'])) {
							$page_layout = $_GET['layout'];
						}
					?>
					
					<?php if ($enable_footer) { ?>
					
						<?php if ($page_layout == "fullwidth") { ?>
						</div>
						<!-- OPEN #footer -->
						<section id="footer">
						<?php } else { ?>
						<!-- OPEN #footer -->
						<section id="footer" class="full-width">
						<?php } ?>
							
							<div class="container">
		
								<div id="footer-widgets" class="clearfix">
									
									<?php if ($footer_config == "footer-1") { ?>
		
									<div class="four columns alpha">
									<?php if ( function_exists('dynamic_sidebar') ) { ?>
										<?php dynamic_sidebar('footer-column-1'); ?>
									<?php } ?>
									</div>
									<div class="four columns">
									<?php if ( function_exists('dynamic_sidebar') ) { ?>
										<?php dynamic_sidebar('footer-column-2'); ?>
									<?php } ?>
									</div>
									<div class="four columns">
									<?php if ( function_exists('dynamic_sidebar') ) { ?>
										<?php dynamic_sidebar('footer-column-3'); ?>
									<?php } ?>
									</div>
									<div class="four columns omega">
									<?php if ( function_exists('dynamic_sidebar') ) { ?>
										<?php dynamic_sidebar('footer-column-4'); ?>
									<?php } ?>
									</div>
									
									<?php } else if ($footer_config == "footer-2") { ?>
									
									<div class="eight columns alpha">
									<?php if ( function_exists('dynamic_sidebar') ) { ?>
										<?php dynamic_sidebar('footer-column-1'); ?>
									<?php } ?>
									</div>
									<div class="four columns">
									<?php if ( function_exists('dynamic_sidebar') ) { ?>
										<?php dynamic_sidebar('footer-column-2'); ?>
									<?php } ?>
									</div>
									<div class="four columns omega">
									<?php if ( function_exists('dynamic_sidebar') ) { ?>
										<?php dynamic_sidebar('footer-column-3'); ?>
									<?php } ?>
									</div>
									
									<?php } else if ($footer_config == "footer-3") { ?>
									
									<div class="four columns alpha">
									<?php if ( function_exists('dynamic_sidebar') ) { ?>
										<?php dynamic_sidebar('footer-column-1'); ?>
									<?php } ?>
									</div>
									<div class="four columns">
									<?php if ( function_exists('dynamic_sidebar') ) { ?>
										<?php dynamic_sidebar('footer-column-2'); ?>
									<?php } ?>
									</div>
									<div class="eight columns omega">
									<?php if ( function_exists('dynamic_sidebar') ) { ?>
										<?php dynamic_sidebar('footer-column-3'); ?>
									<?php } ?>
									</div>
									
									<?php } else if ($footer_config == "footer-4") { ?>
									
									<div class="eight columns alpha">
									<?php if ( function_exists('dynamic_sidebar') ) { ?>
										<?php dynamic_sidebar('footer-column-1'); ?>
									<?php } ?>
									</div>
									<div class="eight columns omega">
									<?php if ( function_exists('dynamic_sidebar') ) { ?>
										<?php dynamic_sidebar('footer-column-2'); ?>
									<?php } ?>
									</div>
									
									<?php } else if ($footer_config == "footer-5") { ?>
									
									<div class="one-third column alpha">
									<?php if ( function_exists('dynamic_sidebar') ) { ?>
										<?php dynamic_sidebar('footer-column-1'); ?>
									<?php } ?>
									</div>
									<div class="one-third column">
									<?php if ( function_exists('dynamic_sidebar') ) { ?>
										<?php dynamic_sidebar('footer-column-2'); ?>
									<?php } ?>
									</div>
									<div class="one-third column omega">
									<?php if ( function_exists('dynamic_sidebar') ) { ?>
										<?php dynamic_sidebar('footer-column-3'); ?>
									<?php } ?>
									</div>
									
									<?php } else if ($footer_config == "footer-6") { ?>
									
									<div class="two-thirds column alpha">
									<?php if ( function_exists('dynamic_sidebar') ) { ?>
										<?php dynamic_sidebar('footer-column-1'); ?>
									<?php } ?>
									</div>
									<div class="one-third column omega">
									<?php if ( function_exists('dynamic_sidebar') ) { ?>
										<?php dynamic_sidebar('footer-column-2'); ?>
									<?php } ?>
									</div>
									
									<?php } else if ($footer_config == "footer-7") { ?>
									
									<div class="one-third column alpha">
									<?php if ( function_exists('dynamic_sidebar') ) { ?>
										<?php dynamic_sidebar('footer-column-1'); ?>
									<?php } ?>
									</div>
									<div class="two-thirds column omega">
									<?php if ( function_exists('dynamic_sidebar') ) { ?>
										<?php dynamic_sidebar('footer-column-2'); ?>
									<?php } ?>
									</div>
									
									<?php } else { ?>
									
									<div class="four columns alpha">
									<?php if ( function_exists('dynamic_sidebar') ) { ?>
										<?php dynamic_sidebar('footer-column-1'); ?>
									<?php } ?>
									</div>
									<div class="eight columns">
									<?php if ( function_exists('dynamic_sidebar') ) { ?>
										<?php dynamic_sidebar('footer-column-2'); ?>
									<?php } ?>
									</div>
									<div class="four columns omega">
									<?php if ( function_exists('dynamic_sidebar') ) { ?>
										<?php dynamic_sidebar('footer-column-3'); ?>
									<?php } ?>
									</div>
									
									<?php } ?>
									
								</div>
		
							</div>	
						
						<!-- CLOSE #footer -->
						</section>
						
					<?php } ?>
					
					<?php
						$swiftideas_backlink = "";
						if ($show_backlink) {			
						$swiftideas_backlink =	apply_filters("swiftideas_link", " | <a href='http://www.swiftideas.net'>Premium WordPress Themes by Swift Ideas</a>");
						}
					?>
					
					<?php if ($enable_copyright) { ?>
					
					<?php if ($page_layout == "fullwidth") { ?>
					<footer id="copyright">
						<div class="container">
							<p><?php echo do_shortcode(stripslashes($copyright_text)); ?><?php echo $swiftideas_backlink; ?></p>
							<div class="beam-me-up"><a href="#"><?php echo do_shortcode(stripslashes($go_top_text)); ?><i class="icon-arrow-up"></i></a></div>
						</div>
					</footer>
					<?php } else { ?>
					<footer id="copyright" class="full-width">
						<p><?php echo do_shortcode(stripslashes($copyright_text)); ?><?php echo $swiftideas_backlink; ?></p>
						<div class="beam-me-up"><a href="#"><?php echo do_shortcode(stripslashes($go_top_text)); ?><i class="icon-arrow-up"></i></a></div>
					</footer>
					<?php } ?>
					
					<?php } ?>
					
				<?php if ($page_layout == "boxed") { ?>
				</div>
				</div>
				<?php } ?>

			<!-- CLOSE #main-container -->
			</div>
		
		<?php if ($page_layout == "fullwidth") { ?>
		<!-- CLOSE #container -->
		</div>
		<?php } else { ?>
		<!-- CLOSE #container -->
		</div>
		<!-- CLOSE #boxed-container -->
		</div>
		<?php } ?>
		
		<?php
			
			global $has_portfolio, $has_blog, $include_maps, $include_isotope, $include_carousel;
				
			$sf_inc_class = "";
			
			if ($has_portfolio) {
				$sf_inc_class .= "has-portfolio ";
			}
			if ($has_blog) {
				$sf_inc_class .= "has-blog ";
			}
			if ($include_maps) {
				$sf_inc_class .= "has-map ";
			}
			if ($include_carousel) {
				$sf_inc_class .= "has-carousel ";
			}
			
		?>
		
		<div id="sf-included" class="<?php echo $sf_inc_class; ?>"></div>
		
		<?php $tracking = $options['google_analytics']; ?>
		<?php if ($tracking != "") { ?>
		<?php echo $tracking; ?>
		<?php } ?>
			
		<!-- WordPress Footer Hook -->
		<?php wp_footer(); ?>

	<!-- CLOSE body -->
	</body>

<!-- CLOSE html -->
</html>