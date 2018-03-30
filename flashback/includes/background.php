<!--// BEGIN Backstretch //-->
<script type="text/javascript">

jQuery(document).ready(function() {

	<?php 
	
	$duration = of_get_option("duration");
	$fade = of_get_option("fade");
	
	$back1 = of_get_option("back1");
	$back2 = of_get_option("back2");
	$back3 = of_get_option("back3");
	$back4 = of_get_option("back4");
	$back5 = of_get_option("back5");
	$error_back = of_get_option("error_back");
	
	?>
	
	<?php if (is_front_page()) : ?>
	
		<?php if ($back1 == "") : ?>
		
		jQuery.backstretch("<?php echo get_stylesheet_directory_uri(); ?>/images/main_bg.jpg");
		
		<?php else : ?>
		
		jQuery.backstretch([
		
			"<?php echo $back1; // First Image ?>",
			<?php if ($back2 != "") : ?>"<?php echo $back2; ?>",<?php endif; ?>
			<?php if ($back3 != "") : ?>"<?php echo $back3; ?>",<?php endif; ?>
			<?php if ($back4 != "") : ?>"<?php echo $back4; ?>",<?php endif; ?>
			<?php if ($back5 != "") : ?>"<?php echo $back5; ?>"<?php endif; ?>
			
		], {
		
			duration: <?php if ($duration != "") : ?><?php echo $duration; ?><?php else : ?>5000<?php endif; ?>,
			fade: <?php if ($fade != "") : ?><?php echo $fade; ?><?php else : ?>1000<?php endif; ?>
		
		});
		
		<?php endif; ?>
		
	<?php elseif (is_404()) : ?>
	
		<?php if ($error_back != "") : ?>
	
		jQuery.backstretch("<?php echo $error_back; ?>");
		
		<?php else : ?>
		
		jQuery.backstretch([
		
			"<?php echo $back1; // First Image ?>",
			<?php if ($back2 != "") : ?>"<?php echo $back2; ?>",<?php endif; ?>
			<?php if ($back3 != "") : ?>"<?php echo $back3; ?>",<?php endif; ?>
			<?php if ($back4 != "") : ?>"<?php echo $back4; ?>",<?php endif; ?>
			<?php if ($back5 != "") : ?>"<?php echo $back5; ?>"<?php endif; ?>
			
		], {
		
			duration: <?php if ($duration != "") : ?><?php echo $duration; ?><?php else : ?>5000<?php endif; ?>,
			fade: <?php if ($fade != "") : ?><?php echo $fade; ?><?php else : ?>1000<?php endif; ?>
		
		});
		
		<?php endif; ?>
		
	<?php elseif (is_home()) : ?>
	
		<?php $blog_bg = of_get_option("blog_bg"); ?>
		
		<?php if ($blog_bg != "") : ?>
		
		jQuery.backstretch("<?php echo $blog_bg; ?>");
		
		<?php else : ?>
		
		jQuery.backstretch([
		
			"<?php echo $back1; // First Image ?>",
			<?php if ($back2 != "") : ?>"<?php echo $back2; ?>",<?php endif; ?>
			<?php if ($back3 != "") : ?>"<?php echo $back3; ?>",<?php endif; ?>
			<?php if ($back4 != "") : ?>"<?php echo $back4; ?>",<?php endif; ?>
			<?php if ($back5 != "") : ?>"<?php echo $back5; ?>"<?php endif; ?>
			
		], {
		
			duration: <?php if ($duration != "") : ?><?php echo $duration; ?><?php else : ?>5000<?php endif; ?>,
			fade: <?php if ($fade != "") : ?><?php echo $fade; ?><?php else : ?>1000<?php endif; ?>
		
		});
		
		<?php endif; ?>
		
	<?php elseif ( 'project' == get_post_type() ) : ?>
	
		<?php
		
		global $wp_query;
		$thePostID = $wp_query->post->ID;
		$imgFull = wp_get_attachment_image_src(get_post_thumbnail_id($thePostID), 'fullsize');
		$projectBg1 = get_post_meta($thePostID, 'si_project_bg_one', true);
		$projectBg2 = get_post_meta($thePostID, 'si_project_bg_two', true);
		$projectBg3 = get_post_meta($thePostID, 'si_project_bg_three', true);
		$projectBg4 = get_post_meta($thePostID, 'si_project_bg_four', true);
		$projectBg5 = get_post_meta($thePostID, 'si_project_bg_five', true);
		
		?>
		
		<?php if ($projectBg1 == "") : ?>
	
		jQuery.backstretch("<?php echo $imgFull[0]; ?>");
		
		<?php else : ?>
		
		jQuery.backstretch([
		
			"<?php echo $projectBg1; // First Image ?>"
			<?php if ($projectBg2 != "") : ?>,"<?php echo $projectBg2; ?>"<?php endif; ?>
			<?php if ($projectBg3 != "") : ?>,"<?php echo $projectBg3; ?>"<?php endif; ?>
			<?php if ($projectBg4 != "") : ?>,"<?php echo $projectBg4; ?>"<?php endif; ?>
			<?php if ($projectBg5 != "") : ?>,"<?php echo $projectBg5; ?>"<?php endif; ?>
			
		], {
		
			duration: <?php if ($duration != "") : ?><?php echo $duration; ?><?php else : ?>5000<?php endif; ?>,
			fade: <?php if ($fade != "") : ?><?php echo $fade; ?><?php else : ?>1000<?php endif; ?>
		
		});
		
		<?php endif; ?>
		
	<?php elseif (!is_single() || !is_page()) : ?>
	
		// Page Background
		
		<?php 
		
		global $wp_query;
		$thePostID = $wp_query->post->ID;
		$page_bg = get_post_meta($thePostID, 'si_page_bg', true);
		
		?>
		
		<?php if ($page_bg != "") : ?>
		
			jQuery.backstretch("<?php echo $page_bg; ?>");
		
		<?php else : ?>
		
			<?php if ($back1 == "") : ?>
			
			jQuery.backstretch("<?php echo get_stylesheet_directory_uri(); ?>/images/main_bg.jpg");
			
			<?php else : ?>
			
			jQuery.backstretch([
			
				"<?php echo $back1; // First Image ?>",
				<?php if ($back2 != "") : ?>"<?php echo $back2; ?>",<?php endif; ?>
				<?php if ($back3 != "") : ?>"<?php echo $back3; ?>",<?php endif; ?>
				<?php if ($back4 != "") : ?>"<?php echo $back4; ?>",<?php endif; ?>
				<?php if ($back5 != "") : ?>"<?php echo $back5; ?>"<?php endif; ?>
				
			], {
			
				duration: <?php if ($duration != "") : ?><?php echo $duration; ?><?php else : ?>5000<?php endif; ?>,
				fade: <?php if ($fade != "") : ?><?php echo $fade; ?><?php else : ?>1000<?php endif; ?>
			
			});
			
			<?php endif; ?>
		
		<?php endif; ?>
		
	<?php endif; ?>
	
});

</script>
<!--// END Backstretch //-->