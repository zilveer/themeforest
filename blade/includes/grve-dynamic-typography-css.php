<?php
/**
 *  Dynamic typography css style
 * 	@author		Greatives Team
 * 	@URI		http://greatives.eu
 */

$typo_css = "";

/**
 * Typography
 * ----------------------------------------------------------------------------
 */

$typo_css .= "

body,
p {
	font-size: " . blade_grve_option( 'body_font', '14px', 'font-size'  ) . ";
	font-family: " . blade_grve_option( 'body_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . blade_grve_option( 'body_font', 'normal', 'font-weight'  ) . ";
	line-height: " . blade_grve_option( 'body_font', '36px', 'line-height'  ) . ";
	" . blade_grve_css_option( 'body_font', '0px', 'letter-spacing'  ) . "
}

";

/* Logo as text */
$typo_css .= "

#grve-header .grve-logo.grve-logo-text a {
	font-family: " . blade_grve_option( 'logo_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . blade_grve_option( 'logo_font', 'normal', 'font-weight'  ) . ";
	font-style: " . blade_grve_option( 'logo_font', 'normal', 'font-style'  ) . ";
	font-size: " . blade_grve_option( 'logo_font', '11px', 'font-size'  ) . ";
	text-transform: " . blade_grve_option( 'logo_font', 'uppercase', 'text-transform'  ) . ";
	" . blade_grve_css_option( 'logo_font', '0px', 'letter-spacing'  ) . "
}

";


/* Main Menu  */
$typo_css .= "

#grve-main-menu .grve-wrapper > ul > li > a,
#grve-main-menu .grve-wrapper > ul > li.megamenu > ul > li > a,
#grve-theme-wrapper #grve-hidden-menu ul.grve-menu > li > a,
.grve-toggle-hiddenarea .grve-label,
#grve-hidden-menu ul.grve-menu > li.megamenu > ul > li > a,
#grve-main-menu .grve-wrapper > ul > li ul li.grve-goback a,
#grve-hidden-menu ul.grve-menu > li ul li.grve-goback a {
	font-family: " . blade_grve_option( 'main_menu_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . blade_grve_option( 'main_menu_font', 'normal', 'font-weight'  ) . ";
	font-style: " . blade_grve_option( 'main_menu_font', 'normal', 'font-style'  ) . ";
	font-size: " . blade_grve_option( 'main_menu_font', '11px', 'font-size'  ) . ";
	text-transform: " . blade_grve_option( 'main_menu_font', 'uppercase', 'text-transform'  ) . ";
	" . blade_grve_css_option( 'main_menu_font', '0px', 'letter-spacing'  ) . "
}

.grve-slide-menu #grve-main-menu .grve-wrapper ul li.megamenu ul li:not(.grve-goback) > a,
#grve-hidden-menu.grve-slide-menu ul li.megamenu ul li:not(.grve-goback) > a,
#grve-main-menu .grve-wrapper > ul > li ul li a,
#grve-header .grve-shoppin-cart-content {
	font-family: " . blade_grve_option( 'sub_menu_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . blade_grve_option( 'sub_menu_font', 'normal', 'font-weight'  ) . ";
	font-style: " . blade_grve_option( 'sub_menu_font', 'normal', 'font-style'  ) . ";
	font-size: " . blade_grve_option( 'sub_menu_font', '11px', 'font-size'  ) . ";
	text-transform: " . blade_grve_option( 'sub_menu_font', 'uppercase', 'text-transform'  ) . ";
	" . blade_grve_css_option( 'sub_menu_font', '0px', 'letter-spacing'  ) . "
}

#grve-main-menu .grve-menu-description,
#grve-hidden-menu .grve-menu-description {
	font-family: " . blade_grve_option( 'description_menu_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . blade_grve_option( 'description_menu_font', 'normal', 'font-weight'  ) . ";
	font-style: " . blade_grve_option( 'description_menu_font', 'normal', 'font-style'  ) . ";
	font-size: " . blade_grve_option( 'description_menu_font', '11px', 'font-size'  ) . ";
	text-transform: " . blade_grve_option( 'description_menu_font', 'uppercase', 'text-transform'  ) . ";
	" . blade_grve_css_option( 'description_menu_font', '0px', 'letter-spacing'  ) . "
}

";

/* Anchor Menu  */
$typo_css .= "

.grve-anchor-menu .grve-anchor-wrapper .grve-container > ul > li > a,
.grve-anchor-menu .grve-anchor-wrapper .grve-container ul.sub-menu li a {
	font-family: " . blade_grve_option( 'small_text', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . blade_grve_option( 'small_text', 'normal', 'font-weight'  ) . ";
	font-style: " . blade_grve_option( 'small_text', 'normal', 'font-style'  ) . ";
	font-size: " . blade_grve_option( 'small_text', '34px', 'font-size'  ) . ";
	text-transform: " . blade_grve_option( 'small_text', 'none', 'text-transform'  ) . ";
	" . blade_grve_css_option( 'small_text', '0px', 'letter-spacing'  ) . "
}

";

/* Headings */
$typo_css .= "

h1,
.grve-h1,
#grve-theme-wrapper .grve-modal .grve-search input[type='text'],
.grve-dropcap span,
h2,
.grve-h2,
h3,
.grve-h3,
h4,
.grve-h4,
h5,
.grve-h5,
h6,
.grve-h6 {
	font-family: " . blade_grve_option( 'headings_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . blade_grve_option( 'headings_font', 'normal', 'font-weight'  ) . ";
	font-style: " . blade_grve_option( 'headings_font', 'normal', 'font-style'  ) . ";
	text-transform: " . blade_grve_option( 'headings_font', 'uppercase', 'text-transform'  ) . ";
}

h1,
.grve-h1,
#grve-theme-wrapper .grve-modal .grve-search input[type='text'],
.grve-dropcap span {
	font-size: " . blade_grve_option( 'h1_font', '56px', 'font-size'  ) . ";
	line-height: " . blade_grve_option( 'h1_font', '60px', 'line-height'  ) . ";
	" . blade_grve_css_option( 'h1_font', '0px', 'letter-spacing'  ) . "
}

h2,
.grve-h2 {
	font-size: " . blade_grve_option( 'h2_font', '36px', 'font-size'  ) . ";
	line-height: " . blade_grve_option( 'h2_font', '40px', 'line-height'  ) . ";
	" . blade_grve_css_option( 'h2_font', '0px', 'letter-spacing'  ) . "
}

h3,
.grve-h3 {
	font-size: " . blade_grve_option( 'h3_font', '30px', 'font-size'  ) . ";
	line-height: " . blade_grve_option( 'h3_font', '33px', 'line-height'  ) . ";
	" . blade_grve_css_option( 'h3_font', '0px', 'letter-spacing'  ) . "
}

h4,
.grve-h4 {
	font-size: " . blade_grve_option( 'h4_font', '23px', 'font-size'  ) . ";
	line-height: " . blade_grve_option( 'h4_font', '26px', 'line-height'  ) . ";
	" . blade_grve_css_option( 'h4_font', '0px', 'letter-spacing'  ) . "
}

h5,
.grve-h5,
h3#reply-title {
	font-size: " . blade_grve_option( 'h5_font', '18px', 'font-size'  ) . ";
	line-height: " . blade_grve_option( 'h5_font', '20px', 'line-height'  ) . ";
	" . blade_grve_css_option( 'h5_font', '0px', 'letter-spacing'  ) . "
}

h6,
.grve-h6 {
	font-size: " . blade_grve_option( 'h6_font', '16px', 'font-size'  ) . ";
	line-height: " . blade_grve_option( 'h6_font', '18px', 'line-height'  ) . ";
	" . blade_grve_css_option( 'h6_font', '0px', 'letter-spacing'  ) . "
}

";

/* Page Title */
$typo_css .= "

#grve-page-title .grve-title,
#grve-blog-title .grve-title {
	font-family: " . blade_grve_option( 'page_title', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . blade_grve_option( 'page_title', 'normal', 'font-weight'  ) . ";
	font-style: " . blade_grve_option( 'page_title', 'normal', 'font-style'  ) . ";
	font-size: " . blade_grve_option( 'page_title', '60px', 'font-size'  ) . ";
	text-transform: " . blade_grve_option( 'page_title', 'uppercase', 'text-transform'  ) . ";
	line-height: " . blade_grve_option( 'page_title', '60px', 'line-height'  ) . ";
	" . blade_grve_css_option( 'page_title', '0px', 'letter-spacing'  ) . "
}

#grve-page-title .grve-description,
#grve-blog-title .grve-description,
#grve-blog-title .grve-description p {
	font-family: " . blade_grve_option( 'page_description', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . blade_grve_option( 'page_description', 'normal', 'font-weight'  ) . ";
	font-style: " . blade_grve_option( 'page_description', 'normal', 'font-style'  ) . ";
	font-size: " . blade_grve_option( 'page_description', '24px', 'font-size'  ) . ";
	text-transform: " . blade_grve_option( 'page_description', 'none', 'text-transform'  ) . ";
	line-height: " . blade_grve_option( 'page_description', '60px', 'line-height'  ) . ";
	" . blade_grve_css_option( 'page_description', '0px', 'letter-spacing'  ) . "
}

";


/* Post Title */
$typo_css .= "

#grve-post-title .grve-title-meta {
	font-family: " . blade_grve_option( 'post_title_meta', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . blade_grve_option( 'post_title_meta', 'normal', 'font-weight'  ) . ";
	font-style: " . blade_grve_option( 'post_title_meta', 'normal', 'font-style'  ) . ";
	font-size: " . blade_grve_option( 'post_title_meta', '60px', 'font-size'  ) . ";
	text-transform: " . blade_grve_option( 'post_title_meta', 'uppercase', 'text-transform'  ) . ";
	line-height: " . blade_grve_option( 'post_title_meta', '112px', 'line-height'  ) . ";
	" . blade_grve_css_option( 'post_title_meta', '0px', 'letter-spacing'  ) . "
}

#grve-post-title .grve-title {
	font-family: " . blade_grve_option( 'post_title', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . blade_grve_option( 'post_title', 'normal', 'font-weight'  ) . ";
	font-style: " . blade_grve_option( 'post_title', 'normal', 'font-style'  ) . ";
	font-size: " . blade_grve_option( 'post_title', '60px', 'font-size'  ) . ";
	text-transform: " . blade_grve_option( 'post_title', 'uppercase', 'text-transform'  ) . ";
	line-height: " . blade_grve_option( 'post_title', '112px', 'line-height'  ) . ";
	" . blade_grve_css_option( 'post_title', '0px', 'letter-spacing'  ) . "
}

#grve-post-title .grve-description {
	font-family: " . blade_grve_option( 'post_title_desc', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . blade_grve_option( 'post_title_desc', 'normal', 'font-weight'  ) . ";
	font-style: " . blade_grve_option( 'post_title_desc', 'normal', 'font-style'  ) . ";
	font-size: " . blade_grve_option( 'post_title_desc', '60px', 'font-size'  ) . ";
	text-transform: " . blade_grve_option( 'post_title_desc', 'uppercase', 'text-transform'  ) . ";
	line-height: " . blade_grve_option( 'post_title_desc', '112px', 'line-height'  ) . ";
	" . blade_grve_css_option( 'post_title_desc', '0px', 'letter-spacing'  ) . "
}


";

/* Portfolio Title */
$typo_css .= "

#grve-portfolio-title .grve-title {
	font-family: " . blade_grve_option( 'portfolio_title', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . blade_grve_option( 'portfolio_title', 'normal', 'font-weight'  ) . ";
	font-style: " . blade_grve_option( 'portfolio_title', 'normal', 'font-style'  ) . ";
	font-size: " . blade_grve_option( 'portfolio_title', '60px', 'font-size'  ) . ";
	text-transform: " . blade_grve_option( 'portfolio_title', 'uppercase', 'text-transform'  ) . ";
	line-height: " . blade_grve_option( 'portfolio_title', '112px', 'line-height'  ) . ";
	" . blade_grve_css_option( 'portfolio_title', '0px', 'letter-spacing'  ) . "
}

#grve-portfolio-title .grve-description {
	font-family: " . blade_grve_option( 'portfolio_description', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . blade_grve_option( 'portfolio_description', 'normal', 'font-weight'  ) . ";
	font-style: " . blade_grve_option( 'portfolio_description', 'normal', 'font-style'  ) . ";
	font-size: " . blade_grve_option( 'portfolio_description', '60px', 'font-size'  ) . ";
	text-transform: " . blade_grve_option( 'portfolio_description', 'uppercase', 'text-transform'  ) . ";
	line-height: " . blade_grve_option( 'portfolio_description', '112px', 'line-height'  ) . ";
	" . blade_grve_css_option( 'portfolio_description', '0px', 'letter-spacing'  ) . "
}


";

/* WooCommerce Title */
$typo_css .= "

#grve-product-title .grve-title,
#grve-product-tax-title .grve-title,
.woocommerce-page #grve-page-title .grve-title {
	font-family: " . blade_grve_option( 'product_tax_title', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . blade_grve_option( 'product_tax_title', 'normal', 'font-weight'  ) . ";
	font-style: " . blade_grve_option( 'product_tax_title', 'normal', 'font-style'  ) . ";
	font-size: " . blade_grve_option( 'product_tax_title', '60px', 'font-size'  ) . ";
	text-transform: " . blade_grve_option( 'product_tax_title', 'uppercase', 'text-transform'  ) . ";
	line-height: " . blade_grve_option( 'product_tax_title', '112px', 'line-height'  ) . ";
	" . blade_grve_css_option( 'product_tax_title', '0px', 'letter-spacing'  ) . "
}

#grve-product-title .grve-description,
#grve-product-tax-title .grve-description,
#grve-product-tax-title .grve-description p,
.woocommerce-page #grve-page-title .grve-description {
	font-family: " . blade_grve_option( 'product_tax_description', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . blade_grve_option( 'product_tax_description', 'normal', 'font-weight'  ) . ";
	font-style: " . blade_grve_option( 'product_tax_description', 'normal', 'font-style'  ) . ";
	font-size: " . blade_grve_option( 'product_tax_description', '60px', 'font-size'  ) . ";
	text-transform: " . blade_grve_option( 'product_tax_description', 'uppercase', 'text-transform'  ) . ";
	line-height: " . blade_grve_option( 'product_tax_description', '112px', 'line-height'  ) . ";
	" . blade_grve_css_option( 'product_tax_description', '0px', 'letter-spacing'  ) . "
}


";

/* Feature Section Custom */
$typo_css .= "

#grve-feature-section .grve-subheading {
	font-family: " . blade_grve_option( 'feature_subheading_custom_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . blade_grve_option( 'feature_subheading_custom_font', 'normal', 'font-weight'  ) . ";
	font-style: " . blade_grve_option( 'feature_subheading_custom_font', 'normal', 'font-style'  ) . ";
	font-size: " . blade_grve_option( 'feature_subheading_custom_font', '60px', 'font-size'  ) . ";
	text-transform: " . blade_grve_option( 'feature_subheading_custom_font', 'uppercase', 'text-transform'  ) . ";
	line-height: " . blade_grve_option( 'feature_subheading_custom_font', '112px', 'line-height'  ) . ";
	" . blade_grve_css_option( 'feature_subheading_custom_font', '0px', 'letter-spacing'  ) . "
}

#grve-feature-section .grve-title {
	font-family: " . blade_grve_option( 'feature_title_custom_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . blade_grve_option( 'feature_title_custom_font', 'normal', 'font-weight'  ) . ";
	font-style: " . blade_grve_option( 'feature_title_custom_font', 'normal', 'font-style'  ) . ";
	font-size: " . blade_grve_option( 'feature_title_custom_font', '60px', 'font-size'  ) . ";
	text-transform: " . blade_grve_option( 'feature_title_custom_font', 'uppercase', 'text-transform'  ) . ";
	line-height: " . blade_grve_option( 'feature_title_custom_font', '112px', 'line-height'  ) . ";
	" . blade_grve_css_option( 'feature_title_custom_font', '0px', 'letter-spacing'  ) . "
}

#grve-feature-section .grve-description {
	font-family: " . blade_grve_option( 'feature_desc_custom_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . blade_grve_option( 'feature_desc_custom_font', 'normal', 'font-weight'  ) . ";
	font-style: " . blade_grve_option( 'feature_desc_custom_font', 'normal', 'font-style'  ) . ";
	font-size: " . blade_grve_option( 'feature_desc_custom_font', '60px', 'font-size'  ) . ";
	text-transform: " . blade_grve_option( 'feature_desc_custom_font', 'uppercase', 'text-transform'  ) . ";
	line-height: " . blade_grve_option( 'feature_desc_custom_font', '112px', 'line-height'  ) . ";
	" . blade_grve_css_option( 'feature_desc_custom_font', '0px', 'letter-spacing'  ) . "
}


";

/* Feature Section Fullscreen */
$typo_css .= "

#grve-feature-section.grve-fullscreen .grve-subheading {
	font-family: " . blade_grve_option( 'feature_subheading_full_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . blade_grve_option( 'feature_subheading_full_font', 'normal', 'font-weight'  ) . ";
	font-style: " . blade_grve_option( 'feature_subheading_full_font', 'normal', 'font-style'  ) . ";
	font-size: " . blade_grve_option( 'feature_subheading_full_font', '60px', 'font-size'  ) . ";
	text-transform: " . blade_grve_option( 'feature_subheading_full_font', 'uppercase', 'text-transform'  ) . ";
	line-height: " . blade_grve_option( 'feature_subheading_full_font', '112px', 'line-height'  ) . ";
	" . blade_grve_css_option( 'feature_subheading_full_font', '0px', 'letter-spacing'  ) . "
}

#grve-feature-section.grve-fullscreen .grve-title {
	font-family: " . blade_grve_option( 'feature_title_full_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . blade_grve_option( 'feature_title_full_font', 'normal', 'font-weight'  ) . ";
	font-style: " . blade_grve_option( 'feature_title_full_font', 'normal', 'font-style'  ) . ";
	font-size: " . blade_grve_option( 'feature_title_full_font', '60px', 'font-size'  ) . ";
	text-transform: " . blade_grve_option( 'feature_title_full_font', 'uppercase', 'text-transform'  ) . ";
	line-height: " . blade_grve_option( 'feature_title_full_font', '112px', 'line-height'  ) . ";
	" . blade_grve_css_option( 'feature_title_full_font', '0px', 'letter-spacing'  ) . "
}

";

$typo_css .= "

#grve-feature-section.grve-fullscreen .grve-description {
	font-family: " . blade_grve_option( 'feature_desc_full_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . blade_grve_option( 'feature_desc_full_font', 'normal', 'font-weight'  ) . ";
	font-style: " . blade_grve_option( 'feature_desc_full_font', 'normal', 'font-style'  ) . ";
	font-size: " . blade_grve_option( 'feature_desc_full_font', '60px', 'font-size'  ) . ";
	text-transform: " . blade_grve_option( 'feature_desc_full_font', 'uppercase', 'text-transform'  ) . ";
	line-height: " . blade_grve_option( 'feature_desc_full_font', '112px', 'line-height'  ) . ";
	" . blade_grve_css_option( 'feature_desc_full_font', '0px', 'letter-spacing'  ) . "
}

";


/* Special Text */
$typo_css .= "

.grve-leader-text,
.grve-leader-text p,
p.grve-leader-text,
blockquote,
blockquote p {
	font-family: " . blade_grve_option( 'leader_text', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . blade_grve_option( 'leader_text', 'normal', 'font-weight'  ) . ";
	font-style: " . blade_grve_option( 'leader_text', 'normal', 'font-style'  ) . ";
	font-size: " . blade_grve_option( 'leader_text', '34px', 'font-size'  ) . ";
	text-transform: " . blade_grve_option( 'leader_text', 'none', 'text-transform'  ) . ";
	line-height: " . blade_grve_option( 'leader_text', '36px', 'line-height'  ) . ";
	" . blade_grve_css_option( 'leader_text', '0px', 'letter-spacing'  ) . "
}

.grve-subtitle,
.grve-subtitle p,
.grve-subtitle-text {
	font-family: " . blade_grve_option( 'subtitle_text', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . blade_grve_option( 'subtitle_text', 'normal', 'font-weight'  ) . ";
	font-style: " . blade_grve_option( 'subtitle_text', 'normal', 'font-style'  ) . ";
	font-size: " . blade_grve_option( 'subtitle_text', '34px', 'font-size'  ) . ";
	text-transform: " . blade_grve_option( 'subtitle_text', 'none', 'text-transform'  ) . ";
	line-height: " . blade_grve_option( 'subtitle_text', '36px', 'line-height'  ) . ";
	" . blade_grve_css_option( 'subtitle_text', '0px', 'letter-spacing'  ) . "
}

.grve-small-text,
span.wpcf7-not-valid-tip,
div.wpcf7-validation-errors {
	font-family: " . blade_grve_option( 'small_text', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . blade_grve_option( 'small_text', 'normal', 'font-weight'  ) . ";
	font-style: " . blade_grve_option( 'small_text', 'normal', 'font-style'  ) . ";
	font-size: " . blade_grve_option( 'small_text', '34px', 'font-size'  ) . ";
	text-transform: " . blade_grve_option( 'small_text', 'none', 'text-transform'  ) . ";
	" . blade_grve_css_option( 'small_text', '0px', 'letter-spacing'  ) . "
}

";

/* Link Text */
$grve_btn_size = blade_grve_option( 'link_text', '13px', 'font-size'  );
$grve_btn_size = filter_var( $grve_btn_size, FILTER_SANITIZE_NUMBER_INT );

$grve_btn_size_xsm = $grve_btn_size * 0.7;
$grve_btn_size_sm = $grve_btn_size * 0.85;
$grve_btn_size_lg = $grve_btn_size * 1.2;
$grve_btn_size_xlg = $grve_btn_size * 1.35;

$typo_css .= "

.grve-link-text,
.grve-btn,
input[type='submit'],
input[type='reset'],
button:not(.mfp-arrow),
#grve-header .grve-shoppin-cart-content .total,
#grve-header .grve-shoppin-cart-content .button,
#grve-main-content .vc_tta.vc_general .vc_tta-tab > a,
.vc_tta.vc_general .vc_tta-panel-title,
#cancel-comment-reply-link {
	font-family: " . blade_grve_option( 'link_text', 'Arial, Helvetica, sans-serif', 'font-family'  ) . " !important;
	font-weight: " . blade_grve_option( 'link_text', 'normal', 'font-weight'  ) . " !important;
	font-style: " . blade_grve_option( 'link_text', 'normal', 'font-style'  ) . ";
	font-size: " . blade_grve_option( 'link_text', '13px', 'font-size'  ) . " !important;
	text-transform: " . blade_grve_option( 'link_text', 'uppercase', 'text-transform'  ) . ";
	" . blade_grve_css_option( 'link_text', '0px', 'letter-spacing'  ) . "
}

.grve-btn.grve-btn-extrasmall,
.widget.woocommerce button[type='submit'] {
	font-size: " . round( $grve_btn_size_xsm, 0 ) . "px !important;
}

.grve-btn.grve-btn-small {
	font-size: " . round( $grve_btn_size_sm, 0 ) . "px !important;
}

.grve-btn.grve-btn-large {
	font-size: " . round( $grve_btn_size_lg, 0 ) . "px !important;
}

.grve-btn.grve-btn-extralarge {
	font-size: " . round( $grve_btn_size_xlg, 0 ) . "px !important;
}


";

/* Widget Text */
$typo_css .= "

.grve-widget-title {
	font-family: " . blade_grve_option( 'widget_title', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . blade_grve_option( 'widget_title', 'normal', 'font-weight'  ) . ";
	font-style: " . blade_grve_option( 'widget_title', 'normal', 'font-style'  ) . ";
	font-size: " . blade_grve_option( 'widget_title', '34px', 'font-size'  ) . ";
	text-transform: " . blade_grve_option( 'widget_title', 'none', 'text-transform'  ) . ";
	line-height: " . blade_grve_option( 'widget_title', '36px', 'line-height'  ) . ";
	" . blade_grve_css_option( 'widget_title', '0px', 'letter-spacing'  ) . "
}

.widget,
.widgets,
#grve-hidden-menu ul.grve-menu li a {
	font-family: " . blade_grve_option( 'widget_text', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . blade_grve_option( 'widget_text', 'normal', 'font-weight'  ) . ";
	font-style: " . blade_grve_option( 'widget_text', 'normal', 'font-style'  ) . ";
	font-size: " . blade_grve_option( 'widget_text', '34px', 'font-size'  ) . ";
	text-transform: " . blade_grve_option( 'widget_text', 'none', 'text-transform'  ) . ";
	line-height: " . blade_grve_option( 'widget_text', '36px', 'line-height'  ) . ";
	" . blade_grve_css_option( 'widget_text', '0px', 'letter-spacing'  ) . "
}


";


//Responsive Typography

$grve_responsive_fonts_group_headings =  array (
	array(
		'id'   => 'h1_font',
		'selector'  => 'h1,.grve-h1,#grve-theme-wrapper .grve-modal .grve-search input[type="text"],.grve-dropcap span',
	),
	array(
		'id'   => 'h2_font',
		'selector'  => 'h2,.grve-h2',
	),
	array(
		'id'   => 'h3_font',
		'selector'  => 'h3,.grve-h3',
	),
	array(
		'id'   => 'h4_font',
		'selector'  => 'h4,.grve-h4',
	),
	array(
		'id'   => 'h5_font',
		'selector'  => 'h5,.grve-h5,h3#reply-title',
	),
	array(
		'id'   => 'h6_font',
		'selector'  => 'h6,.grve-h6',
	),
);


$grve_responsive_fonts_group_1 =  array (
	array(
		'id'   => 'page_title',
		'selector'  => '#grve-page-title .grve-title,#grve-blog-title .grve-title',
	),
	array(
		'id'   => 'post_title',
		'selector'  => '#grve-post-title .grve-title',
	),
	array(
		'id'   => 'portfolio_title',
		'selector'  => '#grve-portfolio-title .grve-title',
	),
	array(
		'id'   => 'product_tax_title',
		'selector'  => '#grve-product-title .grve-title,#grve-product-tax-title .grve-title,.woocommerce-page #grve-page-title .grve-title',
	),
	array(
		'id'   => 'feature_title_custom_font',
		'selector'  => '#grve-feature-section .grve-title',
	),
	array(
		'id'   => 'feature_title_full_font',
		'selector'  => '#grve-feature-section.grve-fullscreen .grve-title',
	),
	array(
		'id'   => 'feature_desc_full_font',
		'selector'  => '#grve-feature-section.grve-fullscreen .grve-description',
	),
);

$grve_responsive_fonts_group_2 =  array (
	array(
		'id'   => 'page_description',
		'selector'  => '#grve-page-title .grve-description,#grve-blog-title .grve-description,#grve-blog-title .grve-description p',
	),
	array(
		'id'   => 'post_title_meta',
		'selector'  => '#grve-post-title .grve-title-meta',
	),
	array(
		'id'   => 'post_title_desc',
		'selector'  => '#grve-post-title .grve-description',
	),
	array(
		'id'   => 'portfolio_description',
		'selector'  => '#grve-portfolio-title .grve-description',
	),
	array(
		'id'   => 'product_tax_description',
		'selector'  => '#grve-product-title .grve-description,#grve-product-tax-title .grve-description,#grve-product-tax-title .grve-description p,.woocommerce-page #grve-page-title .grve-description',
	),
	array(
		'id'   => 'feature_subheading_custom_font',
		'selector'  => '#grve-feature-section .grve-subheading',
	),
	array(
		'id'   => 'feature_subheading_full_font',
		'selector'  => '#grve-feature-section.grve-fullscreen .grve-subheading',
	),
	array(
		'id'   => 'feature_desc_custom_font',
		'selector'  => '#grve-feature-section .grve-description',
	),
	array(
		'id'   => 'leader_text',
		'selector'  => '.grve-leader-text,.grve-leader-text p,p.grve-leader-text,blockquote',
	),
	array(
		'id'   => 'subtitle_text',
		'selector'  => '.grve-subtitle,.grve-subtitle-text',
	),
	array(
		'id'   => 'link_text',
		'selector'  => '#grve-theme-wrapper .grve-link-text,#grve-theme-wrapper a.grve-btn,#grve-theme-wrapper input[type="submit"],#grve-theme-wrapper input[type="reset"],#grve-theme-wrapper button:not(.mfp-arrow),#cancel-comment-reply-link',
	),
);

function blade_grve_print_typography_responsive( $grve_responsive_fonts = array() , $threshold = 35, $ratio = 0.7) {

	$css = '';

	if ( !empty( $grve_responsive_fonts ) && $ratio < 1 ) {

		foreach ( $grve_responsive_fonts as $font ) {
			$grve_size = blade_grve_option( $font['id'], '32px', 'font-size'  );
			$grve_size = filter_var( $grve_size, FILTER_SANITIZE_NUMBER_INT );
			if ( $grve_size >= $threshold ) {
				$line_height = blade_grve_option( $font['id'], '32px', 'line-height'  );
				$line_height = filter_var( $line_height, FILTER_SANITIZE_NUMBER_INT );

				$line_height = $line_height / $grve_size;
				$grve_size = $grve_size * $ratio;

				if ( 'link_text' == $font['id'] ) {
					$css .= $font['selector'] . " {
						font-size: " . $grve_size . "px !important;
						line-height: " . round( $line_height, 2 ) . "em;
					}
					";
				} else {
					$css .= $font['selector'] . " {
						font-size: " . $grve_size . "px;
						line-height: " . round( $line_height, 2 ) . "em;
					}
					";
				}
			}
		}

	}

	return $css;
}

$tablet_landscape_threshold_headings = blade_grve_option( 'typography_tablet_landscape_threshold_headings', 20 );
$tablet_landscape_ratio_headings = blade_grve_option( 'typography_tablet_landscape_ratio_headings', 1 );
$tablet_portrait_threshold_headings = blade_grve_option( 'typography_tablet_portrait_threshold_headings', 20 );
$tablet_portrait_ratio_headings = blade_grve_option( 'typography_tablet_portrait_ratio_headings', 1 );
$mobile_threshold_headings = blade_grve_option( 'typography_mobile_threshold_headings', 20 );
$mobile_ratio_headings = blade_grve_option( 'typography_mobile_ratio_headings', 1 );

$tablet_landscape_threshold = blade_grve_option( 'typography_tablet_landscape_threshold', 20 );
$tablet_landscape_ratio = blade_grve_option( 'typography_tablet_landscape_ratio', 0.9 );
$tablet_portrait_threshold = blade_grve_option( 'typography_tablet_portrait_threshold', 20 );
$tablet_portrait_ratio = blade_grve_option( 'typography_tablet_portrait_ratio', 0.85 );
$mobile_threshold = blade_grve_option( 'typography_mobile_threshold', 28 );
$mobile_ratio = blade_grve_option( 'typography_mobile_ratio', 0.6 );

$tablet_landscape_threshold2 = blade_grve_option( 'typography_tablet_landscape_threshold2', 14 );
$tablet_landscape_ratio2 = blade_grve_option( 'typography_tablet_landscape_ratio2', 0.9 );
$tablet_portrait_threshold2 = blade_grve_option( 'typography_tablet_portrait_threshold2', 14 );
$tablet_portrait_ratio2 = blade_grve_option( 'typography_tablet_portrait_ratio2', 0.8 );
$mobile_threshold2 = blade_grve_option( 'typography_mobile_threshold2', 13 );
$mobile_ratio2 = blade_grve_option( 'typography_mobile_ratio2', 0.7 );

$typo_css .= "
	@media only screen and (min-width: 960px) and (max-width: 1200px) {
		" . blade_grve_print_typography_responsive( $grve_responsive_fonts_group_headings, $tablet_landscape_threshold_headings, $tablet_landscape_ratio_headings ). "
		" . blade_grve_print_typography_responsive( $grve_responsive_fonts_group_1, $tablet_landscape_threshold, $tablet_landscape_ratio ). "
		" . blade_grve_print_typography_responsive( $grve_responsive_fonts_group_2, $tablet_landscape_threshold2, $tablet_landscape_ratio2 ). "
	}
	@media only screen and (min-width: 768px) and (max-width: 959px) {
		" . blade_grve_print_typography_responsive( $grve_responsive_fonts_group_headings, $tablet_portrait_threshold_headings, $tablet_portrait_ratio_headings ). "
		" . blade_grve_print_typography_responsive( $grve_responsive_fonts_group_1, $tablet_portrait_threshold, $tablet_portrait_ratio ). "
		" . blade_grve_print_typography_responsive( $grve_responsive_fonts_group_2, $tablet_portrait_threshold2, $tablet_portrait_ratio2 ). "
	}
	@media only screen and (max-width: 767px) {
		" . blade_grve_print_typography_responsive( $grve_responsive_fonts_group_headings, $mobile_threshold_headings, $mobile_ratio_headings ). "
		" . blade_grve_print_typography_responsive( $grve_responsive_fonts_group_1, $mobile_threshold, $mobile_ratio ). "
		" . blade_grve_print_typography_responsive( $grve_responsive_fonts_group_2, $mobile_threshold2, $mobile_ratio2 ). "
	}
	@media print {
		" . blade_grve_print_typography_responsive( $grve_responsive_fonts_group_headings, $mobile_threshold_headings, $mobile_ratio_headings ). "
		" . blade_grve_print_typography_responsive( $grve_responsive_fonts_group_1, $mobile_threshold, $mobile_ratio ). "
		" . blade_grve_print_typography_responsive( $grve_responsive_fonts_group_2, $mobile_threshold2, $mobile_ratio2 ). "
	}
";

echo blade_grve_get_css_output( $typo_css );

//Omit closing PHP tag to avoid accidental whitespace output errors.
