<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $g5plus_options,$g5plus_woocommerce_loop;
$prefix = 'g5plus_';

$layout_style = isset($_GET['layout']) ? $_GET['layout'] : '';
if (!in_array($layout_style, array('full','container','container-fluid'))) {
    $layout_style = rwmb_meta($prefix.'page_layout');
    if (($layout_style === '') || ($layout_style == '-1')) {
        $layout_style = $g5plus_options['single_product_layout'];
    }
}


$sidebar = isset($_GET['sidebar']) ? $_GET['sidebar'] : '';
if (!in_array($sidebar, array('none','left','right','both'))) {
    $sidebar = rwmb_meta($prefix.'page_sidebar');
    if (($sidebar === '') || ($sidebar == '-1')) {
        $sidebar = $g5plus_options['single_product_sidebar'];
    }
}


$left_sidebar = rwmb_meta($prefix.'page_left_sidebar');
if (($left_sidebar === '') || ($left_sidebar == '-1')) {
    $left_sidebar = $g5plus_options['single_product_left_sidebar'];
}

$right_sidebar = rwmb_meta($prefix.'page_right_sidebar');
if (($right_sidebar === '') || ($right_sidebar == '-1')) {
    $right_sidebar = $g5plus_options['single_product_right_sidebar'];
}

$sidebar_width = isset($_GET['sidebar_width']) ? $_GET['sidebar_width'] : '';
if (!in_array($sidebar_width, array('small','large'))) {
    $sidebar_width = rwmb_meta($prefix.'sidebar_width');
    if (($sidebar_width === '') || ($sidebar_width == '-1')) {
        $sidebar_width = $g5plus_options['single_product_sidebar_width'];
    }
}


// Calculate sidebar column & content column
$sidebar_col = 'col-md-3';
if ($sidebar_width == 'large') {
    $sidebar_col = 'col-md-4';
}

$content_col_number = 12;
if (is_active_sidebar($left_sidebar) && (($sidebar == 'both') || ($sidebar == 'left'))) {
    if ($sidebar_width == 'large') {
        $content_col_number -= 4;
    } else {
        $content_col_number -= 3;
    }
}
if (is_active_sidebar($right_sidebar) && (($sidebar == 'both') || ($sidebar == 'right'))) {
    if ($sidebar_width == 'large') {
        $content_col_number -= 4;
    } else {
        $content_col_number -= 3;
    }
}

$content_col = 'col-md-' . $content_col_number;
if (($content_col_number == 12) && ($layout_style == 'full')) {
    $content_col = '';
}
$main_class = array('single-product-wrap');
if ($content_col_number < 12) {
    $main_class[] = 'has-sidebar';
}
get_header( 'shop' ); ?>

<?php
/**
 * @hooked - g5plus_page_heading - 5
 **/
do_action('g5plus_before_page');
?>
<main  class="<?php echo join(' ',$main_class) ?>">
    <?php if ($layout_style != 'full'): ?>
    <div class="<?php echo esc_attr($layout_style) ?> clearfix">
    <?php endif;?>

        <?php if (($content_col_number != 12) || ($layout_style != 'full')): ?>
        <div class="row clearfix">
        <?php endif;?>

            <?php if (is_active_sidebar( $left_sidebar ) && (($sidebar == 'left') || ($sidebar == 'both'))): ?>
                <div class="sidebar woocommerce-sidebar <?php echo esc_attr($sidebar_col) ?> hidden-sm hidden-xs">
                    <?php dynamic_sidebar( $left_sidebar );?>
                </div>
            <?php endif;?>

            <div class="site-content-single-product <?php echo esc_attr($content_col) ?>">
                <div class="single-product-inner">
                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php wc_get_template_part( 'content', 'single-product' ); ?>

                    <?php endwhile; // end of the loop. ?>
                </div>
            </div>



            <?php if (is_active_sidebar( $right_sidebar ) && (($sidebar == 'right') || ($sidebar == 'both'))): ?>
                <div class="sidebar woocommerce-sidebar <?php echo esc_attr($sidebar_col) ?> hidden-sm hidden-xs">
                    <?php dynamic_sidebar( $right_sidebar );?>
                </div>
            <?php endif;?>

        <?php if (($content_col_number != 12) || ($layout_style != 'full')): ?>
        </div>
        <?php endif;?>



    <?php if ($layout_style != 'full'): ?>
    </div>
    <?php endif;?>
</main>
<?php get_footer( 'shop' ); ?>
