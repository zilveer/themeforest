<?php if(! defined('ABSPATH')){ return; }
/*
	Name: Column
	Description: This element will generate a column in which you can add elements
	Class: ZnColumn
	Category: Layout
	Level: 2
	Flexible: true
	Style: true
*/

class ZnColumn extends ZnElements {


	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){

		$uid = $this->data['uid'];
		$css = '';

		$innerwrapper = '';

		//** Set the border for the container
		$border = "";
		$border_style = $this->opt('border_style','none');
		if ($border_style !== 'none') {
			$border_width = $this->opt('border_width',0);
			$border_color = $this->opt('border_color','transparent');
			$border = " border-style:$border_style; border-width:{$border_width}px; border-color:$border_color;";
			// shorten up if all are set
			if( $border_style != 'none' && !empty($border_width) && !empty($border_color) ) {
				$border = " border:$border_style {$border_width}px $border_color;";
			}
			$innerwrapper .= $border;
		}

		//** Set the corner radius
		$corner_radius = $this->opt('corner_radius','');
		if (!empty($corner_radius))
		{
			$innerwrapper .=  " border-radius:{$corner_radius}px;";
		}

		// Inner Wrapper Styles
		$innerwrapper .= $this->opt('background_color', '') ? ' background-color:'.$this->opt('background_color', '').';':'';

		if(!empty($innerwrapper)){
			$css .= '.'.$uid. ' > .znColumnElement-innerWrapper{'.$innerwrapper.'}';
		}

		// Height
		$css .= zn_smart_slider_css( $this->opt( 'custom_height', '' ), '.'.$uid.' > .znColumnElement-innerWrapper' , 'height' );

		// Width
		$inner_width = $this->opt( 'custom_width' );
		if(!empty($inner_width) && isset($inner_width['lg']) && $inner_width['lg'] != '100'){
			$css .= zn_smart_slider_css( $inner_width, '.'.$uid.' > .znColumnElement-innerWrapper > .znColumnElement-innerContent:not(.zn_pb_no_content)' , 'width' );
		}

		// Margin
		if( $this->opt('cc_margin_lg', '' ) || $this->opt('cc_margin_md', '' ) || $this->opt('cc_margin_sm', '' ) || $this->opt('cc_margin_xs', '' ) ){
			$css .= zn_push_boxmodel_styles(array(
					'selector' => '.'.$uid.' > .znColumnElement-innerWrapper',
					'type' => 'margin',
					'lg' =>  $this->opt('cc_margin_lg', '' ),
					'md' =>  $this->opt('cc_margin_md', '' ),
					'sm' =>  $this->opt('cc_margin_sm', '' ),
					'xs' =>  $this->opt('cc_margin_xs', '' ),
				)
			);
		}
		// Padding
		if( $this->opt('cc_padding_lg', '' ) || $this->opt('cc_padding_md', '' ) || $this->opt('cc_padding_sm', '' ) || $this->opt('cc_padding_xs', '' ) ){
			$css .= zn_push_boxmodel_styles(array(
					'selector' => '.'.$uid.' > .znColumnElement-innerWrapper',
					'type' => 'padding',
					'lg' =>  $this->opt('cc_padding_lg', '' ),
					'md' =>  $this->opt('cc_padding_md', '' ),
					'sm' =>  $this->opt('cc_padding_sm', '' ),
					'xs' =>  $this->opt('cc_padding_xs', '' ),
				)
			);
		}


		$zindex = $this->opt('zindex', '');

		if(!empty($zindex)){
			$css .= '.'.$uid. '{z-index:'.$zindex.'}';
		}

		return $css;
	}

	function offsets($brp = 'md'){
		return array(
			'' => 'No offset',
			'col-'.$brp.'-offset-0' => '0 - Reset Offset',
			'col-'.$brp.'-offset-1' => '1 Column Offset',
			'col-'.$brp.'-offset-2' => '2 Columns Offset',
			'col-'.$brp.'-offset-3' => '3 Columns Offset',
			'col-'.$brp.'-offset-4' => '4 Columns Offset',
			'col-'.$brp.'-offset-5' => '5 Columns Offset',
			'col-'.$brp.'-offset-6' => '6 Columns Offset',
			'col-'.$brp.'-offset-7' => '7 Columns Offset',
			'col-'.$brp.'-offset-8' => '8 Columns Offset',
			'col-'.$brp.'-offset-9' => '9 Columns Offset',
			'col-'.$brp.'-offset-10' => '10 Columns Offset',
			'col-'.$brp.'-offset-11' => '11 Columns Offset'
		);
	}

	function cols($brp = 'sm'){
		return array(
			'' => 'Default',
			'col-'.$brp.'-1' => '1 / 12',
			'col-'.$brp.'-2' => '2 / 12',
			'col-'.$brp.'-3' => '3 / 12',
			'col-'.$brp.'-4' => '4 / 12',
			'col-'.$brp.'-5' => '5 / 12',
			'col-'.$brp.'-6' => '6 / 12',
			'col-'.$brp.'-7' => '7 / 12',
			'col-'.$brp.'-8' => '8 / 12',
			'col-'.$brp.'-9' => '9 / 12',
			'col-'.$brp.'-10' => '10 / 12',
			'col-'.$brp.'-11' => '11 / 12',
			'col-'.$brp.'-12' => '12 / 12',
			'col-'.$brp.'-1-5' => '1 / 5',
		);
	}

	function options() {

		$uid = $this->data['uid'];

		// Inherit large and medium from small
		$_lg_offset_inheritance = !$this->opt('column_offset_lg', '') && $this->opt('column_offset', '') != '' ? str_replace('sm', 'lg', $this->opt('column_offset', '') ) : '';
		$_md_offset_inheritance = !$this->opt('column_offset_md', '') && $this->opt('column_offset', '') != '' ? str_replace('sm', 'md', $this->opt('column_offset', '') ) : '';

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

					array (
						"name"        => __( "Edit Settings for each device breakpoint", 'zn_framework' ),
						"description" => __( "This will enable you to have more control over the settings of this column on each device.", 'zn_framework' ),
						"id"          => "cc_breakpoints",
						"std"         => "lg",
						"tabs"        => true,
						"type"        => "zn_radio",
						"options"     => array (
							"lg"        => __( "LARGE", 'zn_framework' ),
							"md"        => __( "MEDIUM", 'zn_framework' ),
							"sm"        => __( "SMALL", 'zn_framework' ),
							"xs"        => __( "EXTRA SMALL", 'zn_framework' ),
						),
						"class"       => "zn_full zn_breakpoints"
					),

					// OFFSETS
					array(
						'id'          => 'column_offset_lg',
						'name'        => 'Column Offset - Desktops',
						'description' => 'Here you can define an offset for this column ',
						'type'        => 'select',
						'std'        => $_lg_offset_inheritance,
						'options'        => $this->offsets('lg'),
						'live' => array(
							'type'		=> 'class',
							'css_class' => '.zn_pb_el_container[data-uid="'.$this->data['uid'].'"]'
						),
						"dependency"  => array( 'element' => 'cc_breakpoints' , 'value'=> array('lg') ),
					),

					array(
						'id'          => 'column_offset_md',
						'name'        => 'Column Offset - Laptops / large tablets',
						'description' => 'Here you can define an offset for this column',
						'type'        => 'select',
						'std'        => $_md_offset_inheritance,
						'options'        => $this->offsets('md'),
						'live' => array(
							'type'		=> 'class',
							'css_class' => '.zn_pb_el_container[data-uid="'.$this->data['uid'].'"]'
						),
						"dependency"  => array( 'element' => 'cc_breakpoints' , 'value'=> array('md') ),
					),
					array(
						'id'          => 'column_offset',
						'name'        => 'Column offset - Tablets',
						'description' => 'Here you can define an offset for this column',
						'type'        => 'select',
						'std'        => '',
						'options'        => $this->offsets('sm'),
						'live' => array(
							'type'		=> 'class',
							'css_class' => '.zn_pb_el_container[data-uid="'.$this->data['uid'].'"]'
						),
						"dependency"  => array( 'element' => 'cc_breakpoints' , 'value'=> array('sm') ),
					),

					array(
						'id'          => 'column_offset_xs',
						'name'        => 'Column Offset - SmartPhones',
						'description' => 'Here you can define an offset for this column. Usually not used at all.',
						'type'        => 'select',
						'std'         => '',
						'options'     => $this->offsets('xs'),
						"dependency"  => array( 'element' => 'cc_breakpoints' , 'value'=> array('xs') ),
					),


					array(
						'id'          => 'size_large',
						'name'        => 'Column Size on Desktops',
						'description' => 'In View Mode only! <br> Select a size for this column on large devices, for example Desktops with a resolution bigger than 1200px.',
						'type'        => 'select',
						'std'        => '',
						'options'        => $this->cols('lg'),
						"dependency"  => array( 'element' => 'cc_breakpoints' , 'value'=> array('lg') ),
					),

					array(
						'id'          => 'size_small',
						'name'        => 'Column Size on Tablets',
						'description' => 'Select a size for this column on small devices( >= 768px )',
						'type'        => 'select',
						'options'        => $this->cols('sm'),
						"dependency"  => array( 'element' => 'cc_breakpoints' , 'value'=> array('sm') ),
					),

					array(
						'id'          => 'size_xsmall',
						'name'        => 'Columns Size on Smartphones',
						'description' => 'Select a size for this column on extra small devices( <768px )',
						'type'        => 'select',
						'options'        => $this->cols('xs'),
						"dependency"  => array( 'element' => 'cc_breakpoints' , 'value'=> array('xs') ),
					),
				),
			),

			'styles' => array(
				'title' => 'Styles options',
				'options' => array(

					array(
						'id'          => 'custom_height',
						'name'        => __( 'Inner Height', 'zn_framework'),
						'description' => __( 'Choose the desired height for this section. You can choose either height or min-height as a property. Height will force a fixed size rather than just a minimum. <br>*TIP: Use 100vh to have a full-height element.', 'zn_framework' ),
						'type'        => 'smart_slider',
						'std'        => '',
						'helpers'     => array(
							'min' => '0',
							'max' => '1400'
						),
						'supports' => array('breakpoints'),
						'units' => array('px', 'vh'),
						'live' => array(
							'type'      => 'css',
							'css_class' => '.'.$uid. ' > .znColumnElement-innerWrapper',
							'css_rule'  => 'height',
							'unit'      => 'px'
						)
					),

					array(
						'id'          => 'custom_width',
						'name'        => __( 'Inner Width', 'zn_framework'),
						'description' => __( 'Choose the desired height for this section. You can choose either height or min-height as a property. Height will force a fixed size rather than just a minimum. <br>*TIP: Use 100vh to have a full-height element.', 'zn_framework' ),
						'type'        => 'smart_slider',
						'std'        => '100',
						'helpers'     => array(
							'min' => '0',
							'max' => '100'
						),
						'supports' => array('breakpoints'),
						'units' => array('%'),
						'live' => array(
							'type'      => 'css',
							'css_class' => '.'.$uid. ' > .znColumnElement-innerWrapper > .znColumnElement-innerContent:not(.zn_pb_no_content)',
							'css_rule'  => 'width',
							'unit'      => '%'
						)
					),

					array(
						'id'          => 'valign',
						'name'        => __( 'Vertical Align - Inner Content', 'zn_framework'),
						'description' => __( 'Choose how to vertically align content.', 'zn_framework' ),
						'type'        => 'select',
						'std'        => 'top',
						'options'     => array(
							'top' => 'Top',
							'center' => 'Middle',
							'bottom' => 'Bottom',
						),
						'live' => array(
							'type'      => 'class',
							'css_class' => '.'.$uid.' > .znColumnElement-innerWrapper',
							'val_prepend'  => 'znColumnElement-innerWrapper--valign-',
						),
					),

					array(
						'id'          => 'halign',
						'name'        => __( 'Horizontal Align - Inner Content', 'zn_framework'),
						'description' => __( 'Choose how to horizontally align content.', 'zn_framework' ),
						'type'        => 'select',
						'std'        => 'left',
						'options'     => array(
							'left' => 'Left',
							'center' => 'Center',
							'right' => 'Right',
						),
						'live' => array(
							'type'      => 'class',
							'css_class' => '.'.$uid.' > .znColumnElement-innerWrapper',
							'val_prepend'  => 'znColumnElement-innerWrapper--halign-',
						),
					),

					array(
						'id'          => 'background_color',
						'name'        => 'Inner Background color',
						'description' => 'Here you can override the background color for this section.',
						'type'        => 'colorpicker',
						'alpha'        => true,
						'std'         => '',
						'live'        => array(
							'type'		=> 'css',
							'css_class' => '.'.$uid. ' > .znColumnElement-innerWrapper',
							'css_rule'	=> 'background-color',
							'unit'		=> ''
						)
					),


					/**
					 * Margins and padding
					 */
					array (
						// "name"        => __( "Edit padding & margins for each device breakpoint", 'zn_framework' ),
						// "description" => __( "This will enable you to have more control over the padding of the container on each device. Click to see <a href='http://hogash.d.pr/1f0nW' target='_blank'>how box-model works</a>.", 'zn_framework' ),
						"id"          => "cc_spacing_breakpoints",
						"std"         => "lg",
						"tabs"        => true,
						"type"        => "zn_radio",
						"options"     => array (
							"lg"        => __( "LARGE", 'zn_framework' ),
							"md"        => __( "MEDIUM", 'zn_framework' ),
							"sm"        => __( "SMALL", 'zn_framework' ),
							"xs"        => __( "EXTRA SMALL", 'zn_framework' ),
						),
						"class"       => "zn_full zn_breakpoints"
					),
					// MARGINS
					array(
						'id'          => 'cc_margin_lg',
						'name'        => 'Margin (Large Breakpoints)',
						'description' => 'Select the margin (in percent % or px) for this container. Accepts negative margin.',
						'type'        => 'boxmodel',
						'placeholder' => '0px',
						"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('lg') ),
						'live' => array(
							'type'		=> 'boxmodel',
							'css_class' => '.'.$uid. ' > .znColumnElement-innerWrapper',
							'css_rule'	=> 'margin',
						),
					),
					array(
						'id'          => 'cc_margin_md',
						'name'        => 'Margin (Medium Breakpoints)',
						'description' => 'Select the margin (in percent % or px) for this container.',
						'type'        => 'boxmodel',
						'placeholder'        => '0px',
						"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('md') ),
					),
					array(
						'id'          => 'cc_margin_sm',
						'name'        => 'Margin (Small Breakpoints)',
						'description' => 'Select the margin (in percent % or px) for this container.',
						'type'        => 'boxmodel',
						'placeholder'        => '0px',
						"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('sm') ),
					),
					array(
						'id'          => 'cc_margin_xs',
						'name'        => 'Margin (Extra Small Breakpoints)',
						'description' => 'Select the margin (in percent % or px) for this container.',
						'type'        => 'boxmodel',
						'placeholder'        => '0px',
						"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('xs') ),
					),
					// PADDINGS
					array(
						'id'          => 'cc_padding_lg',
						'name'        => 'Padding (Large Breakpoints)',
						'description' => 'Select the padding (in percent % or px) for this container.',
						'type'        => 'boxmodel',
						"allow-negative" => false,
						'std'	  => '',
						'placeholder' => '0px',
						"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('lg') ),
						'live' => array(
							'type'		=> 'boxmodel',
							'css_class' => '.'.$uid. ' > .znColumnElement-innerWrapper',
							'css_rule'	=> 'padding',
						),
					),
					array(
						'id'          => 'cc_padding_md',
						'name'        => 'Padding (Medium Breakpoints)',
						'description' => 'Select the padding (in percent % or px) for this container.',
						'type'        => 'boxmodel',
						"allow-negative" => false,
						'std'	  => 	'',
						'placeholder'        => '0px',
						"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('md') ),
					),
					array(
						'id'          => 'cc_padding_sm',
						'name'        => 'Padding (Small Breakpoints)',
						'description' => 'Select the padding (in percent % or px) for this container.',
						'type'        => 'boxmodel',
						"allow-negative" => false,
						'std'	  => 	'',
						'placeholder'        => '0px',
						"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('sm') ),
					),
					array(
						'id'          => 'cc_padding_xs',
						'name'        => 'Padding (Extra Small Breakpoints)',
						'description' => 'Select the padding (in percent % or px) for this container.',
						'type'        => 'boxmodel',
						"allow-negative" => false,
						'std'	  => 	'',
						'placeholder'        => '0px',
						"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('xs') ),
					),

					// BORDER SETTINGS
					array (
						'id'          => 'border_style',
						'name'        => 'Border style',
						'description' => 'Select a border style you wish to use for this column.',
						'type'        => 'select',
						'options'	  => array(
							'none'		=> 'None',
							'solid'		=> 'Solid',
							'dotted'	=> 'Dotted',
							'dashed'	=> 'Dashed',
							'double'	=> 'Double',
							'groove'	=> 'Groove',
							'ridge'		=> 'Ridge',
							'inset'		=> 'Inset',
							'outset'	=> 'Outset'
						),
						'live' => array(
							'type'		=> 'css',
							'css_class' => '.'.$uid. ' > .znColumnElement-innerWrapper',
							'css_rule'	=> 'border-style',
							'unit'		=> ''
						),
					),

					array(
						'id'          => 'border_width',
						'name'        => 'Border width',
						'description' => 'Select the border width you wish to use for this column.',
						'type'        => 'slider',
						'std'		  => '0',
						// 'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '0',
							'max' => '100',
							'step' => '1'
						),
						'live' => array(
							'type'		=> 'css',
							'css_class' => '.'.$uid. ' > .znColumnElement-innerWrapper',
							'css_rule'	=> 'border-width',
							'unit'		=> 'px'
						),
						"dependency"  => array( 'element' => 'border_style' , 'value'=> array('solid', 'dotted', 'dashed', 'double', 'groove', 'ridge', 'inset', 'outset') ),
					),
					array(
						'id'          => 'border_color',
						'name'        => 'Border color',
						'description' => 'Here you can override the background color for this section.',
						'type'        => 'colorpicker',
						'std'         => '',
						'live'        => array(
							'type'		=> 'css',
							'css_class' => '.'.$uid. ' > .znColumnElement-innerWrapper',
							'css_rule'	=> 'border-color',
							'unit'		=> ''
						),
						"dependency"  => array( 'element' => 'border_style' , 'value'=> array('solid', 'dotted', 'dashed', 'double', 'groove', 'ridge', 'inset', 'outset') ),
					),
					array(
						'id'          => 'corner_radius',
						'name'        => 'Corner radius',
						'description' => 'Select a corner radius (in pixels) for this column.',
						'type'        => 'slider',
						'std'		  => '0',
						'helpers'	  => array(
							'min' => '0',
							'max' => '400',
							'step' => '1'
						),
						'live' => array(
							'type'		=> 'css',
							'css_class' => '.'.$uid. ' > .znColumnElement-innerWrapper',
							'css_rule'	=> 'border-radius',
							'unit'		=> 'px'
						),
					),

					array(
						'id'          => 'zindex',
						'name'        => 'Z-Index',
						'description' => 'Select the z-index of this column element.',
						'type'        => 'slider',
						'std'         => '',
						'helpers'      => array(
							'step' => 1,
							'min' => -10,
							'max' => 100,
						),
						'live'        => array(
							'type'		=> 'css',
							'css_class' => '.'.$uid,
							'css_rule'	=> 'z-index',
							'unit'		=> ''
						),
					),

				),
			),

			'advanced' => array(
				'title' => 'Advanced options',
				'options' => array(

					array (
						"name"        => __( "Enable Object Scrolling", 'zn_framework' ),
						"description" => __( "This will add a very nice slide up or down effect to this element, upon scrolling.", 'zn_framework' ),
						"id"          => "obj_parallax_enable",
						"std"         => "",
						"type"        => "toggle2",
						"value"        => "yes",
					),

					array (
						"name"        => __( "Distance", 'zn_framework' ),
						"description" => __( "Select the Y axis distance to run the effect. The effect will run on the entire screen, from entering the viewport until leaving it.", 'zn_framework' ),
						"id"          => "obj_parallax_distance",
						"std"         => "100",
						"type"        => "select",
						"options"     => array(
								"50" => "Slide for 50px",
								"100" => "Slide for 100px",
								"200" => "Slide for 200px",
								"300" => "Slide for 300px",
						),
						"dependency"  => array( 'element' => 'obj_parallax_enable' , 'value'=> array('yes') ),
					),

					array(
						"name"        => __( "Speed", 'zn_framework' ),
						"description" => __( "How long should the animation take, or better said, how slow or fast should it be. Value is in miliseconds (1s = 1000ms).", 'zn_framework' ),
						'id'          => 'obj_parallax_speed',
						'type'        => 'slider',
						'std'         => '800',
						'helpers'     => array(
							'min' => '0',
							'max' => '5000',
							'step' => '100'
						),
						"dependency"  => array( 'element' => 'obj_parallax_enable' , 'value'=> array('yes') ),
					),

					array (
						"name"        => __( "Easing", 'zn_framework' ),
						"description" => __( "Select the effect's easing. You can play with the easing effects <a href=\"http://greensock.com/ease-visualizer\" target=\"_blank\">here</a>.", 'zn_framework' ),
						"id"          => "obj_parallax_easing",
						"std"         => "Power1.easeOut",
						"type"        => "select",
						"options"     => array(
							"Power0.easeOut" => "Power0.easeOut (Linear)",
							"Power1.easeOut" => "Power1.easeOut (Quad)",
							"Power2.easeOut" => "Power2.easeOut (Cubic)",
							"Power3.easeOut" => "Power3.easeOut (Quart)",
							"Power4.easeOut" => "Power4.easeOut (Quint)",
						),
						"dependency"  => array( 'element' => 'obj_parallax_enable' , 'value'=> array('yes') ),
					),

					array (
						"name"        => __( "Tween in reverse?", 'zn_framework' ),
						"description" => __( "This will make the tween effect to run in opposite direction of the scroll.", 'zn_framework' ),
						"id"          => "obj_parallax_reverse",
						"std"         => "",
						"type"        => "toggle2",
						"value"        => "yes",
						"dependency"  => array( 'element' => 'obj_parallax_enable' , 'value'=> array('yes') ),
					),

				),
			),

			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#hBPFBT437_M',
				'docs'    => 'http://support.hogash.com/documentation/column/',
				'copy'    => $uid,
				'general' => true,
			)),

		);

		return $options;

	}

	function element() {

		$options = $this->data['options'];

		// $column_offset = ( $this->opt('column_offset') && !ZN()->pagebuilder->is_active_editor ) ? ' '.$this->opt('column_offset').' ' : '';

		$width = ( $this->data['width'] ) ? $this->data['width'] : 'col-md-12';
		$size_small = $this->opt('size_small', str_replace("md","sm",$width));
		$size_xsmall = $this->opt('size_xsmall','');
		$size_large = $this->opt('size_large','');

		$classes=array();
		$classes[] = $uid = $this->data['uid'];
		$classes[] = zn_get_element_classes($options);

		if(!ZN()->pagebuilder->is_active_editor){
			$column_offset = $this->opt('column_offset', '');
			$classes[] = !$this->opt('column_offset_lg', '') && $column_offset != '' ? str_replace('sm', 'lg', $column_offset ) : $this->opt('column_offset_lg', '');
			$classes[] = !$this->opt('column_offset_md', '') && $column_offset != '' ? str_replace('sm', 'md', $column_offset ) : $this->opt('column_offset_md', '');
			$classes[] = $column_offset;
			$classes[] = $this->opt('column_offset_xs', '');
		}

		$classes[] = $width;
		$classes[] = $size_small;
		$classes[] = $size_xsmall;
		$classes[] = $size_large;

		$attributes = zn_get_element_attributes($options);

		// Object Parallax
		$obj_parallax_class = '';
		$obj_parallax_attributes = '';
		if( $this->opt('obj_parallax_enable','') == 'yes' ){
			$obj_parallax_class = 'znParallax-object';
			$obj_distance = $this->opt('obj_parallax_distance','100')/2;
			$parallaxObject = array(
				"scene" => array(
					'triggerHook' => 'onEnter',
					'triggerElement' => '.'.$uid. ' > .znColumnElement-innerWrapper',
					'duration' => 'force_full',
				),
				"tween" => array(
					'speed' => $this->opt('obj_parallax_speed','800')/1000,
					'reverse' => $this->opt('obj_parallax_reverse','') == 'yes' ? 'true':'false',
					'css' => array(
						"y" => array( "from" => -$obj_distance, "to" => $obj_distance )
					),
					'easing' => $this->opt('obj_parallax_easing', 'Power1.easeOut')
				),
			);
			$obj_parallax_attributes .= ' data-zn-parallax-obj=\''.json_encode($parallaxObject).'\'';
		}

	?>

		<div class="<?php echo implode(' ', $classes); ?> znColumnElement" <?php echo $attributes; ?>>
			<div class="znColumnElement-innerWrapper znColumnElement-innerWrapper--valign-<?php echo $this->opt('valign','top') ?> znColumnElement-innerWrapper--halign-<?php echo $this->opt('halign','left') ?> <?php echo $obj_parallax_class; ?>" <?php echo $obj_parallax_attributes; ?>>
				<div class="znColumnElement-innerContent zn_sortable_content zn_content" data-droplevel="2">
				<?php ZN()->pagebuilder->zn_render_content( $this->data['content'] ); ?>
				</div>
			</div>
		</div>
	<?php
	}

}

?>
