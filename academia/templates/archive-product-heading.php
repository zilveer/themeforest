<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/8/2015
 * Time: 2:44 PM
 */
$g5plus_options = &G5Plus_Global::get_options();
$prefix = 'g5plus_';
$show_page_title = isset($g5plus_options['show_archive_product_title']) ? $g5plus_options['show_archive_product_title'] : '1';
if ($show_page_title == 0) return;

$page_sub_title = strip_tags(term_description());
if (empty($page_sub_title)) {
    $page_sub_title = isset($g5plus_options['archive_product_sub_title']) ? $g5plus_options['archive_product_sub_title'] : '';
}

$page_title_style = isset($g5plus_options['style_archive_product_title']) ? $g5plus_options['style_archive_product_title'] : "";

// Page Title Text Align
$page_title_text_align = isset($g5plus_options['archive_product_title_text_align']) ? $g5plus_options['archive_product_title_text_align'] : 'center';
if($page_title_style == "pt-bottom"){
    $page_title_text_align = "";
}


$custom_styles = array();
$page_title_wrap_class = array('archive-product-title-wrap');
$page_title_inner_class = array('archive-product-title-inner');
$page_title_inner_class[] = $page_title_style;

// Custom Page Title Background Image
$page_title_bg_image_url = '';
$page_title_bg_image = '';
$cat = get_queried_object();
if ($cat && property_exists( $cat, 'term_id' )) {
    $page_title_bg_image = get_tax_meta($cat,$prefix.'page_title_background');
}

if(!$page_title_bg_image || ($page_title_bg_image === '')) {
    $page_title_bg_image = $g5plus_options['archive_product_title_bg_image'];
}

if (isset($page_title_bg_image) && isset($page_title_bg_image['url'])) {
    $page_title_bg_image_url = $page_title_bg_image['url'];
}

$page_title_wrap_class[] = 'archive-product-title-margin';

$custom_style= '';
if ($custom_styles) {
    $custom_style = 'style="'. join(';',$custom_styles).'"';
}

// Page Title Parallax
$page_title_parallax=0;
if (!empty($page_title_bg_image_url)) {
    $page_title_parallax = isset($g5plus_options['archive_product_title_parallax']) ? $g5plus_options['archive_product_title_parallax'] : '0';
    if ($page_title_parallax == 1) {
        $page_title_parallax_position = isset($g5plus_options['archive_product_title_parallax_position']) ? $g5plus_options['archive_product_title_parallax_position'] : 'top';
    }
}

if(!empty($page_title_text_align)){
    $page_title_inner_class[] = 'text-' . $page_title_text_align;
}

// Breadcrumbs
$breadcrumbs_class = array('breadcrumbs-wrap');
?>
<section id="page-title" class="<?php echo join(' ', $page_title_wrap_class); ?>" <?php echo wp_kses_post($custom_style); ?>>
    <?php if (!empty($page_title_bg_image_url)) :?>
        <?php if ($page_title_parallax == 1) : ?>
            <div data-stellar-background-image="<?php echo esc_url($page_title_bg_image_url); ?>" data-stellar-background-position="<?php echo esc_attr($page_title_parallax_position); ?>" data-stellar-background-ratio="0.5" class="page-title-parallax" style="background-image: url('<?php echo esc_url($page_title_bg_image_url); ?>');background-position:center <?php echo esc_attr($page_title_parallax_position); ?>;"></div>
        <?php else: ?>
            <div class="page-title-wrap-bg" style="background-image: url('<?php echo esc_attr($page_title_bg_image_url); ?>');"></div>
        <?php endif; ?>
    <?php endif; ?>
    <div class="container">
        <div class="<?php echo join(' ',$page_title_inner_class); ?>">
            <div class="m-title">
                <h1 class="p-font"><?php if(is_search()){ esc_html_e('Course','g5plus-academia'); }else { woocommerce_page_title(); }  ?></h1>
                <?php if ($page_sub_title != '') : ?>
                    <p class="s-font"><?php echo esc_html($page_sub_title) ?></p>
                <?php endif; ?>
            </div>
	        <div class="<?php echo join(' ',$breadcrumbs_class); ?>">
		        <div class="breadcrumbs-inner text-left">
			        <?php g5plus_the_breadcrumb(); ?>
		        </div>
	        </div>
        </div>

    </div>
</section>


