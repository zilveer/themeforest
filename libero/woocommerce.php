<?php 
/*
Template Name: WooCommerce
*/ 
?>
<?php

global $woocommerce;

$id = get_option('woocommerce_shop_page_id');
$shop = get_post($id);
$sidebar = libero_mikado_sidebar_layout();

if(get_post_meta($id, 'mkd_page_background_color', true) != ''){
	$background_color = 'background-color: '.esc_attr(get_post_meta($id, 'mkd_page_background_color', true));
}else{
	$background_color = '';
}

$content_style = '';
if(get_post_meta($id, 'mkd_content-top-padding', true) != '') {
	if(get_post_meta($id, 'mkd_content-top-padding-mobile', true) == 'yes') {
		$content_style = 'padding-top:'.esc_attr(get_post_meta($id, 'mkd_content-top-padding', true)).'px !important';
	} else {
		$content_style = 'padding-top:'.esc_attr(get_post_meta($id, 'mkd_content-top-padding', true)).'px';
	}
}

if ( get_query_var('paged') ) {
	$paged = get_query_var('paged');
} elseif ( get_query_var('page') ) {
	$paged = get_query_var('page');
} else {
	$paged = 1;
}

get_header();

libero_mikado_get_title();
get_template_part('slider');

$full_width = false;

if ( libero_mikado_options()->getOptionValue('mkd_woo_products_list_full_width') == 'yes' && !is_singular('product') ) {
	$full_width = true;
}

if ( $full_width ) { ?>
	<div class="mkd-full-width" <?php libero_mikado_inline_style($background_color); ?>>
<?php } else { ?>
	<div class="mkd-container" <?php libero_mikado_inline_style($background_color); ?>>
<?php }
		if ( $full_width ) { ?>
			<div class="mkd-full-width-inner" <?php libero_mikado_inline_style($content_style); ?>>
		<?php } else { ?>
			<div class="mkd-container-inner clearfix" <?php libero_mikado_inline_style($content_style); ?>>
		<?php }

			//Woocommerce content
			if ( ! is_singular('product') ) {
				if(($sidebar == 'default')||($sidebar == '')) :
					libero_mikado_woocommerce_content();
					do_action('libero_mikado_page_after_content');
				elseif($sidebar == 'sidebar-33-right' || $sidebar == 'sidebar-25-right'): ?>
					<div <?php echo libero_mikado_sidebar_columns_class(); ?>>
						<div class="mkd-column1 mkd-content-left-from-sidebar mkd-woocommerce-with-sidebar">
							<div class="mkd-column-inner">
								<?php libero_mikado_woocommerce_content(); ?>
								<?php do_action('libero_mikado_page_after_content'); ?>
							</div>
						</div>
						<div class="mkd-column2">
							<?php get_sidebar(); ?>
						</div>
					</div>
				<?php elseif($sidebar == 'sidebar-33-left' || $sidebar == 'sidebar-25-left'): ?>
					<div <?php echo libero_mikado_sidebar_columns_class(); ?>>
						<div class="mkd-column1">
							<?php get_sidebar(); ?>
						</div>
						<div class="mkd-column2 mkd-content-right-from-sidebar mkd-woocommerce-with-sidebar">
							<div class="mkd-column-inner">
								<?php libero_mikado_woocommerce_content(); ?>
								<?php do_action('libero_mikado_page_after_content'); ?>
							</div>
						</div>
					</div>
				<?php endif;
			} else {
				libero_mikado_woocommerce_content();
			} ?>

			</div>
	</div>
<?php get_footer(); ?>
