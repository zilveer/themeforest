<?php
function webnus_checklist_custom_param($settings, $value) {

   $output = '<div class="webnus_checklistbox_container" style="border:2px solid #ccc; width:100%; height: 100px; overflow-y: scroll;display:block">';
   $output .= '<input id="webnus_checklist" name="'.$settings['param_name']
             .'" class="wpb_vc_param_value wpb-textinput '
             .$settings['param_name'].' '.$settings['type'].'_field" type="hidden" value="'
             .$value.'">';
   
   if(is_array($settings['value']))
   	$params = $settings['value'];
   else {
       $params = array();
   }
   
   // For check the checkboxes in load,select previous values
   $values = array();
   
   if(!empty($value))
   		$values  = explode(',', $value);
   
   
   
   foreach($params as $param=>$val){
   	 	
	if(in_array($val, $values))	
   	 	$output .= "<p><input checked='checked' type='checkbox' name='{$settings['param_name']}' value='$val' class='checkbox webnus_checklist' /> <span style='display:width:90%'>$param </span></p>";
	else
		$output .= "<p><input  type='checkbox' name='{$settings['param_name']}' value='$val' class='checkbox webnus_checklist' /> <span style='display:width:90%'>$param </span></p>";	
   }
   $output .= '</div>';
   
   $output .= '<script type="text/javascript">jQuery(document).ready(function(){
   	
	jQuery(".webnus_checklist").click(function(){
		
		
	
	
	var listbox_values = [];
	
	jQuery(".webnus_checklist:checked").each(function(index){
		
		listbox_values.push(jQuery(this).val());
		
	});
	
	jQuery("#webnus_checklist").val(listbox_values);
	
	});
	
   });</script>';
   
   return $output;
}
vc_add_shortcode_param('checklist', 'webnus_checklist_custom_param');
?>