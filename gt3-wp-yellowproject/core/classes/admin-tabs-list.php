<?php

/**
* Tab class
*/
class Tab
{
	private $link_template = '
		<li class="l-mix-tabs-item" id="{$ID}">
			<a class="l-mix-tab-title" href="#{$ID}" data-tabname="{$ID}">
				<img src="{$ICON}" class="l-mix-tabs-icon default" alt="" />
				<img src="{$ICON_ACTIVE}" class="l-mix-tabs-icon active" alt="" />
				<img src="{$ICON_HOVER}" class="l-mix-tabs-icon hover" alt="" />
				<span>{$NAME}</span>
			</a>
		</li>';
	
	private $link_vars = array(
		'{$ID}',
		'{$ICON}',
		'{$ICON_ACTIVE}',
		'{$ICON_HOVER}',
		'{$NAME}'
	);
	
	private $desc_template = '<h3 class="mix-tab-content_title">Description</h3>
		<div class="mix-tab-content_desc">
		{$DESC}
	</div>';
	
	private $desc_vars = array(
		'{$DESC}'
	);
	
	private $tab_template = '<div class="mix-tab {$ID}">
		<!--h2 class="mix-tab_title">{$NAME}</h2-->
		<div class="mix-tab-content">
			{$DESC}
		<div class="mix-tab-controls">
			{$OPTIONS}
		</div> <!-- .mix-tab-controls -->
		</div> 
		</div>';
	
	private $tab_vars = array(
		'{$ID}',
		'{$NAME}',
		'{$DESC}',
		'{$OPTIONS}'
	);
	
	private $info = array(
		'name'        => 'Tab',
		'icon'        => '',
		'icon_active'     => '',
		'icon_hover'     => '',
		'description' => ''
	);
	
	private $options = array();
	
	private $id = NULL;
	
	public function __construct(Array $tab_info, Array $options)
	{
		$this->info = array_merge($this->info, $tab_info);
		$this->options = $options;
		$this->id = sanitize_title($this->info['name'], 'tab');
	}
	
	public function render_link()
	{
		return str_replace($this->link_vars, array(
			$this->id,
			get_template_directory_uri() . '/core/admin/img/icons/' .$this->info['icon'],
			get_template_directory_uri() . '/core/admin/img/icons/' .$this->info['icon_active'],
			get_template_directory_uri() . '/core/admin/img/icons/' .$this->info['icon_hover'],
			htmlspecialchars($this->info['name'])
		), $this->link_template);
	}
	
	public function render_tab()
	{
		$options = array();
		foreach ($this->options as $option) {
			$options[] = $option->render();
		}
		
		// desc
		if (!empty($this->info['desc'])) {
			$desc = str_replace($this->desc_vars, array(
				htmlspecialchars($this->info['desc'])
			), $this->desc_template);
		}else{
			$desc = '';
		}
		
		return str_replace($this->tab_vars, array(
			$this->id,
			htmlspecialchars($this->info['name']),
			$desc,
			implode(' ', $options)
		), $this->tab_template);
	}
	
	public function save()
	{
		if (count($this->options) == 0) {
			return FALSE;
		}
		
		$arr_data = array();
		foreach ($this->options as $opt) {
			if (empty($opt->params['id'])) {
				continue;
			}
			
			if(isset($_REQUEST[$opt->params['id']])){
				$as_array = (isset($opt->params['as_array']))?$opt->params['as_array']:FALSE;
				if ($as_array) {
					$arr_data[$as_array][$opt->params['id']] = $_REQUEST[$opt->params['id']];
				}else{
					update_theme_option($opt->params['id'], $_REQUEST[$opt->params['id']]);
				}
			}else{
				switch (get_class($opt)) {
					case 'CheckboxOption':
						update_theme_option($opt->params['id'], 0);
						break;
					
					default:
						delete_theme_option($opt->params['id']);
						break;
				}
			}
		}
		
		// save array data
		foreach ($arr_data as $arr_name => $arr_value) {
			update_theme_option($arr_name, $arr_value);
		}
		
		return TRUE;
	}
	
	public function reset($default = FALSE)
	{
		if (count($this->options) == 0) {
			return FALSE;
		}
		
		if ($default) {
			$arr_data = array();
			foreach ($this->options as $opt) {
				if (empty($opt->params['id'])) {
					continue;
				}
				
				$as_array = (isset($opt->params['as_array']))?$opt->params['as_array']:FALSE;
				if ($as_array) {
					$arr_data[$as_array][$opt->params['id']] = $opt->params['default'];
				}else{
					update_theme_option($opt->params['id'], $opt->params['default']);
				}
			}
			
			// save array data
			foreach ($arr_data as $arr_name => $arr_value) {
				update_theme_option($arr_name, $arr_value);
			}
		}else{
			$arr_data = array();
			foreach ($this->options as $opt){
				if (empty($opt->params['id'])) {
					continue;
				}

				$as_array = (isset($opt->params['as_array']))?$opt->params['as_array']:FALSE;
				if ($as_array) {
					$arr_data[$as_array][] = $opt->params['id'];
				}else{
					delete_theme_option($opt->params['id']);
				}
			}

			foreach ($arr_data as $arr => $keys) {
				$temp = get_theme_option($arr, array());
				foreach ($keys as $key) {
					unset($temp[$key]);
				}
				update_theme_option($arr, $temp);
			}
		}
		
		return TRUE;
	}
	
	public function id()
	{
		return $this->id;
	}
}


/**
* end of file
*/
?>