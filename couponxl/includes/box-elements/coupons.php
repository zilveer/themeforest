<div class="white-block">
    <div class="white-block-title no-border">
        <?php if( !empty( $icon ) ): ?>
            <i class="fa fa-<?php echo esc_attr( $icon ); ?>"></i>
        <?php endif; ?>
        <h2><?php echo $title ?></h2>
        <a href="<?php echo esc_url( couponxl_append_query_string( couponxl_get_permalink_by_tpl( 'page-tpl_search_page' ), array( 'offer_type' => 'coupon' ), array() ) ) ?>">
            <?php echo $small_title; ?>
            <i class="fa fa-arrow-circle-o-right"></i>
        </a>
    </div>
</div>

<?php

if( !empty( $coupon_categories ) || !empty( $coupon_locations ) || !empty( $coupon_stores ) || !empty( $coupons_number ) ){
    $args = array(
        'post_type' => 'offer',
        'post_status' => 'publish',
        'posts_per_page' => $coupons_number,
        'orderby' => 'meta_value_num',
        'meta_key' => 'offer_expire',
        'order' => 'ASC',
        'tax_query' => array(
            'relation' => 'AND'
        ),
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'offer_start',
                'value' => current_time( 'timestamp' ),
                'compare' => '<='
            ),
            array(
                'key' => 'offer_expire',
                'value' => current_time( 'timestamp' ),
                'compare' => '>='
            ),
            array(
                'key' => 'offer_type',
                'value' => 'coupon',
                'compare' => '='
            )
        )
    );
    if( !empty( $coupon_categories ) ){
        $args['tax_query'][] = array(
            'taxonomy' => 'offer_cat',
            'field' => 'slug',
            'terms' => explode( ",", $coupon_categories ),
            'operator' => 'IN'
        );
    }
    if( !empty( $coupon_locations ) ){
        $args['tax_query'][] = array(
            'taxonomy' => 'location',
            'field' => 'slug',
            'terms' => explode( ",", $coupon_locations ),
            'operator' => 'IN'
        );
    }
    if( !empty( $coupon_stores ) ){
        $args['meta_query'][] = array(
            'key' => 'offer_store',
            'value' => explode( ",", $coupon_stores ),
            'compare' => 'IN',
        );
    }    
}

else if( !empty( $items ) ){
    $args = array(
        'post_type' => 'offer',
        'post_status' => 'publish',
        'posts_per_page' => '-1',
        'post__in' => $items,
        'orderby' => 'meta_value_num',
        'meta_key' => 'offer_expire',
        'order' => 'ASC',
    );
}

if( !empty( $coupons_orderby ) ){
    if( $coupons_orderby !== 'offer_expire' ){
        unset( $args['meta_key'] );
    }
    $args['orderby'] = $coupons_orderby;
}
if( !empty( $coupons_order ) ){
    $args['order'] = $coupons_order;
} 

$coupons = new WP_Query( $args );
$counter = 0;
if( $coupons->have_posts() ){
    ?>
    <div class="row">
    <?php                    
    while( $coupons->have_posts() ){
        if( $counter == 3 ){
            echo '</div><div class="row">';
            $counter = 0;
        }
        $counter++;
        $coupons->the_post();
        ?>
        <div class="col-sm-4">
            <?php include( locate_template( 'includes/offers/offers.php' ) ); ?>
        </div>
        <?php
    }
    ?>
    </div>
    <?php
    wp_reset_query();
}
?>