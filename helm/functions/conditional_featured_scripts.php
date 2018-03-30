<?php
//Check for Featured type
$featured_slide_type=of_get_option('featured_style');
//$featured_slide_type="flexislider";
if ( DEMO_STATUS  ) { 
	if ( isset( $_GET['demo_featured'] ) ) $_SESSION['demo_featured']=$_GET['demo_featured'];
	if ( isset($_SESSION['demo_featured'] )) $featured_slide_type = $_SESSION['demo_featured'];
}
//Switch
Switch ( $featured_slide_type ) {
case "flexislider" :
?>
<!-- Flexi Slider init -->
<script type="text/javascript">
jQuery(window).bind("load", function() {
	jQuery('.flexslider').hide();
	jQuery('.flexslider').flexslider({
		animation: "<?php echo of_get_option('flexi_transition_style'); ?>",
		slideshow: <?php if ( of_get_option('flexi_slideshow') ) { echo 'true'; } else { echo 'false'; } ?>,
		slideshowSpeed: <?php echo of_get_option('flexi_slideshow_speed'); ?>,
		animationDuration: <?php echo of_get_option('flexi_animation_duration'); ?>,
		pauseOnAction: true,
		pauseOnHover: false,
		controlsContainer: ".flexslider-container"
	});
	jQuery('.flexslider').fadeIn('slow', function() { 
		jQuery('.flexslider-loader').css('height', 'auto');
	});
	
});
</script>
<?php
break;
}
?>