<?php
/**
 * Trizzy Theme Customizer
 *
 * @package Trizzy
 */


/**
 * Convert a hexa decimal color code to its RGB equivalent
 *
 * @param string $hexStr (hexadecimal color value)
 * @param boolean $returnAsString (if set true, returns the value separated by the separator character. Otherwise returns associative array)
 * @param string $seperator (to separate RGB values. Applicable only if second parameter is true.)
 * @return array or string (depending on second parameter. Returns False if invalid hex color value)
 */
function trizzyhex2rgb($hexStr, $returnAsString = false, $seperator = ',') {
    $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
    $rgbArray = array();
    if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
        $colorVal = hexdec($hexStr);
        $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
        $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
        $rgbArray['blue'] = 0xFF & $colorVal;
    } elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
        $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
        $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
        $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
    } else {
        return false; //Invalid hex color code
    }
    return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
}


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function trizzy_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    // color section
    $wp_customize->add_section( 'trizzy_color_settings', array(
        'title'          => __('Main theme color','trizzy'),
        'priority'       => 35,
        ) );

    $wp_customize->add_setting( 'trizzy_main_color', array(
        'default'        => '#73b819',
        'transport' =>'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
        ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trizzy_main_color', array(
        'label'   => __('Color Settings','trizzy'),
        'section' => 'colors',
        'settings'   => 'trizzy_main_color',
        )));

    // bof layout section
    $wp_customize->add_section( 'trizzy_layout_settings', array(
        'title'          => __('Layout','trizzy'),
        'priority'       => 36,
        ));


    $wp_customize->add_setting( 'trizzy_layout_style', array(
        'default'  => 'boxed',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_layout_style',
        ));
    $wp_customize->add_control( 'trizzy_layout_choose', array(
        'label'    => __('Select layout type','trizzy'),
        'section'  => 'trizzy_layout_settings',
        'settings' => 'trizzy_layout_style',
        'type'     => 'select',
        'choices'    => array(
            'boxed' => 'Boxed',
            'fullwidth' => 'Wide',
            )
        ));


    $wp_customize->add_setting( 'trizzy_menu_style', array(
        'default'  => 'dark',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_menu_style',
        ));
    $wp_customize->add_control( 'trizzy_menu_choose', array(
        'label'    => __('Select menu style','trizzy'),
        'section'  => 'trizzy_layout_settings',
        'settings' => 'trizzy_menu_style',
        'type'     => 'select',
        'choices'    => array(
            'dark' => 'Dark',
            'alt' => 'Light',
            )
        ));

    $wp_customize->add_setting( 'trizzy_menu_bgcolor', array(
        'default'        => '#606060',
        'transport' =>'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
        ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trizzy_menu_bgcolor', array(
        'label'   => __('Menu background color','trizzy'),
        'section' => 'colors',
        'settings'   => 'trizzy_menu_bgcolor',
        )));


    $wp_customize->add_setting( 'trizzy_menu_currcolor', array(
        'default'        => '#505050',
        'transport' =>'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
        ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trizzy_menu_currcolor', array(
        'label'   => __('Menu current element color','trizzy'),
        'section' => 'colors',
        'settings'   => 'trizzy_menu_currcolor',
        )));


    $wp_customize->add_setting( 'trizzy_tagline_switch', array(
        'default'  => 'show',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_tagline_switch',
        ));
    $wp_customize->add_control( 'trizzy_tagline_switcher', array(
        'settings' => 'trizzy_tagline_switch',
        'label'    => __( 'Display Tagline','trizzy' ),
        'section'  => 'title_tagline',
        'type'     => 'select',
        'choices'    => array(
            'hide' => 'Hide',
            'show' => 'Show',
            )
    ));

    $wp_customize->add_setting( 'trizzy_tagline_position', array(
        'default'  => 'below',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_tagline_position',
        ));
    $wp_customize->add_control( 'trizzy_tagline_positioner', array(
        'settings' => 'trizzy_tagline_position',
        'label'    => __( 'Display Tagline below or next to logo','trizzy' ),
        'section'  => 'title_tagline',
        'type'     => 'select',
        'choices'    => array(
            'below' => 'Below',
            'next' => 'Next to logo',
            )
    ));

    if ( $wp_customize->is_preview() && !is_admin() ) {
        add_action( 'wp_footer', 'trizzy_customize_preview', 21);
    }

}
add_action( 'customize_register', 'trizzy_customize_register' );


function sanitize_layout_style( $value ) {
    if ( ! in_array( $value, array( 'boxed', 'fullwidth' ) ) )
        $value = 'boxed';
    return $value;
}

function sanitize_menu_style( $value ) {
    if ( ! in_array( $value, array( 'dark', 'alt' ) ) )
        $value = 'dark';
    return $value;
}

function sanitize_tagline_switch( $value ) {
    if ( ! in_array( $value, array( 'hide', 'show' ) ) )
        $value = 'hide';
    return $value;
}

function sanitize_tagline_position( $value ) {
    if ( ! in_array( $value, array( 'below', 'next' ) ) )
        $value = 'below';
    return $value;
}



function trizzy_customize_preview() { ?>
    <script type="text/javascript">
    ( function( $ ){
        wp.customize('trizzy_main_color',function( value ) {
            value.bind(function(to) {

            $('.skill-bar-value,.counter-box.colored,.pagination .current,.tabs-nav li.active a,.dropcap.full,.highlight.color,.ui-accordion .ui-accordion-header-active,.trigger.active a,.share-buttons ul li:first-child a,#price-range .ui-state-default,.customSelect .selectList dd.hovered').css('background',to);
            $('.top-bar-dropdown ul li a,a.menu-trigger,.pagination ul li a,.pagination-next-prev ul li a,.ui-accordion .ui-accordion-header-active,.trigger.active a,a.caption-btn,.mfp-close,.mfp-arrow,.img-caption figcaption,.selectricItems li,.rsDefault .rsThumbsArrow,.qtyplus,.qtyminus,a.calculate-shipping,.og-close,.tags a').hover(
                function(){
                    var attr = $(this).attr('orgbackground');
                    if (typeof attr == 'undefined' || attr == false) {
                        var orgbg = $(this).css('background');
                    }
                    $(this).attr('orgbackground', orgbg).css('background', to);
                }, function(){
                    var bg = $(this).attr('orgbackground');
                    $(this).css('background', bg);
                });


            $('.cart-buttons a,.menu > li.sfHover .current,input[type="button"],input[type="submit"],a.button,a.button.color,.product-discount,.newsletter-btn,.hover-icon,#filters a.selected,#categories li a.active, .cart-buttons a.checkout,.menu > li.sfHover').css('background-color',to);
            $('.top-search button, .menu > li, li.dropdown ul li a, #jPanelMenu-menu li a, a.button.dark, a.button.gray, .icon-box span, .tp-leftarrow, .tp-rightarrow, .sb-navigation-left, .sb-navigation-right, #categories li a, .flexslider .flex-prev, .flexslider .flex-next, .rsDefault .rsArrowIcn, #filters a').hover(
                function(){
                    var attr = $(this).attr('orgbackground');
                    if (typeof attr == 'undefined' || attr == false) {
                        var orgbg = $(this).css('background-color');
                    }
                    $(this).attr('orgbackground', orgbg).css('background-color', to);
                }, function(){
                    var bg = $(this).attr('orgbackground');
                    $(this).css('background-color', bg);
                });

            $('.happy-clients-author, .mega ul li p a, #not-found i, .dropcap, .list-1.color li:before, .list-2.color li:before, .list-3.color li:before, .list-4.color li:before').css('color',to);
            $('#additional-menu ul li a,.mega a,.comment-by span.reply a,#categories li ul li a,table .cart-title a,.st-val a,.meta a').hover(
            function(){
                var attr = $(this).attr('orgbackground');
                if (typeof attr == 'undefined' || attr == false) {
                    var orgbg = $(this).css('color');
                }
                $(this).attr('orgbackground', orgbg).css('color', to);
            }, function(){
                var bg = $(this).attr('orgbackground');
                $(this).css('color', bg);
            });
        });
    });


    wp.customize('trizzy_menu_bgcolor',function( value ) {
            value.bind(function(to) {
            $('#navigation .menu').css('backgroundColor',to);
        });
    });
    wp.customize('trizzy_menu_currcolor',function( value ) {
            value.bind(function(to) {
            $('#navigation .menu > li.current-menu-parent, #navigation .menu > li.current-menu-ancestor, #navigation .menu > li.current_page_parent, #navigation .menu > li.current-menu-item').css('backgroundColor',to);
        });
    });

    wp.customize('trizzy_tagline_switch',function( value ) {
      value.bind(function(to) {
          if(to === 'hide') { $('#blogdesc').hide(); } else { $('#blogdesc').show(); }
      });
    });
    wp.customize('trizzy_layout_style',function( value ) {
      value.bind(function(to) {
        $("body").removeClass("boxed").removeClass("wide").addClass(to);
      });
    });
    wp.customize('trizzy_menu_style',function( value ) {
      value.bind(function(to) {
        $("#navigation").removeClass("alt").removeClass("standard").addClass(to);
      });
    });

} )( jQuery )
</script>
<?php
}



function pp_generate_typo_css($typo){
    if($typo){
        foreach ($typo as  $key => $value) {
            if(isset($value) && !empty($value)) {
                if($key=='font-color') $key = "color";
                echo $key.":".$value.";";
            }
        }
    }
}
function pp_generate_bg_css($typo){
    if($typo){
        foreach ($typo as  $key => $value) {
            if(isset($value) && !empty($value)) {
                if($key=='background-image') $value = "url('".$value."')";
                echo $key.":".$value.";";
            }
        }
    }
}

function mobile_menu_css(){
    $breakpoint = ot_get_option('pp_menu_breakpoint','767');
    $bodytypo = ot_get_option( 'trizzy_body_font');
    $menutypo = ot_get_option( 'trizzy_menu_font');
    $logotypo = ot_get_option( 'trizzy_logo_font');
    $headerstypo = ot_get_option( 'trizzy_headers_font');

?>
<style type="text/css">

    body { <?php pp_generate_typo_css($bodytypo); ?> }
    h1, h2, h3, h4, h5, h6  { <?php pp_generate_typo_css($headerstypo); ?> }
    #logo h1 a, #logo h2 a { <?php pp_generate_typo_css($logotypo); ?> }
    #navigation .menu > li > a, #navigation ul li a {  <?php pp_generate_typo_css($menutypo); ?>  }
    /* =================================================================== */
    /* Mobile Navigation
    ====================================================================== */
    @media only screen and (max-width: <?php echo $breakpoint; ?>px) {
       .menu{max-height:none}#responsive{display:none}#jPanelMenu-menu{display:block}a.menu-trigger{color:#fff;display:block;font-size:14px;text-transform:uppercase;font-weight:700;float:left;background:#606060;position:relative;width:100%;margin:15px 0 25px;-webkit-transition:all .2s ease-in-out;-moz-transition:all .2s ease-in-out;-o-transition:all .2s ease-in-out;-ms-transition:all .2s ease-in-out;transition:all .2s ease-in-out}a.menu-trigger i{padding:16px 17px;margin:0 10px 0 0;background:rgba(0,0,0,.08);font-size:14px;font-weight:500}a.menu-trigger:hover{background:gray}
    }
    </style>
  <?php
}
add_action('wp_footer', 'mobile_menu_css');


add_action('wp_head', 'custom_stylesheet_content');
function custom_stylesheet_content() {
 $ltopmar = ot_get_option( 'pp_logo_top_margin' );
 $lbotmar = ot_get_option( 'pp_logo_bottom_margin' );
 $taglinemar = ot_get_option( 'pp_tagline_margin' );
?>
    <style type="text/css">
    #logo {
    <?php if ( isset( $ltopmar[0] ) && $ltopmar[1] ) { echo 'margin-top:'.$ltopmar[0].$ltopmar[1].';'; } ?>
    <?php if ( isset( $lbotmar[0] ) && $lbotmar[1] ) { echo 'margin-bottom:'.$lbotmar[0].$lbotmar[1].';'; } ?>
    }
<?php
$custom_main_color = get_theme_mod('trizzy_main_color','#73b819');
$menu_bg_color = get_theme_mod('trizzy_menu_bgcolor','#606060');
$menu_current_color = get_theme_mod('trizzy_menu_currcolor','#505050');
$custom_rgb = trizzyhex2rgb($custom_main_color);
if($custom_rgb) {
  $red = $custom_rgb['red'];
  $green = $custom_rgb['green'];
  $blue = $custom_rgb['blue'];
}
?>
#navigation .menu { background-color: <?php echo $menu_bg_color; ?>; }
 #navigation .menu > li.current-menu-parent,  #navigation .menu > li.current-menu-ancestor,  #navigation .menu > li.current_page_parent,  #navigation .menu > li.current-menu-item { background-color: <?php echo $menu_current_color; ?>; }
.top-bar-dropdown ul li a:hover, .skill-bar-value, .counter-box.colored, a.menu-trigger:hover, .pagination .current, .pagination span.current,
.pagination ul li a:hover, .pagination-next-prev ul li a:hover, .tabs-nav li.active a, body .wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav .ui-tabs-active a,
.dropcap.full, .nav-next:hover, .nav-previous:hover, .highlight.color, .ui-accordion .ui-accordion-header-active:hover, .ui-accordion .ui-accordion-header-active,
.wpb_column > .wpb_wrapper .trigger.active a, .trigger.active a, .trigger.active a:hover, .share-buttons ul li:first-child a, a.caption-btn:hover,
.mfp-close:hover, .mfp-arrow:hover, .img-caption:hover figcaption, #price-range .ui-state-default, .page-numbers.current, .selectricItems li:hover,
.product-categories .img-caption:hover figcaption, .rsDefault .rsThumbsArrow:hover, .customSelect .selectList dd.hovered, .qtyplus:hover,
.qtyminus:hover, a.calculate-shipping:hover, .og-close:hover, .tags a:hover { background: <?php echo $custom_main_color; ?>; }


a.button.wc-forward,.widget_layered_nav ul li:hover,.woo-search-main button:hover, .top-search button:hover, .cart-buttons a, .cart-buttons a.checkout, .menu > li:hover .current, .menu > li.sfHover .current, .menu > li:hover,
.menu > li.sfHover, #navigation.alt .menu > li:hover, #navigation.alt .menu > li.sfHover, #navigation .menu > li:hover, #navigation .menu > li.sfHover,
li.dropdown ul li a:hover, #jPanelMenu-menu .menu-item-has-children:not(.has-megamenu) ol li a:hover , #jPanelMenu-menu li a:hover, li.menu-item-has-children:not(.has-megamenu) ul li a:hover, input[type="button"],
input[type="submit"], a.button, .shipping-calculator-form .button, a.button.color, a.button.checkout.wc-forward, /* .apply-coupon input.button:hover, */
.widget_price_filter .button, .widget_price_filter .ui-state-default, a.button.dark:hover, a.button.gray:hover, .icon-box:hover span, .tp-leftarrow:hover,
.tp-rightarrow:hover, .sb-navigation-left:hover, .sb-navigation-right:hover, #backtotop_trizzy a:hover, .product-discount, #footer .widget .tagcloud a:hover, .tagcloud a:hover,
.onsale, .pagination span.current, .wp-pagenavi .current, .page-numbers.current, span.current, .newsletter-btn, ul.product-categories > li > a:hover, ul.product-categories li a.active,
#categories li a:hover, #categories li a.active, .flexslider .flex-prev:hover, .flexslider .flex-next:hover, .rsDefault .rsArrowIcn:hover,
.quantity input.plus:hover, .quantity input.minus:hover, .hover-icon, .magazine-lead figcaption:hover, .woocommerce-pagination ul li a:hover, #filters a:hover,
.magazine-lead figcaption .button, .nav-links .nav-next a:hover, .nav-links .nav-previous a:hover, .rev_slider_wrapper .tp-leftarrow:hover, .rev_slider_wrapper .tp-rightarrow:hover,
body input[name="update_cart"]:hover, #filters a.selected, .widget.woocommerce ul.product-categories > li.current-cat-parent.has-sublist > a,.widget.trizzy_woocommerce ul.product-categories > li.current-cat-parent.has-sublist > a { background-color: <?php echo $custom_main_color; ?>; }

a, .top-bar-dropdown > span:hover, ul.top-bar-menu > li > a:hover, a.back-to-shop:hover, .happy-clients-author,#additional-menu ul li a:hover, #additional-menu ul li a:hover span, .mega a:hover, #navigation.alt .mega a:hover, #navigation .mega a:hover,
.mega ul li p a, #not-found i, .dropcap, ul.product-categories li ul li a:hover, .widget.woocommerce ul.product-categories li li a:hover, .widget.widget_shopping_cart li a:hover,
.list-1.color li:before, .list-2.color li:before, .list-3.color li:before, .list-4.color li:before, .comment-by span.reply a:hover, .comment-by span.reply a:hover i,
#categories li ul li a:hover span, .widget.woocommerce ul.product-categories li li a:hover span, #categories li ul li a:hover, table .cart-title a:hover, .st-val a:hover,
.widget .widget-tabs li:hover a, .widget .widget-tabs li:hover, .meta a:hover,.widget.woocommerce ul.product-categories > li.current-cat-parent.has-sublist  li.current-cat a { color: <?php echo $custom_main_color; ?>; }

#jPanelMenu-menu a.current { background: <?php echo $custom_main_color; ?> !important; }
body .page-numbers.current { background-color: <?php echo $custom_main_color; ?>; }
blockquote { border-left: 4px solid <?php echo $custom_main_color; ?>; }
.categories li a:hover { color: <?php echo $custom_main_color; ?> !important; }

<?php
$woosearcbg = ot_get_option('pp_shop_search_bg');
$simplebg = ot_get_option('pp_simple_home_bg');
?>
.home-contact {
      <?php pp_generate_bg_css($simplebg) ?>
}
.woo-search {
    <?php pp_generate_bg_css($woosearcbg) ?>
}
<?php echo ot_get_option( 'pp_custom_css' );  ?>

<?php
$catalogmode = ot_get_option('pp_woo_catalog','off');
if ($catalogmode == "on") { ?>
    .product-button,
    .add_to_cart_button,
    #cart { display: none;}

<?php } ?>
</style>
<?php

}   //eof custom_stylesheet_content ?>