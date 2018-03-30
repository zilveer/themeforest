<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Steps Box 4
 Description: Create and display a Steps Box 4 element
 Class: TH_StepsBox4
 Category: content
 Level: 3
 Keywords: process, timeline, icon
*/
/**
 * Class TH_StepsBox4
 *
 * Create and display a Steps Box 4 element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_StepsBox4 extends ZnElements
{
	public static function getName(){
		return __( "Steps Box 4", 'zn_framework' );
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
		$elm_classes[] = 'stepsbox4--'.$color_scheme;
		$elm_classes[] = 'element-scheme--'.$color_scheme;

		if ( ! empty ( $options['stp_title'] ) ) {
			echo '<h3 class="m_title m_title_ext text-custom" '.WpkPageHelper::zn_schema_markup('title').'>' . $options['stp_title'] . '</h3>';
		}

		echo '<div class="step-boxes-4 stepbox4 '.implode(' ', $elm_classes).'" '.$attributes.'>';
		if ( ! empty ( $options['steps_single4'] ) && is_array( $options['steps_single4'] ) ) {
			$i   = 1;
			$all = count( $options['steps_single4'] );
			$cls = '';
			foreach ( $options['steps_single4'] as $step )
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

				$stp_link['start'] ='';
				$stp_link['end'] ='';

				if(isset($step['stp_link']) && !empty($step['stp_link'])){
					$stp_link = zn_extract_link($step['stp_link'], 'stp_link stepbox4-link');
				}

				echo '<div class="process_box4 stepbox4-box ' . $cls . '">';

				if ( ! empty ( $step['stp_single_title'] ) ) {
					echo '<h4 class="stp_title stepbox4-title" '.WpkPageHelper::zn_schema_markup('title').'>';
						echo $stp_link['start'];
							echo $step['stp_single_title'];
						echo $stp_link['end'];
					echo '</h4>';
				}
				echo '<div class="pb__line stepbox4-line"><div class="number stepbox4-number">';

				echo $stp_link['start'];

					// $tabIcon = (isset($step['vts_tab_icon']) && !empty($step['vts_tab_icon']) ? $step['vts_tab_icon'] : '');

					$iconHolder = $step['vts_tab_icon'];
					$tabIcon = !empty( $iconHolder['family'] )  ? '<span class="stepbox4-icon" '.zn_generate_icon( $step['vts_tab_icon'] ).'></span>' : '';

					if($options['stepsbox_style'] == 'style2' && !empty($tabIcon)){
						echo $tabIcon;
					}
					else {
						echo '<span class="stepbox4-icon">';
						if ( $i < 10 ) {
							echo '0' . $i;
						}
						else {
							echo $i;
						}
						echo '</span>';
					}

				echo $stp_link['end'];

				echo '</div></div>';

				echo '<div class="content stepbox4-content">';

				// STEP CONTENT
				if ( ! empty ( $step['stp_single_desc'] ) ) {
					if ( preg_match( '%(<p[^>]*>.*?</p>)%i', $step['stp_single_desc'], $regs ) ) {
						echo $step['stp_single_desc'];
					}
					else {
						echo '<p>' . $step['stp_single_desc'] . '</p>';
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
			"id"             => "steps_single4",
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
					"name"        => __( "Step link", 'zn_framework' ),
					"description" => __( "Please enter a link that will be added to the icon.", 'zn_framework' ),
					"id"          => "stp_link",
					"std"         => "",
					"type"        => "link",
					"options"     => zn_get_link_targets(),
				),
				array (
					"name"        => __( "Step icon", 'zn_framework' ),
					"description" => __( "Select your desired icon that will appear on the step circle.", 'zn_framework' ),
					"id"          => "vts_tab_icon",
					"std"         => "",
					"type"        => "icon_list",
					'class'       => 'zn_full',
				),
			)
		);

		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array (
						"name"        => __( "Steps Box 4 Style", 'zn_framework' ),
						"description" => __( "Please select the style you want to use.", 'zn_framework' ),
						"id"          => "stepsbox_style",
						"std"         => "style1",
						"options"     => array (
							'style1'  => __( 'Number', 'zn_framework' ),
							'style2'  => __( 'Icon', 'zn_framework' ),
						),
						"type"        => "select",
					),
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
									'val_prepend'  => 'stepsbox4--',
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
				'video'   => 'http://support.hogash.com/kallyas-videos/#XT0Vyy3Q8-w',
				'docs'    => 'http://support.hogash.com/documentation/steps-box/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
