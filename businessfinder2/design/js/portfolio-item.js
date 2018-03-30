
function portfolioSingleToggles(){
	jQuery('.local-toggles.type-accordion').accordion({ heightStyle: "content" });
}

function portfolioSingleEasySlider(ratio){
	var pRatio = ratio.split(':');
	var width = jQuery('.detail-thumbnail-slider').width();
	var height = (width / parseInt(pRatio[0])) * parseInt(pRatio[1]);

	jQuery('.detail-thumbnail-slider ul li iframe').each(function(){
		jQuery(this).attr({'width': width, 'height': height});
	});

	var portfolioSingleEasySlider = jQuery('.detail-thumbnail-slider ul').bxSlider({
		pagerCustom: ".easy-slider-pager",
		useCSS: false,
		adaptiveHeight: true,
		nextText: "",
		prevText: "",
		onSliderLoad: function(currentIndex){
			/*var width = jQuery('.detail-thumbnail-slider ul li:first').width();
			var height = (width / parseInt(pRatio[0])) * parseInt(pRatio[1]);
			jQuery('.detail-thumbnail-slider ul li iframe').each(function(){
				jQuery(this).attr({'width': width, 'height': height});
			});*/

			jQuery('.detail-thumbnail-slider').find('ul').delay(500).animate({'opacity':1}, 500, function(){
				jQuery('.detail-thumbnail-slider').find('.loading').fadeOut('fast');
				jQuery.waypoints('refresh');
			});
		},
		onSlideAfter: function($slideElement, oldIndex, newIndex){
			var container = jQuery($slideElement.prevObject[oldIndex]);
			var element = container.find('iframe');
			if(typeof element.attr('id') != "undefined"){
				container.html(container.html());
			}
		}
	});

	jQuery(document).bind('cbox_open', function(){
		// set opacity to 0
		jQuery('.detail-thumbnail-slider ul').parent().css({'opacity': '0'});
	});

	jQuery(document).bind('cbox_closed', function(){
		var portfolioSliderStyle = jQuery('.detail-thumbnail-slider ul').attr('style');
		jQuery('.detail-thumbnail-slider ul').delay(50).queue(function(next){
			jQuery('.detail-thumbnail-slider ul').removeAttr('style');
			next();
		});
		jQuery('.detail-thumbnail-slider ul').delay(25).queue(function(next){
			jQuery('.detail-thumbnail-slider ul').attr('style', portfolioSliderStyle);
			jQuery('.detail-thumbnail-slider ul').parent().css({'opacity': '1'});
			next();
		});
	});
}
