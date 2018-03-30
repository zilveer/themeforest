<?php
/**
 * Displays google map of contact page
 *
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

global $apollo13;

    if($apollo13->get_option('contact','contact_map') == 'on'):
?>

    <div class="map-container">
        <div id="map-canvas"></div>
    </div>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
        function initialize() {
            var latlng              = new google.maps.LatLng(<?php echo $apollo13->get_option('contact','contact_ll'); ?>),
                    m_size              = new google.maps.Size(60,51),
                    m_start_point       = new google.maps.Point(0,0),
                    m_drop_point        = new google.maps.Point(30,51),
                    markerImage         = new google.maps.MarkerImage('<?php echo A13_TPL_GFX; ?>/pointer.png', m_size, m_start_point, m_drop_point);

            var mapOptions = {
                center: latlng,
                zoom: <?php echo $apollo13->get_option('contact','contact_zoom'); ?>,
                mapTypeId: google.maps.MapTypeId.<?php echo $apollo13->get_option('contact','contact_map_type'); ?>
            };

            var map = new google.maps.Map(document.getElementById("map-canvas"),
                    mapOptions);

            var marker = new google.maps.Marker({
                position: latlng,
                flat: true,
                icon : markerImage,
                map: map,
                title: <?php echo json_encode($apollo13->get_option('contact','contact_title')); ?>
            });

            var contentString = <?php echo json_encode($apollo13->get_option('contact','contact_content')); ?>;

            var infowindow = new google.maps.InfoWindow({
                content: contentString,
                maxWidth: 250
            });

            google.maps.event.addListener(marker, 'click', function() {
                infowindow.open(map,marker);
            });
        }
        initialize();
    </script>

    <?php
    endif;

?>
