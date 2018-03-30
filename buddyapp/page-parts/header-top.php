<!-- Header
============================================= -->

<?php
//white or dark logo
$logo_mobile = Kleo::get_config( 'logo_mobile' );
$logo_attr = sq_option( $logo_mobile . '_retina', '' ) ? 'data-retina="' . esc_attr( sq_option( $logo_mobile . '_retina' ) ) . '"' : '';
$logo_link = home_url();

$current_header_classes = 'header-colors header-layout-01';

/* Check if search is active */
if ( sq_option( 'header_search', true, true ) )  {
    $current_header_classes .= ' has-search';
}

/* Check how dropdown triggers */
if ( sq_option( 'menu_dropdown', 'hover', true ) == 'hover' )  {
    $current_header_classes .= ' hover-menu';
} else {
    $current_header_classes .= ' click-menu';
}


?>

<header id="header" <?php kleo_header_class( $current_header_classes ); ?>>

    <div id="header-wrap">

            <div class="logo">
                <!-- top-header and mobile logo only-->
                <?php if ( sq_option( $logo_mobile, Kleo::get_config($logo_mobile . '_default') ) ) : ?>

                    <a href="<?php echo esc_url( $logo_link ); ?>" class="mobile-logo standard-logo" <?php echo $logo_attr;?>>
                        <img src="<?php echo sq_option( $logo_mobile, Kleo::get_config($logo_mobile . '_default') ); ?>" alt="<?php bloginfo('name'); ?>">
                    </a>

                <?php endif; ?>

            </div>

            <div class="header-left">
                <a href="#" class="sidemenu-trigger sidemenu-icon-wrapper">
                    <span class="sidemenu-icon">
                        <span><i></i><b></b></span>
                        <span><i></i><b></b></span>
                        <span><i></i><b></b></span>
                    </span>
                </a>
            </div>
            <div class="header-right">
                <a href="#" class="second-menu-trigger second-menu-icon-wrapper">
                    <span class="second-menu-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                    
                    <!--<i class="icon-storage"></i>-->
                </a>
            </div>

            <div class="second-menu">
                    <div class="second-menu-main">
                       <div class="second-menu-inner">
                        <div class="scroll-container-wrapper">
                            <div class="scroll-container">
                                <div class="second-menu-section">
                                   
                                    <?php
                                    // Top left navigation menu.
                                    wp_nav_menu( array(
                                        'theme_location' => 'top-left',
                                        'menu_class'     => 'basic-menu header-icons kleo-nav-menu',
                                        'container' => false,
                                        'link_before'       => '<span>',
                                        'link_after'        => '</span>',
                                        'depth' => 4,
                                        'max_elements' => 5,
                                        'walker' => new kleo_walker_nav_menu(),
                                        'fallback_cb' => 'kleo_header_icons_menu'
                                    ) );
                                    ?>


                                    <?php
                                    /* Check if search is active */
                                    if ( sq_option( 'header_search', true, true ) ) : ?>

                                        <!-- The search form -->
                                        <div class="search-form-wrapper">
                                            <?php
                                            $context = sq_option( 'search_context', '' );
                                            echo kleo_search_form(array('context' => $context)); ?>
                                        </div>

                                    <?php endif; ?>


                                    <?php
                                    /* Show my menu under the profile image just for logged in members */
                                    if ( sq_option('header_right_logic', 'default', true ) == 'default' ): ?>

                                        <?php if (is_user_logged_in()) : ?>

                                            <ul class="basic-menu header-menu">
                                                <li class="has-submenu kleo-user_avatar-nav my-profile-default">
                                                    <?php
                                                    echo '<a href="#" class="open-submenu">' . kleo_get_avatar();
                                                    echo '<span>';
                                                    $current_user = wp_get_current_user();
                                                    echo esc_html( $current_user->display_name );
                                                    echo '</span>';
                                                    echo '</a><span class="menu-arrow"></span>';
                                                    ?>

                                                    <?php
                                                    // Top right navigation menu.
                                                    wp_nav_menu( array(
                                                        'theme_location' => 'top-right',
                                                        'menu_class'     => 'submenu',
                                                        'container'      => false,
                                                        'link_before'    => '',
                                                        'link_after'     => '',
                                                        'depth'          => 4,
                                                        'walker'         => new kleo_walker_nav_menu(),
                                                        'fallback_cb'    => 'kleo_bp_menu',
                                                    ) );
                                                    ?>
                                                </li>
                                            </ul>

                                        <?php else : ?>

                                            <div class="show-login">
                                                <a href="">
                                                    <i class="icon-lock"></i>
                                                    <?php esc_html_e( "Login", 'buddyapp' ); ?>
                                                </a>
                                            </div>

                                        <?php endif; ?>

                                    <?php
                                    /* Show my menu horizontally */
                                    else: ?>

                                        <?php
                                        // Top right navigation menu.
                                        wp_nav_menu( array(
                                            'theme_location' => 'top-right',
                                            'menu_class'     => 'basic-menu header-menu',
                                            'container'      => false,
                                            'link_before'    => '',
                                            'link_after'     => '',
                                            'depth'          => 4,
                                            'walker'         => new kleo_walker_nav_menu(),
                                            'fallback_cb'    => 'kleo_bp_menu'
                                        ) );
                                        ?>

                                    <?php endif; ?>


                                    <?php
                                    /**
                                     * If WPML plugin is active, the language sub-menu will show here
                                     */

                                    do_action( 'kleo_header_language' );
                                    ?>

                                </div>
                                
                                
                                
                            </div>
                        </div>
                        
                        
                       </div>
                    </div>
                    

            </div>



    </div>

</header><!-- #header end -->
