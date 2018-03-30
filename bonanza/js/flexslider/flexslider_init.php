<?php
global $theme_options;
?>
<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function($){	
	//	Initialize Homepage Slider
	$("#featured .flexslider").flexslider({
		controlNav: false,
		directionNav: true,
		animation: "<?php echo $theme_options['slider_animation']; ?>",
		slideshowSpeed: <?php echo $theme_options['slider_speed']; ?>,
		slideshow: <?php if ( isset($theme_options['slider_auto']) && $theme_options['slider_auto']  == '1' ) { echo 'true'; } else { echo 'false'; } ?>,
		start: function(){
	      $('.loader').hide();
	  }
	});	
});
//]]>
</script>