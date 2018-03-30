<script id="{$htmlId}-container-script">

	jQuery(window).load(function(){
		var map;
		var mapDiv = jQuery("#{!$htmlId}-container");

		var styles = [
			{
				stylers: [
					{ hue: "{!$el->option(mapHue)}" },
					{ saturation: "{!$el->option(mapSaturation)}" },
					{ lightness: "{!$el->option(mapBrightness)}" },
				]
			},
			{ featureType: "landscape", stylers: [
					{ hue: "{!$el->option(landscapeColor)}"},
					{ saturation: "{if $el->option(landscapeColor) != ''} {!$el->option(objSaturation)} {/if}"},
					{ lightness: "{if $el->option(landscapeColor) != ''} {!$el->option(objBrightness)} {/if}"},
				]
			},
			{ featureType: "administrative", stylers: [
					{ hue: "{!$el->option(administrativeColor)}"},
					{ saturation: "{if $el->option(administrativeColor) != ''} {!$el->option(objSaturation)} {/if}"},
					{ lightness: "{if $el->option(administrativeColor) != ''} {!$el->option(objBrightness)} {/if}"},
				]
			},
			{ featureType: "road", stylers: [
					{ hue: "{!$el->option(roadsColor)}"},
					{ saturation: "{if $el->option(roadsColor) != ''} {!$el->option(objSaturation)} {/if}"},
					{ lightness: "{if $el->option(roadsColor) != ''} {!$el->option(objBrightness)} {/if}"},
				]
			},
			{ featureType: "water", stylers: [
					{ hue: "{!$el->option(waterColor)}"},
					{ saturation: "{if $el->option(waterColor) != ''} {!$el->option(objSaturation)} {/if}"},
					{ lightness: "{if $el->option(waterColor) != ''} {!$el->option(objBrightness)} {/if}"},
				]
			},
			{ featureType: "poi", stylers: [
					{ hue: "{!$el->option(poiColor)}"},
					{ saturation: "{if $el->option(poiColor) != ''} {!$el->option(objSaturation)} {/if}"},
					{ lightness: "{if $el->option(poiColor) != ''} {!$el->option(objBrightness)} {/if}"},
				]
			},
		];

		mapDiv.gmap3({
			map:{
				{if is_array($address) == false}address: "{!$address}",{/if}
				options:{
					{if is_array($address)}
					center: [{!$address['latitude']},{!$address['longitude']}],
					{/if}
					mapTypeId: google.maps.MapTypeId.{!$el->option(type)},
					zoom: {!$el->option(zoom)},
					scrollwheel: {!$scrollWheel},
					styles: styles,
				}
			},
			marker:{
				values:[
					{var $markers = $el->option(markers)}
					{if empty($markers)} {* cast empty string to empty array for cycle *}
						{var $markers = array()}
					{/if}
					{foreach $markers as $mark}
						{* JAVASCRIPT DATA VALIDATION *}
						{var $mark[address] = str_replace("\xe2\x80\xa8", '', $mark[address])}
						{var $mark[address] = str_replace("\xe2\x80\xa9", '', $mark[address])}
						{var $mark[title] = str_replace("\xe2\x80\xa8", '', $mark[title])}
						{var $mark[title] = str_replace("\xe2\x80\xa9", '', $mark[title])}
						{var $mark[description] = str_replace("\xe2\x80\xa8", '', $mark[description])}
						{var $mark[description] = str_replace("\xe2\x80\xa9", '', $mark[description])}
						{* JAVASCRIPT DATA VALIDATION *}

						{
							address: "{!$mark[address]}",
							data: {if $mark[url] != ""}"<div class=\"gmap-infowindow-content\"><a href=\"{!$mark[url]}\"><h3>{!$mark[title]}</h3><p>{!$mark[description]}</p></a></div>"{else}"<div class=\"gmap-infowindow-content\"><h3>{!$mark[title]}</h3><p>{!$mark[description]}</p></div>"{/if},
							{if $mark[icon] != ""}
							options:
							{
								icon: "{!$mark[icon]}"
							}
							{/if}
						},
					{/foreach}
				],
				options:{
					draggable: false
				},
				events:{
					click: function(marker, event, context){
						map = jQuery(this).gmap3("get"),
						infowindow = jQuery(this).gmap3({ get:{ name:"infowindow" } });
						if (infowindow){
							infowindow.open(map, marker);
							infowindow.setContent(context.data);
						} else {
							jQuery(this).gmap3({
								infowindow:{
									anchor:marker,
									options:{ content: context.data }
								}
							});
						}
					},
				},
			}
			{if is_array($address) and isset($address['streetview'])}
				{if $address['streetview']}
			, streetviewpanorama:{
				options:{
					container: jQuery("#{!$htmlId}-container"),
					opts:{
						position: new google.maps.LatLng({!$address['latitude']},{!$address['longitude']}),
						pov: {
							heading: parseInt({!$address['swheading']}),
							pitch: parseInt({!$address['swpitch']}),
							zoom: parseInt({!$address['swzoom']})
						},
						scrollwheel: {!$scrollWheel},
						panControl: false,
						enableCloseButton: true
					}
				}
			},
				{/if}
			{/if}
		});

		setTimeout(function(){
			checkTouchDevice();
		},2000);


		{if $options->theme->general->progressivePageLoading}
			if(!isResponsive(1024)){
				jQuery("#{!$htmlId}").waypoint(function(){
					jQuery("#{!$htmlId}").parent().parent().addClass('load-finished');
				}, { triggerOnce: true, offset: "95%" });
			} else {
				jQuery("#{!$htmlId}").parent().parent().addClass('load-finished');
			}
		{else}
			jQuery("#{!$htmlId}").parent().parent().addClass('load-finished');
		{/if}


		var checkTouchDevice = function() {
			if (Modernizr.touch){
				map = mapDiv.gmap3("get");
				map.setOptions({ draggable : false });
				var draggableClass = 'inactive', draggableTitle = {__ 'Activate map'};
				var draggableButton = jQuery('<div class="draggable-toggle-button '+draggableClass+'">'+draggableTitle+'</div>').appendTo(mapDiv);

				draggableButton.click(function () {
					if(jQuery(this).hasClass('active')){
						jQuery(this).removeClass('active').addClass('inactive').text({__ 'Activate map'});
						map.setOptions({ draggable : false });
					} else {
						jQuery(this).removeClass('inactive').addClass('active').text({__ 'Deactivate map'});
						map.setOptions({ draggable : true });
					}
				});
			}
		}

	});

</script>
