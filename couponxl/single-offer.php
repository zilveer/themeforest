<?php
/*==================
 SINGLE DEAL POST
==================*/

the_post();
$_offer_type = get_post_meta( get_the_ID(), 'offer_type', true );

get_header();
get_template_part( 'includes/title' );

$result = couponxl_get_rate_average( get_the_ID() );

?>
<section class="deal-single">
    <div class="container">
        <div class="row">
            <?php if( $_offer_type == 'deal' ): ?>
                <?php couponxl_register_click( get_the_ID() ); ?>
                <div class="col-sm-8">
                    <div class="deal-message">
                        <?php couponxl_check_shopping(); ?>
                    </div>
                    <div class="white-block">
                        <?php
                        $deal_images = couponxl_smeta_images( 'deal_images', get_the_ID(), array() ); 
                        if( !empty( $deal_images ) || has_post_thumbnail() ){
                            ?>
                            <div class="white-block-media">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <?php
                                        if( !empty( $deal_images ) ){
                                            ?>
                                            <ul class="list-unstyled post-slider embed-responsive-item">
                                                <?php
                                                foreach( $deal_images as $image_id ){
                                                    echo '<li>'.wp_get_attachment_image( $image_id, 'post-thumbnail', 0, array( 'class' => 'embed-responsive-item' ) ).'</li>';
                                                }
                                                ?>
                                            </ul>
                                            <?php
                                        }
                                        else if( has_post_thumbnail() ){
                                            the_post_thumbnail( 'post-thumbnail', array( 'class' => 'embed-responsive-item' ) );
                                        }
                                        else{
                                            echo '<img src="'.esc_url( get_template_directory_uri().'/images/sider-featured-placeholder.png' ).'" alt="" class="embed-responsive-item" />';
                                        }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="white-block-content">

                            <ul class="list-unstyled list-inline top-meta">
                                <?php
                                $deal_markers = get_post_meta( get_the_ID(), 'deal_markers' );
                                if( count( $deal_markers ) > 0 ):
                                ?>
                                    <li>
                                        <i class="fa fa-map-marker"></i> 
                                        <?php _e( 'MULTIPLE LOCATIONS', 'couponxl' ) ?>
                                    </li>
                                <?php endif; ?>
                                <li><i class="fa fa-circle"></i><?php echo couponxl_taxonomy( 'offer_cat', 1 ); ?></li>
                                <li class="pull-right"><?php echo couponxl_get_ratings() ?></li>
                            </ul>

                            <?php 
                            $show_breadcrumbs = couponxl_get_option( 'show_breadcrumbs' );
                            if( $show_breadcrumbs == 'yes' ){
                                ?>
                                <h1 class="size-h2"><?php the_title(); ?></h1>
                                <?php
                            }
                            else{
                                ?>
                                <h2><?php the_title(); ?></h2>
                                <?php
                            }
                            ?>
                            <div class="page-content">
                                <?php the_content(); ?>
                            </div>
                        </div>

                    </div>

                    <?php
                    $tags = couponxl_offer_tags();
                    if( !empty( $tags ) ):
                    ?>
                        <div class="white-block tags-list">
                            <div class="white-block-content">
                                <i class="fa fa-tags icon-margin"></i>
                                <?php echo $tags; ?>
                            </div>
                        </div>
                    <?php
                    endif;
                    ?>

                    <?php
                    $deal_show_author = couponxl_get_option( 'deal_show_author' );
                    if( $deal_show_author == 'yes' ):
                    ?>
                        <div class="white-block author-box">
                            <div class="media">
                                <div class="media-left">
                                    <?php
                                    $avatar_url = couponxl_get_avatar_url( get_avatar( get_the_author_meta( 'ID' ), 140 ) ) ;
                                    ?>
                                    <img src="<?php echo esc_url( $avatar_url ) ?>" class="media-object" alt=""/>
                                </div>
                                <div class="media-body">
                                    <h4><?php the_author_meta( 'display_name' ); ?></h4>
                                    <p><?php the_author_meta( 'description' ); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php comments_template( '', true ); ?>

                </div>

                <div class="col-sm-4">
                    <?php
                    $offer_availability =  couponxl_check_offer();
                    $deal_vouchers = couponxl_deal_voucher_count();
                    $deal_items = get_post_meta( get_the_ID(), 'deal_items', true );
                    $deal_link = get_post_meta( get_the_ID(), 'deal_link', true );

                    ?>
                    <div class="widget white-block deal-sidebar-box <?php echo $offer_availability ? '' : 'disabled' ?>">

                        <div class="widget-title">
                            <?php echo couponxl_get_deal_price() ?>
                        </div>

                        <?php couponxl_generate_paypal_offer_link(); ?>

                        <?php

                        $offer_expire = get_post_meta( get_the_ID(), 'offer_expire', true );
                        $offer_start = get_post_meta( get_the_ID(), 'offer_start', true );
                        if( ( !empty( $offer_expire ) && $offer_expire != '99999999999' ) || $offer_start > current_time( 'timestamp' ) ):
                        ?>
                            <div class="deal-countdown-wrap">
                                <i class="fa fa-clock-o"></i>
                                <div class="deal-countdown-info">
                                    <p><?php 
                                    if( $offer_start <= current_time( 'timestamp' ) ){
                                        _e( 'TIME LEFT - LIMITED OFFER!', 'couponxl' );
                                        $countdown_time = $offer_expire;
                                    }
                                    else{
                                        _e( 'TIME UNTIL OFFER STARTS', 'couponxl' );
                                        $countdown_time = $offer_start;
                                    }?></p>
                                    <h4>
                                        <?php
                                        if( $offer_expire <= current_time( 'timestamp' ) ){
                                            _e( 'DEAL EXPIRED', 'couponxl' );
                                        }
                                        else if( $deal_items - $deal_vouchers <= 0 ){
                                            _e( 'SOLD OUT', 'couponxl' );
                                        }
                                        else{
                                        ?>
                                            <span class="deal-countdown" data-single="<?php esc_attr_e( 'Day', 'couponxl' ) ?>" data-multiple="<?php esc_attr_e( 'Days', 'couponxl' ) ?>" data-expire="<?php echo esc_attr( $countdown_time ) ?>" data-current-time="<?php echo esc_attr( current_time( 'timestamp' ) ); ?>"></span>
                                        <?php 
                                        } 
                                        ?>
                                    </h4>
                                </div>
                            </div>
                        <?php elseif( empty( $deal_link ) ): ?>
                            <div class="deal-countdown-wrap">
                                <i class="fa fa-ticket"></i>
                                <div class="deal-countdown-info">
                                    <p><?php _e( 'ITEMS LEFT - LIMITED OFFER!', 'couponxl' ) ?></p>
                                    <h4>
                                        <?php
                                        if( $deal_items - $deal_vouchers > 0 ){
                                            $items_left = $deal_items - $deal_vouchers;
                                            echo $items_left; 
                                            $items_left == 1 ? _e( ' ITEM', 'couponxl' ) : _e( ' ITEMS', 'couponxl' );
                                        }
                                        else{
                                            _e( 'SOLD OUT', 'couponxl' );
                                        }
                                        ?>
                                    </h4>
                                </div>
                            </div>                        
                        <?php endif; ?>

                        <?php
                        $deal_show_bought = couponxl_get_option( 'deal_show_bought' );
                        if( $deal_show_bought == 'yes' && empty( $deal_link ) ):
                            ?>
                            <div class="deal-bought-wrap">
                                <i class="fa fa-users"></i>
                                <div class="deal-bought-info">
                                    <h4> <?php echo $deal_vouchers; _e( ' Bought!', 'couponxl' ); ?> </h4>
                                </div>
                            </div>
                        <?php endif; ?>

                        <ul class="deal-value-wrap list-unstyled list-inline">

                            <?php 
                            $deal_price = get_post_meta( get_the_ID(), 'deal_price', true ); 
                            if( !empty( $deal_price ) ):
                            ?>
                                <li>
                                    <p><?php _e( 'VALUE', 'couponxl' ); ?></p>
                                    <h6><?php echo couponxl_format_price_number( $deal_price ) ?></h6>
                                </li>
                            <?php endif; ?>

                            <?php 
                            $deal_discount = get_post_meta( get_the_ID(), 'deal_discount', true ); 
                            if( !empty( $deal_discount ) ):
                            ?>
                                <li>
                                    <p><?php _e( 'DISCOUNT', 'couponxl' ); ?></p>
                                    <h6><?php echo $deal_discount ?></h6>
                                </li>
                            <?php endif; ?>

                            <?php 
                            $deal_sale_price = get_post_meta( get_the_ID(), 'deal_sale_price', true ); 
                            if( !empty( $deal_sale_price ) ):
                            ?>
                                <li>
                                    <p><?php _e( 'YOU SAVE', 'couponxl' ); ?></p>
                                    <h6><?php echo couponxl_format_price_number( $deal_price - $deal_sale_price ); ?></h6>
                                </li>
                            <?php endif; ?>

                        </ul>

                        <ul class="list-unstyled list-inline store-social-networks">
                            <li>
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink() ) ?>" class="share" target="_blank">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="http://twitter.com/intent/tweet?source=<?php echo esc_attr( get_bloginfo('name') ) ?>&amp;text=<?php echo urlencode( get_permalink() ) ?>" class="share" target="_blank">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://plus.google.com/share?url=<?php echo urlencode( get_permalink() ) ?>" class="share" target="_blank">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;" class="share mail-share" data-body="<?php the_permalink(); ?>" data-subject="<?php the_title(); ?>">
                                    <i class="fa fa-envelope-o"></i>
                                </a>
                            </li>                        
                        </ul>

                        <?php
                        $deal_in_short = get_post_meta( get_the_ID(), 'deal_in_short', true );
                        if( !empty( $deal_in_short ) ):
                        ?>
                            <div class="white-block-content">
                                <h5><?php _e( 'In Short', 'couponxl' ); ?></h5>
                                <div class="read-more">
                                    <p><?php echo $deal_in_short; ?></p>
                                </div>
                                <a href="javascript:;" class="read-more-toggle" data-close="<?php esc_attr_e( 'Close', 'couponxl' ) ?>"><?php _e( 'Read More', 'couponxl' ) ?></a>                            
                            </div>
                        <?php endif; ?>


                        <?php
                        $deal_markers = get_post_meta( get_the_ID(), 'deal_markers' );
                        if( !empty( $deal_markers ) ):
                        ?>
                            <div id="deal-map" data-markers='<?php echo json_encode( $deal_markers ) ?>'></div>
                        <?php endif; ?>

                        <?php
                        $offer_store = get_post_meta( get_the_ID(), 'offer_store', true );
                        ?>
                        <div class="shop-logo">
                            <a href="<?php echo get_permalink( $offer_store ) ?>">
                                <?php couponxl_store_logo( $offer_store ); ?>
                            </a>
                        </div>                    

                    </div>

                    <?php
                    $terms = get_the_terms( get_the_ID(), 'offer_cat' );
                    $deal_show_similar = couponxl_get_option( 'deal_show_similar' );
                    if( !empty( $terms ) && $deal_show_similar == 'yes' ):
                        $terms = array_shift( $terms );
                        $similar = new WP_Query(array(
                            'post_status' => 'publish',
                            'post_type' => 'offer',
                            'posts_per_page' => couponxl_get_option( 'similar_offers' ),
                            'post__not_in' => array( get_the_ID() ),
                            'meta_query' => array(
                                'relation' => "AND",
                                array(
                                    'key' => 'offer_type',
                                    'value' => 'deal',
                                    'compare' => '='
                                ),
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
                            ),
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'offer_cat',
                                    'field' => 'slug',
                                    'terms' => $terms->slug
                                )
                            )
                        ));  
                        if( $similar->have_posts() ){              
                        ?>  
                        <div class="widget white-block widget_similar_offers">

                            <div class="widget-title">
                                <h4><?php _e( 'Similar Offers', 'couponxl' ) ?></h4>
                            </div>

                            <?php
                                while( $similar->have_posts() ){
                                    $similar->the_post();
                                    ?>                                
                                    <a href="<?php the_permalink() ?>">
                                        <?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'img-responsive' ) ); ?>
                                    </a>
                                    <p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                                    <?php
                                }
                                wp_reset_query();
                            ?>
                        </div>
                        <?php
                        }
                        ?>                    

                    <?php endif; ?>

                </div>
                <?php get_sidebar( 'offer' ) ?>
                <?php
                    if( has_post_thumbnail() ){
                        $image_data = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' );
                    }
                    if( !empty( $offer_expire ) && $offer_expire != '99999999999' ){
                        $priceValidUntil = date_i18n( 'Y-m-d', $offer_expire );
                    }                    
                ?>
                <script type="application/ld+json">
                {
                  "@context": "http://schema.org/",
                  "@type": "Product",
                  "name": "<?php the_title() ?>",
                  "image": "<?php echo !empty( $image_data[0] ) ? $image_data[0] : '' ?>",
                  "description": "<?php echo get_the_excerpt(); ?>",
                  <?php if( !empty( $result['sum'] ) && $result['count'] > 0 ): ?>
                  "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "<?php echo number_format( $result['sum'] / $result['count'], 2 ) ?>",
                    "reviewCount": "<?php echo $result['count']; ?>"
                  },
                  <?php endif; ?>
                  "offers": {
                    "@type": "Offer",
                    "priceCurrency": "<?php echo esc_attr( couponxl_get_option( 'main_unit_abbr' ) ) ?>",
                    "price": "<?php echo $deal_sale_price ?>",
                    "priceValidUntil": "<?php echo !empty( $priceValidUntil ) ? $priceValidUntil : '' ?>",
                    "itemCondition": "http://schema.org/UsedCondition",
                    "availability": "http://schema.org/InStock",
                    "seller": {
                      "@type": "Organization",
                      "name": "<?php echo get_the_title( $offer_store ); ?>"
                    }
                  }
                }
                </script>                 
            <?php else: ?>
                <div class="col-sm-8">
                    <div class="white-block">
                        <?php
                        if( has_post_thumbnail() ){
                            ?>
                            <div class="white-block-media">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'embed-responsive-item' ) ); ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="white-block-content">

                            <ul class="list-unstyled list-inline top-meta">
                                <li><i class="fa fa-circle"></i><?php echo couponxl_taxonomy( 'offer_cat', 1 ); ?></li>
                                <li class="pull-right"><?php echo couponxl_get_ratings() ?></li>
                            </ul>

                            <?php 
                            $show_breadcrumbs = couponxl_get_option( 'show_breadcrumbs' );
                            if( $show_breadcrumbs == 'yes' ){
                                ?>
                                <h1 class="size-h2"><?php the_title(); ?></h1>
                                <?php
                            }
                            else{
                                ?>
                                <h2><?php the_title(); ?></h2>
                                <?php
                            }
                            ?>

                            
                            <div class="page-content">
                                <?php the_content(); ?>
                            </div>
                        </div>

                    </div>

                    <?php
                    $tags = couponxl_offer_tags();
                    if( !empty( $tags ) ):
                    ?>
                        <div class="white-block tags-list">
                            <div class="white-block-content">
                                <i class="fa fa-tags icon-margin"></i>
                                <?php echo $tags; ?>
                            </div>
                        </div>
                    <?php
                    endif;
                    ?>

                    <?php
                    $coupon_show_author = couponxl_get_option( 'coupon_show_author' );
                    if( $coupon_show_author == 'yes' ):
                    ?>
                        <div class="white-block author-box">
                            <div class="media">
                                <div class="media-left">
                                    <?php
                                    $avatar_url = couponxl_get_avatar_url( get_avatar( get_the_author_meta( 'ID' ), 140 ) ) ;
                                    ?>
                                    <img src="<?php echo esc_url( $avatar_url ) ?>" class="media-object" alt=""/>
                                </div>
                                <div class="media-body">
                                    <h4><?php the_author_meta( 'display_name' ); ?></h4>
                                    <p><?php the_author_meta( 'description' ); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php comments_template( '', true ); ?>

                </div>

                <div class="col-sm-4">
                    <div class="widget white-block deal-sidebar-box coupon-sidebar">

                        <?php echo couponxl_coupon_button(); ?>

                        <?php
                        $offer_expire = get_post_meta( get_the_ID(), 'offer_expire', true );
                        $offer_start = get_post_meta( get_the_ID(), 'offer_start', true );
                        ?>

                        <div class="deal-countdown-wrap">
                            <i class="fa fa-clock-o"></i>
                            <div class="deal-countdown-info">
                                <p><?php 
                                if( !empty( $offer_start ) && $offer_start > current_time( 'timestamp' ) ){
                                    _e( 'TIME UNTIL OFFER STARTS', 'couponxl' );
                                    $countdown_time = $offer_start;
                                }
                                else if( !empty( $offer_expire ) && $offer_expire != '99999999999' ){
                                    _e( 'TIME LEFT - LIMITED OFFER!', 'couponxl' );
                                    $countdown_time = $offer_expire;
                                }
                                else if( empty( $offer_expire ) || $offer_expire == '99999999999'  ){
									_e( 'UNLIMITED OFFER!', 'couponxl' );
                                }
                                ?></p>
                                <h4>
                                    <?php
                                    if( !empty( $offer_start ) && $offer_start > current_time( 'timestamp' ) ){
                                    	?>
                                    	<span class="deal-countdown" data-single="<?php esc_attr_e( 'Day', 'couponxl' ) ?>" data-multiple="<?php esc_attr_e( 'Days', 'couponxl' ) ?>" data-expire="<?php echo esc_attr( $countdown_time ) ?>" data-current-time="<?php echo esc_attr( current_time( 'timestamp' ) ); ?>"></span>
                                    	<?php
                                    }
                                    else if( !empty( $offer_expire ) && $offer_expire == '99999999999' ){
                                    	_e( 'UNLIMITED', 'couponxl' );
                                    }
                                    else if( !empty( $offer_expire ) &&  $offer_expire <= current_time( 'timestamp' ) ){
                                        _e( 'DEAL EXPIRED', 'couponxl' );
                                    }
                                    else{
                                    ?>
                                        <span class="deal-countdown" data-single="<?php esc_attr_e( 'Day', 'couponxl' ) ?>" data-multiple="<?php esc_attr_e( 'Days', 'couponxl' ) ?>" data-expire="<?php echo esc_attr( $countdown_time ) ?>" data-current-time="<?php echo esc_attr( current_time( 'timestamp' ) ); ?>"></span>
                                    <?php 
                                    } 
                                    ?>
                                </h4>
                            </div>
                        </div>

                        <ul class="list-unstyled list-inline store-social-networks">
                            <li>
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink() ) ?>" class="share" target="_blank">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="http://twitter.com/intent/tweet?source=<?php echo esc_attr( get_bloginfo('name') ) ?>&amp;text=<?php echo urlencode( get_permalink() ) ?>" class="share" target="_blank">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://plus.google.com/share?url=<?php echo urlencode( get_permalink() ) ?>" class="share" target="_blank">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;" class="share mail-share" data-body="<?php the_permalink(); ?>" data-subject="<?php the_title(); ?>">
                                    <i class="fa fa-envelope-o"></i>
                                </a>
                            </li>                        
                        </ul>

                        <?php
                        $offer_store = get_post_meta( get_the_ID(), 'offer_store', true );
                        ?>
                        <div class="shop-logo">
                            <a href="<?php echo get_permalink( $offer_store ) ?>">
                                <?php couponxl_store_logo( $offer_store ); ?>
                            </a>
                        </div>                    

                    </div>

                    <?php
                    $terms = get_the_terms( get_the_ID(), 'offer_cat' );
                    $coupon_show_similar = couponxl_get_option( 'coupon_show_similar' );
                    if( !empty( $terms ) && $coupon_show_similar == 'yes' ):
                        $terms = array_shift( $terms );
                        $similar = new WP_Query(array(
                            'post_status' => 'publish',
                            'post_type' => 'offer',
                            'posts_per_page' => couponxl_get_option( 'coupon_similar_offers' ),
                            'post__not_in' => array( get_the_ID() ),
                            'meta_query' => array(
                                'relation' => "AND",
                                array(
                                    'key' => 'offer_type',
                                    'value' => 'coupon',
                                    'compare' => '='
                                ),
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
                                array(
                                    'taxonomy' => 'offer_cat',
                                    'field' => 'slug',
                                    'terms' => $terms->slug
                                )
                            )
                        ));  
                        if( $similar->have_posts() ){              
                        ?>  
                        <div class="widget white-block widget_similar_offers">

                            <div class="widget-title">
                                <h4><?php _e( 'Similar Offers', 'couponxl' ) ?></h4>
                            </div>

                            <?php
                                while( $similar->have_posts() ){
                                    $similar->the_post();
                                    ?>                                
                                    <a href="<?php the_permalink() ?>">
                                        <?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'img-responsive' ) ); ?>
                                    </a>
                                    <p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                                    <?php
                                }
                                wp_reset_query();
                            ?>
                        </div>
                        <?php
                        }
                        ?>                    

                    <?php endif; ?>

                </div>
                <?php get_sidebar( 'offer' ) ?>
                <script type="application/ld+json">
                {
                  "@context": "http://schema.org/",
                  "@type": "Organization",
                  "name": "Coupon",
                  "description": "<?php the_content() ?>",
                  <?php if( !empty( $result['sum'] ) && $result['count'] > 0 ): ?>
                  "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "<?php echo number_format( $result['sum'] / $result['count'], 2 ) ?>",
                    "reviewCount": "<?php echo $result['count']; ?>"
                  }
                  <?php endif; ?>
                }              
                </script> 
            <?php endif; ?>

        </div>
    </div>
</section>

<?php
get_footer();
?>