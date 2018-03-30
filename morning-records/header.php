<?php
/**
 * The Header for our theme.
 */

// Theme init - don't remove next row! Load custom options
morning_records_core_init_theme();
morning_records_profiler_add_point(esc_html__('Before Theme HTML output', 'morning-records'));
$theme_init = morning_records_custom_options();

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="<?php echo 'scheme_' . esc_attr($theme_init['body_scheme']); ?>">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1<?php if (morning_records_get_theme_option('responsive_layouts')=='yes') echo ', maximum-scale=1'; ?>">
    <meta name="format-detection" content="telephone=no">

    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <?php
    morning_records_page_preloader();

    wp_head();

    ?>
</head>

<body <?php body_class();?>>

<?php
morning_records_profiler_add_point(esc_html__('BODY start', 'morning-records'));

echo force_balance_tags(morning_records_get_custom_option('gtm_code'));

// Page preloader
if (($preloader=morning_records_get_theme_option('page_preloader'))!='') {
    ?><div id="page_preloader"></div><?php
}

do_action( 'before' );

// Add TOC items 'Home' and "To top"
morning_records_home_and_toc();
?>

<?php if ( !morning_records_param_is_off(morning_records_get_custom_option('show_sidebar_outer')) ) { ?>
<div class="outer_wrap">
    <?php } ?>

    <?php get_template_part(morning_records_get_file_slug('sidebar_outer.php')); ?>

    <?php
    $class = $style = '';
    if (morning_records_get_custom_option('bg_custom')=='yes' && ($theme_init['body_style']=='boxed' || morning_records_get_custom_option('bg_image_load')=='always')) {
        if (($img = morning_records_get_custom_option('bg_image_custom')) != '')
            $style = 'background: url('.esc_url($img).') ' . str_replace('_', ' ', morning_records_get_custom_option('bg_image_custom_position')) . ' no-repeat fixed;';
        else if (($img = morning_records_get_custom_option('bg_pattern_custom')) != '')
            $style = 'background: url('.esc_url($img).') 0 0 repeat fixed;';
        else if (($img = morning_records_get_custom_option('bg_image')) > 0)
            $class = 'bg_image_'.($img);
        else if (($img = morning_records_get_custom_option('bg_pattern')) > 0)
            $class = 'bg_pattern_'.($img);
        if (($img = morning_records_get_custom_option('bg_color')) != '')
            $style .= 'background-color: '.($img).';';
    }
    ?>

    <div class="body_wrap<?php echo !empty($class) ? ' '.esc_attr($class) : ''; ?>"<?php echo !empty($style) ? ' style="'.esc_attr($style).'"' : ''; ?>>

        <?php
        if ($theme_init['video_bg_show']) {
            $youtube = morning_records_get_custom_option('video_bg_youtube_code');
            $video   = morning_records_get_custom_option('video_bg_url');
            $overlay = morning_records_get_custom_option('video_bg_overlay')=='yes';
            if (!empty($youtube)) {
                ?>
                <div class="video_bg<?php echo !empty($overlay) ? ' video_bg_overlay' : ''; ?>" data-youtube-code="<?php echo esc_attr($youtube); ?>"></div>
                <?php
            } else if (!empty($video)) {
                $info = pathinfo($video);
                $ext = !empty($info['extension']) ? $info['extension'] : 'src';
                ?>
                <div class="video_bg<?php echo !empty($overlay) ? ' video_bg_overlay' : ''; ?>"><video class="video_bg_tag" width="1280" height="720" data-width="1280" data-height="720" data-ratio="16:9" preload="metadata" autoplay loop src="<?php echo esc_url($video); ?>"><source src="<?php echo esc_url($video); ?>" type="video/<?php echo esc_attr($ext); ?>"></source></video></div>
                <?php
            }
        }
        ?>

        <div class="page_wrap">

            <?php $top_panel_style = 'header_8'; ?>

            <?php
            morning_records_profiler_add_point(esc_html__('Before Page Header', 'morning-records'));
            // Top panel 'Above' or 'Over'
            if (in_array($theme_init['top_panel_position'], array('above', 'over'))) {
                morning_records_show_post_layout(array(
                    'layout' => $top_panel_style,
                    'position' => $theme_init['top_panel_position'],
                    'scheme' => $theme_init['top_panel_scheme']
                ), false);
                // Mobile Menu
                get_template_part(morning_records_get_file_slug('templates/headers/_parts/header-mobile.php'));

                morning_records_profiler_add_point(esc_html__('After show menu', 'morning-records'));
            }

            // Slider
            get_template_part(morning_records_get_file_slug('templates/headers/_parts/slider.php'));

            // Top panel 'Below'
            if ($theme_init['top_panel_position'] == 'below') {
                morning_records_show_post_layout(array(
                    'layout' => $top_panel_style,
                    'position' => $theme_init['top_panel_position'],
                    'scheme' => $theme_init['top_panel_scheme']
                ), false);
                // Mobile Menu
                get_template_part(morning_records_get_file_slug('templates/headers/_parts/header-mobile.php'));

                morning_records_profiler_add_point(esc_html__('After show menu', 'morning-records'));
            }

            // Top of page section: page title and breadcrumbs
            $show_title = morning_records_get_custom_option('show_page_title')=='yes';
            $show_navi = $show_title && is_single() && morning_records_is_woocommerce_page();
            $show_breadcrumbs = morning_records_get_custom_option('show_breadcrumbs')=='yes';
            if ($show_title || $show_breadcrumbs) {
                ?>
                <div class="top_panel_title top_panel_style_<?php echo esc_attr(str_replace('header_', '', $top_panel_style)); ?> <?php echo (!empty($show_title) ? ' title_present'.  ($show_navi ? ' navi_present' : '') : '') . (!empty($show_breadcrumbs) ? ' breadcrumbs_present' : ''); ?> scheme_<?php echo esc_attr($theme_init['top_panel_scheme']); ?>">
                    <div class="top_panel_title_inner top_panel_inner_style_<?php echo esc_attr(str_replace('header_', '', $top_panel_style)); ?> <?php echo (!empty($show_title) ? ' title_present_inner' : '') . (!empty($show_breadcrumbs) ? ' breadcrumbs_present_inner' : ''); ?>">
                        <div class="content_wrap">
                            <?php
                            if ($show_title) {
                                if ($show_navi) {
                                    ?><div class="post_navi"><?php
                                    previous_post_link( '<span class="post_navi_item post_navi_prev">%link</span>', '%title', true, '', 'product_cat' );
                                    next_post_link( '<span class="post_navi_item post_navi_next">%link</span>', '%title', true, '', 'product_cat' );
                                    ?></div><?php
                                } else {
                                    ?><h1 class="page_title"><?php echo strip_tags(morning_records_get_blog_title()); ?></h1><?php
                                }
                            }
                            if ($show_breadcrumbs) {
                                ?><div class="breadcrumbs"><?php if (!is_404()) morning_records_show_breadcrumbs(); ?></div><?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>

            <div class="page_content_wrap page_paddings_<?php echo esc_attr(morning_records_get_custom_option('body_paddings')); ?>">

<?php
morning_records_profiler_add_point(esc_html__('Before Page content', 'morning-records'));
// Content and sidebar wrapper
if ($theme_init['body_style']!='fullscreen') morning_records_open_wrapper('<div class="content_wrap">');


// Content for WooCommerce page
if (function_exists('is_shop') && is_shop() && (morning_records_get_custom_option('show_content_shop')=='yes') ) {
    morning_records_woocommerce_get_content();
}

// Main content wrapper
morning_records_open_wrapper('<div class="content">');

?>