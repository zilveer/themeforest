<?php
/*
 * template-services.php
 *
 * This file supports the template-services.php template
 * by creating the metabox fields necessary to render
 * the admin panel options
 *
 */
function services_page_meta_boxes($meta_boxes) {
  // homepage template options
  $services_metabox = new T2T_MetaBox(array(
      "id"            => "template-services",
      "post_type"     => "page",
      "title"         => __("Services Template Options", "t2t"),
      "location"      => "normal",
      "priority"      => "low",
  ));

  // use the same options the shortcode uses
  $service_list_sc = new T2T_Shortcode_Service_List();
  foreach($service_list_sc->get_attributes() as $att) {
    $services_metabox->add_field($att);
  }

  array_push($meta_boxes, $services_metabox);

  return $meta_boxes;
}
add_filter("t2t_page_meta_boxes", "services_page_meta_boxes");
?>