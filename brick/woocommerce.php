<?php 
/*
Template Name: WooCommerce
*/ 
?>
<?php 
global $woocommerce;
global $qode_options;
$id = get_option('woocommerce_shop_page_id');
$shop = get_post($id);
$sidebar = get_post_meta($id, "qode_show-sidebar", true);

if(get_post_meta($id, "qode_page_background_color", true) != ""){
	$background_color = 'background-color: '.esc_attr(get_post_meta($id, "qode_page_background_color", true));
}else{
	$background_color = "";
}

$content_style = "";
if(get_post_meta($id, "qode_content-top-padding", true) != ""){
	if(get_post_meta($id, "qode_content-top-padding-mobile", true) == 'yes'){
		$content_style = "padding-top:".esc_attr(get_post_meta($id, "qode_content-top-padding", true))."px !important";
	}else{
		$content_style = "padding-top:".esc_attr(get_post_meta($id, "qode_content-top-padding", true))."px";
	}
}

if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }

?>
	<?php 
		get_header(); 
		$id = get_option('woocommerce_shop_page_id');
	?>
		<?php if(get_post_meta($id, "qode_page_scroll_amount_for_sticky", true)) { ?>
			<script>
			var page_scroll_amount_for_sticky = <?php echo esc_attr(get_post_meta($id, "qode_page_scroll_amount_for_sticky", true)); ?>;
			</script>
		<?php } ?>
        <?php get_template_part( 'title' ); ?>
		<?php get_template_part('slider'); ?>

		<?php if(isset($qode_options['woo_products_enable_full_width_template'])&& $qode_options['woo_products_enable_full_width_template']=="yes" && !is_singular('product')){ ?>
			<div class="full_width"<?php qode_inline_style($background_color); ?>>
		<?php } else{ ?>	
		<div class="container"<?php qode_inline_style($background_color); ?>>
		<?php } ?>	
			
		<?php if($qode_options['overlapping_content'] == 'yes') {?>
			<div class="overlapping_content"><div class="overlapping_content_inner">
		<?php } ?>
		<?php if(isset($qode_options['woo_products_enable_full_width_template'])&& $qode_options['woo_products_enable_full_width_template']=="yes" && !is_singular('product')){ ?>			
			<div class="full_width_inner" <?php qode_inline_style($content_style); ?>>
		<?php } else{ ?>
			<div class="container_inner default_template_holder clearfix" <?php qode_inline_style($content_style); ?>>			
		<?php } ?>		
				<?php if(!is_singular('product')) { ?>
					<?php if(($sidebar == "default")||($sidebar == "")) : ?>
						<?php qode_woocommerce_content(); ?>
					<?php elseif($sidebar == "1" || $sidebar == "2"): ?>		
					<?php global $woocommerce_loop;
			        	$woocommerce_loop['columns'] = 3;
			        ?>
					<?php if($sidebar == "1") : ?>
						<div class="two_columns_66_33 grid2 woocommerce_with_sidebar clearfix">
							<div class="column1">
					<?php elseif($sidebar == "2") : ?>
						<div class="two_columns_75_25 grid2 woocommerce_with_sidebar clearfix">
							<div class="column1 content_left_from_sidebar">
					<?php endif; ?>
								<div class="column_inner">
									<?php qode_woocommerce_content(); ?>
								</div>
							</div>
							<div class="column2"><?php get_sidebar();?></div>
						</div>
					<?php elseif($sidebar == "3" || $sidebar == "4"): ?>
						<?php global $woocommerce_loop;
				        	$woocommerce_loop['columns'] = 3;
				        ?>
						<?php if($sidebar == "3") : ?>
							<div class="two_columns_33_66 grid2 woocommerce_with_sidebar clearfix">
								<div class="column1"><?php get_sidebar();?></div>
								<div class="column2">
						<?php elseif($sidebar == "4") : ?>
							<div class="two_columns_25_75 grid2 woocommerce_with_sidebar clearfix">
								<div class="column1"><?php get_sidebar();?></div>
								<div class="column2 content_right_from_sidebar">
						<?php endif; ?>
									<div class="column_inner">
										<?php qode_woocommerce_content(); ?>
									</div>
								</div>
							</div>
					<?php endif; ?>
                <?php } else { 
                      qode_woocommerce_content();
                } ?>
			</div>
			<?php if($qode_options['overlapping_content'] == 'yes') {?>
				</div></div>
			<?php } ?>
		</div>
	<?php get_footer(); ?>