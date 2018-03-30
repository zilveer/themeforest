<?php
	if ( isset( $ct_options['ct_rtl_styles'] ) ) $rtl_styles = $ct_options['ct_rtl_styles'];

	/* Menu */
	if ( isset( $ct_options['ct_menu_transform'] ) ) $menu_transform = strtolower( $ct_options['ct_menu_transform'] );
	if ( isset( $ct_options['ct_menu_font'] ) ) $menu_font = $ct_options['ct_menu_font'];
	if ( isset( $ct_options['ct_dd_menu_font'] ) ) $dd_menu_font = $ct_options['ct_dd_menu_font'];
	if ( isset( $ct_options['ct_menu_hover_color'] ) ) $menu_hover_color = $ct_options['ct_menu_hover_color'];
	if ( isset( $ct_options['ct_menu_hover_background'] ) ) $menu_hover_background = $ct_options['ct_menu_hover_background'];
	if ( isset( $ct_options['ct_dd_menu_background'] ) ) $dd_menu_background = $ct_options['ct_dd_menu_background'];
	if ( isset( $ct_options['ct_dd_menu_opacity'] ) ) $dd_menu_opacity = $ct_options['ct_dd_menu_opacity'];
	if ( isset( $ct_options['ct_dd_menu_hover_background'] ) ) $dd_menu_hover_background = $ct_options['ct_dd_menu_hover_background'];
	if ( isset( $ct_options['ct_dd_menu_hover_color'] ) ) $dd_menu_hover_color = $ct_options['ct_dd_menu_hover_color'];
	if ( isset( $ct_options['ct_menu_position'] ) ) $menu_position = strtolower ( $ct_options['ct_menu_position'] );
	if ( isset( $ct_options['ct_menu_default_bg_color'] ) ) $menu_default_bg_color = strtolower ( $ct_options['ct_menu_default_bg_color'] );
	if ( isset( $ct_options['ct_menu_top_padding'] ) ) $menu_top_padding = $ct_options['ct_menu_top_padding'];
	if ( isset( $ct_options['ct_menu_right_padding'] ) ) $menu_right_padding = $ct_options['ct_menu_right_padding'];
	if ( isset( $ct_options['ct_menu_bottom_padding'] ) ) $menu_bottom_padding = $ct_options['ct_menu_bottom_padding'];
	if ( isset( $ct_options['ct_menu_left_padding'] ) ) $menu_left_padding = $ct_options['ct_menu_left_padding'];

	/* Widgets */
	if ( isset( $ct_options['ct_widget_title_bg_color'] ) ) $widget_title_bg_color = $ct_options['ct_widget_title_bg_color'];
	if ( isset( $ct_options['ct_widget_title_font'] ) ) $widget_title_font = $ct_options['ct_widget_title_font'];
	if ( isset( $ct_options['ct_widget_gap'] ) ) $widget_gap = $ct_options['ct_widget_gap'];
	if ( isset( $ct_options['ct_widget_title_top_padding'] ) ) $widget_title_top_padding = $ct_options['ct_widget_title_top_padding'];
	if ( isset( $ct_options['ct_widget_title_right_padding'] ) ) $widget_title_right_padding = $ct_options['ct_widget_title_right_padding'];
	if ( isset( $ct_options['ct_widget_title_bottom_padding'] ) ) $widget_title_bottom_padding = $ct_options['ct_widget_title_bottom_padding'];
	if ( isset( $ct_options['ct_widget_title_left_padding'] ) ) $widget_title_left_padding = $ct_options['ct_widget_title_left_padding'];
	if ( isset( $ct_options['ct_widget_arrow'] ) ) $widget_arrow = $ct_options['ct_widget_arrow'];

	if ( isset( $ct_options['ct_blog_title_color'] ) ) $blog_title_color = $ct_options['ct_blog_title_color'];

	/* Logo */
	if ( isset( $ct_options['ct_logo_top_margin'] ) ) $logo_top_margin = $ct_options['ct_logo_top_margin'];
	if ( isset( $ct_options['ct_logo_right_margin'] ) ) $logo_right_margin = $ct_options['ct_logo_right_margin'];
	if ( isset( $ct_options['ct_logo_bottom_margin'] ) ) $logo_bottom_margin = $ct_options['ct_logo_bottom_margin'];
	if ( isset( $ct_options['ct_logo_left_margin'] ) ) $logo_left_margin = $ct_options['ct_logo_left_margin'];
	if ( isset( $ct_options['ct_logo_font'] ) ) $logo_font = $ct_options['ct_logo_font'];
	if ( isset( $ct_options['ct_logo_slogan_font'] ) ) $logo_slogan_font = $ct_options['ct_logo_slogan_font'];
	if ( isset( $ct_options['ct_logo_width'] ) ) $logo_width = $ct_options['ct_logo_width'];

	/* Show Featured Image */
	if ( isset( $ct_options['ct_featured_image_post'] ) ) $featured_image_post = $ct_options['ct_featured_image_post'];

	/* Responsive Layout */
	if ( isset( $ct_options['ct_responsive_layout'] ) ) $responsive_layout = $ct_options['ct_responsive_layout'];

	/* Stretch thumbnail post images */
	if ( isset( $ct_options['ct_thumb_posts_stretch'] ) ) $thumb_posts_stretch = $ct_options['ct_thumb_posts_stretch'];

	/* Links Color */
	if ( isset( $ct_options['ct_links_color'] ) ) $links_color = stripslashes ( $ct_options['ct_links_color'] );
	if ( isset( $ct_options['ct_links_hover_color'] ) ) $links_hover_color = stripslashes ( $ct_options['ct_links_hover_color'] );
	if ( isset( $ct_options['ct_links_alt_color'] ) ) $links_alt_color = stripslashes ( $ct_options['ct_links_alt_color'] );
	if ( isset( $ct_options['ct_meta_font'] ) ) $meta_font = $ct_options['ct_meta_font'];

	/* Top Blocks Settings */
	if ( isset( $ct_options['ct_social_font_color'] ) ) $social_font_color = stripslashes ( $ct_options['ct_social_font_color'] );

	/* Body background Color */
	if ( isset( $ct_options['ct_body_background'] ) ) $body_background = stripslashes ( $ct_options['ct_body_background'] );

	/* Header bg */
	//if ( isset( $ct_options['ct_header_width'] ) ) $header_width = stripslashes ( $ct_options['ct_header_width'] );
	if ( isset( $ct_options['ct_header_background'] ) ) $header_background = stripslashes ( $ct_options['ct_header_background'] );
	if ( isset( $ct_options['ct_header_bg_type'] ) ) $header_bg_type = stripslashes ( $ct_options['ct_header_bg_type'] );
	if ( isset( $ct_options['ct_header_bg_repeat'] ) ) $header_bg_repeat = strtolower( $ct_options['ct_header_bg_repeat'] );
	if ( isset( $ct_options['ct_header_bg_image'] ) ) $header_bg_image = stripslashes ( $ct_options['ct_header_bg_image'] );
	if ( isset( $ct_options['ct_header_predefined_bg'] ) ) $header_predefined_bg = $ct_options['ct_header_predefined_bg'];

	/* Breadcrumb bg */
	if ( isset( $ct_options['ct_breadcrumb_background'] ) ) $breadcrumb_background = stripslashes ( $ct_options['ct_breadcrumb_background'] );
	if ( isset( $ct_options['ct_breadcrumb_bg_type'] ) ) $breadcrumb_bg_type = stripslashes ( $ct_options['ct_breadcrumb_bg_type'] );
	if ( isset( $ct_options['ct_breadcrumb_bg_repeat'] ) ) $breadcrumb_bg_repeat = strtolower( $ct_options['ct_breadcrumb_bg_repeat'] );
	if ( isset( $ct_options['ct_breadcrumb_bg_image'] ) ) $breadcrumb_bg_image = stripslashes ( $ct_options['ct_breadcrumb_bg_image'] );
	if ( isset( $ct_options['ct_breadcrumb_predefined_bg'] ) ) $breadcrumb_predefined_bg = $ct_options['ct_breadcrumb_predefined_bg'];
	if ( isset( $ct_options['ct_breadcrumb_font'] ) ) $breadcrumb_font = $ct_options['ct_breadcrumb_font'];
	if ( isset( $ct_options['ct_breadcrumb_links_color'] ) ) $breadcrumb_links_color = $ct_options['ct_breadcrumb_links_color'];

	/* Footer bg */
	if ( isset( $ct_options['ct_footer_background'] ) ) $footer_background = stripslashes ( $ct_options['ct_footer_background'] );
	if ( isset( $ct_options['ct_footer_bg_type'] ) ) $footer_bg_type = stripslashes ( $ct_options['ct_footer_bg_type'] );
	if ( isset( $ct_options['ct_footer_bg_repeat'] ) ) $footer_bg_repeat = strtolower( $ct_options['ct_footer_bg_repeat'] );
	if ( isset( $ct_options['ct_footer_bg_image'] ) ) $footer_bg_image = stripslashes ( $ct_options['ct_footer_bg_image'] );
	if ( isset( $ct_options['ct_footer_predefined_bg'] ) ) $footer_predefined_bg = $ct_options['ct_footer_predefined_bg'];
	if ( isset( $ct_options['ct_footer_font'] ) ) $footer_font = $ct_options['ct_footer_font'];
	if ( isset( $ct_options['ct_footer_font_link'] ) ) $footer_font_link = $ct_options['ct_footer_font_link'];
	if ( isset( $ct_options['ct_footer_title_color'] ) ) $footer_title_color = $ct_options['ct_footer_title_color'];
	if ( isset( $ct_options['ct_footer_bg_copyright_color'] ) ) $footer_bg_copyright_color = $ct_options['ct_footer_bg_copyright_color'];
	if ( isset( $ct_options['ct_footer_widgets_color'] ) ) $footer_widgets_color = $ct_options['ct_footer_widgets_color'];

	/* Headings Options: Size, Style, Color */
	if ( isset( $ct_options['ct_h_one'] ) ) $h_one = $ct_options['ct_h_one'];
	if ( isset( $ct_options['ct_h_two'] ) ) $h_two = $ct_options['ct_h_two'];
	if ( isset( $ct_options['ct_h_three'] ) ) $h_three = $ct_options['ct_h_three'];
	if ( isset( $ct_options['ct_h_four'] ) ) $h_four = $ct_options['ct_h_four'];
	if ( isset( $ct_options['ct_h_five'] ) ) $h_five = $ct_options['ct_h_five'];
	if ( isset( $ct_options['ct_h_six'] ) ) $h_six = $ct_options['ct_h_six'];
	if ( isset( $ct_options['ct_post_title_font'] ) ) $post_title_font = $ct_options['ct_post_title_font'];
	if ( isset( $ct_options['ct_post_title_transform'] ) ) $post_title_transform = strtolower( $ct_options['ct_post_title_transform'] );

	if ( isset( $ct_options['ct_body_font'] ) ) $body_font = $ct_options['ct_body_font'];

	if ( isset( $ct_options['ct_shop_sidebar_position'] ) ) $ct_shop_sidebar_position = $ct_options['ct_shop_sidebar_position'];
	if ( isset( $ct_options['ct_shop_columns'] ) ) $ct_shop_columns = $ct_options['ct_shop_columns'];
	/*if ( isset( $ct_options['ct_shop_products_per_row'] ) ) $ct_shop_products_per_row = $ct_options['ct_shop_products_per_row'];*/
	if ( isset( $ct_options['ct_shop_show_title'] ) ) $ct_shop_show_title = $ct_options['ct_shop_show_title'];
	if ( isset( $ct_options['ct_shop_bg_title_color'] ) ) $ct_shop_bg_title_color = $ct_options['ct_shop_bg_title_color'];
	if ( isset( $ct_options['ct_shop_font_title_color'] ) ) $ct_shop_font_title_color = $ct_options['ct_shop_font_title_color'];
	if ( isset( $ct_options['ct_shop_onsale_color'] ) ) $ct_shop_onsale_color = $ct_options['ct_shop_onsale_color'];
	if ( isset( $ct_options['ct_shop_outofstock_color'] ) ) $ct_shop_outofstock_color = $ct_options['ct_shop_outofstock_color'];
	if ( isset( $ct_options['ct_shop_instock_color'] ) ) $ct_shop_instock_color = $ct_options['ct_shop_instock_color'];

	if ( isset( $ct_options['ct_blog_pagination_type'] ) ) $ct_blog_pagination_type = $ct_options['ct_blog_pagination_type'];
	if ( isset( $ct_options['ct_cat_pagination_type'] ) ) $ct_cat_pagination_type = $ct_options['ct_cat_pagination_type'];
?>

<?php if ( $ct_shop_sidebar_position == 'none' ) : ?>
	.product-block { width: 29.7%; }
<?php endif; ?>

body {
	color: <?php echo $body_font['color']; ?>;
	font-size: <?php echo $body_font['size']; ?>; 
	line-height: <?php echo $body_font['height']; ?>; 
}

/* Logo Settings */
#logo { margin: <?php echo $logo_top_margin.'px '.$logo_right_margin.'px '.$logo_bottom_margin.'px '.$logo_left_margin.'px'; ?>}
#logo h1 {
	color: <?php echo $logo_font['color']; ?>;
	<?php if( $logo_font['style'] == 'normal' || $logo_font['style'] == 'italic') { ?>font-style: <?php echo $logo_font['style']; ?>;<?php } ?>	
	<?php if( $logo_font['style'] == 'bold' || $logo_font['style'] == 'bold italic') { ?>font-weight: <?php echo $logo_font['style']; ?>;<?php } ?>	
	font-size: <?php echo $logo_font['size']; ?>; 
	line-height: <?php echo $logo_font['height']; ?>; 
}
#logo h1 a { color: <?php echo $logo_font['color']; ?>; }
.logo-slogan {
	color: <?php echo $logo_slogan_font['color']; ?>;
	<?php if( $logo_slogan_font['style'] == 'normal' || $logo_slogan_font['style'] == 'italic') { ?>font-style: <?php echo $logo_slogan_font['style']; ?>;<?php } ?>	
	<?php if( $logo_slogan_font['style'] == 'bold' || $logo_slogan_font['style'] == 'bold italic') { ?>font-weight: <?php echo $logo_slogan_font['style']; ?>;<?php } ?>	
	font-size: <?php echo $logo_slogan_font['size']; ?>; 
	line-height: <?php echo $logo_slogan_font['height']; ?>; 
}

<?php if ( $logo_width == 'wide' ) : ?>
#logo { text-align: center; }
<?php endif; //$header_bg_type ?>


/* Top Blocks Settings */
#social-icons-block i { color: <?php echo $social_font_color; ?>; }

/* Header Bg */
<?php if ( $header_bg_type == 'Color' ) : ?>
	.ct-top-entry { background: <?php echo $header_background; ?>; }
<?php elseif ( $header_bg_type == 'Predefined' ) : ?>
	.ct-top-entry {
		background: url(<?php echo $header_predefined_bg; ?>) left top <?php echo $header_bg_repeat?>;
		background-color: <?php echo $header_background; ?>;
	}
<?php elseif ( $header_bg_type == 'Uploaded' ) : ?>
	.ct-top-entry {
		background: url(<?php echo $header_bg_image; ?>) left top <?php echo $header_bg_repeat?>;
		background-color: <?php echo $header_background; ?>;
	}
<?php endif; //$header_bg_type ?>	



/* Breadcrumb Settings */
<?php if ( $breadcrumb_bg_type == 'Color' ) : ?>
	.entry-navigation { background-color: <?php echo $breadcrumb_background; ?>; }
<?php elseif ( $breadcrumb_bg_type == 'Predefined' ) : ?>
	.entry-navigation {
		background: url(<?php echo $breadcrumb_predefined_bg; ?>) left top <?php echo $breadcrumb_bg_repeat?>;
		background-color: <?php echo $breadcrumb_background; ?>;
	}
<?php elseif ( $breadcrumb_bg_type == 'Uploaded' ) : ?>
	.entry-navigation {
		background: url(<?php echo $breadcrumb_bg_image; ?>) left top <?php echo $breadcrumb_bg_repeat?>;
		background-color: <?php echo $breadcrumb_background; ?>;
	}
<?php endif; //$header_bg_type ?>	

.entry-breadcrumb {
	font-size: <?php echo $breadcrumb_font['size']; ?>;
	color: <?php echo $breadcrumb_font['color']; ?>;
	<?php if( $breadcrumb_font['style'] == 'normal' || $breadcrumb_font['style'] == 'italic') { ?>font-style: <?php echo $breadcrumb_font['style']; ?>;<?php } ?>	
	<?php if( $breadcrumb_font['style'] == 'bold' || $breadcrumb_font['style'] == 'bold italic') { ?>font-weight: <?php echo $breadcrumb_font['style']; ?>;<?php } ?>	
}

.entry-breadcrumb a { color: <?php echo $breadcrumb_links_color ?>; }


/* Footer Settings */
<?php if ( $footer_bg_type == 'Color' ) : ?>
	#footer { background: <?php echo $footer_background; ?>; }
<?php elseif ( $footer_bg_type == 'Predefined' ) : ?>
	#footer {
		background: url(<?php echo $footer_predefined_bg; ?>) left top <?php echo $footer_bg_repeat?>;
		background-color: <?php echo $footer_background; ?>;
	}
<?php elseif ( $footer_bg_type == 'Uploaded' ) : ?>
	#footer {
		background: url(<?php echo $footer_bg_image; ?>) left top <?php echo $footer_bg_repeat?>;
		background-color: <?php echo $footer_background; ?>;
	}
<?php endif; //$footer_bg_type ?>

#footer .widget-title { background-color: <?php echo $footer_title_color; ?>; }
#footer .widget .bottom-triangle { border-top-color: <?php echo $footer_title_color; ?>; }

#footer .ct-copyright a { color: <?php echo $footer_font_link; ?>; }
#footer .ct-copyright { color: <?php echo $footer_font['color']; ?>; font-size: <?php echo $footer_font['size']; ?>; background-color: <?php echo $footer_bg_copyright_color; ?>; }

#footer h4.entry-title a,
#footer .ct-comments-widget h4,
#footer .ct-comments-widget h4 a,
#footer .widget_recent_entries a,
#footer .widget_recent_comments a,
#footer .widget_nav_menu a,
#footer .widget_categories a,
#footer .widget_archive a,
#footer .ct-blog-widget h2 a,
#footer .ct-categories-widget a,
#footer .widget_recent_entries li:before,
#footer .widget_recent_comments li:before,
#footer .widget_nav_menu li:before,
#footer .widget_categories li:before,
#footer .widget_archive li:before,
#footer .ct-categories-widget li:before { color: <?php echo $footer_widgets_color; ?>; }


/*
   ------------------------------------------------------
						Menu
   ------------------------------------------------------
*/
.sf-menu a {
	text-transform: <?php echo $menu_transform; ?>;
	font-size: <?php echo $menu_font['size']; ?>;
	color: <?php echo $menu_font['color']; ?>;
	<?php if( $menu_font['style'] == 'normal' || $menu_font['style'] == 'italic') { ?>font-style: <?php echo $menu_font['style']; ?>;<?php } ?>	
	<?php if( $menu_font['style'] == 'bold' || $menu_font['style'] == 'bold italic') { ?>font-weight: <?php echo $menu_font['style']; ?>;<?php } ?>	
}

.sf-menu .sub-menu a {
	font-size: <?php echo $dd_menu_font['size']; ?>;
	color: <?php echo $dd_menu_font['color']; ?>;
	<?php if( $dd_menu_font['style'] == 'normal' || $dd_menu_font['style'] == 'italic') { ?>font-style: <?php echo $dd_menu_font['style']; ?>;<?php } ?>	
	<?php if( $dd_menu_font['style'] == 'bold' || $dd_menu_font['style'] == 'bold italic') { ?>font-weight: <?php echo $dd_menu_font['style']; ?>;<?php } ?>	
}

.sf-menu > li > a { padding: <?php echo $menu_top_padding.'px '.$menu_right_padding.'px '.$menu_bottom_padding.'px '.$menu_left_padding.'px ' ?> !important; }
.sf-menu li { background: <?php echo $menu_default_bg_color; ?>; }

.sf-arrows .sf-with-ul:after,
.sf-arrows > li:hover > .sf-with-ul:after { border-color: <?php echo $menu_font['color']; ?>; }

.sf-arrows .sfHover .sf-with-ul:after { border-color: <?php echo $dd_menu_font['color']; ?> !important; }

.sf-menu > li:hover > a { color: <?php echo $menu_hover_color; ?>; }
.sf-arrows > .sfHover > .sf-with-ul:after { border-color: <?php echo $menu_hover_color; ?> !important; }
.sf-menu li:hover, .sf-menu li.sfHover { background: <?php echo $menu_hover_background; ?>; }
.sf-menu .sub-menu a:hover { color: <?php echo $dd_menu_hover_color; ?>; }
.sf-menu .sub-menu .sf-with-ul:hover:after { border-color: <?php echo $dd_menu_hover_color; ?> !important; }

.sf-menu > .current-menu-ancestor > a,
.sf-menu > .current-menu-item > a,
.sf-menu > li:hover > a { }


<?php
// convert hex color too rgb
$rgb = ct_hex2rgb($dd_menu_background);
$rgba = "rgba(" . $rgb[0] . "," . $rgb[1] . "," . $rgb[2] . ", " . $dd_menu_opacity . ")";
?>
.sf-menu ul li, .sf-menu ul ul li {
	background: <?php echo $dd_menu_background; ?>;
	background: <?php echo $rgba; ?>;
}
.sf-menu ul > li:hover { background: <?php echo $dd_menu_hover_background; ?>; }
.sf-menu { float: <?php echo $menu_position; ?> }



/* Body background Color */
body { background: <?php echo $body_background; ?>; }


/* Widgets */
.widget-title {
	background-color: <?php echo $widget_title_bg_color; ?>;
	font-size: <?php echo $widget_title_font['size']; ?>;
	color: <?php echo $widget_title_font['color']; ?>;
	<?php if( $widget_title_font['style'] == 'normal' || $widget_title_font['style'] == 'italic') { ?>font-style: <?php echo $widget_title_font['style']; ?>;<?php } ?>	
	<?php if( $widget_title_font['style'] == 'bold' || $widget_title_font['style'] == 'bold italic') { ?>font-weight: <?php echo $widget_title_font['style']; ?>;<?php } ?>
	padding: <?php echo $widget_title_top_padding.'px '.$widget_title_right_padding.'px '.$widget_title_bottom_padding.'px '.$widget_title_left_padding.'px'?>;
}

.widget-title a { color: <?php echo $widget_title_font['color']; ?>; }
.widget .bottom-triangle { border-top-color: <?php echo $widget_title_bg_color; ?>;}
.widget { margin-bottom: <?php echo $widget_gap.'px'; ?>; }

<?php if ( !$widget_arrow) : ?>
	.widget .bottom-triangle { display: none; }
<?php endif; ?>


/* Headers Styling */
h1 {
	color: <?php echo $h_one['color']; ?>;
	<?php if( $h_one['style'] == 'normal' || $h_one['style'] == 'italic') { ?>font-style: <?php echo $h_one['style']; ?>;<?php } ?>	
	<?php if( $h_one['style'] == 'bold' || $h_one['style'] == 'bold italic') { ?>font-weight: <?php echo $h_one['style']; ?>;<?php } ?>	
	font-size: <?php echo $h_one['size']; ?>; 
	line-height: <?php echo $h_one['height']; ?>; 
}

h2 {
	color: <?php echo $h_two['color']; ?>;
	<?php if( $h_two['style'] == 'normal' || $h_two['style'] == 'italic') { ?>font-style: <?php echo $h_two['style']; ?>;<?php } ?>	
	<?php if( $h_two['style'] == 'bold' || $h_two['style'] == 'bold italic') { ?>font-weight: <?php echo $h_two['style']; ?>;<?php } ?>	
	font-size: <?php echo $h_two['size']; ?>; 
	line-height: <?php echo $h_two['height']; ?>; 
}

h3 {
	color: <?php echo $h_three['color']; ?>;
	<?php if( $h_three['style'] == 'normal' || $h_three['style'] == 'italic') { ?>font-style: <?php echo $h_three['style']; ?>;<?php } ?>	
	<?php if( $h_three['style'] == 'bold' || $h_three['style'] == 'bold italic') { ?>font-weight: <?php echo $h_three['style']; ?>;<?php } ?>	
	font-size: <?php echo $h_three['size']; ?>; 
	line-height: <?php echo $h_three['height']; ?>; 
}

h4 {
	color: <?php echo $h_four['color']; ?>;
	<?php if( $h_four['style'] == 'normal' || $h_four['style'] == 'italic') { ?>font-style: <?php echo $h_four['style']; ?>;<?php } ?>	
	<?php if( $h_four['style'] == 'bold' || $h_four['style'] == 'bold italic') { ?>font-weight: <?php echo $h_four['style']; ?>;<?php } ?>	
	font-size: <?php echo $h_four['size']; ?>; 
	line-height: <?php echo $h_four['height']; ?>; 
}

h5 {
	color: <?php echo $h_five['color']; ?>;
	<?php if( $h_five['style'] == 'normal' || $h_five['style'] == 'italic') { ?>font-style: <?php echo $h_five['style']; ?>;<?php } ?>	
	<?php if( $h_five['style'] == 'bold' || $h_five['style'] == 'bold italic') { ?>font-weight: <?php echo $h_five['style']; ?>;<?php } ?>	
	font-size: <?php echo $h_five['size']; ?>; 
	line-height: <?php echo $h_five['height']; ?>; 
}

h6 {
	color: <?php echo $h_six['color']; ?>;
	<?php if( $h_six['style'] == 'normal' || $h_six['style'] == 'italic') { ?>font-style: <?php echo $h_six['style']; ?>;<?php } ?>	
	<?php if( $h_six['style'] == 'bold' || $h_six['style'] == 'bold italic') { ?>font-weight: <?php echo $h_six['style']; ?>;<?php } ?>	
	font-size: <?php echo $h_six['size']; ?>; 
	line-height: <?php echo $h_six['height']; ?>; 
}

h2.entry-title {
	<?php if( $post_title_font['style'] == 'normal' || $post_title_font['style'] == 'italic') { ?>font-style: <?php echo $post_title_font['style']; ?>;<?php } ?>	
	<?php if( $post_title_font['style'] == 'bold' || $post_title_font['style'] == 'bold italic') { ?>font-weight: <?php echo $post_title_font['style']; ?>;<?php } ?>	
	font-size: <?php echo $post_title_font['size']; ?>; 
	line-height: <?php echo $post_title_font['height']; ?>;
	text-transform: <?php echo $post_title_transform; ?>;
}


/* Featured image */
<?php if ( $featured_image_post == '0') : ?>
.single .entry-content { padding-top: 0; }
<?php endif; ?>

/* Stretch thumbnail post images */
<?php if ( $thumb_posts_stretch ) : ?>
.single-post .entry-thumb img { width: 100%; }
<?php endif; ?>


/* Links color */
a { color: <?php echo $links_color; ?>; }
a:hover,
.widget_nav_menu a:hover,
.widget_recent_entries a:hover,
.widget_recent_comments a:hover,
.widget_nav_menu a:hover,
.widget_categories a:hover,
h4.entry-title a:hover,
.ct-comments-widget h4 a:hover,
.widget_archive a:hover,
#entry-blog h2 a:hover,
#entry-blog .ct-read-more:hover,
#entry-blog #pbd-alp-load-posts i,
.to-top:hover i,
.entry-navigation .meta-nav i:hover,
.fn .url:hover,
.not-found #searchform #searchsubmit:hover i,
.woocommerce ul.products li.product h3:hover, .woocommerce-page ul.products li.product h3:hover  { color: <?php echo $links_hover_color; ?>; }

#entry-blog .ct-read-more:hover:after,
.entry-navigation .meta-nav i:hover { border-color: <?php echo $links_hover_color; ?>; }

h4.entry-title a,
.ct-comments-widget h4,
.ct-comments-widget h4 a,
.widget_recent_entries a,
.widget_recent_comments a,
.widget_nav_menu a,
.widget_categories a,
.widget_archive a,
#entry-blog h2 a,
.ct-categories-widget a,
.fn .url { color: <?php echo $links_alt_color; ?>; }

#wp-calendar td#today { background-color: <?php echo $links_color; ?>; }

.widget_nav_menu li a:hover { color: <?php echo $links_hover_color; ?>; }
.widget_nav_menu li.current-menu-item:before,
.widget_nav_menu li.current-menu-ancestor:before { color: <?php echo $links_color; ?>; }

.pagination a:hover,
.pagination .current { background-color: <?php echo $links_color; ?>; }

.woocommerce nav.woocommerce-pagination ul li a:focus,
.woocommerce nav.woocommerce-pagination ul li a:hover,
.woocommerce nav.woocommerce-pagination ul li span.current { background: <?php echo $links_color; ?>; }


.ct-popularpost-widget .entry-meta > span,
#entry-blog .entry-meta > span,
.ct-small-slider-widget .entry-meta > span,
.single-post .entry-meta > span {
	<?php if( $meta_font['style'] == 'normal' || $meta_font['style'] == 'italic') { ?>font-style: <?php echo $meta_font['style']; ?>;<?php } ?>	
	<?php if( $meta_font['style'] == 'bold' || $meta_font['style'] == 'bold italic') { ?>font-weight: <?php echo $meta_font['style']; ?>;<?php } ?>
	color: <?php echo $meta_font['color']; ?>;
	font-size: <?php echo $meta_font['size']; ?>;
}

.ct-popularpost-widget .entry-meta a,
.single-post .entry-meta a,
.ct-comments-widget .comment-time,
.ct-twitter-widget .tweet-time a,
.widget_recent_entries li .post-date,
#entry-blog .entry-meta a,
.ct-small-slider-widget a,
.ct-popularpost-widget .entry-meta i,
.ct-v-newsticker-widget .entry-meta i,
#entry-blog .entry-meta i,
.ct-small-slider-widget .entry-meta i,
.single-post .entry-meta i,
.widget_recent_comments li,
.widget_categories li,
.widget_archive li,
.ct-carousel-widget .entry-meta,
.ct-carousel-widget .entry-meta a,
#wp-calendar td#prev, #wp-calendar td#next, #wp-calendar td#prev a, #wp-calendar td#next a,
.entry-navigation .meta-nav i,
.logged-in-as,
.comment-meta a:hover { color: <?php echo $meta_font['color']; ?>; }

#entry-blog .ct-read-more:after,
.entry-navigation .meta-nav i { border-color: <?php echo $meta_font['color']; ?>; }

.page-template #content .widget-title,
.blog #content .widget-title,
.home #content.home-default .widget-title { background-color: <?php echo $blog_title_color; ?>; }

.page-template #content .bottom-triangle,
.blog #content .bottom-triangle,
.home #content.home-default .bottom-triangle { border-top-color: <?php echo $blog_title_color; ?>;}


/* RTL styles */
<?php if ( $rtl_styles ) : ?>
.sf-arrows .sf-with-ul:before,
.sf-arrows > li:hover > .sf-with-ul:before { border: 1px solid <?php echo $menu_font['color']; ?>; }

.sf-arrows .sfHover .sf-with-ul:before { border-color: <?php echo $dd_menu_font['color']; ?> !important; }	

.sf-arrows > .sfHover > .sf-with-ul:before { border-color: <?php echo $menu_hover_color; ?> !important; }
.sf-menu .sub-menu .sf-with-ul:hover:before { border-color: <?php echo $dd_menu_hover_color; ?> !important; }

#entry-blog .ct-read-more:before { border-color: <?php echo $meta_font['color']; ?>; }
#entry-blog .ct-read-more:hover:before { border-color: <?php echo $links_hover_color; ?>; }

.sf-arrows .sf-with-ul { padding-right: <?php echo $menu_right_padding.'px '; ?> !important; }

<?php endif; ?>


<?php if ( !$responsive_layout ) { ?>
/* Disable responsive layout */
#masthead, #footer { min-width: 1170px; }

.container { max-width: 1170px !important; width: 1170px !important; }

.col-lg-12 { width: 100%; }
.col-lg-11 { width: 91.66666666666666%; }
.col-lg-10 { width: 83.33333333333334%; }
.col-lg-9 { width: 75%; }
.col-lg-8 { width: 66.66666666666666%; }
.col-lg-7 { width: 58.333333333333336%; }
.col-lg-6 { width: 50%; }
.col-lg-5 { width: 41.66666666666667%; }
.col-lg-4 { width: 33.33333333333333%; }
.col-lg-3 { width: 25%; }
.col-lg-2 { width: 16.666666666666664%; }
.col-lg-1 { width: 8.333333333333332%; }

.col-lg-pull-12 { right: 100%; }
.col-lg-pull-11 { right: 91.66666666666666%; }
.col-lg-pull-10 { right: 83.33333333333334%; }
.col-lg-pull-9 { right: 75%; }
.col-lg-pull-8 { right: 66.66666666666666%; }
.col-lg-pull-7 { right: 58.333333333333336%; }
.col-lg-pull-6 { right: 50%; }
.col-lg-pull-5 { right: 41.66666666666667%; }
.col-lg-pull-4 { right: 33.33333333333333%; }
.col-lg-pull-3 { right: 25%; }
.col-lg-pull-2 { right: 16.666666666666664%; }
.col-lg-pull-1 { right: 8.333333333333332%; }
.col-lg-pull-0 { right: 0; }

.col-lg-push-12 { left: 100%; }
.col-lg-push-11 { left: 91.66666666666666%; }
.col-lg-push-10 { left: 83.33333333333334%; }
.col-lg-push-9 { left: 75%; }
.col-lg-push-8 { left: 66.66666666666666%; }
.col-lg-push-7 { left: 58.333333333333336%; }
.col-lg-push-6 { left: 50%; }
.col-lg-push-5 { left: 41.66666666666667%; }
.col-lg-push-4 { left: 33.33333333333333%; }
.col-lg-push-3 { left: 25%; }
.col-lg-push-2 { left: 16.666666666666664%; }
.col-lg-push-1 { left: 8.333333333333332%; }
.col-lg-push-0 { left: 0; }

.col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11 { float: left; }
<?php } ?>


/* Woocommerce */
.product_list_widget .star-rating { color: <?php echo $links_color; ?>; }

span.cart-total { color: <?php echo $links_color; ?>; }
.product-rating, .ct-shop-tabs #reviews .star-rating { color: <?php echo $links_color; ?>; }

.price > ins, .price > ins > .amount { color: <?php echo $links_color; ?>; }
.woocommerce .cart-collaterals .cart_totals tr.total th strong, .woocommerce .cart-collaterals .cart_totals tr.total td strong, tr.total th strong, tr.total td strong .amount { color: <?php echo $links_color; ?>; }
.cart_totals tr.total th strong, .cart_totals tr.total td  strong, tr.total th strong, tr.total td strong .amount { color: <?php echo $links_color; ?>; }
.thankyou { color: <?php echo $links_color; ?>; }
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle,
.woocommerce .widget_price_filter .ui-slider .ui-slider-range,.woocommerce-page .widget_price_filter .ui-slider .ui-slider-range { background: <?php echo $links_color; ?>; } 
.product-added .icon-check { color: <?php echo $links_color; ?>; }
.woocommerce .widget_shopping_cart .total > strong, .woocommerce-page .widget_shopping_cart .total > strong { color: <?php echo $links_color; ?>; }
.woocommerce ul.cart_list li a:hover, .woocommerce ul.product_list_widget li a:hover, .woocommerce-page ul.cart_list li a:hover, .woocommerce-page ul.product_list_widget li a:hover { color: <?php echo $links_hover_color; ?>; }
.woocommerce table.cart a.remove:hover, .woocommerce #content table.cart a.remove:hover, .woocommerce-page table.cart a.remove:hover, .woocommerce-page #content table.cart a.remove:hover {
	background-color: <?php echo $links_color; ?>;
	border-color: <?php echo $links_color; ?>;
}

.woocommerce .woocommerce-message {
  border-top-color: <?php echo $links_color; ?>;
}

.woocommerce .woocommerce-message:before {
  color: <?php echo $links_color; ?>;
}


<?php if (  !$ct_shop_show_title ) : ?>
	.woocommerce.woocommerce-page .page-title { display: none; }
<?php endif; ?>

.woocommerce-page h1.page-title { background-color: <?php echo $ct_shop_bg_title_color; ?>; color: <?php echo $ct_shop_font_title_color; ?> }

.widget .tagcloud a { background-color: <?php echo $links_color; ?>; }
.woocommerce-page .shopping-cart-block a.button, .woocommerce .shopping-cart-block a.button { color: <?php echo $links_color; ?>; }
.woocommerce-error, .woocommerce-error a,
.woocommerce-info, .woocommerce-info a { background-color: <?php echo $links_color; ?>; }


<?php if ( $ct_blog_pagination_type == 'load_more' ) { ?>
	.home .blog-navigation { display: none; }
<?php } ?>

<?php if ( $ct_cat_pagination_type == 'load_more' ) { ?>
	.archive .blog-navigation,
	.search .blog-navigation { display: none; } 
<?php } ?>

.woocommerce span.onsale { background-color: <?php echo $ct_shop_onsale_color; ?>; }

ul.products li.product .stock.in-stock { background-color: <?php echo $ct_shop_instock_color; ?>; }
ul.products li.product .stock.out-of-stock { background-color: <?php echo $ct_shop_outofstock_color; ?>; }