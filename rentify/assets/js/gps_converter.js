var $ = jQuery.noConflict();
var shortname = 'glocal';

jQuery(document).ready(function() { if (jQuery("#map_canvas").length) { loader(); } });

function loader() {

    var geocoder;
    var map;
    var marker;
    var zoom;
    var start_lat = jQuery("#_sb_property_address_lat").val();
    var start_lng = jQuery("#_sb_property_address_lng").val();

    if ((start_lat == 0 ) && (start_lng == 0)) {
        zoom = 5;
    } else {
        zoom = 15;
    }
    var latlng = new google.maps.LatLng(start_lat,start_lng);
    var options = {
        zoom: zoom,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("map_canvas"), options);

    marker = new google.maps.Marker({
        map: map,
        draggable: true
    });
    var location = new google.maps.LatLng(start_lat, start_lng);
    marker.setPosition(location);
    map.setCenter(location);

    geocoder = new google.maps.Geocoder();
    google.maps.event.addListener(marker, 'drag', function() {
        $("#_sb_property_address_lat").val(marker.getPosition().lat());
        $("#_sb_property_address_lng").val(marker.getPosition().lng());
    });
    google.maps.event.addListener(marker, 'mouseup', function() {
        geocoder.geocode({latLng: marker.getPosition(), region: 'en' }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results) {
                    //console.log(results.length);
                    var marker_country = false, marker_region = false, marker_address = false, marker_zip = false;
                    $("#_sb_property_address_country_name").val(" ");
                    $("#_sb_property_address_region_name").val(" ");
                    $("#_sb_property_address_name").val(" ");
                    $("#_sb_property_address_zip").val(" ");
                    for (var index_res=0; index_res <= (results.length - 1); index_res++) {
                        //console.log(results[index_res].address_components.length);
                        for (var index_count=0; index_count <= (results[index_res].address_components.length - 1); index_count++) {
                            //console.log(results[index_res].address_components[index_count].types[0]);
                            //console.log(results[index_res].address_components[index_count].long_name);
                            if ((results[index_res].address_components[index_count].types[0] == "country") && (marker_country == false)) {
                                $("#_sb_property_address_country_name").val(results[index_res].address_components[index_count].long_name);
                                marker_country = true;
                            }
                            if ((results[index_res].address_components[index_count].types[0] == "administrative_area_level_1") && (marker_region == false)) {
                                $("#_sb_property_address_region_name").val(results[index_res].address_components[index_count].long_name);
                                marker_region = true;
                            }
                            if ((results[index_res].address_components[index_count].types[0] == "locality") && (marker_region == true)) {
                                $("#_sb_property_address_region_name").val(results[index_res].address_components[index_count].long_name);
                                marker_region = true;
                            }
                            if ((results[index_res].address_components[index_count].types[0] == "postal_code") && (marker_zip == false)) {
                                $("#_sb_property_address_zip").val(results[index_res].address_components[index_count].long_name);
                                marker_zip = true;
                            }
                        }
                    }
                    for (index_count=0; index_count <= (results[0].address_components.length - 1); index_count++) {
                        if ((results[0].address_components[index_count].types[0] != "country") &&
                            (results[0].address_components[index_count].types[0] != "administrative_area_level_1") &&
                            (results[0].address_components[index_count].types[0] != "administrative_area_level_2") &&
                            (results[0].address_components[index_count].types[0] != "administrative_area_level_3") &&
                            (results[0].address_components[index_count].types[0] != "locality")) {
                            if ($("#_sb_property_address_name").val() == " ") { $("#_sb_property_address_name").val(results[0].address_components[index_count].long_name); }
                            else { $("#_sb_property_address_name").val($("#_sb_property_address_name").val() + ", " + results[0].address_components[index_count].long_name); }
                        }
                    }
                    if ((marker_country == true) || (marker_region == true) || (marker_address == true)) {
                        $("#glocal_convert_gps_log").html('<span style="color: green;">Geocode was successful. Status: ' + status + '</span>');
                    }
                }
            } else {
                $("#glocal_convert_gps_log").html('<span style="color: red;">Error! Geocode was not successful for the following reason: ' + status + '</span>');
            }
        });
    });
}

$('#_sb_property_address_convert_zip').click(function(){

     var geocoder, geocoder_drag;
    var map;
    var start_lat = jQuery("#_sb_property_address_lat").val();
    var start_lng = jQuery("#_sb_property_address_lng").val();
    var country = $("#_sb_property_address_country_name").val();
    var region = $("#_sb_property_address_region_name").val();
    var address = $("#_sb_property_address_name").val();
    var zip = $("#_sb_property_address_zip").val();
    var full_address = zip + ' ' + country + ' ' + region + ' ' + address;

    geocoder = new google.maps.Geocoder();
    geocoder.geocode( { address: full_address, region: 'en'}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {

            var latlng = new google.maps.LatLng(start_lat,start_lng);
            var options = {
                zoom: 15,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            map = new google.maps.Map(document.getElementById("map_canvas"), options);
            map.setCenter(results[0].geometry.location);

            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location,
                draggable: true
            });
            $('#_sb_property_address_lat').val(results[0].geometry.location.lat());
            $('#_sb_property_address_lng').val(results[0].geometry.location.lng());
            $("#glocal_convert_gps_log").html("Geocode was successful. Status: " + status);

            geocoder_drag = new google.maps.Geocoder();
            google.maps.event.addListener(marker, 'drag', function() {
                $('#_sb_property_address_lat').val(marker.getPosition().lat());
                $('#_sb_property_address_lng').val(marker.getPosition().lng());
            });
            google.maps.event.addListener(marker, 'mouseup', function() {
                geocoder_drag.geocode({latLng: marker.getPosition(), region: 'en'}, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results) {
                            //console.log(results.length);
                            var marker_country = false, marker_region = false, marker_address = false, marker_zip = false;
                            $("#_sb_property_address_country_name").val(" ");
                            $("#_sb_property_address_region_name").val(" ");
                            $("#_sb_property_address_name").val(" ");
                            $("#_sb_property_address_zip").val(" ");
                            for (var index_res=0; index_res <= (results.length - 1); index_res++) {
                                //console.log(results[index_res].address_components.length);
                                for (var index_count=0; index_count <= (results[index_res].address_components.length - 1); index_count++) {
                                    //console.log(results[index_res].address_components[index_count].types[0]);
                                    //console.log(results[index_res].address_components[index_count].long_name);
                                    if ((results[index_res].address_components[index_count].types[0] == "country") && (marker_country == false)) {
                                        $("#_sb_property_address_country_name").val(results[index_res].address_components[index_count].long_name);
                                        marker_country = true;
                                    }
                                    if ((results[index_res].address_components[index_count].types[0] == "administrative_area_level_1") && (marker_region == false)) {
                                        $("#_sb_property_address_region_name").val(results[index_res].address_components[index_count].long_name);
                                        marker_region = true;
                                    }
                                    if ((results[index_res].address_components[index_count].types[0] == "locality") && (marker_region == true)) {
                                        $("#_sb_property_address_region_name").val(results[index_res].address_components[index_count].long_name);
                                        marker_region = true;
                                    }
                                    if ((results[index_res].address_components[index_count].types[0] == "postal_code") && (marker_zip == false)) {
                                        $("#_sb_property_address_zip").val(results[index_res].address_components[index_count].long_name);
                                        marker_zip = true;
                                    }
                                }
                            }
                            for (index_count=0; index_count <= (results[0].address_components.length - 1); index_count++) {
                                if ((results[0].address_components[index_count].types[0] != "country") &&
                                    (results[0].address_components[index_count].types[0] != "administrative_area_level_1") &&
                                    (results[0].address_components[index_count].types[0] != "administrative_area_level_2") &&
                                    (results[0].address_components[index_count].types[0] != "administrative_area_level_3") &&
                                    (results[0].address_components[index_count].types[0] != "locality")) {
                                    if ($("#_sb_property_address_name").val() == " ") { $("#_sb_property_address_name").val(results[0].address_components[index_count].long_name); }
                                    else { $("#_sb_property_address_name").val($("#_sb_property_address_name").val() + ", " + results[0].address_components[index_count].long_name); }
                                }
                            }
                            if ((marker_country == true) || (marker_region == true) || (marker_address == true)) {
                                $("#glocal_convert_gps_log").html('<span style="color: green;">Geocode was successful. Status: ' + status + '</span>');
                            }
                        }
                    } else {
                        $("#glocal_convert_gps_log").html('<span style="color: red;">Error! Geocode was not successful for the following reason: ' + status + '</span>');
                    }
                });
            });
        } else {
            $("#glocal_convert_gps_log").html('<span style="color: red;">Error! Geocode was not successful for the following reason: ' + status + '</span>');
        }
    });


});
