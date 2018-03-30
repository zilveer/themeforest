<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/8/2015
 * Time: 2:44 PM
 */
global $g5plus_options;
$show_page_title = $g5plus_options['show_archive_product_title'];

$prefix = 'g5plus_';

$page_sub_title = strip_tags(term_description());

//archive
$page_title_bg_image = '';
$page_title_height = '';
$cat = get_queried_object();
if ($cat && property_exists( $cat, 'term_id' )) {
    $page_title_bg_image = get_tax_meta($cat,$prefix.'page_title_background');
    $page_title_height = get_tax_meta($cat,$prefix.'page_title_height');
}

if(!$page_title_bg_image || $page_title_bg_image === '') {
    $page_title_bg_image = $g5plus_options['archive_product_title_bg_image'];
}

if (isset($page_title_bg_image) && isset($page_title_bg_image['url'])) {
    $page_title_bg_image_url = $page_title_bg_image['url'];
}


$breadcrumbs_in_page_title = $g5plus_options['breadcrumbs_in_archive_product_title'];
$product_show_result_count = $g5plus_options['product_show_result_count'];
$product_show_catalog_ordering = $g5plus_options['product_show_catalog_ordering'];
$product_show_catalog_page_size = isset($g5plus_options['product_show_catalog_page_size']) ? $g5plus_options['product_show_catalog_page_size'] : 0;
$breadcrumb_class = array('breadcrumb-wrap breadcrumb-archive-product-wrap');

if (($product_show_result_count == 0) && ($product_show_catalog_ordering == 0) && ($product_show_catalog_page_size == 0) ) {
	$breadcrumb_class[] = 'catalog-filter-visible';
} else {
	if ($product_show_result_count == 0) {
		$breadcrumb_class[] = 'result-count-visible';
	}

	if ($product_show_catalog_ordering == 0) {
		$breadcrumb_class[] = 'catalog-ordering-visible';
	}
}




$page_title_warp_class = array();
$page_title_warp_class[] = 'page-title-wrap archive-product-title-height';

$custom_styles = array();

if ($page_title_bg_image_url != '') {
    $page_title_warp_class[] = 'page-title-wrap-bg';
    $custom_styles[] = 'background-image: url(' . $page_title_bg_image_url . ');';
}

if (($page_title_height != '') && ($page_title_height > 0)) {
    $custom_styles[] = 'height:' . $page_title_height . 'px';
}




$custom_style= '';
if ($custom_styles) {
    $custom_style = 'style="'. join(';',$custom_styles).'"';
}

$page_title_parallax = $g5plus_options['archive_product_title_parallax'];

if (!empty($page_title_bg_image_url) && ($page_title_parallax == '1')) {
    $custom_style.= ' data-stellar-background-ratio="0.5"';
    $page_title_warp_class[] = 'page-title-parallax';
}

$page_title_text_align = $g5plus_options['archive_product_title_text_align'];
if (!isset($page_title_text_align) || empty($page_title_text_align)) {
    $page_title_text_align = 'left';
}
$page_title_warp_class[] = 'page-title-' . $page_title_text_align;


$section_page_title_class = array('section-page-title archive-product-title-margin');
$page_title_layout = $g5plus_options['archive_product_title_layout'];
if (in_array($page_title_layout,array('container','container-fluid'))) {
    $section_page_title_class[] = $page_title_layout;
}

?>
<?php if (($show_page_title == 1) || ($breadcrumbs_in_page_title == 1)) : ?>
    <div class="<?php echo join(' ',$section_page_title_class) ?>">
        <?php if ($show_page_title == 1) : ?>
            <section class="<?php echo join(' ',$page_title_warp_class); ?>" <?php echo wp_kses_post($custom_style); ?>>
                <div class="page-title-overlay"></div>
                <div class="container">
                    <div class="page-title-inner block-center">
                        <div class="block-center-inner">
                            <h1><?php woocommerce_page_title(); ?></h1>
                            <?php if ($page_sub_title != '') : ?>
                                <span class="page-sub-title"><?php echo esc_html($page_sub_title) ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <?php if ($breadcrumbs_in_page_title == 1 || $product_show_result_count == 1 || $product_show_catalog_ordering == 1) : ?>
            <section class="<?php echo join(' ',$breadcrumb_class); ?>">
                <div class="container">
                    <?php g5plus_the_breadcrumb(); ?>
                    <div class="catalog-filter clearfix">
                        <?php
                        /**
                         * woocommerce_before_shop_loop hook
                         *
                         * @hooked woocommerce_result_count - 20
                         * @hooked woocommerce_catalog_ordering - 30
                         */
                        do_action( 'g5plus_before_shop_loop' );
                        ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    </div>
<?php endif; ?>


