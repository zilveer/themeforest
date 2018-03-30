<?php if(! defined('ABSPATH')){ return; }
/*
	Name: Page Builder Smart Area
	Description: This element will generate an empty element with an unique ID that can be used as an achor point
	Class: ZnPbCustomTempalte
	Category: content
	Level: 1
*/

class ZnPbCustomTempalte extends ZnElements {

	function options() {

		$uid = $this->data['uid'];
		$pb_templates_options = array('' => '-- Select a template --');
		$all_pb_templates = get_posts( array (
			'post_type'      => 'znpb_template_mngr',
			'posts_per_page' => - 1,
			'post_status'    => 'publish',
		) );

		// print_z( $all_pb_templates );

		foreach ($all_pb_templates as $key => $value) {
			$pb_templates_options[$value->ID] = $value->post_title;
		}


		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

					array (
						'id'          => 'pb_template',
						'name'        => 'Select Pagebuilder Template',
						'description' => 'Using this option you can select a pre-built template made at Admin > Pagebuilder Tempaltes page.',
						'type'        => 'select',
						'options'	=> $pb_templates_options
					),

				),
			),

			// 'help' => znpb_get_helptab( array(
			// 	'video'   => 'http://support.hogash.com/kallyas-videos/#GAiAelvoOg4',
			// 	'docs'    => 'http://support.hogash.com/documentation/anchor-point-element/',
			// 	'copy'    => $uid,
			// 	'general' => true,
			// )),

		);

		return $options;

	}

	function element(){

		$options = $this->data['options'];

		$template = $this->opt( 'pb_template' );
		if( empty( $template ) ) { return; }

		$classes=array();
		$classes[] = $this->data['uid'];
		$classes[] = zn_get_element_classes($options);

		$attributes = zn_get_element_attributes($options);

		$pb_data = get_post_meta( $template, 'zn_page_builder_els', true );
		echo '<div class="'.implode(' ', $classes).'" '.$attributes.'>';
			ZN()->pagebuilder->zn_render_uneditable_content( $pb_data, $template );
		echo '</div>';

	}

}

?>
