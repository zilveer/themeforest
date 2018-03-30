<?php get_header(); 

// Layout
$options_ibuki = get_option('ibuki');
$shop_type = $options_ibuki['shop_type'];
$shop_container = $options_ibuki['shop_container'];

$single_container = $options_ibuki['shop_single_product_container'];

$header_type = $options_ibuki['header-type'];
$header_layout = $options_ibuki['header-container'];
$header_container = null;

if($header_type == 'header-normal' || $header_type == 'header-fixed' || $header_type == 'header-sticky' ) {
    $header_container = $shop_container;
} else {
	$header_container = 'container-fluid';
}

$woocommerceGetLayout = (!empty($options_ibuki['select-loop-columns'])) ? $options_ibuki['select-loop-columns'] : '3'; 

if (!function_exists('loop_columns')) {
	function loop_columns() {
		$options_ibuki = get_option('ibuki');

		$woocommerceLoopColumns = (!empty($options_ibuki['select-loop-columns'])) ? $options_ibuki['select-loop-columns'] : '3'; 
		
		if($woocommerceLoopColumns == '2'){
		    $wooCommerceCol = 2;
		} else if($woocommerceLoopColumns == '4'){
		    $wooCommerceCol = 4;
		} else {
		    $wooCommerceCol = 3;
		}
		return $wooCommerceCol;
	}
}
add_filter('loop_shop_columns', 'loop_columns', 999);

if(is_product()){
	if($woocommerceGetLayout == '2' || $woocommerceGetLayout == '3' || $woocommerceGetLayout == '4'){
	    $woocommerceLayout = 'product_layout';
	}
}
elseif(is_shop() || is_product_category() || is_product_tag()) { 
	if($woocommerceGetLayout == '2'){
	    $woocommerceLayout = 'two_columns';
	} else if($woocommerceGetLayout == '4'){
	    $woocommerceLayout = 'four_columns';
	} else {
	    $woocommerceLayout = 'three_columns';
	}
}
else {
	if($woocommerceGetLayout == '2' || $woocommerceGetLayout == '3' || $woocommerceGetLayout == '4'){
	    $woocommerceLayout = 'normal_shop_layout';
	}
}

// Search
$search_image = null;
$search_class = null;
$search_container = 'normal-container';
if( !empty($options_ibuki['search-woocommerce-custom-settings']) && $options_ibuki['search-woocommerce-custom-settings'] == 1) {
    if( !empty($options_ibuki['search-woocommerce-custom-image']['url'])) {
        $search_class = 'imagize';
        $search_image = ' style="background-image: url('.$options_ibuki['search-woocommerce-custom-image']['url'].'); background-size: cover; background-repeat: no-repeat; background-position: center center;"';
    } else {
        $search_class = 'titlize';
        $search_image = '';
    }
    if( !empty($options_ibuki['search-woocommerce-full-area']) && $options_ibuki['search-woocommerce-full-area'] == 1) {
        $search_container = 'full-container';
    } else {
        $search_container = 'normal-container';
    }
} else {
    $search_class = 'titlize';
    $search_image = '';
}
?>

<div id="content">
<?php 
$page_title = sprintf( __( 'Search Results for <span class="color-text">&#8220;</span>%s<span class="color-text">&#8221;</span>', AZ_THEME_NAME ), get_search_query() );
$page_caption = sprintf( __( 'Products', AZ_THEME_NAME ) );
if (is_search() ) { ?>
<section id="text-header">
    <div class="<?php echo $search_container; ?> responsiveFull <?php echo $search_class; ?>"<?php echo $search_image; ?>>
    	<?php if( !empty($options_ibuki['search-woocommerce-custom-settings']) && $options_ibuki['search-woocommerce-custom-settings'] == 1) { echo '<span class="overlay-bg-search"></span>'; } ?>
        <div class="box-overlay <?php echo $search_class; ?>">
            <div class="content-title centerize">
                <h2 class="title"><?php echo $page_title; ?></h2>
                <span class="line"></span>
                <h3 class="caption"><?php echo $page_caption; ?></h3>
            </div>
        </div>
        <?php if( !empty($options_ibuki['search-woocommerce-full-area']) && $options_ibuki['search-woocommerce-full-area'] == 1 && $options_ibuki['search-woocommerce-full-area-arrow'] == 1 ) { ?>
        <a href="#" class="scroll-btn-full-area metabox-header"><i class="scroll-btn-down-icon animated-opacity"></i></a>
        <?php } ?>
    </div>
</section>
<?php } else if(is_shop() || is_product_category() || is_product_tag()) {
	az_page_header(woocommerce_get_page_id('shop'));
} else if ( is_product() ){
	az_page_header($post->ID);
} ?>

<section class="wrap_content">
<?php if($shop_type == 'fullwidth-shop') { ?>
<?php if(is_shop() || is_product_category() || is_product_tag()) { ?>
<section class="main-content default-padding <?php echo $woocommerceLayout; ?> <?php echo $options_ibuki['shop_type']; ?>">
	<div class="<?php echo $shop_container; ?>">
		<div class="row">
			<div class="col-md-12">
				<?php woocommerce_content(); ?>
			</div>
		</div>
	</div>
</section>
<?php } else if( is_product() ) { ?>
<section class="main-content default-padding <?php echo $woocommerceLayout; ?> <?php echo $options_ibuki['shop_type']; ?>">
	<div class="<?php echo $single_container; ?>">
		<div class="row">
			<div class="col-md-12">
				<?php woocommerce_content(); ?>
			</div>
		</div>
	</div>
</section>
<?php } ?>

<?php } else if($shop_type == 'sidebar-shop') { 
	$alignment = (!empty($options_ibuki['shop_sidebar_layout'])) ? $options_ibuki['shop_sidebar_layout'] : 'right_side' ;

	switch ($alignment) {
	case 'right_side' :
		$align_sidebar = 'right_side';
		$align_main = 'left_side';
	break;
				
	case 'left_side' :
		$align_sidebar = 'left_side';
		$align_main = 'right_side';
	break;
	} 
?>
<?php if(is_shop() || is_product_category() || is_product_tag()) { ?>
<section class="main-content <?php echo $woocommerceLayout; ?> <?php echo $options_ibuki['shop_type']; ?>">
	<div class="content-sidebar <?php echo $header_container; ?>">
		<div class="row default-padding">
			<div class="col-md-9 page-content <?php echo $align_main; ?>">
				<?php woocommerce_content(); ?>
			</div>
			<aside class="col-md-3 page-sidebar <?php echo $align_sidebar; ?>">
				<?php get_sidebar(); ?>
			</aside>
		</div>
	</div>
</section>
<?php } else if( is_product() ) { ?>
<section class="main-content default-padding <?php echo $woocommerceLayout; ?> <?php echo $options_ibuki['shop_type']; ?>">
	<div class="<?php echo $single_container; ?>">
		<div class="row">
			<div class="col-md-12">
				<?php woocommerce_content(); ?>
			</div>
		</div>
	</div>
</section>
<?php } ?>
<?php } ?>
</section> 

</div>
<?php get_footer(); ?>