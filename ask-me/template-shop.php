<?php if (class_exists('woocommerce')) {
	/* Template Name: Shop */
	get_header();
	    $paged = (get_query_var("paged") != ""?(int)get_query_var("paged"):(get_query_var("page") != ""?(int)get_query_var("page"):1));
	    $args = array('post_type' => 'product','paged' => $paged, );
	    $wp_query = new WP_Query($args);
	    do_action('woocommerce_archive_description');
	    if (have_posts()) : ?>
	    	<div class="woocommerce-page">
	            <ul class = "products woocommerce_products products_grid clearfix">
	                <?php while (have_posts()) : the_post();
	                    woocommerce_get_template_part('content', 'product');
	                endwhile;?>
	            </ul>
	        </div>
	        <?php do_action('woocommerce_after_shop_loop');
	    elseif (!woocommerce_product_subcategories(array('before' => woocommerce_product_loop_start(false), 'after' => woocommerce_product_loop_end(false)))) :
	        woocommerce_get_template('loop/no-products-found.php');
	    endif;
	get_footer();
}