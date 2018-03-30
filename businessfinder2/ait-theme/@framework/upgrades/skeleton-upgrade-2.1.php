<?php


class AitSkeletonUpgrade21
{

	protected $errors = array();



	public function execute()
	{
		global $wpdb;

		$oldOptions = $this->getOldOptions();

		if(!$oldOptions and !$wpdb->last_error) return array();

		if(!$oldOptions and $wpdb->last_error){
			$this->errors[] = $wpdb->last_error;
			return $this->errors;
		}

		$newOptions = $this->replaceOldOptions($oldOptions);

		$this->updateOldOptions($newOptions);

		AitCache::clean();

		return $this->errors;
	}



	protected function replaceOldOptions($options)
	{
		$code = AitLangs::getCurrentLanguageCode();
		$theme = AIT_CURRENT_THEME;
		$keys = (object) array(
			'theme'    => (object) array('nontxt' => "ait_{$theme}_theme_opts",   'txt' => "ait_{$theme}_theme_opts_txt_" . $code,   'new' => "_ait_{$theme}_theme_opts"),
			'layout'   => (object) array('nontxt' => "ait_{$theme}_layout_opts",  'txt' => "ait_{$theme}_layout_opts_txt_" . $code,  'new' => "_ait_{$theme}_layout_opts%oid%"),
			'elements' => (object) array('nontxt' => "ait_{$theme}_elements_opts",'txt' => "ait_{$theme}_elements_opts_txt_" . $code,'new' => "_ait_{$theme}_elements_opts%oid%"),
		);

		$result = array();

		$types = array(
			'theme',
			'layout',
			'elements',
		);

		foreach($types as $type){

			foreach($options as $i => $option){
				if(!AitUtils::contains($option['option_name'], "_theme_") and !AitUtils::contains($option['option_name'], "_layout_") and !AitUtils::contains($option['option_name'], "_elements_")){

					if($option['option_name'] == "ait_{$theme}_local_opts_register"){
						$option['option_name'] = "_ait_{$theme}_local_opts_register";
					}
					$result[$i] = $option;
				}else{
					if(AitUtils::startsWith($option['option_name'], $keys->{$type}->nontxt) and !AitUtils::startsWith($option['option_name'], $keys->{$type}->txt)){
						$oid = str_replace($keys->{$type}->nontxt, '', $option['option_name']);
						$newKey = str_replace('%oid%', $oid, $keys->{$type}->new);
						$result[$i]['option_name'] = $newKey;
						$result[$i]['autoload'] = $option['autoload'];

						$nonTxtValue = @unserialize($option['option_value']);
						if($nonTxtValue === false){
							$this->errors[] = sprintf("Can not proccess option with key '%s', it's value is %s", print_r($option['option_name'], true), print_r($option['option_value'], true));
							continue;
						}

						$txtValue = @unserialize($this->findTxtValue($options, $keys->{$type}->txt, $oid));
						if($txtValue === false){
							$this->errors[] = sprintf("Can not proccess option with key '%s', it's value is %s", print_r($option['option_name'], true), print_r($option['option_value'], true));
							continue;
						}

						if($type == 'elements'){
							if(key((array) $nonTxtValue) == 0)
								$merged = array_replace_recursive((array) $nonTxtValue, (array) $txtValue);
							else
								$merged = array_replace_recursive((array) $txtValue, (array) $nonTxtValue);
						}else{
							$merged = array_replace_recursive($nonTxtValue, $txtValue);
						}

						$result[$i]['option_value'] = serialize($merged);
					}
				}
			}
		}

		return $result;
	}



	protected function updateOldOptions($newOptions)
	{
		global $wpdb;

		$optionsCounter = 0;

		$theme = esc_sql(AIT_CURRENT_THEME);
		$where = " `option_name` LIKE 'ait\_{$theme}\_%\_opts%'";

		$sql = "DELETE FROM {$wpdb->options} WHERE $where;";
		$result = $wpdb->query($sql);

		$errors = array();

		if($result === false and $wpdb->last_error){
			$errors = $wpdb->last_error;
		}

		foreach($newOptions as $id => $option){
			$optionsCounter++;
			$result = $wpdb->insert($wpdb->options, $option);
			if($result === false){
				$errors[] = sprintf(__('Inserting of the theme option "%s" failed.', 'ait-admin'), $option['option_name']);
			}
		}

		if(!empty($errors)){
			// 206 - Partial Content
			$code = (count($errors) != $optionsCounter) ? 206 : 0;
			$msg = $code == 0 ? __('All inserts of theme settings to the database failed.', 'ait-admin') : implode("\n\n", $errors);
			$this->errors[] = $msg;
			return false;
		}else{
			return true;
		}
	}



	protected function getOldOptions()
	{
		global $wpdb;

		$theme = esc_sql(AIT_CURRENT_THEME);
		$where = " `option_name` LIKE 'ait\_{$theme}\_%\_opts%'";
		$sql = "SELECT `option_name`, `option_value`, `autoload` FROM `{$wpdb->options}` WHERE $where;";

		return $wpdb->get_results($sql, ARRAY_A);
	}



	protected function findTxtValue($options, $key, $oid)
	{
		foreach($options as $j => $r){
			if(AitUtils::startsWith($r['option_name'], $key) and AitUtils::endsWith($r['option_name'], $oid)){
				return $r['option_value'];
			}
		}
		return 'a:0:{}';
	}
}
