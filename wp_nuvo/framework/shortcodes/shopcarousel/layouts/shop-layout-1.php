<div id="cs_carousel_product<?php echo esc_attr($date); ?>" class="cs-carousel cs-carousel-product <?php echo esc_attr($cl_show . ' ' . $style); ?> cs-shopcarousel-style-1-shop">
    <?php if ($title != "" || $description != "") { ?>
    <div class="cs-header <?php echo $heading_style;?>">
        <?php if ($title != "") { ?>
            <<?php echo $heading_size; ?> class="cs-title <?php echo $title_align;?>" style="color:<?php echo $title_color; ?>;">
                <span class="line"><?php echo esc_attr($title); ?></span>
            </<?php echo $heading_size; ?>>
        <?php } ?>
        <?php if ($subtitle !=""){ ?>
            <<?php echo $subtitle_heading_size; ?> class="cs-subtitle <?php echo $title_align;?>">
                <?php echo esc_attr($subtitle); ?>
            </<?php echo $subtitle_heading_size; ?>>
        <?php }?>
        <?php if ($description != "") { ?>
            <p class="cs-desc <?php echo $title_align;?>"><?php echo esc_attr($description); ?></p>
        <?php } ?>
    </div>
    <?php } ?>
    <div class="cs-content center">
        <div class="cs-carousel-product-list">
            <div id="cs_carousel_product_<?php echo esc_attr($date); ?>" data-moveslides="5" data-auto="<?php echo esc_attr($auto_scroll); ?>" data-prevselector="#cs_carousel_product<?php echo esc_attr($date); ?> .prev" data-nextselector="#cs_carousel_product<?php echo esc_attr($date); ?> .next"  data-touchenabled="1" data-controls="true" data-pager="<?php echo $show_pager;?>" data-pause="4000" data-infiniteloop="true" data-adaptiveheight="true" data-speed="<?php echo esc_attr($speed); ?>" data-autohover="true" data-slidemargin="<?php echo esc_attr($margin_item); ?>" data-maxslides="5" data-minslides="1" data-slidewidth="<?php echo esc_attr($width_item);?>" data-slideselector="" data-easing="swing" data-usecss="" data-resize="1" class="slider jm-bxslider">
                <?php
                    $counter = 0;
                    while ($products->have_posts()) : $products->the_post();
                    $counter++;
                    ?>
                    <?php
                    global $product;

                    // Ensure visibility
                    if (!$product || !$product->is_visible())
                        return;

                    // Extra post classes
                    $classes = array();

                    $classes[] = 'cs-carousel-item-wrap';
                    if($rows == 1){
                        echo '<div class="cs-carousel-item-full">';
                    }else{
                        if($counter % $rows == 1){
                            echo '<div class="cs-carousel-item-full">';
                        }
                    }

                    ?>
                    <div <?php post_class($classes); ?> <?php if(!$counter % $rows == 0) echo 'style="margin-bottom:'.$margin_item.'px;"'; ?>>
                        <div class="cs-carousel-item">
                            <?php do_action('woocommerce_before_shop_loop_item'); ?>
                            <?php if($show_image == '1') :?>
                                <div class="woo-image" >
                                    <a href="<?php the_permalink(); ?>">
                                        <?php
                                            do_action('woocommerce_before_shop_loop_item_title');
                                        ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <div class="woo-view-detail">
                                <a class="btn view-detail" rel="" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span><?php esc_html_e('View Detail', 'wp_nuvo'); ?></span></a>
                            </div>

                            <?php if ($show_add_to_cart == '1'): ?>
                            <div class="woo-add-to-cart">
                                <?php do_action( 'woocommerce_after_shop_loop_item' );   ?>
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
                            <div class="woo-price primary-color">
                                <?php
                                do_action('woocommerce_after_shop_loop_item_title');
                                ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php
                if($rows == 1){
                    echo '</div>';
                }else{
                    if($counter % $rows == 0){
                        echo '</div>';
                    }
                }
                endwhile; // end of the loop.
                ?>
            </div>
            <?php if($morelink!=''):?>
            <div class="cs-morelink"><a href="<?php echo $morelink;?>" class="" ><?php echo $moretext;?></a></div>
            <?php endif;?>
        </div>
        <?php if ($show_nav == '1') { ?>
        <div class="cs-nav">
            <ul>
                <li class="prev"></li>
                <li class="next"></li>
            </ul>
        </div>
        <?php } ?>
    </div>
</div>
