<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Revolution Slider
 Description: Create and display a Recent Work 3 element
 Class: TH_RevolutionSlider
 Category: content
 Level: 3
 Dependency_class: UniteBaseClassRev
*/

/**
 * Class TH_RevolutionSlider
 *
 * Create and display a Revolution Slider element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_RevolutionSlider extends ZnElements
{
	public static function getName(){
		return __( "Revolution Slider", 'zn_framework' );
	}


	/**
	 * This method is used to display the output of the element.
	 *
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		// Don't show anything if a slider wasn't selected
		if( empty( $options['revslider_id'] ) ){ return; }

		$classes=array();
		$classes[] = $this->data['uid'];
		$classes[] = zn_get_element_classes($options);

		$attributes = zn_get_element_attributes($options);

		$style = $this->opt('ww_header_style', '');
		if ( ! empty ( $style ) ) {
			$style = 'uh_' . $style;
		}

		$bottom_mask = $this->opt('hm_header_bmasks','none');
		$classes[] = $bm_class = $bottom_mask != 'none' ? 'maskcontainer--'.$bottom_mask : '';

		?>
		<div class="kl-slideshow <?php echo $style; ?> kl-revolution-slider portfolio_devices <?php echo implode(' ', $classes); ?>" <?php echo $attributes; ?>>
			<div class="bgback"></div>

			<?php
				if(isset($options['revslider_id']) && !empty($options['revslider_id']) ){
					echo do_shortcode( '[rev_slider alias="' . $options['revslider_id'] . '"]' );
				}
			?>

			<div class="th-sparkles"></div>

			<?php
				zn_bottommask_markup($bottom_mask, $this->opt('hm_header_bmasks_bg',''));
			?>
		</div>
		<?php
	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		global $wpdb;
		$revslider_options = array(''=> 'No slider');
		if(! function_exists('is_plugin_active')) {
			include_once(ABSPATH . 'wp-admin/includes/plugin.php');
		}
		if ( is_plugin_active( 'revslider/revslider.php' ) ) {
			// Table name
			$table_name = $wpdb->prefix . "revslider_sliders";
			// Get sliders
			$rev_sliders = $wpdb->get_results( "SELECT title,alias FROM $table_name" );
			// Iterate over the sliders
			if(! empty($rev_sliders)) {
				foreach ($rev_sliders as $key => $item) {
					if (isset($item->alias) && isset($item->title)) {
						$revslider_options[$item->alias] = $item->title;
					}
				}
			}
		}

		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array (
						"name"        => __( "Background Style", 'zn_framework' ),
						"description" => __( "Select the background style you want to use. Please note that styles can be created
									from the unlimited headers options in the theme admin's page.", 'zn_framework' ),
						"id"          => "ww_header_style",
						"std"         => "",
						"type"        => "select",
						"options"     => WpkZn::getThemeHeaders(true),
						"class"       => ""
					),
					array (
						"name"        => __( "Select slider", 'zn_framework' ),
						"description" => __( "Select the desired slider you want to use. Please note that the slider can be created
									from inside the Revolution Slider options page.", 'zn_framework' ),
						"id"          => "revslider_id",
						"std"         => "",
						"type"        => "select",
						"options"     => $revslider_options
					),

					// Bottom masks overrides
					array (
						"name"        => __( "Bottom masks override", 'zn_framework' ),
						"description" => __( "The new masks are svg based, vectorial and color adapted.", 'zn_framework' ),
						"id"          => "hm_header_bmasks",
						"std"         => "none",
						"type"        => "select",
						"options"     => zn_get_bottom_masks(),
					),

                    array(
                        'id'          => 'hm_header_bmasks_bg',
                        'name'        => 'Bottom Mask Background Color',
                        'description' => 'If you need the mask to have a different color than the main site background, please choose the color. Usually this color is needed when the next section, under this one has a different background color.',
                        'type'        => 'colorpicker',
                        'std'         => '',
                        "dependency"  => array( 'element' => 'hm_header_bmasks' , 'value'=> array('mask3', 'mask3 mask3l', 'mask3 mask3r', 'mask4', 'mask4 mask4l', 'mask4 mask4r', 'mask5', 'mask6') ),
                    ),
				),
			),


			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#pP-ktSGJabg',
				'docs'    => 'http://support.hogash.com/documentation/revolution-slider/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
