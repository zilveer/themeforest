<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Spacer Element
 Description: Create and display a Spacer Element element
 Class: TH_SpacerElement
 Category: content
 Level: 3
 Keywords: divider, distance, spacing
*/
/**
 * Class TH_SpacerElement
 *
 * Create and display a Spacer Element element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_SpacerElement extends ZnElements
{
	public static function getName(){
		return __( "Spacer Element", 'zn_framework' );
	}

	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){

		$uid = $this->data['uid'];
		$css = '';

		$css .= zn_smart_slider_css( $this->opt( 'spacer_height', 30 ), '.'.$uid.'.th-spacer', 'height' );

		return $css;
	}

	/**
	 * This method is used to display the output of the element.
	 *
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		$hide = array();
		$hide[] = $this->opt('spacer_hide_lg','0') == 1 ? 'hidden-lg' : '';
		$hide[] = $this->opt('spacer_hide_md','0') == 1 ? 'hidden-md' : '';
		$hide[] = $this->opt('spacer_hide_sm','0') == 1 ? 'hidden-sm' : '';
		$hide[] = $this->opt('spacer_hide_xs','0') == 1 ? 'hidden-xs' : '';

		echo '<div class="th-spacer clearfix '.$this->data['uid'].' '. implode(' ', $hide ) .' '.zn_get_element_classes($this->data['options']).'"></div>';
	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$uid = $this->data['uid'];

		// TODO: To be moved in the system (misc.) options
		// $breakpoints_hide_std = array(
		// 	( isset($this->data['options']['spacer_hide_lg']) && $this->data['options']['spacer_hide_lg'] == 1 ? 'lg' : '' ),
		// 	( isset($this->data['options']['spacer_hide_md']) && $this->data['options']['spacer_hide_md'] == 1 ? 'md' : '' ),
		// 	( isset($this->data['options']['spacer_hide_sm']) && $this->data['options']['spacer_hide_sm'] == 1 ? 'sm' : '' ),
		// 	( isset($this->data['options']['spacer_hide_xs']) && $this->data['options']['spacer_hide_xs'] == 1 ? 'xs' : '' ),
		// );

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

					array(
						'id'          => 'spacer_height',
						'name'        => __( 'Spacer Height', 'zn_framework'),
						'description' => __( 'Choose the desired height for this element.', 'zn_framework' ),
						'type'        => 'smart_slider',
						'std'        => '30',
						'helpers'     => array(
							"step" => "1",
							'min' => '0',
							'max' => '600'
						),
						'supports' => array('breakpoints'),
						'units' => array('px', '%', 'vh'),
						'live' => array(
							'type'      => 'css',
							'css_class' => '.'.$uid,
							'css_rule'  => 'height',
							'unit'      => 'px'
						),
					),

					// TODO: To be moved in the system (misc.) options
					array (
						"name"        => __( "Hide on Large Breakpoint", 'zn_framework' ),
						"description" => __( "Bigger than 1200px", 'zn_framework' ),
						"id"          => "spacer_hide_lg",
						"std"         => "0",
						"value"       => "1",
						"type"        => "toggle2",
					),
					array (
						"name"        => __( "Hide on Medium Breakpoint", 'zn_framework' ),
						"description" => __( "Bigger than 992px and smaller than 1199px", 'zn_framework' ),
						"id"          => "spacer_hide_md",
						"std"         => "0",
						"value"       => "1",
						"type"        => "toggle2",
					),
					array (
						"name"        => __( "Hide on Small Breakpoint ", 'zn_framework' ),
						"description" => __( "Bigger than 768px and smaller than 991px", 'zn_framework' ),
						"id"          => "spacer_hide_sm",
						"std"         => "0",
						"value"       => "1",
						"type"        => "toggle2",
					),
					array (
						"name"        => __( "Hide on Extra small Breakpoint ", 'zn_framework' ),
						"description" => __( "Smaller than 767px", 'zn_framework' ),
						"id"          => "spacer_hide_xs",
						"std"         => "0",
						"value"       => "1",
						"type"        => "toggle2",
					),


				),
			),

			'znpb_misc' => array(
				'disable' => array('znpb_hide_breakpoint')
			),

			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#O03njJEtSNQ',
				'copy'    => $uid,
				'general' => true,
			)),

		);

		return $options;
	}
}
