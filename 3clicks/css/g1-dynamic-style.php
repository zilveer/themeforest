<?php

// read script params
// ------------------
if ( isset( $argv[1] ) ) {
    $root_dir = $argv[1];
}

if ( isset( $argv[2] ) ) {
    $theme_id = $argv[2];
}

if ( isset( $argv[3] ) && $argv[3] === 'dont_send_headers' ) {
    $dont_send_headers = true;
}

if ( isset( $argv[4] ) && $argv[4] === 'disable_debug' ) {
    define('WP_DEBUG', false);
}
// ------------------

 if ( ! isset( $root_dir ) ) {
    $root_dir = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
}

if ( file_exists( $root_dir.'/wp-load.php' ) ) {
    require_once( $root_dir . '/wp-load.php' );
} elseif ( file_exists( $root_dir.'/wp-config.php' ) ) {
    require_once( $root_dir.'/wp-config.php' );
}

if ( isset( $theme_id ) ) {
    G1_Theme()->set_id( $theme_id );
}

/* Content Color Scheme - default */
/* Preheader Color Scheme */
/* Header Color Scheme */
/* Precontent Color Scheme */
/* Prefooter Color Scheme */
/* Footer Color Scheme */


/* Important text */
/*
h1, .g1-h1,
h2, .g1-h2,
h3, .g1-h3,
h4, .g1-h4,
h5, .g1-h5,
h6, .g1-h6 {
    color: ;
}
 */


ob_start();
/* Typography */

/* Regular texts */
$g1_regular_font_size = g1_get_theme_option( 'style_fonts', 'regular_size', 'm' );
$g1_regular_font_sizes = array(
    'xs'    => 12,
    's'     => 13,
    'm'     => 14,
    'l'     => 15,
    'xl'    => 16,
);
if ( in_array( $g1_regular_font_size, $g1_regular_font_sizes ) ) {
    $g1_regular_font_size = $g1_regular_font_sizes[ $g1_regular_font_size ];
} else {
    $g1_regular_font_size = 14;
}

/* Important texts */
$g1_important_font_size = g1_get_theme_option( 'style_fonts', 'important_size', 'm' );
$g1_important_scale = array();
switch ( $g1_important_font_size ) {
    case 'xs':
        /* Modular scale 1:1.25 */
        $g1_important_scale['h1'] = 1.802;
        //$g1_important_scale['h1'] = 1.602;
        $g1_important_scale['h2'] = 1.424;
        $g1_important_scale['h3'] = 1.266;
        $g1_important_scale['h4'] = 1.125;
        $g1_important_scale['h5'] = 1;
        $g1_important_scale['h6'] = 1;
        break;

    case 's':
        /* Modular scale 1:1.25 */
        $g1_important_scale['h1'] = 2.488;
        //$g1_important_scale['h1'] = 2.074;
        $g1_important_scale['h2'] = 1.728;
        $g1_important_scale['h3'] = 1.44;
        $g1_important_scale['h4'] = 1.2;
        $g1_important_scale['h5'] = 1;
        $g1_important_scale['h6'] = 1;
        break;

    case 'l':
        /* Modular scale 1:1.25 */
        $g1_important_scale['h1'] = 4.209;
        //$g1_important_scale['h1'] = 3.157;
        $g1_important_scale['h2'] = 2.369;
        $g1_important_scale['h3'] = 1.777;
        $g1_important_scale['h4'] = 1.333;
        $g1_important_scale['h5'] = 1;
        $g1_important_scale['h6'] = 1;
        break;

    case 'xl':
        /* Modular scale 1:1.25 */
        $g1_important_scale['h1'] = 3.998;
        $g1_important_scale['h2'] = 2.827;
        $g1_important_scale['h3'] = 1.999;
        $g1_important_scale['h4'] = 1.414;
        $g1_important_scale['h5'] = 1;
        $g1_important_scale['h6'] = 1;
        break;

    case 'm':
    default:
        /* Modular scale 1:1.25 */
        $g1_important_scale['h1'] = 3.052;
        //$g1_important_scale['h1'] = 2.441;
        $g1_important_scale['h2'] = 1.953;
        $g1_important_scale['h3'] = 1.563;
        $g1_important_scale['h4'] = 1.25;
        $g1_important_scale['h5'] = 1;
        $g1_important_scale['h6'] = 1;
        break;
}
?>
    html { font-size:<?php echo $g1_regular_font_size; ?>px; }
    h1, .g1-h1 { font-size:<?php echo round($g1_regular_font_size * $g1_important_scale['h1']); ?>px; }
    h2, .g1-h2 { font-size:<?php echo round($g1_regular_font_size * $g1_important_scale['h2']); ?>px; }
    h3, .g1-h3 { font-size:<?php echo round($g1_regular_font_size * $g1_important_scale['h3']); ?>px; }
    h4, .g1-h4 { font-size:<?php echo round($g1_regular_font_size * $g1_important_scale['h4']); ?>px; }
    h5, .g1-h5 { font-size:<?php echo round($g1_regular_font_size * $g1_important_scale['h5']); ?>px; }
    h6, .g1-h6 { font-size:<?php echo round($g1_regular_font_size * $g1_important_scale['h6']); ?>px; }
<?php

do_action( 'g1_dynamic_styles' );

$g1_composition = g1_get_theme_option( 'ta_header', 'composition', 'left-right' );
?>
<?php if ( 'right-left' == $g1_composition ): ?>
    /* logo on right, menu on left */
    #g1-id {
    float:right;
    }
    #g1-id .site-title,
    #g1-id .site-description {
    clear:both;
    float:right;
    }
    #g1-primary-nav {
    margin-left:-10px;
    float:left;
    }
<?php elseif( 'left-bottom' == $g1_composition ): ?>
    /* logo on left, menu below */
    #g1-id .site-title {
    float:left;
    }
    #g1-id .site-description {
    float:right;
    }
<?php elseif( 'center-bottom' == $g1_composition ): ?>
    /* logo centered, menu below */
    #g1-id {
    clear:both;
    text-align:center;
    }
    #g1-id .site-title img {
    margin-left:auto;
    margin-right:auto;
    }
    #g1-primary-nav {
    display:table;
    margin-left:auto;
    margin-right:auto;
    }
<?php elseif( 'right-bottom' == $g1_composition ): ?>
    /* logo on left, menu below */
    #g1-id .site-title {
    float:right;
    }
    #g1-id .site-description {
    float:left;
    }
<?php elseif( 'left-top' == $g1_composition ): ?>
    /* logo on left, menu on top */
    #g1-id {
    clear:both;
    }
    #g1-id .site-title {
    float:left;
    }
    #g1-id .site-description {
    float:right;
    }
    #g1-primary-nav {
    width:100%;
    }
<?php elseif( 'center-top' == $g1_composition ): ?>
    /* logo centered, menu on top */
    #g1-id {
    clear:both;
    text-align:center;
    }
    #g1-id .site-title img {
    margin-left:auto;
    margin-right:auto;
    }
    #g1-primary-nav {
    display:table;
    margin-left:auto;
    margin-right:auto;
    }
<?php elseif( 'right-top' == $g1_composition ): ?>
    /* logo on right, menu on top */
    #g1-id {
    float:right;
    }
    #g1-id .site-title,
    #g1-id .site-description {
    clear:both;
    float:right;
    }
    #g1-primary-nav {
    width:100%;
    }
<?php else: ?>
    /* logo on left, menu on right */
    #g1-id {
    float:left;
    }
    #g1-primary-nav {
    margin-right:-10px;
    float:right;
    }
<?php endif; ?>
<?php

/* Rounded corners for theme areas */
$g1_theme_areas = array(
    'preheader',
    'header',
    'precontent',
    'content',
    'prefooter',
    'footer',
);

foreach( $g1_theme_areas as $g1_theme_area ) {
    $g1 = (array) g1_get_theme_option( 'ta_' . $g1_theme_area, 'layout_corners', array() );

    $g1_tl = '0';
    $g1_tl = 'squircle' === $g1['tl'] ? '7px' : $g1_tl;
    $g1_tl = 'circle' === $g1['tl'] ? '28px' : $g1_tl;

    $g1_tr = '0';
    $g1_tr = 'squircle' === $g1['tr'] ? '7px' : $g1_tr;
    $g1_tr = 'circle' === $g1['tr'] ? '28px' : $g1_tr;

    $g1_br = '0';
    $g1_br = 'squircle' === $g1['br'] ? '7px' : $g1_br;
    $g1_br = 'circle' === $g1['br'] ? '28px' : $g1_br;

    $g1_bl = '0';
    $g1_bl = 'squircle' === $g1['bl'] ? '7px' : $g1_bl;
    $g1_bl = 'circle' === $g1['bl'] ? '28px' : $g1_bl;

    $g1_border_radius = $g1_tl . ' ' . $g1_tr . ' ' . $g1_br . ' ' . $g1_bl;
    ?>
    .g1-<?php echo $g1_theme_area; ?> > .g1-background {
    -webkit-border-radius:<?php echo $g1_border_radius; ?>;
    -moz-border-radius:<?php echo $g1_border_radius; ?>;
    -ms-border-radius:<?php echo $g1_border_radius; ?>;
    -o-border-radius:<?php echo $g1_border_radius; ?>;
    border-radius:<?php echo $g1_border_radius; ?>;
    }
<?php
}
?>
<?php

$g1 = (array) g1_get_theme_option( 'style', 'ui_corners', array() );

$g1_ui_tl = '0';
$g1_ui_tl = 'squircle' === $g1['tl'] ? '5px' : $g1_ui_tl;
$g1_ui_tl = 'circle' === $g1['tl'] ? '12px' : $g1_ui_tl;

$g1_ui_tr = '0';
$g1_ui_tr = 'squircle' === $g1['tr'] ? '5px' : $g1_ui_tr;
$g1_ui_tr = 'circle' === $g1['tr'] ? '12px' : $g1_ui_tr;

$g1_ui_br = '0';
$g1_ui_br = 'squircle' === $g1['br'] ? '5px' : $g1_ui_br;
$g1_ui_br = 'circle' === $g1['br'] ? '12px' : $g1_ui_br;

$g1_ui_bl = '0';
$g1_ui_bl = 'squircle' === $g1['bl'] ? '5px' : $g1_ui_bl;
$g1_ui_bl = 'circle' === $g1['bl'] ? '12px' : $g1_ui_bl;

$g1_border_radius = $g1_ui_tl . ' ' . $g1_ui_tr . ' ' . $g1_ui_br . ' ' . $g1_ui_bl;
?>
    input,
    select,
    textarea,
    pre code,
    input[type=button],
    input[type=submit],
    button,
    .g1-button,
    a.button,
    .g1-message,
    .woocommerce-message,
    .woocommerce-info,
    .woocommerce-error,
    .bbp-template-notice,
    .g1-placeholder,
    .g1-frame--inherit > .g1-decorator,
    .g1-quote--solid > .g1-inner,
    .g1-box:before,
    .g1-box__inner,
    .g1-toggle__switch,
    .g1-table--solid,
    .shop_table:before,
    .woocommerce .images .zoom,
    .g1-tabs--simple,
    .g1-tabs--simple > div,
    .g1-chat-row,
    .g1-side-nav,
    .gallery-icon,
    .g1-countdown i,
    .countdown_section span,
    .g1-banda img,
    .g1-nav--mobile #g1-secondary-nav-menu,
    #lang_sel ul ul,
    .g1-twitter--simple .g1-twitter__items,
    .g1-gmap__box > .g1-inner,
    .g1gmap-marker-bubble-inner,
    .g1-isotope-filters,
    .g1-isotope-filters > div,
    .g1-mediabox--featured-media .g1-mediabox__item,
    .g1-mediabox--list .g1-mediabox__item,
    .g1-mediabox--slider .g1-carousel,
    .g1-slide__title > .g1-background,
    .g1-slide__description > .g1-background,
    .g1-simple-slider .g1-fullscreen a,
    .tp-caption,
    .g1-nav--expanded #g1-primary-nav-menu:before,
    .g1-nav--expanded #g1-primary-nav-menu:after,
    .g1-nav--simple #g1-primary-nav-menu > .current_page_ancestor > a,
    .g1-nav--simple #g1-primary-nav-menu > .current_page_parent > a,
    .g1-nav--simple #g1-primary-nav-menu > .current_page_item > a,
    #g1-primary-nav-menu > .g1-type-tile .g1-submenus,
    #g1-primary-nav-menu > .g1-type-column .g1-submenus,
    #g1-primary-nav-menu > .g1-type-drops ul,
    .g1-searchbox #searchform,
    .g1-cartbox .g1-cartbox__box,
    .entry-featured-media,
    #payment,
    #payment .payment_box,
    .bbp-logged-in {
    -webkit-border-radius:<?php echo $g1_border_radius; ?>;
    -moz-border-radius:<?php echo $g1_border_radius; ?>;
    -ms-border-radius:<?php echo $g1_border_radius; ?>;
    -o-border-radius:<?php echo $g1_border_radius; ?>;
    border-radius:<?php echo $g1_border_radius; ?>;
    }
<?php
/* Top radiuses only */
$g1_border_radius = $g1_ui_tl . ' ' . $g1_ui_tr . ' 0 0';
?>
    .g1-gmap-wrapper .g1-pan-control {
    -webkit-border-radius:<?php echo $g1_border_radius; ?>;
    -moz-border-radius:<?php echo $g1_border_radius; ?>;
    -ms-border-radius:<?php echo $g1_border_radius; ?>;
    -o-border-radius:<?php echo $g1_border_radius; ?>;
    border-radius:<?php echo $g1_border_radius; ?>;
    }
<?php
/* Bottom radiuses only */
$g1_border_radius = '0 0 ' . $g1_ui_tl . ' ' . $g1_ui_tr;
?>
    .g1-gmap-wrapper .g1-zoom-control {
    -webkit-border-radius:<?php echo $g1_border_radius; ?>;
    -moz-border-radius:<?php echo $g1_border_radius; ?>;
    -ms-border-radius:<?php echo $g1_border_radius; ?>;
    -o-border-radius:<?php echo $g1_border_radius; ?>;
    border-radius:<?php echo $g1_border_radius; ?>;
    }
<?php
/* Top-left radius only */
?>
    #wp-calendar tbody tr:first-child > td:first-child,
    .g1-table--solid thead tr:first-of-type th:first-child,
    .shop_table thead tr:first-of-type th:first-child {
    -webkit-border-top-left-radius:<?php echo $g1_ui_tl; ?>;
    -moz-border-top-left-radius:<?php echo $g1_ui_tl; ?>;
    -ms-border-top-left-radius:<?php echo $g1_ui_tl; ?>;
    -o-border-top-left-radius:<?php echo $g1_ui_tl; ?>;
    border-top-left-radius:<?php echo $g1_ui_tl; ?>;
    }
<?php
/* Top-right radius only */
?>
    #wp-calendar tbody tr:first-child > td:last-child,
    .g1-table--solid thead tr:first-of-type th:last-child,
    .shop_table thead tr:first-of-type th:last-child {
    -webkit-border-top-right-radius:<?php echo $g1_ui_tr; ?>;
    -moz-border-top-right-radius:<?php echo $g1_ui_tr; ?>;
    -ms-border-top-right-radius:<?php echo $g1_ui_tr ?>;
    -o-border-top-right-radius:<?php echo $g1_ui_tr; ?>;
    border-top-right-radius:<?php echo $g1_ui_tr; ?>;
    }
<?php
/* Bottom-left radius only */
?>
    #wp-calendar tbody tr:last-child > td:first-child,
    .g1-table--solid tr:last-of-type td:first-child,
    .g1-table--solid tr:last-of-type th:first-child,
    .shop_table tr:last-of-type td:first-child,
    .shop_table tr:last-of-type th:first-child {
    -webkit-border-bottom-left-radius:<?php echo $g1_ui_bl; ?>;
    -moz-border-bottom-left-radius:<?php echo $g1_ui_bl; ?>;
    -ms-border-bottom-left-radius:<?php echo $g1_ui_bl; ?>;
    -o-border-bottom-left-radius:<?php echo $g1_ui_bl; ?>;
    border-bottom-left-radius:<?php echo $g1_ui_bl; ?>;
    }
<?php
/* Bottom-right radius only */
?>
    #wp-calendar tbody tr:last-child > td:last-child,
    .g1-table--solid tr:last-of-type td:last-child,
    .g1-table--solid tr:last-of-type th:last-child,
    .shop_table tr:last-of-type td:last-child,
    .shop_table tr:last-of-type th:last-child {
    -webkit-border-bottom-right-radius:<?php echo $g1_ui_br; ?>;
    -moz-border-bottom-right-radius:<?php echo $g1_ui_br; ?>;
    -ms-border-bottom-right-radius:<?php echo $g1_ui_br; ?>;
    -o-border-bottom-right-radius:<?php echo $g1_ui_br; ?>;
    border-bottom-right-radius:<?php echo $g1_ui_br; ?>;
    }
<?php
/* Squared elements */
$g1_ui_tl = '0';
$g1_ui_tl = 'squircle' === $g1['tl'] ? '5px' : $g1_ui_tl;
$g1_ui_tl = 'circle' === $g1['tl'] ? '50%' : $g1_ui_tl;

$g1_ui_tr = '0';
$g1_ui_tr = 'squircle' === $g1['tr'] ? '5px' : $g1_ui_tr;
$g1_ui_tr = 'circle' === $g1['tr'] ? '50%' : $g1_ui_tr;

$g1_ui_br = '0';
$g1_ui_br = 'squircle' === $g1['br'] ? '5px' : $g1_ui_br;
$g1_ui_br = 'circle' === $g1['br'] ? '50%' : $g1_ui_br;

$g1_ui_bl = '0';
$g1_ui_bl = 'squircle' === $g1['bl'] ? '5px' : $g1_ui_bl;
$g1_ui_bl = 'circle' === $g1['bl'] ? '50%' : $g1_ui_bl;

$g1_border_radius = $g1_ui_tl . ' ' . $g1_ui_tr . ' ' . $g1_ui_br . ' ' . $g1_ui_bl;
$g1_border_radius_mirror = $g1_ui_tr . ' ' . $g1_ui_tl . ' ' . $g1_ui_bl . ' ' . $g1_ui_br;
?>
    .g1-indicator:before,
    .g1-quote figcaption img,
    .g1-quote__image,
    .g1-banda__handle span,
    .g1-twitter .g1-nav-direction__next,
    .g1-html-rotator .g1-nav-direction__next,
    #wp-calendar #next a,
    #wp-calendar #next span,
    .g1-mediabox--slider .g1-nav-direction__next,
    .tp-rightarrow.default,
    .g1-simple-slider-simple .g1-nav-direction__next,
    .g1-simple-slider-kenburns .g1-nav-direction__next,
    .g1-simple-slider-standout .g1-nav-direction__next,
    .g1-simple-slider-relay .g1-nav-direction__next,
    #g1-back-to-top,
    .galleria-exit-button,
    .entry-featured-media .g1-nav-direction__next,
    .g1-pagination a.next,
    .widget_rss .widgettitle a.rsswidget:first-child {
    -webkit-border-radius:<?php echo $g1_border_radius; ?>;
    -moz-border-radius:<?php echo $g1_border_radius; ?>;
    -ms-border-radius:<?php echo $g1_border_radius; ?>;
    -o-border-radius:<?php echo $g1_border_radius; ?>;
    border-radius:<?php echo $g1_border_radius; ?>;
    }
    .g1-twitter .g1-nav-direction__prev,
    .g1-html-rotator .g1-nav-direction__prev,
    #wp-calendar #prev a,
    #wp-calendar #prev span,
    .g1-mediabox--slider .g1-nav-direction__prev,
    .g1-mediabox--slider .g1-nav-coin li,
    .tp-leftarrow.default,
    .g1-simple-slider-simple .g1-nav-direction__prev,
    .g1-simple-slider-kenburns .g1-nav-direction__prev,
    .g1-simple-slider-standout .g1-nav-direction__prev,
    .g1-simple-slider-relay .g1-nav-direction__prev,
    .entry-featured-media .g1-nav-direction__prev,
    .g1-pagination a.prev {
    -webkit-border-radius:<?php echo $g1_border_radius_mirror; ?>;
    -moz-border-radius:<?php echo $g1_border_radius_mirror; ?>;
    -ms-border-radius:<?php echo $g1_border_radius_mirror; ?>;
    -o-border-radius:<?php echo $g1_border_radius_mirror; ?>;
    border-radius:<?php echo $g1_border_radius_mirror; ?>;
    }
<?php
/* 32px height */
$g1_ui_tl = '0';
$g1_ui_tl = 'squircle' === $g1['tl'] ? '5px' : $g1_ui_tl;
$g1_ui_tl = 'circle' === $g1['tl'] ? '16px' : $g1_ui_tl;

$g1_ui_tr = '0';
$g1_ui_tr = 'squircle' === $g1['tr'] ? '5px' : $g1_ui_tr;
$g1_ui_tr = 'circle' === $g1['tr'] ? '16px' : $g1_ui_tr;

$g1_ui_br = '0';
$g1_ui_br = 'squircle' === $g1['br'] ? '5px' : $g1_ui_br;
$g1_ui_br = 'circle' === $g1['br'] ? '16px' : $g1_ui_br;

$g1_ui_bl = '0';
$g1_ui_bl = 'squircle' === $g1['bl'] ? '5px' : $g1_ui_bl;
$g1_ui_bl = 'circle' === $g1['bl'] ? '16px' : $g1_ui_bl;

$g1_border_radius = $g1_ui_tl . ' ' . $g1_ui_tr . ' ' . $g1_ui_br . ' ' . $g1_ui_bl;
?>
    #g1-primary-nav-switch {
    -webkit-border-radius:<?php echo $g1_border_radius; ?>;
    -moz-border-radius:<?php echo $g1_border_radius; ?>;
    -ms-border-radius:<?php echo $g1_border_radius; ?>;
    -o-border-radius:<?php echo $g1_border_radius; ?>;
    border-radius:<?php echo $g1_border_radius; ?>;
    }
<?php
/* Other */
$g1_ui_tl = '0';
$g1_ui_tl = 'squircle' === $g1['tl'] ? '5px' : $g1_ui_tl;
$g1_ui_tl = 'circle' === $g1['tl'] ? '1em' : $g1_ui_tl;

$g1_ui_tr = '0';
$g1_ui_tr = 'squircle' === $g1['tr'] ? '5px' : $g1_ui_tr;
$g1_ui_tr = 'circle' === $g1['tr'] ? '1em' : $g1_ui_tr;

$g1_ui_br = '0';
$g1_ui_br = 'squircle' === $g1['br'] ? '5px' : $g1_ui_br;
$g1_ui_br = 'circle' === $g1['br'] ? '1em' : $g1_ui_br;

$g1_ui_bl = '0';
$g1_ui_bl = 'squircle' === $g1['bl'] ? '5px' : $g1_ui_bl;
$g1_ui_bl = 'circle' === $g1['bl'] ? '1em' : $g1_ui_bl;

$g1_border_radius = $g1_ui_tl . ' ' . $g1_ui_tr . ' ' . $g1_ui_br . ' ' . $g1_ui_bl;
?>
    .g1-tagcloud > a {
    -webkit-border-radius:<?php echo $g1_border_radius; ?>;
    -moz-border-radius:<?php echo $g1_border_radius; ?>;
    -ms-border-radius:<?php echo $g1_border_radius; ?>;
    -o-border-radius:<?php echo $g1_border_radius; ?>;
    border-radius:<?php echo $g1_border_radius; ?>;
    }

<?php
echo G1()->capture_custom_css();
$size = ob_get_length();
$content = ob_get_contents();
ob_end_clean();

$cache_timeout = apply_filters('g1_dynamic_style_cache_timeout', 3600);

if ( empty($dont_send_headers) ) {
    header('Pragma: public'); // HTTP 1.0
    header('Cache-Control: public');
    header('Expires: '.gmdate('D, d M Y H:i:s',time() + $cache_timeout).' GMT');
    header("Content-Type: text/css");
    header("Content-Length: $size");
}

echo $content;