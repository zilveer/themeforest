<div class="white-block">
    <div class="white-block-title no-border">
        <?php if( !empty( $icon ) ): ?>
            <i class="fa fa-<?php echo esc_attr( $icon ); ?>"></i>
        <?php endif; ?>
        <h2><?php echo $title ?></h2>
        <a href="<?php echo esc_url( couponxl_append_query_string( couponxl_get_permalink_by_tpl( 'page-tpl_search_page' ), array( 'offer_type' => 'deal' ), array() ) ) ?>">
            <?php echo $small_title; ?>
            <i class="fa fa-arrow-circle-o-right"></i>
        </a>
    </div>
</div>

<?php
if( !empty( $deal_categories ) || !empty( $deal_locations ) || !empty( $deal_stores ) || !empty( $deals_number ) ){
    $args = array( 
        'post_type' => 'offer',
        'post_status' => 'publish',
        'posts_per_page' => $deals_number,
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
                'key' => 'deal_status',
                'value' => 'has_items',
                'compare' => '='
            ),
            array(
                'key' => 'offer_type',
                'value' => 'deal',
                'compare' => '='
            )
        )
    );
    if( !empty( $deal_categories ) ){
        $args['tax_query'][] = array(
            'taxonomy' => 'offer_cat',
            'field' => 'slug',
            'terms' => explode( ",", $deal_categories ),
            'operator' => 'IN'
        );
    }
    if( !empty( $deal_locations ) ){
        $args['tax_query'][] = array(
            'taxonomy' => 'location',
            'field' => 'slug',
            'terms' => explode( ",", $deal_locations ),
            'operator' => 'IN'
        );
    }
    if( !empty( $deal_stores ) ){
        $args['meta_query'][] = array(
            'key' => 'offer_store',
            'value' => explode( ",", $deal_stores ),
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

if( !empty( $deals_orderby ) ){
    if( $deals_orderby !== 'offer_expire' ){
        unset( $args['meta_key'] );
    }
    $args['orderby'] = $deals_orderby;
}
if( !empty( $deals_order ) ){
    $args['order'] = $deals_order;
}

$deals = new WP_Query( $args );

$counter = 0;
if( $deals->have_posts() ){
    ?>
    <div class="row">
    <?php                    
    while( $deals->have_posts() ){
        if( $counter == 3 ){
            echo '</div><div class="row">';
            $counter = 0;
        }
        $counter++;
        $deals->the_post();
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