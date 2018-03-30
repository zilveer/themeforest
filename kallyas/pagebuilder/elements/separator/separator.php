<?php if(! defined('ABSPATH')){ return; }
/*
	Name: Separator
	Description: This element will generate a separator line
	Class: ZnSeparator
	Category: Content, Fullwidth
	Keywords: divider, spacer, line
	Level: 3
*/

class ZnSeparator extends ZnElements {

	function options() {

		$uid = $this->data['uid'];

		// backwards compatibility for top and bottom margin
		$sep_margin_std = array('top' => '0', 'bottom'=> '35px');
		if(isset($this->data['options']['top_margin']) && $this->data['options']['top_margin'] != '' ){
			$sep_margin_std['top'] = $this->data['options']['top_margin'].'px';
		}
		if(isset($this->data['options']['bottom_margin']) && $this->data['options']['bottom_margin'] != '' ){
			$sep_margin_std['bottom'] = $this->data['options']['bottom_margin'].'px';
		}

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(


	                array(
						'id'          => 'color',
						'name'        => 'Separator color',
						'description' => 'Select the color for separator line.',
						'type'        => 'colorpicker',
						'std'		  => '', // zget_option( 'default_text_color' , 'style_options' ),
	                    'live' => array(
	                    	'multiple' => array(
	                    		array(
			                        'type'		=> 'css',
			                        'css_class' => '.'.$uid . '.zn_separator--icon-no',
			                        'css_rule'	=> 'border-top-color',
			                        'unit'		=> ''
			                    ),
			                    array(
			                        'type'		=> 'css',
			                        'css_class' => '.'.$uid . '.zn_separator--icon-yes .zn_separator__line',
			                        'css_rule'	=> 'border-top-color',
			                        'unit'		=> ''
			                    ),
                    		)
                    	)
					),
	                array(
						'id'          => 'height',
						'name'        => 'Separator height',
						'description' => 'Select the separator line height (in pixels).',
						'type'        => 'slider',
						'std'		  => '1',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '0',
							'max' => '15',
							'step' => '1'
						),
						'live' => array(
	                    	'multiple' => array(
	                    		array(
									'type'		=> 'css',
									'css_class' => '.'.$uid . '.zn_separator--icon-no',
									'css_rule'	=> 'border-top-width',
									'unit'		=> 'px'
								),
								array(
									'type'		=> 'css',
									'css_class' => '.'.$uid . '.zn_separator--icon-yes .zn_separator__line',
									'css_rule'	=> 'border-top-width',
									'unit'		=> 'px'
								)
							)
						)
					),


					/**
					 * Margins
					 */
					array (
						"name"        => __( "Edit margins for each device breakpoint", 'zn_framework' ),
						"description" => __( "This will enable you to have more control over the padding of the container on each device. Click to see <a href='http://hogash.d.pr/1f0nW' target='_blank'>how box-model works</a>.", 'zn_framework' ),
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
						'std'	  => $sep_margin_std,
						'placeholder' => '0px',
						"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('lg') ),
						'live' => array(
							'type'		=> 'boxmodel',
							'css_class' => '.'.$uid,
							'css_rule'	=> 'margin',
						),
					),
					array(
						'id'          => 'cc_margin_md',
						'name'        => 'Margin (Medium Breakpoints)',
						'description' => 'Select the margin (in percent % or px) for this container.',
						'type'        => 'boxmodel',
						'std'	  => 	'',
						'placeholder'        => '0px',
						"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('md') ),
					),
					array(
						'id'          => 'cc_margin_sm',
						'name'        => 'Margin (Small Breakpoints)',
						'description' => 'Select the margin (in percent % or px) for this container.',
						'type'        => 'boxmodel',
						'std'	  => 	'',
						'placeholder'        => '0px',
						"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('sm') ),
					),
					array(
						'id'          => 'cc_margin_xs',
						'name'        => 'Margin (Extra Small Breakpoints)',
						'description' => 'Select the margin (in percent % or px) for this container.',
						'type'        => 'boxmodel',
						'std'	  => 	'',
						'placeholder'        => '0px',
						"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('xs') ),
					),

					array (
						"name"        => __( "Add Icon?", 'zn_framework' ),
						"description" => __( "Choose if you want to add an icon in the center of the separator.", 'zn_framework' ),
						"id"          => "enable_icon",
						"std"         => "no",
						"type"        => "zn_radio",
						"options"     => array(
							"yes" => __( "Yes", 'zn_framework' ),
							"no" => __( "No", 'zn_framework' ),
						),
					    "class"        => "zn_radio--yesno",
					),

					array (
						"name"        => __( "Icon", 'zn_framework' ),
						"description" => __( "Add icon.", 'zn_framework' ),
						"id"          => "icon",
						"std"         => "",
						"type"        => "icon_list",
						'class'       => 'zn_full',
						"dependency"  => array( 'element' => 'enable_icon' , 'value'=> array('yes') )
					),

	                array (
						"name"        => __( "Icon Color", 'zn_framework' ),
						"description" => __( "Select icon color.", 'zn_framework' ),
						"id"          => "icon_color",
						"std"         => "#cd2122",
						"type"        => "colorpicker",
						"dependency"  => array( 'element' => 'enable_icon' , 'value'=> array('yes') ),
						'live' => array(
							'type'      => 'css',
							'css_class' => '.'.$uid.' .zn_separator__icon',
							'css_rule'  => 'color',
							'unit'      => ''
						)
					),

					array(
						'id'          => 'icon_size',
						'name'        => 'Icon Size',
						'description' => 'Select the icon size in px.',
						'type'        => 'slider',
						'std'         => '20',
						'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '14',
							'max' => '80',
							'step' => '2'
						),
						"dependency"  => array( 'element' => 'enable_icon' , 'value'=> array('yes') ),
					),

				),
			),

			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#D_3o10kKikk',
				'copy'    => $uid,
				'general' => true,
			)),

		);

		return $options;

	}

	/**
	 * Output the element
	 * IMPORTANT : The UID needs to be set on the top parent container
	 */
	function element() {
		$options = $this->data['options'];

		// if( empty( $options ) ) { return; }
		//
		$enable_icon = $this->opt('enable_icon', 'no');

		$classes=array();
		$classes[] = $this->data['uid'];
		$classes[] = 'zn_separator--icon-'.$enable_icon;
		$classes[] = zn_get_element_classes($options);

		$attributes = zn_get_element_attributes($options);
		?>
			<div class="zn_separator clearfix <?php echo implode(' ', $classes); ?>" <?php echo $attributes; ?>><?php

				if($enable_icon == 'yes'){
					echo '<span class="zn_separator__line zn_separator__line--left"></span>';
					$icon = $this->opt('icon');
					if( isset($icon['family']) && !empty( $icon['family'] ) ){
						echo '<span class="zn_separator__icon" '.zn_generate_icon( $icon ).'></span>';
					}
					echo '<span class="zn_separator__line zn_separator__line--right"></span>';
				}
				// For 1px separator, make sure notification is not displayed in PB Mode
				if( ZNPB()->is_active_editor && $this->opt('height','1') == '1' ){
					echo '<div class="sep-no-notification clearfix"></div>';
				}
				?></div>
		<?php
	}


	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){

		$uid = $this->data['uid'];
		$css = "";

		// backwards compatibility for top and bottom margin
		$sep_margin_std = array('top' => '0', 'bottom'=> '35px');
		if(isset($this->data['options']['top_margin']) && $this->data['options']['top_margin'] != '' ){
			$sep_margin_std['top'] = $this->data['options']['top_margin'].'px';
		}
		if(isset($this->data['options']['bottom_margin']) && $this->data['options']['bottom_margin'] != '' ){
			$sep_margin_std['bottom'] = $this->data['options']['bottom_margin'].'px';
		}

		// Margin
		if( $this->opt('cc_margin_lg', $sep_margin_std ) || $this->opt('cc_margin_md', '' ) || $this->opt('cc_margin_sm', '' ) || $this->opt('cc_margin_xs', '' ) ){
			$css .= zn_push_boxmodel_styles(array(
					'selector' => '.'.$uid,
					'type' => 'margin',
					'lg' =>  $this->opt('cc_margin_lg', $sep_margin_std ),
					'md' =>  $this->opt('cc_margin_md', '' ),
					'sm' =>  $this->opt('cc_margin_sm', '' ),
					'xs' =>  $this->opt('cc_margin_xs', '' ),
				)
			);
		}

		$height = $this->opt('height') || $this->opt('height') === '0' ? 'border-top-width:'.$this->opt('height').'px;' : 'border-top-width:1px;';
        $color = $this->opt('color') ? 'border-top-color:'.$this->opt('color').';' : 'border-top-color:transparent;';

		$enable_icon = $this->opt('enable_icon', 'no');


		if($enable_icon == 'no'){
			$css .= ".{$uid}.zn_separator--icon-no { $height $color }";
		}

		if($enable_icon == 'yes'){
			$icon_size = $this->opt('icon_size', '20');
			$icon_size_css = 'font-size:'.$icon_size.'px;';
			$icon_color = 'color:'.$this->opt('icon_color', '#cd2122');

			$icon_size_calc = $icon_size + 40; // add 20px side margins
			$width = 'width: calc(50% - '.($icon_size_calc/2).'px);';

			$css .= ".{$uid}.zn_separator--icon-yes .zn_separator__line { $height $color $width }";
			$css .= ".{$uid} .zn_separator__icon { $icon_size_css $icon_color }";
		}

		return $css;
	}

}

?>
