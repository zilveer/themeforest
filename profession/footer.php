	<?php if ( opt('vertical_template') == 1 ) { ?>
		<a class="go-to-top"><img src="<?php echo THEME_IMAGES_URI ?>/up.png"></a>
	<?php }  ?>
	
	<footer class="wrap">
		<div class="footer-center clearfix">
			
			<div class="footer-border"></div>
			<?php if ( opt('footer_copyright') ) { ?>
			
				<div class="copyright">
					<span><?php  eopt('footer_copyright'); ?></span>
				</div>
				
			<?php }  else { ?>
						
				<div class="footer-border"></div>
			
			<?php }  ?>
			<div class="footer-border"></div>
			
		</div>
	</footer>
	<?php  if ( opt('HFColor') == 1 ) { ?> 
		</div> 
	<?php }  if ( opt('location_display') ) {

            if ( opt('marker') )
            {
              $marker=opt('marker');
            }
           else
            {
               $marker=get_template_directory_uri().'/assets/img/marker.png';
            }
?>
	
		<script src="http://maps.googleapis.com/maps/api/js?sensor=false&key=<?php eopt('gmap_api_key'); ?>" type="text/javascript"></script>
		<script type="text/javascript">
		
		//  Add location Here 
			var ZoomLevel= <?php eopt('contact_map_zoom'); ?>,
            ICON_MAP="<?php echo($marker); ?>",
            CUSTOM_MAP= <?php eopt('contact_map_custom'); ?>,
			CITY_MAP_CENTER_LAT= <?php eopt('contact_map_Latitude'); ?>,
			CITY_MAP_CENTER_LNG= <?php eopt('contact_map_Longitude'); ?>;
		
		// Custom Script
			<?php echo stripslashes(opt('custom_javascript')); ?>
		
		</script>	
		
	<?php } ?>
    <!-- Theme Hook -->
	<?php wp_footer(); ?> 
  </body>
</html>