<?php
//======================================================================
// Service Boxes - Vertical
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
$section_template_class = 'icon-blocks';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// Meta Box Header / Subtext
//-----------------------------------------------------
$partName = 'header';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// Service Blocks
//-----------------------------------------------------
if ($show == 1){ // is this featured enabled?
	// return custom post type args for WP Query
	$args = themo_return_cpt_args($post->ID,$key,'themo_service_block','themo_cpt_group');

	// WP Query
	$loop = new WP_Query($args);

	// Open The Loop
	if ($loop->have_posts()) {

		$i = 1;
		// Animation
		$themo_enable_animate = get_post_meta($post->ID, $key.'_animate', true );
		$themo_animation_style = get_post_meta($post->ID, $key.'_animate_style', true );

		/* Count number of boxes and output HTML accordingly */

		switch ($loop->post_count) {
			case 1:
				$bootstrap_tier = ' col-md-6 col-md-offset-3';
				break;
			case 2:
				$bootstrap_tier = ' col-md-6';
				break;
			default:
				$bootstrap_tier = ' col-md-4';
				break;
		}

		echo '<div class="row">';
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

				echo '<div class="icon-block icon-block-', $i, $bootstrap_tier , themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#'.$key.' .icon-block-'.$i,200),'">';

				if($glyphicon){
					echo '<div class="circle-lrg-icon">';
					echo wp_kses_post($a_href) . '<i class="accent '. esc_attr($glyphicon_class) . '"></i>'. wp_kses_post($a_href_close);
					echo '</div>';
				}
				if (get_the_title() > '') {
					echo '<h3>', wp_kses_post($a_href). get_the_title(), wp_kses_post($a_href_close). '</h3>';
				}
				if($post->post_content != "") {
					echo themo_content($post->post_content);
				}
				echo '</div>';

				if ($i++ == 3) break;
			}
		echo '</div><!--/row-->';

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

