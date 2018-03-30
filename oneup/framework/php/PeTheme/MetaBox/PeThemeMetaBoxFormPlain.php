<?php

class PeThemeMetaBoxFormPlain extends PeThemeMetaBoxForm {
	
	protected function template() {
		$html = <<< EOT
<div class="pe_theme pe_mbox [CLASSES]">
	[TABS_BODY]
</div>
EOT;
		return $html;	
	}

	public function getHTML() {
		$sections =& $this->sections;
		foreach ($sections as $section=>$options) {
			$body = array();
			foreach ($sections[$section] as $option) {
				$body[] = $option->get_render();
			}
			$tabsContent[] = implode("",$body);
		}

		return strtr($this->template(),array("[TABS_BODY]"=>implode("",$tabsContent)));
	}

}
?>
