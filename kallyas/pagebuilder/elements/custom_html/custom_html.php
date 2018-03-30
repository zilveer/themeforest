<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Custom HTML
 Description: Create and display a Text Box element
 Class: TH_CustomHTML
 Category: content
 Level: 3
 Keywords: code
*/

/**
 * Class TH_CustomHTML
 *
 * Create and display a custom HTML box
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_CustomHTML extends ZnElements
{
	public static function getName(){
		return __( "Custom HTML", 'zn_framework' );
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		$elm_classes=array();
		$elm_classes[] = $uid = $this->data['uid'];
		$elm_classes[] = zn_get_element_classes($options);

		$attributes = zn_get_element_attributes($options);

		echo '<div class="zn_custom_html '. implode(' ', $elm_classes).'" '.$attributes.'>';
			echo force_balance_tags( $this->opt( 'custom_html' ) );
		echo '</div>';
	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

					array(
						'id'          => 'custom_html',
						'name'        => 'Custom HTML',
						'description' => 'Using this option you can enter you own custom HTML code. If you plan on adding CSS or JavaScript, wrap the codes into &lt;style type="text/css"&gt;...&lt;/style&gt; respectively &lt;script&gt;...&lt;/script&gt; . <strong>Please make sure your JS code is fully functional</strong> as it might break the entire page!!',
						'type'        => 'custom_html',
						'class'       => 'zn_full',
						'editor_type' => 'html',
					)

				)
			),

			'help' => znpb_get_helptab( array(
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
