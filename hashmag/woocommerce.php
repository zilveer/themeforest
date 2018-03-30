<?php 
/*
Template Name: WooCommerce
*/ 
?>
<?php

$id = get_option('woocommerce_shop_page_id');
$shop = get_post($id);
$sidebar = hashmag_mikado_sidebar_layout();

if(get_post_meta($id, 'mkdf_page_background_color_meta', true) != ''){
	$background_color = 'background-color: '.esc_attr(get_post_meta($id, 'mkdf_page_background_color_meta', true));
}else{
	$background_color = '';
}

$content_style = '';
if(get_post_meta($id, 'mkdf_page_content_top_padding', true) != '') {
	if(get_post_meta($id, 'mkdf_page_content_top_padding_mobile', true) == 'yes') {
		$content_style = 'padding-top:'.esc_attr(get_post_meta($id, 'mkdf_page_content_top_padding', true)).'px !important';
	} else {
		$content_style = 'padding-top:'.esc_attr(get_post_meta($id, 'mkdf_page_content_top_padding', true)).'px';
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
hashmag_mikado_get_title();
get_template_part('slider');
?>

<div class="mkdf-container" <?php hashmag_mikado_inline_style($background_color); ?>>
	<div class="mkdf-container-inner clearfix" <?php hashmag_mikado_inline_style($content_style); ?>>
		<?php
			//Woocommerce content
			if ( ! is_singular('product') ) {

				switch( $sidebar ) {
					case 'sidebar-33-right': ?>
						<div class="mkdf-two-columns-66-33 mkdf-content-has-sidebar mkdf-woocommerce-with-sidebar clearfix">
							<div class="mkdf-column1">
								<div class="mkdf-column-inner">
									<?php hashmag_mikado_woocommerce_content(); ?>
								</div>
							</div>
							<div class="mkdf-column2">
								<?php get_sidebar();?>
							</div>
						</div>
					<?php
						break;
					case 'sidebar-25-right': ?>
						<div class="mkdf-two-columns-75-25 mkdf-content-has-sidebar mkdf-woocommerce-with-sidebar clearfix">
							<div class="mkdf-column1 mkdf-content-left-from-sidebar">
								<div class="mkdf-column-inner">
									<?php hashmag_mikado_woocommerce_content(); ?>
								</div>
							</div>
							<div class="mkdf-column2">
								<?php get_sidebar();?>
							</div>
						</div>
					<?php
						break;
					case 'sidebar-33-left': ?>
						<div class="mkdf-two-columns-33-66 mkdf-content-has-sidebar mkdf-woocommerce-with-sidebar clearfix">
							<div class="mkdf-column1">
								<?php get_sidebar();?>
							</div>
							<div class="mkdf-column2">
								<div class="mkdf-column-inner">
									<?php hashmag_mikado_woocommerce_content(); ?>
								</div>
							</div>
						</div>
					<?php
						break;
					case 'sidebar-25-left': ?>
						<div class="mkdf-two-columns-25-75 mkdf-content-has-sidebar mkdf-woocommerce-with-sidebar clearfix">
							<div class="mkdf-column1">
								<?php get_sidebar();?>
							</div>
							<div class="mkdf-column2 mkdf-content-right-from-sidebar">
								<div class="mkdf-column-inner">
									<?php hashmag_mikado_woocommerce_content(); ?>
								</div>
							</div>
						</div>
					<?php
						break;
					default:
						hashmag_mikado_woocommerce_content();
				}

			} else {
				hashmag_mikado_woocommerce_content();
			} ?>

			</div>
	</div>
<?php get_footer(); ?>