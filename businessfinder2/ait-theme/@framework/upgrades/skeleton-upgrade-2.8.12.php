<?php


class AitSkeletonUpgrade2812
{

	protected $errors = array();



	public function execute()
	{

		add_action('init', array($this, 'fixWidgetsFields'), 99);

		return $this->errors;
	}



	/**
	 * Removes '_en' and '_all' from the widget field names
	 */
	public function fixWidgetsFields()
	{
		foreach($GLOBALS['wp_registered_widgets'] as $widget){
			if(!empty($widget['callback'][0]) and !empty($widget['params'][0]['number'])){
				$obj = $widget['callback'][0];
				if(
					is_object($obj) and
					method_exists($obj, 'get_settings') and
					method_exists($obj, 'save_settings') and
					in_array($obj->id_base, array('ait-posts', 'ait-submenu', 'ait-items', 'ait-login', 'ait-social', 'ait-newest-item'))
				){
					$settings = $obj->get_settings();
					$number = $widget['params'][0]['number'];
					$newSettings = $settings;
					if(is_numeric($number) and isset($settings[$number])){
						foreach($settings[$number] as $key => $value){
							$newKey = $key;
							if(AitUtils::endsWith($key, '_all')){
								$newKey = substr($key, 0, -4);
							}else{
								$suffix = substr($key, -3, 3);
								if(AitUtils::startsWith($suffix, '_')){
									$newKey = substr($key, 0, -3);
								}
							}
							$newSettings[$number][$newKey] = $value;
							unset($newSettings[$number][$key]);
						}
						$obj->save_settings($newSettings);
					}
				}
			}
		}

	}

}
