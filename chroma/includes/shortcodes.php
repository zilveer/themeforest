<?php
/*
 * Testimonial Shortcodes
 */
function testimonial_markup_wrapper($output, $options) {
	$title = get_post_meta(get_the_ID(), "testimonials_title", true);

	$shortcode = new T2T_Shortcode_Section_Title();
	$wrapper = $shortcode->handle_shortcode(array(
		"style" => "strikethrough"
	), $title);

	if(isset($options["post_count"]) && $options["post_count"] > 0) {
		$output = "<div class=\"testimonials\">" . $output . "</div>";
	}

	return $wrapper . $output;

}
add_filter("t2t_shortcode_testimonial_wrapper", "testimonial_markup_wrapper", null, 2);


/*
 * Service Shortcodes
 */
function service_list_markup($output, $options, $content) {
	// throw an exception if post_id is not provided
	if(!isset($options["post_id"])) {
		throw new InvalidArgumentException(__("A post_id is required to render a service.", "framework"));
	}

	// retrieve the post
	$post = get_post($options["post_id"]);

	// override output completely rather than appending to it
  $output = "";

	$rand_id = mt_rand(99, 999);

	// retrieve the external_url provided by the user
	$external_url = T2T_Toolkit::get_post_meta($options["post_id"], "service_external_url", true, get_permalink($options["post_id"]));

	// if an external_url was provided, set the link to open in a new window
	if(get_permalink($options["post_id"]) != $external_url) {
		$target = "_blank";
	} else {
		$target = "_self";      
	}

	$icon_style = array(
		"color" => $options["icon_color"]
	);

	// generate the markup
	$icon = "<a href=\"" . $external_url . "\" target=\"" . $target . "\" class=\"service_icon\">";
	$icon .= "	" . T2T_Toolkit::display_icon(get_post_meta($options["post_id"], 'service_icon', true));
	$icon .= "</a>";

	// generate the markup
  $image = wp_get_attachment_image_src(get_post_thumbnail_id($options["post_id"]), "medium");

  // if an image was provided
  if(isset($image) && $image != "") {
    $the_image = "<img src=\"$image[0]\" class=\"callout_box_image service_image\">";
  } else {
  	$the_image = "";
    array_push($options["classes"], "no_image");
  }

	$output .= "<div id=\"service_". $rand_id ."\" class=\"article " . join(" ", $options["classes"]) . "\">";    
	if($options["layout_style"] != "simple") {
		if(isset($image) && $image != "") {
			$output .= $the_image;
		} else {
			$output .= $icon;
		}
	}

	$output .= "	<div class=\"service_content\"><h5>";
	if($options["layout_style"] == "simple") {
		if(isset($image) && $image != "") {
			$output .= $the_image;
		} else {
			$output .= $icon;
		}
	}

	$output .= "  	<a href=\"" . $external_url . "\" target=\"" . $target . "\" class=\"service_title\">" . $post->post_title . "</a>";
	$output .= "  	</h5><p>" . T2T_Toolkit::truncate_string(strip_tags($post->post_content), $options["description_length"]) . "</p>";
	$output .= "  </div>";
	$output .= "</div>";

	$output .= "<style type=\"text/css\">";
	$output .= "#service_". $rand_id ." a.service_icon {";
	$output .= "	color: ". $options["icon_color"] ." !important;";
	$output .= "	font-size: ". $options["icon_size"] ."px;";
	$output .= "	line-height: ". $options["icon_size"] ."px;";
	$output .= "}";
	$output .= "#service_". $rand_id ." a.service_title {";
	$output .= "	color: ". $options["title_color"] ." !important;";
	$output .= "}";
	$output .= "#service_". $rand_id ." a.service_title:hover {";
	$output .= "	color: ". $options["title_hover_color"] ." !important;";
	$output .= "}";
	$output .= "#service_". $rand_id ." .service_content p {";
	$output .= "	color: ". $options["description_color"] ." !important;";
	$output .= "}";
	$output .= "</style>";

	return $output;
}
add_filter("t2t_shortcode_service_list_output", "service_list_markup", null, 3);

function service_list_wrapper($output, $options) {
	$title = get_post_meta(get_the_ID(), "services_title", true);

	$shortcode = new T2T_Shortcode_Section_Title();
	$wrapper = $shortcode->handle_shortcode(array(
		"style" => "strikethrough"
	), $title);

	if(isset($options["post_count"]) && $options["post_count"] > 0) {
		$output = "<div class=\"services ". $options["layout_style"] ."\">" . $output . "<div class=\"clear\"></div></div>";
	}

	return $wrapper . $output;
}
add_filter("t2t_shortcode_service_list_wrapper", "service_list_wrapper", null, 2);

function service_list_empty_author_markup($markup) {
	$markup .= get_empty_author_markup("T2T_Service", "http://docs.t2themes.com/chroma/#services");

	return $markup;
}
add_filter("t2t_shortcode_service_list_empty_author_output", "service_list_empty_author_markup");


/*
 * Album List Shortcodes
 */
function album_list_markup($output, $options, $content) {
	// throw an exception if post_id is not provided
	if(!isset($options["post_id"])) {
		throw new InvalidArgumentException(__("A post_id is required to render a album.", "framework"));
	}
 
	// retrieve the post
	$post = get_post($options["post_id"]);

	// override output completely rather than appending to it
	$output = "";
  
	// retrieve the featured image for this album
	$image = wp_get_attachment_image_src(get_post_thumbnail_id($options["post_id"]), 'medium');
 
	// if not featured image is present
	if(empty($image)) {        
	  // make sure there are images int he album
	  if(sizeof($options["image_ids"]) > 0) {
	    // retrieve a random image from the album
	    $random_key = array_rand($options["image_ids"], 1);
	    $image = wp_get_attachment_image_src($options["image_ids"][$random_key], 'medium');          
	  }
	}

	// if the user has selected to display the filters
	if(filter_var($options["show_category_filter"], FILTER_VALIDATE_BOOLEAN)) {
		// gather the categories
		$terms = wp_get_post_terms($options["post_id"], strtolower(T2T_Album::get_name()) . "_categories");

		if(!empty($terms)) {
			// pull out just the slug
			$slugs = wp_list_pluck($terms, "slug");

			foreach($slugs as $slug) {
				// append the appropriate class to the classes array
				array_push($options["classes"], "term_" . $slug);
			}
		}
	}
 
	$output .= "<div class=\"element " . join(" ", $options["classes"]) . "\" data-album-id=\"album_" . $options["post_id"] . "\">";    
	$output .= "	<a href=\"" . get_permalink($options["post_id"]) . "\">";
	$output .= "	<img src=\"" . $image[0] ."\" />";
	$output .= "    <span class=\"hover\"><span class=\"icons\">";
	$output .= "      <span class=\"entypo-eye\"></span>";
	$output .= "		</span></span>";
	$output .= "	</a>";
	$output .= "	<div class=\"caption\">";
	$output .= "		<h5><a href=\"" . get_permalink($options["post_id"]) . "\" class=\"title\">" . $post->post_title . "</a></h5>";
	$output .= "		<p>" . T2T_Toolkit::truncate_string(strip_tags($post->post_content), $options["description_length"]) . "</p>";
	$output .= "	</div>";
	$output .= "</div>";
 
	return $output;
}
add_filter("t2t_shortcode_album_list_output", "album_list_markup", null, 3);
 
function album_list_markup_wrapper($output, $options) {
	$classes = array();

	if(isset($options["post_count"]) && $options["post_count"] > 0) {

		$album_div = mt_rand(99, 999);

		$before_output = "<div id=\"album_$album_div\" class=\"albums thumbnail_" . $options["thumbnail_hover_style"] . " full_width container\">\n";

		// if the user has selected to display the filters
		if(!isset($options["category"]) && filter_var($options["show_category_filter"], FILTER_VALIDATE_BOOLEAN)) {
			$terms = wp_get_object_terms(array_keys($options["all_image_ids"]), strtolower(T2T_Album::get_name()) . "_categories");

			if(!empty($terms)) {
				// remove duplicates
				$terms = array_unique($terms, SORT_REGULAR);

				$before_output .= "<ul class=\"filter_list\">\n";
				$before_output .= "<li><a href=\"javascript:;\" class=\"active\" data-filter=\"*\">". __('All', 'framework') ."</a><span class=\"separator\">/</span></li>";

				// create entry for each term
				foreach($terms as $term) {
	      	$before_output .= "<li><a href=\"javascript:;\" data-filter=\".term_" . $term->slug . "\">" . $term->name . "</a><span class=\"separator\">/</span></li>";
				}

				$before_output .= "</ul>\n";
				array_push($classes, 'with_filters');
			}
		} else {
			array_push($classes, "without_filters");
		}

		$output = $before_output . "<div class=\"filter_content ". join(' ', $classes) ."\">" . $output . "</div></div>";

		if($options['thumbnail_hover_style'] == "scroller") {
		  // if there are photos in this album
		  if(sizeof($options["all_image_ids"]) > 0) {
		  	$thumbnails = array();

				foreach($options["all_image_ids"] as $album_id => $images) {
					foreach ($images as $key => $image_id) {
						// retrieve the image
						$imageTemp = wp_get_attachment_image_src($image_id, "medium");

						// append this image id and path
						$thumbnails[$album_id][] = $imageTemp[0];		
					}
			  }

				$output .= "<script type=\"text/javascript\" charset=\"utf-8\">\n";
				$output .= "  jQuery(document).ready(function($) {\n";
				$output .= "    $('#album_". $album_div ."').each(function() {";
				$output .= "  		var json = [" . json_encode($thumbnails) . "];\n";
				$output .= "			$(this).Scrubnails({ images: json });\n";
				$output .= "		})";
				$output .= "  });\n";
				$output .= "</script>\n";
		  }
		}
	}

	return $output;
}
add_filter("t2t_shortcode_album_list_wrapper", "album_list_markup_wrapper", null, 2);

function album_list_shortcode_fields($fields) {
	array_push($fields, new T2T_SelectHelper(array(
    "id"          => "thumbnail_hover_style",
    "name"        => "thumbnail_hover_style",
    "label"       => __("Thumbnail Hover Style", "framework"),
    "description" => sprintf(__('Choose the hover style you\'d like to use for the %1$s thumbnails.', 't2t'), strtolower(T2T_Album::get_title())),
    "options"     => array(
      "default"            => __("Default", "framework"), 
      "caption_overlay"    => __("Caption Overlay", "framework"),
      "scroller"           => __("Thumbnail Scroller", "framework"),
      "zoom"               => __("Zoom", "framework")),
    "default"     => "default"
  )));

  $terms = get_terms(strtolower(T2T_Album::get_name()) . "_categories");

	$default_show_filters = true;

	// only show the filter if there are 2 or more, otherwise what would you be filtering?
	if(!empty($terms) && sizeof($terms) > 1 && !array_key_exists("errors", $terms)) {
		$default_show_filters = false;
	}

	array_push($fields, new T2T_SelectHelper(array(
		"id"          => "show_category_filter",
		"name"        => "show_category_filter",
		"label"       => __("Show Category Filter?", "framework"),
    "description" => sprintf(__('Whether or not to include a list of categories that will allow visitors to filter your %1$s.', 't2t'), strtolower(T2T_Toolkit::pluralize(T2T_Album::get_title()))),
		"options"     => array(
			"true"  => __("Yes", "framework"),
			"false" => __("No", "framework")
		),
		"default"     => $default_show_filters
	)));

  return $fields;
}
add_filter("t2t_shortcode_album_list_fields", "album_list_shortcode_fields");

function album_list_empty_author_markup($markup) {
	$markup .= get_empty_author_markup("T2T_Album", "http://docs.t2themes.com/chroma/#albums");

	return $markup;
}
add_filter("t2t_shortcode_album_list_empty_author_output", "album_list_empty_author_markup");


/*
 * Album Shortcodes
 */
function album_markup($output, $options, $content) {	
	// throw an exception if post_id is not provided
	if(!isset($options["post_id"])) {
		throw new InvalidArgumentException(__("A post_id is required to render a album."));
	}

  // details
  $large_image    = wp_get_attachment_image_src($options["post_id"], 'full');
  $icon      			= get_post_meta($options["album_id"], 'icon', true);
  $links_to_show  = T2T_Toolkit::get_post_meta($options["album_id"], 'links_to_show', true, null);

  // make sure the image is valid
  if(empty($large_image)) {
  	return;
  }

  // initialize html attributes for the album
  $styles                  = array();
  $full_width_column_width = get_theme_mod("t2t_customizer_full_width_column_width", 280);

  $post = get_post($options["post_id"]);

  if($options["album_layout_style"] == "grid") {
	  $image_file = wp_get_attachment_image($options["post_id"], 'medium');
	  if($options["posts_per_row"] == 1) {
	  	$image_file = wp_get_attachment_image($options["post_id"], 'full');
	  }
  }
  elseif(in_array($options['album_layout_style'], array("grid_full", "masonry", "masonry_full"))) {
  	if(isset($options["masonry_style"]) && $options["masonry_style"] == "forced") {
		  $image_file = wp_get_attachment_image($options["post_id"], 'masonry-thumb');
  	}
  	else {
  		// defaults to natural masonry
		  $image_file = wp_get_attachment_image($options["post_id"], 'masonry-thumb-natural');
  	}

  	// classes use to crop the images using css
  	if($options["album_layout_style"] == "grid_full" || 
  			$options["album_layout_style"] == "masonry_full" || 
  			($options['album_layout_style'] == "masonry" && isset($options["masonry_style"]) && $options["masonry_style"] == "forced" )) {
			// required classes
			array_push($options["classes"], "imgLiquidFill");
			array_push($options["classes"], "imgLiquid");
		}

  	// grid full crops square images, make the height the same as the width
    if($options['album_layout_style'] == "grid_full") {
    	array_push($styles, "height: " . $full_width_column_width . "px;");
    }  

    // both 'full' options need a specified width
  	if(in_array($options['album_layout_style'], array("grid_full", "masonry_full"))) {
  		array_push($styles, "width: " . $full_width_column_width . "px;");

  		if($options["album_layout_style"] == "masonry_full") {
			  $image_data = wp_get_attachment_image_src($options["post_id"], 'masonry-thumb-natural');

			  // calculate the image size
			  $aspect_ratio = ($image_data[2] / $image_data[1]);

			  // assign the height of the image
	      array_push($styles, "height: ". round($aspect_ratio * $full_width_column_width) ."px;");			  
  		}
  	}

  	if(in_array($options['album_layout_style'], array("masonry", "masonry_full"))) {
    	if(isset($options["masonry_style"]) && $options["masonry_style"] == "forced") {	

    	  // determine random height of this image
    	  if($options["posts_per_row"] <= 2) {
    		  $height_options = range(260, 560, 30);
    	  }
    	  elseif($options["posts_per_row"] == 3) {
    		  $height_options = range(230, 500, 30);
    	  }
    	  else {
    		  $height_options = range(200, 380, 30);
    	  }

    	  $random_index   = array_rand($height_options, 1);
    	  $height         = $height_options[$random_index];

				// assign the randomly selected height	    
	      array_push($styles, "height: ". $height ."px;");
    	}
    }     
  } 

  if($icon == "") {
  	$icon = "typicons-eye";
  } else {
  	$icon = $icon;
  }

  $disable_social = get_theme_mod("t2t_disable_social_sharing", false);
  if($disable_social === true) {
  	$disable_social = "true";
  }
  else {
  	$disable_social = "false";
  }

  $title = "";
  if($post->post_excerpt != "") {
  	$title .= "<h3>". $post->post_excerpt ."</h3>";
  }
  if($post->post_content != "") {
  	$title .= "<p>". $post->post_content ."</p>";
  }

  // override output completely rather than appending to it
  $output = "";

  $output .= "<div class=\"wall_entry " . join(" ", $options["classes"]) . "\" style=\"" . join(" ", $styles) . "\">";
  $output .= "       ". $image_file;
  $output .= "       <span class=\"hover\"><span class=\"icons\">";

  if(!isset($links_to_show) || (isset($links_to_show) && ($links_to_show == "both" || $links_to_show == "fancybox"))) {
  	$output .= "       	<a href=\"" . $large_image[0] . "\" class=\"entypo-search fancybox\" rel=\"album_". $options["album_id"] ."\"></a>";
  }

  if(!isset($links_to_show) || (isset($links_to_show) && ($links_to_show == "both" || $links_to_show == "individual"))) {
    $output .= "       	<a href=\"". get_attachment_link($options["post_id"]) ."\" class=\"entypo-link\"></a>";  	
  }

  $output .= "			 </span></span>";
  $output .= "</div>";
 
	return $output;
}
add_filter("t2t_shortcode_album_output", "album_markup", null, 3);
 
function album_markup_wrapper($output, $options) {
	if(isset($options["album_layout_style"])) {
		$album = "<div class=\"album " . $options["album_layout_style"]."\">" . $output . "</div>";

		if($options["album_layout_style"] == "masonry_full" || $options["album_layout_style"] == "grid_full") {
			return "</section>$album<section>";
		} else {
			return "<div class=\"page_content\">$album<div class=\"clear\"></div></div>";
		}
	}
	else {
		return $output;
	}
}
add_filter("t2t_shortcode_album_wrapper", "album_markup_wrapper", null, 2);


/*
 * Slit Slider Shortcodes
 */
function slit_slider_markup($output, $options, $content) {
	$slider_id = mt_rand(99, 999);

	$show_title         = get_post_meta($options["post_id"], 'show_title', true);
	$alignment          = get_post_meta($options["post_id"], 'alignment', true);
	$orientation        = get_post_meta($options["post_id"], 'orientation', true);
	$slice1_rotation    = get_post_meta($options["post_id"], 'slice_1_rotation', true);
	$slice1_scale       = get_post_meta($options["post_id"], 'slice_1_scale', true);
	$slice2_rotation    = get_post_meta($options["post_id"], 'slice_2_rotation', true);
	$slice2_scale       = get_post_meta($options["post_id"], 'slice_2_scale', true);
	$title_color        = get_post_meta($options["post_id"], 'title_color', true);
	$caption_color      = get_post_meta($options["post_id"], 'caption_color', true);
	$post_id            = get_post_meta($options["post_id"], 'button_post_id', true);
	$button_text        = get_post_meta($options["post_id"], 'button_text', true);
	$button_color       = get_post_meta($options["post_id"], 'button_color', true);
	$button_text_color  = get_post_meta($options["post_id"], 'button_text_color', true);
	$image              = wp_get_attachment_image_src(get_post_thumbnail_id(), "full");

  // override output completely rather than appending to it
  $html = "";

	$html .= "<div id=\"slit-slider-$slider_id\" class=\"sl-slide\" data-orientation=\"" . $orientation . "\" data-slice1-rotation=\"" . $slice1_rotation . "\" data-slice2-rotation=\"" . $slice2_rotation . "\" data-slice1-scale=\"" . $slice1_scale . "\" data-slice2-scale=\"" . $slice2_scale . "\">";
	$html .= "	<div class=\"sl-slide-inner\">";
	$html .= "		<div class=\"bg-img\" data-background=\"" . $image[0] . "\"></div>";
	$html .= "		<div class=\"slide-content\">";

	if(filter_var($show_title, FILTER_VALIDATE_BOOLEAN)) {
		$html .= "			<span class=\"title\">" . get_the_title() . "</span>";
	}

	$html .= "      <span class=\"caption\">" . get_the_content() . "</span>";            
	$html .= "			" . get_slider_button_markup($post_id, $button_text);
	$html .= "		</div>";
	$html .= "	</div>";
	$html .= "</div>";

	$html .= "<style type=\"text/css\">";
	$html .= "#slit-slider-" . $slider_id." .title {";
	if(isset($title_color) && $title_color != "") { $html .= "  color: " . $title_color." !important;"; }
	if(isset($alignment) && $alignment != "") { $html .= "  text-align: " . $alignment." !important;"; }
	$html .= "}";
	$html .= "#slit-slider-" . $slider_id." .caption {";
	if(isset($caption_color) && $caption_color != "") { $html .= "  color: " . $caption_color." !important;"; }
	if(isset($alignment) && $alignment != "") { $html .= "  text-align: " . $alignment." !important;"; }
	$html .= "}";
	$html .= "#slit-slider-" . $slider_id . " .link {";
	if(isset($button_color) && $button_color != "") { $html .= "  background: " . $button_color . " !important;"; }
	if(isset($button_text_color) && $button_text_color != "") { $html .= "  color: " . $button_text_color . " !important;"; }
	if(isset($alignment) && $alignment != "") { $html .= "  float: " . $alignment . " !important;"; }
	$html .= "}";
	$html .= "</style>";

	return $html;
}
add_filter("t2t_shortcode_slitslider_output", "slit_slider_markup", null, 3);

function slitslider_markup_wrapper($output, $options) {
	// if full width was selected we need to break the container
	if($options["width"] == "full" && $options["post_count"] > 0) {
		return break_page_container($output, $options);
	}
	else {
		return $output;
	}
}
add_filter("t2t_shortcode_slitslider_wrapper", "slitslider_markup_wrapper", null, 2);

function slit_slider_empty_author_markup($markup) {
	$markup .= get_empty_author_markup("T2T_SlitSlider", "http://docs.t2themes.com/chroma/#slit-slider");

	return $markup;
}
add_filter("t2t_shortcode_slitslider_empty_author_output", "slit_slider_empty_author_markup");


/*
 * Elastic Slider Shortcodes
 */
function elasticslider_markup($output, $options, $content) {
	$slider_id = mt_rand(99, 999);

	$image = wp_get_attachment_image_src(get_post_thumbnail_id(), "full");

	$show_title         = get_post_meta($options["post_id"], 'show_title', true);
	$alignment          = get_post_meta($options["post_id"], 'alignment', true);
	$title_color        = get_post_meta($options["post_id"], 'title_color', true);
	$caption_color      = get_post_meta($options["post_id"], 'caption_color', true);
	$controls_color     = get_post_meta($options["post_id"], 'controls_color', true);
	$post_id            = get_post_meta($options["post_id"], 'button_post_id', true);
	$button_text        = get_post_meta($options["post_id"], 'button_text', true);
	$button_color       = get_post_meta($options["post_id"], 'button_color', true);
	$button_text_color  = get_post_meta($options["post_id"], 'button_text_color', true);

  // override output completely rather than appending to it
  $html = "";

	$html .= "<li id=\"elastic-slider-$slider_id\" class=\"controls-$controls_color\">";
	$html .= "	<img src=\"" . $image[0] . "\" alt=\"" . get_the_title() . "\">";
	$html .= "	<div class=\"slide-content\">";

	if(filter_var($show_title, FILTER_VALIDATE_BOOLEAN)) {
		$html .= "	  <span class=\"title\">" . get_the_title() . "</span>";
	}

	$html .= "	  <span class=\"caption\">" . get_the_content() . "</span>";
	$html .= "		" . get_slider_button_markup($post_id, $button_text);
	$html .= "	</div>";
	$html .= "</li>";

	$html .= "<style type=\"text/css\">";
	$html .= "#elastic-slider-" . $slider_id." .title {";
	if(isset($title_color) && $title_color != "") { $html .= "  color: " . $title_color." !important;"; }
	if(isset($alignment) && $alignment != "") { $html .= "  text-align: " . $alignment." !important;"; }
	$html .= "}";
	$html .= "#elastic-slider-" . $slider_id." .caption {";
	if(isset($caption_color) && $caption_color != "") { $html .= "  color: " . $caption_color." !important;"; }
	if(isset($alignment) && $alignment != "") { $html .= "  text-align: " . $alignment." !important;"; }
	$html .= "}";
	$html .= "#elastic-slider-" . $slider_id . " .link {";
	if(isset($button_color) && $button_color != "") { $html .= "  background: " . $button_color . " !important;"; }
	if(isset($button_text_color) && $button_text_color != "") { $html .= "  color: " . $button_text_color . " !important;"; }
	if(isset($alignment) && $alignment != "") { $html .= "  float: " . $alignment . " !important;"; }
	$html .= "}";
	$html .= "</style>";

	return $html;
}
add_filter("t2t_shortcode_elasticslider_output", "elasticslider_markup", null, 3);

function elasticslider_markup_wrapper($output, $options) {
	// if full width was selected we need to break the container
	if($options["width"] == "full" && $options["post_count"] > 0) {
		return break_page_container($output, $options);
	}
	else {
		return $output;
	}
}
add_filter("t2t_shortcode_elasticslider_wrapper", "elasticslider_markup_wrapper", null, 2);

function elastic_slider_empty_author_markup($markup) {
	$markup .= get_empty_author_markup("T2T_ElasticSlider", "http://docs.t2themes.com/chroma/#elastic-slider");

	return $markup;
}
add_filter("t2t_shortcode_elasticslider_empty_author_output", "elastic_slider_empty_author_markup");


/*
 * Flex Slider Shortcodes
 */
function flexslider_markup_output($output, $options) {

	$slider_id = mt_rand(99, 999);

  // retrieve the post
  $post = get_post($options["post_id"]);

	$image           = wp_get_attachment_image(get_post_thumbnail_id(), "full");
	$image_src       = wp_get_attachment_image_src(get_post_thumbnail_id(), "full");

	$show_title         = get_post_meta($options["post_id"], 'show_title', true);
	$alignment          = get_post_meta($options["post_id"], 'alignment', true);
	$title_color        = get_post_meta($options["post_id"], 'title_color', true);
	$caption_color      = get_post_meta($options["post_id"], 'caption_color', true);
	$controls_color     = get_post_meta($options["post_id"], 'controls_color', true);
	$post_id            = get_post_meta($options["post_id"], 'button_post_id', true);
	$button_text        = get_post_meta($options["post_id"], 'button_text', true);
	$button_color       = get_post_meta($options["post_id"], 'button_color', true);
	$button_text_color  = get_post_meta($options["post_id"], 'button_text_color', true);

	if(isset($options["height"]) && $options["height"] != "") {
		$height = $options["height"];
	} else {
		$height = $image_src[2];
	}

	$output  = "<li class=\"flexslider-$slider_id\" data-image=\"". $image_src[0] ."\" style=\"height: ". $height ."px;\">";
	$output .= "<div class=\"slide-content\">";
	if(filter_var($show_title, FILTER_VALIDATE_BOOLEAN)) {
		$output .= "	<span class=\"title\">" . get_the_title() . "</span>";
	}
	$output .= "	<span class=\"caption\">" . get_the_content() . "</span>";
	$output .= "	" . get_slider_button_markup($post_id, $button_text);
	$output .= "</div>";
	$output .= "</li>";

	$output .= "<style type=\"text/css\">";
	$output .= ".flexslider-" . $slider_id." .title {";
	if(isset($title_color) && $title_color != "") { $output .= "  color: " . $title_color." !important;"; }
	if(isset($alignment) && $alignment != "") { $output .= "  text-align: " . $alignment." !important;"; }
	$output .= "}";
	$output .= ".flexslider-" . $slider_id." .caption {";
	if(isset($caption_color) && $caption_color != "") { $output .= "  color: " . $caption_color." !important;"; }
	if(isset($alignment) && $alignment != "") { $output .= "  text-align: " . $alignment." !important;"; }
	$output .= "}";
	$output .= ".flexslider-" . $slider_id . " .link {";
	if(isset($button_color) && $button_color != "") { $output .= "  background: " . $button_color . " !important;"; }
	if(isset($button_text_color) && $button_text_color != "") { $output .= "  color: " . $button_text_color . " !important;"; }
	if(isset($alignment) && $alignment != "") { $output .= "  float: " . $alignment . " !important;"; }
	$output .= "}";
	$output .= "</style>";

  return $output;

}
add_filter("t2t_shortcode_flexslider_output", "flexslider_markup_output", null, 2);

function flexslider_markup_wrapper($output, $options) {
	// if full width was selected we need to break the container
	if($options["width"] == "full" && $options["post_count"] > 0) {
		return break_page_container($output, $options);
	}
	else {
		return $output;
	}
}
add_filter("t2t_shortcode_flexslider_wrapper", "flexslider_markup_wrapper", null, 2);


/*
 * Portfolio Shortcodes
 */
function portfolio_shortcode_fields($fields) {
  $terms = get_terms(strtolower(T2T_Portfolio::get_name()) . "_categories");

	$default_show_filters = true;

	// only show the filter if there are 2 or more, otherwise what would you be filtering?
	if(!empty($terms) && sizeof($terms) > 1 && !array_key_exists("errors", $terms)) {
		$default_show_filters = false;
	}

	array_push($fields, new T2T_SelectHelper(array(
		"id"          => "show_category_filter",
		"name"        => "show_category_filter",
		"label"       => __("Show Category Filter?", "framework"),
    "description" => sprintf(__('Whether or not to include a list of categories that will allow visitors to filter your %1$s.', 't2t'), strtolower(T2T_Toolkit::pluralize(T2T_Portfolio::get_title()))),
		"options"     => array(
			"true"  => __("Yes", "framework"),
			"false" => __("No", "framework")
		),
		"default"     => $default_show_filters
	)));

  return $fields;
}
add_filter("t2t_shortcode_portfolio_fields", "portfolio_shortcode_fields");

function shortcode_portfolio_output($output, $options) {

    // retrieve the post
    $post = get_post($options["post_id"]);

		// retrieve the featured image for this portfolio
		$image = wp_get_attachment_image_src(get_post_thumbnail_id($options["post_id"]), 'medium');
	 
    // retrieve the external_url provided by the user
    $portfolio_url = T2T_Toolkit::get_post_meta($options["post_id"], 'external_url', true, get_permalink($options["post_id"]));

    // if an external_url was provided, set the link to open in a new window
    if(get_permalink($options["post_id"]) != $portfolio_url) {
      $target = "_blank";
    } else {
      $target = "_self";      
    }

    $post_format = get_post_format($options["post_id"]);

		// if the user has selected to display the filters
		if(filter_var($options["show_category_filter"], FILTER_VALIDATE_BOOLEAN)) {
			// gather the categories
			$terms = wp_get_post_terms($options["post_id"], strtolower(T2T_Portfolio::get_name()) . "_categories");

			if(!empty($terms)) {
				// pull out just the slug
				$slugs = wp_list_pluck($terms, "slug");

				foreach($slugs as $slug) {
					// append the appropriate class to the classes array
					array_push($options["classes"], "term_" . $slug);
				}
			}
		}

    // Render the thumbnail
    if(has_post_thumbnail($options["post_id"])) {
    	$thumbnail = "	  <a href=\"" . get_permalink($options["post_id"]) . "\">";
    	$thumbnail .= "			<img src=\"" . $image[0] ."\" />";
    	$thumbnail .= "		</a>";
    } else {
    	// Video player
    	if($post_format == "video") {
    		$thumbnail = "<div class=\"thumbnail_video_player\">";
				if(get_post_meta(get_the_ID(), "video_url", true) != "") {
	        global $wp_embed;
	        $thumbnail .= $wp_embed->run_shortcode("[embed]". get_post_meta(get_the_ID(), "video_url", true) ."[/embed]");
				} else {
					$thumbnail .= get_post_meta(get_the_ID(), "video_embed", true);
				}
				$thumbnail .= "</div>";
			// Audio player
    	} elseif($post_format == "audio") {
	  		$thumbnail = "<div class=\"audio_player\">";
				if(get_post_meta(get_the_ID(), "audio_url", true) != "") {
	        global $wp_embed;
	        $thumbnail .= $wp_embed->run_shortcode("[embed]". get_post_meta(get_the_ID(), "audio_url", true) ."[/embed]");
				} else {
					$thumbnail .= get_post_meta(get_the_ID(), "audio_embed", true);
				}
				$thumbnail .= "</div>";
    	} elseif($post_format == "gallery") {

	  		$thumbnail = "<div class=\"multi_image_thumbnail\">";
	  		$thumbnail .= "<div class=\"flexslider\" data-effect=\"". T2T_Toolkit::get_post_meta(get_the_ID(), "effect", true, "fade") ."\" data-autoplay=\"". T2T_Toolkit::get_post_meta(get_the_ID(), "autoplay", true, "true") ."\" data-interval=\"". T2T_Toolkit::get_post_meta(get_the_ID(), "interval", true, "5") ."\">";
	    	$thumbnail .= "	<ul class=\"slides\">";
  			// initialize options to send to t2t_get_gallery_images
  			$slider_options = array(
  			  "posts_to_show"  => -1,
  			  "posts_per_row"  => -1
  			);
  			
  			// gather the images
  			$images = T2T_Toolkit::get_gallery_images(get_the_ID(), $slider_options);

  			foreach($images as $index => $image_id) {
  			  $image = wp_get_attachment_image($image_id, "medium");
  			  $thumbnail .= "<li>$image</li>";
  			}

	    	$thumbnail .= "	</ul>";
	  		$thumbnail .= "</div>";
	  		$thumbnail .= "</div>";
    	}
    }

    // generate the markup
    $output  = "<div id=\"portfolio_". $options["post_id"] ."\" class=\"element " . join(" ", $options["classes"]) . "\">";    
    $output .= "  <div class=\"portfolio_content\">";
		if(isset($thumbnail) && $thumbnail != "") {
			$output .= 				$thumbnail;
		}
    $output .= "		<h5>";
    $output .= "    	<a href=\"" . $portfolio_url . "\" target=\"" . $target . "\" class=\"portfolio_title\">" . $post->post_title . "</a>";
    $output .= "    </h5><p>" . T2T_Toolkit::truncate_string(strip_tags($post->post_content), $options["description_length"]) . "</p>";
    $output .= "  </div>";
    $output .= "</div>";

    return $output;

}
add_filter("t2t_shortcode_portfolio_output", "shortcode_portfolio_output", null, 2);

function shortcode_portfolio_wrapper($output, $options) {
	$classes = array();

	if(isset($options["post_count"]) && $options["post_count"] > 0) {

		$before_output = "<div class=\"portfolio\">";

		// if the user has selected to display the filters
		if(!isset($options["category"]) && filter_var($options["show_category_filter"], FILTER_VALIDATE_BOOLEAN)) {
			// $terms = wp_get_object_terms(array_keys($options["all_image_ids"]), strtolower(T2T_Album::get_name()) . "_categories");
			$terms = get_terms(strtolower(T2T_Portfolio::get_name()) . "_categories");

			if(!empty($terms)) {
				// remove duplicates
				$terms = array_unique($terms, SORT_REGULAR);

				$before_output .= "<ul class=\"filter_list\">\n";
				$before_output .= "<li><a href=\"javascript:;\" class=\"active\" data-filter=\"*\">". __('All', 'framework') ."</a><span class=\"separator\">/</span></li>";

				// create entry for each term
				foreach($terms as $term) {
	      	$before_output .= "<li><a href=\"javascript:;\" data-filter=\".term_" . $term->slug . "\">" . $term->name . "</a><span class=\"separator\">/</span></li>";
				}

				$before_output .= "</ul>\n";
				array_push($classes, 'with_filters');
			}
		} else {
			array_push($classes, "without_filters");
		}

		$output = $before_output . "<div class=\"filter_content ". join(' ', $classes) ."\">" . $output . "</div></div>";
	}

	return $output;
}
add_filter("t2t_shortcode_portfolio_wrapper", "shortcode_portfolio_wrapper", null, 2);

function portfolio_empty_author_markup($markup) {
	$markup .= get_empty_author_markup("T2T_Portfolio", "http://docs.t2themes.com/chroma/#portfolio");

	return $markup;
}
add_filter("t2t_shortcode_portfolio_empty_author_output", "portfolio_empty_author_markup");


/*
 * Post Shortcodes
 */
function post_list_markup_wrapper($output, $options) {
	$title = get_post_meta(get_the_ID(), "posts_title", true);

	$shortcode = new T2T_Shortcode_Section_Title();
	$wrapper = $shortcode->handle_shortcode(array(
		"style" => "strikethrough"
	), $title);

	if(isset($options["post_count"]) && $options["post_count"] > 0) {
		$output = "<div class=\"post_list ". $options["layout"] ."\">" . $output . "</div>";
	}

	return $wrapper . $output;
}
add_filter("t2t_shortcode_post_list_wrapper", "post_list_markup_wrapper", null, 2);


/*
 * Callout banners
 */
function callout_banner_wrapper($output, $options) {
	return break_page_container($output, $options);
}
add_filter("t2t_shortcode_callout_banner_wrapper", "callout_banner_wrapper", null, 2);


/*
 * Page sections
 */
function page_section_wrapper($output, $options) {
	return break_page_container($output, $options);
}
add_filter("t2t_shortcode_page_section_wrapper", "page_section_wrapper", null, 2);


/**
 * break_page_container
 *
 * @since 1.0.0
 *
 * @param string $output Markup generated by the shortcode
 * @param array $options options selected by user for this shortcode
 *
 * @return HTML representing a break in the markup
 */
function break_page_container($output, $options) {
	// determine which page layout to continue after breaking
	$page_layout = get_post_meta(get_queried_object_id(), "layout", true);

	$wrapper  = "</div></section>";
	$wrapper .= $output;
	$wrapper .= "<section class=\"$page_layout container\"><div class=\"page_content\">";

	return $wrapper;
}

/**
 * get_slider_button_markup
 *
 * @since 1.1.0
 *
 * @param string $post_id Post to link the button to
 * @param string $button_text Text to appear on the button
 *
 * @return HTML representing a break in the markup
 */
function get_slider_button_markup($post_id, $button_text) {
	// can't do much without a link
	if($post_id > 0) {
		// get the permalink to the post provided
		$url = get_permalink($post_id);

		if($button_text == "") {
			// gather information for default button text
			$post_type        = get_post_type($post_id);
			$post_type_object = get_post_type_object($post_type);

			// make sure a post type was found
			if(isset($post_type_object)) {
				$button_text = sprintf(__('View %1$s', 't2t'), $post_type_object->labels->singular_name);
			}
			else {
				$button_text = __("View");
			}
		}

		// return the button markup
		return "<a href=\"" . $url . "\" class=\"link\">" . $button_text . "</a>";
	}
	else {
		return "";
	}
}

/**
 * get_empty_author_markup
 *
 * @since 1.2.0
 *
 * @param string $class_name Class name used to get post type link
 * @param string $help_url URL to help docs
 *
 * @return HTML representing a break in the markup
 */
function get_empty_author_markup($class_name, $help_url = "") {
	$post_type_obj = get_post_type_object(call_user_func(array($class_name, "get_name")));

	$markup  = "  <div class=\"author_instructions\">";
	$markup .= "    <p>" . sprintf(__('You have not created a %1$s yet, in order to display correctly you\'ll need at least 1 %2$s.', 't2t'), $post_type_obj->labels->singular_name, $post_type_obj->labels->singular_name) . "</p>";

	if($help_url !== "") {
		$shortcode = new T2T_Shortcode_Button();
		$markup .= $shortcode->handle_shortcode(array(
			"size"             => "medium",
			"background_color" => "#85ca75",
			"icon"             => "fontawesome-question-sign",
			"style"            => "three-dimensional",
			"target"           => "_blank",
			"url"              => $help_url
		), __("Get Help", "t2t"));

		$markup .= " ";
	}

	$shortcode = new T2T_Shortcode_Button();
	$markup .= $shortcode->handle_shortcode(array(
		"size"             => "medium",
		"background_color" => "#21759b",
		"icon"             => "fontawesome-plus-sign",
		"style"            => "three-dimensional",
		"target"           => "_blank",
		"url"              => get_bloginfo('url') . "/wp-admin/post-new.php?post_type=" . call_user_func(array($class_name, "get_name"))
	), sprintf(__('%1$s &rarr;', 't2t'), $post_type_obj->labels->add_new));

	$markup .= "  </div>";

	return $markup;
}
?>