<?php
/*
 * template-albums.php
 *
 * This file supports the template-albums.php template
 * by creating the metabox fields necessary to render
 * the admin panel options
 *
 */
function albums_page_meta_boxes($meta_boxes) {
  // homepage template options
  $albums_metabox = new T2T_MetaBox(array(
      "id"            => "template-albums",
      "post_type"     => "page",
      "title"         => __("Albums Template Options", "t2t"),
      "location"      => "normal",
      "priority"      => "low",
  ));

  // use the same options the shortcode uses
  $album_list_sc = new T2T_Shortcode_Album_List();
  foreach($album_list_sc->get_attributes() as $att) {
    $albums_metabox->add_field($att);
  }

  array_push($meta_boxes, $albums_metabox);

  return $meta_boxes;
}
add_filter("t2t_page_meta_boxes", "albums_page_meta_boxes");
?>