<?php

require_once 'class-pexeto-customize-option.php';

class PexetoCustomizeOptionColor extends PexetoCustomizeOption{

	public function add_control($wp_customizer){
		parent::add_setting($wp_customizer, array(
			'sanitize_callback' => 'sanitize_hex_color'
			));
			 
		$wp_customizer->add_control(
			new WP_Customize_Color_Control(
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

	public function get_type(){
		return 'color';
	}

	public function generate_css(){
		$saved_value = $this->get_saved_value();

		if(empty($this->rules) || empty($saved_value)){
			return '';
		}

		$css = '';

		foreach ($this->rules as $key=>$value) {
			if($key=='rgba-bg'){
				$rgba = $this->hex_to_rgba($saved_value);
				foreach ($value as $rgba_el) {
					$css.=$rgba_el['selector'].'{background-color:rgba('.$rgba['r'].','.$rgba['g'].','.$rgba['b'].','.$rgba_el['alpha'].');}';
				}
				
			}else{
				$css.=$value.'{'.$key.':'.$saved_value.';}';
			}
		}

		return $css;
		
	}

	private function hex_to_rgba($hex){
		if ( $hex[0] == '#' ) {
		        $hex = substr( $hex, 1 );
		}
		if ( strlen( $hex ) == 6 ) {
		        list( $r, $g, $b ) = array( $hex[0] . $hex[1], $hex[2] . $hex[3], $hex[4] . $hex[5] );
		} elseif ( strlen( $hex ) == 3 ) {
		        list( $r, $g, $b ) = array( $hex[0] . $hex[0], $hex[1] . $hex[1], $hex[2] . $hex[2] );
		} else {
		        return false;
		}
		$r = hexdec( $r );
		$g = hexdec( $g );
		$b = hexdec( $b );
		return array( 'r' => $r, 'g' => $g, 'b' => $b );
	}

}