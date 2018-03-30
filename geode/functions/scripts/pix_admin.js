jQuery.noConflict();

/*! Copyright 2012, Ben Lin (http://dreamerslab.com/)
 * Licensed under the MIT License (LICENSE.txt).
 *
 * Version: 1.0.14
 *
 * Requires: jQuery 1.2.3 ~ 1.9.0
 */
;(function(e){e.fn.extend({actual:function(t,n){if(!this[t]){throw'$.actual => The jQuery method "'+t+'" you called does not exist'}var r={absolute:false,clone:false,includeMargin:false};var i=e.extend(r,n);var s=this.eq(0);var o,u;if(i.clone===true){o=function(){var e="position: absolute !important; top: -1000 !important; ";s=s.clone().attr("style",e).appendTo("body")};u=function(){s.remove()}}else{var a=[];var f="";var l;o=function(){if(e.fn.jquery>="1.8.0")l=s.parents().addBack().filter(":hidden");else l=s.parents().andSelf().filter(":hidden");f+="visibility: hidden !important; display: block !important; ";if(i.absolute===true)f+="position: absolute !important; ";l.each(function(){var t=e(this);a.push(t.attr("style"));t.attr("style",f)})};u=function(){l.each(function(t){var n=e(this);var r=a[t];if(r===undefined){n.removeAttr("style")}else{n.attr("style",r)}})}}o();var c=/(outer)/g.test(t)?s[t](i.includeMargin):s[t]();u();return c}})})(jQuery);


/*!
	jQuery Autosize v1.16.15
	(c) 2013 Jack Moore - jacklmoore.com
	updated: 2013-06-07
	license: http://www.opensource.org/licenses/mit-license.php
*/
;(function(e){var t,o={className:"autosizejs",append:"",callback:!1,resizeDelay:10},i="hidden",n="border-box",s="lineHeight",a='<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>',r=["fontFamily","fontSize","fontWeight","fontStyle","letterSpacing","textTransform","wordSpacing","textIndent"],l="oninput",c="onpropertychange",h=e(a).data("autosize",!0)[0];h.style.lineHeight="99px","99px"===e(h).css(s)&&r.push(s),h.style.lineHeight="",e.fn.autosize=function(s){return s=e.extend({},o,s||{}),h.parentNode!==document.body&&e(document.body).append(h),this.each(function(){function o(){if(t=w,h.className=s.className,p=parseInt(f.css("maxHeight"),10),e.each(r,function(e,t){h.style[t]=f.css(t)}),l in w){var o=w.style.width;w.style.width="0px",w.offsetWidth,w.style.width=o}}function a(){var e,n,a;t!==w&&o(),h.value=w.value+s.append,h.style.overflowY=w.style.overflowY,a=parseInt(w.style.height,10),h.style.width=Math.max(f.width(),0)+"px",h.scrollTop=0,h.scrollTop=9e4,e=h.scrollTop,p&&e>p?(e=p,n="scroll"):d>e&&(e=d),e+=b,w.style.overflowY=n||i,a!==e&&(w.style.height=e+"px",z&&s.callback.call(w,w))}var d,p,u,w=this,f=e(w),b=0,z=e.isFunction(s.callback);if(!f.data("autosize")){if((f.css("box-sizing")===n||f.css("-moz-box-sizing")===n||f.css("-webkit-box-sizing")===n)&&(b=f.outerHeight()-f.height()),d=Math.max(parseInt(f.css("minHeight"),10)-b||0,f.height()),u="none"===f.css("resize")||"vertical"===f.css("resize")?"none":"horizontal",f.css({overflow:i,overflowY:i,wordWrap:"break-word",resize:u}).data("autosize",!0),c in w?l in w?w[l]=w.onkeyup=a:w[c]=function(){"value"===event.propertyName&&a()}:w[l]=a,s.resizeDelay!==!1){var x,y=e(w).width();e(window).on("resize.autosize",function(){clearTimeout(x),x=setTimeout(function(){e(w).width()!==y&&a()},parseInt(s.resizeDelay,10))})}f.on("autosize",a),a()}})}})(window.jQuery||window.Zepto);

/*
 * jQuery resize event - v1.1 - 3/14/2010
 * http://benalman.com/projects/jquery-resize-plugin/
 * 
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */
;(function($,h,c){var a=$([]),e=$.resize=$.extend($.resize,{}),i,k="setTimeout",j="resize",d=j+"-special-event",b="delay",f="throttleWindow";e[b]=250;e[f]=true;$.event.special[j]={setup:function(){if(!e[f]&&this[k]){return false}var l=$(this);a=a.add(l);$.data(this,d,{w:l.width(),h:l.height()});if(a.length===1){g()}},teardown:function(){if(!e[f]&&this[k]){return false}var l=$(this);a=a.not(l);l.removeData(d);if(!a.length){clearTimeout(i)}},add:function(l){if(!e[f]&&this[k]){return false}var n;function m(s,o,p){var q=$(this),r=$.data(this,d);r.w=o!==c?o:q.width();r.h=p!==c?p:q.height();n.apply(this,arguments)}if($.isFunction(l)){n=l;return m}else{n=l.handler;l.handler=m}}};function g(){i=h[k](function(){a.each(function(){var n=$(this),m=n.width(),l=n.height(),o=$.data(this,d);if(m!==o.w||l!==o.h){n.trigger(j,[o.w=m,o.h=l])}});g()},e[b])}})(jQuery,this);

/********************************
*
*   Determine whether a color is dark or bright
*
********************************/
function geode_hex2rgb( hex ) {
	hex = (hex.substr(0,1)=="#") ? hex.substr(1) : hex;
	if (hex.length < 6) {
		hex = hex[0]+hex[0]+hex[1]+hex[1]+hex[2]+hex[2];
	}
	if (!isNaN(hex)) {
		return [parseInt(hex.substr(0,2), 16), parseInt(hex.substr(2,2), 16), parseInt(hex.substr(4,2), 16)];
	} else {
		return [255,255,255];
	}
}
function geode_checkDarkness( hex ) {
	var rgb = geode_hex2rgb( hex );
    var min, max, delta, h, s, l;
    var r = rgb[0], g = rgb[1], b = rgb[2];
    min = Math.min(r, Math.min(g, b));
    max = Math.max(r, Math.max(g, b));
    delta = max - min;
    l = (min + max) / 2;
    s = 0;
    if (l > 0 && l < 1) {
      s = delta / (l < 0.5 ? (2 * l) : (2 - 2 * l));
    }
    h = 0;
    if (delta > 0) {
      if (max == r && max != g) h += (g - b) / delta;
      if (max == g && max != b) h += (2 + (b - r) / delta);
      if (max == b && max != r) h += (4 + (r - g) / delta);
      h /= 6;
    }
    return l > (255/2);
}

/********************************
*
*   If an element if visible
*
********************************/
function isScrolledIntoCompleteView(elem, val) {
    var docViewTop = jQuery(window).scrollTop();
    var docViewBottom = docViewTop + jQuery(window).height();

    var elemTop = jQuery(elem).offset().top;
    var elemBottom = elemTop + jQuery(elem).actual('height') + val;

    return ( elemTop >= docViewTop && elemBottom <= docViewBottom);
}

/********************************
*
*   Select
*
********************************/
function getSelValue($selector){
	if (typeof $selector == 'undefined' || $selector === '') {
		$selector = jQuery('#pix_content_loaded');
	}
    jQuery('select', $selector).each(function(){
		jQuery(this).bind('change',function(){
			var tx = jQuery('option:selected',this).text();
			if ( !jQuery(this).parents('span').eq(0).find('.appended').length ) {
				jQuery(this).parents('span').eq(0).prepend('<span class="appended" />');
			}
			var elm = jQuery(this).siblings('.appended');
			jQuery(elm).text(tx);
	    }).triggerHandler('change');
	});
}

/********************************
*
*   Upload media
*
********************************/
function uploadImages(){
	jQuery('#pix_content_loaded .pix_upload.upload_image').each(function(){
		var t = jQuery(this),
			pix_media_frame,
			formlabel = 0;

		t.off('click', 'a, span.img_preview');
		t.on('click', 'a, span.img_preview', function( e ){
			e.preventDefault();
			var button = jQuery(this);

			if ( pix_media_frame ) {
				pix_media_frame.open();
			return;
			}

			pix_media_frame = wp.media.frames.pix_media_frame = wp.media({

				className: 'media-frame pix-media-frame',
				frame: 'post',
				multiple: false,
				library: {
					type: 'image'
				}
			});

			pix_media_frame.on('insert', function(){
				var media_attachments = pix_media_frame.state().get('selection').toJSON(),
					thumbSize = jQuery('.attachment-display-settings select.size option:selected').val(),
					thumbUrl;

				jQuery.each(media_attachments, function(index, el) {
					//console.log(JSON.stringify(media_attachments));
					var url = this.url,
						id = this.id,
						size = typeof thumbSize!=='undefined' ? thumbSize : '';

					if ( size !== '' ) {
						size = this.sizes[size];
						url = size.url;
					}

					if ( typeof this.sizes != 'undefined' && typeof this.sizes.thumbnail != 'undefined' ) {
						previewUrl = this.sizes.thumbnail.url;
					} else {
						previewUrl = url;
					}
					button.parents('.pix_upload').eq(0).find('input').val(url);
					button.parents('.pix_upload').eq(0).find('.img_preview').addClass('filled').css({
						backgroundImage: 'url('+previewUrl+')'
					});
				});
			});

			pix_media_frame.open();
			jQuery('.media-menu a').eq(1).hide();
			jQuery('.attachment-display-settings .setting').remove();
			jQuery('.media-toolbar-secondary').hide();
		});

		jQuery('#pix_content_loaded .img_preview').each(function(){
			var field = jQuery(this).siblings('input').val();
			if ( field!='' ) {
				jQuery(this).addClass('filled').css({
					backgroundImage: 'url('+field+')'
				});
			}
		});
	});
}

/********************************
*
*   Color pickers
*
********************************/
function init_farbtastic(){
	if(jQuery.isFunction(jQuery.fn.farbtastic)) {
		jQuery('.colorpicker').each(function(){
			jQuery(this).after('<div class="picker_close" />');
		});
		jQuery(document).off('click','.pix_color_picker .pix_button');
		jQuery(document).on('click','.pix_color_picker .pix_button',function(){
			var t = jQuery(this),
				inputPicker = t.parents('.pix_color_picker').eq(0).find('input[type=text]').trigger('pix_farb');
			t.siblings('.colorpicker, i').fadeIn(150);

			t.siblings('i').off('click');
			t.siblings('i').on('click',function() {
				t.siblings('.colorpicker, i').fadeOut(150);
			});
	
			return false;
		});

		jQuery('#pix_content_loaded .pix_color_picker').each(function() {
			var divPicker = jQuery(this).find('.colorpicker'),
				inputPicker = jQuery(this).find('input[type=text]');
			var txtColor = geode_checkDarkness(inputPicker.val()) ? '#000' : '#fff';
			inputPicker.css({backgroundColor:inputPicker.val(), color: txtColor});

			jQuery.farbtastic(divPicker, function(color){
				var txtColor = geode_checkDarkness(color) ? '#000' : '#fff';
				inputPicker.val(color).css({backgroundColor:color, color: txtColor});
			});
			inputPicker.on('keyup pix_farb',function(){
				var colorVal = inputPicker.val();
				jQuery.farbtastic(divPicker).setColor(colorVal);
				inputPicker.css({backgroundColor:colorVal});
			});
		});
	}
}


/********************************
*
*   Sliders
*
********************************/
function init_sliders() {
	if(jQuery.isFunction(jQuery.fn.slider)) {
		jQuery('.slider_div').each(function(){
			var t = jQuery(this);
			var value = jQuery('input',t).val();
			if(t.hasClass('milliseconds')){
				var mi = 0;
				var m = 50000;
				var s = 100;
			} else if(t.hasClass('milliseconds_2')){
				var mi = 0;
				var m = 5000;
				var s = 100;
			} else if(t.hasClass('opacity')){
				var mi = 0;
				var m = 1;
				var s = 0.05;
			} else if(t.hasClass('googlemap')){
				var mi = 1;
				var m = 19;
				var s = 1;
			} else if(t.hasClass('border')){
				var mi = 0;
				var m = 50;
				var s = 1;
			} else if(t.hasClass('em')){
				var mi = 0;
				var m = 8;
				var s = 0.001;
			} else if(t.hasClass('percent')){
				var mi = 0;
				var m = 100;
				var s = 1;
			} else if(t.hasClass('ratio')){
				var mi = 0;
				var m = 20;
				var s = 0.01;
			} else if(t.hasClass('layout')){
				var mi = 0;
				var m = 2000;
				var s = 1;
			} else {
				var mi = 0;
				var m = 200;
				var s = 1;
			}
			jQuery('.slider_cursor',t).slider({
				range: 'min',
				value: value,
				min: mi,
				max: m,
				step: s,
				slide: function( event, ui ) {
					jQuery('input',t).val( ui.value );
				},
				stop: function( event, ui ) {
					t.trigger('slided');
				}
			});
			jQuery('a',t).mousedown(function(event){
				t.addClass('active');
			});
			jQuery(document).mouseup(function(){
				t.removeClass('active');
			});
			jQuery('input',t).keyup(function(){
				var v = jQuery('input',t).val();
				jQuery('.slider_cursor',t).slider({
					range: 'min',
					value: v,
					min: 0,
					max: m,
					step: s,
					slide: function( event, ui ) {
						jQuery('input',t).val( ui.value );
					}
				});
				t.trigger('slided');
			});
			jQuery('.slider_cursor',t).each(function(){
				if ( jQuery('.ui-slider-range-min',this).length > 1 ) {
					jQuery('.ui-slider-range-min',this).not(':last').remove();
				}
			});
		});
	}
}

/********************************
*
*	Navsidebar menu
*
********************************/
function adminNav(){
	if(pagenow=='toplevel_page_admin_interface') {
		var newRequest;
		function pix_ajax_update() {
			var spinner = jQuery('#spinner2');
			jQuery('#pix_ap_header h2').append(spinner.animate({opacity:1},100));

			var geode_active_tab = localStorage.getItem("geode_active_tab"),
				geode_active_link = localStorage.getItem("geode_active_link");

			if(typeof geode_active_tab == 'undefined' || geode_active_tab == false || geode_active_tab == null) {
				geode_active_tab = 'register';
			}
			if(typeof geode_active_link == 'undefined' || geode_active_link == false || geode_active_link == null) {
				geode_active_link = 'register-theme';
			}

			var url = jQuery('#pix_ap_body li[data-store='+geode_active_link+'] a').attr('href');

			if(newRequest && newRequest.readyState != 4){
				newRequest.abort();
			}

			newRequest = jQuery.ajax({
				url: url,
				success: function(loadeddata){
					var height = jQuery('#pix_content_loaded').outerHeight();
					jQuery('#pix_content_loaded').outerHeight(height);

					jQuery('#pix_ap_body').find('li[data-store='+geode_active_tab+'], li[data-store='+geode_active_link+']').addClass('current');

					var html = jQuery("<div/>").append(loadeddata.replace(/<script(.|\s)*?\/script>/g, "")).find('#pix_content_loaded').html();
					jQuery('#pix_content_loaded').animate({opacity:0},0).html('<div class="cf">'+html+'</div>');
					var newH = jQuery('#pix_content_loaded > div').actual('outerHeight');
					jQuery('#pix_content_loaded').html(html);
						
					jQuery('#pix_content_loaded').animate({height:newH},800,'easeOutQuad',function(){
						spinner.animate({opacity:0},100,function(){
							jQuery('#spinner_wrap').prepend(spinner);
						});
						jQuery('#pix_content_loaded').css({height:'auto'});
						jQuery('#pix_content_loaded').animate({opacity:1},250);
						floatingSaveButton();
					});
					saveOptions();
					jQuery('textarea').each(function(){
						jQuery(this).autosize();
					});
					getSelValue();
					uploadImages();
					init_farbtastic();
					init_sliders();
					changelogButton();
					infoDialog();
					sortElems();
					navMenuFontIcon();
					removeSidebars();
					expandSections();
					selectGoogleFonts();
					fontFinder();
					refreshGoogleFonts();
					selectFontGroup();
					checkLicense();
					jQuery(':file').filestyle({classIcon: 'scicon-awesome-folder-open'});
					jQuery('#pix_content_loaded textarea.codemirror:visible').not('.done').each(function(){
						var txtArea = jQuery(this).addClass('done'),
							txtH = typeof txtArea.data('height') !== 'undefined' ? txtArea.data('height') : 180,
							editor = CodeMirror.fromTextArea(txtArea.get(0), {theme:'solarized light',mode:'css',lineNumbers:true,styleActiveLine:true,matchBrackets:true}).setSize('100%', txtH);
					});
					jQuery('#pix_content_loaded textarea.jsmirror:visible').not('.done').each(function(){
						var txtArea = jQuery(this).addClass('done'),
							txtH = typeof txtArea.data('height') !== 'undefined' ? txtArea.data('height') : 180,
							editor = CodeMirror.fromTextArea(txtArea.get(0), {theme:'solarized light',mode:'javascript',lineNumbers:true,styleActiveLine:true,matchBrackets:true}).setSize('100%', txtH);
					});
				},
				error: function(){
					/*geode_active_tab = 'general_head';
					geode_active_link = 'admin_panel';*/
				}
			});
		};
	
		pix_ajax_update();

		jQuery('nav#pix_ap_main_nav > ul > li').not('.current').each(function(){

			var li = jQuery(this);

				jQuery('> a, > ul', li).hover(function(){
					if ( !li.hasClass('current') ) {
						li.addClass('hover');
						jQuery('nav#pix_ap_main_nav li.current').removeClass('current').addClass('fake-current');
					}
				},function(){
					li.removeClass('hover');
					jQuery('nav#pix_ap_main_nav li.fake-current').removeClass('fake-current').addClass('current');
				});

			jQuery('> a', li).bind('click',function(){
				jQuery('> ul > li > a:first', li).click();
				return false;
			});
		});

		jQuery('nav#pix_ap_main_nav > ul > li li').not('.current').each(function(){

			var li = jQuery(this);

			jQuery('> a', li).bind('click',function(){
				var t = jQuery(this);

				jQuery('nav#pix_ap_main_nav > ul li').removeClass('current').removeClass('fake-current');
				li.parents('li').eq(0).addClass('current');
				li.addClass('current');

				if ( jQuery('nav#pix_ap_main_nav > ul li.hover').length ) {
					var tab = jQuery('nav#pix_ap_main_nav > ul li.hover').attr('data-store');
					if (Modernizr.localstorage) {
						localStorage.setItem("geode_active_tab", tab);
					}
				}

				var link = li.attr('data-store');
				if (Modernizr.localstorage) {
					localStorage.setItem("geode_active_link", link);
				}
				pix_ajax_update();
				return false;
			});
		});

		/*Height of the ULs*/
		jQuery('nav#pix_ap_main_nav > ul > li ul').each(function(){
			var h = jQuery(this).actual('outerHeight'),
				wrapH = jQuery(this).parents('ul').eq(0).actual('outerHeight');

			if ( h < wrapH ) {
				jQuery(this).outerHeight(wrapH);
			}
		});
	}
}

/********************************
*
*	Show option
*
********************************/
function floatingSaveButton(){
	jQuery(window).bind('scroll resize',function(){
		jQuery('#pix_content_loaded .pix-save-options.fake_button2').each(function(){
			var t = jQuery(this),
				l = jQuery(window).width()-(t.offset().left+t.outerWidth()),
				cont = jQuery('#pix_content_loaded'),
				lCont = cont.offset().left,
				wCont = cont.outerWidth();
			jQuery('#pix_content_loaded #gradient-save-button').css({
				left: lCont,
				width: wCont
			});
			if (isScrolledIntoCompleteView(this, 20))	{
				jQuery('#pix_content_loaded .pix-save-options').not('.fake_button').not('.fake_button2').removeClass('fixed').css({
					right: 20
				});
				jQuery('#pix_content_loaded #gradient-save-button').fadeOut(150);
			} else {
				jQuery('#pix_content_loaded .pix-save-options').not('.fake_button').not('.fake_button2').addClass('fixed').css({
					right: l
				});
				jQuery('#pix_content_loaded #gradient-save-button').fadeIn(150);
			}
		});
	}).triggerHandler('scroll');
}

/********************************
*
*	Save options
*
********************************/
function saveOptions(){
	jQuery(document).off('submit','form.ajax_form');
	jQuery(document).on('submit','form.ajax_form',function() {
		var spinner = jQuery('#spinner');
		jQuery(this).find('button[type="submit"]').append(spinner).animate({paddingLeft:40},150,function(){spinner.animate({opacity:1},100);});
		var data = jQuery(this).serialize(),
			cont = { action: 'css_compile_ajax', context: data };

		jQuery.post(ajaxurl, data).success(function(html) {
			jQuery.post(ajaxurl, cont).success(function(html){ 
				spinner.delay(500).animate({opacity:0},100,function(){
					jQuery('#spinner_wrap').append(spinner);
					jQuery('form.ajax_form button[type="submit"] i').fadeIn(100).delay(500).fadeOut(100,function(){
						jQuery('button[type="submit"].pix-save-options').animate({paddingLeft:15},150);
					});
				});
			});
		});
		return false;
	});
}

/********************************
*
*	Changelog button
*
********************************/
function changelogButton(){
	jQuery(document).off('click','.pix-iframe');
	jQuery(document).on('click','.pix-iframe',function() {
		var href = jQuery(this).attr('href'),
			title = jQuery(this).text(),
			h = jQuery(window).height(),
			div = jQuery('<div />');
		if ( href.match(/\.(jpg|png|gif)/i) ) {
			var spinner = jQuery('#spinner2');
			jQuery('#pix_ap_header h2').append(spinner.animate({opacity:1},100));
            jQuery('<img />').load( function(){
            	//alert(jQuery(this).get(0).naturalWidth);
				spinner.animate({opacity:0},100,function(){
					jQuery('#spinner_wrap').prepend(spinner);
				});
				div.append(jQuery(this)).dialog({
					height: jQuery(this).get(0).naturalHeight,
					width: jQuery(this).get(0).naturalWidth,
					modal: false,
					dialogClass: 'wp-dialog pix-dialog pix-dialog-info pix-dialog-iframe',
					position: { my: "center", at: "center", of: window },
					title: title,
					zIndex: 100,
					open: function(){
				        jQuery('body').addClass('overflowHidden');        
						jQuery('body').append('<div id="pix-modal-overlay" />');
					},
					close: function(){
						jQuery('#pix-modal-overlay').remove();
				        jQuery('body').removeClass('overflowHidden');     
				        div.remove();   
		    			jQuery(window).unbind('resize');  
					}
				});
				div.bind('resize',function() {
					div.dialog('option','position',{ my: "center", at: "center", of: window });
				}).triggerHandler('resize');
            }).attr('src', href).each(function() {
                if(this.complete) jQuery(this).load();
            });
        } else {
			div.append(jQuery("<iframe />").attr("src", href)).dialog({
				height: (h*0.8),
				width: '80%',
				modal: false,
				dialogClass: 'wp-dialog pix-dialog pix-dialog-info pix-dialog-iframe',
				position: { my: "center", at: "center", of: window },
				title: title,
				zIndex: 100,
				open: function(){
			        jQuery('body').addClass('overflowHidden');        
					jQuery('body').append('<div id="pix-modal-overlay" />');
				},
				close: function(){
					jQuery('#pix-modal-overlay').remove();
			        jQuery('body').removeClass('overflowHidden');     
			        div.remove();   
	    			jQuery(window).unbind('resize');  
				}
			});
			jQuery(window).bind('resize',function() {
				h = jQuery(window).height();
				div.dialog( 'option', {'height':(h*0.8)} );
			});
			div.bind('resize',function() {
				div.dialog('option','position',{ my: "center", at: "center", of: window });
			}).triggerHandler('resize');
		}
		return false;
	});
}


/********************************
*
*	Dialog boxes for info
*
********************************/
function infoDialog(){
	jQuery(document).off('click','[data-dialog]')
	jQuery(document).on('click','[data-dialog]',function() {
		var html = jQuery(this).attr('data-dialog'),
			w = (typeof jQuery(this).attr('data-width') != 'undefined') ? jQuery(this).attr('data-width') : 400,
			title = jQuery(this).text(),
			div = jQuery('<div />').html(html);
		div.dialog({
		    show: {
		        duration: 500
		    },
		    hide: {
		        duration: 250
		    },
			height: 'auto',
			width: w,
			modal: false,
			dialogClass: 'wp-dialog pix-dialog pix-dialog-info',
			position: { my: "center", at: "center", of: window },
			title: title,
			zIndex: 50,
			open: function(){
		        jQuery('body').addClass('overflowHidden');        
				jQuery('body').append('<div id="pix-modal-overlay" />');
			},
			close: function(){
				jQuery('#pix-modal-overlay').remove();
		        jQuery('body').removeClass('overflowHidden');        
		        div.remove();   
			}
		});
		jQuery(window).bind('resize',function() {
			h = jQuery(window).height(),
			div.dialog('option',{'position':{ my: "center", at: "center", of: window }});
		});
		return false;
	});
}

/******************************************************
*
*	Sortable
*
******************************************************/
function sortElems(){
	jQuery('.pix-sorting').each(function(){ 
		var pixsorting = jQuery(this);
		pixsorting.sortable({ 
			items: 'div.pix-sorting-elem',
			placeholder: "pix-sorting-highlight",
			handle: '.move-element',
			tolerance: 'pointer',
			stop: function() {
	            pixsorting.find('> div').not('.clone').each(function(){
	            	var ind = jQuery(this).index();
	            	jQuery('[name]',this).each(function(){
						var attrb = jQuery(this).attr('name');
						attrb = attrb.replace(/_\[(.*?)\]\[/g, '_['+ ( ind - 1 ) +'][');
						jQuery(this).attr('name',attrb);
					});
	            });
	       },
			start: function(event,ui) {
				var uiH = ui.item.outerHeight();
				jQuery('.pix-sorting-highlight',this).css({height:(uiH)});
			}
		});

/* Add an element */
		pixsorting.off('click','.add-element');
		pixsorting.on('click','.add-element',function(){
			var clone = pixsorting.find('.clone').clone();
			clone.find('textarea').trigger('oninput');
			clone.fadeIn().removeClass('hidden').removeClass('clone');
			clone.find('[data-clone]').each(function(){
				var attrb = jQuery(this).attr('data-clone');
				jQuery(this).removeAttr('data-clone');
				attrb = attrb.replace(/\[i\]/g, '['+pixsorting.find('> div').not('.clone').length+']');
				jQuery(this).attr('name',attrb).trigger('oninput');
			});
			jQuery(this).before(clone);
			return false;
		});

/* Remove an element */
		pixsorting.off('click','.pix-sorting-elem .delete-element');
		pixsorting.on('click','.pix-sorting-elem .delete-element',function(){
			var el = jQuery(this).parents('.pix-sorting-elem').eq(0);
			el.animate({opacity:0,height:0,minHeight:0,paddingTop:0,paddingBottom:0,margin:0},400, 'easeOutQuad', function(){ 
				jQuery(this).remove();
	            pixsorting.find('> div').not('.clone').each(function(){
	            	var ind = jQuery(this).index();
	            	jQuery('[name]',this).each(function(){
						var attrb = jQuery(this).attr('name');
						attrb = attrb.replace(/_\[(.*?)\]\[/g, '_['+ ( ind - 1 ) +'][');
						jQuery(this).attr('name',attrb);
					});
	            });
	        });
			return false;
		});

/* Edit an element */
		pixsorting.off('click','.pix-sorting-elem .edit-element');
		pixsorting.on('click','.pix-sorting-elem .edit-element', function(){
			var t = jQuery(this),
				par = t.parents('.pix-sorting-elem').eq(0),
				div = jQuery('.dialog-edit-sorting-elements').clone(),
				h = jQuery(window).height(),
				w = (typeof jQuery(this).attr('data-width') != 'undefined') ? jQuery(this).attr('data-width') : 400,
				title = div.attr('data-title');
			div.dialog({
			    show: {
			        duration: 500
			    },
			    hide: {
			        duration: 250
			    },
				height: 'auto',
				maxHeight: (h*0.8),
				width: w,
				modal: false,
				dialogClass: 'wp-dialog pix-dialog pix-dialog-info pix-dialog-input',
				position: { my: "center", at: "center", of: window },
				title: title,
				zIndex: 50,
				open: function(){
			        jQuery('body').addClass('overflowHidden');        
					jQuery('body').append('<div id="pix-modal-overlay" />');
					jQuery(this).closest('.ui-dialog').find('.ui-button').eq(1).addClass('ui-dialog-titlebar-edit pix_button');

					div.find('[data-id]').each(function(){
						var dataId = jQuery(this).data('id');
						jQuery(this).attr('id',dataId);
					});


					par.find('[readOnly]').each(function(){
						var thisVal = jQuery(this).val();
						thisVal = thisVal.replace(/"/g, "'");
						if ( div.find('[data-name="'+jQuery(this).attr('data-name')+'"]').is(':checkbox') ) {
							if ( thisVal=='true' )
								div.find('[data-name="'+jQuery(this).attr('data-name')+'"]').prop('checked',true);
						} else {
							div.find('[data-name="'+jQuery(this).attr('data-name')+'"] option[value="'+thisVal+'"]').prop('selected',true).trigger('change');
							div.find('[data-name="'+jQuery(this).attr('data-name')+'"]').val(thisVal).trigger('keyup');							
						}
						if ( jQuery(this).attr('data-name')=='icon' ) {
							div.find('.icon-preview i').attr('class',thisVal);
						}							
					});

	/* Open icon selector */
					jQuery('.icon-preview, .icon-preview-edit',this).off('click');
					jQuery('.icon-preview, .icon-preview-edit',this).on('click',function(e){
						e.preventDefault();
						var dial = jQuery(this).parents('.ui-dialog').eq(0);
							dial.hide();
						var iconSel = jQuery('#shortcodelic_fonticons_generator').clone(),
							iconTitle = iconSel.attr('data-title'),
							searchTitle = iconSel.attr('data-search');

						iconSel.attr('id','shortcodelic_fonticons_generator_cloned').dialog({
							height: (h*0.8),
							width: '80%',
							modal: false,
							dialogClass: 'wp-dialog pix-dialog pix-dialog-info pix-dialog-input',
							position: { my: "center", at: "center", of: window },
							title: iconTitle,
							zIndex: 51,
							create: function(){
								jQuery(this).find('label').text(searchTitle);
								hideByTyping();
								getSelValue(jQuery('#shortcodelic_fonticons_generator_cloned'));
								selectFontSet();
								iconSel.off('click','.the-icons');
								iconSel.on('click','.the-icons',function(){
									var classIcon = jQuery('i',this).attr('class');
									dial.find('.icon-preview i').attr('class',classIcon);
									dial.find('[data-name="icon"]').val(classIcon);
									iconSel.dialog('close');
								});
							},
							close: function(){
								dial.show();
								iconSel.remove();
							}
						});
						iconSel.bind('resize',function() {
							h = jQuery(window).height(),
							iconSel.dialog('option',{'position':{ my: "center", at: "center", of: window },'height':(h*0.8)});
						});
					});

					jQuery('.icon-remove',this).off('click');
					jQuery('.icon-remove',this).on('click',function(e){
						e.preventDefault();
						var dial = jQuery(this).parents('.ui-dialog').eq(0);
						dial.find('.icon-preview i').attr('class','');
						dial.find('[data-name="icon"]').val('');
					});
					init_farbtastic();
					getSelValue(div);
				},
				buttons: {
					'': function() {
						jQuery(this).find('[data-name]').each(function(){
							if ( jQuery(this).is(':checkbox') ) {
								if ( jQuery(this).prop("checked") === true )
									par.find('[data-name="'+jQuery(this).attr('data-name')+'"]').val('true').prop('readOnly',false).trigger('oninput').prop('readOnly',true);
								else
									par.find('[data-name="'+jQuery(this).attr('data-name')+'"]').val('').prop('readOnly',false).trigger('oninput').prop('readOnly',true);
							} else {
								par.find('[data-name="'+jQuery(this).attr('data-name')+'"]').val(jQuery(this).val()).prop('readOnly',false).trigger('oninput').prop('readOnly',true);
							}
							par.find('[data-class="'+jQuery(this).attr('data-name')+'"]').attr('class',jQuery(this).val());
							par.find('[data-color="'+jQuery(this).attr('data-name')+'"]').css('background-color',jQuery(this).val());
						});
						jQuery(this).dialog('close');
					}
				},
				close: function(){
					jQuery('#pix-modal-overlay').remove();
					div.remove();
			        jQuery('body').removeClass('overflowHidden'); 
        			jQuery(window).unbind('resize');  
				}
			});
			jQuery(window).bind('resize',function() {
				h = jQuery(window).height();
				div.dialog( 'option', {'maxHeight':(h*0.8),'position':{ my: "center", at: "center", of: window }} );
			});
			div.bind('resize',function() {
				div.dialog('option','position',{ my: "center", at: "center", of: window });
			});
			return false;
		});
	});
}

/******************************************************
*
*	Font icon selector for nav menu
*
******************************************************/
function navMenuFontIcon(){
	jQuery('.load-icons').off('click','.icon-preview');
	jQuery('.load-icons').on('click','.icon-preview',function(e){
		e.preventDefault();
		var wrap = jQuery(this).parents('.load-icons').eq(0),
			iconSel = jQuery('#shortcodelic_fonticons_generator').clone(),
			iconTitle = iconSel.attr('data-title'),
			searchTitle = iconSel.attr('data-search'),
			h = jQuery(window).height();

		iconSel.attr('id','shortcodelic_fonticons_generator_cloned').dialog({
			height: (h*0.8),
			width: '80%',
			modal: false,
			dialogClass: 'wp-dialog pix-dialog pix-dialog-info pix-dialog-input',
			position: { my: "center", at: "center", of: window },
			title: iconTitle,
			zIndex: 51,
			create: function(){
				jQuery(this).find('label').text(searchTitle);
				hideByTyping();
				getSelValue(jQuery('#shortcodelic_fonticons_generator_cloned'));
				selectFontSet();
				iconSel.off('click','.the-icons');
				iconSel.on('click','.the-icons',function(){
					var classIcon = jQuery('i',this).attr('class');
					wrap.find('.icon-preview i').attr('class',classIcon);
					wrap.find('input[type="hidden"]').val(classIcon);
					iconSel.dialog('close');
				});
			},
			open: function(){
		        jQuery('body').addClass('overflowHidden');        
				jQuery('body').append('<div id="pix-modal-overlay" />');
			},
			close: function(){
				jQuery('#pix-modal-overlay').remove();
		        jQuery('body').removeClass('overflowHidden');        
				iconSel.remove();
			}
		});
		iconSel.bind('resize',function() {
			h = jQuery(window).height(),
			iconSel.dialog('option',{'position':{ my: "center", at: "center", of: window },'height':(h*0.8)});
		});
	});
}
/******************************************************
*
*	Find icon on the list
*
******************************************************/
function hideByTyping(){
	jQuery('#shortcodelic_fonticons_generator_cloned input[type="text"]').keyup(function(){
		var val = jQuery(this).val();
		if ( val != '' ) {
			jQuery('#shortcodelic_fonticons_generator_cloned .the-icons').not('[data-search*="'+val+'"]').hide();
			jQuery('#shortcodelic_fonticons_generator_cloned .the-icons[data-search*="'+val+'"]').show();
		} else {
			jQuery('#shortcodelic_fonticons_generator_cloned .the-icons').show();
		}
	});
}

/******************************************************
*
*	Find fonts from google list
*
******************************************************/
function fontFinder(){
	var set;
	jQuery('#pix_font_finder').keyup(function(){
		var t = jQuery(this);
		clearTimeout(set);
		set = setTimeout(function(){
			jQuery('.checkboxes_font').show();
			var val = t.val();
			if ( val != '' ) {
				jQuery('.checkboxes_font').not('[data-search*="'+val+'"]').hide();
				jQuery('.checkboxes_font [data-search*="'+val+'"]').show();
			}
			jQuery(window).trigger('resize');
		},500);
	});
}


/******************************************************
*
*	Remove the sidebars
*
******************************************************/
function removeSidebars(){
	jQuery(document).off('click','.pix_button[data-remove]');
	jQuery(document).on('click','.pix_button[data-remove]',function(){
		var par = jQuery(this).parents('.pix_sidebar_row').eq(0),
			ind = jQuery(this).attr('data-remove'),
			form = par.parents('form').eq(0);
			html = form.attr('data-alert'),
			w = (typeof form.attr('data-width') != 'undefined') ? form.attr('data-width') : 400,
			title = form.attr('data-title'),
			div = jQuery('<div />').html(html);
		div.dialog({
		    show: {
		        duration: 500
		    },
		    hide: {
		        duration: 250
		    },
			height: 'auto',
			width: w,
			modal: false,
			dialogClass: 'wp-dialog pix-dialog pix-dialog-info',
			position: { my: "center", at: "center", of: window },
			title: title,
			zIndex: 50,
			buttons: {
				"Yes, continue": function() {
					jQuery( this ).dialog( "close" );

					par.addClass('deleting').find('[type="hidden"]').remove();
					form.find('[name="sidebar_removed"]').val(ind);
					par.off('transitionend webkitTransitionEnd oTransitionEnd otransitionend');
					par.on('transitionend webkitTransitionEnd oTransitionEnd otransitionend', function() {
						form.submit();
					});
				},
				"No, cancel": function() {
					jQuery( this ).dialog( "close" );
				}
			},
			open: function(){
		        jQuery('body').addClass('overflowHidden');        
				jQuery('body').append('<div id="pix-modal-overlay" />');
			},
			close: function(){
				jQuery('#pix-modal-overlay').remove();
		        jQuery('body').removeClass('overflowHidden');        
		        div.remove();   
			}
		});
		jQuery(window).bind('resize',function() {
			h = jQuery(window).height(),
			div.dialog('option',{'position':{ my: "center", at: "center", of: window }});
		});
		return false;
	});
}

/********************************
*
*   Ajax loaders
*
********************************/
function ajaxLoaders($start){
	if ( $start===true ) {
		var spinclone = jQuery('#spinner2').clone().attr('id','spinnerclone');
		jQuery('.ui-dialog-content:visible > *').animate({ opacity : 0.25}, 250).parents('.ui-dialog-content').eq(0).append(spinclone.animate({opacity:1}, 250));
	} else {
		jQuery('.ui-dialog-content #spinnerclone').animate({opacity:0}, 250, function(){
			jQuery(this).remove();
		});
		jQuery('.ui-dialog-content > *').animate({ opacity : 1}, 250);
	}
}

/******************************************************
*
*	Select font set
*
******************************************************/
//function selectFontSet($tdial,$id,$textarea){
function selectFontSet(){
	jQuery('#shortcodelic_fonticons_generator_cloned .select_font_set').off('change');
	jQuery('#shortcodelic_fonticons_generator_cloned .select_font_set').on('change',function(){
		var val = jQuery('option:selected',this).val();
		ajaxLoaders(true);
		jQuery.ajax({
            url: pix_theme_dir + '/font/scicon-' + val + '.php',
            cache: false,
            success: function(loadeddata) {
				jQuery('#shortcodelic_fonticons_generator_cloned .shortcodelic_font_list_wrap input').val('');
				var html = jQuery("<div/>").append(loadeddata.replace(/<script(.|\s)*?\/script>/g, "")).html();
				jQuery('#shortcodelic_fonticons_generator_cloned .shortcodelic_font_list').html(html);
				hideByTyping();
				jQuery('#shortcodelic_fonticons_generator_cloned input[type="text"]').triggerHandler('keyup');
				//insertSCicons($tdial,$id,$textarea);
				ajaxLoaders();
            }
		});
	});
}

/********************************
*
*	Expand sections
*
********************************/
function expandSections(){
	jQuery(document).off('click', '.section_title');
	jQuery(document).on('click', '.section_title', function(){
		var t = jQuery(this).toggleClass('active'),
			next = t.next('.admin-section-toggle'),
			parent = t.parents('.pix_columns').eq(0);
		if ( t.hasClass('active') ) {
			next.slideDown(250,'easeOutQuad').animate({opacity:1},{queue:false,duration:250, easing:'easeOutQuad', complete:function(){
				jQuery(this).addClass('visible');
				jQuery('#pix_content_loaded textarea.codemirror:visible').not('.done').each(function(){
					var txtArea = jQuery(this).addClass('done'),
						editor = CodeMirror.fromTextArea(txtArea.get(0), {theme:'solarized light',mode:'text/css',lineNumbers:true,styleActiveLine:true,matchBrackets:true}).setSize('100%', 180);
				});
				jQuery(window).trigger('resize');
			}});
		} else {
			next.slideUp(250,'easeOutQuad').animate({opacity:0},{queue:false,duration:250, easing:'easeOutQuad', complete:function(){
				jQuery(this).removeClass('visible');
				jQuery(window).trigger('resize');
			}});
		}
	});
}

/********************************
*
*	Select fonts from list
*
********************************/
function selectGoogleFonts(){
	if ( typeof pix_google_enabled !== 'undefined' && pix_google_enabled=='true' ) {
		jQuery('.checkboxes_font').each(function(){
			var t = jQuery(this),
				check = t.find('input[type="checkbox"]');
			if ( check.prop("checked") === true ) {
				t.addClass('checked');
			} else {
				t.removeClass('checked');
			}
			t.off('click');
			t.on('click', function(e){
				e.preventDefault();
				check.prop("checked", !check.prop("checked"));
				if ( check.prop("checked") === true ) {
					t.addClass('checked');
				} else {
					t.removeClass('checked');
				}
			});
			t.off('click','a.preview_font_list');
			t.on('click','a.preview_font_list',function(e){
				e.preventDefault();
				e.stopPropagation();
				var t = jQuery(this).hide(),
					parent = t.parents('.checkboxes_font').eq(0),
					font = jQuery('.font_preview',parent).attr('data-font'),
					webfont = jQuery('.font_preview',parent).attr('data-webfont'),
					spinner = jQuery('#spinner2').addClass('dark');
				parent.append(spinner);
				spinner.animate({opacity:1},150,function(){
					WebFont.load({
						google: {
						families: [ webfont ]
						},
						active: function() { 
							jQuery('.font_preview', parent).css({fontFamily:font}); 
							parent.addClass('loaded');
							spinner.removeClass('dark').animate({opacity:0},100,function(){jQuery('#spinner_wrap').prepend(spinner);});
						}
					});
					
				});
			});
		});
	}
}

/********************************
*
*	Refresh the font list
*
********************************/
function refreshGoogleFonts(){
	jQuery(document).off('click','.refresh_font_list');
	jQuery(document).on('click','.refresh_font_list',function(e){
		e.preventDefault();
		var spinner = jQuery('#spinner2');
		jQuery('#pix_ap_header h2').append(spinner.animate({opacity:1},100));
		jQuery('#pix_content_loaded').animate({opacity:.5},100);
		var data = {
			action: 'update_google_font_list'
		};
		jQuery.post(ajaxurl, data).success(function(html) {
			spinner.animate({opacity:0},100,function(){
				jQuery('#spinner_wrap').prepend(spinner);
				jQuery('nav#pix_ap_main_nav > ul > li li.current a').click();
			});
		});
	});
}

/********************************
*
*	Import skin alert
*
********************************/
function importSkins(){
	jQuery(document).off('click','button.pix_import_skin')
	jQuery(document).on('click','button.pix_import_skin',function(e) {

		e.preventDefault()
		
		var t = jQuery(this),
			html = t.attr('data-alert'),
			w = (typeof t.attr('data-width') != 'undefined') ? t.attr('data-width') : 400,
			title = t.text(),
			div = jQuery('<div />').html(html);
		div.dialog({
		    show: {
		        duration: 500
		    },
		    hide: {
		        duration: 250
		    },
			height: 'auto',
			width: w,
			modal: false,
			dialogClass: 'wp-dialog pix-dialog pix-dialog-info',
			position: { my: "center", at: "center", of: window },
			title: title,
			zIndex: 50,
			buttons: {
				"Yes, continue": function() {
					jQuery( this ).dialog( "close" );

					var	form = t.parents('form.dynamic_form');
					form.submit();
				},
				"No, cancel": function() {
					jQuery( this ).dialog( "close" );
				}
			},
			open: function(){
		        jQuery('body').addClass('overflowHidden');        
				jQuery('body').append('<div id="pix-modal-overlay" />');
			},
			close: function(){
				jQuery('#pix-modal-overlay').remove();
		        jQuery('body').removeClass('overflowHidden');        
		        div.remove();   
			}
		});
		jQuery(window).bind('resize',function() {
			h = jQuery(window).height(),
			div.dialog('option',{'position':{ my: "center", at: "center", of: window }});
		});
		return false;
	});
}

/********************************
*
*	Select font group
*
********************************/
function selectFontGroup(){
	jQuery('.pix_group').each(function(){
		var group = jQuery(this),
			getFontVals = function(){
				if (jQuery('.for_font_family select option:selected', group).val()!='') {
					var spinner = jQuery('#spinner2'),
						family = jQuery('.for_font_family select option:selected', group).val(),
						webfont = jQuery('.for_font_family select option:selected', group).data('webfont'),
						variant = typeof jQuery('.for_font_variant select option:selected', group).val() != 'undefined' ? jQuery('.for_font_variant select option:selected', group).val() : '',
						subset = typeof jQuery('.for_font_subset select option:selected').val() != 'undefined' ? jQuery('.for_font_subset select option:selected').val() : pix_general_subset,
						weight = variant.replace('italic',''),
						style = variant.indexOf('italic')!=-1 ? 'italic' : 'normal',
						size = jQuery('.slider_div input', group).val();
					if ( jQuery('.slider_div', group).hasClass('em') ) {
						size = pix_general_fontsize*size;
					}
					weight = weight.replace('regular','400'),
					jQuery('#pix_ap_header h2').append(spinner.animate({opacity:1},150,function(){
						if(webfont!=='') {
							group.stop(true,false).animate({opacity:.5},100);
							WebFont.load({
								google: {
									families: [ webfont+':'+variant+':'+subset ]
								},
								fontloading: function() { 
									jQuery('.font_preview', group).css({
										fontFamily: '\"'+family+'\"',
										fontWeight: weight,
										fontStyle: style,
										fontSize: size+'px'
									}); 
									group.stop(true,false).animate({opacity:1},100);
									spinner.animate({opacity:0},100,function(){jQuery('#spinner_wrap').prepend(spinner);});
								}
							});
						}
					}));
				}
			};
		getFontVals();
		group.off('change','select');
		group.on('change','select', function(){
			getFontVals();
		});
		jQuery('.for_font_family select',group).bind('change', function(){
			group.stop(true,false).animate({opacity:.5},100);
			var sel = jQuery('option:selected',this),
				val = sel.val(),
				variant = jQuery('.for_font_variant select option:selected').val(),
				subset = typeof jQuery('.for_font_subset select option:selected').val() != 'undefined' ? jQuery('.for_font_subset select option:selected').val() : pix_general_subset,
				name = jQuery('.for_font_variant select').attr('name'),
				name2 = jQuery('.for_font_subset select').attr('name'),
				data = {
					action: 'load_font_variants',
					family: val,
					name: name,
					selected: variant
				};
				data2 = {
					action: 'load_font_subsets',
					family: val,
					name: name2,
					selected: subset
				};
			jQuery.post(ajaxurl, data)
				.success(function(html){
					group.stop(true,false).animate({opacity:1},100);
					jQuery('.for_font_variant',group).html(html);
					getSelValue(jQuery('.for_font_variant',group));
					getFontVals();
				});
			jQuery.post(ajaxurl, data2)
				.success(function(html){
					group.stop(true,false).animate({opacity:1},100);
					jQuery('.for_font_subset',group).html(html);
					getSelValue(jQuery('.for_font_subset',group));
					getFontVals();
				});
		});
		jQuery('.slider_div', group).bind('slided', function(){
			getFontVals();
		});
	});
}

/********************************
*
*	Check license
*
********************************/
function checkLicense(){
	if ( typeof geode_check_license != 'undefined' && geode_check_license != false && geode_check_license != null) {
		jQuery('#check_license_message').html(geode_check_message).slideDown();
	}

	geode_check_license = undefined;
}



jQuery(function(){
	importSkins();
	adminNav();
	floatingSaveButton();
	selectFontSet();
});
