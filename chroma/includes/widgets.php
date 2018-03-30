<?php
/*
 * Album Widgets
 */
function album_widget_output($current_markup, $instance) {
	$markup = array();

	array_push($markup, "<div class=\"gallery\">");

  // initialize options to send to t2t_get_gallery_images
  $options = array(
    "posts_to_show"  => $instance["posts_to_show"],
    "posts_per_row"  => $instance["posts_per_row"]
  );
  
  // gather the images
  $images = T2T_Toolkit::get_gallery_images($instance["album"], $options);
  
  // loop through each image returned
  foreach($images as $index => $image_id) {
    // collect the image information necessary
    $image_file  = wp_get_attachment_image($image_id, "thumbnail");
    $large_image = wp_get_attachment_image_src($image_id, "full");
    
    // initialize the class attribute for the image
    $classes = array("photo");
    
    array_push($classes, T2T_Toolkit::determine_loop_classes(sizeof($images), ($index + 1), $options));
    
	  if ($instance["display_method"] == "fancybox") {                
      array_push($markup,
        "<div class=\"" . join(" ", $classes) . "\">",
        "   <a href=\"" . $large_image[0] . "\" class=\"fancybox\" rel=\"album_widget_". $instance["album"] ."\">",
        "       ". $image_file,
        "       <div class=\"hover\"><span class=\"typcn typcn-eye\"></span></div>",
        "   </a>",
        "</div>"
      );
    }
    else {
      array_push($markup,        		
        "<div class=\"" . join(" ", $classes) . "\">",
        "   <a href=\"" . get_attachment_link($image_id) . "\">",
        "       ". $image_file,
        "       <div class=\"hover\"><span class=\"typcn typcn-eye\"></span></div>",
        "   </a>",
        "</div>"
      );
    }
  }
  
  array_push($markup, "<div class=\"clear\"></div>");
  array_push($markup, "</div>");

  return join("\n", $markup);
}
add_filter("t2t_widget_album_output", "album_widget_output", null, 2);
?>