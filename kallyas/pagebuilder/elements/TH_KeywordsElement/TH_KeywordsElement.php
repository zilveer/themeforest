<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Keywords Element
 Description: Create and display a Keywords Element element
 Class: TH_KeywordsElement
 Category: content
 Level: 3
*/

/**
 * Class TH_KeywordsElement
 *
 * Create and display a Keywords Element element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    3.8.0
 */
class TH_KeywordsElement extends ZnElements
{
	public static function getName(){
		return __( "Keywords Element", 'zn_framework' );
	}

	/**
	 * This method is used to display the output of the element.
	 *
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		$elm_classes=array();
		$elm_classes[] = $this->data['uid'];
		$elm_classes[] = zn_get_element_classes($options);

		$attributes = zn_get_element_attributes($options);

		$color_scheme = $this->opt( 'element_scheme', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'element_scheme', '' );
		$elm_classes[] = 'kwd--'.$color_scheme;
		$elm_classes[] = 'element-scheme--'.$color_scheme;

		$kbStyle = $this->opt('keywordbox_style','style1');

		$cssRules = '';
		$useBgImage = false;
		$useBgColor = false;

		if('style2' == $kbStyle){
			$elm_classes[] = 'keywordbox-2';
			$useBgImage = true;
		}
		elseif('style3' == $kbStyle){
			$elm_classes[] = 'keywordbox-3';
			$useBgImage = true;
		}
		elseif('style4' == $kbStyle){
			$elm_classes[] = 'keywordbox-4';
			$useBgColor = true;
		}


		if($useBgImage){
			$cssRules .= "background-image: url({$options['kb_bg_image']});";
		}
		if($useBgColor){
			$cssRules .= "background-color: {$options['kb_bg_color']};";
		}

		if ( !empty ( $options['kw_content'] ) ) {
			echo '<div class="keywordbox '.implode(' ', $elm_classes).'" '.$attributes.' style="'.$cssRules.'">'.$options['kw_content'].'</div>';
		}
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
					array (
						"name"        => __( "Keyword Box Style", 'zn_framework' ),
						"description" => __( "Please select the style you want to use.", 'zn_framework' ),
						"id"          => "keywordbox_style",
						"std"         => "style1",
						"options"     => array (
							'style1'  => __( 'Style 1', 'zn_framework' ),
							'style2'  => __( 'Style 2 (since v4.0)', 'zn_framework' ),
							'style3'  => __( 'Style 3 (since v4.0)', 'zn_framework' ),
							'style4'  => __( 'Style 4 (since v4.0)', 'zn_framework' )
						),
						"type"        => "select",
					),
					array (
						"name"        => __( "Background image", 'zn_framework' ),
						"description" => __( "Select a background image for this element", 'zn_framework' ),
						"id"          => "kb_bg_image",
						"std"         => "",
						"type"        => "media",
						'class'       => 'zn_full',
						'dependency'  => array('element' => 'keywordbox_style', 'value' => array('style2', 'style3')),
					),
					array (
						"name"        => __( "Background Color", 'zn_framework' ),
						"description" => __( "Here you can choose the background color for this element.", 'zn_framework' ),
						"id"          => "kb_bg_color",
						"std"         => '',
						"type"        => "colorpicker",
						'dependency'  => array('element' => 'keywordbox_style', 'value' => array('style4')),
					),
					array (
						"name"        => __( "Content", 'zn_framework' ),
						"description" => __( "Please enter the Keywords content", 'zn_framework' ),
						"id"          => "kw_content",
						"std"         => "",
						"type"        => "textarea",
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
									'val_prepend'  => 'kwd--',
								),
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid,
									'val_prepend'  => 'element-scheme--',
								),
							)
						)
					),
				),
			),

			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#0S7H_kkVP5U',
				'docs'    => 'http://support.hogash.com/documentation/keywords-element/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}

