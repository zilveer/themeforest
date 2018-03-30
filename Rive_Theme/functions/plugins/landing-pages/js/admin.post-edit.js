jQuery(document).ready(function ($) {

	jQuery('#templates-container').isotope();

	// filter items when filter link is clicked
	jQuery('#template-filter a').click(function(){
	  var selector = jQuery(this).attr('data-filter');
	  //alert(selector);
	  jQuery('#templates-container').isotope({ filter: selector });
	  return false;
	});

	// Fix inactivate theme display
	jQuery("#template-box a").live('click', function () {

		setTimeout(function() {
			jQuery('#TB_window iframe').contents().find("#customize-controls").hide();
			jQuery('#TB_window iframe').contents().find(".wp-full-overlay.expanded").css("margin-left", "0px");
		}, 600);
	});

	// Fix Split testing iframe size
    jQuery("#lp-metabox-splittesting a.thickbox").live('click', function () {
        jQuery('#TB_iframeContent, #TB_window').hide();
		setTimeout(function() {

		 jQuery('#TB_iframeContent, #TB_window').width( 640 ).height( 800 ).css("margin-left", "0px").css("left", "35%");
		 jQuery('#TB_iframeContent, #TB_window').show();
		}, 600);
    });

    var delay = (function () {
		var timer = 0;
		return function (callback, ms) {
			clearTimeout(timer);
			timer = setTimeout(callback, ms);
		};
	})();

    jQuery(function () {
		var pause = 100; // will only process code within delay(function() { ... }) every 100ms.
		jQuery(window).resize(function () {
			delay(function () {
				var width = jQuery(window).width();
				jQuery('#TB_iframeContent, #TB_window').width( 640 ).height( 800 ).css("margin-left", "0px").css("left", "35%");
			}, pause);
		});
		jQuery(window).resize();
	});

	// Load meta box in correct position on page load
    var current_template = jQuery("input#lp_select_template ").val();
    var current_template_meta = "#lp_" + current_template + "_custom_meta_box";
    jQuery(current_template_meta).removeClass("postbox").appendTo("#template-display-options").addClass("Old-Template");
    var current_template_h3 = "#lp_" + current_template + "_custom_meta_box h3";
    jQuery(current_template_h3).css("background","#f8f8f8");
	jQuery(current_template_meta +' .handlediv').hide();
	jQuery(current_template_meta +' .hndle').css('cursor','default');


    // Fix Thickbox width/hieght
    jQuery(function($) {
		tb_position = function() {
			var tbWindow = $('#TB_window');
			var width = $(window).width();
			var H = $(window).height();
			var W = ( 1720 < width ) ? 1720 : width;

			if ( tbWindow.size() ) {
				tbWindow.width( W - 50 ).height( H - 45 );
				$('#TB_iframeContent').width( W - 50 ).height( H - 75 );
				tbWindow.css({'margin-left': '-' + parseInt((( W - 50 ) / 2),10) + 'px'});
				if ( typeof document.body.style.maxWidth != 'undefined' )
					tbWindow.css({'top':'40px','margin-top':'0'});
				//$('#TB_title').css({'background-color':'#fff','color':'#cfcfcf'});
			};

			return $('a.thickbox').each( function() {
				var href = $(this).attr('href');
				if ( ! href ) return;
				href = href.replace(/&width=[0-9]+/g, '');
				href = href.replace(/&height=[0-9]+/g, '');
				$(this).attr( 'href', href + '&width=' + ( W - 80 ) + '&height=' + ( H - 85 ) );
			});

		};

		jQuery('a.thickbox').click(function(){
			if ( typeof tinyMCE != 'undefined' &&  tinyMCE.activeEditor ) {
				tinyMCE.get('content').focus();
				tinyMCE.activeEditor.windowManager.bookmark = tinyMCE.activeEditor.selection.getBookmark('simple');
			}

		});

		$(window).resize( function() { tb_position() } );
	});
    // Isotope Styling
	jQuery('#template-filter a').first().addClass('button-primary');
	jQuery('#template-filter a').click(function(){
        jQuery("#template-filter a.button-primary").removeClass("button-primary");
        jQuery(this).addClass('button-primary');
    });

	jQuery('.lp_select_template').click(function(){
		var template = jQuery(this).attr('id');
		var label = jQuery(this).attr('label');
        jQuery("#template-box.default_template_highlight").removeClass("default_template_highlight");
        var selected_template_id = "#" + template;
        var currentlabel = jQuery(".currently_selected").show();
        jQuery(selected_template_id).parent().addClass("default_template_highlight").prepend(currentlabel);
		jQuery(".lp-template-selector-container").fadeOut(500,function(){
			jQuery(".wrap").fadeIn(500, function(){
			});
		});
        jQuery(current_template_meta).appendTo("#template-display-options");
		jQuery('#lp_metabox_select_template h3').first().html('Current Active Template: '+label);
		jQuery('#lp_select_template').val(template);
        jQuery(".Old-Template").hide();
        var current_template = jQuery("input#lp_select_template ").val();
        var current_template_meta = "#lp_" + current_template + "_custom_meta_box";
        var current_template_h3 = "#lp_" + current_template + "_custom_meta_box h3";
        var current_template_div = "#lp_" + current_template + "_custom_meta_box .handlediv";
        jQuery(current_template_div).css("display","none");
        jQuery(current_template_h3).css("background","#f8f8f8");
        jQuery(current_template_meta).show().appendTo("#template-display-options").removeClass("postbox").addClass("Old-Template");
		//alert(template);
		//alert(label);
	});

    jQuery('#lp-cancel-selection').click(function(){
        jQuery(".lp-template-selector-container").fadeOut(500,function(){
            jQuery(".wrap").fadeIn(500, function(){
            });
        });

    });
	// Colorpicker fix
    jQuery('.jpicker').one('mouseenter', function () {
        jQuery(this).jPicker({
            window: // used to define the position of the popup window only useful in binded mode
            {
                title: null, // any title for the jPicker window itself - displays "Drag Markers To Pick A Color" if left null
                position: {
                    x: 'screenCenter', // acceptable values "left", "center", "right", "screenCenter", or relative px value
                    y: 'center', // acceptable values "top", "bottom", "center", or relative px value
                },
                expandable: false, // default to large static picker - set to true to make an expandable picker (small icon with popup) - set
                // automatically when binded to input element
                liveUpdate: true, // set false if you want the user to click "OK" before the binded input box updates values (always "true"
                // for expandable picker)
                alphaSupport: false, // set to true to enable alpha picking
                alphaPrecision: 0, // set decimal precision for alpha percentage display - hex codes do not map directly to percentage
                // integers - range 0-2
                updateInputColor: true // set to false to prevent binded input colors from changing
            }
        })
    });
    if (jQuery(".lp-template-selector-container").css("display") == "none"){
        jQuery(".currently_selected").hide(); }
    else {
        jQuery(".currently_selected").show();
    }

    // Add current title of template to selector
    var selected_template = jQuery('#lp_select_template').val();
    var selected_template_id = "#" + selected_template;
    var currentlabel = jQuery(".currently_selected");
    jQuery(selected_template_id).parent().addClass("default_template_highlight").prepend(currentlabel);
    jQuery("#lp_metabox_select_template h3").first().append(' - Current Active Template: <strong>' + selected_template + '</strong>')

    jQuery('#lp-change-template-button').live('click', function () {
        jQuery(".wrap").fadeOut(500,function(){
			jQuery('#templates-container').isotope();
			jQuery(".lp-template-selector-container").fadeIn(500, function(){
                jQuery(".currently_selected").show();
                jQuery('#lp-cancel-selection').show();
			});
            jQuery("#template-filter li a").first().click();
		});
    });

    // Move Primary Headline box to correct place
    var headline = jQuery('#lp-main-headline-wrap');

    headline.remove();
    jQuery('#titlediv #titlewrap').after(headline.show());

    jQuery('#lp-main-headline').live('click', function () {
        var content = jQuery('#lp-main-headline').attr('value');
        if (!content) {
            jQuery('.lp-main-headline-label').html("");
        }
    });

    jQuery('#lp-main-headline').live('blur', function () {

        var content = jQuery('#lp-main-headline').attr('value');
        if (!content) {
            //alert('here');
            jQuery('.lp-main-headline-label').html("Primary Headline");
        }
    });

    // Background Options
    jQuery('.current_lander .background-style').live('change', function () {
        var input = jQuery(".current_lander .background-style option:selected").val();
        if (input == 'color') {
            jQuery('.current_lander tr.background-color').show();
            jQuery('.current_lander tr.background-image').hide();
            jQuery('.background_tip').hide();
        }
        else if (input == 'default') {
            jQuery('.current_lander tr.background-color').hide();
            jQuery('.current_lander tr.background-image').hide();
            jQuery('.background_tip').hide();
        }
        else if (input == 'custom') {
            var obj = jQuery(".current_lander tr.background-style td .lp_tooltip");
            obj.removeClass("lp_tooltip").addClass("background_tip").html("Use the custom css block at the bottom of this page to set up custom CSS rules");
            jQuery('.background_tip').show();
        }
        else {
            jQuery('.current_lander tr.background-color').hide();
            jQuery('.current_lander tr.background-image').show();
            jQuery('.background_tip').hide();
        }

    });

    // Check BG options on page load
    jQuery(document).ready(function () {
        var input2 = jQuery(".current_lander .background-style option:selected").val();
        if (input2 == 'color') {
            jQuery('.current_lander tr.background-color').show();
            jQuery('.current_lander tr.background-image').hide();
        } else if (input2 == 'custom') {
            var obj = jQuery(".current_lander tr.background-style td .lp_tooltip");
            obj.removeClass("lp_tooltip").addClass("background_tip").html("Use the custom css block at the bottom of this page to set up custom CSS rules");
            jQuery('.background_tip').show();
        } else if (input2 == 'default') {
            jQuery('.current_lander tr.background-color').hide();
            jQuery('.current_lander tr.background-image').hide();
        } else {
            jQuery('.current_lander tr.background-color').hide();
            jQuery('.current_lander tr.background-image').show();
        }
    });

});