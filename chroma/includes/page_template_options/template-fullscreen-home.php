<?php
/*
 * template-fullscreen-home.php
 *
 * This file supports the template-fullscreen-home.php template
 * by creating the metabox fields necessary to render
 * the admin panel options
 *
 */
function home_page_meta_boxes($meta_boxes) {
  // homepage template options
  $homepage_metabox = new T2T_MetaBox(array(
      "id"            => "template-fullscreen-home",
      "post_type"     => "page",
      "title"         => __("Home Template Options", "t2t"),
      "location"      => "normal",
      "priority"      => "low",
  ));

  $slider_field_group = new T2T_MetaBoxFieldGroup(array(
    "title" => __("Slider", "t2t")
  ));

  $slider_field_group->add_field(new T2T_SelectHelper(array(
    "id"          => "slider",
    "name"        => "slider",
    "label"       => __("Page Slider", "t2t"),
    "description" => __("Select which, if any, slider you'd like on this page", "t2t"),
    "options"     => array(
      "none"                        => "None",
      T2T_SlitSlider::get_name()    => T2T_SlitSlider::get_title(),
      T2T_ElasticSlider::get_name() => T2T_ElasticSlider::get_title(),
      T2T_FlexSlider::get_name()    => T2T_FlexSlider::get_title()
    ),
    "default"     => "none"
  )));

  $slider_field_group->add_field(new T2T_TextHelper(array(
    "id"          => "slider_height",
    "name"        => "slider_height",
    "label"       => __("Slider Height", "t2t"),
    "description" => __("Leave blank for full screen.", "t2t")
  )));

  $homepage_metabox->add_field_group($slider_field_group);

  /*
   * album fields
   */
  $album_field_group = new T2T_MetaBoxFieldGroup(array(
    "title" => sprintf(__('%1$s', 't2t'), T2T_Album::get_title())
  ));

  $album_field_group->add_field(new T2T_SelectHelper(array(
    "id"          => "show_album",
    "name"        => "show_album",
    "label"       => __("Enable Section", "t2t"),
    "description" => __("Select No to hide this section from the template.", "t2t"),
    "class"       => "enabled_field_group",
    "options" => array(
      "true"  => __("Yes", "t2t"),
      "false" => __("No", "t2t")
    ),
    "default"     => "true"
  )));

  // use the same options the shortcode uses
  $album_list_sc = new T2T_Shortcode_Album();
  foreach($album_list_sc->get_attributes("album") as $att) {
    if($att->id == "album_album_layout_style") {
      foreach($att->getOptions() as $option) {
        if(strpos($option->key, "_full") !== false) {
          $att->removeOption($option);
        }
      }
    }

    $album_field_group->add_field($att);
  }

  $homepage_metabox->add_field_group($album_field_group);

  array_push($meta_boxes, $homepage_metabox);

  /*
   * post fields
   */
  $post_field_group = new T2T_MetaBoxFieldGroup(array(
    "title" => sprintf(__('%1$s List', 't2t'), T2T_Post::get_title())
  ));

  $post_field_group->add_field(new T2T_SelectHelper(array(
    "id"          => "show_posts",
    "name"        => "show_posts",
    "label"       => __("Enable Section", "t2t"),
    "description" => __("Select No to hide this section from the template.", "t2t"),
    "class"       => "enabled_field_group",
    "options" => array(
      "true"  => __("Yes", "t2t"),
      "false" => __("No", "t2t")
    ),
    "default"     => "true"
  )));

  $post_field_group->add_field(new T2T_TextHelper(array(
    "id"          => "posts_title",
    "name"        => "posts_title",
    "label"       => __("Title", "t2t"),
    "description" => __("Leave blank to not display a title.", "t2t")
  )));

  // use the same options the shortcode uses
  $post_list_sc = new T2T_Shortcode_Post_List();
  foreach($post_list_sc->get_attributes("posts") as $att) {
    $post_field_group->add_field($att);
  }

  $homepage_metabox->add_field_group($post_field_group);

  /*
   * testimonial fields
   */
  $testimonial_field_group = new T2T_MetaBoxFieldGroup(array(
    "title" => sprintf(__('%1$s', 't2t'), T2T_Testimonial::get_title())
  ));

  $testimonial_field_group->add_field(new T2T_SelectHelper(array(
    "id"          => "show_testimonials",
    "name"        => "show_testimonials",
    "label"       => __("Enable Section", "t2t"),
    "description" => __("Select No to hide this section from the template.", "t2t"),
    "class"       => "enabled_field_group",
    "options" => array(
      "true"  => __("Yes", "t2t"),
      "false" => __("No", "t2t")
    ),
    "default"     => "true"
  )));
  $testimonial_field_group->add_field(new T2T_TextHelper(array(
    "id"          => "testimonials_title",
    "name"        => "testimonials_title",
    "label"       => __("Title", "t2t"),
    "description" => __("Leave blank to not display a title.", "t2t")
  )));

  // use the same options the shortcode uses
  $testimonial_list_sc = new T2T_Shortcode_Testimonial_List();
  foreach($testimonial_list_sc->get_attributes("testimonials") as $att) {
    $testimonial_field_group->add_field($att);
  }

  $homepage_metabox->add_field_group($testimonial_field_group);

  array_push($meta_boxes, $homepage_metabox);

  return $meta_boxes;
}
add_filter("t2t_page_meta_boxes", "home_page_meta_boxes");
?>