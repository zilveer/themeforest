<?php if(! defined('ABSPATH')){ return; }
/*
	Name: Anchor Point
	Description: This element will generate an empty element with an unique ID that can be used as an achor point
	Class: ZnAnchorPoint
	Category: content
	Level: 3
	Keywords: scroll

*/

	class ZnAnchorPoint extends ZnElements {

	function options() {

		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

					array (
						'id'          => 'id',
						'name'        => 'ID',
						'description' => 'Please enter an id for this anchor point. You can use this #id for an anchor href.',
						'std'         => $this->data['uid'],
						'type'        => 'text'
					),

				),
			),

			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#GAiAelvoOg4',
				'docs'    => 'http://support.hogash.com/documentation/anchor-point-element/',
				'copy'    => $uid,
				'general' => true,
			)),

		);

		return $options;

	}

	function element(){
		 $element_id = $this->opt('id') ? $this->opt('id') : $this->data['uid'];
			echo '<div id="'.esc_attr( $element_id ).'" class="zn_anchor_point '.zn_get_element_classes($this->data['options']).'"></div>';
	}


	function element_edit() {

		$element_id = $this->opt('id') ? $this->opt('id') : $this->data['uid'];
		echo '<div id="'.esc_attr( $element_id ).'" class="zn_anchor_point '.zn_get_element_classes($this->data['options']).'">'.$element_id.'</div>';

	}
	}

?>
