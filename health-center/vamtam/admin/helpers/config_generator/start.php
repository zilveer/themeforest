<?php
/**
 * begin section
 */

$id = isset($slug) ? $slug : $name;
if(isset($sub)) {
	$id = "$sub $id";
}
$id = preg_replace('/[^\w]+/', '-', strtolower($id));

global $wpv_loaded_config_groups;

?>
<div class="wpv-config-group" style="<?php if($wpv_loaded_config_groups++ > 0):?>display:none<?php endif?>" id="<?php echo $id?>-tab-<?php echo $wpv_loaded_config_groups-1 ?>">
