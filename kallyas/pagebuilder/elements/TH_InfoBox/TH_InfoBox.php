<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Info Box
 Description: Create and display an Info Box element
 Class: TH_InfoBox
 Category: content
 Level: 3
 Legacy: true
*/
/**
 * Class TH_InfoBox
 *
 * Create and display an Info Box element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author Team Hogash
 * @since 3.8.0
 */
class TH_InfoBox extends ZnElements
{
	public static function getName(){
		return __( "Info Box", 'zn_framework' );
	}

	/**
	 * This method is used to display the output of the element.
	 *
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		if( empty( $options['ib_style'] ) ){
			$options['ib_style'] = 'style1';
		}

		// Only for style 3
		$isStyle3 = ((isset($options['ib_style']) && !empty($options['ib_style'])) && ('infobox3' == $options['ib_style']));
		$style3Style = $link1 = $link2 = '';
		if($isStyle3){
			$bgColor = (isset($options['ib_bgcolor']) && !empty($options['ib_bgcolor']) ? $options['ib_bgcolor'] : '');
			$bgImage = (isset($options['ib_bgimage']) && !empty($options['ib_bgimage']) ? $options['ib_bgimage'] : '');
			if(!empty($bgColor) || !empty($bgImage)){
				$style3Style = 'style="';
				if(!empty($bgColor)){ $style3Style .= 'background-color: '.$bgColor.';';}

				if( !empty( $bgImage['image'] ) ) { $style3Style .= 'background-image: url('.$bgImage['image'].');'; }
				if( !empty( $bgImage['repeat'] ) ) { $style3Style .= 'background-repeat:'.$bgImage['repeat'].';'; }
				if( !empty( $bgImage['size'] ) ) { $style3Style .= 'background-size:'.$bgImage['size'].';'; }
				if( !empty( $bgImage['position'] ) ) { $style3Style .= 'background-position:'.$bgImage['position']['x'].' '.$bgImage['position']['y'].';'; }
				if( !empty( $bgImage['attachment'] ) ) { $style3Style .= 'background-attachment:'.$bgImage['attachment'].';'; }

				$style3Style .= '"';
			}
			// LINK 2
			$ib_button_link2 = zn_extract_link( $options['ib_button_link2'], 'ib-button2 btn btn-fullcolor' );
			$link2 = '';
			if ( ! empty ( $options['ib_button_text2'] ) ) {
				$link2 = $ib_button_link2['start'] . $options['ib_button_text2'] . $ib_button_link2['end'];

			}
		}

		// LINK
		$link = '';
		$link_classes = $isStyle3 ? 'ib-button-1 btn btn-lined' : 'btn btn-lg btn-fullcolor';
		$ib_button_link = zn_extract_link( $options['ib_button_link'], $link_classes );

		if ( ! empty ( $options['ib_button_text'] ) ) {
			$link = $ib_button_link['start'] . $options['ib_button_text'] . $ib_button_link['end'];
		}

		// If the button does not exists
		$useColCustom = 'col-lg-12';

		if(!empty($options['ib_button_text']) && ($options['ib_style'] == 'infobox2') && !empty($link)){
			$useColCustom = 'col-lg-8';
		}
		else {
			if ( $options['ib_style'] == 'infobox1' ) {
				$useColCustom = 'col-lg-12';
			}
		}


		echo '<div class="' . $options['ib_style'] . ' '.zn_get_element_classes($options).'" '.zn_get_element_attributes($options).' '.$style3Style.'>';
		echo '<div class="row">';
		echo '<div class="ib-content infobox3--'.$this->opt('ib_theme_color', 'dark').' col-sm-12 '.$useColCustom.'">';
		// TITLE
		if ( ! empty ( $options['ib_title'] ) ) {
			echo '<h3 class="ib-content__title m_title m_title_ext text-custom " '.WpkPageHelper::zn_schema_markup('title').'>' . $options['ib_title'] . '</h3>';
		}

		// SUBTITLE
		if ( ! empty ( $options['ib_subtitle'] ) ) {
			echo wpautop($options['ib_subtitle']);
		}

		// Link button: style 1
		if (!empty($options['ib_style']) && ( $options['ib_style'] == 'infobox1' ) && !empty($link)) {
			echo '<div class="ib-button">';
			echo $link;
			echo '</div>';
		}
		// Link button: style 3
		elseif($isStyle3){
			// Button 1
			if(! empty($link)){
				echo '<div class="ib-button ib-button-1">';
				echo $link;
				echo '</div>';
			}
			// Button 2
			if(! empty($link2)){
				echo '<div class="ib-button ib-button-2">';
				echo $link2;
				echo '</div>';
			}
		}

		echo '</div>'; // End .ib-content

		// Link button: style 2
		if ( !empty($options['ib_style']) && ( $options['ib_style'] == 'infobox2' ) && !empty($link)) {
			echo '<div class="ib-button col-sm-12 col-lg-4">';
			echo $link;
			echo '</div>';
		}

		echo '</div>'; // End .row

		echo '</div>'; //  end .$options['ib_style']


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
						"name"        => __( '<strong style="font-size:120%">Warning!</strong>', 'zn_framework' ),
						"description" => __( 'Since v4.x, <strong>this element is <em>deprecated</em> & <em>unsuported</em></strong>. It\'s not recommended to be used bucause at some point it\'ll be removed (now it\'s kept only for backwards compatibilty).<br> Instead, try to use a one of these elements (or combined): Section (to add background), 2 Columns (6 + 6), Title element/TextBox (onto the left column), Button Element (into the right column)', 'zn_framework' ),
						'type'  => 'zn_message',
						'id'    => 'zn_error_notice',
						'show_blank'  => 'true',
						'supports'  => 'warning'
					),
					array (
						"name"        => __( "Title", 'zn_framework' ),
						"description" => __( "Please enter the Info Box title", 'zn_framework' ),
						"id"          => "ib_title",
						"std"         => "",
						"type"        => "text",
					),
					array (
						"name"        => __( "Subtitle", 'zn_framework' ),
						"description" => __( "Please enter the Info Box subtitle", 'zn_framework' ),
						"id"          => "ib_subtitle",
						"std"         => "",
						"type"        => "text",
					),
					array (
						"name"        => __( "Select style", 'zn_framework' ),
						"description" => __( "Select the desired style for this element", 'zn_framework' ),
						"id"          => "ib_style",
						"type"        => "select",
						"std"         => "style1",
						"options"     => array (
							'infobox1' => __( 'Style 1', 'zn_framework' ),
							'infobox2' => __( 'Style 2', 'zn_framework' ),
							'infobox3' => __( 'Style 3', 'zn_framework' ),
						),
					),

					array (
						"name"        => __( "Text color scheme", 'zn_framework' ),
						"description" => __( "Select the desired style for this element", 'zn_framework' ),
						"id"          => "ib_theme_color",
						"type"        => "select",
						"std"         => "dark",
						"options"     => array (
							'dark' => __( 'Dark text color', 'zn_framework' ),
							'light' => __( 'Light text color', 'zn_framework' ),
						),
						// 'dependency'  => array( 'element' => 'ib_style', 'value'   => array('infobox3'), ),
					),

					array (
						"name"        => __( "Select background color", 'zn_framework' ),
						"description" => __( "Select a color to apply as background color.", 'zn_framework' ),
						"id"          => "ib_bgcolor",
						"std"         => "#eee",
						"type"        => "colorpicker",
						'dependency'  => array( 'element' => 'ib_style', 'value'   => array('infobox3'), ),
					),
					array (
						"name"        => __( "Select background image", 'zn_framework' ),
						"description" => __( "Please select an image to use as background image.", 'zn_framework' ),
						"id"          => "ib_bgimage",
						"std"         => "",
						"type"        => "background",
						'class'       => 'zn_full',
						'options' => array( "repeat" => true , "position" => true , "attachment" => true, "size" => true ),
						'dependency'  => array( 'element' => 'ib_style', 'value'   => array('infobox3'), ),
					),
					array (
						"name"        => __( "Button 2 text", 'zn_framework' ),
						"description" => __( "Please enter a text that will appear as button", 'zn_framework' ),
						"id"          => "ib_button_text2",
						"std"         => "",
						"type"        => "text",
						'dependency'  => array( 'element' => 'ib_style', 'value'   => array('infobox3'), ),
					),
					array (
						"name"        => __( "Button 2 link", 'zn_framework' ),
						"description" => __( "Please choose the link you want to use.", 'zn_framework' ),
						"id"          => "ib_button_link2",
						"std"         => "",
						"type"        => "link",
						"options"     => zn_get_link_targets(),
						'dependency'  => array( 'element' => 'ib_style', 'value'   => array('infobox3'), ),
					),

					array (
						"name"        => __( "Button text", 'zn_framework' ),
						"description" => __( "Please enter a text that will appear as button", 'zn_framework' ),
						"id"          => "ib_button_text",
						"std"         => "",
						"type"        => "text",
					),
					array (
						"name"        => __( "Button link", 'zn_framework' ),
						"description" => __( "Please choose the link you want to use.", 'zn_framework' ),
						"id"          => "ib_button_link",
						"std"         => "",
						"type"        => "link",
						"options"     => array (
							'_blank' => __( "New window", 'zn_framework' ),
							'_self'  => __( "Same window", 'zn_framework' )
						)
					),
				),
			),


			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#LoGkTg6n6lg',
				'docs'    => 'http://support.hogash.com/documentation/info-box/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;

	}
}
