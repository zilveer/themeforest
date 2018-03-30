jQuery(document).ready(function($) {
	
	/* Menu */
	
	jQuery(".navigation ul li ul").parent("li").addClass("parent-list");
	jQuery(".parent-list").find("a:first").append(" <span class='menu-nav-arrow'><i class='icon-angle-down'></i></span>");
	
	jQuery(".navigation ul a").removeAttr("title");
	jQuery(".navigation ul ul").css({display: "none"});
	jQuery(".navigation ul li").each(function() {	
		var sub_menu = jQuery(this).find("ul:first");
		jQuery(this).hover(function() {	
			sub_menu.stop().css({overflow:"hidden", height:"auto", display:"none", paddingTop:0}).slideDown(250, function() {
				jQuery(this).css({overflow:"visible", height:"auto"});
			});	
		},function() {	
			sub_menu.stop().slideUp(50, function() {	
				jQuery(this).css({overflow:"hidden", display:"none"});
			});
		});	
	});
	
	/* Header fixed */
	
	var aboveHeight   = jQuery("#header").outerHeight();
	var fixed_enabled = jQuery("#wrap").hasClass("fixed-enabled");
	if(fixed_enabled){
		jQuery(window).scroll(function(){
			if(jQuery(window).scrollTop() > aboveHeight) {
				jQuery("#header").css({"top":"0"}).addClass("fixed-nav");
			}else{
				jQuery("#header").css({"top":"auto"}).removeClass("fixed-nav");
			}
		});
	}else {
		jQuery("#header").removeClass("fixed-nav");
	}
	
	/* Mobile */
	
	if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || 
		navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || 
		navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || 
		navigator.userAgent.match(/Windows Phone/i)) { 
		var mobile_device = true; 
	}else { 
		var mobile_device = false; 
	}
	
	/* Header and footer fix mobile */
	
	jQuery(window).bind("resize", function () {
		if (jQuery(this).width() < 465) {
			jQuery(".social_icons").each(function () {
				if (jQuery(this).find("li").length > 10) {
					jQuery(this).find("li i").addClass("font11");
					jQuery(this).find("li i").removeClass("font17");
				}
			});
		}else {
			jQuery(".social_icons").each(function () {
				if (jQuery(this).find("li").length > 10) {
					jQuery(this).find("li i").addClass("font17");
					jQuery(this).find("li i").removeClass("font11");
				}
			});
		}
		
		if (jQuery(this).width() < 767) {
			jQuery(".panel-pop").each(function () {
				var panel_pop = jQuery(this);
				var panel_width = panel_pop.outerWidth();
				if (jQuery("body").hasClass("rtl")) {
					panel_pop.css("margin-right","-"+panel_width/2+"px");
				}else {
					panel_pop.css("margin-left","-"+panel_width/2+"px");
				}
			});
		}
	});
	
	if (jQuery(this).width() < 767) {
		jQuery(".panel-pop").each(function () {
			var panel_pop = jQuery(this);
			var panel_width = panel_pop.outerWidth();
			if (jQuery("body").hasClass("rtl")) {
				panel_pop.css("margin-right","-"+panel_width/2+"px");
			}else {
				panel_pop.css("margin-left","-"+panel_width/2+"px");
			}
		});
	}
	
	if (jQuery(window).width() < 465) {
		jQuery(".social_icons").each(function () {
			if (jQuery(this).find("li").length > 10) {
				jQuery(this).find("li i").addClass("font11");
				jQuery(this).find("li i").removeClass("font17");
			}
		});
	}else {
		jQuery(".social_icons").each(function () {
			if (jQuery(this).find("li").length > 10) {
				jQuery(this).find("li i").addClass("font17");
				jQuery(this).find("li i").removeClass("font11");
			}
		});
	}
	
	jQuery(".navigation > div > ul > li").clone().appendTo('.navigation_mobile > ul');
	
	if (jQuery(".navigation_mobile_click").length) {
		jQuery(".navigation_mobile_click").click(function() {
			if (jQuery(this).hasClass("navigation_mobile_click_close")) {
				jQuery(this).next().slideUp(500);
				jQuery(this).removeClass("navigation_mobile_click_close");
				if (jQuery("#wrap").hasClass("fixed-enabled")) {
					var attr_style = jQuery("#header").attr("style");
					attr_style = attr_style.replace("position","");
					jQuery("#header").attr("style",attr_style);
				}
			}else {
				jQuery(this).next().slideDown(500);
				jQuery(this).addClass("navigation_mobile_click_close");
				if (jQuery("#wrap").hasClass("fixed-enabled")) {
					jQuery("#header").css({"position":"static"});
					jQuery('html,body').animate({scrollTop: jQuery("#wrap").offset().top},"slow");
				}
			}
		});
		
		jQuery(".navigation_mobile ul li").each(function() {	
			var sub_menu = jQuery(this).find("ul:first");
			jQuery(this).find("> a > .menu-nav-arrow").click(function() {
				if (jQuery(this).parent().parent().find("ul").length > 0) {
					if (jQuery(this).parent().parent().find("> ul").hasClass("sub_menu")) {
						jQuery(this).parent().parent().find("> ul").removeClass("sub_menu");
						sub_menu.stop().slideUp(250,function() {	
							jQuery(this).css({overflow:"hidden",display:"none"});
						});
					}else {
						jQuery(this).parent().parent().find("> ul").addClass("sub_menu");
						sub_menu.stop().css({overflow:"hidden",height:"auto",display:"none",paddingTop:0}).slideDown(250,function() {
							jQuery(this).css({overflow:"visible",height:"auto"});
						});
					}
					return false;
				}else {
					return true;
				}
			});	
		});
	}
	
	/* Go up */
	
	jQuery(window).scroll(function () {
		if(jQuery(this).scrollTop() > 100) {
			jQuery(".go-up").css("right","20px");
		}else {
			jQuery(".go-up").css("right","-60px");
		}
	});
	jQuery(".go-up").click(function(){
		jQuery("html,body").animate({scrollTop:0},500);
		return false;
	});
	
	/* Icon boxes */
	
	if (jQuery(".box_warp").length) {
		jQuery(".box_warp").each(function () {
			var box_warp = jQuery(this);
			var box_background = box_warp.attr("box_background");
			var box_color = box_warp.attr("box_color");
			var box_border = box_warp.attr("box_border");
			var box_border_width = box_warp.attr("box_border_width");
			var box_border_radius = box_warp.attr("box_border_radius");
			var box_background_hover = box_warp.attr("box_background_hover");
			var box_color_hover = box_warp.attr("box_color_hover");
			var box_border_hover = box_warp.attr("box_border_hover");
			
			box_warp.css({"background-color":box_background,"border-color":box_border,"color":box_color,"-moz-border-radius":box_border_radius+"px","-webkit-border-radius":box_border_radius+"px","border-radius":box_border_radius+"px"});
			
			if (box_border_width != "") {
				box_warp.css("border",box_border_width+"px solid "+box_border);
			}
			
			box_warp.find("a").not(".button").css({"color":box_color});
			
			box_warp.hover(function () {
				box_warp.css({"background-color":box_background_hover,"border-color":box_border_hover,"color":box_color_hover});
				box_warp.find("a").not(".button").css({"color":box_color_hover});
			},function () {
				box_warp.css({"background-color":box_background,"border-color":box_border,"color":box_color});
				box_warp.find("a").not(".button").css({"color":box_color});
			});
		});
	}
	
	if (jQuery(".box_icon").length) {
		jQuery(".box_icon").each(function () {
			var box_icon = jQuery(this);
			var icon_align = box_icon.find(".icon_i > span").attr("icon_align");
			var icon_size = box_icon.find(".icon_i > span").attr("icon_size");
			
			if (box_icon.find(".icon_i > span").hasClass("icon_soft_r") || box_icon.find(".icon_i > span").hasClass("icon_square") || box_icon.find(".icon_i > span").hasClass("icon_circle")) {
				box_icon.find(".icon_i > span").css({"height":icon_size+"px","width":icon_size+"px","font-size":icon_size/2+"px","line-height":icon_size+"px"});
				box_icon.find(".icon_i > span > span").css({"margin":0,"text-align":"center"}).parent().css({"line-height":icon_size+"px"});
			}else if (box_icon.find(".box_text h3 > span").hasClass("icon_soft_r") || box_icon.find(".box_text h3 > span").hasClass("icon_square") || box_icon.find(".box_text h3 > span").hasClass("icon_circle")) {
				if (icon_size > 80 && box_icon.find(".box_text h3 > span > span").length == 1) {
					var icon_size = 80;
				}
				box_icon.find(".box_text h3 > span").css({"height":icon_size+"px","width":icon_size+"px","line-height":icon_size+"px"});
			}else {
				box_icon.find(".icon_i > span i").css({"font-size":icon_size/2+"px"});
			}
			
			if (icon_align == "left") {
				box_icon.find(".icon_i").css({"display":"inherit"});
				if (box_icon.find(".icon_i > span").hasClass("icon_soft_r") || box_icon.find(".icon_i > span").hasClass("icon_square") || box_icon.find(".icon_i > span").hasClass("icon_circle")) {
					box_icon.find(".box_text").css({"padding-left":parseFloat(icon_size)+25+"px"});
				}else if (box_icon.find(".icon_i span[class^='icons']").length == 1) {
					box_icon.find(".box_text").css({"padding-left":41+"px"});
				}else {
					box_icon.find(".box_text").css({"padding-left":parseFloat(icon_size/2)+15+"px"});
				}
				
				box_icon.find(".icon_i > span").addClass("f_left");
			}else if (icon_align == "right") {
				box_icon.find(".icon_i").css({"display":"inherit"});
				
				if (box_icon.find(".icon_i > span").hasClass("icon_soft_r") || box_icon.find(".icon_i > span").hasClass("icon_square") || box_icon.find(".icon_i > span").hasClass("icon_circle")) {
					box_icon.find(".box_text").css({"padding-right":parseFloat(icon_size)+25+"px"});
				}else if (box_icon.find(".icon_i span[class^='icons']").length == 1) {
					box_icon.find(".box_text").css({"padding-right":41+"px"});
				}else {
					box_icon.find(".box_text").css({"padding-right":parseFloat(icon_size/2)+15+"px"});
				}
				
				box_icon.find(".icon_i > span").addClass("f_right");
			}else if (icon_align == "center") {
				box_icon.find(".icon_i").addClass("t_center");
			}
		});
	}
	
	if (jQuery(".box_icon").length) {
		jQuery(".box_icon").each(function() {
			var this_icon = jQuery(this);
			var span_bg = this_icon.find(".icon_i > span").attr("span_bg");
			if (span_bg != undefined) {
				this_icon.find(".icon_i > span").css({"background-color":span_bg});
			}else {
				var span_bg = this_icon.find(".box_text h3 > span").attr("span_bg");
				this_icon.find(".box_text h3 > span").css({"background-color":span_bg});
			}
			var i_color = this_icon.find(".icon_i > span i").attr("i_color");
			if (i_color != undefined) {
				this_icon.find(".icon_i > span i").css({"color":i_color});
			}
			var border_radius = this_icon.find(".icon_i > span").attr("border_radius");
			if (border_radius != undefined) {
				this_icon.find(".icon_i > span").css({"-moz-border-radius":border_radius+"px","-webkit-border-radius":border_radius+"px","border-radius":border_radius+"px"});
			}
			
			var border_color = this_icon.find(".icon_i > span").attr("border_color");
			if (border_color != undefined) {
				this_icon.find(".icon_i > span").css({"border-color":border_color});
				this_icon.find(".box_text h3 > span").css({"border-color":border_color});
			}else {
				var border_color = this_icon.find(".box_text h3 > span").attr("border_color");
				this_icon.find(".box_text h3 > span").css({"border-color":border_color});
			}
			var border_width = this_icon.find(".icon_i > span").attr("border_width");
			if (border_width != undefined) {
				this_icon.find(".icon_i > span").css({"border-width":border_width+"px","border-style":"solid"});
			}else {
				var border_width = this_icon.find(".box_text h3 > span").attr("border_width");
				this_icon.find(".box_text h3 > span").css({"border-width":border_width+"px","border-style":"solid"});
			}
		
			this_icon.hover(function () {
				var span_hover = this_icon.find(".icon_i > span").attr("span_hover");
				if (span_hover != undefined) {
					this_icon.find(".icon_i > span").css({"background-color":span_hover});
				}else {
					var span_hover = this_icon.find(".box_text h3 > span").attr("span_hover");
					this_icon.find(".box_text h3 > span").css({"background-color":span_hover});
				}
				var border_hover = this_icon.find(".icon_i > span").attr("border_hover");
				if (border_hover != undefined) {
					this_icon.find(".icon_i > span").css({"border-color":border_hover});
				}else {
					var border_hover = this_icon.find(".box_text h3 > span").attr("border_hover");
					this_icon.find(".box_text h3 > span").css({"border-color":border_hover});
				}
				var i_hover = this_icon.find(".icon_i > span i").attr("i_hover");
				if (i_hover != undefined) {
					this_icon.find(".icon_i > span i").css({"color":i_hover});
				}
				
				if (this_icon.find(".button").length) {
					var button_background_hover = this_icon.find(".button").attr("button_background_hover");
					var button_color_hover = this_icon.find(".button").attr("button_color_hover");
					var button_border_hover = this_icon.find(".button").attr("button_border_hover");
					this_icon.find(".button").css({"background-color":button_background_hover,"color":button_color_hover,"border-color":button_border_hover});
				}
			},function() {
				if (i_color != undefined) {
					this_icon.find(".icon_i > span i").css({"color":i_color});
				}
				var span_bg = this_icon.find(".icon_i > span").attr("span_bg");
				if (span_bg != undefined) {
					this_icon.find(".icon_i > span").css({"background-color":span_bg});
				}else {
					var span_bg = this_icon.find(".box_text h3 > span").attr("span_bg");
					this_icon.find(".box_text h3 > span").css({"background-color":span_bg});
				}
				var border_color = this_icon.find(".icon_i > span").attr("border_color");
				if (border_color != undefined) {
					this_icon.find(".icon_i > span").css({"border-color":border_color});
				}else {
					var border_color = this_icon.find(".box_text h3 > span").attr("border_color");
					this_icon.find(".box_text h3 > span").css({"border-color":border_color});
				}
				if (this_icon.find(".button").length) {
					var button_background = this_icon.find(".button").attr("button_background");
					var button_color = this_icon.find(".button").attr("button_color");
					var button_border = this_icon.find(".button").attr("button_border");
					this_icon.find(".button").css({"background-color":button_background,"color":button_color,"border-color":button_border});
				}
			});
			
		});
	}
	
	/* Icons */
	
	if (jQuery(".icon_i").length) {
		jQuery(".icon_i").each(function() {
			var this_icon = jQuery(this);
			if (!this_icon.parent().hasClass("box_icon") && !this_icon.parent().parent().hasClass("box_icon") && !this_icon.parent().parent().parent().hasClass("box_icon")) {
				var span_bg = this_icon.find("> span").attr("span_bg");
				var icon_align = this_icon.find("> span").attr("icon_align");
				var icon_size = this_icon.find("> span").attr("icon_size");
				var border_color = this_icon.find("> span").attr("border_color");
				var border_width = this_icon.find("> span").attr("border_width");
				var border_radius = this_icon.find("> span").attr("border_radius");
				var span_hover = this_icon.find("> span").attr("span_hover");
				var border_hover = this_icon.find("> span").attr("border_hover");
				var i_color = this_icon.find("> span i").attr("i_color");
				var i_hover = this_icon.find("> span i").attr("i_hover");
				
				if (this_icon.find("> span").hasClass("icon_soft_r") || this_icon.find("> span").hasClass("icon_square") || this_icon.find("> span").hasClass("icon_circle")) {
					this_icon.find("> span").css({"height":icon_size+"px","width":icon_size+"px","font-size":icon_size/2+"px","line-height":icon_size+"px"});
					this_icon.find("> span > span").css({"margin":0,"text-align":"center"});
				}else {
					this_icon.find("> span i").css({"font-size":icon_size/2+"px"});
				}
				
				if (icon_align == "left") {
					this_icon.addClass("f_left");
				}else if (icon_align == "right") {
					this_icon.addClass("f_right");
				}else if (icon_align == "center") {
					this_icon.addClass("t_center");
					this_icon.css("margin-bottom","15px");
				}
				
				if (this_icon.find("> span").hasClass("icon_soft_r") || this_icon.find("> span").hasClass("icon_square") || this_icon.find("> span").hasClass("icon_circle")) {
					this_icon.find("> span").css({"background-color":span_bg,"border-color":border_color,"border-width":border_width+"px","border-style":"solid","-moz-border-radius":border_radius+"px","-webkit-border-radius":border_radius+"px","border-radius":border_radius+"px"});
				}
				this_icon.find("> span i").css({"color":i_color});
			
				this_icon.hover(function () {
					if (this_icon.find("> span").hasClass("icon_soft_r") || this_icon.find("> span").hasClass("icon_square") || this_icon.find("> span").hasClass("icon_circle")) {
						this_icon.find("> span").css({"background-color":span_hover,"border-color":border_hover});
					}
					this_icon.find("> span i").css({"color":i_hover});
			
				},function() {
					if (this_icon.find("> span").hasClass("icon_soft_r") || this_icon.find("> span").hasClass("icon_square") || this_icon.find("> span").hasClass("icon_circle")) {
						this_icon.find("> span").css({"background-color":span_bg,"border-color":border_color});
					}
					this_icon.find("> span i").css({"color":i_color});
				});
			}
		});
	}
	
	/* Section */
	
	if (jQuery(".section-warp").length) {
		jQuery(".section-warp").each(function () {
			var section = jQuery(this);
			var section_background_color = section.attr("section_background_color");
			var section_background = section.attr("section_background");
			var section_background_size = section.attr("section_background_size");
			var section_color = section.attr("section_color");
			var section_color_a = section.attr("section_color_a");
			var section_padding_top = section.attr("section_padding_top");
			var section_padding_bottom = section.attr("section_padding_bottom");
			var section_margin_top = section.attr("section_margin_top");
			var section_margin_bottom = section.attr("section_margin_bottom");
			var section_border_top = section.attr("section_border_top");
			var section_border_bottom = section.attr("section_border_bottom");
			
			if (section_background != "" && section_background != undefined) {
				section.css({"background-image":"url("+section_background+")"});
			}
	
			section.css({"background-size":section_background_size,"background-color":section_background_color,"color":section_color,"padding-top":section_padding_top+"px","padding-bottom":section_padding_bottom+"px","margin-top":section_margin_top+"px","margin-bottom":section_margin_bottom+"px"});
			section.find("h1").css({"color":section_color});
			section.find("h2").css({"color":section_color});
			section.find("h3").css({"color":section_color});
			section.find("h4").css({"color":section_color});
			section.find("h5").css({"color":section_color});
			section.find("h6").css({"color":section_color});
			section.find("p").css({"color":section_color});
			section.find("a").not(".button").css({"color":section_color_a});
			if (section_border_top != "") {
				section.css({"border-top":"1px solid "+section_border_top});
			}
			if (section_border_bottom != "") {
				section.css({"border-bottom":"1px solid "+section_border_bottom});
			}
		});
	}
	
	/* Accordion & Toggle */
	
	if (jQuery(".accordion").length) {
		jQuery(".accordion").each(function(){
			if (jQuery(this).hasClass("toggle-accordion")) {
				jQuery(this).find(".accordion-toggle-open").addClass("active");
				jQuery(this).find(".accordion-toggle-open").next(".accordion-inner").show();
			}else {
				var what_active = jQuery(this).attr("what-active");
				if (what_active != undefined) {
					jQuery(this).find(".accordion-inner:nth-child("+what_active * 2+")").show();
					jQuery(this).find(".accordion-inner:nth-child("+what_active * 2+")").prev().addClass("active");
				}
			}
		});
		
		jQuery(".accordion .accordion-title").each(function(){
			//i_color
			var i_color = jQuery(this).parent().attr("i_color");
			jQuery(this).parent().find(".accordion-title i").css({"color":i_color});
			//i_click
			var i_click = jQuery(this).parent().attr("i_click");
			jQuery(this).parent().find(".accordion-title.active i").css({"color":i_click});
		
			jQuery(this).click(function() {
				if (jQuery(this).parent().hasClass("toggle-accordion")) {
					jQuery(this).parent().find("li:first .accordion-title").addClass("active");
					jQuery(this).toggleClass("active");
					jQuery(this).next(".accordion-inner").slideToggle();
				}else {
					if (jQuery(this).next().is(":hidden")) {
						jQuery(this).parent().find(".accordion-title").removeClass("active").next().slideUp(200);
						jQuery(this).toggleClass("active").next().slideDown(200);
					}
				}
				if (jQuery(this).parent().hasClass("acc-style-4")) {
					jQuery(this).parent().find(".accordion-title.active").next().css({"border-bottom":"1px solid #DEDEDE"});
				}
				//i_color
				jQuery(this).parent().find(".accordion-title i").css({"color":i_color});
				//i_click
				jQuery(this).parent().find(".accordion-title.active i").css({"color":i_click});
				return false;
			});
		
		});
	}
	
	/* Tabs */
	
	if (jQuery(".tab-inner-warp").length > 0) {
		jQuery("ul.tabs").tabss(".tab-inner-warp",{effect:"slide",fadeInSpeed:100});
	}
	
	var question_tab_value = '';
	if (typeof(localStorage) != 'undefined') {
		question_tab_value = localStorage.getItem(question_tab);
	}
	
	if (question_tab_value != '' && jQuery(".question-tab .tabs a[data-js='"+question_tab_value+"']").length) {
		jQuery(".question-tab .tabs a[data-js='"+question_tab_value+"']").click();
	}
	
	jQuery('.question-tab .tabs a').click(function(evt) {
		evt.preventDefault();
		if (typeof(localStorage) != 'undefined') {
			localStorage.setItem(question_tab, jQuery(this).attr('data-js'));
		}
	});
	
	if (jQuery(".ul.tabs li").length) {
		jQuery("ul.tabs li").each(function(){
			//i_color
			var i_color = jQuery(this).parent().parent().attr("i_color");
			jQuery(this).find("a i").css({"color":i_color});
			//i_click
			var i_click = jQuery(this).parent().parent().attr("i_click");
			jQuery(this).find("a.current i").css({"color":i_click});
			
			jQuery(this).find("a").hover(function () {
				jQuery(this).find("i").css({"color":i_click});
			},function () {
				if (jQuery(this).hasClass("current")) {
					jQuery(this).find("i").css({"color":i_click});
				}else {
					jQuery(this).find("i").css({"color":i_color});
				}
			});
			
			if (!jQuery(this).parent().parent().hasClass("woocommerce-tabs")) {
				jQuery(this).click(function() {
					//i_color
					var i_color = jQuery(this).parent().parent().attr("i_color");
					jQuery(this).parent().find("a i").css({"color":i_color});
					//i_click
					var i_click = jQuery(this).parent().parent().attr("i_click");
					jQuery(this).find("a.current i").css({"color":i_click});
					return false;
				});
		
				var tab_width = jQuery(this).parent().parent().attr("tab_width");
				if (jQuery(this).parent().parent().hasClass("tabs-vertical")) {
					jQuery(this).parent().css({"width":tab_width+"px"});
					jQuery(this).parent().parent().find("div.tab-inner-warp").css({"margin-left":tab_width+"px"});
				}
			}
			
		});
	}
	
	/* Button */
	
	if (jQuery(".button").length) {
		jQuery(".button").each(function () {
			var button = jQuery(this);
			var button_background = button.attr("button_background");
			var button_background_hover = button.attr("button_background_hover");
			var button_color = button.attr("button_color");
			var button_color_hover = button.attr("button_color_hover");
			var button_border = button.attr("button_border");
			var button_border_hover = button.attr("button_border_hover");
			var button_border_width = button.attr("button_border_width");
			var button_border_radius = button.attr("button_border_radius");
			
			button.css({"background-color":button_background,"color":button_color,"border":button_border_width+"px solid "+button_border,"-moz-border-radius":button_border_radius+"px","-webkit-border-radius":button_border_radius+"px","border-radius":button_border_radius+"px"});
			
			button.hover(function () {
			button.css({"background-color":button_background_hover,"color":button_color_hover,"border-color":button_border_hover});
			},function () {
				button.css({"background-color":button_background,"color":button_color,"border":button_border_width+"px solid "+button_border,"-moz-border-radius":button_border_radius+"px","-webkit-border-radius":button_border_radius+"px","border-radius":button_border_radius+"px"});
			});
		});
	}
	
	/* Lists */
	
	if (jQuery(".ul_list").length) {
		jQuery(".ul_list").each(function () {
			var ul_list = jQuery(this);
			var list_background = ul_list.attr("list_background");
			var list_background_hover = ul_list.attr("list_background_hover");
			var list_color = ul_list.attr("list_color");
			var list_color_hover = ul_list.attr("list_color_hover");
			var list_border_radius = ul_list.attr("list_border_radius");
	
			if (ul_list.hasClass("ul_list_circle") || ul_list.hasClass("ul_list_square")) {
				ul_list.find("ul li i").css({"background-color":list_background,"-moz-border-radius":list_border_radius+"px","-webkit-border-radius":list_border_radius+"px","border-radius":list_border_radius+"px"});
				ul_list.find("ul li").hover(function () {
					jQuery(this).find("i").css({"background-color":list_background_hover});
				},function () {
					jQuery(this).find("i").css({"background-color":list_background});
				});
			}
			ul_list.find("ul li i").css({"color":list_color});
	
			ul_list.find("ul li").hover(function () {
				jQuery(this).find("i").css({"color":list_color_hover});
			},function () {
				jQuery(this).find("i").css({"color":list_color});
			});
			ul_list.find("i").each(function () {
				var ul_l = jQuery(this);
				var l_background = ul_l.attr("l_background");
				var l_background_hover = ul_l.attr("l_background_hover");
				var l_color = ul_l.attr("l_color");
				var l_color_hover = ul_l.attr("l_color_hover");
				var l_border_radius = ul_l.attr("l_border_radius");
				
				if (ul_l.hasClass("ul_l_circle") || ul_l.hasClass("ul_l_square")) {
					ul_l.css({"background-color":l_background,"-moz-border-radius":l_border_radius+"px","-webkit-border-radius":l_border_radius+"px","border-radius":l_border_radius+"px"});
					ul_l.parent().hover(function () {
						ul_l.css({"background-color":l_background_hover});
					},function () {
						ul_l.css({"background-color":l_background});
					});
				}
				
				ul_l.css({"color":l_color});
		
				ul_l.parent().hover(function () {
					ul_l.css({"color":l_color_hover});
				},function () {
					ul_l.css({"color":l_color});
				});
			});
		});
	}
	
	/* Quote */
	
	if (jQuery("blockquote").length) {
		jQuery("blockquote").each(function () {
			var blockquote = jQuery(this);
			var blockquote_background = blockquote.attr("blockquote_background");
			var blockquote_color = blockquote.attr("blockquote_color");
			var blockquote_border = blockquote.attr("blockquote_border");
			
			blockquote.css({"background-color":blockquote_background,"color":blockquote_color,"border-color":blockquote_border});
		});
	}
	
	/* Dropcap */
	
	if (jQuery(".dropcap").length) {
		jQuery(".dropcap").each(function () {
			var dropcap = jQuery(this);
			var dropcap_background = dropcap.attr("dropcap_background");
			var dropcap_color = dropcap.attr("dropcap_color");
			var dropcap_border_radius = dropcap.attr("dropcap_border_radius");
			
			if (dropcap_border_radius != "" && dropcap_border_radius != undefined) {
				dropcap.css({"-moz-border-radius":dropcap_border_radius+"px","-webkit-border-radius":dropcap_border_radius+"px","border-radius":dropcap_border_radius+"px"});
			}
			dropcap.css({"background-color":dropcap_background,"color":dropcap_color});
		});
	}
	
	/* Divider */
	
	if (jQuery(".divider").length) {
		jQuery(".divider").each(function () {
			var divider = jQuery(this);
			var divider_color = divider.attr("divider_color");
			
			divider.css({"border-bottom-color":divider_color});
		});
	}
	
	/* Progress Bar */
	
	if (jQuery(".progressbar-percent").length) {
		jQuery(".progressbar-percent").each(function(){
			var $this = jQuery(this);
			var percent = $this.attr("attr-percent");
			$this.bind("inview", function(event, isInView, visiblePartX, visiblePartY) {
				if (isInView) {
					$this.animate({ "width" : percent + "%"}, percent*20);
				}
			});
		});
	}
	
	/* Testimonial */
	
	if (jQuery(".testimonial-warp").length) {
		jQuery(".testimonial-warp").each(function () {
			var testimonial = jQuery(this);
			var testimonial_background = testimonial.attr("testimonial_background");
			var testimonial_color = testimonial.attr("testimonial_color");
			var testimonial_border = testimonial.attr("testimonial_border");
			var border_radius = testimonial.attr("border_radius");
			var client_color = testimonial.attr("client_color");
			var jop_color = testimonial.attr("jop_color");
			
			testimonial.find(".testimonial").css({"background-color":testimonial_background,"color":testimonial_color,"border-color":testimonial_border,"-moz-border-radius":border_radius+"px","-webkit-border-radius":border_radius+"px","border-radius":border_radius+"px"});
			testimonial.find(".testimonial a").css({"color":testimonial_color});
			testimonial.find(".testimonial-f-arrow").css({"border-top-color":testimonial_border});
			testimonial.find(".testimonial-l-arrow").css({"border-top-color":testimonial_background});
	
			testimonial.find(".testimonial-client > span").css({"color":client_color});
			testimonial.find(".testimonial-client > span > span").css({"color":jop_color});
		});
	}
	
	/* Callout */
	
	if (jQuery(".callout_warp").length) {
		jQuery(".callout_warp").each(function () {
			var callout_warp = jQuery(this);
			if (callout_warp.find(".button_right").length == 1) {
				callout_warp.find(".callout_inner").css("margin-right",parseFloat(callout_warp.find(".button_right").outerWidth())+25);
				var button_css_top = (((parseFloat(callout_warp.innerHeight()))/2))-parseFloat(callout_warp.find(".button_right").innerHeight())/2;
				callout_warp.find(".button_right").css("top",button_css_top);
			}
		});
	}
	
	/* Flex slider */
	
	if (jQuery(".blog_silder").length && jQuery()) {
		var flex_slider = jQuery(".blog_silder");
		flex_slider.flexslider({
			animation: "fade",//fade - slide
			animationLoop: true,
			slideshow: true,
			slideshowSpeed: 3000,
			animationSpeed: 800,
			pauseOnHover: true,
			pauseOnAction:true,
			controlNav: false,
			directionNav: true,
		});
	}
	
	if (jQuery(".flex-slider").length && jQuery()) {
		var flex_slider = jQuery(".flex-slider");
		flex_slider.flexslider({
			animation: "fade",//fade - slide
			animationLoop: true,
			slideshow: true,
			slideshowSpeed: 3000,
			animationSpeed: 800,
			pauseOnHover: true,
			pauseOnAction: true,
			controlNav: true,
			directionNav: true,
		});
	}
	
	/* Tipsy */
	
	jQuery(".tooltip-n").tipsy({fade:true,gravity:"s"});
	jQuery(".tooltip-s").tipsy({fade:true,gravity:"n"});
	jQuery(".tooltip-nw").tipsy({fade:true,gravity:"nw"});
	jQuery(".tooltip-ne").tipsy({fade:true,gravity:"ne"});
	jQuery(".tooltip-w").tipsy({fade:true,gravity:"w"});
	jQuery(".tooltip-e").tipsy({fade:true,gravity:"e"});
	jQuery(".tooltip-sw").tipsy({fade:true,gravity:"sw"});
	jQuery(".tooltip-se").tipsy({fade:true,gravity:"se"});
	
	/* Ask Question */
	
	if (jQuery(".ask-me .ask-question,.publish-question.publish-question-widget").length) {
		jQuery(".ask-me .ask-question,.publish-question.publish-question-widget").click(function () {
			jQuery(".loader").fadeIn(500);
			var question_title = jQuery("#question_title").val();
			jQuery.get(add_question,question_title,function () {
				window.location.href = add_question+"?question_title="+question_title;
				jQuery(".the-title").val(question_title);
			})
			return false;
		});
	}
	
	function getParameterByName(name) {
	    name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
	    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	        results = regex.exec(location.search);
	    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}
	
	if (getParameterByName("question_title") != "") {
		jQuery(".the-title").val(getParameterByName("question_title"));
	}
	
	if (jQuery(".question_tags,.post_tag").length) {
		jQuery('.question_tags,.post_tag').tag();
	}
	
	var question_poll = jQuery(".question_poll:checked").length;
	if (question_poll == 1) {
		jQuery(".poll_options").slideDown(500);
	}else {
		jQuery(".poll_options").slideUp(500);
	}
	
	if (jQuery(".question_poll").length) {
		jQuery(".question_poll").click(function () {
			var question_poll_c = jQuery(".question_poll:checked").length;
			if (question_poll_c == 1) {
				jQuery(".poll_options").slideDown(500);
			}else {
				jQuery(".poll_options").slideUp(500);
			}
		});
	}
	
	if (jQuery(".question_polls_item").length) {
		jQuery(".question_polls_item").sortable({placeholder: "ui-state-highlight"});
	}
	
	if (jQuery(".question_upload_item").length) {
		jQuery(".question_upload_item").sortable({placeholder: "ui-state-highlight"});
	}
	
	if (jQuery(".add_poll_button_js").length) {
		jQuery(".add_poll_button_js").click(function() {
			jQuery(this).parent().parent().find('.question_poll_item').append('<li id="poll_li_'+nextli+'"><div class="poll-li"><p><input id="ask['+nextli+'][title]" class="ask" name="ask['+nextli+'][title]" value="" type="text"></p><input id="ask['+nextli+'][value]" name="ask['+nextli+'][value]" value="" type="hidden"><input id="ask['+nextli+'][id]" name="ask['+nextli+'][id]" value="'+nextli+'" type="hidden"><div class="del-poll-li"><i class="icon-remove"></i></div><div class="move-poll-li"><i class="icon-fullscreen"></i></div></div></li>');
			jQuery('#poll_li_'+nextli).hide().fadeIn();
			nextli++;
			jQuery(".del-poll-li").click(function() {
				jQuery(this).parent().parent().addClass('removered').fadeOut(function() {
					jQuery(this).remove();
				});
			});
			return false;
		});
	}
	
	if (jQuery(".del-poll-li").length) {
		jQuery(".del-poll-li").click(function() {
			jQuery(this).parent().parent().addClass('removered').fadeOut(function() {
				jQuery(this).remove();
			});
		});
	}
	
	if (jQuery(".fileinputs").length) {
		jQuery(".fileinputs input[type='file']").change(function () {
			var file_fake = jQuery(this);
			file_fake.parent().find("button").text(file_fake.val());
		});
	}
	
	if (jQuery(".fakefile").length) {
		jQuery(".fakefile").click(function () {
			jQuery(this).parent().find("input[type='file']").click();
		});
	}
	
	if (jQuery(".video_description_input,.video_description").length) {
		var video_description = jQuery(".video_description_input:checked").length;
		if (video_description == 1) {
			jQuery(".video_description").slideDown(300);
		}else {
			jQuery(".video_description").slideUp(300);
		}
		
		jQuery(".video_description_input").click(function () {
			var video_description_c = jQuery(".video_description_input:checked").length;
			if (video_description_c == 1) {
				jQuery(".video_description").slideDown(300);
			}else {
				jQuery(".video_description").slideUp(300);
			}
		});
	}
	
	if (jQuery(".ask-question-link").length) {
		jQuery(".ask-question-link").click(function () {
			jQuery(".panel-pop").animate({"top":"-100%"},10).hide();
			jQuery("#ask-question").show().animate({"top":"2%"},500);
			jQuery("html,body").animate({scrollTop:0},500);
			jQuery("body").prepend("<div class='wrap-pop'></div>");
			wrap_pop();
			return false;
		});
	}
	
	if (jQuery(".add_upload_button_js").length) {
		jQuery(".add_upload_button_js").click(function() {
			jQuery(this).parent().parent().find('.question_poll_item').append('<li id="poll_li_'+next_attachment+'"><div class="poll-li"><div class="fileinputs"><input type="file" class="file" name="attachment_m['+next_attachment+'][file_url]" id="attachment_m['+next_attachment+'][file_url]"><div class="fakefile"><button type="button" class="button small margin_0">'+select_file+'</button><span><i class="icon-arrow-up"></i>'+browse+'</span></div><div class="del-poll-li"><i class="icon-remove"></i></div><div class="move-poll-li"><i class="icon-fullscreen"></i></div></div></div></li>');
			jQuery(".fileinputs input[type='file']").change(function () {
				var file_fake = jQuery(this);
				file_fake.parent().find("button").text(file_fake.val());
			});
			jQuery(".fakefile").click(function () {
				jQuery(this).parent().find("input[type='file']").click();
			});
			jQuery('#poll_li_'+next_attachment).hide().fadeIn();
			next_attachment++;
			jQuery(".del-poll-li").click(function() {
				jQuery(this).parent().parent().parent().fadeOut(function() {
					jQuery(this).remove();
				});
			});
			return false;
		});
	}
	
	if (jQuery(".the-details").length) {
		jQuery("#wp-question-details-wrap").appendTo(".the-details");
		jQuery("#wp-post-details-wrap").appendTo(".the-details");
	}
	
	/* single question */
	
	if (jQuery(".share-inside").length) {
		jQuery(".share-inside").click(function () {
			if (jQuery(".share-inside-warp").hasClass("share-inside-show")) {
				jQuery(".share-inside-warp").slideUp("500");
				jQuery(".share-inside-warp").removeClass("share-inside-show");
			}else {
				jQuery(".share-inside-warp").slideDown("500");
				jQuery(".share-inside-warp").addClass("share-inside-show");
			}
		});
	}
	
	if (jQuery(".single-question.question").length > 0 && (jQuery(".question-edit").length > 0 || jQuery(".question-delete").length > 0 || jQuery(".question-follow").length > 0 || jQuery(".question-close").length > 0)) {
		jQuery(".single-question.question").hover(function () {
			jQuery(this).find(".edit-delete-follow-close").slideDown(500);
		},function () {
			jQuery(this).find(".edit-delete-follow-close").slideUp(500);
		});
	}
	
	if (jQuery(".post-delete").length) {
		jQuery(".post-delete").click(function () {
			if (confirm(sure_delete_post)) {
				return true;
			}else {
				return false;
			}
		});
	}
	
	if (jQuery(".question-follow a").length) {
		jQuery(".question-follow a").click(function () {
			question_follow = jQuery(this);
			if (jQuery(".edit-delete-follow-close-2").length > 0) {
				post_id = question_follow.parent().parent().parent().parent().parent().attr('id');
			}else {
				post_id = question_follow.parent().parent().parent().parent().attr('id');
			}
			post_id = post_id.replace("post-","");
			question_follow.hide();
			if (question_follow.hasClass("unfollow-question")) {
				jQuery.ajax({
					url: admin_url,
					type: "POST",
					data: { action : 'question_unfollow', post_id : post_id },
					success:function(data) {
						question_follow.removeClass("unfollow-question");
						question_follow.find("i").addClass("icon-circle-arrow-up");
						question_follow.find("i").removeClass("icon-circle-arrow-down");
						question_follow.attr("original-title",follow_question_attr);
						question_follow.text(follow_question);
						question_follow.show();
					}
				});
			}else {
				jQuery.ajax({
					url: admin_url,
					type: "POST",
					data: { action : 'question_follow', post_id : post_id },
					success:function(data) {
						question_follow.addClass("unfollow-question");
						question_follow.find("i").removeClass("icon-circle-arrow-up");
						question_follow.find("i").addClass("icon-circle-arrow-down");
						question_follow.attr("original-title",unfollow_question_attr);
						question_follow.text(unfollow_question);
						question_follow.show();
					}
				});
			}
			return false;
		});
	}
	
	if (jQuery(".question-close a").length) {
		jQuery(".question-close a").click(function () {
			question_close = jQuery(this);
			if (jQuery(".edit-delete-follow-close-2").length > 0) {
				post_id = question_close.parent().parent().parent().parent().parent().attr('id');
			}else {
				post_id = question_close.parent().parent().parent().parent().attr('id');
			}
			post_id = post_id.replace("post-","");
			question_close.hide();
			jQuery.ajax({
				url: admin_url,
				type: "POST",
				data: { action : 'question_close', post_id : post_id },
				success:function(data) {
					location.reload();
				}
			});
			return false;
		});
	}
	
	if (jQuery(".question-open a").length) {
		jQuery(".question-open a").click(function () {
			question_open = jQuery(this);
			if (jQuery(".edit-delete-follow-close-2").length > 0) {
				post_id = question_open.parent().parent().parent().parent().parent().attr('id');
			}else {
				post_id = question_open.parent().parent().parent().parent().attr('id');
			}
			post_id = post_id.replace("post-","");
			question_open.hide();
			jQuery.ajax({
				url: admin_url,
				type: "POST",
				data: { action : 'question_open', post_id : post_id },
				success:function(data) {
					location.reload();
				}
			});
			return false;
		});
	}
	
	if (jQuery(".question-delete a").length) {
	jQuery(".question-delete a").click(function () {
		if (confirm(sure_delete)) {
			return true;
		}else {
			return false;
		}
	});
	}
	
	if (jQuery("li.comment").length) {
		jQuery(".best_answer_re").live("click",function() {
			best_answer_re = this;
			comment_id = jQuery(this).parent().parent().attr('id');
			comment_id = comment_id.replace("comment-","");
			
			jQuery(".best_answer_re").hide();
			jQuery(best_answer_re).parent().find(" > .loader_3").show();
			
			jQuery.ajax({
				url: admin_url,
				type: "POST",
				data: { action : 'best_answer_re', comment_id : comment_id },
				success:function(data) {
					jQuery(best_answer_re).parent().parent().parent().removeClass("comment-best-answer");
					jQuery(best_answer_re).parent().find(" > .loader_3").hide();
					jQuery(best_answer_re).parent().find("div.commentform.question-answered").remove();
					jQuery(".comment-body .text").after('<a class="commentform best_answer_a question-report" title="'+choose_best_answer+'" href="#">'+choose_best_answer+'</a>');
					jQuery(best_answer_re).remove();
				}
			});
			return false;
		});
		
		jQuery(".best_answer_a").live("click",function() {
			best_answer_a = this;
			comment_id = jQuery(this).parent().parent().attr('id');
			comment_id = comment_id.replace("comment-","");
			
			jQuery(".best_answer_a").hide();
			jQuery(best_answer_a).parent().find(" > .loader_3").show();
			
			jQuery.ajax({
				url: admin_url,
				type: "POST",
				data: { action : 'best_answer', comment_id : comment_id },
				success:function(data) {
					jQuery(best_answer_a).parent().parent().parent().addClass("comment-best-answer");
					jQuery(best_answer_a).parent().find(".text").after('<div class="commentform question-answered question-answered-done"><i class="icon-ok"></i>'+best_answer+'</div><div class="clearfix"></div><a class="commentform best_answer_re question-report" title="'+cancel_best_answer+'" href="#">'+cancel_best_answer+'</a>');
					jQuery(best_answer_a).parent().find(" > .loader_3").hide();
					jQuery(best_answer_a).remove();
				}
			});
			return false;
		});
	}
	
	if (jQuery(".comment-best-answer").length > 0) {
		jQuery(".comment-best-answer").prependTo("ol.commentlist");
		jQuery(".comment-best-answer").hide;
	}
	
	if (jQuery(".vote_not_user").length) {
		jQuery(".vote_not_user").on("click",function() {
			var this_vote_q = this;
			jQuery(this_vote_q).hide();
			jQuery(this_vote_q).parent().find(".loader_3").show();
			if (jQuery(this_vote_q).hasClass("single-question-vote-up") || jQuery(this_vote_q).hasClass("single-question-vote-down")) {
				jQuery(this).parent().parent().parent().parent().parent().find(".no_vote_more").hide(10).text(no_vote_user).slideDown(300).delay(1200).hide(300);
			}else {
				jQuery(this).parent().parent().parent().parent().find(".no_vote_more").hide(10).text(no_vote_user).slideDown(300).delay(1200).hide(300);
			}
			jQuery(this_vote_q).parent().find(".loader_3").hide();
			jQuery(this_vote_q).delay(500).show();
			return false;
		});
	}
	
	if (jQuery(".question_vote_up").length) {
		jQuery(".question_vote_up").each(function () {
			var this_vote_each = jQuery(this);
			if (this_vote_each.parent().find(".vote_allow").length) {
				this_vote_each.parent().find(".vote_allow").on("click",function() {
					var this_vote_q = this;
					var id = jQuery(this).attr('id');
					id = id.replace('question_vote_up-',"");
					
					jQuery(this_vote_q).hide();
					jQuery(this_vote_q).parent().find(".question_vote_down").hide();
			
					if (jQuery(this).hasClass("ask_yes-"+id)) {
						jQuery(this).parent().parent().parent().parent().find(".no_vote_more").hide(10).text(no_vote_more).slideDown(300).delay(1200).hide(300);
						jQuery(this_vote_q).parent().find(".loader_3").hide();
						jQuery(this_vote_q).delay(500).show();
						jQuery(this_vote_q).parent().find(".question_vote_down").delay(500).show();
					}else {
						jQuery.ajax({
							url: admin_url,
							type: "POST",
							data: { action : 'question_vote_up', id : id },
							success:function(data) {
								if (data > 0) {
									jQuery(this_vote_q).parent().parent().parent().parent().find(".question_vote_result").removeClass("question_vote_red");
								}else if (data == 0) {
									jQuery(this_vote_q).parent().parent().parent().parent().find(".question_vote_result").removeClass("question_vote_red");
								}else if (data < 0) {
									jQuery(this_vote_q).parent().parent().parent().parent().find(".question_vote_result").addClass("question_vote_red");
								}
								jQuery(this_vote_q).parent().parent().parent().parent().find(".question_vote_result").html(data);
								jQuery(this_vote_q).parent().find("#question_vote_up-"+id).addClass("ask_yes-"+id);
								jQuery(this_vote_q).parent().parent().find("#question_vote_down-"+id).addClass("ask_yes-"+id);
								jQuery(this_vote_q).parent().find(".loader_3").hide();
								jQuery(this_vote_q).delay(500).show();
								jQuery(this_vote_q).parent().find(".question_vote_down").delay(500).show();
							}
						});
					}
					return false;
				});
			}else if (this_vote_each.parent().find(".vote_not_allow")) {
				this_vote_each.parent().find(".vote_not_allow").on("click",function() {
					var this_vote_q = this;
					jQuery(this_vote_q).hide();
					jQuery(this_vote_q).parent().find(".loader_3").show();
					jQuery(this).parent().parent().parent().parent().find(".no_vote_more").hide(10).text(no_vote_question).slideDown(300).delay(1200).hide(300);
					jQuery(this_vote_q).parent().find(".loader_3").hide();
					jQuery(this_vote_q).delay(500).show();
					return false;
				});
			}
		});
	}
	
	if (jQuery(".question_vote_down").length) {
		jQuery(".question_vote_down").each(function () {
			var this_vote_each = jQuery(this);
			if (this_vote_each.parent().find(".vote_allow").length) {
				this_vote_each.parent().find(".vote_allow").on("click",function() {
					var this_vote_q = this;
					var id = jQuery(this).attr('id');
					id = id.replace('question_vote_down-',"");
					jQuery(this_vote_q).hide();
					jQuery(this_vote_q).parent().find(".question_vote_up").hide();
			
					if (jQuery(this).hasClass("ask_yes-"+id)) {
						jQuery(this).parent().parent().parent().parent().find(".no_vote_more").hide(10).text(no_vote_more).slideDown(300).delay(1200).hide(300);
						jQuery(this_vote_q).parent().find(".loader_3").hide();
						jQuery(this_vote_q).delay(500).show();
						jQuery(this_vote_q).parent().find(".question_vote_up").delay(500).show();
					}else {
						jQuery.ajax({
							url: admin_url,
							type: "POST",
							data: { action : 'question_vote_down', id : id },
							success:function(data) {
								if (data > 0) {
									jQuery(this_vote_q).parent().parent().parent().parent().find(".question_vote_result").removeClass("question_vote_red");
								}else if (data == 0) {
									jQuery(this_vote_q).parent().parent().parent().parent().find(".question_vote_result").removeClass("question_vote_red");
								}else if (data < 0) {
									jQuery(this_vote_q).parent().parent().parent().parent().find(".question_vote_result").addClass("question_vote_red");
								}
								jQuery(this_vote_q).parent().parent().parent().parent().find(".question_vote_result").html(data);
								jQuery(this_vote_q).parent().parent().find("#question_vote_up-"+id).addClass("ask_yes-"+id);
								jQuery(this_vote_q).parent().find("#question_vote_down-"+id).addClass("ask_yes-"+id);
								jQuery(this_vote_q).parent().find(".loader_3").hide();
								jQuery(this_vote_q).delay(500).show();
								jQuery(this_vote_q).parent().find(".question_vote_up").delay(500).show();
							}
						});
					}
					return false;
				});
			}else if (this_vote_each.parent().find(".vote_not_allow")) {
				this_vote_each.parent().find(".vote_not_allow").on("click",function() {
					var this_vote_q = this;
					jQuery(this_vote_q).hide();
					jQuery(this_vote_q).parent().find(".loader_3").show();
					jQuery(this).parent().parent().parent().parent().find(".no_vote_more").hide(10).text(no_vote_question).slideDown(300).delay(1200).hide(300);
					jQuery(this_vote_q).parent().find(".loader_3").hide();
					jQuery(this_vote_q).delay(500).show();
					return false;
				});
			}
		});
	}
	
	if (jQuery(".comment_vote_up").length) {
		jQuery(".comment_vote_up").each(function () {
			var this_vote_each = jQuery(this);
			if (this_vote_each.parent().find(".vote_allow").length) {
				this_vote_each.parent().find(".vote_allow").on("click",function() {
					var this_vote = jQuery(this);
					var id = this_vote.attr('id');
					id = id.replace('comment_vote_up-',"");
					
					this_vote.parent().hide();
					this_vote.parent().parent().find(".comment_vote_down").parent().hide();
					this_vote.parent().parent().find(".loader_3").show();
			
					var post_id = this_vote.parent().parent().parent().parent().parent().parent().attr('rel');
					post_id = post_id.replace('posts-',"");
					if (this_vote.hasClass("ask_yes_comment-"+id)) {
						this_vote.parent().parent().parent().parent().parent().find(".no_vote_more").hide(10).text(no_vote_more_answer).slideDown(300).delay(1200).hide(300);
						this_vote.parent().parent().find(".loader_3").delay(300).hide(10);
						this_vote.parent().delay(300).show(1);
						this_vote.parent().parent().find(".comment_vote_down").parent().delay(300).show(1);
					}else {
						jQuery.ajax({
							url: admin_url,
							type: "POST",
							data: { action : 'comment_vote_up', id : id, post_id : post_id },
							success:function(data) {
								if (data > 0) {
									jQuery("#comment-"+id).find(".question_vote_result").removeClass("question_vote_red");
								}else if (data == 0) {
									jQuery("#comment-"+id).find(".question_vote_result").removeClass("question_vote_red");
								}else if (data < 0) {
									jQuery("#comment-"+id).find(".question_vote_result").addClass("question_vote_red");
								}
								jQuery("#comment-"+id).find(".question_vote_result").html(data);
								jQuery("#comment-"+id).find("#comment_vote_up-"+id).addClass("ask_yes_comment-"+id);
								jQuery("#comment-"+id).find("#comment_vote_down-"+id).addClass("ask_yes_comment-"+id);
								this_vote.parent().parent().find(".loader_3").hide();
								this_vote.parent().delay(500).show();
								this_vote.parent().parent().find(".comment_vote_down").parent().delay(500).show();
							}
						});
					}
					return false;
				});
			}else if (this_vote_each.parent().find(".vote_not_allow")) {
				this_vote_each.parent().find(".vote_not_allow").on("click",function() {
					var this_vote_q = jQuery(this);
					this_vote_q.hide();
					this_vote_q.parent().find(".loader_3").show();
					this_vote_q.parent().parent().parent().parent().parent().find(".no_vote_more").hide(10).text(no_vote_answer).slideDown(300).delay(1200).hide(300);
					this_vote_q.parent().find(".loader_3").hide();
					this_vote_q.delay(500).show();
					return false;
				});
			}
		});
	}
	
	if (jQuery(".comment_vote_down").length) {
		jQuery(".comment_vote_down").each(function () {
			var this_vote_each = jQuery(this);
			if (this_vote_each.parent().find(".vote_allow").length) {
				this_vote_each.parent().find(".vote_allow").on("click",function() {
					var this_vote = this;
					var id = jQuery(this).attr('id');
					id = id.replace('comment_vote_down-',"");
			
					jQuery(this_vote).parent().hide();
					jQuery(this_vote).parent().parent().find(".comment_vote_up").parent().hide();
					jQuery(this_vote).parent().parent().find(".loader_3").show();
			
					var post_id = jQuery(this).parent().parent().parent().parent().parent().parent().attr('rel');
					post_id = post_id.replace('posts-',"");
					
					if (jQuery(this).hasClass("ask_yes_comment-"+id)) {
						jQuery(this).parent().parent().parent().parent().parent().find(".no_vote_more").hide(10).text(no_vote_more_answer).slideDown(300).delay(1200).hide(300);
						jQuery(this_vote).parent().parent().find(".loader_3").delay(300).hide(10);
						jQuery(this_vote).parent().delay(300).show(1);
						jQuery(this_vote).parent().parent().find(".comment_vote_up").parent().delay(300).show(1);
					}else {
						jQuery.ajax({
							url: admin_url,
							type: "POST",
							data: { action : 'comment_vote_down', id : id, post_id : post_id },
							success:function(data) {
								if (data > 0) {
									jQuery("#comment-"+id).find(".question_vote_result").removeClass("question_vote_red");
								}else if (data == 0) {
									jQuery("#comment-"+id).find(".question_vote_result").removeClass("question_vote_red");
								}else if (data < 0) {
									jQuery("#comment-"+id).find(".question_vote_result").addClass("question_vote_red");
								}
								jQuery("#comment-"+id).find(".question_vote_result").html(data);
								jQuery("#comment-"+id).find("#comment_vote_up-"+id).addClass("ask_yes_comment-"+id);
								jQuery("#comment-"+id).find("#comment_vote_down-"+id).addClass("ask_yes_comment-"+id);
								jQuery(this_vote).parent().parent().find(".loader_3").hide();
								jQuery(this_vote).parent().delay(500).show();
								jQuery(this_vote).parent().parent().find(".comment_vote_up").parent().delay(500).show();
							}
						});
					}
					return false;
				});
			}else if (this_vote_each.parent().find(".vote_not_allow")) {
				this_vote_each.parent().find(".vote_not_allow").on("click",function() {
					var this_vote_q = this;
					jQuery(this_vote_q).hide();
					jQuery(this_vote_q).parent().find(".loader_3").show();
					jQuery(this).parent().parent().parent().parent().parent().find(".no_vote_more").hide(10).text(no_vote_answer).slideDown(300).delay(1200).hide(300);
					jQuery(this_vote_q).parent().find(".loader_3").hide();
					jQuery(this_vote_q).delay(500).show();
					return false;
				});
			}
		});
	}
	
	if (jQuery(".report_q").length) {
		jQuery(".report_q").on("click",function() {
			report_q = jQuery(this);
			post_id = report_q.parent().attr("id");
			post_id = post_id.replace('post-',"");
			
			report_q.parent().find(".explain-reported").slideDown();
			report_q.parent().find(".cancel").click(function () {
				report_q.parent().find(".explain-reported").slideUp();
				return false;
			});
			
			report_q.parent().find(".report").click(function () {
				report = jQuery(this);
				var explain = report_q.parent().find(".explain-reported textarea");
				report_q.parent().find(".required-error").remove();
				if (explain.val() == '') {
					explain.after('<span class="required-error red">'+ask_error_text+'</span>');
				}else {
					report.hide();
					report.parent().find(".loader_3").show();
					report.parent().find(".cancel").hide();
					report_q.parent().find(".required-error").remove();
					jQuery.ajax({
						url: admin_url,
						type: "POST",
						data: { action : 'report_q', post_id : post_id, explain : explain.val() },
						success:function(data) {
							explain.val("");
							report.show();
							report.parent().find(".cancel").show();
							report_q.parent().find(".explain-reported").slideUp();
							report.parent().find(".loader_3").hide();
							report_q.delay(500).show();
						}
					});
				}
				return false;
			});
			return false;
		});
	}
	
	if (jQuery(".report_c").length) {
		jQuery(".report_c").on("click",function() {
			report_c = jQuery(this);
			comment_id = report_c.parent().parent().parent().parent().parent().attr("id");
			comment_id = comment_id.replace("li-comment-","");
			
			report_c.parent().parent().parent().find(".explain-reported").slideDown();
			report_c.parent().parent().parent().find(".cancel").click(function () {
				report_c.parent().parent().parent().find(".explain-reported").slideUp();
				return false;
			});
			
			report_c.parent().parent().parent().find(".report").click(function () {
				report = jQuery(this);
				var explain = report_c.parent().parent().parent().find(".explain-reported textarea");
				report_c.parent().parent().parent().find(".required-error").remove();
				if (explain.val() == '') {
					explain.after('<span class="required-error red">'+ask_error_text+'</span>');
				}else {
					report.hide();
					report.parent().parent().parent().find(".explain-reported .loader_3").show();
					report.parent().parent().parent().find(".cancel").hide();
					report_c.parent().parent().parent().find(".required-error").remove();
					jQuery.ajax({
						url: admin_url,
						type: "POST",
						data: { action : 'report_c', comment_id : comment_id, explain : explain.val() },
						success:function(data) {
							explain.val("");
							report.show();
							report.parent().parent().parent().find(".cancel").show();
							report_c.parent().parent().parent().find(".explain-reported").slideUp();
							report.parent().parent().parent().find(".explain-reported .loader_3").hide();
							report_c.delay(500).show();
						}
					});
				}
				return false;
			});
			return false;
		});
	}
	
	if (jQuery(".poll_results").length) {
		jQuery(".poll_results").on("click",function() {
			jQuery(".poll_2").fadeOut(500);
			jQuery(".poll_1").delay(500).slideDown(500);
			return false;
		});
	}
	
	if (jQuery(".poll_polls").length) {
		jQuery(".poll_polls").on("click",function() {
			jQuery(".poll_1").fadeOut(500);
			jQuery(".poll_2").delay(500).slideDown(500);
			return false;
		});
	}
	
	if (jQuery(".question_poll_end").length) {
		jQuery(".question_poll_end input").on("click",function() {
			question_poll = jQuery(this);
			
			jQuery(question_poll).parent().find("input").hide();
			jQuery(question_poll).parent().find("label").hide();
			jQuery(question_poll).parent().parent().parent().parent().find(".loader_3").show();
	
			poll_id = question_poll.val();
			poll_id = poll_id.replace('poll_',"");
			
			poll_title = question_poll.attr("rel");
			poll_title = poll_title.replace('poll_',"");
			
			post_id = question_poll.parent().parent().parent().parent().parent().parent().parent().parent().attr("id");
			post_id = post_id.replace('post-',"");
			jQuery.ajax({
				url: admin_url,
				type: "POST",
				data: { action : 'question_poll', poll_id : poll_id, poll_title : poll_title, post_id : post_id },
				success:function(data) {
					location.reload();
				}
			});
		});
	}
	
	if (jQuery(".add_favorite").length) {
		jQuery(".add_favorite").click(function () {
			add_favorite = jQuery(this);
			post_id = add_favorite.parent().parent().parent().attr("id");
			post_id = post_id.replace('post-',"");
			
			add_favorite.hide();
			add_favorite.parent().find(".loader_2").show();
			jQuery.ajax({
				url: admin_url,
				type: "POST",
				data: { action : 'add_favorite', post_id : post_id },
				success:function(data) {
					location.reload();
				}
			});
			return false;
		});
	}
	
	if (jQuery(".remove_favorite").length) {
		jQuery(".remove_favorite").click(function () {
			remove_favorite = jQuery(this);
			if (remove_favorite.hasClass("question-remove")) {
				post_id = remove_favorite.parent().parent().attr("id");
			}else {
				post_id = remove_favorite.parent().parent().parent().attr("id");
			}
			post_id = post_id.replace('post-',"");
			
			remove_favorite.hide();
			remove_favorite.parent().find(".loader_2").show();
			jQuery.ajax({
				url: admin_url,
				type: "POST",
				data: { action : 'remove_favorite', post_id : post_id },
				success:function(data) {
					location.reload();
				}
			});
			return false;
		});
	}
	
	if (jQuery(".user-profile").length) {
		jQuery(".following_not").live("click",function () {
			following_not = jQuery(this);
			following_not_id = following_not.attr("rel");
			following_not.hide();
			jQuery.ajax({
				url: admin_url,
				type: "POST",
				data: {action:'following_not',following_not_id:following_not_id},
				success:function(data) {
					jQuery(".followers span span").text(data);
					following_not.addClass("following_you").removeClass("following_not").text(follow_question).show();
					//location.reload();
				}
			});
			return false;
		});
		
		jQuery(".following_you").live("click",function () {
			following_you = jQuery(this);
			following_you_id = following_you.attr("rel");
			following_you.hide();
			jQuery.ajax({
				url: admin_url,
				type: "POST",
				data: {action:'following_me',following_you_id:following_you_id},
				success:function(data) {
					jQuery(".followers span span").text(data);
					following_you.addClass("following_not").removeClass("following_you").text(unfollow_question).show();
					//location.reload();
				}
			});
			return false;
		});
	}
	
	/* Add Point */
	
	if (jQuery(".form-add-point a").length) {
		jQuery(".form-add-point a").click(function () {
			var point_a = jQuery(this);
			var input_add = jQuery("#input-add-point");
			var input_add_point = input_add.val();
			point_a.hide();
			point_a.parent().parent().parent().find(".loader_2").show();
			post_id = point_a.parent().parent().parent().parent().parent().attr("id");
			post_id = post_id.replace('post-',"");
			jQuery.ajax({
				url: admin_url,
				type: "POST",
				data: {action:'add_point',input_add_point:input_add_point,post_id:post_id},
				success:function(data) {
					point_a.parent().parent().parent().find(".no_vote_more").hide(10).text(data).slideDown(300).delay(1200).hide(300);
					point_a.show();
					point_a.parent().parent().parent().find(".loader_2").hide();
					input_add.val("");
				}
			});
			return false;
		});
	}
	
	/* Login panel */
	
	if (jQuery(".login-panel-link").length) {
		jQuery(".login-panel-link").click(function () {
			if (jQuery(this).hasClass("header-top-active")) {
				jQuery(".login-panel").slideUp(500);
				jQuery(this).removeClass("header-top-active");
				jQuery(this).find("i").addClass("icon-user");
				jQuery(this).find("i").removeClass("icon-remove");
			}else {
				jQuery(".login-panel").slideDown(500);
				jQuery(this).addClass("header-top-active");
				jQuery(this).find("i").removeClass("icon-user");
				jQuery(this).find("i").addClass("icon-remove");
			}
			return false;
		});
	}
	
	/* Login */
	
	if (jQuery(".login-form").length) {
		jQuery(".login-form").submit(function() {
			var thisform = jQuery(this);
			jQuery('.required-error',thisform).remove();
			jQuery('input[type="submit"]',thisform).hide();
			jQuery('.loader_2',thisform).show().css({"display":"block"});
			var fields = jQuery('.inputs',thisform);
			jQuery('.required-item',thisform).each(function () {
				var required = jQuery(this);
				if (required.val() == '') {
					required.after('<span class=required-error>'+ask_error_text+'</span>');
					return false;
				}
			});
			
			if (jQuery('.ask_captcha',thisform).length > 0) {
				var ask_captcha = jQuery('.ask_captcha',thisform);
				var url = v_get_template_directory_uri+"/captcha/captcha.php";
				var postStr = ask_captcha.attr("name")+"="+encodeURIComponent(ask_captcha.val());
				
				if (ask_captcha.val() == "") {
					ask_captcha.parent().append('<span class="required-error required-error-c">'+ask_error_text+'</span>');
					jQuery('.loader_2',thisform).hide().css({"display":"none"});
					jQuery('input[type="submit"]',thisform).show();
					return false;
				}else if (ask_captcha.hasClass("captcha_answer")) {
					if (ask_captcha.val() != captcha_answer) {
						ask_captcha.parent().append('<span class="required-error required-error-c">'+ask_error_captcha+'</span>');
						jQuery('.loader_2',thisform).hide().css({"display":"none"});
						jQuery('input[type="submit"]',thisform).show();
						return false;
					}
				}else {
					message = "";
					jQuery.ajax({
						url:  url,
						type: "POST",
						data: postStr,
						async:false,
						success: function(data){
							message = data;
						}
					});
					if (message == "ask_captcha_0") {
						ask_captcha.parent().append('<span class="required-error required-error-c">'+ask_error_captcha+'</span>');
						jQuery('.loader_2',thisform).hide().css({"display":"none"});
						jQuery('input[type="submit"]',thisform).show();
						return false;
					}
				}
			}
			
		    var data = {
				action: 		'ask_ajax_login_process',
				security: 		jQuery('input[name=\"login_nonce\"]',thisform).val(),
				log: 			jQuery('input[name=\"log\"]',thisform).val(),
				pwd: 			jQuery('input[name=\"pwd\"]',thisform).val(),
				redirect_to:	jQuery('input[name=\"redirect_to\"]',thisform).val()
			};
			jQuery.post(jQuery('input[name=\"ajax_url\"]',thisform).val(),data,function(response) {
				var result = jQuery.parseJSON(response);
				if (result.success == 1) {
					window.location = result.redirect;
				}else if (result.error) {
					jQuery(".ask_error",thisform).hide(10).slideDown(300).html('<strong>'+result.error+'</strong>').delay(3000).slideUp(300);
				}else {
					return true;
				}
				jQuery('.loader_2',thisform).hide().css({"display":"none"});
				jQuery('input[type="submit"]',thisform).show();
			});
			return false;
		});
	}
	
	/* Login */
	
	if (jQuery(".login-comments,.comment-reply-login").length) {
		jQuery(".login-comments,.comment-reply-login").click(function () {
			jQuery(".panel-pop").animate({"top":"-100%"},10).hide();
			jQuery("#login-comments").show().animate({"top":"2%"},500);
			jQuery("html,body").animate({scrollTop:0},500);
			jQuery("body").prepend("<div class='wrap-pop'></div>");
			wrap_pop();
			return false;
		});
	}
	
	/* Signup */
	
	if (jQuery(".signup,.login-links-r a").length) {
		jQuery(".signup,.login-links-r a").click(function () {
			jQuery(".panel-pop").animate({"top":"-100%"},10).hide();
			jQuery("#signup").show().animate({"top":"2%"},500);
			jQuery("html,body").animate({scrollTop:0},500);
			jQuery("body").prepend("<div class='wrap-pop'></div>");
			wrap_pop();
			return false;
		});
	}
	
	if (jQuery(".signup_form").length) {
		jQuery(".signup_form").submit(function () {
			var whatsubmit_s = true;
			var thisform = jQuery(this);
			jQuery('.required-error',thisform).remove();
			if (jQuery('.ask_captcha',thisform).length > 0) {
				var ask_captcha = jQuery('.ask_captcha',thisform).parent().find("input");
				var url = v_get_template_directory_uri+"/captcha/captcha.php";
				var postStr = ask_captcha.attr("name")+"="+encodeURIComponent(ask_captcha.val());
				if (ask_captcha.val() == "") {
					ask_captcha.parent().append('<span class="required-error required-error-c">'+ask_error_text+'</span>');
					whatsubmit_s = false;
				}else if (ask_captcha.hasClass("captcha_answer")) {
					if (ask_captcha.val() != captcha_answer) {
						whatsubmit_s = false;
						ask_captcha.parent().append('<span class="required-error required-error-c">'+ask_error_captcha+'</span>');
					}else {
						whatsubmit_s = true;
					}
				}else {
					message = "";
					jQuery.ajax({
						url:  url,
						type: "POST",
						data: postStr,
						async:false,
						success: function(data){
							message = data;
						}
					});
					if (message == "ask_captcha_0") {
						ask_captcha.parent().append('<span class="required-error required-error-c">'+ask_error_captcha+'</span>');
						whatsubmit_s = false;
					}else {
						whatsubmit_s = true;
					}
				}
			}
			jQuery('.required-item',thisform).each(function () {
				var required = jQuery(this);
				if (required.val() == '') {
					required.after('<span class=required-error>'+ask_error_text+'</span>');
					whatsubmit_s = false;
				}
			});
			if(!whatsubmit_s){
				jQuery('.ask_error',thisform).hide(10).slideDown(300).html('<strong>'+ask_error_empty+'</strong>').delay(1000).slideUp(300);
			}
			return whatsubmit_s;
		});
	}
	
	/* Lost password */
	
	if (jQuery(".login-password a").length) {
		jQuery(".login-password a").click(function () {
			jQuery(".panel-pop").animate({"top":"-100%"},10).hide();
			jQuery("#lost-password").show().animate({"top":"2%"},500);
			jQuery("html,body").animate({scrollTop:0},500);
			jQuery("body").prepend("<div class='wrap-pop'></div>");
			wrap_pop();
			return false;
		});
	}
	
	if (jQuery(".ask-lost-password").length) {
		jQuery(".ask-lost-password").submit(function () {
			var whatsubmit_l = true;
			var thisform = jQuery(this);
			jQuery('.required-error',thisform).remove();
			jQuery('.required-item',thisform).each(function () {
				var required = jQuery(this);
				if (required.val() == '') {
					required.after('<span class=required-error>'+ask_error_text+'</span>');
					whatsubmit_l = false;
				}
			});
			if(!whatsubmit_l){
				jQuery('.ask_error',thisform).hide(10).slideDown(300).html('<strong>'+ask_error_empty+'</strong>').delay(1000).slideUp(300);
			}
			return whatsubmit_l;
		});
	}
	
	/* Comments & Answers */
	
	if (jQuery("#commentform").length) {
		jQuery("#commentform").submit(function () {
			var thisform = jQuery(this);
			jQuery('.required-error',thisform).remove();
			if (jQuery('.ask_captcha',thisform).length > 0) {
				var ask_captcha = jQuery('.ask_captcha',thisform).parent().find("input");
				var url = v_get_template_directory_uri+"/captcha/captcha.php";
				var postStr = ask_captcha.attr("name")+"="+encodeURIComponent(ask_captcha.val());
				if (ask_captcha.val() == "") {
					ask_captcha.parent().append('<span class="required-error required-error-c">'+ask_error_text+'</span>');
					return false;
				}else if (ask_captcha.hasClass("captcha_answer")) {
					if (ask_captcha.val() != captcha_answer) {
						ask_captcha.parent().append('<span class="required-error required-error-c">'+ask_error_captcha+'</span>');
						return false;
					}else {
						return true;
					}
				}else {
					message = "";
					jQuery.ajax({
						url:  url,
						type: "POST",
						data: postStr,
						async:false,
						success: function(data){
							message = data;
						}
					});
					if (message == "ask_captcha_0") {
						ask_captcha.parent().append('<span class="required-error required-error-c">'+ask_error_captcha+'</span>');
						return false;
					}else {
						return true;
					}
				}
			}
		});
	}
	
	/* Panel pop */
	
	if (jQuery(".panel-pop h2 i").length) {
		jQuery(".panel-pop h2 i").click(function () {
			jQuery(this).parent().parent().animate({"top":"-100%"},500).fadeOut(function () {
				jQuery(this).animate({"top":"-100%"},500);
			});
			jQuery(".wrap-pop").remove();
		});
	}
	
	function wrap_pop() {
		jQuery(".wrap-pop").click(function () {
			jQuery(".panel-pop").animate({"top":"-100%"},500).fadeOut(function () {
				jQuery(this).animate({"top":"-100%"},500);
			});
			jQuery(this).remove();
		});
	}
	
	/* Select */
	if (jQuery(".widget select,select#calc_shipping_country,.woocommerce-sort-by select").length) {
		jQuery(".widget:not(.signup-widget) select,select#calc_shipping_country,.woocommerce-sort-by select").wrap('<div class="styled-select"></div>');
	}
	
	/* Widget */
	
	if (jQuery(".widget li.cat-item,.widget.widget_archive li").length) {
		jQuery(".widget li.cat-item,.widget.widget_archive li").each(function(){var e= jQuery(this).contents();e.length>1&&(e.eq(1).wrap('<span class="widget-span"></span>'),e.eq(1).each(function(){}))}).contents();jQuery(".widget li.cat-item .widget-span,.widget.widget_archive li .widget-span").each(function(){jQuery(this).html(jQuery(this).text().substring(2));jQuery(this).html(jQuery(this).text().replace(/\)/gi,""))});jQuery(".widget li.cat-item").length&&jQuery(".widget li.cat-item .widget-span");
	}
	
	/* Woocommerce */
	
	if (jQuery(".woocommerce").length > 0) {
		jQuery("#calc_shipping_state,#calc_shipping_postcode").parent().addClass("col-md-6").addClass("woocommerce-input");
		jQuery(".woocommerce .woocommerce-input").wrapAll('<div class="row"></div>');
		
		jQuery("ul.products li .product-details h3 a").each(function () {
			var shortlink = jQuery(this);
			var txt = shortlink.text();
			shortlink.html(trunc(txt,products_excerpt_title));
		});
	}
	
	function trunc(str,n) {
		return str.substr(0,n-1);
	}
	
	if (jQuery(".cart_control").length) {
		jQuery(document).on('click','.cart_control',function() {
			if (jQuery(this).next('.cart_wrapper').hasClass('cart_wrapper_active')) {
				jQuery(this).next('.cart_wrapper').removeClass('cart_wrapper_active');
				jQuery(this).next('.cart_wrapper').slideUp();
			}else {
				jQuery(this).next('.cart_wrapper').slideDown();
				jQuery(this).next('.cart_wrapper').addClass('cart_wrapper_active');
			}
			return false;
		});
	}
	
	/* NiceScroll */
	
	if (jQuery(".wrap-nicescroll").length) {
		jQuery("html").niceScroll({
			scrollspeed: 60,
			mousescrollstep: 38,
			cursorwidth: 6,
			cursorborder: 0,
			cursorcolor: '#bbb',
			autohidemode: false,
			zindex: 9999999,
			horizrailenabled: false,
			cursorborderradius: 0,
		});
	}
	
	/* Widget Menu jQuery */
	
	if (jQuery(".widget_menu_jquery").length) {
		jQuery(".widget_menu_jquery").onePageNav({
			currentClass : "current_page_item",
			changeHash : false,
			scrollSpeed : 750,
			scrollOffset : parseFloat(jQuery("#header").innerHeight())+60
		});
	}
	
	/* Lightbox */
	
	var lightboxArgs = {			
		animation_speed: "fast",
		overlay_gallery: true,
		autoplay_slideshow: false,
		slideshow: 5000, // light_rounded / dark_rounded / light_square / dark_square / facebook
		theme: "pp_default", 
		opacity: 0.8,
		show_title: false,
		social_tools: "",
		deeplinking: false,
		allow_resize: true, // Resize the photos bigger than viewport. true/false
		counter_separator_label: "/", // The separator for the gallery counter 1 "of" 2
		default_width: 940,
		default_height: 529
	};
		
	jQuery("a[href$=jpg], a[href$=JPG], a[href$=jpeg], a[href$=JPEG], a[href$=png], a[href$=gif], a[href$=bmp]:has(img)").prettyPhoto(lightboxArgs);
	jQuery("a[class^='prettyPhoto'], a[rel^='prettyPhoto']").prettyPhoto(lightboxArgs);
	
	/* Page load */
	
	jQuery(window).load(function() {
		
		/* Loader */
		
		jQuery(".loader").fadeOut(500);
		
		/* Carousel */
		
		if (jQuery(".carousel-all").length) {
			jQuery(".carousel-all").each(function(){
			    var $current = jQuery(this);
			    var $prev = jQuery(this).find(".carousel-prev");
			    var $next = jQuery(this).find(".carousel-next");
			    var $effect = jQuery(this).attr("carousel_effect");
			    var $auto = jQuery(this).attr("carousel_auto");
			    var $responsive = jQuery(this).attr("carousel_responsive");
			    var $max = jQuery(this).attr("what_col");
			    var $pagination = jQuery(this).find(".carousel-pagination");
				
				if ($current.hasClass("testimonial-carousel")) {
					var $testimonial_width = $current.width();
					$current.find(".testimonial-warp").css("width",$testimonial_width)
				}
				
				if ($max == 1) {
					var $width = 940;
				}
				if ($max == 2) {
					var $width = 460;
				}
				if ($max == 3) {
					var $width = 300;
				}
				if ($max == 4) {
					var $width = 220;
				}
				if ($max == 5) {
					var $width = 220;
				}
				if ($max == 6) {
					var $width = 140;
				}
				
			    jQuery(this).find(".slides").carouFredSel({
					circular: false,
					prev		 : $prev,
			        next		 : $next,
					infinite	 : true,
					auto		 : ($auto == "true"?true:false),
					responsive	 : ($responsive == "true"?true:false),
					swipe: {onTouch:true},
					pagination   : $pagination,
					scroll	     : {
						easing   : "easeInOutCubic",
						duration : 600,
						fx: ($effect == "scroll"?"scroll":"")+($effect == "cover-fade"?"cover-fade":"")+($effect == "fade"?"fade":"")+($effect == "directscroll"?"directscroll":"")+($effect == "crossfade"?"crossfade":"")+($effect == "cover"?"cover":"")+($effect == "uncover"?"uncover":"")+($effect == "uncover-fade"?"uncover-fade":"")+($effect == "none"?"none":""),
					},
					items        : ($max == 6?6:"")+($max == 5?5:"")+($max == 4?4:"")+($max == 3?3:"")+($max == 2?2:"")+($max == 1?1:""),
			    });
			});
		}
		
		if (jQuery(".bxslider").length) {
			jQuery(".bxslider").bxSlider({
				slideWidth: 200,
				minSlides: 4,
				maxSlides: 4,
				slideMargin: 30
			});
		}
		
	});
	
	/* Widget Menu jQuery */
	
	jQuery(window).scroll(function(){
		var sidebar = jQuery('.sidebar');
		sidebar.each(function(){
			if(!mobile_device && sidebar.hasClass("sticky-sidebar") && jQuery(window).width() > 960 && jQuery(window).height() < sidebar.height()){
				var main_content = jQuery('.main-content');
				if (jQuery(this).height() < main_content.height()) {
					if (jQuery(window).scrollTop() + jQuery(window).height() >= main_content.offset().top + main_content.height()) {
						if (!jQuery(this).hasClass('absolute-sidebar')) {
							jQuery(this).css({'left': ''});
							jQuery(this).addClass('absolute-sidebar').removeClass('fixed-sidebar');
						}
					}else if (!jQuery(this).hasClass('fixed-sidebar') &&
						jQuery(window).scrollTop() + jQuery(window).height() >= main_content.offset().top + jQuery(this).height()) {
						jQuery(this).attr('data-top-position',jQuery(this).offset().top + jQuery(this).height());
						jQuery(this).css({'left': jQuery(this).offset().left,'width': jQuery(this).outerWidth() });
						jQuery(this).addClass('fixed-sidebar').removeClass('absolute-sidebar');
					}else if (jQuery(this).hasClass('fixed-sidebar') &&
						jQuery(window).scrollTop() + jQuery(window).height() < main_content.offset().top + jQuery(this).height()) {
						jQuery(this).css({'left': '','width': '' });
						jQuery(this).removeClass('fixed-sidebar');
					}
				}
			}else {
				jQuery(this).removeClass('fixed-sidebar absolute-sidebar');
				jQuery(this).css({'left': '','width': '' });
			}
		});
	});
	
	jQuery(window).bind("resize",function() {
		jQuery('.sidebar').removeClass('fixed-sidebar');
	});

	jQuery(window).trigger('resize');
	jQuery(window).trigger('scroll');
	
	jQuery(".widget_menu.widget_menu_jquery").each(function () {
		var widget_menu_jquery = jQuery(this);
		var sidebar_w = widget_menu_jquery.parent().width();
		widget_menu_jquery.css({"width":sidebar_w});
	});
	
	jQuery(window).bind("resize", function () {
		if (jQuery(this).width() > 800) {
			jQuery(".widget_menu.widget_menu_jquery").each(function () {
				var widget_menu_jquery = jQuery(this);
				var sidebar_w = widget_menu_jquery.parent().width();
				widget_menu_jquery.css({"width":sidebar_w});
			});
		}
	});
	
	jQuery.fn.scrollBottom = function() {
	    return jQuery(document).height() - this.scrollTop() - this.height();
	};
	
	var $widget_menu = jQuery(".widget_menu_jquery");
	var $window = jQuery(window);
	//var top = $widget_menu.parent().position().top;
	
	var header = parseFloat(jQuery("#header-top").outerHeight()+jQuery("#header").outerHeight()+jQuery(".breadcrumbs").outerHeight()+70);
	var footer = parseFloat(jQuery("#footer").outerHeight()+jQuery("#footer-bottom").outerHeight()+80);
	
	$window.bind("scroll resize", function() {
	    var gap = $window.height() - $widget_menu.height()+40;
	    var visibleHead = header - $window.scrollTop();
	    var visibleFoot = footer - $window.scrollBottom();
	    var scrollTop = $window.scrollTop();
	    
	    if (scrollTop < header) {
	        $widget_menu.css({
	            top: visibleHead + "px",
	            bottom: "auto"
	        });
	    }else if (visibleFoot > $window.height() - $widget_menu.height()) {
	        $widget_menu.css({
	            top: "auto",
	            bottom: visibleFoot + "px"
	        });
	    }else {
	    	if (jQuery("#wrap").hasClass("fixed-enabled")) {
	            $widget_menu.css({
	                top: parseFloat(jQuery("#header.fixed-nav").outerHeight()+40),
	                bottom: "auto"
	            });
	        }else {
	        	$widget_menu.css({
	        	    top: "40px",
	        	    bottom: "auto"
	        	});
	        }
	    }
	}).scroll();
	
});
function ask_get_captcha(captcha_file,captcha_id) {
	var img = jQuery("#"+captcha_id).attr("src",captcha_file+'?'+Math.random());
}