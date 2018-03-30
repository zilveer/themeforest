<?php

require_once 'class-pexeto-customize-option.php';

class PexetoCustomizeOptionHeading extends PexetoCustomizeOption{

	public function __construct($name, $id, $priority, $section_id){
		parent::__construct($name, $id, $priority, '', array(), $section_id);
	}

	public function add_control($wp_customizer){
		$this->include_deps();

		parent::add_setting($wp_customizer, array());
	
		$wp_customizer->add_control(
			new PexetoCustomizeHeadingControl(
				$wp_customizer,
				$this->id,
				array(
					'label' => $this->name,
					'section' => $this->section_id,
					'settings' => $this->id,
					'priority'=>$this->priority
				)
			)
		);
	}

	protected function include_deps(){
		require_once 'custom-controls/class-pexeto-customize-heading-control.php';
	}

	public function get_type(){
		return 'heading';
	}
}