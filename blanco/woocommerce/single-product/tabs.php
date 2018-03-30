<?php
/**
 * Single Product Tabs
 */

// Get tabs
global $woocommerce, $post, $product;
$show_attr = ( get_option( 'woocommerce_enable_dimension_product_attributes' ) == 'yes' ? true : false );
?>
        
<ul id="tabs" class="product-tabs">
    <?php if ( $post->post_content ) : ?>
        <li><a href="#"><?php _e('Description', ETHEME_DOMAIN); ?></a>
        <section>
    		<?php $heading = apply_filters('woocommerce_product_description_heading', __('Product Description', ETHEME_DOMAIN)); ?>
    		
    		<h3><?php echo $heading; ?></h3>
    		
    		<?php the_content(); ?>
        </section>
        </li>
    <?php endif; ?>
    
    <?php if ( $product->has_attributes() || ( $show_attr && $product->has_dimensions() ) || ( $show_attr && $product->has_weight() ) ) { ?>
        <li><a href="#"><?php _e('Additional Information', ETHEME_DOMAIN); ?></a>
            <section>
        		<?php $heading = apply_filters('woocommerce_product_additional_information_heading', __('Additional Information', ETHEME_DOMAIN)); ?>
        
        		<h3><?php echo $heading; ?></h3>
        
        		<?php $product->list_attributes(); ?>
            </section>
        </li>
    <?php } ?>
    
    <?php if ( comments_open() ) { ?>
        <li class="reviews_tab"><a href="#"><?php _e('Reviews', ETHEME_DOMAIN); ?><?php echo comments_number(' (0)', ' (1)', ' (%)'); ?></a>
            <section>
                <?php comments_template(); ?>
            </section>
        </li>
    <?php } ?>

	<?php if ( etheme_get_custom_field('_etheme_custom_tab1') && etheme_get_custom_field('_etheme_custom_tab1_title') ) : ?>
        <li><a href="#"><?php etheme_custom_field('_etheme_custom_tab1_title'); ?></a>
            <section>
                <?php echo do_shortcode(etheme_get_custom_field('_etheme_custom_tab1')) ?>
            </section>
        </li>  
	<?php endif; ?>	
	<?php if ( etheme_get_custom_field('_etheme_custom_tab2') && etheme_get_custom_field('_etheme_custom_tab2_title') ) : ?>
        <li><a href="#"><?php etheme_custom_field('_etheme_custom_tab2_title'); ?></a>
            <section>
                <?php echo do_shortcode(etheme_get_custom_field('_etheme_custom_tab2')) ?>
            </section>
        </li>  
	<?php endif; ?>	
    
	<?php if (etheme_get_option('custom_tab') && etheme_get_option('custom_tab') != '' ) : ?>
        <li><a href="#"><?php  etheme_option('custom_tab_title'); ?></a>
            <section>
                <?php  echo do_shortcode(etheme_get_option('custom_tab')); ?>
            </section>
        </li>  
	<?php endif; ?>	 
</ul>
<div class="clear"></div>
