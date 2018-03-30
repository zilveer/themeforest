<?php
/**
 * @author Stylish Themes
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $clx_data;
$prefix = Haze_Meta_Boxes::get_instance()->prefix;

if(!is_404() && !is_search() && !is_tax()) {
    $bg_image = rwmb_meta("{$prefix}bg_image_override", array('type'=>'image_advanced', 'size' => 'full'));
    $bg_image = array_shift($bg_image);
} else {
    $bg_image = array();
}
if(!empty($bg_image) && !is_404() && !is_archive() && !is_search() && !is_category() && !is_tag()) {
    $body_style = 'style="background-image: url('. $bg_image['url'] .')"';
} else {
    $body_style = '';
}
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="HandheldFriendly" content="true" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>

    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    
    <?php if(isset($clx_data['favico']) && $clx_data['favico']['url'] != ''): ?>
        <link rel="shortcut icon" href="<?php echo esc_url( $clx_data['favico']['url'] ); ?>" />
    <?php endif; ?>

    <!-- Script required for extra functionality on the comment form -->
    <?php if (is_singular()) wp_enqueue_script( 'comment-reply' ); ?>

    <?php wp_head(); ?>

    <?php one_change_colors_css($clx_data['color']); ?>

</head>

<?php
// light-layout, top-slider, fixed-background
$body_class = '';
if($clx_data['color-scheme'] == 'light') {$body_class = 'light-layout';}
?>
<body <?php body_class($body_class); ?> data-swfpath="<?php echo THEMEROOT . '/assets/js'; ?>" <?= $body_style ?> >

<style type="text/css"><?php echo $clx_data['csscode']; ?></style>

<!-- ================================================== -->
<!-- =============== START HEAD CONTAINER ================ -->
<!-- ================================================== -->
<section class="head-container">
    <!-- ================================================== -->
    <!-- =============== START HEADER ================ -->
    <!-- ================================================== -->
    <section class="header">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <header class="clearfix">
                        <!-- LOGO ANCHOR -->
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
                            <!-- LOGO -->
                            <img src="<?= $clx_data['logo']['url']; ?>" alt="<?php bloginfo('name'); ?>">
                        </a>
                        <!-- SOCIAL MEDIA LIST -->
                        <nav class="social-list clearfix">
                            <ul>
                                <?php if(isset($clx_data)){
                                    foreach($clx_data['social'] as $icon) {
                                        echo do_shortcode($icon);
                                    }
                                } ?>
                            </ul>
                        </nav>
                    </header>
                </div>
            </div>
        </div>
    </section>
    <!-- ================================================== -->
    <!-- =============== END HEADER ================ -->
    <!-- ================================================== -->
    <!-- ================================================== -->
    <!-- =============== START MENU ================ -->
    <!-- ================================================== -->
    <?php // menu-affix, my-cart-link
    $menu_class = '';
    if($clx_data['header-cart']) {$menu_class .= ' my-cart-link';}
    if($clx_data['sticky']) {$menu_class .= ' menu-affix';}
    ?>
    <section class="menu <?= $menu_class; ?>">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <nav class="navbar navbar-default" role="navigation">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#clubix-navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="clubix-navbar-collapse">

                            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location'    => 'main-menu',
                                    'menu_class'        => 'nav navbar-nav',
                                    'container'         => '',
                                    'fallback_cb'       => false,
                                    //'walker'            => new HazeControllerExtensionNavWalker()
                                ));
                            ?>

                            <?php get_search_form(true); ?>
                        </div>

                        <!-- Shop Cart -->
                        <?php global $woocommerce; ?>

                        <?php
                        /**
                         * Detect plugin. For use on Front End only.
                         */
                        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

                        // check for plugin using plugin name
                        if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) : ?>

                        <!-- /.navbar-collapse -->
                        <a class="my-cart-link" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" aria-haspopup="true">
                            <span><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'clubix-framework'), $woocommerce->cart->cart_contents_count);?></span>
                            <i class="fa fa-shopping-cart"></i>
                        </a>

                        <?php endif; ?>
                        <!-- End Cart -->

                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- ================================================== -->
    <!-- =============== END MENU ================ -->
    <!-- ================================================== -->
</section>
<!-- ================================================== -->
<!-- =============== END HEAD CONTAINER ================ -->
<!-- ================================================== -->