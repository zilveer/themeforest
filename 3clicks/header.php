<?php
/**
 * The Header for our theme.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Framework
 * @subpackage G1_Theme03
 * @since G1_Theme03 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );

?><!DOCTYPE html>
<!--[if IE 7]>
<html class="no-js lt-ie10 lt-ie9 lt-ie8" id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie10 lt-ie9" id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 9]>
<html class="no-js lt-ie10" id="ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !IE]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php wp_title( '', true, 'right' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
<?php do_action( 'g1_before_page' ); ?>
<div id="page">
    <div id="g1-top">
	<?php 
		/* Executes a custom hook.
		 * If you want to add some content before the g1-header, hook into 'g1_header_before' action.
		 */	
		do_action( 'g1_header_before' );
	?>

	<!-- BEGIN #g1-header -->
    <div id="g1-header-waypoint">
	<div id="g1-header" class="g1-header" role="banner">
        <div class="g1-layout-inner">
            <?php
                /* Executes a custom hook.
                 * If you want to add some content before the g1-primary-bar, hook into 'g1_header_begin' action.
                 */
                do_action( 'g1_header_begin' );
            ?>

            <div id="g1-primary-bar">
                <?php G1_Theme()->render_site_id(); ?>

                <!-- BEGIN #g1-primary-nav -->
                <nav id="g1-primary-nav" class="g1-nav--<?php echo sanitize_html_class( g1_get_theme_option('ta_header', 'primary_nav_style', 'none') ); ?> g1-nav--collapsed">
                    <a id="g1-primary-nav-switch" href="#"><?php echo __('Menu', 'g1_theme')?></a>
                    <?php
                        if ( has_nav_menu( 'primary_nav' ) ) {
                            wp_nav_menu( array(
                                'theme_location'	=> 'primary_nav',
                                'container'			=> '',
                                'menu_class'        => '',
                                'menu_id'			=> 'g1-primary-nav-menu',
                                'depth'				=> 0,
                                'walker'            => new G1_Extended_Walker_Nav_Menu(array(
                                    'with_description' => true,
                                    'with_icon' => true,
                                )),
                            ));
                        } else {
                            $helpmode = G1_Helpmode(
                                'empty_primary_nvation',
                                __( 'Empty Primary Navigation', 'g1_theme' ),
                                '<p>' . sprintf( __( 'You should <a href="%s">assign a menu to the Primary Navigation Theme Location</a>', 'g1_theme' ), network_admin_url( 'nav-menus.php' ) ) . '</p>'
                            );
                            $helpmode->render();
                        }
                    ?>

                    <?php if ( apply_filters( 'g1_header_woocommerce_minicart', is_plugin_active('woocommerce/woocommerce.php') ) ): ?>
                    <div class="g1-cartbox">
                        <a class="g1-cartbox__switch" href="#">
                            <div class="g1-cartbox__arrow"></div>
                            <strong><?php _ex( '&nbsp;', 'searchbox switch label',  'g1_theme' ); ?></strong>
                        </a>

                        <div class="g1-cartbox__box">
                            <div class="g1-inner woocommerce">
                                <?php
                                    $g1_instance = array(
                                        'title' => '',
                                        'number' => 1
                                    );
                                    $g1_args = array(
                                        'title' => '',
                                        'before_widget' => '',
                                        'after_widget' => '',
                                        'before_title' => '<div class="g1-cartbox__title">',
                                        'after_title' => '</div>',
                                    );
                                    $g1_widget = new WC_Widget_Cart();
                                    $g1_widget->number = $g1_instance['number'];
                                    $g1_widget->widget( $g1_args, $g1_instance );
                                ?>
                                <p class="g1-cartbox__empty"><?php _e( 'No products in the cart.', 'woocommerce' ); ?></p>
                            </div>

                        </div>
                    </div>
                    <?php endif; ?>

                    <?php
                        $g1_value = g1_get_theme_option( 'ta_header', 'searchform' );
                        $g1_layout = g1_get_theme_option( 'ta_header', 'layout', 'semi-standard' );

                        $g1_class = array(
                            'g1-searchbox',
                            'g1-searchbox--' . $g1_value,
                            'g1-searchbox--' . $g1_layout
                        );
                    ?>
                    <?php if ( 'none' !== $g1_value && !is_404() ): ?>
                    <div class="<?php echo  sanitize_html_classes($g1_class); ?>">
                        <a class="g1-searchbox__switch" href="#">
                            <div class="g1-searchbox__arrow"></div>
                            <strong><?php _ex( '&nbsp;', 'searchbox switch label',  'g1_theme' ); ?></strong>
                        </a>
                        <?php get_search_form(); ?>
                    </div>
                    <?php endif; ?>

                </nav>
                <!-- END #g1-primary-nav -->
            </div><!-- END #g1-primary-bar -->

            <?php
                /* Executes a custom hook.
                 * If you want to add some content after the g1-primary-bar, hook into 'g1_header_end' action.
                 */
                do_action( 'g1_header_end' );
            ?>

		</div>

        <?php get_template_part( 'template-parts/g1_background', 'header' ); ?>
	</div>
    </div>
	<!-- END #g1-header -->	

	<?php 
		/* Executes a custom hook.
		 * If you want to add some content after the g1-header, hook into 'g1_header_after' action.
		 */	
		do_action( 'g1_header_after' );
	?>
	
	<?php 
		/* Executes a custom hook.
		 * If you want to add some content before the g1-content, hook into 'g1_content_before' action.
		 */	
		do_action( 'g1_content_before' );
	?>
	
	<?php get_template_part( 'g1_precontent' ); ?>


        <div class="g1-background">
        </div>
    </div>

	<!-- BEGIN #g1-content -->
	<div id="g1-content" class="g1-content">
        <div class="g1-layout-inner">
            <?php
                /* Executes a custom hook.
                 * If you want to add some content before the g1-content-area, hook into 'g1_content_begin' action.
                 */
                do_action( 'g1_content_begin' );
            ?>
            <div id="g1-content-area">