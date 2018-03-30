<?php

// [categories_events_v1]
function categories_events_v2_func() {

   ob_start();

   ?>

    <div class="row" style="margin-bottom: 50px;">

      <div id="events-cat-block">

        <?php

            $categories = get_categories( array( 'taxonomy' => 'event_cat', 'hide_empty' => false, 'parent' => 0 ) );

            foreach ($categories as $category) {

                $tag = $category->term_id;

                $tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
                $category_icon_code = isset( $tag_extra_fields[$tag]['category_icon_code'] ) ? $tag_extra_fields[$tag]['category_icon_code'] : '';
                $category_icon = stripslashes($category_icon_code);

                $tag_link = get_term_link( $category );
        ?>

        <div class="col-sm-4 cat-block-isotope">

            <div class="category-shortcode-block">

                <?php if(!empty($category_icon)) { echo $category_icon; } ?>

                <h3 <?php if(empty($category_icon)) { ?>style="margin-top: 30px;"<?php } ?>><?php echo esc_attr($category->cat_name); ?></h3>

                <?php

                  $categories_child = get_categories( array('taxonomy' => 'event_cat', 'hide_empty' => false,  'parent' => $tag) );

                  $option = "";

                  $currentPos = 0;

                  if(!empty($categories_child)) { 

                  ?>

                  <ul class="sub-cat-block">

                  <?php }

                  foreach ($categories_child as $category_child) {

                    $currentPos++;

                    $subCatId = $category_child->cat_ID;
                    $subCatLink = get_term_link( $category_child );

                    $option .= '<li><span class="cat-title"><a href="'.$subCatLink.'">';
                    $option .= $category_child->cat_name;
                    $option .= '</a></span><span class="cat-count">';
                    $option .= $category_child->count;
                    $option .= '</span></li>';

                  }

                  echo $option;

                  if(!empty($categories_child)) {

                ?>

                </ul>

                <?php } ?>

                <?php $catCount = $category->count; if(empty($categories_child) OR $catCount != 0){ ?>

                <ul class="sub-cat-block" <?php if($currentPos > 0) { ?>style="border-top: none; padding-top: 0px;"<?php } ?>>

                <?php

                  $optionOne = '';
                  $optionOne .= '<li><span class="cat-title"><a href="'.$tag_link.'">';
                  $optionOne .= $category->cat_name;
                  $optionOne .= '</a></span><span class="cat-count">';
                  $optionOne .= $category->count;
                  $optionOne .= '</span></li>';

                  echo $optionOne;

                ?>

                </ul>

                <?php } ?>

            </div>

        </div>

        <?php

            }

        ?>

      </div>

    </div>

    <?php

    return ob_get_clean();

}
add_shortcode( 'categories_events_v2', 'categories_events_v2_func' );

add_action( 'vc_before_init', 'categories_events_v2_integrateWithVC' );
function categories_events_v2_integrateWithVC() {
   vc_map( array(
      "name" => __("Event Categories Version 2", "themesdojo"),
      "base" => "categories_events_v2",
      "class" => "",
      "category" => __('Content', 'themesdojo'),
      "params" => ""
   ) );
}

?>