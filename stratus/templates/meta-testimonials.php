<?php
//======================================================================
// Testimonials Template
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
?>


<?php
//-----------------------------------------------------
// Preloader, Section, Container Open
//-----------------------------------------------------
$partName = 'preload-container';
$section_template_class = 'testimonials';
include( locate_template('templates/meta-part-' . $partName . '.php') );
?>


<?php
//-----------------------------------------------------
// Meta Box Header / Subtext
//-----------------------------------------------------
$partName = 'header';
include( locate_template('templates/meta-part-' . $partName . '.php') );


//-----------------------------------------------------
// Testimonials Loop
//-----------------------------------------------------
if ($show == 1) {

	// return custom post type args for WP Query
	$args = themo_return_cpt_args($post->ID,$key,'themo_testimonials','themo_cpt_group');

	// WP Query
	$loop = new WP_Query($args);

	// Open The Loop
	if ($loop->have_posts()) {

		// Animation
		$themo_enable_animate = get_post_meta($post->ID, $key.'_animate', true );
		$themo_animation_style = get_post_meta($post->ID, $key.'_animate_style', true );

		$i = 1;

		/* Count number of boxes and output HTML accordingly */
		$testimonial_count = $loop->post_count;

		switch ($testimonial_count) {
			case 1:
				$bootstrap_tier = 'col-md-12';
				break;
			case 2:
				$bootstrap_tier = 'col-md-6';
				break;
			default:
				$bootstrap_tier = 'col-md-4';
				break;
		}
		while ($loop->have_posts()) {

			$loop->the_post();
			$metadata = get_post_meta($post->ID);

			$panel_count = themo_convertNumber($i);
			$panel_count = ucwords(strtolower($panel_count));
			if ($i == 1){
				$first = "in";
			}else{
				$first = "";
			}

			if(($i == 1) || ($i-1) % 3 == 0){
				echo '<div class="row">';
			}

			echo '<div class="'. $bootstrap_tier .'">';
			echo '<figure class="quote">';

			if(isset($metadata["_quote"]) && $metadata["_quote"] > ""){
				echo '<blockquote class="blockquote-', $i, themo_return_entrance_animation_class($themo_enable_animate, $themo_animation_style, '#' . $key . ' .blockquote-' . $i), '">', $metadata["_quote"][0], '</blockquote>';
			}
			if ( has_post_thumbnail() ) {
				$img_class = 'circle circle-'.$i.themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#'.$key.' .circle-'.$i);

				$featured_img_attr = array('class'	=> $img_class);
				echo get_the_post_thumbnail($post->ID,'themo_testimonials',$featured_img_attr);
			}
			if (get_the_title() > '') {
				echo '<figcaption class="figcaption-', $i, themo_return_entrance_animation_class($themo_enable_animate, $themo_animation_style, '#' . $key . ' .figcaption-' . $i), '">', get_the_title(), '<span>'.$metadata['_title'][0].'</span></figcaption>';
			}


			echo '</figure> ';
			echo '</div> <!-- /.col-md -->';

			if ($loop->post_count == $i || $i % 3 == 0){
				echo '</div> <!-- /.row -->';
			}
			$i++;

		} // end inner loop
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
?>

