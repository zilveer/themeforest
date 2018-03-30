<?php

class PeThemeViewLayoutModuleOneUpRevolutionSlider extends PeThemeViewLayoutModule {

	public function messages() {
		return
			array(
				  'title' => '',
				  'type' => __( 'Revolution Slider' ,'Pixelentity Theme/Plugin')
				  );
	}

	public function fields() {
		return
			array(
				'slider' => array(
					'label'       => __( 'Slider alias' ,'Pixelentity Theme/Plugin'),
					'type'        => 'Text',
					'description' => __( 'Enter here your revolution slider alias.' ,'Pixelentity Theme/Plugin'),
					'default'     => '',
					'datatype'    => 'blocktitle',
				),
				'boxed' => array(
					'label'       => __( 'Boxed' ,'Pixelentity Theme/Plugin'),
					'type'        => 'RadioUI',
					'description' => __( 'Set this to Yes if you are using a boxed slider layout?' ,'Pixelentity Theme/Plugin'),
					'options'     => array(
						__( 'Yes' ,'Pixelentity Theme/Plugin') => 'yes',
						__( 'No' ,'Pixelentity Theme/Plugin')  => 'no',
					),
					'default'     => 'no',
				),
			);
		
	}

	public function name() {
		return __( 'Revolution Slider' ,'Pixelentity Theme/Plugin');
	}

	public function setTemplateData() {
		// we also render (parent) shortcodes here to keep template file clean;
		peTheme()->template->data($this->data,$this->conf->bid);
	}

	public function template() {
		peTheme()->get_template_part( 'viewmodule', 'revolution-slider' );
	}

	public function tooltip() {
		return __( 'Revolution slider.' ,'Pixelentity Theme/Plugin');
	}

}

?>