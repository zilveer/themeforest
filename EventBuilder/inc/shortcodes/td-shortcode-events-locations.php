<?php

// [locations_events]
function locations_events_func() {

   ob_start();

   ?>

    <div class="row" style="margin-bottom: 50px;">

      <?php

        $currentID = 0;

        $categories = get_categories( array('taxonomy' => 'event_loc', 'hide_empty' => false,  'parent' => 0) );

        foreach ($categories as $category) {

          $currentID++;

          get_template_part( 'inc/BFI_Thumb' );
          $params = array( "width" => 900, "height" => 700, "crop" => true );

          if($currentID == 2) { 
            $widthID = "8"; 
          } elseif($currentID == 6) {
            $widthID = "8"; 
          } elseif($currentID == 12) {
            $widthID = "8"; 
          } else {
            $widthID = "4"; 
          }

          $tag = $category->cat_ID;
          $tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
          $your_image_url = isset( $tag_extra_fields[$tag]['your_image_url'] ) ? esc_attr( $tag_extra_fields[$tag]['your_image_url'] ) : '';
          $tag_link = get_term_link( $category );

          $option = '<div class="col-sm-'. $widthID .' '.$currentID.'"><div class="loc-block-cover"><a href="'.$tag_link.'"><span class="loc-block-cover-title">';
          $option .= $category->cat_name;
          $option .= '</span><span class="loc-block-cover-subtitle">(';
          $option .= $category->count;
          $option .= ')</span><span class="loc-block-cover-image" style="background: url('.bfi_thumb( "$your_image_url", $params ).') no-repeat center center;"></span></a></div></div>';

          $catID = $category->term_id;

          $categories_child = get_categories( array('taxonomy' => 'event_loc', 'hide_empty' => false,  'parent' => $catID) );

          foreach ($categories_child as $category_child) {

            $currentID++;

            if($currentID == 2) { 
              $widthID = "8"; 
            } elseif($currentID == 6) {
              $widthID = "8"; 
            } else {
              $widthID = "4"; 
            }

            $tag = $category_child->cat_ID;
            $tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
            $your_image_url = isset( $tag_extra_fields[$tag]['your_image_url'] ) ? esc_attr( $tag_extra_fields[$tag]['your_image_url'] ) : '';
            $tag_link = get_term_link( $category_child );

            $option .= '<div class="col-sm-'. $widthID .' '.$currentID.'"><div class="loc-block-cover"><a href="'.$tag_link.'"><span class="loc-block-cover-title">';
            $option .= $category_child->cat_name;
            $option .= '</span><span class="loc-block-cover-subtitle">(';
            $option .= $category_child->count;
            $option .= ')</span><span class="loc-block-cover-image" style="background: url('.bfi_thumb( "$your_image_url", $params ).') no-repeat center center;"></span></a></div></div>';

          }

          echo $option;

        }

      ?>

    </div>

    <?php

    return ob_get_clean();

}
add_shortcode( 'locations_events', 'locations_events_func' );

add_action( 'vc_before_init', 'locations_events_integrateWithVC' );
function locations_events_integrateWithVC() {
   vc_map( array(
      "name" => __("Events Locations", "themesdojo"),
      "base" => "locations_events",
      "class" => "",
      "category" => __('Content', 'themesdojo'),
      "params" => ""
   ) );
}

?>