<?php 
	
function thb_option_element( $name, $attr_option, $type, $shortcode ){
	
	$option_element = null;
	
	(isset($attr_option['desc']) && !empty($attr_option['desc'])) ? $desc = '<p class="description">'.$attr_option['desc'].'</p>' : $desc = '';
		
	switch( $attr_option['type'] ){
		
	case 'radio':
	    
		$option_element .= '<div class="row"><div class="label"><strong>'.$attr_option['title'].': </strong></div><div class="content large">';
	    foreach( $attr_option['opt'] as $val => $title ){
	    
		(isset($attr_option['def']) && !empty($attr_option['def'])) ? $def = $attr_option['def'] : $def = '';
		
		 $option_element .= '
			
		    <input type="radio" name="'.$shortcode.'-'.$name.'" value="'.$val.'" id="shortcode-option-'.$shortcode.'-'.$name.'-'.$val.'"'. ( $val == $def ? ' checked="checked"':'').'><label for="shortcode-option-'.$shortcode.'-'.$name.'-'.$val.'">'.$title.'</label>';
	    }
		
		$option_element .= $desc . '</div></div>';
		
	    break;
		
	case 'checkbox':
		
		$option_element .= '<div class="row"><div class="label"><label for="' . $name . '"><strong>' . $attr_option['title'] . ': </strong></label></div>    <div class="content large"> <input type="checkbox" class="' . $name . '" id="' . $shortcode. '-' . $name . '" />'. $desc. '</div></div>';
		
		break;	
	
	case 'select':
		
		$option_element .= '<div class="row">
		<div class="label"><label for="'.$name.'"><strong>'.$attr_option['title'].': </strong></label></div>
		
		<div class="content"><select id="'.$shortcode.'-'.$name.'">';
			$values = $attr_option['values'];
			foreach( $values as $value ){
		    	$option_element .= '<option value="'.$value.'">'.$value.'</option>';
			}
		$option_element .= '</select>' . $desc . '</div></div>';
		
		break;
		
	case 'custom':
 
		if( $name == 'tabs' ){
			$option_element .= '
			<div class="shortcode-dynamic-items" id="options-item" data-name="item">
				<div class="shortcode-dynamic-item">
					<div class="row">
					<div class="label"><label><strong>Title: </strong></label></div>
					<div class="content"><input class="shortcode-dynamic-item-input" type="text" name="" value="" /></div>
					</div>
					<div class="row">
					<div class="label"><label><strong>Tab Icon: </strong></label></div>
					<div class="content"><input class="shortcode-dynamic-item-input-icon" type="text" name="" value="" /></div>
					</div>
					<div class="row">
					<div class="label"><label><strong>Tab Content: </strong></label></div>
					<div class="content"><textarea class="shortcode-dynamic-item-text" type="text" name="" /></textarea></div>
					</div>
				</div>
			</div>
			<a href="#" class="btn yellow remove-list-item">'.__('Remove Tab' ). '</a> <a href="#" class="btn yellow add-list-item">'.__('Add Tab' ).'</a>';
			
		}
		elseif( $name == 'icon_list' ){
			$option_element .= '
			<div class="shortcode-dynamic-items" id="options-item" data-name="item">
				<div class="shortcode-dynamic-item">
					<div class="row">
					<div class="label"><label><strong>List Content: </strong></label></div>
					<div class="content"><input class="shortcode-dynamic-item-input" type="text" name="" /></div>
					</div>
				</div>
			</div>
			<a href="#" class="btn yellow remove-list-item">'.__('Remove List Item' ). '</a> <a href="#" class="btn yellow add-list-item">'.__('Add List Item' ).'</a>';
			
		} 
		elseif( $name == 'accordion' ){
			$option_element .= '
			<div class="shortcode-dynamic-items" id="options-item" data-name="item">
				<div class="shortcode-dynamic-item">
					<div class="row">
					<div class="label"><label><strong>Title: </strong></label></div>
					<div class="content"><input class="shortcode-dynamic-item-input" type="text" name="" value="" /></div>
					</div>
					<div class="row">
					<div class="label"><label><strong>Tab Content: </strong></label></div>
					<div class="content"><textarea class="shortcode-dynamic-item-text" type="text" name="" /></textarea></div>
					</div>
				</div>
			</div>
			<a href="#" class="btn yellow remove-list-item">'.__('Remove Tab' ). '</a> <a href="#" class="btn yellow add-list-item">'.__('Add Tab' ).'</a>';
			
		} 
		elseif( $name == 'image' ){
			$option_element .= '
				<div class="shortcode-dynamic-item" id="options-item" data-name="image-upload">
					<div class="row">
					<div class="label"><label><strong> '.$attr_option['title'].' </strong></label></div>
					<div class="content large">
					
					 <input type="hidden" id="options-item"  />
			         <img class="redux-opts-screenshot" id="image_url" src="" />
			         <a data-update="Select File" data-choose="Choose a File" href="javascript:void(0);"class="redux-opts-upload button-secondary" rel-id="">' . __('Upload', 'north') . '</a>
			         <a href="javascript:void(0);" class="redux-opts-upload-remove" style="display: none;">' . __('Remove Upload', 'north') . '</a>';
					
					if(!empty($desc)) $option_element .= $desc;
					
					$option_element .='
					</div>
					</div>
				</div>';
		}
		
		elseif( $name == 'background' ){
			$option_element .= '
			<div class="shortcode-dynamic-items background" id="options-item" data-name="item">		
				
				<div class="shortcode-dynamic-item">
					<div class="row">
						<div class="label"><label><strong>Background Color: </strong></label></div>
						<div class="content"><input class="shortcode-dynamic-item-input colorpicker" type="text" name="" value="" /></div>
					</div>
					<div class="row">
						<div class="label"><label><strong>Background Image: </strong></label></div>
						<div class="content">
						 <input type="hidden" id="options-item"  />
				         <img class="redux-opts-screenshot" id="redux-opts-screenshot-" src="" />
				         <a data-update="Select File" data-choose="Choose a File" href="javascript:void(0);"class="redux-opts-upload button-secondary" rel-id="">' . __('Upload', 'north') . '</a>
				         <a href="javascript:void(0);" class="redux-opts-upload-remove" style="display: none;">' . __('Remove Upload', 'north') . '</a>
						
						</div>
					</div>
					<div class="row">
						<div class="label"><label><strong>Background Position</strong></label></div>
						<div class="content">
							<select id="bg_position">
								<option value="Left Top">Left Top</option>
								<option value="Left Center">Left Center</option>
								<option value="Left Bottom">Left Bottom</option>
								<option value="Center Top">Center Top</option>
								<option value="Center Center">Center Center</option>
								<option value="Center Bottom">Center Bottom</option>
								<option value="Right Top">Right Top</option>
								<option value="Right Center">Right Center</option>
								<option value="Right Bottom">Right Bottom</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="label"><label><strong>Background Repeat</strong></label></div>
						<div class="content">
							<select id="bg_repeat">
								<option value="No-Repeat">No-Repeat</option>
								<option value="Repeat">Repeat</option>
							</select>
						</div>
					</div>
				</div>
			</div>';
		}
		elseif( $type == 'checkbox' ){
			$option_element .= '<div class="row"><div class="label"><label for="' . $name . '"><strong>' . $attr_option['title'] . ': </strong></label></div>    <div class="content large"> <input type="checkbox" class="' . $name . '" id="' . $name . '" />' . $desc . '</div></div>';
		} 
		
		
		break;
		
	case 'textarea':
		$option_element .= '<div class="row">
		<div class="label"><label for="shortcode-option-'.$name.'"><strong>'.$attr_option['title'].': </strong></label></div>
		<div class="content"><textarea id="'.$shortcode.'-'.$name.'" data-attrname="'.$name.'"></textarea> ' . $desc . '</div></div>';
		break;
			
	case 'text':
	default:
	  $option_element .= '<div class="row">
		<div class="label"><label for="shortcode-option-'.$name.'"><strong>'.$attr_option['title'].': </strong></label></div>
		<div class="content"><input class="attr" type="text" id="'.$shortcode.'-'.$name.'" data-attrname="'.$name.'" value="" />' . $desc . '</div></div>';
	  break;
    
 	case 'color':
 		$option_element .= '
		<div class="shortcode-dynamic-item" id="options-item" data-name="item">
			<div class="row">
				<div class="label"><label><strong> '.$attr_option['title'].' </strong></label></div>
				<div class="content"><input class="shortcode-dynamic-item-input colorpicker" type="text" id="'.$shortcode.'-'.$name.'" data-attrname="'.$name.'"  value="" /></div>
			</div>
		</div>';
 	   break;
    }
   
    return $option_element;
}