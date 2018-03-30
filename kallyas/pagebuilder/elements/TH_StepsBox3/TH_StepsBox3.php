<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Steps Box 3
 Description: Create and display a Steps Box 3 element
 Class: TH_StepsBox3
 Category: content
 Level: 3
 Keywords: process, timeline
*/
/**
 * Class TH_StepsBox3
 *
 * Create and display a Steps Box 3 element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_StepsBox3 extends ZnElements
{
	public static function getName(){
		return __( "Steps Box 3", 'zn_framework' );
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
		$elm_classes[] = 'stepsbox3--'.$color_scheme;
		$elm_classes[] = 'element-scheme--'.$color_scheme;

		if ( ! empty ( $options['stp_title'] ) ) {
			echo '<h3 class="m_title m_title_ext text-custom stepbox3-elm-title" '.WpkPageHelper::zn_schema_markup('title').'>' . $options['stp_title'] . '</h3>';
		}

		echo '<div class="step-boxes-3 stepbox3 '.implode(' ', $elm_classes).'" '.$attributes.'>';

		if ( ! empty ( $options['steps_single3'] ) && is_array( $options['steps_single3'] ) ) {
			$i   = 1;
			$all = count( $options['steps_single3'] );
			$cls = '';
			foreach ( $options['steps_single3'] as $step )
			{
				if ( $i % 2 != 0 ) {
					$align = 'left';
				}
				else {
					$align = 'right';
				}

				if ( $i == $all ) {
					$cls = 'last';
				}

				echo '<div class="process_box stepbox3-box u-trans-all-2s ' . $cls . '" data-align="' . $align . '">';

				echo '<div class="number stepbox3-number kl-font-alt"><span class="stepbox3-number-sp">';

				if ( $i < 10 ) {
					echo '0' . $i;
				}
				else {
					echo $i;
				}

				echo '</span></div>';

				echo '<div class="content stepbox3-content">';
				if ( ! empty ( $step['stp_single_title'] ) ) {
					echo '<h4 class="stp_title stepbox3-title" '.WpkPageHelper::zn_schema_markup('title').'>' . $step['stp_single_title'] . '</h4>';
				}
				// STEP CONTENT
				if ( ! empty ( $step['stp_single_desc'] ) ) {
					if ( preg_match( '%(<p[^>]*>.*?</p>)%i', $step['stp_single_desc'], $regs ) ) {
						echo $step['stp_single_desc'];
					}
					else {
						echo '<div class="stepbox3-desc">' . $step['stp_single_desc'] . '</div>';
					}
				}
				echo '</div>';
				echo '<div class="clearfix"></div>';
				echo '</div>';

				$i ++;
			}
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
			"id"             => "steps_single3",
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
					"type"        => "visual_editor",
					"class"        => "zn_full",
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
							'multiple' => array(
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid,
									'val_prepend'  => 'stepsbox3--',
								),
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid,
									'val_prepend'  => 'element-scheme--',
								),
							)
						)
					),
					$extra_options,
				),
			),

			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#E9YzVw0ndi0',
				'docs'    => 'http://support.hogash.com/documentation/steps-box/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
