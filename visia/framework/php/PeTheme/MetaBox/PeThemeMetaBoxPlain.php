<?php

class PeThemeMetaBoxPlain extends PeThemeMetaBox {

	protected function buildForm() {
		$data =& $this->data;
		$this->form = new PeThemeMetaBoxFormPlain($this,"pe_theme_meta[{$this->name}]",$data["content"],$data["value"]);
		$this->form->build();
	}
	
}

?>
