<?php
add_filter( 'woocommerce_enqueue_styles', '__return_false' );
add_action( 'after_setup_theme', 'woocommerce_support' );

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );


add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 5 );
add_action( 'woocommerce_before_shop_loop_item_title', 'os_woocommerce_before_thumbnail', 9 );
add_action( 'woocommerce_before_shop_loop_item_title', 'os_woocommerce_after_thumbnail', 11 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_rating', 15 );
add_action( 'woocommerce_before_main_content', 'os_woocommerce_content_wrapper_before', 5);

function os_woocommerce_content_wrapper_before(){ ?>
  <div class="main-content">
    <div id="primary-content" class="woo-shop"> <?php
}

add_action( 'woocommerce_after_main_content', 'os_woocommerce_content_wrapper_after', 15);

function os_woocommerce_content_wrapper_after(){ ?>
      </div>
    </div>
    <?php
}

function os_woocommerce_before_thumbnail(){
  echo '<div class="product-media-body"><div class="figure-link-w">';
}


function os_woocommerce_after_thumbnail(){
  echo '</div></div>';
}