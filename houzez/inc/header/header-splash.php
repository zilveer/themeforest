<?php
if ( is_page_template( 'template/template-splash.php' ) ) {
    $css_class = 'header-section slpash-header';
} else {
    $css_class = 'header-section';
}

global $current_user;
wp_get_current_user();
$userID  =  $current_user->ID;
$user_custom_picture =  get_the_author_meta( 'fave_author_custom_picture' , $userID );
$splash_page_nav = houzez_option('splash_page_nav');
$splash_menu_align = houzez_option('splash_menu_align');
?>
<!--start section header-->
<header id="header-section" class="clearfix houzez-header-main <?php echo esc_attr( $css_class ).' '.esc_attr( $splash_menu_align ); ?>">
    <div class="header-mobile visible-sm visible-xs">
        <div class="container">
            <!--start mobile nav-->
            <div class="mobile-nav">
                <span class="nav-trigger"><i class="fa fa-navicon"></i></span>
                <div class="nav-dropdown main-nav-dropdown"></div>
            </div>
            <!--end mobile nav-->
            <div class="header-logo logo-mobile">
                <?php get_template_part('inc/header/logo-mobile'); ?>
            </div>
            <?php if( houzez_option('header_login') != 'no' ): ?>
                <div class="header-user">
                    <?php get_template_part('inc/header/login', 'nav'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="hidden-sm hidden-xs">
        <div class="header-left">

            <div class="logo logo-desktop">
                <?php get_template_part('inc/header/logo'); ?>
            </div>

            <?php if( $splash_page_nav != 0 ) { ?>
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
            <?php } ?>

            <!--start mobile nav-->
            <?php get_template_part( 'inc/header/mobile', 'menu' ); ?>
            <!--end mobile nav-->
        </div>
        <div class="header-right">
            <?php if( houzez_option('header_login') != 'no' ): ?>
                <?php get_template_part('inc/header/login', 'nav'); ?>
            <?php endif; ?>
        </div>
    </div>
</header>
<!--end section header-->