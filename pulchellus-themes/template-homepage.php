<?php
/*
Template Name: Homepage
*/	
?>
<?php get_header(); ?>
<?php get_template_part(THEME_INCLUDES.'top'); ?>

<?php 
	wp_reset_query();
	global $post;

	$homepage_layout_order = get_option(THEME_NAME."_homepage_layout_order"); 
?>
	<div id="primary">
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
	</div>
</div>
<?php get_footer(); ?>