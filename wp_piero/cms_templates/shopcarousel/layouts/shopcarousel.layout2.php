<article <?php post_class(); ?> <?php echo $content_style;?>>
    <?php do_action('woocommerce_before_shop_loop_item'); ?>
    <?php if($show_image == '1') :?>
        <div class="cshero-image">
            <a href="<?php the_permalink(); ?>">
                <?php
                    do_action('woocommerce_before_shop_loop_item_title');
                ?>
            </a>
            <div class="overlay <?php echo $overlay_appear;?>" <?php echo $overlay_style;?>>
                <div class="overlay-content">
                    <?php if ($show_title == '1') { ?>
                        <div class="woo-title">
                        <<?php echo $item_heading_size; ?> class="woo-title">
                            <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" rel="" style="color: <?php echo esc_attr($item_title_color); ?>;">
                                <?php the_title(); ?>
                            </a>
                        </<?php echo $item_heading_size; ?>>
                        </div>
                    <?php } ?>
                    <?php if ( $show_category == '1'): ?>
                        <div class="woo-category">
                            <?php
                                $postid = get_the_ID();
                                $categories = get_the_term_list($postid, 'product_cat', '', ', ', '');
                            ?>
                            <span><?php print_r($categories); ?></span>  
                        </div>
                    <?php endif; ?>
                    
                    <?php if($show_description): ?>
                    <div class="woo-description">
                        <span>
                        <?php echo cshero_content_max_charlength(strip_tags(get_the_content()), $excerpt_length); ?>
                        </span>
                    </div>
                    <?php endif; ?>

                    <?php if ( $show_price == '1'): ?>
                    <h5 class="woo-price">
                        <?php
                            do_action('woocommerce_after_shop_loop_item_title_price');
                        ?>
                    </h5>
                    <?php endif; ?>
                    <?php if ($show_rate): ?>
                    <div class="woo-rate left">
                        <?php /* Load rating here*/
                        do_action('woocommerce_after_shop_loop_item_title_rating');
                        ?>
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
                    
                    <?php if($show_details_btn): ?> 
                    <div class="woo-view-detail">
                        <a class="<?php echo $button_type;?>" rel="" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo $view_details_btn_text; ?></a>
                    </div> 
                    <?php endif; ?>
                </div>
                <?php if ($show_add_to_cart == '1'): ?>
                    <div class="woo-add-to-cart">
                        <?php do_action( 'woocommerce_after_shop_loop_item' );   ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php else : ?>    
        <?php if ($show_title == '1') { ?>
            <div class="woo-title">
            <<?php echo $item_heading_size; ?> class="cs-title woo-title">
                <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" rel="" style="color: <?php echo esc_attr($item_title_color); ?>;">
                    <?php the_title(); ?>
                </a>
            </<?php echo $item_heading_size; ?>>
            </div>
        <?php } ?>
        <?php if ( $show_category == '1'): ?>
            <div class="woo-category">
                <?php
                    $postid = get_the_ID();
                    $categories = get_the_term_list($postid, 'product_cat', '', ', ', '');
                ?>
                <span><?php print_r($categories); ?></span>  
            </div>
        <?php endif; ?>

        <?php if($show_description): ?>
        <div class="woo-description">
            <span>
            <?php echo cshero_content_max_charlength(strip_tags(get_the_content()), $excerpt_length); ?>
            </span>
        </div>
        <?php endif; ?>

        <?php if ( $show_price == '1'): ?>
        <div class="woo-price">
            <?php
                do_action('woocommerce_after_shop_loop_item_title');
            ?>
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
        <?php if ($show_add_to_cart == '1'): ?>
            <div class="woo-add-to-cart">
                <?php do_action( 'woocommerce_after_shop_loop_item' ); ?> 
            </div>
        <?php endif; ?>
        <?php if($show_details_btn): ?> 
        <div class="woo-view-detail">
            <a class="<?php echo $button_type;?>" rel="" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo $view_details_btn_text; ?></a>
        </div> 
        <?php endif; ?>
    <?php endif; ?>  
    <h6 style="display:none;">&nbsp;</h6><?php /* this element for fix validator warning */ ?>
</article>