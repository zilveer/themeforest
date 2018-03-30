<?php

/* Don't render if it is not enabled */
if (sq_option('header_sidemenu', true, true) != true ) {
    return false;
}


$primary_menu = wp_nav_menu( array(
        'theme_location'    => 'primary',
        'depth'             => 4,
        'container'         => '',
        'container_class'   => '',
        'menu_class'        => 'menu-list kleo-nav-menu',
        'before'       => '',
        'after'        => '',
        'link_before'       => '<span>',
        'link_after'        => '</span>',
        'fallback_cb'     => 'kleo_side_pages_nav',
        //'fallback_cb'       => '',
        'walker'            => new kleo_walker_nav_menu(),
        'echo'              => false
    )
);

/* Sidemenu bottom text */
$bottom_text = '';
$sidemenu_class = 'sidemenu-colors';
if ( sq_option( 'header_bottom_text', Kleo::get_config( 'footer_text' ) ) ) {
    $bottom_text = sq_option( 'header_bottom_text' );
    $sidemenu_class .= ' has-sidemenu-footer';
}

$logo_side = Kleo::get_config( 'logo_side' );

$logo_attr = sq_option( $logo_side . '_retina' ) ? 'data-retina="' . esc_attr(sq_option( $logo_side . '_retina' )) . '"' : '';
$logo_mini_attr = sq_option( 'logo_mini_retina' ) ? 'data-retina="' . esc_attr(sq_option(  'logo_mini_retina' )) . '"' : '';

$logo_link = home_url();

?>


<!-- Sidemenu Wrapper
 ============================================= -->

<div id="sidemenu-wrapper" class="<?php echo esc_attr( $sidemenu_class ); ?>">
   
    <div class="sidemenu-inner">
       <div class="sidemenu-header">
            
            <div class="logo">
                <!--logo standard-->
                <?php if (sq_option( $logo_side, Kleo::get_config( $logo_side . '_default' ), true )) : ?>
                    <a href="<?php echo esc_url( $logo_link ); ?>" class="real-logo standard-logo" <?php echo $logo_attr;?>>
                        <img src="<?php echo sq_option( $logo_side, Kleo::get_config( $logo_side . '_default' ), true ); ?>" alt="<?php bloginfo('name'); ?>">
                    </a>
                <?php endif;?>
        
                <!--mini logo - when sidemenu is minimized-->
                <?php if (sq_option( 'logo_mini', Kleo::get_config('logo_mini_default'), true )) : ?>
                <a href="<?php echo esc_url( $logo_link ); ?>" class="mini-logo standard-logo" <?php echo $logo_mini_attr;?>>
                    <img src="<?php echo sq_option( 'logo_mini', Kleo::get_config('logo_mini_default'), true ); ?>" alt="<?php bloginfo('name'); ?>">
                </a>
                <?php endif;?>
            </div>
            <p><?php _e ( "Menu", "buddyapp" ); ?></p>
        </div>
        
        <div class="sidemenu-main">
            <div class="sidemenu-main-inner">
                <div class="scroll-container-wrapper">
                    <div class="scroll-container">
                        
                        <div class="menu-section click-menu">
                        
                            <?php echo $primary_menu; ?>
                        
                        </div>
                        
                        <?php if ( is_active_sidebar( 'side' ) ) : ?>
                            <div class="widgets-section">
                                <?php dynamic_sidebar( 'side' ); ?>
                            </div><!-- .widget-area -->
                        <?php endif; ?>
                        
                    </div>
                </div>
            </div>
        </div>
        
        <?php if ( $bottom_text != '' ) : ?>
        
            <div class="sidemenu-footer">
                <div class="sidemenu-footer-inner">
                <?php echo do_shortcode( $bottom_text ); ?>
                </div>
            </div>
        
        <?php endif ;?>
    </div>

</div>