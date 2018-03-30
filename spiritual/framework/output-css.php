<?php

if (!function_exists('swm_output_styles')) {
    function swm_output_styles() {

$swm_primary_skin = get_theme_mod('swm_primary_skin_color','#da5455');
$swm_secondary_skin = get_theme_mod('swm_secondary_skin_color','#2e2e2e');

$output = '';
$swm_postid = swm_get_id();
$swm_body_bg = array();

$output .= '<style type="text/css" media="all">
';

// =================================== 

// Body font -family,weight,color and size,background color and image

$swm_body_bg['default_body_bg_color'] = get_theme_mod('swm_body_bg_color','#606060');
$swm_body_bg['default_body_bg_image'] = get_theme_mod('swm_body_bg_image');
$swm_body_bg['default_body_bg_repeat'] = get_theme_mod('swm_body_bg_repeat','no-repeat');
$swm_body_bg['default_body_bg_position'] = get_theme_mod('swm_body_bg_position','center-top');
$swm_body_bg['default_body_bg_attachment'] = get_theme_mod('swm_body_bg_attachment','fixed');
$swm_body_bg['default_body_bg_stretch'] = get_theme_mod('swm_body_bg_stretch',0);

if (function_exists('rwmb_meta')) {    

    $swm_body_bg['meta_body_bg_color'] = rwmb_meta('swm_meta_body_bg_color');
    $meta_body_bg_image = rwmb_meta( 'swm_meta_body_bg_image', 'type=thickbox_image' ); 

    if ( $meta_body_bg_image ) {
            foreach ( $meta_body_bg_image as $intro_header_image ) {                                               
            $swm_body_bg['final_meta_body_bg_image'] = "{$intro_header_image['url']}";         
        }
    }

    if ( ! empty($swm_body_bg['final_meta_body_bg_image']) ) {
        $swm_body_bg['default_body_bg_repeat'] = rwmb_meta('swm_meta_body_bg_image_repeat');
        $swm_body_bg['default_body_bg_position'] = rwmb_meta('swm_meta_body_bg_image_position');
        $swm_body_bg['default_body_bg_attachment'] = rwmb_meta('swm_meta_body_bg_image_attachment');
        $swm_body_bg['default_body_bg_stretch'] = rwmb_meta('swm_meta_body_bg_image_stretch');
    }

}

$swm_body_bg['final_body_bg_color'] = empty($swm_body_bg['meta_body_bg_color']) ? $swm_body_bg['default_body_bg_color'] : $swm_body_bg['meta_body_bg_color'];
$swm_body_bg['final_body_bg_image'] = empty($swm_body_bg['final_meta_body_bg_image']) ? $swm_body_bg['default_body_bg_image'] : $swm_body_bg['final_meta_body_bg_image'];

$output .= 'body { '. swm_output_font_family_weight('swm_body_font_family','swm_body_font_weight','swm_body_sf','swm_body_sw');    

$output .= empty( $swm_body_bg['final_body_bg_color'] ) ? "" : 'background-color: ' . $swm_body_bg['final_body_bg_color'] .'; ';
        
        if ($swm_body_bg['final_body_bg_image'] != '') {
            $output .= 'background-image:url(' . $swm_body_bg['final_body_bg_image'] . '); ';
            $output .= 'background-position:' . str_replace( '-', ' ', $swm_body_bg['default_body_bg_position']) . '; ';
            $output .= 'background-repeat: ' . $swm_body_bg['default_body_bg_repeat'] . '; ';
            $output .= 'background-attachment: ' . $swm_body_bg['default_body_bg_attachment'] . '; ';

            if ($swm_body_bg['default_body_bg_stretch']) {
                $output .= 'background-size: cover;';
            }
        } 

$output .= swm_output_font_size_color('swm_body_sc_size','swm_body_sc_color');

$output .= '}
';

// General color

$output .= '.swm_archives_page a,.search-list a,.swm_portfolio_title_section a,.swm_portfolio_title_section,.swm_horizontal_menu li a,a.swm_text_color,.swm_text_color a,a.page-numbers,.pagination_menu a span,.pf_quote p.pf_quote_text a,.swm_breadcrumbs a,.swm_breadcrumbs a i,.swm_breadcrumbs i { color:'. get_theme_mod('swm_body_sc_color','#606060') .' }';

$output .= '.te_venue_map_title,.swm_evt_title,.portfolio_title,.swm_donor_name span.swm_d_name,.swm_dot_heading,.swm_section_title,.swm_fancy_heading { font-family:' . get_theme_mod('swm_headings_font_family') . ' } ';

$output .= '.swm_archives_page a:hover,.search-list a:hover,.icon_url a i.fa-link,a.swm_text_color:hover,.swm_sermons_title h2 a:hover,.swm_cause_title h2 a:hover { color:'.$swm_primary_skin.'}';

$output .= '.swm_horizontal_menu li a.active,.swm_horizontal_menu li.current_page_item a,.swm_highlight_skin_color,.sf-menu ul li,.swm_cause_bar_out,.swm_sermons_item:hover .swm_sermons_date { background:'.$swm_primary_skin.';}';
$output .= '.swm_horizontal_menu li a.active,.swm_horizontal_menu li.current_page_item a { border-color:'.$swm_primary_skin.';}';

$output .= '::selection {color:#fff; background:'.$swm_primary_skin.'; }';
$output .= '::-moz-selection { color:#fff;background:'.$swm_primary_skin.'; }';

$output .= '.swm_text_color a:hover,.swm_portfolio_box .project_title a:hover { color:'.$swm_secondary_skin.'}';

// Main Container

if (function_exists('rwmb_meta')) {

    $swm_main_container_top_padding = '';
    $swm_main_container_bottom_padding = '';

    if ( rwmb_meta('swm_meta_page_content_top_padding') != '' ) {
        $swm_main_container_top_padding = 'padding-top:'.rwmb_meta('swm_meta_page_content_top_padding').';';
    }
    if ( rwmb_meta('swm_meta_page_content_bottom_padding') != '' ) {
        $swm_main_container_bottom_padding = 'padding-bottom:'.rwmb_meta('swm_meta_page_content_bottom_padding').';';
    }
    $output .= '#swm_page_container { '.$swm_main_container_top_padding.' '.$swm_main_container_bottom_padding.'}';
}

// primary secondary colors
$output .= 'a,.primary_color a,.author_title h4 span,.swm_portfolio_title_section a:hover { color: '.$swm_primary_skin.' }';
$output .= 'a:hover,.primary_color a:hover,.icon_url a:hover i.fa-link { color:'.$swm_secondary_skin.'}';

// Headings

$output .= 'h1,h2,h3,h4,h5,h6,.pf_image_caption .img_title {' . swm_output_font_family_weight('swm_headings_font_family','swm_headings_font_weight','swm_headings_sf','swm_headings_sw') . '}';
$output .= 'h1 {' . swm_output_font_size_color('swm_h1_sc_size','swm_h1_sc_color','27px','#222222') . ' }';
$output .= 'h2 {' . swm_output_font_size_color('swm_h2_sc_size','swm_h2_sc_color','24px','#222222') . ' }';
$output .= 'h3 {' . swm_output_font_size_color('swm_h3_sc_size','swm_h3_sc_color','20px','#222222') . ' }';
$output .= 'h4 {' . swm_output_font_size_color('swm_h4_sc_size','swm_h4_sc_color','18px','#222222') . ' }';
$output .= 'h5 {' . swm_output_font_size_color('swm_h5_sc_size','swm_h5_sc_color','16px','#222222') . ' }';
$output .= 'h6 {' . swm_output_font_size_color('swm_h6_sc_size','swm_h6_sc_color','14px','#222222') . ' }';

// logo

if ( get_theme_mod('swm_logo_bg_image') ) {

    $output .= '.swm_logo_section_bg { 
        background-image:url(' . get_theme_mod('swm_logo_bg_image','#2e2e2e') . '); 
        background-repeat:' . get_theme_mod('swm_logo_bg_repeat') . ';
        background-position:' . str_replace( '-', ' ', get_theme_mod('swm_logo_bg_position') ) . ';
        background-attachment:' . get_theme_mod('swm_logo_bg_attachment') . ';';

        if ( get_theme_mod('swm_logo_bg_stretch') ) {
            $output .= 'background-size:cover;';
        }

        $output .= '}';

    $output .= 'span.donate_btn a { color:' . get_theme_mod('swm_donate_button_text','#ffffff') . ';  }';    

}

$output .= '.swm_logo_section_bg { background-color:'. get_theme_mod('swm_logo_bg_color','#2e2e2e') . '; }';
$output .= 'span.donate_btn a:hover { background:'.$swm_primary_skin.';}';

// Search Box

$output .= '.swm_search_box form input.button,.search_section,.search_section.sbox_skin { background: ' . $swm_primary_skin . '; }';
$output .= '.swm_search_box form input.button:hover { background: ' . $swm_secondary_skin . '; }';

// Blog

$output .= '.swm_blog_post .swm_post_title h2 a,.swm_blog_post .swm_post_title h2,.swm_blog_post .swm_post_title h1 a,.swm_blog_post .swm_post_title h1,.swm_blog_grid .swm_post_title h2 a,.swm_blog_grid .swm_post_title h2  {' . swm_output_font_size_color('swm_blog_post_sc_size','swm_blog_post_sc_color','18px','#222222') . ' }';
$output .= '.p_comment_arrow { border-color: transparent ' . $swm_secondary_skin . ' transparent transparent; }';
$output .= '.swm_post_meta ul li a,.page-numbers span.dots {color:'.get_theme_mod('swm_body_sc_color','#606060').';  }';
$output .= 'a.p_continue_reading,.swm_portfolio_text a.p_continue_reading { color:' . $swm_primary_skin . '; }';
$output .= 'a:hover.p_continue_reading,.swm_post_meta ul li a:hover,.sidebar ul.menu > li ul li.current-menu-item > a,.sidebar .widget_nav_menu  ul li.current-menu-item > a,.sidebar .widget_nav_menu  ul li.current-menu-item:before,.sidebar .widget_categories ul li.current-cat > a,.sidebar .widget_categories ul li.current-cat:before,.widget_product_categories ul li.current-cat > a,.widget_product_categories ul li.current-cat:before,.swm_portfolio_text a.p_continue_reading:hover {color:' . $swm_secondary_skin . '; }';

$output .= 'small.swm_pf_icon, .page-numbers.current, .page-numbers.current:hover,.next_prev_pagination a,#sidebar .tagcloud a:hover,.pagination_menu > span,.paginate-com span.current,.paginate-com a:hover,.swm_date_box, .swm_blog_post:hover .swm_post_title,.swm_blog_post:hover .swm_pf_ic,.swm_blog_grid:hover .swm_post_title,.sticky.swm_blog_post .swm_pf_ic {background:' . $swm_primary_skin . ';}';
$output .= '.p_comments,.next_prev_pagination a:hover {background:' . $swm_secondary_skin . ';}';
$output .= 'small.post_arrow_shape { border-top: 20px solid ' . $swm_primary_skin . ';}';
$output .= '.page-numbers.current, .page-numbers.current:hover,#sidebar .tagcloud a:hover,.pagination_menu > span,.paginate-com span.current,.paginate-com a:hover { border-color: '.$swm_primary_skin.';}';

// Top Navigation

$output .= '.swm_top_menu_section { background-color: '.$swm_primary_skin.';  }';

$output .= '.swm_woo_cart_menu a,ul.logo_section_list li a { ' . swm_output_font_size_color('swm_top_bar_sc_size','swm_top_bar_sc_color') . ' }';

$output .= 'ul.top_nav > li > a  {' . swm_output_font_size_color('swm_top_nav_sc_size','swm_top_nav_sc_color') . ' }';
$output .= 'ul.top_nav > li > a  {' . swm_output_font_family_weight('swm_top_nav_font_family','swm_top_nav_font_weight','swm_top_nav_sf','swm_top_nav_sw') .'}';


// Header

$output .= '.swm_heading_h1 h1,.swm_heading_h1 h1 a { color:' . swm_output_page_element_color('swm_page_title_sc_color','#ffffff','swm_meta_page_title_color') . '; font-size:'. get_theme_mod('swm_page_title_sc_size','36px') . '; }';
$output .= '.heading_bg { background-color:' . swm_output_page_element_color('swm_page_title_bg',$swm_primary_skin,'swm_meta_page_title_bg') . '; }';
$output .= '.heading_bg.transparent_bg_opacity { ' .swm_background_opacity('page_title_bg_opacity','swm_meta_page_title_bg_opacity') .' } ';

// Sidebar

$output .= '.sidebar h2,.sidebar h3,.aboutme_widget .person_name {' . swm_output_font_size_color('swm_sidebar_h2_sc_size','swm_sidebar_h2_sc_color','15px','#333333') . ' }';
$output .= '.sidebar a { '.swm_output_font_size_color('swm_body_sc_size','swm_body_sc_color').'; }';
$output .= '.sidebar a:hover,.sidebar ul li a:hover { color:' . $swm_primary_skin . ';}';

// Footer

$output .= '.footer h2, .footer h3,.footer .aboutme_widget .person_name {' . swm_output_font_size_color('swm_footer_h2_sc_size','swm_footer_h2_sc_color') . ' }';

$swm_footer_bg_image = get_theme_mod('swm_footer_bg_image');
$swm_footer_bg_color = get_theme_mod('swm_footer_bg_color','#2e2e2e');
$swm_footer_bg_color_two = get_theme_mod('swm_footer_bg_color_two','#191919');
$swm_footer_border_color = get_theme_mod('swm_footer_border_color','#353535');
$swm_footer_text_color = 'color:'.get_theme_mod('swm_footer_text_sc_color','#ffffff').';';
$swm_footer_links_hover_color = get_theme_mod('swm_footer_links_hover_color','#da5455');

$swm_footer_bg_color_final = empty( $swm_footer_bg_color ) ? "transparent" : $swm_footer_bg_color;           
$swm_footer_bg_image_final = empty( $swm_footer_bg_image ) ? "" : "url(". $swm_footer_bg_image .") " .get_theme_mod('swm_footer_bg_repeat'). " " .str_replace( '-', ' ', get_theme_mod('swm_footer_bg_position','center-top'));

$output .= '.swm_footer_bg { background:'.$swm_footer_bg_color_final.' '.$swm_footer_bg_image_final.'; }';

$output .= '.small_footer ul li a,.small_footer p {' . swm_output_font_size_color('swm_small_footer_sc_size','swm_small_footer_sc_color') . ' }';

$output .= '.small_footer { background:' . $swm_primary_skin . ';}';

$output .= '.footer,.footer a,.footer .client_name_position h5,.footer .client_name_position span,.footer .sm_icons ul li a,.footer .sm_icons ul li a:hover,.footer .widget ul li a,.footer .widget.woocommerce ul li a,.footer ul.product_list_widget li ins,.footer ul.product_list_widget li span.amount,.footer .widget_shopping_cart_content span.amount,.footer .widget_layered_nav ul li.chosen a,.footer .widget_layered_nav_filters ul li a  { '.$swm_footer_text_color.' }';

$output .= '.swm_large_footer a:hover,.footer #wp-calendar tbody td a,.footer .tp_recent_tweets ul li a:hover,.footer ul.menu > li ul li.current-menu-item > a,.footer .widget_nav_menu  ul li.current-menu-item a,.footer .widget_nav_menu  ul li.current-menu-item:before,.footer .widget_categories ul li.current-cat > a,.footer .widget_categories ul li.current-cat:before,.footer .widget.woocommerce ul li.current-cat a,.footer .widget.woocommerce ul li.current-cat:before,.footer .widget ul li a:hover,.footer .recent_posts_square_posts ul li .grid_date a:hover { color:'.$swm_footer_links_hover_color.'; }';

$output .= '.footer { font-size:'.get_theme_mod('swm_footer_text_sc_size').'; }';
$output .= '.footer #widget_search_form form input[type="text"] { '.$swm_footer_text_color.' text-shadow:none; }';
$output .= '.footer #widget_search_form form input[type="text"]::-webkit-input-placeholder { '.$swm_footer_text_color.' opacity:.5; }';
$output .= '.footer #widget_search_form form input[type="text"]::-moz-placeholder { '.$swm_footer_text_color.' opacity:.5; }';
$output .= '.footer #widget_search_form form input[type="text"]::-ms-placeholder { '.$swm_footer_text_color.' opacity:.5; }';
$output .= '.footer #widget_search_form form input[type="text"]::placeholder { '.$swm_footer_text_color.' opacity:.5; }';
$output .= '.footer #widget_search_form #searchform #s,.footer #widget_search_form #searchform input.button,.footer .aboutme_widget,.footer .aboutme_social,.footer .aboutme_widget .person_img,.footer .widget_product_categories ul li,.footer .widget.woocommerce ul li:first-child,.footer .widget_rss ul li,.footer .uc_events_widget ul li:first-child,.footer .uc_events_widget ul li:last-child,.footer .contact_info_list ul.ci_list li { border-color: '.$swm_footer_border_color.'; }';

$output .= '.footer .widget_meta ul li,.footer .widget_categories ul li,.footer .widget_pages ul li,.footer .widget_archive ul li,.footer .widget_recent_comments ul li,.footer .widget_recent_entries ul li,.footer .widget_nav_menu ul li,.footer .widget_meta ul li:before { border-color: '.$swm_footer_border_color.'; }';
$output .= '.footer .widget_categories ul li:before,.footer .widget_pages ul li:before,.footer .widget_archive ul li:before,.footer .widget_recent_comments ul li:before,.footer .widget_recent_entries ul li:before,.footer .widget_nav_menu ul li:before,.footer .widget.woocommerce ul li:before,.footer .widget_rss ul li:before { color: '.$swm_footer_text_color.'; }';

$output .= '.footer #widget_search_form #searchform input.button { '.$swm_footer_text_color.' }';
$output .= '.footer .input-text,.footer input[type="text"], .footer input[type="input"], .footer input[type="password"], .footer input[type="email"], .footer input[type="number"], .footer input[type="url"], .footer input[type="tel"], .footer input[type="search"], .footer textarea, .footer select,.footer #wp-calendar thead th,.footer #wp-calendar caption,.footer #wp-calendar tbody td,.footer #wp-calendar tbody td:hover { '.$swm_footer_text_color.' border-color: '.$swm_footer_border_color.';}';

$output .= '.footer input[type="text"]:focus, .footer input[type="password"]:focus, .footer input[type="email"]:focus, .footer input[type="number"]:focus, .footer input[type="url"]:focus, .footer input[type="tel"]:focus, .footer input[type="search"]:focus, .footer textarea:focus,footer #widget_search_form #searchform #s:focus { '.$swm_footer_text_color.' border-color: '.get_theme_mod('swm_footer_text_sc_color').';}';

if ( get_theme_mod('swm_scroll_top_arrow',1) == 0 ) {
    $output .= '#go_top_scroll {right:-100px;}';
}

// plugin styles
$output .= '.footer .testimonials-bx-slider .testimonial_box:before { border-color: '.$swm_footer_border_color.' transparent transparent '.$swm_footer_border_color.'; }';
$output .= '.footer .testimonials-bx-slider .testimonial_box:after { border-color: '.$swm_footer_bg_color_two.' transparent transparent '.$swm_footer_bg_color_two.'; }';
$output .= '.footer .testimonial_box { background:'.$swm_footer_bg_color_two.'; border-top: 1px solid '.$swm_footer_border_color.'; } ';
$output .= '.footer select { background:'.$swm_footer_bg_color_two.' url('.get_template_directory_uri() .'/images/select2.png) no-repeat center right;  }';
$output .= '.footer .bx-controls-direction { background:'.$swm_footer_bg_color.' }';
$output .= '.footer .bx-wrapper .bx-controls-direction a,.footer .testimonial_box .fa-quote-left,.footer .recent_posts_tiny p,.footer .tp_recent_tweets ul li:before,.footer .tp_recent_tweets ul li a,.footer .recent_posts_square_posts ul li .grid_date i { '.$swm_footer_text_color.'; }';
$output .= '.footer .testimonial_box,footer .recent_posts_square_posts ul li,.footer .recent_posts_slider_excerpt { border-color:'.$swm_footer_border_color.'; }';
$output .= '.footer .contact_info,.footer .recent_posts_square_date a,.footer .recent_posts_square_date a:hover { border-color:'.$swm_footer_border_color.'; background:'.$swm_footer_bg_color_two.'; }';
$output .= '.footer ul li.cat-item a small,.footer #wp-calendar thead th,.footer #wp-calendar caption,.footer #wp-calendar tbody td,.footer .tagcloud a:hover,.footer .aboutme_social,.footer .tp_recent_tweets ul li:before,.footer .contact_info_list ul.ci_list li:before {  background:'.$swm_footer_bg_color_two.' }';

/*Custom CSS*/

$swm_custom_css = get_theme_mod('swm_custom_css');
if ($swm_custom_css != '') { 
    $output .= $swm_custom_css; 
}

// Portfolio Page

if ( is_page_template( 'templates/portfolio.php' ) ) { 

    $swm_onoff_page_title_section   = get_post_meta($swm_postid, 'swm_onoff_page_title_section', true );
    $swm_pf_title_font_size         = get_post_meta($swm_postid, 'swm_pf_title_font_size', true );
    $swm_pf_title_font_weight         = get_post_meta($swm_postid, 'swm_pf_title_font_weight', true );
    $swm_pf_excerpt_font_size       = get_post_meta($swm_postid, 'swm_pf_excerpt_font_size', true );

    $output .= '.swm_portfolio_box .swm_portfolio_title_section span.portfolio_title { font-size: '.$swm_pf_title_font_size.'px; font-weight:'.$swm_pf_title_font_weight.'; }';
    $output .= '.swm_portfolio_box .swm_portfolio_title_section span.subtexts { font-size: '.$swm_pf_excerpt_font_size.'px;} ';

    if (!$swm_onoff_page_title_section) {
        $output .= '.swm_portfolio_text,.swm-arrow-up.arrow-portfolio { display:none; }';     
    }

    
} // end if portfolio template condition

$output .= '.swm_portfolio_menu li a { color:'. get_theme_mod('swm_body_sc_color','#606060') .' }';
$output .= '.swm_portfolio_menu li a.active,.swm_portfolio_menu li a.active:hover,.swm_portfolio_menu li.current_page_item a { background:'.$swm_primary_skin.';  }';

// ========== Shortcodes Styles ==========

$output .= '.steps_with_circle ol li span,.projects_style1 a,.sm_icons ul li a,.sm_icons ul li a:hover,.recent_posts_square_title a { color:'. get_theme_mod('swm_body_sc_color','#606060') .' }';

$output .= '.skin_color,.special_plan .pricing_title,.special_plan .swm_button,.client_position,.p_bar_skin_color .p_bar_bg,.swm_pagination li a.current,.swm_pagination li a:hover.current,a.swm_button.skin_color, button.swm_button.skin_color,input.swm_button[type="submit"],input[type="submit"], input[type="button"],input[type="reset"], a.button,button.button,#footer a.button,#footer button.button { background:'.$swm_primary_skin.'; }';

$output .= '.footer .offer_icon,.swm_donor_amount { background:'.$swm_primary_skin.';  }';

$output .= '.swm_pagination li a.current,.swm_pagination li a:hover.current, input.swm_button[type="submit"],input[type="submit"],input[type="button"],input[type="reset"],blockquote { border-color:'.$swm_primary_skin.'; }';

$output .= 'input.skin_color:hover,a.skin_color:hover,input[type="submit"]:hover,button[type="submit"]:hover,.sidebar .widget_shopping_cart_content p.buttons a:hover,.swm_woo_cart_hover_menu p.buttons a:hover { border-color:'.$swm_secondary_skin.'; background:'.$swm_secondary_skin.'; opacity:1; }';

$output .= '.recent_posts_full .swm_post_title a:hover,.recent_posts_full p.recent_post_read_more_link a:hover,.recent_posts_full .post_meta span a:hover,.recent_posts_square_content a:hover,.recent_posts_square_posts ul li .grid_date a:hover,.swm_promotion_box .title_text  { color:'.$swm_secondary_skin.'; }';

$output .= '.icon_url a i.fa-link,.recent_post_read_more_link a,blockquote .title_text,blockquote .title_text p,.recent_posts_full p.recent_post_read_more_link a,.footer .bx-wrapper .bx-controls-direction a:hover,.swm-product-price-cart a.button:hover { color:'.$swm_primary_skin.'; }';

$output .= '.swm_special_offer,.swm_tabs ul.tab-nav li a:hover,.swm_tabs ul.tab-nav li.ui-tabs-selected a,.recent_posts_square_date span.d_year,.recent_posts_slider_excerpt span { background:'.$swm_primary_skin.';  }';

$output .= '.toggle_box .ui-state-active,.toggle_box_accordion .ui-state-active,.toggle_box:hover .toggle_box_title,.toggle_box_accordion:hover .toggle_box_title_accordion { background:'.$swm_primary_skin.';  }';

$output .= '.footer .aboutme_widget,.footer a.recent_posts_tiny_icon { background:'.$swm_footer_bg_color_two.';  }';

$output .= '.swm_donor_amount:before,.swm_donor_amount:after {  border-top-color: '.$swm_primary_skin.'; border-bottom-color: '.$swm_primary_skin.'; }';

// WPML Plugin
$output .= '#lang_sel_footer,#wpml_credit_footer { background:' .get_theme_mod('swm_small_footer_bg',$swm_primary_skin). '; border-color:' .get_theme_mod('swm_small_footer_bg',$swm_primary_skin). ';}';
$output .= '#lang_sel_footer ul li,#wpml_credit_footer,#lang_sel_footer ul li a,#wpml_credit_footer a { ' . swm_output_font_size_color('swm_small_footer_sc_size','swm_small_footer_sc_color') . '  } ';

$output .= '.footer .widget #lang_sel_list ul li a { '.$swm_footer_text_color.'   }';
$output .= '.footer .widget #lang_sel_list ul li a:hover { color:'.$swm_footer_links_hover_color.'; }';

$output .= '.footer .widget #lang_sel_click ul li a { background-color:'.$swm_footer_bg_color_two.'; }';
$output .= '.footer .widget #lang_sel_click a, .footer .widget #lang_sel_click a:visited,.footer .recent_work_widget ul li a img { '.$swm_footer_text_color.' border-color:'.$swm_footer_border_color.'; }';
$output .= '.footer .widget #lang_sel_click ul li ul { background:'.$swm_footer_bg_color_two.'; border:1px solid '.$swm_footer_border_color.'; }';

$output .= '.swm_team_members img { border-color:'.$swm_primary_skin.'; }';
$output .= '#lang_sel_footer ul li a { font-size: 11px; }';

// ========== WooCommerce Styles ==========

if ( class_exists('woocommerce') ) {

/*Onsale colors*/

$swm_large_footer_text = '';

$swm_onsale_bg = (get_option('swm_onsale_badge_background') <> '') ? get_option('swm_onsale_badge_background') : '#d75f5f'; 
$swm_onsale_text = (get_option('swm_onsale_badge_font_color') <> '') ? get_option('swm_onsale_badge_font_color') : '#ffffff';

if ($swm_large_footer_text != "") { 
$output .= '#footer ins,#footer .price_slider_amount .price_label { color:'.$swm_large_footer_text['color'].';font-size:'.$swm_large_footer_text['size'].'; }
'; }

$output .= 'span.onsale { background:'.$swm_onsale_bg.'; color:'.$swm_onsale_text.'; }';

$output .= '#reviews #comments ol.commentlist li .meta,.swm-woo-sort-order a { color:'.get_theme_mod('swm_body_sc_color','#606060').'; }';

$output .= 'p.price ins,p.price > span.amount,.single_variation span.price span.amount,table.group_table .price ins,.product_meta > span > a,a.reset_variations,.single_variation span ins,#comments p.noreviews a,table.cart td.product-name a,a.woocommerce-remove-coupon,.order-total span.amount,.woocommerce-info a,.woocommerce-message:before,p.lost_password a,p.form-row.terms a,td.product-name strong.product-quantity,.order_details li strong,td.product-name a,table.shop_table.order_details tfoot tr:last-child td,ul.product_list_widget li ins,ul.product_list_widget li span.amount,.widget_shopping_cart_content span.amount,.widget_layered_nav ul li.chosen a,.widget_layered_nav_filters ul li a,p.stars span a:focus, p.stars span a.active,.star-rating,p.stars span a:hover,.swm-product-details h3 a:hover,.swm-product-details h3 a:hover mark,.swm-featured-product-block.p_category:hover a h3,.swm-featured-product-block.p_category:hover a h3 mark,#reviews #comments ol.commentlist li .comment-text p.meta strong,.swm-featured-product-block span.amount,.swm-featured-product-block a.button.add_to_cart_button:hover { color:'.$swm_primary_skin.'; }';

$output .= '.cart-loading { background-color:'.$swm_primary_skin.'; }';
$output .= 'nav.woocommerce-pagination span,p.demo_store,.woocommerce-pagination a:hover,.swm_woo_next_prev span a:hover,.swm_woo_cart_hover_menu p.buttons a { background: '.$swm_primary_skin.'; }';
$output .= 'nav.woocommerce-pagination span,.swm_woo_next_prev span a:hover,.swm_woo_cart_hover_menu p.buttons a { border-color:'.$swm_primary_skin.'; }';
$output .= '.product .woocommerce-tabs ul.tabs li a:hover,.product .woocommerce-tabs ul.tabs li.active a { background:'.$swm_primary_skin.'; }';




}  // end if class_exists ( woocommerce )

//event calendar
if (function_exists('tribe_is_event')) { 

$output .= 'ul.tribe-events-sub-nav li a:hover,.tribe-events-calendar td.tribe-events-present div[id*="tribe-events-daynum-"],#tribe-bar-form .tribe-bar-filters .tribe-bar-submit input[type=submit],.swm_te_single_title_meta_section span.swm_te_single_title_cost,#tribe-events .tribe-events-button:hover,.tribe-grid-header,.swm_te_single_meta ul li span.event_bar_icon,.tribe-events-meta-group .tribe-events-single-section-title,.swm_event_box:hover .swm_evt_date { background:'.$swm_primary_skin.'; }';

$output .= '#tribe-bar-form .tribe-bar-filters .tribe-bar-submit input[type=submit]:hover { background:'.$swm_secondary_skin.'; }';

$output .= 'h3.tribe-events-month-event-title a:hover,#tribe-events-content .tribe-events-tooltip h4,.tribe-events-list .vevent.hentry h2 a:hover,a.tribe-events-read-more,a.tribe-events-read-more:hover,ul.tribe-bar-views-list li.tribe-bar-active a span,.swm_evt_title a:hover,.swm_event_box:hover .swm_evt_title a,#tribe-events a.tribe-events-ical.tribe-events-button,#tribe-events a.tribe-events-gcal.tribe-events-button { color:'.$swm_primary_skin.'; }';
 
$output .= '.swm-tribe-event-list-meta ul li a:hover,a.tribe-events-read-more,.swm_event_single_meta_row dd.fn.org,#tribe-events a.tribe-events-ical.tribe-events-button:hover,#tribe-events a.tribe-events-gcal.tribe-events-button:hover { color:'.$swm_secondary_skin.'; }';

$output .= '#tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option a,.swm-tribe-event-list-meta ul li a,.tribe-events-day .tribe-events-day-time-slot h5,.swm_event_single_meta_row a,body.events-single ul.tribe-events-sub-nav li a { color:'.get_theme_mod('swm_body_sc_color','#606060').'; }';

$output .= ' #tribe-bar-form .tribe-bar-filters .tribe-bar-submit input[type=submit] { border-color:'.$swm_primary_skin.'; }';
$output .= ' #tribe-bar-form .tribe-bar-filters .tribe-bar-submit input[type=submit]:hover { border-color:'.$swm_secondary_skin.'; }';

$output .= '.footer .tribe-events-list-widget .tribe-events-widget-link a,.footer ol.hfeed.vcalendar li span{ '.$swm_footer_text_color.' }';
 
$output .= '.footer .tribe-events-list-widget .tribe-events-widget-link a:hover,.footer .star-rating { color:'.$swm_footer_links_hover_color.'; }';

 $output .= '.footer ol.hfeed.vcalendar li,.footer .tagcloud a,.footer ul.product_list_widget li,.footer .widget_shopping_cart_content ul li:last-child,.footer ul.product_list_widget li a img { border-color:'.$swm_footer_border_color.'; }';

$output .= '.footer .star-rating:before { color:'.$swm_footer_border_color.'; }';

$output .= '.footer .widget_layered_nav ul small.count { background:'.$swm_footer_bg_color_two.';}';

$output .= '.swm_upcoming_events ul li:nth-child(even) .upcoming_events_square_date.primary,.swm_upcoming_events ul li .upcoming_events_square_date.colorful.primary { background:'.$swm_primary_skin.'; border-color:'.$swm_primary_skin.'; }';
$output .= '.swm_upcoming_events ul li:nth-child(even) .upcoming_events_square_date.secondary,.swm_upcoming_events ul li .upcoming_events_square_date.colorful.secondary { background:'.$swm_secondary_skin.'; border-color:'.$swm_secondary_skin.'; }';

} // end if function exists tribe event 

// Detect Internet Explorer version and apply styles    

//IF IE 9
if (stripos($_SERVER['HTTP_USER_AGENT'], 'MSIE 9')) {
    $output .= '.search_box input { width: 150px; } .about_author { border: 1px solid #e4e4e4; box-shadow: none; } .client_img_link span.icon_url { display:none;  } .testimonial_box:hover .client_img_link span.icon_url { display: block;  } .testimonial_box sub { font-size: 13px; } .star-rating { width: 5.2em !important;} .page-numbers span,.page-numbers a { min-width:20px; padding:4px; }'; 
}

//IF IE 10
if (stripos($_SERVER['HTTP_USER_AGENT'], 'MSIE 10')) {
    $output .= '.search_box input { width: 120px; } .about_author { border: 1px solid #e4e4e4; box-shadow: none; } .client_img_link span.icon_url { display:none;  } .testimonial_box:hover .client_img_link span.icon_url { display: block;  } .testimonial_box sub { font-size: 13px; } .star-rating { width: 5.2em !important;} .p.stars span { width: 102px !important;}';
}

//IF IE 11
if (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false) {        
    $output .= '.client_img_link span.icon_url { display: none; } .swm_testimonials_block:hover .client_img_link span.icon_url { display: block; }';
}

// Responsive

$output .= '@media only screen and (max-width: 979px) { ';
$output .= 'span.donate_btn a:hover { background: none; } span.donate_btn a { color:#222;}';
$output .= '}';

$output .= '@media only screen and (max-width: 767px) { ';
$output .= '.swm_heading_h1 { width:100%; background: #ececec; border-radius:0 0 3px 3px; height:auto; display:block; bottom:0px;  padding:12px 20px; position: relative; }
.swm_heading_h1 h1 a,.swm_heading_h1 h1 { font-size:16px; color:#222; line-height:normal; margin:0; padding:0; }';
$output .= '}';

// Text Color on Skin Color Background

$output .= '.search_section, ul li.footer_menu-setting-msg, .swm_horizontal_menu li a.active, .swm_horizontal_menu li a.active:hover, .swm_horizontal_menu li.current_page_item a, .swm_portfolio_menu li a.active, .swm_portfolio_menu li a.active:hover, .swm_portfolio_menu li.current_page_item a, .page-numbers span, .pagination_menu a span, .pagination_menu span, .paginate-com a, .paginate-com span.current, .page-numbers.current, .paginate-com span.current, .page-numbers.current:hover, .pagination_menu > span, .next_prev_pagination, .swm_container .next_prev_pagination a, .next_prev_pagination a, .swm_pagination li a.current, .swm_pagination li a:hover.current, .woocommerce-pagination span, .swm_woo_next_prev span a:hover:before, .product .woocommerce-tabs ul.tabs li a:hover, .product .woocommerce-tabs ul.tabs li.active a, .sidebar .widget_shopping_cart_content p.buttons a, a.add_to_cart_button, .cart-loading, .sidebar .tagcloud a:hover,.footer .tagcloud a:hover, .p_date a,.swm_container .p_date a, .swm_blog_post:hover .swm_post_title h2 a,.swm_blog_post:hover .swm_post_title h2, .swm_blog_post:hover .swm_post_title h1 a,.swm_blog_post:hover .swm_post_title h1, .swm_blog_grid:hover .swm_post_title h2 a,.swm_blog_grid:hover .swm_post_title h2, .swm_blog_post:hover .swm_post_title,.swm_blog_post:hover .swm_pf_ic, .swm_blog_grid:hover .swm_post_title, .sticky.swm_blog_post .swm_pf_ic, ul.tribe-events-sub-nav li a:hover, body.events-single ul.tribe-events-sub-nav li a:hover, #tribe-bar-form .tribe-bar-filters .tribe-bar-submit input[type=submit], .swm_te_single_meta ul li span.event_bar_icon, .tribe-events-meta-group .tribe-events-single-section-title, .swm_event_box:hover .swm_evt_date, .swm_event_box:hover .swm_evt_date_day, .swm_evt_date_year, .recent_posts_square_date span.d_year, .client_position, .special_plan .pricing_title .title_text, .special_plan .pricing_button a.skin_color, .swm_tabs ul.tab-nav li a:hover, .swm_tabs ul.tab-nav li.ui-tabs-selected a, .toggle_box:hover i,.toggle_box:hover span.title_text, .toggle_box_accordion:hover i, .toggle_box_accordion:hover span.title_text, .toggle_box_accordion .ui-state-active i, .toggle_box_accordion .ui-state-active span.title_text, .toggle_box .ui-state-active span i.openclose, .toggle_box_accordion .ui-state-active span i.openclose, .toggle_box:hover span i.openclose, .toggle_box_accordion:hover span i.openclose, .toggle_box .ui-state-active i, .toggle_box .ui-state-active span.title_text, .swm_dropcap.dark , .swm_special_offer, .swm_container .swm_special_offer a, .swm_container .swm_special_offer a:hover, .footer .offer_icon i, span.donate_btn a:hover, .swm_donor_amount, .skin_color, .special_plan .pricing_title, .p_bar_skin_color .p_bar_bg, a.swm_button.skin_color, .swm_search_box form input[type="submit"].button, .pricing_button a.swm_button, .special_plan .swm_button, button.swm_button.skin_color, input.swm_button[type="submit"], input[type="submit"], input[type="button"], input[type="reset"], a.button,button.button, #footer a.button, #footer button.button ul.tribe-events-sub-nav li a:hover, a.swm_button.skin_color:hover, input.skin_color:hover, a.skin_color:hover, input[type="submit"]:hover, button[type="submit"]:hover, .swm-product-price-cart a.button:hover, .sidebar .widget_shopping_cart_content p.buttons a:hover, .swm_woo_cart_hover_menu p.buttons a:hover, #tribe-bar-form .tribe-bar-filters .tribe-bar-submit input[type=submit]:hover,.swm_sermons_item:hover .swm_sermons_date { color:' . get_theme_mod('swm_text_color_on_skin_color_bg','#ffffff') . '; }';

$output .= 'swm_donor_amount span { border-color:' . get_theme_mod('swm_text_color_on_skin_color_bg','#ffffff') . '; }';

$output .= '.logo_image a img, logo_image img { width:'.get_theme_mod('swm_logo_width','142').'px;}';

// =================================== 

$output .= '</style>
';

echo $output;

}
    add_action('wp_head', 'swm_output_styles');
}

?>