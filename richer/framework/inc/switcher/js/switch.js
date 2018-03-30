/*
 * jQuery miniColors: A small color selector
 *
 * Copyright 2012 Cory LaViska for A Beautiful Site, LLC. (http://www.abeautifulsite.net/)
 *
 * Dual licensed under the MIT or GPL Version 2 licenses
 *
*/
if(jQuery)(function($){$.extend($.fn,{miniColors:function(o,data){var prefix=!o||typeof o.prefix==='undefined'?'#':o.prefix;function create(input,o,data){var color=expandHex(input.val())||'ffffff',hsb=hex2hsb(color),rgb=hsb2rgb(hsb),alpha=parseFloat(input.attr('data-opacity')).toFixed(2),opacity=false,trigger;if(alpha>1)alpha=1;if(alpha<0)alpha=0;if(input.attr('data-opacity')!==undefined||o.opacity===true){opacity=true;alpha=input.attr('data-opacity');if(alpha===''){alpha=1}else{alpha=parseFloat(alpha).toFixed(2)}if(alpha>1)alpha=1;if(alpha<0)alpha=0;input.attr('data-opacity',alpha)}trigger=$('<a class="miniColors-trigger" style="background-color: #'+color+'" href="#"></a>');trigger.insertAfter(input);trigger.wrap('<span class="miniColors-triggerWrap"></span>');if(o.opacity){trigger.css('backgroundColor','rgba('+rgb.r+', '+rgb.g+', '+rgb.b+', '+alpha+')')}input.addClass('miniColors').data('original-maxlength',input.attr('maxlength')||null).data('original-autocomplete',input.attr('autocomplete')||null).data('letterCase',o.letterCase==='uppercase'?'uppercase':'lowercase').data('opacity',opacity).data('alpha',alpha).data('trigger',trigger).data('hsb',hsb).data('change',o.change?o.change:null).data('close',o.close?o.close:null).data('open',o.open?o.open:null).attr('maxlength',7).attr('autocomplete','off').val(prefix+convertCase(color,o.letterCase));if(o.readonly||input.prop('readonly'))input.prop('readonly',true);if(o.disabled||input.prop('disabled'))disable(input);trigger.on('click.miniColors',function(event){event.preventDefault();if(input.val()==='')input.val(prefix);show(input)});input.on('focus.miniColors',function(event){if(input.val()==='')input.val(prefix);show(input)});input.on('blur.miniColors',function(event){var hex=expandHex(input.val());input.val(hex?prefix+convertCase(hex,input.data('letterCase')):'#'+hsb2hex(input.data('hsb')))});input.on('keydown.miniColors',function(event){if(event.keyCode===9||event.keyCode===27)hide(input)});input.on('keyup.miniColors',function(event){setColorFromInput(input)});input.on('paste.miniColors',function(event){setTimeout(function(){setColorFromInput(input)},5)})}function destroy(input){hide();input=$(input);input.data('trigger').parent().remove();input.attr('autocomplete',input.data('original-autocomplete')).attr('maxlength',input.data('original-maxlength')).removeData().removeClass('miniColors').off('.miniColors');$(document).off('.miniColors')}function enable(input){input.prop('disabled',false).data('trigger').parent().removeClass('disabled')}function disable(input){hide(input);input.prop('disabled',true).data('trigger').parent().addClass('disabled')}function show(input){var hex,colorPosition,huePosition,opacityPosition,hidden,top,left,trigger,triggerWidth,triggerHeight,selector,selectorWidth,selectorHeight,windowHeight,windowWidth,scrollTop,scrollLeft;if(input.prop('disabled'))return false;hide();selector=$('<div class="miniColors-selector"></div>').append('<div class="miniColors-hues"><div class="miniColors-huePicker"></div></div>').append('<div class="miniColors-colors" style="background-color: #FFF;"><div class="miniColors-colorPicker"><div class="miniColors-colorPicker-inner"></div></div>').css('display','none').addClass(input.attr('class'));if(input.data('opacity')){selector.addClass('opacity').prepend('<div class="miniColors-opacity"><div class="miniColors-opacityPicker"></div></div>')}hsb=input.data('hsb');selector.find('.miniColors-colors').css('backgroundColor','#'+hsb2hex({h:hsb.h,s:100,b:100})).end().find('.miniColors-opacity').css('backgroundColor','#'+hsb2hex({h:hsb.h,s:hsb.s,b:hsb.b})).end();colorPosition=input.data('colorPosition');if(!colorPosition)colorPosition=getColorPositionFromHSB(hsb);selector.find('.miniColors-colorPicker').css('top',colorPosition.y+'px').css('left',colorPosition.x+'px');huePosition=input.data('huePosition');if(!huePosition)huePosition=getHuePositionFromHSB(hsb);selector.find('.miniColors-huePicker').css('top',huePosition+'px');opacityPosition=input.data('opacityPosition');if(!opacityPosition)opacityPosition=getOpacityPositionFromAlpha(input.attr('data-opacity'));selector.find('.miniColors-opacityPicker').css('top',opacityPosition+'px');input.data('selector',selector).data('huePicker',selector.find('.miniColors-huePicker')).data('opacityPicker',selector.find('.miniColors-opacityPicker')).data('colorPicker',selector.find('.miniColors-colorPicker')).data('mousebutton',0);$('BODY').append(selector);trigger=input.data('trigger');hidden=!input.is(':visible');top=hidden?trigger.offset().top+trigger.outerHeight():input.offset().top+input.outerHeight();left=hidden?trigger.offset().left:input.offset().left;selectorWidth=selector.outerWidth();selectorHeight=selector.outerHeight();triggerWidth=trigger.outerWidth();triggerHeight=trigger.outerHeight();windowHeight=$(window).height();windowWidth=$(window).width();scrollTop=$(window).scrollTop();scrollLeft=$(window).scrollLeft();if((top+selectorHeight)>windowHeight+scrollTop)top=top-selectorHeight-triggerHeight;if((left+selectorWidth)>windowWidth+scrollLeft)left=left-selectorWidth+triggerWidth;selector.css({top:top,left:left}).fadeIn(100);selector.on('selectstart',function(){return false});if(!$.browser.msie||($.browser.msie&&$.browser.version>=9)){$(window).on('resize.miniColors',function(event){hide(input)})}$(document).on('mousedown.miniColors touchstart.miniColors',function(event){var testSubject=$(event.target).parents().andSelf();input.data('mousebutton',1);if(testSubject.hasClass('miniColors-colors')){event.preventDefault();input.data('moving','colors');moveColor(input,event)}if(testSubject.hasClass('miniColors-hues')){event.preventDefault();input.data('moving','hues');moveHue(input,event)}if(testSubject.hasClass('miniColors-opacity')){event.preventDefault();input.data('moving','opacity');moveOpacity(input,event)}if(testSubject.hasClass('miniColors-selector')){event.preventDefault();return}if(testSubject.hasClass('miniColors'))return;hide(input)}).on('mouseup.miniColors touchend.miniColors',function(event){event.preventDefault();input.data('mousebutton',0).removeData('moving')}).on('mousemove.miniColors touchmove.miniColors',function(event){event.preventDefault();if(input.data('mousebutton')===1){if(input.data('moving')==='colors')moveColor(input,event);if(input.data('moving')==='hues')moveHue(input,event);if(input.data('moving')==='opacity')moveOpacity(input,event)}});if(input.data('open')){input.data('open').call(input.get(0),'#'+hsb2hex(hsb),$.extend(hsb2rgb(hsb),{a:parseFloat(input.attr('data-opacity'))}))}}function hide(input){if(!input)input=$('.miniColors');input.each(function(){var selector=$(this).data('selector');$(this).removeData('selector');$(selector).fadeOut(100,function(){if(input.data('close')){var hsb=input.data('hsb'),hex=hsb2hex(hsb);input.data('close').call(input.get(0),'#'+hex,$.extend(hsb2rgb(hsb),{a:parseFloat(input.attr('data-opacity'))}))}$(this).remove()})});$(document).off('.miniColors')}function moveColor(input,event){var colorPicker=input.data('colorPicker'),position,s,b,hsb;colorPicker.hide();position={x:event.pageX,y:event.pageY};if(event.originalEvent.changedTouches){position.x=event.originalEvent.changedTouches[0].pageX;position.y=event.originalEvent.changedTouches[0].pageY}position.x=position.x-input.data('selector').find('.miniColors-colors').offset().left-6;position.y=position.y-input.data('selector').find('.miniColors-colors').offset().top-6;if(position.x<=-5)position.x=-5;if(position.x>=144)position.x=144;if(position.y<=-5)position.y=-5;if(position.y>=144)position.y=144;input.data('colorPosition',position);colorPicker.css('left',position.x).css('top',position.y).show();s=Math.round((position.x+5)*0.67);if(s<0)s=0;if(s>100)s=100;b=100-Math.round((position.y+5)*0.67);if(b<0)b=0;if(b>100)b=100;hsb=input.data('hsb');hsb.s=s;hsb.b=b;setColor(input,hsb,true)}function moveHue(input,event){var huePicker=input.data('huePicker'),position=event.pageY,h,hsb;huePicker.hide();if(event.originalEvent.changedTouches){position=event.originalEvent.changedTouches[0].pageY}position=position-input.data('selector').find('.miniColors-colors').offset().top-1;if(position<=-1)position=-1;if(position>=149)position=149;input.data('huePosition',position);huePicker.css('top',position).show();h=Math.round((150-position-1)*2.4);if(h<0)h=0;if(h>360)h=360;hsb=input.data('hsb');hsb.h=h;setColor(input,hsb,true)}function moveOpacity(input,event){var opacityPicker=input.data('opacityPicker'),position=event.pageY,alpha;opacityPicker.hide();if(event.originalEvent.changedTouches){position=event.originalEvent.changedTouches[0].pageY}position=position-input.data('selector').find('.miniColors-colors').offset().top-1;if(position<=-1)position=-1;if(position>=149)position=149;input.data('opacityPosition',position);opacityPicker.css('top',position).show();alpha=parseFloat((150-position-1)/150).toFixed(2);if(alpha<0)alpha=0;if(alpha>1)alpha=1;input.data('alpha',alpha).attr('data-opacity',alpha);setColor(input,input.data('hsb'),true)}function setColor(input,hsb,updateInput){var hex=hsb2hex(hsb),selector=$(input.data('selector')),rgb=hsb2rgb(hsb);input.data('hsb',hsb);if(updateInput)input.val(prefix+convertCase(hex,input.data('letterCase')));selector.find('.miniColors-colors').css('backgroundColor','#'+hsb2hex({h:hsb.h,s:100,b:100})).end().find('.miniColors-opacity').css('backgroundColor','#'+hex).end();input.data('trigger').css('backgroundColor','#'+hex);if(input.data('opacity')){input.data('trigger').css('backgroundColor','rgba('+rgb.r+', '+rgb.g+', '+rgb.b+', '+input.attr('data-opacity')+')')}if(input.data('change')){if((hex+','+input.attr('data-opacity'))===input.data('lastChange'))return;input.data('change').call(input.get(0),'#'+hex,$.extend(hsb2rgb(hsb),{a:parseFloat(input.attr('data-opacity'))}));input.data('lastChange',hex+','+input.attr('data-opacity'))}}function setColorFromInput(input){var hex,hsb,colorPosition,colorPicker,huePosition,huePicker,opacityPosition,opacityPicker;input.val(prefix+cleanHex(input.val()));hex=expandHex(input.val());if(!hex)return false;hsb=hex2hsb(hex);colorPosition=getColorPositionFromHSB(hsb);colorPicker=$(input.data('colorPicker'));colorPicker.css('top',colorPosition.y+'px').css('left',colorPosition.x+'px');input.data('colorPosition',colorPosition);huePosition=getHuePositionFromHSB(hsb);huePicker=$(input.data('huePicker'));huePicker.css('top',huePosition+'px');input.data('huePosition',huePosition);opacityPosition=getOpacityPositionFromAlpha(input.attr('data-opacity'));opacityPicker=$(input.data('opacityPicker'));opacityPicker.css('top',opacityPosition+'px');input.data('opacityPosition',opacityPosition);setColor(input,hsb);return true}function convertCase(string,letterCase){if(letterCase==='uppercase'){return string.toUpperCase()}else{return string.toLowerCase()}}function getColorPositionFromHSB(hsb){var x=Math.ceil(hsb.s/0.67);if(x<0)x=0;if(x>150)x=150;var y=150-Math.ceil(hsb.b/0.67);if(y<0)y=0;if(y>150)y=150;return{x:x-5,y:y-5}}function getHuePositionFromHSB(hsb){var y=150-(hsb.h/2.4);if(y<0)h=0;if(y>150)h=150;return y}function getOpacityPositionFromAlpha(alpha){var y=150*alpha;if(y<0)y=0;if(y>150)y=150;return 150-y}function cleanHex(hex){return hex.replace(/[^A-F0-9]/ig,'')}function expandHex(hex){hex=cleanHex(hex);if(!hex)return null;if(hex.length===3)hex=hex[0]+hex[0]+hex[1]+hex[1]+hex[2]+hex[2];return hex.length===6?hex:null}function hsb2rgb(hsb){var rgb={};var h=Math.round(hsb.h);var s=Math.round(hsb.s*255/100);var v=Math.round(hsb.b*255/100);if(s===0){rgb.r=rgb.g=rgb.b=v}else{var t1=v;var t2=(255-s)*v/255;var t3=(t1-t2)*(h%60)/60;if(h===360)h=0;if(h<60){rgb.r=t1;rgb.b=t2;rgb.g=t2+t3}else if(h<120){rgb.g=t1;rgb.b=t2;rgb.r=t1-t3}else if(h<180){rgb.g=t1;rgb.r=t2;rgb.b=t2+t3}else if(h<240){rgb.b=t1;rgb.r=t2;rgb.g=t1-t3}else if(h<300){rgb.b=t1;rgb.g=t2;rgb.r=t2+t3}else if(h<360){rgb.r=t1;rgb.g=t2;rgb.b=t1-t3}else{rgb.r=0;rgb.g=0;rgb.b=0}}return{r:Math.round(rgb.r),g:Math.round(rgb.g),b:Math.round(rgb.b)}}function rgb2hex(rgb){var hex=[rgb.r.toString(16),rgb.g.toString(16),rgb.b.toString(16)];$.each(hex,function(nr,val){if(val.length===1)hex[nr]='0'+val});return hex.join('')}function hex2rgb(hex){hex=parseInt(((hex.indexOf('#')>-1)?hex.substring(1):hex),16);return{r:hex>>16,g:(hex&0x00FF00)>>8,b:(hex&0x0000FF)}}function rgb2hsb(rgb){var hsb={h:0,s:0,b:0};var min=Math.min(rgb.r,rgb.g,rgb.b);var max=Math.max(rgb.r,rgb.g,rgb.b);var delta=max-min;hsb.b=max;hsb.s=max!==0?255*delta/max:0;if(hsb.s!==0){if(rgb.r===max){hsb.h=(rgb.g-rgb.b)/delta}else if(rgb.g===max){hsb.h=2+(rgb.b-rgb.r)/delta}else{hsb.h=4+(rgb.r-rgb.g)/delta}}else{hsb.h=-1}hsb.h*=60;if(hsb.h<0){hsb.h+=360}hsb.s*=100/255;hsb.b*=100/255;return hsb}function hex2hsb(hex){var hsb=rgb2hsb(hex2rgb(hex));if(hsb.s===0)hsb.h=360;return hsb}function hsb2hex(hsb){return rgb2hex(hsb2rgb(hsb))}switch(o){case'readonly':$(this).each(function(){if(!$(this).hasClass('miniColors'))return;$(this).prop('readonly',data)});return $(this);case'disabled':$(this).each(function(){if(!$(this).hasClass('miniColors'))return;if(data){disable($(this))}else{enable($(this))}});return $(this);case'value':if(data===undefined){if(!$(this).hasClass('miniColors'))return;var hex=expandHex($(this).val());return hex?prefix+convertCase(hex,$(this).data('letterCase')):null}$(this).each(function(){if(!$(this).hasClass('miniColors'))return;$(this).val(data);setColorFromInput($(this))});return $(this);case'opacity':if(data===undefined){if(!$(this).hasClass('miniColors'))return;if($(this).data('opacity')){return parseFloat($(this).attr('data-opacity'))}else{return null}}$(this).each(function(){if(!$(this).hasClass('miniColors'))return;if(data<0)data=0;if(data>1)data=1;$(this).attr('data-opacity',data).data('alpha',data);setColorFromInput($(this))});return $(this);case'destroy':$(this).each(function(){if(!$(this).hasClass('miniColors'))return;destroy($(this))});return $(this);default:if(!o)o={};$(this).each(function(){if($(this)[0].tagName.toLowerCase()!=='input')return;if($(this).data('trigger'))return;create($(this),o,data)});return $(this)}}})})(jQuery);

jQuery(document).ready(function(){
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
	function changeColor(hex) {
	style.html(
	'section.fullwidth-6, #footer .widget ul li:before, #infobar .widget ul li:before, .social-icon a:hover, .social-icons a:hover{background-color:'+hex+' !important;}'+
	'::selection { background:'+hex+' !important; }'+
	'::-moz-selection { background:'+hex+'; }'+
	'#footer ul li a {color:#ffffff !important;}'+
	'.add_to_cart_button.lightgray.button:hover {background-color: '+hex+' !important;}'+
	'ul.list li:before, #footer a, #copyright .copyright-text a, #footer a:hover'+
	'.title a:hover, .post-meta span a:hover, .tp-caption.my_big_blue { color: '+hex+' !important; }'+
	'.separator_line {background: '+hex+';}'+
	'#filters ul li a.active, #filters ul li a:hover {border-color:'+hex+'; color:'+hex+';}'+
	'.projects-nav a:hover { background-color: '+hex+'; }'+
	'blockquote, .pullquote.align-right, .pullquote.align-left {border-color:'+hex+';}'+
	'#navigation ul.menu > li > .sub-menu { border-top:3px solid '+hex+';}'+
	'#navigation ul.menu > li.sfHover > a,'+
	'#navigation ul.menu > li.sfHover > a:hover,'+
	'#navigation ul.menu li.menu-item a:hover,'+
	'#navigation ul.menu > li.current-menu-item > a:hover,'+
	'#navigation ul.menu > li.current-menu-item > a,'+
	'#navigation ul.menu > li.current-menu-ancestor > a:hover,'+
	'#navigation ul.menu > li.current-menu-ancestor > a,'+
	'#navigation ul.menu > li.current-menu-parent > a:hover,'+
	'#navigation ul.menu > li.current-menu-parent > a, '+
	'#navigation ul.menu > li.megamenu > ul > li > a:hover, #navigation ul.menu > li.megamenu > ul > li.sfHover > a, '+
	'#navigation ul.menu > li.megamenu > ul > li.current-menu-item > a, '+
	'#navigation ul.menu > li.megamenu > ul > li.current-menu-parent > a,'+
	'#navigation .sub-menu li a:hover,'+
	'#navigation .sub-menu li.sfHover > a,'+
	'#navigation .sub-menu li.current-menu-parent > a,'+
	'#navigation .sub-menu li .sub-menu li a:hover,'+
	'#navigation .sub-menu li.current-menu-item a,'+
	'#navigation .sub-menu li.current-menu-item a:hover,'+
	'#navigation .sub-menu li.current_page_item a,'+
	'#navigation .sub-menu li.current_page_item a:hover { color: '+hex+' !important; }'+
	'.accordion.style1 .accordion-title.active i,'+
	'.sidenav li a:hover, '+
	'.sidenav li.current_page_item > a, '+
	'.sidenav li.current_page_item > a:hover { color: '+hex+'; }'+
	'.blog-item  .author .name, a, a:visited { color: '+hex+' }'+
	'#back-to-top a:hover { background-color: '+hex+' }'+
	'.widget_tag_cloud a:hover { background: '+hex+'; border-color: '+hex+';}'+
	'.widget_portfolio .portfolio-widget-item .portfolio-pic:hover { background: '+hex+'; border-color: '+hex+';}'+
	'#footer .widget_tag_cloud a:hover,'+
	'#footer .widget_flickr #flickr_tab a:hover,'+
	'#footer .widget_portfolio .portfolio-widget-item .portfolio-pic:hover,'+
	'.flex-direction-nav a:hover { background-color: '+hex+' }'+
	'.flex-control-nav li a:hover, .flex-control-nav li a.flex-active{ background: '+hex+';}'+
	'.gallery img:hover { background: '+hex+'; border-color: '+hex+' !important; }'+
	'.skillbar .skill-percentage { background: '+hex+' }'+
	'.latest-blog .blog-item:hover h4 { color: '+hex+' }'+
	'.tp-caption.big_colorbg{ background: '+hex+'; }'+
	'.tp-caption.medium_colorbg{ background: '+hex+'; }'+
	'.tp-caption.small_colorbg { background: '+hex+'; }'+
	'.tp-caption.customfont_color{ color: '+hex+'; }'+
	'.tp-caption a { color: '+hex+'; }'+
	'.widget_categories ul li a:hover, #related-posts ul li h5 a:hover { color: '+hex+'; }'+
	'.portfolio-item .portfolio-page-item .portfolio-title a:hover { color: '+hex+';}'+
	'a.more,'+
	'#sidebar .widget ul li a:hover,'+
	'#related-posts ul li:before {color: '+hex+';}'+
	'.counter-value .value {color: '+hex+';}'+
	'.callout, .description.style-2 {border-left-color:'+hex+';}'+
	'.tabset .tab a.selected i, .tabset .tab a:hover i, .tabset .tab a.selected h6, .tabset .tab a:hover h6 { color:'+hex+';}'+
	'.shop_table .product-remove a:hover {color: '+hex+';}'+
	'.testimonial-author .featured-thumbnail:after {border-left-color:'+hex+';}'+
	'#header.header6 .logo_bg {background-color: '+hex+';}'+
	'#pagination a:hover, #pagination span.current {background-color: '+hex+';}'+
	'.iconlist:hover .icon.circle {color: '+hex+';border-color: '+hex+';}'+
	'.iconbox:hover .top_icon_circle .icon,'+
	'.iconbox:hover .aside_rounded_icon .icon {background-color: '+hex+' !important;	border-color: '+hex+' !important;color:#fff !important;}'+
	'.portfolio-item:hover .portfolio-title {background-color: '+hex+' ;}'+
	'.portfolio-item .portfolio-terms a {background-color: '+hex+' ;}'+
	'.cart-loading,'+
	'.portfolio-item .portfolio-pic .portfolio-overlay .overlay-link,'+
	'.portfolio-item-one .portfolio-pic .portfolio-overlay .overlay-link {background-color: rgba('+hexToRgb(hex).r+','+hexToRgb(hex).g+','+hexToRgb(hex).b+',0.8);}'+
	'.testimonial.thumb-side .testimonial-author .featured-thumbnail {border-color:'+hex+';}'+
	'.testimonial.thumb-side .testimonial-author .featured-thumbnail:after {border-left-color:'+hex+';}'+
	'.iconbox:hover .top_icon_standard .icon {color:'+hex+' !important;}'+
	'.sidenav .children li:hover a::after,'+
	'.sidenav .children > li.current_page_item > a::after{background-color: '+hex+';}'+
	'.button, .button.default, input.button, input[type=submit], .loadmore.default {background-color: '+hex+';}'+
	'.ui-slider .ui-slider-range {background-color: '+hex+' !important;}'+
	'.widget ul li:before {background-color: '+hex+';}'+
	'.widget_shopping_cart_content .buttons a.button:hover {color: '+hex+' !important;}'
	);
}
function changeFontHeadings(font) {
	jQuery('#headings_font').remove();
	jQuery('<link rel="stylesheet" href="http://fonts.googleapis.com/css?family='+font.replace(" ", "+")+':400,700" type="text/css" id="headings_font" media="all">').appendTo('head');
	style2.html(' .sidenav li a, #title h1, #alt-title h1, #navigation ul li a, .tp-caption.big_black, .tp-caption.big_green, h1, h2, h3, h4, h5, h6, .title {font-family:"'+font+'";}');
}
function changeFontText(font2) {
	jQuery('#text_font').remove();
	jQuery('<link rel="stylesheet" href="http://fonts.googleapis.com/css?family='+font2.replace(" ", "+")+':400,700" type="text/css" id="text_font" media="all">').appendTo('head');
	style3.html(' body, .tp-caption.medium_text_black {font-family:"'+font2+'";}');
}
	var templateURI = jQuery('#templateURI').val();
   	var style = jQuery('<style type="text/css" id="theme_color" />').appendTo('head');
   	var style2 = jQuery('<style type="text/css" id="theme_headings" />').appendTo('head');
   	var style3 = jQuery('<style type="text/css" id="theme_text" />').appendTo('head');
   	var select = '<ul class="drop">'+
			'<li><a href="javascript:void(0);">Open Sans</a></li>'+
			'<li><a href="javascript:void(0);">Raleway</a></li>'+
			'<li><a href="javascript:void(0);">Bitter</li>'+
			'<li><a href="javascript:void(0);">Lato</a></li>'+
			'<li><a href="javascript:void(0);">Source Sans Pro</a></li>'+
			'<li><a href="javascript:void(0);">PT Sans</a></li>'+
			'<li><a href="javascript:void(0);">Droid Serif</a></li>'+
		'</ul>'+
		'<input type="hidden" id="select" />'+
	'</div>';
    var input_box = '<select id="layout_option"><option value="wide">Wide</option><option value="boxed">Boxed</option></select>';
	var	menu	  = jQuery('<menu class="switcher"></menu>'),
		toogle	  = jQuery('<div class="style-toggle"><i class="fa fa-gear"></i></div>'),
		items	  = '<li data-color="#43b4f9" class="st1"><a href="#"></a></li>'+
		'<li data-color="#2ecc71" class="st2"><a href="#"></a></li>'+
		'<li data-color="#ff5900" class="st3"><a href="#"></a></li>'+
		'<li data-color="#ffd427" class="st4"><a href="#"></a></li>'+
		'<li data-color="#ed1f24" class="st5"><a href="#"></a></li>'+
		'<li data-color="#A0B5B6" class="st6"><a href="#"></a></li>'+
		'<li data-color="#2997ab" class="st7"><a href="#"></a></li>'+
		'<li data-color="#a2c852" class="st8"><a href="#"></a></li>',
		pattern1   = '<a href="#" name="retina_wood"><img src="'+ templateURI +'/framework/inc/switcher/patterns/retina_wood_ico.png" width="20px" height="20px" alt="" /></a>',
		pattern2   = '<a href="#" name="carbon_fibre"><img src="'+ templateURI +'/framework/inc/switcher/patterns/carbon_fibre.png"width="20px" height="20px" alt="" /></a>',
		pattern3   = '<a href="#" name="white_wall"><img src="'+ templateURI +'/framework/inc/switcher/patterns/white_wall_ico.png" width="20px" height="20px" alt="" /></a>',
		pattern4   = '<a href="#" name="ecailles"><img src="'+ templateURI +'/framework/inc/switcher/patterns/ecailles.png" width="20px" height="20px" alt="" /></a>',
		pattern5   = '<a href="#" name="escheresque_ste"><img src="'+ templateURI +'/framework/inc/switcher/patterns/escheresque_ste.png" width="20px" height="20px" alt="" /></a>',
		pattern6   = '<a href="#" name="p6"><img src="'+ templateURI +'/framework/inc/switcher/patterns/p6.png" width="20px" height="20px" alt="" /></a>',
		pattern7   = '<a href="#" name="grey_wash_wall"><img src="'+ templateURI +'/framework/inc/switcher/patterns/grey_wash_wall_ico.png" width="20px" height="20px" alt="" /></a>',
		pattern8   = '<a href="#" name="binding_dark"><img src="'+ templateURI +'/framework/inc/switcher/patterns/binding_dark_ico.png" width="20px" height="20px" alt="" /></a>',
		pattern9   = '<a href="#" name="cream_pixels"><img src="'+ templateURI +'/framework/inc/switcher/patterns/cream_pixels.png" width="20px" height="20px" alt="" /></a>',
		pattern10   = '<a href="#" name="brickwall"><img src="'+ templateURI +'/framework/inc/switcher/patterns/brickwall_ico.png" width="20px" height="20px" alt="" /></a>',
		pattern11   = '<a href="#" name="triangular"><img src="'+ templateURI +'/framework/inc/switcher/patterns/triangular.png" width="20px" height="20px" alt="" /></a>',
		pattern12   = '<a href="#" name="old_moon"><img src="'+ templateURI +'/framework/inc/switcher/patterns/old_moon_ico.png" width="20px" height="20px" alt="" /></a>',
		pattern13   = '<a href="#" name="light_grey"><img src="'+ templateURI +'/framework/inc/switcher/patterns/light_grey.png" width="20px" height="20px" alt="" /></a>',
		bkgd1   = '<a href="#" class="bkgd" name="bkgd1"><img src="'+ templateURI +'/framework/inc/switcher/patterns/bkgd1.gif" width="20px" height="20px" alt="" /></a>',
		bkgd2   = '<a href="#" class="bkgd" name="bkgd2"><img src="'+ templateURI +'/framework/inc/switcher/patterns/bkgd2.gif" width="20px" height="20px" alt="" /></a>',
		bkgd3   = '<a href="#" class="bkgd" name="bkgd3"><img src="'+ templateURI +'/framework/inc/switcher/patterns/bkgd3.gif" width="20px" height="20px" alt="" /></a>',
		bkgd4   = '<a href="#" class="bkgd" name="bkgd4"><img src="'+ templateURI +'/framework/inc/switcher/patterns/bkgd4.gif" width="20px" height="20px" alt="" /></a>';
		bkgd5   = '<a href="#" class="bkgd" name="bkgd5"><img src="'+ templateURI +'/framework/inc/switcher/patterns/bkgd5.gif" width="20px" height="20px" alt="" /></a>';

	//construct dom

	jQuery('#style_selector').prepend(menu);
	menu.append('<div class="box-heading"><h4>Style switcher</h4></div>');
	menu.append('<div class="box"><h5>Layout Style</h5>'+ input_box +'</div>');
	menu.append('<div class="box"><h5>Patterns for Boxed layout</h5><div class="images">'+ pattern1 + pattern2 + pattern3 + pattern4 + pattern5 + pattern6 + pattern7 + pattern8+ pattern9+ pattern10+ pattern11+ pattern12+ pattern13 + bkgd1 + bkgd2 + bkgd3 + bkgd4 + bkgd5 +'</div></div>');
	menu.append('<div class="box"><h5>Predefined color schemes</h5><!--<input type="text" name="color1" class="color-picker miniColors" size="7" autocomplete="off" value="#a2c852" maxlength="7">--><ul class="colors clearfix">' + items + '</ul></div>');
	menu.append('<div class="box last"><small>Those customization options used only for demonstration. You have a lot of theme options in dashboard.</small></div>');
	//menu.append('<div class="box last"><h5>Font</h5><div class="mb10">Header:<div class="select"><a href="javascript:void(0);" class="slct headings">Font family</a>'+select+'</div><div class="mb10">Body:<div class="select"><a href="javascript:void(0);" class="slct text">Font family</a>'+select+'</div><small>* Fonts are used to example. You able to use 500+ google web fonts in the backend.</small></div>');
	jQuery('#style_selector').prepend(toogle);
	// ---------------------------------------------------------
	// Style switcher
	// ---------------------------------------------------------
	jQuery(".style-toggle").toggle(function(){
		jQuery(this).removeClass('active');
		jQuery("#style_selector").stop().animate({left:"-245px"}, {easing:"easeInOutQuad"}, "fast");
	},function(){
		jQuery(this).addClass('active');
	    jQuery("#style_selector").stop().animate({left:"0px"}, {easing:"easeInOutQuad"}, "fast");
	});

    jQuery('select#layout_option').change(function(){
        select_value = jQuery(this).val();
        jQuery("#main").removeClass().addClass(''+select_value)
        jQuery(window).resize();
    });
	jQuery('.box .images a').click(function(e) {
		e.preventDefault();
		var current = jQuery('select#layout_option :selected').val();
		if(current == 'boxed') {
			jQuery(this).parent().find('img').removeClass('active');
			jQuery(this).find('img').addClass('active');

			var name = jQuery(this).attr('name');
			var templateURI = jQuery('#templateURI').val();
			
			if(jQuery(this).hasClass('bkgd')) {
				jQuery('body').css('background', 'url('+ templateURI + '/framework/inc/switcher/patterns/'+name+'.jpg) no-repeat center center fixed');
				jQuery('body').css('background-size', 'cover');
			} else {
				jQuery('body').css('background', 'url('+ templateURI + '/framework/inc/switcher/patterns/'+name+'.png) repeat center center scroll');
				jQuery('body').css('background-size', 'auto');
			}
		} else {
		alert('This is available with boxed layout');
		}
	});
	// Select
	jQuery('.slct.headings').click(function(){
		var dropBlock = jQuery(this).parent().find('.drop');
		if( dropBlock.is(':hidden') ) {
			dropBlock.slideDown();
			jQuery(this).addClass('active');
			jQuery(this).parent().find('li').click(function(){
				var selectResult = jQuery(this).find('a').html();
				jQuery(this).parent().parent().find('input').val(selectResult);
				jQuery(this).parent().parent().find('.slct').removeClass('active').html(selectResult);
				dropBlock.slideUp();
				changeFontHeadings(selectResult);
			});
		} else {
			jQuery(this).removeClass('active');
			dropBlock.slideUp();
		}
		return false;
	});

	// Select
	jQuery('.slct.text').click(function(){
		var dropBlock = jQuery(this).parent().find('.drop');
		if( dropBlock.is(':hidden') ) {
			dropBlock.slideDown();
			jQuery(this).addClass('active');
			jQuery(this).parent().find('li').click(function(){
				var selectResult = jQuery(this).find('a').html();
				jQuery(this).parent().parent().find('input').val(selectResult);
				jQuery(this).parent().parent().find('.slct').removeClass('active').html(selectResult);
				dropBlock.slideUp();
				changeFontText(selectResult);
			});
		} else {
			jQuery(this).removeClass('active');
			dropBlock.slideUp();
		}
		return false;
	});

	jQuery('.color-picker').miniColors({
			change: function(hex, rgba) {
				changeColor(hex);
			}
		});
	jQuery('#style_selector .switcher ul.colors li').click(function(){
			var hex = jQuery(this).data('color');
			changeColor(hex);
		});
});
