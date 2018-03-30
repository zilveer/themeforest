						<?php
							$options = get_option('sf_supreme_options');
							
							$enable_footer = $options['enable_footer'];
							$enable_copyright = $options['enable_copyright'];
							$show_backlink = $options['show_backlink'];
							$page_layout = $options['page_layout'];
							$footer_config = $options['footer_layout'];
							$copyright_text = __($options['footer_copyright_text'], 'swiftframework');
							$go_top_text = __($options['footer_gotop_text'], 'swiftframework');
							
							$use_disqus = $options['use_disqus'];
							$disqus_shortname = $options['disqus_shortname'];
						?>
					
					<!-- CLOSE #page-wrap -->				
					</div>
				
				<!-- CLOSE .container -->
				</div>

			<!-- CLOSE #main-container -->
			</div>
			
			<?php if ($enable_footer) { ?>
			
			<!-- OPEN #footer -->
			<section id="footer">
				
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
				$swiftideas_backlink =	apply_filters("swiftideas_link", " &middot; <a href='http://www.swiftideas.net'>Premium WordPress Themes by Swift Ideas</a>");
				}
			?>
			
			<?php if ($enable_copyright) { ?>
			
			<footer id="copyright">
				<div class="container">
					<p class="twelve columns"><?php echo do_shortcode(stripslashes($copyright_text)); ?><?php echo $swiftideas_backlink; ?></p>
					<div class="beam-me-up three columns offset-by-one"><a href="#"><?php echo do_shortcode(stripslashes($go_top_text)); ?><i class="icon-arrow-up"></i></a></div>
				</div>
			</footer>
			
			<?php } ?>
		

		<!-- CLOSE #container -->
		</div>
		
		<?php
			
			global $has_portfolio, $has_blog, $include_maps, $include_isotope, $include_ticker, $include_carousel;
				
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
			if ($include_ticker) {
				$sf_inc_class .= "has-ticker ";
			}
			
		?>
		
		<div id="sf-included" class="<?php echo $sf_inc_class; ?>"></div>
		
		<?php $tracking = $options['google_analytics']; ?>
		<?php if ($tracking != "") { ?>
		<?php echo $tracking; ?>
		<?php } ?>
		
		<?php if ($use_disqus) { ?>
		<script>
			var disqus_shortname = "<?php echo $disqus_shortname; ?>";
			(function () {
			var s = document.createElement('script'); s.async = true;
			s.type = 'text/javascript';
			s.src = 'http://' + disqus_shortname + '.disqus.com/count.js';
			(document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
			}());
		</script>
		<?php } ?>
		
			
		<!--// WORDPRESS FOOTER HOOK //-->
		<?php wp_footer(); ?>

	
	<!--// CLOSE BODY //-->
	</body>


<!--// CLOSE HTML //-->
</html>