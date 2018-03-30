<?php 
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.6.3
 * 
 * Fonts & Colors Settings File
 * Created by CMSMasters
 * 
 */


header('Content-type: text/css');


require('../../../../wp-load.php');


$cmsms_option = cmsms_get_global_options();

?>
/* ===================> Fonts <================== */


/* ====> Content <==== */

body,
li p {
	font:<?php 
		if ($cmsms_option[CMSMS_SHORTNAME . '_content_font_google_font'] != '') {
			$google_font_array = explode(':', $cmsms_option[CMSMS_SHORTNAME . '_content_font_google_font']);
			
			$google_font = str_replace('+', ' ', $google_font_array[0]);
		} else {
			$google_font = '';
		}
		
		echo $cmsms_option[CMSMS_SHORTNAME . '_content_font_font_size'] . 
		'px/' . 
		$cmsms_option[CMSMS_SHORTNAME . '_content_font_line_height'] . 
		'px ' . 
		(($google_font != '') ? "'" . $google_font . "', " : '') . 
		$cmsms_option[CMSMS_SHORTNAME . '_content_font_system_font'];
	?>;
	font-weight:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_content_font_font_weight']; ?>;
	font-style:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_content_font_font_style']; ?>;
}

.widget,
.widget li,
.widget p,
.widget a,
.widget span {
	font-size:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_widget_content_font_font_size']; ?>px;
	line-height:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_widget_content_font_line_height']; ?>px;
}


/* ====> Links <==== */

a,
.post_type_shortcode.type_post .post_type_shortcode_inner > h3 .cmsms_post_type_link {
	font:<?php 
		if ($cmsms_option[CMSMS_SHORTNAME . '_link_font_google_font'] != '') {
			$google_font_array = explode(':', $cmsms_option[CMSMS_SHORTNAME . '_link_font_google_font']);
			
			$google_font = str_replace('+', ' ', $google_font_array[0]);
		} else {
			$google_font = '';
		}
		
		echo $cmsms_option[CMSMS_SHORTNAME . '_link_font_font_size'] . 
		'px/' . 
		$cmsms_option[CMSMS_SHORTNAME . '_link_font_line_height'] . 
		'px ' . 
		(($google_font != '') ? "'" . $google_font . "', " : '') . 
		$cmsms_option[CMSMS_SHORTNAME . '_link_font_system_font'];
	?>;
	font-weight:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_link_font_font_weight']; ?>;
	font-style:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_link_font_font_style']; ?>;
}

/* ====> Navigation <==== */

#navigation > li > a {
	font:<?php 
		if ($cmsms_option[CMSMS_SHORTNAME . '_nav_title_font_google_font'] != '') {
			$google_font_array = explode(':', $cmsms_option[CMSMS_SHORTNAME . '_nav_title_font_google_font']);
			
			$google_font = str_replace('+', ' ', $google_font_array[0]);
		} else {
			$google_font = '';
		}
		
		echo $cmsms_option[CMSMS_SHORTNAME . '_nav_title_font_font_size'] . 
		'px/' . 
		$cmsms_option[CMSMS_SHORTNAME . '_nav_title_font_line_height'] . 
		'px ' . 
		(($google_font != '') ? "'" . $google_font . "', " : '') . 
		$cmsms_option[CMSMS_SHORTNAME . '_nav_title_font_system_font'];
	?>;
	font-weight:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_nav_title_font_font_weight']; ?>;
	font-style:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_nav_title_font_font_style']; ?>;
	text-transform:uppercase;
}

#navigation ul li a {
	font:<?php 
		if ($cmsms_option[CMSMS_SHORTNAME . '_nav_dropdown_font_google_font'] != '') {
			$google_font_array = explode(':', $cmsms_option[CMSMS_SHORTNAME . '_nav_dropdown_font_google_font']);
			
			$google_font = str_replace('+', ' ', $google_font_array[0]);
		} else {
			$google_font = '';
		}
		
		echo $cmsms_option[CMSMS_SHORTNAME . '_nav_dropdown_font_font_size'] . 
		'px/' . 
		$cmsms_option[CMSMS_SHORTNAME . '_nav_dropdown_font_line_height'] . 
		'px ' . 
		(($google_font != '') ? "'" . $google_font . "', " : '') . 
		$cmsms_option[CMSMS_SHORTNAME . '_nav_dropdown_font_system_font'];
	?>;
	font-weight:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_nav_dropdown_font_font_weight']; ?>;
	font-style:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_nav_dropdown_font_font_style']; ?>;
	text-transform:uppercase;
}


/* ====> Headings <==== */

h1,
h1 a,
.logo .title {
	font:<?php 
		if ($cmsms_option[CMSMS_SHORTNAME . '_h1_font_google_font'] != '') {
			$google_font_array = explode(':', $cmsms_option[CMSMS_SHORTNAME . '_h1_font_google_font']);
			
			$google_font = str_replace('+', ' ', $google_font_array[0]);
		} else {
			$google_font = '';
		}
		
		echo $cmsms_option[CMSMS_SHORTNAME . '_h1_font_font_size'] . 
		'px/' . 
		$cmsms_option[CMSMS_SHORTNAME . '_h1_font_line_height'] . 
		'px ' . 
		(($google_font != '') ? "'" . $google_font . "', " : '') . 
		$cmsms_option[CMSMS_SHORTNAME . '_h1_font_system_font'];
	?>;
	font-weight:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_h1_font_font_weight']; ?>;
	font-style:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_h1_font_font_style']; ?>;
}

h2,
h2 a,
.blog article.post .entry-header .entry-title,
.archive article.project .entry-header .entry-title,
.search article.project .entry-header .entry-title,
.blog article.post .entry-header .entry-title a,
.archive article.project .entry-header .entry-title a,
.search article.project .entry-header .entry-title a {
	font:<?php 
		if ($cmsms_option[CMSMS_SHORTNAME . '_h2_font_google_font'] != '') {
			$google_font_array = explode(':', $cmsms_option[CMSMS_SHORTNAME . '_h2_font_google_font']);
			
			$google_font = str_replace('+', ' ', $google_font_array[0]);
		} else {
			$google_font = '';
		}
		
		echo $cmsms_option[CMSMS_SHORTNAME . '_h2_font_font_size'] . 
		'px/' . 
		$cmsms_option[CMSMS_SHORTNAME . '_h2_font_line_height'] . 
		'px ' . 
		(($google_font != '') ? "'" . $google_font . "', " : '') . 
		$cmsms_option[CMSMS_SHORTNAME . '_h2_font_system_font'];
	?>;
	font-weight:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_h2_font_font_weight']; ?>;
	font-style:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_h2_font_font_style']; ?>;
}

h3,
h3 a,
.cmsms_sitemap > li > a,
.blog article.post.format-quote .entry-header blockquote,
.product .entry-summary .product_title,
.woocommerce-tabs h2,
.product .related > h2,
.product .upsells > h2,
.col2-set .col-1 > h2,
.col2-set .col-2 > h2,
.woocommerce-checkout .woocommerce h2,
.post_type_shortcode.type_post .post_type_shortcode_inner article .entry-header .entry-title,
.post_type_shortcode.type_post .post_type_shortcode_inner article .entry-header .entry-title a {
	font:<?php 
		if ($cmsms_option[CMSMS_SHORTNAME . '_h3_font_google_font'] != '') {
			$google_font_array = explode(':', $cmsms_option[CMSMS_SHORTNAME . '_h3_font_google_font']);
			
			$google_font = str_replace('+', ' ', $google_font_array[0]);
		} else {
			$google_font = '';
		}
		
		echo $cmsms_option[CMSMS_SHORTNAME . '_h3_font_font_size'] . 
		'px/' . 
		$cmsms_option[CMSMS_SHORTNAME . '_h3_font_line_height'] . 
		'px ' . 
		(($google_font != '') ? "'" . $google_font . "', " : '') . 
		$cmsms_option[CMSMS_SHORTNAME . '_h3_font_system_font'];
	?>;
	font-weight:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_h3_font_font_weight']; ?>;
	font-style:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_h3_font_font_style']; ?>;
}

h4,
h4 a,
.cmsms_sitemap > li > ul > li > a,
.cmsms_sitemap_category > li > a,
.cart-collaterals .cart_totals h2,
.product-category h3 {
	font:<?php 
		if ($cmsms_option[CMSMS_SHORTNAME . '_h4_font_google_font'] != '') {
			$google_font_array = explode(':', $cmsms_option[CMSMS_SHORTNAME . '_h4_font_google_font']);
			
			$google_font = str_replace('+', ' ', $google_font_array[0]);
		} else {
			$google_font = '';
		}
		
		echo $cmsms_option[CMSMS_SHORTNAME . '_h4_font_font_size'] . 
		'px/' . 
		$cmsms_option[CMSMS_SHORTNAME . '_h4_font_line_height'] . 
		'px ' . 
		(($google_font != '') ? "'" . $google_font . "', " : '') . 
		$cmsms_option[CMSMS_SHORTNAME . '_h4_font_system_font'];
	?>;
	font-weight:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_h4_font_font_weight']; ?>;
	font-style:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_h4_font_font_style']; ?>;
}

h5,
h5 a,
.table thead th,
.table tfoot th,
.shop_table thead th,
.shop_table tfoot tr.total th,
.shop_table tfoot tr.total td,
.blog article.post.format-quote .entry-header .quote-author,
.woocommerce.product .amount {
	font:<?php 
		if ($cmsms_option[CMSMS_SHORTNAME . '_h5_font_google_font'] != '') {
			$google_font_array = explode(':', $cmsms_option[CMSMS_SHORTNAME . '_h5_font_google_font']);
			
			$google_font = str_replace('+', ' ', $google_font_array[0]);
		} else {
			$google_font = '';
		}
		
		echo $cmsms_option[CMSMS_SHORTNAME . '_h5_font_font_size'] . 
		'px/' . 
		$cmsms_option[CMSMS_SHORTNAME . '_h5_font_line_height'] . 
		'px ' . 
		(($google_font != '') ? "'" . $google_font . "', " : '') . 
		$cmsms_option[CMSMS_SHORTNAME . '_h5_font_system_font'];
	?>;
	font-weight:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_h5_font_font_weight']; ?>;
	font-style:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_h5_font_font_style']; ?>;
}

.shop_table.order_details tfoot tr:nth-child(3) th,
.shop_table.order_details tfoot tr:nth-child(3) td {
	font:<?php 
		if ($cmsms_option[CMSMS_SHORTNAME . '_h5_font_google_font'] != '') {
			$google_font_array = explode(':', $cmsms_option[CMSMS_SHORTNAME . '_h5_font_google_font']);
			
			$google_font = str_replace('+', ' ', $google_font_array[0]);
		} else {
			$google_font = '';
		}
		
		echo $cmsms_option[CMSMS_SHORTNAME . '_h5_font_font_size'] . 
		'px/' . 
		$cmsms_option[CMSMS_SHORTNAME . '_h5_font_line_height'] . 
		'px ' . 
		(($google_font != '') ? "'" . $google_font . "', " : '') . 
		$cmsms_option[CMSMS_SHORTNAME . '_h5_font_system_font'];
	?>;
	font-weight:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_h5_font_font_weight']; ?>;
	font-style:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_h5_font_font_style']; ?>;
}

h6,
h6 a,
.widget_custom_popular_projects_entries .project_title a,
.widget_custom_latest_projects_entries .project_title a,
.woocommerce-result-count,
.order_details li > span {
	font:<?php 
		if ($cmsms_option[CMSMS_SHORTNAME . '_h6_font_google_font'] != '') {
			$google_font_array = explode(':', $cmsms_option[CMSMS_SHORTNAME . '_h6_font_google_font']);
			
			$google_font = str_replace('+', ' ', $google_font_array[0]);
		} else {
			$google_font = '';
		}
		
		echo $cmsms_option[CMSMS_SHORTNAME . '_h6_font_font_size'] . 
		'px/' . 
		$cmsms_option[CMSMS_SHORTNAME . '_h6_font_line_height'] . 
		'px ' . 
		(($google_font != '') ? "'" . $google_font . "', " : '') . 
		$cmsms_option[CMSMS_SHORTNAME . '_h6_font_system_font'];
	?>;
	font-weight:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_h6_font_font_weight']; ?>;
	font-style:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_h6_font_font_style']; ?>;
}


/* ====> Other <==== */

q,
blockquote {
	font:<?php 
		if ($cmsms_option[CMSMS_SHORTNAME . '_quote_font_google_font'] != '') {
			$google_font_array = explode(':', $cmsms_option[CMSMS_SHORTNAME . '_quote_font_google_font']);
			
			$google_font = str_replace('+', ' ', $google_font_array[0]);
		} else {
			$google_font = '';
		}
		
		echo $cmsms_option[CMSMS_SHORTNAME . '_quote_font_font_size'] . 
		'px/' . 
		$cmsms_option[CMSMS_SHORTNAME . '_quote_font_line_height'] . 
		'px ' . 
		(($google_font != '') ? "'" . $google_font . "', " : '') . 
		$cmsms_option[CMSMS_SHORTNAME . '_quote_font_system_font'];
	?>;
	font-weight:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_quote_font_font_weight']; ?>;
	font-style:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_quote_font_font_style']; ?>;
}

q:before,
blockquote:before {
	font-size:36px;
	line-height:1em;
	font-weight:normal;
}

span.dropcap,
span.dropcap2 {
	font:<?php 
		if ($cmsms_option[CMSMS_SHORTNAME . '_dropcap_font_google_font'] != '') {
			$google_font_array = explode(':', $cmsms_option[CMSMS_SHORTNAME . '_dropcap_font_google_font']);
			
			$google_font = str_replace('+', ' ', $google_font_array[0]);
		} else {
			$google_font = '';
		}
		
		echo $cmsms_option[CMSMS_SHORTNAME . '_dropcap_font_font_size'] . 
		'px/' . 
		$cmsms_option[CMSMS_SHORTNAME . '_dropcap_font_line_height'] . 
		'px ' . 
		(($google_font != '') ? "'" . $google_font . "', " : '') . 
		$cmsms_option[CMSMS_SHORTNAME . '_dropcap_font_system_font'];
	?>;
	font-weight:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_dropcap_font_font_weight']; ?>;
	font-style:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_dropcap_font_font_style']; ?>;
}

span.dropcap2 {
	font-size:24px;
	line-height:48px;
	height:48px;
}

code,
.table tbody td,
.shop_table tbody td {
	font:<?php 
		if ($cmsms_option[CMSMS_SHORTNAME . '_code_font_google_font'] != '') {
			$google_font_array = explode(':', $cmsms_option[CMSMS_SHORTNAME . '_code_font_google_font']);
			
			$google_font = str_replace('+', ' ', $google_font_array[0]);
		} else {
			$google_font = '';
		}
		
		echo $cmsms_option[CMSMS_SHORTNAME . '_code_font_font_size'] . 
		'px/' . 
		$cmsms_option[CMSMS_SHORTNAME . '_code_font_line_height'] . 
		'px ' . 
		(($google_font != '') ? "'" . $google_font . "', " : '') . 
		$cmsms_option[CMSMS_SHORTNAME . '_code_font_system_font'];
	?>;
	font-weight:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_code_font_font_weight']; ?>;
	font-style:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_code_font_font_style']; ?>;
}

small,
small a {
	font:<?php 
		if ($cmsms_option[CMSMS_SHORTNAME . '_small_font_google_font'] != '') {
			$google_font_array = explode(':', $cmsms_option[CMSMS_SHORTNAME . '_small_font_google_font']);
			
			$google_font = str_replace('+', ' ', $google_font_array[0]);
		} else {
			$google_font = '';
		}
		
		echo $cmsms_option[CMSMS_SHORTNAME . '_small_font_font_size'] . 
		'px/' . 
		$cmsms_option[CMSMS_SHORTNAME . '_small_font_line_height'] . 
		'px ' . 
		(($google_font != '') ? "'" . $google_font . "', " : '') . 
		$cmsms_option[CMSMS_SHORTNAME . '_small_font_system_font'];
	?>;
	font-weight:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_small_font_font_weight']; ?>;
	font-style:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_small_font_font_style']; ?>;
}

input,
textarea,
select,
option {
	font:<?php 
		if ($cmsms_option[CMSMS_SHORTNAME . '_input_font_google_font'] != '') {
			$google_font_array = explode(':', $cmsms_option[CMSMS_SHORTNAME . '_input_font_google_font']);
			
			$google_font = str_replace('+', ' ', $google_font_array[0]);
		} else {
			$google_font = '';
		}
		
		echo $cmsms_option[CMSMS_SHORTNAME . '_input_font_font_size'] . 
		'px/' . 
		$cmsms_option[CMSMS_SHORTNAME . '_input_font_line_height'] . 
		'px ' . 
		(($google_font != '') ? "'" . $google_font . "', " : '') . 
		$cmsms_option[CMSMS_SHORTNAME . '_input_font_system_font'];
	?>;
	font-weight:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_input_font_font_weight']; ?>;
	font-style:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_input_font_font_style']; ?>;
}

.tab.lpr .tabs li a {
	font-family:<?php 
		if ($cmsms_option[CMSMS_SHORTNAME . '_content_font_google_font'] != '') {
			$google_font_array = explode(':', $cmsms_option[CMSMS_SHORTNAME . '_content_font_google_font']);
			
			$google_font = str_replace('+', ' ', $google_font_array[0]);
		} else {
			$google_font = '';
		}
		
		echo (($google_font != '') ? "'" . $google_font . "', " : '') . 
		$cmsms_option[CMSMS_SHORTNAME . '_content_font_system_font'];
	?>;
}

.button,
.button_medium,
.button_large,
.button_small,
input[type="submit"],
.tog,
.tabs li a,
.related_posts > ul > li a,
.tour > li a,
.cmsms_currency,
.cmsms_price,
.cmsms_coins,
.blog article.post.format-aside .entry-header .entry-content,
.comment-reply-link,
.comment-edit-link,
.pj_sort a > span,
a.pj_cat_filter > span,
.widget .tl-content_wrap .tl_author_info a,
.product .price,
.cmsms_add_to_cart_button,
.cmsms_details_button,
.cmsms_dynamic_cart .widget_shopping_cart_content .total strong,
.widget.widget_shopping_cart .widget_shopping_cart_content .total strong {
	font-family:<?php 
		if ($cmsms_option[CMSMS_SHORTNAME . '_h5_font_google_font'] != '') {
			$google_font_array = explode(':', $cmsms_option[CMSMS_SHORTNAME . '_h5_font_google_font']);
			
			$google_font = str_replace('+', ' ', $google_font_array[0]);
		} else {
			$google_font = '';
		}
		
		echo (($google_font != '') ? "'" . $google_font . "', " : '') . 
		$cmsms_option[CMSMS_SHORTNAME . '_h5_font_system_font'];
	?>;
}

.colored_button,
.cmsms_pricing_table .title,
.cmsms_period {
	font-family:<?php 
		if ($cmsms_option[CMSMS_SHORTNAME . '_h1_font_google_font'] != '') {
			$google_font_array = explode(':', $cmsms_option[CMSMS_SHORTNAME . '_h1_font_google_font']);
			
			$google_font = str_replace('+', ' ', $google_font_array[0]);
		} else {
			$google_font = '';
		}
		
		echo (($google_font != '') ? "'" . $google_font . "', " : '') . 
		$cmsms_option[CMSMS_SHORTNAME . '_h1_font_system_font'];
	?>;
}

.post_type_shortcode article .entry-meta .post_category,
.post_type_shortcode article .entry-meta .post_category a,
.portfolio .project .entry-meta .cmsms_category,
.portfolio .project .entry-meta .cmsms_category a,
.project_navi a,
.cmsms_share,
.comment-body .cmsms_comment_info .published {
	font-size: <?php echo $cmsms_option[CMSMS_SHORTNAME . '_small_font_font_size'] . 'px'?>; 
	line-height: <?php echo $cmsms_option[CMSMS_SHORTNAME . '_small_font_line_height'] . 'px'?>; 
}


/* ===================> Colors <================== */

/* ====> Content <==== */
	
body {
	color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_content_font_font_color']; ?>;
}

/* ====> Links <==== */

a,
.tog,
.tour > li a,
.tour.active > li:first-child a,
.post_type_shortcode article .entry-title a:hover,
.portfolio .project .entry-title a:hover,
.cmsms_sitemap > li > a:hover,
.cmsms_sitemap > li > ul > li > a:hover,
.cmsms_sitemap_category > li > a:hover,
.tl_author a:hover,
.more_button:hover,
.blog article.post .entry-header .entry-title a:hover,
.archive article.project .entry-header .entry-title a:hover,
.search article.project .entry-header .entry-title a:hover,
.blog article.post.format-link .entry-header .entry-title a,
.project_navi a:hover,
.related_posts_content .rel_post_content h6 a:hover,
#page .woocommerce-breadcrumb a,
.widget_custom_popular_projects_entries .project_title a:hover,
.widget_custom_latest_projects_entries .project_title a:hover,
#wp-calendar caption,
#wp-calendar #today,
.product .product_inner .entry-title a:hover,
.cmsms_product_info .cmsms_product_info_text {
	color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_link_font_font_color']; ?>;
}

a:hover,
.button:hover,
.button_medium:hover,
.button_large:hover,
.button_small:hover,
input[type="submit"]:hover,
.tog:hover,
.tog.current,
.cmsmsLike,
.cmsmsLike:hover,
.cmsmsLike.active,
.tabs li a,
.related_posts > ul > li a,
.tab .tabs.active li:first-child a,
div.jp-playlist li a:hover,
div.jp-playlist li.jp-playlist-current a,
.tl_author a,
.more_button,
ul.page-numbers li .page-numbers.current,
ul.page-numbers li .page-numbers:hover,
.blog article.post .entry-header .entry-title a,
.archive article.project .entry-header .entry-title a,
.search article.project .entry-header .entry-title a,
.blog article.post.format-link .entry-header .entry-title a:hover,
.project_navi a,
.related_posts_content .rel_post_content h6 a,
ul.pj_filter_list li a:hover,
ul.pj_filter_list li.current a,
#page .woocommerce-breadcrumb,
#page .woocommerce-breadcrumb a:hover,
.widget_custom_popular_projects_entries .project_title a,
.widget_custom_latest_projects_entries .project_title a,
.product .product_inner .entry-title a,
.shop_table.cart .remove, 
.product-categories .cat-item.current-cat a {
	color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_link_font_hover']; ?>;
}

/* ====> Navigation <==== */

#navigation > li > a {
	color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_nav_title_font_font_color']; ?>;
}

#navigation li.current_page_item > a,
#navigation li.current_page_ancestor > a,
#navigation li.current-menu-ancestor > a,
#navigation li:hover > a:hover,
#navigation li:hover > a {
	color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_nav_title_font_hover']; ?>;
}

#navigation ul li > a,
#navigation > li.dropdown > a:hover {
	color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_nav_dropdown_font_font_color']; ?>;
}

#navigation li li.current_page_item > a,
#navigation li li.current_page_ancestor > a,
#navigation li li.current-menu-ancestor > a,
#navigation li li:hover > a:hover,
#navigation ul li:hover > a {
	color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_nav_dropdown_font_hover']; ?>;
}


/* ====> Headings <==== */

.logo .title {
	color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_text_logo_title_color']; ?>;
}

.logo .title_text {
	color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_text_logo_subtitle_color']; ?>;
}

h1,
.colored_button {
	color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_h1_font_font_color']; ?>;
}

h2,
.cart-collaterals .cart_totals h2 {
	color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_h2_font_font_color']; ?>;
}

h3,
.cmsms_sitemap > li > a {
	color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_h3_font_font_color']; ?>;
}

h4,
.post_type_shortcode article .entry-title a,
.portfolio .project .entry-title a,
.cmsms_sitemap > li > ul > li > a,
.cmsms_sitemap_category > li > a {
	color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_h4_font_font_color']; ?>;
}

h5 {
	color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_h5_font_font_color']; ?>;
}

h6 {
	color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_h6_font_font_color']; ?>;
}


/* ====> Other <==== */

q,
blockquote {
	color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_quote_font_font_color']; ?>;
}

span.dropcap {
	color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_dropcap_font_font_color']; ?>;
}

span.dropcap2 {
	color:#ffffff;
}

code {
	color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_code_font_font_color']; ?>;
}

small {
	color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_small_font_font_color']; ?>;
}

input,
textarea,
select,
select option {
	color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_input_font_font_color']; ?>;
}

.color_1,
q:before,
blockquote:before,
.product .price,
.col2-set .form-row label .required {
	color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_theme_color_1']; ?>;
}

.color_2 {
	color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_theme_color_2']; ?>;
}

.color_3 {
	color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_theme_color_3']; ?>;
}

.color_4 {
	color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_theme_color_4']; ?>;
}

.headline h1,
.headline h5,
.table thead th,
.table tfoot th,
.shop_table thead th,
.shop_table tfoot tr.total th,
.shop_table tfoot tr.total td,
.button,
.button_medium,
.button_large,
.button_small,
input[type="submit"],
.colored_title_inner *,
.colored_title_inner h1,
.colored_title_inner h2,
.colored_title_inner h3,
.colored_title_inner h4,
.colored_title_inner h5,
.colored_title_inner h6,
.colored_banner_inner *,
.colored_banner_inner h1,
.colored_banner_inner h2,
.colored_banner_inner h3,
.colored_banner_inner h4,
.colored_banner_inner h5,
.colored_banner_inner h6,
.accordion .tog:hover,
.accordion .tog.current,
.tab .tabs li:first-child a,
.tab .tabs.active li.current a,
.tab .tabs.active li.current:first-child a,
.tab .tabs.active li:first-child a:hover,
.tab .tabs li.current a,
.tab .tabs li a:hover,
.woocommerce-tabs .tabs li.active a,
.woocommerce-tabs .tabs li a:hover,
.related_posts > ul > li a.current,
.related_posts > ul > li a:hover,
.tour > li a:hover,
.tour.active > li:first-child a:hover,
.tour > li:first-child a,
.tour li.current a,
.tour.active li:first-child.current a,
.cmsms_pricing_table .title,
.cmsms_currency,
.cmsms_price,
.cmsms_coins,
.cmsms_period,
.pricing_footer .button:hover,
.percent_item,
.error h1,
.cmsms_timeline_header .entry-title a,
.cmsms_timeline_date,
.blog article.post.format-quote .entry-header *,
.about_author > h6,
.comment-body .cmsms_comment_info *,
.pj_sort a > span,
a.pj_cat_filter > span,
.pj_side_bar > h4,
.tweet_list li .tweet_time,
.widget .tl-content_wrap .tl_author_info,
.widget .tl-content_wrap .tl_author_info *,
.woocommerce-result-count,
.product .onsale,
.product .product_inner .out-of-stock,
.cmsms_add_to_cart_button,
.cmsms_details_button,
.cmsms_add_to_cart_button:hover,
.cmsms_details_button:hover,
.cmsms_product_comment_info,
.cmsms_product_comment_info *,
.payment_methods li .payment_box,
.shop_table.order_details tfoot tr + tr + tr th,
.shop_table.order_details tfoot tr + tr + tr td,
.order_details li > span,
.cmsms_wrap_basket > span,
.cmsms_wrap_basket > a,
.post_type_shortcode.type_post .post_type_shortcode_inner > h3,
.post_type_shortcode.type_post .post_type_shortcode_inner > h3 .cmsms_post_type_link {
	color:#ffffff;
}


/* ===================> Backgrounds and Borders <================== */

#slide_top:hover,
span.dropcap2,
.button,
.button_medium,
.button_large,
.button_small,
input[type="submit"],
.cmsms_content_slider_parent ul.cmsms_slides_nav li.active a,
.cmsms_content_slider_parent ul.cmsms_slides_nav li a:hover,
.togg .tog.current .cmsms_check,
.accordion .tog:hover,
.accordion .tog.current,
.accordion .tog:hover .cmsms_check,
.accordion .tog.current .cmsms_check,
.tab .tabs li:first-child a,
.tab .tabs.active li.current a,
.tab .tabs.active li.current:first-child a,
.tab .tabs.active li:first-child a:hover,
.tab .tabs li.current a,
.tab .tabs li a:hover,
.woocommerce-tabs .tabs li.active a,
.woocommerce-tabs .tabs li a:hover,
.related_posts > ul > li a.current,
.related_posts > ul > li a:hover,
.tour > li a:hover,
.tour.active > li:first-child a:hover,
.tour > li:first-child a,
.tour li.current a,
.tour.active li:first-child.current a,
.tour > li a:hover .cmsms_check,
.tour.active > li:first-child a:hover .cmsms_check,
.tour > li:first-child a .cmsms_check,
.tour li.current a .cmsms_check,
.tour.active li:first-child.current a .cmsms_check,
.cmsms_content_prev_slide:hover,
.cmsms_content_next_slide:hover,
.percent_item_colored,
.cmsms_timeline > article:hover:before,
ul.page-numbers li .page-numbers.prev:hover,
ul.page-numbers li .page-numbers.next:hover,
.blog article.post.format-quote .entry-header,
.pj_sort a:hover > span,
.pj_sort a.current > span,
a.pj_cat_filter:hover > span,
.pj_filter_container:hover a.pj_cat_filter > span,
.product .onsale,
.star-rating span,
#review_form_wrapper #commentform .stars span a:hover,
#review_form_wrapper #commentform .stars span a:focus,
#review_form_wrapper #commentform .stars span a.active,
.woocommerce .shop_table.cart .actions .button.checkout-button,
.project .cmsmsLike:hover,
.project .cmsmsLike.active, 
.widget_price_filter .price_slider_wrapper .price_slider .ui-slider-handle {
	background-color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_theme_color_1']; ?>;
}

.product .product_inner .out-of-stock {
	background-color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_theme_color_2']; ?>;
}

.table thead th,
.table tfoot th,
.shop_table thead th,
.shop_table tfoot tr.total th,
.shop_table tfoot tr.total td,
.shop_table.order_details tfoot tr + tr + tr th,
.shop_table.order_details tfoot tr + tr + tr td,
.colored_title_inner,
.cmsms_timeline_header,
.cmsms_timeline > article:before,
.about_author > h6,
.pj_sort_block,
.pj_side_bar > h4,
.widget_custom_flickr_entries .flickr_badge_image a:hover img,
body .tweet_list li .tweet_time,
.widget_custom_popular_projects_entries .cmsms_content_slider_parent ul.cmsms_slides_nav li a:hover,
.widget_custom_latest_projects_entries .cmsms_content_slider_parent ul.cmsms_slides_nav li a:hover,
.widget_custom_recent_testimonials_entries .cmsms_content_slider_parent ul.cmsms_slides_nav li a:hover,
.widget_custom_popular_projects_entries .cmsms_content_slider_parent ul.cmsms_slides_nav li.active a,
.widget_custom_latest_projects_entries .cmsms_content_slider_parent ul.cmsms_slides_nav li.active a,
.widget_custom_recent_testimonials_entries .cmsms_content_slider_parent ul.cmsms_slides_nav li.active a,
.widget .tl-content_wrap .tl_author_info,
.cmsms_wrap_result,
.cmsms_dynamic_cart .widget_shopping_cart_content:before,
.cmsms_product_comment_info,
.payment_methods li .payment_box,
.order_details li > span,
.responsive_nav,
.responsive_nav:hover span,
.responsive_nav:hover span:before,
.responsive_nav:hover span:after,
.responsive_nav.active span,
.responsive_nav.active span:before,
.responsive_nav.active span:after,
.post_type_shortcode.type_post .post_type_shortcode_inner > h3,
#navigation > li > a > span:before {
	background-color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_theme_color_3']; ?>;
}

.comment-body .cmsms_comment_info,
.cmsms_dynamic_cart .widget_shopping_cart_content .buttons .button.checkout,
.widget.widget_shopping_cart .widget_shopping_cart_content .buttons .button.checkout,
.product .product_inner .added_to_cart,
.product .entry-summary .cart .button,
.woocommerce .shop_table.cart .actions .coupon .button,
.woocommerce .shop_table.cart .actions .button {
	background-color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_theme_color_4']; ?>;
}

.accordion .tog .cmsms_check,
.tour > li a .cmsms_check,
.tour.active > li:first-child a .cmsms_check {
	background-color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_link_font_font_color']; ?>;
}

.button:hover,
.button_medium:hover,
.button_large:hover,
.button_small:hover,
input[type="submit"]:hover,
.cmsms_dynamic_cart .widget_shopping_cart_content .buttons .button.checkout:hover,
.widget.widget_shopping_cart .widget_shopping_cart_content .buttons .button.checkout:hover,
.box.css_box,
.colored_button,
.togg .tog .cmsms_check,
.accordion .tog,
.tour > li a,
.tour.active > li:first-child a,
.cmsms_content_prev_slide,
.cmsms_content_next_slide,
div.jp-playlist li,
.cmsms_pricing_table,
.percent_item,
.person_block,
.cmsms_timeline_content,
.tl-content_wrap,
ul.page-numbers li .page-numbers,
.about_author .about_author_inner,
.comment-body,
.pj_side_bar,
.widget_custom_flickr_entries .flickr_badge_image a img,
.tab.lpr .tab_content,
.tweet_list li .tweet_text,
#wp-calendar caption:before,
.product .woocommerce-tabs .comment_container,
.cart .quantity .minus:hover,
.cart .quantity .plus:hover,
.product .entry-summary .cart .button:hover,
.shop_table tfoot tr th,
.shop_table tfoot tr td,
#payment,
.woocommerce .shop_table.cart .actions .coupon .button:hover,
.woocommerce .shop_table.cart .actions .button:hover,
.woocommerce .shop_table.cart .actions .button.checkout-button:hover,
.widget_custom_colored_blocks_entries,
.post_type_shortcode.type_post .post_type_shortcode_inner article, 
.widget_price_filter .price_slider_wrapper .price_slider .ui-slider-range {
	background-color:#fffae6;
}
.shop_table.my_account_orders tr:nth-child(2n),
.shop_table tbody tr:nth-child(2n) td,
.cart_totals table tbody tr:nth-child(2n+1) td,
.cart_totals table tbody tr:nth-child(2n+1) th {
	background-color:#fffae6;
}

.cmsmsLike {background-color:#eae9e9;}

.woocommerce .shop_table.cart .actions .coupon .input-text:focus,
input[type="text"]:focus,
input[type="number"]:focus,
input[type="search"]:focus,
input[type="email"]:focus,
input[type="password"]:focus,
textarea:focus,
select:focus {
	border-color:#252525;
}

.cmsms_tags a:before {
	border-top-color:#eae9e9;
	border-right-color:#eae9e9;
	border-left-color:#eae9e9;
}

.cmsmsLike:hover,
.cmsmsLike.active,
.project .cmsmsLike {background-color:#2e2927;}

.cmsms_tags a:hover:before {
	border-top-color:#2e2927;
	border-right-color:#2e2927;
	border-left-color:#2e2927;
}

code,
#page .product .onsale:before {
	border-top-color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_theme_color_1']; ?>;
}

#page .product .onsale:before {
	border-bottom-color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_theme_color_1']; ?>;
}

#page .product .out-of-stock:before {
	border-top-color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_theme_color_2']; ?>;
}

#page .product .out-of-stock:before {
	border-bottom-color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_theme_color_2']; ?>;
}

.widget_custom_flickr_entries .flickr_badge_image a:hover img,
.woocommerce-ordering select,
.cmsms_dynamic_cart .cmsms_product_info {
	border-color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_theme_color_3']; ?>;
}

.cmsms_timeline_header:before {
	border-<?php echo ((is_rtl()) ? 'left' : 'right') ?>-color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_theme_color_3']; ?>;
}

.tweet_list li .tweet_time:before,
#navigation > li > a:after, 
#navigation > li > a > span:after {
	border-top-color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_theme_color_3']; ?>;
}

.payment_methods li .payment_box:before {
	border-bottom-color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_theme_color_3']; ?>;
}

#page .product .product_inner .added_to_cart:before {
	border-top-color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_theme_color_4']; ?>;
}

#page .product .product_inner .added_to_cart:before {
	border-bottom-color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_theme_color_4']; ?>;
}

.error h1 {
	background-color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_error_bg_color']; ?>;
	background-image:url(<?php echo ($cmsms_option[CMSMS_SHORTNAME . '_error_bg_image'] != '' && $cmsms_option[CMSMS_SHORTNAME . '_error_bg_image'] != get_template_directory_uri() . '/framework/admin/inc/img/image.png') ? ((is_numeric($cmsms_option[CMSMS_SHORTNAME . '_error_bg_image'])) ? array_shift(wp_get_attachment_image_src($cmsms_option[CMSMS_SHORTNAME . '_error_bg_image'], 'full')) : $cmsms_option[CMSMS_SHORTNAME . '_error_bg_image']) : ''; ?>);
}

<?php 
$i = 1;

foreach ($cmsms_option[CMSMS_SHORTNAME . '_social_icons'] as $cmsms_social_icons) {
	$cmsms_social_icon = explode('|', str_replace(' ', '', $cmsms_social_icons));
	
	echo '.social_icons li:nth-child(' . $i . ') a:hover {background-color:' . $cmsms_social_icon[1] . ' !important;}' . "\n";
	
	$i++;
}
?>


/* ---------- Small Monitor (Note: Design for a width less than 1024px) ---------- */

@media only screen and (max-width: 1023px) {
	
	#page #navigation > li > a,
	#page #navigtion li.current_page_item > a,
	#page #navigation li.current_page_ancestor > a,
	#page #navigation li.current-menu-ancestor > a,
	#page #navigation li:hover > a:hover,
	#page #navigation li:hover > a,
	#page #navigation ul li > a,
	#page #navigation li li.current_page_item > a,
	#page #navigation li li.current_page_ancestor > a,
	#page #navigation li li.current-menu-ancestor > a,
	#page #navigation li li:hover > a:hover,
	#page #navigation ul li:hover > a {
		font-family:<?php 
			if ($cmsms_option[CMSMS_SHORTNAME . '_h5_font_google_font'] != '') {
				$google_font_array = explode(':', $cmsms_option[CMSMS_SHORTNAME . '_h5_font_google_font']);
				
				$google_font = str_replace('+', ' ', $google_font_array[0]);
			} else {
				$google_font = '';
			}
			
			echo (($google_font != '') ? "'" . $google_font . "', " : '') . 
			$cmsms_option[CMSMS_SHORTNAME . '_h5_font_system_font'];
		?>;
		font-size:13px;
		font-weight:normal;
		text-transform:none;
		color:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_link_font_font_color']; ?>;
	}
	
	#page #navigation li > a:hover,
	#page #navigation li.current_page_item > a,
	#page #navigation li.current_page_ancestor > a,
	#page #navigation li.current-menu-ancestor > a,
	#page #navigation li:hover > a:hover,
	#page #navigation li:hover > a,
	#page #navigation li li.current_page_item > a,
	#page #navigation li li.current_page_ancestor > a,
	#page #navigation li li.current-menu-ancestor > a,
	#page #navigation li li:hover > a:hover,
	#page #navigation ul li:hover > a,
	#page #navigation li a.drop_active {
		background:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_theme_color_3']; ?>;
		color:#ffffff;
	}
	
}


@media only screen and (max-width: 540px) {

	#page .woocommerce .shop_table.cart tbody td.product-name,
	#page .woocommerce .shop_table.cart tbody td.product-name a,
	#page .woocommerce .shop_table.cart tbody td.product-thumbnail {
		background:<?php echo $cmsms_option[CMSMS_SHORTNAME . '_theme_color_3']; ?>;
		color:#ffffff;
		font-family:<?php 
			if ($cmsms_option[CMSMS_SHORTNAME . '_h5_font_google_font'] != '') {
				$google_font_array = explode(':', $cmsms_option[CMSMS_SHORTNAME . '_h5_font_google_font']);
				
				$google_font = str_replace('+', ' ', $google_font_array[0]);
			} else {
				$google_font = '';
			}
			
			echo (($google_font != '') ? "'" . $google_font . "', " : '') . 
			$cmsms_option[CMSMS_SHORTNAME . '_h5_font_system_font'];
		?>;
	}
	
}

