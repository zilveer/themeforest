


function rnrShortcodes($) {
	
		
	/* ------------------------------------------------------------------------ */
	/* Accordion */
	/* ------------------------------------------------------------------------ */
	
	jQuery('.accordion').each(function(){
	    var acc = jQuery(this).attr("rel") * 2;
	    jQuery(this).find('.accordion-inner:nth-child(' + acc + ')').show();
	     jQuery(this).find('.accordion-inner:nth-child(' + acc + ')').prev().addClass("active");
	});
	
	jQuery('.accordion .accordion-title').click(function() {
	    if(jQuery(this).next().is(':hidden')) {
	        jQuery(this).parent().find('.accordion-title').removeClass('active').next().slideUp(200);
	        jQuery(this).toggleClass('active').next().slideDown(200);
	    }
	    return false;
	});
	
	/* ------------------------------------------------------------------------ */
	/* Alert Messages */
	/* ------------------------------------------------------------------------ */
	
	jQuery(".alert-message .close").bind('click',function(){
		jQuery(this).parent().animate({'opacity' : '0'}, 300).slideUp(300);
		return false;
	});
	
	 
	/* ------------------------------------------------------------------------ */
	/* Skillbar */
	/* ------------------------------------------------------------------------ */	
	jQuery('.skillbar').appear(function() {
		jQuery('.skillbar').each(function(){
			dataperc = jQuery(this).attr('data-perc'),
			jQuery(this).find('.skill-percentage').animate({ "width" : dataperc + "%"}, dataperc*10);
		});
	 }); 
	 

	 
	
	/* ------------------------------------------------------------------------ */
	/* Tabs */
	/* ------------------------------------------------------------------------ */
	
	jQuery('div.tabset').tabset();
	
	/* ------------------------------------------------------------------------ */
	/* Toggle */
	/* ------------------------------------------------------------------------ */
	
	if( jQuery(".toggle .toggle-title").hasClass('active') ){
		jQuery(".toggle .toggle-title.active").closest('.toggle').find('.toggle-inner').show();
	}
	
	jQuery(".toggle .toggle-title").click(function(){
		if( jQuery(this).hasClass('active') ){
			jQuery(this).removeClass("active").closest('.toggle').find('.toggle-inner').slideUp(200);
		}
		else{
			jQuery(this).addClass("active").closest('.toggle').find('.toggle-inner').slideDown(200);
		}
	});

/* EOF document.ready */

};

/* Tabset Function ---------------------------------- */
(function (jQuery) {
jQuery.fn.tabset = function () {
    var jQuerytabsets = jQuery(this);
    jQuerytabsets.each(function (i) {
        var jQuerytabs = jQuery('li.tab a', this);
        jQuerytabs.click(function (e) {
            var jQuerythis = jQuery(this);
                panels = jQuery.map(jQuerytabs, function (val, i) {
                    return jQuery(val).attr('href');
                });
            jQuery(panels.join(',')).hide();
            jQuerytabs.removeClass('selected');
            jQuerythis.addClass('selected').blur();
            jQuery(jQuerythis.attr('href')).show();
            e.preventDefault();
            return false;
        }).first().triggerHandler('click');
    });
};

    //img overlays
    jQuery('.team-thumb').on('mouseover', function()
    {
        var overlay = jQuery(this).find('.team-overlay');
        var content = jQuery(this).find('.overlay-content');

        overlay.stop(true,true).fadeIn(600);
        content.stop().animate({'top': "40%",
			                     opacity:1 }, 600);
        
    }).on('mouseleave', function()
    {
        var overlay = jQuery(this).find('.team-overlay');
        var content = jQuery(this).find('.overlay-content');
        
        content.stop().animate({'top': "60%",
			                     opacity:0  }, 300, function(){
			content.css('top',"20%")});
			
        overlay.fadeOut(300);
		
    }); 
	
    jQuery('a.modal-popup-link').bind('click',function(){
	   jQuery(window).trigger("scroll");
	});
	
	/* ------------------------------------------------------------------------ */
	/* TEAM MODAL
	/* ------------------------------------------------------------------------ */	
		jQuery('.modal').each(function(){
			jQuery(this).appendTo("body");
		});	
		
		
	jQuery('.milestone-counter').appear(function() {
		jQuery('.milestone-counter').each(function(){
			dataperc = jQuery(this).attr('data-perc'),
			jQuery(this).find('.milestone-count').delay(6000).countTo({
            from: 0,
            to: dataperc,
            speed: 2000,
            refreshInterval: 100
        });
     });
    });		
	
	
	/* element effects
	================================================== */
	jQuery('.rnr-animate').appear(function() {			
		var effect = jQuery(this).data('effect');			
		jQuery(this).delay(50).queue( function() {				
			jQuery(this).removeClass('rnr-animate').addClass( effect );				
		});
		
				  
	});	
	
		/* Youtube WMODE
		================================================== */
		jQuery('iframe').each(function() {
			
			var url = jQuery(this).attr("src");
			
			if ( url!=undefined ) {
				
				var youtube   = url.search("youtube"),			
					splitable = url.split("?");
				
				/* url has already vars */	
				if( youtube > 0 && splitable[1] ) {
					jQuery(this).attr("src",url+"&wmode=transparent")
				}
				
				/* url has no vars */
				if( youtube > 0 && !splitable[1] ) {
					jQuery(this).attr("src",url+"?wmode=transparent")
				}
			
			}
			
		});

	
})(jQuery);

/* ------------------------------------------------------------------------ */
/* EOF */
/* ------------------------------------------------------------------------ */