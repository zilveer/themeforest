<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Circle Title Text Box
 Description: Create and display a Circle Title Text Box element
 Class: TH_CircleTitleTextBox
 Category: content
 Level: 3
*/
class TH_CircleTitleTextBox extends ZnElements
{
	public static function getName(){
		return __( "Circle Title Text Box", 'zn_framework' );
	}

	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){
		$css = '';
		$uid = $this->data['uid'];

		$ctb_circle_bgcolor = $this->opt( 'ctb_circle_bgcolor', '#cd2122' );
		if($ctb_circle_bgcolor != '#cd2122'){
			$css .= '.'.$uid.':not(.style3) .wpk-circle-span:after, .'.$uid.'.circle-text-box.style2 .wpk-circle-span::before, .'.$uid.'.circle-text-box.style3 .wpk-circle-span {background-color:'.$ctb_circle_bgcolor.'} ';
		}

		$ctb_circle_textcolor = $this->opt('ctb_circle_textcolor', '#ffffff' );
		if($ctb_circle_textcolor != '#ffffff'){
			$css .= '.'.$uid.' .wpk-circle-span {color:'.$ctb_circle_textcolor.'} ';
		}

		return $css;
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		$c_title      = '';

		$elm_classes=array();
		$elm_classes[] = $this->data['uid'];
		$elm_classes[] = zn_get_element_classes($options);

		$attributes = zn_get_element_attributes($options);

		$color_scheme = $this->opt( 'element_scheme', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'element_scheme', '' );
		$elm_classes[] = 'circletitlebox--'.$color_scheme;
		$elm_classes[] = 'element-scheme--'.$color_scheme;

		$elm_classes[] = $this->opt( 'cttb_style', 'style1' );

		echo '<div class="circle-text-box '.implode(' ', $elm_classes).'" '.$attributes.'>';
			echo '<div class="circle-headline">';

				// TITLE 1
				if ( ! empty ( $options['ctb_circle_title'] ) ) {
					$c_title = '<span class="wpk-circle-span"><span>' . $options['ctb_circle_title'] . '</span></span> ';
				}
				// TITLE 2
				if ( ! empty ( $options['ctb_main_title'] ) ) {
					echo  $c_title. '<h4 class="wpk-circle-title text-custom" '.WpkPageHelper::zn_schema_markup('title').'>' . $options['ctb_main_title'] .'</h4>';
				}
			echo '</div>';
			// CONTENT
			if ( ! empty ( $options['ctb_content'] ) ) {
				echo wpautop(do_shortcode( $options['ctb_content'] ));
			}
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
					array (
						"name"        => __( "Style", 'zn_framework' ),
						"description" => __( "Please select the style you want to use.", 'zn_framework' ),
						"id"          => "cttb_style",
						"std"         => "style1",
						"type"        => "select",
						"options"     => array (
							'style1'     => __( 'Style 1 - Simple Circle', 'zn_framework' ),
							'style2'    => __( 'Style 2 - Pointing circle', 'zn_framework' ),
							'style3'    => __( 'Style 3 - Square shaped', 'zn_framework' )
						),
						'live' => array(
							'type'      => 'class',
							'css_class' => '.'.$this->data['uid']
						)
					),
					array (
						"name"        => __( "Circle Text Title", 'zn_framework' ),
						"description" => __( "Please enter a SMALL word that will appear on the left circle beside the main title.", 'zn_framework' ),
						"id"          => "ctb_circle_title",
						"std"         => "",
						"type"        => "text",
					),
					array (
						"name"        => __( "Main Title", 'zn_framework' ),
						"description" => __( "Please enter a main title for this box.", 'zn_framework' ),
						"id"          => "ctb_main_title",
						"std"         => "",
						"type"        => "text",
					),
					array (
						"name"        => __( "Content", 'zn_framework' ),
						"description" => __( "Please enter a content for this box.", 'zn_framework' ),
						"id"          => "ctb_content",
						"std"         => "",
						"type"        => "visual_editor",
						'class'       => 'zn_full'
					),

					array (
						"name"        => __( "Circle Background Color", 'zn_framework' ),
						"description" => __( "Select the background color for the circle.", 'zn_framework' ),
						"id"          => "ctb_circle_bgcolor",
						"std"         => "#cd2122",
						"type"        => "colorpicker",
					),
					array (
						"name"        => __( "Circle Text Color", 'zn_framework' ),
						"description" => __( "Select the text color for the circle.", 'zn_framework' ),
						"id"          => "ctb_circle_textcolor",
						"std"         => "#ffffff",
						"type"        => "colorpicker",
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
									'val_prepend'  => 'circletitlebox--',
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
				'video'   => 'http://support.hogash.com/kallyas-videos/#nMXI-Tfit68',
				'docs'    => 'http://support.hogash.com/documentation/circle-title-text-box/',
				'copy'    => $uid,
				'general' => true,
			)),

		);

		return $options;
	}
}
