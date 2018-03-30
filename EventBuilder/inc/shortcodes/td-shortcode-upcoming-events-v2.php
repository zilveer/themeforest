<?php

// [upcoming_events_v2]
function upcoming_events_v2_func() {

  ob_start();

  ?>

  <div class="row upcoming-events-holder" style="margin-bottom: 90px;">

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

        $currentEvent = 0;

        if ( $custom_posts2->have_posts() ) {

    ?>

        <?php while ($custom_posts2->have_posts()) : $custom_posts2->the_post(); $currentEvent++; ?>

            <div class="col-sm-12 event-block id-<?php echo get_the_ID(); ?>">

                <div class="upcoming-events-v2">

                    <a class="upcoming-events-big-button" href="<?php the_permalink(); ?>"></a>

                    <div class="row">

                        <div class="col-sm-2 upcoming-events-number">

                            <h2><?php if($currentEvent <= 9) { ?>0<?php } ?><?php echo $currentEvent; ?></h2>

                        </div>

                        <div class="col-sm-5 upcoming-events-title">

                            <div class="upcoming-events-avatar">

                                <?php 

                                    if(has_post_thumbnail()) { 

                                      $image_src_all = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), false, '' );

                                      $image_src = $image_src_all[0];

                                    } elseif(!empty($redux_default_img_bg)) { 

                                      $image_src = esc_url($redux_default_img_bg); 

                                    } else { 

                                      $image_src = esc_url(get_template_directory_uri())."/images/title-bg.jpg";

                                    } 

                                    get_template_part( 'inc/BFI_Thumb' );
                                    $params = array( 'width' => 71, 'height' => 71, 'crop' => true );

                                ?> 

                                <img src="<?php echo bfi_thumb( $image_src, $params ); ?>" alt="" />  

                            </div>

                            <div class="upcoming-events-title-cont">

                                <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>

                                <?php 

                                    $postID = get_the_ID();

                                    $terms = get_the_terms($postID, 'event_cat' );
                                    if ($terms && ! is_wp_error($terms)) :
                                        $term_slugs_arr = array();
                                        foreach ($terms as $term) {
                                            $term_slugs_arr[] = $term->name;
                                        }
                                        $terms_slug_str = join( " ", $term_slugs_arr);
                                    endif; 

                                ?>

                                <span><i class="fa fa-folder-open"></i><?php echo esc_attr($terms_slug_str); ?></span>

                            </div>

                        </div>

                        <div class="col-sm-5 upcoming-events-details">

                            <div class="full">

                            <?php 

                                $event_address_country = get_post_meta(get_the_ID(), 'event_address_country', true);
                                $event_address_state = get_post_meta(get_the_ID(), 'event_address_state', true);
                                $event_address_city = get_post_meta(get_the_ID(), 'event_address_city', true);
                                $event_address_address = get_post_meta(get_the_ID(), 'event_address_address', true);
                                $event_address_zip = get_post_meta(get_the_ID(), 'event_address_zip', true);
                                $event_location = get_post_meta(get_the_ID(), 'event_location', true);

                            ?>

                            <i class="fa fa-map-marker"></i> 

                            <?php if(!empty($event_location)) { ?>
                                <?php echo esc_attr($event_location); ?><?php _e( ' - ', 'themesdojo' ); ?>
                            <?php } ?>

                            <?php if(!empty($event_address_city)) { ?>
                                <?php echo esc_attr($event_address_city); ?><?php _e( ', ', 'themesdojo' ); ?>
                            <?php } ?>

                            <?php if(!empty($event_address_country)) { ?>
                                <?php echo esc_attr($event_address_country); ?>
                            <?php } ?>

                            </div>

                            <div class="full">

                            <?php $event_phone = get_post_meta(get_the_ID(), 'event_phone', true); if(!empty($event_phone)) { ?>
                            <span><i class="fa fa-phone"></i><?php echo esc_attr($event_phone); ?></span><?php } ?>

                            </div>

                            <div class="full">

                            <i class="fa fa-calendar"></i>

                            <?php $event_start_date = get_post_meta(get_the_ID(), 'event_start_date', true); $event_start_time = get_post_meta(get_the_ID(), 'event_start_time', true); $event_location = get_post_meta(get_the_ID(), 'event_location', true); if(!empty($event_start_date)) { ?>

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

																<?php

																	global $redux_demo; 
																	if(isset($redux_demo['events-time-format'])) {
																		$time_format = $redux_demo['events-time-format'];
																		if($time_format == 1) {

																?>

																	<?php $start_time = esc_attr($event_start_time); ?>

																	<?php } elseif($time_format == 2) { ?>

																	<?php $start_time = date("H:i", strtotime($event_start_time)); ?>

																	<?php } } else { ?>

																	<?php $start_time = esc_attr($event_start_time); ?>

																<?php } ?>

														        <span><?php echo esc_attr($start_date); ?> <?php echo esc_attr($start_time); ?></span>

                            <?php } ?>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        <?php endwhile; ?>

        <?php
            global $redux_demo; 
            $all_events = $redux_demo['page-url-all-events'];
            if(!empty($all_events)) {
        ?>  

            <div class="col-sm-12" style="text-align: center; margin-top: 50px;">

                <a href="<?php echo get_permalink( $all_events ); ?>" class="td-buttom"><i class="fa fa-binoculars"></i><?php _e( 'View All Events', 'themesdojo' ); ?></a>

            </div>

        <?php } ?>

    <?php } else { ?>

        <div class="col-sm-12"><?php _e( 'No events found.', 'themesdojo' ); ?></div>

    <?php } ?>

  </div>

  <?php

  return ob_get_clean();

}
add_shortcode( 'upcoming_events_v2', 'upcoming_events_v2_func' );

add_action( 'vc_before_init', 'upcoming_events_v2_integrateWithVC' );
function upcoming_events_v2_integrateWithVC() {
   vc_map( array(
      "name" => __("Upcoming Events V2", "themesdojo"),
      "base" => "upcoming_events_v2",
      "class" => "",
      "category" => __('Content', 'themesdojo'),
      "params" => ""
   ) );
}

?>