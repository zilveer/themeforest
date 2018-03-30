<?php
	if(df_get_option(THEME_NAME."_scriptLoad") != "on") {
		header('Content-type: text/css');	
	} 
	function df_custom_style() {
		//banner settings
		$banner_type = df_get_option ( THEME_NAME."_banner_type" );

		//bg type
		$bg_type = df_get_option ( THEME_NAME."_body_bg_type" );
		$bg_color = df_get_option ( THEME_NAME."_body_color" );
		$bg_image = df_get_option ( THEME_NAME."_body_image" );
		$bg_image_repeat = df_get_option ( THEME_NAME."_body_image_repeat" );
		$bg_texture = df_get_option ( THEME_NAME."_body_pattern" );
		if(!$bg_texture) $bg_texture = "texture-1";
		

		//colors
		$color_1 = df_get_option(THEME_NAME."_color_1");
		$color_2 = df_get_option(THEME_NAME."_color_2");
		$color_3 = df_get_option(THEME_NAME."_color_3");
		$color_4 = df_get_option(THEME_NAME."_color_4");
		$color_5 = df_get_option(THEME_NAME."_color_5");
		$color_6 = df_get_option(THEME_NAME."_color_6");
		$color_7 = df_get_option(THEME_NAME."_color_7");
		$color_8 = df_get_option(THEME_NAME."_color_8");
		if(!$color_4) $color_4 = "222";
		if(!$color_5) $color_5 = "FC8D8D";
		if(!$color_6) $color_6 = "eee";
		if(!$color_7) $color_7 = "ddd";
		if(!$color_8) $color_8 = "999";

		if(df_get_option(THEME_NAME."_scriptLoad") == "on") {
			echo "<style>";	
		} 

	
?>

/*------------------------------------------------------------------------------
    Color
    (link hover, weather forecast icon, weather forecast temp, logo span,
    dropcap first letter, quotes, meta calendar icon)
------------------------------------------------------------------------------*/
a:hover,
#header .header_meta .weather_forecast i,
#header .header_meta .weather_forecast .temp,
#site_title span,
.dropcap:first-letter,
.full_meta span.meta_date:before,
.full_meta span.meta_comments:before,
.full_meta span.meta_views:before,
.full_meta span.meta_author i,
blockquote p span:first-child,
blockquote p span:last-child,
.entry_media span.meta_likes a,
article.post .entry_content p a,
.full_meta span.meta_likes:before {
    color: #<?php echo esc_html__($color_1);?>;
}

/*------------------------------------------------------------------------------
    Background
    (mark, button, search icon in menu, format, tags hover, post format hover,
    input submit, shop hover icon, pagination current link, shop button,
    span format icon, review border, rating result, transition line, wide slider
    controls, filter shop handle)
------------------------------------------------------------------------------*/
mark,
.breaking-news .breaking-title,
.search_icon_form a,
.author_box .posts,
span.format,
.tagcloud a:hover,
#footer .tagcloud a:hover,
.item .item_thumb .thumb_icon a,
input[type="submit"], 
.thumb_meta span.category,
ul.products li.product .item_thumb .thumb_icon a,
ul.page-numbers li span.current,
ul.products li.product a.btn:hover,
.layout_post_1 .item_thumb .thumb_icon a,
.full_meta span.meta_format,
.review_footer span,
.transition_line,
.layout_post_2 .item_thumb .thumb_icon a,
.list_posts .post .item_thumb .thumb_icon a,
.wide_slider .bx-wrapper .bx-controls-direction a:hover,
.ui-slider-range,
#gallery_grid .gallery_album .item_thumb .thumb_icon a,
.wc-proceed-to-checkout,
.single_add_to_cart_button.btn_red,
#back_to_top a:hover,
.layout_post_4 .item_thumb .thumb_icon a {
    background-color: #<?php echo esc_html__($color_2);?>;
}

/*------------------------------------------------------------------------------
    Border
    (drop down menu, tags hover, slider pager top border)
------------------------------------------------------------------------------*/
nav.site_navigation ul.menu ul.sub-menu,
nav.site_navigation ul.menu > li > .content,
nav.site_navigation ul.menu > li.has_dt_mega_menu > ul.dt_mega_menu,
.tagcloud a:hover:before,
#footer .tagcloud a:hover:before,
#wide_slider_pager .box.active {
    border-color: #<?php echo esc_html__($color_3);?>;
}

/*------------------------------------------------------------------------------
    Heading colors in post content
------------------------------------------------------------------------------*/
.entry_content>h1:not(.page_title):not(.entry-title):not(.entry_title),
.entry_content>h2,
.entry_content>h3,
.entry_content>h4,
.entry_content>h5,
.entry_content>h6,
.entry_content>.row>.col>h1:not(.page_title):not(.entry-title):not(.entry_title),
.entry_content>.row>.col>h2,
.entry_content>.row>.col>h3,
.entry_content>.row>.col>h4,
.entry_content>.row>.col>h5,
.entry_content>.row>.col>h6 {
    color: #<?php echo esc_html__($color_4);?>;
}
.entry_content .head_title h2 {
	color: #222;
}

.entry_content .head_title h2 {
	color: #222;
}

/*------------------------------------------------------------------------------
    Content Link Color
------------------------------------------------------------------------------*/

.entry_content a:not(.ui-tabs-anchor):not(.btn):not(.gal-link):not(:hover) {
    color: #<?php echo esc_html__($color_5);?>;
}

/*------------------------------------------------------------------------------
    Accordions background and color
------------------------------------------------------------------------------*/
.accordion_content .accordion_content_title {
	background-color: #<?php echo esc_html__($color_6);?>;
}

/*------------------------------------------------------------------------------
    Accordion icon background and color
------------------------------------------------------------------------------*/
.accordion_content .accordion_content_title:after {
	background-color: #<?php echo esc_html__($color_7);?>;
	color: #<?php echo esc_html__($color_8);?>;
}


		/* Background Color/Texture/Image */
		body {
			<?php if($bg_type == "color") { ?>
				background: #<?php echo esc_html_e($bg_color);?>;
			<?php } else if ($bg_type == "pattern") { ?> 
				background: url(<?php echo esc_url(THEME_IMAGE_URL.$bg_texture.'.png');?>);
			<?php } else if ($bg_type == "image") { ?>
				background-image: url(<?php echo esc_url($bg_image);?>);
				<?php if(!$bg_image_repeat || $bg_image_repeat=="no-repeat") { ?>
					background-attachment: fixed;
					background-size: 100%; 
				<?php } elseif($bg_image_repeat) { ?>
					background-repeat: <?php esc_html_e($bg_image_repeat);?>;
				<?php } ?>
			<?php } else { ?>
				background: #<?php echo esc_html__($bg_color);?>;
			<?php } ?>

		}

		<?php
			if ( $banner_type == "image" ) {
			//Image Banner
		?>
				#overlay { width:100%; height:100%; position:fixed;  _position:absolute; top:0; left:0; z-index:1001; background-color:#000000; overflow: hidden;  }
				#popup { display: none; position:absolute; width:auto; height:auto; z-index:1002; color: #000; font-family: Tahoma,sans-serif;font-size: 14px; }
				#baner_close { width: 22px; height: 25px; background: url(<?php echo esc_url(get_template_directory_uri().'/images/close.png');?>) 0 0 repeat; text-indent: -5000px; position: absolute; right: -10px; top: -10px; }
		<?php
			} else if ( $banner_type == "text" ) {
			//Text Banner
		?>
				#overlay { width:100%; height:100%; position:fixed;  _position:absolute; top:0; left:0; z-index:1001; background-color:#000000; overflow: hidden;  }
				#popup { display: none; position:absolute; width:auto; height:auto; max-width:700px; z-index:1002; border: 1px solid #000; background: #e5e5e5 url(<?php echo esc_url(get_template_directory_uri().'/images/dotted-bg-6.png');?>) 0 0 repeat; color: #000; font-family: Tahoma,sans-serif;font-size: 14px; line-height: 24px; border: 1px solid #cccccc; -moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px; text-shadow: #fff 0 1px 0; }
				#popup center { display: block; padding: 20px 20px 20px 20px; }
				#baner_close { width: 22px; height: 25px; background: url(<?php echo esc_url(get_template_directory_uri().'/images/close.png');?>) 0 0 repeat; text-indent: -5000px; position: absolute; right: -12px; top: -12px; }
		<?php 
			} else if ( $banner_type == "text_image" ) {
			//Image And Text Banner
		?>
				#overlay { width:100%; height:100%; position:fixed;  _position:absolute; top:0; left:0; z-index:1001; background-color:#000000; overflow: hidden;  }
				#popup { display: none; position:absolute; width:auto; z-index:1002; color: #000; font-size: 11px; font-weight: bold; }
				#popup center { padding: 15px 0 0 0; }
				#baner_close { width: 22px; height: 25px; background: url(<?php echo esc_url(get_template_directory_uri().'/images/close.png');?>) 0 0 repeat; text-indent: -5000px; position: absolute; right: -10px; top: -10px; }
		<?php } ?>
	<?php
		if(df_get_option(THEME_NAME."_scriptLoad") == "on") {
			echo "</style>";	
		} 
	?>
<?php } ?>
<?php

	if(df_get_option(THEME_NAME."_scriptLoad") != "on") {
		df_custom_style();	
	} 

?>