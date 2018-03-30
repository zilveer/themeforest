<?php
global $wp_query;	
$image_width = get_option('product_image_width');
/*
 * Most functions called in this page can be found in the wpsc_query.php file
 */
?>
<div id="default_products_page_container" class="wrap wpsc_container">
<?php wpsc_output_breadcrumbs(); ?>
	<?php do_action('wpsc_top_of_products_page'); // Plugin hook for adding things to the top of the products page, like the live search ?>
<?php // */ ?>
	
	<?php if(wpsc_display_products()): ?>
		<ul class="wpsc_categories"><?php 
        
        while (wpsc_have_products()) :  wpsc_the_product(); ?><li><div class="default_products_display product_view_<?php echo wpsc_the_product_id(); ?> <?php echo wpsc_category_class(); ?> group">   
				<div class="product-meta">
                    <div class="imagecol"><a rel="<?php echo wpsc_the_product_title(); ?>" class="<?php echo wpsc_the_product_image_link_classes(); ?>" href="<?php echo wpsc_the_product_image(); ?>"><img src="<?php echo wpsc_the_product_thumbnail(191,191); ?>" alt="<?php echo wpsc_the_product_title(); ?>" id="product_image_<?php echo wpsc_the_product_id(); ?>" class="product_image"></a></div>
                    <div class="wpsc_product_price "><?php
                    if(wpsc_product_on_special()) { ?><span class="sale-icon">Sale!</span><?php }
                    
                    ?><span class="pricedisplay sale-price" id="product_price_<?php echo wpsc_the_product_id(); ?>"><?php echo wpsc_the_product_price(); ?></span></div>
                </div>
                <div class="producttext productcol">
                    <h2 class="prodtitles"><a href="<?php echo wpsc_the_product_permalink(); ?>" class="wpsc_product_title"><?php echo wpsc_the_product_title(); ?></a></h2>
                    <div class="wpsc_description"><?php echo wpsc_the_product_description(); ?></div>
                </div></div></li>
		<?php endwhile; ?>
		
	</ul>
    <?php if(wpsc_has_pages_bottom()) : ?>
            <div class="clear"></div>
            <div class="wpsc_page_numbers_bottom">
                <?php wpsc_pagination(); ?>
            </div>
        <?php endif; ?>
    <?php endif; ?></div>
