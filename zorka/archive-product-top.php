<?php
global $zorka_data;
$cat = get_queried_object();
$page_sub_title = '';

if ($cat && property_exists( $cat, 'term_id' )) {
    $page_title_background_arr = get_tax_meta($cat,'zorka_custom_page_title_background');
    if (is_array($page_title_background_arr) ) {
        $page_title_background = $page_title_background_arr['url'];
    }
    $page_sub_title =  strip_tags(term_description());
}

if (empty($page_title_background)) {
    $page_title_background = $zorka_data['shop-page-title-background'];
}

$class = array();

$class[] = 'page-title-wrapper page-title-shop-wrapper';
$custom_style = '';
if (!empty($page_title_background)) {
    $class[] = 'dark';
    $class[] = 'page-title-image';
    $custom_style = 'style="background-image: url('.$page_title_background.');"';
}
/*else {
    $class[] = 'border-bottom';
}*/

$class_name = join(' ',$class);
?>

<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

<section class="<?php echo esc_attr($class_name) ?>"  <?php echo wp_kses_post($custom_style); ?>>

        <div class="page-title-inner">
            <div class="container">
                <h1><?php woocommerce_page_title(); ?></h1>
                <?php if (!empty($page_sub_title)) : ?>
                    <span><?php echo esc_html($page_sub_title);?></span>
                <?php endif; ?>
            </div>
        </div>
</section>
<?php endif; ?>



