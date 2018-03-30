<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Accordion
 Description: Create and display an Accordion element
 Class: TH_Accordion
 Category: content
 Level: 3
 Multiple: true
 Keywords: toggle, collapsible, expandable
*/
/**
 * Class HT_Accordion
 *
 * Create and display an Accordion element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author Team Hogash
 * @since 3.8.0
 */
class TH_Accordion extends ZnElements
{
	public static function getName(){
		return __( "Accordion", 'zn_framework' );
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{

		$GLOBALS['options'] = array(
			'accordion' => $this->data['options']
		);
		include( 'inc/ui.inc.php' );
	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$extra_options = array (
			"name"           => __( "Accordions", 'zn_framework' ),
			"description"    => __( "Here you can create your desired accordions.", 'zn_framework' ),
			"id"             => "accordion_single",
			"std"            => "",
			"type"           => "group",
			"group_sortable" => true,
			"element_title" => "acc_single_title",
			"subelements"    => array (
				array (
					"name"        => __( "Title", 'zn_framework' ),
					"description" => __( "Please enter a title for this accordion.", 'zn_framework' ),
					"id"          => "acc_single_title",
					"std"         => "",
					"type"        => "text"
				),
				array (
					"name"        => __( "Expanded", 'zn_framework' ),
					"description" => __( "Select yes if you want this panel to be expanded on page load.",
						'zn_framework' ),
					"id"          => "acc_colapsed",
					"std"         => "no",
					"options"     => array (
						'yes' => __( 'Yes', 'zn_framework' ),
						'no'  => __( 'No', 'zn_framework' )
					),
					"type"        => "zn_radio",
					"class"        => "zn_radio--yesno",
				)
			)
		);

		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

					array (
						"name"        => __( "Title", 'zn_framework' ),
						"description" => __( "Enter a title for your Accordion element", 'zn_framework' ),
						"id"          => "acc_title",
						"std"         => "",
						"type"        => "text",
					),
					array (
						"name"        => __( "Accordion Style", 'zn_framework' ),
						"description" => __( "Please select the style you want to use.", 'zn_framework' ),
						"id"          => "acc_style",
						"std"         => "default-style",
						"options"     => array (
							'default-style' => __( 'Style 1', 'zn_framework' ),
							'style2'        => __( 'Style 2', 'zn_framework' ),
							'style3'        => __( 'Style 3', 'zn_framework' ),
							'style4'        => __( 'Style 4', 'zn_framework' ),
						),
						"type"        => "select",
						'live' => array(
								'multiple' => array(
									array(
										'type'        => 'class',
										'css_class' => '.' . $this->data['uid'],
										'val_prepend'   => 'zn-acc--',
									),
									array(
										'type'        => 'class',
										'css_class' => '.' . $this->data['uid'] . ' .panel-group',
										'val_prepend'   => 'acc--',
									),
								)
							)
					),
					array(
						'id'          => 'element_scheme',
						'name'        => 'Element Color Scheme',
						'description' => 'Select the color scheme of this element',
						'type'        => 'select',
						'std'         => '',
						'options'        => array(
							'' => 'Inherit from Kallyas options > Color Options [Requires refresh]',
							'light' => 'Light (default)',
							'dark' => 'Dark'
						),
						'live'        => array(
							'multiple' => array(
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid,
									'val_prepend'  => 'acc-sch--',
								),
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid,
									'val_prepend'  => 'element-scheme--',
								),
							)
						)
					),
					array (
						"name"        => __( "Collapse Behaviour", 'zn_framework' ),
						"description" => __( "Select the behaviour of the collapsible panels. Upon click, Accordion Functionality will close other panels, while toggle just opens/closes the current clicked panel.", 'zn_framework' ),
						"id"          => "acc_behaviour",
						"std"         => "tgg",
						"options"     => array (
							'tgg' => __( 'Toggle', 'zn_framework' ),
							'acc'  => __( 'Accordion', 'zn_framework' )
						),
						"type"        => "select"
					),
					$extra_options,
				),
			),


			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#gIrgHl-BrLQ',
				'docs'    => 'http://support.hogash.com/documentation/accordion/',
				'copy'    => $uid,
				'general' => true,
			)),
		);

		return $options;
	}
}
