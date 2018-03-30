<script id="{$htmlId}-script" type="text/javascript">
jQuery(window).load(function(){
	{!$el->jsObject}
	{if $options->theme->general->progressivePageLoading}
		if(!isResponsive(1024)){
			jQuery("#{!$htmlId}-main").waypoint(function(){
				jQuery("#{!$htmlId}-main").addClass('load-finished');
				initEasySlider("#{!$htmlId}");
			}, { triggerOnce: true, offset: "95%" });
		} else {
			jQuery("#{!$htmlId}-main").addClass('load-finished');
			initEasySlider("#{!$htmlId}");
		}
	{else}
		jQuery("#{!$htmlId}-main").addClass('load-finished');
		initEasySlider("#{!$htmlId}");
	{/if}

	function initEasySlider(selector){
		// selector - "#{!$htmlId} ul.easy-slider"
		jQuery(selector).find('ul.easy-slider').css({'opacity':0});
		jQuery(selector).find('ul.easy-slider').bxSlider({
			mode: {$el->option("sliderMode")},
			{if $el->option("pagerType") == "thumbnails"}
			pagerCustom: selector +" .easy-slider-pager",
			{/if}
			adaptiveHeight: true,
			useCSS: false,
			auto: {if $el->option("sliderAutoplay") == "1"}true{else}false{/if},
			autoStart: {if $el->option("sliderAutoplay") == "1"}true{else}false{/if},
			pause: {$el->option("sliderAutoplayPause")*1000},
			autoHover: true,
			autoDelay: 500,
			onSliderLoad: function(currentIndex){
				// count the heights of the
				computeDescriptionHeight(selector);
				{if $el->option("sliderMode") == "horizontal"}
				//jQuery(selector).find('ul.easy-slider li:not(.bx-clone):first div.bx-caption').addClass('animation-start');
				jQuery(selector).find('ul.easy-slider li:not(.bx-clone):first div.bx-caption').delay(500).queue(function(next){
					jQuery(this).addClass('animation-start');
					next();
				});
				jQuery(selector).find('ul.easy-slider li:not(.bx-clone):first').show();
				{else}
				//jQuery(selector).find('ul.easy-slider li:first div.bx-caption').addClass('animation-start');
				jQuery(selector).find('ul.easy-slider li:first div.bx-caption').delay(500).queue(function(next){
					jQuery(this).addClass('animation-start');
					next();
				});
				jQuery(selector).find('ul.easy-slider li:first').show();
				{/if}
				jQuery(selector).find('ul.easy-slider').delay(500).animate({'opacity':1}, 500, function(){
					jQuery(selector).find('.loading').fadeOut('fast');
					if(typeof jQuery.waypoints !== "undefined"){
						jQuery.waypoints('refresh');
					}
				});
			},
			onSlideBefore: function($slideElement, oldIndex, newIndex){
				jQuery(selector).find("ul.easy-slider").children().each(function(){
					jQuery(this).find('div.bx-caption').removeClass('animation-start');
				});
			},
			onSlideAfter: function($slideElement, oldIndex, newIndex){
				if(!jQuery(selector).find("ul.easy-slider").hasClass('has-big-descriptions')){
					$slideElement.find('div.bx-caption').addClass('animation-start');
				}
			}
		});

		jQuery(window).resize(function(){
			if(!isMobile) {
				resizeSliderCaptions(selector);
			}
		});
	}

	function resizeSliderCaptions(selector){
		var container = jQuery(selector).find("ul.easy-slider");
		var sliderHeight = container.children('li.big-description:first').find('img').height();
		var biggestCaption = 0;
		var biggestCaptionGap = 0;
		// reset caption heights
		container.children('li.big-description').each(function(){
			var caption = jQuery(this).find('.bx-cap-table');
			caption.css({'height':''});
		});
		// find new biggest caption
		container.children('li.big-description').each(function(){
			var caption = jQuery(this).find('.bx-caption-desc');
			jQuery(this).css({"visibility":'hidden', 'display' : 'block'});
			var captionHeight = caption.height();
			var captionGap = caption.outerHeight(true)-caption.height();
			{if $el->option(sliderMode) == "horizontal"}
			jQuery(this).css({"visibility":'', 'display' : ''});
			{else}
			jQuery(this).css({"visibility":'', 'display' : 'none'});
			{/if}
			if(captionHeight > biggestCaption){
				biggestCaption = captionHeight;
				biggestCaptionGap = captionGap;
			}
		});

		container.children('li.big-description').each(function(){
			jQuery(this).find('.bx-caption-desc').height(biggestCaption);
		});

		if(biggestCaption != 0){
			container.parent().height(sliderHeight+biggestCaption+biggestCaptionGap);
		}
	}

	function computeDescriptionHeight(selector){
		var container = jQuery(selector).find("ul.easy-slider");
		var sliderHeight = container.children('li:not(.bx-clone):first').find('img').height();
		var biggestCaption = 0;
		var biggestCaptionGap = 0;
		var isABigDescThere = false;
		container.children('li:not(.bx-clone)').each(function(){
			var caption = jQuery(this).find('.bx-cap-table');
			jQuery(this).css({"visibility":'hidden', 'display' : 'block'});
			var captionHeight = caption.outerHeight(true);
			{if $el->option(sliderMode) == "horizontal"}
			jQuery(this).css({"visibility":'', 'display' : ''});
			{else}
			jQuery(this).css({"visibility":'', 'display' : 'none'});
			{/if}
			if(captionHeight > sliderHeight){
				jQuery(this).addClass('big-description');
				isABigDescThere = true;
			}
		});

		if(isABigDescThere){
			jQuery(selector).addClass('has-big-descriptions');
			container.children().each(function(){
				jQuery(this).addClass('big-description');
			});
		}

		// parse the new height
		container.children('li.big-description:not(.bx-clone)').each(function(){
			var caption = jQuery(this).find('.bx-caption-desc');
			jQuery(this).css({"visibility":'hidden', 'display' : 'block'});
			var captionHeight = caption.height();
			var captionGap = caption.outerHeight(true)-caption.height();
			{if $el->option(sliderMode) == "horizontal"}
			jQuery(this).css({"visibility":'', 'display' : ''});
			{else}
			jQuery(this).css({"visibility":'', 'display' : 'none'});
			{/if}
			if(captionHeight > biggestCaption){
				biggestCaption = captionHeight;
				biggestCaptionGap = captionGap;
			}
		});

		container.children('li.big-description').each(function(){
			jQuery(this).find('.bx-caption-desc').height(biggestCaption);
		});

		if(biggestCaption != 0){
			container.parent().height(sliderHeight+biggestCaption+biggestCaptionGap);
		}
	}
});
</script>
