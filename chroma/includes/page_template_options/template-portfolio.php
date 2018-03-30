<?php
/*
 * template-portfolio.php
 *
 * This file supports the template-portfolio.php template
 * by creating the metabox fields necessary to render
 * the admin panel options
 *
 */
function portfolio_page_meta_boxes($meta_boxes) {
  // homepage template options
  $portfolio_metabox = new T2T_MetaBox(array(
      "id"            => "template-portfolio",
      "post_type"     => "page",
      "title"         => __("Portfolio Template Options", "t2t"),
      "location"      => "normal",
      "priority"      => "low",
  ));

  // use the same options the shortcode uses
  $portfolio_list_sc = new T2T_Shortcode_Portfolio();
  foreach($portfolio_list_sc->get_attributes() as $att) {
    $portfolio_metabox->add_field($att);
  }

  array_push($meta_boxes, $portfolio_metabox);

  return $meta_boxes;
}
add_filter("t2t_page_meta_boxes", "portfolio_page_meta_boxes");
?>