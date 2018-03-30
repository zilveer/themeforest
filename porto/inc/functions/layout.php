<?php

require_once(porto_functions . '/layout/breadcrumbs.php');
require_once(porto_functions . '/layout/page-title.php');

add_action('wp_head', 'porto_output_skin_options');
add_action('wp_footer', 'porto_output_custom_js_body');

function porto_logo( $sticky_logo = false) {
    global $porto_settings;

    ob_start();

    if ($porto_settings['logo-overlay'] && $porto_settings['logo-overlay']['url']) :
        $logo = $porto_settings['logo-overlay']['url'];
        $logo_width = $porto_settings['logo-overlay-width'] ? $porto_settings['logo-overlay-width'] : 250;
        ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" class="overlay-logo">
            <?php
            echo '<img class="img-responsive" src="' . esc_url(str_replace( array( 'http:', 'https:' ), '', $logo)) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" style="max-width:' . esc_attr($logo_width) . 'px;" />';
            ?>
        </a>
    <?php
    endif;

    if ( (( is_front_page() && is_home()) || is_front_page()) && !$sticky_logo ) : ?><h1 class="logo"><?php else : ?><div class="logo"><?php endif; ?>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>"<?php if (!$sticky_logo) echo ' rel="home"' ?>>
        <?php if ($porto_settings['logo'] && $porto_settings['logo']['url']) {
            $logo_width = '';
            $logo_height = '';
            $logo = $porto_settings['logo']['url'];
            if ($sticky_logo && $porto_settings['sticky-logo'] && $porto_settings['sticky-logo']['url'])
                $logo = $porto_settings['sticky-logo']['url'];
            if ( isset($porto_settings['logo-retina-width']) && isset($porto_settings['logo-retina-height']) && $porto_settings['logo-retina-width'] && $porto_settings['logo-retina-height'] ) {
                $logo_width = (int)$porto_settings['logo-retina-width'];
                $logo_height = (int)$porto_settings['logo-retina-height'];
            }

            echo '<img class="img-responsive standard-logo"'.($logo_width?' width="'.$logo_width.'"':'').($logo_height?' height="'.$logo_height.'"':'').' src="' . esc_url(str_replace( array( 'http:', 'https:' ), '', $logo)) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" />';

            $retina_logo = '';
            if (isset($porto_settings['logo-retina']) && $porto_settings['logo-retina'] && $porto_settings['logo-retina']['url']) {
                $retina_logo = $porto_settings['logo-retina']['url'];
            }
            if ($sticky_logo && isset($porto_settings['sticky-logo-retina']) && $porto_settings['sticky-logo-retina'] && $porto_settings['sticky-logo-retina']['url']) {
                $retina_logo = $porto_settings['sticky-logo-retina']['url'];
            }

            if ($retina_logo) {
                echo '<img class="img-responsive retina-logo"'.($logo_width?' width="'.$logo_width.'"':'').($logo_height?' height="'.$logo_height.'"':'').' src="' . esc_url(str_replace( array( 'http:', 'https:' ), '', $retina_logo)) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" style="max-height:'.$logo_height.'px;display:none;" />';
            } else {
                echo '<img class="img-responsive retina-logo"'.($logo_width?' width="'.$logo_width.'"':'').($logo_height?' height="'.$logo_height.'"':'').' src="' . esc_url(str_replace( array( 'http:', 'https:' ), '', $logo)) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" style="display:none;" />';
            }
        } else {
            bloginfo( 'name' );
        } ?>
    </a>
    <?php if ( (( is_front_page() && is_home()) || is_front_page()) && !$sticky_logo ) : ?></h1><?php else : ?></div><?php
    endif;

    return apply_filters('porto_logo', ob_get_clean());
}

function porto_banner($banner_class = '') {
    global $porto_settings;

    $banner_type = porto_get_meta_value('banner_type');
    $master_slider = porto_get_meta_value('master_slider');
    $rev_slider = porto_get_meta_value('rev_slider');
    $banner_block = porto_get_meta_value('banner_block');

    $banner_class .= (porto_get_wrapper_type() != 'boxed' && $porto_settings['banner-wrapper'] == 'boxed') ? ' banner-wrapper-boxed' : '';

    $post_types = array('post', 'portfolio', 'member');
    foreach ($post_types as $post_type) {
        if (is_singular($post_type)) {
            if (isset($porto_settings[$post_type . '-banner-block']) && $porto_settings[$post_type . '-banner-block']) {
                ?>
                <div class="banner-container">
                    <div id="banner-wrapper" class="<?php echo $banner_class ?>">
                        <?php echo do_shortcode('[porto_block name="'.$porto_settings[$post_type . '-banner-block'].'"]'); ?>
                    </div>
                </div>
                <?php
            }
        }
    }

    if ($banner_type === 'master_slider' && isset($master_slider)) { ?>
        <div class="banner-container">
            <div id="banner-wrapper" class="<?php echo $banner_class ?>">
                <?php echo do_shortcode('[masterslider id="'.$master_slider.'"]'); ?>
            </div>
        </div>
    <?php } else if ($banner_type === 'rev_slider' && isset($rev_slider)) { ?>
        <div class="banner-container">
            <div id="banner-wrapper" class="<?php echo $banner_class ?>">
                <?php echo do_shortcode('[rev_slider '.$rev_slider.']'); ?>
            </div>
        </div>
    <?php } else if ($banner_type === 'banner_block' && isset($banner_block)) { ?>
        <div class="banner-container">
            <div id="banner-wrapper" class="<?php echo $banner_class ?>">
                <?php echo do_shortcode('[porto_block name="'.$banner_block.'"]'); ?>
            </div>
        </div>
    <?php
    }
}

function porto_currency_switcher() {
    global $porto_settings;

    ob_start();
    if ( !$porto_settings['wcml-switcher'] && has_nav_menu( 'currency_switcher' ) ) :
        wp_nav_menu(array(
            'theme_location' => 'currency_switcher',
            'container' => '',
            'menu_class' => 'currency-switcher mega-menu show-arrow' . ($porto_settings['switcher-effect']?' '.$porto_settings['switcher-effect']:'') . ($porto_settings['menu-sub-effect']?' '.$porto_settings['menu-sub-effect']:''),
            'before' => '',
            'after' => '',
            'depth' => 2,
            'link_before' => '',
            'link_after' => '',
            'fallback_cb' => false,
            'walker' => new porto_top_navwalker
        ));
    endif;

    if ( $porto_settings['wcml-switcher'] && $porto_settings['wcml-switcher-pos'] == '' ) {
        if ( class_exists('WCML_Multi_Currency_Support') ) {
            global $sitepress, $woocommerce_wpml;

            $settings = $woocommerce_wpml->get_settings();
            $format = '%symbol% %code%';
            $wc_currencies = get_woocommerce_currencies();
            if (!isset($settings['currencies_order'])) {
                $currencies = $woocommerce_wpml->multi_currency_support->get_currency_codes();
            } else {
                $currencies = $settings['currencies_order'];
            }
            $active_c = '';
            $other_c = '';

            foreach ($currencies as $currency) {
                if ($woocommerce_wpml->settings['currency_options'][$currency]['languages'][$sitepress->get_current_language()] == 1 ) {
                    $selected = $currency == $woocommerce_wpml->multi_currency_support->get_client_currency() ? ' selected="selected"' : '';
                    $currency_format = preg_replace(array('#%name%#', '#%symbol%#', '#%code%#'),
                        array($wc_currencies[$currency], get_woocommerce_currency_symbol($currency), $currency), $format);

                    if ($selected) {
                        $active_c .= $currency_format;
                    } else {
                        $other_c .= '<li rel="' . $currency . '" class="menu-item"><h5>' . $currency_format . '</h5></li>';
                    }
                }
            }
            ?>
            <ul id="menu-currency-switcher" class="currency-switcher mega-menu show-arrow<?php echo ($porto_settings['switcher-effect']?' '.$porto_settings['switcher-effect']:'') ?><?php echo ($porto_settings['menu-sub-effect']?' '.$porto_settings['menu-sub-effect']:'') ?>">
                <li class="menu-item<?php if ($other_c) echo ' has-sub' ?> narrow">
                    <h5><?php echo $active_c ?></h5>
                    <?php if ($other_c) : ?>
                        <div class="popup">
                            <div class="inner">
                                <ul class="sub-menu wcml-switcher">
                                    <?php echo $other_c ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                </li>
            </ul>
        <?php
        } else if ( class_exists('WOOCS') ) {
            global $WOOCS;
            $currencies = $WOOCS->get_currencies();
            $current_currency = $WOOCS->current_currency;

            $active_c = '';
            $other_c = '';

            foreach ($currencies as $currency) {
                $label = ($currency['flag'] ? '<span class="flag"><img src="'.esc_url($currency['flag']).'" height="12" alt="'.esc_attr($currency['name']).'" width="18" /></span>' : '') . $currency['name'] . ' ' . $currency['symbol'];
                if ($currency['name'] == $current_currency) {
                    $active_c .= $label;
                } else {
                    $other_c .= '<li rel="' . $currency['name'] . '" class="menu-item"><h5>' . $label . '</h5></li>';
                }
            }
            ?>
            <ul id="menu-currency-switcher" class="currency-switcher mega-menu show-arrow<?php echo ($porto_settings['switcher-effect']?' '.$porto_settings['switcher-effect']:'') ?><?php echo ($porto_settings['menu-sub-effect']?' '.$porto_settings['menu-sub-effect']:'') ?>">
                <li class="menu-item<?php if ($other_c) echo ' has-sub' ?> narrow">
                    <h5><?php echo $active_c ?></h5>
                    <?php if ($other_c) : ?>
                        <div class="popup">
                            <div class="inner">
                                <ul class="sub-menu woocs-switcher">
                                    <?php echo $other_c ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                </li>
            </ul>
        <?php
        }
    }

    return apply_filters('porto_currency_switcher', str_replace('&nbsp;', '', ob_get_clean()));
}

function porto_mobile_currency_switcher() {
    global $porto_settings;

    ob_start();
    if ( !$porto_settings['wcml-switcher'] && has_nav_menu( 'currency_switcher' ) ) :
        wp_nav_menu(array(
            'theme_location' => 'currency_switcher',
            'container' => '',
            'menu_class' => 'currency-switcher accordion-menu show-arrow',
            'before' => '',
            'after' => '',
            'depth' => 2,
            'link_before' => '',
            'link_after' => '',
            'fallback_cb' => false,
            'walker' => new porto_accordion_navwalker
        ));
    endif;

    if ( $porto_settings['wcml-switcher'] && class_exists('WCML_Multi_Currency_Support') ) {
        global $sitepress, $woocommerce_wpml;

        $settings = $woocommerce_wpml->get_settings();
        $format = '%symbol% %code%';
        $wc_currencies = get_woocommerce_currencies();
        if (!isset($settings['currencies_order'])) {
            $currencies = $woocommerce_wpml->multi_currency_support->get_currency_codes();
        } else {
            $currencies = $settings['currencies_order'];
        }
        $active_c = '';
        $other_c = '';

        foreach ($currencies as $currency) {
            if ($woocommerce_wpml->settings['currency_options'][$currency]['languages'][$sitepress->get_current_language()] == 1 ) {
                $selected = $currency == $woocommerce_wpml->multi_currency_support->get_client_currency() ? ' selected="selected"' : '';
                $currency_format = preg_replace(array('#%name%#', '#%symbol%#', '#%code%#'),
                    array($wc_currencies[$currency], get_woocommerce_currency_symbol($currency), $currency), $format);

                if ($selected) {
                    $active_c .= $currency_format;
                } else {
                    $other_c .= '<li rel="' . $currency . '" class="menu-item"><h5>' . $currency_format . '</h5></li>';
                }
            }
        }
        ?>
        <ul id="menu-currency-switcher" class="currency-switcher accordion-menu show-arrow">
            <li class="menu-item<?php if ($other_c) echo ' has-sub' ?> narrow">
                <h5><?php echo $active_c ?></h5>
                <?php if ($other_c) : ?>
                    <span class="arrow"></span>
                    <ul class="sub-menu wcml-switcher">
                        <?php echo $other_c ?>
                    </ul>
                <?php endif; ?>
            </li>
        </ul>
    <?php
    } else if ( $porto_settings['wcml-switcher'] && class_exists('WOOCS') ) {
        global $WOOCS;
        $currencies = $WOOCS->get_currencies();
        $current_currency = $WOOCS->current_currency;

        $active_c = '';
        $other_c = '';

        foreach ($currencies as $currency) {
            $label = ($currency['flag'] ? '<span class="flag"><img src="'.esc_url($currency['flag']).'" height="12" alt="'.esc_attr($currency['name']).'" width="18" /></span>' : '') . $currency['name'] . ' ' . $currency['symbol'];
            if ($currency['name'] == $current_currency) {
                $active_c .= $label;
            } else {
                $other_c .= '<li rel="' . $currency['name'] . '" class="menu-item"><h5>' . $label . '</h5></li>';
            }
        }
        ?>
        <ul id="menu-currency-switcher" class="currency-switcher accordion-menu show-arrow">
            <li class="menu-item<?php if ($other_c) echo ' has-sub' ?> narrow">
                <h5><?php echo $active_c ?></h5>
                <?php if ($other_c) : ?>
                    <span class="arrow"></span>
                    <ul class="sub-menu woocs-switcher">
                        <?php echo $other_c ?>
                    </ul>
                <?php endif; ?>
            </li>
        </ul>
    <?php
    }

    return apply_filters('porto_mobile_currency_switcher', str_replace('&nbsp;', '', ob_get_clean()));
}

function porto_view_switcher() {
    global $porto_settings;

    ob_start();
    if ( !$porto_settings['wpml-switcher'] && has_nav_menu( 'view_switcher' ) ) :
        wp_nav_menu(array(
            'theme_location' => 'view_switcher',
            'container' => '',
            'menu_class' => 'view-switcher mega-menu show-arrow' . ($porto_settings['switcher-effect']?' '.$porto_settings['switcher-effect']:'') . ($porto_settings['menu-sub-effect']?' '.$porto_settings['menu-sub-effect']:''),
            'before' => '',
            'after' => '',
            'depth' => 2,
            'link_before' => '',
            'link_after' => '',
            'fallback_cb' => false,
            'walker' => new porto_top_navwalker
        ));
    endif;

    if ( $porto_settings['wpml-switcher'] && $porto_settings['wpml-switcher-pos'] == '' ) {
        if ( function_exists('icl_get_languages') ) {
            $languages = icl_get_languages('skip_missing=0&orderby=code');
            if (!empty($languages)) {
                $active_lang = '';
                $other_langs = '';
                foreach ($languages as $l) {
                    if (!$l['active']) {
                        $other_langs .= '<li class="menu-item"><a href="'.esc_url($l['url']).'">';
                    }
                    if ($l['country_flag_url']){
                        if ($l['active']) {
                            $active_lang .= '<span class="flag"><img src="'.esc_url($l['country_flag_url']).'" height="12" alt="'.esc_attr($l['language_code']).'" width="18" /></span>';
                        } else {
                            $other_langs .= '<span class="flag"><img src="'.esc_url($l['country_flag_url']).'" height="12" alt="'.esc_attr($l['language_code']).'" width="18" /></span>';
                        }
                    }
                    if ($l['active']) {
                        $active_lang .= porto_icl_disp_language($l['native_name'], $l['translated_name']);
                    } else {
                        $other_langs .= porto_icl_disp_language($l['native_name'], $l['translated_name']);
                    }
                    if (!$l['active']) {
                        $other_langs .= '</a></li>';
                    }
                }
                ?>
                <ul id="menu-view-switcher" class="view-switcher mega-menu show-arrow<?php echo ($porto_settings['switcher-effect']?' '.$porto_settings['switcher-effect']:'') ?><?php echo ($porto_settings['menu-sub-effect']?' '.$porto_settings['menu-sub-effect']:'') ?>">
                    <li class="menu-item<?php if ($other_langs) echo ' has-sub' ?> narrow">
                        <h5><?php echo $active_lang ?></h5>
                        <?php if ($other_langs) : ?>
                            <div class="popup">
                                <div class="inner">
                                    <ul class="sub-menu">
                                        <?php echo $other_langs ?>
                                    </ul>
                                </div>
                            </div>
                        <?php endif; ?>
                    </li>
                </ul>
            <?php
            }
        } else if ( function_exists('qtranxf_getSortedLanguages') ) {
            global $q_config;

            $languages = qtranxf_getSortedLanguages();
            $flag_location=qtranxf_flag_location();
            if(is_404()) $url = get_option('home'); else $url = '';

            if (!empty($languages)) {
                $active_lang = '';
                $other_langs = '';
                foreach ($languages as $language) {
                    if ($language != $q_config['language']) {
                        $other_langs .= '<li class="menu-item"><a href="'.qtranxf_convertURL($url, $language, false, true).'">';
                        $other_langs .= '<span class="flag"><img src="'.$flag_location.$q_config['flag'][$language].'" /></span>';
                        $other_langs .= $q_config['language_name'][$language];
                        $other_langs .= '</a></li>';
                    } else {
                        $active_lang .= '<span class="flag"><img src="'.$flag_location.$q_config['flag'][$language].'" /></span>';
                        $active_lang .= $q_config['language_name'][$language];
                    }
                }
                ?>
                <ul id="menu-view-switcher" class="view-switcher mega-menu show-arrow<?php echo ($porto_settings['switcher-effect']?' '.$porto_settings['switcher-effect']:'') ?><?php echo ($porto_settings['menu-sub-effect']?' '.$porto_settings['menu-sub-effect']:'') ?>">
                    <li class="menu-item<?php if ($other_langs) echo ' has-sub' ?> narrow">
                        <h5><?php echo $active_lang ?></h5>
                        <?php if ($other_langs) : ?>
                            <div class="popup">
                                <div class="inner">
                                    <ul class="sub-menu">
                                        <?php echo $other_langs ?>
                                    </ul>
                                </div>
                            </div>
                        <?php endif; ?>
                    </li>
                </ul>
            <?php
            }
        }
    }

    return apply_filters('porto_view_switcher', str_replace('&nbsp;', '', ob_get_clean()));
}

function porto_mobile_view_switcher() {
    global $porto_settings;

    ob_start();
    if ( !$porto_settings['wpml-switcher'] && has_nav_menu( 'view_switcher' ) ) :
        wp_nav_menu(array(
            'theme_location' => 'view_switcher',
            'container' => '',
            'menu_class' => 'view-switcher accordion-menu show-arrow',
            'before' => '',
            'after' => '',
            'depth' => 2,
            'link_before' => '',
            'link_after' => '',
            'fallback_cb' => false,
            'walker' => new porto_accordion_navwalker
        ));
    endif;

    if ( $porto_settings['wpml-switcher'] && function_exists('icl_get_languages')) {
        $languages = icl_get_languages('skip_missing=0&orderby=code');
        if (!empty($languages)) {
            $active_lang = '';
            $other_langs = '';
            foreach ($languages as $l) {
                if (!$l['active']) {
                    $other_langs .= '<li class="menu-item"><a href="'.esc_url($l['url']).'">';
                }
                if ($l['country_flag_url']){
                    if ($l['active']) {
                        $active_lang .= '<span class="flag"><img src="'.esc_url($l['country_flag_url']).'" height="12" alt="'.esc_attr($l['language_code']).'" width="18" /></span>';
                    } else {
                        $other_langs .= '<span class="flag"><img src="'.esc_url($l['country_flag_url']).'" height="12" alt="'.esc_attr($l['language_code']).'" width="18" /></span>';
                    }
                }
                if ($l['active']) {
                    $active_lang .= porto_icl_disp_language($l['native_name'], $l['translated_name']);
                } else {
                    $other_langs .= porto_icl_disp_language($l['native_name'], $l['translated_name']);
                }
                if (!$l['active']) {
                    $other_langs .= '</a></li>';
                }
            }
            ?>
            <ul id="menu-view-switcher" class="view-switcher accordion-menu show-arrow">
                <li class="menu-item<?php if ($other_langs) echo ' has-sub' ?> narrow">
                    <h5><?php echo $active_lang ?></h5>
                    <?php if ($other_langs) : ?>
                        <span class="arrow"></span>
                        <ul class="sub-menu">
                            <?php echo $other_langs ?>
                        </ul>
                    <?php endif; ?>
                </li>
            </ul>
        <?php
        }
    } else if ( $porto_settings['wpml-switcher'] && function_exists('qtranxf_getSortedLanguages')) {
        global $q_config;

        $languages = qtranxf_getSortedLanguages();
        $flag_location = qtranxf_flag_location();
        if(is_404()) $url = get_option('home'); else $url = '';

        if (!empty($languages)) {
            $active_lang = '';
            $other_langs = '';
            foreach ($languages as $language) {
                if ($language != $q_config['language']) {
                    $other_langs .= '<li class="menu-item"><a href="'.qtranxf_convertURL($url, $language, false, true).'">';
                    $other_langs .= '<span class="flag"><img src="'.$flag_location.$q_config['flag'][$language].'" /></span>';
                    $other_langs .= $q_config['language_name'][$language];
                    $other_langs .= '</a></li>';
                } else {
                    $active_lang .= '<span class="flag"><img src="'.$flag_location.$q_config['flag'][$language].'" /></span>';
                    $active_lang .= $q_config['language_name'][$language];
                }
            }
            ?>
            <ul id="menu-view-switcher" class="view-switcher accordion-menu show-arrow">
                <li class="menu-item<?php if ($other_langs) echo ' has-sub' ?> narrow">
                    <h5><?php echo $active_lang ?></h5>
                    <?php if ($other_langs) : ?>
                        <span class="arrow"></span>
                        <ul class="sub-menu">
                            <?php echo $other_langs ?>
                        </ul>
                    <?php endif; ?>
                </li>
            </ul>
        <?php
        }
    }

    return apply_filters('porto_mobile_view_switcher', str_replace('&nbsp;', '', ob_get_clean()));
}

function porto_top_navigation() {
    global $porto_settings;

    $html = '';

    // show language switcher
    if ( $porto_settings['wpml-switcher'] && $porto_settings['wpml-switcher-pos'] == 'top_nav' ) {
        if ( function_exists('icl_get_languages') ) {
            $languages = icl_get_languages('skip_missing=0&orderby=code');
            if (!empty($languages)) {
                $active_lang = '';
                $other_langs = '';
                foreach ($languages as $l) {
                    if (!$l['active']) {
                        $other_langs .= '<li class="menu-item"><a href="'.esc_url($l['url']).'">';
                    }
                    if ($l['country_flag_url']){
                        if ($l['active']) {
                            $active_lang .= '<span class="flag"><img src="'.esc_url($l['country_flag_url']).'" height="12" alt="'.esc_attr($l['language_code']).'" width="18" /></span>';
                        } else {
                            $other_langs .= '<span class="flag"><img src="'.esc_url($l['country_flag_url']).'" height="12" alt="'.esc_attr($l['language_code']).'" width="18" /></span>';
                        }
                    }
                    if ($l['active']) {
                        $active_lang .= porto_icl_disp_language($l['native_name'], $l['translated_name']);
                    } else {
                        $other_langs .= porto_icl_disp_language($l['native_name'], $l['translated_name']);
                    }
                    if (!$l['active']) {
                        $other_langs .= '</a></li>';
                    }
                }
                $html .= '<li class="menu-item' . ($other_langs ? ' has-sub' : '') . ' narrow">';
                $html .= '<h5>' . $active_lang . '</h5>';
                if ($other_langs) {
                    $html .= '<div class="popup"><div class="inner"><ul class="sub-menu">';
                    $html .= $other_langs;
                    $html .= '</ul></div></div>';
                }
                $html .= '</li>';
            }
        } else if ( function_exists('qtranxf_getSortedLanguages') ) {
            global $q_config;

            $languages = qtranxf_getSortedLanguages();
            $flag_location = qtranxf_flag_location();
            if(is_404()) $url = get_option('home'); else $url = '';

            if (!empty($languages)) {
                $active_lang = '';
                $other_langs = '';
                foreach ($languages as $language) {
                    if ($language != $q_config['language']) {
                        $other_langs .= '<li class="menu-item"><a href="'.qtranxf_convertURL($url, $language, false, true).'">';
                        $other_langs .= '<span class="flag"><img src="'.$flag_location.$q_config['flag'][$language].'" /></span>';
                        $other_langs .= $q_config['language_name'][$language];
                        $other_langs .= '</a></li>';
                    } else {
                        $active_lang .= '<span class="flag"><img src="'.$flag_location.$q_config['flag'][$language].'" /></span>';
                        $active_lang .= $q_config['language_name'][$language];
                    }
                }
                $html .= '<li class="menu-item' . ($other_langs ? ' has-sub' : '') . ' narrow">';
                $html .= '<h5>' . $active_lang . '</h5>';
                if ($other_langs) {
                    $html .= '<div class="popup"><div class="inner"><ul class="sub-menu">';
                    $html .= $other_langs;
                    $html .= '</ul></div></div>';
                }
                $html .= '</li>';
            }
        }
    }

    // show currency switcher
    if ( $porto_settings['wcml-switcher'] && $porto_settings['wcml-switcher-pos'] == 'top_nav' ) {
        if ( class_exists('WCML_Multi_Currency_Support') ) {
            global $sitepress, $woocommerce_wpml;

            $settings = $woocommerce_wpml->get_settings();
            $format = '%symbol% %code%';
            $wc_currencies = get_woocommerce_currencies();
            if (!isset($settings['currencies_order'])) {
                $currencies = $woocommerce_wpml->multi_currency_support->get_currency_codes();
            } else {
                $currencies = $settings['currencies_order'];
            }
            $active_c = '';
            $other_c = '';

            foreach ($currencies as $currency) {
                if ($woocommerce_wpml->settings['currency_options'][$currency]['languages'][$sitepress->get_current_language()] == 1 ) {
                    $selected = $currency == $woocommerce_wpml->multi_currency_support->get_client_currency() ? ' selected="selected"' : '';
                    $currency_format = preg_replace(array('#%name%#', '#%symbol%#', '#%code%#'),
                        array($wc_currencies[$currency], get_woocommerce_currency_symbol($currency), $currency), $format);

                    if ($selected) {
                        $active_c .= $currency_format;
                    } else {
                        $other_c .= '<li rel="' . $currency . '" class="menu-item"><h5>' . $currency_format . '</h5></li>';
                    }
                }
            }
            $html .= '<li class="menu-item' . ($other_c ? ' has-sub' : '') . ' narrow">';
            $html .= '<h5>' . $active_c . '</h5>';
            if ($other_c) {
                $html .= '<div class="popup"><div class="inner"><ul class="sub-menu wcml-switcher">';
                $html .= $other_c;
                $html .= '</ul></div></div>';
            }
            $html .= '</li>';
        } else if ( class_exists('WOOCS') ) {
            global $WOOCS;
            $currencies = $WOOCS->get_currencies();
            $current_currency = $WOOCS->current_currency;

            $active_c = '';
            $other_c = '';

            foreach ($currencies as $currency) {
                $label = ($currency['flag'] ? '<span class="flag"><img src="'.esc_url($currency['flag']).'" height="12" alt="'.esc_attr($currency['name']).'" width="18" /></span>' : '') . $currency['name'] . ' ' . $currency['symbol'];
                if ($currency['name'] == $current_currency) {
                    $active_c .= $label;
                } else {
                    $other_c .= '<li rel="' . $currency['name'] . '" class="menu-item"><h5>' . $label . '</h5></li>';
                }
            }
            $html .= '<li class="menu-item' . ($other_c ? ' has-sub' : '') . ' narrow">';
            $html .= '<h5>' . $active_c . '</h5>';
            if ($other_c) {
                $html .= '<div class="popup"><div class="inner"><ul class="sub-menu woocs-switcher">';
                $html .= $other_c;
                $html .= '</ul></div></div>';
            }
            $html .= '</li>';
        }
    }

    // show login/logout link
    if (isset($porto_settings['menu-login-pos']) && $porto_settings['menu-login-pos'] == 'top_nav') {
        if (is_user_logged_in()) {
            $logout_link = '';
            if ( class_exists( 'WooCommerce' ) ) {
                $logout_link = wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) );
            } else {
                $logout_link = wp_logout_url( get_home_url() );
            }
            $html .= '<li class="menu-item"><a href="' . $logout_link . '"><i class="avatar">' . get_avatar( get_current_user_id(), $size = '24' ) . '</i>' . __('Logout', 'porto') . '</a></li>';
        } else {
            $login_link = $register_link = '';
            if ( class_exists( 'WooCommerce' ) ) {
                $login_link = wc_get_page_permalink( 'myaccount' );
                if (get_option('woocommerce_enable_myaccount_registration') === 'yes') {
                    $register_link = wc_get_page_permalink( 'myaccount' );
                }
            } else {
                $login_link = wp_login_url( get_home_url() );
                $active_signup = get_site_option( 'registration', 'none' );
                $active_signup = apply_filters( 'wpmu_active_signup', $active_signup );
                if ($active_signup != 'none')
                    $register_link = wp_registration_url( get_home_url() );
            }
            $html .= '<li class="menu-item"><a href="' . $login_link . '"><i class="fa fa-user"></i>' . __('Login', 'porto') . '</a></li>';
            if ($register_link && isset($porto_settings['menu-enable-register']) && $porto_settings['menu-enable-register']) {
                $html .= '<li class="menu-item"><a href="' . $register_link . '"><i class="fa fa-user-plus"></i>' . __('Register', 'porto') . '</a></li>';
            }
        }
    }

    ob_start();
    if ( has_nav_menu( 'top_nav' ) ) :
        wp_nav_menu(array(
            'theme_location' => 'top_nav',
            'container' => '',
            'menu_class' => 'top-links mega-menu' . ($porto_settings['menu-arrow']?' show-arrow':'') . ($porto_settings['menu-effect']?' '.$porto_settings['menu-effect']:'') . ($porto_settings['menu-sub-effect']?' '.$porto_settings['menu-sub-effect']:''),
            'before' => '',
            'after' => '',
            'depth' => 2,
            'link_before' => '',
            'link_after' => '',
            'fallback_cb' => false,
            'walker' => new porto_top_navwalker
        ));
    endif;

    $output = str_replace('&nbsp;', '', ob_get_clean());

    if ($output && $html) {
        $output = preg_replace('/<\/ul>$/', $html . '</ul>', $output, 1);
    } else if (!$output && $html) {
        $output = '<ul class="' . 'top-links mega-menu' . ($porto_settings['menu-arrow']?' show-arrow':'') . ($porto_settings['menu-effect']?' '.$porto_settings['menu-effect']:'') . ($porto_settings['menu-sub-effect']?' '.$porto_settings['menu-sub-effect']:'') . '" id="menu-top-navigation">' . $html . '</ul>';
    }

    return apply_filters('porto_top_navigation', $output);
}

function porto_mobile_top_navigation() {
    global $porto_settings;

    $html = '';
    if (isset($porto_settings['menu-login-pos']) && $porto_settings['menu-login-pos'] == 'top_nav') {
        if (is_user_logged_in()) {
            $logout_link = '';
            if ( class_exists( 'WooCommerce' ) ) {
                $logout_link = wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) );
            } else {
                $logout_link = wp_logout_url( get_home_url() );
            }
            $html .= '<li class="menu-item"><a href="' . $logout_link . '"><i class="avatar">' . get_avatar( get_current_user_id(), $size = '24' ) . '</i>' . __('Logout', 'porto') . '</a></li>';
        } else {
            $login_link = $register_link = '';
            if ( class_exists( 'WooCommerce' ) ) {
                $login_link = wc_get_page_permalink( 'myaccount' );
                if (get_option('woocommerce_enable_myaccount_registration') === 'yes') {
                    $register_link = wc_get_page_permalink( 'myaccount' );
                }
            } else {
                $login_link = wp_login_url( get_home_url() );
                $active_signup = get_site_option( 'registration', 'none' );
                $active_signup = apply_filters( 'wpmu_active_signup', $active_signup );
                if ($active_signup != 'none')
                    $register_link = wp_registration_url( get_home_url() );
            }
            $html .= '<li class="menu-item"><a href="' . $login_link . '"><i class="fa fa-user"></i>' . __('Login', 'porto') . '</a></li>';
            if ($register_link && isset($porto_settings['menu-enable-register']) && $porto_settings['menu-enable-register']) {
                $html .= '<li class="menu-item"><a href="' . $register_link . '"><i class="fa fa-user-plus"></i>' . __('Register', 'porto') . '</a></li>';
            }
        }
    }

    ob_start();
    if ( has_nav_menu( 'top_nav' ) ) :
        wp_nav_menu(array(
            'theme_location' => 'top_nav',
            'container' => '',
            'menu_class' => 'top-links accordion-menu' . ($porto_settings['menu-arrow']?' show-arrow':''),
            'before' => '',
            'after' => '',
            'depth' => 2,
            'link_before' => '',
            'link_after' => '',
            'fallback_cb' => false,
            'walker' => new porto_accordion_navwalker
        ));
    endif;

    $output = str_replace('&nbsp;', '', ob_get_clean());

    if ($output && $html) {
        $output = preg_replace('/<\/ul>$/', $html . '</ul>', $output, 1);
    } else if (!$output && $html) {
        $output = '<ul class="' . 'top-links accordion-menu' . ($porto_settings['menu-arrow']?' show-arrow':'') . '" id="menu-top-navigation-1">' . $html . '</ul>';
    }

    return apply_filters('porto_mobile_top_navigation', $output);
}

function porto_main_menu() {
    global $porto_settings, $porto_layout;

    $header_type = porto_get_header_type();
    
    $is_home = false;

    if ( is_front_page() && is_home() ) {
        $is_home = true;
    } elseif ( is_front_page() ) {
        $is_home = true;
    }

    if (($header_type == 1 || $header_type == 4 || $header_type == 13 || $header_type == 14) && ($porto_layout == 'wide-left-sidebar' || $porto_layout == 'wide-right-sidebar' || $porto_layout == 'left-sidebar' || $porto_layout == 'right-sidebar') && $porto_settings['menu-sidebar']) {
        if ($is_home || (!$is_home && !$porto_settings['menu-sidebar-home']))
            return '';
    }

    $html = '';

    // show language switcher
    if ( $porto_settings['wpml-switcher'] && $porto_settings['wpml-switcher-pos'] == 'main_menu' ) {
        if ( function_exists('icl_get_languages') ) {
            $languages = icl_get_languages('skip_missing=0&orderby=code');
            if (!empty($languages)) {
                $active_lang = '';
                $other_langs = '';
                foreach ($languages as $l) {
                    if (!$l['active']) {
                        $other_langs .= '<li class="menu-item"><a href="'.esc_url($l['url']).'">';
                    }
                    if ($l['country_flag_url']){
                        if ($l['active']) {
                            $active_lang .= '<span class="flag"><img src="'.esc_url($l['country_flag_url']).'" height="12" alt="'.esc_attr($l['language_code']).'" width="18" /></span>';
                        } else {
                            $other_langs .= '<span class="flag"><img src="'.esc_url($l['country_flag_url']).'" height="12" alt="'.esc_attr($l['language_code']).'" width="18" /></span>';
                        }
                    }
                    if ($l['active']) {
                        $active_lang .= porto_icl_disp_language($l['native_name'], $l['translated_name']);
                    } else {
                        $other_langs .= porto_icl_disp_language($l['native_name'], $l['translated_name']);
                    }
                    if (!$l['active']) {
                        $other_langs .= '</a></li>';
                    }
                }
                $html .= '<li class="menu-item' . ($other_langs ? ' has-sub' : '') . ' narrow">';
                $html .= '<h5>' . $active_lang . '</h5>';
                if ($other_langs) {
                    $html .= '<div class="popup"><div class="inner"><ul class="sub-menu">';
                    $html .= $other_langs;
                    $html .= '</ul></div></div>';
                }
                $html .= '</li>';
            }
        } else if ( function_exists('qtranxf_getSortedLanguages') ) {
            global $q_config;

            $languages = qtranxf_getSortedLanguages();
            $flag_location = qtranxf_flag_location();
            if(is_404()) $url = get_option('home'); else $url = '';

            if (!empty($languages)) {
                $active_lang = '';
                $other_langs = '';
                foreach ($languages as $language) {
                    if ($language != $q_config['language']) {
                        $other_langs .= '<li class="menu-item"><a href="'.qtranxf_convertURL($url, $language, false, true).'">';
                        $other_langs .= '<span class="flag"><img src="'.$flag_location.$q_config['flag'][$language].'" /></span>';
                        $other_langs .= $q_config['language_name'][$language];
                        $other_langs .= '</a></li>';
                    } else {
                        $active_lang .= '<span class="flag"><img src="'.$flag_location.$q_config['flag'][$language].'" /></span>';
                        $active_lang .= $q_config['language_name'][$language];
                    }
                }
                $html .= '<li class="menu-item' . ($other_langs ? ' has-sub' : '') . ' narrow">';
                $html .= '<h5>' . $active_lang . '</h5>';
                if ($other_langs) {
                    $html .= '<div class="popup"><div class="inner"><ul class="sub-menu">';
                    $html .= $other_langs;
                    $html .= '</ul></div></div>';
                }
                $html .= '</li>';
            }
        }
    }

    // show currency switcher
    if ( $porto_settings['wcml-switcher'] && $porto_settings['wcml-switcher-pos'] == 'main_menu' ) {
        if ( class_exists('WCML_Multi_Currency_Support') ) {
            global $sitepress, $woocommerce_wpml;

            $settings = $woocommerce_wpml->get_settings();
            $format = '%symbol% %code%';
            $wc_currencies = get_woocommerce_currencies();
            if (!isset($settings['currencies_order'])) {
                $currencies = $woocommerce_wpml->multi_currency_support->get_currency_codes();
            } else {
                $currencies = $settings['currencies_order'];
            }
            $active_c = '';
            $other_c = '';

            foreach ($currencies as $currency) {
                if ($woocommerce_wpml->settings['currency_options'][$currency]['languages'][$sitepress->get_current_language()] == 1 ) {
                    $selected = $currency == $woocommerce_wpml->multi_currency_support->get_client_currency() ? ' selected="selected"' : '';
                    $currency_format = preg_replace(array('#%name%#', '#%symbol%#', '#%code%#'),
                        array($wc_currencies[$currency], get_woocommerce_currency_symbol($currency), $currency), $format);

                    if ($selected) {
                        $active_c .= $currency_format;
                    } else {
                        $other_c .= '<li rel="' . $currency . '" class="menu-item"><h5>' . $currency_format . '</h5></li>';
                    }
                }
            }
            $html .= '<li class="menu-item' . ($other_c ? ' has-sub' : '') . ' narrow">';
            $html .= '<h5>' . $active_c . '</h5>';
            if ($other_c) {
                $html .= '<div class="popup"><div class="inner"><ul class="sub-menu wcml-switcher">';
                $html .= $other_c;
                $html .= '</ul></div></div>';
            }
            $html .= '</li>';
        } else if ( class_exists('WOOCS') ) {
            global $WOOCS;
            $currencies = $WOOCS->get_currencies();
            $current_currency = $WOOCS->current_currency;

            $active_c = '';
            $other_c = '';

            foreach ($currencies as $currency) {
                $label = ($currency['flag'] ? '<span class="flag"><img src="'.esc_url($currency['flag']).'" height="12" alt="'.esc_attr($currency['name']).'" width="18" /></span>' : '') . $currency['name'] . ' ' . $currency['symbol'];
                if ($currency['name'] == $current_currency) {
                    $active_c .= $label;
                } else {
                    $other_c .= '<li rel="' . $currency['name'] . '" class="menu-item"><h5>' . $label . '</h5></li>';
                }
            }
            $html .= '<li class="menu-item' . ($other_c ? ' has-sub' : '') . ' narrow">';
            $html .= '<h5>' . $active_c . '</h5>';
            if ($other_c) {
                $html .= '<div class="popup"><div class="inner"><ul class="sub-menu woocs-switcher">';
                $html .= $other_c;
                $html .= '</ul></div></div>';
            }
            $html .= '</li>';
        }
    }

    // show login/logout link
    if (isset($porto_settings['menu-login-pos']) && $porto_settings['menu-login-pos'] == 'main_menu') {
        if (is_user_logged_in()) {
            $logout_link = '';
            if ( class_exists( 'WooCommerce' ) ) {
                $logout_link = wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) );
            } else {
                $logout_link = wp_logout_url( get_home_url() );
            }

            if (($header_type == 1 || $header_type == 4 || $header_type == 13 || $header_type == 14)) {
                $html .= '<li class="' . (is_rtl() ? 'pull-left' : 'pull-right') . '"><div class="menu-custom-block"><a href="' . $logout_link . '"><i class="avatar">' . get_avatar( get_current_user_id(), $size = '24' ) . '</i>' . __('Logout', 'porto') . '</a></div></li>';
            } else {
                $html .= '<li class="menu-item"><a href="' . $logout_link . '"><i class="avatar">' . get_avatar( get_current_user_id(), $size = '24' ) . '</i>' . __('Logout', 'porto') . '</a></li>';
            }
        } else {
            $login_link = $register_link = '';
            if ( class_exists( 'WooCommerce' ) ) {
                $login_link = wc_get_page_permalink( 'myaccount' );
                if (get_option('woocommerce_enable_myaccount_registration') === 'yes') {
                    $register_link = wc_get_page_permalink( 'myaccount' );
                }
            } else {
                $login_link = wp_login_url( get_home_url() );
                $active_signup = get_site_option( 'registration', 'none' );
                $active_signup = apply_filters( 'wpmu_active_signup', $active_signup );
                if ($active_signup != 'none')
                    $register_link = wp_registration_url( get_home_url() );
            }
            if (($header_type == 1 || $header_type == 4 || $header_type == 13 || $header_type == 14)) {
                if ($register_link && isset($porto_settings['menu-enable-register']) && $porto_settings['menu-enable-register']) {
                    $html .= '<li class="' . (is_rtl() ? 'pull-left' : 'pull-right') . '"><div class="menu-custom-block"><a href="' . $register_link . '"><i class="fa fa-user-plus"></i>' . __('Register', 'porto') . '</a></div></li>';
                }
                $html .= '<li class="' . (is_rtl() ? 'pull-left' : 'pull-right') . '"><div class="menu-custom-block"><a href="' . $login_link . '"><i class="fa fa-user"></i>' . __('Login', 'porto') . '</a></div></li>';
            } else {
                $html .= '<li class="menu-item"><a href="' . $login_link . '"><i class="fa fa-user"></i>' . __('Login', 'porto') . '</a></li>';
                if ($register_link && isset($porto_settings['menu-enable-register']) && $porto_settings['menu-enable-register']) {
                    $html .= '<li class="menu-item"><a href="' . $register_link . '"><i class="fa fa-user-plus"></i>' . __('Register', 'porto') . '</a></li>';
                }
            }
        }
    }

    if ($header_type == 1 || $header_type == 4 || $header_type == 13 || $header_type == 14) {
        if ($porto_settings['menu-block']) {
            $html .= '<li class="menu-custom-content ' . (is_rtl() ? 'pull-left' : 'pull-right') . '"><div class="menu-custom-block">'.force_balance_tags($porto_settings['menu-block']).'</div></li>';
        }
    }

    ob_start();
    $main_menu = porto_get_meta_value('main_menu');
    if ( has_nav_menu( 'main_menu' ) || $main_menu ) :
        $args = array(
            'container' => '',
            'menu_class' => 'main-menu mega-menu' . ($porto_settings['menu-type']?' '.$porto_settings['menu-type']:'') . ($porto_settings['menu-arrow']?' show-arrow':'') . ($porto_settings['menu-effect']?' '.$porto_settings['menu-effect']:'') . ($porto_settings['menu-sub-effect']?' '.$porto_settings['menu-sub-effect']:''),
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'fallback_cb' => false,
            'walker' => new porto_top_navwalker
        );
        if ($main_menu) {
            $args['menu'] = $main_menu;
        } else {
            $args['theme_location'] = 'main_menu';
        }
        wp_nav_menu($args);
    endif;

    $output = str_replace('&nbsp;', '', ob_get_clean());

    if ($output && $html) {
        $output = preg_replace('/<\/ul>$/', $html . '</ul>', $output, 1);
    } else if (!$output && $html) {
        $output = '<ul class="' . 'main-menu mega-menu' . ($porto_settings['menu-arrow']?' show-arrow':'') . ($porto_settings['menu-effect']?' '.$porto_settings['menu-effect']:'') . ($porto_settings['menu-sub-effect']?' '.$porto_settings['menu-sub-effect']:'') . '" id="menu-main-menu">' . $html . '</ul>';
    }

    return apply_filters('porto_main_menu', $output);
}

function porto_main_toggle_menu() {
    global $porto_settings, $porto_layout;

    $header_type = porto_get_header_type();

    if ($header_type != 9)
        return porto_main_menu();

    ob_start();
    $main_menu = porto_get_meta_value('main_menu');
    if ( has_nav_menu( 'main_menu' ) || $main_menu ) :
        $args = array(
            'container' => '',
            'menu_class' => 'main-menu sidebar-menu' . ($porto_settings['menu-sub-effect']?' '.$porto_settings['menu-sub-effect']:''),
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'fallback_cb' => false,
            'walker' => new porto_sidebar_navwalker
        );
        if ($main_menu) {
            $args['menu'] = $main_menu;
        } else {
            $args['theme_location'] = 'main_menu';
        }
        wp_nav_menu($args);
    endif;

    $output = str_replace('&nbsp;', '', ob_get_clean());

    return apply_filters('porto_main_toggle_menu', $output);
}

function porto_header_side_menu() {
    global $porto_settings;

    $output = '';

    $html = '';

    // show language switcher
    if ( $porto_settings['wpml-switcher'] && $porto_settings['wpml-switcher-pos'] == 'main_menu' ) {
        if ( function_exists('icl_get_languages') ) {
            $languages = icl_get_languages('skip_missing=0&orderby=code');
            if (!empty($languages)) {
                $active_lang = '';
                $other_langs = '';
                foreach ($languages as $l) {
                    if (!$l['active']) {
                        $other_langs .= '<li class="menu-item"><a href="'.esc_url($l['url']).'">';
                    }
                    if ($l['country_flag_url']){
                        if ($l['active']) {
                            $active_lang .= '<span class="flag"><img src="'.esc_url($l['country_flag_url']).'" height="12" alt="'.esc_attr($l['language_code']).'" width="18" /></span>';
                        } else {
                            $other_langs .= '<span class="flag"><img src="'.esc_url($l['country_flag_url']).'" height="12" alt="'.esc_attr($l['language_code']).'" width="18" /></span>';
                        }
                    }
                    if ($l['active']) {
                        $active_lang .= porto_icl_disp_language($l['native_name'], $l['translated_name']);
                    } else {
                        $other_langs .= porto_icl_disp_language($l['native_name'], $l['translated_name']);
                    }
                    if (!$l['active']) {
                        $other_langs .= '</a></li>';
                    }
                }
                $html .= '<li class="menu-item' . ($other_langs ? ' has-sub' : '') . ' narrow">';
                $html .= '<h5>' . $active_lang . '</h5><span class="arrow"></span>';
                if ($other_langs) {
                    $html .= '<div class="popup"><div class="inner"><ul class="sub-menu">';
                    $html .= $other_langs;
                    $html .= '</ul></div></div>';
                }
                $html .= '</li>';
            }
        } else if ( function_exists('qtranxf_getSortedLanguages') ) {
            global $q_config;

            $languages = qtranxf_getSortedLanguages();
            $flag_location = qtranxf_flag_location();
            if(is_404()) $url = get_option('home'); else $url = '';

            if (!empty($languages)) {
                $active_lang = '';
                $other_langs = '';
                foreach ($languages as $language) {
                    if ($language != $q_config['language']) {
                        $other_langs .= '<li class="menu-item"><a href="'.qtranxf_convertURL($url, $language, false, true).'">';
                        $other_langs .= '<span class="flag"><img src="'.$flag_location.$q_config['flag'][$language].'" /></span>';
                        $other_langs .= $q_config['language_name'][$language];
                        $other_langs .= '</a></li>';
                    } else {
                        $active_lang .= '<span class="flag"><img src="'.$flag_location.$q_config['flag'][$language].'" /></span>';
                        $active_lang .= $q_config['language_name'][$language];
                    }
                }
                $html .= '<li class="menu-item' . ($other_langs ? ' has-sub' : '') . ' narrow">';
                $html .= '<h5>' . $active_lang . '</h5><span class="arrow"></span>';
                if ($other_langs) {
                    $html .= '<div class="popup"><div class="inner"><ul class="sub-menu">';
                    $html .= $other_langs;
                    $html .= '</ul></div></div>';
                }
                $html .= '</li>';
            }
        }
    }

    // show currency switcher
    if ( $porto_settings['wcml-switcher'] && $porto_settings['wcml-switcher-pos'] == 'main_menu' ) {
        if ( class_exists('WCML_Multi_Currency_Support') ) {
            global $sitepress, $woocommerce_wpml;

            $settings = $woocommerce_wpml->get_settings();
            $format = '%symbol% %code%';
            $wc_currencies = get_woocommerce_currencies();
            if (!isset($settings['currencies_order'])) {
                $currencies = $woocommerce_wpml->multi_currency_support->get_currency_codes();
            } else {
                $currencies = $settings['currencies_order'];
            }
            $active_c = '';
            $other_c = '';

            foreach ($currencies as $currency) {
                if ($woocommerce_wpml->settings['currency_options'][$currency]['languages'][$sitepress->get_current_language()] == 1 ) {
                    $selected = $currency == $woocommerce_wpml->multi_currency_support->get_client_currency() ? ' selected="selected"' : '';
                    $currency_format = preg_replace(array('#%name%#', '#%symbol%#', '#%code%#'),
                        array($wc_currencies[$currency], get_woocommerce_currency_symbol($currency), $currency), $format);

                    if ($selected) {
                        $active_c .= $currency_format;
                    } else {
                        $other_c .= '<li rel="' . $currency . '" class="menu-item"><h5>' . $currency_format . '</h5></li>';
                    }
                }
            }
            $html .= '<li class="menu-item' . ($other_c ? ' has-sub' : '') . ' narrow">';
            $html .= '<h5>' . $active_c . '</h5><span class="arrow"></span>';
            if ($other_c) {
                $html .= '<div class="popup"><div class="inner"><ul class="sub-menu wcml-switcher">';
                $html .= $other_c;
                $html .= '</ul></div></div>';
            }
            $html .= '</li>';
        } else if ( class_exists('WOOCS') ) {
            global $WOOCS;
            $currencies = $WOOCS->get_currencies();
            $current_currency = $WOOCS->current_currency;

            $active_c = '';
            $other_c = '';

            foreach ($currencies as $currency) {
                $label = ($currency['flag'] ? '<span class="flag"><img src="'.esc_url($currency['flag']).'" height="12" alt="'.esc_attr($currency['name']).'" width="18" /></span>' : '') . $currency['name'] . ' ' . $currency['symbol'];
                if ($currency['name'] == $current_currency) {
                    $active_c .= $label;
                } else {
                    $other_c .= '<li rel="' . $currency['name'] . '" class="menu-item"><h5>' . $label . '</h5></li>';
                }
            }
            $html .= '<li class="menu-item' . ($other_c ? ' has-sub' : '') . ' narrow">';
            $html .= '<h5>' . $active_c . '</h5><span class="arrow"></span>';
            if ($other_c) {
                $html .= '<div class="popup"><div class="inner"><ul class="sub-menu woocs-switcher">';
                $html .= $other_c;
                $html .= '</ul></div></div>';
            }
            $html .= '</li>';
        }
    }

    // show login/logout link
    if (isset($porto_settings['menu-login-pos']) && $porto_settings['menu-login-pos'] == 'main_menu') {
        if (is_user_logged_in()) {
            $logout_link = '';
            if ( class_exists( 'WooCommerce' ) ) {
                $logout_link = wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) );
            } else {
                $logout_link = wp_logout_url( get_home_url() );
            }
            $html .= '<li class="menu-item"><a href="' . $logout_link . '"><i class="avatar">' . get_avatar( get_current_user_id(), $size = '24' ) . '</i>' . __('Logout', 'porto') . '</a></li>';
        } else {
            $login_link = $register_link = '';
            if ( class_exists( 'WooCommerce' ) ) {
                $login_link = wc_get_page_permalink( 'myaccount' );
                if (get_option('woocommerce_enable_myaccount_registration') === 'yes') {
                    $register_link = wc_get_page_permalink( 'myaccount' );
                }
            } else {
                $login_link = wp_login_url( get_home_url() );
                $active_signup = get_site_option( 'registration', 'none' );
                $active_signup = apply_filters( 'wpmu_active_signup', $active_signup );
                if ($active_signup != 'none')
                    $register_link = wp_registration_url( get_home_url() );
            }
            $html .= '<li class="menu-item"><a href="' . $login_link . '"><i class="fa fa-user"></i>' . __('Login', 'porto') . '</a></li>';
            if ($register_link && isset($porto_settings['menu-enable-register']) && $porto_settings['menu-enable-register']) {
                $html .= '<li class="menu-item"><a href="' . $register_link . '"><i class="fa fa-user-plus"></i>' . __('Register', 'porto') . '</a></li>';
            }
        }
    }
    if ($porto_settings['menu-block']) {
        $html .= '<li class="menu-custom-item"><div class="menu-custom-block">'.force_balance_tags($porto_settings['menu-block']).'</div></li>';
    }

    ob_start();
    $main_menu = porto_get_meta_value('main_menu');
    if ( has_nav_menu( 'main_menu' ) || $main_menu ) {
        $args = array(
            'container' => '',
            'menu_class' => 'main-menu sidebar-menu' . ((has_nav_menu( 'sidebar_menu' ) || porto_get_meta_value('sidebar_menu')) ? ' has-side-menu' : '') . ($porto_settings['menu-sub-effect']?' '.$porto_settings['menu-sub-effect']:''),
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'fallback_cb' => false,
            'walker' => new porto_sidebar_navwalker
        );
        if ($main_menu) {
            $args['menu'] = $main_menu;
        } else {
            $args['theme_location'] = 'main_menu';
        }
        wp_nav_menu($args);
    }

    $output .= str_replace('&nbsp;', '', ob_get_clean());

    if ($output && $html) {
        $output = preg_replace('/<\/ul>$/', $html . '</ul>', $output, 1);
    } else if (!$output && $html) {
        $output = '<ul class="' . 'main-menu sidebar-menu' . ((has_nav_menu( 'sidebar_menu' ) || porto_get_meta_value('sidebar_menu')) ? ' has-side-menu' : '') . ($porto_settings['menu-sub-effect']?' '.$porto_settings['menu-sub-effect']:'') . '" id="menu-main-menu">' . $html . '</ul>';
    }

    return apply_filters('porto_header_side_menu', $output);
}

function porto_have_sidebar_menu() {
    global $porto_settings, $porto_layout;

    $header_type = porto_get_header_type();

    $is_home = false;
    if ( is_front_page() && is_home() ) {
        $is_home = true;
    } elseif ( is_front_page() ) {
        $is_home = true;
    }

    $have_sidebar_menu = false;

    if (!((($header_type == 1 || $header_type == 4 || $header_type == 13 || $header_type == 14) && ($porto_layout == 'wide-left-sidebar' || $porto_layout == 'wide-right-sidebar' || $porto_layout == 'left-sidebar' || $porto_layout == 'right-sidebar') && $porto_settings['menu-sidebar']))) {

    } else if (($header_type == 1 || $header_type == 4 || $header_type == 13 || $header_type == 14) && !$is_home && $porto_settings['menu-sidebar-home']) {

    } else {
        if (isset($porto_settings['menu-login-pos']) && $porto_settings['menu-login-pos'] == 'main_menu') {
            $have_sidebar_menu = true;
        }
        if ($porto_settings['menu-block']) {
            $have_sidebar_menu = true;
        }
        $main_menu = porto_get_meta_value('main_menu');
        if ( has_nav_menu( 'main_menu' ) || $main_menu ) {
            $have_sidebar_menu = true;
        }
    }

    // sidebar menu
    $sidebar_menu = porto_get_meta_value('sidebar_menu');
    if ( has_nav_menu( 'sidebar_menu' ) || $sidebar_menu ) {
        $have_sidebar_menu = true;
    }

    return apply_filters('porto_is_sidebar_menu', $have_sidebar_menu);
}

function porto_sidebar_menu() {
    global $porto_settings, $porto_layout;

    $header_type = porto_get_header_type();
    
    $is_home = false;
    if ( is_front_page() && is_home() ) {
        $is_home = true;
    } elseif ( is_front_page() ) {
        $is_home = true;
    }

    $output = '';

    $html = '';
    if (!((($header_type == 1 || $header_type == 4 || $header_type == 13 || $header_type == 14) && ($porto_layout == 'wide-left-sidebar' || $porto_layout == 'wide-right-sidebar' || $porto_layout == 'left-sidebar' || $porto_layout == 'right-sidebar') && $porto_settings['menu-sidebar']))) {

    } else if (($header_type == 1 || $header_type == 4 || $header_type == 13 || $header_type == 14) && !$is_home && $porto_settings['menu-sidebar-home']) {

    } else {
        // show language switcher
        if ( $porto_settings['wpml-switcher'] && $porto_settings['wpml-switcher-pos'] == 'main_menu' ) {
            if ( function_exists('icl_get_languages') ) {
                $languages = icl_get_languages('skip_missing=0&orderby=code');
                if (!empty($languages)) {
                    $active_lang = '';
                    $other_langs = '';
                    foreach ($languages as $l) {
                        if (!$l['active']) {
                            $other_langs .= '<li class="menu-item"><a href="'.esc_url($l['url']).'">';
                        }
                        if ($l['country_flag_url']){
                            if ($l['active']) {
                                $active_lang .= '<span class="flag"><img src="'.esc_url($l['country_flag_url']).'" height="12" alt="'.esc_attr($l['language_code']).'" width="18" /></span>';
                            } else {
                                $other_langs .= '<span class="flag"><img src="'.esc_url($l['country_flag_url']).'" height="12" alt="'.esc_attr($l['language_code']).'" width="18" /></span>';
                            }
                        }
                        if ($l['active']) {
                            $active_lang .= porto_icl_disp_language($l['native_name'], $l['translated_name']);
                        } else {
                            $other_langs .= porto_icl_disp_language($l['native_name'], $l['translated_name']);
                        }
                        if (!$l['active']) {
                            $other_langs .= '</a></li>';
                        }
                    }
                    $html .= '<li class="menu-item' . ($other_langs ? ' has-sub' : '') . ' narrow">';
                    $html .= '<h5>' . $active_lang . '</h5><span class="arrow"></span>';
                    if ($other_langs) {
                        $html .= '<div class="popup"><div class="inner"><ul class="sub-menu">';
                        $html .= $other_langs;
                        $html .= '</ul></div></div>';
                    }
                    $html .= '</li>';
                }
            } else if ( function_exists('qtranxf_getSortedLanguages') ) {
                global $q_config;

                $languages = qtranxf_getSortedLanguages();
                $flag_location = qtranxf_flag_location();
                if(is_404()) $url = get_option('home'); else $url = '';

                if (!empty($languages)) {
                    $active_lang = '';
                    $other_langs = '';
                    foreach ($languages as $language) {
                        if ($language != $q_config['language']) {
                            $other_langs .= '<li class="menu-item"><a href="'.qtranxf_convertURL($url, $language, false, true).'">';
                            $other_langs .= '<span class="flag"><img src="'.$flag_location.$q_config['flag'][$language].'" /></span>';
                            $other_langs .= $q_config['language_name'][$language];
                            $other_langs .= '</a></li>';
                        } else {
                            $active_lang .= '<span class="flag"><img src="'.$flag_location.$q_config['flag'][$language].'" /></span>';
                            $active_lang .= $q_config['language_name'][$language];
                        }
                    }
                    $html .= '<li class="menu-item' . ($other_langs ? ' has-sub' : '') . ' narrow">';
                    $html .= '<h5>' . $active_lang . '</h5><span class="arrow"></span>';
                    if ($other_langs) {
                        $html .= '<div class="popup"><div class="inner"><ul class="sub-menu">';
                        $html .= $other_langs;
                        $html .= '</ul></div></div>';
                    }
                    $html .= '</li>';
                }
            }
        }

        // show currency switcher
        if ( $porto_settings['wcml-switcher'] && $porto_settings['wcml-switcher-pos'] == 'main_menu' ) {
            if ( class_exists('WCML_Multi_Currency_Support') ) {
                global $sitepress, $woocommerce_wpml;

                $settings = $woocommerce_wpml->get_settings();
                $format = '%symbol% %code%';
                $wc_currencies = get_woocommerce_currencies();
                if (!isset($settings['currencies_order'])) {
                    $currencies = $woocommerce_wpml->multi_currency_support->get_currency_codes();
                } else {
                    $currencies = $settings['currencies_order'];
                }
                $active_c = '';
                $other_c = '';

                foreach ($currencies as $currency) {
                    if ($woocommerce_wpml->settings['currency_options'][$currency]['languages'][$sitepress->get_current_language()] == 1 ) {
                        $selected = $currency == $woocommerce_wpml->multi_currency_support->get_client_currency() ? ' selected="selected"' : '';
                        $currency_format = preg_replace(array('#%name%#', '#%symbol%#', '#%code%#'),
                            array($wc_currencies[$currency], get_woocommerce_currency_symbol($currency), $currency), $format);

                        if ($selected) {
                            $active_c .= $currency_format;
                        } else {
                            $other_c .= '<li rel="' . $currency . '" class="menu-item"><h5>' . $currency_format . '</h5></li>';
                        }
                    }
                }
                $html .= '<li class="menu-item' . ($other_c ? ' has-sub' : '') . ' narrow">';
                $html .= '<h5>' . $active_c . '</h5><span class="arrow"></span>';
                if ($other_c) {
                    $html .= '<div class="popup"><div class="inner"><ul class="sub-menu wcml-switcher">';
                    $html .= $other_c;
                    $html .= '</ul></div></div>';
                }
                $html .= '</li>';
            } else if ( class_exists('WOOCS') ) {
                global $WOOCS;
                $currencies = $WOOCS->get_currencies();
                $current_currency = $WOOCS->current_currency;

                $active_c = '';
                $other_c = '';

                foreach ($currencies as $currency) {
                    $label = ($currency['flag'] ? '<span class="flag"><img src="'.esc_url($currency['flag']).'" height="12" alt="'.esc_attr($currency['name']).'" width="18" /></span>' : '') . $currency['name'] . ' ' . $currency['symbol'];
                    if ($currency['name'] == $current_currency) {
                        $active_c .= $label;
                    } else {
                        $other_c .= '<li rel="' . $currency['name'] . '" class="menu-item"><h5>' . $label . '</h5></li>';
                    }
                }
                $html .= '<li class="menu-item' . ($other_c ? ' has-sub' : '') . ' narrow">';
                $html .= '<h5>' . $active_c . '</h5><span class="arrow"></span>';
                if ($other_c) {
                    $html .= '<div class="popup"><div class="inner"><ul class="sub-menu woocs-switcher">';
                    $html .= $other_c;
                    $html .= '</ul></div></div>';
                }
                $html .= '</li>';
            }
        }

        // show login/logout link
        if (isset($porto_settings['menu-login-pos']) && $porto_settings['menu-login-pos'] == 'main_menu') {
            if (is_user_logged_in()) {
                $logout_link = '';
                if ( class_exists( 'WooCommerce' ) ) {
                    $logout_link = wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) );
                } else {
                    $logout_link = wp_logout_url( get_home_url() );
                }
                $html .= '<li class="menu-item"><a href="' . $logout_link . '"><i class="avatar">' . get_avatar( get_current_user_id(), $size = '24' ) . '</i>' . __('Logout', 'porto') . '</a></li>';
            } else {
                $login_link = $register_link = '';
                if ( class_exists( 'WooCommerce' ) ) {
                    $login_link = wc_get_page_permalink( 'myaccount' );
                    if (get_option('woocommerce_enable_myaccount_registration') === 'yes') {
                        $register_link = wc_get_page_permalink( 'myaccount' );
                    }
                } else {
                    $login_link = wp_login_url( get_home_url() );
                    $active_signup = get_site_option( 'registration', 'none' );
                    $active_signup = apply_filters( 'wpmu_active_signup', $active_signup );
                    if ($active_signup != 'none')
                        $register_link = wp_registration_url( get_home_url() );
                }
                $html .= '<li class="menu-item"><a href="' . $login_link . '"><i class="fa fa-user"></i>' . __('Login', 'porto') . '</a></li>';
                if ($register_link && isset($porto_settings['menu-enable-register']) && $porto_settings['menu-enable-register']) {
                    $html .= '<li class="menu-item"><a href="' . $register_link . '"><i class="fa fa-user-plus"></i>' . __('Register', 'porto') . '</a></li>';
                }
            }
        }
        if ($porto_settings['menu-block']) {
            $html .= '<li class="menu-custom-item"><div class="menu-custom-block">'.force_balance_tags($porto_settings['menu-block']).'</div></li>';
        }

        ob_start();
        $main_menu = porto_get_meta_value('main_menu');
        if ( has_nav_menu( 'main_menu' ) || $main_menu ) {
            $args = array(
            'container' => '',
                'menu_class' => 'main-menu sidebar-menu' . ((has_nav_menu( 'sidebar_menu' ) || porto_get_meta_value('sidebar_menu')) ? ' has-side-menu' : '') . ($porto_settings['menu-sub-effect']?' '.$porto_settings['menu-sub-effect']:''),
                'before' => '',
                'after' => '',
                'link_before' => '',
                'link_after' => '',
                'fallback_cb' => false,
                'walker' => new porto_sidebar_navwalker
            );
            if ($main_menu) {
                $args['menu'] = $main_menu;
            } else {
                $args['theme_location'] = 'main_menu';
            }
            wp_nav_menu($args);
        }

        $output .= str_replace('&nbsp;', '', ob_get_clean());

        if ($output && $html) {
            $output = preg_replace('/<\/ul>$/', $html . '</ul>', $output, 1);
        } else if (!$output && $html) {
            $output = '<ul class="' . 'main-menu sidebar-menu' . ((has_nav_menu( 'sidebar_menu' ) || porto_get_meta_value('sidebar_menu')) ? ' has-side-menu' : '') . ($porto_settings['menu-sub-effect']?' '.$porto_settings['menu-sub-effect']:'') . '" id="menu-main-menu">' . $html . '</ul>';
        }
    }

    // sidebar menu
    ob_start();
    $sidebar_menu = porto_get_meta_value('sidebar_menu');
    if ( has_nav_menu( 'sidebar_menu' ) || $sidebar_menu ) {
        $args = array(
            'container' => '',
            'menu_class' => 'sidebar-menu' . ($output ? ' has-main-menu' : '') . ($porto_settings['menu-sub-effect']?' '.$porto_settings['menu-sub-effect']:''),
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'fallback_cb' => false,
            'walker' => new porto_sidebar_navwalker
        );
        if ($sidebar_menu) {
            $args['menu'] = $sidebar_menu;
        } else {
            $args['theme_location'] = 'sidebar_menu';
        }
        wp_nav_menu($args);
    }

    $output .= str_replace('&nbsp;', '', ob_get_clean());

    return apply_filters('porto_sidebar_menu', $output);
}

function porto_mobile_menu() {
    global $porto_settings;

    $html = '';
    if (isset($porto_settings['menu-login-pos']) && $porto_settings['menu-login-pos'] == 'main_menu') {
        if (is_user_logged_in()) {
            $logout_link = '';
            if ( class_exists( 'WooCommerce' ) ) {
                $logout_link = wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) );
            } else {
                $logout_link = wp_logout_url( get_home_url() );
            }
            $html .= '<li class="menu-item"><a href="' . $logout_link . '"><i class="avatar">' . get_avatar( get_current_user_id(), $size = '24' ) . '</i>' . __('Logout', 'porto') . '</a></li>';
        } else {
            $login_link = $register_link = '';
            if ( class_exists( 'WooCommerce' ) ) {
                $login_link = wc_get_page_permalink( 'myaccount' );
                if (get_option('woocommerce_enable_myaccount_registration') === 'yes') {
                    $register_link = wc_get_page_permalink( 'myaccount' );
                }
            } else {
                $login_link = wp_login_url( get_home_url() );
                $active_signup = get_site_option( 'registration', 'none' );
                $active_signup = apply_filters( 'wpmu_active_signup', $active_signup );
                if ($active_signup != 'none')
                    $register_link = wp_registration_url( get_home_url() );
            }
            $html .= '<li class="menu-item"><a href="' . $login_link . '"><i class="fa fa-user"></i>' . __('Login', 'porto') . '</a></li>';
            if ($register_link && isset($porto_settings['menu-enable-register']) && $porto_settings['menu-enable-register']) {
                $html .= '<li class="menu-item"><a href="' . $register_link . '"><i class="fa fa-user-plus"></i>' . __('Register', 'porto') . '</a></li>';
            }
        }
    }

    ob_start();
    $main_menu = porto_get_meta_value('main_menu');
    if ( has_nav_menu( 'main_menu' ) || $main_menu ) :
        $args = array(
            'container' => '',
            'menu_class' => 'mobile-menu accordion-menu',
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'fallback_cb' => false,
            'walker' => new porto_accordion_navwalker
        );
        if ($main_menu) {
            $args['menu'] = $main_menu;
        } else {
            $args['theme_location'] = 'main_menu';
        }
        wp_nav_menu($args);
    endif;

    $output = str_replace('&nbsp;', '', ob_get_clean());

    // sidebar menu
    ob_start();
    $sidebar_menu = porto_get_meta_value('sidebar_menu');
    if ( has_nav_menu( 'sidebar_menu' ) || $sidebar_menu ) {
        $args = array(
            'container' => '',
            'menu_class' => 'mobile-menu accordion-menu',
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'fallback_cb' => false,
            'walker' => new porto_accordion_navwalker
        );
        if ($sidebar_menu) {
            $args['menu'] = $sidebar_menu;
        } else {
            $args['theme_location'] = 'sidebar_menu';
        }
        wp_nav_menu($args);
    }

    $output .= str_replace('&nbsp;', '', ob_get_clean());

    if ($output && $html) {
        $output = preg_replace('/<\/ul>$/', $html . '</ul>', $output, 1);
    } else if (!$output && $html) {
        $output = '<ul class="' . 'mobile-menu accordion-menu' . '" id="menu-main-menu">' . $html . '</ul>';
    }

    return apply_filters('porto_mobile_menu', $output);
}

function porto_search_form() {
    global $porto_settings;

    if (!$porto_settings['show-searchform']) return '';

    ob_start();
    ?>
    <div class="searchform-popup">
        <a class="search-toggle"><i class="fa fa-search"></i></a>
        <?php echo porto_search_form_content(); ?>
    </div>
    <?php
    return apply_filters('porto_search_form', ob_get_clean());
}

function porto_search_form_content() {
    global $porto_settings;

    if (!$porto_settings['show-searchform']) return '';

    ob_start();
    if (isset($porto_settings['search-type']) && $porto_settings['search-type'] === 'product' && class_exists( 'WooCommerce' ) && defined('YITH_WCAS')) {
        $wc_get_template = function_exists('wc_get_template') ? 'wc_get_template' : 'woocommerce_get_template';
        $wc_get_template( 'yith-woocommerce-ajax-search.php', array(), '', YITH_WCAS_DIR . 'templates/' );
        return;
    }
    ?>
    <form action="<?php echo home_url(); ?>/" method="get"
        class="searchform <?php if (isset($porto_settings['search-type']) && ($porto_settings['search-type'] === 'post' || $porto_settings['search-type'] === 'product' || $porto_settings['search-type'] === 'portfolio') && (isset($porto_settings['search-cats']) && $porto_settings['search-cats'])) echo 'searchform-cats'; ?>">
        <fieldset>
            <span class="text"><input name="s" id="s" type="text" value="<?php echo get_search_query() ?>" placeholder="<?php echo __('Search&hellip;', 'porto'); ?>" autocomplete="off" /></span>
            <?php if (isset($porto_settings['search-type']) && ($porto_settings['search-type'] === 'post' || $porto_settings['search-type'] === 'product' || $porto_settings['search-type'] === 'portfolio')) : ?>
                <input type="hidden" name="post_type" value="<?php echo $porto_settings['search-type'] ?>"/>
                <?php
                if (isset($porto_settings['search-cats']) && $porto_settings['search-cats']) {
                    $args = array(
                        'show_option_all' => __( 'All Categories', 'porto' ),
                        'hierarchical' => 1,
                        'class' => 'cat',
                        'echo' => 1,
                        'value_field' => 'slug',
                        'selected' => 1
                    );
                    if ($porto_settings['search-type'] === 'product' && class_exists('WooCommerce')) {
                        $args['taxonomy'] = 'product_cat';
                        $args['name'] = 'product_cat';
                    }
                    if ($porto_settings['search-type'] === 'portfolio') {
                        $args['taxonomy'] = 'portfolio_cat';
                        $args['name'] = 'portfolio_cat';
                    }
                    wp_dropdown_categories($args);
                }
            endif; ?>
            <span class="button-wrap"><button class="btn btn-special" title="<?php echo __('Search', 'porto'); ?>" type="submit"><i class="fa fa-search"></i></button></span>
        </fieldset>
    </form>
    <?php
    return apply_filters('porto_search_form_content', ob_get_clean());
}

function porto_header_socials() {
    global $porto_settings;

    if (!$porto_settings['show-header-socials']) return '';

    $nofollow = '';
    if ($porto_settings['header-socials-nofollow'])
        $nofollow = ' rel="nofollow"';

    ob_start();
    echo '<div class="share-links">';
    if ($porto_settings['header-social-facebook']) :
        ?><a target="_blank" <?php echo $nofollow ?> class="share-facebook" href="<?php echo esc_url($porto_settings['header-social-facebook']) ?>" title="<?php _e('Facebook', 'porto') ?>"></a><?php
    endif;

    if ($porto_settings['header-social-twitter']) :
        ?><a target="_blank" <?php echo $nofollow ?> class="share-twitter" href="<?php echo esc_url($porto_settings['header-social-twitter']) ?>" title="<?php _e('Twitter', 'porto') ?>"></a><?php
    endif;

    if ($porto_settings['header-social-rss']) :
        ?><a target="_blank" <?php echo $nofollow ?> class="share-rss" href="<?php echo esc_url($porto_settings['header-social-rss']) ?>" title="<?php _e('RSS', 'porto') ?>"></a><?php
    endif;

    if ($porto_settings['header-social-pinterest']) :
        ?><a target="_blank" <?php echo $nofollow ?> class="share-pinterest" href="<?php echo esc_url($porto_settings['header-social-pinterest']) ?>" title="<?php _e('Pinterest', 'porto') ?>"></a><?php
    endif;

    if ($porto_settings['header-social-youtube']) :
        ?><a target="_blank" <?php echo $nofollow ?> class="share-youtube" href="<?php echo esc_url($porto_settings['header-social-youtube']) ?>" title="<?php _e('Youtube', 'porto') ?>"></a><?php
    endif;

    if ($porto_settings['header-social-instagram']) :
        ?><a target="_blank" <?php echo $nofollow ?> class="share-instagram" href="<?php echo esc_url($porto_settings['header-social-instagram']) ?>" title="<?php _e('Instagram', 'porto') ?>"></a><?php
    endif;

    if ($porto_settings['header-social-skype']) :
        ?><a target="_blank" <?php echo $nofollow ?> class="share-skype" href="<?php echo esc_attr($porto_settings['header-social-skype']) ?>" title="<?php _e('Skype', 'porto') ?>"></a><?php
    endif;

    if ($porto_settings['header-social-linkedin']) :
        ?><a target="_blank" <?php echo $nofollow ?> class="share-linkedin" href="<?php echo esc_url($porto_settings['header-social-linkedin']) ?>" title="<?php _e('LinkedIn', 'porto') ?>"></a><?php
    endif;

    if ($porto_settings['header-social-googleplus']) :
        ?><a target="_blank" <?php echo $nofollow ?> class="share-googleplus" href="<?php echo esc_url($porto_settings['header-social-googleplus']) ?>" title="<?php _e('Google Plus', 'porto') ?>"></a><?php
    endif;

    if ($porto_settings['header-social-vk']) :
        ?><a target="_blank" <?php echo $nofollow ?> class="share-vk" href="<?php echo esc_url($porto_settings['header-social-vk']) ?>" title="<?php _e('VK', 'porto') ?>"></a><?php
    endif;

    if ($porto_settings['header-social-xing']) :
        ?><a target="_blank" <?php echo $nofollow ?> class="share-xing" href="<?php echo esc_url($porto_settings['header-social-xing']) ?>" title="<?php _e('Xing', 'porto') ?>"></a><?php
    endif;

    if ($porto_settings['header-social-tumblr']) :
        ?><a target="_blank" <?php echo $nofollow ?> class="share-tumblr" href="<?php echo esc_url($porto_settings['header-social-tumblr']) ?>" title="<?php _e('Tumblr', 'porto') ?>"></a><?php
    endif;

    if ($porto_settings['header-social-reddit']) :
        ?><a target="_blank" <?php echo $nofollow ?> class="share-reddit" href="<?php echo esc_url($porto_settings['header-social-reddit']) ?>" title="<?php _e('Reddit', 'porto') ?>"></a><?php
    endif;

    if ($porto_settings['header-social-vimeo']) :
        ?><a target="_blank" <?php echo $nofollow ?> class="share-vimeo" href="<?php echo esc_url($porto_settings['header-social-vimeo']) ?>" title="<?php _e('Vimeo', 'porto') ?>"></a><?php
    endif;

    if ($porto_settings['header-social-telegram']) :
        ?><a target="_blank" <?php echo $nofollow ?> class="share-telegram" href="<?php echo esc_url($porto_settings['header-social-telegram']) ?>" title="<?php _e('Telegram', 'porto') ?>"></a><?php
    endif;

    if ($porto_settings['header-social-yelp']) :
        ?><a target="_blank" <?php echo $nofollow ?> class="share-yelp" href="<?php echo esc_url($porto_settings['header-social-yelp']) ?>" title="<?php _e('Yelp', 'porto') ?>"></a><?php
    endif;

    if ($porto_settings['header-social-flickr']) :
        ?><a target="_blank" <?php echo $nofollow ?> class="share-flickr" href="<?php echo esc_url($porto_settings['header-social-flickr']) ?>" title="<?php _e('Flickr', 'porto') ?>"></a><?php
    endif;

    if ($porto_settings['header-social-whatsapp']) :
        ?><a target="_blank" <?php echo $nofollow ?> class="share-whatsapp" style="display:none" href="whatsapp://send?text=<?php echo esc_url($porto_settings['header-social-whatsapp']) ?>" title="<?php echo __('WhatsApp', 'porto') ?>"><?php echo __('WhatsApp', 'porto') ?></a><?php
    endif;

    echo '</div>';

    return apply_filters('porto_header_socials', ob_get_clean());
}

function porto_minicart() {
    global $woocommerce, $porto_settings;

    if (!$porto_settings['show-minicart']) return '';

    if ($porto_settings['catalog-enable']) {
        if ($porto_settings['catalog-admin'] || (!$porto_settings['catalog-admin'] && !(current_user_can( 'administrator' ) && is_user_logged_in())) ) {
            if (!$porto_settings['catalog-cart']) {
                return '';
            }
        }
    }

    $minicart_type = porto_get_minicart_type();

    ob_start();
    if ( class_exists( 'WooCommerce' ) ) :
        ?>
        <div id="mini-cart" class="dropdown mini-cart <?php echo $minicart_type ?><?php echo ($porto_settings['minicart-effect']?' '.$porto_settings['minicart-effect']:'') ?>">
            <div class="dropdown-toggle cart-head <?php echo str_replace('minicart-icon', 'cart-head', $porto_settings['minicart-icon']) ?>" data-toggle="dropdown" data-delay="50" data-close-others="false">
                <i class="minicart-icon <?php echo $porto_settings['minicart-icon'] ?>"></i>
                <?php if (defined('WP_CACHE') && WP_CACHE) :
                    $_cartQty = '<i class="fa fa-spinner fa-pulse"></i>';
                    ?>
                    <span class="cart-items"><?php echo ($minicart_type == 'minicart-inline')
                            ? '<span class="mobile-hide">' . $_cartQty . '</span><span class="mobile-show">' . $_cartQty . '</span>' : $_cartQty; ?></span>
                <?php else :
                    $_cartQty = $woocommerce->cart->cart_contents_count;
                    ?>
                    <span class="cart-items"><?php echo ($minicart_type == 'minicart-inline')
                            ? '<span class="mobile-hide">' . sprintf( _n( '%d item', '%d items', $_cartQty, 'porto' ), $_cartQty ) . '</span><span class="mobile-show">' . $_cartQty . '</span>'
                            : (($_cartQty > 0) ? $_cartQty : '0'); ?></span>
                <?php endif; ?>
            </div>
            <div class="dropdown-menu cart-popup widget_shopping_cart">
                <div class="widget_shopping_cart_content">
                    <div class="cart-loading"></div>
                </div>
            </div>
        </div>
    <?php
    endif;

    return apply_filters('porto_minicart', ob_get_clean());
}

function porto_get_wrapper_type() {
    global $porto_settings;

    return apply_filters('porto_get_wrapper_type', $porto_settings['wrapper']);
}

function porto_get_header_type() {
    global $porto_settings;

    return apply_filters('porto_get_header_type', $porto_settings['header-type']);
}

function porto_get_minicart_type() {
    global $porto_settings;

    $header_type = porto_get_header_type();
    return apply_filters('porto_get_minicart_type', ($header_type == 'side' || $header_type >= 10) ? 'minicart-inline' : $porto_settings['minicart-type']);
}

function porto_get_blog_id() {
    global $porto_settings;

    return apply_filters('porto_get_blog_id', get_current_blog_id());
}

function porto_is_dark_skin() {
    global $porto_settings;

    return apply_filters('porto_is_dark_skin', (isset($porto_settings['css-type']) && $porto_settings['css-type'] == 'dark'));
}

add_filter('masterslider_layer_shortcode', 'porto_master_slider_iframe', 10, 4);

function porto_master_slider_iframe($layer, $merged, $atts, $content) {
    return str_replace('<iframe', '<iframe frameborder="0"', $layer);
}

function porto_render_rich_snippets( $title_tag = true, $author_tag = true, $updated_tag = true ) {

    global $porto_settings;

    if (isset($porto_settings['rich-snippets']) && $porto_settings['rich-snippets']) {
        if ($title_tag) {
            echo '<span class="entry-title" style="display: none;">' . get_the_title() . '</span>';
        }
        if ($author_tag) {
            echo '<span class="vcard" style="display: none;"><span class="fn">';
            the_author_posts_link();
            echo '</span></span>';
        }
        if ($updated_tag) {
            echo '<span class="updated" style="display:none">' . get_the_modified_time('c') . '</span>';
        }
    }

}

function porto_get_button_style() {
    global $porto_settings;

    return isset($porto_settings['button-style']) ? $porto_settings['button-style'] : '';
}

function porto_icl_disp_language( $native_name, $translated_name = false, $lang_native_hidden = false, $lang_translated_hidden = false ) {
    if (function_exists('icl_disp_language')) {
        return icl_disp_language($native_name, $translated_name, $lang_native_hidden, $lang_translated_hidden);
    }
    $ret = '';

    if ( !$native_name && !$translated_name ) {
        $ret = '';
    } elseif ( $native_name && $translated_name ) {
        $hidden1 = $hidden2 = $hidden3 = '';
        if ( $lang_native_hidden ) {
            $hidden1 = 'style="display:none;"';
        }
        if ( $lang_translated_hidden ) {
            $hidden2 = 'style="display:none;"';
        }
        if ( $lang_native_hidden && $lang_translated_hidden ) {
            $hidden3 = 'style="display:none;"';
        }

        if ( $native_name != $translated_name ) {
            $ret =
                '<span ' .
                $hidden1 .
                ' class="icl_lang_sel_native">' .
                $native_name .
                '</span> <span ' .
                $hidden2 .
                ' class="icl_lang_sel_translated"><span ' .
                $hidden1 .
                ' class="icl_lang_sel_native">(</span>' .
                $translated_name .
                '<span ' .
                $hidden1 .
                ' class="icl_lang_sel_native">)</span></span>';
        } else {
            $ret = '<span ' . $hidden3 . ' class="icl_lang_sel_current">' . $native_name . '</span>';
        }
    } elseif ( $native_name ) {
        $ret = $native_name;
    } elseif ( $translated_name ) {
        $ret = $translated_name;
    }

    return $ret;
}

function porto_get_featured_images( $post_id = null ) {
    if ( is_null( $post_id ) ) {
        global $post;
        $post_id = $post->ID;
    }
    if( class_exists('Dynamic_Featured_Image') ) {
        global $dynamic_featured_image;
        return $dynamic_featured_image->get_all_featured_images( $post_id );
    }
    $thumbnail_id = get_post_thumbnail_id( $post_id );
    $featured_images = array();
    if ( ! empty( $thumbnail_id ) ) {
        $featured_image         = array(
            'thumb'         => wp_get_attachment_thumb_url( $thumbnail_id ),
            'full'          => wp_get_attachment_url( $thumbnail_id ),
            'attachment_id' => $thumbnail_id
        );
        $featured_images[] = $featured_image;
    }
    return $featured_images;
}

function porto_show_archive_filter() {

    global $porto_settings;

    $value = false;

    if (is_archive()) {
        if (is_post_type_archive('portfolio')) {
            $value = $porto_settings['portfolio-cat-sort-pos'] == 'sidebar' && get_categories(array('taxonomy' => 'portfolio_cat'));
        } else if (is_post_type_archive('member')) {
            $value = $porto_settings['member-cat-sort-pos'] == 'sidebar' && get_categories(array('taxonomy' => 'member_cat'));
        } else if (is_post_type_archive('faq')) {
            $value = $porto_settings['faq-cat-sort-pos'] == 'sidebar' && get_categories(array('taxonomy' => 'faq_cat'));
        } else {
            $term = get_queried_object();
            if ($term && isset($term->taxonomy) && isset($term->term_id)) {
                switch ($term->taxonomy) {
                    case in_array($term->taxonomy, porto_get_taxonomies('portfolio')):
                        $value = $porto_settings['portfolio-cat-sort-pos'] == 'sidebar' && get_categories(array('taxonomy' => 'portfolio_cat', 'child_of' => $term->term_id));
                        break;
                    case in_array($term->taxonomy, porto_get_taxonomies('faq')):
                        $value = $porto_settings['faq-cat-sort-pos'] == 'sidebar' && get_categories(array('taxonomy' => 'faq_cat', 'child_of' => $term->term_id));
                        break;
                }
            }
        }
    }

    return apply_filters('porto_show_archive_filter', $value);
}

function porto_woocommerce_product_nav() {
    global $porto_settings;

    if (!$porto_settings['product-nav'])
        return;

    if ( is_singular('product') ) {
        echo '<div class="product-nav">';
        porto_woocommerce_next_product(true);
        porto_woocommerce_prev_product(true);
        echo '</div>';
    }
}

function porto_breadcrumbs_filter() {
    global $porto_settings;

    if (is_archive()) {
        if (is_post_type_archive('portfolio')) {
            if ($porto_settings['portfolio-cat-sort-pos'] === 'breadcrumbs' && !is_search())
                porto_show_portfolio_archive_filter('global');
        } else if (is_post_type_archive('member')) {
            if ($porto_settings['member-cat-sort-pos'] === 'breadcrumbs' && !is_search())
                porto_show_member_archive_filter('global');
        } else if (is_post_type_archive('faq')) {
            if ($porto_settings['faq-cat-sort-pos'] === 'breadcrumbs' && !is_search())
                porto_show_faq_archive_filter('global');
        } else {
            $term = get_queried_object();
            if ($term && isset($term->taxonomy) && isset($term->term_id)) {
                switch ($term->taxonomy) {
                    case in_array($term->taxonomy, porto_get_taxonomies('portfolio')):
                        if ($porto_settings['portfolio-cat-sort-pos'] === 'breadcrumbs')
                            porto_show_portfolio_tax_filter('global');
                        break;
                    case in_array($term->taxonomy, porto_get_taxonomies('faq')):
                        if ($porto_settings['faq-cat-sort-pos'] === 'breadcrumbs')
                            porto_show_faq_tax_filter('global');
                        break;
                }
            }
        }
    }
}

function porto_show_portfolio_archive_filter( $position = 'global' ) {
    global $porto_settings;

    $portfolio_infinite = $porto_settings['portfolio-infinite'];

    $portfolio_taxs = array();

    $taxs = get_categories(array(
        'taxonomy' => 'portfolio_cat',
        'orderby' => isset($porto_settings['portfolio-cat-orderby']) ? $porto_settings['portfolio-cat-orderby'] : 'name',
        'order' => isset($porto_settings['portfolio-cat-order']) ? $porto_settings['portfolio-cat-order'] : 'asc'
    ));

    foreach ($taxs as $tax) {
        $portfolio_taxs[urldecode($tax->slug)] = $tax->name;
    }

    if (!$portfolio_infinite) {
        global $wp_query;
        $posts_portfolio_taxs = array();
        if (is_array($wp_query->posts) && !empty($wp_query->posts)) {
            foreach($wp_query->posts as $post) {
                $post_taxs = wp_get_post_terms($post->ID, 'portfolio_cat', array("fields" => "all"));
                if (is_array($post_taxs) && !empty($post_taxs)) {
                    foreach ($post_taxs as $post_tax) {
                        $posts_portfolio_taxs[urldecode($post_tax->slug)] = $post_tax->name;
                    }
                }
            }
        }
        foreach ($portfolio_taxs as $key => $value) {
            if (!isset($posts_portfolio_taxs[$key]))
                unset($portfolio_taxs[$key]);
        }
    }

    if ($position !== 'global')
        $position = 'sidebar';

    if ($position == 'sidebar') : ?>
        <h4 class="filter-title"><?php echo __('<strong>Filter</strong> By', 'porto') ?></h4>
        <ul class="portfolio-filter nav nav-list m-b-lg" data-position="<?php echo esc_attr($position) ?>">
            <li class="active" data-filter="*"><a href="#"><?php echo __('Show All', 'porto'); ?></a></li>
            <?php foreach ($portfolio_taxs as $tax_slug => $tax_name) : ?>
                <li data-filter="<?php echo esc_attr($tax_slug) ?>"><a href="#"><?php echo esc_html($tax_name) ?></a></li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <ul class="portfolio-filter nav sort-source" data-position="<?php echo esc_attr($position) ?>">
            <li class="active" data-filter="*"><a href="#"><?php echo __('Show All', 'porto'); ?></a></li>
            <?php foreach ($portfolio_taxs as $tax_slug => $tax_name) : ?>
                <li data-filter="<?php echo esc_attr($tax_slug) ?>"><a href="#"><?php echo esc_html($tax_name) ?></a></li>
            <?php endforeach; ?>
        </ul>
    <?php endif;
}

function porto_show_portfolio_tax_filter( $position = 'global' ) {
    global $porto_settings, $wp_query;

    $term = $wp_query->queried_object;
    $term_id = $term->term_id;

    $portfolio_options = get_metadata($term->taxonomy, $term->term_id, 'portfolio_options', true) == 'portfolio_options' ? true : false;
    $portfolio_infinite = $portfolio_options ? (get_metadata($term->taxonomy, $term->term_id, 'portfolio_infinite', true) != 'portfolio_infinite' ? true : false ) : $porto_settings['portfolio-infinite'];

    $portfolio_taxs = array();

    $taxs = get_categories(array(
        'taxonomy' => 'portfolio_cat',
        'child_of' => $term_id,
        'orderby' => isset($porto_settings['portfolio-cat-orderby']) ? $porto_settings['portfolio-cat-orderby'] : 'name',
        'order' => isset($porto_settings['portfolio-cat-order']) ? $porto_settings['portfolio-cat-order'] : 'asc'
    ));

    foreach ($taxs as $tax) {
        $portfolio_taxs[urldecode($tax->slug)] = $tax->name;
    }

    if (!$portfolio_infinite) {
        global $wp_query;
        $posts_portfolio_taxs = array();
        if (is_array($wp_query->posts) && !empty($wp_query->posts)) {
            foreach($wp_query->posts as $post) {
                $post_taxs = wp_get_post_terms($post->ID, 'portfolio_cat', array("fields" => "all"));
                if (is_array($post_taxs) && !empty($post_taxs)) {
                    foreach ($post_taxs as $post_tax) {
                        $posts_portfolio_taxs[urldecode($post_tax->slug)] = $post_tax->name;
                    }
                }
            }
        }
        foreach ($portfolio_taxs as $key => $value) {
            if (!isset($posts_portfolio_taxs[$key]))
                unset($portfolio_taxs[$key]);
        }
    }

    if ($position !== 'global')
        $position = 'sidebar';

    if (is_array($portfolio_taxs) && !empty($portfolio_taxs)) :
        if ($position == 'sidebar') : ?>
            <h4 class="filter-title"><?php echo __('<strong>Filter</strong> By', 'porto') ?></h4>
            <ul class="portfolio-filter nav nav-list m-b-lg" data-position="<?php echo esc_attr($position) ?>">
                <li class="active" data-filter="*"><a href="#"><?php echo __('Show All', 'porto'); ?></a></li>
                <?php foreach ($portfolio_taxs as $tax_slug => $tax_name) : ?>
                    <li data-filter="<?php echo esc_attr($tax_slug) ?>"><a href="#"><?php echo esc_html($tax_name) ?></a></li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <ul class="portfolio-filter nav sort-source" data-position="<?php echo esc_attr($position) ?>">
                <li class="active" data-filter="*"><a href="#"><?php echo __('Show All', 'porto'); ?></a></li>
                <?php foreach ($portfolio_taxs as $tax_slug => $tax_name) : ?>
                    <li data-filter="<?php echo esc_attr($tax_slug) ?>"><a href="#"><?php echo esc_html($tax_name) ?></a></li>
                <?php endforeach; ?>
            </ul>
        <?php endif;
    endif;
}

function porto_show_member_archive_filter( $position = 'global' ) {
    global $porto_settings;

    $member_infinite = $porto_settings['member-infinite'];

    $member_taxs = array();

    $taxs = get_categories(array(
        'taxonomy' => 'member_cat',
        'orderby' => isset($porto_settings['member-cat-orderby']) ? $porto_settings['member-cat-orderby'] : 'name',
        'order' => isset($porto_settings['member-cat-order']) ? $porto_settings['member-cat-order'] : 'asc'
    ));

    foreach ($taxs as $tax) {
        $member_taxs[urldecode($tax->slug)] = $tax->name;
    }

    if (!$member_infinite) {
        global $wp_query;
        $posts_member_taxs = array();
        if (is_array($wp_query->posts) && !empty($wp_query->posts)) {
            foreach($wp_query->posts as $post) {
                $post_taxs = wp_get_post_terms($post->ID, 'member_cat', array("fields" => "all"));
                if (is_array($post_taxs) && !empty($post_taxs)) {
                    foreach ($post_taxs as $post_tax) {
                        $posts_member_taxs[urldecode($post_tax->slug)] = $post_tax->name;
                    }
                }
            }
        }
        foreach ($member_taxs as $key => $value) {
            if (!isset($posts_member_taxs[$key]))
                unset($member_taxs[$key]);
        }
    }

    if ($position !== 'global')
        $position = 'sidebar';

    if ($position == 'sidebar') : ?>
        <h4 class="filter-title"><?php echo __('<strong>Filter</strong> By', 'porto') ?></h4>
        <ul class="member-filter nav nav-list m-b-lg" data-position="<?php echo esc_attr($position) ?>">
            <li class="active" data-filter="*"><a href="#"><?php echo __('Show All', 'porto'); ?></a></li>
            <?php foreach ($member_taxs as $tax_slug => $tax_name) : ?>
                <li data-filter="<?php echo esc_attr($tax_slug) ?>"><a href="#"><?php echo esc_html($tax_name) ?></a></li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <ul class="member-filter nav sort-source" data-position="<?php echo esc_attr($position) ?>">
            <li class="active" data-filter="*"><a href="#"><?php echo __('Show All', 'porto'); ?></a></li>
            <?php foreach ($member_taxs as $tax_slug => $tax_name) : ?>
                <li data-filter="<?php echo esc_attr($tax_slug) ?>"><a href="#"><?php echo esc_html($tax_name) ?></a></li>
            <?php endforeach; ?>
        </ul>
    <?php endif;
}

function porto_show_faq_archive_filter( $position = 'global' ) {
    global $porto_settings;

    $faq_infinite = $porto_settings['faq-infinite'];

    $faq_taxs = array();

    $taxs = get_categories(array(
        'taxonomy' => 'faq_cat',
        'orderby' => isset($porto_settings['faq-cat-orderby']) ? $porto_settings['faq-cat-orderby'] : 'name',
        'order' => isset($porto_settings['faq-cat-order']) ? $porto_settings['faq-cat-order'] : 'asc'
    ));

    foreach ($taxs as $tax) {
        $faq_taxs[urldecode($tax->slug)] = $tax->name;
    }

    if (!$faq_infinite) {
        global $wp_query;
        $posts_faq_taxs = array();
        if (is_array($wp_query->posts) && !empty($wp_query->posts)) {
            foreach($wp_query->posts as $post) {
                $post_taxs = wp_get_post_terms($post->ID, 'faq_cat', array("fields" => "all"));
                if (is_array($post_taxs) && !empty($post_taxs)) {
                    foreach ($post_taxs as $post_tax) {
                        $posts_faq_taxs[urldecode($post_tax->slug)] = $post_tax->name;
                    }
                }
            }
        }
        foreach ($faq_taxs as $key => $value) {
            if (!isset($posts_faq_taxs[$key]))
                unset($faq_taxs[$key]);
        }
    }

    if ($position !== 'global')
        $position = 'sidebar';

    if ($position == 'sidebar') : ?>
        <h4 class="filter-title"><?php echo __('<strong>Filter</strong> By', 'porto') ?></h4>
        <ul class="faq-filter nav nav-list m-b-lg" data-position="<?php echo esc_attr($position) ?>">
            <li class="active" data-filter="*"><a href="#"><?php echo __('Show All', 'porto'); ?></a></li>
            <?php foreach ($faq_taxs as $tax_slug => $tax_name) : ?>
                <li data-filter="<?php echo esc_attr($tax_slug) ?>"><a href="#"><?php echo esc_html($tax_name) ?></a></li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <ul class="faq-filter nav sort-source" data-position="<?php echo esc_attr($position) ?>">
            <li class="active" data-filter="*"><a href="#"><?php echo __('Show All', 'porto'); ?></a></li>
            <?php foreach ($faq_taxs as $tax_slug => $tax_name) : ?>
                <li data-filter="<?php echo esc_attr($tax_slug) ?>"><a href="#"><?php echo esc_html($tax_name) ?></a></li>
            <?php endforeach; ?>
        </ul>
    <?php endif;
}

function porto_show_faq_tax_filter( $position = 'global' ) {
    global $porto_settings, $wp_query;

    $term = $wp_query->queried_object;
    $term_id = $term->term_id;

    $faq_infinite = $porto_settings['faq-infinite'];

    $faq_taxs = array();

    $taxs = get_categories(array(
        'taxonomy' => 'faq_cat',
        'child_of' => $term_id,
        'orderby' => isset($porto_settings['faq-cat-orderby']) ? $porto_settings['faq-cat-orderby'] : 'name',
        'order' => isset($porto_settings['faq-cat-order']) ? $porto_settings['faq-cat-order'] : 'asc'
    ));

    foreach ($taxs as $tax) {
        $faq_taxs[urldecode($tax->slug)] = $tax->name;
    }

    if (!$faq_infinite) {
        global $wp_query;
        $posts_faq_taxs = array();
        if (is_array($wp_query->posts) && !empty($wp_query->posts)) {
            foreach($wp_query->posts as $post) {
                $post_taxs = wp_get_post_terms($post->ID, 'faq_cat', array("fields" => "all"));
                if (is_array($post_taxs) && !empty($post_taxs)) {
                    foreach ($post_taxs as $post_tax) {
                        $posts_faq_taxs[urldecode($post_tax->slug)] = $post_tax->name;
                    }
                }
            }
        }
        foreach ($faq_taxs as $key => $value) {
            if (!isset($posts_faq_taxs[$key]))
                unset($faq_taxs[$key]);
        }
    }

    if ($position !== 'global')
        $position = 'sidebar';

    // Show Filters
    if (is_array($faq_taxs) && !empty($faq_taxs)) :
        if ($position == 'sidebar') : ?>
            <h4 class="filter-title"><?php echo __('<strong>Filter</strong> By', 'porto') ?></h4>
            <ul class="faq-filter nav nav-list m-b-lg" data-position="<?php echo esc_attr($position) ?>">
                <li class="active" data-filter="*"><a href="#"><?php echo __('Show All', 'porto'); ?></a></li>
                <?php foreach ($faq_taxs as $tax_slug => $tax_name) : ?>
                    <li data-filter="<?php echo esc_attr($tax_slug) ?>"><a href="#"><?php echo esc_html($tax_name) ?></a></li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <ul class="faq-filter nav sort-source" data-position="<?php echo esc_attr($position) ?>">
                <li class="active" data-filter="*"><a href="#"><?php echo __('Show All', 'porto'); ?></a></li>
                <?php foreach ($faq_taxs as $tax_slug => $tax_name) : ?>
                    <li data-filter="<?php echo esc_attr($tax_slug) ?>"><a href="#"><?php echo esc_html($tax_name) ?></a></li>
                <?php endforeach; ?>
            </ul>
        <?php endif;
    endif;
}

function porto_output_skin_options() {

    global $porto_settings;

    $custom_css = porto_get_meta_value('custom_css');

    $body_bg_color = porto_get_meta_value('body_bg_color');
    $body_bg_image = porto_get_meta_value('body_bg_image');
    $body_bg_repeat = porto_get_meta_value('body_bg_repeat');
    $body_bg_size = porto_get_meta_value('body_bg_size');
    $body_bg_attachment = porto_get_meta_value('body_bg_attachment');
    $body_bg_position = porto_get_meta_value('body_bg_position');

    $page_bg_color = porto_get_meta_value('page_bg_color');
    $page_bg_image = porto_get_meta_value('page_bg_image');
    $page_bg_repeat = porto_get_meta_value('page_bg_repeat');
    $page_bg_size = porto_get_meta_value('page_bg_size');
    $page_bg_attachment = porto_get_meta_value('page_bg_attachment');
    $page_bg_position = porto_get_meta_value('page_bg_position');

    $content_bottom_bg_color = porto_get_meta_value('content_bottom_bg_color');
    $content_bottom_bg_image = porto_get_meta_value('content_bottom_bg_image');
    $content_bottom_bg_repeat = porto_get_meta_value('content_bottom_bg_repeat');
    $content_bottom_bg_size = porto_get_meta_value('content_bottom_bg_size');
    $content_bottom_bg_attachment = porto_get_meta_value('content_bottom_bg_attachment');
    $content_bottom_bg_position = porto_get_meta_value('content_bottom_bg_position');

    $header_bg_color = porto_get_meta_value('header_bg_color');
    $header_bg_image = porto_get_meta_value('header_bg_image');
    $header_bg_repeat = porto_get_meta_value('header_bg_repeat');
    $header_bg_size = porto_get_meta_value('header_bg_size');
    $header_bg_attachment = porto_get_meta_value('header_bg_attachment');
    $header_bg_position = porto_get_meta_value('header_bg_position');

    $sticky_header_bg_color = porto_get_meta_value('sticky_header_bg_color');
    $sticky_header_bg_image = porto_get_meta_value('sticky_header_bg_image');
    $sticky_header_bg_repeat = porto_get_meta_value('sticky_header_bg_repeat');
    $sticky_header_bg_size = porto_get_meta_value('sticky_header_bg_size');
    $sticky_header_bg_attachment = porto_get_meta_value('sticky_header_bg_attachment');
    $sticky_header_bg_position = porto_get_meta_value('sticky_header_bg_position');

    $footer_top_bg_color = porto_get_meta_value('footer_top_bg_color');
    $footer_top_bg_image = porto_get_meta_value('footer_top_bg_image');
    $footer_top_bg_repeat = porto_get_meta_value('footer_top_bg_repeat');
    $footer_top_bg_size = porto_get_meta_value('footer_top_bg_size');
    $footer_top_bg_attachment = porto_get_meta_value('footer_top_bg_attachment');
    $footer_top_bg_position = porto_get_meta_value('footer_top_bg_position');

    $footer_bg_color = porto_get_meta_value('footer_bg_color');
    $footer_bg_image = porto_get_meta_value('footer_bg_image');
    $footer_bg_repeat = porto_get_meta_value('footer_bg_repeat');
    $footer_bg_size = porto_get_meta_value('footer_bg_size');
    $footer_bg_attachment = porto_get_meta_value('footer_bg_attachment');
    $footer_bg_position = porto_get_meta_value('footer_bg_position');

    $footer_main_bg_color = porto_get_meta_value('footer_main_bg_color');
    $footer_main_bg_image = porto_get_meta_value('footer_main_bg_image');
    $footer_main_bg_repeat = porto_get_meta_value('footer_main_bg_repeat');
    $footer_main_bg_size = porto_get_meta_value('footer_main_bg_size');
    $footer_main_bg_attachment = porto_get_meta_value('footer_main_bg_attachment');
    $footer_main_bg_position = porto_get_meta_value('footer_main_bg_position');

    $footer_bottom_bg_color = porto_get_meta_value('footer_bottom_bg_color');
    $footer_bottom_bg_image = porto_get_meta_value('footer_bottom_bg_image');
    $footer_bottom_bg_repeat = porto_get_meta_value('footer_bottom_bg_repeat');
    $footer_bottom_bg_size = porto_get_meta_value('footer_bottom_bg_size');
    $footer_bottom_bg_attachment = porto_get_meta_value('footer_bottom_bg_attachment');
    $footer_bottom_bg_position = porto_get_meta_value('footer_bottom_bg_position');

    $breadcrumbs_bg_color = porto_get_meta_value('breadcrumbs_bg_color');
    $breadcrumbs_bg_image = porto_get_meta_value('breadcrumbs_bg_image');
    $breadcrumbs_bg_repeat = porto_get_meta_value('breadcrumbs_bg_repeat');
    $breadcrumbs_bg_size = porto_get_meta_value('breadcrumbs_bg_size');
    $breadcrumbs_bg_attachment = porto_get_meta_value('breadcrumbs_bg_attachment');
    $breadcrumbs_bg_position = porto_get_meta_value('breadcrumbs_bg_position');

    if (! empty( $custom_css )
        || $body_bg_color || $body_bg_image || $body_bg_repeat || $body_bg_size || $body_bg_attachment || $body_bg_position
        || $page_bg_color || $page_bg_image || $page_bg_repeat || $page_bg_size || $page_bg_attachment || $page_bg_position
        || $content_bottom_bg_color || $content_bottom_bg_image || $content_bottom_bg_repeat || $content_bottom_bg_size || $content_bottom_bg_attachment || $content_bottom_bg_position
        || $header_bg_color || $header_bg_image || $header_bg_repeat || $header_bg_size || $header_bg_attachment || $header_bg_position
        || $sticky_header_bg_color || $sticky_header_bg_image || $sticky_header_bg_repeat || $sticky_header_bg_size || $sticky_header_bg_attachment || $sticky_header_bg_position
        || $footer_top_bg_color || $footer_top_bg_image || $footer_top_bg_repeat || $footer_top_bg_size || $footer_top_bg_attachment || $footer_top_bg_position
        || $footer_bg_color || $footer_bg_image || $footer_bg_repeat || $footer_bg_size || $footer_bg_attachment || $footer_bg_position
        || $footer_main_bg_color || $footer_main_bg_image || $footer_main_bg_repeat || $footer_main_bg_size || $footer_main_bg_attachment || $footer_main_bg_position
        || $footer_bottom_bg_color || $footer_bottom_bg_image || $footer_bottom_bg_repeat || $footer_bottom_bg_size || $footer_bottom_bg_attachment || $footer_bottom_bg_position
        || $breadcrumbs_bg_color || $breadcrumbs_bg_image || $breadcrumbs_bg_repeat || $breadcrumbs_bg_size || $breadcrumbs_bg_attachment || $breadcrumbs_bg_position) :
        ?><style type="text/css"><?php
        if ($body_bg_color || $body_bg_image || $body_bg_repeat || $body_bg_size || $body_bg_attachment || $body_bg_position) :
        ?>body {<?php
            if ($body_bg_color) : ?>background-color: <?php echo $body_bg_color ?> !important;<?php endif;
            if ($body_bg_image == 'none') : echo 'background-image: none !important'; else : if ($body_bg_image) : ?>background-image: url('<?php echo esc_url(str_replace(array('http://', 'https://'), array('//', '//'), $body_bg_image)) ?>') !important;<?php endif; endif;
            if ($body_bg_repeat) : ?>background-repeat: <?php echo $body_bg_repeat ?> !important;<?php endif;
            if ($body_bg_size) : ?>background-size: <?php echo $body_bg_size ?> !important;<?php endif;
            if ($body_bg_attachment) : ?>background-attachment: <?php echo $body_bg_attachment ?> !important;<?php endif;
            if ($body_bg_position) : ?>background-position: <?php echo $body_bg_position ?> !important;<?php endif;
        ?>}<?php
        endif;
        if ($page_bg_color || $page_bg_image || $page_bg_repeat || $page_bg_size || $page_bg_attachment || $page_bg_position) :
        ?>#main {<?php
            if ($page_bg_color) : ?>background-color: <?php echo $page_bg_color ?> !important;<?php endif;
            if ($page_bg_image == 'none') : echo 'background-image: none !important'; else : if ($page_bg_image) : ?>background-image: url('<?php echo esc_url(str_replace(array('http://', 'https://'), array('//', '//'), $page_bg_image)) ?>') !important;<?php endif; endif;
            if ($page_bg_repeat) : ?>background-repeat: <?php echo $page_bg_repeat ?> !important;<?php endif;
            if ($page_bg_size) : ?>background-size: <?php echo $page_bg_size ?> !important;<?php endif;
            if ($page_bg_attachment) : ?>background-attachment: <?php echo $page_bg_attachment ?> !important;<?php endif;
            if ($page_bg_position) : ?>background-position: <?php echo $page_bg_position ?> !important;<?php endif;
        ?>}<?php
            if ($page_bg_color == 'transparent') :
            ?>.page-content { margin-left: -<?php echo $porto_settings['grid-gutter-width'] / 2 ?>px; margin-right: -<?php echo $porto_settings['grid-gutter-width'] / 2 ?>px;} .main-content { padding-bottom: 0 !important; } .left-sidebar, .right-sidebar, .wide-left-sidebar, .wide-right-sidebar { padding-top: 0 !important; padding-bottom: 0 !important; margin: 0; }<?php
            endif;
        endif;
        if ($content_bottom_bg_color || $content_bottom_bg_image || $content_bottom_bg_repeat || $content_bottom_bg_size || $content_bottom_bg_attachment || $content_bottom_bg_position) :
        ?>#main .content-bottom-wrapper {<?php
            if ($content_bottom_bg_color) : ?>background-color: <?php echo $content_bottom_bg_color ?> !important;<?php endif;
            if ($content_bottom_bg_image == 'none') : echo 'background-image: none !important'; else : if ($content_bottom_bg_image) : ?>background-image: url('<?php echo esc_url(str_replace(array('http://', 'https://'), array('//', '//'), $content_bottom_bg_image)) ?>') !important;<?php endif; endif;
            if ($content_bottom_bg_repeat) : ?>background-repeat: <?php echo $content_bottom_bg_repeat ?> !important;<?php endif;
            if ($content_bottom_bg_size) : ?>background-size: <?php echo $content_bottom_bg_size ?> !important;<?php endif;
            if ($content_bottom_bg_attachment) : ?>background-attachment: <?php echo $content_bottom_bg_attachment ?> !important;<?php endif;
            if ($content_bottom_bg_position) : ?>background-position: <?php echo $content_bottom_bg_position ?> !important;<?php endif;
        ?>}<?php
        endif;
        if ($header_bg_color || $header_bg_image || $header_bg_repeat || $header_bg_size || $header_bg_attachment || $header_bg_position) :
        ?>#header, .fixed-header #header {<?php
            if ($header_bg_color) : ?>background-color: <?php echo $header_bg_color ?> !important;<?php endif;
            if ($header_bg_image == 'none') : echo 'background-image: none !important'; else : if ($header_bg_image) : ?>background-image: url('<?php echo esc_url(str_replace(array('http://', 'https://'), array('//', '//'), $header_bg_image)) ?>') !important;<?php endif; endif;
            if ($header_bg_repeat) : ?>background-repeat: <?php echo $header_bg_repeat ?> !important;<?php endif;
            if ($header_bg_size) : ?>background-size: <?php echo $header_bg_size ?> !important;<?php endif;
            if ($header_bg_attachment) : ?>background-attachment: <?php echo $header_bg_attachment ?> !important;<?php endif;
            if ($header_bg_position) : ?>background-position: <?php echo $header_bg_position ?> !important;<?php endif;
        ?>}<?php
        endif;
        if ($sticky_header_bg_color || $sticky_header_bg_image || $sticky_header_bg_repeat || $sticky_header_bg_size || $sticky_header_bg_attachment || $sticky_header_bg_position) :
        ?>#header.sticky-header, .fixed-header #header.sticky-header {<?php
            if ($sticky_header_bg_color) : ?>background-color: <?php echo $sticky_header_bg_color ?> !important;<?php endif;
            if ($sticky_header_bg_image == 'none') : echo 'background-image: none !important'; else : if ($sticky_header_bg_image) : ?>background-image: url('<?php echo esc_url(str_replace(array('http://', 'https://'), array('//', '//'), $sticky_header_bg_image)) ?>') !important;<?php endif; endif;
            if ($sticky_header_bg_repeat) : ?>background-repeat: <?php echo $sticky_header_bg_repeat ?> !important;<?php endif;
            if ($sticky_header_bg_size) : ?>background-size: <?php echo $sticky_header_bg_size ?> !important;<?php endif;
            if ($sticky_header_bg_attachment) : ?>background-attachment: <?php echo $sticky_header_bg_attachment ?> !important;<?php endif;
            if ($sticky_header_bg_position) : ?>background-position: <?php echo $sticky_header_bg_position ?> !important;<?php endif;
        ?>}<?php
        endif;
        if ($footer_top_bg_color || $footer_top_bg_image || $footer_top_bg_repeat || $footer_top_bg_size || $footer_top_bg_attachment || $footer_top_bg_position) :
        ?>.footer-top {<?php
            if ($footer_top_bg_color) : ?>background-color: <?php echo $footer_top_bg_color ?> !important;<?php endif;
            if ($footer_top_bg_image == 'none') : echo 'background-image: none !important'; else : if ($footer_top_bg_image) : ?>background-image: url('<?php echo esc_url(str_replace(array('http://', 'https://'), array('//', '//'), $footer_top_bg_image)) ?>') !important;<?php endif; endif;
            if ($footer_top_bg_repeat) : ?>background-repeat: <?php echo $footer_top_bg_repeat ?> !important;<?php endif;
            if ($footer_top_bg_size) : ?>background-size: <?php echo $footer_top_bg_size ?> !important;<?php endif;
            if ($footer_top_bg_attachment) : ?>background-attachment: <?php echo $footer_top_bg_attachment ?> !important;<?php endif;
            if ($footer_top_bg_position) : ?>background-position: <?php echo $footer_top_bg_position ?> !important;<?php endif;
        ?>}<?php
        endif;
        if ($footer_bg_color || $footer_bg_image || $footer_bg_repeat || $footer_bg_size || $footer_bg_attachment || $footer_bg_position) :
        ?>#footer {<?php
            if ($footer_bg_color) : ?>background-color: <?php echo $footer_bg_color ?> !important;<?php endif;
            if ($footer_bg_image == 'none') : echo 'background-image: none !important'; else : if ($footer_bg_image) : ?>background-image: url('<?php echo esc_url(str_replace(array('http://', 'https://'), array('//', '//'), $footer_bg_image)) ?>') !important;<?php endif; endif;
            if ($footer_bg_repeat) : ?>background-repeat: <?php echo $footer_bg_repeat ?> !important;<?php endif;
            if ($footer_bg_size) : ?>background-size: <?php echo $footer_bg_size ?> !important;<?php endif;
            if ($footer_bg_attachment) : ?>background-attachment: <?php echo $footer_bg_attachment ?> !important;<?php endif;
            if ($footer_bg_position) : ?>background-position: <?php echo $footer_bg_position ?> !important;<?php endif;
        ?>}<?php
        endif;
        if ($footer_main_bg_color || $footer_main_bg_image || $footer_main_bg_repeat || $footer_main_bg_size || $footer_main_bg_attachment || $footer_main_bg_position) :
        ?>#footer .footer-main {<?php
            if ($footer_main_bg_color) : ?>background-color: <?php echo $footer_main_bg_color ?> !important;<?php endif;
            if ($footer_main_bg_image == 'none') : echo 'background-image: none !important'; else : if ($footer_main_bg_image) : ?>background-image: url('<?php echo esc_url(str_replace(array('http://', 'https://'), array('//', '//'), $footer_main_bg_image)) ?>') !important;<?php endif; endif;
            if ($footer_main_bg_repeat) : ?>background-repeat: <?php echo $footer_main_bg_repeat ?> !important;<?php endif;
            if ($footer_main_bg_size) : ?>background-size: <?php echo $footer_main_bg_size ?> !important;<?php endif;
            if ($footer_main_bg_attachment) : ?>background-attachment: <?php echo $footer_main_bg_attachment ?> !important;<?php endif;
            if ($footer_main_bg_position) : ?>background-position: <?php echo $footer_main_bg_position ?> !important;<?php endif;
        ?>}<?php
        endif;
        if ($footer_bottom_bg_color || $footer_bottom_bg_image || $footer_bottom_bg_repeat || $footer_bottom_bg_size || $footer_bottom_bg_attachment || $footer_bottom_bg_position) :
        ?>#footer .footer-bottom, .footer-wrapper.fixed #footer .footer-bottom {<?php
            if ($footer_bottom_bg_color) : ?>background-color: <?php echo $footer_bottom_bg_color ?> !important;<?php endif;
            if ($footer_bottom_bg_image == 'none') : echo 'background-image: none !important'; else : if ($footer_bottom_bg_image) : ?>background-image: url('<?php echo esc_url(str_replace(array('http://', 'https://'), array('//', '//'), $footer_bottom_bg_image)) ?>') !important;<?php endif; endif;
            if ($footer_bottom_bg_repeat) : ?>background-repeat: <?php echo $footer_bottom_bg_repeat ?> !important;<?php endif;
            if ($footer_bottom_bg_size) : ?>background-size: <?php echo $footer_bottom_bg_size ?> !important;<?php endif;
            if ($footer_bottom_bg_attachment) : ?>background-attachment: <?php echo $footer_bottom_bg_attachment ?> !important;<?php endif;
            if ($footer_bottom_bg_position) : ?>background-position: <?php echo $footer_bottom_bg_position ?> !important;<?php endif;
        ?>}<?php
        endif;
        if ($breadcrumbs_bg_color || $breadcrumbs_bg_image || $breadcrumbs_bg_repeat || $breadcrumbs_bg_size || $breadcrumbs_bg_attachment || $breadcrumbs_bg_position) :
        ?>.page-top {<?php
            if ($breadcrumbs_bg_color) : ?>background-color: <?php echo $breadcrumbs_bg_color ?> !important;<?php endif;
            if ($breadcrumbs_bg_image == 'none') : echo 'background-image: none !important'; else : if ($breadcrumbs_bg_image) : ?>background-image: url('<?php echo esc_url(str_replace(array('http://', 'https://'), array('//', '//'), $breadcrumbs_bg_image)) ?>') !important;<?php endif; endif;
            if ($breadcrumbs_bg_repeat) : ?>background-repeat: <?php echo $breadcrumbs_bg_repeat ?> !important;<?php endif;
            if ($breadcrumbs_bg_size) : ?>background-size: <?php echo $breadcrumbs_bg_size ?> !important;<?php endif;
            if ($breadcrumbs_bg_attachment) : ?>background-attachment: <?php echo $breadcrumbs_bg_attachment ?> !important;<?php endif;
            if ($breadcrumbs_bg_position) : ?>background-position: <?php echo $breadcrumbs_bg_position ?> !important;<?php endif;
        ?>}<?php endif;
        if (! empty( $custom_css )) :
            echo trim( preg_replace( '#<style[^>]*>(.*)</style>#is', '$1', $custom_css ) );
        endif;
        ?></style><?php
    endif;

    $custom_js_head = porto_get_meta_value('custom_js_head');
    if (! empty( $custom_js_head )) { ?>
        <script type="text/javascript">
            <?php echo trim( preg_replace( '#<script[^>]*>(.*)</script>#is', '$1', $custom_js_head ) ); ?>
        </script>
    <?php }
}

function porto_output_custom_js_body() {
    $custom_js_body = porto_get_meta_value('custom_js_body');
    if (! empty( $custom_js_body )) { ?>
        <script type="text/javascript">
            <?php echo trim( preg_replace( '#<script[^>]*>(.*)</script>#is', '$1', $custom_js_body ) ); ?>
        </script>
    <?php }
}