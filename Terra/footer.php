<?php 

	$footer_style = ot_get_option('footer_style');
	
?>	


	<!-- Footer -->
	<div id="footer" class="container animationStart <?php echo (!$footer_style ? 'footer_light' : '');?>">
		<div class="row footer_inside">
		
		  <div class="four columns">
		  	<?php if ( ! dynamic_sidebar('Footer Widget 1') ) : ?>
			<?php endif; // end widget area ?>	
		  </div>

		  <div class="four columns">
		  	<?php if ( ! dynamic_sidebar('Footer Widget 2') ) : ?>
			<?php endif; // end widget area ?>	
		  </div>

		  <div class="four columns">
		  	<?php if ( ! dynamic_sidebar('Footer Widget 3') ) : ?>
			<?php endif; // end widget area ?>	
		  </div>

		  <div class="four columns">
		  	<?php if ( ! dynamic_sidebar('Footer Widget 4') ) : ?>
			<?php endif; // end widget area ?>		
		  </div> 
	  </div> 
	  <div class="clear"></div>
	  <div class="footer_btm">
	  	<div class="footer_btm_inner">
	  	
	  	<?php 	if(is_array($footer_icons = ot_get_option('footer_icons'))){
					$footer_icons = array_reverse($footer_icons);							
					foreach($footer_icons as $footer_icon){
						echo "<a target='_blank' href='". $footer_icon['icons_url_footer']."' class='icon_". $footer_icon['icons_service_footer'] ."' title='". $footer_icon['title'] ."'>". $footer_icon['icons_service_footer'] ."</a>";			
					}
				}
		?>
	  	
		  	<div id="powered"><?php echo ot_get_option('copyrights');?></div>
		</div>	  
	  </div>
	</div>
	<!-- Footer::END -->
	
  </div>
  
  <?php wp_footer(); ?>
  
  
</body>
</html>