/*
	Contact Map
*/

var map;

;(function($, window, undefined)
{
	"use strict";

	$(document).ready(function()
	{
		var initialize = function()
		{
			var bounds = new google.maps.LatLngBounds(),
				mapOptions = {
					zoom: 10,
					center: new google.maps.LatLng(0, 0),
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					scrollwheel: false
				};

			$.each(mapChords, function(i, p)
			{
				var map_point = p.map_point,
					lat_lng = new google.maps.LatLng(map_point.lat, map_point.lng);

				bounds.extend(lat_lng);
			});

			mapOptions.center = bounds.getCenter();
			map = new google.maps.Map(document.getElementById("map"), mapOptions);

			// Set Markers
			$.each(mapChords, function(i, p)
			{
				setTimeout(function()
				{
					// Pin
					var pinIcon = p.pin_image ? p.pin_image : '';
					
					if ( p.is_retina && p.pin_image ) {
						var pinIcon = new google.maps.MarkerImage( p.pin_image, null, null, null, new google.maps.Size( p.size[0]/2, p.size[1]/2) );
						
						var marker = new google.maps.Marker({
							position: new google.maps.LatLng(p.map_point.lat, p.map_point.lng),
							map: map,
							flat: true,
							icon: pinIcon
						});
						
						pinIcon = '';
					} else {					
						new google.maps.Marker({
							position: new google.maps.LatLng(p.map_point.lat, p.map_point.lng),
							map: map,
							animation: google.maps.Animation.DROP,
							icon: pinIcon
						});
					}
				}, i * 250);
			});


			// Set Center
			var zooms = [];

			$.each(mapChords, function(i, p){

				if(p.zoom_level !== '')
					zooms.push(parseInt(p.zoom_level, 10));
			});

			if(zooms.length)
				map.setZoom(zooms.reduce(function(a,b){ return a + b; }) / zooms.length);
			else
				map.fitBounds(bounds);
		};

		if(typeof google !== 'undefined')
			google.maps.event.addDomListener(window, 'load', initialize);


		// Contact Form
		$("#contact-form").on('submit', function(ev)
		{
			ev.preventDefault();

			var $form = $(this);

			if($form.data('is-busy'))
				return false;

			var fields      = $(this).serializeArray(),
				name        = $form.find('input[name="name"]'),
				subject     = $form.find('input[name="subject"]'),
				email       = $form.find('input[name="email"]'),
				message     = $form.find('textarea[name="message"]');


			// Errors
			var has_errors = [];

			$form.find('.required').each(function(i, el)
			{
				var $field = $(el);

				$field.removeClass('has-errors');

				if($field.prop('type') == 'email')
				{
					if($field.val().trim().length == 0 || ! /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test($field.val()) )
					{
						has_errors.push($field);
					}
				}
				else
				if($field.val().trim().length == 0)
				{
					has_errors.push($field);
				}
			});

			if(has_errors.length > 0)
			{
				$.each(has_errors, function(i, el)
				{
					var $field = $(el);

					if(i == 0)
					{
						$field.focus();
					}

					$field.addClass('has-errors');
				});
			}
			else // Send the message
			{
				$form.data('is-busy', true);

				var $btn = $form.find('.send-message');

				$btn.fadeTo(250, 0.25);

				$.post(ajaxurl, {action: 'lab_req_contact_token', form_data: {name: name.val(), subject: subject.val(), email: email.val(), message: message.val()}}, function(resp)
				{
					var hn = resp.split('_'),
						ver = {
							name: hn[0],
							value: hn[1]
						},
						act = {
							name: 'action',
							value: 'lab_contact_form'
						};

					fields.push(ver);
					fields.push(act);

					$.post(ajaxurl, fields, function(cresp)
					{
						if( cresp.errors === false )
						{
							$form.find('input, textarea').prop('readonly', true).fadeTo(250, .5);
							$(".form-success-message").removeClass('hidden').hide().slideDown();
							$btn.fadeTo(250, 0);
						}
						else
						{
							$form.data('is-busy', false);
							alert("An error occured during the verification of the token! Please try again");

							$btn.fadeTo(250, 1);
						}
					}, 'json');
				});
			}
		});
	});

})(jQuery, window);