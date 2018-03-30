<?php
	/*
	*
	*	Styleswitcher
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2013 - http://www.swiftideas.net
	*
	*/
	
	$options = get_option('sf_neighborhood_options');
	$enable_styleswitcher = $options['enable_styleswitcher'];
	
	if ($enable_styleswitcher) {
		add_action('wp_footer', 'sf_styleswitcher');
	}
	
	function sf_styleswitcher() {
		
		$styleswitcher_path = get_template_directory_uri() . '/includes/swift-framework/sf-styleswitcher/';
	
	?>
		
		<div class="style-switcher">
			<h4>Style Switcher<a class="switch-button"><i class="fa-cog"></i></a></h4>
			
			<div class="switch-cont">
				
				<h5>Layout options</h5>
				<ul class="options layout-select">
					<li><a class="boxed" href="#"><img src="<?php echo $styleswitcher_path; ?>page-bordered.png"/></a></li>
					<li class="selected"><a class="fullwidth" href="#"><img src="<?php echo $styleswitcher_path; ?>page-fullwidth.png"/></a></li>
				</ul>
				
				<h5>Background Examples (boxed-only)</h5>
				<ul class="options bg-select" data-bgpath="<?php echo $styleswitcher_path; ?>">
					<li><a href="#" data-bgimage="detailed.png" class="pattern"><img src="<?php echo $styleswitcher_path; ?>detailed.png" alt="detailed"/></a></li>
					<li><a href="#" data-bgimage="px_by_Gre3g.png" class="pattern"><img src="<?php echo $styleswitcher_path; ?>px_by_Gre3g.png" alt="pixels"/></a></li>
					<li><a href="#" data-bgimage="diagonal-noise.png" class="pattern"><img src="<?php echo $styleswitcher_path; ?>diagonal-noise.png" alt="diagonal-noise"/></a></li>
					<li><a href="#" data-bgimage="swoosh_b&w.jpg" class="cover"><img src="<?php echo $styleswitcher_path; ?>swoosh_b&w_thumb.jpg" alt="swoosh_b&w"/></a></li>
					<li><a href="#" data-bgimage="swoosh_colour.jpg" class="cover"><img src="<?php echo $styleswitcher_path; ?>swoosh_colour_thumb.jpg" alt="swoosh_colour"/></a></li>
					<li><a href="#" data-bgimage="beach.jpg" class="cover"><img src="<?php echo $styleswitcher_path; ?>beach_thumb.jpg" alt="beach"/></a></li><li><a href="#" data-bgimage="L1040896.jpg" class="cover"><img src="<?php echo $styleswitcher_path; ?>L1040896_thumb.jpg" alt="sundown"/></a></li>
				</ul>
				
				<a class="many-more" href="http://neighborhood.swiftideas.net/features/">Many more options included &rarr;</a></div></div>
		
		<script>
			var onLoad = {
			    init: function(){
			    
			    "use strict";
						
				jQuery('.style-switcher').on('click', 'a.switch-button', function(e) {
					e.preventDefault();
					var $style_switcher = jQuery('.style-switcher');
					if ($style_switcher.css('left') === '0px') {
						$style_switcher.animate({
							left: '-240'
						});
					} else {
						$style_switcher.animate({
							left: '0'
						});
					}
				});
			
				jQuery('.layout-select li').on('click', 'a', function(e) {
					e.preventDefault();
					jQuery('.layout-select li').removeClass('selected');
					jQuery(this).parent().addClass('selected');
					var selectedLayout = jQuery(this).attr('class');
					
					if (selectedLayout === "boxed") {
						jQuery("#container").addClass('boxed-layout');
					} else {
						jQuery("#container").removeClass('boxed-layout');
					}
					
					jQuery('.flexslider').each(function() {
						var slider = jQuery(this).data('flexslider');
						if (slider) {
						slider.resize();
						}
					});
					jQuery(window).resize();
				});
								
				jQuery('.bg-select li').on('click', 'a', function(e) {
					e.preventDefault();
					var newBackground = jQuery(this).attr('data-bgimage'),
						bgType = jQuery(this).attr('class'),
						bgPath = jQuery('.bg-select').attr('data-bgpath');
							
					if (bgType === "cover") {
						jQuery('body').css('background', 'url('+bgPath+newBackground+') no-repeat center top fixed');
						jQuery('body').css('background-size', 'cover');
					} else {
						jQuery('body').css('background', 'url('+bgPath+newBackground+') repeat center top fixed');
						jQuery('body').css('background-size', 'auto');
					}
				});
				
			    }
			};
			
			jQuery(document).ready(onLoad.init);
		</script>
	
	<?php }
	
?>