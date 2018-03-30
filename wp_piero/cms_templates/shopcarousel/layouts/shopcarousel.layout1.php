<div class="cs-carousel-item">
    <div class="cs-carousel-item-meta row">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <?php do_action('woocommerce_before_shop_loop_item'); ?>
            <?php if($show_image == '1') :?>
                <div class="woo-image" >
                    <a href="<?php the_permalink(); ?>">
                        <?php
                            if($crop_image){
                                if (has_post_thumbnail() and wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false)){
                                    $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
                                    
                                    $image_resize = mr_image_resize( $attachment_image[0], $width_image, $height_image, true, 'c', false );
                                    echo '<img alt=""  src="'. $image_resize .'" />';
                                    
                                } else {
                                    $attachment_image = CSCORE_PLUGIN_URL.'assets/images/no-image.jpg';
                                    
                                    $image_resize = mr_image_resize( $attachment_image, $width_image, $height_image, true, false );
                                    echo '<img alt="" src="'. $image_resize .'" />';
                                } 
                            } else {
                                do_action('woocommerce_before_shop_loop_item_title');
                            }
                        ?>
                    </a>
                    <div class="product-action-wrap">
                        <?php if ($show_add_to_cart == '1'): ?>
                            <div class="woo-add-to-cart">
                                <?php do_action( 'woocommerce_after_shop_loop_item' );   ?>
                            </div>
                        <?php endif; ?>
                        <?php if($show_details_btn) :?>   
                        <div class="woo-view-detail">
                            <a class="btn view-detail" rel="" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span>View Detail</span></a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php else : ?>    
                <div class="product-action-wrap">
                    <?php if ($show_add_to_cart == '1'): ?>
                        <div class="woo-add-to-cart">
                            <?php do_action( 'woocommerce_after_shop_loop_item' );   ?>
                        </div>
                    <?php endif; ?>
                    <?php if($show_details_btn) :?>   
                    <div class="woo-view-detail">
                        <a class="btn view-detail" rel="" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span>View Detail</span></a>
                    </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
            <?php if ($show_title == '1') { ?>
                <div class="woo-title">
                <<?php echo $item_heading_size; ?> class="cs-title woo-title">
                    <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" rel="" style="color: <?php echo esc_attr($item_title_color); ?>;">
                        <?php the_title(); ?>
                    </a>
                </<?php echo $item_heading_size; ?>>
                </div>
            <?php } ?>

            <?php if ( $show_price == '1'): ?>
            <div class="woo-price">
                <?php
                    do_action('woocommerce_after_shop_loop_item_title');
                ?>
            </div>
            <?php endif; ?>
            <?php if($show_description): ?>
            <div class="woo-description">
                <span>
                <?php echo cshero_content_max_charlength(strip_tags(get_the_content()), $excerpt_length); ?>
                </span>
            </div>
            <?php endif; ?>

            <?php if ( $show_date): ?>
            <div class="woo-date">
                <?php echo get_the_date($date_format); ?>
            </div>
            <?php endif; ?>
            <?php if ( $show_author): ?>
            <div class="woo-author">
                <?php echo __('by',THEMENAME); ?> <?php the_author(); ?>
            </div>
            <?php endif; ?>
            <?php if ( $show_category == '1'): ?>
                <div class="woo-category">
                    <?php
                        $postid = get_the_ID();
                        $categories = get_the_term_list($postid, 'product_cat', '', ', ', '');
                    ?>
                    <span><?php print_r($categories); ?></span>  
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>