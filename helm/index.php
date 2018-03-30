<?php
/*
Index
*/
FeaturedFlexiSlideScripts();
function FeaturedFlexiSlideshow_Init() {
	?>
<!-- Flexi Slider init -->
<script type="text/javascript">
jQuery(document).ready(function() {
	original_width=jQuery('.slides li').width();
	original_height=jQuery('.slides li').height();
	curr_width=jQuery('.flexslider-container').width();
	curr_height= ( original_height * curr_width ) / original_width;
	jQuery('.flexslider-loader').css('height', curr_height + 'px');
});
</script>
<script type="text/javascript">

	jQuery(window).load(function() {
		jQuery('.flexslider').hide();

	});
	jQuery(window).bind("load", function() {
		jQuery('.flexslider').fadeIn(500, function() {
			jQuery('.flex-direction-nav').fadeIn(500);
			jQuery('.flex-control-nav').fadeIn(500);
			jQuery('.flexslider-loader').css({'height':'auto','background-image':'none'});
		});
		jQuery('.flexslider').flexslider({
			animation: "<?php echo of_get_option('flexi_transition_style'); ?>",
			slideshow:  <?php if ( of_get_option('flexi_slideshow') ) { echo 'true'; } else { echo 'false'; } ?>,
			slideshowSpeed: <?php echo of_get_option('flexi_slideshow_speed'); ?>,
			animationDuration: <?php echo of_get_option('flexi_animation_duration'); ?>,
			pauseOnAction: true,
			pauseOnHover: false,
			controlsContainer: ".flexslider-container",
			before: function(slider) {
		   		jQuery('.flex-title a ').stop().fadeTo('fast','0');
		   		jQuery('.flex-caption').stop().fadeTo('fast','0');
		   		jQuery('.flex-bigtitle a ').stop().fadeTo('fast','0');
		    },
			after: function(slider) {
		   		jQuery('.flex-title a ').fadeTo(500,'1');
		   		jQuery('.flex-caption').fadeTo(800,'1');
		   		jQuery('.flex-bigtitle a ').fadeTo(300,'1');
		    }
		});
	});
</script>
	<?php
}
add_action('wp_footer', 'FeaturedFlexiSlideshow_Init',20);
?>
<?php get_header(); ?>
<?php get_template_part ('includes/mainpage/index-default'); ?>
<?php get_footer(); ?>