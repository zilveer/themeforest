<?php

/**
* Tab class
*/
class Tabs
{
	private $template = '<div class="mix-container">
		<div class="mix-tabs-list">
			<ul class="l-mix-tabs-list">
				{$LINKS}
			</ul>
		</div>
		<div class="mix-tabs">

            <input type="hidden" id="form-tab-action" name="action" value="save" />

            {$TABS}

            <div class="theme_settings_submit_cont">
                <input type="submit" name="reset_theme_settings" class="reset_settings button danger_btn" value="Reset Settings" />
                <input type="submit" name="submit_theme_settings" class="admin_save_all button ok_btn" value="Save Settings" />
            </div>
		</div>
		<div class="clear"></div>
	</div>';
	
	private $vars = array(
		'{$LINKS}',
		'{$TABS}'
	);
	
	private $gt3_tabs = array();
	
	public function __construct()
	{
		
	}
	
	public function add(Tab $tab)
	{
		$this->tabs[] = $tab;
	}
	
	public function render()
	{
		$links = array();
		$gt3_tabs  = array();
		foreach ($this->tabs as $tab) {
			$links[] = $tab->render_link();
			$gt3_tabs[]  = $tab->render_tab();
		}
		
		return str_replace($this->vars, array(
			implode(' ', $links),
			implode(' ', $gt3_tabs)
		), $this->template);
	}
	
	public function save()
	{
		foreach ($this->tabs as $tab) {
			$tab->save();
		}
	}
	
	public function reset($tab_id)
	{
		if( strtolower($tab_id) === 'all' ) {
			foreach ($this->tabs as $tab) {
				$tab->reset(TRUE);
			}
		}else{
			foreach ($this->tabs as $tab) {
				if ($tab_id == $tab->id()) {
					$tab->reset();
				}
			}
		}
	}
	
	public function reset_to_default()
	{
		foreach ($this->tabs as $tab) {
			$tab->reset(TRUE);
		}
	}
}


/**
* end of file
*/
?>