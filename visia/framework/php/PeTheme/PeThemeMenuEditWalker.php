<?php

class PeThemeMenuEditWalker extends Walker_Nav_Menu_Edit {
	
	public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$buffer = $output;
		parent::start_el($output,$item,$depth,$args,$id);

		$options = apply_filters("pe_theme_menu_custom_fields",false,$depth,$item,$args,$id);

		$li = str_replace($buffer,"",$output);

		$item_id = esc_attr($item->ID);		
		$fields = "";

		$values = maybe_unserialize(get_post_meta($item_id,PE_THEME_META,true));

		foreach ($options as $name=>$data) {
			$optionClass = "PeThemeFormElement{$data['type']}";
			  if (isset($values[$name])) {
				  $data["value"] = $values[$name];
			  }
			$field = new $optionClass(PE_THEME_META."[$item_id]",$name,$data);
			//$item->registerAssets();
			$fields .= $field->get_render();
		}	

		$fields = sprintf('<div class="pe_theme"><div class="contents">%s</div></div>',$fields);

		$li = preg_replace('/(<div class="menu-item-settings" .+>)/','\1'.$fields,$li);

		$output = $buffer.$li;
	}

}

?>