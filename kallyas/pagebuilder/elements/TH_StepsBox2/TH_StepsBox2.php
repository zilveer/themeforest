<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Steps Box 2
 Description: Create and display a Steps Box 2 element
 Class: TH_StepsBox2
 Category: content
 Level: 3
 Keywords: tour, process, services
*/
/**
 * Class TH_StepsBox2
 *
 * Create and display a Steps Box 2 element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_StepsBox2 extends ZnElements
{
	public static function getName(){
		return __( "Steps Box 2", 'zn_framework' );
	}

	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){
		$css = '';
		$uid = $this->data['uid'];

		// Featured background color
		$f_bg_color = $this->opt('f_bg_color','');
		if( !empty($f_bg_color) ){
			$css .= ".{$uid} .gobox.ok:before,.{$uid} .gobox.ok:after, .{$uid} .gobox.ok{background-color:{$f_bg_color}}";
		}
		// Featured Text color
		$f_text_color = $this->opt('f_text_color','');
		if( !empty($f_text_color) ){
			$css .= ".{$uid} .gobox.ok, .{$uid} .gobox.ok h4, .{$uid} .gobox.ok > .glyphicon{color:{$f_text_color}}";
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

		$elm_classes=array();
		$elm_classes[] = $this->data['uid'];
		$elm_classes[] = zn_get_element_classes($options);

		$attributes = zn_get_element_attributes($options);

		$color_scheme = $this->opt( 'element_scheme', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'element_scheme', '' );
		$elm_classes[] = 'stepsbox2--'.$color_scheme;

		echo '<div class="elm-stepsbox2 stepbox2 row '.implode(' ', $elm_classes).'" '.$attributes.'>';

		if ( ! empty ( $options['stp_title'] ) ) {
			echo '<div class="col-sm-12">';
				echo '<h3 class="m_title m_title_ext text-custom stepbox2-el-title" '.WpkPageHelper::zn_schema_markup('title').'>' . $options['stp_title'] . '</h3>';
			echo '</div>';
		}

		if ( ! empty ( $options['steps_single2'] ) && is_array( $options['steps_single2'] ) ) {
			$i     = 1;
			$count = count( $options['steps_single2'] );
			echo '<div class="col-sm-12">';
			foreach ( $options['steps_single2'] as $step )
			{
				if ( $i % 3 == 1 ) {
					echo '<div class="row gutter-md">';
				}

				$ok    = '';
				$image = '';

				if ( $step['stp_single_ok'] == 'yes' ) {
					$ok    = 'ok';
					$image = '<span class="stepbox2-okicon glyphicon glyphicon-ok-circle"></span>';
				}

				$goboxfirst = '';
				if($i == 1) $goboxfirst = 'gobox-first stepbox2-first';

				$goboxlast = '';
				if($i == $count) $goboxlast = 'gobox-last stepbox2-last';

				echo '<div class="col-sm-4">';

					echo '<div class="gobox stepbox2-box u-trans-all-2s stepbox2-box--' . $ok . ' '.$goboxfirst.' '.$goboxlast.'">';

						echo $image;

						echo '<div class="gobox-content stepbox2-content">';

						if ( ! empty ( $step['stp_single_title'] ) ) {
							echo '<h4 class="stepbox2-title" '.WpkPageHelper::zn_schema_markup('title').'>' . $step['stp_single_title'] . '</h4>';
						}

						$stp_single_link = zn_extract_link($step['stp_single_link'], 'zn_step_link stepbox2-link');
						echo $stp_single_link['start'] . $stp_single_link['end'];

						if ( ! empty ( $step['stp_single_desc'] ) ) {
							echo '<div class="stepbox2-desc">' . $step['stp_single_desc'] . '</div>';
						}

						echo '</div>';

					echo '</div>';

				echo '</div>';

				if ( $i % 3 == 0 || $i == $count ) {
					echo '</div>';
				}
				$i ++;
			}
			echo '</div>';
		}

		echo '</div>';
	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$extra_options = array (
			"name"           => __( "Steps", 'zn_framework' ),
			"description"    => __( "Here you can create your desired steps.", 'zn_framework' ),
			"id"             => "steps_single2",
			"std"            => "",
			"type"           => "group",
			"add_text"       => __( "Step", 'zn_framework' ),
			"remove_text"    => __( "Step", 'zn_framework' ),
			"group_sortable" => true,
			"element_title" => "stp_single_title",
			"subelements"    => array (
				array (
					"name"        => __( "Step Title", 'zn_framework' ),
					"description" => __( "Please enter a title for this step.", 'zn_framework' ),
					"id"          => "stp_single_title",
					"std"         => "",
					"type"        => "text"
				),
				array (
					"name"        => __( "Step content", 'zn_framework' ),
					"description" => __( "Please enter a content for this step.", 'zn_framework' ),
					"id"          => "stp_single_desc",
					"std"         => "",
					"type"        => "textarea"
				),
				array (
					"name"        => __( "Box Link", 'zn_framework' ),
					"description" => __( "Please choose the link you want to use for this box.", 'zn_framework' ),
					"id"          => "stp_single_link",
					"std"         => "",
					"type"        => "link",
					"options"     => zn_get_link_targets(),
				),
				array (
					"name"        => __( "Use alternative style?", 'zn_framework' ),
					"description" => __( "Select yes if you want your box to use a different background color and display an OK
								icon on the left", 'zn_framework' ),
					"id"          => "stp_single_ok",
					"type"        => "select",
					"std"         => "no",
					"options"     => array (
						'yes' => __( 'Yes', 'zn_framework' ),
						'no'  => __( 'No', 'zn_framework' )
					),
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
						"description" => __( "Please enter a title that will appear on over the boxes", 'zn_framework' ),
						"id"          => "stp_title",
						"std"         => "",
						"type"        => "text",
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
							'type'      => 'class',
							'css_class' => '.'.$uid,
							'val_prepend'  => 'stepsbox2--',
						)
					),

					array(
						'id'          => 'f_bg_color',
						'name'        => 'Featured Box Background color',
						'description' => 'Here you can override the background color for the intro column.',
						'type'        => 'colorpicker',
						'std'         => '',
					),

					array(
						'id'          => 'f_text_color',
						'name'        => 'Intro Column Text color',
						'description' => 'Here you can override the text color for the intro column.',
						'type'        => 'colorpicker',
						'std'         => '',
						'live'        => array(
							'multiple' => array(
								array(
									'type'      => 'css',
									'css_class' => '.'.$uid.' .gobox.ok',
									'css_rule'  => 'color',
									'unit'      => ''
								),
								array(
									'type'      => 'css',
									'css_class' => '.'.$uid.' .gobox.ok h4',
									'css_rule'  => 'color',
									'unit'      => ''
								),
								array(
									'type'      => 'css',
									'css_class' => '.'.$uid.' .gobox.ok > .glyphicon',
									'css_rule'  => 'color',
									'unit'      => ''
								),
							),
						),
					),

					$extra_options,
				),
			),

			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#B0LG1fxTQv0',
				'docs'    => 'http://support.hogash.com/documentation/steps-box/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
