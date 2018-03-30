<?php

// [categories_events_v1]
function categories_events_v1_func() {

   ob_start();

   ?>

    <div class="row" style="margin-bottom: 50px;">

        <?php

            $categories = get_categories( array( 'taxonomy' => 'event_cat', 'hide_empty' => false, 'parent' => 0 ) );

            foreach ($categories as $category) {

                $tag = $category->term_id;

                $tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
                $category_icon_code = isset( $tag_extra_fields[$tag]['category_icon_code'] ) ? $tag_extra_fields[$tag]['category_icon_code'] : '';
                $category_icon = stripslashes($category_icon_code);

                $tag_link = get_term_link( $category );

        ?>

        <div class="col-sm-3">

            <div class="category-shortcode-block">

                <a class="cat-link" href="<?php echo esc_url($tag_link); ?>">

                    <?php if(!empty($category_icon)) { echo $category_icon; } ?>

                    <h3 <?php if(empty($category_icon)) { ?>style="margin-top: 120px;"<?php } ?>><?php echo esc_attr($category->cat_name); ?></h3>

                </a>

            </div>

        </div>

        <?php

            }

        ?>

    </div>

    <?php

    return ob_get_clean();

}
add_shortcode( 'categories_events_v1', 'categories_events_v1_func' );

add_action( 'vc_before_init', 'categories_events_v1_integrateWithVC' );
function categories_events_v1_integrateWithVC() {
   vc_map( array(
      "name" => __("Event Categories Version 1", "themesdojo"),
      "base" => "categories_events_v1",
      "class" => "",
      "category" => __('Content', 'themesdojo'),
      "params" => ""
   ) );
}

?>