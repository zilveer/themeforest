<?php
//======================================================================
// META FAQs Template 
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
$section_template_class = 'showcase';
include( locate_template('templates/meta-part-' . $partName . '.php') );


//-----------------------------------------------------
// Meta Box Header / Subtext
//-----------------------------------------------------
$partName = 'header';
include( locate_template('templates/meta-part-' . $partName . '.php') );


//-----------------------------------------------------
// Showcase | Heading, Content & Image
//-----------------------------------------------------	
$floating_block_show = get_post_meta($post->ID, $key.'_show_floating_block', true );

 if($floating_block_show == 1){
	$tour_content_heading = get_post_meta($post->ID, $key.'_content_heading', true );
	$tour_content = get_post_meta($post->ID, $key.'_content', true );
	$tour_image = get_post_meta($post->ID, $key.'_image', true );
	$tour_image_float = get_post_meta($post->ID, $key.'_image_float', true );

	// Animation
	$themo_enable_animate = get_post_meta($post->ID, $key.'_animate', true );
	$themo_animation_style = get_post_meta($post->ID, $key.'_animate_style', true );


	// Default to col-sm-6
	$cols = '6';
	$bootstrap_tier_content = 'col-sm-'.$cols;

	$centered = '';
	// Default image size
	$image_size = 'themo_showcase';

	switch ($tour_image_float) {
		case 'left':
			$image_align = ' col-sm-pull-'.$cols;
			$text_align = ' col-sm-push-'.$cols;
			break;
		case 'centered':
			$cols = '12';
			$bootstrap_tier_content = 'col-sm-'.$cols;
			$image_align = '';
			$text_align = '';
			$centered = 'centered';
			$image_size = 'themo_full_width';
			break;
		default:
			$image_align = '';
			$text_align = '';
	}

	//-----------------------------------------------------
	// Showcase Image & Paragraph
	//-----------------------------------------------------
	if($tour_content > "" || $tour_image > ""){
		echo '<div class="float-section row">';
			echo '<div class="'. $bootstrap_tier_content . $text_align.'">';
				//-----------------------------------------------------
				// Showcase Title
				//-----------------------------------------------------
				if($tour_content_heading > ""){
					echo '<h3 class="showcase-title '.$centered.'">'.$tour_content_heading.'</h3>';
				}
				echo themo_content($tour_content);
			echo '</div>';
			if($tour_image > ""){
                echo '<div class="showcase_image '. $bootstrap_tier_content . $image_align . themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#'.$key.' .showcase_image').'">';
				echo themo_return_metabox_image($tour_image,"img-responsive", $image_size);
				echo '</div>';
			}
		echo '</div>';
	}
 }

//-----------------------------------------------------
// Showcase Bullet List
//-----------------------------------------------------
if($show == 1){

	// return custom post type args for WP Query
	$args = themo_return_cpt_args($post->ID,$key,'themo_service_block','themo_cpt_group');

	// WP Query
	$loop = new WP_Query($args);

	// Open The Loop
	if ($loop->have_posts()) {

		$i = 1;
		echo '<div class="service-blocks">';
			while ($loop->have_posts()) {
				$loop->the_post();

				$metadata = get_post_meta($post->ID);

				/* Get Formatted Link */
				list($a_href,$a_href_text,$a_href_close) = themo_return_formatted_link($post->ID,'_');

				if(($i == 1) || ($i-1) % 2 == 0){
					echo '<div class="row">';
				}

				// ICONS
				$glyphicon = false;
				$glyphicon_class = "";
				if(isset($metadata['__glyphicons_icon_set'][0])){
					if($metadata['__glyphicons_icon_set'][0] > "" && $metadata['__glyphicons_icon_set'][0] != 'none'){
						$glyphicon_class = $metadata['__glyphicons_icon_set'][0]." ".$metadata['__glyphicons-icon'][0];
						$glyphicon = true;
					}
				}
				echo '<div class="service-block col-sm-6 service-block-', $i, themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#'.$key.' .service-block-'.$i),'">';
				if($glyphicon){
					echo '<div class="med-icon">'. wp_kses_post($a_href) . '<i class="accent '. esc_attr($glyphicon_class) . '"></i>'. wp_kses_post($a_href_close) .'</div>';
				}
				if (get_the_title() > '') {
					echo '<h3>', wp_kses_post($a_href). get_the_title(), wp_kses_post($a_href_close). '</h3>';
				}
				if($post->post_content != "") {
					echo themo_content($post->post_content);
				}
				echo '</div>';

				if ($loop->post_count == $i || $i % 2 == 0){
					echo '</div> <!-- /.row -->';
				}
				$i++;
			}
		echo '</div> <!-- /.service-blocks -->';

	}
	// Restore original Post Data
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


