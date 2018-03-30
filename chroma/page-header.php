<div class="page_title <?php if(get_theme_mod("t2t_customizer_page_header_background_repeat") == "stretch") { echo "backstretch"; } ?>" data-background-image="<?php echo get_theme_mod("t2t_customizer_page_header_background"); ?>">
<h2>
<?php

	// If frontpage is not set
	if(is_front_page() && get_option('page_for_posts', true) == 0 || get_post_type(get_the_ID()) == "post" && is_single()) {
		echo __('Blog', 'framework');
	}
	elseif(is_attachment()) {
		echo "attache";
	}
	// Is page
	elseif(get_option('page_for_posts', true) == get_queried_object_id()) {
		echo get_the_title(get_option('page_for_posts', true));
	} 
	// Is woocommerce
	elseif(class_exists('woocommerce') && is_shop() && get_option('woocommerce_shop_page_id')) {
		echo get_the_title(get_option('woocommerce_shop_page_id'));
	} 
	else {
		echo get_the_title();
	}

?>
</h2>

</div>