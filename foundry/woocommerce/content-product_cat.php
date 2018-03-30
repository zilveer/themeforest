<?php
	/**
	 * @package Foundry
	 * @author TommusRhodus
	 * @version 3.0.0
	 */
	$layout = get_option('foundry_shop_layout', 'sidebar-right');
	
	if( '4col' == $layout ){
		$class = 'col-md-3 col-sm-4 masonry-item col-xs-12';	
	} elseif( '3col' == $layout ){
		$class = 'col-md-4 col-sm-4 masonry-item col-xs-12';	
	} elseif( '2col' == $layout ){
		$class = 'col-md-6 col-sm-4 masonry-item col-xs-12';	
	} elseif( 'sidebar-left' == $layout || 'sidebar-right' == $layout ){
		$class = 'col-md-4 col-sm-4 masonry-item col-xs-12';	
	}
?>

<div class="<?php echo esc_attr($class); ?>">
    <div class="image-tile outer-title text-center">
    	
    	<?php do_action( 'woocommerce_before_subcategory', $category ); ?>
    	
        <a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
            <?php
            	/**
            	 * woocommerce_before_subcategory_title hook
            	 *
            	 * @hooked woocommerce_subcategory_thumbnail - 10
            	 */
            	do_action( 'woocommerce_before_subcategory_title', $category );
            ?>
        </a>
        
        <div class="title">
            <h5 class="mb0"><?php echo $category->name; ?></h5>
            <span class="display-block mb16">
            	<?php 
            		if ( $category->count > 0 )
            			echo apply_filters( 'woocommerce_subcategory_count_html', $category->count, $category );
            	?>
            </span>
            <?php
        		/**
        		 * woocommerce_after_subcategory_title hook
        		 */
        		do_action( 'woocommerce_after_subcategory_title', $category );
        		
        		do_action( 'woocommerce_after_subcategory', $category );
        	?>
        </div>
        
    </div>
</div>
