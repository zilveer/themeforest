	<?php $inspire_options = get_option('inspire_options'); ?>

	<script type="text/javascript">

		<?php if (mb_get_page_type() != 'single' && mb_get_page_type() != 'page') {?>
			//MASONRY
			jQuery(document).ready(function($){
				var $container = $('#main');

				$container.imagesLoaded( function(){
				  $container.masonry({
					itemSelector : '.item'
				  });
				});
			});

		   jQuery(window).load(function(){
				jQuery('#main').masonry('reload');
		   });

			//FLEXSLIDER
			jQuery(window).load(function($){
			  jQuery('.flexslider').flexslider({
				animation: "slide",
				//slideshowSpeed: 7000, 
				controlNav: true  
			  });
			});
		<?php } ?>


		//RESPONSIVE
		jQuery(document).ready(function($) {
			if(jQuery.insGlobalFunctions.isHandHeld()) {
				console.log("userAgent: "+ navigator.userAgent);
				 var insResponsiveString = "<?php if (isset($inspire_options['use_responsive_design'])) echo '<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"><link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"'. get_template_directory_uri() .'/css/responsive.css\" />'; ?>";
				$('head').append(insResponsiveString);
			}
		});

	</script>
