<?php
$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

$id = Mk_Static_Files::shortcode_id();

$atts = array(
    'is_shortcode' => true,
    'id' => $id,
    'toolbar' => 'false', // false as always
    'header_styles' => $style, // only header style 1 or 3 is allowed in header shortcode
    'header_align'  => $align,
    'logo' => $logo,
    'burger_icon' => $burger_icon,
    'woo_cart' => $woo_cart,
    'search_icon' => $search_icon,
    'hover_styles'  => $hover_styles,
    'menu_location'  => $menu_location,
    'is_transparent' => 'false',
    'bg_color'      => $bg_color,
    'border_color'  => $border_color, // top and bottom border color 
    'text_color'    => $text_color,
    'text_hover_skin'  => $text_hover_skin,
    'el_class'  => $el_class . ' js-header-shortcode'
    );

mk_get_header_view('styles', 'header-' . $style, $atts);


Mk_Static_Files::addCSS("
        #mk-header-{$id},
        #mk-header-{$id} .mk-header-bg{
            border-bottom:none !important;
        }
    ", $id);


if(!empty($border_color)) {
    Mk_Static_Files::addCSS("
        #mk-header-{$id}{
            border-top:1px solid {$border_color};
            border-bottom:1px solid {$border_color};
        }
    ", $id);
}

if(!empty($bg_color)) {
    Mk_Static_Files::addCSS("
        #mk-header-{$id} .mk-header-bg {
            background-color:{$bg_color}!important;
        }
    ", $id);   
}

if(!empty($text_color)) {
    Mk_Static_Files::addCSS("
        #mk-header-{$id} .main-navigation-ul > li.menu-item > a.menu-item-link,
        #mk-header-{$id} .mk-search-trigger,
        #mk-header-{$id} .mk-header-cart-count,
        #mk-header-{$id} .mk-header-start-tour
        {
            color: {$text_color};
        }
        #mk-header-{$id} .mk-shoping-cart-link svg,
        #mk-header-{$id} .mk-toolbar-resposnive-icon svg,
        #mk-header-{$id} .mk-header-social svg {
            fill: {$text_color};
        }
        #mk-header-{$id} .mk-css-icon-close div,
        #mk-header-{$id} .mk-css-icon-menu div 
        {
            background-color: {$text_color};
        }
    ", $id);
}

if(!empty($text_hover_skin)) {
    Mk_Static_Files::addCSS("
        #mk-header-{$id} .mk-search-trigger:hover,
        #mk-header-{$id} .mk-header-start-tour:hover
        {
            color: {$text_hover_skin} !important;
        }
        #mk-header-{$id} .main-navigation-ul > li.no-mega-menu ul.sub-menu:after, 
        #mk-header-{$id} .main-navigation-ul > li.has-mega-menu > ul.sub-menu:after
        {
            background-color:{$text_hover_skin} !important;   
        }

    ", $id);
}




if($hover_styles == 1 && !empty($text_hover_skin)) {

    Mk_Static_Files::addCSS("

        #mk-header-{$id} .menu-hover-style-1 .main-navigation-ul li.menu-item > a.menu-item-link:hover,
        #mk-header-{$id} .menu-hover-style-1 .main-navigation-ul li.menu-item:hover > a.menu-item-link,
        #mk-header-{$id} .menu-hover-style-1 .main-navigation-ul li.current-menu-item > a.menu-item-link,
        #mk-header-{$id} .menu-hover-style-1 .main-navigation-ul li.current-menu-ancestor > a.menu-item-link

            color: {$text_hover_skin} !important;
        }

        #mk-header-{$id} .menu-hover-style-1 .main-navigation-ul > li.dropdownOpen > a.menu-item-link,
        #mk-header-{$id} .menu-hover-style-1 .main-navigation-ul > li.active > a.menu-item-link,
        #mk-header-{$id} .menu-hover-style-1 .main-navigation-ul > li.open > a.menu-item-link,
        #mk-header-{$id} .menu-hover-style-1 .main-navigation-ul > li.menu-item > a:hover,
        #mk-header-{$id} .menu-hover-style-1 .main-navigation-ul > li.current-menu-item > a.menu-item-link,
        #mk-header-{$id} .menu-hover-style-1 .main-navigation-ul > li.current-menu-ancestor > a.menu-item-link 
        {
            border-top-color:{$text_hover_skin} !important;
        }

    ", $id);

}



if($hover_styles == 3 && !empty($text_hover_skin)) {

    Mk_Static_Files::addCSS("

        #mk-header-{$id} .menu-hover-style-3 .main-navigation-ul > li.menu-item > a.menu-item-link:hover,
        #mk-header-{$id} .menu-hover-style-3 .main-navigation-ul > li.menu-item:hover > a.menu-item-link
        {
            border:2px solid {$text_hover_skin} !important;
        }

        #mk-header-{$id} .menu-hover-style-3 .main-navigation-ul>li.current-menu-item>a.menu-item-link, 
        #mk-header-{$id} .menu-hover-style-3 .main-navigation-ul>li.current-menu-ancestor>a.menu-item-link
        {
            border:2px solid {$text_hover_skin} !important;
            background-color:{$text_hover_skin} !important;
            color:#fff !important;
        }
    ", $id);


}

if($hover_styles == 4 && !empty($text_hover_skin)) {

    Mk_Static_Files::addCSS("

        #mk-header-{$id} .menu-hover-style-4 .main-navigation-ul li.menu-item > a.menu-item-link:hover,
        #mk-header-{$id} .menu-hover-style-4 .main-navigation-ul li.menu-item:hover > a.menu-item-link,
        #mk-header-{$id} .menu-hover-style-4 .main-navigation-ul li.current-menu-item > a.menu-item-link,
        #mk-header-{$id} .menu-hover-style-4 .main-navigation-ul li.current-menu-ancestor > a.menu-item-link
        {
            background-color: {$text_hover_skin} !important;
        }

    ", $id);

}

if($hover_styles == 5 && !empty($text_hover_skin)) {

    Mk_Static_Files::addCSS("

        #mk-header-{$id} .menu-hover-style-5 .main-navigation-ul > li.menu-item > a.menu-item-link:after
        {
            background-color: {$text_hover_skin} !important;
        }

    ", $id);

}
