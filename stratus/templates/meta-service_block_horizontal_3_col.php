<?php
//======================================================================
// Service Blocks - Careers
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
// Service Blocks - Careers
//-----------------------------------------------------	
if ($show == 1){

	$image = get_post_meta($post->ID, $key.'_image', true );

	// return custom post type args for WP Query
	$args = themo_return_cpt_args($post->ID,$key,'themo_service_block','themo_cpt_group');

	// WP Query
	$loop = new WP_Query($args);

	// Open The Loop
	if ($loop->have_posts()) {

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

			echo '<div class="row">';

			$i=1;
			$i_animate=1;

			$post_count = $loop->post_count;
			$fist_half = round($post_count / 2) ;

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

				if($i == 1){
					echo '<div class="service-block-col first col-sm-4">';
				}elseif($i == ($fist_half+1)){
					echo '</div>';
					if(isset($image) && $image > ""){
						$img_src = themo_return_metabox_image($image, null, "themo_team", true, $alt);
						echo '<div class="service-block-img col-sm-4 ', themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#'.$key.' .service-block-img'),'">';
						echo '<img src="'. esc_url($img_src). '" alt="'. esc_attr($alt).'">';
						echo '</div>';
					}
					echo '<div class="service-block-col col-sm-4">';
					$i_animate=1;
				}

				echo '<div class="service-block service-block-', $i_animate, $block_style_class , themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#'.$key.' .service-block-'.$i_animate),'">';

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

				if($post_count == $i){echo '</div>';}
				$i++;
				$i_animate++;
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