<?php header("content-type: application/x-javascript"); ?>
<?php
require_once( '../../../../wp-load.php' );
?>
<?php
if(isset($_GET['id']) && !empty($_GET['id']))
{
    $pp_contact_lat = get_option('pp_contact_lat');
    $pp_contact_long = get_option('pp_contact_long');
    $pp_contact_map_zoom = get_option('pp_contact_map_zoom');
    
    $pp_contact_info_box = get_option('pp_contact_info_box');
    $has_pp_contact_info_box = 'false';
    
    if(!empty($pp_contact_info_box))
    {
        $has_pp_contact_info_box = 'true';
    }
?>
$j(document).ready(function() {
	$j("#<?php echo $_GET['id']; ?>").gMap({ zoom: <?php echo $pp_contact_map_zoom; ?>, markers: [ { latitude: '<?php echo $pp_contact_lat; ?>', longitude: '<?php echo $pp_contact_long; ?>',popup: <?php echo $has_pp_contact_info_box; ?>, html: '<br/><h4 class="cufon"><?php echo $pp_contact_info_box; ?></h4>' } ], mapTypeControl: true, zoomControl: false, scrollwheel: false });
});
<?php
}
?>