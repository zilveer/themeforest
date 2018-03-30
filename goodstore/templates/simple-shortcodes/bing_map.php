<?php global $jaw_data; ?>
    <?php

ob_start();
wp_register_script('b_maps', 'http://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=7.0', array('jquery'), false, true);
wp_enqueue_script('b_maps');
echo '
<div id="myMap_' . jaw_template_get_var('id') . '" style="position:relative; width:100%; ' . jaw_template_get_var('height') . '"></div>

<script type="text/javascript">
    var map = null;
           
    jQuery(document).ready(function(){
    
        map = new Microsoft.Maps.Map(document.getElementById("myMap_' . jaw_template_get_var('id') . '"), {credentials: "As852KbGV7lHgy9JB4_jAzTnVyeyoId2_1_k9vGRf9fvbd5WzvckkpEDDCRDCuk7",    
                                                                        disablePanning: ' . jaw_template_get_var('dragable') . ',
                                                                        disableZooming: ' . jaw_template_get_var('scrollwheel') . '});
        map.setView({zoom: ' . jaw_template_get_var('zoom') . ', center: new Microsoft.Maps.Location(' . jaw_template_get_var('latitude') . ',' . jaw_template_get_var('longitude') . ')});
        map.setView({mapTypeId : Microsoft.Maps.MapTypeId.' . jaw_template_get_var('maptype') . '});';

if (jaw_template_get_var('marker')) {
    echo 'var pushpin= new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(' . jaw_template_get_var('latitude') . ',' . jaw_template_get_var('longitude') . '), null); 
       map.entities.push(pushpin);';
}
echo '});
</script>';
echo ob_get_clean();






