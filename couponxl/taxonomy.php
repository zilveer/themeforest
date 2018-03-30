<?php 
get_header();
require_once( locate_template( 'includes/title.php' ) );
?>
<section class="offer-archive">
    <div class="container">
        <?php
            $cur_page = 1;
            if( get_query_var( 'paged' ) ){
                $cur_page = get_query_var( 'paged' );
            }
            else if( get_query_var( 'page' ) ){
                $cur_page = get_query_var( 'page' );
            }
            $args = array(
                'post_status' => 'publish',
                'posts_per_page' => couponxl_get_option( 'offers_per_page' ),
                'post_type' => 'offer',
                'paged' => $cur_page,
                'orderby' => array( 'meta_value_num' => 'ASC', 'date' =>'DESC' ),
                'meta_key' => 'offer_expire',
                'order' => 'ASC',
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
                ),
                'tax_query' => array(
                    'relation' => 'AND'
                )
            );

            if( !empty( $offer_sort ) ){
                $temp = explode( '-', $offer_sort );
                if( $temp[0] == 'date' ){
                    unset( $args['meta_key'] );
                    $args['orderby'] = $temp[0];
                    $args['order'] = $temp[1];
                }
                else{
                    if( $temp[0] == 'rate' ){
                        $temp[0] = 'couponxl_average_rate';
                    }
                    else if( $temp[0] == 'offer_expire' ){
                        $args['orderby'] = array( 'meta_value_num' => $temp[1], 'date' =>'DESC' );
                    }
                    $args['meta_key'] = $temp[0];
                    $args['order'] = $temp[1];
                }
            }

            if( is_tax( 'offer_cat' ) ){
                $args['tax_query'][] = array(
                    'taxonomy' => 'offer_cat',
                    'field' => 'slug',
                    'terms' => $offer_cat,
                );
            }
            else if( is_tax( 'location' ) ){
                $args['tax_query'][] = array(
                    'taxonomy' => 'location',
                    'field' => 'slug',
                    'terms' => $location,
                );
            }
            else if( is_tax( 'offer_tag' ) ){
                $args['tax_query'][] = array(
                    'taxonomy' => 'offer_tag',
                    'field' => 'slug',
                    'terms' => $offer_tag,
                );
            }

            if( !empty( $offer_type ) ){
                if( !empty( $offer_type ) || $offer_type == 'deal' ){
                    $args['meta_query'][] = array(
                        'key' => 'deal_status',
                        'value' => 'has_items',
                        'compare' => '='
                    );
                }
                $args['meta_query'][] = array(
                    'key' => 'offer_type',
                    'value' => $offer_type,
                    'compare' => '='
                );
            }

            $offers = new WP_Query( $args );
            $page_links_total =  $offers->max_num_pages;
            $pagination_args = array(
                'prev_next' => true,
                'end_size' => 2,
                'mid_size' => 2,
                'total' => $page_links_total,
                'format' => '?page=%#%',
                'current' => $cur_page, 
                'prev_next' => false,
                'type' => 'array'
            );

            $page_links = paginate_links( $pagination_args );

            $pagination = couponxl_format_pagination( $page_links );                    

            if( $offers->have_posts() ){
                $col = '4';
                if( $offer_view == 'list' ){
                    $col = 12;
                }
                ?>
                <div class="row masonry">
                    <?php
                    while( $offers->have_posts() ){
                        $offers->the_post();
                        ?>
                        <div class="col-sm-<?php echo esc_attr( $col ) ?> masonry-item">
                            <?php include( locate_template( 'includes/offers/offers.php' ) ); ?>
                        </div>
                        <?php
                    }
                    wp_reset_postdata();
                    ?>
                    <?php if( !empty( $pagination ) ): ?>
                        <div class="col-sm-<?php echo esc_attr( $col ) ?> masonry-item">
                            <ul class="pagination">
                               <?php echo $pagination; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
                <?php
            }
            else{
                ?>
                <div class="white-block">
                    <div class="white-block-content">
                        <p class="nothing-found"><?php echo couponxl_get_option( 'search_no_offers_message' ); ?></p>
                    </div>
                </div>
                <?php
            }
        ?>
    </div>
</section>
<?php  get_footer();  ?>