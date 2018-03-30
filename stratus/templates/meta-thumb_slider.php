<?php
//======================================================================
// Thumbnail Slider
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
$section_template_class = 'thumb-slider';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// Meta Box Header / Subtext
//-----------------------------------------------------
$partName = 'header';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// Thumbnail Slider
//-----------------------------------------------------

$metadata = get_post_meta($post->ID);

if($show == 1) { // Slider Enabled

		// return custom post type args for WP Query
		$args = themo_return_cpt_args($post->ID,$key,'themo_thumb_slider','themo_cpt_group');

		// WP Query
		$loop = new WP_Query($args);

		// Open The Loop
		if ($loop->have_posts()) {

			$themo_enable_animate = get_post_meta($post->ID, $key.'__animate', true );
			$themo_animation_style = get_post_meta($post->ID, $key.'__animate_style', true );
			$image_orientation = get_post_meta($post->ID, $key.'_image_orientation', true );
			$image_size = 'themo_thumb_slider';

			if($image_orientation === 'portrait'){
				$image_size = 'themo_thumb_slider_portrait';
			}

			// Lightbox Support
			$lightbox_enabled = get_post_meta($post->ID, $key.'_lightbox', true );

			$i = 0;

			echo '<div class="row">';
			echo '<div id="'. $key .'_inner" class="thumb-flex-slider flexslider flex-'. $image_orientation.' col-xs-12">';
            echo '<ul class="slides gallery">';
            $i = 1;

			while ($loop->have_posts()) {
				$loop->the_post();
				$metadata = get_post_meta($post->ID);
				$unique_img_class = 'thumb-flex-slider-img-'.$i;

				$show_title = true;


				if(isset($metadata["__hide_title"][0]) && $metadata["__hide_title"][0] == 1) {
					$show_title = false;
				}

				/* Get Formatted Link */
				list($a_href,$a_href_text,$a_href_close) = themo_return_formatted_link($post->ID,'_');

				echo '<li class="', $unique_img_class, themo_return_entrance_animation_class($themo_enable_animate, $themo_animation_style, '#' . $key . ' .' . $unique_img_class), '">';

				if ( has_post_thumbnail() ) {
					$img_attr = array('class'	=> 'img-responsive');


					// Lightbox
					if($lightbox_enabled == 1) {
						$img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
						$content =  "<a href='".esc_url($img_url)."' data-parent='slides'>" . get_the_post_thumbnail($post->ID,$image_size,$img_attr) . "</a>";
						$lighbox = themo_add_lighbox_data($content);
						echo $lighbox;
					}else{
						echo wp_kses_post($a_href) . get_the_post_thumbnail($post->ID,"themo_thumb_slider") . wp_kses_post($a_href_close);
					}

					if(get_the_title()>"" && $show_title){
						$small_text = "";
						if(isset($metadata['_small_text'][0]) && $metadata['_small_text'][0] > ""){
							$small_text = "<span>".$metadata['_small_text'][0]."</span>";
						}
						echo '<p class="thumb-title">', wp_kses_post($a_href), get_the_title(), wp_kses_post($a_href_close), $small_text, '</p>';
					}

				}

				echo '</li>';
				$i++;
			}
			echo '</ul><!-- /.slides -->';
			echo '</div> <!-- /.thumb-flex-slider -->';
			echo '</div><!-- /.row -->';

			?>
			<script>
			jQuery(window).load(function() {
				jQuery('.thumb-flex-slider').show();
				themo_start_thumb_slider('#<?php echo sanitize_html_class($key);?>_inner');
			});
			</script>
			<?php
		}else {
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
