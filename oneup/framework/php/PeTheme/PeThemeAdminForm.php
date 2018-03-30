<?php

class PeThemeAdminForm {

	protected $master;
	protected $options;
	protected $values;
	protected $prefix;
	protected $sections;
	protected $scripts;
	protected $styles;

	public function __construct(&$master,$prefix,&$options,&$values) {
		$this->master =& $master;
		$this->prefix = $prefix;
		$this->options =& $options;
		$this->values =& $values;
	}

	public function build() {
		$options =& $this->options;
		$values =& $this->values;
		foreach ($options as $name=>$data) {
			$optionClass = "PeThemeFormElement{$data['type']}";
			if (isset($values) && isset($values->$name)) {
				$data["value"] = $values->$name;
			}
			$item = new $optionClass($this->prefix,$name,$data);
			$item->registerAssets();
			$this->sections[isset($data["section"]) ? $data["section"] : "General"][] = $item;
		}	
	}

	protected function template() {
		$logo = peTheme()->options->get("adminLogo");
		if ($logo) {
			$logo = '<img src="'.$logo.'" />';
			$link = peTheme()->options->get("adminUrl");
			if ($link) {
				$logo = '<a href="'.$link.'">'.$logo.'</a>';
			}
			$logo = '<div class="logo">'.$logo.'</div>';
		} else {
			$logo = "<br/>";
		}
		$html = <<< EOT

	<div class="pe_theme">
		$logo
		<div class="pe_theme_wrap">
			<form action="" id="theme-options" method="POST">
				<!--info bar top-->
				<div class="info top-info">
					<!--toggle tabs button-->
				</div>
				<div class="contents clearfix">
					<div id="options_tabs" class="ui-tabs ui-widget ui-widget-content clearfix">
						<ul class="options_tabs ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header">
							[TABS_HEADER]
						</ul>
						[TABS_BODY]
					</div>
				</div>
            
				<!--info bottom bar-->
				<div class="info bottom">
					<div class="notify saving"><span class="spinner"></span>Saving Changes Please Wait</div>
					<div class="notify saved">All Data Has Been Saved</div>
					<div class="notify warning">Oops An Error Has Occured</div>
					<input class="button save-options" type="submit" name="submit" value="Save All Changes">
				</div>     
				[NONCE]
			</form>
			
		</div>
	</div>
EOT;
		return $html;
	}

	protected function getNonce() {
		return wp_nonce_field('pe_theme_form','pe_theme_form_nonce',true,false);
	}

	protected function prefixID() {
		return strtr($this->prefix,"[] ","___");
	}

	protected function sectionAttr($section) {
		return strtr($section," ","_");
	}

	protected function openBodyTag($section,$count) {
		//return sprintf('<div id="%s_tab_%s" class="block ui-widget-content"%s>',$this->prefixID(),$this->sectionAttr($section),$count > 1 ? ' style="display:none"' : "");
		return sprintf('<div id="%s_tab_%s" class="block ui-widget-content %s">',$this->prefixID(),$this->sectionAttr($section),$count > 1 ? "ui-tabs-hide" : "");

	}

	protected function closeBodyTag($section,$count) {
		return sprintf('</div>');
	}

	public function getHTML() {
		$sections =& $this->sections;
		$count = 1;
		if (empty($sections)) return ""; 
		foreach ($sections as $section=>$options) {
			if ($section != "hidden") {
				$tabsHeader[] = sprintf('<li class="ui-state-default %s"><a href="#%s_tab_%s">%s</a><span class="sprite"></span></li>',$count > 1 ? "" : "ui-tabs-selected ui-state-active",$this->prefixID(),$this->sectionAttr($section),$section);
				//$tabsHeader[] = sprintf('<li class="ui-state-default %s"><a href="#%s_tab_%s">%s</a><span class="sprite"></span></li>',$count > 1 ? "" : "",$this->prefixID(),$this->sectionAttr($section),$section);
			}
			$body = array();
			foreach ($sections[$section] as $option) {
				$body[] = $option->get_render();
			}
			if ($section != "hidden") {
				$tabsContent[] = $this->openBodyTag($section,$count) . implode("",$body). $this->closeBodyTag($section,$count);
			} else {
				$tabsContent[] = '<div class="pe-option-hidden" style="display:none">'.implode("",$body)."</div>";
			
			}
			$count++;
		}

		return strtr($this->template(),array("[TABS_HEADER]"=>implode("",$tabsHeader),"[TABS_BODY]"=>implode("",$tabsContent),"[NONCE]"=>$this->getNonce()));
	}

	public function render() {
		echo $this->getHTML();
	}

}

?>
