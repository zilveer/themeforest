<?php
    global $customize,$is_customize_mode;
    if($customize['map']['show'] || $is_customize_mode): 
?>
<?php $data = json_encode(array("longitude"=>$customize['map']['longitude'],"latitude"=>$customize['map']['latitude'],"marker"=>$customize['map']['marker'],"tooltip"=>array("heading"=>$customize['map']['tooltip']['heading'],"content"=>$customize['map']['tooltip']['content'])));?>
<div id="map" class="awe-map <?php display_background_css('map'); ?>" data-options='<?php echo $data;?>'>
	
</div>
<?php endif; ?>