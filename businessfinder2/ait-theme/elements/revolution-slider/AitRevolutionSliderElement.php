<?php


class AitRevolutionSliderElement extends AitElement
{

	public function init()
	{
		$this->configuration = array(
			 'admin-css' => array(
				'ait-revlisder' => array(
					'file' => '/revslider.css',
				),
			 ),
		);

		if(is_admin()){
			add_filter('ait-backup-content-custom-tables', array($this, 'backupTables'));
		}

		if(!aitIsPluginActive('revslider')){
			add_filter("ait-allow-render-controls-elements-{$this->id}", '__return_false');
			add_filter('ait-dont-allow-render-controls-message', array($this, 'dontAllowRenderControlsMessage'), 10, 4);
		}
	}



	public function renderSlider($alias = '')
	{
		if(aitIsPluginActive('revslider')){
			if(!$alias){
				$alias = $this->option('alias');
			}

			ob_start();
			putRevSlider($alias);
			$return = ob_get_clean();

			return $return;
		}

		return '';
	}



	public function backupTables($tables)
	{
		$tables[] = "revslider_sliders";
		$tables[] = "revslider_slides";
		$tables[] = "revslider_settings";
		$tables[] = "revslider_css";
		$tables[] = "revslider_layer_animations";

		return $tables;
	}



	public function isDisplay()
	{
		return (aitIsPluginActive('revslider') and parent::isDisplay());
	}



	/**
	 * Element is disabled when depends on some CPTs but they no exists (plugin AIT Toolkit is not active)
	 * @return boolean
	 */
	public function isDisabled()
	{
		return (!aitIsPluginActive('revslider') and !parent::isEnabled());
	}



	public function dontAllowRenderControlsMessage($msg, $configType, $elementId, $oid)
	{
		if($configType == 'elements' and $elementId == 'revolution-slider'){
			return __('Revolution Slider plugin is not active', 'ait-admin');
		}

		return $msg;
	}

}
