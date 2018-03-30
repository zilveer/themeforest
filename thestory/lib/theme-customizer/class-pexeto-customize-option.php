<?php 


abstract class PexetoCustomizeOption{

	public $name;
	public $id;
	public $default;
	public $rules;
	public $section_id;
	public $priority;


	abstract public function add_control($wp_customizer);
	abstract public function get_type();


	public function __construct($name, $id, $priority, $default, $rules, $section_id){
		$this->name = $name;
		$this->id = $id;
		$this->default = $default;
		$this->priority=$priority;
		$this->rules = $rules;
		$this->section_id = $section_id;
	}

	protected function add_setting($wp_customizer, $extend_args=null){
		$args = array(
			'transport'=>'postMessage'
		);

		if(!empty($this->default)){
			$args['default'] = $this->default;
		}

		$final_args = $args;

		if(!empty($extend_args) && is_array($extend_args)){
			$final_args = array_merge($args, $extend_args);
		}

		$wp_customizer->add_setting($this->id, $final_args);
	}

	public function get_saved_value(){
		if(!isset($this->saved_value)){
			$val = get_theme_mod($this->id);

			if($val==$this->default){
				//do not set the value if it is the same as the default one
				$val = null;
			}

			$this->saved_value = $val;
		}

		return $this->saved_value;
	}

	public function generate_css(){
		$saved_value = $this->get_saved_value();

		if(empty($this->rules) || empty($saved_value)){
			return '';
		}

		$css = '';

		foreach ($this->rules as $key=>$value) {
			$css.=$value.'{'.$key.':'.$saved_value.';}';
		}

		return $css;
		
	}


}