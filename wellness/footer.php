
				 <div class="footertop"></div>
				 <div class="footercontent">				 
					<div class="one_fourth">
					 <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('footer-widgets1') ): else : ?>
					 <h2><span><?php _e('Footer Column', 'bw_themes');?> 1</span></h2>
					 <p><?php _e('This is a widgetised area. Fill it with content from the Widget Admin area.', 'bw_themes');?></p>
					 <?php endif; ?>
					</div>
					<div class="one_fourth">
					 <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('footer-widgets2') ):  else : ?>
					 <h2><span><?php _e('Footer Column', 'bw_themes');?> 2</span></h2>
					 <p><?php _e('This is a widgetised area. Fill it with content from the Widget Admin area.', 'bw_themes');?></p>
					 <?php endif; ?>
					</div>
					<div class="one_fourth">
					 <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('footer-widgets3') ):  else : ?>
					 <h2><span><?php _e('Footer Column', 'bw_themes');?> 3</span></h2>
					 <p><?php _e('This is a widgetised area. Fill it with content from the Widget Admin area.', 'bw_themes');?></p>
					 <?php endif; ?>
					</div>
					<div class="one_fourth last">
					 <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('footer-widgets4') ):  else : ?>
					 <h2><span><?php _e('Footer Column', 'bw_themes');?> 4</span></h2>
					 <p><?php _e('This is a widgetised area. Fill it with content from the Widget Admin area.', 'bw_themes');?></p>
					 <?php endif; ?>
					 </div>
				 </div>
				 <div class="clearboth"></div>
				 <div class="footerbottom">
				 	  <div class="copyright">&copy; <?php echo date("Y"); echo " "; bloginfo('name'); ?></div>
				 	  <div class="copyrighttext"><?php echo bwthemes_option('footer_slogan');?></div>
				 
				 </div><!-- END DIV footerbottom -->
			
	   </div><!-- END DIV footerwrapper -->
	   </div><!-- END DIV maincontainer -->	   
  </div><!-- END DIV wrapper -->
  
  <?php //Google Analytics Support
		  $bw_ga = bwthemes_option('google_analytics_code');
		  if(!empty($bw_ga))
			{
			?>
			<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', '<?php echo $bw_ga;?>', 'auto');
			ga('send', 'pageview');

			</script>			
		<?php
		}
		?>
		<?php wp_footer(); ?>
  </body>
</html>
