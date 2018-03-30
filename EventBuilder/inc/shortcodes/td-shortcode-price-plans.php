<?php

// [price_plans]
function price_plans_func() {

  ob_start();

  ?>

  <div class="row" style="margin-bottom: 50px;">

  <?php         

            global $custom_posts2;
            $custom_posts2 = new WP_Query();
            $custom_posts2->query('post_type=package&posts_per_page=-1&post_status=publish&order=ASC');

            if ( $custom_posts2->have_posts() ) {
            while ($custom_posts2->have_posts()) : $custom_posts2->the_post();

            $package_active = get_post_meta(get_the_ID(), 'package_active', true);

            if(!empty($package_active)) {

              $postID = get_the_ID();

          ?>

            <?php 

              $posts = get_posts('post_type=package'); 
              $count = count($posts);  

            ?>

            <div class="col-sm-<?php if($count == 1) { ?>12<?php } elseif($count == 2) { ?>6<?php } elseif($count == 3) { ?>4<?php } else { ?>4<?php } ?>">

              <div class="item-block-title price-plan-header">

                <?php

                  global $redux_demo; 

                  $package_price = get_post_meta(get_the_ID(), 'package_price', true);

                  if(empty($package_price) or $package_price == 0) {
                    $package_price = __( 'Free', 'themesdojo' );
                    $currency_symbol = "";
                  } else {
                    $currency_symbol = $redux_demo['currency-symbol'];
                  }

                ?>

                <h4><?php the_title(); ?></h4>
                <span class="package-price"><?php echo esc_attr($currency_symbol); echo esc_attr($package_price); ?></span>

              </div>

              <div class="item-block-content item-image-gallery-block">

                <ul class="package-capabilities">

                  <?php 

                    $package_approve_item = get_post_meta(get_the_ID(), 'package_approve_item', true);
                    if(empty($package_approve_item)) {
                      $package_approve_item = __( 'Instant', 'themesdojo' );
                    } else {
                      $package_approve_item = __( 'Admin Moderated', 'themesdojo' );
                    }

                    $package_items_amount = get_post_meta(get_the_ID(), 'package_items_amount', true);
                    
                    $package_events_amount = get_post_meta(get_the_ID(), 'package_events_amount', true);
                    if(empty($package_events_amount)) {
                      $package_events_amount = 0;
                    }

                    $package_items_feat_amount = get_post_meta(get_the_ID(), 'package_items_feat_amount', true);
                    if(empty($package_items_feat_amount)) {
                      $package_items_feat_amount = 0;
                    }

                    $package_items_expiration = get_post_meta(get_the_ID(), 'package_items_expiration', true);
                    if(empty($package_items_expiration) or $package_items_expiration == 0) {
                      $package_items_expiration = __( 'Unlimited', 'themesdojo' );
                      $package_items_expiration_value = "";
                    } else {
                      $package_items_expiration_value = __( 'Days', 'themesdojo' );
                    }

                    $package_allow_feat_image = get_post_meta(get_the_ID(), 'package_allow_feat_image', true);
                    if(empty($package_allow_feat_image)) {
                      $package_allow_feat_image = '<i class="fa fa-times"></i>';
                    } else {
                      $package_allow_feat_image = '<i class="fa fa-check main-color"></i>';
                    }

                    $package_allow_gallery = get_post_meta(get_the_ID(), 'package_allow_gallery', true);
                    if(empty($package_allow_gallery)) {
                      $package_allow_gallery = '<i class="fa fa-times"></i>';
                    } else {
                      $package_allow_gallery = '<i class="fa fa-check main-color"></i>';
                    }

                    $package_allow_map = get_post_meta(get_the_ID(), 'package_allow_map', true);
                    if(empty($package_allow_map)) {
                      $package_allow_map = '<i class="fa fa-times"></i>';
                    } else {
                      $package_allow_map = '<i class="fa fa-check main-color"></i>';
                    }

                    $package_allow_streetview = get_post_meta(get_the_ID(), 'package_allow_streetview', true);
                    if(empty($package_allow_streetview)) {
                      $package_allow_streetview = '<i class="fa fa-times"></i>';
                    } else {
                      $package_allow_streetview = '<i class="fa fa-check main-color"></i>';
                    }

                    $package_allow_phone = get_post_meta(get_the_ID(), 'package_allow_phone', true);
                    if(empty($package_allow_phone)) {
                      $package_allow_phone = '<i class="fa fa-times"></i>';
                    } else {
                      $package_allow_phone = '<i class="fa fa-check main-color"></i>';
                    }

                    $package_allow_web = get_post_meta(get_the_ID(), 'package_allow_web', true);
                    if(empty($package_allow_web)) {
                      $package_allow_web = '<i class="fa fa-times"></i>';
                    } else {
                      $package_allow_web = '<i class="fa fa-check main-color"></i>';
                    }

                    $package_allow_social = get_post_meta(get_the_ID(), 'package_allow_social', true);
                    if(empty($package_allow_social)) {
                      $package_allow_social = '<i class="fa fa-times"></i>';
                    } else {
                      $package_allow_social = '<i class="fa fa-check main-color"></i>';
                    }

                    $package_allow_workinghours = get_post_meta(get_the_ID(), 'package_allow_workinghours', true);
                    if(empty($package_allow_workinghours)) {
                      $package_allow_workinghours = '<i class="fa fa-times"></i>';
                    } else {
                      $package_allow_workinghours = '<i class="fa fa-check main-color"></i>';
                    }

                    $package_allow_amenities = get_post_meta(get_the_ID(), 'package_allow_amenities', true);
                    if(empty($package_allow_amenities)) {
                      $package_allow_amenities = '<i class="fa fa-times"></i>';
                    } else {
                      $package_allow_amenities = '<i class="fa fa-check main-color"></i>';
                    }

                    $package_allow_video = get_post_meta(get_the_ID(), 'package_allow_video', true);
                    if(empty($package_allow_video)) {
                      $package_allow_video = '<i class="fa fa-times"></i>';
                    } else {
                      $package_allow_video = '<i class="fa fa-check main-color"></i>';
                    }

                    $package_allow_ratings = get_post_meta(get_the_ID(), 'package_allow_ratings', true);
                    if(empty($package_allow_ratings)) {
                      $package_allow_ratings = '<i class="fa fa-times"></i>';
                    } else {
                      $package_allow_ratings = '<i class="fa fa-check main-color"></i>';
                    }

                  ?>

                  <li>
                    <span class="package-cap-title"><?php _e( 'Events', 'themesdojo' ); ?></span>
                    <span class="package-cap-value"><?php echo esc_attr($package_events_amount); ?></span>
                  </li>

                  <li>
                    <span class="package-cap-title"><?php _e( 'Publishing', 'themesdojo' ); ?></span>
                    <span class="package-cap-value"><?php echo esc_attr($package_approve_item); ?></span>
                  </li>

                  <li>
                    <span class="package-cap-title"><?php _e( 'Cover Image', 'themesdojo' ); ?></span>
                    <span class="package-cap-value"><?php echo $package_allow_feat_image; ?></span>
                  </li>

                  <li>
                    <span class="package-cap-title"><?php _e( 'Gallery', 'themesdojo' ); ?></span>
                    <span class="package-cap-value"><?php echo $package_allow_gallery; ?></span>
                  </li>

                  <li>
                    <span class="package-cap-title"><?php _e( 'Ratings', 'themesdojo' ); ?></span>
                    <span class="package-cap-value"><?php echo $package_allow_ratings; ?></span>
                  </li>

                  <li>
                    <span class="package-cap-title"><?php _e( 'Map', 'themesdojo' ); ?></span>
                    <span class="package-cap-value"><?php echo $package_allow_map; ?></span>
                  </li>

                  <li style="border-bottom: none; padding-bottom: 0px; margin-bottom: 0;">

                    <span id="signup-package-<?php echo esc_attr($postID); ?>" class="td-buttom sign-up-button" style="margin-bottom: 0; margin-right: 0;">

                      <?php 

                        if ( !is_user_logged_in() ) {

                          _e( 'Sign up & start publishing now', 'themesdojo' ); 

                        } else {

                          _e( 'Buy now', 'themesdojo' ); 

                        }

                      ?>

                    </span>

                  </li>

                  <script type="text/javascript">

                    jQuery(function($) {

                      document.getElementById('signup-package-<?php echo esc_attr($postID); ?>').addEventListener('click', function(e) {
                                          
                        $.fn.OpenClaimForm<?php echo esc_attr($postID); ?>();

                        $('#account_type').val('<?php echo esc_attr($postID); ?>').trigger('change');

                        e.preventDefault();

                      });

                      $.fn.OpenClaimForm<?php echo esc_attr($postID); ?> = function() {

                          var val = <?php echo esc_attr($postID); ?>;

                          jQuery('#stripe-payment-package').val(val);
                          jQuery('#paypal-payment-package').val(val);
                          jQuery('#payment-package-id').val(val);

                          var val2 = jQuery("#package-title-"+val).val();
                          var val3 = jQuery("#package-price-"+val).val();

                          jQuery('#payment-package-title').val(val2);
                          jQuery('#payment-package-price').val(val3);

                          <?php         

                          $postID = get_the_ID();

                          $package_price = get_post_meta(get_the_ID(), 'package_price', true);

                          if(empty($package_price) or $package_price == 0) {
                                

                        ?>

                          if( val == <?php echo esc_attr($postID); ?> ) {
                              jQuery("#free-package-button").css({"display":"inline-block"});
                              jQuery("#payed-package-button").css({"display":"none"});
                          } 

                          <?php } else { ?>

                          if( val == <?php echo esc_attr($postID); ?> ) {
                              jQuery("#free-package-button").css({"display":"none"});
                              jQuery("#payed-package-button").css({"display":"inline-block"});
                          } 

                          <?php } ?>

                          jQuery('#popup-td-register .item-block-title h4').text("<?php _e( 'Select Payment System', 'themesdojo' ); ?>");
                          jQuery('#popup-td-register').css('display', 'block');

                      }

                    });

                  </script>

                </ul>

              </div>

            </div>

          <?php } ?>

          <?php endwhile; } ?>
          <?php wp_reset_query(); ?>

  </div>

  <?php

  return ob_get_clean();

}
add_shortcode( 'price_plans', 'price_plans_func' );

add_action( 'vc_before_init', 'price_plans_integrateWithVC' );
function price_plans_integrateWithVC() {
   vc_map( array(
      "name" => __("Price Plans", "themesdojo"),
      "base" => "price_plans",
      "class" => "",
      "category" => __('Content', 'themesdojo'),
      "params" => ""
   ) );
}

?>