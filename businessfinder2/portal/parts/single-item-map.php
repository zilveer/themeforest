{if $meta->map['latitude'] && $meta->map['longitude']}
{if ($meta->map['latitude'] === "1" && $meta->map['longitude'] === "1") != true}
<div class="map-container">
	<div class="content" style="height: {$settings->mapHeight}px">

	</div>
	<script type="text/javascript">
	jQuery(document).ready(function(){
		var $mapContainer = jQuery('.single-ait-item .map-container');
		var $mapContent = $mapContainer.find('.content');

		$mapContent.width($mapContainer.width());

		var styles = [
			{ featureType: "landscape", stylers: [
					{ visibility: "{if $settings->mapDisplayLandscapeShow == false}off{else}on{/if}"},
				]
			},
			{ featureType: "administrative", stylers: [
					{ visibility: "{if $settings->mapDisplayAdministrativeShow == false}off{else}on{/if}"},
				]
			},
			{ featureType: "road", stylers: [
					{ visibility: "{if $settings->mapDisplayRoadsShow == false}off{else}on{/if}"},
				]
			},
			{ featureType: "water", stylers: [
					{ visibility: "{if $settings->mapDisplayWaterShow == false}off{else}on{/if}"},
				]
			},
			{ featureType: "poi", stylers: [
					{ visibility: "{if $settings->mapDisplayPoiShow == false}off{else}on{/if}"},
				]
			},
		];

		var mapdata = {
			latitude: {$meta->map['latitude']},
			longitude: {$meta->map['longitude']}
		}

		$mapContent.gmap3({
			map: {
				options: {
					center: [mapdata.latitude,mapdata.longitude],
					zoom: {!$settings->mapZoom},
					scrollwheel: false,
					styles: styles,
				}
			},
			marker: {
				values:[
					{ latLng:[mapdata.latitude,mapdata.longitude] }
		        ],
			},
		});
	});

	jQuery(window).resize(function(){
		var $mapContainer = jQuery('.single-ait-item .map-container');
		var $mapContent = $mapContainer.find('.content');

		$mapContent.width($mapContainer.width());
	});
	</script>
</div>

{/if}
{/if}