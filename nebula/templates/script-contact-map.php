<?php 
header("content-type: application/x-javascript");
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp.'/wp-load.php' );
?>

<?php
    $pp_contact_lat = get_option('pp_contact_lat');
    $pp_contact_long = get_option('pp_contact_long');
    $pp_contact_map_zoom = get_option('pp_contact_map_zoom');
    $pp_contact_map_popup = get_option('pp_contact_map_popup');
    $pp_contact_map_type = get_option('pp_contact_map_type');
    if(empty($pp_contact_map_type))
    {
	    $pp_contact_map_type = 'MapTypeId.TERRAIN';
    }
?>
    jQuery(document).ready(function(){ 
        jQuery("#map_contact").gMap({ zoom: <?php echo $pp_contact_map_zoom; ?>, markers: [ { latitude: '<?php echo $pp_contact_lat; ?>', longitude: '<?php echo $pp_contact_long; ?>', html: "<?php echo $pp_contact_map_popup; ?>", popup: true } ], mapTypeControl: false, zoomControl: false, scrollwheel: false, maptype: google.maps.<?php echo $pp_contact_map_type; ?> });
    });