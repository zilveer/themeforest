<?php

$root = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
    require_once( $root.'/wp-config.php' );
} else {
	$root = dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))));
	if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
    require_once( $root.'/wp-config.php' );
	}
}
header("Content-type: text/css; charset=utf-8");
?>
<?php if (!empty($qode_options_theme13['selection_color'])) { ?>
    /* Webkit */
    ::selection {
        background: <?php echo $qode_options_theme13['selection_color'];  ?>;
    }
<?php } ?>
<?php if (!empty($qode_options_theme13['selection_color'])) { ?>
    /* Gecko/Mozilla */
    ::-moz-selection {
        background: <?php echo $qode_options_theme13['selection_color'];  ?>;
    }
<?php } ?>
<?php if (!empty($qode_options_theme13['first_color']) || !empty($qode_options_theme13['first_color_gradient']) || !empty($qode_options_theme13['first_gradient_border'])) { ?>

    <?php if (!empty($qode_options_theme13['first_color'])){ ?>
        .q_progress_bar .progress_content,
        .portfolio_gallery a .gallery_text_holder,
        .projects_holder article .portfolio_description .separator,
        .projects_holder article .hover_feature_holder_title .separator,
        .portfolio_slider .image_holder .separator,
        .highlight,
        .gallery_holder ul li .gallery_hover,
        .q_dropcap.circle,
        .q_dropcap.square,
        .q_icon_with_title.boxed .icon_holder .fa-stack, 
        .q_font_awsome_icon_square,
        .q_icon_with_title.square .icon_holder .fa-stack,
        .box_holder_icon_inner.square .fa-stack,
        .q_font_awsome_icon_square,
        .box_holder_icon_inner.circle .fa-stack,
        .circle .icon_holder .fa-stack,
        .q_list.number.circle_number ul>li:before,
        .latest_post_holder .latest_post_date .post_publish_day,
        .social_share_dropdown ul li.share_title,
        #wp-calendar td#today,
        #back_to_top:hover span,
        .vc_text_separator.full div,
        .mejs-controls .mejs-time-rail .mejs-time-current,
        .mejs-controls .mejs-time-rail .mejs-time-handle,
        .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current,
        .q_pie_graf_legend ul li .color_holder,
        .q_line_graf_legend ul li .color_holder,
        .circle_item .circle:hover,
        .qode_call_to_action.container,
        .qode_carousels .flex-control-paging li a.flex-active{
            background-color: <?php echo $qode_options_theme13['first_color'];?>;
        }

        <?php $gallery_f_hover = qode_hex2rgb($qode_options_theme13['first_color']); ?>

        .portfolio_gallery a .gallery_text_holder, 
        .gallery_holder ul li .gallery_hover{
            background-color: rgba(<?php echo $gallery_f_hover[0]; ?>,<?php echo $gallery_f_hover[1]; ?>,<?php echo $gallery_f_hover[2]; ?>,0.9);
        }

        h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover, a, p a,
        nav.main_menu>ul>li.active > a > span,
        nav.main_menu>ul>li.active > a > i,
        nav.main_menu > ul > li:hover > a > span,
        nav.main_menu > ul > li:hover > a > i,
        .drop_down .second .inner > ul > li > a:hover,
        .drop_down .second .inner ul li.sub ul li a:hover,
        .drop_down .wide.icons  .second a:hover i,
        nav.mobile_menu ul li a:hover,
        nav.mobile_menu ul li.active > a,
        .breadcrumb .current,
        .breadcrumb a:hover,
        .box_image_holder .box_icon .fa-stack i.fa-stack-base,
        .q_icon_list i,
        .q_counter_holder span.counter,
        .box_holder_icon .fa-stack i,
        .qbutton.gray,
        .qbutton.gray:hover,
        .q_percentage_with_icon,
        .portfolio_navigation .portfolio_button a:hover i,
        .portfolio_like a.liked i,
        .portfolio_like a:hover i,
        .portfolio_single .portfolio_like a.liked i,
        .portfolio_single .portfolio_like a:hover i,
        .filter_holder ul li:hover span,
        .q_accordion_holder.accordion .ui-accordion-header:hover,
        .q_accordion_holder.accordion.with_icon .ui-accordion-header i,
        .testimonial_content_inner .testimonial_author .company_position,
        blockquote i.pull-left,
        .q_dropcap,
        .q_message.with_icon > i,
        .q_box_holder.with_icon .box_holder_icon_inner .fa-stack i.fa-stack-base,
        .q_font_awsome_icon_stack .fa-circle,
        .q_icon_with_title.boxed .icon_holder .fa-stack,
        .q_icon_with_title.center .icon_holder .font_awsome_icon i:hover,
        .q_icon_with_title .icon_with_title_link,
        .q_font_awsome_icon i:hover,
        .q_progress_bars_icons_inner.square .bar.active i,
        .q_progress_bars_icons_inner.circle .bar.active i,
        .q_progress_bars_icons_inner.normal .bar.active i,
        .q_progress_bars_icons_inner .bar.active i.fa-circle,
        .q_list.number ul>li:before,
        .latest_post_inner .post_infos a:hover,
        .post_info_right a:hover,
        .blog_holder article .post_description a:hover,
        .blog_holder.masonry article .post_info a:hover,
        .blog_holder article .post_comments:hover i,
        .latest_post_inner .post_comments:hover i,
        .blog_holder article .post_description a:hover,
        .blog_holder article .post_description .post_comments:hover,
        .blog_like a:hover i,
        .blog_like a.liked i,
        .blog_like a:hover span,
        .social_share_holder:hover .social_share_title,
        .social_share_dropdown ul li:hover .share_text,
        .social_share_dropdown ul li :hover i,
        .blog_holder article.format-quote .post_text i.qoute_mark,
        .blog_holder article.format-link .post_text i.link_mark,
        .blog_holder article.format-link .post_text .post_text_holder:hover h4 a,
        .blog_holder article.format-quote .post_text .post_text_holder:hover h4 a,
        .blog_holder article.format-quote .post_text .post_text_holder:hover .quote_author,
        .author_text_holder .author_email,
        .comment_holder .comment .text .replay, 
        .comment_holder .comment .text .comment-reply-link,
        .header-widget.widget_nav_menu ul.menu li a:hover,
        aside .widget a:hover,
        .header_top #lang_sel ul li ul li a:hover,
        .header_top #lang_sel_click ul li ul li a:hover,
        .header_top #lang_sel_list ul li a.lang_sel_sel,
        .header_top #lang_sel_list ul li a:hover,
        aside .widget #lang_sel a.lang_sel_sel:hover,
        aside .widget #lang_sel_click a.lang_sel_sel:hover,
        aside .widget #lang_sel ul ul a:hover,
        aside .widget #lang_sel_click ul ul a:hover,
        aside .widget #lang_sel_list li a.lang_sel_sel,
        aside .widget #lang_sel_list li a:hover,
        .q_team .q_team_title_holder span,
        .animated_icon_with_text_holder .animated_text p,
        #respond textarea:focus,
        #respond input[type='text']:focus,
        .contact_form input[type='text']:focus,
        .contact_form  textarea:focus,
        .side_menu_button > a:hover,
        .header_top #lang_sel > ul > li > a:hover, 
        .header_top #lang_sel_click > ul > li> a:hover,
				nav.content_menu ul li.active i,
				nav.content_menu ul li:hover i,
				nav.content_menu ul li.active a,
				nav.content_menu ul li:hover a,
				aside .widget.posts_holder li:hover{
            color: <?php echo $qode_options_theme13['first_color'];?>;
        }

        .q_steps_holder .circle_small:hover span, .q_steps_holder .circle_small:hover .step_title, .q_circles_holder .q_circle_inner2:hover i,
        .header_top #lang_sel > ul > li > a:hover, 
        .header_top #lang_sel_click > ul > li> a:hover{
            color: <?php echo $qode_options_theme13['first_color'];?> !important;
        }

        .ajax_loader_html,
        .box_image_with_border:hover,
        .q_progress_bars_icons_inner.square .bar.active .bar_noactive, 
        .q_progress_bars_icons_inner.square .bar.active .bar_active,
        .q_progress_bars_icons_inner.circle .bar.active .bar_noactive,
        .q_progress_bars_icons_inner.circle .bar.active .bar_active,
        .blog_holder article.format-link .post_text .post_text_holder:hover,
        .blog_holder article.format-quote .post_text .post_text_holder:hover,
        .widget.widget_search form.form_focus,
        #back_to_top:hover span,
        .q_steps_holder .circle_small_wrapper,
        #respond textarea:focus,
        #respond input[type='text']:focus,
        .contact_form input[type='text']:focus,
        .contact_form  textarea:focus,
        blockquote,
        .q_progress_bar .progress_content{
            border-color: <?php echo $qode_options_theme13['first_color'];?>;
        }

        <?php if(function_exists("is_woocommerce")){ ?>
            .woocommerce ul.products li.product:hover .price,
            .woocommerce .select2-results li.select2-highlighted,
            .woocommerce-page .select2-results li.select2-highlighted,
            .woocommerce-checkout .chosen-container .chosen-results li.active-result.highlighted,
            .woocommerce-account .chosen-container .chosen-results li.active-result.highlighted,
            .woocommerce ul.products li.product .price,
            .woocommerce div.product p[itemprop='price'] span.amount,
            .woocommerce div.cart-collaterals div.cart_totals table tr.order-total strong span.amount,
            .woocommerce-page div.cart-collaterals div.cart_totals table tr.order-total strong span.amount,
            .woocommerce div.cart-collaterals div.cart_totals table tr.order-total strong,
            .woocommerce .checkout-opener-text a,
            .woocommerce form.checkout table.shop_table tfoot tr.order-total th,
            .woocommerce form.checkout table.shop_table tfoot tr.order-total td span.amount,
            .woocommerce aside ul.product_list_widget li > a:hover,
            .woocommerce aside ul.product-categories li > a:hover,
            .woocommerce aside ul.product_list_widget li span.amount,
            .woocommerce aside .widget ul.product-categories a:hover,
            .woocommerce-page aside .widget ul.product-categories a:hover,
            .shopping_cart_dropdown ul li a:hover,
            .shopping_cart_dropdown span.total span,
            .shopping_cart_dropdown .cart_list span.quantity,
            .shopping_cart_header .header_cart:hover i{
                color: <?php echo $qode_options_theme13['first_color'];?>;
            }

            .woocommerce .product .onsale,
            .woocommerce .product .single-onsale,
            .woocommerce .quantity .minus:hover,
            .woocommerce #content .quantity .minus:hover,
            .woocommerce-page .quantity .minus:hover,
            .woocommerce-page #content .quantity .minus:hover,
            .woocommerce .quantity .plus:hover,
            .woocommerce #content .quantity .plus:hover,
            .woocommerce-page .quantity .plus:hover,
            .woocommerce-page #content .quantity .plus:hover,
            .woocommerce .quantity input[type="button"]:hover,
            .woocommerce #content .quantity input[type="button"]:hover,
            .woocommerce-page .quantity input[type="button"]:hover,
            .woocommerce-page #content .quantity input[type="button"]:hover,
            .woocommerce .quantity input[type="button"]:active,
            .woocommerce #content .quantity input[type="button"]:active,
            .woocommerce-page .quantity input[type="button"]:active,
            .woocommerce-page #content .quantity input[type="button"]:active,
            .woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,
            .woocommerce-page .widget_price_filter .price_slider_wrapper .ui-widget-content,
            .shopping_cart_header .header_cart span{
                background-color: <?php echo $qode_options_theme13['first_color'];?>;
            }
        <?php } ?>

    <?php } ?>
    
    <?php if (!empty($qode_options_theme13['first_color']) && !empty($qode_options_theme13['first_color_gradient'])) { ?>
        .q_progress_bars_vertical .progress_content_outer .progress_content, 
        .qbutton, 
        .load_more a, 
        #submit_comment, 
        .drop_down .wide .second ul li .qbutton, 
        .drop_down .wide .second ul li ul li .qbutton, 
        .qbutton.dark, 
        .q_social_icon_holder .fa-stack, 
        .single_tags a, 
        .widget .tagcloud a,
        .animated_icon_inner span.animated_icon_back i{
            background: <?php echo $qode_options_theme13['first_color_gradient'];?>;
            background: <?php echo $qode_options_theme13['first_color'];?> -ms-linear-gradient(bottom, <?php echo $qode_options_theme13['first_color_gradient'];?> 0%, <?php echo $qode_options_theme13['first_color'];?> 100%);
            background: <?php echo $qode_options_theme13['first_color'];?> -moz-linear-gradient(bottom, <?php echo $qode_options_theme13['first_color_gradient'];?> 0%, <?php echo $qode_options_theme13['first_color'];?> 100%);
            background: <?php echo $qode_options_theme13['first_color'];?> -o-linear-gradient(bottom, <?php echo $qode_options_theme13['first_color_gradient'];?> 0%, <?php echo $qode_options_theme13['first_color'];?> 100%);
            background: <?php echo $qode_options_theme13['first_color'];?> -webkit-gradient(linear, left bottom, left top, color-stop(0,<?php echo $qode_options_theme13['first_color_gradient'];?>), color-stop(1, <?php echo $qode_options_theme13['first_color'];?>));
            background: <?php echo $qode_options_theme13['first_color'];?> -webkit-linear-gradient(bottom, <?php echo $qode_options_theme13['first_color_gradient'];?> 0%, <?php echo $qode_options_theme13['first_color'];?> 100%);
            background: <?php echo $qode_options_theme13['first_color'];?> linear-gradient(to top, <?php echo $qode_options_theme13['first_color_gradient'];?> 0%, <?php echo $qode_options_theme13['first_color'];?> 100%);
        }

        .q_social_icon_holder:hover i.simple_social{
            color: <?php echo $qode_options_theme13['first_color_gradient'];?> !important;
        }

        <?php if(function_exists("is_woocommerce")){ ?>
            .woocommerce .button,
            .woocommerce-page .button,
            .woocommerce-page input[type="submit"],
            .woocommerce input[type="submit"],
            .woocommerce ul.products li.product .added_to_cart,
            .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
            .woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle{
                background: <?php echo $qode_options_theme13['first_color_gradient'];?>;
                background: <?php echo $qode_options_theme13['first_color'];?> -ms-linear-gradient(bottom, <?php echo $qode_options_theme13['first_color_gradient'];?> 0%, <?php echo $qode_options_theme13['first_color'];?> 100%);
                background: <?php echo $qode_options_theme13['first_color'];?> -moz-linear-gradient(bottom, <?php echo $qode_options_theme13['first_color_gradient'];?> 0%, <?php echo $qode_options_theme13['first_color'];?> 100%);
                background: <?php echo $qode_options_theme13['first_color'];?> -o-linear-gradient(bottom, <?php echo $qode_options_theme13['first_color_gradient'];?> 0%, <?php echo $qode_options_theme13['first_color'];?> 100%);
                background: <?php echo $qode_options_theme13['first_color'];?> -webkit-gradient(linear, left bottom, left top, color-stop(0,<?php echo $qode_options_theme13['first_color_gradient'];?>), color-stop(1, <?php echo $qode_options_theme13['first_color'];?>));
                background: <?php echo $qode_options_theme13['first_color'];?> -webkit-linear-gradient(bottom, <?php echo $qode_options_theme13['first_color_gradient'];?> 0%, <?php echo $qode_options_theme13['first_color'];?> 100%);
                background: <?php echo $qode_options_theme13['first_color'];?> linear-gradient(to top, <?php echo $qode_options_theme13['first_color_gradient'];?> 0%, <?php echo $qode_options_theme13['first_color'];?> 100%);
            }
        <?php } ?>
    <?php } ?>  

    <?php if (!empty($qode_options_theme13['first_gradient_border'])){ ?>
        .q_progress_bars_vertical .progress_content_outer .progress_content, 
        .qbutton, 
        .load_more a, 
        #submit_comment, 
        .drop_down .wide .second ul li .qbutton, 
        .drop_down .wide .second ul li ul li .qbutton, 
        .qbutton.dark, 
        .q_social_icon_holder .fa-stack, 
        .single_tags a, 
        .widget .tagcloud a, 
        .animated_icon_inner span.animated_icon_back i{
            border-color: <?php echo $qode_options_theme13['first_gradient_border']; ?>;
        }

        <?php if(function_exists("is_woocommerce")){ ?>
            .woocommerce .button,
            .woocommerce-page .button,
            .woocommerce-page input[type="submit"],
            .woocommerce input[type="submit"],
            woocommerce ul.products li.product .added_to_cart,
            .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
            .woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle{
                border-color: <?php echo $qode_options_theme13['first_gradient_border']; ?>;
            }
        <?php } ?>
    <?php } ?>

<?php } ?>

<?php if (!empty($qode_options_theme13['second_color']) || !empty($qode_options_theme13['second_color_gradient']) || !empty($qode_options_theme13['second_gradient_border'])) { ?>

    <?php if (!empty($qode_options_theme13['second_color'])){ ?>
        .q_progress_bar .progress_content_outer{
            background-color: <?php echo $qode_options_theme13['second_color'];?>;
        }

        .q_icon_with_title.boxed .icon_holder .fa-stack:hover,
        .box_holder_icon_inner.circle .fa-stack:hover,
        .q_icon_with_title.square .icon_holder .fa-stack:hover,
        .box_holder_icon_inner.square .fa-stack:hover,
        .q_font_awsome_icon_square:hover, 
        .circle .icon_holder .fa-stack:hover{
            background-color: <?php echo $qode_options_theme13['second_color'];?> !important;
        }

        .q_icon_with_title.circle .icon_holder .fa-stack:hover i.fa-circle,
        .q_font_awsome_icon_stack:hover .fa-circle,
        .q_box_holder.with_icon .box_holder_icon_inner .fa-stack:hover i.fa-stack-base{
            color: <?php echo $qode_options_theme13['second_color'];?> !important;
        }
    <?php } ?>
    
    <?php if (!empty($qode_options_theme13['second_color']) && !empty($qode_options_theme13['second_color_gradient'])){ ?>
        .q_icon_list i,
        .q_progress_bars_vertical .progress_content_outer,
        .portfolio_navigation .portfolio_prev a,
        .portfolio_navigation .portfolio_next a,
        .q_accordion_holder.accordion .ui-accordion-header .accordion_mark,
        .pagination ul li span,
        .pagination ul li a,
		.single_links_pages span,
        .animated_icon_inner i{
            background: <?php echo $qode_options_theme13['second_color'];?>;
            background: <?php echo $qode_options_theme13['second_color_gradient']; ?> -ms-linear-gradient(bottom, <?php echo $qode_options_theme13['second_color'];?> 0%, <?php echo $second_color_gradient; ?> 100%);
            background: <?php echo $qode_options_theme13['second_color_gradient']; ?> -moz-linear-gradient(bottom, <?php echo $qode_options_theme13['second_color'];?> 0%, <?php echo $qode_options_theme13['second_color_gradient']; ?> 100%);
            background: <?php echo $qode_options_theme13['second_color_gradient']; ?> -o-linear-gradient(bottom, <?php echo $qode_options_theme13['second_color'];?> 0%, <?php echo $qode_options_theme13['second_color_gradient']; ?> 100%);
            background: <?php echo $qode_options_theme13['second_color_gradient']; ?> -webkit-gradient(linear, left bottom, left top, color-stop(0,<?php echo $qode_options_theme13['second_color'];?>), color-stop(1, <?php echo $qode_options_theme13['second_color_gradient']; ?>));
            background: <?php echo $qode_options_theme13['second_color_gradient']; ?> -webkit-linear-gradient(bottom, <?php echo $qode_options_theme13['second_color'];?> 0%, <?php echo $qode_options_theme13['second_color_gradient']; ?> 100%);
            background: <?php echo $qode_options_theme13['second_color_gradient']; ?> linear-gradient(to top, <?php echo $qode_options_theme13['second_color'];?> 0%, <?php echo $qode_options_theme13['second_color_gradient']; ?> 100%);
        }

        <?php if(function_exists("is_woocommerce")){ ?>
            .woocommerce-pagination ul.page-numbers li a,
            .woocommerce-pagination ul.page-numbers li span{
                background: <?php echo $qode_options_theme13['second_color'];?>;
                background: <?php echo $qode_options_theme13['second_color_gradient']; ?> -ms-linear-gradient(bottom, <?php echo $qode_options_theme13['second_color'];?> 0%, <?php echo $qode_options_theme13['second_color_gradient']; ?> 100%);
                background: <?php echo $qode_options_theme13['second_color_gradient']; ?> -moz-linear-gradient(bottom, <?php echo $qode_options_theme13['second_color'];?> 0%, <?php echo $qode_options_theme13['second_color_gradient']; ?> 100%);
                background: <?php echo $qode_options_theme13['second_color_gradient']; ?> -o-linear-gradient(bottom, <?php echo $qode_options_theme13['second_color'];?> 0%, <?php echo $qode_options_theme13['second_color_gradient']; ?> 100%);
                background: <?php echo $qode_options_theme13['second_color_gradient']; ?> -webkit-gradient(linear, left bottom, left top, color-stop(0,<?php echo $qode_options_theme13['second_color'];?>), color-stop(1, <?php echo $qode_options_theme13['second_color_gradient']; ?>));
                background: <?php echo $qode_options_theme13['second_color_gradient']; ?> -webkit-linear-gradient(bottom, <?php echo $qode_options_theme13['second_color'];?> 0%, <?php echo $qode_options_theme13['second_color_gradient']; ?> 100%);
                background: <?php echo $qode_options_theme13['second_color_gradient']; ?> linear-gradient(to top, <?php echo $qode_options_theme13['second_color'];?> 0%, <?php echo $qode_options_theme13['second_color_gradient']; ?> 100%);
            }
        <?php } ?>
    <?php } ?>

    <?php if (!empty($qode_options_theme13['second_gradient_border'])){ ?>
        .q_icon_list i,
        .q_progress_bars_vertical .progress_content_outer,
        .portfolio_navigation .portfolio_prev a,
        .portfolio_navigation .portfolio_next a,
        .q_accordion_holder.accordion .ui-accordion-header .accordion_mark,
        .pagination ul li span,
        .pagination ul li a,
		.single_links_pages span,
        .animated_icon_inner i,
        .q_progress_bar .progress_content_outer,
        .q_counter_holder.boxed_counter,
        .q_box_holder.with_icon,
        .call_to_action,
        .projects_holder article .portfolio_description,
        .filter_holder ul,
        .filter_holder ul li.filter,
        .q_tabs .tabs-nav li a,
        .q_tabs.horizontal .tabs-nav li:last-child a,
        .q_tabs.boxed .tabs-nav li:last-child a,
        .q_tabs.boxed .tabs-container,
        .q_tabs.vertical .tabs-nav li a,
        .q_accordion_holder.accordion.with_icon,
        .q_accordion_holder.accordion.with_icon .ui-accordion-header,
        .q_accordion_holder.with_icon div.accordion_content,
        .author_image_holder .image_holder,
        .testimonials_holder.full_width  .image_holder,
        .testimonials .testimonial_text_inner,
        .testimonial_arrow,
        .q_message,
        .price_table_inner > ul,
        .price_table_inner ul li.pricing_table_content li,
        .latest_post_holder .latest_post,
        .latest_post_holder .latest_post_date .post_publish_month,
        .latest_post_holder.boxes > ul > li .boxes_image,
        .latest_post_holder.boxes > ul > li .latest_post,
        .post_author_avatar img,
        .social_share_dropdown ul,
        .social_share_dropdown ul li a,
        .blog_holder article.format-link .post_text .post_text_holder,
        .blog_holder article.format-quote .post_text .post_text_holder,
        .author_description,
        .author_description_inner .image,
        .comment_holder .comment,
        .comment_holder .comment .image,
        #respond textarea,
        #respond input[type='text'],
        .contact_form input[type='text'],
        .contact_form  textarea,
        .blog_holder.masonry article.format-audio .post_image,
        .blog_holder.masonry article .post_text,
        .blog_holder.masonry article .masonry_avatar img,
        aside .widget.posts_holder li,
        .widget #searchform,
        #back_to_top span,
        .vc_text_separator.full,
        aside .widget #lang_sel > ul > li ,
        aside .widget #lang_sel_click > ul > li,
        aside .widget #lang_sel ul ul,
        aside .widget #lang_sel_click ul ul,
        aside .widget #lang_sel ul ul a,
        aside .widget #lang_sel_click ul ul a,
        aside .widget #lang_sel ul ul a:visited,
        aside .widget #lang_sel_click ul ul a:visited,
		.mejs-container,
        .q_team,
        .q_team_inner,
        .q_team .q_team_image,
        .q_team .q_team_text,
        .qode_carousels .flex-control-paging li a,
        .qode_clients .qode_client_holder_inner:before,
        .qode_clients .qode_client_holder_inner:after,
        .animated_icons_with_text .animated_icon_with_text_inner:before,
        .animated_icons_with_text .animated_icon_with_text_inner:after,
        .q_circles_holder:before,
        .q_circles_holder .q_circle_inner2,
				nav.content_menu ul{
            border-color: <?php echo $qode_options_theme13['second_gradient_border']; ?>;
        }

        .social_share_dropdown .inner_arrow2 {
            border-color: transparent transparent <?php echo $qode_options_theme13['second_gradient_border']; ?> transparent;
        }

        .portfolio_navigation .portfolio_button a i{
            color: <?php echo $qode_options_theme13['second_gradient_border']; ?>;
        }

        .q_counter_holder .separator.small{
            background-color: <?php echo $qode_options_theme13['second_gradient_border']; ?>;
        }

        <?php if(function_exists("is_woocommerce")){ ?>
            .woocommerce-pagination ul.page-numbers li a,
            .woocommerce-pagination ul.page-numbers li span,
            .woocommerce div.cart-collaterals .select2-container .select2-choice,
            .woocommerce-page div.cart-collaterals .select2-container .select2-choice,
            .woocommerce div.cart-collaterals .select2-dropdown-open.select2-drop-above .select2-choice,
            .woocommerce div.cart-collaterals .select2-dropdown-open.select2-drop-above .select2-choices,
            .woocommerce-page div.cart-collaterals .select2-dropdown-open.select2-drop-above .select2-choice,
            .woocommerce-page div.cart-collaterals .select2-dropdown-open.select2-drop-above .select2-choices,
            .shopping_cart_dropdown,
            .shopping_cart_dropdown ul li,
            .select2-drop,
            .woocommerce div.message, 
            .woocommerce .woocommerce-message,
            .woocommerce .woocommerce-error,
            .woocommerce .woocommerce-info,
            .woocommerce input[type='text']:not(.qode_search_field),
            .woocommerce input[type='password'],
            .woocommerce input[type='email'],
            .woocommerce-page input[type='text']:not(.qode_search_field),
            .woocommerce-page input[type='password'],
            .woocommerce-page input[type='email'],
            .woocommerce textarea,
            .woocommerce-page textarea,
            .woocommerce .select2-container .select2-choice,
            .woocommerce-page .select2-container .select2-choice,
            .woocommerce .select2-dropdown-open.select2-drop-above .select2-choice,
            .woocommerce .select2-dropdown-open.select2-drop-above .select2-choices,
            .woocommerce-page .select2-dropdown-open.select2-drop-above .select2-choice,
            .woocommerce-page .select2-dropdown-open.select2-drop-above .select2-choices,
            .woocommerce .chosen-container.chosen-container-single .chosen-single,
            .woocommerce-page .chosen-container.chosen-container-single .chosen-single,
            .woocommerce-checkout .form-row .chosen-container-single .chosen-single,
            .woocommerce-checkout .form-row .chosen-container .chosen-drop,
            .woocommerce-account .form-row .chosen-container .chosen-drop,
            .woocommerce-checkout .form-row .chosen-container-single .chosen-search input,
            .woocommerce-account .form-row .chosen-container-single .chosen-search input,
            .woocommerce .select2-container.orderby .select2-choice,
            .woocommerce-page .select2-container.orderby .select2-choice,
            .woocommerce .select2-dropdown-open.select2-drop-above.orderby .select2-choice,
            .woocommerce .select2-dropdown-open.select2-drop-above.orderby .select2-choices,
            .woocommerce-page .select2-dropdown-open.select2-drop-above.orderby .select2-choice,
            .woocommerce-page .select2-dropdown-open.select2-drop-above.orderby .select2-choices{
                border-color: <?php echo $qode_options_theme13['second_gradient_border']; ?>;
            }
        <?php } ?>
    <?php } ?>
<?php } ?>

<?php if (!empty($qode_options_theme13['third_color'])) { ?>

    .q_tabs .tabs-nav li.active a,
    .q_tabs.boxed .tabs-container,
    .q_accordion_holder.accordion.with_icon .ui-accordion-header-active,
    .q_accordion_holder.with_icon div.accordion_content,
    .testimonials .testimonial_text_inner,
    .testimonial_arrow,
    #respond textarea,
    #respond input[type='text'],
    .contact_form input[type='text'],
    .contact_form  textarea,
    .circle_item .circle{
        background-color: <?php echo $qode_options_theme13['third_color'];?>;
    }

    .q_social_icon_holder .fa-stack i.fa-circle{
        color: <?php echo $qode_options_theme13['third_color'];?>;
    }

    .q_tabs.boxed .tabs-nav li.active a,
    .q_icon_with_title.with_border_line .icon_text_inner{
        border-color: <?php echo $qode_options_theme13['third_color'];?>;
    }

<?php } ?>
<?php if (!empty($qode_options_theme13['fourth_color'])) { ?>

    h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover,
    .q_tabs .tabs-nav li a:hover,
    .q_icon_with_title .icon_with_title_link:hover,
    .q_progress_bars_vertical .progress_number,
    .q_percentage,
    .portfolio_navigation .portfolio_prev a,
    .portfolio_navigation .portfolio_next a,
    .portfolio_navigation .portfolio_prev a i,
    .portfolio_navigation .portfolio_next a i,
    .portfolio_social_holder a,
    .portfolio_single .portfolio_like span,
    .testimonial_content_inner .testimonial_author .website,
    .q_message a.close i.dark,
    .q_message .message_text,
    .q_icon_with_title .icon_holder span i,
    .latest_post_holder .latest_post_date .post_publish_month,
    .latest_post_inner .post_infos a,
	.post_info_right a,
    .blog_holder article .post_description a,
    .blog_holder.masonry article .post_info a,
    .social_share_title,
    .single_tags i,
    .comment_holder .comment .text .name,
    .pagination ul li span,
    .pagination ul li a,
    .pagination ul li span,
    .pagination ul li a:hover,
    .pagination ul li.next a i,
    .pagination ul li.prev a i,
    .pagination ul li.last a i,
    .pagination ul li.first a i,
	.single_links_pages span,
    #back_to_top span i,
    .carousel-control,
    .carousel-control:hover,
    .animated_icon_inner i,
    .q_circles_holder .q_circle_inner2 i{
        color: <?php echo $qode_options_theme13['fourth_color'];?>;
    }

    <?php if(function_exists("is_woocommerce")){ ?>
        .woocommerce div.product div.product_meta > span{
            color: <?php echo $qode_options_theme13['fourth_color']; ?>;
        }
    <?php } ?>
<?php } ?>
<?php if (!empty($qode_options_theme13['background_color']) || !empty($qode_options_theme13['text_color']) || !empty($qode_options_theme13['text_fontsize']) || !empty($qode_options_theme13['text_fontweight']) || $qode_options_theme13['google_fonts'] != "-1") { ?>
    body{
    	<?php if($qode_options_theme13['google_fonts'] != "-1"){ ?>
    	<?php $font = str_replace('+', ' ', $qode_options_theme13['google_fonts']); ?>
    	font-family: '<?php echo $font; ?>', sans-serif;
    	<?php } ?>
    	<?php if (!empty($qode_options_theme13['text_color'])) { ?> color: <?php echo $qode_options_theme13['text_color'];  ?>; <?php } ?>
    	<?php if (!empty($qode_options_theme13['text_fontsize'])) { ?> font-size: <?php echo $qode_options_theme13['text_fontsize']; ?>px; <?php } ?>
    	<?php if (!empty($qode_options_theme13['text_fontweight'])) { ?>font-weight: <?php echo $qode_options_theme13['text_fontweight'];  ?>;<?php } ?>	
    }
    <?php if (!empty($qode_options_theme13['background_color'])) { ?> 
        body,
        .content,
        .full_width{
        	background-color:<?php echo $qode_options_theme13['background_color'];  ?>; 
        }
    <?php } ?>
<?php } ?>
<?php if (!empty($qode_options_theme13['background_color_box'])) { ?>
    .wrapper{
    	<?php if (!empty($qode_options_theme13['background_color_box'])) { ?> background-color:<?php echo $qode_options_theme13['background_color_box'];  ?>; <?php } ?>
    }
<?php } ?>
<?php
$boxed = "no";
if (isset($qode_options_theme13['boxed']))
	$boxed = $qode_options_theme13['boxed'];
?>
<?php if($boxed == "yes"){ ?>
body.boxed .wrapper{
	<?php if (!empty($qode_options_theme13['background_color_box'])) { ?> background-color:<?php echo $qode_options_theme13['background_color_box'];  ?>; <?php } ?>
	
	<?php if($qode_options_theme13['pattern_background_image'] != ""){  ?>
		background-image: url('<?php echo $qode_options_theme13['pattern_background_image'] ?>');
		background-position: 0px 0px;
		background-repeat: repeat;
	<?php } ?>
	
	<?php if($qode_options_theme13['background_image'] != ""){  ?>
		background-image: url('<?php echo $qode_options_theme13['background_image'] ?>');
		background-attachment: fixed;
		background-position: center 0px;
		background-repeat: no-repeat;
	<?php } ?>
}
body.boxed .content{
	<?php if (!empty($qode_options_theme13['background_color'])) { ?> background-color:<?php echo $qode_options_theme13['background_color'];  ?>; <?php } ?>
}
<?php } ?>
<?php if (!empty($qode_options_theme13['background_color_boxes'])) { ?>
.projects_holder article .portfolio_description,
.blog_holder.masonry article .post_text,
.q_team,
.q_team .q_team_text,
.price_table_inner,
.latest_post_holder.boxes > ul > li,
.q_counter_holder.boxed_counter
 {
	background-color: <?php echo $qode_options_theme13['background_color_boxes'];  ?>;
}
<?php } ?>
<?php if (!empty($qode_options_theme13['highlight_color'])) { ?>
span.highlight {
	background-color: <?php echo $qode_options_theme13['highlight_color'];  ?>;
}
<?php } ?>

<?php if (!empty($qode_options_theme13['header_background_color']) || $qode_options_theme13['header_background_transparency_initial'] != "") { 
	if(!empty($qode_options_theme13['header_background_color'])){
		$bg_color = qode_hex2rgb($qode_options_theme13['header_background_color']);
	}else{
		$bg_color = qode_hex2rgb('#ffffff');
	}
	if ($qode_options_theme13['header_background_transparency_initial'] != "") {
		$bg_color_transparency = $qode_options_theme13['header_background_transparency_initial'];
	}else{
		$bg_color_transparency = 1;
	}
?>
.header_bottom,
.header_top {
	background-color: rgba(<?php echo $bg_color[0]; ?>,<?php echo $bg_color[1]; ?>,<?php echo $bg_color[2]; ?>,<?php echo $bg_color_transparency; ?>);
}

<?php if(isset($bg_color_transparency) && $bg_color_transparency == 0) { ?>

.header_bottom,
.header_top {
    border-bottom: 0;
}

.header_bottom {
    box-shadow: none;
}

.header_top .right .inner > div:first-child,
.header_top .right .inner > div,
.header_top .left .inner > div:last-child,
.header_top .left .inner > div {
    border: none;
}

<?php } ?>

<?php } ?>

<?php if (!empty($qode_options_theme13['header_separator_color'])) { ?>

.header_top,
.header_bottom,
.title,
.header_top .left .inner > div,
.header_top .left .inner > div:last-child,
.header_top .right .inner > div:first-child,
.header_top .right .inner > div,
header .header_top .q_social_icon_holder,
.drop_down .second .inner ul li a,
.header-widget.widget_nav_menu ul.menu li ul li a,
.header_top #lang_sel ul li ul li a,
.header_top #lang_sel ul li ul li a:visited,
.header_top #lang_sel_click ul li ul li a,
.header_top #lang_sel_click ul li ul li a:visited,
.drop_down .second .inner > ul,
li.narrow .second .inner ul
{
	border-color:<?php echo $qode_options_theme13['header_separator_color'];  ?>;
}

<?php } ?>
<?php
if (!empty($qode_options_theme13['header_background_color_scroll']) || $qode_options_theme13['header_background_transparency_scroll'] != "") {
	
	if(!empty($qode_options_theme13['header_background_color_scroll'])){
		$bg_color_scroll = qode_hex2rgb($qode_options_theme13['header_background_color_scroll']);
	}else{
		$bg_color_scroll = qode_hex2rgb('#ffffff');
	}
	
	if ($qode_options_theme13['header_background_transparency_scroll'] != "") {
		$bg_color_scroll_transparency = $qode_options_theme13['header_background_transparency_scroll'];
	}else{
		$bg_color_scroll_transparency = 1;
	}
?>
header.scrolled .header_bottom,
header.scrolled .header_top {
	background-color: rgba(<?php echo $bg_color_scroll[0]; ?>,<?php echo $bg_color_scroll[1]; ?>,<?php echo $bg_color_scroll[2]; ?>,<?php echo $bg_color_scroll_transparency; ?>) !important;
}
<?php } ?>

<?php if($qode_options_theme13['header_background_transparency_scroll'] != "" && $qode_options_theme13['header_background_transparency_scroll'] == 0) { ?>

header.scrolled .header_bottom,
header.scrolled .header_top {
    border-bottom: 0;
}

header.scrolled .header_bottom {
    box-shadow: none;
}

header.scrolled .header_top .right .inner > div:first-child,
header.scrolled .header_top .right .inner > div,
header.scrolled .header_top .left .inner > div:last-child,
header.scrolled .header_top .left .inner > div {
    border: none;
}
<?php } ?>

<?php if($qode_options_theme13['header_background_transparency_scroll'] != "" && $qode_options_theme13['header_background_transparency_scroll'] > 0) { ?>

header.scrolled .header_bottom {
    -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.11);
    -moz-box-shadow: 0 1px 3px rgba(0,0,0,0.11);
    -o-box-shadow: 0 1px 3px rgba(0,0,0,0.11);
    box-shadow: 0 1px 3px rgba(0,0,0,0.11);
}

header.scrolled .header_bottom,
header.scrolled .header_top {
    border-bottom:1px solid #ebebeb;
}

header.scrolled .header_top .right .inner > div:first-child {
    border-left: 1px solid #eaeaea;
}

header.scrolled .header_top .right .inner > div {
    border-right: 1px solid #eaeaea;
    border-left: 0
}

header.scrolled .header_top .left .inner > div:last-child {
    border-right: 1px solid #eaeaea;
}

header.scrolled .header_top .left .inner > div {
    border-left: 1px solid #eaeaea;
}

<?php } ?>

<?php
if (!empty($qode_options_theme13['header_background_color_sticky']) || $qode_options_theme13['header_background_transparency_sticky'] != "") {
	
	if(!empty($qode_options_theme13['header_background_color_sticky'])){
		$bg_color_sticky = qode_hex2rgb($qode_options_theme13['header_background_color_sticky']);
	}else{
		$bg_color_sticky = qode_hex2rgb('#ffffff');
	}
	
	if ($qode_options_theme13['header_background_transparency_sticky'] != "") {
		$bg_color_sticky_transparency = $qode_options_theme13['header_background_transparency_sticky'];
	}else{
		$bg_color_sticky_transparency = 1;
	}
?>
header.sticky .header_bottom{
	background-color: rgba(<?php echo $bg_color_sticky[0]; ?>,<?php echo $bg_color_sticky[1]; ?>,<?php echo $bg_color_sticky[2]; ?>,<?php echo $bg_color_sticky_transparency; ?>) !important;
}
<?php } ?>

<?php if (!empty($qode_options_theme13['header_top_background_color']) || $qode_options_theme13['header_background_transparency_initial'] != "") { 
	if(!empty($qode_options_theme13['header_top_background_color'])) {
		$bg_color_top = qode_hex2rgb($qode_options_theme13['header_top_background_color']);
	}

	if ($qode_options_theme13['header_background_transparency_initial'] != "") {
		$bg_color_transparency = $qode_options_theme13['header_background_transparency_initial'];
	} else{
		$bg_color_transparency = 1;
	}
?>

.header_top,
.header_top .header-widget.widget_nav_menu ul ul{
	background-color: rgba(<?php echo $bg_color_top[0]; ?>,<?php echo $bg_color_top[1]; ?>,<?php echo $bg_color_top[2]; ?>,<?php echo $bg_color_transparency; ?>);
}
<?php } ?>
<?php
if (!empty($qode_options_theme13['header_top_background_color']) || $qode_options_theme13['header_background_transparency_scroll'] != "") {
	
	if(!empty($qode_options_theme13['header_top_background_color'])){
		$bg_color_scroll_top = qode_hex2rgb($qode_options_theme13['header_top_background_color']);
	}else{
		$bg_color_scroll_top = qode_hex2rgb('#000000');
	}
	
	if ($qode_options_theme13['header_background_transparency_scroll'] != "") {
		$bg_color_scroll_transparency = $qode_options_theme13['header_background_transparency_scroll'];
	}else{
		$bg_color_scroll_transparency = 0.7;
	}
?>
header.sticky .header_top{
	background-color: rgba(<?php echo $bg_color_scroll_top[0]; ?>,<?php echo $bg_color_scroll_top[1]; ?>,<?php echo $bg_color_scroll_top[2]; ?>,<?php echo $bg_color_scroll_transparency; ?>);
}
<?php } ?>

<?php
$header_bottom_appearance = "fixed";
if (isset($qode_options_theme13['header_bottom_appearance'])) {
    $header_bottom_appearance = $qode_options_theme13['header_bottom_appearance'];
}
?>

<?php 
	$display_header_top = "yes";
	if(isset($qode_options_theme13['header_top_area'])){
		$display_header_top = $qode_options_theme13['header_top_area'];
	}
	if (!empty($_SESSION['qode_theme13_header_top'])){
		$display_header_top = $_SESSION['qode_theme13_header_top'];
	}
	
	if($display_header_top == "no"){
		$margin_top_add = 0;
	}else{
		$margin_top_add = 34;
	}
	if (!empty($qode_options_theme13['header_height'])) {
		$header_height = $qode_options_theme13['header_height'] + 1;
	} else {
		$header_height = 86;
	}
	if($header_bottom_appearance == "stick menu_bottom") {
		$menu_bottom = 46; // border 1px
		if ($qode_options_theme13['center_logo_image'] == "yes") {
			if(is_active_sidebar('header_fixed_right')){
				$menu_bottom = $menu_bottom + 22; // 22 is for right widget in header bottom (line height of text)
			}
		}
	} else {
		$menu_bottom = 0;
	}
	$header_height = $header_height + $menu_bottom;
?>

<?php if ($header_bottom_appearance != "fixed") {?>
	<?php if ($qode_options_theme13['center_logo_image'] != "yes") { ?>
		<?php if($header_bottom_appearance == "stick menu_bottom") { ?>
		.content{
			margin-top: <?php echo '-'.($margin_top_add + $header_height - 6); // 30 is top and bottom margin of centered logo  + 6 is neagitve margin on header?>px;
		}
		<?php }  else { ?>
			.content{
				margin-top: <?php echo '-'.($header_height + $margin_top_add); ?>px;
			}
		<?php } ?>
		
	<?php } else { 
			$height = 0;
		?>
		<?php if(isset($qode_options_theme13['logo_image'])){ 
			if (!empty($qode_options_theme13['logo_image'])) {
				$logo_url_obj = parse_url($qode_options_theme13['logo_image']); 
				list($width, $height, $type, $attr) = getimagesize($_SERVER['DOCUMENT_ROOT'].$logo_url_obj['path']);  
			} 
		} ?>
		<?php if($header_bottom_appearance == "stick menu_bottom") { ?>
		.content{
			margin-top: <?php echo '-'.(30 + $height + $menu_bottom + $margin_top_add); // 30 is top and bottom margin of centered logo ?>px;
		}
		<?php }  else { ?>
			.content{
				margin-top: <?php echo '-'.(30 + $height + $header_height + $margin_top_add -1); // 30 is top and bottom margin of centered logo, 1 is border ?>px;
			}
		<?php } ?>
	<?php } ?>
<?php } else { ?>
.content{
	margin-top: 0;
}
<?php } ?>

<?php if (!empty($qode_options_theme13['header_height'])) { ?>
.logo_wrapper,
.side_menu_button{
	height: <?php echo $qode_options_theme13['header_height'];  ?>px;
}
.content.content_top_margin{
	margin-top: <?php echo $qode_options_theme13['header_height'] + $margin_top_add;  ?> !important;
}

header:not(.centered_logo) .header_fixed_right_area {
    line-height: <?php echo $qode_options_theme13['header_height'];  ?>px;
}

<?php if ($qode_options_theme13['header_background_transparency_initial'] != "1") { ?>

.drop_down .second,
.drop_down .second.bellow_header
{
	top: <?php echo $qode_options_theme13['header_height'];  ?>px;
}
<?php } ?>

<?php } ?>

<?php if (!empty($qode_options_theme13['header_height_scroll'])) { ?>
header.scrolled .logo_wrapper,
header.scrolled .side_menu_button{
	height: <?php echo $qode_options_theme13['header_height_scroll'];  ?>px;
}

header.scrolled nav.main_menu ul li a {
	line-height: <?php echo $qode_options_theme13['header_height_scroll'];  ?>px;
}

header.scrolled .drop_down .second{
	top: <?php echo $qode_options_theme13['header_height_scroll'];  ?>px;
}
<?php } ?>

<?php if (!empty($qode_options_theme13['header_height_sticky'])) { ?>
header.sticky .logo_wrapper,
header.sticky.centered_logo .logo_wrapper,
header.sticky .side_menu_button {
	height: <?php echo $qode_options_theme13['header_height_sticky'];  ?>px !important;
}

header.sticky nav.main_menu > ul > li > a, 
.light.sticky nav.main_menu > ul > li > a, 
.light.sticky nav.main_menu > ul > li > a:hover, 
.light.sticky nav.main_menu > ul > li.active > a, 
.dark.sticky nav.main_menu > ul > li > a, 
.dark.sticky nav.main_menu > ul > li > a:hover, 
.dark.sticky nav.main_menu > ul > li.active > a {
	line-height: <?php echo $qode_options_theme13['header_height_sticky'];  ?>px;
}

header.sticky .drop_down .second{
	top: <?php echo $qode_options_theme13['header_height_sticky'];  ?>px;
}
<?php } ?>

<?php
$parallax_onoff = "on";
if (isset($qode_options_theme13['parallax_onoff']))
	$parallax_onoff = $qode_options_theme13['parallax_onoff'];
if ($parallax_onoff == "off"){
?>
	.touch .parallax section{
		height: auto !important;
		min-height: 300px;  
		background-position: center top !important;  
		background-attachment: scroll;
	}
		
	.touch	.parallax section.no_background{
		padding: 0px;
	}
<?php } ?>
<?php if (!empty($qode_options_theme13['header_height'])) { ?>
nav.main_menu > ul > li > a{
	line-height: <?php echo $qode_options_theme13['header_height'];  ?>px;
}
<?php } ?>
<?php if (!empty($qode_options_theme13['dropdown_background_color'])) { 
	$dropdown_bg_color_initial = qode_hex2rgb($qode_options_theme13['dropdown_background_color']);
	if (!empty($qode_options_theme13['dropdown_background_transparency'])) {
		$dropdown_bg_transparency = $qode_options_theme13['dropdown_background_transparency'];
	}else{
		$dropdown_bg_transparency = 0.8;
	}
?>
.drop_down .second .inner ul, 
.drop_down .second .inner ul li ul, 
li.narrow .second .inner ul, 
nav.main_menu > ul > li:hover > a, 
header.sticky nav.main_menu > ul > li:hover > a span
{
	background-color: <?php echo $qode_options_theme13['dropdown_background_color'];  ?>;
	background-color: rgba(<?php echo $dropdown_bg_color_initial[0]; ?>,<?php echo $dropdown_bg_color_initial[1]; ?>,<?php echo $dropdown_bg_color_initial[2]; ?>,<?php echo $dropdown_bg_transparency; ?>);
}
<?php } else {
	$dropdown_bg_color_initial = qode_hex2rgb("#000");
	if (!empty($qode_options_theme13['dropdown_background_transparency'])) {
		$dropdown_bg_transparency = $qode_options_theme13['dropdown_background_transparency'];
	}else{
		$dropdown_bg_transparency = 0.8;
	}
?>

<?php } ?>
<?php if (!empty($qode_options_theme13['menu_color']) || !empty($qode_options_theme13['menu_fontsize']) || !empty($qode_options_theme13['menu_fontstyle']) || !empty($qode_options_theme13['menu_fontweight']) || !empty($qode_options_theme13['menu_letter_spacing']) || $qode_options_theme13['menu_google_fonts'] != "-1") { ?>
nav.main_menu > ul > li > a{
	<?php if (!empty($qode_options_theme13['menu_color'])) { ?> color: <?php echo $qode_options_theme13['menu_color'];  ?>; <?php } ?>
	<?php if($qode_options_theme13['menu_google_fonts'] != "-1"){ ?>
	font-family: '<?php echo str_replace('+', ' ', $qode_options_theme13['menu_google_fonts']); ?>', sans-serif;
	<?php } ?>
	<?php if (!empty($qode_options_theme13['menu_fontsize'])) { ?> font-size: <?php echo $qode_options_theme13['menu_fontsize'];  ?>px; <?php } ?>
	<?php if (!empty($qode_options_theme13['menu_fontstyle'])) { ?> font-style: <?php echo $qode_options_theme13['menu_fontstyle'];  ?>; <?php } ?>
	<?php if (!empty($qode_options_theme13['menu_fontweight'])) { ?> font-weight: <?php echo $qode_options_theme13['menu_fontweight'];  ?>; <?php } ?>
}

<?php if (!empty($qode_options_theme13['menu_color'])) { ?>
.side_menu_button a,
.side_menu_button a:hover{
	color: <?php echo $qode_options_theme13['menu_color'];  ?>;
}
<?php } ?>

<?php } ?>
<?php if (!empty($qode_options_theme13['menu_hovercolor'])) { ?>
nav.main_menu ul li:hover a,
nav.main_menu ul li.active a{
	color: <?php echo $qode_options_theme13['menu_hovercolor'];  ?>;
}

<?php } ?>
<?php if(!empty($qode_options_theme13['dropdown_color']) || !empty($qode_options_theme13['dropdown_fontsize']) || !empty($qode_options_theme13['dropdown_lineheight']) || !empty($qode_options_theme13['dropdown_fontstyle']) || !empty($qode_options_theme13['dropdown_fontweight']) || $qode_options_theme13['dropdown_google_fonts'] != "-1"){ ?>
.drop_down .second .inner > ul > li > a,
.drop_down .second .inner > ul > li > h3,
.drop_down .wide .second .inner > ul > li > h3,
.drop_down .wide .second .inner > ul > li > a,
.drop_down .wide .second ul li ul li.menu-item-has-children > a,
.drop_down .wide .second .inner ul li.sub ul li.menu-item-has-children > a,
.drop_down .wide .second .inner > ul li.sub .flexslider ul li  h5 a,
.drop_down .wide .second .inner > ul li .flexslider ul li  h5 a,
.drop_down .wide .second .inner > ul li.sub .flexslider ul li  h5,
.drop_down .wide .second .inner > ul li .flexslider ul li  h5{
	<?php if (!empty($qode_options_theme13['dropdown_color'])) { ?> color: <?php echo $qode_options_theme13['dropdown_color']; ?>; <?php } ?>
	<?php if($qode_options_theme13['dropdown_google_fonts'] != "-1"){ ?>
	font-family: '<?php echo str_replace('+', ' ', $qode_options_theme13['dropdown_google_fonts']) ?>', sans-serif !important;
	<?php } ?>
	<?php if (!empty($qode_options_theme13['dropdown_fontsize'])) { ?> font-size: <?php echo $qode_options_theme13['dropdown_fontsize'];  ?>px; <?php } ?>
	<?php if (!empty($qode_options_theme13['dropdown_lineheight'])) { ?> line-height: <?php echo $qode_options_theme13['dropdown_lineheight'];  ?>px; <?php } ?>
	<?php if (!empty($qode_options_theme13['dropdown_fontstyle'])) { ?> font-style: <?php echo $qode_options_theme13['dropdown_fontstyle'];  ?>;  <?php } ?>
	<?php if (!empty($qode_options_theme13['dropdown_fontweight'])) { ?>font-weight: <?php echo $qode_options_theme13['dropdown_fontweight'];  ?>; <?php } ?>
}
<?php } ?>
<?php if (!empty($qode_options_theme13['dropdown_hovercolor'])) { ?>
.drop_down .second .inner > ul > li > a:hover,
.drop_down .wide .second ul li ul li.menu-item-has-children > a:hover,
.drop_down .wide .second .inner ul li.sub ul li.menu-item-has-children > a:hover{
	color: <?php echo $qode_options_theme13['dropdown_hovercolor'];  ?> !important;
}
<?php } ?>
<?php if(!empty($qode_options_theme13['dropdown_color_thirdlvl']) || !empty($qode_options_theme13['dropdown_fontsize_thirdlvl']) || !empty($qode_options_theme13['dropdown_lineheight_thirdlvl']) || !empty($qode_options_theme13['dropdown_fontstyle_thirdlvl']) || !empty($qode_options_theme13['dropdown_fontweight_thirdlvl']) || $qode_options_theme13['dropdown_google_fonts_thirdlvl'] != "-1"){ ?>
.drop_down .wide .second .inner ul li.sub ul li a,
.drop_down .wide .second ul li ul li a,
.drop_down .second .inner ul li.sub ul li a,
.drop_down .wide .second ul li ul li a,
.drop_down .wide .second .inner ul li.sub .flexslider ul li .menu_recent_post,
.drop_down .wide .second .inner ul li .flexslider ul li .menu_recent_post a,
.drop_down .wide .second .inner ul li .flexslider ul li .menu_recent_post,
.drop_down .wide .second .inner ul li .flexslider ul li .menu_recent_post a{
	<?php if (!empty($qode_options_theme13['dropdown_color_thirdlvl'])) { ?> color: <?php echo $qode_options_theme13['dropdown_color_thirdlvl'];  ?>;  <?php } ?>
	<?php if($qode_options_theme13['dropdown_google_fonts_thirdlvl'] != "-1"){ ?>
	font-family: '<?php echo str_replace('+', ' ', $qode_options_theme13['dropdown_google_fonts_thirdlvl']) ?>', sans-serif;
	<?php } ?>
	<?php if (!empty($qode_options_theme13['dropdown_fontsize_thirdlvl'])) { ?> font-size: <?php echo $qode_options_theme13['dropdown_fontsize_thirdlvl'];  ?>px;  <?php } ?>
	<?php if (!empty($qode_options_theme13['dropdown_lineheight_thirdlvl'])) { ?> line-height: <?php echo $qode_options_theme13['dropdown_lineheight_thirdlvl'];  ?>px;  <?php } ?>
	<?php if (!empty($qode_options_theme13['dropdown_fontstyle_thirdlvl'])) { ?> font-style: <?php echo $qode_options_theme13['dropdown_fontstyle_thirdlvl'];  ?>;   <?php } ?>
	<?php if (!empty($qode_options_theme13['dropdown_fontweight_thirdlvl'])) { ?> font-weight: <?php echo $qode_options_theme13['dropdown_fontweight_thirdlvl'];  ?>;  <?php } ?>
}
.drop_down .wide.icons .second i{
    <?php if (!empty($qode_options_theme13['dropdown_color_thirdlvl'])) { ?> color: <?php echo $qode_options_theme13['dropdown_color_thirdlvl'];  ?>;  <?php } ?>
}
<?php } ?>
<?php if (!empty($qode_options_theme13['dropdown_hovercolor_thirdlvl'])) { ?>
.drop_down .second .inner ul li.sub ul li a:hover,
.drop_down .second .inner ul li ul li a:hover,
.drop_down .wide.icons .second a:hover i
{
	color: <?php echo $qode_options_theme13['dropdown_hovercolor_thirdlvl'];  ?> !important;
}
<?php } ?>


<?php if(!empty($qode_options_theme13['fixed_color']) || !empty($qode_options_theme13['fixed_fontsize']) || !empty($qode_options_theme13['fixed_lineheight']) || !empty($qode_options_theme13['fixed_fontstyle']) || !empty($qode_options_theme13['fixed_fontweight']) || $qode_options_theme13['fixed_google_fonts'] != "-1"){ ?>
header.fixed nav.main_menu > ul > li > a, 
header.light.fixed nav.main_menu > ul > li > a, 
header.dark.fixed nav.main_menu > ul > li > a{
	<?php if (!empty($qode_options_theme13['fixed_color'])) { ?> color: <?php echo $qode_options_theme13['fixed_color']; ?>; <?php } ?>
	<?php if($qode_options_theme13['fixed_google_fonts'] != "-1"){ ?>
	font-family: '<?php echo str_replace('+', ' ', $qode_options_theme13['fixed_google_fonts']) ?>', sans-serif !important;
	<?php } ?>
	<?php if (!empty($qode_options_theme13['fixed_fontsize'])) { ?> font-size: <?php echo $qode_options_theme13['fixed_fontsize'];  ?>px; <?php } ?>
	<?php if (!empty($qode_options_theme13['fixed_lineheight'])) { ?> line-height: <?php echo $qode_options_theme13['fixed_lineheight'];  ?>px !important; <?php } ?>
	<?php if (!empty($qode_options_theme13['fixed_fontstyle'])) { ?> font-style: <?php echo $qode_options_theme13['fixed_fontstyle'];  ?>;  <?php } ?>
	<?php if (!empty($qode_options_theme13['fixed_fontweight'])) { ?>font-weight: <?php echo $qode_options_theme13['fixed_fontweight'];  ?>; <?php } ?>
}
<?php } ?>
<?php if (!empty($qode_options_theme13['fixed_color'])) { ?>
header.fixed .side_menu_button a, 
header.fixed .side_menu_button a:hover{
    <?php if (!empty($qode_options_theme13['fixed_color'])) { ?> color: <?php echo $qode_options_theme13['fixed_color']; ?>; <?php } ?>
}
<?php } ?>
<?php if (!empty($qode_options_theme13['fixed_hovercolor'])) { ?>
header.fixed nav.main_menu > ul > li > a:hover > span,
header.fixed nav.main_menu > ul > li:hover > a > span, 
header.fixed nav.main_menu > ul > li.active > a > span,
header.fixed nav.main_menu > ul > li > a:hover > i, 
header.fixed nav.main_menu > ul > li:hover > a > i,
header.fixed nav.main_menu > ul > li.active > a > i,
.light.fixed nav.main_menu > ul > li > a:hover, 
.light.fixed nav.main_menu > ul > li.active > a, 
.dark.fixed nav.main_menu > ul > li > a:hover, 
.dark.fixed nav.main_menu > ul > li.active > a{
	color: <?php echo $qode_options_theme13['fixed_hovercolor'];  ?> !important;
}
<?php } ?>

<?php if(!empty($qode_options_theme13['sticky_color']) || !empty($qode_options_theme13['sticky_fontsize']) || !empty($qode_options_theme13['sticky_lineheight']) || !empty($qode_options_theme13['sticky_fontstyle']) || !empty($qode_options_theme13['sticky_fontweight']) || $qode_options_theme13['sticky_google_fonts'] != "-1"){ ?>
header.sticky nav.main_menu > ul > li > a, 
header.light.sticky nav.main_menu > ul > li > a, 
header.dark.sticky nav.main_menu > ul > li > a{
	<?php if (!empty($qode_options_theme13['sticky_color'])) { ?> color: <?php echo $qode_options_theme13['sticky_color']; ?>; <?php } ?>
	<?php if($qode_options_theme13['sticky_google_fonts'] != "-1"){ ?>
	font-family: '<?php echo str_replace('+', ' ', $qode_options_theme13['sticky_google_fonts']) ?>', sans-serif !important;
	<?php } ?>
	<?php if (!empty($qode_options_theme13['sticky_fontsize'])) { ?> font-size: <?php echo $qode_options_theme13['sticky_fontsize'];  ?>px; <?php } ?>
	<?php if (!empty($qode_options_theme13['sticky_lineheight'])) { ?> line-height: <?php echo $qode_options_theme13['sticky_lineheight'];  ?>px !important; <?php } ?>
	<?php if (!empty($qode_options_theme13['sticky_fontstyle'])) { ?> font-style: <?php echo $qode_options_theme13['sticky_fontstyle'];  ?>;  <?php } ?>
	<?php if (!empty($qode_options_theme13['sticky_fontweight'])) { ?>font-weight: <?php echo $qode_options_theme13['sticky_fontweight'];  ?>; <?php } ?>
}
<?php } ?>

<?php if (!empty($qode_options_theme13['sticky_color'])) { ?>
header.sticky .side_menu_button a, 
header.sticky .side_menu_button a:hover{
    <?php if (!empty($qode_options_theme13['sticky_color'])) { ?> color: <?php echo $qode_options_theme13['sticky_color']; ?>; <?php } ?>
}
<?php } ?>

<?php if (!empty($qode_options_theme13['sticky_hovercolor'])) { ?>
header.sticky nav.main_menu > ul > li > a:hover span, 
header.sticky nav.main_menu > ul > li.active > a span,
header.sticky nav.main_menu > ul > li:hover > a > span,
header.sticky nav.main_menu > ul > li > a:hover > i, 
header.sticky nav.main_menu > ul > li:hover > a > i,
header.sticky nav.main_menu > ul > li.active > a > i,
.light.sticky nav.main_menu > ul > li > a:hover, 
.light.sticky nav.main_menu > ul > li.active > a, 
.dark.sticky nav.main_menu > ul > li > a:hover, 
.dark.sticky nav.main_menu > ul > li.active > a{
	color: <?php echo $qode_options_theme13['sticky_hovercolor'];  ?> !important;
}
<?php } ?>

<?php if (!empty($qode_options_theme13['mobile_color']) || !empty($qode_options_theme13['mobile_fontsize']) || !empty($qode_options_theme13['mobile_lineheight']) || !empty($qode_options_theme13['mobile_fontstyle']) || !empty($qode_options_theme13['mobile_fontweight']) || !empty($qode_options_theme13['mobile_letter_spacing']) || $qode_options_theme13['mobile_google_fonts'] != "-1") { ?>
nav.mobile_menu ul li a,
nav.mobile_menu ul li h3{
	<?php if (!empty($qode_options_theme13['mobile_color'])) { ?> color: <?php echo $qode_options_theme13['mobile_color'];  ?>; <?php } ?>
	<?php if($qode_options_theme13['mobile_google_fonts'] != "-1"){ ?>
	font-family: '<?php echo str_replace('+', ' ', $qode_options_theme13['mobile_google_fonts']); ?>', sans-serif;
	<?php } ?>
	<?php if (!empty($qode_options_theme13['mobile_fontsize'])) { ?> font-size: <?php echo $qode_options_theme13['mobile_fontsize'];  ?>px; <?php } ?>
	<?php if (!empty($qode_options_theme13['mobile_lineheight'])) { ?> line-height: <?php echo $qode_options_theme13['mobile_lineheight'];  ?>px; <?php } ?>
	<?php if (!empty($qode_options_theme13['mobile_fontstyle'])) { ?> font-style: <?php echo $qode_options_theme13['mobile_fontstyle'];  ?>; <?php } ?>
	<?php if (!empty($qode_options_theme13['mobile_fontweight'])) { ?> font-weight: <?php echo $qode_options_theme13['mobile_fontweight'];  ?>; <?php } ?>
	<?php if(!empty($qode_options_theme13['mobile_letter_spacing'])){ ?>
	letter-spacing: <?php echo $qode_options_theme13['mobile_letter_spacing'];  ?>px;
	<?php } ?>
}

<?php if (!empty($qode_options_theme13['mobile_color'])) { ?>
@media only screen and (max-width: 1000px){
	header .side_menu_button a:hover,
	header .side_menu_button a,
	header .mobile_menu_button span,
	header.dark .side_menu_button a,
	header.dark .side_menu_button a:hover,
	header.dark .mobile_menu_button span{
		color: <?php echo $qode_options_theme13['mobile_color'];  ?>;
	}
}
<?php } ?>
<?php } ?>
<?php if (!empty($qode_options_theme13['mobile_hovercolor'])) { ?>
nav.mobile_menu ul li a:hover,
nav.mobile_menu ul li.active > a,
nav.mobile_menu ul li.current-menu-item > a{
	color: <?php echo $qode_options_theme13['mobile_hovercolor'];  ?>;
}
<?php } ?>
<?php if (!empty($qode_options_theme13['mobile_separator_color'])) { ?>
	nav.mobile_menu ul li a,
	nav.mobile_menu ul li h3,
	nav.mobile_menu ul li ul li a,
	nav.mobile_menu ul li.open_sub > a:first-child{
		border-color: <?php echo $qode_options_theme13['mobile_separator_color'];  ?>;
	}
<?php } ?>

<?php if (!empty($qode_options_theme13['mobile_background_color'])) { ?>
	@media only screen and (max-width: 1000px){
		.header_bottom,
		nav.mobile_menu{
			background-color: <?php echo $qode_options_theme13['mobile_background_color'];  ?> !important;
		}
	}
<?php } ?>

<?php if (!empty($qode_options_theme13['smooth_background_color'])) { ?>
#ascrail2000{
	background-color: <?php echo $qode_options_theme13['smooth_background_color'];  ?>; 
}
<?php } ?>
<?php if (!empty($qode_options_theme13['smooth_bar_color'])) { 
?>
#ascrail2000 div{
	background-color: <?php echo $qode_options_theme13['smooth_bar_color'];  ?> !important;
}
<?php } ?>
<?php if (!empty($qode_options_theme13['h1_color']) || !empty($qode_options_theme13['h1_fontsize']) || !empty($qode_options_theme13['h1_lineheight']) || !empty($qode_options_theme13['h1_fontstyle']) || !empty($qode_options_theme13['h1_fontweight']) || !empty($qode_options_theme13['h1_letterspacing']) || $qode_options_theme13['h1_google_fonts'] != "-1") { ?>
h1{
	<?php if (!empty($qode_options_theme13['h1_color'])) { ?>	color: <?php echo $qode_options_theme13['h1_color'];  ?>; <?php } ?>
	<?php if($qode_options_theme13['h1_google_fonts'] != "-1"){ ?>
	font-family: '<?php echo str_replace('+', ' ', $qode_options_theme13['h1_google_fonts']); ?>', sans-serif;
	<?php } ?>
	<?php if (!empty($qode_options_theme13['h1_fontsize'])) { ?>font-size: <?php echo $qode_options_theme13['h1_fontsize'];  ?>px; <?php } ?>
	<?php if (!empty($qode_options_theme13['h1_lineheight'])) { ?>line-height: <?php echo $qode_options_theme13['h1_lineheight'];  ?>px; <?php } ?>
	<?php if (!empty($qode_options_theme13['h1_fontstyle'])) { ?>font-style: <?php echo $qode_options_theme13['h1_fontstyle'];  ?>; <?php } ?>
	<?php if (!empty($qode_options_theme13['h1_fontweight'])) { ?>font-weight: <?php echo $qode_options_theme13['h1_fontweight'];  ?>; <?php } ?>
    <?php if (!empty($qode_options_theme13['h1_letterspacing'])) { ?>letter-spacing: <?php echo $qode_options_theme13['h1_letterspacing'];  ?>px; <?php } ?>
}
<?php } ?>
<?php if (!empty($qode_options_theme13['page_title_color']) || !empty($qode_options_theme13['page_title_fontsize']) || !empty($qode_options_theme13['page_title_lineheight']) || !empty($qode_options_theme13['page_title_fontstyle']) || !empty($qode_options_theme13['page_title_fontweight']) || $qode_options_theme13['page_title_google_fonts'] != "-1") { ?>
.title h1{
	<?php if (!empty($qode_options_theme13['page_title_color'])) { ?>color: <?php echo $qode_options_theme13['page_title_color'];  ?>; <?php } ?>
	<?php if($qode_options_theme13['page_title_google_fonts'] != "-1"){ ?>
	font-family: '<?php echo str_replace('+', ' ', $qode_options_theme13['page_title_google_fonts']); ?>', sans-serif;
	<?php } ?>
	<?php if (!empty($qode_options_theme13['page_title_fontsize'])) { ?>font-size: <?php echo $qode_options_theme13['page_title_fontsize'];  ?>px; <?php } ?>
	<?php if (!empty($qode_options_theme13['page_title_lineheight'])) { ?>line-height: <?php echo $qode_options_theme13['page_title_lineheight'];  ?>px; <?php } ?>
	<?php if (!empty($qode_options_theme13['page_title_fontstyle'])) { ?>font-style: <?php echo $qode_options_theme13['page_title_fontstyle'];  ?>; <?php } ?>
	<?php if (!empty($qode_options_theme13['page_title_fontweight'])) { ?>font-weight: <?php echo $qode_options_theme13['page_title_fontweight'];  ?>; <?php } ?>
}
<?php if($qode_options_theme13['page_title_position'] != "0"){ ?>
.title .separator{
	text-align: <?php if($qode_options_theme13['page_title_position'] == "1"){echo "left";} if($qode_options_theme13['page_title_position'] == "2"){echo "center";} if($qode_options_theme13['page_title_position'] == "3"){echo "right";}  ?>;
	<?php if($qode_options_theme13['page_title_position'] == "1" || $qode_options_theme13['page_title_position'] == "3"){?> 
		margin-left:0;
		margin-right:0;
		display: inline-block;
	<?php } ?>
}
<?php } ?>
<?php if($qode_options_theme13['page_title_position'] != "0"){ ?>
.title h6,
.title
{
	text-align: <?php if($qode_options_theme13['page_title_position'] == "1"){echo "left";} if($qode_options_theme13['page_title_position'] == "2"){echo "center";} if($qode_options_theme13['page_title_position'] == "3"){echo "right";}  ?>;
}
<?php } ?>
<?php } ?>
<?php if (!empty($qode_options_theme13['h2_color']) || !empty($qode_options_theme13['h2_fontsize']) || !empty($qode_options_theme13['h2_lineheight']) || !empty($qode_options_theme13['h2_fontstyle']) || !empty($qode_options_theme13['h2_fontweight']) || !empty($qode_options_theme13['h2_letterspacing']) || $qode_options_theme13['h2_google_fonts'] != "-1") { ?>
h2,
h2 a{
	<?php if (!empty($qode_options_theme13['h2_color'])) { ?>color: <?php echo $qode_options_theme13['h2_color'];  ?>; <?php } ?>
	<?php if($qode_options_theme13['h2_google_fonts'] != "-1"){ ?>
		font-family: '<?php echo str_replace('+', ' ', $qode_options_theme13['h2_google_fonts']); ?>', sans-serif;
	<?php } ?>
	<?php if (!empty($qode_options_theme13['h2_fontsize'])) { ?>font-size: <?php echo $qode_options_theme13['h2_fontsize'];  ?>px; <?php } ?>
	<?php if (!empty($qode_options_theme13['h2_lineheight'])) { ?>line-height: <?php echo $qode_options_theme13['h2_lineheight'];  ?>px; <?php } ?>
	<?php if (!empty($qode_options_theme13['h2_fontstyle'])) { ?>font-style: <?php echo $qode_options_theme13['h2_fontstyle'];  ?>; <?php } ?>
	<?php if (!empty($qode_options_theme13['h2_fontweight'])) { ?>font-weight: <?php echo $qode_options_theme13['h2_fontweight'];  ?>; <?php } ?>
    <?php if (!empty($qode_options_theme13['h2_letterspacing'])) { ?>letter-spacing: <?php echo $qode_options_theme13['h2_letterspacing'];  ?>px; <?php } ?>
}
<?php } ?>
<?php if (!empty($qode_options_theme13['h3_color']) || !empty($qode_options_theme13['h3_fontsize']) || !empty($qode_options_theme13['h3_lineheight']) || !empty($qode_options_theme13['h3_fontstyle']) || !empty($qode_options_theme13['h3_fontweight']) || !empty($qode_options_theme13['h3_letterspacing']) || $qode_options_theme13['h3_google_fonts'] != "-1") { ?>
h3,h3 a{
	<?php if (!empty($qode_options_theme13['h3_color'])) { ?>color: <?php echo $qode_options_theme13['h3_color'];  ?>; <?php } ?>
	<?php if($qode_options_theme13['h3_google_fonts'] != "-1"){ ?>
	font-family: '<?php echo str_replace('+', ' ', $qode_options_theme13['h3_google_fonts']); ?>', sans-serif;
	<?php } ?>
	<?php if (!empty($qode_options_theme13['h3_fontsize'])) { ?>font-size: <?php echo $qode_options_theme13['h3_fontsize'];  ?>px; <?php } ?>
	<?php if (!empty($qode_options_theme13['h3_lineheight'])) { ?>line-height: <?php echo $qode_options_theme13['h3_lineheight'];  ?>px; <?php } ?>
	<?php if (!empty($qode_options_theme13['h3_fontstyle'])) { ?>font-style: <?php echo $qode_options_theme13['h3_fontstyle'];?>; <?php } ?>
	<?php if (!empty($qode_options_theme13['h3_fontweight'])) { ?>font-weight: <?php echo $qode_options_theme13['h3_fontweight'];  ?>; <?php } ?>
    <?php if (!empty($qode_options_theme13['h3_letterspacing'])) { ?>letter-spacing: <?php echo $qode_options_theme13['h3_letterspacing'];  ?>px; <?php } ?>
}
<?php } ?>
<?php if (!empty($qode_options_theme13['h4_color']) || !empty($qode_options_theme13['h4_fontsize']) || !empty($qode_options_theme13['h4_lineheight']) || !empty($qode_options_theme13['h4_fontstyle']) || !empty($qode_options_theme13['h4_fontweight']) || !empty($qode_options_theme13['h4_letterspacing']) || $qode_options_theme13['h4_google_fonts'] != "-1") { ?>
h4,
h4 a{
	<?php if (!empty($qode_options_theme13['h4_color'])) { ?>color: <?php echo $qode_options_theme13['h4_color'];  ?>; <?php } ?>
	<?php if($qode_options_theme13['h4_google_fonts'] != "-1"){ ?>
		font-family: '<?php echo str_replace('+', ' ', $qode_options_theme13['h4_google_fonts']); ?>', sans-serif;
	<?php } ?>
	<?php if (!empty($qode_options_theme13['h4_fontsize'])) { ?>font-size: <?php echo $qode_options_theme13['h4_fontsize'];  ?>px; <?php } ?>
	<?php if (!empty($qode_options_theme13['h4_lineheight'])) { ?>line-height: <?php echo $qode_options_theme13['h4_lineheight'];  ?>px; <?php } ?>
	<?php if (!empty($qode_options_theme13['h4_fontstyle'])) { ?>font-style: <?php echo $qode_options_theme13['h4_fontstyle'];  ?>; <?php } ?>
	<?php if (!empty($qode_options_theme13['h4_fontweight'])) { ?>font-weight: <?php echo $qode_options_theme13['h4_fontweight'];  ?>; <?php } ?>
    <?php if (!empty($qode_options_theme13['h4_letterspacing'])) { ?>letter-spacing: <?php echo $qode_options_theme13['h4_letterspacing'];  ?>px; <?php } ?>
}
<?php } ?>
<?php if (!empty($qode_options_theme13['h5_color']) || !empty($qode_options_theme13['h5_fontsize']) || !empty($qode_options_theme13['h5_lineheight']) || !empty($qode_options_theme13['h5_fontstyle']) || !empty($qode_options_theme13['h5_fontweight']) || !empty($qode_options_theme13['h5_letterspacing']) || $qode_options_theme13['h5_google_fonts'] != "-1") { ?>
h5,
h5 a{
	<?php if (!empty($qode_options_theme13['h5_color'])) { ?>color: <?php echo $qode_options_theme13['h5_color'];  ?>; <?php } ?>
	<?php if($qode_options_theme13['h5_google_fonts'] != "-1"){ ?>
	font-family: '<?php echo str_replace('+', ' ', $qode_options_theme13['h5_google_fonts']); ?>', sans-serif;
	<?php } ?>
	<?php if (!empty($qode_options_theme13['h5_fontsize'])) { ?>font-size: <?php echo $qode_options_theme13['h5_fontsize'];  ?>px; <?php } ?>
	<?php if (!empty($qode_options_theme13['h5_lineheight'])) { ?>line-height: <?php echo $qode_options_theme13['h5_lineheight'];  ?>px; <?php } ?>
	<?php if (!empty($qode_options_theme13['h5_fontstyle'])) { ?>font-style: <?php echo $qode_options_theme13['h5_fontstyle'];  ?>; <?php } ?>
	<?php if (!empty($qode_options_theme13['h5_fontweight'])) { ?>font-weight: <?php echo $qode_options_theme13['h5_fontweight'];  ?>; <?php } ?>
    <?php if (!empty($qode_options_theme13['h5_letterspacing'])) { ?>letter-spacing: <?php echo $qode_options_theme13['h5_letterspacing'];  ?>px; <?php } ?>
}
<?php } ?>
<?php if (!empty($qode_options_theme13['h6_color']) || !empty($qode_options_theme13['h6_fontsize']) || !empty($qode_options_theme13['h6_lineheight']) || !empty($qode_options_theme13['h6_fontstyle']) || !empty($qode_options_theme13['h6_fontweight']) || !empty($qode_options_theme13['h6_letterspacing']) || $qode_options_theme13['h6_google_fonts'] != "-1") { ?>
h6{
	<?php if (!empty($qode_options_theme13['h6_color'])) { ?>color: <?php echo $qode_options_theme13['h6_color'];  ?>; <?php } ?>
	<?php if($qode_options_theme13['h6_google_fonts'] != "-1"){ ?>
	font-family: '<?php echo str_replace('+', ' ', $qode_options_theme13['h6_google_fonts']); ?>', sans-serif;
	<?php } ?>
	<?php if (!empty($qode_options_theme13['h6_fontsize'])) { ?>font-size: <?php echo $qode_options_theme13['h6_fontsize'];  ?>px; <?php } ?>
	<?php if (!empty($qode_options_theme13['h6_lineheight'])) { ?>line-height: <?php echo $qode_options_theme13['h6_lineheight'];  ?>px; <?php } ?>
	<?php if (!empty($qode_options_theme13['h6_fontstyle'])) { ?>font-style: <?php echo $qode_options_theme13['h6_fontstyle'];  ?>;  <?php } ?>
	<?php if (!empty($qode_options_theme13['h6_fontweight'])) { ?>font-weight: <?php echo $qode_options_theme13['h6_fontweight'];  ?>; <?php } ?>
	<?php if (!empty($qode_options_theme13['h6_letterspacing'])) { ?>letter-spacing: <?php echo $qode_options_theme13['h6_letterspacing'];  ?>px; <?php } ?>
}

<?php } ?>

<?php if (!empty($qode_options_theme13['text_color']) || !empty($qode_options_theme13['text_fontsize']) || !empty($qode_options_theme13['text_lineheight']) || !empty($qode_options_theme13['text_fontstyle']) || !empty($qode_options_theme13['text_fontweight']) || $qode_options_theme13['text_google_fonts'] != "-1" || !empty($qode_options_theme13['text_margin'])) { ?>
    p{
    	<?php if (!empty($qode_options_theme13['text_color'])) { ?>color: <?php echo $qode_options_theme13['text_color'];  ?>;<?php } ?>
    	<?php if($qode_options_theme13['text_google_fonts'] != "-1"){ ?>
    		font-family: '<?php echo str_replace('+', ' ', $qode_options_theme13['text_google_fonts']); ?>', sans-serif;
    	<?php } ?>
    	<?php if (!empty($qode_options_theme13['text_fontsize'])) { ?>font-size: <?php echo $qode_options_theme13['text_fontsize'];  ?>px;<?php } ?>
    	<?php if (!empty($qode_options_theme13['text_lineheight'])) { ?>line-height: <?php echo $qode_options_theme13['text_lineheight'];  ?>px;<?php } ?>
    	<?php if (!empty($qode_options_theme13['text_fontstyle'])) { ?>font-style: <?php echo $qode_options_theme13['text_fontstyle'];  ?>;<?php } ?>
    	<?php if (!empty($qode_options_theme13['text_fontweight'])) { ?>font-weight: <?php echo $qode_options_theme13['text_fontweight'];  ?>;<?php } ?>
    	<?php if (!empty($qode_options_theme13['text_margin'])) { ?>margin-top: <?php echo $qode_options_theme13['text_margin'];  ?>px;<?php } ?>
    	<?php if (!empty($qode_options_theme13['text_margin'])) { ?>margin-bottom: <?php echo $qode_options_theme13['text_margin'];  ?>px;<?php } ?>
    }
    .breadcrumb a,
    .filter_holder ul li span,
    blockquote h5,
    .q_social_icon_holder i.simple_social,
    .header-widget.widget_nav_menu ul.menu li a,
    .side_menu a,
    .side_menu li,
    .side_menu span,
    .side_menu p,
    .side_menu .widget.widget_rss li a.rsswidget,
    .side_menu #wp-calendar caption,
    .side_menu #wp-calendar th, 
    .side_menu #wp-calendar td,
    aside .widget #lang_sel_list li a,
    aside .widget #lang_sel li a,
    aside .widget #lang_sel_click li a,
    section.side_menu #lang_sel_list li a,
    section.side_menu #lang_sel li a,
    section.side_menu #lang_sel_click li a,
    footer #lang_sel_list li a,
    footer #lang_sel li a,
    footer #lang_sel_click li a,
    footer #lang_sel_list.lang_sel_list_horizontal a,
    footer #lang_sel_list.lang_sel_list_vertical a,
    .side_menu #lang_sel_list.lang_sel_list_horizontal a,
    .side_menu #lang_sel_list.lang_sel_list_vertical a,
    #lang_sel_footer a{
    	<?php if (!empty($qode_options_theme13['text_color'])) { ?>color: <?php echo $qode_options_theme13['text_color'];  ?>;<?php } ?>
    }
    .header_top #lang_sel > ul > li > a, 
    .header_top #lang_sel_click > ul > li> a,
    footer #lang_sel ul li a,
    footer #lang_sel ul ul a,
    footer #lang_sel_click ul li a,
    footer #lang_sel_click ul ul a,
    footer #lang_sel_click ul ul a span,
    section.side_menu #lang_sel ul li a,
    section.side_menu #lang_sel ul ul a,
    section.side_menu #lang_sel ul ul a:visited,
    section.side_menu #lang_sel_click > ul > li > a,
    section.side_menu #lang_sel_click ul ul a,
    section.side_menu #lang_sel_click ul ul a:visited{
    	<?php if (!empty($qode_options_theme13['text_color'])) { ?>color: <?php echo $qode_options_theme13['text_color'];  ?> !important;<?php } ?>
    }
    <?php if(function_exists("is_woocommerce") && !empty($qode_options_theme13['text_color'])){ ?>
        .woocommerce del,
        .woocommerce-page del,
        .woocommerce input[type='text']:not(.qode_search_field),
        .woocommerce input[type='password'],
        .woocommerce input[type='email'],
        .woocommerce-page input[type='text']:not(.qode_search_field),
        .woocommerce-page input[type='password'],
        .woocommerce-page input[type='email'],
        .woocommerce textarea,
        .woocommerce-page textarea,
        .woocommerce .select2-container .select2-choice,
        .woocommerce-page .select2-container .select2-choice,
        .woocommerce .select2-dropdown-open.select2-drop-above .select2-choice,
        .woocommerce .select2-dropdown-open.select2-drop-above .select2-choices,
        .woocommerce-page .select2-dropdown-open.select2-drop-above .select2-choice,
        .woocommerce-page .select2-dropdown-open.select2-drop-above .select2-choices,
        .woocommerce .chosen-container.chosen-container-single .chosen-single,
        .woocommerce-page .chosen-container.chosen-container-single .chosen-single,
        .woocommerce-checkout .form-row .chosen-container-single .chosen-single,
        .woocommerce ul.products li.product h4,
        .woocommerce div.product p[itemprop='price'] del,
        .woocommerce div.product p[itemprop='price'] del span.amount,
        .woocommerce div.product div.product_meta > span span,
        .woocommerce div.product div.product_meta > span a,
        .woocommerce aside ul.product_list_widget li > a,
        .woocommerce aside ul.product-categories li > a,
        .woocommerce aside ul.product_list_widget li del span.amount,
        .shopping_cart_dropdown ul li a,
        .select2-drop{
            color: <?php echo $qode_options_theme13['text_color']; ?>;
        }
    <?php } ?>
<?php } ?>
<?php if (!empty($qode_options_theme13['link_color']) || !empty($qode_options_theme13['link_fontstyle']) || !empty($qode_options_theme13['link_fontweight']) || !empty($qode_options_theme13['link_fontdecoration'])) { ?>
a, p a{
	<?php if (!empty($qode_options_theme13['link_color'])) { ?>color: <?php echo $qode_options_theme13['link_color'];  ?>;<?php } ?>
	<?php if (!empty($qode_options_theme13['link_fontstyle'])) { ?>font-style: <?php echo $qode_options_theme13['link_fontstyle'];  ?>;<?php } ?>
	<?php if (!empty($qode_options_theme13['link_fontweight'])) { ?>font-weight: <?php echo $qode_options_theme13['link_fontweight'];  ?>;<?php } ?>
	<?php if (!empty($qode_options_theme13['link_fontdecoration'])) { ?>text-decoration: <?php echo $qode_options_theme13['link_fontdecoration'];  ?>;<?php } ?>
}

h1 a:hover,h2 a:hover,h3 a:hover,h4 a:hover,h5 a:hover,h6 a:hover,
.q_icon_with_title .icon_with_title_link,
.blog_holder article .post_description a:hover,
.blog_holder.masonry article .post_info a:hover,
.breadcrumb .current,
.breadcrumb a:hover,
.portfolio_social_holder a:hover,
.latest_post_inner .post_infos a:hover{
    <?php if (!empty($qode_options_theme13['link_color'])) { ?>color: <?php echo $qode_options_theme13['link_color'];  ?>;<?php } ?>
}
<?php } ?>
<?php if (!empty($qode_options_theme13['link_hovercolor']) || !empty($qode_options_theme13['link_fontdecoration'])) { ?>
a:hover,p a:hover,
h1 a,h2 a,h3 a,h4 a,h5 a,h6 a,
.q_tabs .tabs-nav li a:hover,
.q_icon_with_title .icon_with_title_link:hover,
.blog_holder article .post_description a,
.blog_holder.masonry article .post_info a,
.portfolio_social_holder a,
.latest_post_inner .post_infos a{
	<?php if (!empty($qode_options_theme13['link_hovercolor'])) { ?>color: <?php echo $qode_options_theme13['link_hovercolor'];  ?>;<?php } ?>
	<?php if (!empty($qode_options_theme13['link_fontdecoration'])) { ?>text-decoration: <?php echo $qode_options_theme13['link_fontdecoration'];  ?>;<?php } ?>
}
<?php } ?>
<?php if (!empty($qode_options_theme13['info_data_color']) || !empty($qode_options_theme13['info_data_fontsize']) || !empty($qode_options_theme13['info_data_fontweight']) || !empty($qode_options_theme13['info_data_position']) || $qode_options_theme13['info_data_google_fonts'] != "-1") { ?>
.blog_holder article .post_description,
.latest_post_inner .post_infos{
	<?php if (!empty($qode_options_theme13['info_data_color'])) { ?>color: <?php echo $qode_options_theme13['info_data_color'];  ?>; <?php } ?>
	<?php if($qode_options_theme13['info_data_google_fonts'] != "-1"){ ?>
	font-family: '<?php echo str_replace('+', ' ', $qode_options_theme13['info_data_google_fonts']); ?>', sans-serif;
	<?php } ?>
	<?php if (!empty($qode_options_theme13['info_data_fontsize'])) { ?>font-size: <?php echo $qode_options_theme13['info_data_fontsize'];  ?>px; <?php } ?>
	<?php if (!empty($qode_options_theme13['info_data_fontstyle'])) { ?>font-style: <?php echo $qode_options_theme13['info_data_fontstyle'];  ?>; <?php } ?>
	<?php if (!empty($qode_options_theme13['info_data_fontweight'])) { ?>font-weight: <?php echo $qode_options_theme13['info_data_fontweight'];  ?>; <?php } ?>
}
<?php } ?>
<?php if (!empty($qode_options_theme13['info_data_icon_color'])) { ?>
.blog_holder article .post_description .post_description_left .date i,
.blog_holder article .post_comments i,
.latest_post_inner .post_comments i,
.blog_like a i{
	<?php if (!empty($qode_options_theme13['info_data_icon_color'])) { ?>color: <?php echo $qode_options_theme13['info_data_icon_color'];  ?>; <?php } ?>
}
<?php } ?>
<?php if (!empty($qode_options_theme13['blockquote_font_color'])) { ?>
	blockquote h5{
		color: <?php echo $qode_options_theme13['blockquote_font_color'];  ?>;  
	}
<?php } ?>
<?php if (!empty($qode_options_theme13['blockquote_background_color']) && !empty($qode_options_theme13['blockquote_border_color'])) { ?>
	blockquote{
		border-color: <?php echo $qode_options_theme13['blockquote_border_color'];  ?>; 
		background-color: <?php echo $qode_options_theme13['blockquote_background_color'];  ?>;  
	}
<?php } ?>
<?php if(!empty($qode_options_theme13['blockquote_quote_icon_color'])) { ?>
    blockquote i.pull-left {
        color: <?php echo $qode_options_theme13['blockquote_quote_icon_color']; ?>;
    }
<?php } ?>
<?php if(!empty($qode_options_theme13['pricing_table_top_color']) || !empty($qode_options_theme13['pricing_table_bottom_color']) || !empty($qode_options_theme13['pricing_table_border_color'])) { ?>  
    <?php if(!empty($qode_options_theme13['pricing_table_top_color']) && !empty($qode_options_theme13['pricing_table_bottom_color'])) { ?>    
        .price_table_inner ul li.table_title{
            background: <?php echo $qode_options_theme13['pricing_table_top_color']; ?>;
            background: <?php echo $qode_options_theme13['pricing_table_top_color'];?> -ms-linear-gradient(bottom, <?php echo $qode_options_theme13['pricing_table_bottom_color'];?> 0%, <?php echo $qode_options_theme13['pricing_table_top_color'];?> 100%);
            background: <?php echo $qode_options_theme13['pricing_table_top_color'];?> -moz-linear-gradient(bottom, <?php echo $qode_options_theme13['pricing_table_bottom_color'];?> 0%, <?php echo $qode_options_theme13['pricing_table_top_color'];?> 100%);
            background: <?php echo $qode_options_theme13['pricing_table_top_color'];?> -o-linear-gradient(bottom, <?php echo $qode_options_theme13['pricing_table_bottom_color'];?> 0%, <?php echo $qode_options_theme13['pricing_table_top_color'];?> 100%);
            background: <?php echo $qode_options_theme13['pricing_table_top_color'];?> -webkit-gradient(linear, left bottom, left top, color-stop(0,<?php echo $qode_options_theme13['pricing_table_bottom_color'];?>), color-stop(1, <?php echo $qode_options_theme13['pricing_table_top_color'];?>));
            background: <?php echo $qode_options_theme13['pricing_table_top_color'];?> -webkit-linear-gradient(bottom, <?php echo $qode_options_theme13['pricing_table_bottom_color'];?> 0%, <?php echo $qode_options_theme13['pricing_table_top_color'];?> 100%);
            background: <?php echo $qode_options_theme13['pricing_table_top_color'];?> linear-gradient(to top, <?php echo $qode_options_theme13['pricing_table_bottom_color'];?> 0%, <?php echo $qode_options_theme13['pricing_table_top_color'];?> 100%);
        }

        .price_table_inner ul li.prices{
            background: <?php echo $qode_options_theme13['pricing_table_bottom_color']; ?>;
            background: <?php echo $qode_options_theme13['pricing_table_bottom_color'];?> -ms-linear-gradient(bottom, <?php echo $qode_options_theme13['pricing_table_top_color'];?> 0%, <?php echo $qode_options_theme13['pricing_table_bottom_color'];?> 100%);
            background: <?php echo $qode_options_theme13['pricing_table_bottom_color'];?> -moz-linear-gradient(bottom, <?php echo $qode_options_theme13['pricing_table_top_color'];?> 0%, <?php echo $qode_options_theme13['pricing_table_bottom_color'];?> 100%);
            background: <?php echo $qode_options_theme13['pricing_table_bottom_color'];?> -o-linear-gradient(bottom, <?php echo $qode_options_theme13['pricing_table_top_color'];?> 0%, <?php echo $qode_options_theme13['pricing_table_bottom_color'];?> 100%);
            background: <?php echo $qode_options_theme13['pricing_table_bottom_color'];?> -webkit-gradient(linear, left bottom, left top, color-stop(0,<?php echo $qode_options_theme13['pricing_table_top_color'];?>), color-stop(1, <?php echo $qode_options_theme13['pricing_table_bottom_color'];?>));
            background: <?php echo $qode_options_theme13['pricing_table_bottom_color'];?> -webkit-linear-gradient(bottom, <?php echo $qode_options_theme13['pricing_table_top_color'];?> 0%, <?php echo $qode_options_theme13['pricing_table_bottom_color'];?> 100%);
            background: <?php echo $qode_options_theme13['pricing_table_bottom_color'];?> linear-gradient(to top, <?php echo $qode_options_theme13['pricing_table_top_color'];?> 0%, <?php echo $qode_options_theme13['pricing_table_bottom_color'];?> 100%);
        }
    <?php } ?>    

    <?php if(!empty($qode_options_theme13['pricing_table_border_color'])) { ?>
        .price_table_inner ul li.table_title{
            border-top-color: <?php echo $qode_options_theme13['pricing_table_border_color'];?>;
            border-left-color: <?php echo $qode_options_theme13['pricing_table_border_color'];?>;
            border-right-color: <?php echo $qode_options_theme13['pricing_table_border_color'];?>;
        }
    <?php } ?>
<?php } ?>
<?php if (!empty($qode_options_theme13['separator_thickness']) || !empty($qode_options_theme13['separator_topmargin']) || !empty($qode_options_theme13['separator_bottommargin']) || !empty($qode_options_theme13['separator_color'])) { ?>
.separator{
<?php if (!empty($qode_options_theme13['separator_thickness'])) { ?>	height: <?php echo $qode_options_theme13['separator_thickness'];  ?>px; <?php } ?>
<?php if (!empty($qode_options_theme13['separator_topmargin'])) { ?>	margin-top: <?php echo $qode_options_theme13['separator_topmargin'];  ?>px; <?php } ?>
<?php if (!empty($qode_options_theme13['separator_bottommargin'])) { ?>	margin-bottom: <?php echo $qode_options_theme13['separator_bottommargin'];  ?>px; <?php } ?>
<?php if (!empty($qode_options_theme13['separator_color'])) { ?>	background-color: <?php echo $qode_options_theme13['separator_color'];  ?>; <?php } ?>
}
<?php } ?>
<?php if (!empty($qode_options_theme13['separator_color'])) { ?>
.separator.small{
<?php if (!empty($qode_options_theme13['separator_color'])) { ?>	background-color: <?php echo $qode_options_theme13['separator_color'];  ?>; <?php } ?>
}
<?php } ?>
<?php if (!empty($qode_options_theme13['separator_color'])) { ?>
	.blog_holder article,
	.author_description,
	aside .widget,
	section.section,
	.animated_icons_with_text .animated_icon_with_text_inner:after,
	.animated_icons_with_text .animated_icon_with_text_inner:before{
		border-color:<?php echo $qode_options_satellite['separator_color'];  ?>;
	}
<?php } ?>
<?php if (!empty($qode_options_theme13['message_backgroundcolor']) || (isset($qode_options_theme13['message_bordercolor']) && !empty($qode_options_theme13['message_bordercolor']))) { ?>
.q_message{
	<?php if (!empty($qode_options_theme13['message_backgroundcolor'])) { ?>background-color: <?php echo $qode_options_theme13['message_backgroundcolor'];  ?><?php } ?>;
	<?php if (isset($qode_options_theme13['message_bordercolor']) && !empty($qode_options_theme13['message_bordercolor'])) { ?>border-color: <?php echo $qode_options_theme13['message_bordercolor'];  ?> <?php } ?>; 
}
<?php } ?>
<?php if (!empty($qode_options_theme13['message_title_color']) || !empty($qode_options_theme13['message_title_fontsize']) || !empty($qode_options_theme13['message_title_lineheight']) || !empty($qode_options_theme13['message_title_fontstyle']) || !empty($qode_options_theme13['message_title_fontweight']) || $qode_options_theme13['message_title_google_fonts'] != "-1") { ?>
.q_message .message_text{
<?php if (!empty($qode_options_theme13['message_title_color'])) { ?>	color: <?php echo $qode_options_theme13['message_title_color'];  ?>; <?php } ?>
	<?php if($qode_options_theme13['message_title_google_fonts'] != "-1"){ ?>
	font-family: '<?php echo str_replace('+', ' ', $qode_options_theme13['message_title_google_fonts']); ?>', sans-serif;
	<?php } ?>
<?php if (!empty($qode_options_theme13['message_title_fontsize'])) { ?>	font-size: <?php echo $qode_options_theme13['message_title_fontsize'];  ?>px; <?php } ?>
<?php if (!empty($qode_options_theme13['message_title_lineheight'])) { ?>	line-height: <?php echo $qode_options_theme13['message_title_lineheight'];  ?>px; <?php } ?>
<?php if (!empty($qode_options_theme13['message_title_fontstyle'])) { ?>	font-style: <?php echo $qode_options_theme13['message_title_fontstyle'];  ?>; <?php } ?>
<?php if (!empty($qode_options_theme13['message_title_fontweight'])) { ?>	font-weight: <?php echo $qode_options_theme13['message_title_fontweight'];  ?>; <?php } ?>
}
<?php } ?>
<?php if (!empty($qode_options_theme13['message_icon_fontsize']) && !empty($qode_options_theme13['message_icon_color'])) { ?>
.q_message.with_icon > i {
   <?php if (!empty($qode_options_theme13['message_icon_color'])) { ?> color:  <?php echo $qode_options_theme13['message_icon_color'];  ?>; <?php } ?>
   <?php if (!empty($qode_options_theme13['message_icon_fontsize'])) { ?> font-size: <?php echo $qode_options_theme13['message_icon_fontsize'];  ?>px; <?php } ?>
}
<?php } ?>
<?php if (!empty($qode_options_theme13['social_icon_top_gradient_background_color']) || !empty($qode_options_theme13['social_icon_bottom_gradient_background_color']) || !empty($qode_options_theme13['social_icon_border_color'])) { ?>
	.q_social_icon_holder .fa-stack {
        <?php if(!empty($qode_options_theme13['social_icon_top_gradient_background_color']) && !empty($qode_options_theme13['social_icon_bottom_gradient_background_color'])) { ?>
		background: <?php echo $qode_options_theme13['social_icon_bottom_gradient_background_color'];  ?>;
        background: <?php echo $qode_options_theme13['social_icon_top_gradient_background_color']; ?> -ms-linear-gradient(bottom, <?php echo $qode_options_theme13['social_icon_bottom_gradient_background_color'] ?> 0%, <?php echo $qode_options_theme13['social_icon_top_gradient_background_color'] ?> 100%);
        background: <?php echo $qode_options_theme13['social_icon_top_gradient_background_color']; ?> -moz-linear-gradient(bottom, <?php echo $qode_options_theme13['social_icon_bottom_gradient_background_color'] ?>00b2f4 0%, <?php echo $qode_options_theme13['social_icon_top_gradient_background_color'] ?> 100%);
        background: <?php echo $qode_options_theme13['social_icon_top_gradient_background_color']; ?> -o-linear-gradient(bottom, <?php echo $qode_options_theme13['social_icon_bottom_gradient_background_color'] ?> 0%, <?php echo $qode_options_theme13['social_icon_top_gradient_background_color'] ?> 100%);
        background: <?php echo $qode_options_theme13['social_icon_top_gradient_background_color']; ?> -webkit-gradient(linear, left bottom, left top, color-stop(0,<?php echo $qode_options_theme13['social_icon_bottom_gradient_background_color'] ?>), color-stop(1, <?php echo $qode_options_theme13['social_icon_top_gradient_background_color'] ?>));
        background: <?php echo $qode_options_theme13['social_icon_top_gradient_background_color']; ?> -webkit-linear-gradient(bottom, <?php echo $qode_options_theme13['social_icon_bottom_gradient_background_color'] ?> 0%, <?php echo $qode_options_theme13['social_icon_top_gradient_background_color'] ?> 100%);
        background: <?php echo $qode_options_theme13['social_icon_top_gradient_background_color']; ?> linear-gradient(to top, <?php echo $qode_options_theme13['social_icon_bottom_gradient_background_color'] ?> 0%, <?php echo $qode_options_theme13['social_icon_top_gradient_background_color'] ?> 100%);

        <?php } ?>

        <?php if(!empty($qode_options_theme13['social_icon_border_color'])) { ?>

        border: 1px solid <?php echo $qode_options_theme13['social_icon_border_color']; ?>

        <?php } ?>
	}
<?php } ?>

<?php if(!empty($qode_options_theme13['social_icon_color'])) { ?>
    .q_social_icon_holder .fa-stack i {
        color: <?php echo $qode_options_theme13['social_icon_color']; ?>
    }
<?php } ?>

<?php if (!empty($qode_options_theme13['button_title_color']) || !empty($qode_options_theme13['button_title_fontsize']) || !empty($qode_options_theme13['button_title_lineheight']) || !empty($qode_options_theme13['button_title_fontstyle']) || !empty($qode_options_theme13['button_title_fontweight']) || $qode_options_theme13['button_title_google_fonts'] != "-1" || (!empty($qode_options_theme13['button_top_gradient_color']) && !empty($qode_options_theme13['button_bottom_gradient_color'])) || !empty($qode_options_theme13['button_border_color'])) { ?>
.qbutton, .qbutton.medium, #submit_comment, .load_more a{
<?php if (!empty($qode_options_theme13['button_title_color'])) { ?>	color: <?php echo $qode_options_theme13['button_title_color'];  ?>; <?php } ?>
	<?php if($qode_options_theme13['button_title_google_fonts'] != "-1"){ ?>
	font-family: '<?php echo str_replace('+', ' ', $qode_options_theme13['button_title_google_fonts']); ?>', sans-serif;
	<?php } ?>

    <?php if (!empty($qode_options_theme13['button_border_color'])) { ?>	border-color: <?php echo $qode_options_theme13['button_border_color'];  ?>; <?php } ?>

	<?php if (!empty($qode_options_theme13['button_title_fontsize'])) { ?>	font-size: <?php echo $qode_options_theme13['button_title_fontsize'];  ?>px; <?php } ?>
	<?php if (!empty($qode_options_theme13['button_title_lineheight'])) { ?>	line-height: <?php echo $qode_options_theme13['button_title_lineheight'];  ?>px; <?php } ?>
	<?php if (!empty($qode_options_theme13['button_title_lineheight'])) { ?>	height: <?php echo $qode_options_theme13['button_title_lineheight'];  ?>px; <?php } ?>
	<?php if (!empty($qode_options_theme13['button_title_fontstyle'])) { ?>	font-style: <?php echo $qode_options_theme13['button_title_fontstyle'];  ?>; <?php } ?>
	<?php if (!empty($qode_options_theme13['button_title_fontweight'])) { ?>	font-weight: <?php echo $qode_options_theme13['button_title_fontweight'];  ?>; <?php } ?>
    <?php if($qode_options_theme13['button_top_gradient_color'] != "" && $qode_options_theme13['button_bottom_gradient_color'] != ""){ ?>
    background: -ms-linear-gradient(bottom, <?php echo $qode_options_theme13['button_bottom_gradient_color']; ?> 0%, <?php echo $qode_options_theme13['button_top_gradient_color']; ?> 100%);
    background: -moz-linear-gradient(bottom, <?php echo $qode_options_theme13['button_bottom_gradient_color']; ?> 0%, <?php echo $qode_options_theme13['button_top_gradient_color']; ?> 100%);
    background: -o-linear-gradient(bottom, <?php echo $qode_options_theme13['button_bottom_gradient_color']; ?> 0%, <?php echo $qode_options_theme13['button_top_gradient_color']; ?> 100%);
    background: -webkit-gradient(linear, left bottom, left top, color-stop(0, <?php echo $qode_options_theme13['button_bottom_gradient_color']; ?>), color-stop(1, <?php echo $qode_options_theme13['button_top_gradient_color']; ?>));
    background: -webkit-linear-gradient(bottom, <?php echo $qode_options_theme13['button_bottom_gradient_color']; ?> 0%, <?php echo $qode_options_theme13['button_top_gradient_color']; ?> 100%);
    background: linear-gradient(to top, <?php echo $qode_options_theme13['button_bottom_gradient_color']; ?> 0%, <?php echo $qode_options_theme13['button_top_gradient_color']; ?> 100%);

    <?php } ?>
}
<?php } ?>
<?php if (!empty($qode_options_theme13['button_title_hovercolor']) || (isset($qode_options_theme13['button_backgroundhovercolor']) && !empty($qode_options_theme13['button_backgroundhovercolor']))) { ?>
	.qbutton:hover,
    .qbutton.medium:hover,
	#submit_comment:hover,
	.load_more a:hover{
		<?php if (!empty($qode_options_theme13['button_title_hovercolor'])) { ?> color: <?php echo $qode_options_theme13['button_title_hovercolor'];?> !important; <?php } ?>
			}
<?php } ?>
<?php if (!empty($qode_options_theme13['button_backgroundcolor_hover'])) { ?>
	.qbutton:hover,
	#submit_comment:hover,
	.load_more a:hover{
		<?php if (!empty($qode_options_theme13['button_backgroundcolor_hover'])) { ?> background: <?php echo $qode_options_theme13['button_backgroundcolor_hover'];?> !important; <?php } ?>
			}
<?php } ?>
<?php
if(isset($qode_options_theme13['google_maps_height'])){
	if (intval($qode_options_theme13['google_maps_height']) > 0) {
?>
.google_map{
	height: <?php echo intval($qode_options_theme13['google_maps_height']); ?>px;
}
<?php
	}
}
?>
<?php if (!empty($qode_options_theme13['footer_top_background_color'])) { ?>
	.footer_top_holder,	footer #lang_sel > ul > li > a,	footer #lang_sel_click > ul > li > a{
		background-color: <?php echo $qode_options_theme13['footer_top_background_color']; ?>;
	}
	footer #lang_sel ul ul a,footer #lang_sel_click ul ul a,footer #lang_sel ul ul a:visited,footer #lang_sel_click ul ul a:visited{
		background-color: <?php echo $qode_options_theme13['footer_top_background_color']; ?> !important;
	}
<?php } ?>
<?php if (!empty($qode_options_theme13['footer_top_title_color'])) { ?>
.footer_top .column_inner > div h4 { 
	color:<?php echo $qode_options_theme13['footer_top_title_color'];  ?>;
}
<?php } ?>
<?php if (!empty($qode_options_theme13['footer_separator_color'])) { ?>
.footer_top .widget_recent_entries > ul > li:after,
.footer_top .widget_pages ul li:after,
.footer_top .widget_meta > ul > li:after,
.footer_top .widget_nav_menu ul li:after,
.footer_top .widget_recent_comments > ul > li:after { 
	border-color:<?php echo $qode_options_theme13['footer_separator_color'];  ?>;
}
<?php } ?>
<?php if (!empty($qode_options_theme13['footer_top_text_color'])) { ?>
	.footer_top,
	.footer_top p,
    .footer_top span,
    .footer_top li{
		color: <?php echo $qode_options_theme13['footer_top_text_color'];  ?>;
	}
<?php } ?>
<?php if (!empty($qode_options_theme13['footer_link_color'])) { ?>
    .footer_top a{
        color: <?php echo $qode_options_theme13['footer_link_color']; ?> !important;
    }
<?php } ?>
<?php if (!empty($qode_options_theme13['footer_link_hover_color'])) { ?>
    .footer_top a:hover{
        color: <?php echo $qode_options_theme13['footer_link_hover_color']; ?> !important;
    }
<?php } ?>
<?php if (!empty($qode_options_theme13['footer_bottom_background_color'])) { ?>
	.footer_bottom_holder, #lang_sel_footer{
		background-color:<?php echo $qode_options_theme13['footer_bottom_background_color'];  ?>;
	}
<?php } ?>
<?php if (!empty($qode_options_theme13['footer_bottom_text_color'])) { ?>
.footer_bottom, .footer_bottom span, .footer_bottom p, .footer_bottom p a, #lang_sel_footer ul li a,
footer #lang_sel > ul > li > a,
footer #lang_sel_click > ul > li > a,
footer #lang_sel a.lang_sel_sel,
footer #lang_sel_click a.lang_sel_sel,
footer #lang_sel ul ul a,
footer #lang_sel_click ul ul a,
footer #lang_sel ul ul a:visited,
footer #lang_sel_click ul ul a:visited,
footer #lang_sel_list.lang_sel_list_horizontal a,
footer #lang_sel_list.lang_sel_list_vertical a,
#lang_sel_footer a{
	color:<?php echo $qode_options_theme13['footer_bottom_text_color'];  ?>;
}
<?php } ?>
<?php if (!empty($qode_options_theme13['content_bottom_background_color'])) { ?>
	.qode_call_to_action.container{
		background-color:<?php echo $qode_options_theme13['content_bottom_background_color'];  ?>;
	}
<?php } ?>
<?php if (isset($qode_options_theme13['side_area_background_color']) && !empty($qode_options_theme13['side_area_background_color'])) { ?>
	.side_menu,
	.side_menu #lang_sel,
	.side_menu #lang_sel_click,
	.side_menu #lang_sel ul ul,
	.side_menu #lang_sel_click ul ul{
		background-color:<?php echo $qode_options_theme13['side_area_background_color'];  ?>;
	}
<?php } ?>
<?php if (isset($qode_options_theme13['side_area_text_color']) && !empty($qode_options_theme13['side_area_text_color'])) { ?>
	.side_menu .widget,
	.side_menu .widget.widget_search form,
	.side_menu .widget.widget_search form input[type="text"],
	.side_menu .widget.widget_search form input[type="submit"],
	.side_menu .widget h6,
	.side_menu .widget h6 a,
	.side_menu .widget p,
	.side_menu .widget li a,
	.side_menu .widget.widget_rss li a.rsswidget,
	.side_menu #wp-calendar caption,
	.side_menu .widget li,
	.side_menu_title h3,
	.side_menu .widget.widget_archive select, 
	.side_menu .widget.widget_categories select,
	.side_menu .widget.widget_text select,
	.side_menu .widget.widget_search form input[type="submit"],
	.side_menu #wp-calendar th, 
	.side_menu #wp-calendar td{
		color: <?php echo $qode_options_theme13['side_area_text_color'];  ?>;
	}
<?php } ?>
<?php if (isset($qode_options_theme13['side_area_title_color']) && !empty($qode_options_theme13['side_area_title_color'])) { ?>
	.side_menu .side_menu_title h4,
	.side_menu h5{
		color: <?php echo $qode_options_theme13['side_area_title_color'];  ?>;
	}
<?php } ?>

<?php if (isset($qode_options_theme13['blog_quote_link_box_color']) && !empty($qode_options_theme13['blog_quote_link_box_color'])) { ?>
	.blog_holder article.format-link .post_text .post_text_holder,
	.blog_holder article.format-quote .post_text .post_text_holder{
		background-color: <?php echo $qode_options_theme13['blog_quote_link_box_color'];  ?>;
	}
<?php } ?>

<?php
if(is_admin_bar_showing()){
?>

@media only screen and (min-width: 1000px){
	header.sticky.sticky_animate,
	header.fixed{
		padding-top: 32px !important;
	}

	header.sticky .qode_search_form,
	header.fixed .qode_search_form{
		top: 32px;
	}

	.side_menu{
		top: 32px;
	}
}

<?php
}
?>