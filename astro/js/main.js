/*jshint ignore: start */
/* 
	THIS PAGE CONTAINS THE MAIN SCRIPTS OF THE THEME
*/
function astro_init() {
	//FUNCTION TO CONVERT NUMBERS TO TEXT - RESPONSIVE COLUMN SIZES
	"use strict";
	//HEXADECIMAL TO RGB:#CCCCCC=>rgb(204,204,204)
	function hex2rgb(hexStr,alpha) {
		// note: hexStr should be #rrggbb
		var hex = parseInt(hexStr.substring(1), 16);
		var r = (hex & 0xff0000) >> 16;
		var g = (hex & 0x00ff00) >> 8;
		var b = hex & 0x0000ff;
		return "rgba("+[r, g, b]+","+alpha+")";
	}
	//FUNCTION TO DETECT IF A TOUCH DEVICE IS IN USE
	function is_mobile() {
		var check = false;
		(function(a){if((/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase())) || /(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a.toLowerCase())||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4).toLowerCase())){check = true;}})(navigator.userAgent||navigator.vendor||window.opera);
		return check;
	}
	var astro_on_mobile = is_mobile()===true ? true : false;
	var ajax_calls = theme_options.ajax_calls==="1" ? true : false;
	var eventtype = is_mobile() ? 'touchstart' : 'click';
	if (jQuery('body').hasClass('astro_nav_right')) {
		var nav_on_right=true;
	}
	else {
		var nav_on_right=false;
	}
	if (astro_on_mobile===true) {
		jQuery('html').addClass('astro_on_mobile');
	}
	else {
		jQuery('html').addClass('astro_on_desktop');
	}
	function textize(m_nb) {
		if (m_nb===1) {
			return "one";}
		if (m_nb===2){
			return "two";}
		if (m_nb===3){
			return "three";}
		if (m_nb===4){
			return "four";}
		if (m_nb===5){
			return "five";}
		if (m_nb===6){
			return "six";}
		if (m_nb===7){
			return "seven";}
		if (m_nb===8){
			return "eight";}
		if (m_nb===9){
			return "nine";}
		if (m_nb===10){
			return "ten";}
		if (m_nb===11){
			return "eleven";}
		if (m_nb===12){
			return "twelve";}
	}
	function isScrolledIntoView(elem) {
		var docViewTop = jQuery(window).scrollTop();
		var docViewBottom = docViewTop + jQuery(window).height();
	
		var elemTop = jQuery(elem).offset().top;
		var elemBottom = elemTop + jQuery(elem).height();
	
		return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom));
	}
	var original_active_color=theme_options.active_color;
	var is_iphone = navigator.userAgent.toLowerCase().indexOf("iphone");
	var prk_sensi="";
	var prk_panel_event="";
	var titlify_bars_width=0;
	var dunk=0;
	var prk_shifter=0;
	if (jQuery('html').hasClass('no-csstransforms3d')) {
		jQuery('#st-container').addClass('no-csstransforms3d');
	}	
	//SHARING FUNCTIONS
	function prk_init_sharrre() {
		jQuery('.prk_sharrre_twitter').sharrre({
			share: {
			twitter: true
			},
			template: '<a class="box social_tipped" href="#" data-color="#43b3e5" title="Twitter"><div class="share"><div class="icon-twitter"></div></div></a><div class="count prk_sharrre_count" href="#">{total}</div>',
			enableHover: false,
			enableTracking: false,
			//buttons: { twitter: {via: 'username'}},
			click: function(api) {
				api.simulateClick();
				api.openPopup('twitter');
			},
			render: function(api){
				jQuery(".prk_sharrre_twitter a.social_tipped").tooltipster({
					touchDevices:false,
					theme:'tooltipster-light',
					position:'top-left',
					offsetY:-2,
					offsetX:-6
				});
			}
		});
		jQuery('.prk_sharrre_facebook').sharrre({
			share: {
				facebook: true
			},
			template: '<a class="box social_tipped" href="#" data-color="#1f69b3" title="Facebook"><div class="share"><div class="icon-facebook"></div></div></a><div class="count prk_sharrre_count" href="#">{total}</div>',
			enableHover: false,
			enableTracking: false,
			click: function(api) {
				api.simulateClick();
				api.openPopup('facebook');
			},
			render: function(api){
				jQuery(".prk_sharrre_facebook a.social_tipped").tooltipster({
					touchDevices:false,
					theme:'tooltipster-light',
					position:'top-left',
					offsetY:-2,
					offsetX:-4
				});
			}
		});
		jQuery('.prk_sharrre_google').sharrre({
			share: {
				googlePlus: true
			},
			template: '<a class="box social_tipped" href="#" data-color="#222222" title="Google +"><div class="share"><span></span><div class="icon-gplus"></div></div></a><div class="count prk_sharrre_count" href="#">{total}</div>',
			enableHover: false,
			enableTracking: false,
			click: function(api) {
				api.simulateClick();
				api.openPopup('googlePlus');
			},
			render: function(api){
				jQuery(".prk_sharrre_google a.social_tipped").tooltipster({
					touchDevices:false,
					theme:'tooltipster-light',
					position:'top-left',
					offsetY:-2,
					offsetX:-4
				});
			}
		});
		var pinterestMedia="";
		jQuery('.prk_sharrre_pinterest').sharrre({
			share: {
				pinterest: true
			},
			buttons: {
				pinterest: {
				media: pinterestMedia,
				description: ''
				}   
			},
			template: '<a class="box social_tipped" href="#" data-color="#df2126" title="Pinterest"><div class="share"><span></span><div class="icon-pinterest"></div></div></a><div class="count prk_sharrre_count" href="#">{total}</div>',
			enableHover: false,
			enableTracking: false,
			click: function(api) {
				api.simulateClick();
				api.openPopup('pinterest');
			},
			render: function(api){
				jQuery(".prk_sharrre_pinterest a.social_tipped").tooltipster({
					touchDevices:false,
					theme:'tooltipster-light',
					position:'top-left',
					offsetY:-2,
					offsetX:-4
				});
			}
		});
		jQuery('.prk_sharrre_linkedin').sharrre({
			share: {
				linkedin: true
			},
			template: '<a class="box social_tipped" href="#" data-color="#1a7696" title="LinkedIn"><div class="share"><div class="icon-linkedin"></div></div></a><div class="count prk_sharrre_count" href="#">{total}</div>',
			enableHover: false,
			enableTracking: false,
			click: function(api) {
				api.simulateClick();
				api.openPopup('linkedin');
			},
			render: function(api){
				jQuery(".prk_sharrre_linkedin a.social_tipped").tooltipster({
					touchDevices:false,
					theme:'tooltipster-light',
					position:'top-left',
					offsetY:-2,
					offsetX:-4
				});
			}
		});
		jQuery('.prk_sharrre_stumbleupon').sharrre({
			share: {
				stumbleupon: true
			},
			template: '<a class="box social_tipped" href="#" data-color="#ef4e23" title="Stumbleupon"><div class="share"><div class="icon-stumbleupon"></div></div></a><div class="count prk_sharrre_count" href="#">{total}</div>',
			enableHover: false,
			enableTracking: false,
			click: function(api) {
				api.simulateClick();
				api.openPopup('stumbleupon');
			},
			render: function(api){
				jQuery(".prk_sharrre_stumbleupon a.social_tipped").tooltipster({
					touchDevices:false,
					theme:'tooltipster-light',
					position:'top-left',
					offsetY:-2,
					offsetX:-3
				});
			}
		});
		jQuery('.prk_sharrre_delicious').sharrre({
			share: {
				delicious: true
			},
			template: '<a class="box social_tipped" href="#" data-color="#3274d1" title="Delicious"><div class="share"><div class="icon-delicious"></div></div></a><div class="count prk_sharrre_count" href="#">{total}</div>',
			enableHover: false,
			enableTracking: false,
			click: function(api) {
				api.simulateClick();
				api.openPopup('delicious');
			},
			render: function(api){
				jQuery(".prk_sharrre_delicious a.social_tipped").tooltipster({
					touchDevices:false,
					theme:'tooltipster-light',
					position:'top-left',
					offsetY:-2,
					offsetX:-4
				});
			}
		});
		jQuery('.prk_sharrre_pinterest').live('mouseover', function() { 
			jQuery('#prk_pint').attr('data-media',jQuery(this).attr('data-media'));
		});
	}
	//PARENT LINKS
	jQuery('#menu_section .sf-menu>li>a').hover(function() {
		if (is_mobile()===false) {
			if(!jQuery('#menu_section').hasClass('under_logo')) {
				jQuery(this).stop().animate({
					delay:100,
					color:theme_options.menu_active_color,
					duration:150
				});
				jQuery(this).parent().stop().animate({
					delay:100,
					backgroundColor:theme_options.menu_active_bk_color,
					duration:150
				});
			}
		}
	},
	function() {
		if((!jQuery('#menu_section').hasClass('under_logo') && !jQuery(this).parent().hasClass('active'))) {
			jQuery(this).stop().animate({
				color:theme_options.menu_up_color,
				duration:150
			});
			jQuery(this).parent().stop().animate({
				backgroundColor:theme_options.background_color_menu,
				duration:150
			});
		}
	});
	//SUBMENU LINKS
	jQuery('#menu_section .sub-menu>li>a').hover(
	function() {
		if (is_mobile()===false) {
			if(!jQuery('#menu_section').hasClass('under_logo')) {
				jQuery(this).stop().animate({
					delay:100,
					color:theme_options.menu_active_color,
					duration:150
				});
				jQuery(this).parent().stop().animate({
					delay:100,
					backgroundColor:theme_options.menu_active_bk_color,
					duration:150
				});
			}
		}
	},
	function() {
		if(!jQuery('#menu_section').hasClass('under_logo') && !jQuery(this).parent().hasClass('active')) {
			jQuery(this).stop().animate({
				color:theme_options.menu_up_color,
				duration:150
			});
			jQuery(this).parent().stop().animate({
				backgroundColor:theme_options.background_color_menu,
				duration:150
			});
		}
	});
	//ADD ELEMENTS TO SUBMENUS
	jQuery('.sf-menu ul.sub-menu').each(function() {
		jQuery(this).addClass('clearfix'); 
	});

	//CHECK FOR CART TEXT
	var prk_cart_txt="";
	if (jQuery('#prk_hidden_cart').length) {
		prk_cart_txt=jQuery('#prk_hidden_cart').find('.prk_cart_label').text();
	}

	function activate_menu_links() {
		//CHECK IF THERE'S A PARENT PAGE THAT HAS AN ACTIVE SUBPAGE
		jQuery('#nav-main ul.sf-menu>li.active ul.sub-menu li.active').each(function() {
			jQuery(this).parent().parent().removeClass('active');
		});
		//HIGHLIGHT BLOG OR PORTFOLIO IF NEEDED
		jQuery('#nav-main ul li a').each(function() {
			if (jQuery(this).attr('data-color')!==undefined) {
			}
			else {
				jQuery(this).attr('data-color',theme_options.active_color);
			}
			jQuery(this).addClass('fade_anchor_menu');
		});
		update_menu(jQuery(location).attr('href'));
	}
	activate_menu_links();

	//BLOG ISOTOPE FUNCTIONS
	var $container_blog = jQuery('#blog_entries_masonr');
	function rearrange_cols() {
		var columns = Math.ceil(($container_blog.width())/parseInt(jQuery('#blog_entries_masonr').attr('data-max-width'),10));
		var entry_width = $container_blog.width()/columns;
		entry_width = Math.floor(entry_width);
		//FORCE COLUMNS TO HAVE A MINIMUM SIZE
		if (entry_width<parseInt(jQuery('#blog_entries_masonr').attr('data-min-width'),10)) {
			columns--;	
		}
		entry_width = ($container_blog.width())/columns;
		entry_width = Math.floor(entry_width);
		jQuery(".blog_entry_li").each(function() {
			jQuery(this).css({"width":entry_width});
			jQuery(this).find('.blog_fader_grid').height(jQuery(this).find('.grid_image').height());
		});
	}
	function rearrange_layout() {
		var winWidth = jQuery(window).width();
		rearrange_cols();
		$container_blog.isotope('reLayout',function(){
			//DELAY CALCULATIONS IF WE ARE SCALING DOWN THE STAGE
			if(jQuery(window).width() !== winWidth) {
				setTimeout(function(){ rearrange_layout();},10);
			}
		});
	}
	function init_blog() {
		if (jQuery('.recentposts_ul_shortcode').length) {
			jQuery('.recentposts_ul_shortcode .featured_color').each(function() {
				jQuery(this).find('.not_zero_color').stop().css({'color':jQuery(this).attr('data-color')});
				jQuery(this).find('.theme_button a,.theme_button input').stop().css({'background-color':jQuery(this).attr('data-color')});
				jQuery(this).find('.theme_button a,.theme_button input,.theme_button_inverted a,.zero_color a,.default_color a').attr('data-color',jQuery(this).attr('data-color'));
				jQuery(this).find('.blog_fader_grid').stop().css({'background-color':hex2rgb(jQuery(this).attr('data-color'),theme_options.custom_opacity)});
			});
		}
		if (jQuery('#blog_entries_masonr').length) {
			jQuery('#blog_entries_masonr').fitVids();
			$container_blog = jQuery('#blog_entries_masonr');
			var minus_sm=parseInt(jQuery('#blog_entries_masonr').attr('data-margin'),10)-4;
			if (jQuery('.sidebarized').length) {
				jQuery('#blog_entries_masonr').css({'margin':'-'+jQuery('#blog_entries_masonr').attr('data-margin')+'px -'+jQuery('#blog_entries_masonr').attr('data-margin')+'px '+jQuery('#blog_entries_masonr').attr('data-margin')+'px -'+jQuery('#blog_entries_masonr').attr('data-margin')+'px'});
			}
			else {
				jQuery('#blog_entries_masonr').css({'margin':jQuery('#blog_entries_masonr').attr('data-margin')+'px '+minus_sm+'px '+jQuery('#blog_entries_masonr').attr('data-margin')+'px '+jQuery('#blog_entries_masonr').attr('data-margin')+'px'});
			}
			var img_load=imagesLoaded("#blog_entries_masonr");
			img_load.on('always', function() {
				NProgress.done();
				$container_blog.prepend('<div class="grid-sizer"></div>');
				$container_blog.isotope({
					itemSelector : '.blog_entry_li',
					masonry:{columnWidth:'.grid-sizer'},
					transitionDuration:'0.6s'
				});
				
				setTimeout(function(){ 
					jQuery(window).trigger("debouncedresize");
					jQuery('#blog_entries_masonr').delay(200).animate({
						opacity:1
					}, 
					{
						easing:'linear',
						duration:300
					});
				},50);
				jQuery('#blog_entries_masonr .featured_color').each(function() {
					jQuery(this).find('.not_zero_color').stop().css({'color':jQuery(this).attr('data-color')});
					jQuery(this).find('.theme_button a').stop().css({'background-color':jQuery(this).attr('data-color')});
					jQuery(this).find('.theme_button a,.theme_button_inverted a,.zero_color a,.default_color a').attr('data-color',jQuery(this).attr('data-color'));
					jQuery(this).find('.blog_fader_grid').stop().css({'background-color':hex2rgb(jQuery(this).attr('data-color'),theme_options.custom_opacity)});
				});
			});
		}
		if (jQuery('#classic_blog_section').length) {
			jQuery('#classic_blog_section').fitVids();
			jQuery('#classic_blog_section .featured_color').each(function() {
				jQuery(this).find('.not_zero_color').stop().css({'color':jQuery(this).attr('data-color')});
				jQuery(this).find('.theme_button a').stop().css({'background-color':jQuery(this).attr('data-color')});
				jQuery(this).find('.theme_button a,.theme_button_inverted a,.zero_color a,a.zero_color,.default_color a').attr('data-color',jQuery(this).attr('data-color'));
				jQuery(this).find('.blog_fader_grid').stop().css({'background-color':hex2rgb(jQuery(this).attr('data-color'),theme_options.custom_opacity)});
			});
			var img_load=imagesLoaded("#classic_blog_section");
			img_load.on('always', function() {
				NProgress.done();
				jQuery('#classic_blog_section').delay(200).animate({
					opacity:1
				}, 
				{
					easing:'linear',
					duration:300
				});
				jQuery('#sidebar').delay(200).animate({
					opacity:1
				}, 
				{
					easing:'linear',
					duration:300
				});
			});
		}
		if (jQuery('#single_blog_content.featured_color').length) {
			jQuery('#single_blog_content.featured_color').each(function() {
				jQuery(this).find('.not_zero_color,.not_zero_color a').stop().css({'color':jQuery(this).attr('data-color')});
				jQuery(this).find('.theme_button a').stop().css({'background-color':jQuery(this).attr('data-color')});
				jQuery(this).find('.blog_fader_grid').stop().css({'background-color':hex2rgb(jQuery(this).attr('data-color'),theme_options.custom_opacity)});
				jQuery(this).find('.theme_button a,.theme_button_inverted a,.zero_color a,a.zero_color,.default_color a,a.default_color').attr('data-color',jQuery(this).attr('data-color'));
			});
			jQuery('.theme_button input').stop().css({'background-color':jQuery('#single_blog_content.featured_color').attr('data-color')});
			jQuery("#sidebar,#sidebar a,.theme_button input").attr('data-color',jQuery('#single_blog_content.featured_color').attr('data-color'));
			jQuery('#sidebar .not_zero_color').stop().delay(50).animate({'color':jQuery('#single_blog_content.featured_color').attr('data-color')}, 500);
		}
		jQuery('.video-container,.soundcloud-container').css({opacity:1});
	}
	function init_member() {
		if (jQuery('.member_ul').length) {
			jQuery('.member_ul li').each(function() {
				if (jQuery('this').attr('data-color')!=="default") {
					jQuery(this).find('.zero_color a,.default_color a,a.zero_color').attr({'data-color':jQuery(this).attr('data-color')});
				}
			});
		}
		if (jQuery('#member_full_row').length && jQuery('#member_full_row').attr('data-color')!=="default") {
			jQuery('#member_full_row .prk_button_like,#member_full_row .prk_blockquote.colored_background').css({'background-color':jQuery('#member_full_row').attr('data-color')});
			jQuery('#members_nav .zero_color a').attr({'data-color':jQuery('#member_full_row').attr('data-color')});
		}
	}

	//PORTFOLIO ISOTOPE FUNCTIONS
	var $container="";
	var grid_helper="";
	var portfolio_gutter=0;
	var curr_filter="p_all";
	//FILTER FUNCTIONS
	function calculate_filters() {
		if (jQuery('#folio_masonry').length) {
			portfolio_gutter=parseInt(jQuery('#folio_masonry').attr('data-margin'),10);
			//jQuery('#folio_masonry .portfolio_entry_li').css({'margin-bottom':portfolio_gutter});
			jQuery('#pir_categories ul.filter li a').each(function() {
				var classes = jQuery(this).attr("data-filter").split(" "); 
				var in_counter=0;
				jQuery('#folio_masonry>div').each(
				function()
				{
					if (jQuery(this).hasClass(classes)) {
						in_counter++;
					}
				});
				jQuery(this).attr("data-q_counter",in_counter);
			});
		}
	}
	//calculate_filters();
	var first_cross=true;
	function init_portfolio() {
		jQuery('#pir_categories ul.filter li a').live().click(function(e) {
			e.preventDefault();
			jQuery('#pir_categories ul.filter li').removeClass('active');
			curr_filter = jQuery(this).attr('data-filter').split(' ');
			jQuery(this).parent().addClass('active');
			setTimeout(function(){ jQuery(window).trigger( "smartresize");},0);
			$container.isotope({
				filter: '.'+curr_filter
			});
		});
		//PORTFOLIO SHORTCODE
		jQuery('.scode_categories .filter li a').live().click(function(e) {
			if (!jQuery(this).hasClass('pf_link')) {
				e.preventDefault();
				jQuery('.scode_categories .filter li').removeClass('active');
				curr_filter = jQuery(this).attr('data-filter').split(' ');
				jQuery(this).parent().addClass('active');
				setTimeout(function(){ jQuery(window).trigger( "smartresize");},0);
				$container.isotope({
					filter: '.'+curr_filter
				});
			}
		});
		jQuery('.astro_iso_gallery').each(function() {
			var $container_gals = jQuery(this);
			$container_gals.prepend('<div class="grid-sizer"></div>');
			var iso_gallery_gutter=parseInt($container_gals.attr('data-margin'),10);
			$container_gals.css({'margin-left':iso_gallery_gutter});
			$container_gals.css({'margin-top':iso_gallery_gutter});
			//$container_gals.find('.portfolio_entry_li').css({'margin-bottom':Math.floor(iso_gallery_gutter/2)});
			var img_load=imagesLoaded($container_gals);
			img_load.on('always', function() {
				NProgress.done();
				first_cross=true;
				$container_gals.css({'display':'block','opacity':0});
				var img_nr=2;
				/*if ($container_gals .attr('data-columns')==="variable") {
					img_nr=Math.ceil($container_gals.width()/430);
				}
				else {	
					img_nr=$container_gals.attr('data-columns');
				}
				var helper= Math.floor($container_gals.width() / img_nr);*/
				$container_gals.isotope({
					itemSelector : '.portfolio_entry_li',
					masonry:{columnWidth:'.grid-sizer'},
					transitionDuration:'0.6s'
				});
				jQuery(window).trigger("debouncedresize");
				setTimeout(function(){ 
					$container_gals.animate({
						opacity:1
					}, 
					{
						easing:'linear',
						duration:300
					});
					$container_gals.addClass('ignited');
				},200);

				/*$container_gals.isotope({
					itemSelector : '.portfolio_entry_li',
					resizable: false, // disable normal resizing
					// set columnWidth to a percentage of container width
					masonry: { columnWidth: $container_gals.width() / img_nr },
					transformsEnabled : false,
					animationEngine : "jquery"
					},
					function() {
						$container_gals.find('.portfolio_entry_li,.inset_shadow,.prk_overlayer').css({'width':helper});
						
						//NO 1 PIXEL SPACING SOMETIMES!
						
					});*/
			});
			/*jQuery(window).smartresize(function() {
				//SET THE NUMBER OF IMAGES TO SHOW
				var img_nr=2;
				if (jQuery(window).width()<(768 - scrollbar_width)) {
					
					if (jQuery(window).width()<(420 - scrollbar_width)) {
						img_nr=1;
					}
				}
				else 
				{
					if ($container_gals.attr('data-columns')==="variable") {
						img_nr=Math.ceil($container_gals.width()/430);
					}
					else {	
						img_nr=$container_gals.attr('data-columns');
					}
				}
				$container_gals.find('.portfolio_entry_li').css({'width':'auto'});
				var helper= Math.floor($container_gals.width() / img_nr);
				$container_gals.find('.portfolio_entry_li,.portfolio_entry_li img').css({'width':helper});
				$container_gals.isotope({
					animationOptions: {
					duration: first_cross === true ? 10 : 450,
					easing:'linear',
				},
					// update columnWidth to a percentage of container width
					masonry: { columnWidth: Math.floor($container_gals.width() / img_nr) }
				},
				function() {

				});
				//TRICK TO MAKE SURE THE FILTER WORKS
				if (curr_filter!=="p_all" && jQuery('#folio_father.dyn_loaded').length) {
					$container_gals.isotope({
						filter: '.p_all'
					});
					$container_gals.isotope({
						filter: '.'+curr_filter
					});
				}
				$container_gals.find('.portfolio_entry_li,.inset_shadow,.prk_overlayer').css({'width':helper-iso_gallery_gutter});
				first_cross=false;
			});*/
		});
		if (jQuery('#folio_masonry').length) {
			$container = jQuery('#folio_masonry');
			$container.prepend('<div class="grid-sizer"></div>');
			jQuery('#folio_masonry').css({'margin-left':portfolio_gutter});
			if (!jQuery('#filter_top').length) {
				jQuery('#folio_masonry').css({'margin-top':portfolio_gutter});
			}
			
			var img_load=imagesLoaded($container);
			img_load.on('always', function() {
				NProgress.done();
				first_cross=true;
				jQuery('.portfolio_entry_li img').each(function() 
				{
					if (grid_helper==="" && jQuery(this).attr('data-featured')==="no") {
						grid_helper=jQuery(this).parent().parent().parent().attr('id');
					}
                });
				$container.css({'display':'block'});
				$container.isotope({
					itemSelector : '.portfolio_entry_li',
					masonry:{columnWidth:'.grid-sizer'},
					transitionDuration:'0.6s'
				});
				jQuery('#folio_father').delay(200).animate({
					opacity:1
				}, 
				{
					easing:'linear',
					duration:300
				});
				setTimeout(function(){ jQuery(window).trigger( "smartresize");},10);
				jQuery('#folio_father').css({'min-height':height_fix+1});
			});
			/*jQuery(window).smartresize(function() {
				//SET THE NUMBER OF IMAGES TO SHOW
				var img_nr=2;
				if (jQuery(window).width()<(768 - scrollbar_width)) {
					
					if (jQuery(window).width()<(420 - scrollbar_width)) {
						img_nr=1;
					}
				}
				else 
				{
					if (jQuery('#folio_masonry').attr('data-columns')==="variable") {
						img_nr=Math.ceil($container.width()/430);
					}
					else {	
						img_nr=jQuery('#folio_masonry').attr('data-columns');
					}
				}
				jQuery('.portfolio_entry_li').css({'width':'auto'});
				var helper= Math.floor($container.width() / img_nr);
				jQuery('.portfolio_entry_li,.portfolio_entry_li img').css({'width':helper});
				jQuery('.portfolio_entry_li img').each(function() 
				{
					if (jQuery(this).attr('data-featured')==="yes") {
						jQuery(this).height(parseInt(jQuery('#'+grid_helper).height()*2+portfolio_gutter,10));
					}
                });
				$container.isotope({
					animationOptions: {
					duration: first_cross === true ? 10 : 450,
					easing:'linear',
				},
					// update columnWidth to a percentage of container width
					masonry: { columnWidth: Math.floor($container.width() / img_nr) }
				},
				function() {

				});
				//TRICK TO MAKE SURE THE FILTER WORKS
				if (curr_filter!=="p_all" && jQuery('#folio_father.dyn_loaded').length) {
					$container.isotope({
						filter: '.p_all'
					});
					$container.isotope({
						filter: '.'+curr_filter
					});
				}
				setTimeout(function(){ check_and_load()},10);
				jQuery('.portfolio_entry_li,.inset_shadow,.prk_overlayer').css({'width':helper-portfolio_gutter});
				first_cross=false;
			});*/
		}
		if (jQuery('#folio_carousel').length) {
			jQuery('.titled_block .grid_single_title>a').each(function() {
				if (jQuery(this).attr('data-color')!=="default" && jQuery(this).attr('data-color')!==undefined) {
					//jQuery(this).css({'color':jQuery(this).attr('data-color')});
					jQuery(this).parent().parent().css({'background-color':hex2rgb(jQuery(this).attr('data-color'),theme_options.carousel_background_opacity)});
					//jQuery(this).parent().parent().find('.inner_skills a').attr('data-color',jQuery(this).attr('data-color'));
				}	
			});
			jQuery('#folio_father,#folio_carousel').css({'min-height':height_fix});
			var img_load=imagesLoaded('#folio_carousel');
			img_load.on('always', function() {
				NProgress.done();
				if (prk_panel_event==="click") {
					jQuery('.prk_panel_lnk').removeClass('fade_anchor');
					jQuery(".prk_panel_lnk").click(function() {
						event.preventDefault();
					});
				}
				jQuery('#folio_carousel').accordionSlider({
					width:'100%',
					height: '100%',
					shadow: true,
					autoplay:false,
					visiblePanels:jQuery('#folio_carousel').attr('data-columns'),
					mouseDelay:100,
					openPanelDuration:500,
					closePanelDuration:500,
					mouseWheelTarget: 'page',
					startPanel:-1,
					maxOpenedPanelSize:'60%',
					openPanelOn:prk_panel_event,
					panelOverlap:false,
					panelOpenComplete: function(event) {
						var panel_string='#prk_panel-'+event.index;
						jQuery(panel_string).children('.prk-panel').children('.as-prk-bottom').css({'margin-top':0});
						jQuery(panel_string).children('.prk-panel').children('.as-prk-bottom').animate({'margin-top':-jQuery(panel_string).children('.prk-panel').children('.as-prk-bottom').children('.titled_block').height()-20},0);
						jQuery(panel_string).children('.prk-panel').find('.grid_single_title a.fade_anchor').removeClass('prk_first_anim');
						jQuery(panel_string).children('.prk-panel').find('.titled_block .inner_skills').removeClass('prk_first_anim');
						jQuery(panel_string).children('.prk-panel').find('.prk_heart_carousel').removeClass('prk_first_anim');
				    	setTimeout(function() {
				    		jQuery(panel_string).children('.prk-panel').find('.grid_single_title a.fade_anchor').addClass('prk_first_anim');
				    		jQuery(panel_string).children('.prk-panel').find('.titled_block .inner_skills').addClass('prk_first_anim');
				    		jQuery(panel_string).children('.prk-panel').find('.prk_heart_carousel').addClass('prk_first_anim');
				    	},580);

				    },
				    panelClick: function(event) {
					},
					breakpoints: {
				        767: {
				        	height: '101%',
				        	maxOpenedPanelSize:'50%',
				        	visiblePanels: 4, 
				        	orientation: 'vertical'},
				        640: {
				        	height: '101%',
				        	maxOpenedPanelSize:'46%', 
				        	visiblePanels: 3, 
				        	orientation: 'vertical'
				        }
				    }
				});
				jQuery('#folio_father').delay(200).animate({
					opacity:1
				}, 
				{
					easing:'linear',
					duration:300
				});
				jQuery('html').css({'overflow-y':'hidden'});
				setTimeout(function() {
					pirenko_resize();
					jQuery(window).trigger("smartresize");
					jQuery(window).trigger("debouncedresize");
				},150);
			});
		}
		if (jQuery('#prk_full_folio.featured_color').length) {
			jQuery('#full-entry-right .side_skills a,#prk_project_meta a,.prevnext_single_blog.on_folio a').attr('data-color',jQuery('#prk_full_folio.featured_color').attr('data-color'));
		}
		if (jQuery('#astro_featured_header.featured_color').length) {
			jQuery('#project_info .side_skills a').attr('data-color',jQuery('#astro_featured_header.featured_color').attr('data-color'));
		}
		jQuery('.video-container,.soundcloud-container').css({opacity:1});
	}

	//SEARCH FORM
	jQuery('#searchform').submit(function(e) {
		if (ajax_calls) {
			e.preventDefault();
			close_left_bar(400);
			var search_query=jQuery(this).attr('data-url')+jQuery(this).find('#astro_search').val();
			jQuery ('#sidebar').stop().transition({
				opacity:0,
				duration:300 
			});
			jQuery ('#main_block').stop().transition({
				opacity:0,
				duration:300 
			},function() {
				load_ajax_link(search_query,true);
				NProgress.start();
				if (jQuery('#prk_responsive_menu.at_top').length) {
					jQuery('#nprogress .bar').css({'top':'50px'});
					jQuery('#nprogress .spinner').css({'top':'65px'});
				}
			});
		}
	});
	jQuery('.sform_wrapper .icon-search').click(function() {
		jQuery('#searchform').submit();
	});

	//BACK TO TOP BUTTON
	jQuery(window).scroll(function() {
		if(jQuery(window).scrollTop() >= 180)
		{
			jQuery('#back_to_top-collapsed').css({'display':'inline'});
			jQuery('#back_to_top-collapsed').stop().animate({opacity: 1}, 300,
			function() {
			});
		}
		else
		{
			jQuery('#back_to_top-collapsed').stop().animate({opacity: 0}, 300,
			function() 
			{
				jQuery('#back_to_top-collapsed').css({'display':'none'});
			});
		}
		check_and_load();
	});
	//INITIALIZE BUTTON
	if(jQuery(window).scrollTop() >= 200)
    {
		jQuery('#back_to_top-collapsed').css({'display':'inline',opacity: 1});
	}
	else
	{
		jQuery('#back_to_top-collapsed').css({'display':'none',opacity: 0});	
	}
	jQuery('#back_to_top-collapsed').click(function() {
		jQuery('body,html').animate({scrollTop:0},600);
	});

	//SLIDERS INIT
	function init_sliders() {
		if (jQuery('#not_slider').length)
		{
			jQuery('#not_slider').fitVids();
			var img_load=imagesLoaded('#not_slider');
			img_load.on('always', function() {
				jQuery("#single_blog_content,#sidebar,#full-entry-right,#prk_full_size_single").addClass('prk_first_anim');
			});		
		}				
		//SINGLE PAGES SLIDER - BLOG
		if (jQuery('#single_slider').length) {
			jQuery('#single_slider .slides').css({'opacity':'0'});
			//jQuery('#single_slider').append('<div class="spinner"><div class="spinner-icon"></div></div>');
			jQuery('#single_slider').css({'opacity':1,'padding-bottom':'45px'});
			jQuery('#single_slider').addClass('loading_sld');
			$js_flexislider('#single_slider').fitVids().flexslider({
				slideshow : $js_flexislider('#single_slider>ul').attr('data-autoplay') === "true" ? true : false,
				slideshowSpeed : $js_flexislider('#single_slider>ul').attr('data-delay') !== undefined ? $js_flexislider('#single_slider>ul').attr('data-delay') : theme_options.delay_portfolio,
				smoothHeight: true, 
				controlNav: false,
				useCSS: 'false',
				pauseOnHover: true, 
				touch:true,
				start:function (slider) {
					//SHIFT BUTTONS IF VIDEO SLIDE
					if (jQuery('.flex-active-slide .prk-video-container').length) {
						jQuery('.flex-direction-nav li a.flex-next, .flex-direction-nav li a.flex-prev').transition({bottom:50}, 0 );
					}
					else {
						jQuery('.flex-direction-nav li a.flex-next, .flex-direction-nav li a.flex-prev').transition({bottom:14}, 0 );
					}
					if (slider.attr('data-color')!=="default") {
						jQuery('.flex-direction-nav li a.flex-next, .flex-direction-nav li a.flex-prev').attr('data-color',slider.attr('data-color'));
					}
					jQuery('.flex-direction-nav li a.flex-prev').each(function() 
					{
						jQuery(this).prepend('<div class="pirenko_tinted submenu_arrow_left"><div class="icon-left-open-big"></div></div>');
                    });
					jQuery('.flex-direction-nav li a.flex-next').each(function() 
					{
						jQuery(this).prepend('<div class="pirenko_tinted submenu_arrow_right"><div class="icon-right-open-big"></div></div>');
                    });
                    if (jQuery('#single_slider .slides>li').length===1) {
						jQuery('.flex-direction-nav').css({'display':'none'});
                    }
                    var img_load=imagesLoaded('#single_slider');
                    img_load.on('always', function() {
						setTimeout(function() {
							jQuery('#single_slider').css({'padding-bottom':'','opacity':0});
							jQuery('#single_slider').removeClass('loading_sld');
							jQuery('#single_slider .slides').css({'opacity':'1'});
							jQuery('#single_slider img').css({'width':'100%'});
							jQuery('#single_slider #slide_1').css({'display':'block'});
							jQuery(window).trigger("debouncedresize");
							jQuery('#single_slider').css({'height':jQuery('#single_slider>ul>li:nth-child(1) img').height()});
							if (jQuery('#single_slider>ul>li:nth-child(1) iframe').length) {
								jQuery('#single_slider').css({'height':jQuery('#single_slider>ul>li:nth-child(1) iframe').height()});
							}
							jQuery('#single_slider').stop().animate({
								opacity:1 },200,
								function() {
									if (jQuery('#single_slider').height()===0) {
										jQuery('#single_slider').css({'height':jQuery('#single_slider #slide_1 img').height()});
										if (jQuery('#single_slider #slide_1 iframe').length) {
											jQuery('#single_slider').css({'height':jQuery('#single_slider #slide_1 iframe').height()});
										}
									}
									if (jQuery('#single_slider #slide_1 img').length && jQuery('#single_slider').height()!==jQuery('#single_slider #slide_1 img').height()) {
										jQuery('#single_slider').css({'height':jQuery('#single_slider #slide_1 img').height()});
									}
									if (jQuery('#single_slider #slide_1 iframe').length) {
										jQuery('#single_slider').css({'height':jQuery('#single_slider #slide_1 iframe').height()});
									}
									jQuery('#after_single_folio').stop().animate({opacity:1 },200);
									jQuery(window).trigger("debouncedresize");
									jQuery("#single_blog_content,#sidebar,#full-entry-right,#prk_full_size_single").addClass('prk_first_anim');
								} 
							);
							jQuery('.flex-direction-nav').stop().animate({
								opacity:1 },200, 
								function() {
									
								} 
							);
						},350);	
                    });
                    
                    jQuery('#single_slider').magnificPopup({
						delegate: 'div.prk_magnificent_li',
						src:'data-src',
						type: 'image',
						tLoading: 'Loading image #%curr%...',
						fixedContentPos: false,
						fixedBgPos: true,
						closeOnContentClick: true,
						closeBtnInside: false,
						mainClass: 'mfp-no-margins my-mfp-zoom-in',
						removalDelay: 300,
						gallery: {
							enabled: true,
							navigateByImgClick: true,
							preload: [0,1] // Will preload 0 - before current, and 1 after the current image
						},
						image: {
							tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
							titleSrc: function(item) {
								return item.el.attr('title');
							}
						},
						callbacks: {
							open: function() {
								scrollbar_width=window.innerWidth-jQuery("body").width();
								jQuery('html').css({'padding-right':scrollbar_width});
								jQuery('html').css({'overflow-y':'hidden'});
								jQuery('.mfp-bg').css({'opacity':0.8});
							},
							beforeClose: function() {
								jQuery('.mfp-bg').css({'opacity':0});
							},
							close: function() {
								jQuery('html').css({'overflow-y':'','padding-right':''});
							}
						}
					});
				},
				before: function(slider) {
				},
				after: function()
				{
					//SHIFT BUTTONS IF VIDEO SLIDE
					if (jQuery('.flex-active-slide .prk-video-container').length) {
						jQuery('.flex-direction-nav li a.flex-next, .flex-direction-nav li a.flex-prev').transition({bottom:50}, 200 );
					}
					else {
						jQuery('.flex-direction-nav li a.flex-next, .flex-direction-nav li a.flex-prev').transition({bottom:14}, 200 );
					}
				}
			});
		}	
		$js_flexislider('.tiny_slider.per_init').each(function() {
			jQuery(this).removeClass('per_init');
			var delayer = Math.floor(Math.random() * 3000);
			$js_flexislider(this).flexslider({
				slideshow : true,
				slideshowSpeed : (parseInt(theme_options.delay_portfolio,10)-2000)>2000 ? parseInt(theme_options.delay_portfolio,10)-2000 : 2000,
				smoothHeight: false, 
				controlNav: false,
				useCSS: 'false',
				pauseOnHover: false, 
				initDelay:delayer,
				touch:false,
				startAt:0,
				start: function(){
					
				} 
			});
			jQuery(this).parent().parent().each(function() {
				jQuery(this).magnificPopup({
					delegate: 'div.prk_magnificent_li',
					src:'data-src',
					type: 'image',
					tLoading: 'Loading image #%curr%...',
					fixedContentPos: false,
					fixedBgPos: true,
					closeOnContentClick: true,
					closeBtnInside: false,
					mainClass: 'mfp-no-margins my-mfp-zoom-in',
					removalDelay: 300,
					gallery: {
						enabled: true,
						navigateByImgClick: true,
						preload: [0,1] // Will preload 0 - before current, and 1 after the current image
					},
					image: {
						tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
						titleSrc: function(item) {
							return item.el.attr('title');
						}
					},
					callbacks: {
						open: function() {
							scrollbar_width=window.innerWidth-jQuery("body").width();
							jQuery('html').css({'padding-right':scrollbar_width});
							jQuery('html').css({'overflow-y':'hidden'});
							jQuery('.mfp-bg').css({'opacity':0.8});
						},
						beforeClose: function() {
							jQuery('.mfp-bg').css({'opacity':0});
						},
						close: function() {
							jQuery('html').css({'overflow-y':'','padding-right':''});
						}
					}
				});
			});
		});
		//SHORTCODE SLIDERS	
		$js_flexislider('.shortcode_slider').not($js_flexislider('.shortcode_slider.super_height')).each(function() {
			$js_flexislider(this).flexslider({
				slideshow : $js_flexislider(this).attr('data-autoplay') === "true" ? true : false,
				slideshowSpeed : $js_flexislider(this).attr('data-delay') !== "" ? $js_flexislider(this).attr('data-delay') : theme_options.delay_portfolio,
				smoothHeight: true,
				controlNav: false,
				directionNav: $js_flexislider(this).find('ul').children('li').length > 1 ? true : false,
				useCSS: 'false',
				pauseOnHover: true,
				pauseOnAction:true,
				touch:true,
				start:function (slider) {
					//SHIFT BUTTONS IF VIDEO SLIDE
					if (jQuery('.flex-active-slide .fluid-width-video-wrapper').length) {
						jQuery('.flex-direction-nav li a.flex-next, .flex-direction-nav li a.flex-prev').transition({bottom:50}, 0 );
					}
					else {
						jQuery('.flex-direction-nav li a.flex-next, .flex-direction-nav li a.flex-prev').transition({bottom:14}, 0 );
					}
					var my_string='#'+jQuery(slider).find('ul').attr('id')+'top_0';
					var my_body_string='#'+jQuery(slider).find('ul').attr('id')+'body_0';
					var my_button_string='#'+jQuery(slider).find('ul').attr('id')+'slidebtn_0';
					jQuery(my_string).stop();
					jQuery(my_body_string).stop();
					jQuery(my_string).css({'left':'8px'});
					jQuery(my_body_string).css({'left':'-8px'});
					jQuery(my_button_string).css({'left':'8px','display':'inline-block'});
					if (jQuery(my_button_string).children('a').attr('data-color')!==undefined && jQuery(my_button_string).children('a').attr('data-color')!=="") {
						jQuery(my_button_string).css({'background-color':jQuery(my_button_string).children('a').attr('data-color')});
					}
					else {
						jQuery(my_button_string).css({'background-color':theme_options.active_color});
					}
					jQuery(my_string).transition({
						delay:600,
						opacity:1,
						duration:300,
						left:0
					});
					jQuery(my_body_string).transition({
						delay:800,
						opacity:1,
						duration:300,
						left:0
					});
					jQuery(my_button_string).transition({
						delay:1000,
						opacity:1,
						duration:300,
						left:0
					});
					jQuery('.flex-direction-nav').delay(1000).transition({opacity:1}, 300 );
					if (jQuery('.flex-direction-nav').length)
					{
						jQuery('.flex-direction-nav li a.flex-prev').each(function() 
						{
							jQuery(this).prepend('<div class="pirenko_tinted submenu_arrow_left"><div class="icon-left-open-big"></div></div>');
						});
						jQuery('.flex-direction-nav li a.flex-next').each(function() 
						{
							jQuery(this).prepend('<div class="pirenko_tinted submenu_arrow_right"><div class="icon-right-open-big"></div></div>');
						});
					}
					else {
						//IT'S A SINGLE SLIDE - HIDE CAPTIONS	
						jQuery(my_string).transition({
							delay:7500,
							opacity:0,
							duration:300,
							left:0
						});
						jQuery(my_body_string).transition({
							delay:7500,
							opacity:0,
							duration:300,
							left:0
						});
						jQuery(my_button_string).transition({
							delay:7500,
							opacity:0,
							duration:300,
							left:0
						});
					}
					jQuery('.sld_v_center').each(function() {
						jQuery(this).css({'margin-top':-parseInt(jQuery(this).height()/2,10)});
					});
					var img_load=imagesLoaded('.shortcode_slider #astro_slide_0');
					img_load.on('always', function() {
						jQuery(slider).height(jQuery(slider).find('#astro_slide_0').height());
						jQuery(window).trigger("debouncedresize");
						jQuery('.shortcode_slider').transition({opacity:1}, 300 );
                    });
				},
				before: function(slider) {
					var my_string='#'+jQuery(slider).find('ul').attr('id')+'top_'+slider.currentSlide;
					var my_body_string='#'+jQuery(slider).find('ul').attr('id')+'body_'+slider.currentSlide;
					var my_button_string='#'+jQuery(slider).find('ul').attr('id')+'slidebtn_'+slider.currentSlide;
					jQuery(my_string).stop().animate({opacity:0}, 200 );
					jQuery(my_body_string).stop().animate({opacity:0}, 200 );
					jQuery(my_button_string).stop().animate({
						opacity:0 },200, 
						function() {
							jQuery(my_button_string).css({'display':'none'});
						} 
					);
				},
				after: function(slider)
				{
					//SHIFT BUTTONS IF VIDEO SLIDE
					if (jQuery('.flex-active-slide .fluid-width-video-wrapper').length) {
						jQuery('.flex-direction-nav li a.flex-next, .flex-direction-nav li a.flex-prev').transition({bottom:50}, 200 );
					}
					else {
						jQuery('.flex-direction-nav li a.flex-next, .flex-direction-nav li a.flex-prev').transition({bottom:14}, 200 );
					}
					var my_string='#'+jQuery(slider).find('ul').attr('id')+'top_'+slider.currentSlide;
					var my_body_string='#'+jQuery(slider).find('ul').attr('id')+'body_'+slider.currentSlide;
					var my_button_string='#'+jQuery(slider).find('ul').attr('id')+'slidebtn_'+slider.currentSlide;
					jQuery(my_string).stop();
					jQuery(my_body_string).stop();
					jQuery(my_string).css({'left':'8px'});
					jQuery(my_body_string).css({'left':'-8px'});
					jQuery(my_button_string).css({'left':'8px','display':'inline-block'});
					if (jQuery(my_button_string).children('a').attr('data-color')!==undefined && jQuery(my_button_string).children('a').attr('data-color')!=="") {
						jQuery(my_button_string).children('a').css({'background-color':jQuery(my_button_string).children('a').attr('data-color')});
					}
					else {
						jQuery(my_button_string).children('a').css({'background-color':theme_options.active_color});
					}
					jQuery(my_string).transition({
						delay:600,
						opacity:1,
						duration:300,
						left:0
					});
					jQuery(my_body_string).transition({
						delay:800,
						opacity:1,
						duration:300,
						left:0
					});
					jQuery(my_button_string).transition({
						delay:1000,
						opacity:1,
						duration:300,
						left:0
					});
					jQuery('.sld_v_center').each(function() {
						jQuery(this).css({'margin-top':-parseInt(jQuery(this).height()/2,10)});
					});
				}
			});
		});
		//HOMEPAGE MAIN SLIDER	
		if ($js_flexislider('.shortcode_slider.super_height').length) {
			if (is_iphone > -1)
			{
				jQuery('body').css({height:'auto'});	
			}
			jQuery(window).on("debouncedresize", function( event ) {
				jQuery('.shortcode_slider.super_height .slides>li').each(function(index, element) {
					var minWidth=jQuery(this).parent().width();// Min width for the image
					var minHeight=height_fix+2;// Min height for the image
					var width=parseInt(jQuery(this).find('img.vsbl').attr('data-or_w'),10); 
					var height=parseInt(jQuery(this).find('img.vsbl').attr('data-or_h'),10);
					var ratio=minHeight / height;

					//FILL HEIGHT
					jQuery(this).find('img.vsbl').css("height", minHeight);  
					jQuery(this).find('img.vsbl').css("width", width * ratio); 
					//UPDATE VARS
					width = jQuery(this).find('img.vsbl').width(); 
					height = jQuery(this).find('img.vsbl').height(); 
					//FILL WIDTH IF NEEDED
					if(width < minWidth) {
						ratio = minWidth / width;
						jQuery(this).find('img.vsbl').css("width", minWidth);
						jQuery(this).find('img.vsbl').css("height", height * ratio);
					}
					//LIMIT SLIDER HEIGHT ON SMALL DEVICES
					if((is_mobile() && is_iphone > -1) || jQuery("#prk_responsive_menu.at_top").length) {
						jQuery('html').css({'overflow-y':''});
						jQuery('.main_with_sections').css({'overflow':'hidden'});
						if (Math.abs(window.orientation) === 90) {
							ratio = 210 / jQuery(this).find('img.vsbl').height(); // get ratio for scaling image
							jQuery(this).find('img.vsbl').css("height", 210);   // Set new height
							jQuery(this).find('img.vsbl').css("width", jQuery(this).find('img.vsbl').width() * ratio);    // Scale width based on ratio
							//width = width * ratio;    // Reset width to match scaled image
							if(jQuery(this).find('img').width() < (jQuery(window).width()+15)) {
								ratio = (jQuery(window).width()+15) / jQuery(this).find('img.vsbl').width();   // get ratio for scaling image
								jQuery(this).find('img.vsbl').css("width", jQuery(window).width()+15); // Set new width
								jQuery(this).find('img.vsbl').css("height", jQuery(this).find('img.vsbl').height() * ratio);  // Scale height based on ratio
								//height = height * ratio;    // Reset height to match scaled image
							}
						}
						else
						{
							ratio = 350 / jQuery(this).find('img.vsbl').height(); // get ratio for scaling image
							jQuery(this).find('img.vsbl').css("height", 350);   // Set new height
							jQuery(this).find('img.vsbl').css("width", jQuery(this).find('img.vsbl').width() * ratio);    // Scale width based on ratio
							//width = width * ratio;    // Reset width to match scaled image
							//if(jQuery(this).find('img').width() < jQuery(window).width()) {
								ratio = (jQuery(window).width()+15) / jQuery(this).find('img.vsbl').width();   // get ratio for scaling image
								jQuery(this).find('img.vsbl').css("width", jQuery(window).width()+15); // Set new width
								jQuery(this).find('img.vsbl').css("height", jQuery(this).find('img.vsbl').height() * ratio);  // Scale height based on ratio
								//height = height * ratio;    // Reset height to match scaled image
							//}
						}
						jQuery('.flex-control-nav').css({'top':15,'right':7});
					}
					else {
						jQuery('html').css({'overflow-y':'hidden'});
						jQuery('.main_with_sections').css({'overflow':''});
						jQuery('.flex-control-nav').css({'position':'relative'});
						var al_helper=jQuery('.flex-control-nav').outerHeight();
						jQuery('.flex-control-nav').css({'position':'absolute'});
						jQuery('.flex-control-nav').css({'right':'','top':parseInt((height_fix-al_helper)/2,10)});
					}
					//ADJUST MARGINS
					if (jQuery("#nav-main.resp_mode").length) 
					{
						jQuery(this).find('img.vsbl').css("margin-left",0);
					}
					else {
						jQuery(this).find('img.vsbl').css("margin-left",-(jQuery(this).find('img').width()-minWidth)/2);
					}
					if (jQuery(window).width()<780) {
						jQuery(this).find('img.vsbl').css("margin-top",0);
					}
					else {
						jQuery(this).find('img.vsbl').css("margin-top",-(jQuery(this).find('img.vsbl').height()-minHeight)/2);
					}
					if (!jQuery(this).find('.slider_text_holder').hasClass('sld_top')) {
						var btm_dis=parseInt(jQuery(this).find('.slider_text_holder').outerHeight(),10);
						jQuery(this).find('.slider_text_holder').css({"bottom":-parseInt(jQuery(this).find('img.vsbl').css("margin-top"),10)+35});
					}
					jQuery('.sld_v_center').each(function() {
						jQuery(this).css({'margin-top':Math.ceil(-parseInt(jQuery(this).height()/2,10)+parseInt(jQuery(this).parent().children('img.vsbl').css('margin-top'),10)/2)});
					});
					//ALSO FORCE YOUTUBE AND VIMEO VIDEO DIMENSIONS - FIX FOR IE AND FIREFOX
					jQuery(this).find('iframe,.fluid-width-video-wrapper').css("height", height_fix+1);
				});
				if((is_mobile() && is_iphone > -1) || jQuery("#prk_responsive_menu.at_top").length) {
					jQuery('.shortcode_slider.super_height .flex-direction-nav li a').css({'top':jQuery('.shortcode_slider.super_height').height()/2});
					jQuery('.shortcode_slider.super_height').css({'height':jQuery('.shortcode_slider.super_height .flex-active-slide').height()});
					jQuery('iframe,.fluid-width-video-wrapper,.shortcode_slider.super_height').css({'height':''});
				}
				else {
					jQuery('.shortcode_slider.super_height').css({'height':''});
					jQuery('.shortcode_slider.super_height .flex-direction-nav li a').css({'top':height_fix/2});
				}
			});//DEBOUNCED RESIZE
			$js_flexislider('.shortcode_slider.super_height .slides').css({'display':'none'});
			$js_flexislider('.shortcode_slider.super_height').append('<div class="spinner"><div class="spinner-icon"></div></div>');
			$js_flexislider('.shortcode_slider.super_height').css({'opacity':1});
			jQuery('#bottom_sidebar').css({'display':'none'});
			jQuery('html').css({'overflow-y':'hidden'});
			$js_flexislider('.shortcode_slider.super_height').flexslider({
				slideshow : $js_flexislider('.shortcode_slider.super_height').attr('data-autoplay') === "true" ? true : false,
				slideshowSpeed : $js_flexislider('.shortcode_slider.super_height').attr('data-delay'),
				smoothHeight: false,
				controlNav: true,
				directionNav:false,
				pauseOnHover: $js_flexislider('.shortcode_slider.super_height').attr('data-hover') === "true" ? true : false,
				touch:true,
				start:function (slider){
					jQuery('.flexslider').css({'min-height':0});
					if (jQuery('.flex-direction-nav').length)
					{
						jQuery('.flex-direction-nav li a.flex-prev').each(function() 
						{
							jQuery(this).prepend('<div class="pirenko_tinted submenu_arrow_left"><div class="icon-left-open-big"></div></div>');
						});
						jQuery('.flex-direction-nav li a.flex-next').each(function() 
						{
							jQuery(this).prepend('<div class="pirenko_tinted submenu_arrow_right"><div class="icon-right-open-big"></div></div>');
						});
					}
					//ADJUST TEXT TO BE SHOWN
					var my_string='#'+jQuery(slider).find('ul').attr('id')+'top_0';
					var my_body_string='#'+jQuery(slider).find('ul').attr('id')+'body_0';
					var my_button_string='#'+jQuery(slider).find('ul').attr('id')+'slidebtn_0';
					jQuery(my_string).stop();
					jQuery(my_body_string).stop();
					jQuery(my_string).css({'left':'8px','opacity':'0'});
					jQuery(my_body_string).css({'left':'-8px','opacity':'0'});
					jQuery(my_button_string).css({'left':'8px','display':'inline-block','opacity':'0'});
					if (jQuery(my_button_string).children('a').attr('data-color')!==undefined && jQuery(my_button_string).children('a').attr('data-color')!=="") {
						jQuery(my_button_string).children('a').css({'background-color':jQuery(my_button_string).children('a').attr('data-color')});
					}
					else {
						jQuery(my_button_string).children('a').css({'background-color':theme_options.active_color});
					}
					jQuery(my_string).stop().delay(600).animate({'opacity':'1','left':'0px'}, 300 );
					jQuery(my_body_string).stop().delay(800).animate({'opacity':'1','left':'0px'}, 300 );
					jQuery(my_button_string).stop().delay(1000).animate({'opacity':'1','left':'0px'}, 300 );
					if (jQuery('.shortcode_slider.super_height .slides>li').length===1) {
						jQuery('.flex-direction-nav').css({'display':'none'});
                    }
                    jQuery('.flex-control-nav li a').live('mouseover', function() {
						jQuery(this).css({'backgroundColor': $js_flexislider('.shortcode_slider.super_height').attr('data-color'),'box-shadow':'0x 0px 1px '+hex2rgb($js_flexislider('.shortcode_slider.super_height').attr('data-color'),0.75)});
					});
					jQuery('.flex-control-nav li a').live('mouseout', function() {
						if (!jQuery(this).hasClass('flex-active')) {
							jQuery(this).css({'backgroundColor': '','box-shadow':''});
						}
					});
                    var img_load=imagesLoaded('.shortcode_slider.super_height #astro_slide_0');
                    img_load.on('always', function() {
						jQuery('.flex-control-nav li a.flex-active').css({'background-color':$js_flexislider('.shortcode_slider.super_height').attr('data-color'),'box-shadow':'0px 0px 1px '+hex2rgb($js_flexislider('.shortcode_slider.super_height').attr('data-color'),0.75)});
						jQuery('.shortcode_slider.super_height').css({'opacity':0});
						jQuery('.shortcode_slider.super_height .slides').css({'display':'block'});
						jQuery('.shortcode_slider.super_height .spinner').remove();
						jQuery('.shortcode_slider.super_height').transition({opacity:1}, 300 );
						//ADJUST IMAGE SIZE
						jQuery(window).trigger("debouncedresize");
                    });
				},
				before: function(slider)
				{
					jQuery('.flex-control-nav li a.flex-active').css({'backgroundColor': '','box-shadow':'none'});
					var my_string='#'+jQuery(slider).find('ul').attr('id')+'top_'+slider.currentSlide;
					var my_body_string='#'+jQuery(slider).find('ul').attr('id')+'body_'+slider.currentSlide;
					var my_button_string='#'+jQuery(slider).find('ul').attr('id')+'slidebtn_'+slider.currentSlide;
					jQuery(my_string).stop().animate({opacity:0}, 200 );
					jQuery(my_body_string).stop().animate({opacity:0}, 200 );
					jQuery(my_button_string).stop().animate({
						opacity:0 },200, 
						function() {
							jQuery(my_button_string).css({'display':'none'});
						} 
					);
				},
				after: function(slider) {
					if ((is_mobile() && is_iphone > -1) || jQuery("#prk_responsive_menu.at_top").length) {
						jQuery('.shortcode_slider.super_height').css({'height':jQuery('.shortcode_slider.super_height #astro_slide_'+slider.currentSlide).height()});
					}
					jQuery('.flex-control-nav li a').css({'box-shadow':''});
					jQuery('.flex-control-nav li a.flex-active').css({'backgroundColor': $js_flexislider('.shortcode_slider.super_height').attr('data-color'),'box-shadow':'0px 0px 1px '+hex2rgb($js_flexislider('.shortcode_slider.super_height').attr('data-color'),0.75)});
					var my_string='#'+jQuery(slider).find('ul').attr('id')+'top_'+slider.currentSlide;
					var my_body_string='#'+jQuery(slider).find('ul').attr('id')+'body_'+slider.currentSlide;
					var my_button_string='#'+jQuery(slider).find('ul').attr('id')+'slidebtn_'+slider.currentSlide;
					jQuery(my_string).stop();
					jQuery(my_body_string).stop();
					jQuery(my_string).css({'left':'8px'});
					jQuery(my_body_string).css({'left':'-8px'});
					jQuery(my_button_string).css({'left':'8px','display':'inline-block'});
					if (jQuery(my_button_string).children('a').attr('data-color')!==undefined && jQuery(my_button_string).children('a').attr('data-color')!=="") {
						jQuery(my_button_string).children('a').css({'background-color':jQuery(my_button_string).children('a').attr('data-color')});
					}
					else {
						jQuery(my_button_string).children('a').css({'background-color':theme_options.active_color});
					}
					jQuery(my_string).transition({
						delay:600,
						opacity:1,
						duration:300,
						left:0
					});
					jQuery(my_body_string).transition({
						delay:800,
						opacity:1,
						duration:300,
						left:0
					});
					jQuery(my_button_string).transition({
						delay:1000,
						opacity:1,
						duration:300,
						left:0
					});
					jQuery('.sld_v_center').each(function() {
						jQuery(this).css({'margin-top':-parseInt(jQuery(this).height()/2,10)});
					});
				}
			});
		}
	}
	//LIKE FEATURE
	jQuery(".pir_like").live("click",function(event) {
		event.preventDefault();
		//CHECK IF WE ARE CLICKING ON THE BUTTON THAT "SHOULD" BE INACTIVE
		if (jQuery(this).hasClass('alreadyvoted'))
		{
			return false;
		}
		else
		{
			var heart = jQuery(this);
			var post_id = heart.data("post_id");
			var in_likes_txt=theme_options.likes_text;
			jQuery.ajax(
			{
				type: "post",
				url: ajax_var.url,
				data: "action=post-like&nonce="+ajax_var.nonce+"&post_like=&post_id="+post_id,
				success: function(count) {
					if(count !== "already"){
						heart.addClass("alreadyvoted");
						heart.find(".like_count").text(''+count+' '+in_likes_txt);
						heart.tooltipster('hide');
						setTimeout(function(){ heart.tooltipster('update', heart.attr("data-no_more"));},300); 
					}
				}
			});
			return false;
		}
	});
	jQuery('#nav-collapsed-icon').hover(function() {
			if (is_mobile()===false) {
				jQuery(this).addClass('hover_trigger');
				jQuery(this).children('.prk_menu_block').stop().animate({'background-color':theme_options.active_color}, 250);
			}
		},
		function() {
			jQuery(this).removeClass('hover_trigger');
			jQuery(this).children('.prk_menu_block').stop().animate({'background-color':theme_options.color_header}, 250);
		}
	);
	//THUMBS ROLLOVER
	//SMOOTHER HOVER COLORS
	var main_color_elements=".smoothed_a,.zero_color a,a.zero_color,.default_color a,a.default_color,#mini_social_nets a,#footer_in a,#top_widgets_in a,#back_to_top-collapsed,#prk_fullscreen_wrapper,.pir_like";
	var inv_color_elements=".inv_smoothed_a";
	var alt_color_elements=".alt_smoothed_a,.tweet_body a";
	var opacity_color_elements=".as-layer a.fade_anchor,.as-layer .inner_skills a,.as-layer .post-like a";
	function thumbs_roll() {
		jQuery(inv_color_elements).hover(
			function() {
				if (is_mobile()===false) {
					jQuery(this).stop().transition({
					color:theme_options.menu_up_color,
					duration:250
					});
				}
			},
			function() {
					jQuery(this).stop().transition({
				color:'',
				duration:250
				});
			}
		);
		jQuery(opacity_color_elements).hover(
			function() {
				if (is_mobile()===false) {
					if (jQuery(this).children('.like_count').length) {
						jQuery(this).children('.like_count').stop().animate({
							opacity:0.8
						},
						{
							easing:'linear',
							duration:250,
						});
					}
					else {
						jQuery(this).stop().animate({
							opacity:0.8
						},
						{
							easing:'linear',
							duration:250,
						});
					}
				}	
			},
			function() {
				if (jQuery(this).children('.like_count').length) {
					jQuery(this).children('.like_count').stop().animate({
						opacity:1
					},
					{
						easing:'linear',
						duration:250,
					});
				}
				else {
					jQuery(this).stop().animate({
						opacity:1
					},
					{
						easing:'linear',
						duration:250,
					});
				}
			}
		);
		jQuery(alt_color_elements).hover(
			function() {
				if (is_mobile()===false) {
					jQuery(this).stop().transition({
					color:theme_options.bd_headings_color,
					duration:250
					});
				}	
			},
			function() {
					jQuery(this).stop().transition({
				color:'',
				duration:250
				});
			}
		);
		jQuery(main_color_elements).live('mouseover', function() {
			if (is_mobile()===false) {
				if (jQuery(this).attr('data-color')!==undefined  && jQuery(this).attr('data-color')!=="default") {
					jQuery(this).css({'text-shadow':'0px 0px 1px '+hex2rgb(jQuery(this).attr('data-color'),0.3)});
					jQuery(this).stop().transition({
						color:jQuery(this).attr('data-color'),
						duration:250,
					});
					if (jQuery(this).parent().hasClass('prk_less_opacity')) {
						jQuery(this).parent().transition({
							opacity:1,
							duration:250,
						});
					}
				}
				else {
					jQuery(this).css({'text-shadow':'0px 0px 1px '+hex2rgb(theme_options.active_color,0.3)});
					jQuery(this).stop().transition({
						color:theme_options.active_color,
						duration:250
					});
				}
				
			} 
		});
		jQuery(main_color_elements).live( 'mouseout', function() {
			if (is_mobile()===false) { 
				jQuery(this).css({'text-shadow':''});
				jQuery(this).stop().transition({
					color:'',
					duration:250
				});
				if (jQuery(this).parent().hasClass('prk_less_opacity')) {
					jQuery(this).parent().transition({
						opacity:'',
						duration:250,
					});
				}
			} 
		});
		jQuery('.theme_button a,.theme_button input').live('mouseover', function() {
			if (is_mobile()===false) {
				jQuery(this).stop().animate({'backgroundColor': theme_options.theme_buttons_color}, 200 );
			}
		});
		jQuery('.theme_button a,.theme_button input').live( 'mouseout', function() {
			if (is_mobile()===false) {
				if (jQuery(this).attr('data-color')!==undefined && jQuery(this).attr('data-color')!=="default" && jQuery(this).attr('data-color')!=="") {
						jQuery(this).stop().animate({'backgroundColor': jQuery(this).attr('data-color')}, 200 );
					}
					else 
					{
						jQuery(this).stop().animate({'backgroundColor': theme_options.active_color}, 200 );
				}
			}
		});
		jQuery('.theme_button_inverted a').live('mouseover', function() {
			if (is_mobile()===false && jQuery(this).attr('id')!=='in_no_more') {
				if (jQuery(this).attr('data-color')!==undefined && jQuery(this).attr('data-color')!=="default"  && jQuery(this).attr('data-color')!=="") {
					jQuery(this).stop().animate({'backgroundColor': jQuery(this).attr('data-color')}, 200 );
				}
				else {
					jQuery(this).stop().animate({'backgroundColor': theme_options.active_color}, 200 );
				}
			}
		});
		jQuery('.theme_button_inverted a').live( 'mouseout', function() {
			jQuery(this).stop().animate({'backgroundColor': theme_options.theme_buttons_color}, 200 );
		});
		jQuery('.flexslider .theme_button_inverted a,.flex-prev,.flex-next,.navigation-next,.navigation-previous').live('mouseover', function() {
			if (is_mobile()===false) {
				if (jQuery(this).attr('data-color')!==undefined && jQuery(this).attr('data-color')!=="default" && jQuery(this).attr('data-color')!=="") {
					jQuery(this).stop().animate({'backgroundColor': jQuery(this).attr('data-color')}, 200 );
				}
				else {
					jQuery(this).stop().animate({'backgroundColor': theme_options.active_color}, 200 );
				}
			}
		});
		jQuery('.flexslider .theme_button_inverted a,.flex-prev,.flex-next,.navigation-next,.navigation-previous').live( 'mouseout', function() {
			if (is_mobile()===false) {
				jQuery(this).stop().animate({'backgroundColor': theme_options.theme_buttons_color}, 200 );
			}
		});
		jQuery('.prk_titlify_father').each(function() {
			if (!jQuery(this).find('.titlify_right').length) {
					jQuery(this).append("<div class='simple_line titlify_right'></div>");
				jQuery(this).after("<div class='clearfix'></div>");
			}
		});
		jQuery('.blog_fader_grid').hover(function() {
			if (is_mobile()===false) {
				jQuery(this).parent().children('.grid_image').stop().animate({
					scale:1.1,
					opacity:1
				},300);
				jQuery(this).stop().animate({'opacity':'1'}, 300 );
				jQuery(this).find('.titled_link_icon').stop();
				jQuery(this).find('.titled_link_icon').css({'top':'56%','opacity':'0'});
				jQuery(this).find('.titled_link_icon').delay(100).animate({'opacity':'1','top':'50%'}, 300 );
			}
		},	
		function() {
			jQuery(this).parent().children('.grid_image').stop().animate({
				scale:1
			},300);
			jQuery(this).stop().delay(100).animate({'opacity':0}, 300 );
			jQuery(this).find('.titled_link_icon').stop().animate({'top':'44%','opacity':'0'}, 300 );
		});
		jQuery(".prk_heart_carousel .pir_like,.prk_heart_masonry .pir_like").tooltipster({
			touchDevices:false,
			theme:'tooltipster-light',
			position:'top-right',
			offsetY:-2,
			offsetX:-1
		});
		jQuery("#project_info .prk_heart_project .pir_like").tooltipster({
			touchDevices:false,
			theme:'tooltipster-light',
			position:'top-left',
			offsetY:-7,
			offsetX:-5
		});
		jQuery("#prk_full_folio .prk_heart_project .pir_like").tooltipster({
			touchDevices:false,
			theme:'tooltipster-light',
			position:'bottom-left',
			offsetY:-2,
			offsetX:-6
		});
		jQuery("#astro_right,#astro_left,#astro_close").tooltipster({
			theme:'tooltipster-light .prk_bigger',
			touchDevices:false,
			position:'right',
			offsetY:4,
			offsetX:jQuery('#left_bar_wrapper').attr('data-offset_tip'),
			functionBefore: function(origin, continueTooltip) {
				if (!jQuery('#wrap.at_top').length) {
   					continueTooltip();
   				}
   			}
		});
		jQuery(".rounded a.tipped,.squared a.tipped").tooltipster({
			theme:'tooltipster-light',
			touchDevices:false,
			position:'top-left',
			offsetY:2,
			offsetX:-1
		});
		jQuery(".minimal a.tipped").tooltipster({
			theme:'tooltipster-light',
			touchDevices:false,
			position:'top-left',
			offsetY:2,
			offsetX:-5
		});
		jQuery(".colored a.tipped").tooltipster({
			theme:'tooltipster-light',
			touchDevices:false,
			position:'top-left',
			offsetY:2,
			offsetX:1
		});
		jQuery('.grid_image_wrapper').hover(function() {
			jQuery(this).find('.grid_colored_block').stop();
			jQuery(this).find('.prk_magnificent,.prk_magnificent_disabled').stop();
			jQuery(this).find('.prk_magnificent_li_outer').stop();
			jQuery(this).find('.grid_image').stop();
			jQuery(this).find('.grid_single_title .inner_skills').stop();
			var dif=0;
			//ADJUST TITLE VERTICALLY
			if (jQuery(this).find('.grid_single_title .inner_skills').length) {
				dif=jQuery(this).find('.grid_single_title').height()-4;
			}
			if (jQuery(this).parent().hasClass('featured_color')) {
				jQuery(this).find('.grid_colored_block').css({'background-color':hex2rgb(jQuery(this).parent().attr('data-color'),theme_options.custom_opacity_folio)});
			}
			else {
				jQuery(this).find('.grid_colored_block').css({'background-color':hex2rgb(theme_options.active_color,theme_options.custom_opacity_folio)});
			}
			//jQuery(this).find('.grid_single_title .prk_ttl').css({'margin-top':'-10px'});
			jQuery(this).find('.grid_single_title .inner_skills,.prk_heart_masonry').css({'top':jQuery(this).height()-62});
			jQuery(this).find('.grid_image').animate({
				scale:1.2
			},300);
			jQuery(this).find('.prk_magnificent,.prk_magnificent_disabled').transition({
				opacity:1
			},300);
			jQuery(this).find('.prk_magnificent_li_outer').transition({
				opacity:1
			},300);
			jQuery(this).find('.grid_colored_block').transition({
				opacity:1
			},300);
			jQuery(this).find('.grid_single_title').transition({
				opacity: 1
			},300);
		},
		function()
		{
			jQuery(this).find('.grid_colored_block').stop();
			jQuery(this).find('.grid_single_title').stop();
			jQuery(this).find('.prk_magnificent,.prk_magnificent_disabled').stop();
			jQuery(this).find('.prk_magnificent_li_outer').stop();
			jQuery(this).find('.prk_magnificent,.prk_magnificent_disabled').stop().transition({
				opacity: 0
			},300);
			jQuery(this).find('.prk_magnificent_li_outer').stop().transition({
				opacity: 0
			},300);
			jQuery(this).find('.grid_single_title').stop().transition({
				opacity: 0
			},300);
			jQuery(this).find('.grid_image').stop().animate({
				scale:1
			},200);
			jQuery(this).find('.grid_colored_block').stop().delay(0).transition({
				duration:300,
				opacity:0
			});
		});
		jQuery('.member_colored_block').not('.member_colored_block.no_link').hover( function() {
			//NO 1 PIXEL SPACING ON SOME SIZES

			jQuery(this).find('.sh_member_link_icon').stop();
			jQuery(this).find('.sh_member_link_icon').css({'top':'56%','opacity':'0'});
			jQuery(this).find('.sh_member_link_icon').delay(100).animate({'opacity':'1','top':'50%'}, 300 );
			jQuery(this).find('.member_colored_block_in').stop();
			var color_helper=theme_options.active_color;
			if (jQuery(this).parent().parent().attr('data-color')!=="default") {
				color_helper=jQuery(this).parent().parent().attr('data-color');
			}
			jQuery(this).find('.member_colored_block_in').css({'background-color':hex2rgb(color_helper,"0.5")});
			jQuery(this).find('.member_colored_block_in').animate({
				opacity: 1
			},300);
			jQuery(this).find('.mb_in_img').stop();
			jQuery(this).find('.mb_in_img').animate({
					scale:1.1
				},300); 
		}, 
		function() {
			jQuery(this).find('.sh_member_link_icon').animate({'top':'44%','opacity':'0'}, 300 );
			jQuery(this).find('.member_colored_block_in').stop();
			jQuery(this).find('.member_colored_block_in').delay(100).animate({
				opacity: 0
			},300);
			jQuery(this).find('.mb_in_img').stop();
			jQuery(this).find('.mb_in_img').delay(100).animate({
					scale:1
				},300); 
		});
	}

	//AJAX PAGE LOAD FUNCTIONS
	var prk_content;
	function update_colors() {
		//ACTIVE SUBMENU?
		jQuery('#menu_section .mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,.prk_button_like,.theme_tags li.active,.blog_icon,.inner_line_block,.flex-control-nav li a.flex-active,.inner_line_single_block,.home_fader_grid,.theme_button a,.theme_button input,.sidebar_bubble,.big_icon,.single_special_line,#right_rect,#left_rect,.special_line,.member_function,blockquote,#tp_side_plus,.blog_squared_icon,.prk_blockquote.colored_background,.tiny_line,#headings_wrap.back_activated_color,.back_activated_color,.wpb_tour .ui-state-active, .wpb_tour .ui-widget-content .ui-state-active, .wpb_tour .ui-widget-header .ui-state-active,  .wpb_tour .ui-tabs .ui-tabs-nav li.ui-state-active, .wpb_tabs .ui-tabs-nav .ui-state-active, .wpb_tabs .ui-tabs-nav .ui-widget-content .ui-state-active, .wpb_tabs .ui-tabs-nav .ui-widget-header .ui-state-active, .wpb_tabs .ui-tabs-nav .ui-tabs .ui-tabs-nav li.ui-state-active,.wpb_content_element .wpb_accordion_wrapper .wpb_accordion_header').not('#author_area.prk_blockquote.colored_background').css({'background-color':theme_options.active_color});
		jQuery('.blog_fader_grid').css({'background-color':hex2rgb(theme_options.background_color_btns_blog,theme_options.custom_opacity)});
		jQuery('.wpb_tabs .ui-tabs .ui-tabs-panel').css({'border-top':'1px solid '+theme_options.active_color});
	}
	function deactivate_menu_links() {
		jQuery('#nav-main .sf-menu li.active a').stop().animate({
			color:theme_options.menu_up_color,
			duration:150
		});
		jQuery('#nav-main .sf-menu li.active').stop().animate({
			backgroundColor:theme_options.background_color_menu,
			duration:150
		});
		jQuery('#nav-main ul li.active').removeClass('active');
	}
	function activate_parent_links() {
	 	jQuery('#nav-main .sf-menu>li').each(function() {
			if (jQuery(this).find('ul li.active').length) {
				jQuery(this).addClass('active');
				if(!jQuery('#menu_section').hasClass('under_logo')) {
					jQuery(this).children('a').stop().animate({
						delay:100,
						color:theme_options.menu_active_color,
						duration:150
					});
					jQuery(this).stop().animate({
						delay:100,
						backgroundColor:theme_options.menu_active_bk_color,
						duration:150
					});
				}
			}
		});
	 }
	function update_menu(new_page) {
		//WOOCOMERCE CART TEXT IF NEEDED
		jQuery('#nav-main ul li a').each(function() {
			if (jQuery(this).attr('href')===theme_options.woo_link_for_cart) {
				if (jQuery(this).attr('data-original')===undefined) {
					jQuery(this).attr('data-original','no');
					if (prk_cart_txt!=="") {
						jQuery(this).html(jQuery(this).html()+" ("+prk_cart_txt+")");
					}
				}
			}
		});
		//CHECK IF THE CHANGE CAME FROM THE MENU
		if (jQuery('#menu_section.just_clicked').length) {
			jQuery('#menu_section').removeClass('just_clicked');
		}
		else {
			//CHECK IF THERE'S AN EXACT URL MATCH
			var found_url=false;
			jQuery('#nav-main .sf-menu li a').each(function() {
				if (jQuery(this).attr('href')===new_page) {
					found_url=true;
					deactivate_menu_links();
					jQuery(this).parent().addClass('active');
					jQuery(this).stop().transition({
						delay:100,
						color:theme_options.menu_active_color,
						duration:150
					});
					jQuery(this).parent().stop().transition({
						delay:100,
						backgroundColor:theme_options.menu_active_bk_color,
						duration:150
					});
				}
			});
			if (found_url===false) {
				//TRY TO HIGHLIGHT PARENT ON SINGLES PAGE
				if (jQuery('.prk_no_change').length) {
					if (jQuery('#content').attr('data-parent')!==undefined) {
						jQuery('#nav-main .sf-menu li a').each(function() {
							if (jQuery(this).attr('href')===jQuery('#content').attr('data-parent')) {
								found_url=true;
								deactivate_menu_links();
								jQuery(this).parent().addClass('active');
								jQuery(this).stop().transition({
									delay:100,
									color:theme_options.menu_active_color,
									duration:150
								});
								jQuery(this).parent().stop().transition({
									delay:100,
									backgroundColor:theme_options.menu_active_bk_color,
									duration:150
								});
							}
						});
					}
				}
				else {
					//HIGHLIGHT WOOCOMERCE IF NEEDED
					jQuery('#nav-main ul li a').each(function() {
						if (jQuery(this).attr('href')===theme_options.woo_link)
						{
							jQuery(this).parent().addClass('active');
							if (prk_cart_txt!=="") {
								jQuery(this).parent().parent().parent().children('a').attr('data-subheader',prk_cart_txt);
							}
						}
					});
				}
			}
		}
		activate_parent_links();
	}
	function update_page_meta(text) {
		var new_title = text.find('.prk_page_ttl').text();
		document.title = new_title;
		jQuery('body').removeClass();
		jQuery('body').addClass(text.find('#prk_body_classes').attr('class'));
	}
	function show_new_page(ajax_page,text) {
		prk_content.html('');
		var loaded_html = jQuery(text);
		var new_inner = loaded_html.find('#centered_block');
		current_URL=jQuery(location).attr('href');
		prk_content.append(new_inner);
		update_menu(ajax_page);
		jQuery('#main_block').css({'opacity':'0','visibility':'visible'});
		jQuery('#main_block').delay(500).animate({opacity:'1'}, 300);	
		update_page_meta(loaded_html);
		ended_loading();
		jQuery('body,html').animate({scrollTop:0},0);
		if (location.href.indexOf("#")!==-1 && location.href.indexOf("#!")===-1) {
			setTimeout(function(){ jQuery('html,body').animate({scrollTop:jQuery(''+location.href.substr(location.href.indexOf("#"))+'').offset().top}, 0);},100);
		}
	}
	function load_ajax_link(ajax_page,change_history) {
		jQuery('body,html').animate({scrollTop:0},600);
		jQuery.ajax({
			url: ajax_page,
			dataType: 'html',
			async: true,
			success: function (text) {
				//CHANGE HISTORY IF NEEDED
				if (change_history===true && window.history.pushState && fullscreen_mode===false) {
					var pageurl = ajax_page;
					if (pageurl !== window.location) {
						window.history.pushState({
						path: pageurl
						}, '', pageurl);
					}
				}
				show_new_page(ajax_page,text);
			},
			error: function () {
				//SHOW 404 ERROR PAGE
				window.location.replace(ajax_page);
			}
		});
	}
	function close_left_bar(timing) {
		if (jQuery('#left_bar_wrapper').css('display')==='block') {
			jQuery('#prk_mega_wrap').removeClass('forced_closing');
			jQuery('.prk_right_panel').stop().animate({'opacity':0},timing/2);
			if (nav_on_right===true) {
				jQuery('#left_bar_wrapper').stop().animate({
					right:'-'+theme_options.logo_bar_width+'px',
					opacity:0,
					}, 
					{
						easing:'easeOutQuad',
						duration:timing,
						complete:function() {
							jQuery('#left_bar_wrapper').css({'display':'none','opacity':1});
						}
				});
			}
			else {
				jQuery('#left_bar_wrapper').stop().animate({
					left:'-'+theme_options.logo_bar_width+'px',
					opacity:0,
					}, 
					{
						easing:'easeOutQuad',
						duration:timing,
						complete:function() {
							jQuery('#left_bar_wrapper').css({'display':'none','opacity':1});
						}
				});
			}
			if(info_is_open===true) {
				prk_toggle_info();
			}
		}
	}

	//EMAIL SEND FEATURE
	function ajaxSubmit() {
		var prk_form_content = jQuery('#contact-form').serialize();
		var data = {
			action: 'mail_before_submit',
			email_wrap: prk_form_content,
			_ajax_nonce:ajax_var.nonce
		};
		jQuery.post(ajax_var.url, data, function(response) {
		if(response === 'sent0') {
				jQuery("#contact_ok").html(jQuery('#contact-form').attr('data-ok'));
			}
			else {
				jQuery("#contact_ok").html(response);
			}
		});
		return false;
    }
    //FULLSCREEN FEATURE
	var fullscreen_mode=false;
    //CHECK IF IT'S POSSIBLE TO USE
    if(is_mobile()===false && document.documentElement.requestFullScreen || document.documentElement.mozRequestFullScreen || document.documentElement.webkitRequestFullScreen) {
    	jQuery("#prk_fullscreen_wrapper").css({'display':'block'})
		jQuery("#prk_fullscreen_wrapper").live('click', function(event) {
			jQuery(document).toggleFullScreen();
		});
		jQuery("#landing_go_full").live('click', function(event) {
			jQuery(document).toggleFullScreen();
		});
		jQuery(document).bind("fullscreenchange", function() {
		    fullscreen_mode=jQuery(document).fullScreen() ? true : false;
		    if (fullscreen_mode===true){
		    	jQuery("#prk_fullscreen_wrapper .navicon-expand-2").css({'display':'none'});
		    	jQuery("#prk_fullscreen_wrapper .navicon-contract-2").css({'display':'block'});
		    }
		    else {
		    	jQuery("#prk_fullscreen_wrapper .navicon-expand-2").css({'display':'block'});
		    	jQuery("#prk_fullscreen_wrapper .navicon-contract-2").css({'display':'none'});
		    }
		});
	}
	//ANCHOR TAGS DELAYED SCRIPT
	jQuery("a.fade_anchor,a.fade_anchor_menu,.fade_anchor a,.titled_block .fade_anchor a,#members_nav .fade_anchor a,.single_blog_meta_div .theme_button.fade_anchor a,.blog_categories a,.side_skills a").live('click', function(event) {
		if (jQuery(this).attr("target")==="_blank" || jQuery(this).parent().hasClass('regular_load')) {
			//OPEN LINK NORMALLY
		}
		else {
			if (ajax_calls) {
				//SPECIAL BEHAVIOR FOR PARENT PAGES WITH URL LINKS THAT HAVE SUBMENUS
				if (current_URL===jQuery(this).attr("href") && jQuery(this).parent().children('.sub-menu').length) {
					event.preventDefault();
				}
				if (jQuery(this).hasClass('fade_anchor_menu') && jQuery(this).attr("href")==="#") {
					event.preventDefault();
				}
				if (loading_page===false && jQuery(this).attr("href")!=="#" && !event.metaKey && !jQuery('.astro_theme.admin-bar').length)
				{
					event.preventDefault();
					loading_page=true;
					var next_page=jQuery(this).attr("href");
					if (jQuery(this).hasClass('landing_link')) {
						jQuery('#astro_full_back').css({'opacity':'0'});
					}
					if (jQuery(this).hasClass('fade_anchor_menu') && !jQuery(this).hasClass('landing_link')) {
						deactivate_menu_links();
						jQuery('#menu_section').addClass('just_clicked');
						jQuery(this).parent().addClass('active');
						jQuery(this).stop().transition({
							delay:100,
							color:theme_options.menu_active_color,
							duration:150
						});
						jQuery(this).parent().stop().transition({
							delay:100,
							backgroundColor:theme_options.menu_active_bk_color,
							duration:150
						});
						if(menu_is_open===true) {
							prk_toggle_menu();
						}
						if(info_is_open===true) {
							prk_toggle_info();
						}
						if(contact_is_open===true) {
							prk_toggle_contact_info();
						}
						activate_parent_links();
					}
					else {
						if(info_is_open===true) {
							prk_toggle_info();
						}
					}
					jQuery('#sidebar,#single_slider').stop().animate({
							opacity:0
						}, 
						{
							easing:'linear',
							duration:300
						}
					);
					//NO VIMEO FLICK ON SAFARI
					if (navigator.userAgent.indexOf("Safari") > -1) {
						jQuery('#classic_blog_section').css({'opacity':0});
					}
					jQuery('#main_block').stop().animate({
						opacity:0
						}, 
						{
							easing:'linear',
							duration:300,
							complete:function() {
								load_ajax_link(next_page,true);
								NProgress.start();
								if (jQuery('#prk_responsive_menu.at_top').length) {
									jQuery('#nprogress .bar').css({'top':'50px'});
									jQuery('#nprogress .spinner').css({'top':'65px'});
								}
							}
						}
					);
				}
				if (jQuery(this).parent().children('.sub-menu').length) {
					jQuery(this).parent().children('.sub-menu').addClass('opened-sub');
					jQuery('#menu_section').addClass('opened-sub');
				}
			}
			else {
				//HANDLE SUBMENUS
				//SPECIAL BEHAVIOR FOR PARENT PAGES WITH URL LINKS THAT HAVE SUBMENUS
				if (current_URL===jQuery(this).attr("href") && jQuery(this).parent().children('.sub-menu').length) {
					event.preventDefault();
					jQuery(this).parent().children('.sub-menu').addClass('opened-sub');
					jQuery('#menu_section').addClass('opened-sub');
				}
				else {
					if (jQuery(this).parent().children('.sub-menu').length) {
						event.preventDefault();
						jQuery(this).parent().children('.sub-menu').addClass('opened-sub');
						jQuery('#menu_section').addClass('opened-sub');
					}
				}
			}
		}
	});
	

	//AJAX LAZY LOAD MORE POSTS FUNCTIONS
	var jq_paged=-1;
	var jq_max=0;
	var jq_load=false;
	var delayed_counter=2;
	function load_more_ps() {
		var orig_text;
		var link;
		var new_url;
		var items_nr_before;

		//MASONRY AND GRID PORTFOLIO 
		if (jQuery('#next_portfolio_masonry .nx_lnk_wp>a').length) {
			jQuery('#pages_static_nav').css({'display':'block'});
			jq_load=true;
			jQuery("#pir_loader_wrapper").css({'visibility':'visible','opacity':'1'});
			if (jq_paged===-1)
			{
				jq_paged=parseInt(jQuery('#next_portfolio_masonry .nx_lnk_wp>a').parent().parent().attr('data-pir_curr'),10)+1;
			}
			items_nr_before= jQuery('#folio_masonry>div').length;
			orig_text=jQuery('#next_portfolio_masonry .nx_lnk_wp>a').html();
			jq_max=jQuery('#next_portfolio_masonry .nx_lnk_wp>a').parent().parent().attr('data-pir_max');
			link = jQuery('#next_portfolio_masonry .nx_lnk_wp>a').attr('href');
			if (theme_options.home_link!=="")
			{
				link = link.replace(theme_options.home_link, theme_options.home_link+theme_options.home_slug+'/');
			}
			jQuery('li').removeClass('last_li');
			jQuery('#dump').append('<div id=more_content_'+jq_paged+'></div>');
			jQuery('#more_content_'+jq_paged+'').load(link+' #folio_masonry >*',function()
			{
				var $newEls = jQuery('#more_content_'+delayed_counter+' > *');
				var img_load=imagesLoaded($newEls);
				img_load.on('always', function() {
					$container.append($newEls).isotope( 'appended', $newEls,function() {
						var ctr=1;
						jQuery('#folio_masonry>div').each(function() {
							jQuery(this).css({'margin-bottom':portfolio_gutter});
							if (ctr>items_nr_before)
							{
								ctr++;
							}
						});
					});
					jQuery('#folio_father').addClass('dyn_loaded');
					setTimeout(function(){ jQuery(window).trigger("smartresize");},0);
					//UPDATE CONTENT
					calculate_filters();
					thumbs_roll();
					init_sliders();
					//LIGHBOX ON+INDIVIDUAL SLIDERS OFF
					jQuery('#folio_masonry .individual_lightbox.per_init').not(jQuery('#folio_masonry .individual_lightbox.per_init.conf')).each(function() {
						jQuery(this).removeClass('per_init');
						jQuery(this).parent().parent().magnificPopup({
							delegate: 'div.prk_magnificent_li',
							src:'data-src',
							type: 'image',
							tLoading: 'Loading image #%curr%...',
							fixedContentPos: false,
							fixedBgPos: true,
							closeOnContentClick: true,
							closeBtnInside: false,
							mainClass: 'mfp-no-margins my-mfp-zoom-in',
							removalDelay: 300,
							gallery: {
								enabled: true,
								navigateByImgClick: true,
								preload: [0,1] // Will preload 0 - before current, and 1 after the current image
							},
							image: {
								tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
								titleSrc: function(item) {
									return item.el.attr('title');
								}
							},
							callbacks: {
								open: function() {
									scrollbar_width=window.innerWidth-jQuery("body").width();
									jQuery('html').css({'padding-right':scrollbar_width});
									jQuery('html').css({'overflow-y':'hidden'});
									jQuery('.mfp-bg').css({'opacity':0.8});
								},
								beforeClose: function() {
									jQuery('.mfp-bg').css({'opacity':0});
								},
								close: function() {
									jQuery('html').css({'overflow-y':'','padding-right':''});
								}
							}
						});
					});
					//LIGHBOX ON+INDIVIDUAL SLIDERS ON
					jQuery('#folio_masonry .individual_lightbox.per_init.conf').each(function() {
						jQuery(this).removeClass('per_init');
						jQuery(this).parent().parent().magnificPopup({
							delegate: '.magna_conf',
							src:'data-src',
							type: 'image',
							tLoading: 'Loading image #%curr%...',
							fixedContentPos: false,
							fixedBgPos: true,
							closeOnContentClick: true,
							closeBtnInside: false,
							mainClass: 'mfp-no-margins my-mfp-zoom-in',
							removalDelay: 300,
							gallery: {
								enabled: true,
								navigateByImgClick: true,
								preload: [0,1] // Will preload 0 - before current, and 1 after the current image
							},
							image: {
								tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
								titleSrc: function(item) {
									return item.el.attr('title');
								}
							},
							callbacks: {
								open: function() {
									scrollbar_width=window.innerWidth-jQuery("body").width();
									jQuery('html').css({'padding-right':scrollbar_width});
									jQuery('html').css({'overflow-y':'hidden'});
									jQuery('.mfp-bg').css({'opacity':0.8});
								},
								beforeClose: function() {
									jQuery('.mfp-bg').css({'opacity':0});
								},
								close: function() {
									jQuery('html').css({'overflow-y':'','padding-right':''});
								}
							}
						});
					});
				});
				//INCREASE COUNTER
				delayed_counter++;
				if (jq_paged<=jq_max)
				{
					jQuery('#next_portfolio_masonry .nx_lnk_wp>a').html(orig_text);
					jq_load=false;
					jQuery('#pages_static_nav').css({'display':'none'});
				}
				else
				{
					jQuery('#pages_static_nav').css({'display':'none'});
					jQuery('#no_more').css({'display':'block'});
					setTimeout(function() {
						jQuery('#no_more').stop().animate({
							opacity:0
						}, 
						{
							easing:'linear',
							duration:400,
							complete:function() {
								jQuery('#no_more').css({'display':'none'});
							}
						});
					},3000);
				}
			});
			jq_paged++;
			//ADJUST LINK ACCORDING TO PERMALINK OPTION
			if (jQuery('#next_portfolio_masonry .nx_lnk_wp>a').attr('href').substring(jQuery('#next_portfolio_masonry .nx_lnk_wp>a').attr('href').length - 1, jQuery('#next_portfolio_masonry .nx_lnk_wp>a').attr('href').length)==='/') {
				if (parseInt(jq_paged,10)<=10) {
					new_url=jQuery('#next_portfolio_masonry .nx_lnk_wp>a').attr('href').substring(0, jQuery('#next_portfolio_masonry .nx_lnk_wp>a').attr('href').length - 2)+jq_paged;
				}
				else
				{
					new_url=jQuery('#next_portfolio_masonry .nx_lnk_wp>a').attr('href').substring(0, jQuery('#next_portfolio_masonry .nx_lnk_wp>a').attr('href').length - 3)+jq_paged;
				}
			}
			else {
				if (parseInt(jq_paged,10)<=10) {
					new_url=jQuery('#next_portfolio_masonry .nx_lnk_wp>a').attr('href').substring(0, jQuery('#next_portfolio_masonry .nx_lnk_wp>a').attr('href').length - 1)+jq_paged;
				}
				else
				{
					new_url=jQuery('#next_portfolio_masonry .nx_lnk_wp>a').attr('href').substring(0, jQuery('#next_portfolio_masonry .nx_lnk_wp>a').attr('href').length - 2)+jq_paged;
				}
			}
			jQuery('#next_portfolio_masonry .nx_lnk_wp>a').attr('href',new_url);
		}

		//TITLED PORTFOLIO 
		if (jQuery('#next_portfolio_titled .nx_lnk_wp>a').length)
		{
			jq_load=true;
			jQuery("#pir_loader_wrapper").css({'visibility':'visible','opacity':'1'});
			if (jq_paged===-1)
			{
				jq_paged=parseInt(jQuery('#next_portfolio_titled .nx_lnk_wp>a').parent().parent().attr('data-pir_curr'),10)+1;
			}
			items_nr_before= jQuery('#folio_titled>div').length;
			orig_text=jQuery('#next_portfolio_titled .nx_lnk_wp>a').html();
			jq_max=jQuery('#next_portfolio_titled .nx_lnk_wp>a').parent().parent().attr('data-pir_max');
			link = jQuery('#next_portfolio_titled .nx_lnk_wp>a').attr('href');
			if (theme_options.home_link!=="")
			{
				link = link.replace(theme_options.home_link, theme_options.home_link+theme_options.home_slug+'/');
			}
			jQuery('li').removeClass('last_li');
			jQuery('#dump').append('<div id=more_content_'+jq_paged+'></div>');
			jQuery('#more_content_'+jq_paged+'').load(link+' #folio_titled >*',function()
			{
				var $newEls = jQuery('#more_content_'+delayed_counter+' > *');
				var img_load=imagesLoaded($newEls);
				img_load.on('always', function() {
					$container.append($newEls).isotope( 'appended', $newEls,function()
					{
						var ctr=1;
						jQuery('#folio_titled>div').each(function() {
							if (ctr>items_nr_before)
							{
								if (jQuery(this).attr('data-color')!=="default") {
									jQuery(this).find('.tiny_line').css({'background-color':jQuery(this).attr('data-color')});
									jQuery(this).find('.inner_skills a').attr('data-color',jQuery(this).attr('data-color'));
								}
							}
							ctr++;
						});
					});
					jQuery('#folio_father').addClass('dyn_loaded');
					setTimeout(function(){ jQuery(window).trigger("smartresize");},0);
					//UPDATE CONTENT
					calculate_filters();
					thumbs_roll();
					init_sliders();
				});
				//INCREASE COUNTER
				delayed_counter++;
				jQuery("#pir_loader_wrapper").stop().fadeTo('slow', 0,function()
				{
					
				});
				if (jq_paged<=jq_max)
				{
					jQuery('#next_portfolio_titled .nx_lnk_wp>a').html(orig_text);
					jq_load=false;
				}
				else
				{
					jQuery('.next-posts').css({'display':'none'});
					jQuery('#no_more').css({'display':'block'});
				}
			});
			jq_paged++;
			//ADJUST LINK ACCORDING TO PERMALINK OPTION
			if (jQuery('#next_portfolio_titled .nx_lnk_wp>a').attr('href').substring(jQuery('#next_portfolio_titled .nx_lnk_wp>a').attr('href').length - 1, jQuery('#next_portfolio_titled .nx_lnk_wp>a').attr('href').length)==='/') {
				if (parseInt(jq_paged,10)<=10) {
					new_url=jQuery('#next_portfolio_masonry .nx_lnk_wp>a').attr('href').substring(0, jQuery('#next_portfolio_masonry .nx_lnk_wp>a').attr('href').length - 2)+jq_paged;
				}
				else
				{
					new_url=jQuery('#next_portfolio_masonry .nx_lnk_wp>a').attr('href').substring(0, jQuery('#next_portfolio_masonry .nx_lnk_wp>a').attr('href').length - 3)+jq_paged;
				}
			}
			else {
				if (parseInt(jq_paged,10)<=10) {
					new_url=jQuery('#next_portfolio_masonry .nx_lnk_wp>a').attr('href').substring(0, jQuery('#next_portfolio_masonry .nx_lnk_wp>a').attr('href').length - 1)+jq_paged;
				}
				else
				{
					new_url=jQuery('#next_portfolio_masonry .nx_lnk_wp>a').attr('href').substring(0, jQuery('#next_portfolio_masonry .nx_lnk_wp>a').attr('href').length - 2)+jq_paged;
				}
			}
			jQuery('#next_portfolio_titled .nx_lnk_wp>a').attr('href',new_url);
		}
	}
	jQuery("#pages_static_nav").live('click', function(event) { 
		event.preventDefault();
		load_more_ps();
	});

	//NAVIGATION BUTTONS
	jQuery('#astro_left').live('click', function(event) {
		if (ajax_calls) {
			if (loading_page===false) {
				loading_page=true;
				if (jQuery('#prk_ajax_container_folio').length) {
					if (ajax_in_pos>0) {
						jQuery('html, body').animate({scrollTop:offset_ajax}, 100);
						jQuery('#prk_ajax_container_folio').delay(50).slideUp(400,
							function() {
								jQuery('#prk_ajax_wrapper').remove();
								jQuery('.project_ajax_loader').animate({opacity:1}, 200);
								switch_projects('back');
							}
						);
					}
				}
				else {
					var next_page=jQuery('#prk_nav_left').children('a').attr("href");
					if(info_is_open===true) {
						prk_toggle_info();
						setTimeout(function() {
							jQuery('#astro_featured_header').removeClass('prk_ready');
							jQuery('#main_block').stop().animate({
								opacity:0
							}, 
							{
								easing:'linear',
								duration:200,
								complete:function() {
									NProgress.start();
									load_ajax_link(next_page,true);
								}
							});
						},150);
					}
					else {
						jQuery('#astro_featured_header').removeClass('prk_ready');
						jQuery('#main_block').stop().animate({
							opacity:0
						}, 
						{
							easing:'linear',
							duration:200,
							complete:function() {
								NProgress.start();
								load_ajax_link(next_page,true);
							}
						});
					}
				}
			}
		}
		else {
			document.location.href=jQuery('#prk_nav_left').children('a').attr("href");
		}
	});
	function check_and_load() {
		if(jQuery('#prk_pusher').length && isScrolledIntoView(jQuery('#prk_pusher')) && jq_load===false) {
			load_more_ps(); 
		}
	}
	jQuery('#astro_right').live('click', function(event) {
		if (ajax_calls) {
			if (loading_page===false) {
				loading_page=true;
				if (jQuery('#prk_ajax_container_folio').length) {
					if (ajax_in_pos<(jQuery('.iso_folio>div').length-1)) {
						jQuery('html, body').animate({scrollTop:offset_ajax}, 100);
						jQuery('#prk_ajax_container_folio').delay(50).slideUp(400,
							function() {
								jQuery('#prk_ajax_wrapper').remove();
								jQuery('.project_ajax_loader').animate({opacity:1}, 200);
								switch_projects('forward');
							}
						);
					}
				}
				else {
					var next_page=jQuery('#prk_nav_right').children('a').attr("href");
					if(info_is_open===true) {
						prk_toggle_info();
						setTimeout(function() {
							jQuery('#astro_featured_header').removeClass('prk_ready');
							jQuery('#main_block').stop().animate({
								opacity:0
							}, 
							{
								easing:'linear',
								duration:200,
								complete:function() {
									NProgress.start();
									load_ajax_link(next_page,true);
								}
							});
						},150);
					}
					else {
						jQuery('#astro_featured_header').removeClass('prk_ready');
						jQuery('#main_block').stop().animate({
							opacity:0
						}, 
						{
							easing:'linear',
							duration:200,
							complete:function() {
								NProgress.start();
								load_ajax_link(next_page,true);
							}
						});
					}
				}
			}
		}
		else {
			document.location.href=jQuery('#prk_nav_right').children('a').attr("href");
		}
	});
	jQuery('#astro_close').live('click', function(event) {
		if (ajax_calls) {
			if (loading_page===false) {
				loading_page=true;
				showing_ajax_page=false;
				if (jQuery('#prk_ajax_container_folio').length) {
					//PORTFOLIO AJAX IS ON
					jQuery('html, body').animate({scrollTop:0}, 100);
						jQuery('#aj_loader_wrapper').slideUp(100);
						jQuery('#prk_ajax_container_folio').slideUp(400,
							function() {
							jQuery('#prk_ajax_container_folio #content').remove();
					});
				}
				else {
					var next_page=jQuery('#prk_nav_close').children('a').attr("href");
					jQuery('#astro_featured_header').stop().transition({
						opacity:0,
						duration:300
					}); 
					jQuery('#main_block').stop().transition({
						opacity:0,
						duration:300 
					},function(){
						NProgress.start();
						load_ajax_link(next_page,true);
					});
				}
				jQuery(this).tooltipster('hide');
				close_left_bar(400);
			}
		}
		else {
			document.location.href=jQuery('#prk_nav_close').children('a').attr("href");
		}
	});

	//INITIALIZE CONTENT AND VARIABLES
	var loading_page=true;
	var showing_ajax_page=false;
	var first_load=true;
	var current_URL=jQuery(location).attr('href');
	var $js_flexislider = jQuery.noConflict();

	//FIX FOR MEDIA QUERIES ON SOME BROWSERS
	var scrollbar_width=window.innerWidth-jQuery("body").width();
	if (jQuery.browser.msie) {
		scrollbar_width=scrollbar_width+1;
	}

	//WINDOW HISTORY MANAGEMENT
	if (ajax_calls && window.history.pushState) {
		jQuery(window).bind('popstate', function () {
			if (current_URL!==jQuery(location).attr('href') && first_load===false && location.href.indexOf("#")===-1) {
				loading_page=true;
				showing_ajax_page=false;
				var next_page=jQuery(location).attr('href');
				jQuery ('#sidebar').stop().transition({
					opacity:0,
					duration:300
				});
				jQuery ('#main_block').stop().transition({
					opacity:0,
					duration:300 
				},function(){
					load_ajax_link(next_page,false);
				});
			}
		});
	}
	function update_left_bar() {
		if (jQuery('#content.has_left_bar').length) {
			jQuery('#prk_mega_wrap').addClass('forced_closing');
			if (jQuery('#left_bar_wrapper').css('display')==='none') {
				jQuery('#prj_ttl').html(jQuery('#prk_prj_title h1').html());
				jQuery('#prj_ttl').css({'color':jQuery('#astro_featured_header').attr('data-color')});
				if (nav_on_right===true) {
					jQuery('#left_bar_wrapper').css({'right':'-'+theme_options.logo_bar_width+'px','display':'block'});
					jQuery('#left_bar_wrapper').animate({
						right:0
						}, 
						{
							easing:'easeOutQuad',
							duration:400
					});
				}
				else {
					jQuery('#left_bar_wrapper').css({'left':'-'+theme_options.logo_bar_width+'px','display':'block'});
					jQuery('#left_bar_wrapper').animate({
						left:0
						}, 
						{
							easing:'easeOutQuad',
							duration:400
					});
				}
			}
			else {
				jQuery('#prj_ttl').css({'opacity':0});
				jQuery('#prj_ttl').html(jQuery('#prk_prj_title h1').html());
				jQuery('#prj_ttl').css({'color':jQuery('#astro_featured_header').attr('data-color')});
				jQuery('#prj_ttl').stop().delay(100).animate({
					opacity:1
					}, 
					{
						easing:'easeOutQuad',
						duration:500
					}
				);
			}
			jQuery('#astro_close').tooltipster('update', jQuery('#prk_nav_close a').attr('data-pir_title'));
			if (jQuery('#prk_nav_left').length) {
				jQuery('#astro_left').css({'display':'block'});
				if (jQuery('#prk_ajax_container_folio').length) {
					if (ajax_in_pos===0) {
						jQuery('#astro_left').css({'display':'none'});
					}
					jQuery('#astro_left').tooltipster('update', jQuery('.iso_folio>div:nth-child('+parseInt((ajax_in_pos),10)+') a.prk_trigger_ajax h4').html());
				}
				else {
					jQuery('#astro_left').tooltipster('update', jQuery('#prk_nav_left a').attr('data-pir_title'));
				}
				jQuery('#astro_left').stop().animate({
					opacity:1
					}, 
					{
						easing:'easeOutQuad',
						duration:200
					}
				);
			}
			else {
				jQuery('#astro_left').stop().animate({
					opacity:0
				}, 
				{
					easing:'easeOutQuad',
					duration:200,
					complete:function()
					{
						jQuery('#astro_left').css({'display':'none'});
					}
				});
			}
			if (jQuery('#prk_nav_right').length) {
				jQuery('#astro_right').css({'display':'block'});
				if (jQuery('#prk_ajax_container_folio').length) {
					if (ajax_in_pos===(jQuery('.iso_folio>div').length-1)) {
						jQuery('#astro_right').css({'display':'none'});
					}
					jQuery('#astro_right').tooltipster('update', jQuery('.iso_folio>div:nth-child('+parseInt((ajax_in_pos+2),10)+') a.prk_trigger_ajax h4').html());
				}
				else {
					jQuery('#astro_right').tooltipster('update', jQuery('#prk_nav_right a').attr('data-pir_title'));
				}
				jQuery('#astro_right').stop().animate({
					opacity:1
					}, 
					{
						easing:'easeOutQuad',
						duration:200
					}
				);
			}
			else {
				jQuery('#astro_right').stop().animate({
					opacity:0
				}, 
				{
					easing:'easeOutQuad',
					duration:200,
					complete:function()
					{
						jQuery('#astro_right').css({'display':'none'});
					}
				});
			}
		}
		else
		{
			close_left_bar(0);
		}
	}
	function update_ferro(myflag) {
		if (myflag===true) {
			jQuery('#prj_naver').css({'opacity':0});
			jQuery('#prj_naver').stop().delay(100).animate({
				opacity:1
				}, 
				{
					easing:'easeOutQuad',
					duration:500,
				}
			);
		}
		if(jQuery('#content').attr('data-count')==='1') {
			jQuery('#prj_naver_wrap').css({'display':'none','opacity':0});
		}
		else {
			jQuery('#prj_naver_wrap').css({'display':'block'});
			jQuery('#prj_naver_wrap').stop().delay(100).animate({
				opacity:1
				}, 
				{
					easing:'easeOutQuad',
					duration:500,
				}
			);
		}
		jQuery('#prj_naver').html(jQuery('#outerSlider .ferro_active').attr('data-pos')+' '+jQuery('#prk_lower_nav').attr('data-pir_title')+' '+jQuery('#content').attr('data-count'));
	}
	function update_ferro_arrows() {
		if (jQuery(jQuery.fn.ferroSlider.getActualSlideId()).attr('data-pos')==="1") {
			jQuery("#prk_ferro_left").css({'display':'none'});
		}
		else {
			jQuery("#prk_ferro_left").css({'display':'block'});
		}
		if (jQuery(jQuery.fn.ferroSlider.getActualSlideId()).attr('data-pos')===jQuery('#content').attr('data-count')) {
			jQuery("#prk_ferro_right").css({'display':'none'});
		}
		else {
			jQuery("#prk_ferro_right").css({'display':'block'});
		}
	}
	jQuery("#prj_naver_left").click(function(e) {
    	if (jQuery(jQuery.fn.ferroSlider.getActualSlideId()).attr('data-pos')==="1") {
    		jQuery.fn.ferroSlider.slideTo(jQuery('#outerSlider>div:nth-child('+jQuery('#content').attr('data-count')+')>div').attr('id'));
    	}
    	else {
    		var less_one=parseInt(jQuery(jQuery.fn.ferroSlider.getActualSlideId()).attr('data-pos'),10)-1;
    		jQuery.fn.ferroSlider.slideTo(jQuery('#outerSlider>div:nth-child('+less_one+')>div').attr('id'));
    	}
    	update_ferro_arrows();
    });
	jQuery("#prj_naver_right").click(function(e) {
    	if (jQuery(jQuery.fn.ferroSlider.getActualSlideId()).attr('data-pos')===jQuery('#content').attr('data-count')) {
    		jQuery.fn.ferroSlider.slideTo(jQuery('#outerSlider>div:nth-child(1)>div').attr('id'));
    	}
    	else {
    		var plus_one=parseInt(jQuery(jQuery.fn.ferroSlider.getActualSlideId()).attr('data-pos'),10)+1;
    		jQuery.fn.ferroSlider.slideTo(jQuery('#outerSlider>div:nth-child('+plus_one+')>div').attr('id'));
    	}
    	update_ferro_arrows();
    });
    jQuery("#prj_naver_info").click(function(e) {
    	prk_toggle_info();
    });
    function load_next_ferro(new_image) {
    	if (jQuery(''+new_image+'').attr("data-bgimage")!==undefined && jQuery(''+new_image+'').attr("data-bgimage")!=="") {
    		var next_image=jQuery(''+new_image+'').attr("data-bgimage");
    		jQuery(''+new_image+'').append('<img src="'+next_image+'" class="hide_now" alt="" />');
    		var img_load=imagesLoaded(''+new_image+'');
    		img_load.on('always', function() {
	    		jQuery(''+new_image+'').css({"background-image":"url("+next_image+")","background-position":"center center","background-repeat":"no-repeat","-webkit-background-size":"cover","-moz-background-size":"cover","-o-background-size":"cover","background-size":"cover"});
	    		check_for_more(jQuery(''+new_image+'').attr('data-pos'));
	    	});
	    }
	    else {
	    	check_for_more(jQuery(''+new_image+'').attr('data-pos'));
	    }
    }
    function check_for_more(last_image) {
    	if (parseInt(last_image,10)<parseInt(jQuery('#content').attr('data-count'),10)) {
    		load_next_ferro('#slide_'+(parseInt(last_image,10)+1));
    	}
    }
    function prk_hover_left() {
    	if(jQuery(jQuery.fn.ferroSlider.getActualSlideId()).attr('data-pos')!=="1" && prk_sensi) {
    		prk_shifter=(parseInt(jQuery(jQuery.fn.ferroSlider.getActualSlideId()).attr('data-pos'),10)-1)*jQuery('#astro_featured_header').width();
			dunk=prk_shifter-70;
			jQuery('#outerSlider').stop().transition({ transform: "translate(-"+dunk+"px,0px)" });
		}
    }
    function prk_hover_right() {
    	if(jQuery(jQuery.fn.ferroSlider.getActualSlideId()).attr('data-pos')!==jQuery('#content').attr('data-count') && prk_sensi) {
    		prk_shifter=(parseInt(jQuery(jQuery.fn.ferroSlider.getActualSlideId()).attr('data-pos'),10)-1)*jQuery('#astro_featured_header').width();
			dunk=prk_shifter+70;
			jQuery('#outerSlider').stop().transition({ transform: "translate(-"+dunk+"px,0px)" });
		}
    }
	//CAN BE CALLED MULTIPLE TIMES IF AJAX PAGE LOADING IS ON
	function ended_loading() {
		//INIT CONTENT
		if (!jQuery('#folio_father,#classic_blog_section,#blog_masonry_father').length ) {
			NProgress.done();
		}
		if (jQuery('.astro_landing_page').length) {
			jQuery('body').addClass('astro_landing_page');
		}
		jQuery('html').css({'overflow-y':''});
		jQuery('.main_with_sections').css({'overflow':''});
		info_is_open=false;

		//UPDATE CONTAINER
		prk_content=jQuery("#prk_ajax_container");
 
		//REMOVE PREVIOUS BINDINGS
		jQuery(window).off( "smartresize" );
		//FORCE BLUR ON COMMENTS FORM
		jQuery('#author').blur();
		jQuery('#email').blur();
		jQuery('#url').blur();
		jQuery('#comment').blur();

		//SINGLE PORTFOLIOS MAIN SLIDER
		if (jQuery('.prk_ferro_wrap').length) {
			pirenko_resize();
		    jQuery('.prk_ferro_wrap').fitVids().ferroSlider({
		        easing                  : 'snap',
		        createMap               : true,
		        time 					: 500,
		        mapPosition             : 'bottom_center',
		        container: '#astro_featured_header',
		        createSensibleAreas : prk_sensi,
		        disableSwipe: false,
		        preventArrowNavigation : true
		    });
		    jQuery('.prk_ferro_wrap iframe').css("height", height_fix+1);
		    if (jQuery('#slide_1').attr("data-bgimage")!==undefined && jQuery('#slide_1').attr("data-bgimage")!=="") {
		    	var img_load=imagesLoaded('#astro_featured_header');
		    	img_load.on('always', function() {
		    		jQuery('#slide_1').css({"background-image":"url("+jQuery('#slide_1').attr("data-bgimage")+")","background-position":"center center","background-repeat":"no-repeat","-webkit-background-size":"cover","-moz-background-size":"cover","-o-background-size":"cover","background-size":"cover"});
		    		setTimeout(function() { 
		    			jQuery(window).trigger("debouncedresize");
		    			jQuery('#astro_featured_header').addClass('prk_ready');
		    		},400);
		    		check_for_more("1");
		    		if (jQuery('#left_bar_wrapper.auto_open').length) {
		    			setTimeout(function() { 
		    				if (info_is_open===false) {
		    					prk_toggle_info();
		    				}
		    			},1500);
		    		}
		    	});
		    }
		    else {
		    	jQuery('#astro_featured_header').addClass('prk_ready');
		    	check_for_more("1");
		    	if (jQuery('#left_bar_wrapper.auto_open').length) {
	    			setTimeout(function() { 
	    				if (info_is_open===false) {
	    					prk_toggle_info();
	    				}
	    			},1500);
	    		}
		    }
		    if (prk_sensi===false || theme_options.folio_arrows==='1') {
		    	jQuery('#astro_featured_header').append('<div id="prk_ferro_right"><div class="naverette"><div class="navicon-forward-2"></div></div></div><div id="prk_ferro_left"><div class="naverette"><div class="navicon-backward-2"></div></div></div>');
		    }
		    jQuery("#prk_ferro_right").hover(function() {
		    	prk_hover_right();
			}, function() {
				if(jQuery(jQuery.fn.ferroSlider.getActualSlideId()).attr('data-pos')!==jQuery('#content').attr('data-count')) {
					prk_shifter=(parseInt(jQuery(jQuery.fn.ferroSlider.getActualSlideId()).attr('data-pos'),10)-1)*jQuery('#astro_featured_header').width();
					jQuery('#outerSlider').transition({ transform: "translate(-"+prk_shifter+"px,0px)" });
				}
			});
			jQuery("#prk_ferro_left").hover(function() {
				prk_hover_left();
			}, function() {
				if(jQuery(jQuery.fn.ferroSlider.getActualSlideId()).attr('data-pos')!=="1") {
					prk_shifter=(parseInt(jQuery(jQuery.fn.ferroSlider.getActualSlideId()).attr('data-pos'),10)-1)*jQuery('#astro_featured_header').width();
					jQuery('#outerSlider').transition({ transform: "translate(-"+prk_shifter+"px,0px)" });
				}
			});
			jQuery("#prk_ferro_right").click(function(e) {
		    	if (jQuery(jQuery.fn.ferroSlider.getActualSlideId()).attr('data-pos')===jQuery('#content').attr('data-count')) {
		    		jQuery.fn.ferroSlider.slideTo(jQuery('#outerSlider>div:nth-child(1)>div').attr('id'));
		    	}
		    	else {
		    		var plus_one=parseInt(jQuery(jQuery.fn.ferroSlider.getActualSlideId()).attr('data-pos'),10)+1;
		    		jQuery.fn.ferroSlider.slideTo(jQuery('#outerSlider>div:nth-child('+plus_one+')>div').attr('id'));
		    	}
		    	update_ferro_arrows();
		    });
		    jQuery("#ferroslider-sensible-area-right,#ferroslider-sensible-area-left").click(function(e) {
		    	update_ferro_arrows();
		    });
		    jQuery("#prk_ferro_left").click(function(e) {
		    	if (jQuery(jQuery.fn.ferroSlider.getActualSlideId()).attr('data-pos')==="1") {
		    		jQuery.fn.ferroSlider.slideTo(jQuery('#outerSlider>div:nth-child('+jQuery('#content').attr('data-count')+')>div').attr('id'));
		    	}
		    	else {
		    		var less_one=parseInt(jQuery(jQuery.fn.ferroSlider.getActualSlideId()).attr('data-pos'),10)-1;
		    		jQuery.fn.ferroSlider.slideTo(jQuery('#outerSlider>div:nth-child('+less_one+')>div').attr('id'));
		    	}
		    	update_ferro_arrows();
		    });
		    jQuery(document).keydown(function(e) {
			    if (e.keyCode === 37 && jQuery('.prk_ferro_wrap').length) { 
			       	if (jQuery(jQuery.fn.ferroSlider.getActualSlideId()).attr('data-pos')==="1") {
			    		jQuery.fn.ferroSlider.slideTo(jQuery('#outerSlider>div:nth-child('+jQuery('#content').attr('data-count')+')>div').attr('id'));
			    	}
			    	else {
			    		var less_one=parseInt(jQuery(jQuery.fn.ferroSlider.getActualSlideId()).attr('data-pos'),10)-1;
			    		jQuery.fn.ferroSlider.slideTo(jQuery('#outerSlider>div:nth-child('+less_one+')>div').attr('id'));
			    	}
			    	update_ferro_arrows();
					return false;
				}
			});
			jQuery(document).keydown(function(e){
				if (e.keyCode == 39 && jQuery('.prk_ferro_wrap').length) { 
					if (jQuery(jQuery.fn.ferroSlider.getActualSlideId()).attr('data-pos')===jQuery('#content').attr('data-count')) {
			    		jQuery.fn.ferroSlider.slideTo(jQuery('#outerSlider>div:nth-child(1)>div').attr('id'));
			    	}
			    	else {
			    		var plus_one=parseInt(jQuery(jQuery.fn.ferroSlider.getActualSlideId()).attr('data-pos'),10)+1;
			    		jQuery.fn.ferroSlider.slideTo(jQuery('#outerSlider>div:nth-child('+plus_one+')>div').attr('id'));
			    	}
			    	update_ferro_arrows();
			    	return false;
				}
			});
		    var ferro_active_div='#'+jQuery('#ferroslider-navigation-map a.actual').attr('id').substr(4);
		    jQuery(ferro_active_div).addClass('ferro_active');
		    update_ferro(true);
		    update_ferro_arrows();
		    jQuery(document).unbind("endslide");
			jQuery(document).bind("endslide",function() {
				setTimeout(function() {
					if (jQuery("#prk_ferro_left").length && jQuery("#prk_ferro_left").is(":hover")) {
						prk_hover_left();
					}
					if (jQuery("#prk_ferro_right").length && jQuery("#prk_ferro_right").is(":hover")) {
						prk_hover_right();
					}
					if(jQuery(jQuery.fn.ferroSlider.getActualSlideId()).hasClass('slide_video')) {
						jQuery('#ferroslider-sensible-area-left,#ferroslider-sensible-area-right').css({'display':'none'});
					}
					else {
						jQuery('#ferroslider-sensible-area-left,#ferroslider-sensible-area-right').css({'display':'block'});
					}
				},450);
				jQuery('.prk_ferro_wrap').removeClass('ferro_active');
				if (jQuery('#ferroslider-navigation-map a.actual').length) {
					ferro_active_div='#'+jQuery('#ferroslider-navigation-map a.actual').attr('id').substr(4);
			    	jQuery(ferro_active_div).addClass('ferro_active');
			        update_ferro(false);
			    }
		    });
		}

		//CONTACT PAGE
        function init_map() {
        	if (jQuery('#google-maps').attr('data-style')==='subtle_grayscale') {
	            var mapOptions = {
	                zoom: parseInt(jQuery('#google-maps').attr('data-zoom'),10),
	                center: new google.maps.LatLng(jQuery('#google-maps').attr('data-lat'), jQuery('#google-maps').attr('data-long')),
	                styles: [{featureType:"landscape",stylers:[{saturation:-100},{lightness:65},{visibility:"on"}]},{featureType:"poi",stylers:[{saturation:-100},{lightness:51},{visibility:"simplified"}]},{featureType:"road.highway",stylers:[{saturation:-100},{visibility:"simplified"}]},{featureType:"road.arterial",stylers:[{saturation:-100},{lightness:30},{visibility:"on"}]},{featureType:"road.local",stylers:[{saturation:-100},{lightness:40},{visibility:"on"}]},{featureType:"transit",stylers:[{saturation:-100},{visibility:"simplified"}]},{featureType:"administrative.province",stylers:[{visibility:"off"}]/**/},{featureType:"administrative.locality",stylers:[{visibility:"off"}]},{featureType:"administrative.neighborhood",stylers:[{visibility:"on"}]/**/},{featureType:"water",elementType:"labels",stylers:[{visibility:"on"},{lightness:-25},{saturation:-100}]},{featureType:"water",elementType:"geometry",stylers:[{hue:"#ffff00"},{lightness:-25},{saturation:-97}]}]
	            };
	        }
	        else if (jQuery('#google-maps').attr('data-style')==='almost_gray') {
	            var mapOptions = {
	                zoom: parseInt(jQuery('#google-maps').attr('data-zoom'),10),
	                center: new google.maps.LatLng(jQuery('#google-maps').attr('data-lat'), jQuery('#google-maps').attr('data-long')),
	                styles: [{"stylers":[{"saturation":-100},{"gamma":1}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi.place_of_worship","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.place_of_worship","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"water","stylers":[{"visibility":"on"},{"saturation":50},{"gamma":0},{"hue":"#50a5d1"}]},{"featureType":"administrative.neighborhood","elementType":"labels.text.fill","stylers":[{"color":"#333333"}]},{"featureType":"road.local","elementType":"labels.text","stylers":[{"weight":0.5},{"color":"#333333"}]},{"featureType":"transit.station","elementType":"labels.icon","stylers":[{"gamma":1},{"saturation":50}]}]
	            };
	        }
	        else if (jQuery('#google-maps').attr('data-style')==='cobalt') {
	            var mapOptions = {
	                zoom: parseInt(jQuery('#google-maps').attr('data-zoom'),10),
	                center: new google.maps.LatLng(jQuery('#google-maps').attr('data-lat'), jQuery('#google-maps').attr('data-long')),
	                styles: [{"featureType":"all","elementType":"all","stylers":[{"invert_lightness":true},{"saturation":10},{"lightness":30},{"gamma":0.5},{"hue":"#435158"}]}]
	            };
	        }
	        else if (jQuery('#google-maps').attr('data-style')==='midnight') {
	            var mapOptions = {
	                zoom: parseInt(jQuery('#google-maps').attr('data-zoom'),10),
	                center: new google.maps.LatLng(jQuery('#google-maps').attr('data-lat'), jQuery('#google-maps').attr('data-long')),
	                styles: [{"featureType":"water","stylers":[{"color":"#021019"}]},{"featureType":"landscape","stylers":[{"color":"#08304b"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#0c4152"},{"lightness":5}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#0b434f"},{"lightness":25}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#000000"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#0b3d51"},{"lightness":16}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#ffffff"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#000000"},{"lightness":13}]},{"featureType":"transit","stylers":[{"color":"#146474"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#144b53"},{"lightness":14},{"weight":1.4}]}]
	            };
	        }
	        else if (jQuery('#google-maps').attr('data-style')==='old_timey') {
	            var mapOptions = {
	                zoom: parseInt(jQuery('#google-maps').attr('data-zoom'),10),
	                center: new google.maps.LatLng(jQuery('#google-maps').attr('data-lat'), jQuery('#google-maps').attr('data-long')),
	                styles: [{"featureType":"administrative","stylers":[{"visibility":"off"}]},{"featureType":"poi","stylers":[{"visibility":"simplified"}]},{"featureType":"road","stylers":[{"visibility":"simplified"}]},{"featureType":"water","stylers":[{"visibility":"simplified"}]},{"featureType":"transit","stylers":[{"visibility":"simplified"}]},{"featureType":"landscape","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"visibility":"off"}]},{"featureType":"road.local","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"water","stylers":[{"color":"#84afa3"},{"lightness":52}]},{"stylers":[{"saturation":-77}]},{"featureType":"road"}]
	            };
	        }
	        else if (jQuery('#google-maps').attr('data-style')==='green') {
	            var mapOptions = {
	                zoom: parseInt(jQuery('#google-maps').attr('data-zoom'),10),
	                center: new google.maps.LatLng(jQuery('#google-maps').attr('data-lat'), jQuery('#google-maps').attr('data-long')),
	                styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#333739"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#2ecc71"}]},{"featureType":"poi","stylers":[{"color":"#2ecc71"},{"lightness":-7}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#2ecc71"},{"lightness":-28}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#2ecc71"},{"visibility":"on"},{"lightness":-15}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#2ecc71"},{"lightness":-18}]},{"elementType":"labels.text.fill","stylers":[{"color":"#ffffff"}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#2ecc71"},{"lightness":-34}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#333739"},{"weight":0.8}]},{"featureType":"poi.park","stylers":[{"color":"#2ecc71"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#333739"},{"weight":0.3},{"lightness":10}]}]
	            };
	        }
	        else {
	        	var mapOptions = {
	                zoom: parseInt(jQuery('#google-maps').attr('data-zoom'),10),
	                center: new google.maps.LatLng(jQuery('#google-maps').attr('data-lat'), jQuery('#google-maps').attr('data-long'))
	            };
	        }

            var mapElement = document.getElementById('google-maps');
            if (jQuery('#menu_section.at_top').length) {
				jQuery("#google-maps.fullscreen").width(jQuery(window).width());
			}
			else {
				jQuery("#google-maps.fullscreen").width(jQuery(window).width()-theme_options.logo_bar_width);
			}
            jQuery('#google-maps.fullscreen').css({'height':height_fix});
            var map = new google.maps.Map(mapElement, mapOptions);
            google.maps.event.addListenerOnce(map, 'idle', function(){
			    if (jQuery('#contact_info.auto_open').length) {
		    			setTimeout(function() { 
		    				if (contact_is_open===false) {
		    					prk_toggle_contact_info();
		    				}
		    			},1000);
		    	}
			});
            if (jQuery('#google-maps').attr('data-marker_image_lat')!="" && jQuery('#google-maps').attr('data-marker_image_long')!=""){
	            var marker = new google.maps.Marker({
	                  position: new google.maps.LatLng(jQuery('#google-maps').attr('data-marker_image_lat'), jQuery('#google-maps').attr('data-marker_image_long')),
	                  map: map,
	                  icon: jQuery('#google-maps').attr('data-marker'),
	                  size: new google.maps.Size(40,52)
	              });
	        }
	        else {
	        	var marker = new google.maps.Marker({
	                  position: new google.maps.LatLng(jQuery('#google-maps').attr('data-lat'), jQuery('#google-maps').attr('data-long')),
	                  map: map,
	                  icon: jQuery('#google-maps').attr('data-marker'),
	                  size: new google.maps.Size(40,52)
	              });
	        }
	        if (jQuery('#google-maps.fullscreen').length) {
		        google.maps.event.addListener(marker, 'click', function() {
		        	prk_toggle_contact_info();
				});
		    }
        }
        if (jQuery('#google-maps').length){
        	init_map();
        	pirenko_resize();
    	}
    	if (jQuery('#contact-image-fth').length) {
    		var img_load=imagesLoaded('#contact-image-fth');
    		img_load.on('always', function() {
    			setTimeout(function(){ pirenko_resize();},50);
	    		jQuery('#contact-image-cover').unbind('click');
	    		jQuery('#contact-image-fth.fullscreen #contact-image-cover').click(function(e) {
	    			e.preventDefault();
	    			prk_toggle_contact_info();
	    		});
	    		if (jQuery('#contact_info.auto_open').length) {
		    			setTimeout(function() { 
		    				if (contact_is_open===false) {
		    					prk_toggle_contact_info();
		    				}
		    			},1000);
		    	}
	    	});
    	}
		jQuery('#submit_message_div a').click(function(e) {
			e.preventDefault();
			//REMOVE PREVIOUS ERRORS IF THEY EXIST
			jQuery("#contact-form .contact_error").remove();
	    
			//ADD THE TEMPLATE NAME TO THE SUBJECT
			var helper=jQuery('#c_subject').attr('value');
			jQuery('#full_subject').attr('value',jQuery('#contact-form').attr('data-name')+' - '+helper);
			var empty_text_error=jQuery('#contact-form').attr('data-empty');
			var invalid_email_error=jQuery('#contact-form').attr('data-invalid');
			var value, theID, error, emailReg;
			error = false;
	        emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;				
			//DATA VALIDATION
			jQuery('#c_name, #c_email, #c_message').each(function()
	        {
				value = jQuery(this).val();
	            theID = jQuery(this).attr('id');
	            if(value === '' || value=== jQuery(this).attr('data-original'))
	            {
	                if (theID === 'c_message') {
	                    jQuery(this).after('<p class="contact_error zero_color special_italic">'+empty_text_error+'</p>');
	                }
	                else {
						jQuery(this).after('<p class="contact_error zero_color special_italic">'+empty_text_error+'</p>');
					}
	                error = true;
				}
				if(theID === 'c_email' && value !== '' && !emailReg.test(value))
				{
					jQuery(this).after('<p class="contact_error zero_color special_italic">'+invalid_email_error+'</p>');
					error = true;
				}
			});
					
			//SEND EMAIL IF THERE ARE NO ERRORS
			if(error === false)
			{
				//HIDE THE SEND BUTTON
				jQuery("#submit_message_div").fadeTo("slow",0,function() 
				{
					//ON COMPLETE MAKE THE BUTTON INVISIBLE
					jQuery("#submit_message_div").addClass("hidden_div");	
					jQuery("#contact_ok").fadeIn("slow");
					ajaxSubmit();
				});
			}
		});

		//RETINA IMAGES SIZE CHANGE
		jQuery('img.prk_retina').each(function() {
			jQuery(this).width('');
			jQuery(this).height('');
			var original_height=jQuery(this).height();
			//DO NOTHING IF THERE ARE CSS RESTRICTIONS TO THE VERTICAL SIZE
			jQuery(this).css({'max-height':'5000px'});
			if (jQuery(this).height()>original_height) {
				jQuery(this).css({'max-height':''});
			}
			else {
				jQuery(this).width((jQuery(this).width()/2));
				jQuery(this).height((original_height/2));
			}
		});

		jQuery('.wpb_alert').not('.wpb_alert.wpb_alert-info,.wpb_alert.wpb_alert-success,.wpb_alert.wpb_alert-error').each(function() {
			jQuery(this).prepend('<div class="navicon-spam"></div>');
		});
		jQuery('.wpb_alert.wpb_alert-info').each(function() {
			jQuery(this).prepend('<div class="navicon-info"></div>');
		});
		jQuery('.wpb_alert.wpb_alert-success').each(function() {
			jQuery(this).prepend('<div class="navicon-checkmark-circle"></div>');
		});
		jQuery('.wpb_alert.wpb_alert-error').each(function() {
			jQuery(this).prepend('<div class="navicon-cancel-circle"></div>');
		});

		if ($js_flexislider('.comments_slider').length)
		{
			$js_flexislider('.comments_slider').flexslider(
			{
				animation: "fade",
				useCSS  :false,        
				slideshow: true,    
				slideshowSpeed: 5000,    
				animationDuration: 300, 
				smoothHeight: true,
				directionNav: false,   
				controlNav: false,   
				keyboardNav: false,
				touch:false,
				start:function (slider) {
					slider.css({'min-height':0});
					jQuery(window).trigger("debouncedresize");
					$js_flexislider('.comments_slider').stop().delay(100).animate({'opacity':'1'}, 100 );
				}
			});
		}

		//SHARRE POPUP
		jQuery('.prk_sharrre_wrapper').hover(function() {
			jQuery(this).children('.sharrre_hider').stop().animate({
				width:200
			},
			{
				easing:'linear',
				duration:400,
				complete:function() {
					jQuery(this).css({'width':jQuery(this).children('.prk_sharre_btns').width()+16})
				}
			});
		}, function() {
			jQuery(this).children('.sharrre_hider').stop().animate({
				width:0
			},
			{
				easing:'linear',
				duration:300,
				complete:function() {
				}
			});
		});

		//HANDLE PLACEHODERS EVEN ON OLDER BROWSERS
		jQuery('[placeholder]').focus(function() {
			var input = jQuery(this);
			if (input.val() == input.attr('placeholder')) {
				input.val('');
				input.removeClass('placeholder');
			}
		}).blur(function() {
			var input = jQuery(this);
			if (input.val() == '' || input.val() == input.attr('placeholder')) {
				input.addClass('placeholder');
				input.val(input.attr('placeholder'));
			}
		}).blur();
			
		//ADD ARROWS
		jQuery('ul.sitemap_block li a,.widget_rss ul li a, .widget_meta a,.widget_recent_entries a,.widget_categories a,.widget_archive a,.widget_pages a,.widget_links a,.widget_nav_menu a').each(function() {
			jQuery(this).addClass('smoothed_a fade_anchor');
			jQuery(this).prepend('<div class="prk_theme_arrows"><div class="tr_wrapper"><div class="navicon-play prk_minus_opacity"></div></div></div>');
		});

		//WOOCOMERCERCE
		if (theme_options.active_woocommerce==="true") {
			jQuery('.woocommerce-tabs .panel, .woocommerce form.login, .woocommerce form.checkout_coupon, .woocommerce form.register, .woocommerce-page form.login, .woocommerce-page form.checkout_coupon, .woocommerce-page form.register, .woocommerce #payment,.woocommerce .form-row.place-order, .woocommerce #payment ul.payment_methods, .woocommerce-page #payment ul.payment_methods.woocommerce-tabs .panel.entry-content,.woocommerce-message, .woocommerce-error, .woocommerce-info,.shop_table,.cart_totals>table,.woocommerce #searchform #s').live().addClass('no_radius');
			jQuery('.woocommerce-tabs .panel').addClass("prk_bordered");
			jQuery('.woocommerce-result-count,.woocommerce-review-link').addClass("zero_color header_font");
			jQuery('.woocommerce .reset_variations, .woocommerce h2, .cart_totals h2,.woocommerce h1,.shipping_calculator h2,.checkout h3,.woocommerce h2,.woocommerce h3').not('.prk-woocommerce .woocommerce-tabs h2').addClass('zero_color bd_headings_text_shadow');
			jQuery('.woocommerce .woocommerce-ordering select,.woocommerce-page .woocommerce-ordering select,.woocommerce .input-text,.woocommerce textarea,.woocommerce form .form-row textarea, .woocommerce-page form .form-row textarea').addClass('pirenko_highlighted');
			jQuery('.woocommerce .product_meta .posted_in,.woocommerce .product_meta .tagged_as,.tagcloud').addClass('clearfix');
			jQuery('.prk-woocommerce h1,.woocommerce h2,.woocommerce h3').not('').addClass('header_font');
			jQuery('.woocommerce button').live().addClass('no_radius');
			jQuery('.woocommerce #searchform #searchsubmit').live().addClass('button product_type_simple');
			jQuery('.product .images .thumbnails>a,.product .images>a,.product>a,.widget .product_list_widget a').live().addClass('woo_small_fade');
			jQuery('.woocommerce ul.products li.product a img, .woocommerce-page ul.products li.product a img,.woocommerce div.product div.images img, .woocommerce #content div.product div.images img, .woocommerce-page div.product div.images img, .woocommerce-page #content div.product div.images img,.woocommerce ul.cart_list li img, .woocommerce ul.product_list_widget li img, .woocommerce-page ul.cart_list li img, .woocommerce-page ul.product_list_widget li img').live().addClass('boxed_shadow');
			jQuery('.woocommerce-page #sidebar a').each(function() {
				jQuery(this).attr('data-color',theme_options.woo_color);
			});
			
			jQuery('.woocommerce-page #sidebar .product-categories li a').each(function() 
			{
				jQuery(this).prepend('<div class="prk_theme_arrows"><div class="tr_wrapper"><div class="navicon-play prk_minus_opacity"></div></div></div>');
			});
			jQuery('.woocommerce-page #sidebar .product-categories a').each(function() {
				jQuery(this).addClass('smoothed_a');
			});
			jQuery('.woo_small_fade img').live('mouseover', function() {
				if (is_mobile()===false) {
					jQuery(this).stop().transition({
						opacity:0.8,
						duration:200,
						easing:'linear' 
					});
				}
			});
			jQuery('.woo_small_fade img').live( 'mouseout', function() {
				jQuery(this).stop().transition({
					opacity:1,
					duration:200,
					easing:'linear' 
				});
			});
			jQuery('.woocommerce .woocommerce-ordering select,.woocommerce-page .woocommerce-ordering select').each(function() {
				var curr_text=jQuery(this).parent().find('select option:selected').text();
				jQuery(this).parent().append("<div class='pirenko_highlighed select_twin colored_bg prk_bordered'><div class='twin_text'>"+curr_text+"</div><div class='navicon-menu-2 woo_select_navicon'></div></div>");
				if (!jQuery(this).parent().children('.reset_variations').length) {
					jQuery(this).parent().addClass('no_reset_btn');
				}
				jQuery(this).change(function() {
					var curr_text=jQuery(this).parent().find('select option:selected').text();
					jQuery(this).parent().find('.twin_text').html('');
					jQuery(this).parent().find('.twin_text').html(curr_text);
				});
			});
			jQuery('.product_meta a,.product-name a,a.showcoupon,a.showlogin,a.added_to_cart,.woocommerce-pagination a,.woocommerce-tabs .panel a').live().css({'color':theme_options.woo_color});

			//PRODUCT GALLERIES
			jQuery('.prk-woocommerce').magnificPopup({
				delegate: 'a.prk_woo_magnificent',
				src:'data-src',
				type: 'image',
				tLoading: 'Loading image #%curr%...',
				fixedContentPos: false,
				fixedBgPos: true,
				closeOnContentClick: true,
				closeBtnInside: false,
				mainClass: 'mfp-no-margins my-mfp-zoom-in',
				removalDelay: 300,
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0,1] // Will preload 0 - before current, and 1 after the current image
				},
				image: {
					tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
					titleSrc: function(item) {
						return item.el.attr('data-title');
					}
				},
				callbacks: {
					open: function() {
						scrollbar_width=window.innerWidth-jQuery("body").width();
						jQuery('html').css({'padding-right':scrollbar_width});
						jQuery('html').css({'overflow-y':'hidden'});
						jQuery('.mfp-bg').css({'opacity':0.8});
					},
					beforeClose: function() {
						jQuery('.mfp-bg').css({'opacity':0});
					},
					close: function() {
						jQuery('html').css({'overflow-y':'','padding-right':''});
					}
				}
			});
		}//END WOOCOMMERCE STUFF

		//VISUAL COMPOSER STUFF
		//console.log(theme_options.active_visual_composer);
		if (theme_options.active_visual_composer) {
			//console.log("COMPOSER");
			jQuery('.wpb_single_image a').not('.wpb_single_image a.no_magnize').addClass('image-popup-no-margins');
			jQuery('.image-popup-no-margins').magnificPopup({
				type: 'image',
				fixedContentPos: false,
				fixedBgPos: true,
				closeOnContentClick: true,
				closeBtnInside: false,
				mainClass: 'mfp-no-margins my-mfp-zoom-in',
				removalDelay: 300,
				image: {
					verticalFit: true
				},
				callbacks: {
					open: function() {
						scrollbar_width=window.innerWidth-jQuery("body").width();
						jQuery('html').css({'padding-right':scrollbar_width});
						jQuery('html').css({'overflow-y':'hidden'});
						jQuery('.mfp-bg').css({'opacity':0.8});
					},
					beforeClose: function() {
						jQuery('.mfp-bg').css({'opacity':0});
					},
					close: function() {
						jQuery('html').css({'overflow-y':'','padding-right':''});
					}
				}
			});
			//GALLERIES
			jQuery('.popup-gallery').each(function(){
				jQuery(this).magnificPopup({
					delegate: 'a',
					type: 'image',
					tLoading: 'Loading image #%curr%...',
					fixedContentPos: false,
					fixedBgPos: true,
					closeOnContentClick: true,
					closeBtnInside: false,
					mainClass: 'mfp-no-margins my-mfp-zoom-in',
					removalDelay: 300,
					gallery: {
						enabled: true,
						navigateByImgClick: true,
						preload: [0,1] // Will preload 0 - before current, and 1 after the current image
					},
					image: {
						tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
						titleSrc: function(item) {
							return item.el.attr('title');
						}
					},
					callbacks: {
						open: function() {
							scrollbar_width=window.innerWidth-jQuery("body").width();
							jQuery('html').css({'padding-right':scrollbar_width});
							jQuery('html').css({'overflow-y':'hidden'});
							jQuery('.mfp-bg').css({'opacity':0.8});
						},
						beforeClose: function() {
							jQuery('.mfp-bg').css({'opacity':0});
						},
						close: function() {
							jQuery('html').css({'overflow-y':'','padding-right':''});
						}
					}
				});
			});
			jQuery('.wpb_slider_nivo').magnificPopup({
				delegate: 'a.prettyphoto',
				type: 'image',
				tLoading: 'Loading image #%curr%...',
				fixedContentPos: false,
				fixedBgPos: true,
				closeOnContentClick: true,
				closeBtnInside: false,
				mainClass: 'mfp-no-margins my-mfp-zoom-in',
				removalDelay: 300,
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0,1] // Will preload 0 - before current, and 1 after the current image
				},
				image: {
					tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
					titleSrc: function(item) {
						return item.el.attr('title');
					}
				},
				callbacks: {
					open: function() {
						scrollbar_width=window.innerWidth-jQuery("body").width();
						jQuery('html').css({'padding-right':scrollbar_width});
						jQuery('html').css({'overflow-y':'hidden'});
						jQuery('.mfp-bg').css({'opacity':0.8});
					},
					beforeClose: function() {
						jQuery('.mfp-bg').css({'opacity':0});
					},
					close: function() {
						jQuery('html').css({'overflow-y':'','padding-right':''});
					}
				}
			});
			jQuery('.wpb_single_image a,.wpb_image_grid_ul li a').hover( function() {
				jQuery(this).children('img').stop();
				jQuery(this).children('img').animate({
					opacity: 0.8
				},300);
				}, function() {
					jQuery(this).find('img').stop();
					jQuery(this).find('img').delay(100).animate({
							opacity:1
				},300); 
			});
			jQuery('.wpb_flexslider').each(function() {
				var this_element = jQuery(this);
				var sliderSpeed = 800,
				sliderTimeout = parseInt(this_element.attr('data-interval'),10)*1000,
				sliderFx = this_element.attr('data-flex_fx'),
				slideshow = true;
				if ( sliderTimeout === 0 ) {
					slideshow = false;
				}
				this_element.flexslider({
					animation: sliderFx,
					slideshow: slideshow,
					slideshowSpeed: sliderTimeout,
					sliderSpeed: sliderSpeed,
					controlNav: false,
					smoothHeight: true,
					start:function (slider) {
					jQuery('.flex-direction-nav li a.flex-prev').each(function() 
					{
						jQuery(this).prepend('<div class="pirenko_tinted submenu_arrow_left"><div class="icon-left-open-big"></div></div>');
					});
					jQuery('.flex-direction-nav li a.flex-next').each(function() 
					{
						jQuery(this).prepend('<div class="pirenko_tinted submenu_arrow_right"><div class="icon-right-open-big"></div></div>');
					});
					}
				});
			});
			jQuery('.wpb_gallery_slides').each(function(index) {
				var this_element = jQuery(this);

				if ( this_element.hasClass('wpb_slider_nivo') ) {
					var sliderSpeed = 800,
						sliderTimeout = this_element.attr('data-interval')*1000;

					if ( sliderTimeout === 0 ) {
						sliderTimeout = 9999999999;
					}
					this_element.find('.nivoSlider').nivoSlider({
						effect: 'boxRainGrow,boxRain,boxRainReverse,boxRainGrowReverse', // Specify sets like: 'fold,fade,sliceDown'
						slices: 15, // For slice animations
						boxCols: 8, // For box animations
						boxRows: 4, // For box animations
						animSpeed: sliderSpeed, // Slide transition speed
						pauseTime: sliderTimeout, // How long each slide will show
						startSlide: 0, // Set starting Slide (0 index)
						directionNav: true, // Next & Prev navigation
						directionNavHide: true, // Only show on hover
						controlNav: true, // 1,2,3... navigation
						keyboardNav: false, // Use left & right arrows
						pauseOnHover: true, // Stop animation while hovering
						manualAdvance: false, // Force manual transitions
						prevText: 'Prev', // Prev directionNav text
						nextText: 'Next' // Next directionNav text
					});
				}
				else if ( this_element.hasClass('wpb_image_grid') ) {
					var isotope = this_element.find('.wpb_image_grid_ul');
					var img_load=imagesLoaded(isotope);
					img_load.on('always', function() {
						isotope.isotope({
							// options
							itemSelector : '.isotope-item',
							layoutMode : 'fitRows',
							transformsEnabled: false
						},
						function()
						{
							
						});
						jQuery(window).load(function() {
							isotope.isotope("reLayout");
						});

					});
				}
			});
			jQuery('.wpb_tour_tabs_wrapper>ul>li').hover(function() {
				if (is_mobile()===false) {
					jQuery(this).stop().animate({
						backgroundColor:theme_options.active_color,
				},200);
				}
			},	
				function() {
					if (!jQuery(this).hasClass('ui-state-active')) {
						jQuery(this).stop().animate({
							backgroundColor:theme_options.background_color,
						},200);
					}
				}
			);
			vc_tabsBehaviour();
			vc_twitterBehaviour();
			vc_toggleBehaviour();
			vc_accordionBehaviour();
			vc_teaserGrid();
			vc_carouselBehaviour();
			vc_slidersBehaviour();
			vc_prettyPhoto();
			vc_googleplus();
			vc_pinterest();
			vc_progress_bar();
			vc_waypoints();
		}//END VISUAL COMPOSER STUFF

		//FIT SCREENR VIDEOS
		jQuery(".columns").fitVids({ customSelector: "iframe[src^='http://www.screenr.com']"});

		//MAGNIFIC POPUP
		jQuery('.prk_shorts').magnificPopup({
			delegate: 'div.prk_magnificent',
			src:'data-src',
			type: 'image',
			tLoading: 'Loading image #%curr%...',
			fixedContentPos: false,
			fixedBgPos: true,
			closeOnContentClick: true,
			closeBtnInside: false,
			mainClass: 'mfp-no-margins my-mfp-zoom-in',
			removalDelay: 300,
			gallery: {
				enabled: true,
				navigateByImgClick: true,
				preload: [0,1] // Will preload 0 - before current, and 1 after the current image
			},
			image: {
				tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
				titleSrc: function(item) {
					return item.el.attr('title');
				}
			},
			callbacks: {
				open: function() {
					scrollbar_width=window.innerWidth-jQuery("body").width();
					jQuery('html').css({'padding-right':scrollbar_width});
					jQuery('html').css({'overflow-y':'hidden'});
					jQuery('.mfp-bg').css({'opacity':0.8});
				},
				beforeClose: function() {
					jQuery('.mfp-bg').css({'opacity':0});
				},
				close: function() {
					jQuery('html').css({'overflow-y':'','padding-right':''});
						}
			}
		});
		jQuery('.pirenko_gallery').each(function(){
			jQuery(this).magnificPopup({
				delegate: 'div.portfolio_entry_li',
				src:'data-src',
				type: 'image',
				tLoading: 'Loading image #%curr%...',
				fixedContentPos: false,
				fixedBgPos: true,
				closeOnContentClick: true,
				closeBtnInside: false,
				mainClass: 'mfp-no-margins my-mfp-zoom-in',
				removalDelay: 300,
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0,1] // Will preload 0 - before current, and 1 after the current image
				},
				image: {
					tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
					titleSrc: function(item) {
						return item.el.attr('title');
					}
				},
				callbacks: {
					open: function() {
						scrollbar_width=window.innerWidth-jQuery("body").width();
						jQuery('html').css({'padding-right':scrollbar_width});
						jQuery('html').css({'overflow-y':'hidden'});
						jQuery('.mfp-bg').css({'opacity':0.8});
					},
					beforeClose: function() {
						jQuery('.mfp-bg').css({'opacity':0});
					},
					close: function() {
						jQuery('html').css({'overflow-y':'','padding-right':''});
					}
				}
			});
		});
		//LIGHBOX ON+INDIVIDUAL SLIDERS OFF
		jQuery('#folio_masonry').magnificPopup({
			delegate: 'a.magna_a',
			src:'data-src',
			type: 'image',
			tLoading: 'Loading image #%curr%...',
			fixedContentPos: false,
			fixedBgPos: true,
			closeOnContentClick: true,
			closeBtnInside: false,
			mainClass: 'mfp-no-margins my-mfp-zoom-in',
			removalDelay: 300,
			gallery: {
				enabled: true,
				navigateByImgClick: true,
				preload: [0,1] // Will preload 0 - before current, and 1 after the current image
			},
			image: {
				tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
				titleSrc: function(item) {
					return item.el.attr('title');
				}
			},
			callbacks: {
				open: function() {
					scrollbar_width=window.innerWidth-jQuery("body").width();
					jQuery('html').css({'padding-right':scrollbar_width});
					jQuery('html').css({'overflow-y':'hidden'});
					jQuery('.mfp-bg').css({'opacity':0.8});
				},
				beforeClose: function() {
					jQuery('.mfp-bg').css({'opacity':0});
				},
				close: function() {
					jQuery('html').css({'overflow-y':'','padding-right':''});
				}
			}
		});
		//LIGHBOX OFF+INDIVIDUAL SLIDERS ON
		jQuery('#folio_masonry .individual_lightbox.per_init').not(jQuery('#folio_masonry .individual_lightbox.per_init.conf')).each(function() {
			jQuery(this).removeClass('per_init');
			jQuery(this).parent().parent().magnificPopup({
				delegate: 'div.prk_magnificent_li',
				src:'data-src',
				type: 'image',
				tLoading: 'Loading image #%curr%...',
				fixedContentPos: false,
				fixedBgPos: true,
				closeOnContentClick: true,
				closeBtnInside: false,
				mainClass: 'mfp-no-margins my-mfp-zoom-in',
				removalDelay: 300,
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0,1] // Will preload 0 - before current, and 1 after the current image
				},
				image: {
					tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
					titleSrc: function(item) {
						return item.el.attr('title');
					}
				},
				callbacks: {
					open: function() {
						scrollbar_width=window.innerWidth-jQuery("body").width();
						jQuery('html').css({'padding-right':scrollbar_width});
						jQuery('html').css({'overflow-y':'hidden'});
						jQuery('.mfp-bg').css({'opacity':0.8});
					},
					beforeClose: function() {
						jQuery('.mfp-bg').css({'opacity':0});
					},
					close: function() {
						jQuery('html').css({'overflow-y':'','padding-right':''});
					}
				}
			});
		});
		//LIGHBOX ON+INDIVIDUAL SLIDERS ON
		jQuery('#folio_masonry .individual_lightbox.per_init.conf').each(function() {
			jQuery(this).removeClass('per_init');
			jQuery(this).parent().parent().magnificPopup({
				delegate: '.magna_conf',
				src:'data-src',
				type: 'image',
				tLoading: 'Loading image #%curr%...',
				fixedContentPos: false,
				fixedBgPos: true,
				closeOnContentClick: true,
				closeBtnInside: false,
				mainClass: 'mfp-no-margins my-mfp-zoom-in',
				removalDelay: 300,
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0,1] // Will preload 0 - before current, and 1 after the current image
				},
				image: {
					tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
					titleSrc: function(item) {
						return item.el.attr('title');
					}
				},
				callbacks: {
					open: function() {
						scrollbar_width=window.innerWidth-jQuery("body").width();
						jQuery('html').css({'padding-right':scrollbar_width});
						jQuery('html').css({'overflow-y':'hidden'});
						jQuery('.mfp-bg').css({'opacity':0.8});
					},
					beforeClose: function() {
						jQuery('.mfp-bg').css({'opacity':0});
					},
					close: function() {
						jQuery('html').css({'overflow-y':'','padding-right':''});
					}
				}
			});
		});
		jQuery('.prk-panel').each(function() {
			jQuery(this).magnificPopup({
				delegate: 'a.magna_a',
				type: 'image',
				tLoading: 'Loading image #%curr%...',
				fixedContentPos: false,
				fixedBgPos: true,
				closeOnContentClick: true,
				closeBtnInside: false,
				mainClass: 'mfp-no-margins my-mfp-zoom-in',
				removalDelay: 300,
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0,1] // Will preload 0 - before current, and 1 after the current image
				},
				image: {
					tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
					titleSrc: function(item) {
						return item.el.attr('title');
					}
				},
				callbacks: {
					open: function() {
						scrollbar_width=window.innerWidth-jQuery("body").width();
						jQuery('html').css({'padding-right':scrollbar_width});
						jQuery('html').css({'overflow-y':'hidden'});
						jQuery('.mfp-bg').css({'opacity':0.8});
					},
					beforeClose: function() {
						jQuery('.mfp-bg').css({'opacity':0});
					},
					close: function() {
						jQuery('html').css({'overflow-y':'','padding-right':''});
					}
				}
			});
		});
		jQuery('.as-panel').each(function() {
			jQuery(this).magnificPopup({
				delegate: 'a.magna_b',
				type: 'image',
				tLoading: 'Loading image #%curr%...',
				fixedContentPos: false,
				fixedBgPos: true,
				closeOnContentClick: true,
				closeBtnInside: false,
				mainClass: 'mfp-no-margins my-mfp-zoom-in',
				removalDelay: 300,
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0,1] // Will preload 0 - before current, and 1 after the current image
				},
				image: {
					tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
					titleSrc: function(item) {
						return item.el.attr('title');
					}
				},
				callbacks: {
					open: function() {
						scrollbar_width=window.innerWidth-jQuery("body").width();
						jQuery('html').css({'padding-right':scrollbar_width});
						jQuery('html').css({'overflow-y':'hidden'});
						jQuery('.mfp-bg').css({'opacity':0.8});
					},
					beforeClose: function() {
						jQuery('.mfp-bg').css({'opacity':0});
					},
					close: function() {
						jQuery('html').css({'overflow-y':'','padding-right':''});
					}
				}
			});
		});
		jQuery('#folio_father').magnificPopup({
			delegate: 'a.magna_c',
			type: 'image',
			tLoading: 'Loading image #%curr%...',
			fixedContentPos: false,
			fixedBgPos: true,
			closeOnContentClick: true,
			closeBtnInside: false,
			mainClass: 'mfp-no-margins my-mfp-zoom-in',
			removalDelay: 300,
			gallery: {
				enabled: true,
				navigateByImgClick: true,
				preload: [0,1] // Will preload 0 - before current, and 1 after the current image
			},
			image: {
				tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
				titleSrc: function(item) {
					return item.el.attr('title');
				}
			},
			callbacks: {
				open: function() {
					scrollbar_width=window.innerWidth-jQuery("body").width();
					jQuery('html').css({'padding-right':scrollbar_width});
					jQuery('html').css({'overflow-y':'hidden'});
					jQuery('.mfp-bg').css({'opacity':0.8});
				},
				beforeClose: function() {
					jQuery('.mfp-bg').css({'opacity':0});
				},
				close: function() {
					jQuery('html').css({'overflow-y':'','padding-right':''});
				}
			}
		});
		jQuery('#magner').magnificPopup({
			delegate: 'a.magna_b',
			src:'data-src',
			type: 'image',
			tLoading: 'Loading image #%curr%...',
			fixedContentPos: false,
			fixedBgPos: true,
			closeOnContentClick: true,
			closeBtnInside: false,
			mainClass: 'mfp-no-margins my-mfp-zoom-in',
			removalDelay: 300,
			gallery: {
				enabled: true,
				navigateByImgClick: true,
				preload: [0,1] // Will preload 0 - before current, and 1 after the current image
			},
			image: {
				tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
				titleSrc: function(item) {
					return item.el.attr('title');
				}
			},
			callbacks: {
				open: function() {
					scrollbar_width=window.innerWidth-jQuery("body").width();
					jQuery('html').css({'padding-right':scrollbar_width});
					jQuery('html').css({'overflow-y':'hidden'});
					jQuery('.mfp-bg').css({'opacity':0.8});
				},
				beforeClose: function() {
					jQuery('.mfp-bg').css({'opacity':0});
				},
				close: function() {
					jQuery('html').css({'overflow-y':'','padding-right':''});
				}
			}
		});
		jQuery('#d_magner').magnificPopup({
			delegate: 'div.prk_magnificent',
			src:'data-src',
			type: 'image',
			tLoading: 'Loading image #%curr%...',
			fixedContentPos: false,
			fixedBgPos: true,
			closeOnContentClick: true,
			closeBtnInside: false,
			mainClass: 'mfp-no-margins my-mfp-zoom-in',
			removalDelay: 300,
			gallery: {
				enabled: true,
				navigateByImgClick: true,
				preload: [0,1] // Will preload 0 - before current, and 1 after the current image
			},
			image: {
				tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
				titleSrc: function(item) {
					return item.el.attr('title');
				}
			},
			callbacks: {
				open: function() {
					scrollbar_width=window.innerWidth-jQuery("body").width();
					jQuery('html').css({'padding-right':scrollbar_width});
					jQuery('html').css({'overflow-y':'hidden'});
					jQuery('.mfp-bg').css({'opacity':0.8});
				},
				beforeClose: function() {
					jQuery('.mfp-bg').css({'opacity':0});
				},
				close: function() {
					jQuery('html').css({'overflow-y':'','padding-right':''});
				}
			}
		});

		//HEADINGS STYLE
		if (jQuery('#headings_wrap').length && jQuery('#headings_wrap').attr('data-color')!==undefined)
		{
			jQuery('#headings_wrap,#headings_wrap #breadcrumbs.zero_color,#headings_wrap #breadcrumbs.zero_color a').css({'color':jQuery('#headings_wrap').attr('data-color'),'text-shadow':'0px 0px 1px rgba('+jQuery('#headings_wrap').attr('data-c1')+', '+jQuery('#headings_wrap').attr('data-c2')+', '+jQuery('#headings_wrap').attr('data-c3')+',0.3)'});
		}

		//MAILCHIMP, CONTACT FORM 7 && PROTECTED PAGES
		jQuery('#prk_protected input,.mc_input,.wpcf7-form input[type="password"],.wpcf7-form input[type="password"],.wpcf7-form input[type="email"],.wpcf7-form input[type="text"],.wpcf7-form textarea').not('.wpcf7-submit').addClass('pirenko_highlighted');
		jQuery('.mc_form_inside').addClass('clearfix');
		jQuery('.mc_signup_submit').addClass('prk_minimal_button clearfix');
		jQuery('.mc_signup_submit').append('<div class="navicon-forward"></div>');
		jQuery('.mc_signup_submit input').addClass('pirenko_highlighted body_text_shadow default_color header_font prk_heavy');
		jQuery('.wpcf7-submit').parent().addClass('prk_minimal_button');
		//jQuery('#mc_display_rewards a').addClass('not_zero_color');
		
		//FORM INPUTS FUNCTIONS
		jQuery('.pirenko_highlighted,.pk_contact_highlighted').focus(function (){
			jQuery(this).css({'outline': 'none','border':'1px solid '+theme_options.inactive_color+''});
		});

		//CAROUSELS
		jQuery(".prk_rousel").each( function () {
			var $this_fred=jQuery(this);
			var imgs_w=$this_fred.find('img').width();
			//var imgs_h=jQuery(this).find('img').height();
			var img_load=imagesLoaded($this_fred);
			img_load.on('always', function() {
				$this_fred.carouFredSel({
				circular    : true,
				infinite    : true,
				responsive  : true,
				auto : {
					play: false,
					pauseOnHover:true,
					duration    : 1000
				},	//AUTOSTART
				swipe       : {
					onTouch     : true,
					onMouse     : true
				}, 
				items: {
					width:imgs_w,
					visible: {
						min : 2,
						max : 6
					}
				},
				onCreate:function(){
					setTimeout(function(){ jQuery(window).trigger("debouncedresize");},150);
				}
			});
			});
		});

		//FORCE TEXTFIELDS BLUR
		jQuery('.pirenko_highlighted,.pk_contact_highlighted').blur(function() {
			jQuery(this).css({'border':'','outline':'none'});
		});

		//SHORTCODES MANAGEMENT
		jQuery('.wpb_row').each(function() {
			if (jQuery(this).find('.prk_price_table').length && !jQuery(this).find('.wpb_row .prk_price_table').length) {
				jQuery(this).children('.centered').addClass('columns tables_father');
			}
		});
		jQuery('.prk_progress_bar').each(function() {
			if( !jQuery(this).hasClass('prk_already_anim') && isScrolledIntoView(jQuery(this))) {
				jQuery(this).addClass('prk_already_anim');
				jQuery(this).children('.active_bar').each(function() {
					jQuery(this).width('50');
					jQuery(this).transition({'width': jQuery(this).attr('data-width')+'%'}, 1400);
				});
			}
		});
		jQuery(".recentposts_ul_shortcode").each( function () {
			var classy=textize(Math.floor(12/jQuery(this).attr('data-columns')));
			jQuery(this).children('li').each(function() {
				if (!jQuery(this).hasClass('clearfix')) {
					jQuery(this).addClass('columns '+classy);
				} 
			});
		});
		//SIDEBAR STUFF
		jQuery('.tagcloud a').live('mouseover', function() {
			if (is_mobile()===false) {
				if (jQuery(this).attr('data-color')!==undefined) {
					jQuery(this).stop().animate({'color': jQuery(this).attr('data-color')}, 200 );
				}
				else {
					jQuery(this).stop().animate({'color': theme_options.active_color}, 200 );
				}
			}
		});
		jQuery('.tagcloud a').live( 'mouseout', function() {
			jQuery(this).stop().animate({'color': theme_options.inactive_color}, 200 );
		});
		jQuery('#sidebar a').not('.tagcloud a,a.button').addClass('zero_color');
		if (jQuery('#blog_entries_masonr').length) {
			jQuery('#blog_entries_masonr').css({'opacity':0});
			jQuery('#blog_entries_masonr .blog_entry_li').css({'padding':jQuery('#blog_entries_masonr').attr('data-margin')+'px'});
			jQuery('#entries_navigation_blog').css({'margin-left':parseInt(jQuery('#blog_entries_masonr').attr('data-margin'),10)*2+'px'});
			jQuery('#wrap').css({'max-width':'none'});
		}
		else {
			jQuery('#wrap').css({'max-width':''});
			jQuery('#prk_ajax_container').css({'padding-left':'','padding-right':''});
		}
		if (jQuery('#classic_blog_section').length) {
			jQuery('#classic_blog_section').css({'opacity':0});
		}

		//VARIOUS THEME FUNCTIONS
		thumbs_roll();
		update_colors();
		init_sliders();
		init_blog();
		calculate_filters();
		init_portfolio();
		init_member();
		prk_init_sharrre();

		//FADE IN CONTENT
		jQuery('.video-container,.soundcloud-container').css({opacity:1});
		jQuery('.footer').css({'visibility':'visible'});
		jQuery('#main_block').css({'visibility':'visible','opacity':'0'});
		jQuery('#main_block,.prk_rv').transition({
			delay:100,
			opacity:1,
			duration:400,
			easing:'linear' 
		});
		var img_load=imagesLoaded('#prk_ajax_container');
		img_load.on('always', function() {
			jQuery(window).trigger("debouncedresize");
			pirenko_resize();
		});
		setTimeout(function(){ update_left_bar();},5);
		first_load=false;
		loading_page=false;
	}//ENDED LOADING

	if (!astro_on_mobile) {
		var astro_skrollr = skrollr.init({forceHeight:false});
		jQuery(window).trigger("debouncedresize");
	}

	var helper = jQuery('#height_helper');
	var offset_helper = helper.position();
	var half_helper="";
	var offset_half_helper="";
	var bk_ratio=1;
	var height_fix;
	//DELAYED RESIZE LISTENTER
	jQuery(window).on("debouncedresize", function() {
		jQuery("body,#project_info").css({'min-height':height_fix});
		jQuery('#single_slider.limited_height').css({'height':'','max-height':jQuery(window).height()-130});
		jQuery('#single_slider.limited_height img').css({'max-height':jQuery(window).height()-130});
		jQuery('#single_slider.limited_height').css({'height':jQuery('#single_slider .flex-active-slide').height()});
		jQuery('.opened_menu').css({'padding-top':height_fix/2-parseInt(jQuery('.opened_menu').attr('data-size'),10)-7});
		jQuery("#menu_section").height(height_fix);
		offset_helper = helper.position();
		if (parseInt(height_fix-20-offset_helper.top-jQuery('.footer').height(),10)>0) {
			jQuery('.opened_menu').removeClass('glued');
			jQuery('.footer').css({'top':parseInt(height_fix-jQuery('.footer').height(),10),'position':'absolute'});
		}
		else {
			//MOVE THE MENU UP
			jQuery('.opened_menu').css({'padding-top':0});
			jQuery('.opened_menu').addClass('glued');
			offset_helper = helper.position();
			if (parseInt(height_fix-20-offset_helper.top-jQuery('.footer').height(),10)>0) {
				jQuery('.footer').css({'top':parseInt(height_fix-jQuery('.footer').height(),10),'position':'absolute'});
			}
			else {
				jQuery('.footer').css({'top':-5,'position':'relative'});
			}
		}
		jQuery("#menu_section").mCustomScrollbar("update");
		if (jQuery('#blog_masonry_father').length) {
			jQuery('#blog_masonry_father').css({'min-height':height_fix});
			jQuery('#entries_navigation_mason').css({'width':jQuery('#blog_masonry_father').width()});
		}
		if (jQuery('#single_portfolio_half').length) {
			half_helper = jQuery('#half_helper');
			offset_half_helper = half_helper.position();
			jQuery('#single_portfolio_half').css({'min-height':parseInt(offset_half_helper.top,10)});
		}
		if (jQuery('#prk_full_size_single').length) {
			half_helper = jQuery('#half_helper');
			offset_half_helper = half_helper.position();
			jQuery('#prk_full_size_single').css({'min-height':parseInt(offset_half_helper.top,10)});
		}
		if (jQuery('#member_full_row').length) {
			//half_helper = jQuery('#half_helper');
			//offset_half_helper = half_helper.position();
			//jQuery('#member_full_row').css({'min-height':parseInt(offset_half_helper.top,10+20)});
		}
		if (jQuery('#sidebar').length && jQuery('#half_helper').length) {
			half_helper = jQuery('#half_helper');
			offset_half_helper = half_helper.position();
			jQuery('#main').css({'min-height':parseInt(offset_half_helper.top,10)+20});
		}
		if (jQuery('#contact_lower').length) {
			half_helper = jQuery('#half_helper');
			offset_half_helper = half_helper.position();
			jQuery('#contact_lower').css({'min-height':parseInt(offset_half_helper.top,10)});
		}
		jQuery('.astro_iso_gallery.ignited').each(function() {
			jQuery(this).isotope('layout');
		});
		if (jQuery('#blog_entries_masonr.isotope').length) {
			rearrange_layout();
		}
		if (!astro_on_mobile) {
			astro_skrollr.refresh();
		}
	});
	//RESIZE LISTENER
	function pirenko_resize() {
		if (jQuery.browser.msie  && parseInt(jQuery.browser.version, 10) === 8) {
			height_fix = jQuery(window).height();
		}
		else {
			height_fix = window.innerHeight ? window.innerHeight : jQuery(window).height();
		}
		jQuery('.centerized_father').height(height_fix);
		//scrollbar_width = window.innerWidth - jQuery("body").width();
		if (jQuery(window).width()<(768 - scrollbar_width)) {
			jQuery('#prk_responsive_menu,#menu_section,#left_bar_wrapper,#wrap').addClass('at_top');
			jQuery('.wpb_call_to_action.cta_align_right .wpb_button_a,.wpb_call_to_action.cta_align_left .wpb_button_a,.wpb_call_to_action.cta_align_right .theme_button,.wpb_call_to_action.cta_align_right .theme_button_inverted,.wpb_call_to_action.cta_align_left .theme_button,.wpb_call_to_action.cta_align_left .theme_button_inverted').each(function() {
				jQuery(this).css({'top':'16px'});
			});
			height_fix=height_fix-jQuery('#prk_responsive_menu').height();
			jQuery("#astro_featured_header").height(jQuery(window).width()/1.6);
			jQuery("#google-maps.fullscreen").width(jQuery(window).width());
		}
		else {
			jQuery('#prk_responsive_menu,#menu_section,#left_bar_wrapper,#wrap').removeClass('at_top');
			jQuery('.wpb_call_to_action.cta_align_right .wpb_button_a,.wpb_call_to_action.cta_align_left .wpb_button_a,.wpb_call_to_action.cta_align_right .theme_button,.wpb_call_to_action.cta_align_right .theme_button_inverted,.wpb_call_to_action.cta_align_left .theme_button,.wpb_call_to_action.cta_align_left .theme_button_inverted').each(function() {
				jQuery(this).css({'top':(jQuery(this).parent().parent().height()-jQuery(this).height())/2});
			});
			jQuery("#astro_featured_header").height(height_fix);
			jQuery("#google-maps.fullscreen").width(jQuery(window).width()-theme_options.logo_bar_width);
		}
		jQuery("#prj_ttl").width(height_fix);
		jQuery("#prj_ttl,#google-maps.fullscreen").height(height_fix);
		jQuery("#contact_info").css({'min-height':height_fix});
		jQuery("#google-maps.classic").height(jQuery("#google-maps").attr('data-map_height'));
		if (jQuery('#folio_father').length && showing_ajax_page===false && !jQuery('#folio_father.has_carousel').length) {
			jQuery('#folio_father').css({'min-height':height_fix+1});
			jQuery('#next_portfolio_titled,#next_portfolio_masonry,#no_more').css({'max-width':jQuery('#folio_father').width()});
		}
		if (jQuery('#folio_father.has_carousel').length && showing_ajax_page===false) {
			jQuery('#folio_father,#folio_carousel').css({'min-height':height_fix});
			//NO WHITE GAP ON THE RIGHT SIDE
			if (jQuery('#menu_section.at_top').length) {
				jQuery('#folio_father.has_carousel').css({'width':jQuery(window).width()+40});
			}
			else {
				if (!jQuery('body').hasClass('always_menu')) {
					jQuery('#folio_father.has_carousel').css({'width':jQuery(window).width()-jQuery('#prk_responsive_menu').width()+54});
				}
				else {
					jQuery('#folio_father.has_carousel').css({'width':jQuery(window).width()-jQuery('#prk_responsive_menu').width()-jQuery('#st-container').width()+54});
				}
			}
		}
		if (jQuery.browser.msie) {
			scrollbar_width=scrollbar_width+1;
		}
		jQuery('.prk_ferro_wrap iframe').css("height", height_fix+1);
		if (jQuery('#contact-image-fth.fullscreen #contact-image-cover').length){
        	var dth=jQuery(window).width()-parseInt(jQuery('#contact-image-cover').css('margin-left'),10);
			var ght=parseInt(jQuery("#contact-image-cover").attr('data-or_h')*dth/jQuery("#contact-image-cover").attr('data-or_w'),10);
			if (ght<height_fix) {

				ght=height_fix;
				dth=ght*jQuery("#contact-image-cover").attr('data-or_w')/jQuery("#contact-image-cover").attr('data-or_h');
			}
			jQuery("#contact-image-cover").css({'width':dth,'height':ght,'left':-(dth-(jQuery(window).width()-parseInt(jQuery('#contact-image-cover').css('margin-left'),10)))/2,'top':-(ght-height_fix)/2});
		
    	}
	}
	pirenko_resize();
	jQuery(window).resize(function() {
		pirenko_resize();
	});
	//THESE FUNCTIONS ARE EXECUTED ONLY ONCE

	//MENU FUNCTIONS
	//ADD ELEMENTS TO SUBMENUS
	jQuery('.sf-menu ul.sub-menu').each(function() {
		jQuery(this).addClass('clearfix');
		if (nav_on_right===true) {
			jQuery(this).parent().children('a').prepend('<div class="prk_btm_square icon-right-open-big"></div>');
		}
		else {
			jQuery(this).parent().children('a').prepend('<div class="prk_btm_square icon-left-open-big"></div>');
		}
		jQuery(this).append('<div class="submenu_header"><div class="naver_back">'+jQuery(this).parent().children('a').html()+'</div><div class="prk_close_submenu bd_headings_text_shadow fade_anchor_menu">'+jQuery('#menu_section').attr('data-close')+'<div class="navicon-play"></div></div></div><div class="prk_inner_tip"></div>');
		jQuery(this).children('.submenu_header').css({'top':-jQuery(this).children('.submenu_header').height()+1});
	});
	jQuery('.prk_close_submenu').click(function(e) {
		jQuery(this).parent().parent().removeClass('opened-sub');
		jQuery('#menu_section').removeClass('opened-sub');
	});
	if (isMobileOut()) {
		prk_sensi=false;
		prk_panel_event="click";
	}
	else
	{
		prk_sensi=true;
		prk_panel_event="hover";
	}
	//OPEN SUBMENU IF NEEDED
	jQuery('.pirenko_social').parent().addClass('zero_line_height');
	jQuery(window).trigger("debouncedresize");
	jQuery("#menu_section").mCustomScrollbar({
		scrollInertia:450,
		autoHideScrollbar:true,
		scrollButtons:{
			enable:false
		}
	});
	jQuery("#prj_naver_left,#prj_naver_right,#prj_naver_info").tooltipster({
		theme:'tooltipster-light .prk_bigger',
		touchDevices:false,
		position:'right',
		offsetY:4,
		offsetX:jQuery('#left_bar_wrapper').attr('data-offset_tip'),
	});
	jQuery('#prj_naver_left').tooltipster('update', jQuery('#prj_naver_left').attr('data-pir_title'));
	jQuery('#prj_naver_right').tooltipster('update', jQuery('#prj_naver_right').attr('data-pir_title'));
	jQuery('#prj_naver_info').tooltipster('update', jQuery('#prj_naver_info').attr('data-pir_title'));
	jQuery('#main_block').css({'opacity':'0'});
	jQuery('#prk_ajax_container').css({'display':'block','visibility':'visible'});
	ended_loading();
}
//ANIMATED PANELS FUNCTIONS
var menu_is_open=false;
var info_is_open=false;
var contact_is_open=false;
var container_menu;
var buttons;
var eventtype;
var mn_width=jQuery('#st-container').attr('data-width');
if (jQuery('body').hasClass('astro_nav_right')) {
	var nav_on_right=true;
}
else {
	var nav_on_right=false;
}
function prk_toggle_contact_info() {
	if (contact_is_open===false) {
		contact_is_open=true;
		jQuery('.main_no_sections').css({'z-index':9910});
		jQuery('#contact_info').css({'display':'block'});
		if (nav_on_right===true) {
			jQuery('#contact_info').css({'display':'block'});
			setTimeout(function() {
				jQuery('#contact_info').addClass('opened_contact');
			},10); 
		}
		else {
			jQuery('#contact_info').stop().delay(100).animate({
				'margin-left':0
			},
			{
				easing:'easeOutQuint',
				duration:500
			});
		}
		jQuery('#body_hider').css({'visibility':'visible','opacity':0});
		jQuery('#body_hider').stop().animate({
			opacity:0.75
		},
		{
			easing:'easeOutQuint',
			duration:500,
			complete:function() {
				document.addEventListener( eventtype, click_on_body );
			}
		});
	}
	else {
		contact_is_open=false;
		if (nav_on_right===true) {
			jQuery('#contact_info').removeClass('opened_contact');
		}
		else {
			jQuery('#contact_info').stop().animate({
				'margin-left':-580
			},
			{
				easing:'easeOutQuint',
				duration:500
			});
		}
		jQuery('#body_hider').stop().animate({
			opacity:0.01
		},
		{
			easing:'easeOutQuint',
			duration:500,
			complete:function()
			{
				jQuery('#contact_info').css({'display':'none'});
				jQuery('#body_hider').css({'visibility':'hidden'});
				document.removeEventListener( eventtype, click_on_body );
			}
		});
	}
}
function prk_close_contact() {
	contact_is_open=false;
	if (nav_on_right===true) {
		jQuery('#contact_info').stop().animate({
			'margin-right':0
		},
		{
			easing:'easeOutQuint',
			duration:500,
			complete:function()
			{
				jQuery('#contact_info').css({'display':'none'});
			}
		});
	}
	else {
		jQuery('#contact_info').stop().animate({
			'margin-left':-580
		},
		{
			easing:'easeOutQuint',
			duration:500,
			complete:function()
			{
				jQuery('#contact_info').css({'display':'none'});
			}
		});
	}
	
}
function prk_toggle_info() {
	if (info_is_open===false) {
		info_is_open=true;
		jQuery('#prj_naver_info').tooltipster('hide');
		setTimeout(function() { 
			jQuery('#prj_naver_info').tooltipster('update', jQuery('#prj_naver_info').attr('data-pir_close'))
		},300); 
		jQuery('#project_info').css({'display':'block'});
		if (nav_on_right===true) {
			jQuery('#project_info').stop().animate({
				right:theme_options.logo_bar_width
			},
			{
				easing:'easeOutQuint',
				duration:500
			});
		}
		else {
			jQuery('#project_info').stop().animate({
				left:theme_options.logo_bar_width
			},
			{
				easing:'easeOutQuint',
				duration:500
			});
		}
		jQuery('#body_hider').css({'visibility':'visible','opacity':0});
		jQuery('#body_hider').stop().animate({
			opacity:0.75
		},
		{
			easing:'easeOutQuint',
			duration:500,
			complete:function() {
				document.addEventListener( eventtype, click_on_body );
			}
		});
	}
	else {
		info_is_open=false;
		jQuery('#prj_naver_info').tooltipster('hide');
		setTimeout(function(){ 
			jQuery('#prj_naver_info').tooltipster('update', jQuery('#prj_naver_info').attr('data-pir_title'))
		},300);
		if (nav_on_right===true) {
			jQuery('#project_info').stop().animate({
				right:-356
			},
			{
				easing:'easeOutQuint',
				duration:500
			});
		}
		else {
			jQuery('#project_info').stop().animate({
				left:-356
			},
			{
				easing:'easeOutQuint',
				duration:500
			});
		}
		jQuery('#body_hider').stop().animate({
			opacity:0.01
		},
		{
			easing:'easeOutQuint',
			duration:500,
			complete:function()
			{
				jQuery('#project_info').css({'display':'none'});
				jQuery('#body_hider').css({'visibility':'hidden'});
				document.removeEventListener( eventtype, click_on_body );
			}
		});
	}
}
function prk_toggle_menu() {
	"use strict";
	if (menu_is_open===false || menu_is_open==="middle") {
		prk_close_contact();
		menu_is_open=true;
		jQuery('#prk_responsive_menu').addClass('prk_opened');
		jQuery('body').addClass('showing_main_menu');
		jQuery('#nav-collapsed-icon').removeClass('hover_trigger');
		if (nav_on_right===true) {
			jQuery('#prk_responsive_menu').stop().animate({
				right:mn_width,
			},
			{
				easing:'easeOutQuint',
				duration:500
			});
			jQuery('#st-container').stop().animate({
				'width':mn_width
			},
			{
				easing:'easeOutQuint',
				duration:500
			});
		}
		else {
			jQuery('#prk_responsive_menu').stop().animate({
				left:mn_width,
			},
			{
				easing:'easeOutQuint',
				duration:500
			});
			jQuery('#st-container').stop().animate({
				'width':mn_width
			},
			{
				easing:'easeOutQuint',
				duration:500
			});
		}
		
		jQuery('#body_hider').css({'visibility':'visible','opacity':0});
		jQuery('#body_hider').stop().animate({
			opacity:0.75
		},
		{
			easing:'easeOutQuint',
			duration:500,
			complete:function() {
				jQuery('#st-container').css({'overflow':'visible'});
				document.addEventListener( eventtype, click_on_body );
			}
		});
	}
	else {
		menu_is_open=false;
		jQuery('#prk_responsive_menu').removeClass('prk_opened');
		jQuery('body').removeClass('showing_main_menu');
		jQuery('#nav-collapsed-icon').removeClass('hover_trigger');
		jQuery('#st-container').css({'overflow':'hidden'});
		if (nav_on_right===true) {
			jQuery('#prk_responsive_menu').stop().animate({
				right:0
			},
			{
				easing:'easeOutQuint',
				duration:500
			});
		}
		else {
			jQuery('#prk_responsive_menu').stop().animate({
				left:0
			},
			{
				easing:'easeOutQuint',
				duration:500
			});
		}
		
		jQuery('#st-container').stop().animate({
			'width':0
		},
		{
			easing:'easeOutQuint',
			duration:500
		});
		jQuery('#body_hider').stop().animate({
			opacity:0.01
		},
		{
			easing:'easeOutQuint',
			duration:500,
			complete:function()
			{
				jQuery('#prk_ajax_container').css({'position':''});
				jQuery('#body_hider').css({'visibility':'hidden'});
				//AUTO-CLOSE SUBMENUS?
				//jQuery('#menu_section.opened-sub,#nav-main .sub-menu.opened-sub').removeClass('opened-sub');
				document.removeEventListener( eventtype, click_on_body );
			}
		});
	}
	jQuery('#nav-collapsed-icon .prk_menu_block').stop().animate({'background-color':theme_options.color_header}, 250);
}


// http://coveroverflow.com/a/11381730/989439
function is_mobile() {
	"use strict";
	var check = false;
	(function(a){if(/(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))){check = true;}})(navigator.userAgent||navigator.vendor||window.opera);
	return check;
}
function isAppleDevice(){
    return (
        (navigator.userAgent.toLowerCase().indexOf("ipad") > -1) ||
        (navigator.userAgent.toLowerCase().indexOf("iphone") > -1) ||
        (navigator.userAgent.toLowerCase().indexOf("ipod") > -1)
    );
}
function reset_menu() {
	"use strict";
	classie.remove( container_menu, 'st-menu-open' );
	menu_is_open=false;
}
function hasParentClass( e, classname ) {
	"use strict";
	if(e === document){ 
		return false;
	}
	if( classie.has( e, classname ) ) {
		return true;
	}
	return e.parentNode && hasParentClass( e.parentNode, classname );
}
click_on_body = function(evt) {
	"use strict";
	if (evt==='close_flag' || hasParentClass(evt.target,'hider_flag')) {
		if(menu_is_open===true)   {
			prk_toggle_menu();
		}
		if(info_is_open===true)   {
			prk_toggle_info();
		}
		if(contact_is_open===true)   {
			prk_toggle_contact_info();
		}
	}
};
function init_sidebar() {
	"use strict";
	container_menu = document.getElementById( 'st-container' );
		buttons = Array.prototype.slice.call( document.querySelectorAll('#nav-collapsed-icon')),
		eventtype = isAppleDevice() ? 'click' : 'click',

	buttons.forEach( function( el, i ) {
		var effect = el.getAttribute( 'data-effect' );
		el.addEventListener( eventtype, function( ev ) {
			prk_toggle_menu();
		});
	});
	jQuery('#menu_hover_trigger').hover(function() {
		if(menu_is_open===false || menu_is_open==="middle") {
			menu_is_open="middle";
			jQuery('body').addClass('showing_main_menu');
			prk_toggle_menu();
		}
	});
}
function iOSversion() {
	"use strict";
  if (/iP(hone|od|ad)/.test(navigator.platform)) {
    // supports iOS 2.0 and later: <http://bit.ly/TJjs1V>
    var v = (navigator.appVersion).match(/OS (\d+)_(\d+)_?(\d+)?/);
    return [parseInt(v[1], 10), parseInt(v[2], 10), parseInt(v[3] || 0, 10)];
  }
 
}
jQuery(window).bind("pageshow", function(event) {
	"use strict";
    if (event.originalEvent.persisted) {
        window.location.reload();
    }
});
jQuery(document).ready(function() {
	"use strict";
	//FORCE NO 3D EFFECT ON CERTAIN DEVICES
	var prk_version = iOSversion();
	if (prk_version!== undefined && prk_version[0] <= 6) {
	  jQuery('html').removeClass('csstransforms3d');
	  jQuery('html').addClass('no-csstransforms3d');
	}
	if (jQuery.browser.chrome) {
		jQuery('html').addClass('astro_chrome');
	}
	else {
		var nua = navigator.userAgent;
		if (((nua.indexOf('Mozilla/5.0') > -1 && nua.indexOf('Android ') > -1 && nua.indexOf('AppleWebKit') > -1))) {
			jQuery('html').addClass('astro_android');
		}
		else {
			var msie = nua.indexOf('MSIE ');
		    var trident = nua.indexOf('Trident/');
		    if (msie > 0 || trident > 0) {
		        jQuery('html').addClass('astro_ie');
		    }
		    else {
		    	if (jQuery.browser.safari) {
					jQuery('html').addClass('astro_safari');
				} 
		    }
		}
	}
	if (jQuery('.astro_landing_page').length) {
		jQuery('body').addClass('astro_landing_page');
	}
	jQuery('.opened_menu').attr('data-size',jQuery('.opened_menu').height()/2);
	if (jQuery('#astro_full_back').length) {
		jQuery('#astro_full_back').css({'background-image':'url('+jQuery('#astro_full_back').attr('data-image')+')'});
	}
	NProgress.configure({ minimum: 0.3, trickleRate: 0.08, trickleSpeed: 400  });
	NProgress.start();
	jQuery("#wrap").delay(100).animate({
		opacity:1
		}, 
		{
			easing:'linear',
			duration:250
		}
	);
	//CALL MAIN JSCRIPT FUNCTION
	if (make_session!==true) {
		astro_init();
		init_sidebar();
	}
});
/*jshint ignore: end */