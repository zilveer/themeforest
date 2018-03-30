<?php
$social_pull_right = $contact_pull_right = '';
$contact_info = true;
$social = true;
if( houzez_option('hd2_contact_info') != '1' && houzez_option('hd2_address_info') != '1' && houzez_option('hd2_timing_info') != '1' ) {
    $social_pull_right = 'pull-right';
    $contact_info = false;
}

if( houzez_option('social-header') != '1' ) {
    $contact_pull_right = 'pull-right';
    $social = false;
}

$main_menu_sticky = houzez_option('main-menu-sticky');

global $current_user;
wp_get_current_user();
$userID  =  $current_user->ID;
$user_custom_picture =  get_the_author_meta( 'fave_author_custom_picture' , $userID );
$top_bar = houzez_option('top_bar');

if( $top_bar != 0 ) {
    get_template_part('inc/header/top', 'bar');
}
?>
<header id="header-section" class="header-section-3 not-splash-header houzez-header-main">

    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 hidden-sm hidden-xs">
                    <div class="logo logo-desktop">
                        <?php get_template_part('inc/header/logo'); ?>
                    </div>
                </div>

                <?php if( $contact_info != false ) { ?>
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 <?php echo sanitize_html_class( $contact_pull_right ); ?>">
                    <?php get_template_part( 'inc/header/contact', 'info' ); ?>
                </div>
                <?php } ?>

                <?php if( $social != false ) { ?>
                <div class="col-sm-2 hidden-sm hidden-xs <?php echo sanitize_html_class( $social_pull_right ); ?>">
                    <?php get_template_part( 'inc/header/social' ); ?>
                </div>
                <?php } ?>

            </div>
        </div>
    </div>
    <div class="header-bottom hidden-sm hidden-xs" data-sticky="<?php echo esc_attr( $main_menu_sticky ); ?>">
        <div class="container">
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
