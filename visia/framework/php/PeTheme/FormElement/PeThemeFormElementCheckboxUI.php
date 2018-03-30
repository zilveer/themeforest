<?php

class PeThemeFormElementCheckboxUI extends PeThemeFormElementCheckbox {
	
	public function registerAssets() {
		parent::registerAssets();
		wp_enqueue_script("jquery-ui-button");
		wp_enqueue_style("pe_theme_admin_ui");
	}

	protected function template() {
		$html = <<<EOT
<div class="option">
    <h4>[LABEL][TOOLTIP]</h4>
    <div class="section">
        <div class="element">
<div id="[ID]_buttonset">
[OPTIONS]
</div>
        </div>
        <div class="description">[DESCRIPTION]</div>
    </div>
	</div>[SCRIPT]
EOT;
		return $html;
	}

	public function jsInit() {
		return 'jQuery(function() {jQuery("#[ID]_buttonset").buttonset();});';
	}

	protected function addTemplateValues(&$data) {
		parent::addTemplateValues($data);
		if (!isset($this->data["noscript"])) {
			$data['[SCRIPT]'] = sprintf('<script type="text/javascript">%s</script>',str_replace("[ID]",$data['[ID]'],$this->jsInit()));
		} else {
			$data['[SCRIPT]'] = "";
		}
	}

	protected function addTemplateMarkup(&$buffer,&$options,$value,$id,$name,$single) {
		$count = 0;
		foreach ($options as $label=>$current) {
			$label = $single ? $current : $label;
			$selected = in_array($current,$value) ? " checked " : "";
			$buffer .=  '<input name="'.$name.'['.$count.']" id="'.$id.'_'.$count.'" type="checkbox" value="'.esc_attr($current).'"'.$selected.' /><label for="'.$id.'_'.$count.'">'.esc_attr($label).'</label>';
			$count++;
		}

	}


}

?>
