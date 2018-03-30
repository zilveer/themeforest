/*!
 * jQuery Cookie Plugin
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2011, Klaus Hartl
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.opensource.org/licenses/GPL-2.0
 */
(function($) {
    $.cookie = function(key, value, options) {

        // key and at least value given, set cookie...
        if (arguments.length > 1 && (!/Object/.test(Object.prototype.toString.call(value)) || value === null || value === undefined)) {
            options = $.extend({}, options);

            if (value === null || value === undefined) {
                options.expires = -1;
            }

            if (typeof options.expires === 'number') {
                var days = options.expires, t = options.expires = new Date();
                t.setDate(t.getDate() + days);
            }

            value = String(value);

            return (document.cookie = [
                encodeURIComponent(key), '=', options.raw ? value : encodeURIComponent(value),
                options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
                options.path    ? '; path=' + options.path : '',
                options.domain  ? '; domain=' + options.domain : '',
                options.secure  ? '; secure' : ''
            ].join(''));
        }

        // key and possibly options given, get cookie...
        options = value || {};
        var decode = options.raw ? function(s) { return s; } : decodeURIComponent;

        var pairs = document.cookie.split('; ');
        for (var i = 0, pair; pair = pairs[i] && pairs[i].split('='); i++) {
            if (decode(pair[0]) === key) return decode(pair[1] || ''); // IE saves cookies with empty string as "c; ", e.g. without "=" as opposed to EOMB, thus pair[1] may be undefined
        }
        return null;
    };
})(jQuery);

$(document).ready(function(){

	if($.cookie("cookie_color")) {
		set_color = $.cookie("cookie_color");
	}
	else {
		set_color = 'color-default';
	}

	//Start Control Panel Script
	$('body').append('<div class="demo_panel opacity showed"><a href="javascript:void(0)" class="panel_toggler"></a><span class="panel_title">Settings panel</span></div>');
	demo_panel = $('body').find('.demo_panel');
	
	demo_panel.append('<div class="panel_item color_panel"><ul class="color_list"><li class="color_item"><a class="color1" rel="FFD200" href="javascript:void(0)"></a></li><li class="color_item"><a class="color2" rel="FF8D00" href="javascript:void(0)"></a></li><li class="color_item"><a class="color3" rel="FF5B29" href="javascript:void(0)"></a></li><li class="color_item"><a class="color4" rel="FF60AF" href="javascript:void(0)"></a></li><li class="color_item"><a class="color5" rel="B36AFF" href="javascript:void(0)"></a></li><li class="color_item"><a class="color6" rel="5196da" href="javascript:void(0)"></a></li><li class="color_item"><a class="color7" rel="0AB7E1" href="javascript:void(0)"></a></li><li class="color_item"><a class="color8" rel="88C800" href="javascript:void(0)"></a></li><li class="color_item"><a class="color9" rel="DBE93A" href="javascript:void(0)"></a></li><li class="color_item"><a class="color10" rel="A3A3A3" href="javascript:void(0)"></a></li></ul><div class="clear"></div><div/>');
	demo_panel.find('a[rel="'+$.cookie("cookie_color")+'"]').addClass('current');
	demo_panel.append('<div class="panel_item layout_item"><a href="javascript:void(0)" class="layout_default current">Default Layout<span></span></a></div>');
	demo_panel.append('<div class="panel_item layout_item"><a href="javascript:void(0)" class="layout_user_bg">Boxed Layout<span></span></a></div>');
	demo_panel.append('<div class="panel_item layout_item"><a href="javascript:void(0)" class="layout_user_image">Background Image<span></span></a></div>');
	
	$('.layout_default').live('click', function(){
		$('div.custom_bg_cont').remove();
		$('div.bg_pic').remove();		
		$('html').removeClass('user_bg_layout');
		$('html').removeClass('user_pic_layout');
		$('.layout_item a').removeClass('current');
		$(this).addClass('current');
	});
	$('.layout_user_bg').live('click', function(){
		if (!$(this).hasClass('current')) {
			$('div.custom_bg_cont').remove();
			$('html').removeClass('user_pic_layout');
			$('body').append('<div class="custom_bg_cont" style=" background-color:#5d5d5d"></div>');
			$('html').addClass('user_bg_layout');
			$('.layout_item a').removeClass('current');
			$(this).addClass('current');
		}
	});
	$('.layout_user_image').live('click', function(){
		if (!$(this).hasClass('current')) {
			$('div.custom_bg_cont').remove();
			$('html').removeClass('user_bg_layout');
			$('body').append('<div class="custom_bg_cont bg_pic" style=" background-image:url('+themerooturl+'/img/bg_user.jpg); background-repeat:no-repeat; background-position:center;"></div>');
			$('html').addClass('user_pic_layout');
			$('html').addClass('user_bg_layout');
			$('.layout_item a').removeClass('current');
			$(this).addClass('current');
		}
	});
	$('.color_item a').live('click', function(){
		$('.color_item').find('.current').removeClass('current');
		$(this).addClass('current');
		set_color = $(this).attr('rel');
		$('#theme_color').attr('href', 'css/colors/' + set_color + '.css');
        $.cookie("color_scheme", set_color, {expires: 1, path: "/"});
        window.location.reload();
	});
	
	$('.panel_toggler').live('click', function(){
		demo_panel.toggleClass('showed');
	});
});

$(window).load(function(){
	setTimeout("$('body').find('.demo_panel').removeClass('opacity')",800);
	setTimeout("$('body').find('.demo_panel').removeClass('showed')",1800);
});
