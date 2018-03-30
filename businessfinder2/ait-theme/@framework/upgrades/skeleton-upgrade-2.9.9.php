<?php


class AitSkeletonUpgrade299
{

	protected $errors = array();


	protected $oldSavedSidebars;
	protected $sidebars;
	protected $register;

	public function __construct()
	{
		wp_cache_delete('alloptions', 'options'); // will force to load new options from DB in next get_option call
		$this->register = aitOptions()->getLocalOptionsRegister();
	}



	public function needsUpgrade()
	{
		return (get_option('_ait_sidebars_need_update', 'yes') === 'yes');
	}



	public function execute()
	{
		$this->fixSidebarsInLayoutOptions();
		$this->fixWidgetAreaElement();

		update_option('_ait_sidebars_need_update', 'no');
		return $this->errors;
	}



	protected function fixSidebarsInLayoutOptions()
	{
		foreach($this->register as $type => $oids){
			foreach($oids as $oid){
				$options = aitOptions()->getOptions($oid);

				if(isset($options['layout']['@sidebars']['right']['sidebar'])){
					$s = $options['layout']['@sidebars']['right']['sidebar'];
					if(!AitUtils::startsWith($s, '__') and $s !== 'none'){
						$s = '__' . $s;
						$options['layout']['@sidebars']['right']['sidebar'] = $s;
					}
				}

				if(isset($options['layout']['@sidebars']['left']['sidebar'])){
					$s = $options['layout']['@sidebars']['left']['sidebar'];
					if(!AitUtils::startsWith($s, '__') and $s !== 'none'){
						$s = '__' . $s;
						$options['layout']['@sidebars']['left']['sidebar'] = $s;
					}
				}

				$key = aitOptions()->getOptionKey('layout', $oid);
				update_option($key, $options['layout']);
			}
		}
	}



	protected function fixWidgetAreaElement()
	{
		foreach($this->register as $type => $oids){
			foreach($oids as $oid){
				$options = aitOptions()->getOptions($oid);

				$elements = $options['elements'];
				foreach($elements as $i => $element){
					foreach($element as $id => $opts){
						if($id !== 'widget-area') continue;

						if(isset($opts['area']['sidebar'])){
							if(!AitUtils::startsWith($opts['area']['sidebar'], '__') and $opts['area']['sidebar'] !== 'none'){
								$options['elements'][$i][$id]['area']['sidebar'] = '__' . $opts['area']['sidebar'];
							}else{
								continue;
							}
						}

					}
				}

				$key = aitOptions()->getOptionKey('elements', $oid);
				update_option($key, $options['elements']);
			}
		}

	}
}
