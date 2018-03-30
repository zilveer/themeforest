
jQuery(document).ready(function() {
	jQuery('#tm-panel-switch').addClass('panel-open');
		
	//=================== Show or Hide Control Panel ========================//
	jQuery('#tm-panel-switch').click(function(){
		if ( jQuery(this).hasClass('panel-open') ) {
			jQuery('#tm-control-panel').animate( { left: 0 } );
			jQuery(this).removeClass('panel-open');
			jQuery(this).addClass('panel-close');
			jQuery.cookie('tm_panel_open', 0);
		}else if ( jQuery(this).hasClass('panel-close') ) {
			jQuery('#tm-control-panel').animate( { left: -250 } );
			jQuery(this).addClass('panel-open');
			jQuery(this).removeClass('panel-close');
			jQuery.cookie('tm_panel_open', 1);
			
		}
		//return false;
	});
		
	//=================== BACKGROUND COLOR SETTINGS ========================//
	var tm_bkgcolor;

	if(jQuery.cookie('tm_bkgcolor')) {
		tm_bkgcolor = jQuery.cookie('tm_bkgcolor');
	} else {
		tm_bkgcolor = bkg_color_default;
	}

	jQuery('#tm-panel-bkgcolor').ColorPicker({

		color: tm_bkgcolor,

		onShow: function (colpkr) {
			jQuery(colpkr).fadeIn(500);
			return false;
		},
		
		onHide: function (colpkr) {
			jQuery(colpkr).fadeOut(500);
			return false;
		},

		onChange: function (hsb, hex, rgb) {
			jQuery('body').css('backgroundColor', '#' + hex);
			jQuery('#tm-panel-bkgcolor').css('backgroundColor', '#' + hex);
			jQuery('#panel_form').submit(function() {
				jQuery.cookie('tm_bkgcolor', hex);
		    });
		}
	});
	
	
	//=================== TEXTURE SETTINGS ========================//
	jQuery('#tm-control-panel a.tm-panel-item').click(function(){
		var tm_texture_value = jQuery(this).attr('title');
		jQuery('body').css('backgroundImage', 'url(' + tm_theme_path + '/images/megnor/colorpicker/pattern/' + tm_texture_value + '.png)' );
		jQuery('body').css('background-repeat','repeat');		
		jQuery('#panel_form').submit(function() {
			jQuery.cookie('tm_texture', tm_texture_value);
		});
	});
	

	//=================== BODY SETTINGS ========================//
	var tm_bodyfont_tag = 'body';

	jQuery('#tm-panel-body-font').change(function(){

		var tm_bodyfont_encoded = jQuery(this).val(),
			tm_bodyfont_value = jQuery(this).val().replace(' ','+');

		jQuery('head').append('<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family='+ tm_bodyfont_value + '" />');
		jQuery('head').append('<style type="text/css">' + tm_bodyfont_tag + ' { font-family: "' + tm_bodyfont_encoded + '"; }</style>');

		jQuery('#panel_form').submit(function() {
			jQuery.cookie('tm_bodyfont', tm_bodyfont_encoded);
	    });
	});
	
	var tm_bodyfont_color;

	if(jQuery.cookie('tm_bodyfont_color')) {
		tm_bodyfont_color = jQuery.cookie('tm_bodyfont_color');
	} else {
		tm_bodyfont_color = bodyfont_color_default;
	}
	
	jQuery('#tm-panel-body-font-color').ColorPicker({
													
		color: tm_bodyfont_color,

		onShow: function (colpkr) {
			jQuery(colpkr).fadeIn(500);
			return false;
		},

		onHide: function (colpkr) {
			jQuery(colpkr).fadeOut(500);
			return false;
		},

		onChange: function (hsb, hex, rgb) {
			jQuery(tm_bodyfont_tag).css('color', '#' + hex);
			jQuery('#tm-panel-body-font-color').css('backgroundColor', '#' + hex);
			jQuery('#panel_form').submit(function() {
				jQuery.cookie('tm_bodyfont_color', hex);
	    	});
		}
	});
	
	
	//=================== HEADER SETTINGS ========================//
	var tm_headerfont_tag = 'h1,h2,h3,h4,h5,h6';

	jQuery('#tm-panel-header-font').change(function(){

		var tm_headerfont_encoded = jQuery(this).val(),
			tm_headerfont_value = jQuery(this).val().replace(' ','+');

			jQuery('head').append('<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=' + tm_headerfont_value + '" />');
			jQuery('head').append('<style type="text/css">' + tm_headerfont_tag + ' { font-family: "' + tm_headerfont_encoded + '"; }</style>');
			
			jQuery('#panel_form').submit(function() {
				jQuery.cookie('tm_headerfont', tm_headerfont_encoded);
	    	});

	});
	
	var tm_headerfont_color;

	if(jQuery.cookie('tm_headerfont_color')) {
		tm_headerfont_color = jQuery.cookie('tm_headerfont_color');
	} else {
		tm_headerfont_color = headerfont_color_default;
	}
	
	jQuery('#tm-panel-header-font-color').ColorPicker({

		color: tm_headerfont_color,
		
		onShow: function (colpkr) {
			jQuery(colpkr).fadeIn(500);
			return false;
		},

		onHide: function (colpkr) {
			jQuery(colpkr).fadeOut(500);
			return false;
		},

		onChange: function (hsb, hex, rgb) {
			jQuery(tm_headerfont_tag).css('color', '#' + hex);
			jQuery('#tm-panel-header-font-color').css('backgroundColor', '#' + hex);
			jQuery('#panel_form').submit(function() {
				jQuery.cookie('tm_headerfont_color', hex);
	    	});
		}
	});
	
	
	//=================== NAVIGATION SETTINGS ========================//
	var tm_navfont_tag = '.primary-navigation a';

	jQuery('#tm-panel-nav-font').change(function(){

		var tm_navfont_encoded = jQuery(this).val(),
			tm_navfont_value = jQuery(this).val().replace(' ','+');

		jQuery('head').append('<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=' + tm_navfont_value + '" />');
		jQuery('head').append('<style type="text/css">' + tm_navfont_tag + ' { font-family: "' + tm_navfont_encoded + '"; }</style>');

		jQuery('#panel_form').submit(function() {
			jQuery.cookie('tm_navfont', tm_navfont_encoded);
	    });
	});
	
	var tm_navfont_color;

	if(jQuery.cookie('tm_navfont_color')) {
		tm_navfont_color = jQuery.cookie('tm_navfont_color');
	} else {
		tm_navfont_color = navfont_color_default;
	}
	
	jQuery('#tm-panel-nav-font-color').ColorPicker({

		color: tm_navfont_color,
		
		onShow: function (colpkr) {
			jQuery(colpkr).fadeIn(500);
			return false;
		},

		onHide: function (colpkr) {
			jQuery(colpkr).fadeOut(500);
			return false;
		},

		onChange: function (hsb, hex, rgb) {
			jQuery(tm_navfont_tag).css('color', '#' + hex );
			jQuery('#tm-panel-nav-font-color').css('backgroundColor', '#' + hex);
			jQuery('#panel_form').submit(function() {
				jQuery.cookie('tm_navfont_color', hex);
	    	});
		}
	});
	
	
	//=================== LINK COLOR SETTINGS ========================//
	var tm_linkcolor;

	if(jQuery.cookie('tm_linkcolor')) {
		tm_linkcolor = jQuery.cookie('tm_linkcolor');
	} else {
		tm_linkcolor = link_color_default;
	}
	
	jQuery('#tm-panel-linkcolor').ColorPicker({

		color: tm_linkcolor,

		onShow: function (colpkr) {
			jQuery(colpkr).fadeIn(500);
			return false;
		},
		
		onHide: function (colpkr) {
			jQuery(colpkr).fadeOut(500);
			return false;
		},

		onChange: function (hsb, hex, rgb) {
			jQuery('a').css('color', '#' + hex);
			jQuery('#tm-panel-linkcolor').css('backgroundColor', '#' + hex);
			jQuery('#panel_form').submit(function() {
				jQuery.cookie('tm_linkcolor', hex);
		    });
		}
	});
	
	//=================== FOOTER COLOR SETTINGS ========================//
	var tm_footercolor_tag = '.footer-main a',
		tm_footercolor;

	if(jQuery.cookie('tm_footercolor')) {
		tm_footercolor = jQuery.cookie('tm_footercolor');
	} else {
		tm_footercolor = footer_link_color_default;
	}
	
	jQuery('#tm-panel-footercolor').ColorPicker({

		color: tm_footercolor,

		onShow: function (colpkr) {
			jQuery(colpkr).fadeIn(500);
			return false;
		},
		
		onHide: function (colpkr) {
			jQuery(colpkr).fadeOut(500);
			return false;
		},

		onChange: function (hsb, hex, rgb) {
			jQuery(tm_footercolor_tag).css('color', '#' + hex);
			jQuery('#tm-panel-footercolor').css('backgroundColor', '#' + hex);
			jQuery('#panel_form').submit(function() {
				jQuery.cookie('tm_footercolor', hex);
		    });
		}
	}); 
	
	//=================== RESET ALL COOKIES ========================//
	jQuery('#reset_panel_form').submit(function() {
		jQuery.cookie('tm_bkgcolor', null);	
		jQuery.cookie('tm_texture', null);
		jQuery.cookie('tm_bodyfont', null);
		jQuery.cookie('tm_bodyfont_color', null);
		jQuery.cookie('tm_headerfont', null);
		jQuery.cookie('tm_headerfont_color', null);
		jQuery.cookie('tm_navfont', null);
		jQuery.cookie('tm_navfont_color', null);
		jQuery.cookie('tm_linkcolor', null);
		jQuery.cookie('tm_footercolor', null);
	});

});