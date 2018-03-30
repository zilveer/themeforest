<?php 
    if(function_exists('woocommerce_get_page_id')) $page_for_shop = woocommerce_get_page_id( 'shop' );
    $page_id = get_the_ID();
    if(class_exists('WooCommerce') && ( is_shop() || is_product_category() || is_product_tag() )) {
    	$page_id = $page_for_shop;
    }
	$ht = $class = ''; 
	$ht = apply_filters('custom_header_filter',$ht);  
	$hstrucutre = etheme_get_header_structure($ht); 
	$page_slider = etheme_get_custom_field('page_slider', $page_id);

	if (is_home() && get_option('page_for_posts') !='') {
		$page_slider = etheme_get_custom_field('page_slider', get_option('page_for_posts'));
	}
	
	if($page_slider != '' && $page_slider != 'no_slider' && ($ht == 2 || $ht == 3 || $ht == 5)) {
		$class = 'slider-overlap';
	}
	if(etheme_get_option('header_transparent')) {
		$class .= ' header-transparent';
	}

?>

<div class="header-wrapper header-type-<?php echo $ht.' '.$class; ?>">
	<?php get_template_part('headers/parts/top-bar', $hstrucutre); ?>
	<header class="header main-header">
		<div class="container">	
			<div class="navbar" role="navigation">
				<div class="container-fluid">
					<div id="st-trigger-effects" class="column">
						<button data-effect="mobile-menu-block" class="menu-icon"></button>
					</div>
					<div class="tbs blog-description"><span><?php echo etheme_get_option('header_custom_block'); ?></span></div>
					
					<div class="header-logo">
						<?php etheme_logo(); ?>
					</div>
					
					<div class="clearfix visible-md visible-sm visible-xs"></div>

					<div class="navbar-header navbar-right">
						<div class="navbar-right">
				            <?php if(class_exists('Woocommerce') && !etheme_get_option('just_catalog') && etheme_get_option('cart_widget')): ?>
			                    <?php etheme_top_cart(); ?>
				            <?php endif ;?>
							<?php if(etheme_get_option('search_form')): ?>
								<?php etheme_search_form(); ?>
							<?php endif; ?>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</div>
		</div>	
		<div class="menu-wrapper">
			<div class="container">
				<div class="collapse navbar-collapse">
					<?php et_get_main_menu(); ?>
				</div>
			</div><!-- /.navbar-collapse -->
		</div>
	</header>
</div>