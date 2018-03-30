<?php
//======================================================================
// Tour Template 
//======================================================================
?>

<?php
// If there is a anchor link for one pager style, create output
$anchor_id_markup = false;
$anchor_key = get_post_meta($post->ID, $key.'_anchor', true );

if(isset($anchor_key) && $anchor_key > "" ){
    $anchor_id_markup = "id='$anchor_key'";
}

echo '<div '.$anchor_id_markup.' >';
?>

<section <?php if($key > ""){echo 'id="'.$key.'"';} ?> class="floated-blocks">
<?php

if ($show == 1) {
	// return custom post type args for WP Query
	$args = themo_return_cpt_args($post->ID,$key,'themo_tour','themo_cpt_group');

	// WP Query
	$loop = new WP_Query($args);

	// Open The Loop
	if ($loop->have_posts()) {

		$i = 0;

		while ($loop->have_posts()) {
			$loop->the_post();
			$element = get_post_meta($post->ID);


			// Image Float
			if (!isset($element['__photo_align'][0])){
				$element['__photo_align'][0] = "centred";
			}

			// Default image size
			$image_size = 'themo_team';
            $large_photo_size_class = false;
			switch ($element['__photo_align'][0]) {
				case 'right':
					$align_class = "img-right";
					//__photo_size
					if (isset($element['__photo_size'][0]) && $element['__photo_size'][0] == 'large'){
						$large_photo_size_class = " lg-tour-image";
						$bootstrap_tier_content = "col-sm-7";
						$bootstrap_tier_image = "col-sm-5";
					}else{
						$bootstrap_tier_content = "col-sm-8";
						$bootstrap_tier_image = "col-sm-4";
					}
					break;
				case 'left':
					$align_class = "img-left";
					if (isset($element['__photo_size'][0]) && $element['__photo_size'][0] == 'large'){
						$large_photo_size_class = " lg-tour-image";
						$bootstrap_tier_content = "col-sm-7";
						$bootstrap_tier_image = "col-sm-5";
					}else{
						$bootstrap_tier_content = "col-sm-8";
						$bootstrap_tier_image = "col-sm-4";
					}
					break;
				case 'centered':
					$align_class = "img-center";
					$bootstrap_tier_content = "col-sm-12";
					$bootstrap_tier_image = "col-sm-12";
					$image_size = 'themo_full_width';
					break;
			}

			// Image Sticky
			switch ($element['__photo_sticky'][0]) {
				case 'bottom':
					$sticky_class = "img-sticky-bottom";
					if (isset($element['__hover'][0]) && $element['__hover'][0] == 1){
						$sticky_class .= " sticky-pop-up";
					}

					break;
				case 'top':
					$sticky_class = "img-sticky-top";
					break;
				default:
					$sticky_class = "";
			}

			//$options_array = $element;
			$section_uid = $key."_".$i;

			// Add large styling class if selected.
			$large_style_class = "";
			if (isset($element['__large_styling'][0]) && $element['__large_styling'][0] == 1){
				$large_style_class = "large-tour ";
			}

			//$key ='_';
			$themo_custom_post_type_meta = true;
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
			$section_template_class = 'float-block '. $large_style_class . $align_class . $large_photo_size_class;

			// add large-tour after float-block
			include( locate_template('templates/meta-part-' . $partName . '.php') );


			// Animation
			$themo_enable_animate = $element['__animate'][0] ;
			$themo_animation_style = $element['__animate_style'][0];

			echo '<div class="row">';
				echo '<div class="float-content '.$bootstrap_tier_content.'">';
					echo '<div class="center-table-con">';
						echo '<div class="center-table-cell">';
							if (get_the_title() > '') {
								echo '<h2 class="tour-content-title tour-title-', $i, themo_return_entrance_animation_class($themo_enable_animate, $themo_animation_style, '#' . $section_uid . ' .tour-title-' . $i), '">', get_the_title(), '</h2>';
							}
							if($post->post_content != "") {
								echo '<div class="tour-content-', $i, themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#'.$section_uid.' .tour-content-'.$i),'">', themo_content($post->post_content) , '</div>';
							}
			                $button = false;
                            $button2 = false;

                            $button = themo_do_shortocde_button($post->ID, '_', true);
                            $button2 = themo_do_shortocde_button($post->ID, '_', true,false,2);
                            if ($button > "" || $button2 > "") {
								echo '<div class="tour-button-', $i, themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#'.$section_uid.' .tour-button-'.$i),'">';
                                echo do_shortcode($button);
                                echo do_shortcode($button2);
                                echo '</div>';
							}
					   echo '</div>';
					echo '</div>';
				echo '</div>';
			if ( has_post_thumbnail() ) {
				$img_attr = array('class'	=> 'img-responsive');

				echo '<div class="float-img '. $bootstrap_tier_image.'">';
				echo '<div class="center-table-con">';
				echo '<div class="center-table-cell '. $sticky_class.'">';
				echo get_the_post_thumbnail($post->ID,$image_size,$img_attr);
				echo '</div>';
				echo '</div>';
				echo '</div>';
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

			$i++;
		} // end inner loop
	} else {
		// no posts found
	}
	// Restore original Post Data
	wp_reset_postdata();
}
echo '</section>';
echo '</div>';
$background_array = "";
$section_uid = "";
