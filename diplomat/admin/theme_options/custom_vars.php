<?php
//Website width
$website_width = TMM::get_option('website_width');
$website_width_px = TMM::get_option('website_width_px') ? TMM::get_option('website_width_px') : TMM_OptionsHelper::get_default_value('website_width_px');
$website_width_per = TMM::get_option('website_width_per') ? TMM::get_option('website_width_per') : TMM_OptionsHelper::get_default_value('website_width_per');

// General Logo
$logo_font_size = TMM::get_option('logo_font_size') ? TMM::get_option('logo_font_size') : TMM_OptionsHelper::get_default_value('logo_font_size');
$logo_font = TMM::get_option('logo_font') ? TMM::get_option('logo_font') : TMM_OptionsHelper::get_default_value('logo_font');
$logo_text_color = TMM::get_option('logo_text_color') ? TMM::get_option('logo_text_color') : TMM_OptionsHelper::get_default_value('logo_text_color');
$hlight_logo_text_color1 = (TMM::get_option('use_logo_two_colors')) ? TMM::get_option('hlight_logo_text_color1') : $logo_text_color;
$hlight_logo_text_color2 = TMM::get_option('hlight_logo_text_color2') ? TMM::get_option('hlight_logo_text_color2') : TMM_OptionsHelper::get_default_value('hlight_logo_text_color2');
$hdark_logo_text_color1 = (TMM::get_option('use_logo_two_colors')) ? TMM::get_option('hdark_logo_text_color1') : $logo_text_color;
$hdark_logo_text_color2 = TMM::get_option('hdark_logo_text_color2') ? TMM::get_option('hdark_logo_text_color2') : TMM_OptionsHelper::get_default_value('hdark_logo_text_color2') ;

// RTL Support
$rtl_suport = TMM::get_option('rtl_suport');
$text_direction = ($rtl_suport) ? 'rtl' : 'ltr';
$default_float = ($rtl_suport) ? 'right' : 'left';

// Styling
$general_elements = TMM::get_option('general_elements') ? TMM::get_option('general_elements') : TMM_OptionsHelper::get_default_value('general_elements');
$general_font_family = TMM::get_option('general_font_family') ? TMM::get_option('general_font_family') : TMM_OptionsHelper::get_default_value('general_font_family') ;
$general_font_size = (TMM::get_option('general_font_size')) ? TMM::get_option('general_font_size') : TMM_OptionsHelper::get_default_value('general_font_size');
$general_text_color = TMM::get_option('general_text_color') ? TMM::get_option('general_text_color') : TMM_OptionsHelper::get_default_value('general_text_color') ;
$general_normal_links_color = TMM::get_option('general_normal_links_color') ? TMM::get_option('general_normal_links_color') : TMM_OptionsHelper::get_default_value('general_normal_links_color');

// Styling General Backgrounds

$header_top_bg_color = TMM::get_option('header_top_bg_color') ? TMM::get_option('header_top_bg_color') : TMM_OptionsHelper::get_default_value('header_top_bg_color');
$header_bottom_bg_color = TMM::get_option('header_bottom_bg_color') ? TMM::get_option('header_bottom_bg_color') : TMM_OptionsHelper::get_default_value('header_bottom_bg_color');
$header_bottom_bg_blue_color = TMM::get_option('header_bottom_bg_blue_color') ? TMM::get_option('header_bottom_bg_blue_color') : TMM_OptionsHelper::get_default_value('header_bottom_bg_blue_color');
$body_bg = TMM_Helper::draw_body_bg();
$body_bg = (!empty($body_bg)) ? $body_bg : TMM_OptionsHelper::get_default_value('body_bg_color');
$general_footer_top_bg_color = TMM::get_option('general_footer_top_bg_color') ? TMM::get_option('general_footer_top_bg_color') : TMM_OptionsHelper::get_default_value('general_footer_top_bg_color');
$general_footer_bottom_bg_color = TMM::get_option('general_footer_bottom_bg_color') ? TMM::get_option('general_footer_bottom_bg_color') : TMM_OptionsHelper::get_default_value('general_footer_bottom_bg_color');

// Styling Headings

$h1_font_family = TMM::get_option('h1_font_family') ? TMM::get_option('h1_font_family') : TMM_OptionsHelper::get_default_value('h1_font_family') ;
$h1_font_size = (TMM::get_option('h1_font_size')) ? TMM::get_option('h1_font_size') : TMM_OptionsHelper::get_default_value('h1_font_size');
$h1_font_color = TMM::get_option('h1_font_color') ? TMM::get_option('h1_font_color') : TMM_OptionsHelper::get_default_value('h1_font_color') ;

$h2_font_family = TMM::get_option('h2_font_family') ? TMM::get_option('h2_font_family') : TMM_OptionsHelper::get_default_value('h2_font_family');
$h2_font_size = (TMM::get_option('h2_font_size')) ? TMM::get_option('h2_font_size') : TMM_OptionsHelper::get_default_value('h2_font_size');
$h2_font_color = TMM::get_option('h2_font_color') ? TMM::get_option('h2_font_color') : TMM_OptionsHelper::get_default_value('h2_font_color');

$h3_font_family = TMM::get_option('h3_font_family') ? TMM::get_option('h3_font_family') : TMM_OptionsHelper::get_default_value('h3_font_family');
$h3_font_size = (TMM::get_option('h3_font_size')) ? TMM::get_option('h3_font_size') : TMM_OptionsHelper::get_default_value('h3_font_size');
$h3_font_color = TMM::get_option('h3_font_color') ? TMM::get_option('h3_font_color') : TMM_OptionsHelper::get_default_value('h3_font_color');

$h4_font_family = TMM::get_option('h4_font_family') ? TMM::get_option('h4_font_family') : TMM_OptionsHelper::get_default_value('h4_font_family');
$h4_font_size = (TMM::get_option('h4_font_size')) ? TMM::get_option('h4_font_size') : TMM_OptionsHelper::get_default_value('h4_font_size');
$h4_font_color = TMM::get_option('h4_font_color') ? TMM::get_option('h4_font_color') : TMM_OptionsHelper::get_default_value('h4_font_color');

$h5_font_family = TMM::get_option('h5_font_family') ? TMM::get_option('h5_font_family') : TMM_OptionsHelper::get_default_value('h5_font_family');
$h5_font_size = (TMM::get_option('h5_font_size')) ? TMM::get_option('h5_font_size') : TMM_OptionsHelper::get_default_value('h5_font_size');
$h5_font_color = TMM::get_option('h5_font_color') ? TMM::get_option('h5_font_color') : TMM_OptionsHelper::get_default_value('h5_font_color');

$h6_font_family = TMM::get_option('h6_font_family') ? TMM::get_option('h6_font_family') : TMM_OptionsHelper::get_default_value('h6_font_family');
$h6_font_size = (TMM::get_option('h6_font_size')) ? TMM::get_option('h6_font_size') : TMM_OptionsHelper::get_default_value('h6_font_size');
$h6_font_color = TMM::get_option('h6_font_color') ? TMM::get_option('h6_font_color') : TMM_OptionsHelper::get_default_value('h6_font_color');

// Stling Main Navigation

$main_nav_font = TMM::get_option('main_nav_font') ? TMM::get_option('main_nav_font') : TMM_OptionsHelper::get_default_value('main_nav_font');
$main_nav_first_level_font_size = (TMM::get_option('main_nav_first_level_font_size')) ? TMM::get_option('main_nav_first_level_font_size') : TMM_OptionsHelper::get_default_value('main_nav_first_level_font_size');
$main_nav_second_level_font_size = (TMM::get_option('main_nav_second_level_font_size')) ? TMM::get_option('main_nav_second_level_font_size') : TMM_OptionsHelper::get_default_value('main_nav_second_level_font_size');
$main_nav_def_text_color = TMM::get_option('main_nav_def_text_color') ? TMM::get_option('main_nav_def_text_color') : TMM_OptionsHelper::get_default_value('main_nav_def_text_color');

$main_nav_dd_def_text_color = TMM::get_option('main_nav_dd_def_text_color') ? TMM::get_option('main_nav_dd_def_text_color') : TMM_OptionsHelper::get_default_value('main_nav_dd_def_text_color');
$main_nav_dd_hover_bg_color = TMM::get_option('main_nav_dd_hover_bg_color') ? TMM::get_option('main_nav_dd_hover_bg_color') : TMM_OptionsHelper::get_default_value('main_nav_dd_hover_bg_color');

// Styling Content

$content_normal_link_color = TMM::get_option('content_normal_link_color') ? TMM::get_option('content_normal_link_color') : TMM_OptionsHelper::get_default_value('content_normal_link_color');
$content_mouseover_link_color = TMM::get_option('content_mouseover_link_color') ? TMM::get_option('content_mouseover_link_color') : TMM_OptionsHelper::get_default_value('content_mouseover_link_color');
$donate_buttons_bg = TMM::get_option('donate_buttons_bg') ? TMM::get_option('donate_buttons_bg') : TMM_OptionsHelper::get_default_value('donate_buttons_bg');
$pagination_bg = TMM::get_option('pagination_bg') ? TMM::get_option('pagination_bg') : TMM_OptionsHelper::get_default_value('pagination_bg');
$search_button_color = TMM::get_option('search_button_color') ? TMM::get_option('search_button_color') : TMM_OptionsHelper::get_default_value('search_button_color');

// Styling Buttons

$buttons_font_family = TMM::get_option('buttons_font_family') ? TMM::get_option('buttons_font_family') : TMM_OptionsHelper::get_default_value('buttons_font_family');
$buttons_font_size = (TMM::get_option('buttons_font_size')) ? TMM::get_option('buttons_font_size') : TMM_OptionsHelper::get_default_value('buttons_font_size');
$buttons_text_color = TMM::get_option('buttons_text_color') ? TMM::get_option('buttons_text_color') : TMM_OptionsHelper::get_default_value('buttons_text_color');
$buttons_border_color = TMM::get_option('buttons_border_color') ? TMM::get_option('buttons_border_color') : TMM_OptionsHelper::get_default_value('buttons_border_color');
$buttons_bg_color = TMM::get_option('buttons_bg_color') ? TMM::get_option('buttons_bg_color') : TMM_OptionsHelper::get_default_value('buttons_bg_color');
$buttons_hover_text_color = TMM::get_option('buttons_hover_text_color') ? TMM::get_option('buttons_hover_text_color') : TMM_OptionsHelper::get_default_value('buttons_hover_text_color');
$buttons_hover_border_color = (TMM::get_option('buttons_hover_border_color')) ? TMM::get_option('buttons_hover_border_color') : 'transparent';
$buttons_hover_bg_color = TMM::get_option('buttons_hover_bg_color') ? TMM::get_option('buttons_hover_bg_color') : TMM_OptionsHelper::get_default_value('buttons_hover_bg_color');

// Widgets
$widget_title_color = TMM::get_option('widget_title_color') ? TMM::get_option('widget_title_color') : TMM_OptionsHelper::get_default_value('widget_title_color');
$widget_title_bg_color = TMM::get_option('widget_title_bg_color') ? TMM::get_option('widget_title_bg_color') : TMM_OptionsHelper::get_default_value('widget_title_bg_color');
$widget_text_color = TMM::get_option('widget_text_color') ? TMM::get_option('widget_text_color') : TMM_OptionsHelper::get_default_value('widget_text_color');

$footer_widget_title_color = TMM::get_option('footer_widget_title_color') ? TMM::get_option('footer_widget_title_color') : TMM_OptionsHelper::get_default_value('footer_widget_title_color');
$footer_widget_text_color = TMM::get_option('footer_widget_text_color') ? TMM::get_option('footer_widget_text_color') : TMM_OptionsHelper::get_default_value('footer_widget_text_color');

$featured_event_widget_title_bg_color = TMM::get_option('featured_event_widget_title_bg_color') ? TMM::get_option('featured_event_widget_title_bg_color') : TMM_OptionsHelper::get_default_value('featured_event_widget_title_bg_color');
$featured_event_widget_date_bg_color = TMM::get_option('featured_event_widget_date_bg_color') ? TMM::get_option('featured_event_widget_date_bg_color') : TMM_OptionsHelper::get_default_value('featured_event_widget_date_bg_color');

// DEFINE VALUES
?>

@import "functions";

// Website Width
<?php
    if (TMM::get_option('website_width')=='px'){
        ?>
        $row-width : rem-calc(<?php echo $website_width_px ?>);
        <?php
    }else{
        ?>
        $row-width : <?php echo $website_width_per ?>%;
    <?php
    }
?>

// General Logo

    $logo-font-size: rem-calc(<?php echo $logo_font_size ?>);
    $logo-font-family: "<?php echo $logo_font; ?>";
    $logo-first-part-color: <?php echo $logo_text_color; ?>;
    $logo-first-part-color: <?php echo $hlight_logo_text_color1; ?>;
    $logo-second-part-color: <?php echo $hlight_logo_text_color2; ?>;
    $logo-first-part-color-2: <?php echo $hdark_logo_text_color1; ?>;
    $logo-second-part-color-2: <?php echo $hdark_logo_text_color2; ?>;

//RTL Support

    $text-direction : <?php echo $text_direction ?>;
    $default-float : <?php echo $default_float ?>;

// Styling

	$link-color: <?php echo $general_elements; ?>;
    $widget-sidebar-sheet-hover-color : <?php echo $general_elements; ?>;
    $focus-border-color : rgb(red(<?php echo $general_elements; ?>), green(<?php echo $general_elements; ?>), blue(<?php echo $general_elements; ?>));
    $widget-sidebar-list-color : <?php echo $general_elements; ?>;
    $widget-footer-list-color : <?php echo $general_elements; ?>;
    $widget-sidebar-sheet-hover-color : <?php echo $general_elements; ?>;
    $widget-footer-sheet-hover-color : <?php echo $general_elements; ?>;
    $widget-footer-list-color : <?php echo $general_elements; ?>;
    $info-font-color : <?php echo $general_elements; ?>;
    $font-family-serif: "<?php echo $general_font_family; ?>";
    $base-font-size: <?php echo $general_font_size; ?>px;
    $body-font-color: <?php echo $general_text_color; ?>;

// Styling General Backgrounds

    $header-top-bg: <?php echo $header_top_bg_color ?>;
    $header-middle-bg: <?php echo $header_bottom_bg_color ?>;
    $header-middle-bg-3: <?php echo $header_bottom_bg_blue_color ?>;
    $body-bg: <?php echo $body_bg ?>;
    $footer-top-bg: <?php echo $general_footer_top_bg_color ?>;
    $footer-bottom-bg:<?php echo $general_footer_bottom_bg_color ?>;

// Styling Headings

    $h1-font-family: "<?php echo $h1_font_family ?>";
    $h1-font-color: <?php echo $h1_font_color ?>;
    $h1-font-size: rem-calc(<?php echo $h1_font_size ?>);

    $h2-font-family: "<?php echo $h2_font_family ?>";
    $h2-font-color: <?php echo $h2_font_color ?>;
    $h2-font-size: rem-calc(<?php echo $h2_font_size ?>);

    $h3-font-family: "<?php echo $h3_font_family ?>";
    $h3-font-color: <?php echo $h3_font_color ?>;
    $h3-font-size: rem-calc(<?php echo $h3_font_size ?>);

    $h4-font-family: "<?php echo $h4_font_family ?>";
    $h4-font-color: <?php echo $h4_font_color ?>;
    $h4-font-size: rem-calc(<?php echo $h4_font_size ?>);

    $h5-font-family: "<?php echo $h5_font_family ?>";
    $h5-font-color: <?php echo $h5_font_color ?>;
    $h5-font-size: rem-calc(<?php echo $h5_font_size ?>);

    $h6-font-family: "<?php echo $h6_font_family ?>";
    $h6-font-color: <?php echo $h6_font_color ?>;
    $h6-font-size: rem-calc(<?php echo $h6_font_size ?>);

// Styling Main Navigation

    $header-navigation-font-family: "<?php echo $main_nav_font ?>";
    $header-font-size: rem-calc(<?php echo $main_nav_first_level_font_size ?>);
    $sub-menu-font-size: rem-calc(<?php echo $main_nav_second_level_font_size ?>);
    $header-navigation-font-color: <?php echo $main_nav_def_text_color ?>;

    $sub-menu-font-color: <?php echo $main_nav_dd_def_text_color ?>;
    $sub-menu-hover-bg: <?php echo $main_nav_dd_hover_bg_color ?>;

// Styling Content

    $anchor-font-color: <?php echo $content_normal_link_color ?>;
    $anchor-font-color-hover: <?php echo $content_mouseover_link_color ?>;
    $donate-amount-button-bg-hover-color: <?php echo $donate_buttons_bg ?>;
    $pagination-hover-bg: <?php echo $pagination_bg ?>;
    $search-button-color: <?php echo $search_button_color ?>;

// Styling Buttons

    $button-font-family : "<?php echo $buttons_font_family ?>";
    $button-font-size: rem-calc(<?php echo $buttons_font_size ?>);
    $button-default-font-color: <?php echo $buttons_text_color ?>;
    $button-default-border-color: <?php echo $buttons_border_color ?>;
    $button-default-bg-color : <?php echo $buttons_bg_color ?>;
    $button-default-hover-font-color: <?php echo $buttons_hover_text_color ?>;
    $button-default-hover-border-color: <?php echo $buttons_hover_border_color ?>;
    $button-default-hover-bg-color: <?php echo $buttons_hover_bg_color ?>;

// Widgets

    $widget-sidebar-title-color: <?php echo $widget_title_color; ?>;
    $widget-sidebar-title-bg-color : <?php echo $widget_title_bg_color ?>;
    $widget-sidebar-text-color: <?php echo $widget_text_color ?>;
    $widget-footer-title-color: <?php echo $footer_widget_title_color ?>;
    $widget-footer-text-color: <?php echo $footer_widget_text_color ?>;
    $widget-cat-bg-color: <?php echo $widget_title_bg_color ?>;

// Events

    $event-title-bg: <?php echo $featured_event_widget_title_bg_color; ?>;
    $event-date-bg: <?php echo $featured_event_widget_date_bg_color; ?>;
