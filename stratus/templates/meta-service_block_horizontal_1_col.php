<?php
//======================================================================
// Service Boxes - Horizontal 1 Column
//======================================================================

//-----------------------------------------------------
// GET BACKGROUND
//-----------------------------------------------------
$partName = 'background';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// GET BORDER
//-----------------------------------------------------
$partName = 'border';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// Preloader, Section, Container Open
//-----------------------------------------------------
$partName = 'preload-container';
$section_template_class = 'service-blocks-horiz';
include( locate_template('templates/meta-part-' . $partName . '.php') );


//-----------------------------------------------------
// Meta Box Header / Subtext
//-----------------------------------------------------
$partName = 'header';
include( locate_template('templates/meta-part-' . $partName . '.php') );


//-----------------------------------------------------
// Service Blocks
//-----------------------------------------------------
if($show == 1){

	// return custom post type args for WP Query
	$args = themo_return_cpt_args($post->ID,$key,'themo_service_block','themo_cpt_group');

	// WP Query
	$loop = new WP_Query($args);

	// Open The Loop
	if ($loop->have_posts()) {

		$i = 0;

		// Animation
		$themo_enable_animate = get_post_meta($post->ID, $key.'_animate', true );
		$themo_animation_style = get_post_meta($post->ID, $key.'_animate_style', true );

		// Icon Style
		$icon_style = get_post_meta($post->ID, $key."_icon_style", true);
		if($icon_style == 'standard'){
			$icon_style_class = 'med-icon';
			$block_style_class = ' standard-block';
		}else{
			$icon_style_class = 'circle-med-icon';
			$block_style_class = ' circle-block';
		}

		echo '<div class="service-blocks">';
		while ($loop->have_posts()) {
			$loop->the_post();

			$metadata = get_post_meta($post->ID);


			/* Get Formatted Link */
			list($a_href,$a_href_text,$a_href_close) = themo_return_formatted_link($post->ID,'_');


			// ICONS
			$glyphicon = false;
			$glyphicon_class = "";
			if(isset($metadata['__glyphicons_icon_set'][0])){
				if($metadata['__glyphicons_icon_set'][0] > "" && $metadata['__glyphicons_icon_set'][0] != 'none'){
					$glyphicon_class = $metadata['__glyphicons_icon_set'][0]." ".$metadata['__glyphicons-icon'][0];
					$glyphicon = true;
				}
			}

			echo '<div class="service-block service-block-', $i, $block_style_class ,' row ', themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#'.$key.' .service-block-'.$i),'">';
			echo '<div class="col-xs-12">';
			if($glyphicon){
				echo '<div class="'. $icon_style_class.'">';
				echo wp_kses_post($a_href) . '<i class="accent '. esc_attr($glyphicon_class) . '"></i>'. wp_kses_post($a_href_close);
				echo '</div>';
			}
				echo '<div class="service-block-text">';
				if (get_the_title() > '') {
					echo '<h3>', wp_kses_post($a_href). get_the_title(), wp_kses_post($a_href_close). '</h3>';
				}
				if($post->post_content != "") {
					echo themo_content($post->post_content);
				}
				echo '</div>';
			echo '</div>';
			echo '</div>';


			$i++;
		}
		echo '</div> <!-- /.service-blocks -->';

	}
	wp_reset_postdata();

} // end outer if / then


//-----------------------------------------------------
// Preloader, Section, Container Close
//-----------------------------------------------------
$partName = 'preload-container-close';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// GET BORDER CLOSE
//-----------------------------------------------------
$partName = 'border-close';
include( locate_template('templates/meta-part-' . $partName . '.php') );