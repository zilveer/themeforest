<?php if(! defined('ABSPATH')){ return; }
/*
	Name: Sticky Section LITE
	Description: This element will generate a sticky section that will be glued to the bottom edge of the screen (window) and in which you can add elements
	Class: ZnStickySectionLite
	Category: Layout, Fullwidth
	Keywords: row, container, block, footer, sticky, fixed
	Level: 1
	Style: true
	Toolbar: bottom-blue
*/

class ZnStickySectionLite extends ZnElements {

	function options() {

		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

					array (
						'id'          => 'size',
						'name'        => 'Section Width',
						'description' => 'Select the desired size for this section.',
						'type'        => 'select',
						'std'        => 'container',
						'options'	  => array(
							'container' => 'Fixed width',
							'full_width' => 'Full width',
						),
						'live' => array(
							'type'		=> 'class',
							'css_class' => '.'.$uid.' .zn_sticky_section_size'
						)
					),

					array(
						'id'          => 'background_color',
						'name'        => 'Background color',
						'description' => 'Here you can override the background color for this section.',
						'type'        => 'colorpicker',
						'alpha'       => true,
						'std'         => '',
						'live'        => array(
							'type'		=> 'css',
							'css_class' => '.'.$uid,
							'css_rule'	=> 'background-color',
							'unit'		=> ''
						)
					),

					/**
					 *  padding
					 */
					array (
						"name"        => __( "Edit padding for each device breakpoint", 'zn_framework' ),
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

					// PADDINGS
					array(
						'id'          => 'cc_padding_lg',
						'name'        => 'Padding (Large Breakpoints)',
						'description' => 'Select the padding (in percent % or px) for this container.',
						'type'        => 'boxmodel',
						"allow-negative" => false,
						'std'	  => array(
							'top' => '15px',
							'bottom' => '15px',
							),
						'placeholder' => '0px',
						"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('lg') ),
						'live' => array(
							'type'		=> 'boxmodel',
							'css_class' => '.'.$uid,
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

					array(
						'id'          => 'minimize',
						'name'        => 'Minimize button?',
						'description' => 'Add a minimize button. The bar overlaps the footer and some parts might not be visible.',
						'type'        => 'toggle2',
						'std'		  => 	'yes',
						'value' => 'yes',
					),

				),
			),

			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#vcux4GW2ctg',
				'docs'    => 'http://support.hogash.com/documentation/section-and-columns/',
				'copy'    => $uid,
				'general' => true,
				'custom_id' => true,
			)),
		);

		return $options;

	}

	/**
	 * Output the element
	 * IMPORTANT : The UID needs to be set on the top parent container
	 */
	function element() {

		$uid = $this->data['uid'];
		$element_id = $this->opt('custom_id') ? $this->opt('custom_id') : $uid;

		$options = $this->data['options'];

		$section_classes = array();

		$section_classes[] = $uid;
		$section_classes[] = zn_get_element_classes($options);

		$attributes = zn_get_element_attributes($options);

		if ( empty( $this->data['content'] ) ) {
			$this->data['content'] = array ( ZN()->pagebuilder->add_module_to_layout( 'ZnColumn', array() , array(), 'col-sm-12' ) );
		}

		?>
		<section class="zn_sticky_section <?php echo implode(' ', $section_classes); ?>" id="<?php echo esc_attr( $element_id ); ?>" <?php echo $attributes; ?>>

			<div class="zn_sticky_section_size <?php echo $this->opt('size','container');?>">
				<div class="row zn_columns_container zn_content" data-droplevel="1">
					<?php
						ZN()->pagebuilder->zn_render_content( $this->data['content'] );
					?>

				</div>
			</div>
			<?php if( $this->opt('minimize','yes') == 'yes' && !ZNPB()->is_active_editor){ ?>
			<span class="zn_sticky_section_minimize js-toggle-class" data-target=".<?php echo $uid; ?>" data-target-class="is-minimized"><span class="glyphicon glyphicon-chevron-down"></span></span>
			<?php } ?>
		</section>
	<?php
	}

	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){

		$uid = $this->data['uid'];
		$css = '';
		$s_css = '';

		$cc_padding_lg = '';
		$cc_padding_lg_default = $this->opt('cc_padding_lg', array('top' => '15px', 'bottom' => '15px') );
		if( $cc_padding_lg_default['top'] != '15px' && $cc_padding_lg_default['bottom'] != '15px' ){
			$cc_padding_lg = $cc_padding_lg_default;
		}

		// Padding
		if( $cc_padding_lg || $this->opt('cc_padding_md', '' ) || $this->opt('cc_padding_sm', '' ) || $this->opt('cc_padding_xs', '' ) ){

			$css .= zn_push_boxmodel_styles(array(
					'selector' => '.'.$uid,
					'type' => 'padding',
					'lg' =>  $this->opt('cc_padding_lg', array('top' => '15px', 'bottom' => '15px') ),
					'md' =>  $this->opt('cc_padding_md', '' ),
					'sm' =>  $this->opt('cc_padding_sm', '' ),
					'xs' =>  $this->opt('cc_padding_xs', '' ),
				)
			);
		}

		$s_css .= $this->opt('background_color') ? 'background-color:'.$this->opt('background_color').';' : '';

		if ( !empty($s_css) )
		{
			$css .= '.zn_sticky_section.'.$uid.'{'.$s_css.'}';
		}

		return $css;
	}

}