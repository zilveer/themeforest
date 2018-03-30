<?php
/**
 * Helper functions for theme
 */


/**
 * alternative portfolio single featured image
 */
if (class_exists('kdMultipleFeaturedImages')) {

    $args = array(
        'id' => 'featured-image-portfolio-single',
        'post_type' => 'portfolio', // Set this to post or page
        'labels' => array(
            'name' => __('Portfolio full image', 'ct_theme'),
            'set' => __('Set portfolio full image', 'ct_theme'),
            'remove' => __('Remove portfolio full image', 'ct_theme'),
            'use' => __('Use as portfolio full image', 'ct_theme'),
        )
    );

    new kdMultipleFeaturedImages($args);
}


if (!function_exists('ct_get_portfolio_featured_image_single')) {
    /**
     * Returns product image
     *
     * @param $id
     * @param string $name
     * @param string $size
     *
     * @return stringt
     */

    function ct_get_portfolio_featured_image_single($id, $name = 'featured-image-portfolio-single', $size = 'full')
    {
        $image = '';
        if (class_exists('kdMultipleFeaturedImages')) {
            $image = kd_mfi_get_featured_image_url($name, 'portfolio', $size, $id);
        }

        if ($image == '') {
            $img = wp_get_attachment_image_src(get_post_thumbnail_id($id), $size);
            $image = $img[0];
        }

        return $image;
    }
}


if (!function_exists('has_portfolio_second_featured_image')) {
    /**
     * Returns product image
     *
     * @param $id
     * @param string $name
     * @param string $size
     *
     * @return stringt
     */

    function has_portfolio_second_featured_image($id, $name = 'featured-image-portfolio-single', $size = 'full')
    {
        $image = '';
        if (class_exists('kdMultipleFeaturedImages')) {
            $image = kd_mfi_get_featured_image_url($name, 'portfolio', $size, $id);
        } else {
            return false;
        }

        if ($image == '') {
            return false;
        }

        return true;
    }
}


if (!function_exists('ct_get_footer_settings')) {
    /**
     * Setup dynamic footer. This function is automatically called by plugin
     * @see plugin/footer-columns
     * @param $default
     * @return array
     */
    function ct_get_footer_settings($default)
    {
        return array_merge(
            $default,
            array(
                'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
                'after_widget' => '</div></section>',
                'before_title' => '<h3>',
                'after_title' => '</h3>',
                'definitions' => array(
                    '3c' => array(
                        'columns' => array(3, 6, 3)
                    ),
                ),
                'numbers' => array(2 => 2, 3 => 3, '3 ' . __("columns (center wide)", 'ct_theme') => '3c', 4 => 4),
                'default_number' => 4
            ));
    }
}
/**
 * Custom plugins extension
 */
if (!function_exists('ct_css_animate_extension')) {
    function ct_css_animate_extension($shortcodes)
    {
        $shortcodes[] = 'twitter';
        return $shortcodes;
    }

    add_action('ct.css_animate.compatible_shortcodes', 'ct_css_animate_extension');
}

/**
 * Wraps content into [row] if required
 * @param $content
 * @return string
 */
function ct_theme_page_content_filter($content)
{
    if (is_page() && stripos($content, '[row') === false) {
        return do_shortcode('[row space="true"]' . $content . '[/row]');
    }
    return $content;
}

add_filter('the_content', 'ct_theme_page_content_filter');


/**
 * Enqueue styles
 */
if (!function_exists('ct_theme_styles')) {
    function ct_theme_styles()
    {
    }
}

add_action('init', 'ct_theme_styles');

/**
 * Enqueue scripts
 */
if (!function_exists('ct_theme_scripts')) {
    function ct_theme_scripts()
    {
        //custom user style
        if (file_exists(CT_THEME_DIR . '/assets/js/selectnav.min.js')) {
            wp_register_script('ct_selectnav', CT_THEME_DIR_URI . '/assets/js/selectnav.min.js', array('jquery'), null, true);
            wp_enqueue_script('ct_selectnav');

        }
        if (file_exists(CT_THEME_DIR . '/assets/js/modernizr.custom.js')) {
            wp_register_script('ct_modernizr', CT_THEME_DIR_URI . '/assets/js/modernizr.custom.js', array('jquery'), null, true);
            wp_enqueue_script('ct_modernizr');

        }
        if (file_exists(CT_THEME_DIR . '/assets/js/jquery.placeholder.min.js')) {
            wp_register_script('ct_placeholder', CT_THEME_DIR_URI . '/assets/js/jquery.placeholder.min.js', array('jquery'), null, true);
            wp_enqueue_script('ct_placeholder');

        }
        if (file_exists(CT_THEME_DIR . '/assets/js/jquery.fitvids.js')) {
            wp_register_script('ct-fitvids', CT_THEME_ASSETS . '/js/jquery.fitvids.js', array('jquery'));
            wp_enqueue_script('ct-fitvids');
        }
        if (file_exists(CT_THEME_DIR . '/assets/js/jquery.icheck.min.js')) {
            wp_register_script('ct-icheck', CT_THEME_ASSETS . '/js/jquery.icheck.min.js', array('jquery'));
            wp_enqueue_script('ct-icheck');
        }
        if (file_exists(CT_THEME_DIR . '/assets/js/selectize.min.js')) {
            wp_register_script('ct-selectize', CT_THEME_ASSETS . '/js/selectize.min.js', array('jquery'));
            wp_enqueue_script('ct-selectize');
        }
    }
}

add_action('wp_enqueue_scripts', 'ct_theme_scripts');


/**
 * Theme activation
 */

function theme_activation()
{
    $theme_data = wp_get_theme();
    //add crop option
    if (!get_option("medium_crop")) {
        add_option("medium_crop", "1");
    } else {
        update_option("medium_crop", "1");
    }

    //add current version
    add_option('nonus_theme_version', $theme_data->get('Version'));
}

theme_activation();

/**
 * returns video html for video format post
 */
if (!function_exists('ct_post_video')) {
    function ct_post_video($postid, $width = 500, $height = 300)
    {
        $m4v = get_post_meta($postid, 'videoM4V', true);
        $ogv = get_post_meta($postid, 'videoOGV', true);
        $direct = get_post_meta($postid, 'videoDirect', true);
        echo do_shortcode('[video width="' . $width . '" height="' . $height . '" link="' . $direct . '" m4v="' . $m4v . '" ogv="' . $ogv . '"]');
    }
}

/**
 * returns audio html for audio format post
 */
if (!function_exists('ct_post_audio')) {
    function ct_post_audio($postid, $width = 500, $height = 300)
    {
        $mp3 = get_post_meta($postid, 'audioMP3', TRUE);
        $ogg = get_post_meta($postid, 'audioOGA', TRUE);
        $poster = get_post_meta($postid, 'audioPoster', TRUE);
        $height = get_post_meta($postid, 'audioPosterHeight', TRUE);

        // Calc $height for small images; large will return same value
        $height = $height * $width / 580;

        echo do_shortcode('[audio width="' . $width . '" mp3="' . $mp3 . '" ogg="' . $ogg . '" poster="' . $poster . '" posterheight="' . $height . '"]');
    }
}

/**
 * show single post title?
 */
if (!function_exists('ct_get_single_post_title')) {
    function ct_get_single_post_title($postType = 'page')
    {
        $show = get_post_meta(get_post() ? get_the_ID() : null, 'show_title', TRUE);
        if ($show == 'global' || $show == '') {
            if ($postType == 'page' && ct_get_option('pages_single_show_title', 1)) {
                return get_the_title();
            }
            if ($postType == 'post' && ct_get_option('posts_single_page_title', '')) {
                return ct_get_option('posts_single_page_title', '');
            }
            if ($postType == 'portfolio' && ct_get_option('portfolio_single_page_title', '')) {
                return ct_get_option('portfolio_single_page_title', '');
            }
        }
        if ($show == "yes") {
            if ($postType == 'post' && ct_get_option('posts_single_page_title', '')) {
                return ct_get_option('posts_single_page_title', '');
            }
            if ($postType == 'portfolio' && ct_get_option('portfolio_single_page_title', '')) {
                return ct_get_option('portfolio_single_page_title', '');
            }
        }
        return $show == "yes" ? get_the_title() : '';
    }
}

/**
 * single post/page subtitle?
 */
if (!function_exists('ct_get_single_post_subtitle')) {
    function ct_get_single_post_subtitle($postType = 'page')
    {
        $subtitle = get_post_meta(get_post() ? get_the_ID() : null, 'subtitle', TRUE);
        return $subtitle;
    }
}

/**
 * show single post breadcrumbs?
 */
if (!function_exists('ct_show_single_post_breadcrumbs')) {
    function ct_show_single_post_breadcrumbs($postType = 'page')
    {
        $show = get_post_meta(get_post() ? get_the_ID() : null, 'show_breadcrumbs', TRUE);
        if ($show == 'global' || $show == '') {
            if ($postType == 'page') {
                return ct_get_option('pages_single_show_breadcrumbs', 1);
            }
            if ($postType == 'post') {
                return ct_get_option('posts_single_show_breadcrumbs', 1);
            }
            if ($postType == 'portfolio') {
                return ct_get_option('portfolio_single_show_breadcrumbs', 1);
            }
        }
        return $show == "yes";
    }
}

/**
 * show index post title?
 */
if (!function_exists('ct_get_index_post_title')) {
    function ct_get_index_post_title($postType = 'page')
    {
        $show = get_post_meta(get_post() ? get_the_ID() : null, 'show_title', TRUE);
        if (is_search()) {
            return __('Search results', 'ct_theme');
        }
        if ($show == 'global' || $show == '') {
            if ($postType == 'post' && ct_get_option('posts_index_show_p_title', 1)) {
                $id = ct_get_option('posts_index_page');
                $page = get_post($id);
                return $page ? $page->post_title : '';
            }
            if ($postType == 'portfolio' && ct_get_option('portfolio_index_show_p_title', 1)) {
                $id = ct_get_option('portfolio_index_page');
                $page = get_post($id);
                return $page ? $page->post_title : '';
            }
            if ($postType == 'faq' && ct_get_option('faq_index_show_title', 1)) {
                $id = ct_get_option('faq_index_page');
                $page = get_post($id);
                return $page ? $page->post_title : '';
            }
        }
        return $show == "yes" ? get_the_title() : '';
    }
}

/**
 * single post/page subtitle?
 */
if (!function_exists('ct_get_index_post_subtitle')) {
    function ct_get_index_post_subtitle($postType = 'page')
    {
        if (is_search()) {
            return '';
        }
        if ($postType == 'post' && ct_get_option('posts_index_show_p_title', 1)) {
            $id = ct_get_option('posts_index_page');
            $subtitle = $id ? get_post_meta($id, 'subtitle', TRUE) : '';
            return $subtitle;
        }

        $subtitle = get_post_meta(get_post() ? get_the_ID() : null, 'subtitle', TRUE);
        return $subtitle;
    }
}


/**
 * show index post breadcrumbs?
 */
if (!function_exists('ct_show_index_post_breadcrumbs')) {
    function ct_show_index_post_breadcrumbs($postType = 'page')
    {
        $show = get_post_meta(get_post() ? get_the_ID() : null, 'show_breadcrumbs', TRUE);
        if ($show == 'global' || $show == '') {
            if ($postType == 'post') {
                return ct_get_option('posts_index_show_breadcrumbs', 1);
            }
            if ($postType == 'portfolio') {
                return ct_get_option('portfolio_index_show_breadcrumbs', 1);
            }
            if ($postType == 'faq') {
                return ct_get_option('faq_index_show_breadcrumbs', 1);
            }
        }
        return $show == "yes";
    }
}


/**
 * use boxed layout?
 */
if (!function_exists('ct_use_boxed_layout')) {
    function ct_use_boxed_layout()
    {
        $use = get_post_meta(get_post() ? get_the_ID() : null, 'use_boxed', TRUE);
        if ($use == 'global' || $use == '') {
            return ct_get_option('style_layout_boxed', 'no') == 'yes';
        }
        return $use == 'yes';
    }
}

/**
 * add menu shadow ?
 */
if (!function_exists('ct_add_menu_shadow')) {
    function ct_add_menu_shadow()
    {
        return ct_get_option('style_menu_shadow', 'no') == 'yes';
    }
}


/**
 * slider code
 */
if (!function_exists('ct_slider_code')) {
    function ct_slider_code()
    {
        if (is_home()) {
            $id = ct_get_option('posts_index_page');
            $slider = $id ? get_post_meta($id, 'slider', TRUE) : '';
        } else {
            $slider = get_post_meta(get_post() ? get_the_ID() : null, 'slider', TRUE);
        }

        return $slider;
    }
}