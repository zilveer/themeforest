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
get_header();


global $zorka_data;

$page_title_background = get_post_meta(get_the_ID(),'custom-page-title-background',true);

if (empty($page_title_background)) {
    $page_title_background = $zorka_data['page-title-background'];
}
$header_layout = get_post_meta(get_the_ID(),'header-layout',true);
if (!isset($header_layout) || $header_layout == 'none' || $header_layout == '') {
    $header_layout =  $zorka_data['header-layout'];
}
?>

<?php if ((!empty($page_title_background)) && ($header_layout == 4 || $header_layout == 8) ) :
    get_template_part('content','top');
endif; ?>

<?php zorka_the_breadcrumb();?>

<main role="main" class="site-content-product-single">
    <div class="container clearfix">
        <?php while ( have_posts() ) : the_post(); ?>
            <?php wc_get_template_part( 'content', 'single-product' ); ?>
        <?php endwhile; // end of the loop. ?>
    </div>
</main>
<?php get_footer(); ?>

