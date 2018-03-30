<?php
/*
Template Name: Drag & Drop Page Builder
*/	
?>
<?php get_header(); ?>
<?php

	wp_reset_query();
	global $post;
	
	//pagebuilder saved layout 
	$pagebuilder_layout = get_post_meta( $post->ID, "_".THEME_NAME."_pagebuilder_layout", true );
	
?>
<?php get_template_part(THEME_LOOP."loop-start"); ?>

	<?php 
		if(get_the_content()) {
			the_content();
		} 
		if(!$pagebuilder_layout && get_post_meta ( DF_page_id(), "_".THEME_NAME."_sliderStyle", true ) == "1") {
	?>
		<div class="row">
			<div class="col col_12_of_12">
				<?php get_template_part(THEME_SLIDERS."main-slider");?>
			</div>
		</div>		
	<?php
		}
		$DF_builder = new DF_home_builder;  
		if($pagebuilder_layout) {
			//foreach columns
			foreach ($pagebuilder_layout->columnRows as $columRows) {
				$DF_builder->columRows($columRows);
			}
		}

	?> 
	&nbsp;
<?php get_template_part(THEME_LOOP."loop-end"); ?>
<?php get_footer();?>