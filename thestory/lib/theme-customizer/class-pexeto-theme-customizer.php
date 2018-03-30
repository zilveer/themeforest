<?php

class PexetoThemeCustomizer{

	private $data;
	private $section_priority = 200;
	private $prefix = 'pexeto_';
	private $wp_customizer;
	private $js_uri;
	private $js_options = array();
	private $options = array();

	public function __construct($data, $js_uri){
		$this->data = $data;
		$this->js_uri = $js_uri;
		$this->init();
	}

	private function init(){
		$this->include_classes();
		$this->register_options();

		add_action( 'customize_register', array($this, 'customize_register') );
		add_action( 'customize_preview_init', array($this, 'enqueue_js') );
		add_action('customize_controls_print_scripts', array($this, 'print_css'));

	}

	public function customize_register($wp_customizer){
		

		$this->wp_customizer = $wp_customizer;

		foreach ($this->data as $index=>$section) {
			if(isset($section['section_id']) && isset($section['section_name'])){
				$this->add_section($section, $index);
			}
		}

		foreach ($this->options as $option){
			$this->add_control($option);
		}
	}

	protected function register_options(){
		foreach ($this->data as $section) {

			foreach ($section['controls'] as $index=>$control) {
				$control_id = $this->prefix.$control['id'];
				$default = isset($control['default']) ? $control['default'] : '';
				$rules = isset($control['rules']) ? $control['rules'] : '';
				$type = isset($control['type']) ? $control['type']:'color';
				switch ($type) {
					case 'color':
						$option = new PexetoCustomizeOptionColor(
							$control['name'], 
							$control_id, 
							$index,
							$default, 
							$rules, 
							$this->prefix.$section['section_id']);
						break;
					
					case 'heading':
						$option = new PexetoCustomizeOptionHeading(
							$control['name'], 
							$control_id, 
							$index,
							$this->prefix.$section['section_id']);
						break;
				}

				

				$this->options[]=$option;
			}
		}
	}

	protected function include_classes(){
		require_once 'class-pexeto-customize-option-color.php';
		require_once 'class-pexeto-customize-option-heading.php';
	}

	protected function add_section($section, $priority){

		if(empty($this->wp_customizer)){
			return;
		}

		$args = array(
				'title' => $section['section_name'],
				'priority' => $priority
			);

		if(!empty($section['description'])){
			$args['description'] = $section['description'];
		}

		$this->wp_customizer->add_section($this->prefix.$section['section_id'], $args);
	}

	protected function add_control($option){
		if(empty($this->wp_customizer)){
			return;
		}

		$option->add_control($this->wp_customizer);

		$this->js_options[]= array(
			'id'=>$option->id,
			'rules'=>$option->rules,
			'type'=>$option->get_type()
			);
	}

	public function get_options_css(){
		$css = '';
		foreach ($this->options as $option) {
			$css.=$option->generate_css();
		}
		return $css;
	}

	public function enqueue_js(){
		add_action( 'wp_head', array($this, 'print_js') );
		wp_enqueue_script( 
		  'pexeto-theme-customizer',			
		  $this->js_uri.'theme-customizer.js',
		  array( 'jquery','customize-preview' ),	
		  '',						
		  true						
		);
	}

	public function print_js(){
		$out = '<script>';
		$out.='jQuery(document).ready(function(){new PexetoCustomizer('.json_encode($this->js_options).').init();});';
		$out.='</script>';
	
		echo $out;
	}

	public function print_css(){
	//print a Pexeto item before each section in the theme customizer menu
	echo '<style>.wp-customizer li[id*="'.$this->prefix.'"] h3:before {
		    background: url("'.PEXETO_IMAGES_URL.'pex_icon.png") no-repeat center left;
			    background-size:17px 17px;
			    content: "";
			    display: inline-block;
			    height: 15px;
			    width: 20px;
			    position:relative;
			    top:2px;}
			.pexeto-control-heading{
				background:#E4EFF5;
				font-weight: normal;
			    margin: 0 -30px 10px -30px;
			    padding: 10px 30px;
			    text-transform: uppercase;}
		    </style>';
	}
}

?>