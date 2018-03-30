<script id="{$htmlId}-script">
jQuery(document).ready(function(){

	{if $options->theme->general->progressivePageLoading}
		if(!isResponsive(1024)){
			jQuery("#{!$htmlId}-main").waypoint(function(){
				jQuery("#{!$htmlId}-main").addClass('load-finished');
			}, { triggerOnce: true, offset: "95%" });
		} else {
			jQuery("#{!$htmlId}-main").addClass('load-finished');
		}
	{else}
		jQuery("#{!$htmlId}-main").addClass('load-finished');
	{/if}


	var select2Settings = {
		dropdownAutoWidth : true
	};

	jQuery('#{!$htmlId}').find('select').select2(select2Settings).on("select2-close", function() {
		// fired to the original element when the dropdown closes
		jQuery('.select2-drop').removeClass('select2-drop-active');

		// replace all &nbsp;
		var regPattern = "&nbsp;";
		jQuery('#{!$htmlId} .category-search .select2-chosen').html(jQuery('#{!$htmlId} .category-search .select2-chosen').html().replace(new RegExp(regPattern, "g"), ''));
		jQuery('#{!$htmlId} .location-search .select2-chosen').html(jQuery('#{!$htmlId} .location-search .select2-chosen').html().replace(new RegExp(regPattern, "g"), ''));

		jQuery('.select2-drop').removeClass('select-position-first').removeClass('select-position-last');
	});

	jQuery('#{!$htmlId}').find('select').select2(select2Settings).on("select2-loaded", function() {
		// fired to the original element when the dropdown closes
		jQuery('#{!$htmlId}').find('.select2-container').removeAttr('style');
	});

	jQuery('#{!$htmlId}').find('select').select2(select2Settings).on("select2-open", function() {
		var selectPosition = jQuery('#{!$htmlId}').find('.select2-dropdown-open').parent().attr('data-position');
		jQuery('.select2-drop').addClass('select-position-'+selectPosition);
	});

	if(isMobile()){
		jQuery('#{!$htmlId} .category-search-wrap').find('select').select2(select2Settings).on("select2-selecting", function(val, choice) {
			if(val != ""){
				jQuery('#{!$htmlId}').find('.category-clear').addClass('clear-visible');
			}
		});
		jQuery('#{!$htmlId} .location-search-wrap').find('select').select2(select2Settings).on("select2-selecting", function(val, choice) {
			if(val != ""){
				jQuery('#{!$htmlId}').find('.location-clear').addClass('clear-visible');
			}
		});

		jQuery('#{!$htmlId} .category-search-wrap').find('select').select2(select2Settings).on("select2-selecting", function(val, choice) {
			if(val != ""){
				// add class
				jQuery('#{!$htmlId} .category-search-wrap').addClass('option-selected');
			}
		});
		jQuery('#{!$htmlId} .location-search-wrap').find('select').select2(select2Settings).on("select2-selecting", function(val, choice) {
			if(val != ""){
				jQuery('#{!$htmlId} .location-search-wrap').addClass('option-selected');
			}
		});
	} else {
		jQuery('#{!$htmlId} .category-search-wrap').find('select').select2(select2Settings).on("select2-selecting", function(val, choice) {
			if(val != ""){
				// add class
				jQuery('#{!$htmlId} .category-search-wrap').addClass('option-selected');
			}
		});
		jQuery('#{!$htmlId} .location-search-wrap').find('select').select2(select2Settings).on("select2-selecting", function(val, choice) {
			if(val != ""){
				jQuery('#{!$htmlId} .location-search-wrap').addClass('option-selected');
			}
		});

		jQuery('#{!$htmlId}').find('.category-search-wrap').hover(function(){
			if(jQuery(this).find('select').select2("val") != ""){
				jQuery(this).find('.category-clear').addClass('clear-visible');
			}
		},function(){
			if(jQuery(this).find('select').select2("val") != ""){
				jQuery(this).find('.category-clear').removeClass('clear-visible');
			}
		});

		jQuery('#{!$htmlId}').find('.location-search-wrap').hover(function(){
			if(jQuery(this).find('select').select2("val") != ""){
				jQuery(this).find('.location-clear').addClass('clear-visible');
			}
		},function(){
			if(jQuery(this).find('select').select2("val") != ""){
				jQuery(this).find('.location-clear').removeClass('clear-visible');
			}
		});
	}

	jQuery('#{!$htmlId}').find('.select2-chosen').each(function(){
		jQuery(this).html(jQuery(this).html().replace(new RegExp("&nbsp;", "g"), ''));
	});


	if(isMobile()){
		jQuery('#{!$htmlId}').find('.radius').on('click', function(){
			jQuery(this).find('.radius-clear').addClass('clear-visible');
		});
	} else {
		jQuery('#{!$htmlId}').find('.radius').hover(function(){
			jQuery(this).find('.radius-clear').addClass('clear-visible');
		},function(){
			jQuery(this).find('.radius-clear').removeClass('clear-visible');
		});
	}

	jQuery('#{!$htmlId}').find('.category-clear').click(function(){
		jQuery('#{!$htmlId}').find('.category-search-wrap select').select2("val", "");
		jQuery(this).removeClass('clear-visible');
		// remove class selected
		jQuery('#{!$htmlId} .category-search-wrap').removeClass('option-selected');
	});
	jQuery('#{!$htmlId}').find('.location-clear').click(function(){
		jQuery('#{!$htmlId}').find('.location-search-wrap select').select2("val", "");
		jQuery(this).removeClass('clear-visible');
		// remove class selected
		jQuery('#{!$htmlId} .location-search-wrap').removeClass('option-selected');
	});



	/* RADIUS SCRIPT */


	{if $type == 4}
		var $radiusContainer = jQuery('#{!$htmlId} .radius');
		initRadius($radiusContainer);


	{else}
	var $headerMap = jQuery("#{!$elements->unsortable[header-map]->getHtmlId()}-container");

	var $radiusContainer = jQuery('#{!$htmlId} .radius');
	var $radiusToggle = $radiusContainer.find('.radius-toggle');
	var $radiusDisplay = $radiusContainer.find('.radius-display');
	var $radiusPopup = $radiusContainer.find('.radius-popup-container');

	$radiusToggle.click(function(){
		jQuery(this).removeClass('radius-input-visible').addClass('radius-input-hidden');
		$radiusContainer.find('input').each(function(){
			jQuery(this).removeAttr('disabled');
		});
		$radiusDisplay.removeClass('radius-input-hidden').addClass('radius-input-visible');
		$radiusDisplay.trigger('click');

		$radiusDisplay.find('.radius-value').html($radiusPopup.find('input').val());
		$radiusPopup.find('.radius-value').html($radiusPopup.find('input').val());
	});

	$radiusDisplay.click(function(){
		$radiusPopup.removeClass('radius-input-hidden').addClass('radius-input-visible');

		if($headerMap.length != 0){
			$headerMap.gmap3({
				getgeoloc: {
					callback: function(latLng){
						if(latLng){
							jQuery("#latitude-search").attr('value', latLng.lat());
							jQuery("#longitude-search").attr('value', latLng.lng());
							jQuery(".elm-header-map ").removeClass('deactivated');
						}
					}
				}
			});
		} else {
			navigator.geolocation.getCurrentPosition(function(position){
				jQuery("#latitude-search").attr('value', position.coords.latitude);
				jQuery("#longitude-search").attr('value', position.coords.longitude);
				jQuery(".elm-header-map ").removeClass('deactivated');
			}, function(){
				// error callback
			});
		}
	});
	$radiusDisplay.find('.radius-clear').click(function(e){
		e.stopPropagation();
		$radiusDisplay.removeClass('radius-input-visible').addClass('radius-input-hidden');
		$radiusContainer.find('input').each(function(){
			jQuery(this).attr('disabled', true);
		});
		$radiusPopup.find('.radius-popup-close').trigger('click');
		$radiusToggle.removeClass('radius-input-hidden').addClass('radius-input-visible');
		$radiusContainer.removeClass('radius-set');
	});
	$radiusPopup.find('.radius-popup-close').click(function(e){
		e.stopPropagation();
		$radiusPopup.removeClass('radius-input-visible').addClass('radius-input-hidden');
	});
	$radiusPopup.find('input').change(function(){
		$radiusDisplay.find('.radius-value').html(jQuery(this).val());
		$radiusPopup.find('.radius-value').html(jQuery(this).val());
	});

	{if $selectedRad}
	$radiusToggle.trigger('click');
	{/if}
	{/if}

	/* RADIUS SCRIPT */

	{if $type == 2}
	/* KEYWORD INPUT HACK */
	var $keywordContaier = jQuery('#{!$htmlId} #searchinput-text');
	var $keywordWidthHack = jQuery('#{!$htmlId} .search-input-width-hack');

	if($keywordContaier.val() != ""){
		$keywordWidthHack.html($keywordContaier.val());
	} else {
		$keywordWidthHack.html($keywordWidthHack.attr('data-defaulttext'));
	}
	$keywordContaier.width($keywordWidthHack.width());

	$keywordContaier.on('keyup', function(){
		if(jQuery(this).val() != ""){
			$keywordWidthHack.html(jQuery(this).val());
		} else {
			$keywordWidthHack.html($keywordWidthHack.attr('data-defaulttext'));
		}

		if($keywordWidthHack.width() <= 150){
			if(jQuery(this).val() != ""){
				$keywordContaier.width($keywordWidthHack.outerWidth(true));
			} else {
				$keywordContaier.width($keywordWidthHack.width());
			}
		}
	});
	/* KEYWORD INPUT HACK */
	{/if}

	{if $type == 3}
	jQuery('#{!$htmlId} .category-search-wrap .category-icon').on('click', function(){
		jQuery(this).parent().find('select').select2('open');
	});
	jQuery('#{!$htmlId} .location-search-wrap .location-icon').on('click', function(){
		jQuery(this).parent().find('select').select2('open');
	});
	{/if}
});



function updateRadiusText(context) {
	var value = context.value;
	jQuery(context).closest('.radius').find('.radius-value').text(value);
}

function toggleRadius(context) {
	var $container = jQuery(context).parent('.radius');
	if ($container.hasClass('radius-set')) {
		// disable radius and geolocation
		$container.find('input').each(function(){
			jQuery(this).attr('disabled', true);
		});
		$container.removeClass('radius-set');
	} else {
		// enable radius and geolocation
		$container.find('input').each(function(){
			jQuery(this).attr('disabled', false);
		});
		$container.addClass('radius-set');
		setGeoData();
	}
}

function initRadius($container) {
	if ($container.hasClass('radius-set')) {
		$container.find('input').each(function(){
			jQuery(this).attr('disabled', false);
		});
		setGeoData();
	} else {
		$container.find('input').each(function(){
			jQuery(this).attr('disabled', true);
		});
	}
}

function setGeoData() {
	if(navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
			var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
			jQuery("#latitude-search").attr('value', pos.lat());
			jQuery("#longitude-search").attr('value', pos.lng());
		});
	}

}

</script>
