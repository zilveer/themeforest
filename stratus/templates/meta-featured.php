<!-- START FEATURED TEMPLATE -->
<?php
//======================================================================
// Features Template 
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
$section_template_class = 'features';
include( locate_template('templates/meta-part-' . $partName . '.php') );

echo '<div class="features-inner">';

//-----------------------------------------------------
// Meta Box Header / Subtext
//-----------------------------------------------------
$partName = 'header';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// Featured
//-----------------------------------------------------
if ($show == 1) {


	// return custom post type args for WP Query
	$args = themo_return_cpt_args($post->ID,$key,'themo_featured','themo_cpt_group');


	// WP Query
	$loop = new WP_Query($args);

	// Open The Loop
	if ($loop->have_posts()) {

		$themo_enable_animate = get_post_meta($post->ID, $key.'_animate', true );
		$themo_animation_style = get_post_meta($post->ID, $key.'_animate_style', true );

		$i = 1;

		while ($loop->have_posts()) {
			$loop->the_post();
			$metadata = get_post_meta($post->ID);


			// First Post
			if($i == 1 || $i % 2){
				echo '<div class="row">';
			}

			/* Get Formatted Link */
			list($a_href,$a_href_text,$a_href_close) = themo_return_formatted_link($post->ID,'_');

			echo '<div class="col-md-6">';
			echo '<div class="feature-block">';

			if ( has_post_thumbnail() ) {
				$img_class = 'feature-img-'.$i.themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#'.$key.' .feature-img-'.$i);

				$img_attr = array('class'	=> $img_class);
				echo wp_kses_post($a_href) . get_the_post_thumbnail($post->ID,'themo_featured',$img_attr) . wp_kses_post($a_href_close);
			}

			if (get_the_title() > '') {
				echo '<h3 class="feature-title-', $i, themo_return_entrance_animation_class($themo_enable_animate, $themo_animation_style, '#' . $key . ' .feature-title-' . $i), '">', wp_kses_post($a_href), get_the_title(), wp_kses_post($a_href_close), '</h3>';
			}

			if($post->post_content != "") {
				echo '<div class="feature-text-', $i, themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#'.$key.' .feature-text-'.$i),'">', themo_content($post->post_content) , '</div>';
			} // Subtitle

			echo '</div><!-- /.feature-block -->';
			echo '</div><!-- /.col-md-6 -->';

			// Last Post
			if ($loop->post_count == $i || $i % 2 === 0){
				echo '</div><!--/row-->';
			}
			$i++;
		} // end inner loop

	} else {
		// no posts found
	}
	// Restore original Post Data
	wp_reset_postdata();
}

echo '</div>';

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