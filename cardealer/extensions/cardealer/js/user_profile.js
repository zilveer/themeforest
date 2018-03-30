var app_cardealer_app_user_profile = null;
jQuery(document).ready(function() {
	app_cardealer_app_user_profile = new THEMEMAKERS_APP_CARDEALER_USER_PROFILE();
	app_cardealer_app_user_profile.init();
});
//**********************************************
var THEMEMAKERS_APP_CARDEALER_USER_PROFILE = function() {
	var self = {
		init: function() {
			self.gmt_init_map(jQuery("#map_latitude").val(), jQuery("#map_longitude").val(), "google_map", parseInt(jQuery("#map_zoom").val(), 10), "ROADMAP", "", true, false, true);

			jQuery("#update_user_profile").on('click', function() {
				jQuery('#update_user_errors').hide(333);
				jQuery("#update_user_success").hide(333);

				var data = {
					'action': "app_cardealer_update_user_profile",
					'values': jQuery("#user_data").serialize()
				};
				jQuery.post(ajaxurl, data, function(response) {
					jQuery('[name="password1"]').val("");
					jQuery('[name="password2"]').val("");
					if (response == '1') {
						jQuery("#update_user_success").show(333);
					} else {
						jQuery('#update_user_errors').html(response).show(333);
					}
				});

				return false;
			});


			jQuery("#set_location").click(function() {
				var map_canvas_id = jQuery(jQuery(".google_map").eq(0)).attr('id');
				var geo = new google.maps.Geocoder;
				var address = jQuery("#location_address").val();

				geo.geocode({
					'address': address
				}, function(results, status) {
					var latitude = null;
					var longitude = null;
					//***
					if (status == google.maps.GeocoderStatus.OK) {
						latitude = results[0].geometry.location.lat();
						longitude = results[0].geometry.location.lng();
					} else {
						alert("Geocode was not successful for the following reason: " + status);
						return false;
					}

					jQuery("#" + map_canvas_id).html("");
					jQuery("#map_latitude").val(latitude);
					jQuery("#map_longitude").val(longitude);
					self.gmt_init_map(latitude, longitude, map_canvas_id, parseInt(jQuery("#map_zoom").val(), 10), "ROADMAP", "", true, false, true);
				});

				return false;
			});

			jQuery("#map_zoom").on('change', function() {
				self.gmt_init_map(jQuery("#map_latitude").val(), jQuery("#map_longitude").val(), "google_map", parseInt(jQuery(this).val(), 10), "ROADMAP", "", true, false, true);
			});

			jQuery("#map_latitude").on('change', function() {
				self.gmt_init_map(jQuery(this).val(), jQuery("#map_longitude").val(), "google_map", parseInt(jQuery("#map_zoom").val(), 10), "ROADMAP", "", true, false, true);
			});

			jQuery("#map_longitude").on('change', function() {
				self.gmt_init_map(jQuery("#map_latitude").val(), jQuery(this).val(), "google_map", parseInt(jQuery("#map_zoom").val(), 10), "ROADMAP", "", true, false, true);
			});

		},
		gmt_init_map: function(Lat, Lng, map_canvas_id, zoom, maptype, info, show_marker, show_popup, scrollwheel) {

			var latLng = new google.maps.LatLng(Lat, Lng);
			var homeLatLng = new google.maps.LatLng(Lat, Lng);

			switch (maptype) {
				case "SATELLITE":
					maptype = google.maps.MapTypeId.SATELLITE;
					break;

				case "HYBRID":
					maptype = google.maps.MapTypeId.HYBRID;
					break;

				case "TERRAIN":
					maptype = google.maps.MapTypeId.TERRAIN;
					break;

				default:
					maptype = google.maps.MapTypeId.ROADMAP;
					break;

			}

			var map;
			map = new google.maps.Map(document.getElementById(map_canvas_id), {
				zoom: zoom,
				center: latLng,
				mapTypeId: maptype,
				scrollwheel: scrollwheel
			});


			if (show_marker) {
				var marker = new google.maps.Marker({
					position: homeLatLng,
					draggable: true,
					map: map
				});
			}

			google.maps.event.addListener(marker, "dragend", function() {
				jQuery("#map_latitude").val(marker.position.lat());
				jQuery("#map_longitude").val(marker.position.lng());
			});

			google.maps.event.addListener(map, "zoom_changed", function() {
				jQuery("#map_zoom").val(map.zoom);
			});

		},
	};

	return self;
};




