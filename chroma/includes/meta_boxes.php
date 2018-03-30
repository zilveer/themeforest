<?php
/*
 * SlitSlider MetaBox Fields
 */
function slitslider_meta_box_fields($fields) {
  $fields = array_merge($fields, get_slider_button_fields());

  return $fields;
}
add_filter("t2t_slitslider_core_meta_box_fields", "slitslider_meta_box_fields");

/*
 * ElasticSlider MetaBox Fields
 */
function elasticslider_meta_box_fields($fields) {
  $fields = array_merge($fields, get_slider_button_fields());

  return $fields;
}
add_filter("t2t_elasticslider_core_meta_box_fields", "elasticslider_meta_box_fields");

/*
 * Flexlider MetaBox Fields
 */
function flexslider_meta_box_fields($fields) {
  $fields = array_merge($fields, get_slider_button_fields());

  return $fields;
}
add_filter("t2t_flexslider_core_meta_box_fields", "flexslider_meta_box_fields");


/*
 * Album MetaBox Fields
 */
function album_meta_box_fields($fields) {
  $fields = array_merge($fields, array(
    new T2T_SelectHelper(array(
      "id"          => "links_to_show",
      "name"        => "links_to_show",
      "label"       => __("Links to show", "t2t"),
      "description" => sprintf(__('Which links to show for this %1$s.', 't2t'), strtolower(T2T_Album::get_title())),
      "options"     => array(
        "both"       => __("Both"),
        "fancybox"   => __("Fancybox Only"),
        "individual" => __("Individual Page Only")
      ),
      "default"     => "false"
    )),
    new T2T_SelectHelper(array(
      "id"          => "show_exif",
      "name"        => "show_exif",
      "label"       => __("Show Exif Data?", "t2t"),
      "description" => sprintf(__('Show the exif data for photos in this %1$s.', 't2t'), strtolower(T2T_Album::get_title())),
      "options"     => array(
        "true"  => __("True"),
        "false" => __("False")
      ),
      "default"     => "false"
    )),
    new T2T_SelectHelper(array(
      "id"          => "allow_download",
      "name"        => "allow_download",
      "label"       => __("Allow Download?", "t2t"),
      "description" => __("Allow these photos to be downloaded.", "t2t"),
      "options"     => array(
        "true"  => __("True"),
        "false" => __("False")
      ),
      "default"     => "false"
    ))
  ));

  return $fields;
}
add_filter("t2t_album_core_meta_box_fields", "album_meta_box_fields");


/**
 * get_slider_button_fields
 *
 * @since 1.1.0
 *
 * @return Array of fields
 */
function get_slider_button_fields() {
  $page_options = array();

  $post_types = array("page", "post");

  if(class_exists("T2T_Album")) {
    array_push($post_types, T2T_Album::get_name());
  }

  if(class_exists("T2T_Service")) {
    array_push($post_types, T2T_Service::get_name());
  }

  if(class_exists("T2T_Portfolio")) {
    array_push($post_types, T2T_Portfolio::get_name());
  }

  $pages = get_posts(array(
    "posts_per_page" => -1 , 
    "post_type"      => $post_types
  ));

  foreach($pages as $page) {
    $post_type = get_post_type_object($page->post_type);

    if(!isset($page_options[$post_type->label])) {
      $page_options[$post_type->label] = array();
    }

    $page_options[$post_type->label][$page->ID] = $page->post_title;
  }

  $fields = array(
    new T2T_SelectHelper(array(
      "id"          => "button_post_id",
      "name"        => "button_post_id",
      "label"       => __("Button Post", "t2t"),
      "description" => __("Choose a post you'd like to link to", "t2t"),
      "options"     => $page_options,
      "prompt"      => __("Select a Post")
    )),
    new T2T_TextHelper(array(
      "id"          => "button_text",
      "name"        => "button_text",
      "label"       => __("Button Text", "t2t"),
      "description" => __("Text to display on the button. <b>Default: </b> \"View _PostType_\"", "t2t")
    )),
    new T2T_TextHelper(array(
      "id"          => "button_color",
      "name"        => "button_color",
      "label"       => __("Button Color", "t2t"),
      "description" => __("Background color of the button", "t2t"),
      "class"       => "t2t-color-picker",
      "default"     => get_theme_mod("t2t_customizer_accent_color")
    )),
    new T2T_TextHelper(array(
      "id"          => "button_text_color",
      "name"        => "button_text_color",
      "label"       => __("Button Text Color", "t2t"),
      "description" => __("Text color of the button", "t2t"),
      "class"       => "t2t-color-picker",
      "default"     => "#ffffff"
    ))
  );

  // reset to main query
  wp_reset_postdata();

  return $fields;
}
?>