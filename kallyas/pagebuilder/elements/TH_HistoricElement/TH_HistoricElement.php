<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Historic Element
 Description: Create and display a Historic element
 Class: TH_HistoricElement
 Category: content
 Level: 3
 Keywords: timeline
*/
/**
 * Class TH_HistoricElement
 *
 * Create and display a Historic element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    3.8.0
 */
class TH_HistoricElement extends ZnElements
{
	public static function getName(){
		return __( "Historic Element", 'zn_framework' );
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		if( empty( $options['historic_single'] ) ){
			return;
		}

		$start_text = $this->opt( 'he_start', '' );
		$end_text = $this->opt( 'he_end', __( "PRESENT", 'zn_framework' ) );

		$elm_classes=array();
		$elm_classes[] = $this->data['uid'];
		$elm_classes[] = zn_get_element_classes($options);

		$attributes = zn_get_element_attributes($options);

		$color_scheme = $this->opt( 'element_scheme', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'element_scheme', '' );
		$elm_classes[] = 'historic--'.$color_scheme;
		$elm_classes[] = 'element-scheme--'.$color_scheme;

		echo '<div class="timeline_bar timeline-bar '.implode(' ', $elm_classes).'" '.$attributes.'>';
		echo '<div class="row u-mb-0">';
		echo '<div class="col-sm-12 timeline-edge"><span class="timeline-edge-text">' . $start_text . '</span></div>';

		if ( ! empty ( $options['historic_single'] ) && is_array( $options['historic_single'] ) ) {
			$i = 1;
			foreach ( $options['historic_single'] as $event ) {
				$pos = '<div class="col-sm-6">';
				if ( $i % 2 != 0 ) {
					$pos = '<div class="col-sm-6 col-sm-offset-6 timeline-bar--right" data-align="right">';
				}
				echo $pos;
				echo '<div class="timeline_box timeline-box u-trans-all-2s">';

				echo '<div class="date timeline-box-date">' . $event['she_event_date'] . '</div>';
				echo '<h4 class="htitle  timeline-box-title" '.WpkPageHelper::zn_schema_markup('title').'>' . $event['she_event_name'] . '</h4>';


				echo wpautop(do_shortcode( $event['she_event_desc'] ));


				echo '</div><!-- end timeline box -->';
				echo '</div>';

				$i ++;
			}
		}
		echo '<div class="col-sm-12 timeline-edge">';
		echo '<span class="timeline-edge-text">' . $end_text . '</span>';
		echo '</div>';
		echo '</div>';
		echo '</div><!-- end timeline bar -->';

	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$extra_options = array (
			"name"           => __( "Events", 'zn_framework' ),
			"description"    => __( "Here you can add your desired events.", 'zn_framework' ),
			"id"             => "historic_single",
			"std"            => "",
			"type"           => "group",
			"add_text"       => __( "Event", 'zn_framework' ),
			"remove_text"    => __( "Event", 'zn_framework' ),
			"group_title"    => "",
			"group_sortable" => true,
			"element_title" => "she_event_name",
			"subelements"    => array (
				array (
					"name"        => __( "Event title", 'zn_framework' ),
					"description" => __( "Please enter a title for this event", 'zn_framework' ),
					"id"          => "she_event_name",
					"std"         => "",
					"type"        => "text"
				),
				array (
					"name"        => __( "Event date", 'zn_framework' ),
					"description" => __( "Please enter the date for this event", 'zn_framework' ),
					"id"          => "she_event_date",
					"std"         => "",
					"type"        => "text",
				),
				array (
					"name"        => __( "Event description", 'zn_framework' ),
					"description" => __( "Please enter a description for this event", 'zn_framework' ),
					"id"          => "she_event_desc",
					"std"         => "",
					"type"        => "visual_editor",
					'class'       => 'zn_full'
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
						"name"        => __( "Start text", 'zn_framework' ),
						"description" => __( "Please enter a text that will appear as a start", 'zn_framework' ),
						"id"          => "he_start",
						"std"         => "",
						"type"        => "text",
					),
					array (
						"name"        => __( "End text", 'zn_framework' ),
						"description" => __( "Please enter a text that will appear at the end", 'zn_framework' ),
						"id"          => "he_end",
						"std"         => __( "PRESENT", 'zn_framework' ),
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
									'val_prepend'  => 'historic--',
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
				'video'   => 'http://support.hogash.com/kallyas-videos/#pp9gH2C90CQ',
				'docs'    => 'http://support.hogash.com/documentation/historic-element/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
