<?php
//======================================================================
// Brands
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
$section_template_class = 'brands';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// Meta Box Header / Subtext
//-----------------------------------------------------
$partName = 'header';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// Brands
//-----------------------------------------------------
if ($show == 1) {

	// Animation
	$themo_enable_animate = get_post_meta($post->ID, $key.'_animate', true );
	$themo_animation_style = get_post_meta($post->ID, $key.'_animate_style', true );

	// return custom post type args for WP Query
	$args = themo_return_cpt_args($post->ID,$key,'themo_brands','themo_cpt_group');

	// WP Query
	$loop = new WP_Query($args);

	// Open The Loop
	if ($loop->have_posts()) {

		echo '<div class="row">';
		$i = 0;
		while ($loop->have_posts()) {
			$loop->the_post();
			$metadata = get_post_meta($post->ID);

			/* Get Formatted Link */
			list($a_href,$a_href_text,$a_href_close) = themo_return_formatted_link($post->ID,'_');

			if ( has_post_thumbnail() ) {
				$img_class = 'brand-img-'.$i.themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#'.$key.' .brand-img-'.$i);
				$featured_img_attr = array('class'	=> $img_class);
				echo wp_kses_post($a_href) . get_the_post_thumbnail($post->ID,'themo_brands',$featured_img_attr) . wp_kses_post($a_href_close);
			}

			$i++;
		} // end inner loop
		echo '</div><!-- /.row -->';
	} else {
		// no posts found
	}
	// Restore original Post Data
	wp_reset_postdata();
}

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
 
