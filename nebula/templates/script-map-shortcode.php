<?php 
header("content-type: application/x-javascript"); 
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp.'/wp-load.php' );
?>

<?php
$map_data = unserialize(stripslashes($_GET['data']));

$marker = '{';

if((!empty($map_data['lat']) && !empty($map_data['long'])) OR (!empty($map_data['address'])))
{
    if(!empty($map_data['lat']) && !empty($map_data['long']))
    {
    	$marker.= 'markers: [ { latitude: '.$map_data['lat'].', longitude: '.$map_data['long'];
    }
    elseif(!empty($map_data['address']))
    {
    	$marker.= 'markers: [ { address: "'.$map_data['address'].'"';
    }

    if(!empty($map_data['popup']))
    {
    	$marker.= ', html: "'.$map_data['popup'].'", popup: true';
    }
    $marker.= '} ], ';
}

if(!empty($map_data['type']))
{
    $marker.= 'maptype: google.maps.'.$map_data['type'].',';
}

$marker.= 'zoom: '.$map_data['zoom'];
$marker.= '}';

?>
jQuery(document).ready(function(){ jQuery("#<?php echo $map_data['id']; ?>").gMap(<?php echo $marker; ?>); });