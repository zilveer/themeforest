<?php
/* Generates user css based on settings in admin panel */
function apollo13_make_css_rule($property, $value, $format = false){
    if ( $value !== '' &&  $value !== 'default' ){
        //make fallback for rgba colors by providing rgb color
        if(strpos($property,'color') !== false && strpos($value,'rgba') !== false){
            //break rgba to numbers
            $chunks = a13_break_rgba($value);
            $fallback_color = "rgb($chunks[1], $chunks[2], $chunks[3])";

            return
                $property . ': ' . $fallback_color . "; " .
                $property . ': ' . $value . ';';
        }

        //format for some properties
        if( $format !== false ){
            return $property . ': ' . sprintf($format, $value) . ';';
        }

        return $property . ': ' . $value . ";";
    }
    else{
        return '';
    }
}


function a13_break_rgba( $rgba ){
    $chunks = array();
    preg_match("/\(\s*(\d+),\s*(\d+),\s*(\d+),\s*(\d+\.?\d*)\s*\)/", $rgba, $chunks);
    return $chunks;
}


/*
 * body part
 */
$predefined_colors          = $this->theme_options[ 'appearance' ][ 'predefined_colors' ];
$body_bg_color              = apollo13_make_css_rule( 'background-color', $this->theme_options[ 'appearance' ][ 'body_bg_color' ]);
$body_bg_color_val          = $this->theme_options[ 'appearance' ][ 'body_bg_color' ];
$body_image                 = apollo13_make_css_rule( 'background-image', $this->theme_options[ 'appearance' ][ 'body_image' ], 'url(%s)');
$body_bg_attachment         = apollo13_make_css_rule( 'background-attachment', $this->theme_options[ 'appearance' ][ 'body_bg_attachment' ]);
$headings_color             = apollo13_make_css_rule( 'color', $this->theme_options[ 'fonts' ][ 'headings_color' ]);
$headings_color_hover       = apollo13_make_css_rule( 'color', $this->theme_options[ 'fonts' ][ 'headings_color_hover' ]);
$headings_weight            = apollo13_make_css_rule( 'font-weight', $this->theme_options[ 'fonts' ][ 'headings_weight' ]);
$headings_transform         = apollo13_make_css_rule( 'text-transform', $this->theme_options[ 'fonts' ][ 'headings_transform' ]);
$cursor_css                 = 'cursor: default';
$custom_cursor              = $this->theme_options[ 'appearance' ][ 'custom_cursor' ];
if( $custom_cursor  === 'custom' ){
    $cursor_css             = apollo13_make_css_rule( 'cursor', $this->theme_options[ 'appearance' ][ 'cursor_image' ], 'url("%s"), default');
}
elseif( $custom_cursor === 'select' ){
    $cursor = $this->theme_options[ 'appearance' ][ 'cursor_select' ];
    $cursor_css             = apollo13_make_css_rule( 'cursor', A13_TPL_GFX.'/cursors/'.$cursor , 'url("%s"), default');
}
$button_color           = apollo13_make_css_rule( 'color', $this->theme_options[ 'appearance' ][ 'button_color' ]);
$button_bg_color        = apollo13_make_css_rule( 'background-color', $this->theme_options[ 'appearance' ][ 'button_bg_color' ]);
$button_border_color    = apollo13_make_css_rule( 'border-color', $this->theme_options[ 'appearance' ][ 'button_border_color' ]);
$button_h_color         = apollo13_make_css_rule( 'color', $this->theme_options[ 'appearance' ][ 'button_hover_color' ]);
$button_h_bg_color      = apollo13_make_css_rule( 'background-color', $this->theme_options[ 'appearance' ][ 'button_hover_bg_color' ]);
$button_h_border_color  = apollo13_make_css_rule( 'border-color', $this->theme_options[ 'appearance' ][ 'button_hover_border_color' ]);

$prelaoder_bg_color     = apollo13_make_css_rule( 'background-color', $this->theme_options[ 'appearance' ][ 'preloader_bg_color' ]);
$prelaoder_text_color   = apollo13_make_css_rule( 'color', $this->theme_options[ 'appearance' ][ 'preloader_text_color' ]);
$preloader_font_size    = apollo13_make_css_rule( 'font-size', $this->theme_options[ 'appearance' ][ 'preloader_font_size' ]);
$preloader_text_weight  = apollo13_make_css_rule( 'font-weight', $this->theme_options[ 'appearance' ][ 'preloader_text_weight' ]);


/*
 *  top-bar part
 */
$tb_bgcolor             = $this->theme_options[ 'appearance' ][ 'top_bar_bgcolor' ];
$tb_text_color          = apollo13_make_css_rule( 'color', $this->theme_options[ 'appearance' ][ 'top_bar_text_color' ]);
$tb_title_color         = apollo13_make_css_rule( 'color', $this->theme_options[ 'appearance' ][ 'top_bar_title_color' ]);
$tb_link_color          = apollo13_make_css_rule( 'color', $this->theme_options[ 'appearance' ][ 'top_bar_link_color' ]);
$tb_link_hover_color    = apollo13_make_css_rule( 'color', $this->theme_options[ 'appearance' ][ 'top_bar_link_hover_color' ]);
$tb_line_color          = apollo13_make_css_rule( 'border-bottom-color', $this->theme_options[ 'appearance' ][ 'top_bar_line_color' ]);
$tb_option_color        = apollo13_make_css_rule( 'color', $this->theme_options[ 'appearance' ][ 'top_bar_option_color' ]);
$tb_option_hover_color  = apollo13_make_css_rule( 'color', $this->theme_options[ 'appearance' ][ 'top_bar_option_hover_color' ]);
$tb_option_hl_color     = $this->theme_options[ 'appearance' ][ 'top_bar_option_hl_color' ];
$tb_option_weight       = apollo13_make_css_rule( 'font-weight', $this->theme_options[ 'appearance' ][ 'top_bar_option_weight' ]);
$tb_option_transform    = apollo13_make_css_rule( 'text-transform', $this->theme_options[ 'appearance' ][ 'top_bar_option_transform' ]);
$tb_sub_sep_color       = apollo13_make_css_rule( 'border-top-color', $this->theme_options[ 'appearance' ][ 'top_bar_sub_sep_color' ]);
$tb_sub_option_bgcolor  = $this->theme_options[ 'appearance' ][ 'top_bar_sub_option_bgcolor' ];
$tb_sub_option_hover_bgcolor = apollo13_make_css_rule( 'background-color', $this->theme_options[ 'appearance' ][ 'top_bar_sub_option_hover_bgcolor' ]);



/*
 *  logo
 */
$logo_image_hover       = (int)$this->theme_options[ 'appearance' ][ 'logo_image_opacity' ];
$logo_image_hover_o     = $logo_image_hover/100;
$logo_color             = apollo13_make_css_rule( 'color', $this->theme_options[ 'appearance' ][ 'logo_color' ]);
$logo_color_hover       = apollo13_make_css_rule( 'color', $this->theme_options[ 'appearance' ][ 'logo_color_hover' ]);
$logo_font_size         = apollo13_make_css_rule( 'font-size', $this->theme_options[ 'appearance' ][ 'logo_font_size' ]);
$logo_weight            = apollo13_make_css_rule( 'font-weight', $this->theme_options[ 'appearance' ][ 'logo_weight' ]);
$logo_padding           = $this->theme_options[ 'appearance' ][ 'logo_padding' ];



/*
 *  header part
 */
$header_bg_color        = apollo13_make_css_rule( 'background-color', $this->theme_options[ 'appearance' ][ 'header_bg_color' ]);
$header_bg_image        = apollo13_make_css_rule( 'background-image', $this->theme_options[ 'appearance' ][ 'header_bg_image' ], 'url(%s)');
$fixed_header_bg_color  = apollo13_make_css_rule( 'background-color', $this->theme_options[ 'appearance' ][ 'fixed_header_bg_color' ]);
$menu_bg_color          = apollo13_make_css_rule( 'background-color', $this->theme_options[ 'appearance' ][ 'menu_bg_color' ]);
$menu_top_border        = ($this->theme_options[ 'appearance' ][ 'menu_top_border' ] == 'off')? 'border-top: none;' : '';
$menu_weight            = apollo13_make_css_rule( 'font-weight', $this->theme_options[ 'appearance' ][ 'menu_weight' ]);
$menu_transform         = apollo13_make_css_rule( 'text-transform', $this->theme_options[ 'appearance' ][ 'menu_transform' ]);
$menu_font_size         = apollo13_make_css_rule( 'font-size', $this->theme_options[ 'appearance' ][ 'menu_font_size' ]);
$menu_element_padding   = $this->theme_options[ 'appearance' ][ 'menu_element_padding' ];
$menu_color             = apollo13_make_css_rule( 'color', $this->theme_options[ 'appearance' ][ 'menu_color' ]);
$menu_hover_color       = $this->theme_options[ 'appearance' ][ 'menu_hover_color' ];
$submenu_bg_color       = $this->theme_options[ 'appearance' ][ 'submenu_bg_color' ];
$submenu_hover_bg_color = apollo13_make_css_rule( 'background-color', $this->theme_options[ 'appearance' ][ 'submenu_hover_bg_color' ]);
$submenu_weight         = apollo13_make_css_rule( 'font-weight', $this->theme_options[ 'appearance' ][ 'submenu_weight' ]);
$submenu_transform      = apollo13_make_css_rule( 'text-transform', $this->theme_options[ 'appearance' ][ 'submenu_transform' ]);
$submenu_font_size      = apollo13_make_css_rule( 'font-size', $this->theme_options[ 'appearance' ][ 'submenu_font_size' ]);
$submenu_color          = apollo13_make_css_rule( 'color', $this->theme_options[ 'appearance' ][ 'submenu_color' ]);
$submenu_hover_color    = apollo13_make_css_rule( 'color', $this->theme_options[ 'appearance' ][ 'submenu_hover_color' ]);
$submenu_sep_color      = apollo13_make_css_rule( 'border-color', $this->theme_options[ 'appearance' ][ 'submenu_sep_color' ]);
$mm_group_font_size     = apollo13_make_css_rule( 'font-size', $this->theme_options[ 'appearance' ][ 'mm_group_font_size' ]);
$menu_label_color       = $this->theme_options[ 'appearance' ][ 'menu_label_color' ];
$submenu_label_color    = $this->theme_options[ 'appearance' ][ 'submenu_label_color' ];
$header_lines_color     = apollo13_make_css_rule( 'border-color', $this->theme_options[ 'appearance' ][ 'header_lines_color' ]);
$header_icons_color     = apollo13_make_css_rule( 'color', $this->theme_options[ 'appearance' ][ 'header_icons_color' ]);
$menu_bottom_line       = $this->theme_options[ 'appearance' ][ 'menu_bottom_line' ] === 'off'? 'display: none;': '';
$submenu_top_line       = $this->theme_options[ 'appearance' ][ 'submenu_top_line' ] === 'off'? 'border-top: none;': '';


/*
 *  footer
 */
$fw_bg_color            = apollo13_make_css_rule( 'background-color', $this->theme_options[ 'appearance' ][ 'footer_widgets_bg_color' ]);
$fw_border_color        = apollo13_make_css_rule( 'background-color', $this->theme_options[ 'appearance' ][ 'footer_widgets_border_color' ]);
$fw_title_color         = apollo13_make_css_rule( 'color', $this->theme_options[ 'appearance' ][ 'footer_widget_title_color' ]);
$fw_title_size          = apollo13_make_css_rule( 'font-size', $this->theme_options[ 'appearance' ][ 'footer_widget_title_font_size' ]);
$fw_title_border        = apollo13_make_css_rule( 'border-color', $this->theme_options[ 'appearance' ][ 'footer_widgets_title_border_color' ]);
$fw_font_size           = apollo13_make_css_rule( 'font-size', $this->theme_options[ 'appearance' ][ 'footer_widgets_font_size' ]);
$fw_font_color          = apollo13_make_css_rule( 'color', $this->theme_options[ 'appearance' ][ 'footer_widgets_font_color' ]);
$fw_link_color          = $this->theme_options[ 'appearance' ][ 'footer_widgets_link_color' ];
$fw_link_hover_color    = $this->theme_options[ 'appearance' ][ 'footer_widgets_link_hover_color' ];
$fw_other_color          = apollo13_make_css_rule( 'color', $this->theme_options[ 'appearance' ][ 'footer_widgets_other_color' ]);

$footer_bg_color        = apollo13_make_css_rule( 'background-color', $this->theme_options[ 'appearance' ][ 'footer_lower_bg_color' ]);
$footer_bg_image        = apollo13_make_css_rule( 'background-image', $this->theme_options[ 'appearance' ][ 'footer_lower_bg_image' ], 'url(%s)');
$footer_lines_color     = apollo13_make_css_rule( 'border-color', $this->theme_options[ 'appearance' ][ 'footer_lines_color' ]);
$footer_font_size       = apollo13_make_css_rule( 'font-size', $this->theme_options[ 'appearance' ][ 'footer_font_size' ]);
$footer_font_color      = apollo13_make_css_rule( 'color', $this->theme_options[ 'appearance' ][ 'footer_font_color' ]);
$footer_link_color      = apollo13_make_css_rule( 'color', $this->theme_options[ 'appearance' ][ 'footer_link_color' ]);
$footer_link_hover_color= apollo13_make_css_rule( 'color', $this->theme_options[ 'appearance' ][ 'footer_link_hover_color' ]);



/*
 *  title bar
 */
$title_bar_small_transform    = apollo13_make_css_rule( 'text-transform', $this->theme_options[ 'appearance' ][ 'title_bar_small_transform' ]);



/*
 *  blog
 */
$blog_brick_width       = apollo13_make_css_rule( 'width', $this->theme_options[ 'blog' ][ 'brick_width' ]);
$margin = $this->theme_options[ 'blog' ][ 'brick_margin' ];
$margin_half = ((int)$margin)/2;
$blog_brick_margin_b = apollo13_make_css_rule( 'margin-bottom', $margin);
$blog_brick_margin_r = apollo13_make_css_rule( 'margin-right', $margin_half, '%fpx' );
$blog_brick_margin_l = apollo13_make_css_rule( 'margin-left', $margin_half, '%fpx' );
//$blog_brick_padd_t   = apollo13_make_css_rule( 'padding-top', $margin);
$blog_brick_padd_r   = apollo13_make_css_rule( 'padding-right', $margin_half, '%fpx' );
$blog_brick_padd_l   = apollo13_make_css_rule( 'padding-left', $margin_half, '%fpx' );



/*
 *  Galleries list
 */
$galleries_brick_width    = apollo13_make_css_rule( 'width', $this->theme_options[ 'cpt_gallery' ][ 'gl_brick_width' ]);
$temp = $this->theme_options[ 'cpt_gallery' ][ 'gl_brick_height' ];
// if 0 then height if fluid
if($temp === '0px' || $temp === '0'){
    $galleries_brick_height = 'height: auto;';
}
else{
    $galleries_brick_height = apollo13_make_css_rule( 'height', $temp);
}

$margin = $this->theme_options[ 'cpt_gallery' ][ 'gl_brick_margin' ];
$margin_half = ((int)$margin)/2;
$galleries_brick_margin_b = apollo13_make_css_rule( 'margin-bottom', $margin);
$galleries_brick_margin_r = apollo13_make_css_rule( 'margin-right', $margin_half, '%fpx' );
$galleries_brick_margin_l = apollo13_make_css_rule( 'margin-left', $margin_half, '%fpx' );
$galleries_brick_padd_t   = apollo13_make_css_rule( 'padding-top', $margin);
$galleries_brick_padd_r   = apollo13_make_css_rule( 'padding-right', $margin_half, '%fpx' );
$galleries_brick_padd_l   = apollo13_make_css_rule( 'padding-left', $margin_half, '%fpx' );


/*
 *  Gallery
 */
$gallery_brick_width    = apollo13_make_css_rule( 'width', $this->theme_options[ 'cpt_gallery' ][ 'brick_width' ]);
$temp = $this->theme_options[ 'cpt_gallery' ][ 'brick_height' ];
// if 0 then height if fluid
if($temp === '0px' || $temp === '0'){
    $gallery_brick_height = 'height: auto;';
}
else{
    $gallery_brick_height = apollo13_make_css_rule( 'height', $temp);
}

$margin = $this->theme_options[ 'cpt_gallery' ][ 'brick_margin' ];
$margin_half = ((int)$margin)/2;
$gallery_brick_margin_b = apollo13_make_css_rule( 'margin-bottom', $margin);
$gallery_brick_margin_r = apollo13_make_css_rule( 'margin-right', $margin_half, '%fpx' );
$gallery_brick_margin_l = apollo13_make_css_rule( 'margin-left', $margin_half, '%fpx' );
$gallery_brick_padd_t   = apollo13_make_css_rule( 'padding-top', $margin);
$gallery_brick_padd_r   = apollo13_make_css_rule( 'padding-right', $margin_half, '%fpx' );
$gallery_brick_padd_l   = apollo13_make_css_rule( 'padding-left', $margin_half, '%fpx' );
$gallery_caption        = ($this->theme_options[ 'cpt_gallery' ][ 'titles' ] == 'off')? 'display: none !important;' : '';
$gallery_slide_list     = ($this->theme_options[ 'cpt_gallery' ][ 'list' ] == 'off')? 'display: none !important;' : '';

$gallery_slider_h       = apollo13_make_css_rule( 'height', $this->theme_options[ 'cpt_gallery' ][ 'slider_height' ]);


/*
 *  Works list
 */
$works_brick_width    = apollo13_make_css_rule( 'width', $this->theme_options[ 'cpt_work' ][ 'brick_width' ]);
$temp = $this->theme_options[ 'cpt_work' ][ 'brick_height' ];
// if 0 then height if fluid
if($temp === '0px' || $temp === '0'){
    $works_brick_height = 'height: auto;';
}
else{
    $works_brick_height = apollo13_make_css_rule( 'height', $temp);
}

$margin = $this->theme_options[ 'cpt_work' ][ 'brick_margin' ];
$margin_half = ((int)$margin)/2;
$works_brick_margin_b = apollo13_make_css_rule( 'margin-bottom', $margin);
$works_brick_margin_r = apollo13_make_css_rule( 'margin-right', $margin_half, '%fpx' );
$works_brick_margin_l = apollo13_make_css_rule( 'margin-left', $margin_half, '%fpx' );
$works_brick_padd_t   = apollo13_make_css_rule( 'padding-top', $margin);
$works_brick_padd_r   = apollo13_make_css_rule( 'padding-right', $margin_half, '%fpx' );
$works_brick_padd_l   = apollo13_make_css_rule( 'padding-left', $margin_half, '%fpx' );

//single work
$work_scroller_h      = apollo13_make_css_rule( 'height', $this->theme_options[ 'cpt_work' ][ 'scroller_height' ]);
$work_slider_h        = apollo13_make_css_rule( 'height', $this->theme_options[ 'cpt_work' ][ 'slider_height' ]);
$work_caption         = ($this->theme_options[ 'cpt_work' ][ 'titles' ] == 'off')? 'display: none !important;' : '';
$work_slide_list      = ($this->theme_options[ 'cpt_work' ][ 'list' ] == 'off')? 'display: none !important;' : '';



/*
 *  content
 */
$content_font_size    = apollo13_make_css_rule( 'font-size', $this->theme_options[ 'fonts' ][ 'content_font_size' ]);
$content_font_color   = apollo13_make_css_rule( 'color', $this->theme_options[ 'fonts' ][ 'content_color' ]);
$content_first_p_show = ($this->theme_options[ 'fonts' ][ 'first_paragraph' ] === 'off')? 'font-size: inherit; color: inherit;' : '';
$content_first_p_color= ($this->theme_options[ 'fonts' ][ 'first_paragraph' ] === 'off')? '' : apollo13_make_css_rule( 'color', $this->theme_options[ 'fonts' ][ 'first_paragraph_color' ]);



/*
 *  fonts
 */
$temp               = explode(':', $this->theme_options[ 'fonts' ][ 'normal_fonts' ]);
$normal_fonts       = ($temp[0] === 'default')? '' : apollo13_make_css_rule( 'font-family', $temp[0], '%s, sans-serif' );
$temp               = explode(':', $this->theme_options[ 'fonts' ][ 'titles_fonts' ]);
$titles_fonts       = ($temp[0] === 'default')? '' : apollo13_make_css_rule( 'font-family', $temp[0], '%s, sans-serif' );
$temp               = explode(':', $this->theme_options[ 'fonts' ][ 'nav_menu_fonts' ]);
$nav_menu_font      = ($temp[0] === 'default')? '' : apollo13_make_css_rule( 'font-family', $temp[0], '%s, sans-serif' );


$custom_CSS = $this->theme_options[ 'customize' ][ 'custom_css' ];

/**********************************
 * START OF CSS
 **********************************/
$user_css = '';
$string_to_replace = '#fff/*$color*/';

//prelaoder
if($this->theme_options[ 'appearance' ][ 'preloader' ] === 'on'){
    $prelaoder_type     = $this->theme_options[ 'appearance' ][ 'preloader_type' ];
    $prelaoder_color    = $this->theme_options[ 'appearance' ][ 'preloader_color' ];
    if($prelaoder_type !== 'none'){
        $user_css .= str_replace($string_to_replace, $prelaoder_color, file_get_contents(A13_TPL_CSS_DIR . '/preloaders/'.$prelaoder_type.'.css'));
    }
}


//predefined colors
if($predefined_colors  !== 'default'){
    if($predefined_colors  === 'custom'){
        //use user defined color
        $predefined_colors = $this->theme_options[ 'appearance' ][ 'predefined_color_custom' ];
    }
    $user_css .= str_replace($string_to_replace, $predefined_colors, file_get_contents(A13_TPL_CSS_DIR . '/schemes/scheme.css'));
}


$user_css .= "
/* ==================
   GLOBAL
   ==================*/
body{
    $body_image
    $body_bg_attachment
    $cursor_css
}
body,
.widget .title > span,
.wp-paginate .title,
.wp-paginate .gap,
.navigation a,
.widget-title span,
.title-and-nav .title span,
.title-and-nav nav,
#reply-title span,
#cancel-comment-reply-link{
	$body_bg_color
}


input[type=\"submit\"],
a.a13-button,
a.dot-irecommendthis,
.product .summary .add_to_wishlist,
.woocommerce-page a.button,
.woocommerce-page button.button,
.woocommerce-page input.button,
.woocommerce-page #respond input#submit,
.woocommerce-page #content input.button,
.woocommerce-page a.button.alt,
.woocommerce-page button.button.alt,
.woocommerce-page #content input.button.alt{
    $button_color
    $button_border_color
    $button_bg_color
    $titles_fonts
}
input[type=\"submit\"]:hover,
input[type=\"submit\"]:focus,
a.a13-button:hover,
a.project-site:hover,
.product .summary .add_to_wishlist:hover,
.woocommerce-page a.button:hover,
.woocommerce-page button.button:hover,
.woocommerce-page input.button:hover,
.woocommerce-page #respond input#submit:hover,
.woocommerce-page #content input.button:hover,
.woocommerce-page a.button.alt:hover,
.woocommerce-page button.button.alt:hover,
.woocommerce-page #content input.button.alt:hover{
    $button_h_color
    $button_h_border_color
    $button_h_bg_color
}


/* ==================
   TYPOGRAPHY
   ==================*/
/* Titles and titles alike font */
h1,h2,h3,h4,h5,h6,
h1 a,h2 a,h3 a,h4 a,h5 a, h6 a,
.page-title,
.widget .title{
    $headings_color
    $titles_fonts
    $headings_weight
    $headings_transform
}
h1 a:hover,h2 a:hover,h3 a:hover,h4 a:hover,h5 a:hover,h6 a:hover,
.post .post-title a:hover, .post a.post-title:hover{
    $headings_color_hover
}
.wc-header-cart,
.a13-button,
a.dot-irecommendthis,
.woocommerce-page a.button,
.woocommerce-page button.button,
.woocommerce-page input.button,
.woocommerce-page #respond input#submit,
.woocommerce-page #content input.button,
.woocommerce-page #content input.button.alt,
.woocommerce-page ul.product_list_widget li a,
.woocommerce-page .price,
.product_list_widget .amount,
.product_list_widget .woocommerce-price-suffix,
.shop_table td.number-value,
#shipping_method,
.woocommerce-page .product_name,
.woocommerce-page #content  div.product .woocommerce-tabs ul.tabs li a,
.woocommerce-page .wc-info,
.woocommerce-page #content table.shop_table th,
.woocommerce-page .cart-collaterals .shop_table,
.product .add_to_wishlist,
.woocommerce-page div.product .out-of-stock,
.woocommerce-page #content div.product form.cart .variations label,
.thumb-space .ribbon em,
input[type=\"submit\"],button,
.widget_nav_menu li a,
.widget_about_posts .post-title,
.breadcrumbs,
title-bar .post-meta,
.posts-nav a span,
.in_post_widget .post-title,
.g-link .cov strong,
.wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav a,
.vc_progress_bar .vc_single_bar .vc_label{
    $titles_fonts
}

/* Top menu font */
ul.top-menu,
#a13-demo-switcher .before-label{
	$nav_menu_font
}

/* Text content font */
html,input,select,textarea,
.footer-widget.widget_nav_menu li a{
    $normal_fonts
}

/* Title bar */
.breadcrumbs, .post-meta{
    $title_bar_small_transform
}


/* ==================
   HEADER - top bar
   ==================*/
.top-bar-container,
.top-bar .options li ul{
    background-color: $tb_bgcolor;
}
.top-bar .msg{
    $tb_line_color
}
.top-bar .msg h1,
.top-bar .msg h2,
.top-bar .msg h3,
.top-bar .msg h4{
    $tb_title_color
}
.top-bar .msg_text{
    $tb_text_color
}
.top-bar .msg_text a,
.top-bar .message-close{
    $tb_link_color
}
.top-bar .msg_text a:hover,
.top-bar .message-close:hover{
    $tb_link_hover_color
}
.top-bar .options a{
    $tb_option_transform
    $tb_option_weight
    $tb_option_color
}
.top-bar .options a:hover,
.top-bar .options li:hover > a,
.top-bar .options li.hovered > a{
    $tb_option_hover_color
}
.top-bar .options a.special{
    color: $tb_option_hl_color;
}
.top-bar .options .message-opener:hover:before,
.top-bar .options .message-opener.active:before{
    background-color: $tb_option_hl_color;
}
.top-bar .options li ul:before{
    border-bottom-color: $tb_bgcolor;
}
.top-bar .options li li{
    $tb_sub_sep_color
}
.top-bar .options li ul{
    background-color: $tb_sub_option_bgcolor;
}
.top-bar .options li ul:before{
    border-bottom-color: $tb_sub_option_bgcolor;
}
.top-bar .options li li:hover{
    $tb_sub_option_hover_bgcolor
}

/* ==================
   HEADER
   ==================*/

#header{
    $header_bg_image
}
#header{
    $header_bg_color
}
#logo{
	$logo_color
    $logo_font_size
    $logo_weight
    $titles_fonts
    padding-top: $logo_padding;
    padding-bottom: $logo_padding;
}
#logo:hover{
	$logo_color_hover
}
#logo:hover img{
    filter: alpha(opacity=$logo_image_hover);
    opacity: $logo_image_hover_o;
}
header .bottom-head,
.top-menu ul{
    $menu_bg_color
}
.navigation-bar{
    $menu_top_border
}
.navigation-bar,
.wc-header-cart .header-cart-inside,
#header .search{
    $header_lines_color
}
.wc-header-cart.empty-cart .cart-link,
#header .search .action.open{
    $header_icons_color
}
.top-menu ul{
    background-color: $submenu_bg_color;
    border-color: $menu_hover_color;
    $submenu_top_line
}
.top-menu li a{
    $menu_font_size
    padding-left: $menu_element_padding;
    padding-right: $menu_element_padding;
}
.top-menu li a{
    $menu_color
    $menu_weight
    $menu_transform
}
.top-menu li:hover > a,
.top-menu li.hovered > a,
.top-menu li.current-menu-item > a,
.top-menu li.current-menu-ancestor  > a{
    color: $menu_hover_color;
}
.top-menu > li:hover > a:before,
.top-menu > li.hovered > a:before,
.top-menu > li.current-menu-item > a:before,
.top-menu > li.current-menu-ancestor > a:before{
    border-color: $menu_hover_color;
    $menu_bottom_line
}
.top-menu li li a,
.top-menu li span.title{
    $submenu_font_size
    $submenu_color
    $submenu_weight
    $submenu_transform
}
.top-menu li li:hover > a,
.top-menu li li.hovered > a,
.top-menu li li.current-menu-item > a,
.top-menu li li.current-menu-ancestor > a{
    $submenu_hover_color
    $submenu_hover_bg_color
}
.top-menu li li a, .top-menu li span.title,
.top-menu .mega-menu ul li li > a,
.mega-menu > ul > li,
.navigation-bar.touch .top-menu li a,
.navigation-bar.touch .top-menu li span.title{
    $submenu_sep_color
}
.lt-ie9 .top-menu ul{
    $submenu_sep_color
}
.top-menu .mega-menu span.title,
.top-menu .mega-menu > ul > li > a{
    $mm_group_font_size
    $submenu_weight
    $submenu_transform
}
.top-menu span em, .top-menu a em{
    border-color: $menu_label_color;
    color: $menu_label_color;
}
.top-menu ul span em, .top-menu ul a em{
    border-color: $submenu_label_color;
    color: $submenu_label_color;
}
#fixed-header{
    $header_bg_color
    $menu_bg_color
    $fixed_header_bg_color
}
.navigation-bar.touch .menu-container,
.navigation-bar.touch .top-menu ul{
    $header_bg_color
    $menu_bg_color
}


/* ==================
   FOOTER
   ==================*/
.foot-widgets{
    $fw_bg_color
    $fw_font_color
}
.foot-widgets .foot-content:before{
    $fw_border_color
}
.foot-widgets .widget{
    $fw_font_size
}
.foot-widgets .widget h3.title, .foot-widgets .widget h3.title a {
    $fw_title_color
    $fw_title_size
    $fw_title_border
}
.foot-widgets .widget a{
    color: $fw_link_color;
}
.foot-widgets .widget .author,
.foot-widgets .widget a:hover{
    color: $fw_link_hover_color;
}
.foot-widgets .tagcloud a {
    color: $fw_link_color;
    border-color: $fw_link_color;
}
.foot-widgets .tagcloud a:hover{
    color: $fw_link_hover_color;
    border-color: $fw_link_hover_color;
}
.foot-widgets .widget .entry-date,
.foot-widgets .rss-date,
.foot-widgets .widget_categories,
.foot-widgets .widget_archive,
.foot-widgets .widget_recent_comments,
.foot-widgets .widget a.comments,
.foot-widgets .widget_contact_info .with_icon > i,
.footer-widget .widget-slider-ctrls span{
    $fw_other_color
}

/*lower part*/
.foot-items{
    $footer_bg_color
    $footer_bg_image
}
.f-texts{
    $footer_lines_color
    $footer_font_size
    $footer_font_color
}
.f-texts a{
    $footer_link_color
}
.f-texts a:hover{
    $footer_link_hover_color
}


/* ==================
   GALLERIES LIST
   ==================*/
.bricks_fluid #a13-galleries{
     $galleries_brick_padd_t
     $galleries_brick_padd_l
     $galleries_brick_padd_r
}
.bricks_fluid #a13-galleries .g-item{
     $galleries_brick_margin_b
     $galleries_brick_margin_r
     $galleries_brick_margin_l
     $galleries_brick_height
     $galleries_brick_width
}


/* ==================
   SINGLE GALLERY
   ==================*/
#a13-gallery{
     $gallery_brick_padd_t
     $gallery_brick_padd_l
     $gallery_brick_padd_r
}
#a13-gallery .g-link{
     $gallery_brick_margin_b
     $gallery_brick_margin_r
     $gallery_brick_margin_l
     $gallery_brick_height
     $gallery_brick_width
}
.single-gallery #a13-slider-caption{
    $gallery_caption
}
.single-gallery #slide-list{
    $gallery_slide_list
}
.single-gallery .in-post-slider{
    $gallery_slider_h
}


/* ==================
   WORKS LIST
   ==================*/
.bricks_fluid #a13-works{
     $works_brick_padd_t
     $works_brick_padd_l
     $works_brick_padd_r
}
.bricks_fluid #a13-works .g-item{
     $works_brick_margin_b
     $works_brick_margin_r
     $works_brick_margin_l
     $works_brick_height
     $works_brick_width
}


/* ==================
   SINGLE WORK
   ==================*/
.single-work #a13-scroll-pan{
    $work_scroller_h
}
.single-work .in-post-slider{
    $work_slider_h
}
.single-work #a13-slider-caption{
    $work_caption
}
.single-work #slide-list{
    $work_slide_list
}

   
/* ==================
   BLOG
   ==================*/
.variant_masonry #only-posts-here{
    $blog_brick_padd_l
    $blog_brick_padd_r
}
.variant_masonry .archive-item{
    $blog_brick_width
    $blog_brick_margin_b
    $blog_brick_margin_r
    $blog_brick_margin_l
}


/* ==================
   CONTENT
   ==================*/
#content{
    $content_font_size
    $content_font_color
}
.real-content > p:first-child{
    $content_first_p_show
    $content_first_p_color
}


/* ==================
   RESPONSIVE
   ==================*/
/*@media print,
(-o-min-device-pixel-ratio: 5/4),
(-webkit-min-device-pixel-ratio: 1.25),
(min-resolution: 120dpi) {
}*/

/* ==================
   CUSTOM CSS
   ==================*/
".stripslashes($custom_CSS)."
";

return $user_css;
