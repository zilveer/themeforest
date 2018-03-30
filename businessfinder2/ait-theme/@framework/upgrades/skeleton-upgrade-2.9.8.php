<?php


class AitSkeletonUpgrade298
{

	protected $errors = array();


	protected $oldSavedSidebars;
	protected $sidebars;


	public function __construct()
	{
		wp_cache_delete('alloptions', 'options'); // will force to load new options from DB in next get_option call

		$this->oldSavedSidebars = get_option('sidebars_widgets', array());
		$this->sidebars = array();

		$sidebars = aitManager('sidebars')->getDynamicSidebars();

		foreach($sidebars as $v){
			// old id => new id
			$this->sidebars[trim($v['id'], '_')] = $v['id'];
		}
	}



	public function needsUpgrade()
	{
		foreach($this->oldSavedSidebars as $oldId => $val){
			if(isset($this->sidebars[$oldId])){
				return true;
			}
		}
		return false;
	}



	public function execute()
	{
		$new = array();
		$new['wp_inactive_widgets'] = $this->oldSavedSidebars['wp_inactive_widgets'];
		$new['array_version'] = $this->oldSavedSidebars['array_version'];

		foreach($this->oldSavedSidebars as $oldId => $val){
			if(isset($this->sidebars[$oldId])){
				$newId = $this->sidebars[$oldId];
				$new[$newId] = $val;
			}
		}

		update_option('sidebars_widgets', $new);

		return $this->errors;
	}


}
