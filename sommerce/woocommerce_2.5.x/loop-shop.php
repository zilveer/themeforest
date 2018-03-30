<?php

global $woocommerce_loop, $content_width;

do_action('woocommerce_before_shop_loop');

$woocommerce_loop['loop'] = 0;
$woocommerce_loop['show_products'] = true;    
	
$class_li = array('product');
if ( yiw_get_option( 'shop_border_thumbnail' ) )
   $class_li[] = 'border';
if ( yiw_get_option( 'shop_shadow_thumbnail' ) )
   $class_li[] = 'shadow';
if ( ! yiw_get_option( 'shop_show_price' ) )
   $class_li[] = 'hide-price';
if ( ! yiw_get_option( 'shop_show_button_details' ) )
   $class_li[] = 'hide-details-button';
if ( ! yiw_get_option( 'shop_show_button_add_to_cart' ) )
   $class_li[] = 'hide-add-to-cart-button';

$title_position = yiw_get_option( 'shop_title_position' ); 

$n_cols = floor( $content_width / ( yiw_shop_thumbnail_w() + 10 ) );

if (!isset($woocommerce_loop['columns']) || !$woocommerce_loop['columns']) $woocommerce_loop['columns'] = apply_filters('loop_shop_columns', $n_cols);

ob_start();

do_action('woocommerce_before_shop_loop_products');

if ($woocommerce_loop['show_products'] && have_posts()) : while (have_posts()) : the_post(); 
	
	global $product;
	
	if (!$product->is_visible()) continue; 
	
	$woocommerce_loop['loop']++;

    $loop_class_li = $class_li;
    
    $loop_class_li[] = 'product';
    
    if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ==0 )
        $loop_class_li[] = 'last';      
        
    if ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 )
        $loop_class_li[] = 'first';                 
        
    if ( ! empty( $loop_class_li ) )
        $class = ' class="' . implode( ' ', $loop_class_li ) . '"';
    else
        $class = '';
	
	?>
	<li<?php echo $class; ?>>
	
	    <?php do_action('woocommerce_before_shop_loop_item'); ?>
			
		<a href="<?php the_permalink(); ?>">
			
			<div class="thumbnail">
    			<?php do_action('woocommerce_before_shop_loop_item_title'); ?>
    		
    			<div class="thumb-shadow"></div>
    			
    			<strong class="<?php echo $title_position ?>"><?php the_title(); ?></strong>
    		</div>
			
			<?php do_action('woocommerce_after_shop_loop_item_title'); ?>
		
		</a>

		<?php do_action('woocommerce_after_shop_loop_item'); ?>
		
	</li><?php 
	
endwhile; endif;

if ($woocommerce_loop['loop']==0) :

	echo '<p class="info">'.__('No products found which match your selection.', 'jigoshop').'</p>'; 
	
else :
	
	$found_posts = ob_get_clean();
	
	echo '<ul class="products">' . $found_posts . '</ul><div class="clear"></div>';   
	
endif;              

do_action('woocommerce_after_shop_loop');