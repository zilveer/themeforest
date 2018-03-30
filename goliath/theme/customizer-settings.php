<?php
echo '<style type="text/css">';

/***** Background *****/
$default = str_replace(array('https:', 'http:'), '', plsh_gs('background_image'));
$mod = get_theme_mod('background_image', $default);
if ( ! empty( $mod ) ) 
{
    generate_css('body', 'background-image', 'background_image', 'url(', ')' );
}
else
{
    echo 'body { background-image: none; }' . "\n";
}

generate_css('body', 'background-color', 'background_color', '#' );
generate_css('body', 'background-repeat', 'background_repeat' );
generate_css('body', 'background-attachment', 'background_attachment' );

//content background color
generate_css('body:after', 'background-color', 'content_background_color', '#' );

//content_box_border_color
generate_css('body:after', 'border-left', 'content_box_border_color', '1px solid #' );
generate_css('body:after', 'border-right', 'content_box_border_color', '1px solid #' );

//content box opacity
generate_css('body:after', 'opacity', 'content_box_opacity');

/***** Fonts *****/
generate_css('body, .form-control', 'font-family', 'general_font', '', ', Arial, sans-serif');

//logo_font
generate_css('.header .logo-text', 'font-family', 'logo_font', '', ', Arial, sans-serif');

//menu_font
generate_css('.menu .nav > .menu-item > a, .default-dropdown', 'font-family', 'menu_font', '', ', Arial, sans-serif');

//content_block_title_font
generate_css('.title-default', 'font-family', 'content_block_title_font', '', ', Arial, sans-serif');


/***** Colors *****/
generate_css('body', 'color', 'regular_text_color', '#');
generate_css('a', 'color', 'regular_link_color', '#');

//border & shadow color
generate_css('.tag-1, .form-control', 'border', 'border_shadow_color', '1px solid #' );
generate_css('.tag-1 s, .form-control', 'border-left', 'border_shadow_color', '1px solid #' );

generate_css('.panel-default, .slider-tabs .items .item, .widget-tabs .items, .blog-block-1 .post-item, .blog-block-2 .post-item', 'border-bottom', 'border_shadow_color', '1px solid #' );
generate_css('.post-1 .overview, .post-1-navbar li a, .post table td, .post table tbody th, .photo-galleries .items, .post table thead th, .widget-content', 'border-bottom', 'border_shadow_color', '1px solid #' );

generate_css('.widget-tabs .post-item, .archives .table td, .post-block-1 .post-item, .post-block-2 .post-item, .post-1 .overview .items .row, .comments ul > li, .goliath_archive .items ul li', 'border-top', 'border_shadow_color', '1px solid #' );
generate_css('.post-1-navbar', 'border-top', 'border_shadow_color', '3px solid #' );

echo '@media only screen and (min-width: 768px) and (max-width: 1320px) {';
generate_css('.post-1-navbar li a', 'border-right', 'border_shadow_color', '1px solid #' );
echo '}';

generate_css('.read-progress, .search-results .gallery-widget:after, .post-1 .overview .items .rating .content span', 'background', 'border_shadow_color', '#' );

generate_css('.title-default', 'box-shadow', 'border_shadow_color', '#', ' 0 -3px 0 inset' );
generate_css('.post-block-1 .slider .thumbs', 'box-shadow', 'border_shadow_color', '0 -3px 0 #', ' inset' );
generate_css('.post-1-navbar', 'box-shadow', 'border_shadow_color', '0 -1px 0 #', ' inset' );
generate_css('.copyright', 'box-shadow', 'border_shadow_color', '#', ' 0 -3px 0 inset' );
generate_css('.gallery-item-open .thumbs', 'box-shadow', 'border_shadow_color', '0 -3px 0 #', ' inset' );

//secondary_border_color
generate_css('.form-control:focus', 'border', 'secondary_border_color', '1px solid #');
generate_css('.pagination a, .pagination span, .back-to-top, .back-to-top:hover', 'border-bottom', 'secondary_border_color', '1px solid #', '!important');

//block_background_color
generate_css('.slider-tabs .items .item, .widget-tabs .items, .post-1 .overview .items, .widget-content', 'background', 'block_background_color', '#' );


//-------TODO - is this in the correct place????
generate_css('.carousel-control.left, .carousel-control.right', 'background', 'block_background_color', '#' );

//form_field_background
generate_css('.button-1.white, .form-control, .post code, .post pre, .pagination a', 'background', 'form_field_background', '#' );

//form_field_text_color
generate_css('.form-control', 'color', 'form_field_text_color', '#' );

//content_block_heading_color
generate_css('.title-default > a:hover, .title-default > a.active, .title-default .view-all:hover:after, .trending .controls a:hover, .trending .controls a.active, .title-default > span.active', 'color', 'content_block_heading_color', '#' );
generate_css('.title-default > a.active', 'box-shadow', 'content_block_heading_color', '#', ' 0 -3px 0 inset' );
generate_css('.title-default > span.active ', 'box-shadow', 'content_block_heading_color', '#', ' 0 -3px 0 inset' );
generate_css('.back-to-top, .btn-default, .show-more-link:hover:after, .carousel-control', 'color', 'content_block_heading_color', '#' );
generate_css('.tag-default, .stars', 'background', 'content_block_heading_color', '#' );
generate_css('.post-image-sharrre', 'background', 'content_block_heading_color', '#' );
generate_css('.trending .hotness', 'color', 'content_block_heading_color', '#' );
generate_css('.woocommerce .products .star-rating, .woocommerce-page .products .star-rating, .woocommerce .star-rating, .woocommerce-page .star-rating, .woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce-page .widget_price_filter .ui-slider .ui-slider-range, .woocommerce .widget_layered_nav_filters ul li a, .woocommerce-page .widget_layered_nav_filters ul li a', 'background-color', 'content_block_heading_color', '#' );
generate_css('.woocommerce ul.products li.product a:hover img, .woocommerce-page ul.products li.product a:hover img, .woocommerce .widget_layered_nav_filters ul li a, .woocommerce-page .widget_layered_nav_filters ul li a ', 'border', 'content_block_heading_color', '1px solid #' );

//footer_heading_color
generate_css('footer .title-default > span.active ', 'color', 'footer_heading_color', '#');
generate_css('footer .title-default > span.active ', 'box-shadow', 'footer_heading_color', '#', ' 0 -3px 0 inset');

//primary_special_color
generate_css('a:hover, .trending .social a:hover, .legend-default a:hover, .tag-default:hover, .more-link:hover:after, .reply-link:hover:after, .title-default .go-back:hover:after', 'color', 'primary_special_color', '#' );
generate_css('.post-1 .post .gallery-widget a:hover, .panel-default .panel-title a, .hotness', 'color', 'primary_special_color', '#' );
generate_css('.header .logo-text h2, .menu .nav li > a:hover, .menu .nav li > a:hover:after, .menu .nav .new-stories.new a, .navbar .dropdown.open > a, .navbar .dropdown.open > a:hover', 'color', 'primary_special_color', '#' );
generate_css('.navbar .dropdown.open .dropdown-toggle:after, .menu .dropdown-menu .items .item a:hover, .menu .dropdown-menu .sorting a:hover, .menu .dropdown-menu .post-block-1 .post-item h2 a:hover', 'color', 'primary_special_color', '#' );
generate_css('.mosaic a:hover, .slider-tabs .post-item-overlay h2 a:hover, .widget-tabs .post-item-overlay .title h2 a:hover, .post-block-1 .post-item-overlay h2 a:hover', 'color', 'primary_special_color', '#' );
generate_css('.post-block-2 .post-item-featured-overlay h2 a:hover, .post-block-2 .post-item-overlay .title h2 a:hover, .post-block-3 .post-item-overlay .title h2 a:hover, .blog-block-1 .post-item-overlay h2 a:hover, .blog-block-2 .post-item-overlay h2 a:hover', 'color', 'primary_special_color', '#' );
generate_css('.post-1 .post p a, .post-1 .post .gallery-widget a:hover, .post-1-navbar li a:hover:after, .post-1-navbar li.active a, .post-1-navbar li.active a:hover:after', 'color', 'primary_special_color', '#' );
generate_css('.post code, .post pre, .about-author .about .social a:hover, .sticky:after, .latest-galleries .gallery-item a:hover, .gallery-item-open .control a:hover, .footer a:hover, .copyright a:hover', 'color', 'primary_special_color', '#' );
generate_css('.more-link, .reply-link, .show-more-link, .carousel-control:hover, .carousel-control:active, .pagination .active a, .pagination span,  .comment-reply-link', 'color', 'primary_special_color', '#', '!important' );
generate_css('.button-1', 'color', 'primary_special_color', '#' );


generate_css('.wpb_tabs .wpb_tabs_nav > li.ui-tabs-active > a,  .wpb_accordion .wpb_accordion_wrapper .ui-accordion-header-active a,  .wpb_toggle.wpb_toggle_title_active, .wpb_tour .wpb_tabs_nav li.ui-tabs-active a', 'color', 'primary_special_color', '#' );
generate_css('.menu .nav .dropdown-menu li.active > a:hover,  .header .logo-text h2 a, .pagination span, #reply-title a, .comment-reply-link:hover:after, .latest-galleries .carousel-control i, .wpcf7 input[type=submit]', 'color', 'primary_special_color', '#' );

generate_css('.back-to-top:hover, .tag-1.active, .tag-1.active:hover span, .carousel-control:hover, .read-progress span, .navbar-wrapper-responsive .bars.open > a, .post-1 .overview .items .rating .content span s', 'background', 'primary_special_color', '#', '!important' );
generate_css('.menu .nav > .active > a, .menu .nav > .active > a:hover, .menu .nav > .active:hover > a, .btn-default:hover, .menu .dropdown-menu .btn-default:hover, .button-1:hover, .button-1.color:hover, .button-1.white:hover', 'background', 'primary_special_color', '#' );

generate_css('.post q, blockquote, .post dl', 'border-left', 'primary_special_color', '3px solid #' );

generate_css('.post-block-1 .slider .thumbs .active, .post-block-1 .slider .thumbs a:hover, .gallery-item-open .thumbs .active, .gallery-item-open .thumbs a:hover', 'box-shadow', 'primary_special_color', '0 -3px 0 #', ' inset' );
generate_css('.menu .container', 'box-shadow', 'primary_special_color', '#', ' 0 3px 0' );
generate_css('.dropdown-menu', 'box-shadow', 'primary_special_color', 'rgba(0, 0, 0, 0.2) 0 3px 0 0, #000 0 -1px 0 inset, #', ' 0 3px 0 inset' );
generate_css('.wpb_tabs .wpb_tabs_nav > li.ui-tabs-active > a', 'box-shadow', 'primary_special_color', '#', ' 0 -3px 0 inset' );

generate_css('.tag-1.active ', 'border', 'primary_special_color', '1px solid #', ' !important' );
generate_css('.navbar-wrapper-responsive .menu .nav .search:after', 'color', 'primary_special_color', '#', ' !important' );

generate_css('.affix .navbar', 'box-shadow', 'primary_special_color', '#', ' 0 -3px 0 inset' );


generate_css('.woocommerce #content input.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-page #content input.button, .woocommerce-page #respond input#submit, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button', 'color', 'primary_special_color', '#' );
generate_css('.woocommerce #content input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce-page #content input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover', 'background-color', 'primary_special_color', '#' );
generate_css('.woocommerce #content input.button.alt:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce-page #content input.button.alt:hover, .woocommerce-page #respond input#submit.alt:hover, .woocommerce-page a.button.alt:hover, .woocommerce-page button.button.alt:hover, .woocommerce-page input.button.alt:hover', 'background-color', 'primary_special_color', '#', '!important' );
generate_css('.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active', 'box-shadow', 'primary_special_color', '#', ' 0 -3px 0 inset' );
generate_css('.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page .cart-collaterals .shipping_calculator h2 a, .woocommerce .addresses .edit, .widget_shopping_cart .total .amount', 'color', 'primary_special_color', '#' );

//secondary special color
generate_css('.back-to-top, .btn-default', 'background', 'secondary_special_color', '#' );
generate_css('.pagination a, .pagination span', 'background', 'secondary_special_color', '#', '!important' );

//Menu bar background
generate_css('.menu .container, .affix .navbar, .menu .dropdown-menu .btn-default', 'background', 'menu_bar_background', '#' );

//Menu bar text color
generate_css('.menu .nav li > a, .menu .dropdown-menu .btn-default', 'color', 'menu_bar_text_color', '#' );

//Menu dropdown background color
generate_css('.constellation .dropdown-menu', 'background', 'menu_dropdown_background', '#' );

//Footer background
generate_css('.footer', 'background', 'footer_background_color', '#' );

//post_overlay_color
generate_css('.blog-block-2 .post-item-overlay, .post-block-1 .post-item-overlay, .post-block-2 .post-item-overlay, .slider-tabs .post-item-overlay, .widget-tabs .post-item-overlay, .blog-block-1 .post-item-overlay, .post-block-3 .post-item-overlay', 'background', 'post_overlay_color', '#' );

//post_overlay_text_color
generate_css('.blog-block-2 .post-item-overlay, .post-block-1 .post-item-overlay, .post-block-2 .post-item-overlay, .slider-tabs .post-item-overlay, .widget-tabs .post-item-overlay, .blog-block-1 .post-item-overlay, .post-block-3 .post-item-overlay', 'color', 'post_overlay_text_color', '#' );
generate_css('.blog-block-2 .post-item-overlay h2 a, .post-block-1 .post-item-overlay h2 a, .post-block-2 .post-item-overlay .title h2 a, .slider-tabs .post-item-overlay h2 a, .widget-tabs .post-item-overlay .title h2 a, .blog-block-1 .post-item-overlay h2 a, .post-block-3 .post-item-overlay .title h2 a, .info-box.success p, .info-box.warning p', 'color', 'post_overlay_text_color', '#' );

echo '</style>';
?>