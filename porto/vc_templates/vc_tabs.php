<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $interval : removed
 * @var $el_class
 * @var $content - shortcode content
 *
 * Extra Params
 * @var $position
 * @var $skin
 * @var $color
 * @var $type
 * @var $icon_style
 * @var $icon_effect
 *
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Tabs
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);

$element = 'tabs ';
if ( 'vc_tour' === $this->shortcode ) $element .= ' tabs-vertical';

// Extract tab titles
preg_match_all( '/vc_tab([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE );

$ul_class = '';
switch ( $position ) {
    case 'top-right' :
        $ul_class .= ' text-right';
        break;
    case 'bottom-left' :
        $el_class .= ' tabs-bottom';
        break;
    case 'bottom-right' :
        $ul_class .= ' nav-right';
        $el_class .= ' tabs-bottom';
        break;
    case 'top-justify' :
        $ul_class .= ' nav-justified';
        break;
    case 'bottom-justify' :
        $ul_class .= ' nav-justified';
        $el_class .= ' tabs-bottom';
        break;
    case 'vertical-left' :
        if ($type == 'tabs-navigation') {
            $ul_class .= ' col-md-4';
        } else {
            $ul_class .= ' col-sm-3';
        }
        $el_class .= ' tabs-left';
        break;
    case 'vertical-right' :
        if ($type == 'tabs-navigation') {
            $ul_class .= ' col-md-4';
        } else {
            $ul_class .= ' col-sm-3';
        }
        $el_class .= ' tabs-right';
        break;
    case 'top-center':
        $el_class .= ' tabs-center';
        break;
    case 'bottom-center':
        $el_class .= ' tabs-bottom tabs-center';
        break;
    default:
}

$el_class .= ' ' .$type;

/**
 * vc_tabs
 *
 */
$tabs = array();
if ( isset($matches[0]) ) { $tabs = $matches[0]; }
$tabs_nav = '';
$tabs_nav .= '<ul class="nav nav-tabs ' . $ul_class . ($type == 'tabs-simple' ? ' featured-boxes ' . $icon_style : '') . '">';
foreach ( $tabs as $tab ) {
    preg_match('/ title="([^\"]+)\"/i', $tab[0], $title_matches, PREG_OFFSET_CAPTURE);
    preg_match('/ tab_id="([^\"]+)\"/i', $tab[0], $tab_id_matches, PREG_OFFSET_CAPTURE);
    preg_match('/ show_icon="([^\"]+)\"/i', $tab[0], $show_icon_matches, PREG_OFFSET_CAPTURE);
    preg_match('/ icon_type="([^\"]+)\"/i', $tab[0], $icon_type_matches, PREG_OFFSET_CAPTURE);
    preg_match('/ icon_image="([^\"]+)\"/i', $tab[0], $icon_image_matches, PREG_OFFSET_CAPTURE);
    preg_match('/ icon="([^\"]+)\"/i', $tab[0], $icon_matches, PREG_OFFSET_CAPTURE);
    preg_match('/ icon_simpleline="([^\"]+)\"/i', $tab[0], $icon_simpleline_matches, PREG_OFFSET_CAPTURE);
    preg_match('/ icon_skin="([^\"]+)\"/i', $tab[0], $icon_skin_matches, PREG_OFFSET_CAPTURE);
    preg_match('/ icon_color="([^\"]+)\"/i', $tab[0], $icon_color_matches, PREG_OFFSET_CAPTURE);
    preg_match('/ icon_bg_color="([^\"]+)\"/i', $tab[0], $icon_bg_color_matches, PREG_OFFSET_CAPTURE);
    preg_match('/ icon_border_color="([^\"]+)\"/i', $tab[0], $icon_border_color_matches, PREG_OFFSET_CAPTURE);
    preg_match('/ icon_wrap_border_color="([^\"]+)\"/i', $tab[0], $icon_wrap_border_color_matches, PREG_OFFSET_CAPTURE);
    preg_match('/ icon_shadow_color="([^\"]+)\"/i', $tab[0], $icon_shadow_color_matches, PREG_OFFSET_CAPTURE);
    preg_match('/ icon_hcolor="([^\"]+)\"/i', $tab[0], $icon_hcolor_matches, PREG_OFFSET_CAPTURE);
    preg_match('/ icon_hbg_color="([^\"]+)\"/i', $tab[0], $icon_hbg_color_matches, PREG_OFFSET_CAPTURE);
    preg_match('/ icon_hborder_color="([^\"]+)\"/i', $tab[0], $icon_hborder_color_matches, PREG_OFFSET_CAPTURE);
    preg_match('/ icon_wrap_hborder_color="([^\"]+)\"/i', $tab[0], $icon_wrap_hborder_color_matches, PREG_OFFSET_CAPTURE);
    preg_match('/ icon_hshadow_color="([^\"]+)\"/i', $tab[0], $icon_hshadow_color_matches, PREG_OFFSET_CAPTURE);

    $tab_title = isset($title_matches) && isset($title_matches[1]) ? $title_matches[1][0] : '';
    $tab_id = isset($tab_id_matches) && isset($tab_id_matches[1]) ? $tab_id_matches[1][0] : '';
    $show_icon = isset($show_icon_matches) && isset($show_icon_matches[1]) ? $show_icon_matches[1][0] : '';
    $icon_type = isset($icon_type_matches) && isset($icon_type_matches[1]) ? $icon_type_matches[1][0] : '';
    $icon_image = isset($icon_image_matches) && isset($icon_image_matches[1]) ? $icon_image_matches[1][0] : '';
    $icon = isset($icon_matches) && isset($icon_matches[1]) ? $icon_matches[1][0] : '';
    $icon_simpleline = isset($icon_simpleline_matches) && isset($icon_simpleline_matches[1]) ? $icon_simpleline_matches[1][0] : '';
    $icon_skin = isset($icon_skin_matches) && isset($icon_skin_matches[1]) ? $icon_skin_matches[1][0] : 'custom';
    $icon_color = isset($icon_color_matches) && isset($icon_color_matches[1]) ? $icon_color_matches[1][0] : '';
    $icon_bg_color = isset($icon_bg_color_matches) && isset($icon_bg_color_matches[1]) ? $icon_bg_color_matches[1][0] : '';
    $icon_border_color = isset($icon_border_color_matches) && isset($icon_border_color_matches[1]) ? $icon_border_color_matches[1][0] : '';
    $icon_wrap_border_color = isset($icon_wrap_border_color_matches) && isset($icon_wrap_border_color_matches[1]) ? $icon_wrap_border_color_matches[1][0] : '';
    $icon_shadow_color = isset($icon_shadow_color_matches) && isset($icon_shadow_color_matches[1]) ? $icon_shadow_color_matches[1][0] : '';
    $icon_hcolor = isset($icon_hcolor_matches) && isset($icon_hcolor_matches[1]) ? $icon_hcolor_matches[1][0] : '';
    $icon_hbg_color = isset($icon_hbg_color_matches) && isset($icon_hbg_color_matches[1]) ? $icon_hbg_color_matches[1][0] : '';
    $icon_hborder_color = isset($icon_hborder_color_matches) && isset($icon_hborder_color_matches[1]) ? $icon_hborder_color_matches[1][0] : '';
    $icon_wrap_hborder_color = isset($icon_wrap_hborder_color_matches) && isset($icon_wrap_hborder_color_matches[1]) ? $icon_wrap_hborder_color_matches[1][0] : '';
    $icon_hshadow_color = isset($icon_hshadow_color_matches) && isset($icon_hshadow_color_matches[1]) ? $icon_hshadow_color_matches[1][0] : '';

    switch ($icon_type) {
        case 'simpleline': $icon_class = $icon_simpleline; break;
        case 'image': $icon_class = 'icon-image'; break;
        default: $icon_class = $icon;
    }

    if($tab_title) {
        $tab_id = 'tab-' . ($tab_id ? $tab_id : sanitize_title( $tab_title ));
        $tabs_nav .= '<li><a href="#'. $tab_id .'" id="' . $tab_id .'-title" data-toggle="tab">';
        $tab_id .= '-title';
        if ($show_icon && $icon_class) {
            if ($type == 'tabs-simple') {
                if ($icon_skin == 'custom' && ($icon_color || $icon_bg_color || $icon_border_color || $icon_wrap_border_color || $icon_shadow_color || $icon_hcolor || $icon_hbg_color || $icon_hborder_color || $icon_wrap_hborder_color || $icon_hshadow_color)) :
                    ?>
                    <style type="text/css"><?php
                    if ($icon_color) : ?>
                        .nav-tabs > li a#<?php echo $tab_id ?>:hover,
                        .nav-tabs > li a#<?php echo $tab_id ?>:focus,
                        .nav-tabs > li.active a#<?php echo $tab_id ?>,
                        .nav-tabs > li.active a#<?php echo $tab_id ?>:hover,
                        .nav-tabs > li.active a#<?php echo $tab_id ?>:focus {
                            border-bottom-color: <?php echo $icon_color ?>;
                        }<?php
                    endif;
                    if ($icon_color || $icon_bg_color || $icon_border_color) : ?>
                    #<?php echo $tab_id ?> .featured-box .icon-featured {
                        <?php if ($icon_color) : ?>color: <?php echo $icon_color ?>;<?php endif;
                        if ($icon_bg_color) : ?>background-color: <?php echo $icon_bg_color ?>;<?php endif;
                        if ($icon_border_color) : ?>border-color: <?php echo $icon_border_color ?>;<?php endif; ?>
                    }<?php
                    endif;
                    if ($icon_hcolor || $icon_hbg_color || $icon_hborder_color) : ?>
                    #<?php echo $tab_id ?> .featured-box:hover .icon-featured {
                        <?php if ($icon_hcolor) : ?>color: <?php echo $icon_hcolor ?>;<?php endif;
                        if ($icon_hbg_color) : ?>background-color: <?php echo $icon_hbg_color ?>;<?php endif;
                        if ($icon_hborder_color) : ?>border-color: <?php echo $icon_hborder_color ?>;<?php endif; ?>
                    }<?php
                    endif;
                    if ($icon_style == 'featured-boxes-style-7') :
                        if ($icon_shadow_color) : ?>
                        #<?php echo $tab_id ?> .featured-box .icon-featured:after {
                            box-shadow: 3px 3px <?php echo $icon_shadow_color ?>;
                        }<?php
                        endif;
                        if ($icon_hshadow_color) : ?>
                        #<?php echo $tab_id ?> .featured-box:hover .icon-featured:after {
                            box-shadow: 3px 3px <?php echo $icon_hshadow_color ?>;
                        }<?php
                        endif;
                    endif;
                    if ($icon_effect == 'featured-box-effect-1' || $icon_effect == 'featured-box-effect-2') :
                        if ($icon_shadow_color) : ?>
                        #<?php echo $tab_id ?> .featured-box .icon-featured:after {
                            box-shadow: 0 0 0 3px <?php echo $icon_shadow_color ?>;
                        }<?php
                        endif;
                        if ($icon_hshadow_color) : ?>
                        #<?php echo $tab_id ?> .featured-box:hover .icon-featured:after {
                            box-shadow: 0 0 0 3px <?php echo $icon_hshadow_color ?>;
                        }<?php
                        endif;
                    endif;
                    if ($icon_effect == 'featured-box-effect-3') :
                        if ($icon_shadow_color) : ?>
                        #<?php echo $tab_id ?> .featured-box .icon-featured:after {
                            box-shadow: 0 0 0 10px <?php echo $icon_shadow_color ?>;
                        }<?php
                        endif;
                        if ($icon_hshadow_color) : ?>
                        #<?php echo $tab_id ?> .featured-box:hover .icon-featured:after {
                            box-shadow: 0 0 0 10px <?php echo $icon_hshadow_color ?>;
                        }<?php
                        endif;
                    endif;
                    if ($icon_effect == 'featured-box-effect-7') :
                        if ($icon_shadow_color) : ?>
                        #<?php echo $tab_id ?> .featured-box .icon-featured:after {
                            box-shadow: 3px 3px <?php echo $icon_shadow_color ?>;
                        }<?php
                        endif;
                        if ($icon_hshadow_color) : ?>
                        #<?php echo $tab_id ?> .featured-box:hover .icon-featured:after {
                            box-shadow: 3px 3px <?php echo $icon_hshadow_color ?>;
                        }<?php
                        endif;
                    endif;
                    if ($icon_style == 'featured-boxes-style-6') :
                        if ($icon_wrap_border_color) : ?>
                        #<?php echo $tab_id ?> .featured-box .icon-featured:after {
                            border-color: <?php echo $icon_wrap_border_color ?>;
                        }<?php
                        endif;
                        if ($icon_wrap_hborder_color) : ?>
                        #<?php echo $tab_id ?> .featured-box:hover .icon-featured:after {
                            border-color: <?php echo $icon_wrap_hborder_color ?>;
                            }<?php
                        endif;
                    endif; ?>
                    </style>
                <?php
                endif;
                if ($icon_skin != 'custom')
                    $icon_effect .= ' featured-box-' . $icon_skin;
                $tabs_nav .= '<span class="featured-box '.$icon_effect.'">';
                $tabs_nav .= '<span class="box-content">';
                if ($icon_class) {
                    $tabs_nav .= '<i class="icon-featured ' . $icon_class . '">';
                    if ($icon_class == 'icon-image' && $icon_image) {
                        $icon_image = preg_replace('/[^\d]/', '', $icon_image);
                        $image_url = wp_get_attachment_url($icon_image);
                        $image_url = str_replace(array('http:', 'https:'), '', $image_url);
                        if ($image_url)
                            $tabs_nav .= '<img alt="" src="' . esc_url($image_url) . '">';
                    }
                    $tabs_nav .= '</i>';
                }
                $tabs_nav .= '</span>';
                $tabs_nav .= '</span>' . '<span class="tab-title">' . $tab_title . '</span>';
            } else {
                if ($icon_class) {
                    $tabs_nav .= '<i class="' . $icon_class . '">';
                    if ($icon_class == 'icon-image' && $icon_image) {
                        $icon_image = preg_replace('/[^\d]/', '', $icon_image);
                        $image_url = wp_get_attachment_url($icon_image);
                        $image_url = str_replace(array('http:', 'https:'), '', $image_url);
                        if ($image_url)
                            $tabs_nav .= '<img alt="" src="' . esc_url($image_url) . '">';
                    }
                    $tabs_nav .= '</i>';
                }
                $tabs_nav .= $tab_title;
            }
        } else {
            $tabs_nav .= $tab_title;
        }
        $tabs_nav .= '</a></li>';
    }
}
$tabs_nav .= '</ul>';
$tabs_nav = preg_replace('/<li>/', '<li class="active">', $tabs_nav, 1);

$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim($element.$el_class), $this->settings['base']);

if ($skin == 'custom' && $color) {
    $tabs_class = 'tabs'.rand();
    $css_class .= ' '.$tabs_class;
    ?>
    <style type="text/css"><?php
        if ($color) : ?>
            .tabs.<?php echo $tabs_class ?> ul.nav-tabs a,
            .tabs.<?php echo $tabs_class ?> ul.nav-tabs a:hover {
                color: <?php echo $color ?>;
            }
            .tabs.<?php echo $tabs_class ?> ul.nav-tabs a:hover,
            .tabs.<?php echo $tabs_class ?> ul.nav-tabs a:focus {
                border-top-color: <?php echo $color ?>;
            }
            .tabs.<?php echo $tabs_class ?> ul.nav-tabs li.active a,
            .tabs.<?php echo $tabs_class ?> ul.nav-tabs li.active a:hover,
            .tabs.<?php echo $tabs_class ?> ul.nav-tabs li.active a:focus {
                border-top-color: <?php echo $color ?>;
                color: <?php echo $color ?>;
            }<?php
            if ( strpos($ul_class, 'nav-justified') ) : ?>
            .tabs.<?php echo $tabs_class ?> ul.nav-tabs.nav-justified a:hover,
            .tabs.<?php echo $tabs_class ?> ul.nav-tabs.nav-justified a:focus {
                border-top-color: <?php echo $color ?>;
            }<?php
            endif;
            if ( strpos($css_class, 'tabs-bottom') ) : ?>
            .tabs.<?php echo $tabs_class ?>.tabs-bottom ul.nav-tabs li a:hover,
            .tabs.<?php echo $tabs_class ?>.tabs-bottom ul.nav-tabs li.active a,
            .tabs.<?php echo $tabs_class ?>.tabs-bottom ul.nav-tabs li.active a:hover,
            .tabs.<?php echo $tabs_class ?>.tabs-bottom ul.nav-tabs li.active a:focus {
                border-bottom-color: <?php echo $color ?>;
            }<?php
            endif;
            if ( strpos($css_class, 'tabs-vertical') && strpos($css_class, 'tabs-left') ) : ?>
            .tabs.<?php echo $tabs_class ?>.tabs-vertical.tabs-left ul.nav-tabs li a:hover,
            .tabs.<?php echo $tabs_class ?>.tabs-vertical.tabs-left ul.nav-tabs li.active a,
            .tabs.<?php echo $tabs_class ?>.tabs-vertical.tabs-left ul.nav-tabs li.active a:hover,
            .tabs.<?php echo $tabs_class ?>.tabs-vertical.tabs-left ul.nav-tabs li.active a:focus {
                border-left-color: <?php echo $color ?>;
            }<?php
            endif;
            if ( strpos($css_class, 'tabs-vertical') && strpos($css_class, 'tabs-right') ) : ?>
            .tabs.<?php echo $tabs_class ?>.tabs-vertical.tabs-right ul.nav-tabs li a:hover,
            .tabs.<?php echo $tabs_class ?>.tabs-vertical.tabs-right ul.nav-tabs li.active a,
            .tabs.<?php echo $tabs_class ?>.tabs-vertical.tabs-right ul.nav-tabs li.active a:hover,
            .tabs.<?php echo $tabs_class ?>.tabs-vertical.tabs-right ul.nav-tabs li.active a:focus {
                border-right-color: <?php echo $color ?>;
            }<?php
            endif;
            if ( strpos($css_class, 'tabs-simple') ) : ?>
            .tabs.<?php echo $tabs_class ?>.tabs-simple .nav-tabs > li a,
            .tabs.<?php echo $tabs_class ?>.tabs-simple .nav-tabs > li a:hover,
            .tabs.<?php echo $tabs_class ?>.tabs-simple .nav-tabs > li a:focus,
            .tabs.<?php echo $tabs_class ?>.tabs-simple .nav-tabs > li.active a,
            .tabs.<?php echo $tabs_class ?>.tabs-simple .nav-tabs > li.active a:hover,
            .tabs.<?php echo $tabs_class ?>.tabs-simple .nav-tabs > li.active a:focus {
                color: <?php global $porto_settings; echo $porto_settings['body-font']['color'] ?>;
            }
            .tabs.<?php echo $tabs_class ?>.tabs-simple .nav-tabs > li a:hover,
            .tabs.<?php echo $tabs_class ?>.tabs-simple .nav-tabs > li a:focus,
            .tabs.<?php echo $tabs_class ?>.tabs-simple .nav-tabs > li.active a {
                border-bottom-color: <?php echo $color ?>;
            }<?php
            endif;
        endif; ?>
    </style>
<?php
}

if ($skin != 'custom')
    $css_class .= ' tabs-' . $skin;

$output .= '<div class="'.$css_class.'">';
$output .= wpb_widget_title(array('title' => $title, 'extraclass' => $element.'_heading'));
if ( !in_array($position, array('bottom-left', 'bottom-right', 'bottom-justify', 'bottom-center', 'vertical-right')) ) {
    $output .= $tabs_nav;
}
$output .= '<div class="tab-content">';
$output .= preg_replace('/tab-pane/', 'tab-pane active', wpb_js_remove_wpautop($content), 1);
$output .= '</div>';
if ( in_array($position, array('bottom-left', 'bottom-right', 'bottom-justify', 'bottom-center', 'vertical-right')) ) {
    $output .= $tabs_nav;
}
$output .= '</div>';

echo $output;