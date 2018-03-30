<?php
global $az_options_show_header;
global $woocommerce;

$options_ibuki = get_option('ibuki'); 

// Logo Options
if( !empty($options_ibuki['use-logo'])) {
    $logo = $options_ibuki['logo'];
    $retina_logo = $options_ibuki['retina-logo'];
    $width = $options_ibuki['logo']['width'];
    $height = $options_ibuki['logo']['height'];

    if ($retina_logo['url'] == "" ) {
        $retina_logo['url'] = $logo['url'];
    }
}

// Preloader Settings
$preloader_options = null;
if( !empty($options_ibuki['enable-preloader']) && $options_ibuki['enable-preloader'] == 1) { 
    $preloader_options = 'preloader-enabled'; 
} else { 
    $preloader_options = 'no-preloader';
}

if( !empty($options_ibuki['enable-preloader']) && $options_ibuki['enable-preloader'] == 1) {
    $preloader = (!empty($options_ibuki['preloader-selection'])) ? $options_ibuki['preloader-selection'] : '2';
    if($preloader == '1'){
        $preloader_options = 'preloader-enabled';
    }
    else if($preloader == '2'){
        if ( is_home() || is_search() || is_404() ) {
            $check_preloader_settings = get_post_meta(get_option('page_for_posts'), '_az_preloader_settings', true);
        } 
        else if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
            if(is_shop() || is_product_category() || is_product_tag()) {
                $check_preloader_settings = get_post_meta(woocommerce_get_page_id('shop'), '_az_preloader_settings', true);
            }
            else if ( is_product() ){
                global $wp_query;
                $postid = $wp_query->post->ID;

                $check_preloader_settings = get_post_meta($postid, '_az_preloader_settings', true);
            }
        } 
        else if (is_archive()) {
            $check_preloader_settings = get_post_meta(get_option('page_for_posts'), '_az_preloader_settings', true);
        }
        else {           
            global $wp_query;
            $postid = $wp_query->post->ID;
            
            $check_preloader_settings = get_post_meta($postid, '_az_preloader_settings', true);
        }

        // Output Preloader
        if ( $check_preloader_settings == "enabled") {
            $preloader_options = 'preloader-enabled';
        } else {
            $preloader_options = 'no-preloader';
        }
    }
}

// Animation Mobile Effects
$animation_effects_options = null;
if( !empty($options_ibuki['enable-animation-effects']) && $options_ibuki['enable-animation-effects'] == 1) { 
    $animation_effects_options = 'animation-effects-enabled'; 
} else { 
    $animation_effects_options = 'no-animation-effects';
}

// Nice Scroll
$nicescroll_options = 'no-nice-scroll';

// Header Settings
$header_type = $options_ibuki['header-type'];

$header_main_class = null;
$header_container = null;
$main_class = null;

if($header_type == 'header-left-button') {
    $header_main_class = 'header-left-button-enabled';
    $main_class = 'left-menu-button';
}
else if($header_type == 'header-left-opened') {
    $header_main_class = 'header-left-opened-enabled';
    $main_class = 'left-menu';
}
else if($header_type == 'header-right-button') {
    $header_main_class = 'header-right-button-enabled';
    $main_class = 'right-menu-button';
}
else if($header_type == 'header-right-opened') {
    $header_main_class = 'header-right-opened-enabled';
    $main_class = 'right-menu';
}
else if($header_type == 'header-normal') {
    $header_main_class = 'header-normal-enabled';
    $main_class = 'menu-normal';
}
else if($header_type == 'header-fixed') {
    $header_main_class = 'header-fixed-enabled';
    $main_class = 'menu-fixed';
}
else if($header_type == 'header-sticky') {
    $header_main_class = 'header-sticky-enabled';
    $main_class = 'menu-sticky';
}
else {
    $header_main_class = 'header-normal-enabled';
    $main_class = 'menu-normal';
}

if($header_type == 'header-normal' || $header_type == 'header-fixed' || $header_type == 'header-sticky') {
    $header_container = $options_ibuki['header-container'];
}
else {
    $header_container = 'no-simple';
}

// Transparent Header
$header_transparent_class = 'no-transparent-enabled';
$header_color_mode = 'no-transparent-color';
$logo_img_white = null;
$logo_img_retina_white = null;
if( !empty($options_ibuki['use-transparent-header']) && $options_ibuki['use-transparent-header'] == 1) {
    
    if ( is_home() || is_search() || is_404() ) {
        $check_transparent_settings = get_post_meta(get_option('page_for_posts'), '_az_transparent_header_settings', true);
        $check_color_settings = get_post_meta(get_option('page_for_posts'), '_az_transparent_header_color_settings', true);  
    } 
    else if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
        if(is_shop() || is_product_category() || is_product_tag()) {
            $check_transparent_settings = get_post_meta(woocommerce_get_page_id('shop'), '_az_transparent_header_settings', true);
            $check_color_settings = get_post_meta(woocommerce_get_page_id('shop'), '_az_transparent_header_color_settings', true); 
        }
        else if ( is_product() ){
            global $wp_query;
            $postid = $wp_query->post->ID;

            $check_transparent_settings = get_post_meta($postid, '_az_transparent_header_settings', true);
            $check_color_settings = get_post_meta($postid, '_az_transparent_header_color_settings', true); 
        }
    } 
    else if (is_archive()) {
        $check_transparent_settings = get_post_meta(get_option('page_for_posts'), '_az_transparent_header_settings', true);
        $check_color_settings = get_post_meta(get_option('page_for_posts'), '_az_transparent_header_color_settings', true); 
    }
    else {           
        global $wp_query;
        $postid = $wp_query->post->ID;
        
        $check_transparent_settings = get_post_meta($postid, '_az_transparent_header_settings', true);
        $check_color_settings = get_post_meta($postid, '_az_transparent_header_color_settings', true); 
    }

    // Output Transparent Header
    if ( $check_transparent_settings == "enabled") {
        $header_transparent_class = 'header-transparent-enabled';
        $header_color_mode = $check_color_settings;
    } else {
        $header_transparent_class = 'no-transparent-enabled';
        $header_color_mode = 'no-transparent-color';
    }

    if ( $check_transparent_settings == "enabled" && $check_color_settings == "white-color") {

        if( !empty($options_ibuki['use-logo'])) {
            $logo_white = $options_ibuki['logo-white'];
            $retina_logo_white = $options_ibuki['retina-logo-white'];
            $width_white = $options_ibuki['logo-white']['width'];
            $height_white = $options_ibuki['logo-white']['height'];

            if ($retina_logo_white['url'] == "" ) {
                $retina_logo_white['url'] = $logo_white['url'];
            }
            $logo_img_white = '<img class="standard white-color" src="'.$logo_white['url'].'" alt="'.get_bloginfo('name').'" width="'.$width_white.'" height="'.$height_white.'" style="height: '.$height_white.'px;" />';
            $logo_img_retina_white = '<img class="retina white-color" src="'.$retina_logo_white['url'].'" alt="'.get_bloginfo('name').'" width="'.$width_white.'" height="'.$height_white.'" style="height: '.$height_white.'px;" />';        
        }
    }  
}

// Right Click
$right_click_options = null;
if( !empty($options_ibuki['right-click-option']) && $options_ibuki['right-click-option'] == 1) { 
    $right_click_options = 'right-click-block-enabled'; 
} else { 
    $right_click_options = 'right-click-block-disabled';
}

?>
<!DOCTYPE html>
<!--[if gte IE 9]>
<html class="no-js lt-ie9 animated-content no-animation-effects <?php echo $nicescroll_options; ?> <?php echo $right_click_options; ?> no-preloader" <?php language_attributes(); ?>>     
<![endif]-->
<html <?php language_attributes(); ?> class="no-js <?php echo $nicescroll_options; ?> <?php echo $right_click_options; ?> <?php echo $preloader_options; ?> <?php echo $animation_effects_options; ?>">
<head>

<!-- Meta Tags -->
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<!-- Mobile Specifics -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Mobile Internet Explorer ClearType Technology -->
<!--[if IEMobile]>  <meta http-equiv="cleartype" content="on"><![endif]-->

<?php if(!empty($options_ibuki['favicon']['url'])) { ?>
<!--Shortcut icon-->
<link rel="shortcut icon" href="<?php echo $options_ibuki['favicon']['url']; ?>" />
<?php } ?>

<!-- Title -->
<title><?php wp_title('|',true,'right'); ?><?php bloginfo('name'); ?></title>

<!-- RSS & Pingbacks -->
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php bloginfo( 'rss2_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>

</head>

<!-- Body -->
<body <?php body_class(); ?>>

<?php 
if( !empty($options_ibuki['enable-preloader']) && $options_ibuki['enable-preloader'] == 1) {
    $preloader = (!empty($options_ibuki['preloader-selection'])) ? $options_ibuki['preloader-selection'] : '2';
    $preloader_design = (!empty($options_ibuki['preloader-design'])) ? $options_ibuki['preloader-design'] : '1';
    if($preloader == '1'){
        if($preloader_design == '1'){

echo '
<!-- Loading -->
<div id="loader-container">
    <div class="top-bar"></div>

    <div class="loading-spinner"></div>
    <div id="loader-percentage"></div>


    <div id="logo-content">
        <div class="loading-text">'.esc_attr($options_ibuki['preloader-text']).'</div>
    </div>
</div>
<!-- End Loading -->';

        }
        else if($preloader_design == '2'){
            // Preloader Spinner
            $preloader_spinner_output = null;
            $preloader_spinner_mode = (!empty($options_ibuki['preloader-spinner-value'])) ? $options_ibuki['preloader-spinner-value'] : '1';

            if($preloader_spinner_mode == '1'){
                $preloader_spinner_output = '';
            }
            else if($preloader_spinner_mode == '2'){
                $preloader_spinner_output = '<div class="loading-spinner"></div>';
            }  
            else if($preloader_spinner_mode == '3'){
                $preloader_spinner_output = '<div class="loading-spinner"></div><div id="loader-percentage"></div>';
            } else {
                $preloader_spinner_output = '';
            }

            // Preloader Image
            $preloader_image = $options_ibuki['preloader-media-image'];
            $preloader_image_width = $options_ibuki['preloader-media-image']['width'];
            $preloader_image_height = $options_ibuki['preloader-media-image']['height'];
            $preloader_image_width_content = $preloader_image_width/2;
            $preloader_image_height_content = $preloader_image_height/2;

echo '
<!-- Loading -->
<div id="loader-container">
    <div class="top-bar"></div>
    '.$preloader_spinner_output.'
    <div id="logo-content" style="width: '.$preloader_image_width.'px; height: '.$preloader_image_height.'px; margin-left: -'.$preloader_image_width_content.'px; margin-top: -'.$preloader_image_height_content.'px;">
        <div class="loading-image" style=" background-image: url('.$preloader_image['url'].'); width: '.$preloader_image_width.'px; height: '.$preloader_image_height.'px;" ></div>
    </div>
</div>
<!-- End Loading -->';

        } 
    }
    else if( $preloader == '2' ) {
        if ( is_home() || is_search() || is_404() ) { az_preloader_content(get_option('page_for_posts')); }
        else if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
            if(is_shop() || is_product_category() || is_product_tag()) {
                az_preloader_content(woocommerce_get_page_id('shop'));
            } else if ( is_product() ){ az_preloader_content($postid); }
        } 
        else if ( is_archive() ) { az_preloader_content(get_option('page_for_posts')); }
        else { az_preloader_content($postid); }
    }
}
?>

<?php 
$no_header = null;
if($az_options_show_header) { 
    $no_header = ' no-header-footer-layout-disabled';
} else {
    $no_header = ' no-header-footer-layout-enabled';
} ?>

<?php
/* One Page Classes */
$wrap_id = null; 
$one_page = null;
if ( is_page_template( 'template-one-page.php' ) ) {
    $wrap_id = ' id="top-page"';
    $one_page = 'one-page-enabled';
} else {
    $wrap_id = '';
    $one_page = 'one-page-disabled';
} ?>

<!-- Wrap -->
<div<?php echo $wrap_id; ?> class="wrap_all desktop-enabled <?php echo $main_class; ?><?php echo $no_header; ?>">

<?php if($az_options_show_header) { /* Start $show_header; */ ?>

<!-- Header -->
<header class="header-menu <?php echo $header_type; ?> <?php echo $header_transparent_class; ?> <?php echo $header_color_mode; ?> <?php echo $one_page; ?>">

<!-- Mobile Menu Buttons -->
<div class="mobile-buttons">
<a id="mobile-nav" class="menu-nav mobile" href="#navigation-mobile"><i class="menu-icon"></i></a>
<?php if( !empty($options_ibuki['use-social-button']) && $options_ibuki['use-social-button'] == '1' ) { ?>
<a class="social-nav social-menu-nav mobile" data-toggle="modal" href="#" data-target="#myModalSocial"><i class="font-icon-share"></i></a>
<?php } ?>
<?php if( !empty($options_ibuki['use-search-button']) && $options_ibuki['use-search-button'] == '1' ) { ?>
<a id="search-nav" class="search-menu-nav mobile" data-toggle="modal" href="#" data-target="#myModalSearch"><i class="font-icon-search"></i></a>
<?php } ?>
<?php if ($woocommerce) { 
        if( !empty($options_ibuki['enable-cart-button']) && $options_ibuki['enable-cart-button'] == '1' ) { ?>
<a class="woo-cart cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><i class="font-icon-bag"></i><span class="woocommerce-notification-bubble"><?php echo $woocommerce->cart->cart_contents_count; ?></span></a>
<?php }
    } ?>
</div>
<!-- End Mobile Menu Buttons -->

<!-- Left / Right Header Menu Buttons -->
<div class="desktop-buttons">
<?php if($header_type == 'header-left-button' || $header_type == 'header-right-button') { ?>
    <a id="desktop-nav" class="menu-nav" href="#my-menu"><i class="menu-icon"></i></a>
    <?php if ($woocommerce) { 
            if( !empty($options_ibuki['enable-cart-button']) && $options_ibuki['enable-cart-button'] == '1' ) { ?>
    <a class="woo-cart cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><i class="font-icon-bag"></i><span class="woocommerce-notification-bubble"><?php echo $woocommerce->cart->cart_contents_count; ?></span></a>
    <?php   }
          } ?>
    <?php if( !empty($options_ibuki['use-search-button']) && $options_ibuki['use-search-button'] == '1' ) { ?>
    <a class="search-menu-nav" data-toggle="modal" href="#" data-target="#myModalSearch"><i class="font-icon-search"></i></a>
    <?php } ?>
    <?php if( !empty($options_ibuki['use-social-button']) && $options_ibuki['use-social-button'] == '1' ) { ?>
    <a class="social-nav social-menu-nav" data-toggle="modal" href="#" data-target="#myModalSocial"><i class="font-icon-share"></i></a>
    <?php } ?>
<?php } ?>
</div>
<!-- End Left / Right Header Menu Buttons -->

<!-- Menu Desktop -->
<div id="my-menu" class="<?php echo $header_container; ?>">
    <nav class="mm-panel">
        <?php
        if ( !empty($options_ibuki['use-logo'])) {?>
        <a id="logo" class="logo-img" href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>">
            <img class="standard" src="<?php echo $logo['url']; ?>" alt="<?php bloginfo('name'); ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" style="height:<?php echo $height; ?>px;" />
            <img class="retina" src="<?php echo $retina_logo['url']; ?>" alt="<?php bloginfo('name'); ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
            <?php if( $header_type == 'header-sticky' ) {
                    if( !empty($options_ibuki['use-transparent-header']) && $options_ibuki['use-transparent-header'] == 1) { ?>
                <?php echo $logo_img_white; ?>
                <?php echo $logo_img_retina_white; ?>
            <?php   } 
                  } ?>
        </a>    
        <?php } else { ?>
        <a id="logo" class="logo-text" href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a>
        <?php } ?>

        <ul class="sf-menu desktop-menu">
        <?php 
            if ( is_page_template( 'template-one-page.php' ) ) {
                if(has_nav_menu('one_page_menu')) {
                    wp_nav_menu( array('theme_location' => 'one_page_menu', 'container' => '', 'items_wrap' => '%3$s', 'walker' => new az_onepagemenu_walker ) ); 
                } else {
                    echo '<li><a href="#">No menu assigned!</a></li>';
                }
            } else {
                if(has_nav_menu('primary_menu')) {
                    wp_nav_menu( array('theme_location' => 'primary_menu', 'container' => '', 'items_wrap' => '%3$s' ) ); 
                } else {
                    echo '<li><a href="#">No menu assigned!</a></li>';
                }
            }
        ?>
        <?php if($header_type == 'header-normal' || $header_type == 'header-fixed' || $header_type == 'header-sticky') {
                if ($woocommerce) { 
                    if( !empty($options_ibuki['enable-cart-button']) && $options_ibuki['enable-cart-button'] == '1' ) { ?>
            <li class="woocommerce-cart"><a class="woo-cart cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><i class="font-icon-bag"></i><span class="woocommerce-notification-bubble"><?php echo $woocommerce->cart->cart_contents_count; ?></span></a></li>
        <?php       }
                } 
              } ?>
        <?php if($header_type == 'header-normal' || $header_type == 'header-fixed' || $header_type == 'header-sticky') {
                if( !empty($options_ibuki['use-search-button']) && $options_ibuki['use-search-button'] == '1' ) { ?>
            <li><a class="search-menu-nav" data-toggle="modal" href="#" data-target="#myModalSearch"><i class="font-icon-search"></i></a></li>
        <?php   } 
              } ?>
        <?php if($header_type == 'header-normal' || $header_type == 'header-fixed' || $header_type == 'header-sticky') {
                if( !empty($options_ibuki['use-social-button']) && $options_ibuki['use-social-button'] == '1' ) { ?>
            <li><a class="social-nav social-menu-nav" data-toggle="modal" href="#" data-target="#myModalSocial"><i class="font-icon-share"></i></a></li>
        <?php   } 
              } ?>
        </ul>
    </nav>

    <?php if($header_type == 'header-left-button' || $header_type == 'header-right-button' || $header_type == 'header-left-opened' || $header_type == 'header-right-opened') { ?>
    <div class="copyright">
        <?php if(!empty($options_ibuki['header-copyright-text'])) { ?>
        <div class="copyright-text"><?php echo $options_ibuki['header-copyright-text']; ?></div>
        <?php } else { ?>
        <div class="copyright-text">&copy; <?php _e('Copyright ', AZ_THEME_NAME); echo date( 'Y' ); ?> <a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></div>
        <?php } ?>
    </div>
    <?php } ?>

    <?php 
    if($header_type == 'header-left-opened' || $header_type == 'header-right-opened') {
        if( !empty($options_ibuki['use-social-button']) && $options_ibuki['use-social-button'] == '1' ) { ?>
            <a class="social-nav social-menu-nav desktop" data-toggle="modal" href="#" data-target="#myModalSocial"><i class="social-icon"></i></a>
    <?php } 
    }?>
</div>
<!-- End Menu Desktop -->

</header>

<?php if( !empty($options_ibuki['use-search-button']) && $options_ibuki['use-search-button'] == '1' ) { ?>
<!-- Search Modal -->
<div id="search-button-modal">
<div class="modal modal-custom fade" id="myModalSearch" tabindex="-1" role="dialog" aria-hidden="true">
    <a class="close-modal" data-dismiss="modal" href="#"><i class="close-btn"></i>Close</a>

    <div class="modal-dialog modal-vertical-centered">
        <form method="get" id="searchform" action="<?php echo home_url(); ?>/">
            <fieldset>
                <input id="search_modal" type="text" name="s" value="" autocomplete="off" placeholder="<?php _e('To search type and hit enter...', AZ_THEME_NAME); ?>" />
            </fieldset>
        </form>
    </div>
</div>
</div>
<!-- End Search Modal -->
<?php } ?>

<?php if( !empty($options_ibuki['use-social-button']) && $options_ibuki['use-social-button'] == '1' ) { ?>
<!-- Social Modal -->
<div id="social-button-modal">
<div class="modal modal-custom fade" id="myModalSocial" tabindex="-1" role="dialog" aria-hidden="true">
    <a class="close-modal" data-dismiss="modal" href="#"><i class="close-btn"></i>Close</a>

    <div class="modal-dialog modal-vertical-centered">
        <div class="social-profile-container">
            <?php
            global $socials_profiles;

            foreach($socials_profiles as $social_profile):
                if( $options_ibuki[$social_profile.'-url'] ) {
                    echo '
                    <a href="'.$options_ibuki[$social_profile.'-url'].'" target="_blank"><i class="font-icon-social-'.$social_profile.'"></i></a>';
                }
            endforeach;
            ?>
        </div>
    </div>
</div>
</div>
<!-- End Social Modal -->
<?php } ?>

<!-- Mobile Menu -->
<div id="navigation-mobile">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <ul class="mobile-menu">
                <?php 
                    if ( is_page_template( 'template-one-page.php' ) ) {
                        if(has_nav_menu('one_page_menu')) {
                            wp_nav_menu( array('theme_location' => 'one_page_menu', 'container' => '', 'items_wrap' => '%3$s', 'walker' => new az_onepagemenu_walker ) ); 
                        } else {
                            echo '<li><a href="#">No menu assigned!</a></li>';
                        }
                    } else {
                        if(has_nav_menu('primary_menu')) {
                            wp_nav_menu( array('theme_location' => 'primary_menu', 'container' => '', 'items_wrap' => '%3$s' ) ); 
                        } else {
                            echo '<li><a href="#">No menu assigned!</a></li>';
                        }
                    }
                ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Mobile Menu -->

<?php /* End $show_header */ } ?>

<!-- Main -->
<div id="main" class="<?php echo $header_main_class; ?> <?php echo $header_transparent_class; ?>">