<?php
// Logo in the center with menu below

global $cg_options;
$protocol = (!empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https:" : "http:";

$cg_responsive_status = '';

if ( isset( $cg_options['cg_responsive'] ) ) {
    $cg_responsive_status = $cg_options['cg_responsive'];
}

$cg_logo = '';

$cg_favicon = '';

if ( isset( $cg_options['cg_favicon']['url'] ) ) {
    $cg_options['cg_favicon']['url'] = $protocol . str_replace( array( 'http:', 'https:' ), '', $cg_options['cg_favicon']['url'] );
    $cg_favicon = $cg_options['cg_favicon']['url'];
}

$cg_retina_favicon = '';

if ( isset( $cg_options['cg_retina_favicon']['url'] ) ) {
    $cg_options['cg_retina_favicon']['url'] = $protocol . str_replace( array( 'http:', 'https:' ), '', $cg_options['cg_retina_favicon']['url'] );
    $cg_retina_favicon = $cg_options['cg_retina_favicon']['url'];
}

$cg_topbar_display = '';

if ( isset( $cg_options['cg_topbar_display'] ) ) {
    $cg_topbar_display = $cg_options['cg_topbar_display'];
}

$cg_topbar_message = '';

if ( isset( $cg_options['cg_topbar_message'] ) ) {
    $cg_topbar_message = $cg_options['cg_topbar_message'];
}

$cg_display_cart = '';

if ( isset( $cg_options['cg_show_cart'] ) ) {
    $cg_display_cart = $cg_options['cg_show_cart'];
}

$cg_catalog = '';

if ( isset( $cg_options['cg_catalog_mode'] ) ) {
    $cg_catalog = $cg_options['cg_catalog_mode'];
}

$cg_primary_menu_layout = '';

if ( isset( $cg_options['cg_primary_menu_layout'] ) ) {
    $cg_primary_menu_layout = $cg_options['cg_primary_menu_layout'];
}

$cg_sticky_menu = '';

if ( isset( $cg_options['cg_sticky_menu'] ) ) {
    $cg_sticky_menu = $cg_options['cg_sticky_menu'];
}

if ( !empty( $_SESSION['cg_header_top'] ) ) {
    $cg_topbar_display = $_SESSION['cg_header_top'];
}

$shop_announcements = '';

if ( isset( $cg_options['cg_shop_announcements'] ) ) {
    $shop_announcements = $cg_options['cg_shop_announcements'];
}

$logo_position = '';

if ( isset( $cg_options['cg_logo_position'] ) ) {
    $logo_position = $cg_options['cg_logo_position'];
}
?>
<!-- Center Logo with menu below -->
<div class="cg-menu-below cg-logo-center">
    <div class="container">
        <div class="cg-logo-cart-wrap">
            <div class="cg-logo-inner-cart-wrap">
                <div class="row">
                    <div class="container">
                        <div class="cg-wp-menu-wrapper">
                            <div id="load-mobile-menu">
                            </div>
                            <div class="cg-header-search visible-lg">
                                <?php if ( is_active_sidebar( 'header-search' ) ) : ?>
                                    <?php dynamic_sidebar( 'header-search' ); ?>
                                <?php endif; ?>
                            </div>
                            <?php
                            if ( !empty( $cg_options['site_logo']['url'] ) ) {
                                $cg_options['site_logo']['url'] = $protocol . str_replace( array( 'http:', 'https:' ), '', $cg_options['site_logo']['url'] );
                                $cg_logo = $cg_options['site_logo']['url'];
                            }

                            if ( !empty( $_SESSION['cg_skin_color'] ) ) {
                                $cg_skin_color = $_SESSION['cg_skin_color'];
                                if ( $cg_skin_color == '#DF440B' ) {
                                    $cg_logo = CG_THEMEURI . '/images/logo_red.png';
                                } elseif ( $cg_skin_color == '#1e73be' ) {
                                    $cg_logo = CG_THEMEURI . '/images/logo_blue.png';
                                } elseif ( $cg_skin_color == '#208e3c' ) {
                                    $cg_logo = CG_THEMEURI . '/images/logo_green.png';
                                } elseif ( $cg_skin_color == '#9b3b85' ) {
                                    $cg_logo = CG_THEMEURI . '/images/logo_purple.png';
                                }
                            }

                            if ( $cg_logo ) {
                                $cg_logo_width = $cg_options['site_logo']['width'];
                                $cg_logo_max_width = $cg_logo_width / 2;
                                ?>

                                <div class="responsive-container">
                                    <div class="dummy"></div>

                                    <style>
                                    @media only screen and (min-width: 1100px) {
                                    .max-width-logo {
                                        max-width: <?php echo esc_attr( $cg_logo_max_width ); ?>px;
                                        }
                                    }
                                    </style>
                                    
                                    <div class="img-container">
                                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( $cg_logo ); ?>" class="max-width-logo" alt="<?php bloginfo( 'name' ); ?>" /></a>
                                    </div>
                                </div>
                            
                                <?php if ( $shop_announcements == 'enabled' ) { ?>

                                    <div class="cg-announcements">
                                        <div class="divider"></div>
                                        <ul class="cg-show-announcements">
                                            <?php cg_get_announcements(); ?>
                                        </ul>
                                    </div>

                                <?php } ?>
                            <?php } else { ?>
                                <div class="logo text-logo">
                                    <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                </div>
                                <?php if ( $shop_announcements == 'enabled' ) { ?>
                                    <div class="cg-announcements">
                                        <div class="divider"></div>
                                        <ul class="cg-show-announcements">
                                            <?php cg_get_announcements(); ?>
                                        </ul>
                                    </div>

                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div><!--/container -->
                </div><!--/row -->
            </div><!--/cg-logo-inner-cart-wrap -->
        </div><!--/cg-logo-cart-wrap -->
    </div><!--/container -->
</div><!--/cg-menu-below -->
<div class="cg-primary-menu cg-wp-menu-wrapper cg-primary-menu-below-wrapper">
    <div class="container">
        <div class="row">
            <div class="container">
                <?php if ( has_nav_menu( 'primary' ) ) { ?>
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'before' => '',
                        'after' => '',
                        'link_before' => '',
                        'link_after' => '',
                        'depth' => 4,
                        'container' => 'div',
                        'container_class' => 'cg-main-menu',
                        'fallback_cb' => false,
                        'walker' => new primary_cg_menu() )
                    );
                    ?>
                <?php } else { ?>
                    <p class="setup-message">You can set your main menu in <strong>Appearance &gt; Menus</strong></p>
                <?php } ?>
                <?php if ( $cg_display_cart !== 'no' ) { ?>
                    <?php if ( $cg_catalog == 'disabled' ) { ?>
                        <div class="cart-wrap">
                            <?php
                            if ( class_exists( 'WooCommerce' ) ) {
                                ?>
                                <?php echo cg_woocommerce_cart_dropdown(); ?>
                            <?php }
                            ?>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>