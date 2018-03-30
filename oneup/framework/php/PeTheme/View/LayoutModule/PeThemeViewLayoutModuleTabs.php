<?php

class PeThemeViewLayoutModuleTabs extends PeThemeViewLayoutModuleContainer {

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Tabs",'Pixelentity Theme/Plugin')
				  );
	}

	public function name() {
		return __("Tabs",'Pixelentity Theme/Plugin');
	}

	public function type() {
		return __("UI",'Pixelentity Theme/Plugin');
	}
	
	public function cssClass() {
		return "ui";
	}

	public function allowed() {
		return "tabs";
	}

	public function create() {
		return "TabsItem";
	}
	
	public function prefix() {
		return "tabs";
	}

	public function template() {
		if (!($items = empty($this->conf->items) ? false : $this->conf->items)) return;

		$t =& peTheme();

		$data = new StdClass();

		$idx = 0;
		
		$instances = $this->instances;

		foreach ($items as $item) {
			$idx++;
			$oitem = (object) $item;
			$oitem->view = $item;
			$oitem->data = (object) $oitem->data;
			$oitem->data->id = sprintf("pe-%s-item-{$instances}-{$idx}",$this->prefix());
			$data->loop[] = $oitem;
		}

		$loop = $t->data->create($data);

		$t->template->data($instances,$loop);
		peTheme()->get_template_part("viewmodule",$this->prefix());
	}

	public function tooltip() {
		return __("Use this block to add horizontally tabbed content to your layout. Each tab consists of a title and body content. The body content is only displayed when the title is clicked by the user, except in the case of the first tab, which will be open upon page load.",'Pixelentity Theme/Plugin');
	}


}

?>
