<div id="map_canvas"></div>
<?php
$map_lati = get_option('theme_map_lati');
$map_longi = get_option('theme_map_longi');
$map_zoom = get_option('theme_map_zoom');

$contact_address = stripslashes(get_option('theme_contact_address'));
$contact_cell = get_option('theme_contact_cell');
$contact_phone = get_option('theme_contact_phone');
?>
<script type="text/javascript">
    // Google Map
    function initializeContactMap()
    {
        var officeLocation = new google.maps.LatLng(<?php echo $map_lati; ?>, <?php echo $map_longi; ?>);
        var contactMapOptions = {
            center: officeLocation,
            zoom: <?php echo $map_zoom; ?>,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: false
        };
        var contactMap = new google.maps.Map(document.getElementById("map_canvas"), contactMapOptions);
        var contactMarker = new google.maps.Marker({
            position: officeLocation,
            map: contactMap
        });
    }

    window.onload = initializeContactMap();
</script>