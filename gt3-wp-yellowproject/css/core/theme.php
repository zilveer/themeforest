<?php header("Content-type: text/css");
$wp_include = "../../../../wp-load.php";
$i = 0;
while (!file_exists($wp_include) && $i++ < 10) {
    $wp_include = "../$wp_include";
}

require($wp_include);

global $gt3_themeconfig;
if ($gt3_themeconfig['custom_fonts'] == true) {
    if (is_array($gt3_themeconfig['custom_fonts_array'])) {
        foreach ($gt3_themeconfig['custom_fonts_array'] as $id => $font) {
            if ($font['font_file_name']!=="default_font") {
                echo "
                @font-face {
                    font-family: '".$font['font_family']."';
                    src: url('".THEMEROOTURL."/css/fonts/".$font['font_file_name'].".eot');
                    src: url('".THEMEROOTURL."/css/fonts/".$font['font_file_name'].".eot?#iefix') format('embedded-opentype'),
                         url('".THEMEROOTURL."/css/fonts/".$font['font_file_name'].".woff') format('woff'),
                         url('".THEMEROOTURL."/css/fonts/".$font['font_file_name'].".ttf') format('truetype'),
                         url('".THEMEROOTURL."/css/fonts/".$font['font_file_name'].".svg#".$font['svg_id']."') format('svg');
                    font-weight: ".$font['font_weight'].";
                    font-style: ".$font['font_style'].";

                }
                ";
            }
        }
    }
}

if (isset($_COOKIE['color_scheme'])) {
    $themecolor = $_COOKIE['color_scheme'];
} else {
    $themecolor = get_theme_option("color_scheme");
}
$additional_font = get_theme_option("additional_font");

#Fonts & colors
$footer_background_color = get_theme_option("footer_background_color");
$footer_text_color = get_theme_option("footer_text_color");
$content_text_color = get_theme_option("content_text_color");
$text_headers_font = get_theme_option("text_headers_font");
$main_content_font = get_theme_option("main_content_font");

$h1_font_size = get_theme_option("h1_font_size");
$h1_line_height = substr(get_theme_option("h1_font_size"), 0, -2);
$h1_line_height = (int)$h1_line_height+2;$h1_line_height = $h1_line_height."px";

$h2_font_size = get_theme_option("h2_font_size");
$h2_line_height = substr(get_theme_option("h2_font_size"), 0, -2);
$h2_line_height = (int)$h2_line_height+2;$h2_line_height = $h2_line_height."px";

$h3_font_size = get_theme_option("h3_font_size");
$h3_line_height = substr(get_theme_option("h3_font_size"), 0, -2);
$h3_line_height = (int)$h3_line_height+2;$h3_line_height = $h3_line_height."px";

$h4_font_size = get_theme_option("h4_font_size");
$h4_line_height = substr(get_theme_option("h4_font_size"), 0, -2);
$h4_line_height = (int)$h4_line_height+2;$h4_line_height = $h4_line_height."px";

$h5_font_size = get_theme_option("h5_font_size");
$h5_line_height = substr(get_theme_option("h5_font_size"), 0, -2);
$h5_line_height = (int)$h5_line_height+2;$h5_line_height = $h5_line_height."px";

$h6_font_size = get_theme_option("h6_font_size");
$h6_line_height = substr(get_theme_option("h6_font_size"), 0, -2);
$h6_line_height = (int)$h6_line_height+2;$h6_line_height = $h6_line_height."px";

$main_content_font_size = get_theme_option("main_content_font_size");
$main_content_line_height = get_theme_option("main_content_line_height");

?>

/*MainColor: #<?php echo $themecolor; ?>*/

* {
	font-family:<?php echo $main_content_font; ?>;
	font-weight:400;
}

.widget_search input.field_search,
ul.sub-menu li a {
	font-family:<?php echo $main_content_font; ?>!important;
}
p, td, div { 
	font-size:<?php echo $main_content_font_size; ?>; 
	color:#<?php echo $content_text_color; ?>; 
	line-height:<?php echo $main_content_line_height; ?>;
}
.widget_search input.field_search {
	height:auto!important;
}
.shortcode_messagebox,
.price_item_text,
.shortcode_accordion_item_body div, 
.shortcode_toggles_item_body div,
blockquote p,
blockquote span,
.contentarea ol li,
.contentarea ul li,
.widget_archive ul li a, 
.widget_meta ul li a, 
.widget_recent_entries ul li a, 
.widget_categories ul li, 
.widget_pages ul li a,
.widget_categories ul li a,
.widget_search input.field_search,
.blog_info_block span,
.blog_info_block span a,
.popular_posts li .read_more a, .recent_posts li .read_more a,
.popular_posts li .post_date, .recent_posts li .post_date,
.module_postinfo .portfolio_date a, 
.module_postinfo .portfolio_skills a, 
.module_postinfo .portfolio_categ a, 
.module_postinfo .portfolio_url a, 
.module_postinfo .portfolio_tags a, 
.module_postinfo .portfolio_date, 
.module_postinfo .portfolio_skills, 
.module_postinfo .portfolio_categ, 
.module_postinfo .portfolio_url, 
.module_postinfo .portfolio_tags,
.module_postinfo .portfolio_date span, 
.module_postinfo .portfolio_skills span, 
.module_postinfo .portfolio_categ span, 
.module_postinfo .portfolio_url span, 
.module_postinfo .portfolio_tags span,
ol.commentlist li .thiscommentbody .comment_info span,
ol.commentlist li .thiscommentbody .comment_info span a,
footer .footer_wrapper .copyright,
.module_contact_info .continfo_item,
header nav ul.sub-menu li a, 
header nav ul.sub-menu li ul.sub-menu li a {
	font-size:<?php echo $main_content_font_size; ?>!important; 
	line-height:<?php echo $main_content_line_height; ?>!important;
}
.contentarea ul li:before {
	line-height:<?php echo $main_content_line_height; ?>!important;
}

.contentarea ul.list_type1 li:before, 
.contentarea ul.list_type2 li:before, 
.contentarea ul.list_type3 li:before, 
.contentarea ul.list_type4 li:before, 
.contentarea ul.list_type5 li:before, 
.contentarea ul.list_type6 li:before {
	top:50%!important;
    margin-top:-5px!important;
}

.contentarea ul li:before {
	font-size:14px!important;
}
.carousel_title a,
a:hover,
.blog_post_preview .more-link:hover,
.blog_info_block span,
.blog_info_block span a:hover,
.pagerblock li a.current,
.pagerblock li a:hover,
ol.commentlist li .thiscommentbody .comment_info,
ol.commentlist li .thiscommentbody .comment_info span,
ol.commentlist li .thiscommentbody .comment_info span a:hover,
form.comment-form p,
.btn_back:hover,
.popular_posts li .read_more a:hover,
.recent_posts li .read_more a:hover,
.popular_posts li a:hover,
.recent_posts li a:hover,
.twitter_list li a:hover,
.widget_nav_menu ul li a,
h1, h2, h3, h4, h5, h6,
h1 span, h2 span, h3 span, h4 span, h5 span, h6 span,
.page_title h1,
.dropcap,
.module_contact_info .continfo_item a:hover,
.feedback_form .field-name,
.feedback_form .field-email,
.feedback_form .field-subject,
.feedback_form .field-message,
#commentform .form_field,
.module_highlighter .highlighter_item a,
.shortcode_iconbox .ico,
.shortcode_iconbox a,
.shortcode_accordion_item_title, 
.shortcode_toggles_item_title,
.shortcode_promoblock h4,
.shortcode_promoblock h1 {
	color:#<?php echo $content_text_color; ?>;
}
li.skill_li,
.shortcode_tab_item_title.active,
.shortcode_messagebox,
.price_item.most_popular .price_item_title h2,
.price_item .price_item_cost h1,
.price_item .price_item_text,
.price_item .price_item_cost h1 span,
.widget_archive ul li a, 
.widget_meta ul li a, 
.widget_recent_entries ul li a, 
.widget_categories ul li, 
.widget_pages ul li a,
.widget_categories ul li a,
.widget_search input.field_search,
.filter_navigation ul li ul li.selected a,
.module_postinfo .portfolio_date span, 
.module_postinfo .portfolio_skills span, 
.module_postinfo .portfolio_categ span, 
.module_postinfo .portfolio_url span, 
.module_postinfo .portfolio_tags span {
	color:#<?php echo $content_text_color; ?>!important;
}

#footer_bar .sidepanel, 
#footer_bar .sidepanel p, 
#footer_bar .sidepanel div, 
#footer_bar .sidepanel span {
	color:#<?php echo $footer_text_color; ?>!important;
}
.pre_footer {
	background-color:#<?php echo $footer_background_color; ?>!important;
}

::selection {background:#<?php echo $themecolor; ?>;}
::-moz-selection {background:#<?php echo $themecolor; ?>;}

header,
footer,
.footer_tools .footer_socials li a,
header nav ul.menu li .menu_marker,
#footer_bar .twitter_list li:before,
.carouselslider .carousel-previous:hover,
.carouselslider .carousel-next:hover,
blockquote.type2:before,
.carouselslider ul .item:hover .smallproflinks a,
.featured_slider .img_block .post_type,
.module_gallery .list-of-images .gallery_item hr,
.module_gallery .list-of-images .gallery_item:hover .post_type,
.price_item .price_item_btn a:hover,
.price_item.most_popular .price_item_btn a:hover,
.price_item.most_popular .price_item_title,
.price_item.most_popular .price_item_btn a,
.shortcode_button.btn_type4,
.shortcode_button.btn_type1:hover,
.btn_back:hover,
.arrowButton .prevArrow:hover,
.arrowButton .nextArrow:hover,
.btn2top,
.diagram_bg .skill_div {
	background-color:#<?php echo $themecolor; ?>;
}

.shortcode_promoblock .promo_button:hover,
.nivo-directionNav a:hover,
#commentform #submit:hover,
.feedback_form .feedback_go:hover,
.portfolio_block .filter_img .post_type,
.portfolio_block .filter_img hr,
.btn_load_more:hover,
.ls-nav-prev:hover,
.ls-nav-next:hover,
.highlighted_colored {
	background-color:#<?php echo $themecolor; ?>!important;
}

.tipsy-inner,
.footer_search .field_search,
#footer_bar .sidebar_header,
#footer_bar .sidepanel a,
.shortcode_iconbox:hover p,
.shortcode_iconbox:hover h4,
.shortcode_iconbox:hover .ico,
ul.list_type0 li:before,
.carouselslider ul li .item:hover .carousel_title h4,
.carouselslider ul li .item:hover .carousel_title h4 a,
.carouselslider ul li .item:hover .exc,
.widget_nav_menu ul li a:hover,
.dropcap.colored,
.shortcode_accordion_item_title:hover,
.shortcode_toggles_item_title:hover,
.module_highlighter .highlighter_item a:hover,
.feedback_form .field-name:focus,
.feedback_form .field-email:focus,
.feedback_form .field-subject:focus,
.feedback_form .field-message:focus,
#commentform .form_field:focus,
.shortcode_tab_item_title:hover,
.module_price_table .price_item:hover .price_item_cost h1,
.module_price_table .price_item:hover .price_item_cost h1 span,
.price_item.most_popular .price_item_cost h1,
.price_item.most_popular .price_item_cost h1 span,
.filter_navigation ul li ul li a:hover,
.columns2 .filter_img .portfolio_dscr .wrap_padding,
.columns3 .filter_img .portfolio_dscr .wrap_padding,
.columns4 .filter_img .portfolio_dscr .wrap_padding,
.contentarea ul li:before,
.contentarea ol li,
.shortcode_iconbox:hover a:hover,
.gallery_descr, .gallery_descr span {
	color:#<?php echo $themecolor; ?>;
}

.widget_archive ul li a:hover,
.widget_meta ul li a:hover,
.widget_recent_entries ul li a:hover,
.widget_categories ul li:hover,
.widget_categories ul li:hover a,
.widget_pages ul li a:hover,
.widget_about .signature,
.widget_nav_menu ul li a:hover,
.widget_categories ul li a:hover,
header nav ul.sub-menu li a:hover,
header nav ul.sub-menu li:hover a,
header nav ul.sub-menu li.current-menu-item a,
header nav ul.sub-menu li:hover ul.sub-menu li:hover a,
header nav ul.sub-menu li:hover ul.sub-menu li.current-menu-item a,
.carouselslider ul li .item:hover .carousel_title h4 a:hover,
.widget_nav_menu ul li.current-menu-item a,
.widget_search input.field_search:focus {
	color:#<?php echo $themecolor; ?>!important;
}

.widget_flickr .flickr_badge_image .flickr_wrapper,
.shortcode_promoblock,
.shortcode_iconbox,
.carouselslider ul li .item,
.widget_nav_menu ul li a,
.shortcode_accordion_item_title,
.shortcode_toggles_item_title,
.blog_info_block,
.pagerblock li a.current,
.pagerblock li a:hover,
ol.commentlist  li .stand_comment,
.feedback_form .field-name,
.feedback_form .field-email,
.feedback_form .field-subject,
.feedback_form .field-message,
#commentform .form_field,
.module_highlighter .highlighter_item a,
hr.colored,
.shortcode_tab_item_title:hover,
.shortcode_tab_item_title.active,
.shortcode_messagebox.box_type2,
.columns2 .filter_img .portfolio_dscr,
.columns3 .filter_img .portfolio_dscr,
.columns4 .filter_img .portfolio_dscr,
.breadcrumbs {
	border-color:#<?php echo $themecolor; ?>!important;
}

.module_price_table .price_item .price_item_wrapper,
.filter_navigation ul li ul li.selected a,
.filter_navigation ul li ul li a:hover,
.widget_archive ul li a,
.widget_meta ul li a,
.widget_recent_entries ul li a,
.widget_categories ul li,
.widget_pages ul li a,
.widget_search input.field_search {
	border-color:#<?php echo $themecolor; ?>;
}


/* Fonts */

.demo_panel .panel_title,
header nav ul.menu li a,
h1, h2, h3, h4, h5, h6,
h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
.shortcode_promoblock .promo_button,
.widget_nav_menu .menu-item a,
.dropcap,
.shortcode_accordion_item_title,
.shortcode_toggles_item_title,
.team_slider ul li .op,
.pagerblock li a,
.feedback_form .field-name,
.feedback_form .field-email,
.feedback_form .field-subject,
.feedback_form .field-message,
#commentform .form_field,
.module_highlighter .highlighter_item a,
.shortcode_tab_item_title,
.shortcode_message_box,
.price_item .price_item_title h2,
.price_item .price_item_btn a,
.price_item.most_popular .price_item_cost h1,
.price_item.most_popular .price_item_cost h1 span,
.shortcode_button,
.filter_navigation ul li ul li a,
.load_more_cont,
.columns2 .filter_img .portfolio_dscr .wrap_padding,
.columns3 .filter_img .portfolio_dscr .wrap_padding,
.columns4 .filter_img .portfolio_dscr .wrap_padding,
btn_back,
.slider_type1 form.subscribe .btn_subscribe,
.gallery_descr .gallery_title {
	font-family:<?php echo $additional_font; ?>, sans-serif;
}

h1, h2, h3, h4, h5, h6,
h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
h1 span, h2 span, h3 span, h4 span, h5 span, h6 span,
.shipping-calculator-button {
	font-family:<?php echo $text_headers_font; ?>, sans-serif;
}

h1 {
	font-size:<?php echo $h1_font_size; ?>;
	line-height:<?php echo $h1_line_height; ?>;
}
h2 { 
	font-size:<?php echo $h2_font_size; ?>;
	line-height:<?php echo $h2_line_height; ?>;
}
h3 { 
	font-size:<?php echo $h3_font_size; ?>;
	line-height:<?php echo $h3_line_height; ?>;
}
h4 { 
	font-size:<?php echo $h4_font_size; ?>;
	line-height:<?php echo $h4_line_height; ?>;
}
h5 { 
	font-size:<?php echo $h5_font_size; ?>;
	line-height:<?php echo $h5_line_height; ?>;
}
h6 { 
	font-size:<?php echo $h6_font_size; ?>;
	line-height:<?php echo $h6_line_height; ?>;
}

/* Custom Options */


/* Woocommerce */

nav.woocommerce-pagination ul.page-numbers li a,
nav.woocommerce-pagination ul.page-numbers li span,
.woocommerce-page a.button, .woocommerce-page button.button,
.woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page #content input.button,
.widget_price_filter .price_slider_amount button,
.widget_product_categories a, .widget_login .pagenav a,
.woocommerce_container h1.product_title,
.woocommerce div.product .woocommerce-tabs ul.tabs li a, .woocommerce #content div.product .woocommerce-tabs ul.tabs li a,
.woocommerce input.button, .woocommerce a.edit,
.widget_layered_nav li {
	font-family:<?php echo $text_headers_font; ?>, sans-serif !important;    
}

#pp_full_res #commentform textarea,
#pp_full_res #commentform #author,
#pp_full_res #commentform #email,
.widget_layered_nav li,
.widget_product_search input,
.widget_product_search input:focus {
	border-left:6px #<?php echo $themecolor; ?> solid !important;    
}

#pp_full_res #commentform textarea:focus,
#pp_full_res #commentform #author:focus,
#pp_full_res #commentform #email:focus,
.widget_layered_nav li:hover, .widget_layered_nav li.chosen,
.widget_layered_nav li:hover a,
.widget_layered_nav li.chosen a,
.widget_layered_nav li.chosen small,
.widget_layered_nav li:hover small {
	color: #<?php echo $themecolor; ?>  !important;
}

@media (min-width: 1025px) {
	.woocommerce_container ul.products li.product:hover h3,
    .woocommerce ul.products li.product:hover h3 {
        color: #<?php echo $themecolor; ?>  !important;
    }
}

#pp_full_res #commentform #submit:hover,
.woocommerce .shop_table.cart input.button:hover {
	background:#<?php echo $themecolor; ?>;
	border-color:#<?php echo $themecolor; ?> !important;
}

#fancybox-close:hover {background-color:#<?php echo $themecolor; ?> !important;
}

nav.woocommerce-pagination ul.page-numbers li a:hover,
nav.woocommerce-pagination ul.page-numbers li span {
	border-bottom: 6px #<?php echo $themecolor; ?> solid !important;
}

.woocommerce .woocommerce_container ul.products li.product,
.woocommerce ul.products li.product {
	border-bottom:6px #<?php echo $themecolor; ?> solid;
}

.woocommerce_container ul.products li.product a.add_to_cart_button,
.woocommerce ul.products li.product a.add_to_cart_button,
.woocommerce_container ul.products li.product a.product_type_external,
.woocommerce ul.products li.product a.product_type_external {
	background-color:#<?php echo $themecolor; ?>;
}

@media (min-width: 1025px) {
    .woocommerce_container ul.products li.product:hover .price ins,
    .woocommerce_container ul.products li.product:hover .price .amount,
    .woocommerce ul.products li.product:hover .price ins,
    .woocommerce ul.products li.product:hover .price .amount {
        color:#<?php echo $themecolor; ?>;
    }
}

.widget_product_categories a:hover, .widget_product_categories li.current-cat a, .widget_login .pagenav a:hover,
.widget_product_search input[type="text"]:focus,
.widget_product_search input[type="search"]:focus {
    color:#<?php echo $themecolor; ?>;
}
.woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page #content input.button:hover {
    background: #<?php echo $themecolor; ?> !important;   
}

.widget_product_categories a, .widget_login .pagenav a {
	border-color: #<?php echo $themecolor; ?> !important;
}

.woocommerce_message, .woocommerce_error, .woocommerce_info,
.woocommerce-message, .woocommerce-error, .woocommerce-info {
	border-left:6px #<?php echo $themecolor; ?> solid;
}

.woocommerce div.product .woocommerce-tabs ul.tabs li:hover, .woocommerce #content div.product .woocommerce-tabs ul.tabs li:hover {
	border-top-color:#<?php echo $themecolor; ?>;
}

.woocommerce div.product .woocommerce-tabs ul.tabs li:hover a, .woocommerce #content div.product .woocommerce-tabs ul.tabs li:hover a,
.woocommerce div.product .woocommerce-tabs ul.tabs li:hover a:hover, .woocommerce #content div.product .woocommerce-tabs ul.tabs li:hover a:hover {
	color:#<?php echo $themecolor; ?>;
}

.woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active {
	border-top-color: #<?php echo $themecolor; ?>;
}

.woocommerce div.product .single_add_to_cart_button:hover {
	background:#<?php echo $themecolor; ?> !important;
	border-color:#<?php echo $themecolor; ?> !important;
}

#tab-reviews input[type="text"],
#tab-reviews textarea {
	border-left:6px #<?php echo $themecolor; ?> solid !important;
}

#tab-reviews input[type="text"]:focus,
#tab-reviews textarea:focus {
	color: #<?php echo $themecolor; ?> !important;
}











