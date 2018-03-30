
<?php
global $venedor_settings;

$topnav_pos = $venedor_settings['topnav-pos'];
$switcher_pos = '';
$minicart_pos = '';
$menu_align = $venedor_settings['menu-align'];
$header_on_banner = venedor_meta_header_on_banner();

// get view switcher html
$switcher_html = venedor_html_switcher();
if ($switcher_html) $switcher_pos = $venedor_settings['switcher-pos'];

// get top navigation html
$topnav_html = venedor_html_topnav();

// get main menu html
$menu_html = venedor_html_menu();

// get main mobile menu html
$mobilemenu_html = venedor_html_mobilemenu();

// get mini cart html
$minicart_html = venedor_html_minicart();
if ($minicart_html) $minicart_pos = $venedor_settings['minicart-pos'];

if ($venedor_settings['show-header-top']) : ?>
<!-- header top -->
<div class="header-top">
    <div class="container">
        <div class="<?php if ($topnav_pos == 'left') echo 'left'; else echo 'right' ?>">
            <?php if ($topnav_pos != 'none') echo $topnav_html; ?>
        </div>
        
        <div class="<?php if ($topnav_pos == 'right') echo 'left'; else echo 'right' ?>">
            <div class="welcome-msg<?php if ($topnav_pos == 'right') echo ' right'; ?>"><?php echo __($venedor_settings['welcome-msg']) ?></div>
            <?php if ($venedor_settings['show-header-login']) : ?>
            <div class="login-links<?php if ($topnav_pos == 'right') echo ' right'; ?><?php if ($switcher_pos == 'top' && $minicart_pos == 'top' && $topnav_pos != 'none') echo ' pos2' ?>">
            <?php if ( is_user_logged_in() ) : ?>
                <span class="avatar"><?php echo get_avatar( get_current_user_id(), $size = '28' ); ?></span>
                <?php if ( class_exists('WooCommerce') ) : ?>
                    <a href="<?php echo wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ) ?>" class="nav-top-link"><?php _e('Logout', 'venedor'); ?></a>
                <?php else : ?>
                    <a href="<?php echo wp_logout_url( get_home_url() ) ?>" class="nav-top-link"><?php _e('Log Out'); ?></a>
                <?php endif; ?>
            <?php else: ?>
                <?php if ( class_exists('WooCommerce') ) : ?>
                    <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="nav-top-link"><?php _e('Login', 'woocommerce'); ?></a>
                    <?php echo _e('or', 'venedor') ?>
                    <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="nav-top-link"><?php _e('Register', 'woocommerce'); ?></a>
                <?php else : ?>
                    <a href="<?php echo wp_login_url( get_home_url() ); ?>" class="nav-top-link"><?php _e('Login', 'venedor'); ?></a>
                    <?php echo _e('or', 'venedor') ?>
                    <a href="<?php echo wp_registration_url(); ?>" class="nav-top-link"><?php _e('Register', 'venedor'); ?></a>
                <?php endif; ?>
            <?php endif; ?>
            </div>
            <?php endif; ?>
            
            <?php if ($topnav_pos != 'right') : ?>
                <?php if ( $switcher_pos == 'top' ) echo $switcher_html; ?>
                <?php if ( $minicart_pos == 'top' ) echo $minicart_html; ?>
            <?php else: ?>
                <?php if ( $minicart_pos == 'top' ) echo $minicart_html; ?>
                <?php if ( $switcher_pos == 'top' ) echo $switcher_html; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- end header top -->
<?php endif; ?>

<!-- header -->
<div class="header
    <?php if ($venedor_settings['logo-pos'] == 'center') echo ' header-logo-center'; ?>
    <?php if ($venedor_settings['search-pos'] == 'middle') echo ' searchform-middle'; ?>
    <?php if ($menu_align == 'right') echo ' header-menu-right' ?>">
    <div class="container">
        <div class="row">
            <!-- header left -->
            <div class="col-sm-4 left">
                <?php if ($venedor_settings['logo-pos'] == 'left') : ?>
                <!-- logo -->
                <h1 class="logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" rel="home">
                        <?php if($venedor_settings['logo']){
                            echo '<img src="'.$venedor_settings['logo']['url'].'" />';
                            if ($header_on_banner) {
                                if ($venedor_settings['logo-on-banner']) :
                                    echo '<img class="header-banner-logo" src="'.$venedor_settings['logo-on-banner']['url'].'" />';
                                else :
                                    echo '<img class="header-banner-logo" src="'.$venedor_settings['logo']['url'].'" />';
                                endif;
                            }
                        } else {
                            bloginfo( 'name' );
                        } ?>
                    </a>
                </h1>
                <!-- end logo -->
                <?php else : ?>
                    <?php if ($venedor_settings['show-searchform'] && $venedor_settings['search-pos'] == 'middle') : ?>
                    <!-- search form -->
                    <div id="search-form">
                        <?php venedor_search_form( ); ?>
                    </div>
                    <!-- end search form -->
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <!-- end header left -->
            
            <?php if ($venedor_settings['logo-pos'] == 'center') : ?>
            <!-- start header center -->
            <div class="col-sm-4 logo-center">
                <!-- logo -->
                <h1 class="logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" rel="home">
                        <?php if($venedor_settings['logo']){
                            echo '<img src="'.$venedor_settings['logo']['url'].'" />';
                            if ($header_on_banner) {
                                if ($venedor_settings['logo-on-banner']) :
                                    echo '<img class="header-banner-logo" src="'.$venedor_settings['logo-on-banner']['url'].'" />';
                                else :
                                    echo '<img class="header-banner-logo" src="'.$venedor_settings['logo']['url'].'" />';
                                endif;
                            }
                        } else {
                            bloginfo( 'name' );
                        } ?>
                    </a>
                </h1>
                <!-- end logo -->
            </div>
            <?php endif; ?>
            
            <!-- header right -->
            <div class="col-sm-<?php if ($venedor_settings['logo-pos'] == 'center') echo 4; else echo 8; ?> right">
                <?php
                $block = get_posts( array( 'name' => $venedor_settings['header-contact-block'], 'post_type' => 'block' ) );
                if ( $switcher_pos == 'middle' || $minicart_pos == 'middle'
                    || ($venedor_settings['logo-pos'] == 'left' && $venedor_settings['show-searchform'] && $venedor_settings['search-pos'] == 'middle')
                    || ($venedor_settings['header-contact-pos'] == 'left' && $venedor_settings['header-contact-block'] && $block)) : ?>
                    <div class="switcher-wrapper clearfix">
                        <?php if ( $minicart_pos == 'middle' ) echo $minicart_html; ?>
                        <?php if ( $switcher_pos == 'middle' ) echo $switcher_html; ?>
                        <?php if ($venedor_settings['logo-pos'] == 'left' && $venedor_settings['show-searchform'] && $venedor_settings['search-pos'] == 'middle') : ?>
                        <!-- search form -->
                        <div id="search-form">
                            <?php venedor_search_form( ); ?>
                        </div>
                        <!-- end search form -->
                        <?php endif; ?>
                        <?php
                        if ($venedor_settings['header-contact-pos'] == 'left' && $venedor_settings['header-contact-block'] && $block) : ?>
                            <!-- header contact -->
                            <div class="header-contact right clearfix">
                                <?php
                                $block_content = $block[0]->post_content;
                                echo do_shortcode($block_content);
                                ?>
                            </div>
                            <!-- end header contact -->
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <?php
                if ($venedor_settings['header-contact-pos'] == 'bottom' && $venedor_settings['header-contact-block']
                    && $block) : ?>
                <!-- header contact -->
                <div class="header-contact right clearfix">
                    <?php
                    $block_content = $block[0]->post_content;
                    echo do_shortcode($block_content);
                    ?>
                </div>
                <!-- end header contact -->
                <?php endif; ?>
            </div>
            <!-- header right -->
        </div>
    </div>
    <!-- menu -->
    <div class="menu-wrapper<?php if (!$venedor_settings['show-searchform']) echo ' hide-search' ?>">
        <div class="container">
            <?php if ($menu_align == 'right') : ?>
            <!-- logo -->
            <h1 class="logo left">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" rel="home">
                    <?php if($venedor_settings['logo']){
                        echo '<img src="'.$venedor_settings['logo']['url'].'" />';
                        if ($header_on_banner) {
                            if ($venedor_settings['logo-on-banner']) :
                                echo '<img class="header-banner-logo" src="'.$venedor_settings['logo-on-banner']['url'].'" />';
                            else :
                                echo '<img class="header-banner-logo" src="'.$venedor_settings['logo']['url'].'" />';
                            endif;
                        }
                    } else {
                        bloginfo( 'name' );
                    } ?>
                </a>
            </h1>
            <!-- end logo -->
            <?php endif; ?>

            <?php if ($menu_align == 'left') : ?>
                <?php echo $menu_html; ?>
                <?php echo $mobilemenu_html; ?>
            <?php endif; ?>
            
            <!-- quick access -->
            <div class="quick-access<?php if ($venedor_settings['search-popup']) echo ' search-popup' ?>">
                <?php if (($venedor_settings['logo-pos'] == 'left' ||
                    ($venedor_settings['logo-pos'] == 'center' && $venedor_settings['search-pos'] == 'bottom'))
                    && $venedor_settings['show-searchform']) : ?>
                <!-- search form -->
                <div id="search-form" class="<?php echo $venedor_settings['search-pos'] ?>">
                    <?php venedor_search_form( ); ?>
                </div>
                <!-- end search form -->
                <?php endif; ?>
                
                <?php if ($switcher_pos == 'middle' || $switcher_pos == 'bottom') echo $switcher_html; ?>
                <?php if ($minicart_pos == 'middle' || $minicart_pos == 'bottom') echo $minicart_html; ?>
            </div>
            <!-- end quick access -->
            
            <?php if ($menu_align == 'right') : ?>
                <?php echo $menu_html; ?>
                <?php echo $mobilemenu_html; ?>
            <?php endif; ?>
        </div>
        <div class="container-shadow"></div>
    </div>
    <!-- end menu -->
</div>
<!-- end header -->
