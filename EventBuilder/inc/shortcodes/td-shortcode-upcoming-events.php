<?php

// [upcoming_events]
function upcoming_events_func() {

  ob_start();

  ?>

  <div class="row" style="margin-bottom: 50px;">

    <?php

        global $custom_posts2;
        $custom_posts2 = new WP_Query();
        $custom_posts2->query(array(
            'post_type'      => 'event',
            'posts_per_page' => '6',
            'post_status'    => 'publish',
            'meta_key'       => 'event_start_date_number',
            'orderby'        => 'meta_value',
            'order'          => 'ASC',
            'meta_query' => array(
                    array(
                        'key'     => 'event_status',
                        'value'   => 'upcoming',
                    ),
                ),
            )
        );

        if ( $custom_posts2->have_posts() ) {

    ?>

                  <?php while ($custom_posts2->have_posts()) : $custom_posts2->the_post(); ?>

                  <div class="col-sm-4 id-<?php echo get_the_ID(); ?>">

                    <?php 

                    if(has_post_thumbnail()) { 

                      $image_src_all = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), false, '' );

                      $image_src = $image_src_all[0];

                    } elseif(!empty($redux_default_img_bg)) { 

                      $image_src = esc_url($redux_default_img_bg); 

                    } else { 

                      $image_src = esc_url(get_template_directory_uri())."/images/title-bg.jpg";

                    } 

                    ?> 

                    <div class="listing-container">

                      <a class="listing-container-big-button" href="<?php the_permalink(); ?>"></a>
                      
                      <div class="listing-container-block" >

                        <div class="listing-container-block-body">

                          <div class="listing-block-title">

                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

                            <span class="listing-container-event-date">

                              <?php 

                                $event_address_city = get_post_meta(get_the_ID(), 'event_address_city', true);

                              ?> 

                              <?php if(!empty($event_address_city)) { ?>
                                <span><i class="fa fa-map-marker"></i><?php echo esc_attr($event_address_city); ?></span>
                              <?php } ?>

                            </span>

                          </div>



                          <?php

                            global $wpdb, $all_reviews_media;
                            $post_id = get_the_ID();
                            $table_name = "td_reviews";

                            if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {

                              $all_reviews = $wpdb->get_var( "SELECT COUNT(*) FROM `td_reviews` WHERE listing_id = '".$post_id."' ORDER BY `ID` DESC");

                              if(!empty($all_reviews) && $all_reviews != 0) {

                                $all_reviews_media = $wpdb->get_results( "SELECT * FROM `td_reviews` WHERE listing_id = '".$post_id."' ORDER BY `ID` DESC");

                                $review_media_total = 0;

                                foreach ($all_reviews_media as $key) {

                                  $review_media = $key->listing_review_values_med;

                                  $review_media_total = $review_media_total + $review_media;

                                }

                                $review_overall = $review_media_total/$all_reviews;

                              }

                            }

                          ?>

                          <div class="listing-container-rating">

                            <i class="fa fa-calendar"></i>

                            <?php $event_start_date = get_post_meta(get_the_ID(), 'event_start_date', true); if(!empty($event_start_date)) { ?>

                            <?php

															global $redux_demo; 
															if(isset($redux_demo['events-date-format'])) {
																$time_format = $redux_demo['events-date-format'];
																if($time_format == 1) {

														?>

															<?php $start_unix_time = strtotime($event_start_date); $start_date = date("m/d/Y",$start_unix_time); ?>

															<?php } elseif($time_format == 2) { ?>

															<?php $start_unix_time = strtotime($event_start_date); $start_date = date("d/m/Y",$start_unix_time); ?>

															<?php } } else { ?>

															<?php $start_unix_time = strtotime($event_start_date); $start_date = date("m/d/Y",$start_unix_time); ?>

														<?php } ?>

														<span><?php echo esc_attr($start_date); ?></span>

                            <?php } ?>

                          </div>

                          <div class="listing-container-views">

                            <i class="fa fa-eye"></i><span><?php echo esc_attr( themesdojo_getPostViews(get_the_ID()) ); ?></span>

                          </div>

                          <?php 

                            $this_post_id = get_the_ID();

                                $allFav = $wpdb->get_var( 'SELECT COUNT(*) FROM td_favorites WHERE listing_id = "'.$this_post_id.'" ' );

                                if(empty($allFav)) {
                                  $allFav = 0;
                                }

                              ?>

                          <div class="listing-container-bookmarks">

                            <i class="fa fa-heart"></i><span><?php echo esc_attr($allFav); ?></span>

                          </div>

                        </div>

                      </div>

                      <div class="listing-container-black-shadow"></div>

                      <div class="listing-container-image-bg" style="background: #fff url(<?php echo esc_url($image_src); ?>) no-repeat center center;"></div>

                    </div>

                  </div>

                  <?php endwhile; ?>

                  <?php } else { ?>

                    <div class="col-sm-12"><?php _e( 'No listings found.', 'themesdojo' ); ?></div>

                  <?php } ?>

  </div>

  <?php

  return ob_get_clean();

}
add_shortcode( 'upcoming_events', 'upcoming_events_func' );

add_action( 'vc_before_init', 'upcoming_events_integrateWithVC' );
function upcoming_events_integrateWithVC() {
   vc_map( array(
      "name" => __("Recent Listings", "themesdojo"),
      "base" => "upcoming_events",
      "class" => "",
      "category" => __('Content', 'themesdojo'),
      "params" => ""
   ) );
}

?>