<?php 

$id = uniqid();

if (!empty($view_params['title'])) { ?>
    <h3 class="mk-fancy-title pattern-style"><span><?php echo $view_params['title']; ?></span>
    <a href="<?php echo esc_url( get_permalink( woocommerce_get_page_id( 'shop' ) ) ); ?>" class="mk-woo-view-all page-bg-color"><?php _e('VIEW ALL', 'mk_framework'); ?></a></h3>
<?php } ?>


<div class="mk-swipe-slideshow">
	<div id="mk-swiper-<?php echo $id; ?>"
		class="mk-swiper-container  js-el"
		data-mk-component='SwipeSlideshow'
		data-swipeSlideshow-config='{
		    "effect" : "slide",
		    "slide" : ".products > .item",
		    "slidesPerView" : 4,
		    "displayTime" : 6000,
		    "transitionTime" : 500,
		    "pauseOnHover": true,
            "fluidHeight" : "toHighest" }'>

	    <?php echo do_shortcode('['.($view_params['featured'] == 'false' ? 'recent_products' : 'featured_products').' 
	                                per_page="' . $view_params['per_page'] . '" 
	                                orderby="' . $view_params['orderby'] . '" 
	                                order="' . $view_params['order'] . '"]'); ?>

	</div>
	
</div>