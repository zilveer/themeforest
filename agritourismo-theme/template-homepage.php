<?php
/*
Template Name: Drag & Drop Page Builder
*/	
?>
<?php get_header(); ?>
<?php get_template_part(THEME_INCLUDES.'top'); ?>
<?php

	wp_reset_query();
	global $post;
	
	//homepage slider
	$homeSlider = get_post_meta ( $post->ID, THEME_NAME."_layer_slider_settings", true ); 
	$homeSliderId = get_post_meta ( $post->ID, THEME_NAME."_layer_slider", true ); 
	if(!$homeSliderId) $homeSliderId = 1;

	//blocks
	$homepage_layout_order = get_option(THEME_NAME."_homepage_layout_order_".$post->ID);

?>
			<?php if($homeSlider=="yes") { ?>
				<!-- BEGIN .main-slider -->
				<div class="main-slider">

					<?php echo do_shortcode('[layerslider id="'.$homeSliderId.'"]');?>

				<!-- END .main-slider -->
				</div>
			<?php } ?>
			<!-- BEGIN .content -->
			<div class="content">
				
				<!-- BEGIN .wrapper -->
				<div class="wrapper">

					<?php if(get_the_content()) { ?>
						<div class="main-block">
							<?php the_content();?>
						</div>
					<?php } ?>
					<?php
						get_template_part(THEME_FUNCTIONS.'homepage', 'blocks');
						if(is_array($homepage_layout_order)) {
							foreach($homepage_layout_order as $blocks) { 
								$blockType = $blocks['type'];
								$blockId = $blocks['id'];
								$blockInputType = $blocks['inputType'];
								
								$blockType($blockType, $blockId,$blockInputType);
								
							}
						}
					?> 
				<!-- END .wrapper -->
				</div>
				
			<!-- BEGIN .content -->
			</div>

<?php get_footer();?>