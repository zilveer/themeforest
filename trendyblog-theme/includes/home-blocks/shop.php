<?php 
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    if (df_is_woocommerce_activated() == true) { // Exit if woocommerce isn't active
    $DF_builder = new DF_home_builder; 
    //get block data
    $data = $DF_builder->get_data(); 
    //set query
    $my_query = $data[0]; 
    //extract array data
    extract($data[1]); 

    $post_count = $my_query->post_count;
    $counter = 1;
?>
    <?php if($title) { ?>
        <div class="panel_title">
            <div>
                <h4>
                    <?php if($link) { ?>
                        <a href="<?php echo esc_url($link);?>">
                    <?php } ?>
                        <?php echo esc_html__($title);?>
                    <?php if($link) { ?>
                        </a>
                    <?php } ?>
                </h4>
            </div>
        </div>
    <?php } ?>
    <!-- Products -->
    <ul class="products clearfix">
        <?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
        <?php 
            $DF_builder->set_double($my_query->post->ID);
            $image = get_post_thumb($my_query->post->ID,0,0); 
            global $product;
        ?>
            <li class="product<?php if($counter==1) { ?> first<?php } else if($counter==$post_count || $counter%4==0) { ?> last<?php } ?>">
                <!-- Thumb -->
                <div class="item_thumb">
                    <?php if( $product && $product->is_on_sale()) { ?>
                         <span class="onsale"><?php esc_html_e("Sale!", THEME_NAME);?></span>
                    <?php } ?>
                    <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                    <div class="thumb_icon">
                        <a href="<?php the_permalink();?>"><i class="fa fa-copy"></i></a>
                    </div>
                    <div class="thumb_hover">
                        <a href="<?php the_permalink();?>">
                            <?php echo df_image_html($my_query->post->ID,325,325);?>
                        </a>
                    </div>
                </div><!-- End Thumb -->
                <!-- Info -->
                <div class="info">
                    <?php
                        if( $product && $product->get_rating_html()) { 
                            echo balanceTags($product->get_rating_html(), true);
                        } 
                    ?>
                    <?php if( $product && $product->get_price_html()) { ?>
                        <span class="price"><?php echo balanceTags($product->get_price_html(), true);?></span>
                    <?php } ?>
                </div><!-- End Info -->
                <?php  woocommerce_template_loop_add_to_cart(); ?>
            </li><!-- End Product -->
            <?php $counter++;?>
        <?php endwhile; ?>
        <?php endif; ?>
    </ul><!-- End Products -->
<?php } else { esc_html_e("Please set up WooCommerce Plugin", THEME_NAME); } ?>