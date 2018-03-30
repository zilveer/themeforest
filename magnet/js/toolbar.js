$j(window).load(function(){
	setTimeout(function(){
		$j("#panel").animate({marginLeft: "0px"});
		$j("a.open").addClass('opened');
	},1000);
});


$j(document).ready(function() {


	$j("#panel a.open").click(function(e){
		e.preventDefault();
		var margin_left = $j("#panel").css("margin-left");
		if (margin_left == "-318px"){
			$j("#panel").animate({marginLeft: "0px"});
			$j(this).addClass('opened');
		}
		else{
			$j("#panel").animate({marginLeft: "-318px"});
			$j(this).removeClass('opened');
			$j('.backgroundColorSelector, .firstColorSelector, .secondColorSelector, .thirdColorSelector').css('display','none');
			if(showBackground ) showBackground = !showBackground;
			if(showFirst) showFirst = !showFirst;
			if(showSecond) showSecond = !showSecond;
		}
		return false;
	});
	
	$j('#panel select').sSelect();
	$j('#tootlbar_ajax').change(function(){
		if($j(this).val() != ""){
			
			// sessionStorage.setItem("animation", $j(this).val());
    	$j.post(root+'updatesession.php', {animation : $j(this).val()}, function(data){
					location.reload();
			});
			
			
		}
	});

	
	$j('#tootlbar_pattern').change(function(){
		if($j(this).val() != ""){
			
			newSkin ="body { \
									background-image: url('wp-content/themes/magnet/img/"+$j(this).val()+".png'); \
									background-position: 0px 0px; \
									background-repeat: repeat; \
								} \
								.container, \
								.move_down .second { \
									background-color: transparent; \
								} \
							";
			jQuery('body').append('<style id="tootlbar_pattern" type="text/css">'+newSkin+'</style>'); 
			
		}else{
			newSkin ="body { \
									background-image: none; \
								} \
							";
			jQuery('body').append('<style id="tootlbar_pattern" type="text/css">'+newSkin+'</style>'); 
		}
	});
	
	$j('#tootlbar_layout').change(function(){
		$j('body').removeClass('boxed');
		$j('body').removeClass('wide');
		$j('body').removeClass('background_boxed');
		$j('body').addClass($j(this).val());
	});
	
	$j( "#slider_corners" ).slider({
		value:8,
		min: 0,
		max: 25,
		step: 1,
		slide: function( event, ui ) {
			if ($j("#rounded_corners").length > 0){
				$j("#rounded_corners").remove();
			}
			newSkin =".rounded_background, \
								.big-slider-control .control-seek-box, \
								.button, \
								span.submit_button, \
								p.form-submit, \
								.accordion h5 span, \
								.price_table:hover .price_table_inner, \
								.price_table_inner.active_best_price, \
								.price_table.active .price_table_inner, \
								.progress_bars .progress_content_outer, \
								.message, \
								.testimonial, \
								.pagination ul li:hover, \
								form#contact-form input[type='text'], \
								form#contact-form textarea, \
								.square_item .square, \
								.box_small, \
								#back_to_top, \
								.widget.widget_archive select, \
								.widget.widget_search form input[type='submit'], \
								.widget.widget_search form input[type='text'], \
								.widget .tagcloud a, \
								.logo_dot, \
								.pagination ul li, \
								.magic_holder, \
								.tooltip, \
								.stylish-select .newListSelected, \
								.open, \
								.big-slider-control .control-left, \
								.big-slider-control .control-right, \
								.portfolio_next .next_button, \
								.portfolio_prev .prev_button, \
								.blog_next .next_button, \
								.blog_prev .prev_button, \
								.twitter_post .tweet .twitter_controls .twitter_outer, \
								ul.latest_post li .post_date, \
								.title_search form #s, \
								.title_search form input[type='submit'], \
								.contact_detail form#contact-form input[type='text'], \
								.contact_detail form#contact-form textarea, \
								.comment_form form#contact-form input[type='text'], \
								.comment_form form#contact-form textarea, \
								.widget_product_search #searchform input.placeholder, \
								.widget_product_search #searchform input:focus, \
								.woocommerce .woocommerce-ordering select, \
								.woocommerce-page .woocommerce-ordering select, \
								.woocommerce form .form-row select, \
								.woocommerce-page form .form-row select, \
								.woocommerce a.button.alt, \
								.woocommerce button.button.alt, \
								.woocommerce input.button.alt, \
								.woocommerce #respond input#submit.alt, \
								.woocommerce #content input.button.alt, \
								.woocommerce-page a.button.alt, \
								.woocommerce-page button.button.alt, \
								.woocommerce-page input.button.alt, \
								.woocommerce-page #respond input#submit.alt, \
								.woocommerce-page #content input.button.alt, \
								.woocommerce #respond input#submit,\
								.woocommerce-page #respond input#submit, \
								.woocommerce button.button, \
								.woocommerce-page button.button, \
								.woocommerce-message a.button, \
								.woocommerce table.shop_table input.button, \
								.woocommerce-page table.shop_table input.button, \
								.woocommerce-checkout form.login .form-row input.button, \
								.woocommerce-checkout form.checkout_coupon .form-row input.button, \
								.woocommerce-account input.button, \
								.woo_cart_emtpty_button a.button, \
								.woocommerce-account .my_account_orders a.button, \
								.widget_product_search #searchform #searchsubmit, \
								#pp_full_res #commentform input, \
								.woocommerce #payment, \
								.woocommerce-page #payment, \
								.woocommerce nav.woocommerce-pagination ul li, \
								.woocommerce-page nav.woocommerce-pagination ul li, \
								.woocommerce #billing_country_chzn, \
								.woocommerce #shipping_country_chzn, \
								.woocommerce form .form-row input.input-text, \
								.woocommerce-page form .form-row input.input-text, \
								#pp_full_res #commentform textarea, \
								.woocommerce form .form-row textarea, \
								.woocommerce-page form .form-row textarea, \
								.widget_shopping_cart_content p.buttons a.button \
								{ \
									-webkit-border-radius: "+ui.value+"px; \
									-moz-border-radius: "+ui.value+"px; \
									border-radius: "+ui.value+"px; \
								} \
								.move_down .second, \
								.selectnav ul \
								{ \
									-webkit-border-radius: 0px 0px "+ui.value+"px "+ui.value+"px; \
									-moz-border-radius: 0px 0px "+ui.value+"px "+ui.value+"px; \
									border-radius: 0px 0px "+ui.value+"px "+ui.value+"px; \
								} \
								.price_table:first-child .price_table_inner \
								{ \
									border-top-left-radius: "+ui.value+"px; \
									border-bottom-left-radius: "+ui.value+"px; \
									-webkit-border-top-left-radius: "+ui.value+"px; \
									-webkit-border-bottom-left-radius: "+ui.value+"px; \
									-moz-border-top-left-radius: "+ui.value+"px; \
									-moz-border-bottom-left-radius: "+ui.value+"px;		 \
								} \
								.price_table:last-child .price_table_inner{ \
									border-top-right-radius: "+ui.value+"px; \
									border-bottom-right-radius: "+ui.value+"px; \
									-webkit-border-top-right-radius: "+ui.value+"px; \
									-webkit-border-bottom-right-radius: "+ui.value+"px; \
									-moz-border-top-right-radius: "+ui.value+"px; \
									-moz-border-bottom-right-radius: "+ui.value+"px;	\
								}\
								.price_table:nth-child(4n+1) .price_table_inner \
								{ \
									border-top-left-radius: "+ui.value+"px;  \
									border-bottom-left-radius: "+ui.value+"px; \
									-webkit-border-top-left-radius: "+ui.value+"px; \
									-webkit-border-bottom-left-radius: "+ui.value+"px; \
									-moz-border-top-left-radius: "+ui.value+"px; \
									-moz-border-bottom-left-radius: "+ui.value+"px; \
								} \
								.price_table:nth-child(4) .price_table_inner{ \
									border-top-right-radius: "+ui.value+"px; \
									border-bottom-right-radius: "+ui.value+"px; \
									-webkit-border-top-right-radius: "+ui.value+"px; \
									-webkit-border-bottom-right-radius: "+ui.value+"px; \
									-moz-border-top-right-radius: "+ui.value+"px; \
									-moz-border-bottom-right-radius: "+ui.value+"px;	\
								} \
								.progress_bars .progress_content{ \
									border-top-left-radius: "+ui.value+"px; \
									border-bottom-left-radius: "+ui.value+"px; \
									-webkit-border-top-left-radius: "+ui.value+"px; \
									-webkit-border-bottom-left-radius: "+ui.value+"px; \
									-moz-border-top-left-radius: "+ui.value+"px; \
									-moz-border-bottom-left-radius: "+ui.value+"px; \
								} \
								.tabs .tabs-nav li { \
									border-top-left-radius: "+ui.value+"px; \
									border-top-right-radius: "+ui.value+"px; \
									-webkit-border-top-left-radius: "+ui.value+"px; \
									-webkit-border-top-right-radius: "+ui.value+"px; \
									-moz-border-top-left-radius: "+ui.value+"px; \
									-moz-border-top-right-radius: "+ui.value+"px; \
								} \
								.tabs .tabs-container { \
									border-bottom-left-radius: "+ui.value+"px; \
									border-bottom-right-radius: "+ui.value+"px; \
									border-top-right-radius: "+ui.value+"px; \
									-webkit-border-bottom-left-radius: "+ui.value+"px; \
									-webkit-border-bottom-right-radius: "+ui.value+"px; \
									-webkit-border-top-right-radius: "+ui.value+"px; \
									-moz-border-bottom-left-radius: "+ui.value+"px; \
									-moz-border-bottom-right-radius: "+ui.value+"px; \
									-moz-border-top-right-radius: "+ui.value+"px; \
								} \
								.link_holder{ \
									-webkit-border-radius: "+ui.value+"px 0px 0px "+ui.value+"px; \
									-moz-border-radius: "+ui.value+"px 0px 0px "+ui.value+"px; \
									border-radius: "+ui.value+"px 0px 0px "+ui.value+"px; \
								} \
								#panel-admin \
								{ \
									-webkit-border-radius: 0px "+ui.value+"px "+ui.value+"px 0px; \
									-moz-border-radius: 0px "+ui.value+"px "+ui.value+"px 0px; \
									border-radius: 0px "+ui.value+"px "+ui.value+"px 0px; \
								} \
								.stylish-select .SSContainerDivWrapper \
								{ \
									-webkit-border-radius: 0px 0px "+ui.value+"px "+ui.value+"px; \
									-moz-border-radius: 0px 0px "+ui.value+"px "+ui.value+"px; \
									border-radius: 0px 0px "+ui.value+"px "+ui.value+"px; \
								} \
								.woocommerce-info:before, \
								.woocommerce-message:before \
								{ \
									border-radius: 0px 0px "+ui.value+"px "+ui.value+"px; \
									-moz-border-radius: 0px 0px "+ui.value+"px "+ui.value+"px; \
									-webkit-border-radius: 0px 0px "+ui.value+"px "+ui.value+"px; \
								} \
								.woocommerce div.product .woocommerce-tabs ul.tabs li, \
								.woocommerce #content div.product .woocommerce-tabs ul.tabs li, \
								.woocommerce-page div.product .woocommerce-tabs ul.tabs li, \
								.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li \
								{ \
									border-radius: "+ui.value+"px "+ui.value+"px 0px 0px; \
									-webkit-border-radius: "+ui.value+"px "+ui.value+"px 0px 0px; \
									-moz-border-radius: "+ui.value+"px "+ui.value+"px 0px 0px; \
								} \
								.woocommerce div.product .woocommerce-tabs .panel, \
								.woocommerce #content div.product .woocommerce-tabs .panel, \
								.woocommerce-page div.product .woocommerce-tabs .panel, \
								.woocommerce-page #content div.product .woocommerce-tabs .panel \
								{ \
									border-radius: 0px "+ui.value+"px "+ui.value+"px "+ui.value+"px; \
									-webkit-border-radius: 0px "+ui.value+"px "+ui.value+"px "+ui.value+"px; \
									-moz-border-radius: 0px "+ui.value+"px "+ui.value+"px "+ui.value+"px; \
								} \
								";
			
				jQuery('body').append('<style id="rounded_corners" type="text/css">'+newSkin+'</style>'); 
				
				if($j("#slider_corners").slider("value") == 1){
					var value = 0;
				}else if($j("#slider_corners").slider("value") == 24){
					var value = 25;
				}else{
					var value = $j("#slider_corners").slider("value");
				}
				
				$j( ".round_value" ).html(value);
		}
	});
	
	

	$j('.backgroundColorSelector').each(function(){
		var Othis = $j(this).siblings('.colorSelector'); //cache a copy of the this variable for use inside nested function
		var initialColor = $j(Othis).next('input').attr('value');
		$j(this).ColorPicker({
			flat: true,
			color: initialColor,
			onShow: function (colpkr) {
				$j(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$j(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$j(Othis).children('div').css('backgroundColor', '#' + hex);
				$j(Othis).next('input').attr('value','#' + hex);
				if ($j("#toolbar_background_colors").length > 0){
					$j("#toolbar_background_colors").remove();
				}
				
				newSkin ="body,.progress_bars .progress_title, .boxed .container_shadow_inner, .progress_bars .progress_title {background-color: #"+hex+";}";
				jQuery('body').append('<style id="toolbar_background_colors" type="text/css">'+newSkin+'</style>'); 
				
				// if($j('#tootlbar_pattern').getSetSSValue() != ""){
					// newSkin2 ="body,.progress_bars .progress_title, .boxed .container_shadow_inner, .progress_bars .progress_title {background-color: transparent;}";
					// jQuery('body').append('<style id="toolbar_background_colors" type="text/css">'+newSkin2+'</style>'); 
				// }
				
				
			}
		});
	});
	var showBackground = false;
	$j('.background_colorSelector, .backgroundColorSelector .colorpicker_submit').bind('click', function() {
		$j('.backgroundColorSelector').css({display: showBackground ? 'none' : 'block'});
		$j('.backgroundColorSelector > div').css({display: showBackground ? 'none' : 'block'});
		showBackground = !showBackground;
	});
	
	
	$j('.backgroundBoxedColorSelector').each(function(){
		var Othis = $j(this).siblings('.colorSelector'); //cache a copy of the this variable for use inside nested function
		var initialColor = $j(Othis).next('input').attr('value');
		$j(this).ColorPicker({
			flat: true,
			color: initialColor,
			onShow: function (colpkr) {
				$j(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$j(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$j(Othis).children('div').css('backgroundColor', '#' + hex);
				$j(Othis).next('input').attr('value','#' + hex);
				if ($j("#toolbar_background_boxed_colors").length > 0){
					$j("#toolbar_background_boxed_colors").remove();
				}
				
				newSkin ="body.boxed {background-color: #"+hex+";}";
				jQuery('body').append('<style id="toolbar_background_boxed_colors" type="text/css">'+newSkin+'</style>'); 
				
				// if($j('#tootlbar_pattern').getSetSSValue() != ""){
					// newSkin2 ="body.boxed {background-color: transparent;}";
					// jQuery('body').append('<style id="toolbar_background_boxed_colors" type="text/css">'+newSkin2+'</style>'); 
				// }
				
				
			}
		});
	});
	var showBackgroundBox = false;
	$j('.backgroundBoxed_colorSelector, .backgroundBoxedColorSelector .colorpicker_submit').bind('click', function() {
		$j('.backgroundBoxedColorSelector').css({display: showBackgroundBox ? 'none' : 'block'});
		$j('.backgroundBoxedColorSelector > div').css({display: showBackgroundBox ? 'none' : 'block'});
		showBackgroundBox = !showBackgroundBox;
	});
	
	
	$j('.firstColorSelector').each(function(){
		var Othis = $j(this).siblings('.colorSelector'); //cache a copy of the this variable for use inside nested function
		var initialColor = $j(Othis).next('input').attr('value');
		$j(this).ColorPicker({
			flat: true,
			color: initialColor,
			onShow: function (colpkr) {
				$j(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$j(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$j(Othis).children('div').css('backgroundColor', '#' + hex);
				$j(Othis).next('input').attr('value','#' + hex);
				if ($j("#toolbar_first_colors").length > 0){
					$j("#toolbar_first_colors").remove();
				}
				newSkin ="#magic, \
									#magic2, \
									.move_down .second, \
									.selectnav ul, \
									.big-slider-control .control-seek-box.pressed, \
									.big-slider-control .control-left:hover, \
									.big-slider-control .control-right:hover, \
									.portfolio_next a:hover .next_button, \
									.portfolio_prev a:hover .prev_button, \
									.blog_next a:hover .next_button, \
									.blog_prev a:hover .prev_button, \
									span.submit_button:hover input, \
									p.form-submit:hover input, \
									.button:hover, \
									.accordion h5 span:hover, \
									.accordion h5.ui-state-active span, \
									.circle_item .circle:hover, \
									.square_item .square:hover, \
									.twitter_post .tweet .twitter_controls .twitter_outer:hover, \
									.box_small:hover, \
									#back_to_top:hover, \
									.widget.widget_search form input[type='submit']:hover, \
									.social_menu li a:hover, \
									.footer_bottom .social_menu a:hover, \
									.drop_down .second ul, \
									.drop_down .second ul li ul, \
									ul.latest_post li .post_date span:hover, \
									.link_holder a:hover, \
									.link_holder a:hover, .link_holder a.active, \
									.woocommerce-info:before, \
									.woocommerce-error:before, \
									.woocommerce-message:before, \
									.woocommerce span.onsale, \
									.woocommerce-page span.onsale, \
									.woocommerce a.button.alt:hover, \
									.woocommerce button.button.alt:hover, \
									.woocommerce input.button.alt:hover, \
									.woocommerce #respond input#submit.alt:hover, \
									.woocommerce #content input.button.alt:hover, \
									.woocommerce-page a.button.alt:hover, \
									.woocommerce-page button.button.alt:hover, \
									.woocommerce-page input.button.alt:hover, \
									.woocommerce-page #respond input#submit.alt:hover, \
									.woocommerce-page #content input.button.alt:hover, \
									.woocommerce #respond input#submit:hover, \
									.woocommerce-page #respond input#submit:hover, \
									.woocommerce button.button:hover, \
									.woocommerce-page button.button:hover, \
									.woocommerce-message a.button:hover, \
									.woocommerce-checkout form.login .form-row input.button:hover, \
									.woocommerce-checkout form.checkout_coupon .form-row input.button:hover, \
									.woocommerce-account input.button:hover, \
									.woo_cart_emtpty_button a.button:hover, \
									.woocommerce-account .my_account_orders a.button:hover, \
									.widget_product_search #searchform #searchsubmit:hover, \
									.widget_shopping_cart_content p.buttons a.button:hover, \
									.woocommerce .quantity .plus:hover, \
									.woocommerce .quantity .minus:hover, \
									.woocommerce #content .quantity .plus:hover, \
									.woocommerce #content .quantity .minus:hover, \
									.woocommerce-page .quantity .plus:hover, \
									.woocommerce-page .quantity .minus:hover, \
									.woocommerce-page #content .quantity .plus:hover, \
									.woocommerce-page #content .quantity .minus:hover, \
									.woocommerce .widget_price_filter .ui-slider .ui-slider-range, \
									.woocommerce-page .widget_price_filter .ui-slider .ui-slider-range, \
									.woocommerce .widget_price_filter .ui-slider .ui-slider-handle, \
									.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle, \
									.woocommerce table.shop_table input.button:hover, \
									.woocommerce-page table.shop_table input.button:hover, \
									.woocommerce .chzn-container-single .chzn-drop ul li:hover, \
									.woocommerce .chzn-container-single .chzn-drop ul li.highlighted \
									{\
										background-color: #"+hex+"; \
									} \
									.logo p, \
									.menuHoverOn nav.main_menu > ul > li:hover > a span \
									{ \
										border-color: #"+hex+"; \
									} \
									.button:hover, input[type='submit']:hover, \
									span.submit_button:hover input, \
									p.form-submit:hover input \
									{ \
										background-color: #"+hex+"; \
									} \
									h1, \
									h5, \
									ul.latest_post li a, \
									a, \
									.filter a, \
									p a, \
									.posts_holder1 article .info .left a, \
									.blog_holder3 article .info .left a, \
									.blog_holder3 article .text a.link, \
									.blog_holder3 article .text .post_holder a.link, \
									.comment_holder .comment .info .right a.comment-reply-link, \
									.posts_holder .info .left a, \
									.posts_holder1 article .info a.more, \
									.posts_holder1 article .text a.link, \
									.posts_holder .text a.more, \
									.blog_holder3 .text a.more, \
									.big-slider-slide .more-info a:hover, \
									.footer_bottom nav.footer_menu ul li a:hover, \
									.footer_bottom ul.menu li a:hover, \
									.big-slider-slide .more-info h2 a:hover, \
									.big-slider-slide .more-info a:hover, \
									.big-slider .big-slider-slide:hover .more-info h4 a, \
									.box1.catalog .big-slider-slide .more-info h2, \
									.portfolio_holder_v3 article:hover h4 a, \
									a:hover, \
									.filter a:hover, \
									p a:hover, \
									.posts_holder1 article .info .left a:hover, \
									.blog_holder3 article .info .left a:hover, \
									.blog_holder3 article .text a.link, \
									.blog_holder3 article .text .post_holder a.link:hover, \
									.comment_holder .comment .info .right a.comment-reply-link:hover, \
									.posts_holder .info .left a:hover, \
									.posts_holder1 article .info a.more:hover, \
									.posts_holder1 article .text a.link:hover, \
									.posts_holder .text a.more:hover, \
									.blog_holder3 .text a.more:hover, \
									.portfolio_holder article h4 a:hover, \
									.posts_holder .text h3 a:hover, \
									.blog_holder3 article h3 a:hover, \
									.posts_holder1 article h3 a:hover, \
									aside .widget a:hover, \
									.tooltip, \
									ul.latest_post li a, \
									.footer_top a:hover, \
									.footer_bottom nav.footer_menu ul li a:hover, \
									.footer_bottom ul.menu li a:hover, \
									.first_color, \
									.woocommerce ul.products li.product a.add_to_cart_button:hover, \
									.woocommerce-page ul.products li.product a.add_to_cart_button:hover, \
									.woocommerce p.stars a:hover:before, \
									.woocommerce p.stars a:focus:before, \
									.woocommerce-page p.stars a:hover:before, \
									.woocommerce-page p.stars a:focus:before, \
									.woocommerce .widget .product_list_widget li a:hover, \
									.woocommerce-page .widget .product_list_widget li a:hover, \
									.woocommerce table.cart a.remove:hover, \
									.woocommerce #content table.cart a.remove:hover, \
									.woocommerce-page table.cart a.remove:hover, \
									.woocommerce-page #content table.cart a.remove:hover, \
									.woocommerce table.cart a.remove, \
									.woocommerce #content table.cart a.remove, \
									.woocommerce-page table.cart a.remove, \
									.woocommerce-page #content table.cart a.remove, \
									.woocommerce .cart-collaterals .shipping_calculator h2:hover a, \
									.woocommerce-page .cart-collaterals .shipping_calculator h2:hover a \
									{ \
										color: #"+hex+"; \
									}\
									";
				jQuery('body').append('<style id="toolbar_first_colors" type="text/css">'+newSkin+'</style>'); 
			}
		});
	});
	var showFirst = false;
	$j('.first_ColorSelector, .firstColorSelector .colorpicker_submit').bind('click', function() {
		$j('.firstColorSelector').css({display: showFirst ? 'none' : 'block'});
		$j('.firstColorSelector > div').css({display: showFirst ? 'none' : 'block'});
		showFirst = !showFirst;
	}); 
	
	$j('.secondColorSelector').each(function(){
		var Othis = $j(this).siblings('.colorSelector'); //cache a copy of the this variable for use inside nested function
		var initialColor = $j(Othis).next('input').attr('value');
		$j(this).ColorPicker({
			flat: true,
			color: initialColor,
			onShow: function (colpkr) {
				$j(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$j(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$j(Othis).children('div').css('backgroundColor', '#' + hex);
				$j(Othis).next('input').attr('value','#' + hex);
				if ($j("#toolbar_second_colors").length > 0){
					$j("#toolbar_second_colors").remove();
				}
				newSkin =".price_table_inner, \
									.message, \
									.different_color_testimonials, \
									.bx-wrapper .bx-pager.bx-default-pager a, \
									.progress_bars .progress_content_outer, \
									form#contact-form input[type='text'], \
									form#contact-form textarea, \
									table.standard-table th, \
									table.standard-table tr:nth-child(odd) td, \
									.widget.widget_archive select, \
									.widget.widget_categories select, \
									.widget.widget_text select, \
									.widget.widget_search form input[type='text'], \
									.tabs .tabs-nav li.active a, \
									.tabs .tabs-container, \
									.woocommerce .woocommerce-ordering select, \
									.woocommerce-page .woocommerce-ordering select, \
									.woocommerce form .form-row select, \
									.woocommerce-page form .form-row select, \
									.woocommerce div.product .woocommerce-tabs ul.tabs li.active a, \
									.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a, \
									.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a, \
									.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active a, \
									.woocommerce div.product .woocommerce-tabs .panel, \
									.woocommerce #content div.product .woocommerce-tabs .panel, \
									.woocommerce-page div.product .woocommerce-tabs .panel, \
									.woocommerce-page #content div.product .woocommerce-tabs .panel, \
									.woocommerce .quantity input.qty, \
									.woocommerce #content .quantity input.qty, \
									.woocommerce-page .quantity input.qty, \
									.woocommerce-page #content .quantity input.qty, \
									.woocommerce table.cart td.actions .coupon .input-text, \
									.woocommerce-page table.cart td.actions .coupon .input-text, \
									.widget_product_search #searchform input.placeholder, \
									.widget_product_search #searchform input:focus, \
									.woocommerce table.shop_table tfoot tr:nth-child(2n) th, \
									.woocommerce-page table.shop_table tfoot tr:nth-child(2n) th, \
									.woocommerce table.shop_table tfoot tr:nth-child(2n) td, \
									.woocommerce-page table.shop_table tfoot tr:nth-child(2n) td, \
									.woocommerce table.shop_table tbody tr:nth-child(2n) td, \
									.woocommerce table.shop_table thead, \
									.woocommerce-page table.shop_table thead, \
									.woocommerce .cart-collaterals .cart_totals tr:nth-child(2n) td, \
									.woocommerce .cart-collaterals .cart_totals tr:nth-child(2n) th, \
									.woocommerce-page .cart-collaterals .cart_totals tr:nth-child(2n) td, \
									.woocommerce-page .cart-collaterals .cart_totals tr:nth-child(2n) th, \
									#pp_full_res #commentform input, \
									.woocommerce form .form-row input.input-text, \
									.woocommerce-page form .form-row input.input-text, \
									#pp_full_res #commentform textarea, \
									.woocommerce form .form-row textarea, \
									.woocommerce-page form .form-row textarea, \
									.woocommerce .chzn-container .chzn-results, \
									.woocommerce .chzn-container-single .chzn-search, \
									.woocommerce .chzn-container .chzn-results .no-results, \
									.woocommerce-checkout .form-row .chzn-container-single .chzn-search input, \
									.woocommerce #payment, \
									.woocommerce-page #payment \
									{  \
									background-color: #"+hex+"; \
									} \
									";
				jQuery('body').append('<style id="toolbar_second_colors" type="text/css">'+newSkin+'</style>'); 
			}
		});
	});
	var showSecond = false;
	$j('.second_colorSelector, .secondColorSelector .colorpicker_submit').bind('click', function() {
		$j('.secondColorSelector').css({display: showSecond ? 'none' : 'block'});
		$j('.secondColorSelector > div').css({display: showSecond ? 'none' : 'block'});
		showSecond = !showSecond;
	}); 

	$j('.topGradientColorSelector').each(function(){
		var Othis = $j(this).siblings('.colorSelector'); //cache a copy of the this variable for use inside nested function
		var initialColor = $j(Othis).next('input').attr('value');
		$j(this).ColorPicker({
			flat: true,
			color: initialColor,
			onShow: function (colpkr) {
				$j(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$j(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$j(Othis).children('div').css('backgroundColor', '#' + hex);
				$j(Othis).next('input').attr('value','#' + hex);
				if ($j("#toolbar_top_colors").length > 0){
					$j("#toolbar_top_colors").remove();
				}
				if($j('.bottomGradient_colorSelector div').attr('style') == "" || $j('.bottomGradient_colorSelector div').css('backgroundColor') == "transparent"){
					var bottom_color = "0e0e0e";
				}else{
					hexBottom($j('.bottomGradient_colorSelector div').css('background-color'));
					var bottom_color = bottomColor;
				}
				newSkin =".widget.widget_search form input[type='submit'], \
									.title_search form input[type='submit'], \
									.flex-direction-nav .flex-prev, \
									.flex-direction-nav .flex-next \
									{ \
										background-color: #"+bottom_color+"; \
									} \
									.rounded_background, \
									.big-slider-control .control-seek-box, \
									.big-slider-control .control-left, \
									.big-slider-control .control-right, \
									.portfolio_next .next_button, \
									.portfolio_prev .prev_button, \
									.blog_next .next_button, \
									.blog_prev .prev_button, \
									.button, \
									span.submit_button, \
									p.form-submit, \
									.accordion h5 span, \
									.progress_bars .progress_content, \
									.pagination ul li:hover, \
									.pagination ul li.active > span, \
									.circle_item .circle, \
									.square_item .square, \
									.twitter_post .tweet .twitter_controls .twitter_outer, \
									.box_small, \
									.social_menu li a, \
									.footer_bottom .social_menu li a, \
									.tabs .tabs-nav li a, \
									ul.latest_post li .post_date, \
									.title_search form input[type='submit'] \
									{ \
										background-image: -ms-linear-gradient(top, #"+hex+" 0%, #"+bottom_color+" 100%); \
										background-image: -moz-linear-gradient(top, #"+hex+" 0%, #"+bottom_color+" 100%); \
										background-image: -o-linear-gradient(top, #"+hex+" 0%, #"+bottom_color+" 100%); \
										background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #"+hex+"), color-stop(1, #"+bottom_color+")); \
										background-image: -webkit-linear-gradient(top, #"+hex+" 0%, #"+bottom_color+" 100%); \
										background-image: linear-gradient(to bottom, #"+hex+" 0%, #"+bottom_color+" 100%); \
									} \
									.rounded_background_inner, \
									.big-slider-control .control-seek-box-inner, \
									.big-slider-control .control-inner, \
									.portfolio_next .next_button .inner, \
									.portfolio_prev .prev_button .inner, \
									.blog_next .next_button .inner, \
									.blog_prev .prev_button .inner, \
									span.submit_button input, \
									p.form-submit input, \
									.button.small span, \
									.button span, \
									.accordion h5 span .control-inner, \
									.progress_bars .progress_content span, \
									.pagination ul li:hover a, \
									.pagination ul li.active > span, \
									.circle_item .circle span, \
									.square_item .square span, \
									.twitter_post .tweet .twitter_controls .twitter_outer .twitter_prev, \
									.twitter_post .tweet .twitter_controls .twitter_outer .twitter_next, \
									.box_small_inner, \
									.social_menu li a > span, \
									.footer_bottom .social_menu li a > span, \
									.tabs .tabs-nav li a span, \
									ul.latest_post li .post_date span \
									{ \
										filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#"+hex+"', endColorstr='#"+bottom_color+"'); \
									} \
									.woocommerce nav.woocommerce-pagination ul li:hover, \
									.woocommerce-page nav.woocommerce-pagination ul li:hover, \
									.woocommerce nav.woocommerce-pagination ul li.active, \
									.woocommerce-page nav.woocommerce-pagination ul li.active, \
									.woocommerce nav.woocommerce-pagination ul li span.current, \
									.woocommerce-page nav.woocommerce-pagination ul li span.current, \
									.woocommerce #billing_country_chzn, \
									.woocommerce #shipping_country_chzn, \
									.woocommerce .quantity .plus, \
									.woocommerce .quantity .minus, \
									.woocommerce #content .quantity .plus, \
									.woocommerce #content .quantity .minus, \
									.woocommerce-page .quantity .plus, \
									.woocommerce-page .quantity .minus, \
									.woocommerce-page #content .quantity .plus, \
									.woocommerce-page #content .quantity .minus, \
									.woocommerce a.button.alt, \
									.woocommerce button.button.alt, \
									.woocommerce input.button.alt, \
									.woocommerce #respond input#submit.alt, \
									.woocommerce #content input.button.alt, \
									.woocommerce-page a.button.alt, \
									.woocommerce-page button.button.alt, \
									.woocommerce-page input.button.alt, \
									.woocommerce-page #respond input#submit.alt, \
									.woocommerce-page #content input.button.alt, \
									.woocommerce #respond input#submit, \
									.woocommerce-page #respond input#submit, \
									.woocommerce button.button, \
									.woocommerce-page button.button, \
									.woocommerce-message a.button, \
									.woocommerce table.shop_table input.button, \
									.woocommerce-page table.shop_table input.button, \
									.woocommerce-checkout form.login .form-row input.button, \
									.woocommerce-checkout form.checkout_coupon .form-row input.button, \
									.woocommerce-account input.button, \
									.woo_cart_emtpty_button a.button, \
									.woocommerce-account .my_account_orders a.button, \
									.widget_product_search #searchform #searchsubmit, \
									.woocommerce div.product .woocommerce-tabs ul.tabs li a, \
									.woocommerce #content div.product .woocommerce-tabs ul.tabs li a, \
									.woocommerce-page div.product .woocommerce-tabs ul.tabs li a, \
									.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a, \
									.woocommerce nav.woocommerce-pagination ul li span.current, \
									.woocommerce nav.woocommerce-pagination ul li a:hover, \
									.woocommerce nav.woocommerce-pagination ul li a:focus, \
									.woocommerce #content nav.woocommerce-pagination ul li span.current, \
									.woocommerce #content nav.woocommerce-pagination ul li a:hover, \
									.woocommerce #content nav.woocommerce-pagination ul li a:focus, \
									.woocommerce-page nav.woocommerce-pagination ul li span.current, \
									.woocommerce-page nav.woocommerce-pagination ul li a:hover, \
									.woocommerce-page nav.woocommerce-pagination ul li a:focus, \
									.woocommerce-page #content nav.woocommerce-pagination ul li span.current, \
									.woocommerce-page #content nav.woocommerce-pagination ul li a:hover, \
									.woocommerce-page #content nav.woocommerce-pagination ul li a:focus, \
									.widget_shopping_cart_content p.buttons a.button \
									{ \
										background-color: #"+bottom_color+"; \
										background-image: -ms-linear-gradient(top, #"+hex+" 0%, #"+bottom_color+" 100%); \
										background-image: -moz-linear-gradient(top, #"+hex+" 0%, #"+bottom_color+" 100%); \
										background-image: -o-linear-gradient(top, #"+hex+" 0%, #"+bottom_color+" 100%); \
										background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #"+hex+"), color-stop(1, #"+bottom_color+")); \
										background-image: -webkit-linear-gradient(top, #"+hex+" 0%, #"+bottom_color+" 100%); \
										background-image: linear-gradient(to bottom, #"+hex+" 0%, #"+bottom_color+" 100%); \
									} \
									.woocommerce nav.woocommerce-pagination ul li:hover a, \
									.woocommerce-page nav.woocommerce-pagination ul li:hover a, \
									.woocommerce nav.woocommerce-pagination ul li.active > span, \
									.woocommerce-page nav.woocommerce-pagination ul li.active > span, \
									.woocommerce nav.woocommerce-pagination ul li span.current, \
									.woocommerce-page nav.woocommerce-pagination ul li span.current \
									{ \
										filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#"+hex+"', endColorstr='#"+bottom_color+"'); \
									} \
									";
				jQuery('body').append('<style id="toolbar_top_colors" type="text/css">'+newSkin+'</style>'); 
			}
		});
	});
	var showTop = false;
	$j('.topGradient_ColorSelector, .topGradientColorSelector .colorpicker_submit').bind('click', function() {
		$j('.topGradientColorSelector').css({display: showTop ? 'none' : 'block'});
		$j('.topGradientColorSelector > div').css({display: showTop ? 'none' : 'block'});
		showTop = !showTop;
	}); 

	$j('.bottomGradientColorSelector').each(function(){
		var Othis = $j(this).siblings('.colorSelector'); //cache a copy of the this variable for use inside nested function
		var initialColor = $j(Othis).next('input').attr('value');
		$j(this).ColorPicker({
			flat: true,
			color: initialColor,
			onShow: function (colpkr) {
				$j(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$j(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$j(Othis).children('div').css('backgroundColor', '#' + hex);
				$j(Othis).next('input').attr('value','#' + hex);
				if ($j("#toolbar_bottom_colors").length > 0){
					$j("#toolbar_bottom_colors").remove();
				}
				if($j('.topGradient_ColorSelector div').attr('style') == "" || $j('.topGradient_ColorSelector div').css('backgroundColor') == "transparent"){
					var top_color = "4b4b4b";
				}else{
					hexTop($j('.topGradient_ColorSelector div').css('background-color'));
					var top_color = topColor;
				}
				console.log(top_color);
				console.log(hex);
				newSkin =".widget.widget_search form input[type='submit'], \
									.title_search form input[type='submit'], \
									.flex-direction-nav .flex-prev, \
									.flex-direction-nav .flex-next \
									{ \
										background-color: #"+hex+"; \
									} \
									.rounded_background, \
									.big-slider-control .control-seek-box, \
									.big-slider-control .control-left, \
									.big-slider-control .control-right, \
									.portfolio_next .next_button, \
									.portfolio_prev .prev_button, \
									.blog_next .next_button, \
									.blog_prev .prev_button, \
									.button, \
									span.submit_button, \
									p.form-submit, \
									.accordion h5 span, \
									.progress_bars .progress_content, \
									.pagination ul li:hover, \
									.pagination ul li.active > span, \
									.circle_item .circle, \
									.square_item .square, \
									.twitter_post .tweet .twitter_controls .twitter_outer, \
									.box_small, \
									.social_menu li a, \
									.footer_bottom .social_menu li a, \
									.tabs .tabs-nav li a, \
									ul.latest_post li .post_date, \
									.title_search form input[type='submit'] \
									{ \
										background-image: -ms-linear-gradient(top, #"+top_color+" 0%, #"+hex+" 100%); \
										background-image: -moz-linear-gradient(top, #"+top_color+" 0%, #"+hex+" 100%); \
										background-image: -o-linear-gradient(top, #"+top_color+" 0%, #"+hex+" 100%); \
										background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #"+top_color+"), color-stop(1, #"+hex+")); \
										background-image: -webkit-linear-gradient(top, #"+top_color+" 0%, #"+hex+" 100%); \
										background-image: linear-gradient(to bottom, #"+top_color+" 0%, #"+hex+" 100%); \
									} \
									.rounded_background_inner, \
									.big-slider-control .control-seek-box-inner, \
									.big-slider-control .control-inner, \
									.portfolio_next .next_button .inner, \
									.portfolio_prev .prev_button .inner, \
									.blog_next .next_button .inner, \
									.blog_prev .prev_button .inner, \
									span.submit_button input, \
									p.form-submit input, \
									.button.small span, \
									.button span, \
									.accordion h5 span .control-inner, \
									.progress_bars .progress_content span, \
									.pagination ul li:hover a, \
									.pagination ul li.active > span, \
									.circle_item .circle span, \
									.square_item .square span, \
									.twitter_post .tweet .twitter_controls .twitter_outer .twitter_prev, \
									.twitter_post .tweet .twitter_controls .twitter_outer .twitter_next, \
									.box_small_inner, \
									.social_menu li a > span, \
									.footer_bottom .social_menu li a > span, \
									.tabs .tabs-nav li a span, \
									ul.latest_post li .post_date span \
									{ \
										filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#"+top_color+"', endColorstr='#"+hex+"'); \
									} \
									.woocommerce nav.woocommerce-pagination ul li:hover, \
									.woocommerce-page nav.woocommerce-pagination ul li:hover, \
									.woocommerce nav.woocommerce-pagination ul li.active, \
									.woocommerce-page nav.woocommerce-pagination ul li.active, \
									.woocommerce nav.woocommerce-pagination ul li span.current, \
									.woocommerce-page nav.woocommerce-pagination ul li span.current, \
									.woocommerce #billing_country_chzn, \
									.woocommerce #shipping_country_chzn, \
									.woocommerce .quantity .plus, \
									.woocommerce .quantity .minus, \
									.woocommerce #content .quantity .plus, \
									.woocommerce #content .quantity .minus, \
									.woocommerce-page .quantity .plus, \
									.woocommerce-page .quantity .minus, \
									.woocommerce-page #content .quantity .plus, \
									.woocommerce-page #content .quantity .minus, \
									.woocommerce a.button.alt, \
									.woocommerce button.button.alt, \
									.woocommerce input.button.alt, \
									.woocommerce #respond input#submit.alt, \
									.woocommerce #content input.button.alt, \
									.woocommerce-page a.button.alt, \
									.woocommerce-page button.button.alt, \
									.woocommerce-page input.button.alt, \
									.woocommerce-page #respond input#submit.alt, \
									.woocommerce-page #content input.button.alt, \
									.woocommerce #respond input#submit, \
									.woocommerce-page #respond input#submit, \
									.woocommerce button.button, \
									.woocommerce-page button.button, \
									.woocommerce-message a.button, \
									.woocommerce table.shop_table input.button, \
									.woocommerce-page table.shop_table input.button, \
									.woocommerce-checkout form.login .form-row input.button, \
									.woocommerce-checkout form.checkout_coupon .form-row input.button, \
									.woocommerce-account input.button, \
									.woo_cart_emtpty_button a.button, \
									.woocommerce-account .my_account_orders a.button, \
									.widget_product_search #searchform #searchsubmit, \
									.woocommerce div.product .woocommerce-tabs ul.tabs li a, \
									.woocommerce #content div.product .woocommerce-tabs ul.tabs li a, \
									.woocommerce-page div.product .woocommerce-tabs ul.tabs li a, \
									.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a, \
									.woocommerce nav.woocommerce-pagination ul li span.current, \
									.woocommerce nav.woocommerce-pagination ul li a:hover, \
									.woocommerce nav.woocommerce-pagination ul li a:focus, \
									.woocommerce #content nav.woocommerce-pagination ul li span.current, \
									.woocommerce #content nav.woocommerce-pagination ul li a:hover, \
									.woocommerce #content nav.woocommerce-pagination ul li a:focus, \
									.woocommerce-page nav.woocommerce-pagination ul li span.current, \
									.woocommerce-page nav.woocommerce-pagination ul li a:hover, \
									.woocommerce-page nav.woocommerce-pagination ul li a:focus, \
									.woocommerce-page #content nav.woocommerce-pagination ul li span.current, \
									.woocommerce-page #content nav.woocommerce-pagination ul li a:hover, \
									.woocommerce-page #content nav.woocommerce-pagination ul li a:focus, \
									.widget_shopping_cart_content p.buttons a.button \
									{ \
										background-color: #"+hex+"; \
										background-image: -ms-linear-gradient(top, #"+top_color+" 0%, #"+hex+" 100%); \
										background-image: -moz-linear-gradient(top, #"+top_color+" 0%, #"+hex+" 100%); \
										background-image: -o-linear-gradient(top, #"+top_color+" 0%, #"+hex+" 100%); \
										background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #"+top_color+"), color-stop(1, #"+hex+")); \
										background-image: -webkit-linear-gradient(top, #"+top_color+" 0%, #"+hex+" 100%); \
										background-image: linear-gradient(to bottom, #"+top_color+" 0%, #"+hex+" 100%); \
									} \
									.woocommerce nav.woocommerce-pagination ul li:hover a, \
									.woocommerce-page nav.woocommerce-pagination ul li:hover a, \
									.woocommerce nav.woocommerce-pagination ul li.active > span, \
									.woocommerce-page nav.woocommerce-pagination ul li.active > span, \
									.woocommerce nav.woocommerce-pagination ul li span.current, \
									.woocommerce-page nav.woocommerce-pagination ul li span.current \
									{ \
										filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#"+top_color+"', endColorstr='#"+hex+"'); \
									} \
				";
				jQuery('body').append('<style id="toolbar_bottom_colors" type="text/css">'+newSkin+'</style>'); 
			}
		});
	});
	var showBottom = false;
	$j('.bottomGradient_colorSelector, .bottomGradientColorSelector .colorpicker_submit').bind('click', function() {
		$j('.bottomGradientColorSelector').css({display: showBottom ? 'none' : 'block'});
		$j('.bottomGradientColorSelector > div').css({display: showBottom ? 'none' : 'block'});
		showBottom = !showBottom;
	}); 

}); 

var topColor = '';
var bottomColor = '';

function hexTop(colorval) {
    var parts = colorval.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    delete(parts[0]);
    for (var i = 1; i <= 3; ++i) {
        parts[i] = parseInt(parts[i]).toString(16);
        if (parts[i].length == 1) parts[i] = '0' + parts[i];
    }
    topColor = parts.join('');
}

function hexBottom(colorval) {
    var parts = colorval.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    delete(parts[0]);
    for (var i = 1; i <= 3; ++i) {
        parts[i] = parseInt(parts[i]).toString(16);
        if (parts[i].length == 1) parts[i] = '0' + parts[i];
    }
    bottomColor = parts.join('');
}