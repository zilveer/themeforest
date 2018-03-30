<?php
// WP custom header
$header_image = $header_image2 = $header_color = '';
if ($top_panel_style=='dark') {
    if (($header_image = get_header_image()) == '') {
        $header_image = ancora_get_custom_option('top_panel_bg_image');
    }
    $header_color = ancora_get_link_color(ancora_get_custom_option('top_panel_bg_color'));
}

$header_style = $top_panel_opacity!='transparent' && ($header_image!='' || $header_image2!='' || $header_color!='')
    ? ' style="background: '
    . ($header_image!='' ? 'url('.esc_url($header_image).') repeat center bottom' : '')
    . ($header_image!=''  ? ($header_image!='' ? ',' : '') . 'url('.esc_url($header_image).') repeat center top' : '')
    .'"'
    : '';
?>

<div class="top_panel_fixed_wrap"></div>

<header class="top_panel_wrap bg_tint_<?php echo esc_attr($top_panel_style); ?>" <?php echo ($header_style); ?>>


    <?php if (ancora_get_custom_option('show_menu_user')=='yes') { ?>

        <div class="menu_user_wrap">
            <div class="content_wrap clearfix">
                <div class="menu_user_area menu_user_right menu_user_nav_area">
                    <?php require_once( ancora_get_file_dir('templates/parts/user-panel.php') ); ?>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="border_bottom_grey font_086em display_none">
        <div class="content_wrap clearfix top_div">
            <div class="inline bottom">
                <?php _e(ancora_get_custom_option('disclaimer')); ?>
            </div>
            <div class="inline bottom side-right">
                <?php
                if (ancora_get_custom_option('show_contact_info')=='yes') { ?>
                    <div class="menu_user_area menu_user_left menu_user_contact_area"><?php _e(force_balance_tags(trim(ancora_get_custom_option('contact_info')))); ?></div>
                <?php } ?>
            </div>
            <div class="inline side-right search_s">
                <?php if (ancora_get_custom_option('show_search')=='yes') _e(do_shortcode('[trx_search open="no" title=""]')); ?>
            </div>
        </div>
    </div>

    <div class="menu_main_wrap logo_<?php _e(esc_attr(ancora_get_custom_option('logo_align'))); ?><?php _e(($ANCORA_GLOBALS['logo_text'] ? ' with_text' : '')); ?>">
        <div class="content_wrap clearfix display_none">

            <div class="logo">
                <div class="logo_img">
                    <a href="<?php _e(esc_url(home_url())); ?>">
                        <?php _e(!empty($ANCORA_GLOBALS['logo_'.($logo_style)]) ? '<img src="'.esc_url($ANCORA_GLOBALS['logo_'.($logo_style)]).'" class="logo_main" alt=""><img src="'.esc_url($ANCORA_GLOBALS['logo_fixed']).'" class="logo_fixed" alt="">' : ''); ?>
                    </a>
                </div>
                <div class="contein_logo_text">
                    <a href="<?php _e(esc_url(home_url())); ?>">
                        <?php _e($ANCORA_GLOBALS['logo_text'] ? '<span class="logo_text">'.($ANCORA_GLOBALS['logo_text']).'</span>' : ''); ?>
                        <?php _e($ANCORA_GLOBALS['logo_slogan'] ? '<span class="logo_slogan">' . esc_html($ANCORA_GLOBALS['logo_slogan']) . '</span>' : ''); ?>
                    </a>
                </div>
            </div>

                <a href="#" class="menu_main_responsive_button icon-menu-1"></a>
                <div class="inline image side-right marg_top_2em">
                    <?php
                        if(ancora_get_custom_option('show_number_block') == 'yes') {
                            ?>
                            <div class="inline">
                                <img src="<?php
                                    $img1 = ancora_get_custom_option('number_image');
                                    if(empty($img1))  $img1 = ancora_get_file_url('skins/' . ($theme_skin) . '/images/phone.jpg');
                                    _e($img1);
                                ?>" alt="">
                                <div class="side-right marg_null marg_top">
                                    <h4><?php _e(force_balance_tags(trim(ancora_get_custom_option('contact_phone')))); ?></h4>
                                    <span class="font_086em"><?php _e(ancora_get_custom_option('text_under_number_title')); ?></span>
                                </div>
                            </div>

                        <?php
                        }
                        if(ancora_get_custom_option('show_flower_block') == 'yes') {
                            ?>
                            <div class="inline pad_left_2em">
                                <img src="<?php
                                $img1 = ancora_get_custom_option('flower_image');
                                if(empty($img1))  $img1 = ancora_get_file_url('skins/' . ($theme_skin) . '/images/flower.jpg');
                                _e($img1);
                                ?>" alt="">
                                <div class="side-right marg_null marg_top">
                                    <h4><?php _e(ancora_get_custom_option('flower_title')); ?></h4>
                                    <span class="font_086em"><?php _e(ancora_get_custom_option('text_under_flower_title')); ?></span>
                                </div>
                            </div>
                        <?php
                        }
                    ?>
                </div>
            </div>

            <nav role="navigation" class="menu_main_nav_area">
                <?php
                if (empty($ANCORA_GLOBALS['menu_main'])) $ANCORA_GLOBALS['menu_main'] = ancora_get_nav_menu('menu_main');
                if (empty($ANCORA_GLOBALS['menu_main'])) $ANCORA_GLOBALS['menu_main'] = ancora_get_nav_menu();
                echo ($ANCORA_GLOBALS['menu_main']);
                ?>
            </nav>
        </div>

</header>
