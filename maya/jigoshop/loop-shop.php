<?php

global $columns, $post, $per_page, $wp_query, $paged, $products_style;

do_action('jigoshop_before_shop_loop');

$loop = 0;                                   

$title_position = yiw_get_option( 'shop_title_position' );
if ( ! isset( $products_style ) )    
    $products_style = yiw_get_option( 'shop_products_style', 'ribbon' );
$style = $products_style;

$class_li = array('product');

if ( ! yiw_get_option( 'shop_show_price' ) )
   $class_li[] = 'hide-price';

if ( $style == 'traditional' ) {
    if ( yiw_get_option( 'shop_border_thumbnail' ) )
       $class_li[] = 'border';
    if ( yiw_get_option( 'shop_shadow_thumbnail' ) )
       $class_li[] = 'shadow';
    if ( ! yiw_get_option( 'shop_show_button_details' ) )
       $class_li[] = 'hide-details-button';
    if ( ! yiw_get_option( 'shop_show_button_add_to_cart' ) )
       $class_li[] = 'hide-add-to-cart-button';
}                                              
if ( $style == 'ribbon' )
    $title_position = 'below-thumb';

if ( ! isset( $columns )  || empty( $columns ) )  $columns  = apply_filters('loop_shop_columns', 4);
if ( ! isset( $per_page ) || empty( $per_page ) ) $per_page = apply_filters('loop_shop_per_page', yiw_get_option('shop_products_per_page')); 

$rows = ceil( $per_page / $columns );

if ($per_page >= yiw_get_option('shop_products_per_page')) query_posts( array_merge( $wp_query->query, array( 'posts_per_page' => $per_page, 'paged' => $paged ) ) );

ob_start();

if (have_posts()) : while (have_posts()) : the_post(); $_product = new jigoshop_product( $post->ID ); $loop++;

    $loop_class_li = $class_li;
    
    if ($loop%$columns==0) 
        $loop_class_li[] = 'last';

    if (($loop-1)%$columns==0) 
        $loop_class_li[] = 'first';
    
    if ( $loop > (($rows-1)*$columns) )
        $loop_class_li[] = 'last-row';             
        
    if ( ! empty( $loop_class_li ) )
        $class = ' class="' . implode( ' ', $loop_class_li ) . '"';
    else
        $class = '';
	
	?>
	<li<?php echo $class; ?>>
		
		<?php do_action('jigoshop_before_shop_loop_item'); ?>
		
		<a href="<?php the_permalink(); ?>">
			
			 <div class="thumbnail">
    			<?php do_action('jigoshop_before_shop_loop_item_title', $post, $_product); ?>
    			
    			<div class="thumb-shadow"></div>
    			
    			<strong class="<?php echo $title_position ?>"><?php the_title(); ?></strong>
    		</div>
			
			<?php do_action('jigoshop_after_shop_loop_item_title', $post, $_product); ?>
		
		</a>

		<?php do_action('jigoshop_after_shop_loop_item', $post, $_product); ?>
		
	</li><?php 
	
	if ($loop==$per_page) break;
	
endwhile; endif;

if ($loop==0) :

	echo '<p class="info">'.__('No products found which match your selection.', 'jigoshop').'</p>'; 
	
else :
	
	$found_posts = ob_get_clean();

	echo '<ul class="products ' . $style . '">' . $found_posts . '</ul><div class="clear"></div>';   
	
endif;              

do_action('jigoshop_after_shop_loop');