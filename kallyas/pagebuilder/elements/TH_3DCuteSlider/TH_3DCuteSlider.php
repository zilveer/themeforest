<?php if(! defined('ABSPATH')){ return; }
/*
Name: 3D Cute Slider
Description: Create and display a 3D Cute Slider element
Class: TH_3DCuteSlider
Category: Headers, Fullwidth
Level: 1
*/

/**
 * Class TH_3DCuteSlider
 *
 * Create and display a 3D Cute Slider element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    3.8.0
 */
class TH_3DCuteSlider extends ZnElements
{
	/**
	 * Holds the list of sliders created with this plugin
	 * @type array
	 */
	private $_sliders = array();

	public function __construct( $args = array() ){
		parent::__construct( $args );

		$this->checkForPlugin();
	}

	/**
	 * Check to see whether or not the plugin CuteSlider is installed and active
	 */
	public function checkForPlugin()
	{
		global $wpdb;
		$_options = array ();
		if(! function_exists('is_plugin_active')) {
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}
		if ( is_plugin_active( 'CuteSlider/cuteslider.php' ) ) {
			// Table name
			$table_name = $wpdb->prefix . "cuteslider";
			// Get sliders
			$cute_sliders = $wpdb->get_results(
				"SELECT * FROM $table_name
					WHERE flag_hidden = '0' AND flag_deleted = '0'
				  ORDER BY date_c ASC LIMIT 100"
			);
			// Iterate over the sliders

			$_options[] = 'Select slider';

			if(! empty($cute_sliders)) {
				foreach ($cute_sliders as $key => $item) {
					if (isset($item->id) && isset($item->name)) {
						$_options[$item->id] = $item->name;
					}
				}
			}
		}
		$this->_sliders = $_options;
	}

	public static function getName(){
		return __( "3D Cute Slider", 'zn_framework' );
	}

	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){
		$css = '';
		$uid = $this->data['uid'];

		$top_padding = $this->opt('top_padding');
		if($top_padding != '170'){
			$css .= '.'.$uid.' .kl-slideshow-inner{padding-top : '.$top_padding.'px;}';
		}

		$bottom_padding = $this->opt('bottom_padding');
		if($bottom_padding != '50'){
			$css .= '.'.$uid.' .kl-slideshow-inner{padding-bottom:'.$bottom_padding.'px;}';
		}

		return $css;
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		// TODO: Find fix for 3D Cute slider. Ref #1366
		if ( ZNPB()->is_active_editor ){
			echo '<div style="padding:10px"><p style="width: 100%; background: #A7A7A7; color: #fff; padding: 190px 0 150px; text-align: center; font-size: 18px;">SLIDER PREVIEW AVAILABLE ONLY IN <strong>VIEW-MODE</strong></p> </div>';
			return;
		}

		$slider_id = $this->opt( 'cuteslider_id' );
		if( empty( $slider_id  ) ) { return; }

		$style = $this->opt('ww_header_style', '');
		if ( ! empty ( $style ) ) {
			$style = 'uh_' . $style;
		}
		$sliderId = $this->opt('cuteslider_id', '');

		$bottom_mask = $this->opt('hm_header_bmasks','none');
		$bm_class = $bottom_mask != 'none' ? 'maskcontainer--'.$bottom_mask : '';

		?>
		<div class="kl-slideshow cute3dslider <?php echo $style; ?> <?php echo $bm_class; ?> <?php echo $this->data['uid']; ?> <?php echo zn_get_element_classes($this->data['options']); ?>">
			<div class="bgback"></div>
			<div class="th-sparkles"></div>
			<div class="kl-slideshow-inner container zn_slideshow">
				<?php echo do_shortcode( '[cuteslider id="' . $sliderId . '"]' ); ?>
			</div>
			<?php zn_bottommask_markup($bottom_mask, $this->opt('hm_header_bmasks_bg','')); ?>
		</div>
		<?php
	}

	function element_edit(){

			ob_start();
				$this->element();
			$return = ob_get_clean();

			$uid = uniqid();
			$return = preg_replace("/(cuteslider_)(\d)_(\d)/i", '$1$2$3'. $uid, $return);
			$return = preg_replace("/(cuteslider_)(\d)/i", '$1$2'. $uid, $return);

			echo $return;

	   // echo '<div class="zn-pb-notification">'.__( 'The slider will appear when viewing the page without the pagebuilder editor enabled' ).'</div>';
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
									from inside the Cute Slider option.", 'zn_framework' ),
						"id"          => "cuteslider_id",
						"std"         => "",
						"type"        => "select",
						"options"     => $this->_sliders
					),

					array(
						'id'          => 'top_padding',
						'name'        => 'Top padding',
						'description' => 'Select the top padding ( in pixels ) for this section.',
						'type'        => 'slider',
						'std'         => '170',
						'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '0',
							'max' => '400',
							'step' => '1'
						),
						'live' => array(
							'type'      => 'css',
							'css_class' => '.'.$this->data['uid'].' .kl-slideshow-inner',
							'css_rule'  => 'padding-top',
							'unit'      => 'px'
						)
					),
					array(
						'id'          => 'bottom_padding',
						'name'        => 'Bottom padding',
						'description' => 'Select the bottom padding ( in pixels ) for this section.',
						'type'        => 'slider',
						'std'         => '50',
						'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '0',
							'max' => '400',
							'step' => '1'
						),
						'live' => array(
							'type'      => 'css',
							'css_class' => '.'.$this->data['uid'].' .kl-slideshow-inner',
							'css_rule'  => 'padding-bottom',
							'unit'      => 'px'
						)
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
				'video'   => 'http://support.hogash.com/kallyas-videos/#hiQeyNfwHXw',
				'docs'    => 'http://support.hogash.com/documentation/3d-cute-slider/',
				'copy'    => $uid,
				'general' => true,
			)),

		);

		return $options;
	}
}
