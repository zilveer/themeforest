<?php
global $current_user;
wp_get_current_user();
$userID  =  $current_user->ID;
$user_custom_picture =  get_the_author_meta( 'fave_author_custom_picture' , $userID );

$call_us_img = houzez_option( 'hd3_call_us_image', false, 'url' );
$main_menu_sticky = houzez_option('main-menu-sticky');
$top_bar = houzez_option('top_bar');

if( $top_bar != 0 ) {
    get_template_part('inc/header/top', 'bar');
}
?>
<header id="header-section" class="header-section-2 not-splash-header houzez-header-main">

    <div class="header-top">

        <div class="logo logo-desktop hidden-sm hidden-xs">
            <?php get_template_part('inc/header/logo'); ?>
        </div>

        <?php get_template_part( 'inc/header/social' ); ?>

        <?php if( houzez_option('hd3_callus') != '0' ){ ?>
        <div class="header-top-call">
            <div class="avatar">
                <img width="41" height="41" alt="author" src="<?php echo esc_url( $call_us_img ); ?>" class="img-circle">
                <?php echo esc_attr( houzez_option('hd3_call_us_text') ); ?> <?php echo esc_attr( houzez_option('hd3_phone') ); ?>
            </div>
        </div>
        <?php } ?>
    </div>
    <div class="header-bottom hidden-sm hidden-xs"  data-sticky="<?php echo esc_attr( $main_menu_sticky ); ?>">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="header-nav">
                        <nav class="navi main-nav">
                            <?php
                            // Pages Menu
                            if ( has_nav_menu( 'main-menu' ) ) :
                                wp_nav_menu( array (
                                    'theme_location' => 'main-menu',
                                    'container' => '',
                                    'container_class' => '',
                                    'menu_class' => '',
                                    'menu_id' => 'main-nav',
                                    'depth' => 4
                                ));
                            endif;
                            ?>
                        </nav>
                        <!--start mobile nav-->
                        <?php get_template_part( 'inc/header/mobile', 'menu' ); ?>
                        <!--end mobile nav-->
                    </div>
                    <?php if( class_exists('Houzez_login_register') ): ?>
                        <?php if( houzez_option('header_login') != 'no' ): ?>
                            <div class="header-right">
                                <?php get_template_part('inc/header/login', 'nav'); ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</header>

<?php get_template_part( 'inc/header/mobile-header' ); ?>
