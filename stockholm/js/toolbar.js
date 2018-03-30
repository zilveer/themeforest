$j(window).load(function(){

});

$j(document).ready(function() {
    $j("#panel.default.left a.open").click(function(e){
        e.preventDefault();
        var margin_left = $j("#panel.default").css("margin-left");
        if (margin_left == "-245px"){
            $j("#panel.default").animate({marginLeft: "0px"});
            $j("#panel.default").addClass('opened-panel');
            $j(this).addClass('opened');
        }
        else{
            $j("#panel.default").animate({marginLeft: "-245px"});
            $j(this).removeClass('opened');
            $j("#panel.default").removeClass('opened-panel');
        }
        return false;
    });

    $j("#panel.default.right a.open").click(function(e){
        e.preventDefault();
        var margin_right = $j("#panel.default").css("margin-right");
        if (margin_right == "-245px"){
            $j("#panel.default").animate({marginRight: "0px"});
            $j("#panel.default").addClass('opened-panel');
            $j(this).addClass('opened');
        }
        else{
            $j("#panel.default").animate({marginRight: "-245px"});
            $j(this).removeClass('opened');
            $j("#panel.default").removeClass('opened-panel');
        }
        return false;
    });

    $j('ul#tootlbar_footer_type li').click(function(e){
        e.preventDefault();
        if($j(this).attr("data-value") != "unfold"){
            $j('footer').removeClass('uncover');
            $j('.content').addClass('normal_footer_content');
        }else{
            $j('footer').addClass('uncover');
            $j('.content').removeClass('normal_footer_content');
            setContentBottomMargin();
        }

        if($j('.uncover').length && $j('body').hasClass('vertical_menu_enabled') && $window_width > 1000){
            $j('.uncover').width($window_width -  $j('.vertical_menu_area').width());
        } else{
            $j('.uncover').css('width','100%');
        }
    });

    $j(".accordion_toolbar").accordion({
        animate: "swing",
        collapsible: true,
        active: 6,
        icons: "",
        heightStyle: "content"
    });

    $j('ul#tootlbar_header_top_menu li').click(function(){
        if($j(this).attr("data-value") != ""){

            $j.post(qode_root+'updatesession.php', {stockholm_header_top : $j(this).attr("data-value")}, function(data){
                location.reload();
            });
        }
    });

    $j('ul#tootlbar_page_transitions li').click(function(){
        if($j(this).attr("data-value") != ""){

            $j.post(qode_root+'updatesession.php', {stockholm_page_transitions : $j(this).attr("data-value")}, function(data){
                location.reload();
            });
        }
    });

    $j('ul#tootlbar_header_type li').click(function(){
        if($j(this).attr("data-value") != ""){
            $j.post(qode_root+'updatesession.php', {stockholm_header_type : $j(this).attr("data-value")}, function(data){
                location.reload();
            });
        }
    });

    $j('ul#tootlbar_pattern li').click(function(){

        $j('body.boxed .wrapper').removeClass('toolbar_clicked');
        jQuery('#tootlbar_pattern_css').remove();

        if($j(this).attr("data-value") != "no"){
            //$j('#tootlbar_boxed').getSetSSValue('boxed');
            //$j('#tootlbar_background').getSetSSValue('no');
            $j('body').addClass('boxed');
            newSkin ="body.boxed .wrapper { \
									background-image: url('http://demo.select-themes.com/hazel/demo-files/demo-images/"+$j(this).attr("data-value")+".png'); \
									background-position: 0px 0px; \
									background-repeat: repeat; \
								} \
							";
            jQuery('body').append('<style id="tootlbar_pattern_css" type="text/css">'+newSkin+'</style>');

        }else{
            newSkin ="body { \
									background-image: none; \
								} \
							";
            jQuery('body').append('<style id="tootlbar_pattern_css" type="text/css">'+newSkin+'</style>');
        }
    });

    $j('ul#tootlbar_background li').click(function(){

        $j('body.boxed .wrapper').removeClass('toolbar_clicked');
        jQuery('#tootlbar_background_css').remove();
        if($j(this).attr("data-value") != "no"){
            //$j('#tootlbar_boxed').getSetSSValue('boxed');
            //$j('#tootlbar_pattern').getSetSSValue('no');
            $j('body').addClass('boxed');
            newSkin ="body.boxed .wrapper { \
									background-image: url('http://demo.select-themes.com/hazel/demo-files/demo-images/"+$j(this).attr("data-value")+".jpg'); \
									background-position: 0px 0px; \
									background-repeat: repeat; \
									background-attachment: fixed; \
								} \
							";
            jQuery('body').append('<style id="tootlbar_background_css" type="text/css">'+newSkin+'</style>');

        }else{
            newSkin ="body { \
									background-image: none; \
								} \
							";
            jQuery('body').append('<style id="tootlbar_background_css" type="text/css">'+newSkin+'</style>');
        }
    });

    $j('ul#tootlbar_boxed li').click(function(){

        $j('body').removeClass('boxed');
        $j('body').addClass($j(this).attr("data-value"));

        $j('body.boxed .wrapper').addClass('toolbar_clicked');

        if($j(this).attr("data-value") != "boxed"){
            $j('#tootlbar_pattern').getSetSSValue('no');
            $j('#tootlbar_background').getSetSSValue('no');
        }
    });

    $j('ul#tootlbar_tooltips li').click(function(){
        if($j(this).attr("data-value") != "yes"){
            $j('.tooltip').css('visibility','hidden');
        }else{
            $j('.tooltip').css('visibility','visible');
        }
    });

    $j('div#tootlbar_hide_sections li input').change(function(){
        var id = $j(this).val();
        if(this.checked){
            $j("div.wpb_row[data-q_id='" + id + "'],section.parallax_section_holder[data-q_id='" + id + "']").fadeIn();
        }else{
            $j("div.wpb_row[data-q_id='" + id + "'],section.parallax_section_holder[data-q_id='" + id + "']").fadeOut();
        }
    });

    $j('#tootlbar_colors .color').each(function(){
        $j(this).on('click',function(){
            $j('#tootlbar_colors .color').removeClass('active');
            $j(this).addClass('active');
            var color = $j(this).data('color');

            if ($j("#toolbar_colors_css").length > 0){
                $j("#toolbar_colors_css").remove();
            }

            newSkin ="h1 a:hover,\
                    h2 a:hover,\
                    h3 a:hover,\
                    h4 a:hover,\
                    h5 a:hover,\
                    h6 a:hover,\
                    .blog_holder article.sticky .post_text h3 a,\
                    .blog_holder.masonry article.sticky .post_text h5 a,\
                    .blog_holder.masonry_full_width article.sticky .post_text h5 a,\
                    .blog_holder article .post_info,\
                    .blog_holder article .post_info a,\
                    .blog_holder article.format-quote .post_text:hover .post_info .social_share_dropdown span,\
                    .blog_holder article.format-link .post_text:hover .post_info .social_share_dropdown span,\
                    .latest_post_inner .post_comments:hover i,\
                    .blog_holder article .post_description a:hover,\
                    .blog_holder article .post_description .post_comments:hover,\
                    .blog_like a:hover i,\
                    .blog_like a.liked i,\
                    .blog_like a:hover span,\
                    .blog_holder article.format-quote .post_text i.qoute_mark,\
                    .blog_holder article.format-link .post_text i.link_mark,\
                    .single_tags  a,\
                    .widget .tagcloud a,\
                    .comment_holder .comment .text .replay,\
                    .comment_holder .comment .text .comment-reply-link,\
                    .comment_holder .comment .text .replay:hover,\
                    .comment_holder .comment .text .comment-reply-link:hover,\
                    div.comment_form form p.logged-in-as a,\
                    .blog_holder.masonry .post_author a,\
                    .blog_holder.masonry_full_width .post_author a,\
                    .blog_holder.masonry article .post_info a:hover,\
                    .blog_holder.masonry_full_width article .post_info a:hover,\
                    .q_masonry_blog article .q_masonry_blog_post_info a:hover,\
                    .latest_post_holder .post_info_section.date_hour_holder:hover,\
                    .latest_post_holder.boxes .latest_post_author_holder a,\
                    .latest_post_inner .post_infos a:hover,\
                    .latest_post_holder .post_info_section:hover .latest_post_info_icon,\
                    header:not(.with_hover_bg_color) nav.main_menu > ul > li:hover > a,\
                    nav.main_menu>ul>li.active > a,\
                    .drop_down .second .inner > ul > li > a:hover,\
                    .drop_down .second .inner ul li.sub ul li a:hover,\
                    nav.mobile_menu ul li a:hover,\
                    nav.mobile_menu ul li.active > a,\
                    .side_menu_button > a:hover,\
                    .mobile_menu_button span:hover,\
                    .vertical_menu ul li a:hover,\
                    .vertical_menu_toggle .second .inner ul li a:hover,\
                    .header_top #lang_sel ul li ul li a:hover,\
                    .header_top #lang_sel_click ul li ul li a:hover,\
                    .header_top #lang_sel_list ul li a.lang_sel_sel,\
                    .header_top #lang_sel_list ul li a:hover,\
                    aside .widget #lang_sel a.lang_sel_sel:hover,\
                    aside .widget #lang_sel_click a.lang_sel_sel:hover,\
                    aside .widget #lang_sel ul ul a:hover,\
                    aside .widget #lang_sel_click ul ul a:hover,\
                    aside .widget #lang_sel_list li a.lang_sel_sel,\
                    aside .widget #lang_sel_list li a:hover,\
                    .portfolio_detail .info .info_section_title,\
                    .portfolio_detail .info .info_section_title a,\
                    .portfolio_detail .social_share_icon,\
                    .portfolio_detail .social_share_holder:hover .social_share_title,\
                    .portfolio_navigation .portfolio_prev a:hover,\
                    .portfolio_navigation .portfolio_next a:hover,\
                    .portfolio_navigation .portfolio_button a:hover,\
                    .projects_holder article .portfolio_description .project_category,\
                    .projects_holder.hover_text article .project_category,\
                    .portfolio_slider li.item .project_category,\
                    .q_accordion_holder.accordion .ui-accordion-header:hover,\
                    .q_accordion_holder.accordion.with_icon .ui-accordion-header i,\
                    .q_accordion_holder.boxed .ui-state-active .tab-title,\
                    blockquote.with_quote_icon i,\
                    .q_dropcap,\
                    .testimonials .testimonial_text_inner p.testimonial_author span.author_company,\
                    .testimonial_content_inner .testimonial_author .company_position,\
                    .q_tabs .tabs-nav li.active a:hover,\
                    .q_tabs .tabs-nav li a:hover,\
                    .q_tabs.horizontal .tabs-nav li.active a,\
                    .price_in_table .value,\
                    .price_in_table .price,\
                    .q_font_elegant_holder.q_icon_shortcode:hover,\
                    .q_font_awsome_icon_holder.q_icon_shortcode:hover,\
                    .q_icon_with_title.normal_icon .icon_holder:hover .icon_text_icon,\
                    .box_holder_icon_inner.normal_icon .icon_holder_inner:hover .icon_text_icon,\
                    .q_progress_bars_icons_inner.square .bar.active i,\
                    .q_progress_bars_icons_inner.circle .bar.active i,\
                    .q_progress_bars_icons_inner.normal .bar.active i,\
                    .q_progress_bars_icons_inner .bar.active i.fa-circle,\
                    .q_progress_bars_icons_inner.square .bar.active .q_font_elegant_icon,\
                    .q_progress_bars_icons_inner.circle .bar.active .q_font_elegant_icon,\
                    .q_progress_bars_icons_inner.normal .bar.active .q_font_elegant_icon,\
                    .q_list.number ul>li:before,\
                    .social_share_dropdown ul li.share_title,\
                    .social_share_dropdown ul li a,\
                    .latest_post_holder .social_share_dropdown ul li a,\
                    .social_share_dropdown ul li .social_network_icon,\
                    .social_share_list_holder ul li i:hover,\
                    .service_table_inner li.service_table_title_holder .service_table_icon,\
                    .qbutton:not(.white):hover,\
                    .load_more a:hover,\
                    .blog_load_more_button a,\
                    #submit_comment:hover,\
                    .drop_down .wide .second ul li .qbutton:hover,\
                    .drop_down .wide .second ul li ul li .qbutton:hover,\
                    nav.content_menu ul li.active:hover i,\
                    nav.content_menu ul li:hover i,\
                    nav.content_menu ul li.active:hover a,\
                    nav.content_menu ul li:hover a,\
                    .more_facts_button:hover,\
                    aside.sidebar .widget a:hover,\
                    .header-widget.widget_nav_menu ul.menu li a:hover,\
                    .breadcrumb a:hover,\
                    .title.breadcrumbs_title .breadcrumb a:hover,\
                    .title.breadcrumbs_title .breadcrumb span.current,\
                    .myaccount_user a,\
                    .woocommerce .button:hover,\
                    .woocommerce-page .button:hover,\
                    .woocommerce #submit:hover,\
                    .woocommerce ul.products li.product a.qbutton:hover,\
                    .woocommerce-page ul.products li.product a.qbutton:hover,\
                    .woocommerce ul.products li.product .added_to_cart:hover,\
                    .woocommerce .select2-results li.select2-highlighted,\
                    .woocommerce-page .select2-results li.select2-highlighted,\
                    .woocommerce-checkout .chosen-container .chosen-results li.active-result.highlighted,\
                    .woocommerce-account .chosen-container .chosen-results li.active-result.highlighted,\
                    .woocommerce ins, .woocommerce-page ins,\
                    .woocommerce ul.products li.product .price,\
                    .woocommerce ul.products li.product:hover h6,\
                    .woocommerce .product .woocommerce-product-rating .woocommerce-review-link:hover,\
                    .woocommerce div.product div.product_meta > span a:hover,\
                    .woocommerce div.cart-collaterals div.cart_totals table tr.order-total strong span.amount,\
                    .woocommerce-page div.cart-collaterals div.cart_totals table tr.order-total strong span.amount,\
                    .woocommerce div.cart-collaterals div.cart_totals table tr.order-total strong,\
                    .woocommerce .checkout-opener-text a,\
                    .woocommerce form.checkout table.shop_table tfoot tr.order-total th,\
                    .woocommerce form.checkout table.shop_table tfoot tr.order-total td span.amount,\
                    .woocommerce aside ul.product_list_widget li > a:hover,\
                    aside ul.product-categories li > a:hover,\
                    .woocommerce aside ul.product_list_widget li span.amount,\
                    aside ul.product_list_widget li span.amount,\
                    .woocommerce .widget_shopping_cart_content p.buttons a.button:hover,\
                    .woocommerce aside .widget ul.product-categories a:hover,\
                    aside .widget ul.product-categories a:hover,\
                    .woocommerce-page aside .widget ul.product-categories a:hover,\
                    .woocommerce .widget_shopping_cart_content .total .amount,\
                    .woocommerce-page .widget_shopping_cart_content .total .amount,\
                    .shopping_cart_header .header_cart:hover i,\
                    .shopping_cart_dropdown ul li a:hover,\
                    .shopping_cart_dropdown span.total span,\
                    .shopping_cart_dropdown .cart_list span.quantity\
					{ \
							color: "+color+"; \
					} \
					.header_top #lang_sel > ul > li > a:hover,\
                    .header_top #lang_sel_click > ul > li> a:hover,\
                    .filter_holder ul li.active span,\
                    .filter_holder ul li:hover span,\
                    .q_social_icon_holder.normal_social:hover .simple_social,\
                    .q_steps_holder .circle_small:hover span,\
                    .q_steps_holder .circle_small:hover .step_title,\
                    .social_share_holder:hover > a\
					{ \
						color: "+color+" !important; \
					} \
			        #respond textarea:focus,\
	                #respond input[type='text']:focus,\
                    .contact_form input[type='text']:focus,\
                    .contact_form  textarea:focus,\
                    .q_masonry_blog article.format-link:hover,\
                    .q_masonry_blog article.format-quote:hover,\
                    .latest_post_holder .latest_post_date .post_publish_day,\
                    .mejs-controls .mejs-time-rail .mejs-time-current,\
                    .mejs-controls .mejs-time-rail .mejs-time-handle,\
                    .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current,\
                    .popup_menu:hover .line,\
                    .popup_menu:hover .line:after,\
                    .popup_menu:hover .line:before,\
                    .projects_holder .hover_icon_holder .hover_icon,\
                    .portfolio_slider .hover_icon_holder .hover_icon,\
                    .q_accordion_holder.accordion .ui-accordion-header.ui-state-active .accordion_mark_icon,\
                    .q_dropcap.circle,\
                    .q_dropcap.square,\
                    .gallery_holder ul li .gallery_hover i,\
                    .testimonials_holder.light .flex-direction-nav a:hover,\
                    .q_tabs.vertical .tabs-nav li.active a,\
                    .q_tabs.boxed .tabs-nav li.active a,\
                    .q_message,\
                    .q_price_table.active .active_text,\
                    .price_table_inner .price_button a:hover,\
                    .active .price_table_inner .price_button a,\
                    .q_list.circle ul>li:before,\
                    .q_list.number.circle_number ul>li:before,\
                    .social_share_dropdown ul li:hover,\
                    .vc_text_separator.full div,\
                    .q_pie_graf_legend ul li .color_holder,\
                    .q_line_graf_legend ul li .color_holder,\
                    .q_team .q_team_text_inner .separator,\
                    .circle_item .circle:hover,\
                    .qode_call_to_action.container,\
                    .animated_icon_inner span.animated_icon_back .animated_icon,\
                    .q_progress_bar .progress_content,\
                    .q_progress_bars_vertical .progress_content_outer .progress_content,\
                    .qbutton,\
                    .load_more a,\
                    .blog_load_more_button a,\
                    #submit_comment,\
                    .drop_down .wide .second ul li .qbutton,\
                    .drop_down .wide .second ul li ul li .qbutton,\
                    .qbutton.white:hover,\
                    .qbutton.solid_color,\
                    #wp-calendar td#today,\
                    .woocommerce input[type='text']:not(.qode_search_field):focus,\
                    .woocommerce input[type='password']:focus,\
                    .woocommerce input[type='email']:focus,\
                    .woocommerce-page input[type='text']:not(.qode_search_field):focus,\
                    .woocommerce-page input[type='password']:focus,\
                    .woocommerce-page input[type='email']:focus,\
                    .woocommerce textarea:focus,\
                    .woocommerce-page textarea:focus,\
                    .woocommerce table.cart div.coupon .input-text:focus,\
                    .woocommerce-page table.cart div.coupon .input-text:focus,\
                    .woocommerce.woocommerce-checkout div.coupon .input-text:focus,\
                    .woocommerce-page.woocommerce-checkout div.coupon .input-text:focus,\
                    .woocommerce .button,\
                    .woocommerce-page .button,\
                    .woocommerce-page input[type='submit'],\
                    .woocommerce input[type='submit'],\
                    .woocommerce ul.products li.product .added_to_cart,\
                    .woocommerce .product .onsale,\
                    .woocommerce .product .single-onsale,\
                    .woocommerce .quantity .minus:hover,\
                    .woocommerce #content .quantity .minus:hover,\
                    .woocommerce-page .quantity .minus:hover,\
                    .woocommerce-page #content .quantity .minus:hover,\
                    .woocommerce .quantity .plus:hover,\
                    .woocommerce #content .quantity .plus:hover,\
                    .woocommerce-page .quantity .plus:hover,\
                    .woocommerce-page #content .quantity .plus:hover,\
                    .woocommerce .woocommerce-accordion .ui-accordion-header.ui-state-active,\
                    .woocommerce .widget_price_filter .ui-slider-horizontal .ui-slider-range,\
                    .woocommerce-page .widget_price_filter .ui-slider-horizontal .ui-slider-range\
					{ \
			            background-color: "+color+"; \
			        } \
                    .blog_holder article.format-link .post_text:hover .post_text_inner,\
                    .blog_holder article.format-quote .post_text:hover .post_text_inner,\
                    .q_icon_with_title .icon_holder:hover .fa-stack,\
                    .q_icon_with_title.circle .icon_holder:hover .q_font_elegant_holder,\
                    .q_icon_with_title.square .icon_holder:hover .q_font_elegant_holder,\
                    .box_holder_icon_inner.square .icon_holder_inner:hover .fa-stack,\
                    .box_holder_icon_inner.circle .icon_holder_inner:hover .fa-stack,\
                    .box_holder_icon_inner .icon_holder_inner:hover .q_font_elegant_holder.circle,\
                    .box_holder_icon_inner .icon_holder_inner:hover .q_font_elegant_holder.square,\
                    .q_circles_holder .q_circle_inner:hover .q_circle_inner2\
			       { \
			            background-color: "+color+" !important; \
			        } \
			        .blog_holder article .post_text .post_info .post_author,\
                    .blog_holder article .post_text .post_info .time,\
                    .blog_holder article .post_text .post_info .post_category,\
                    .blog_holder article .post_text .post_info .post_comments,\
                    .blog_holder.masonry article .post_text .post_info .post_comments a,\
                    .blog_holder article .post_text .post_info .blog_like,\
                    .blog_holder article .post_text .post_info .blog_share,\
                    .drop_down .second,\
                    .drop_down .narrow .second .inner ul li ul,\
                    .header_top #lang_sel ul ul ,\
                    .header_top #lang_sel_click ul ul,\
                    .portfolio_slides .hover_feature_holder_inner .qbutton:hover,\
                    .q_accordion_holder.accordion .ui-accordion-header.ui-state-active .accordion_mark,\
                    .q_accordion_holder.accordion.boxed .ui-accordion-header.ui-state-active,\
                    .testimonials_holder.light .flex-direction-nav a:hover,\
                    .q_font_awsome_icon_square:hover,\
                    .q_font_awsome_icon_circle:hover,\
                    .q_font_elegant_holder.circle:hover,\
                    .q_font_elegant_holder.square:hover,\
                    .q_font_elegant_holder.circle:hover,\
                    .q_font_awsome_icon_circle:hover,\
                    .q_progress_bars_icons_inner.circle .bar .bar_noactive,\
                    .q_progress_bars_icons_inner.square .bar .bar_noactive,\
                    .social_share_dropdown ul,\
                    .page_share,\
                    .social_share_dropdown ul li a,\
                    .q_steps_holder .circle_small_wrapper,\
                    .animated_icon_inner span.animated_icon_back .animated_icon,\
                    .qbutton,\
                    .load_more a,\
                    .blog_load_more_button a:hover,\
                    #submit_comment,\
                    .drop_down .wide .second ul li .qbutton,\
                    .drop_down .wide .second ul li ul li .qbutton,\
                    .qbutton.white:hover,\
                    .qbutton.solid_color,\
                    .qbutton:hover,\
                    .header-widget.widget_nav_menu ul ul,\
                    .woocommerce .button,\
                    .woocommerce-page .button,\
                    .woocommerce-page input[type='submit'],\
                    .woocommerce input[type='submit'],\
                    .woocommerce ul.products li.product .added_to_cart,\
                    .woocommerce .quantity .minus:hover,\
                    .woocommerce #content .quantity .minus:hover,\
                    .woocommerce-page .quantity .minus:hover,\
                    .woocommerce-page #content .quantity .minus:hover,\
                    .woocommerce .quantity .plus:hover,\
                    .woocommerce #content .quantity .plus:hover,\
                    .woocommerce-page .quantity .plus:hover,\
                    .woocommerce-page #content .quantity .plus:hover,\
                    .shopping_cart_dropdown\
                    { \
			            border-color: "+color+"; \
			        } \
			        .q_icon_with_title .icon_holder:hover .icon_holder_inner,\
                    .q_icon_with_title .icon_holder:hover .fa-stack,\
                    .q_icon_with_title .icon_holder:hover .q_font_elegant_holder,\
                    .box_holder_icon_inner.circle .icon_holder_inner:hover,\
                    .box_holder_icon_inner.square .icon_holder_inner:hover,\
                    .box_holder_icon_inner.square .icon_holder_inner:hover .fa-stack,\
                    .box_holder_icon_inner.circle .icon_holder_inner:hover .fa-stack,\
                    .box_holder_icon_inner .icon_holder_inner:hover .q_font_elegant_holder.circle,\
                    .box_holder_icon_inner .icon_holder_inner:hover .q_font_elegant_holder.square,\
                    .q_circles_holder .q_circle_inner:hover .q_circle_inner2,\
                    .q_circles_holder .q_circle_inner:hover\
                    {\
                        border-color: "+color+" !important; \
                    }\
            ";
            jQuery('body').append('<style id="toolbar_colors_css" type="text/css">'+newSkin+'</style>');
        });
    });


});

function hexToRgb(hex) {
    // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
    var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
    hex = hex.replace(shorthandRegex, function(m, r, g, b) {
        return r + r + g + g + b + b;
    });

    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}

$j.fn.inlineStyle = function (prop) {
    var styles = this.attr("style"),
        value;
    styles && styles.split(";").forEach(function (e) {
        var style = e.split(":");
        if ($j.trim(style[0]) === prop) {
            value = style[1];
        }
    });
    return value;
};