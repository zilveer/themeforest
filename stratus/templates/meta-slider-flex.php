<?php
/*****************************
	Flexslider Template
*****************************/

if(isset($post->ID)){
	$postID = $post->ID;
}else{
	$postID = get_the_ID();
}

$metadata = get_post_meta($postID);
$key = 'themo_slider';
$show = get_post_meta($postID, $key.'_sortorder_show', true );
$show_flex = get_post_meta($postID, $key.'_flex_show', true );
$show_shortcode = get_post_meta($postID, $key.'_global_form_show', true );
$down_arrow = get_post_meta($postID, $key.'_down_arrow', true );
$down_arrow_anchor = get_post_meta($postID, $key.'_down_arrow_anchor', true );


if($show == 1) { // Slider Enabled
	if($show_flex == 1) { // Use Flex Slider

	// Flex slider Options
	if ( function_exists( 'ot_get_option' ) ) {
		$themo_flex_animation  = ot_get_option( 'themo_flex_animation', "fade" );
		$themo_flex_easing  = ot_get_option( 'themo_flex_easing', "swing" );
		$themo_flex_animationloop  = themo_return_on_off_boolean(ot_get_option( 'themo_flex_animationloop', true ));
		$themo_flex_smoothheight  = themo_return_on_off_boolean(ot_get_option( 'themo_flex_smoothheight', false ));
		$themo_flex_slideshowspeed  = ot_get_option( 'themo_flex_slideshowspeed', 7000 );
		$themo_flex_animationspeed  = ot_get_option( 'themo_flex_animationspeed', 600 );
		$themo_flex_randomize  = themo_return_on_off_boolean(ot_get_option( 'themo_flex_randomize', false ));
		$themo_flex_pauseonhover  =themo_return_on_off_boolean( ot_get_option( 'themo_flex_pauseonhover', true ));
		$themo_flex_touch  = themo_return_on_off_boolean(ot_get_option( 'themo_flex_touch', true ));
		$themo_flex_directionnav  = themo_return_on_off_boolean(ot_get_option( 'themo_flex_directionnav', true ));
		$themo_flex_controlNav  = themo_return_on_off_boolean(ot_get_option( 'themo_flex_controlNav', true ));
	}

	// Down arrow options
		$down_arrow_markup = false;
	if(isset($down_arrow) && $down_arrow == 1 && isset($down_arrow_anchor) && $down_arrow_anchor > ""){
		$themo_flex_controlNav = 'false';
		$down_arrow_markup = '<a href="'.esc_url($down_arrow_anchor).'" target="_self" class="slider-scroll-down th-icon th-i-down"></a>';
	}

	// If there is a anchor link for one pager style, create output
	if($key > ""){
		$anchor_markup_open = "";
		$anchor_markup_close = "";
		$anchor_key = sanitize_text_field(get_post_meta($postID, $key.'_anchor', true ));
		if($anchor_key > ""){
			$anchor_markup_open = "<div id='$anchor_key'>";
			$anchor_markup_close = "</div>";
		}
	};

	// Slider Conversion Form Status and shortocde
	$slider_shortcode_status = get_post_meta($postID, $key.'_global_form_show', true );
	if($slider_shortcode_status == 1) {
		$slider_shortcode = get_post_meta($postID, $key.'_form_global_shortcode', true );
	}
	$themo_enable_animate = get_post_meta($postID, $key.'__animate', true );
	$themo_animation_style = get_post_meta($postID, $key.'__animate_style', true );

	$i = 0;

	// return custom post type args for WP Query
	$args = themo_return_cpt_args($postID,$key.'_flex','themo_slider','themo_cpt_group');
	// WP Query
	$loop = new WP_Query($args);

	echo wp_kses_post($anchor_markup_open);
	// Open The Loop
	if ($loop->have_posts()) {

        $i = 0;
        $padding_css = false;
        while ($loop->have_posts()) {

            $loop->the_post();
            $postID_inner = get_the_ID();
            $element = get_post_meta($postID_inner);

            if(isset($element['__padding'][0]) && $element['__padding'][0] == 1){

                $top_padding = $element['__top_padding'][0];
                $bottom_padding = $element['__bottom_padding'][0];
                $padding_css .= "#main-flex-slider .".$key."_".$i."{padding-top:".$top_padding."px ; padding-bottom:".$bottom_padding."px }\n";
            }
            $i++;
        }

        if ($padding_css > ""){
            echo "<style scoped>";
            echo wp_kses_post($padding_css);  // PADDING CSS
            echo "</style>";
        }


        $loop->rewind_posts();

        echo '<div id="main-flex-slider" class="flexslider"><ul class="slides">';
		$i = 0;
		$js_transparent_header_adjust = "";

		while ($loop->have_posts()) {

			$loop->the_post();
			$postID_inner = get_the_ID();

			$js_transparent_header_adjust .= "themo_adjust_padding_transparent_header('#main-flex-slider .themo_slider_$i'); ";
			$element = get_post_meta($postID_inner);

			$show_tooltip = false;
			$tooltip = false;
			$show_title = true;


			if(isset($element["_hide_title"][0]) && $element["_hide_title"][0] == 1) {
				$show_title = false;
			}

			// Tool Tip
			if(isset($element["_show_tooltip"][0]) && $element["_show_tooltip"][0] == 1){
				if(isset($element["_tooltip_text"][0]) && $element["_tooltip_text"][0] > ''){
					$show_tooltip = true;
					$tooltip = $element["_tooltip_text"][0];
				}
			}

			// Narrow Format
			$narrow_format = false;
			$narrow_format_open = '';
			$narrow_format_close = '';
			if(isset($element["_align_content"][0]) && $element["_align_content"][0] == 1) {
				$narrow_format = true;
				$narrow_format_open = '<div class="slider-content col-sm-6">';
				$narrow_format_close = '</div>';
			}

			// Booked Cal Alignment
			$content_align = false;
			if(isset($element["_content_align"][0]) && $element["_content_align"][0] > '') {
				$content_align = $element["_content_align"][0].' ';
			}

			// Formidable Border Option
			$form_border = false;
			if(isset($element["_form_border"][0]) && $element["_form_border"][0] > '') {
				if($element["_form_border"][0] != 'none'){
					$form_border = $element["_form_border"][0].' ';
				}
			}

			/*
			 * Slider Background Output.
			 * Includes: Color, background-repeat, background-attachment, background-postition, background-size, background-image
			 * Parameter #1 = background array from OptionTree that contains all values above
			 * Parameter #2 = CSS Identifier, can be a class or ID
			 * Function outputs CSS inside of an internal style sheet.
			 */
			$slider_bg_css = "";
			$text_contrast =  $element['__text_contrast'][0];

			if($text_contrast == 'light'){ // Add Text White Class
				$text_contrast_class = "light-text";
			}else{
				$text_contrast_class = "";
			}

			// Add large styling class if selected.
			$large_style_class = "";

			if (isset($element['_large_styling'][0]) && $element['_large_styling'][0] == 1){
				$large_style_class = "lrg-txt ";
			}

			$background_show = $element['__show_background'][0];
			$background = array();
			$background['background-image'] = isset($element['__background_image'][0]) ? $element['__background_image'][0] : '';
			$background['background-color'] = isset($element['__background_color'][0]) ? $element['__background_color'][0] : '';
			$background['background-repeat'] = isset($element['__background_repeat'][0]) ? $element['__background_repeat'][0] : '';
			$background['background-position'] = isset($element['__background_position'][0]) ? $element['__background_position'][0] : '';
			$background['background-attachment'] = isset($element['__background_attachment'][0]) ? $element['__background_attachment'][0] : '';
			$background['background-size'] = isset($element['__background_size'][0]) ? $element['__background_size'][0] : '';

			if($background_show == 1){
				// Return b/g image. If it's full width use backstretch for mobile / touch screens.
				list($background_settings,$is_full_width,$background_image_filtered) = themo_custom_background($background,".slider-bg");

				$slider_bg_css = $background_settings;

			}
			/* END Slider Background Output. */



			echo '<li>';
			echo '<div class="slider-bg ', $content_align, $form_border, $text_contrast_class,' ', $key,'_',$i,'" ', $slider_bg_css,'>';
			echo wp_kses_post($inner_container_open);
			echo '<div class="row ', $large_style_class,'">';
			echo wp_kses_post($narrow_format_open);

				/*
				 * Slider Title, Subtitle and button
				*/
				if(get_the_title()>"" && $show_title){
					echo '<h1 class="slider-title', themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#main-flex-slider .slider-title'), '">', get_the_title(), '</h1>';
				}
				if($post->post_content != "") {
					echo '<div class="slider-subtitle ', themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#main-flex-slider .slider-subtitle'),'">', themo_content($post->post_content), '</div>';
				} // Subtitle

				// Check for link target
				$button_link_target = '';
				if(isset($element['__button_link_target'][0]) && $element['__button_link_target'][0] > ""){
						$button_link_target = "target='".$element['__button_link_target'][0]."'";
				}

                // Button
                $button = false;
                $button2 = false;
                $page_header_button = false;

                $button = themo_do_shortocde_button($postID_inner, '_', true);
                $button2 = themo_do_shortocde_button($postID_inner, '_', true,false,2);
                if ($button > "" || $button2 > "") {
                    $page_header_button = "<div class='page-title-button ".themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#main-flex-slider .page-title-button')."'>".do_shortcode($button).do_shortcode($button2)."</div>";
                    echo wp_kses_post($page_header_button);
                }


				/* END Slider Title, Subtitle and button */

				/*
				 * Slider Image
				 */

				// Get Formatted Link
				list($a_href,$a_href_text,$a_href_close) = themo_return_formatted_link($postID_inner,'_');

				if ( has_post_thumbnail() ) {
					$featured_img_attr = array('class'	=> "hero");
					$slider_image = wp_kses_post($a_href) . get_the_post_thumbnail($postID_inner,'themo_full_width',$featured_img_attr) . wp_kses_post($a_href_close);
					echo '<div class="page-title-image ', themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#main-flex-slider .page-title-image'),'">',$slider_image,'</div>';
				}

				/*
				 * Slider Conversion Form Shortcode.
				 * Uses Global if enabled, else uses individual.
				 */
				if($slider_shortcode_status == 1 && $slider_shortcode > "") {
					if (strpos($slider_shortcode, 'booked-calendar') !== FALSE){
						$themo_flex_smoothheight = 'false';
					}
					themo_do_metabox_shortcode($slider_shortcode,'',$themo_enable_animate,$themo_animation_style,$show_tooltip,$tooltip);
				}elseif(isset($element['_form_shortcode'][0]) && $element['_form_shortcode'][0] > ''){
					if (strpos($element['_form_shortcode'][0], 'booked-calendar') !== FALSE){
						$themo_flex_smoothheight = 'false';
					}
					themo_do_metabox_shortcode($element['_form_shortcode'][0],'',$themo_enable_animate,$themo_animation_style,$show_tooltip,$tooltip);
				}
				/* END Slider Conversion Form */

			echo wp_kses_post($narrow_format_close);
			echo '</div><!-- /.row -->';
			echo wp_kses_post($inner_container_close);
			echo '</div><!-- /.slider-bg -->';
			echo '</li>';
			$i++;
		}
		echo '</ul>';
		echo wp_kses_post($down_arrow_markup);
		echo '</div><!-- /.main-flex-slider -->';
		echo wp_kses_post($anchor_markup_close);



		// Flex slider Options
		$themo_flex_settings = "'$themo_flex_animation', '$themo_flex_easing',
							$themo_flex_animationloop, $themo_flex_smoothheight, $themo_flex_slideshowspeed, $themo_flex_animationspeed,
							$themo_flex_randomize, $themo_flex_pauseonhover, $themo_flex_touch, $themo_flex_directionnav, $themo_flex_controlNav";
		?>
		<script>
			jQuery(window).load(function() {
				<?php echo sanitize_text_field($js_transparent_header_adjust); ?>
				themo_start_flex_slider('#main-flex-slider',<?php echo sanitize_text_field($themo_flex_settings); ?>);
			});
		</script>
	<?php
	}else {
		// no posts found
	}
	// Restore original Post Data
	wp_reset_postdata();

}
	elseif($show_shortcode == 1) { // Use Other Slider via Shortocde
		include( locate_template( 'templates/meta-slider-shortcode.php' ) );
	}
}
