/* *****************************
FONTS
***************************** */

<?php
	
$default_font = str_replace('+',' ',ot_get_option('to_general_custom_font','Lato'));
$default_formatting = ot_get_option('to_defaut_formatting_style',array(
	'font-color' => '#555555',
	'font-size' => '15px',
	'font-style' => 'normal',
	'font-weight' => '400',
	'letter-spacing' => '0',
	'line-height' => '24px',
	'text-decoration' => 'none',
	'text-transform' => 'none',
));

?>

body, p, .basilPageContent ul, .basilPageContent ol, .basilPageContent address, button, select, .basilButton, input, textarea {
	font-family:'<?php echo $default_font; ?>', sans-serif;
	font-weight:<?php echo $default_formatting['font-weight']; ?>;
	letter-spacing:<?php echo $default_formatting['letter-spacing']; ?>;
	font-style:<?php echo $default_formatting['font-style']; ?>;
}
body, p, .basilPageContent ul, .basilPageContent ol, .basilPageContent address, .widget_wysija_cont p label, p.wysija-checkbox-label {
	font-size:<?php echo $default_formatting['font-size']; ?>;
	line-height:<?php echo $default_formatting['line-height']; ?>;
	text-decoration:<?php echo $default_formatting['text-decoration']; ?>;
	text-transform:<?php echo $default_formatting['text-transform']; ?>;
}

p, .basilPageContent ul, .basilPageContent ol, .basilPageContent address {
	margin-bottom:15px;
}

<?php
	
$h1_font = str_replace('+',' ',ot_get_option('to_h1_custom_font','Lato'));
$h1_formatting = ot_get_option('to_h1_formatting_style',array(
	'font-color' => '#555555',
	'font-size' => '35px',
	'font-style' => 'normal',
	'font-weight' => '400',
	'letter-spacing' => '0',
	'line-height' => '45px',
	'text-decoration' => 'none',
	'text-transform' => 'none',
));

?>

h1 {
	font-family:'<?php echo $h1_font; ?>', sans-serif;
	font-weight:<?php echo $h1_formatting['font-weight']; ?>;
	letter-spacing:<?php echo $h1_formatting['letter-spacing']; ?>;
	font-style:<?php echo $h1_formatting['font-style']; ?>;
	font-size:<?php echo $h1_formatting['font-size']; ?>;
	line-height:<?php echo $h1_formatting['line-height']; ?>;
	text-decoration:<?php echo $h1_formatting['text-decoration']; ?>;
	text-transform:<?php echo $h1_formatting['text-transform']; ?>;
	margin:0 0 30px;
}

<?php
	
$h2_font = str_replace('+',' ',ot_get_option('to_h2_custom_font','Lato'));
$h2_formatting = ot_get_option('to_h2_formatting_style',array(
	'font-color' => '#555555',
	'font-size' => '25px',
	'font-style' => 'normal',
	'font-weight' => '300',
	'letter-spacing' => '0',
	'line-height' => '35px',
	'text-decoration' => 'none',
	'text-transform' => 'uppercase',
));

?>

h2 {
	font-family:'<?php echo $h2_font; ?>', sans-serif;
	font-weight:<?php echo $h2_formatting['font-weight']; ?>;
	letter-spacing:<?php echo $h2_formatting['letter-spacing']; ?>;
	font-style:<?php echo $h2_formatting['font-style']; ?>;
	font-size:<?php echo $h2_formatting['font-size']; ?>;
	line-height:<?php echo $h2_formatting['line-height']; ?>;
	text-decoration:<?php echo $h2_formatting['text-decoration']; ?>;
	text-transform:<?php echo $h2_formatting['text-transform']; ?>;
	margin:0 0 20px;
}

<?php
	
$h3_font = str_replace('+',' ',ot_get_option('to_h3_custom_font','Lato'));
$h3_formatting = ot_get_option('to_h3_formatting_style',array(
	'font-color' => '#555555',
	'font-size' => '20px',
	'font-style' => 'normal',
	'font-weight' => '400',
	'letter-spacing' => '0',
	'line-height' => '30px',
	'text-decoration' => 'none',
	'text-transform' => 'none',
));

?>

h3 {
	font-family:'<?php echo $h3_font; ?>', sans-serif;
	font-weight:<?php echo $h3_formatting['font-weight']; ?>;
	letter-spacing:<?php echo $h3_formatting['letter-spacing']; ?>;
	font-style:<?php echo $h3_formatting['font-style']; ?>;
	font-size:<?php echo $h3_formatting['font-size']; ?>;
	line-height:<?php echo $h3_formatting['line-height']; ?>;
	text-decoration:<?php echo $h3_formatting['text-decoration']; ?>;
	text-transform:<?php echo $h3_formatting['text-transform']; ?>;
	margin:0 0 20px;
}

<?php
	
$h4_font = str_replace('+',' ',ot_get_option('to_h4_custom_font','Lato'));
$h4_formatting = ot_get_option('to_h4_formatting_style',array(
	'font-color' => '#555555',
	'font-size' => '17px',
	'font-style' => 'normal',
	'font-weight' => '600',
	'letter-spacing' => '0',
	'line-height' => '27px',
	'text-decoration' => 'none',
	'text-transform' => 'none',
));

?>

h4 {
	font-family:'<?php echo $h4_font; ?>', sans-serif;
	font-weight:<?php echo $h4_formatting['font-weight']; ?>;
	letter-spacing:<?php echo $h4_formatting['letter-spacing']; ?>;
	font-style:<?php echo $h4_formatting['font-style']; ?>;
	font-size:<?php echo $h4_formatting['font-size']; ?>;
	line-height:<?php echo $h4_formatting['line-height']; ?>;
	text-decoration:<?php echo $h4_formatting['text-decoration']; ?>;
	text-transform:<?php echo $h4_formatting['text-transform']; ?>;
	margin:0 0 15px;
}

<?php
	
$h5_font = str_replace('+',' ',ot_get_option('to_h5_custom_font','Lato'));
$h5_formatting = ot_get_option('to_h5_formatting_style',array(
	'font-color' => '#555555',
	'font-size' => '13px',
	'font-style' => 'normal',
	'font-weight' => '400',
	'letter-spacing' => '0',
	'line-height' => '18px',
	'text-decoration' => 'none',
	'text-transform' => 'none',
));

?>

h5 {
	font-family:'<?php echo $h5_font; ?>', sans-serif;
	font-weight:<?php echo $h5_formatting['font-weight']; ?>;
	letter-spacing:<?php echo $h5_formatting['letter-spacing']; ?>;
	font-style:<?php echo $h5_formatting['font-style']; ?>;
	font-size:<?php echo $h5_formatting['font-size']; ?>;
	line-height:<?php echo $h5_formatting['line-height']; ?>;
	text-decoration:<?php echo $h5_formatting['text-decoration']; ?>;
	text-transform:<?php echo $h5_formatting['text-transform']; ?>;
	margin:0 0 15px;
}

<?php
	
$h6_font = str_replace('+',' ',ot_get_option('to_h6_custom_font','Lato'));
$h6_formatting = ot_get_option('to_h6_formatting_style',array(
	'font-color' => '#555555',
	'font-size' => '11px',
	'font-style' => 'normal',
	'font-weight' => '400',
	'letter-spacing' => '0',
	'line-height' => '16px',
	'text-decoration' => 'none',
	'text-transform' => 'none',
));

?>

h6 {
	font-family:'<?php echo $h6_font; ?>', sans-serif;
	font-weight:<?php echo $h6_formatting['font-weight']; ?>;
	letter-spacing:<?php echo $h6_formatting['letter-spacing']; ?>;
	font-style:<?php echo $h6_formatting['font-style']; ?>;
	font-size:<?php echo $h6_formatting['font-size']; ?>;
	line-height:<?php echo $h6_formatting['line-height']; ?>;
	text-decoration:<?php echo $h6_formatting['text-decoration']; ?>;
	text-transform:<?php echo $h6_formatting['text-transform']; ?>;
	margin:0 0 15px;
}

.basilPageContent p { color:<?php echo $default_formatting['font-color']; ?>; }
.basilPageContent h1 { color:<?php echo $h1_formatting['font-color']; ?>; }
.basilPageContent h2 { color:<?php echo $h2_formatting['font-color']; ?>; }
.basilPageContent h3 { color:<?php echo $h3_formatting['font-color']; ?>; }
.basilPageContent h4 { color:<?php echo $h4_formatting['font-color']; ?>; }
.basilPageContent h5 { color:<?php echo $h5_formatting['font-color']; ?>; }
.basilPageContent h6 { color:<?php echo $h6_formatting['font-color']; ?>; }

/* *****************************
LAYOUT CUSTOMIZATIONS
***************************** */

<?php

// Header Height
$header_height = ot_get_option('to_header_height','105');

// Boxed Layout?
$layout_style = ot_get_option('to_layout_style','full');
if ($layout_style == 'full'){

	?>
	#basilWrapper { width:100%; margin:0 auto; }
	<?php
	
} else {

	?>.basilSlider.basilSliderTall { width: 1100px; left: 50%; margin-left: -550px; }
	#basilWrapper { width:1100px; margin:30px auto 0; }
	@media screen and (max-width: 1100px){
		#basilWrapper { width:100%; margin:0; }
	}<?php

}

// Boxed Layout Background Settings
$body_bg_color = (isset($theme_options['to_color_body_bg_color']) ? $theme_options['to_color_body_bg_color'] : '#000000' );
$body_bg_image = (isset($theme_options['to_color_body_bg_image']) ? $theme_options['to_color_body_bg_image'] : false );
$body_bg_image_position = (isset($theme_options['to_color_body_bg_position']) ? $theme_options['to_color_body_bg_position'] : 'top center' );
$body_bg_image_repeat = (isset($theme_options['to_color_body_bg_repeat']) ? $theme_options['to_color_body_bg_repeat'] : 'no-repeat' );
$body_bg_image_fixed = (isset($theme_options['to_color_body_bg_fixed']) ? $theme_options['to_color_body_bg_fixed'] : 'scroll' );

// Link Colors
$link_color = (isset($theme_options['to_color_link_color']) ? $theme_options['to_color_link_color'] : '#90CC28');
$link_color_hover = (isset($theme_options['to_color_link_color_hover']) ? $theme_options['to_color_link_color_hover'] : '#555');

// Button Color Options
$button_color_1_bg = (isset($theme_options['to_color_button_color_1_bg']) ? $theme_options['to_color_button_color_1_bg'] : '#90CC28');
$button_color_1_text = (isset($theme_options['to_color_button_color_1_text']) ? $theme_options['to_color_button_color_1_text'] : '#fff');
$button_color_1_bg_hover = (isset($theme_options['to_color_button_color_1_bg_hover']) ? $theme_options['to_color_button_color_1_bg_hover'] : '#000');
$button_color_1_text_hover = (isset($theme_options['to_color_button_color_1_text_hover']) ? $theme_options['to_color_button_color_1_text_hover'] : '#fff');
$button_color_2_bg = (isset($theme_options['to_color_button_color_2_bg']) ? $theme_options['to_color_button_color_2_bg'] : '#90CC28');
$button_color_2_text = (isset($theme_options['to_color_button_color_2_text']) ? $theme_options['to_color_button_color_2_text'] : '#fff');
$button_color_2_bg_hover = (isset($theme_options['to_color_button_color_2_bg_hover']) ? $theme_options['to_color_button_color_2_bg_hover'] : '#000');
$button_color_2_text_hover = (isset($theme_options['to_color_button_color_2_text_hover']) ? $theme_options['to_color_button_color_2_text_hover'] : '#fff');
$button_color_3_bg = (isset($theme_options['to_color_button_color_3_bg']) ? $theme_options['to_color_button_color_3_bg'] : '#90CC28');
$button_color_3_text = (isset($theme_options['to_color_button_color_3_text']) ? $theme_options['to_color_button_color_3_text'] : '#fff');
$button_color_3_bg_hover = (isset($theme_options['to_color_button_color_3_bg_hover']) ? $theme_options['to_color_button_color_3_bg_hover'] : '#000');
$button_color_3_text_hover = (isset($theme_options['to_color_button_color_3_text_hover']) ? $theme_options['to_color_button_color_3_text_hover'] : '#fff');

// Header & Navigation
$header_bg_color = (isset($theme_options['to_color_header_bg_color']) ? $theme_options['to_color_header_bg_color'] : '#fff');
$header_text_color = (isset($theme_options['to_color_header_text_color']) ? $theme_options['to_color_header_text_color'] : '#aaa');
$nav_bg_color = (isset($theme_options['to_color_nav_bg_color']) ? $theme_options['to_color_nav_bg_color'] : '#90CC28');
$nav_link_color = (isset($theme_options['to_color_nav_link_color']) ? $theme_options['to_color_nav_link_color'] : '#fff');
$nav_link_color_text_hover = (isset($theme_options['to_color_nav_link_color_text_hover']) ? $theme_options['to_color_nav_link_color_text_hover'] : '#fff');
$nav_link_color_bg_hover = (isset($theme_options['to_color_nav_link_color_bg_hover']) ? $theme_options['to_color_nav_link_color_bg_hover'] : '#B1DB5E');
$nav_dropdown_bg_color = (isset($theme_options['to_color_nav_dropdown_bg_color']) ? $theme_options['to_color_nav_dropdown_bg_color'] : '#B1DB5E');
$nav_dropdown_link_color = (isset($theme_options['to_color_nav_dropdown_link_color']) ? $theme_options['to_color_nav_dropdown_link_color'] : '#fff');
$nav_dropdown_link_color_text_hover = (isset($theme_options['to_color_nav_dropdown_link_color_text_hover']) ? $theme_options['to_color_nav_dropdown_link_color_text_hover'] : '#888');
$nav_dropdown_link_color_bg_hover = (isset($theme_options['to_color_nav_dropdown_link_color_bg_hover']) ? $theme_options['to_color_nav_dropdown_link_color_bg_hover'] : '#fff');
$nav_text_color = (isset($theme_options['to_color_nav_text_color']) ? $theme_options['to_color_nav_text_color'] : '#e6f5c8');

// Social Icons
$nav_socials_fg = (isset($theme_options['to_color_nav_socials_fg']) ? $theme_options['to_color_nav_socials_fg'] : '#fff');
$nav_socials_bg = (isset($theme_options['to_color_nav_socials_bg']) ? $theme_options['to_color_nav_socials_bg'] : '#B1DB5E');
$nav_socials_fg_hover = (isset($theme_options['to_color_nav_socials_fg_hover']) ? $theme_options['to_color_nav_socials_fg_hover'] : '#000');
$nav_socials_bg_hover = (isset($theme_options['to_color_nav_socials_bg_hover']) ? $theme_options['to_color_nav_socials_bg_hover'] : '#fff');
$footer_socials_fg = (isset($theme_options['to_color_footer_socials_fg']) ? $theme_options['to_color_footer_socials_fg'] : '#888');
$footer_socials_bg = (isset($theme_options['to_color_footer_socials_bg']) ? $theme_options['to_color_footer_socials_bg'] : '#333');
$footer_socials_fg_hover = (isset($theme_options['to_color_footer_socials_fg_hover']) ? $theme_options['to_color_footer_socials_fg_hover'] : '#fff');
$footer_socials_bg_hover = (isset($theme_options['to_color_footer_socials_bg_hover']) ? $theme_options['to_color_footer_socials_bg_hover'] : '#90CC28');

// Blog Panels
$blog_panel_color = (isset($theme_options['to_color_blog_panel_color']) ? $theme_options['to_color_blog_panel_color'] : '#90CC28');

// Pagination
$pagination_color = (isset($theme_options['to_color_pagination_color']) ? $theme_options['to_color_pagination_color'] : '#90CC28');

// Twitter Block
$twitter_block_bg = (isset($theme_options['to_color_twitter_bg_color']) ? $theme_options['to_color_twitter_bg_color'] : '#E15152');
$twitter_block_text = (isset($theme_options['to_color_twitter_text_color']) ? $theme_options['to_color_twitter_text_color'] : '#fff');

// Footer
$footer_bg_color = (isset($theme_options['to_color_footer_bg_color']) ? $theme_options['to_color_footer_bg_color'] : '#000');
$footer_text_color = (isset($theme_options['to_color_footer_text_color']) ? $theme_options['to_color_footer_text_color'] : '#aaa');

?>

body { <?php if ($body_bg_image) { ?>background:url('<?php echo $body_bg_image; ?>') <?php echo $body_bg_image_repeat; ?> <?php echo $body_bg_image_position; ?> <?php echo $body_bg_image_fixed; ?>;<?php } ?> background-color:<?php echo $body_bg_color; ?>; }
#basilHeaderTop { height:<?php echo $header_height; ?>px; }


/* *****************************
COLORS
***************************** */

/* LINKS */
body a { color:<?php echo $link_color; ?>; }
body a:hover { color:<?php echo $link_color_hover; ?>; }

.woocommerce ul.products li.product a:first-child .onsale,
.basilFeaturedProducts ul.products li.product a:first-child .onsale,
.basilFeaturedProducts ul.products li.product a:first-child .price,
.woocommerce .product .onsale,
.woocommerce.single-product div.product .summary .price { background:<?php echo $link_color; ?>; }

.woocommerce ul.products li.product a:first-child .price,
ul.product_list_widget li .amount,
.woocommerce del { color:<?php echo $link_color; ?>; }

/* CUSTOM COLORS */
.bgColor-1 { background-color:<?php echo $button_color_1_bg; ?>; color:<?php echo $button_color_1_text; ?>; }
.bgColor-1:hover { background-color:<?php echo $button_color_1_bg_hover; ?>; color:<?php echo $button_color_1_text_hover; ?>; }
.bgColor-2, .sticky-tag { background-color:<?php echo $button_color_2_bg; ?>; color:<?php echo $button_color_2_text; ?>; }
.bgColor-2:hover { background-color:<?php echo $button_color_2_bg_hover; ?>; color:<?php echo $button_color_2_text_hover; ?>; }
.bgColor-3 { background-color:<?php echo $button_color_3_bg; ?>; color:<?php echo $button_color_3_text; ?>; }
.bgColor-3:hover { background-color:<?php echo $button_color_3_bg_hover; ?>; color:<?php echo $button_color_3_text_hover; ?>; }

/* FORM ELEMENTS */
button, input[type="button"], input[type="reset"], input[type="submit"], .wysija-submit, #comments-list ol li.comment div.reply a, .searchform .searchsubmit, .widget form#searchform #searchsubmit { background-color:<?php echo $button_color_1_bg; ?>; color:<?php echo $button_color_1_text; ?>; }
button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .wysija-submit:hover, #comments-list ol li.comment div.reply a:hover, .searchform .searchsubmit:hover, .widget form#searchform #searchsubmit:hover { background-color:<?php echo $button_color_1_bg_hover; ?>; color:<?php echo $button_color_1_text_hover; ?>; }
input[type=text], input[type=email], input[type=password], input[type=tel], textarea { border:1px solid #ddd; background:#fff; color:#888; }

/* WOOCOMMERCE */
.woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #review_form #submit, .woocommerce #payment #place_order, .woocommerce-page #payment #place_order,
.woocommerce div.product form.cart .button, .woocommerce #content div.product form.cart .button, .woocommerce-page div.product form.cart .button, .woocommerce-page #content div.product form.cart .button,
.woocommerce #review_form #respond .form-submit input, .woocommerce-page #review_form #respond .form-submit input
{ background:<?php echo $button_color_1_bg; ?>; color:<?php echo $button_color_1_text; ?>; }

.woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #review_form #submit:hover, .woocommerce #payment #place_order:hover, .woocommerce-page #payment #place_order:hover,
.woocommerce div.product form.cart .button:hover, .woocommerce #content div.product form.cart .button:hover, .woocommerce-page div.product form.cart .button:hover, .woocommerce-page #content div.product form.cart .button:hover,
.woocommerce #review_form #respond .form-submit input:hover, .woocommerce-page #review_form #respond .form-submit input:hover
{ background:<?php echo $button_color_1_bg_hover; ?>; color:<?php echo $button_color_1_text_hover; ?>; }

.woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce #content input.button.alt, .woocommerce-page a.button.alt, .woocommerce-page button.button.alt, .woocommerce-page input.button.alt, .woocommerce-page #respond input#submit.alt, .woocommerce-page #content input.button.alt {
background:<?php echo $button_color_2_bg; ?>; color:<?php echo $button_color_2_text; ?>; }

.woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce #content input.button.alt:hover, .woocommerce-page a.button.alt:hover, .woocommerce-page button.button.alt:hover, .woocommerce-page input.button.alt:hover, .woocommerce-page #respond input#submit.alt:hover, .woocommerce-page #content input.button.alt:hover {
background:<?php echo $button_color_2_bg_hover; ?>; color:<?php echo $button_color_2_text_hover; ?>; }

.woocommerce .woocommerce-info, .woocommerce-page .woocommerce-info { border-top-color:<?php echo $button_color_1_bg; ?>; }

/* COMMENT ELEMENTS */
#comments-list #cancel-comment-reply-link { background-color:<?php echo $button_color_3_bg; ?>; color:<?php echo $button_color_3_text; ?>; }
#comments-list #cancel-comment-reply-link:hover { background-color:<?php echo $button_color_3_bg_hover; ?>; color:<?php echo $button_color_3_text_hover; ?>; }

/* LAYOUT ITEMS */
#basilWrapper { }
#basilHeaderTop { background:<?php echo $header_bg_color; ?>; }

/* HEADER */
#basilHeaderTop .basilRight p { color:<?php echo $header_text_color; ?>; }

/* NAVIGATION */
#basilNavBar, .slicknav_menu { background:<?php echo $nav_bg_color; ?>; }
ul.basilNav li a, .slicknav_menu a { color:<?php echo $nav_link_color; ?>; }
.slicknav_menu .slicknav_icon-bar { background-color:<?php echo $nav_link_color_text_hover; ?>; }
ul.basilNav > li > a:hover, ul.basilNav > li:hover > a, .slicknav_menu a:hover, .slicknav_menu .slicknav_btn { color:<?php echo $nav_link_color_text_hover; ?>; background:<?php echo $nav_link_color_bg_hover; ?>; }
ul.basilNav ul { background-color: <?php echo $nav_dropdown_bg_color; ?>; }
ul.basilNav ul a { color:<?php echo $nav_dropdown_link_color; ?>; }
ul.basilNav ul li:hover > a { background-color:<?php echo $nav_dropdown_link_color_bg_hover; ?>; color:<?php echo $nav_dropdown_link_color_text_hover; ?>; }
#basilNavBar .basilRight p { color:<?php echo $nav_text_color; ?>; }

/* SOCIALS */
#basilNavBar .basilSocials a, .basilMobileNavContent .basilSocials a { color:<?php echo $nav_socials_fg; ?>; }
#basilNavBar .basilSocials small, .basilMobileNavContent .basilSocials small { background-color:<?php echo $nav_socials_bg; ?>; }
#basilNavBar .basilSocials a:hover i, .basilMobileNavContent .basilSocials a:hover i { color: <?php echo $nav_socials_fg_hover; ?>; }
#basilNavBar .basilSocials a:hover small, .basilMobileNavContent .basilSocials a:hover small { background-color: <?php echo $nav_socials_bg_hover; ?>; }

footer .basilSocials a { color:<?php echo $footer_socials_fg; ?>; }
footer .basilSocials small { background-color:<?php echo $footer_socials_bg; ?>; }
footer .basilSocials a:hover i { color: <?php echo $footer_socials_fg_hover; ?>; }
footer .basilSocials a:hover small { background-color: <?php echo $footer_socials_bg_hover; ?>; }

/* SLIDER */
.basilSlider { background:#fff; }
.basilSlider .basilSliderNav a { color:#fff; }
.basilRecipeSlider { background:#fff; }

/* BLOG PANELS */
.basilDarkGray .basilPostPanels .basilPostThumbEmpty { background:#555; color:#aaa; }
.basilDarkGray .basilPostPanels article { border:1px solid #333; }
.basilPostPanels article { border:1px solid #ccc; background:#fff; }
.basilPostPanels .basilPostThumbEmpty { background:#ddd; color:#fff; }
.basilPostPanels .basilPostThumbEmpty:hover { background:<?php echo $blog_panel_color; ?>; color:#fff; }
.basilPostPanels .basilPostThumb span { color:#fff; }
.basilPostPanels article .basilPost h4 a, .basilPostPanels article .basilPost p { color:#555; }
.basilPostPanels article .basilPost h4 a:hover { color:<?php echo $link_color; ?>; }
.basilPostPanels .basilPostMeta { background:#f5f5f5; }

.basilPostPanels .basilPostThumb span,
.basilPostList .basilPostThumb span { background:<?php echo basil_hex_to_rgba($blog_panel_color,'0.8'); ?>}

/* BLOG LIST VIEW */
.basilDarkGray .basilPostList .basilPostThumbEmpty { background:#555; color:#aaa; }
.basilPostList .basilPostThumbEmpty { background:#ddd; color:#fff; }
.basilPostList .basilPostThumbEmpty:hover { background:<?php echo $blog_panel_color; ?>; color:#fff; }
.basilPostList .basilPostThumb span { color:#fff; }
.basilPostList article .basilPost h4 a, .basilPostList article .basilPost p { color:#555; }
.basilPostList article .basilPost h4 a:hover { color:<?php echo $link_color; ?>; }
.basilPostList article .basilPostMeta, .basilPostList article .basilPostMeta a { color:#aaa; }
.basilPostList article .basilPostMeta a:hover { color:#555; }

.basilPostMeta, .basilPostMeta a { color:#aaa; }
.basilPostMeta a:hover { color:#555; }

/* PAGINATION */
.basilPostsPagination li a { background:<?php echo $pagination_color; ?>; color:#fff; }
.basilPostsPagination li.basilPrevNextButton a { background:none; color:<?php echo $pagination_color; ?>; }
.basilPostsPagination li a:hover { background:#333; }
.basilPostsPagination li.basilPrevNextButton a:hover { background:none; color:#333; }
.basilPostsPagination li.active a, .basilPostsPagination li.active a:hover { background:#eee; color:#aaa; }

/* RECENT TWEETS */
.basilRecentTweets { background:<?php echo $twitter_block_bg; ?>; color:<?php echo $twitter_block_text; ?>; }
.basilRecentTweets .basilTweetsPrev,
.basilRecentTweets .basilTweetsNext { color:<?php echo $twitter_block_text; ?>; }
.basilRecentTweets a, .basilRecentTweets a:hover { color:<?php echo $twitter_block_text; ?>; }

/* FOOTER */
footer, footer a { background:<?php echo $footer_bg_color; ?>; color:<?php echo $footer_text_color; ?>; }

/* OVERRIDES */
#basilHeader.basilHeaderTransparent #basilWrapper { background:none; }
#basilHeader.basilHeaderTransparent #basilHeaderTop { background:none; }
#basilHeader.basilHeaderTransparent #basilNavBar { background:none; }