// $j(window).load(function(){
	// setTimeout(function(){
		// $j("#panel.default").animate({marginLeft: "0px"});
		// $j("a.open").addClass('opened');
		// $j("#panel").addClass('opened-panel');
	// },1000);
// });

var tooltip1 = '<div class="tooltip tooltip1"><a href="#" class="tooltip_marker"></a> \
									<div class="popup_tooltip popup_tooltip1"> \
										<div class="popup_tooltip_inner"><i class="fa fa-times"></i> \
											<div class="tooltip_row clearfix"> \
													<h5 class="tooltip_title">Header Options</h5> \
													<p>Strata theme comes with an amazing new Qode functionality - choose main menu colors from page to page. Combine it with dark/light/transparent header backgrounds to create beautiful contrasts between pages. </p> \
													<h5>Try a different style</h5> \
													<img class="tooltip_image_1" src="http://demo.qodeinteractive.com/strata/demo_images/tooltip_image_1.jpg" alt="&nbsp;" /> \
													<a class="qbutton tiny tooltip_link_1" href="#">Change</a> \
											</div> \
										</div> \
									</div> \
								</div>\
								';
var tooltip2 = '<div class="tooltip tooltip2"><a href="#" class="tooltip_marker"></a> \
									<div class="popup_tooltip popup_tooltip2"> \
										<div class="popup_tooltip_inner"><i class="fa fa-times"></i> \
											<div class="tooltip_row clearfix"> \
													<h5 class="tooltip_title">Footer Options</h5> \
													<p>Choose different footer types, regular or unfold. </p> \
													<h5>Try a different style</h5> \
													<img class="tooltip_image_2" src="http://demo.qodeinteractive.com/strata/demo_images/tooltip_image_2.jpg" alt="&nbsp;" /> \
													<a class="qbutton tiny tooltip_link_2" href="#">Change</a> \
											</div> \
										</div> \
									</div> \
								</div>\
								';
								
var tooltip3 = '<div class="tooltip tooltip3"><a href="#" class="tooltip_marker"></a> \
									<div class="popup_tooltip popup_tooltip3"> \
										<div class="popup_tooltip_inner"><i class="fa fa-times"></i> \
											<div class="tooltip_row clearfix"> \
													<h5 class="tooltip_title">Sticky Header Options</h5> \
													<p>All menus are completely customizable and can be as simple or as complex as you want. Try our two favorite combinations. </p> \
													<h5>Try a different style</h5> \
													<img class="tooltip_image_3" src="http://demo.qodeinteractive.com/strata/demo_images/tooltip_image_3.jpg" alt="&nbsp;" /> \
													<a class="qbutton tiny tooltip_link_3" href="#">Change</a> \
											</div> \
										</div> \
									</div> \
								</div>\
								';
$j(window).load(function(){
	$j('header .header_bottom .container_inner').append(tooltip1);
	$j('footer .container_inner').append(tooltip2);
});
									
$j(document).ready(function() {
	
	
	
	$j(document).on( "click", ".tooltip .tooltip_marker", function(){
		$j(".popup_tooltip").hide(300);
		var $this = $j(this);
		
		if ($this.next(".popup_tooltip").is(":visible")){           
			$this.next(".popup_tooltip").find(".popup_tooltip_inner").animate({opacity:0},100);
			$this.next(".popup_tooltip").hide(300);
    }
    else{      
			$this.next(".popup_tooltip").show(300, function(){
				$this.next(".popup_tooltip").find(".popup_tooltip_inner").animate({opacity:1},600);
			});
    }
    return false;
	});
	
	$j(document).on( "click", ".tooltip .popup_tooltip_inner i", function(){
		$j(".popup_tooltip").hide(300);
		
		$j(this).closest(".popup_tooltip").find(".popup_tooltip_inner").animate({opacity:0},100);
		$j(this).closest(".popup_tooltip").hide(300);  
		
    return false;
	});
	
	$j(document).click(function() {
		$j(".tooltip .popup_tooltip").hide(300);
		$j(".tooltip .popup_tooltip .popup_tooltip_inner").animate({opacity:0},100);
		$j(".tooltip .popup_tooltip").hide(300);
		
	});

	$j(document).on( "click", ".tooltip", function(event){
		event.stopPropagation();
	});
	
	$j(document).on( "click", ".tooltip_link_1", function(e){
		e.preventDefault();
		if(!$j(this).hasClass('clicked')){
			$j(this).addClass('clicked');
			$j('html').addClass('dark_header');
			$j('.tooltip_image_1').attr('src','http://demo.qodeinteractive.com/strata/demo_images/tooltip_image_1_reverse.jpg');
		}else{
			$j(this).removeClass('clicked');
			$j('html').removeClass('dark_header');
			$j('.tooltip_image_1').attr('src','http://demo.qodeinteractive.com/strata/demo_images/tooltip_image_1.jpg');
		}
	});
	
	$j(document).on( "click", ".tooltip_link_2", function(e){
		e.preventDefault();
		if(!$j(this).hasClass('clicked')){
			$j(this).addClass('clicked');
			$j('footer').removeClass('uncover');
			$j('.content').addClass('normal_footer_content');
			$j('.tooltip_image_2').attr('src','http://demo.qodeinteractive.com/strata/demo_images/tooltip_image_2_reverse.jpg');
			
			
		}else{
			$j(this).removeClass('clicked');
			$j('footer').addClass('uncover');
			$j('.content').removeClass('normal_footer_content');
			$j('.tooltip_image_2').attr('src','http://demo.qodeinteractive.com/strata/demo_images/tooltip_image_2.jpg');
			
		}
	});
	
	$j(document).on( "click", ".tooltip_link_3", function(e){
		e.preventDefault();
		if(!$j(this).hasClass('clicked')){
			$j(this).addClass('clicked');
			$j('html').addClass('sticky_negative');
			$j('.tooltip_image_3').attr('src','http://demo.qodeinteractive.com/strata/demo_images/tooltip_image_3_reverse.jpg');
			
			
		}else{
			$j(this).removeClass('clicked');
			$j('html').removeClass('sticky_negative');
			$j('.tooltip_image_3').attr('src','http://demo.qodeinteractive.com/strata/demo_images/tooltip_image_3.jpg');
			
		}
	});
	
	$j('ul#tootlbar_header_color li').click(function(e){
		e.preventDefault();
		if($j(this).attr("data-value") != "white"){
			$j('.tooltip_link_1').addClass('clicked');
			$j('html').addClass('dark_header');
			$j('.tooltip_image_1').attr('src','http://demo.qodeinteractive.com/strata/demo_images/tooltip_image_1_reverse.jpg');
		}else{
			$j('.tooltip_link_1').removeClass('clicked');
			$j('html').removeClass('dark_header');
			$j('.tooltip_image_1').attr('src','http://demo.qodeinteractive.com/strata/demo_images/tooltip_image_1.jpg');
		}
	});
	
	
	$j('ul#tootlbar_footer_type li').click(function(e){
		e.preventDefault();
		if($j(this).attr("data-value") != "unfold"){
			$j('.tooltip_link_2').addClass('clicked');
			$j('footer').removeClass('uncover');
			$j('.content').addClass('normal_footer_content');
			$j('.tooltip_image_2').attr('src','http://demo.qodeinteractive.com/strata/demo_images/tooltip_image_2_reverse.jpg');
		}else{
			$j('.tooltip_link_2').removeClass('clicked');
			$j('footer').addClass('uncover');
			$j('.content').removeClass('normal_footer_content');
			$j('.tooltip_image_2').attr('src','http://demo.qodeinteractive.com/strata/demo_images/tooltip_image_2.jpg');
		}
	});
	
	
	$j("#panel.default a.open").click(function(e){
		e.preventDefault();
		var margin_left = $j("#panel.default").css("margin-left");
		if (margin_left == "-222px"){
			$j("#panel.default").animate({marginLeft: "0px"});
			$j("#panel.default").addClass('opened-panel');
			$j(this).addClass('opened');
		}
		else{
			$j("#panel.default").animate({marginLeft: "-222px"});
			$j(this).removeClass('opened');
			$j("#panel.default").removeClass('opened-panel');
		}
		return false;
	});
	
	$j(".accordion_toolbar").accordion({
		animate: "swing",
		collapsible: true,
		active: 7,
		icons: "",
		heightStyle: "content"
	});
	
	$j('ul#tootlbar_header_top_menu li').click(function(){
		if($j(this).attr("data-value") != ""){
			
    	$j.post(root+'updatesession.php', {strata_header_top : $j(this).attr("data-value")}, function(data){
				location.reload();
			});
		}
	});
	
	$j('ul#tootlbar_smooth_scroll li').click(function(){
		if($j(this).attr("data-value") != ""){
    	$j.post(root+'updatesession.php', {strata_smooth : $j(this).attr("data-value")}, function(data){
				location.reload();
			});
		}
	});
	
	$j('ul#tootlbar_header_type li').click(function(){
		if($j(this).attr("data-value") != ""){
    	$j.post(root+'updatesession.php', {strata_header_type : $j(this).attr("data-value")}, function(data){
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
									background-image: url('http://demo.qodeinteractive.com/river/demo_images/"+$j(this).attr("data-value")+".png'); \
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
									background-image: url('http://demo.qodeinteractive.com/river/demo_images/"+$j(this).attr("data-value")+".jpg'); \
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
			var color_border = "#049cd4";
			var color_gradient = "#009ad4";
			if($j(this).hasClass('color1')){
				var social_share = "social_share_blue";
				var circle_list = "list_circle_blue";
				var logo_image = "logo_blue";
				var footer_logo_image = "footer_logo_blue";
				var footer_map = "map_blue";
				color_border = "#049cd4";
				color_gradient = "#009ad4";
			}else if($j(this).hasClass('color2')){
				var social_share = "social_share_red";
				var circle_list = "list_circle_red";
				var logo_image = "logo_red";
				var footer_logo_image = "footer_logo_red";
				var footer_map = "map_red";
				color_border = "#ac0101";
				color_gradient = "#bd0000";
			}else if($j(this).hasClass('color3')){
				var social_share = "social_share_purple";
				var circle_list = "list_circle_purple";
				var logo_image = "logo_purple";
				var footer_logo_image = "footer_logo_purple";
				var footer_map = "map_purple";
				color_border = "#5b1f88";
				color_gradient = "#662d91";
			}else if($j(this).hasClass('color4')){
				var social_share = "social_share_orange";
				var circle_list = "list_circle_orange";
				var logo_image = "logo_orange";
				var footer_logo_image = "footer_logo_orange";
				var footer_map = "map_orange";
				color_border = "#e95c18";
				color_gradient = "#f26522";
			}else if($j(this).hasClass('color5')){
				var social_share = "social_share_gray";
				var circle_list = "list_circle_gray";
				var logo_image = "logo_gray";
				var footer_logo_image = "footer_logo_gray";
				var footer_map = "map_gray";
				color_border = "#8494a7";
				color_gradient = "#9aa8bc";
			}else if($j(this).hasClass('color6')){
				var social_share = "social_share_black";
				var circle_list = "list_circle_black";
				var logo_image = "logo_black";
				var footer_logo_image = "footer_logo_black";
				var footer_map = "map_black";
				color_border = "#252525";
				color_gradient = "#111111";
			}else{
				var social_share = "social_share_blue";
				var circle_list = "list_circle_blue";
				
			}
			
			if ($j("#toolbar_colors_css").length > 0){
				$j("#toolbar_colors_css").remove();
			}
			$j('.q_logo img.normal').attr('src', 'http://demo.qodeinteractive.com/strata/demo_images/'+logo_image+'.png');
			$j('.footer_logo').attr('src', 'http://demo.qodeinteractive.com/strata/demo_images/'+footer_logo_image+'.png');
			$j('footer .footer_map').attr('src', 'http://demo.qodeinteractive.com/strata/demo_images/'+footer_map+'.png');
			newSkin =".q_progress_bar .progress_content, \
			        .portfolio_gallery a .gallery_text_holder, \
			        .projects_holder article .portfolio_description .separator, \
			        .projects_holder article .hover_feature_holder_title .separator, \
			        .portfolio_slider .image_holder .separator, \
			        .highlight, \
			        .gallery_holder ul li .gallery_hover, \
			        .q_dropcap.circle, \
			        .q_dropcap.square, \
			        .q_icon_with_title.boxed .icon_holder .fa-stack, \
			        .q_font_awsome_icon_square, \
			        .q_icon_with_title.square .icon_holder .fa-stack, \
			        .box_holder_icon_inner.square .fa-stack, \
			        .q_font_awsome_icon_square, \
			        .box_holder_icon_inner.circle .fa-stack, \
			        .circle .icon_holder .fa-stack, \
			        .q_list.number.circle_number ul>li:before, \
			        .latest_post_holder .latest_post_date .post_publish_day, \
			        .social_share_dropdown ul li.share_title, \
			        #wp-calendar td#today, \
			        #back_to_top:hover span, \
			        .vc_text_separator.full div, \
			        .mejs-controls .mejs-time-rail .mejs-time-current, \
			        .mejs-controls .mejs-time-rail .mejs-time-handle, \
			        .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current, \
			        .q_pie_graf_legend ul li .color_holder, \
			        .q_line_graf_legend ul li .color_holder, \
			        .circle_item .circle:hover, \
			        .qode_call_to_action.container, \
			        .qode_carousels .flex-control-paging li a.flex-active, \
			        .woocommerce .product .onsale, \
		            .woocommerce .product .single-onsale, \
		            .woocommerce .quantity .minus:hover, \
		            .woocommerce #content .quantity .minus:hover, \
		            .woocommerce-page .quantity .minus:hover, \
		            .woocommerce-page #content .quantity .minus:hover, \
		            .woocommerce .quantity .plus:hover, \
		            .woocommerce #content .quantity .plus:hover, \
		            .woocommerce-page .quantity .plus:hover, \
		            .woocommerce-page #content .quantity .plus:hover, \
		            .woocommerce .quantity input[type='button']:hover, \
		            .woocommerce #content .quantity input[type='button']:hover, \
		            .woocommerce-page .quantity input[type='button']:hover, \
		            .woocommerce-page #content .quantity input[type='button']:hover, \
		            .woocommerce .quantity input[type='button']:active, \
		            .woocommerce #content .quantity input[type='button']:active, \
		            .woocommerce-page .quantity input[type='button']:active, \
		            .woocommerce-page #content .quantity input[type='button']:active, \
		            .woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content, \
		            .woocommerce-page .widget_price_filter .price_slider_wrapper .ui-widget-content, \
		            .shopping_cart_header .header_cart span{ \
						background-color: "+color+"; \
					} \
					.toolbar_color_background, .price_table_inner ul li.table_title, .price_table_inner ul li.prices{ \
						background: none !important; \
						background-color: "+color+" !important; \
					} \
					.portfolio_gallery a .gallery_text_holder, \
        			.gallery_holder ul li .gallery_hover{ \
						background-color: rgba("+hexToRgb(color).r+","+hexToRgb(color).g+","+hexToRgb(color).b+", 0.9); \
					} \
			        h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover, a, p a, \
			        nav.main_menu>ul>li.active > a > span, \
			        nav.main_menu>ul>li.active > a > i, \
			        nav.main_menu > ul > li:hover > a > span, \
			        nav.main_menu > ul > li:hover > a > i, \
			        .drop_down .second .inner > ul > li > a:hover, \
			        .drop_down .second .inner ul li.sub ul li a:hover, \
			        .drop_down .wide.icons  .second a:hover i, \
			        nav.mobile_menu ul li a:hover, \
			        nav.mobile_menu ul li.active > a, \
			        .breadcrumb .current, \
			        .breadcrumb a:hover, \
			        .box_image_holder .box_icon .fa-stack i.fa-stack-base, \
			        .q_icon_list i, \
			        .q_counter_holder span.counter, \
			        .box_holder_icon .fa-stack i, \
			        .qbutton.gray, \
			        .qbutton.gray:hover, \
			        .q_percentage_with_icon, \
			        .portfolio_navigation .portfolio_button a:hover i, \
			        .portfolio_like a.liked i, \
			        .portfolio_like a:hover i, \
			        .portfolio_single .portfolio_like a.liked i, \
			        .portfolio_single .portfolio_like a:hover i, \
			        .filter_holder ul li:hover span, \
			        .q_accordion_holder.accordion .ui-accordion-header:hover, \
			        .q_accordion_holder.accordion.with_icon .ui-accordion-header i, \
			        .testimonial_content_inner .testimonial_author .company_position, \
			        blockquote i.pull-left, \
			        .q_dropcap, \
			        .q_message.with_icon > i, \
			        .q_box_holder.with_icon .box_holder_icon_inner .fa-stack i.fa-stack-base, \
			        .q_font_awsome_icon_stack .fa-circle, \
			        .q_icon_with_title.boxed .icon_holder .fa-stack, \
			        .q_icon_with_title.center .icon_holder .font_awsome_icon i:hover, \
			        .q_icon_with_title .icon_with_title_link, \
			        .q_font_awsome_icon i:hover, \
			        .q_progress_bars_icons_inner.square .bar.active i, \
			        .q_progress_bars_icons_inner.circle .bar.active i, \
			        .q_progress_bars_icons_inner.normal .bar.active i, \
			        .q_progress_bars_icons_inner .bar.active i.fa-circle, \
			        .q_list.number ul>li:before, \
			        .latest_post_inner .post_infos a:hover, \
			        .post_info_right a:hover, \
			        .blog_holder article .post_description a:hover, \
			        .blog_holder.masonry article .post_info a:hover, \
			        .blog_holder article .post_comments:hover i, \
			        .latest_post_inner .post_comments:hover i, \
			        .blog_holder article .post_description a:hover, \
			        .blog_holder article .post_description .post_comments:hover, \
			        .blog_like a:hover i, \
			        .blog_like a.liked i, \
			        .blog_like a:hover span, \
			        .social_share_holder:hover .social_share_title, \
			        .social_share_dropdown ul li:hover .share_text, \
			        .social_share_dropdown ul li :hover i, \
			        .blog_holder article.format-quote .post_text i.qoute_mark, \
			        .blog_holder article.format-link .post_text i.link_mark, \
			        .blog_holder article.format-link .post_text .post_text_holder:hover h4 a, \
			        .blog_holder article.format-quote .post_text .post_text_holder:hover h4 a, \
			        .blog_holder article.format-quote .post_text .post_text_holder:hover .quote_author, \
			        .author_text_holder .author_email, \
			        .comment_holder .comment .text .replay, \
			        .comment_holder .comment .text .comment-reply-link, \
			        .header-widget.widget_nav_menu ul.menu li a:hover, \
			        aside .widget a:hover, \
			        .header_top #lang_sel ul li ul li a:hover, \
			        .header_top #lang_sel_click ul li ul li a:hover, \
			        .header_top #lang_sel_list ul li a.lang_sel_sel, \
			        .header_top #lang_sel_list ul li a:hover, \
			        aside .widget #lang_sel a.lang_sel_sel:hover, \
			        aside .widget #lang_sel_click a.lang_sel_sel:hover, \
			        aside .widget #lang_sel ul ul a:hover, \
			        aside .widget #lang_sel_click ul ul a:hover, \
			        aside .widget #lang_sel_list li a.lang_sel_sel, \
			        aside .widget #lang_sel_list li a:hover, \
			        .q_team .q_team_title_holder span, \
			        .animated_icon_with_text_holder .animated_text p, \
			        #respond textarea:focus, \
			        #respond input[type='text']:focus, \
			        .contact_form input[type='text']:focus, \
			        .contact_form  textarea:focus, \
			        .side_menu_button > a:hover, \
			        .header_top #lang_sel > ul > li > a:hover,  \
			        .header_top #lang_sel_click > ul > li> a:hover, \
					nav.content_menu ul li.active i, \
					nav.content_menu ul li:hover i, \
					nav.content_menu ul li.active a, \
					nav.content_menu ul li:hover a, \
					.woocommerce ul.products li.product:hover .price, \
		            .woocommerce .select2-results li.select2-highlighted, \
		            .woocommerce-page .select2-results li.select2-highlighted, \
		            .woocommerce-checkout .chzn-container .chzn-results li.active-result.highlighted, \
		            .woocommerce ul.products li.product .price, \
		            .woocommerce div.product p[itemprop='price'] span.amount, \
		            .woocommerce div.cart-collaterals div.cart_totals table tr.total strong span.amount, \
		            .woocommerce-page div.cart-collaterals div.cart_totals table tr.total strong span.amount, \
		            .woocommerce div.cart-collaterals div.cart_totals table tr.total strong, \
		            .woocommerce .checkout-opener-text a, \
		            .woocommerce form.checkout table.shop_table tfoot tr.total th strong, \
		            .woocommerce form.checkout table.shop_table tfoot tr.total td span.amount, \
		            .woocommerce aside ul.product_list_widget li > a:hover, \
		            .woocommerce aside ul.product-categories li > a:hover, \
		            .woocommerce aside ul.product_list_widget li span.amount, \
		            .woocommerce aside .widget ul.product-categories a:hover, \
		            .woocommerce-page aside .widget ul.product-categories a:hover, \
		            .shopping_cart_dropdown ul li a:hover, \
		            .shopping_cart_dropdown span.total span, \
		            .shopping_cart_dropdown .cart_list span.quantity, \
		            .shopping_cart_header .header_cart:hover i, \
		            #panel .open span i, \
		            .accordion_toolbar_content ul li:hover{ \
			            color: "+color+"; \
			        } \
			        .q_steps_holder .circle_small:hover span, .q_steps_holder .circle_small:hover .step_title, .q_circles_holder .q_circle_inner2:hover i, \
			        .header_top #lang_sel > ul > li > a:hover, .header_top #lang_sel_click > ul > li> a:hover, \
			        #panel-admin p.ui-state-active, #panel-admin p:hover, .toolbar_color .q_icon_with_title .icon_holder span i, .toolbar_color_custom, \
			        .toolbar_button_color .vc_span3:nth-child(2) .qbutton, .layer_slider_color, .q_toolbar_dropcaps .vc_span4:nth-child(3) .q_dropcap.square, \
			        .toolbar_icon_color .q_font_awsome_icon i, .toolbar_icon_color .q_box_holder.with_icon span.fa-stack i:last-child, .toolbar_icon_color .q_social_icon_holder .fa-stack.fa-lg i:last-child, \
			        .toolbar_call_to_action .wpb_wrapper > *:nth-child(7) .qbutton, .toolbar_call_to_action .wpb_wrapper > *:nth-child(9) .qbutton, \
			        .toolbar_process_color .wpb_wrapper > :nth-child(9) h3, .toolbar_process_color .wpb_wrapper > :nth-child(11) h3{ \
			            color: "+color+" !important; \
			        } \
			        .ajax_loader_html, \
			        .box_image_with_border:hover, \
			        .q_progress_bars_icons_inner.square .bar.active .bar_noactive,  \
			        .q_progress_bars_icons_inner.square .bar.active .bar_active, \
			        .q_progress_bars_icons_inner.circle .bar.active .bar_noactive, \
			        .q_progress_bars_icons_inner.circle .bar.active .bar_active, \
			        .blog_holder article.format-link .post_text .post_text_holder:hover, \
			        .blog_holder article.format-quote .post_text .post_text_holder:hover, \
			        .widget.widget_search form.form_focus, \
			        #back_to_top:hover span, \
			        .q_steps_holder .circle_small_wrapper, \
			        #respond textarea:focus, \
			        #respond input[type='text']:focus, \
			        .contact_form input[type='text']:focus, \
			        .contact_form  textarea:focus, \
			        blockquote, \
			        .q_progress_bar .progress_content{ \
			            border-color: "+color+"; \
			        } \
			        .q_progress_bars_vertical .progress_content_outer .progress_content,  \
			        .qbutton, \
			        .load_more a, \
			        #submit_comment, \
			        .drop_down .wide .second ul li .qbutton, \
			        .drop_down .wide .second ul li ul li .qbutton, \
			        .qbutton.dark, \
			        .q_social_icon_holder .fa-stack, \
			        .single_tags a, \
			        .widget .tagcloud a, \
			        .animated_icon_inner span.animated_icon_back i, \
			        .woocommerce .button, \
		            .woocommerce-page .button, \
		            .woocommerce-page input[type='submit'], \
		            .woocommerce input[type='submit'], \
		            .woocommerce ul.products li.product .added_to_cart, \
		            .woocommerce .widget_price_filter .ui-slider .ui-slider-handle, \
		            .woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle, .price_table_inner ul li.table_title{ \
			            border-color: "+color_border+"; \
			        } \
			        .q_progress_bars_vertical .progress_content_outer .progress_content, \
			        .qbutton, \
			        .load_more a, \
			        #submit_comment, \
			        .drop_down .wide .second ul li .qbutton, \
			        .drop_down .wide .second ul li ul li .qbutton, \
			        .qbutton.dark, \
			        .q_social_icon_holder .fa-stack, \
			        .single_tags a, \
			        .widget .tagcloud a, \
			        .animated_icon_inner span.animated_icon_back i, \
			        .woocommerce .button, \
		            .woocommerce-page .button, \
		            .woocommerce-page input[type='submit'], \
		            .woocommerce input[type='submit'], \
		            woocommerce ul.products li.product .added_to_cart, \
		            .woocommerce .widget_price_filter .ui-slider .ui-slider-handle, \
		            .woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle{ \
			            background: "+color_gradient+"; \
			            background: "+color+" -ms-linear-gradient(bottom, "+color_gradient+" 0%, "+color+" 100%); \
			            background: "+color+" -moz-linear-gradient(bottom, "+color_gradient+" 0%, "+color+" 100%); \
			            background: "+color+" -o-linear-gradient(bottom, "+color_gradient+" 0%, "+color+" 100%); \
			            background: "+color+" -webkit-gradient(linear, left bottom, left top, color-stop(0,"+color_gradient+"), color-stop(1, "+color+")); \
			            background: "+color+" -webkit-linear-gradient(bottom, "+color_gradient+" 0%, "+color+" 100%); \
			            background: "+color+" linear-gradient(to top, "+color_gradient+" 0%, "+color+" 100%); \
			        } \
			        .q_social_icon_holder:hover i.simple_social{ \
			            color: "+color_gradient+" !important; \
			        } \
					.social_share_holder:hover .social_share_icon{\
						background-image: url('http://demo.qodeinteractive.com/strata/demo_images/"+social_share+".png');\
					}\
					@media only screen and (-webkit-min-device-pixel-ratio:1.5), only screen and (min--moz-device-pixel-ratio:1.5), only screen and (-o-min-device-pixel-ratio:150/100), only screen and (min-device-pixel-ratio:1.5), only screen and (min-resolution:160dpi) {\
						.social_share_holder:hover .social_share_icon{\
							background-image: url('http://demo.qodeinteractive.com/strata/demo_images/"+social_share+"@1_5x.png');\
						}\
					}\
					@media only screen and (-webkit-min-device-pixel-ratio:2.0), only screen and (min--moz-device-pixel-ratio:2.0), only screen and (-o-min-device-pixel-ratio:200/100), only screen and (min-device-pixel-ratio:2.0), only screen and (min-resolution:210dpi) {\
						.social_share_holder:hover .social_share_icon{\
							background-image: url('http://demo.qodeinteractive.com/strata/demo_images/"+social_share+"@2x.png');\
						}\
					}\
					.q_list.circle ul>li{\
						background-image: url('http://demo.qodeinteractive.com/strata/demo_images/"+circle_list+".png');\
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