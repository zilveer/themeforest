<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Hover Box
 Description: Create and display a Hover Box element
 Class: TH_HoverBox
 Category: content
 Level: 3
*/

/**
 * Class TH_HoverBox
 *
 * Create and display a Hover Box element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    3.8.0
 */
class TH_HoverBox extends ZnElements
{
	public static function getName(){
		return __( "Hover Box", 'zn_framework' );
	}

	/**
	 * This method is used to display the output of the element.
	 *
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		$content      = '';
		$cls = 'margin-top:10px;';

		$hover_box_style = $this->opt( 'hover_box_style', 'hover-box' );
		$hb_icon = $this->opt('hb_icon', '');

		echo '<div class="zn_hover_box '.zn_get_element_classes($options).'" '.zn_get_element_attributes($options).'>';

		$hb_link = zn_extract_link(
			$this->opt('hb_link',''),
			'hover-box u-trans-all-2s ' . $this->opt( 'hb_align', 'zn_fill_class' ) . ' ' . $hover_box_style . ' '.$this->data['uid'] ,
			'style="'.($hover_box_style == 'hover-box-3' && ! empty ( $hb_icon ) ? 'background-image:url('.$hb_icon.'); background-size:cover':'').'"',
			false, false, '#'
		);

		echo $hb_link['start'];

			if($hover_box_style == 'hover-box-2'){
				echo '<svg class="hb-circle" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="187px" height="187px" viewBox="0 0 187 187">
					<circle stroke="#FFFFFF" fill="none" stroke-width="2" cx="93.5" cy="93.5" r="90.5"></circle>
					<path d="M117.004,93 L115.594,94.388 L79.412,130.004 L78.002,128.616 L114.185,93 L78.002,57.384 L79.412,55.996 L115.594,91.612 L117.004,93 L117.004,93 Z" fill="#FFFFFF" ></path>
				</svg>';

			}

			if ( ! empty ( $hb_icon )  ) {
				echo '<img src="' . $hb_icon . '" class="hb-img hover-box-img '.( isset($options['hb_rmmargin']) && $options['hb_rmmargin'] == 1 && $hover_box_style == 'hover-box-2' ? 'rb-right' : '' ).'" alt="'. ZngetImageAltFromUrl( $hb_icon ) .'" title="'.ZngetImageTitleFromUrl( $hb_icon ).'" />';
			}

			if ( ! empty ( $options['hb_desc'] ) ) {
				$content = '<div class="hover-box__content hover-box-content">' . $options['hb_desc'] . '</div>';
				$cls     = '';
			}
			if (isset($options['hb_title']) && !empty($options['hb_title'])) {
				echo '<h3 class="hover-box-title" style="' . $cls . '" '.WpkPageHelper::zn_schema_markup('title').'>' . $options['hb_title'] . '</h3>';
			}
			if (isset($options['hb_subtitle']) && !empty($options['hb_subtitle'])) {
				echo '<h4 class="hover-box-subtitle" '.WpkPageHelper::zn_schema_markup('subtitle').'>' . $options['hb_subtitle'] . '</h4>';
			}

			echo $content;

		echo $hb_link['end'];

		echo '</div>';
	}

	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){

		$hb_bgcolor = $this->opt( 'hb_bgcolor', '#969696' );
		$hb_textcolor = $this->opt( 'hb_textcolor', '#ffffff' );
		$hb_bgcolor_hover = $this->opt( 'hb_bgcolor_hover', '#cd2122' );
		$hb_textcolor_hover = $this->opt( 'hb_textcolor_hover', '#ffffff' );
		$hover_box_style = $this->opt( 'hover_box_style', 'hover-box' );
		$uid = $this->data['uid'];
		$css = '';

		if( $hb_bgcolor != '#969696' || $hb_textcolor != '#ffffff' ){
			$css .= ".{$uid}{";
			if( $hb_bgcolor != '#969696' ){
				$css .= "background-color: $hb_bgcolor;";
			}
			if( $hb_textcolor != '#ffffff' ){
				$css .= "color: $hb_textcolor;";
			}
			$css .= "}";
		}
		if( $hb_textcolor != '#ffffff' && $hover_box_style != 'hover-box' ){
			$css .= ".{$uid}.hover-box-2 .hover-box__content:after, .{$uid}.hover-box-3 .hover-box__content:after { background: $hb_textcolor; }";
		}


		if( $hb_bgcolor_hover != '#cd2122' || $hb_textcolor_hover != '#ffffff' ){
			$css .= ".{$uid}:hover{";
			if( $hb_bgcolor_hover != '#cd2122' ){
				$css .= "background-color: $hb_bgcolor_hover;";
			}
			if( $hb_textcolor_hover != '#ffffff' ){
				$css .= "color: $hb_textcolor_hover;";
			}
			$css .= "}";
		}
		if( $hb_textcolor_hover != '#ffffff' && $hover_box_style != 'hover-box' ){
			$css .= ".{$uid}.hover-box-2:hover .hover-box__content:after, .{$uid}.hover-box-3:hover .hover-box__content:after { background: $hb_textcolor_hover; }";
			$css .= ".{$uid} .hb-circle circle { stroke: $hb_textcolor_hover; }";
			$css .= ".{$uid} .hb-circle path { fill: $hb_textcolor_hover; }";
		}

		return $css;
	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$uid = $this->data['uid'];

		return array (
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array (
						"name"        => __( "Title", 'zn_framework' ),
						"description" => __( "Please enter a title for this box.", 'zn_framework' ),
						"id"          => "hb_title",
						"std"         => "",
						"type"        => "text",
					),
					array (
						"name"        => __( "Subtitle", 'zn_framework' ),
						"description" => __( "Please enter a subtitle for this box.", 'zn_framework' ),
						"id"          => "hb_subtitle",
						"std"         => "",
						"type"        => "text",
					),
					array (
						"name"        => __( "Description", 'zn_framework' ),
						"description" => __( "Please enter a description for this box.", 'zn_framework' ),
						"id"          => "hb_desc",
						"std"         => "",
						"type"        => "textarea",
					),

					array (
						"name"        => __( "Add Image", 'zn_framework' ),
						"description" => __( "Please select an image for this box.", 'zn_framework' ),
						"id"          => "hb_icon",
						"std"         => "",
						"type"        => "media",
					),

					array (
						"name"        => __( "Box Link", 'zn_framework' ),
						"description" => __( "Please choose the link you want to use.", 'zn_framework' ),
						"id"          => "hb_link",
						"std"         => "#",
						"type"        => "link",
						"options"     => zn_get_link_targets(),
					),
				),
			),
			'style_options' => array(
				'title' => 'Style options',
				'options' => array(
					array (
						"name"        => __( "Hover Box Style", 'zn_framework' ),
						"description" => __( "Please select the style you want to use.", 'zn_framework' ),
						"id"          => "hover_box_style",
						"std"         => "hover-box",
						"options"     => array (
							'hover-box'       => __( 'Default Style', 'zn_framework' ),
							'hover-box-2'     => __( 'Right side Image (since v4.0)', 'zn_framework' ),
							'hover-box-3'     => __( 'Background-image (since v4.0)', 'zn_framework' )
						),
						"type"        => "select",
					),

					array (
						"name"        => __( "Content Style", 'zn_framework' ),
						"description" => __( "Select the desired alignment for the content", 'zn_framework' ),
						"id"          => "hb_align",
						"type"        => "select",
						"std"         => "style1",
						"options"     => array (
							'zn_fill_class' => __( 'Normal', 'zn_framework' ),
							'centered'      => __( 'Centered', 'zn_framework' )
						),
						'live'        => array(
							'type'      => 'class',
							'css_class' => '.'.$this->data['uid']
						)
					),
					array (
						"name"        => __( "Remove right margin?", 'zn_framework' ),
						"description" => __( "Please choose if you don't want a right margin.", 'zn_framework' ),
						"id"          => "hb_rmmargin",
						"std"         => "1",
						"type"        => "zn_radio",
						"options"     => array (
							'1' => __( "Yes", 'zn_framework' ),
							'0'  => __( "No", 'zn_framework' )
						),
						"dependency"  => array( 'element' => 'hover_box_style' , 'value'=> array('hover-box-2') ),
					    "class"        => "zn_radio--yesno",
					),
				),
			),
			'color_options' => array(
				'title' => 'Color options',
				'options' => array(

					array (
						"name"        => __( "Box Background-color", 'zn_framework' ),
						"description" => __( "Select a color.", 'zn_framework' ),
						"id"          => "hb_bgcolor",
						"std"         => "#969696",
						"type"        => "colorpicker",
						'live' => array(
							'type'      => 'css',
							'css_class' => '.'.$this->data['uid'],
							'css_rule'  => 'background-color',
							'unit'      => ''
						)
					),

					array (
						"name"        => __( "Box text color", 'zn_framework' ),
						"description" => __( "Select a color.", 'zn_framework' ),
						"id"          => "hb_textcolor",
						"std"         => "#fff",
						"type"        => "colorpicker",
						'live' => array(
							'type'      => 'css',
							'css_class' => '.'.$this->data['uid'],
							'css_rule'  => 'color',
							'unit'      => ''
						)
					),

					array (
						"name"        => __( "Box HOVER Background-color", 'zn_framework' ),
						"description" => __( "Select a color.", 'zn_framework' ),
						"id"          => "hb_bgcolor_hover",
						"std"         => "#cd2122",
						"type"        => "colorpicker"
					),

					array (
						"name"        => __( "Box HOVER text color", 'zn_framework' ),
						"description" => __( "Select a color.", 'zn_framework' ),
						"id"          => "hb_textcolor_hover",
						"std"         => "#fff",
						"type"        => "colorpicker"
					),

				),
			),


			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#BSnIKXeP7Jc',
				'docs'    => 'http://support.hogash.com/documentation/hover-box/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
	}
}
