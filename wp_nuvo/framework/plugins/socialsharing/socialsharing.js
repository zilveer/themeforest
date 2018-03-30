jQuery(window).load(function () {
	"use strict";
	/* render popover */
	jQuery('.cs_social').each(function() {
		"use strict";
		var url = jQuery(this).attr('data-url');
		countSharingInit(url, this);
	});

});
/* popover */
function renderPopover(item) {
	"use strict";
	setTimeout(function(){
		"use strict";
		var id = jQuery(item).attr('data-id');
		jQuery(item).popover({
			'placement' : 'bottom',
			'content' : jQuery(item).find('#cs_social_content_'+id+'').html(),
			'html' : true
		});
	},500);
}
/* popup facebook */
function facebookShare(id){
	"use strict";
	var item = jQuery('#cs_social_'+id+'');
	var url = item.attr('data-url');
	var window_popup = window.open( 'https://www.facebook.com/sharer/sharer.php?u='+url, "facebookWindow", "height=380,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" )
	jQuery(".cs_social").popover('hide');
	windowSocialEvent(window_popup, url, item);
	return false;
}
/* popup googlePlus */
function googlePlusShare(id){
	"use strict";
	var item = jQuery('#cs_social_'+id+'');
	var url = item.attr('data-url');
	var window_popup = window.open( 'https://plus.google.com/share?url='+url, "googlePlusWindow", "height=380,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" )
	jQuery(".cs_social").popover('hide');
	windowSocialEvent(window_popup, url, item);
	return false;
}
/* popup twitter */
function twitterShare(id){
	"use strict";
	var item = jQuery('#cs_social_'+id+'');
	var url = item.attr('data-url');
	
	var $pageTitle = item.attr('data-title');
	
	var window_popup = window.open( 'http://twitter.com/intent/tweet?text='+$pageTitle +' '+url, "twitterWindow", "height=380,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" )
	jQuery(".cs_social").popover('hide');
	windowSocialEvent(window_popup, url, item);
	return false;
}
/* popup linkedIn */
function linkedInShare(id){
	"use strict";
	var item = jQuery('#cs_social_'+id+'');
	var url = item.attr('data-url');
	
	var $pageTitle = item.attr('data-title');
	
	var window_popup = window.open( 'http://www.linkedin.com/shareArticle?mini=true&url='+url+'&title='+$pageTitle+'', "linkedInWindow", "height=380,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" )
	jQuery(".cs_social").popover('hide');
	windowSocialEvent(window_popup, url, item);
	return false;
}
/* popup pinterest */
function pinterestShare(id){
	"use strict";
	var item = jQuery('#cs_social_'+id+'');
	var url = item.attr('data-url');
	var $sharingImg = (jQuery('.single-portfolio').length > 0 && jQuery('div[data-featured-img]').attr('data-featured-img') != 'empty' ) ? jQuery('div[data-featured-img]').attr('data-featured-img') : jQuery('#ajax-content-wrap img').first().attr('src');

	var $pageTitle = item.attr('data-title');

	var window_popup = window.open( 'http://pinterest.com/pin/create/button/?url='+url+'&media='+$sharingImg+'&description='+$pageTitle, "pinterestWindow", "height=640,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" )
	jQuery(".cs_social").popover('hide');
	windowSocialEvent(window_popup, url, item);
	return false;
}
/* check clouse popup */
function windowSocialEvent(win, url, item) {
	"use strict";
	var interval = window.setInterval(function() {
        try {
            if (win == null || win.closed) {
                window.clearInterval(interval);
                countSharingInit(url, item)
            }
        }
        catch (e) {
        }
    }, 1500);
    return win;
}
/* count sharing */
function countSharingInit(url, item) {
	"use strict";
	var total = 0;
	/* facebook */
	jQuery.getJSON("http://graph.facebook.com/?id="+ url +"", function(data) {
		if((data.shares != 0) && (data.shares != undefined) && (data.shares != null)) {
			total = total + parseInt(data.shares);
			jQuery(item).find('span').html(total);
			renderPopover(item);
		} else {
			jQuery(item).find('span').html(total);
			renderPopover(item);
		}
	});
	/* twitter */
	jQuery.getJSON("http://urls.api.twitter.com/1/urls/count.json?url="+ url +"&callback=?", function(data) {
		if((data.count != 0) && (data.count != undefined) && (data.count != null)) {
			total = total + parseInt(data.count);
			jQuery(item).find('span').html(total);
			renderPopover(item);
		} else {
			jQuery(item).find('span').html(total);
			renderPopover(item);
		}
	});
	/* linkedIn */
	jQuery.getJSON("http://www.linkedin.com/countserv/count/share?url="+url+"&callback=?", function(data) {
		if((data.count != 0) && (data.count != undefined) && (data.count != null)) {
			total = total + parseInt(data.count);
			jQuery(item).find('span').html(total);
			renderPopover(item);
		} else {
			jQuery(item).find('span').html(total);
			renderPopover(item);
		}
	});
	/* pinterest */
	jQuery.getJSON("http://api.pinterest.com/v1/urls/count.json?url="+url+"&callback=?", function(data) {
		if((data.count != 0) && (data.count != undefined) && (data.count != null)) {
			total = total + parseInt(data.count);
			jQuery(item).find('span').html(total);
			renderPopover(item);
		} else {
			jQuery(item).find('span').html(total);
			renderPopover(item);
		}
	});
}