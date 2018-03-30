<?php
header("Content-type: text/css; charset: UTF-8");
require_once( '../../../wp-load.php' );

	$body_font = of_get_option('body_font');
    $menu_title_google_font = of_get_option('menu_title_google_font');
    $heading_title_google_font = of_get_option('heading_title_google_font');    
    $title_google_font = of_get_option('title_google_font');
    
echo esc_attr('@import url(http://fonts.googleapis.com/css?family=Oswald:300,400,600,700,800,900,400italic,700italic,900italic);');
$color = of_get_option('theme_color');
$hex = $color;
list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");

$colormenu = of_get_option('main_menubg_color');
if ($colormenu) { ?>
.header_top_wrapper, .tickerfloat_wrapper{background-color: <?php echo esc_attr($colormenu);?> !important;}
<?php }?>
<?php if($title_google_font['face'] == "Open Sans" || $title_google_font['face'] == "Lato"){?>
.feature-post-list .feature-post-title, .box-1 .inside h3{font-weight: bold; font-size: 14px;}
.image-post-title, .caption_overlay_posts a h3, .caption_overlay_posts a, .wrap_box_style_main .image-post-title{font-weight: bold; font-size: 18px; margin-top: -5px;}
ul.tabs li a, ul.tabs1 li a, ul.hover_tab_post_large li a, .grid_header_home .item_slide_caption h1{font-weight: 800;}
.sub-post-image-slider .item_slide_caption h1 a, .menu_post_feature .feature-post-title a{font-weight: bold; font-size: 14px !important;}
.owl_slider .item_slide_caption h1, #ticker a.ticker_title, .single-post-title.heading_post_title, .author-info .author-description h5, #nextpost, #prepost, .review_header span{font-weight: bold;}
.main-post-image-slider .item_slide_caption h1 a, .shortcode_slider h1{line-height: 1.56; letter-spacing: -1px;}
.full-width-slider .item_slide_caption h1 a{ letter-spacing: -1px; padding-bottom: 5px;}
.item_slide_caption .post-meta.meta-main-img{margin-bottom: 2px;}
.categories-title.title, .page-title, .single_post_title{ letter-spacing: -1px;}
.comments-area .comments-title, .comment-respond .comment-reply-title{font-weight: bold; letter-spacing: -1px;}
.pagination-more-grid div a, .pagination-more div a, #pageslide a{font-weight: 800;}
.pagination, .comment-content h1, .comment-content h2, .comment-content h3, .comment-content h4, .comment-content h5, .comment-content h6, .post_content h1, .post_content h2, .post_content h3, .post_content h4, .post_content h5, .post_content h6, .bbp-forum-title{ font-weight: bold;}
<?php }?>
<?php if ($color) { ?>
.grid.caption_header,
#sidebar table thead,
.footer_carousel .link-more:hover,
footer table thead,
.tagcloud a:hover,
.more_button_post,
.tag-cat a:hover,
.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current,
.mejs-controls .mejs-time-rail .mejs-time-current, .pagination .current.box, .pagination > a:hover, .pagination>span:hover, .pagination>span, .score-review span, .review_bar-content, .total_review_bar-content, .btn.default, #go-top a, .meta-category i, .footer_carousel:hover .link-more, .meta-category-slider a, .meta-category-slider i, .score-review-small, .btn.default.read_more:hover, html ul.tabs1 li.active, html ul.tabs1 li.active a, html ul.tabs1 li.active a:hover, html ul.hover_tab_post_large li.active, html ul.hover_tab_post_large li.active a, html ul.hover_tab_post_large li.active a:hover, .pagination-more div a:hover, .pagination-more-grid div a:hover, .tag-cat .tag_title, table thead, #commentform #submit:hover, .wpcf7-submit:hover, .post-password-form input[type="submit"]:hover, .single_post_title .meta-category-small a, .theme_header_style_7 .menu_wrapper, .home_page_fullscreen_slider .personal_slider_meta_category a{background-color: <?php echo esc_attr($color);?> !important;}
.meta-category-small a, .email_subscribe_box .buttons{background-color: <?php echo esc_attr($color);?>; }
.main-post-image-slider .item_slide_caption h1 a, .shortcode_slider h1, .main-post-image-slider .item_slide_caption h1 a, .builder_slider .item_slide_caption h1 a, .full-width-slider .item_slide_caption h1 a{box-shadow: 5px 0 0 <?php echo esc_attr("rgba($r, $g, $b, 0.8)");?>,-5px 0 0 <?php echo esc_attr("rgba($r, $g, $b, 0.8)");?>;background-color: <?php echo esc_attr($color);?>; background-color: <?php echo esc_attr("rgba($r, $g, $b, 0.8)");?>;}
#prepost:hover, #nextpost:hover, #prepost:hover, .btn.default:hover, .footer_carousel:hover .read_more_footer, .tickerfloat i, .btn.default.read_more{color: <?php echo esc_attr($color);?> !important;}
.btn.default:hover, .btn.default.read_more{border:1px solid <?php echo esc_attr($color);?>; background: none !important;}	
ul.tabs, ul.tabs1, ul.hover_tab_post_large, h3.widget-title span{border-top: 2px solid <?php echo esc_attr($color);?>;}
.woocommerce ul.products li.product .star-rating span, .woocommerce ul.products li.product .star-rating span{color: <?php echo esc_attr($color);?>;}	
.woocommerce.widget .ui-slider .ui-slider-handle, .woocommerce .product .onsale{background: none <?php echo esc_attr($color);?>;}
.woocommerce #content nav.woocommerce-pagination ul li a:focus, .woocommerce #content nav.woocommerce-pagination ul li a:hover, .woocommerce #content nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce-page #content nav.woocommerce-pagination ul li a:focus, .woocommerce-page #content nav.woocommerce-pagination ul li a:hover, .woocommerce-page #content nav.woocommerce-pagination ul li span.current, .woocommerce-page nav.woocommerce-pagination ul li a:focus, .woocommerce-page nav.woocommerce-pagination ul li a:hover, .woocommerce-page nav.woocommerce-pagination ul li span.current, .woocommerce #content nav.woocommerce-pagination ul li a, .woocommerce #content nav.woocommerce-pagination ul li span, .woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span, .woocommerce-page #content nav.woocommerce-pagination ul li a, .woocommerce-page #content nav.woocommerce-pagination ul li span, .woocommerce-page nav.woocommerce-pagination ul li a, .woocommerce-page nav.woocommerce-pagination ul li span,
.woocommerce .widget_price_filter .price_slider_amount .button:hover, .woocommerce-page .widget_price_filter .price_slider_amount .button:hover,
.woocommerce #content input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce-page #content input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover, 
.woocommerce #content div.product form.cart .button:hover, .woocommerce div.product form.cart .button:hover, .woocommerce-page #content div.product form.cart .button:hover, .woocommerce-page div.product form.cart .button:hover,
.woocommerce #content input.button.alt:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce-page #content input.button.alt:hover, .woocommerce-page #respond input#submit.alt:hover, .woocommerce-page a.button.alt:hover, .woocommerce-page button.button.alt:hover, .woocommerce-page input.button.alt:hover,
#searchsubmit:hover, .woocommerce-product-search input[type="submit"]:hover, .bbp-login-form .bbp-submit-wrapper .button:hover, #bbp_search_submit:hover, #bbp_topic_submit:hover, .bbp-submit-wrapper .button:hover
{
    background: <?php echo esc_attr($color);?>;
}
.woocommerce #content nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li a, .woocommerce-page #content nav.woocommerce-pagination ul li a, .woocommerce-page nav.woocommerce-pagination ul li a{
    background: #222;
}
.woocommerce a.added_to_cart, .woocommerce-page a.added_to_cart{ color: <?php echo esc_attr($color);?>;}

.widget-title, h3.widget-title{border-bottom: 2px solid <?php echo esc_attr($color);?>;}	
.widget-title h2, h3.widget-title span, .carousel_post_home_wrapper .medium-two-columns:hover .image-post-title{background: <?php echo esc_attr($color);?>; color: #fff;}

.post_link_type .overlay_icon.fa{ color: <?php echo esc_attr($color);?>; border:2px solid <?php echo esc_attr($color);?>;}
.post_link_type .link_type, .post_link_type .link_type a{ color: <?php echo esc_attr($color);?>; border:1px solid <?php echo esc_attr($color);?>;}
.post_link_type .overlay_icon.fa:hover, .post_link_type .link_type a:hover{background:<?php echo esc_attr($color);?>;}
.meta_carousel_post, html ul.tabs li.active a{ background:<?php echo esc_attr($color);?>;}
.post_classic_display .large_post_share_icons li a:hover{ background: <?php echo esc_attr($color);?>; border: 1px solid <?php echo esc_attr($color);?>;}
<?php } ?>
.menu_post_feature ul.hover_tab_post_large li.active a, .menu_post_feature ul.hover_tab_post_large li.active, html ul.hover_tab_post_large li.active a:hover{ background-color: #2C3242 !important;}
<?php if(of_get_option('theme_link_color')){?>
.post_content a, .page.type-page a{ color: <?php echo esc_attr(of_get_option('theme_link_color'));?>;}
<?php }?>

<?php if(of_get_option('theme_link_hover_color')){?>
.post_content a:hover, .page.type-page a:hover{ color: <?php echo esc_attr(of_get_option('theme_link_hover_color'));?>;}
<?php }?>

<?php 
if(of_get_option('full_or_boxed_layout')!= 'full_image_option'){
if(of_get_option('background_body_option')!= 'big_image'){
if(of_get_option('background_body_option')== 'pattern'){
echo esc_attr("body{background:url(img/pattern/pattern_use/".of_get_option('background_parttern').".png);}"); 
}elseif(of_get_option('background_body_option')== 'color'){
echo esc_attr("body{background:".of_get_option('background_color').";}"); 
}}}?>

<?php if(of_get_option('builder_color_1')){?>.widget.color-1 .widget-title, .widget .color-1 .widget-title{border-bottom-color: <?php echo esc_attr(of_get_option('builder_color_1'));?> !important;} .widget.color-1 h2, .feature-two-column.color-1 .widget-title h2{background: <?php echo esc_attr(of_get_option('builder_color_1'));?> url(img/border_title.png) no-repeat right !important;}<?php }?>
<?php if(of_get_option('builder_color_2')){?>.widget.color-2 .widget-title, .widget .color-2 .widget-title{border-bottom-color: <?php echo esc_attr(of_get_option('builder_color_2'));?> !important;} .widget.color-2 h2, .feature-two-column.color-2 .widget-title h2{background: <?php echo esc_attr(of_get_option('builder_color_2'));?> url(img/border_title.png) no-repeat right !important;}<?php }?>
<?php if(of_get_option('builder_color_3')){?>.widget.color-3 .widget-title, .widget .color-3 .widget-title{border-bottom-color: <?php echo esc_attr(of_get_option('builder_color_3'));?> !important;} .widget.color-3 h2, .feature-two-column.color-3 .widget-title h2{background: <?php echo esc_attr(of_get_option('builder_color_3'));?> url(img/border_title.png) no-repeat right !important;}<?php }?>
<?php if(of_get_option('builder_color_4')){?>.widget.color-4 .widget-title, .widget .color-4 .widget-title{border-bottom-color: <?php echo esc_attr(of_get_option('builder_color_4'));?> !important;} .widget.color-4 h2, .feature-two-column.color-4 .widget-title h2{background: <?php echo esc_attr(of_get_option('builder_color_4'));?> url(img/border_title.png) no-repeat right!important;}<?php }?>
<?php if(of_get_option('builder_color_5')){?>.widget.color-5 .widget-title, .widget .color-5 .widget-title{border-bottom-color: <?php echo esc_attr(of_get_option('builder_color_5'));?> !important;} .widget.color-5 h2, .feature-two-column.color-5 .widget-title h2{background: <?php echo esc_attr(of_get_option('builder_color_5'));?> url(img/border_title.png) no-repeat right !important;}<?php }?>
<?php if(of_get_option('builder_color_6')){?>.widget.color-6 .widget-title, .widget .color-6 .widget-title{border-bottom-color: <?php echo esc_attr(of_get_option('builder_color_6'));?> !important;} .widget.color-6 h2, .feature-two-column.color-6 .widget-title h2{background: <?php echo esc_attr(of_get_option('builder_color_6'));?> url(img/border_title.png) no-repeat right !important;}<?php }?>
<?php if(of_get_option('builder_color_7')){?>.widget.color-7 .widget-title, .widget .color-7 .widget-title{border-bottom-color: <?php echo esc_attr(of_get_option('builder_color_7'));?> !important;} .widget.color-7 h2, .feature-two-column.color-7 .widget-title h2{background: <?php echo esc_attr(of_get_option('builder_color_7'));?> url(img/border_title.png) no-repeat right !important;}<?php }?>
<?php if(of_get_option('builder_color_8')){?>.widget.color-8 .widget-title, .widget .color-8 .widget-title{border-bottom-color: <?php echo esc_attr(of_get_option('builder_color_8'));?> !important;} .widget.color-8 h2, .feature-two-column.color-8 .widget-title h2{background: <?php echo esc_attr(of_get_option('builder_color_8'));?> url(img/border_title.png) no-repeat right !important;}<?php }?>
<?php if(of_get_option('builder_color_9')){?>.widget.color-9 .widget-title, .widget .color-9 .widget-title{border-bottom-color: <?php echo esc_attr(of_get_option('builder_color_9'));?> !important;} .widget.color-9 h2, .feature-two-column.color-9 .widget-title h2{background: <?php echo esc_attr(of_get_option('builder_color_9'));?> url(img/border_title.png) no-repeat right !important;}<?php }?>
<?php if(of_get_option('builder_color_10')){?>.widget.color-10 .widget-title, .widget .color-10 .widget-title{border-bottom-color: <?php echo esc_attr(of_get_option('builder_color_10'));?> !important;} .widget.color-10 h2, .feature-two-column.color-10 .widget-title h2{background: <?php echo esc_attr(of_get_option('builder_color_10'));?> url(img/border_title.png) no-repeat right !important;}<?php }?>
<?php if(of_get_option('builder_color_11')){?>.widget.color-11 .widget-title, .widget .color-11 .widget-title{border-bottom-color: <?php echo esc_attr(of_get_option('builder_color_11'));?> !important;} .widget.color-11 h2, .feature-two-column.color-11 .widget-title h2{background: <?php echo esc_attr(of_get_option('builder_color_11'));?> url(img/border_title.png) no-repeat right !important;}<?php }?>
<?php if(of_get_option('builder_color_12')){?>.widget.color-12 .widget-title, .widget .color-12 .widget-title{border-bottom-color: <?php echo esc_attr(of_get_option('builder_color_12'));?> !important;} .widget.color-12 h2, .feature-two-column.color-12 .widget-title h2{background: <?php echo esc_attr(of_get_option('builder_color_12'));?> url(img/border_title.png) no-repeat right !important;}<?php }?>
<?php if(of_get_option('builder_color_13')){?>.widget.color-13 .widget-title, .widget .color-13 .widget-title{border-bottom-color: <?php echo esc_attr(of_get_option('builder_color_13'));?> !important;} .widget.color-13 h2, .feature-two-column.color-13 .widget-title h2{background: <?php echo esc_attr(of_get_option('builder_color_13'));?> url(img/border_title.png) no-repeat right !important;}<?php }?>
<?php if(of_get_option('builder_color_14')){?>.widget.color-14 .widget-title, .widget .color-14 .widget-title{border-bottom-color: <?php echo esc_attr(of_get_option('builder_color_14'));?> !important;} .widget.color-14 h2, .feature-two-column.color-14 .widget-title h2{background: <?php echo esc_attr(of_get_option('builder_color_14'));?> url(img/border_title.png) no-repeat right !important;}<?php }?>
<?php if(of_get_option('builder_color_15')){?>.widget.color-15 .widget-title, .widget .color-15 .widget-title{border-bottom-color: <?php echo esc_attr(of_get_option('builder_color_15'));?> !important;} .widget.color-15 h2, .feature-two-column.color-15 .widget-title h2{background: <?php echo esc_attr(of_get_option('builder_color_15'));?> url(img/border_title.png) no-repeat right !important;}<?php }?>
<?php if(of_get_option('builder_color_16')){?>.widget.color-16 .widget-title, .widget .color-16 .widget-title{border-bottom-color: <?php echo esc_attr(of_get_option('builder_color_16'));?> !important;} .widget.color-16 h2, .feature-two-column.color-16 .widget-title h2{background: <?php echo esc_attr(of_get_option('builder_color_16'));?> url(img/border_title.png) no-repeat right !important;}<?php }?>
<?php if(of_get_option('builder_color_17')){?>.widget.color-17 .widget-title, .widget .color-17 .widget-title{border-bottom-color: <?php echo esc_attr(of_get_option('builder_color_17'));?> !important;} .widget.color-17 h2, .feature-two-column.color-17 .widget-title h2{background: <?php echo esc_attr(of_get_option('builder_color_17'));?> url(img/border_title.png) no-repeat right !important;}<?php }?>

<?php if(of_get_option('border_color_1')){?>#mainmenu li.color-1 .hover_tab_post_large, #mainmenu li.current_page_item.color-1 .hover_tab_post_large, #mainmenu li.current-menu-item.color-1 .hover_tab_post_large, #menu a.current .hover_tab_post_large, #mainmenu li.color-1:hover .hover_tab_post_large, #mainmenu li.sfHover.color-1{background-color: <?php echo esc_attr(of_get_option('border_color_1'));?> !important;}<?php }?>
<?php if(of_get_option('border_color_2')){?>#mainmenu li.color-2 .hover_tab_post_large, #mainmenu li.current_page_item.color-2 .hover_tab_post_large, #mainmenu li.current-menu-item.color-2 .hover_tab_post_large, #menu a.current .hover_tab_post_large, #mainmenu li.color-2:hover .hover_tab_post_large, #mainmenu li.sfHover.color-2{background-color: <?php echo esc_attr(of_get_option('border_color_2'));?> !important;}<?php }?>
<?php if(of_get_option('border_color_3')){?>#mainmenu li.color-3 .hover_tab_post_large, #mainmenu li.current_page_item.color-3 .hover_tab_post_large, #mainmenu li.current-menu-item.color-3 .hover_tab_post_large, #menu a.current .hover_tab_post_large, #mainmenu li.color-3:hover .hover_tab_post_large, #mainmenu li.sfHover.color-3{background-color: <?php echo esc_attr(of_get_option('border_color_3'));?> !important;}<?php }?>
<?php if(of_get_option('border_color_4')){?>#mainmenu li.color-4 .hover_tab_post_large, #mainmenu li.current_page_item.color-4 .hover_tab_post_large, #mainmenu li.current-menu-item.color-4 .hover_tab_post_large, #menu a.current .hover_tab_post_large, #mainmenu li.color-4:hover .hover_tab_post_large, #mainmenu li.sfHover.color-4{background-color: <?php echo esc_attr(of_get_option('border_color_4'));?> !important;}<?php }?>
<?php if(of_get_option('border_color_5')){?>#mainmenu li.color-5 .hover_tab_post_large, #mainmenu li.current_page_item.color-5 .hover_tab_post_large, #mainmenu li.current-menu-item.color-5 .hover_tab_post_large, #menu a.current .hover_tab_post_large, #mainmenu li.color-5:hover .hover_tab_post_large, #mainmenu li.sfHover.color-5{background-color: <?php echo esc_attr(of_get_option('border_color_5'));?> !important;}<?php }?>
<?php if(of_get_option('border_color_6')){?>#mainmenu li.color-6 .hover_tab_post_large, #mainmenu li.current_page_item.color-6 .hover_tab_post_large, #mainmenu li.current-menu-item.color-6 .hover_tab_post_large, #menu a.current .hover_tab_post_large, #mainmenu li.color-6:hover .hover_tab_post_large, #mainmenu li.sfHover.color-6{background-color: <?php echo esc_attr(of_get_option('border_color_6'));?> !important;}<?php }?>
<?php if(of_get_option('border_color_7')){?>#mainmenu li.color-7 .hover_tab_post_large, #mainmenu li.current_page_item.color-7 .hover_tab_post_large, #mainmenu li.current-menu-item.color-7 .hover_tab_post_large, #menu a.current .hover_tab_post_large, #mainmenu li.color-7:hover .hover_tab_post_large, #mainmenu li.sfHover.color-7{background-color: <?php echo esc_attr(of_get_option('border_color_7'));?> !important;}<?php }?>
<?php if(of_get_option('border_color_8')){?>#mainmenu li.color-8 .hover_tab_post_large, #mainmenu li.current_page_item.color-8 .hover_tab_post_large, #mainmenu li.current-menu-item.color-8 .hover_tab_post_large, #menu a.current .hover_tab_post_large, #mainmenu li.color-8:hover .hover_tab_post_large, #mainmenu li.sfHover.color-8{background-color: <?php echo esc_attr(of_get_option('border_color_8'));?> !important;}<?php }?>
<?php if(of_get_option('border_color_9')){?>#mainmenu li.color-9 .hover_tab_post_large, #mainmenu li.current_page_item.color-9 .hover_tab_post_large, #mainmenu li.current-menu-item.color-9 .hover_tab_post_large, #menu a.current .hover_tab_post_large, #mainmenu li.color-9:hover .hover_tab_post_large, #mainmenu li.sfHover.color-9{background-color: <?php echo esc_attr(of_get_option('border_color_9'));?> !important;}<?php }?>
<?php if(of_get_option('border_color_10')){?>#mainmenu li.color-10 .hover_tab_post_large, #mainmenu li.current_page_item.color-10 .hover_tab_post_large, #mainmenu li.current-menu-item.color-10 .hover_tab_post_large, #menu a.current .hover_tab_post_large, #mainmenu li.color-10:hover .hover_tab_post_large, #mainmenu li.sfHover.color-10{background-color: <?php echo esc_attr(of_get_option('border_color_10'));?> !important;}<?php }?>

<?php if(of_get_option('border_color_1')){?>#mainmenu li.color-1.current-menu-ancestor > a, #mainmenu li.current_page_item.color-1 > a, #mainmenu li.current-menu-item.color-1 > a, #menu a.current, #mainmenu > li.color-1:hover, #mainmenu li.sfHover.color-1{background-color: <?php echo esc_attr(of_get_option('border_color_1'));?> !important;}<?php }?>
<?php if(of_get_option('border_color_2')){?>#mainmenu li.color-2.current-menu-ancestor > a, #mainmenu li.current_page_item.color-2 > a, #mainmenu li.current-menu-item.color-2 > a, #menu a.current, #mainmenu > li.color-2:hover, #mainmenu li.sfHover.color-2{background-color: <?php echo esc_attr(of_get_option('border_color_2'));?> !important;}<?php }?>
<?php if(of_get_option('border_color_3')){?>#mainmenu li.color-3.current-menu-ancestor > a, #mainmenu li.current_page_item.color-3 > a, #mainmenu li.current-menu-item.color-3 > a, #menu a.current, #mainmenu > li.color-3:hover, #mainmenu li.sfHover.color-3{background-color: <?php echo esc_attr(of_get_option('border_color_3'));?> !important;}<?php }?>
<?php if(of_get_option('border_color_4')){?>#mainmenu li.color-4.current-menu-ancestor > a, #mainmenu li.current_page_item.color-4 > a, #mainmenu li.current-menu-item.color-4 > a, #menu a.current, #mainmenu > li.color-4:hover, #mainmenu li.sfHover.color-4{background-color: <?php echo esc_attr(of_get_option('border_color_4'));?> !important;}<?php }?>
<?php if(of_get_option('border_color_5')){?>#mainmenu li.color-5.current-menu-ancestor > a, #mainmenu li.current_page_item.color-5 > a, #mainmenu li.current-menu-item.color-5 > a, #menu a.current, #mainmenu > li.color-5:hover, #mainmenu li.sfHover.color-5{background-color: <?php echo esc_attr(of_get_option('border_color_5'));?> !important;}<?php }?>
<?php if(of_get_option('border_color_6')){?>#mainmenu li.color-6.current-menu-ancestor > a, #mainmenu li.current_page_item.color-6 > a, #mainmenu li.current-menu-item.color-6 > a, #menu a.current, #mainmenu > li.color-6:hover, #mainmenu li.sfHover.color-6{background-color: <?php echo esc_attr(of_get_option('border_color_6'));?> !important;}<?php }?>
<?php if(of_get_option('border_color_7')){?>#mainmenu li.color-7.current-menu-ancestor > a, #mainmenu li.current_page_item.color-7 > a, #mainmenu li.current-menu-item.color-7 > a, #menu a.current, #mainmenu > li.color-7:hover, #mainmenu li.sfHover.color-7{background-color: <?php echo esc_attr(of_get_option('border_color_7'));?> !important;}<?php }?>
<?php if(of_get_option('border_color_8')){?>#mainmenu li.color-8.current-menu-ancestor > a, #mainmenu li.current_page_item.color-8 > a, #mainmenu li.current-menu-item.color-8 > a, #menu a.current, #mainmenu > li.color-8:hover, #mainmenu li.sfHover.color-8{background-color: <?php echo esc_attr(of_get_option('border_color_8'));?> !important;}<?php }?>
<?php if(of_get_option('border_color_9')){?>#mainmenu li.color-9.current-menu-ancestor > a, #mainmenu li.current_page_item.color-9 > a, #mainmenu li.current-menu-item.color-9 > a, #menu a.current, #mainmenu > li.color-9:hover, #mainmenu li.sfHover.color-9{background-color: <?php echo esc_attr(of_get_option('border_color_9'));?> !important;}<?php }?>
<?php if(of_get_option('border_color_10')){?>#mainmenu li.color-10.current-menu-ancestor > a, #mainmenu li.current_page_item.color-10 > a, #mainmenu li.current-menu-item.color-10 > a, #menu a.current, #mainmenu > li.color-10:hover, #mainmenu li.sfHover.color-10{background-color: <?php echo esc_attr(of_get_option('border_color_10'));?> !important;}<?php }?>

.theme_header_style_3 #mainmenu>li.current-menu-item>a, .theme_header_style_3 #mainmenu>li>a, .theme_header_style_3 #mainmenu>li.current-menu-ancestor>a, .theme_header_style_5 #mainmenu>li.current-menu-item>a, .theme_header_style_5 #mainmenu>li>a, .theme_header_style_5 #mainmenu>li.current-menu-ancestor>a{ background-color: #FFF !important; background: #fff !important; color: #222 !important;}
        
<?php if ($menu_title_google_font['face'] != 'none') {?>
.sf-top-menu li a, #mainmenu li > a{font-family:<?php echo esc_attr($menu_title_google_font['face']);?> !important;}  
<?php }?>

<?php if ($heading_title_google_font['face'] != 'none') {?>
.tickerfloat, .widget-title h2, .email_subscribe_box h2, .widget-title h2, h3.widget-title span{font-family:<?php echo esc_attr($heading_title_google_font['face']);?> !important;}  
<?php }?>

<?php if ($title_google_font['face'] != 'none') {?>
.detailholder.medium h3, #ticker a.ticker_title, .grid.caption_header h3, ul.tabs1 li a, ul.hover_tab_post_large li a, h1, h2, h3, h4, h5, h6, .carousel_title, .postnav a, .pagination-more-grid div a, .pagination-more div a, ul.tabs li a, #pageslide a, .bbp-forum-title{font-family:<?php echo esc_attr($title_google_font['face']);?> !important;}   
<?php }?> 
<?php if ($body_font['face'] != 'none') {?>
body, p, #search_block_top #search_query_top, .tagcloud a, .btn.default.read_more, .widget_meta li, .widget_archive li a, .widget_rss li a, .widget_recent_entries li a, .widget_recent_comments li a, .widget_pages li a, .widget_categories li a, .meta-list-small .post-date, .view_counter_single{font-family:<?php echo esc_attr($body_font['face']);?> !important;}   
.love_this_post_meta a{font-family:<?php echo esc_attr($body_font['face']);?> !important;}
.single_post_title .single_meta_user .author_link, .single_post_title .post-meta span{font-family:<?php echo esc_attr($body_font['face']);?> !important;}
<?php }?>

<?php if(of_get_option('image_hover_disable')){?>
.feature-item:hover img, .feature-post-list .feature-image-link img:hover, .related-posts ul li a img:hover, .slider-large.full-width-slider .home_large_img_slider:hover .feature-link img, .builder_slider .item_slide:hover a.feature-link img, .widget_slider:hover a.feature-link img, .main-post-image-slider:hover a.feature-link img, .sub-post-image-slider:hover img, .feature-post-list .feature-image-link:hover img {
-webkit-transform: none;
-moz-transform: none;
-o-transform: none;
transform: none;
}

<?php }?> 

<?php echo esc_attr(of_get_option('custom_style'));
if ($color) {
?>
@media only screen and (min-width: 768px) and (max-width: 959px) {
ul.tabs, ul.tabs1{background-color: #F4F4F4 !important;}
html ul.tabs li.active, html ul.tabs li.active a, html ul.tabs li.active a:hover, html ul.tabs1 li.active, html ul.tabs1 li.active a, html ul.tabs1 li.active a:hover{ background: <?php echo $color;?> !important;}
}

@media only screen and (max-width:767px) {
ul.tabs, ul.tabs1{background-color: #F4F4F4 !important;}
html ul.tabs li.active, html ul.tabs li.active a, html ul.tabs li.active a:hover, html ul.tabs1 li.active, html ul.tabs1 li.active a, html ul.tabs1 li.active a:hover{ background: <?php echo $color;?> !important;}
}

@media only screen and (min-width:480px) and (max-width:767px) {
ul.tabs, ul.tabs1{background-color: #F4F4F4 !important;}
html ul.tabs li.active, html ul.tabs li.active a, html ul.tabs li.active a:hover, html ul.tabs1 li.active, html ul.tabs1 li.active a, html ul.tabs1 li.active a:hover{ background: <?php echo $color;?> !important;}
}
<?php }?>