<?php
global $product, $mk_options;
 ?>

<div class="mk-modal is-active close-inside _ flex flex-center flex-items-center">
    <div class="mk-modal-container">
        <div class="mk-modal-header">
            <a href="#" class="modal-close js-modal-close">
                <svg xmlns="http://www.w3.org/2000/svg" width="15px" height="15px">
                    <g>
                        <line stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="0.5" y1="0.5" x2="14.5" y2="14.5"/>
                        <line stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="14.5" y1="0.5" x2="0.5" y2="14.5"/>
                    </g>
                </svg>
            </a>
        </div>
        <div class="mk-modal-content">
            <div class="product-quick-view mk-product style-default woocommerce" itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" >
                <div class="mk-product-image images">
                        <?php
                            $attachment_ids = $product->get_gallery_attachment_ids();
                            
                            $images[] = get_post_thumbnail_id(); 
                            foreach( $attachment_ids as $attachment_id ) {
                                $images[] = $attachment_id;
                            }

                            $images_as_string = implode(' ,', $images);

                            if(count($images) > 1) {
                                echo do_shortcode( '[mk_image_slideshow 
                                                        images="'.$images_as_string.'" 
                                                        effect="slide" 
                                                        displayTime="3000" 
                                                        transitionTime="700" 
                                                        hasNav="true" 
                                                        image_width="550"
                                                        image_height="550" 
                                                        smooth_height="false" 
                                                    ]' );
                            }
                            else {
                                // Product featured image
                                $featured_image_src = Mk_Image_Resize::resize_by_id_adaptive( get_post_thumbnail_id(), 'image-size-550x550', 550, 550, $crop = true, $dummy = true);
  
                                echo '<img src="'.$featured_image_src['dummy'].'" '.$featured_image_src['data-set'].' alt="'.get_the_title(get_post_thumbnail_id()).'">';
                            }
                            
                        ?>
                </div>
                <div class="mk-product-details">
                    <h1 itemprop="name" class="title"><?php the_title(); ?></h1>
                    <div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="mk-price">
                        <div itemprop="price" class="mk-single-price"><?php echo $product->get_price_html(); ?></div>
                        <meta itemprop="priceCurrency" content="<?php echo get_woocommerce_currency(); ?>" />
                        <link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />
                    </div>
                    <?php
                    if ( get_option( 'woocommerce_enable_review_rating' ) != 'no' ) {

                        $rating_count = $product->get_rating_count();
                        $review_count = $product->get_review_count();
                        $average      = $product->get_average_rating();

                    if ( $rating_count > 0 ) : ?>
                    <div class="mk-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                        <div class="star-rating" title="<?php printf( __( 'Rated %s out of 5', 'mk_framework' ), $average ); ?>">
                                <span style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>%">
                                    <strong itemprop="ratingValue" class="rating"><?php echo esc_html( $average ); ?></strong> <?php printf( __( 'out of %s5%s', 'mk_framework' ), '<span itemprop="bestRating">', '</span>' ); ?>
                                    <?php printf( _n( 'based on %s customer rating', 'based on %s customer ratings', $rating_count, 'mk_framework' ), '<span itemprop="ratingCount" class="rating">' . $rating_count . '</span>' ); ?>
                                </span>
                            </div>
                    </div>
                    <?php  endif; } ?>
                    <div class="description">
                        <?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
                    </div>
                    <div class="selector">
                        <?php

                        if($mk_options['woocommerce_catalog'] == 'true') {
                            remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
                        }

                        do_action( 'woocommerce_single_product_summary');

                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="mk-modal-footer"></div>
    </div>
</div>