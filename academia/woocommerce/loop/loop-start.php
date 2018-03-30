<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
global $woocommerce_loop, $g5plus_show_archive_product_start_date,
       $g5plus_show_archive_product_duration, $g5plus_show_archive_product_teacher,$g5plus_show_archive_product_level ;
$g5plus_woocommerce_loop = G5Plus_Global::get_woocommerce_loop();

$g5plus_show_archive_product_start_date = G5Plus_Global::get_option('show_archive_product_start_date','1');
$g5plus_show_archive_product_duration = G5Plus_Global::get_option('show_archive_product_duration','1');
$g5plus_show_archive_product_teacher = G5Plus_Global::get_option('show_archive_product_teacher','1');
$g5plus_show_archive_product_level = G5Plus_Global::get_option('show_archive_product_level','1');

$columns = array_key_exists('columns',$g5plus_woocommerce_loop) ? $g5plus_woocommerce_loop['columns'] : null ;
if (!isset($columns) || empty($columns)) {
    $columns = $woocommerce_loop['columns'];
}

$class = array();
$class[] = 'product-listing woocommerce clearfix';
if (isset($_REQUEST['view'])) {
    $class[] = $_REQUEST['view'];
}else{
    if(isset($g5plus_woocommerce_loop['view']))
        $class[] = $g5plus_woocommerce_loop['view'];
    else
        $class[] = G5Plus_Global::get_option('show_archive_product_view_style','');
}
$archive_product_layout =  isset($g5plus_woocommerce_loop['layout']) ? $g5plus_woocommerce_loop['layout'] : '';
if ($archive_product_layout == 'slider') {
    $class[] = 'product-slider';
} else {
    $class[] = 'columns-' . $columns;
}

$class_names = join(' ', $class);

if ($archive_product_layout == 'slider') {

    $autoPlay = isset($g5plus_woocommerce_loop['autoPlay']) ? $g5plus_woocommerce_loop['autoPlay'] : 'false';
    $dots = isset($g5plus_woocommerce_loop['dots']) ? $g5plus_woocommerce_loop['dots'] : 'false';
    $nav = isset($g5plus_woocommerce_loop['nav']) ? $g5plus_woocommerce_loop['nav'] : 'false';
    $animateOut =  isset($g5plus_woocommerce_loop['animateOut']) ? $g5plus_woocommerce_loop['animateOut'] : 'false';
    $animateIn = isset($g5plus_woocommerce_loop['animateIn']) ? $g5plus_woocommerce_loop['animateIn'] : 'false';

    $animateOut =  'fadeOut';


    $data_carousel = array();
    $data_carousel[]='"autoplay": '. $autoPlay;
    $data_carousel[]='"dots": '. $dots;
    $data_carousel[]='"nav": '. $nav;
    if ($animateOut != 'false') {
        $data_carousel[]='"animateOut": "'. $animateOut . '"';
    }
    if ($animateIn != 'false') {
        $data_carousel[]='"animateIn": "'. $animateIn . '"';
    }

    switch ($columns) {
        case 4:
            $data_carousel[] = '"responsive" : {"0" : {"items" : 1, "margin": 0}, "600": {"items" : 2, "margin": 30}, "768": {"items" : 3, "margin": 30}, "992": {"items" : 4, "margin": 30}}';
            break;
        case 3:
            $data_carousel[] = '"responsive" : {"0" : {"items" : 1, "margin": 0}, "600": {"items" : 2, "margin": 30}, "768": {"items" : 3, "margin": 30}}';
            break;
        case 2:
            $data_carousel[] = '"responsive" : {"0" : {"items" : 1, "margin": 0}, "600": {"items" : 2, "margin": 30}}';
            break;
        case 1:
            $data_carousel[] = '"responsive" : {"0" : {"items" : 1, "margin": 0}}';
            break;
        default:
            $data_carousel[] = '"responsive" : {"0" : {"items" : 1, "margin": 0}, "600": {"items" : 2, "margin": 30}, "768": {"items" : 3, "margin": 30}, "992": {"items" : 4, "margin": 30}, "1200": {"items" : '. $columns .', "margin": 30} }';
            break;
    }

    $data_plugin_options = join(',',$data_carousel);
}

?>
<div class="<?php echo esc_attr($class_names); ?>">
<?php if ($archive_product_layout == 'slider') : ?>
<div class="owl-carousel" data-plugin-options='{<?php echo esc_attr($data_plugin_options); ?>}'>
<?php endif; ?>
