<?php 
/*
Template Name: WooCommerce
*/ 
?>
<?php

$id = get_option('woocommerce_shop_page_id');
$shop = get_post($id);
$sidebar = suprema_qodef_sidebar_layout();

if(get_post_meta($id, 'qode_page_background_color', true) != ''){
	$background_color = 'background-color: '.esc_attr(get_post_meta($id, 'qode_page_background_color', true));
}else{
	$background_color = '';
}

$content_style = '';
if(get_post_meta($id, 'qode_content-top-padding', true) != '') {
	if(get_post_meta($id, 'qode_content-top-padding-mobile', true) == 'yes') {
		$content_style = 'padding-top:'.esc_attr(get_post_meta($id, 'qode_content-top-padding', true)).'px !important';
	} else {
		$content_style = 'padding-top:'.esc_attr(get_post_meta($id, 'qode_content-top-padding', true)).'px';
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

suprema_qodef_get_title();
get_template_part('slider');

$full_width = false;

if ( suprema_qodef_options()->getOptionValue('qodef_woo_products_list_full_width') == 'yes' && !is_singular('product') ) {
	$full_width = true;
}

if ( $full_width ) { ?>
	<div class="qodef-full-width" <?php suprema_qodef_inline_style($background_color); ?>>
<?php } else { ?>
	<div class="qodef-container" <?php suprema_qodef_inline_style($background_color); ?>>
<?php }
		if ( $full_width ) { ?>
			<div class="qodef-full-width-inner" <?php suprema_qodef_inline_style($content_style); ?>>
		<?php } else { ?>
			<div class="qodef-container-inner clearfix" <?php suprema_qodef_inline_style($content_style); ?>>
		<?php }

			//Woocommerce content
			if ( ! is_singular('product') ) {

				switch( $sidebar ) {

					case 'sidebar-33-right': ?>
						<div class="qodef-two-columns-66-33 grid2 qodef-woocommerce-with-sidebar clearfix">
							<div class="qodef-column1">
								<div class="qodef-column-inner">
									<?php suprema_qodef_woocommerce_content(); ?>
								</div>
							</div>
							<div class="qodef-column2">
								<?php get_sidebar();?>
							</div>
						</div>
					<?php
						break;
					case 'sidebar-25-right': ?>
						<div class="qodef-two-columns-75-25 grid2 qodef-woocommerce-with-sidebar clearfix">
							<div class="qodef-column1 qodef-content-left-from-sidebar">
								<div class="qodef-column-inner">
									<?php suprema_qodef_woocommerce_content(); ?>
								</div>
							</div>
							<div class="qodef-column2">
								<?php get_sidebar();?>
							</div>
						</div>
					<?php
						break;
					case 'sidebar-33-left': ?>
						<div class="qodef-two-columns-33-66 grid2 qodef-woocommerce-with-sidebar clearfix">
							<div class="qodef-column1">
								<?php get_sidebar();?>
							</div>
							<div class="qodef-column2">
								<div class="qodef-column-inner">
									<?php suprema_qodef_woocommerce_content(); ?>
								</div>
							</div>
						</div>
					<?php
						break;
					case 'sidebar-25-left': ?>
						<div class="qodef-two-columns-25-75 grid2 qodef-woocommerce-with-sidebar clearfix">
							<div class="qodef-column1">
								<?php get_sidebar();?>
							</div>
							<div class="qodef-column2 qodef-content-right-from-sidebar">
								<div class="qodef-column-inner">
									<?php suprema_qodef_woocommerce_content(); ?>
								</div>
							</div>
						</div>
					<?php
						break;
					default:
						suprema_qodef_woocommerce_content();
				}

			} else {
				suprema_qodef_woocommerce_content();
			} ?>

			</div>
	</div>
<?php get_footer(); ?>
