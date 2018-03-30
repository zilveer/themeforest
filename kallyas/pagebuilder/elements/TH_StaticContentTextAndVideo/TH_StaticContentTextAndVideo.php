<?php if(! defined('ABSPATH')){ return; }
/*
Name: STATIC CONTENT - Text and Video
Description: Create and display a STATIC CONTENT - Text and Video element
Class: TH_StaticContentTextAndVideo
Category: headers, Fullwidth
Level: 1
Legacy: true
*/
/**
 * Class TH_StaticContentTextAndVideo
 *
 * Create and display a STATIC CONTENT - Text and Video element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_StaticContentTextAndVideo extends ZnElements
{
	public static function getName(){
		return __( "STATIC CONTENT - Text and Video", 'zn_framework' );
	}

	/**
	 * Load dependant resources
	 */
	function scripts(){
		wp_enqueue_style( 'static_content', THEME_BASE_URI . '/css/sliders/static_content_styles.css', '', ZN_FW_VERSION );
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		if( empty( $options ) ) { return; }

		$style = $this->opt('ww_header_style', '');
		if ( ! empty ( $style ) ) {
			$style = 'uh_' . $style;
		}

		$bottom_mask = $this->opt('hm_header_bmasks','none');
		$bm_class = $bottom_mask != 'none' ? 'maskcontainer--'.$bottom_mask : '';
		?>
		<div class="kl-slideshow <?php echo $style; ?> <?php echo $bm_class ?> <?php echo $this->data['uid']; ?> <?php echo zn_get_element_classes($this->data['options']); ?>">

			<div class="bgback"></div>
			<div class="th-sparkles"></div>

			<div class="container kl-slideshow-inner kl-slideshow-safepadding">
				<div class="static-content default-style with-login">
					<div class="row">
						<div class="col-sm-7">
							<?php
							if ( ! empty( $options['ww_slide_title'] ) ) {
								echo '<h2 class="static-content__title text-left" '.WpkPageHelper::zn_schema_markup('title').'>' . do_shortcode( $options['ww_slide_title'] ) . '</h2>';
							}

							if ( ! empty( $options['ww_slide_subtitle'] ) ) {
								echo '<h3 class="static-content__subtitle text-left" '.WpkPageHelper::zn_schema_markup('subtitle').'>' . do_shortcode( $options['ww_slide_subtitle'] ) . '</h3>';
							}

							$ww_slide_m_button = $this->opt('ww_slide_m_button', '');
							$ww_slide_l_text = $this->opt('ww_slide_l_text', '');
							$ww_slide_link = zn_extract_link($this->opt('ww_slide_link', ''), 'sc-infopop__btn text-custom');

							if ( !empty($ww_slide_m_button) || !empty($ww_slide_l_text) ) {
								echo '<div class="static-content__infopop animated fadeBoxIn sc-infopop--left" data-arrow="top">';
								if ( !empty ( $ww_slide_link['start'] ) ) {
									echo $ww_slide_link['start'] . $ww_slide_l_text . $ww_slide_link['end'];
								}
								// BUTTON LEFT TEXT
								if ( ! empty ( $ww_slide_m_button ) ) {
									echo '<h5 class="sc-infopop__text kl-font-alt">' . $ww_slide_m_button . '</h5>';
								}
								echo '<div class="clear"></div>';
								echo '</div>';
							}
							?>
						</div>
						<div class="col-sm-5">
							<?php
							// Text
							if ( isset ( $options['sc_ec_vid_desc'] ) && ! empty ( $options['sc_ec_vid_desc'] ) ) {
								echo '<h5 style="text-align:right;">' . $options['sc_ec_vid_desc'] . '</h5>';
							}
							// VIDEO
							if ( isset ( $options['sc_ec_vime'] ) && ! empty ( $options['sc_ec_vime'] ) ) {
								echo get_video_from_link( $options['sc_ec_vime'], 'black_border full_width', '520px', '270px' );
							}
							?>
						</div>
					</div>
					<!-- end row -->
				</div>
				<!-- end static content -->
			</div>
			<?php
				zn_bottommask_markup($bottom_mask, $this->opt('hm_header_bmasks_bg',''));
			?>
			<!-- header bottom style -->
		</div><!-- end kl-slideshow -->
	<?php
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
					array(
						"name"        => __( '<strong style="font-size:120%">Warning!</strong>', 'zn_framework' ),
						"description" => __( 'Since v4.x, <strong>this element is <em>deprecated</em> & <em>unsuported</em></strong>. It\'s not recommended to be used bucause at some point it\'ll be removed (now it\'s kept only for backwards compatibilty).<br> Instead, try to use a combination of these elements: Section (to add background), 2 Columns (6 + 6), Title element/TextBox (onto the left column), Media Container (into the right column)', 'zn_framework' ),
						'type'  => 'zn_message',
						'id'    => 'zn_error_notice',
						'show_blank'  => 'true',
						'supports'  => 'warning'
					),
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
						"name"        => __( "Main title", 'zn_framework' ),
						"description" => __( "Please enter a main title.", 'zn_framework' ),
						"id"          => "ww_slide_title",
						"std"         => "",
						"type"        => "textarea"
					),
					array (
						"name"        => __( "Subtitle", 'zn_framework' ),
						"description" => __( "Please enter a subtitle", 'zn_framework' ),
						"id"          => "ww_slide_subtitle",
						"std"         => "",
						"type"        => "textarea"
					),
					array (
						"name"        => __( "Button Main Text", 'zn_framework' ),
						"description" => __( "Please enter a main text for this button", 'zn_framework' ),
						"id"          => "ww_slide_m_button",
						"std"         => "",
						"type"        => "text"
					),
					array (
						"name"        => __( "Button Link Text", 'zn_framework' ),
						"description" => __( "Please enter a text that will appear on the right side of the button", 'zn_framework' ),
						"id"          => "ww_slide_l_text",
						"std"         => "",
						"type"        => "text"
					),
					array (
						"name"        => __( "Button link", 'zn_framework' ),
						"description" => __( "Please enter a link that will appear on the right side of the button", 'zn_framework' ),
						"id"          => "ww_slide_link",
						"std"         => "",
						"type"        => "link",
						"options"     => zn_get_link_targets(),
					),
					array (
						"name"        => __( "Video", 'zn_framework' ),
						"description" => __( "Please enter the link for your desired video ( youtube or vimeo ).", 'zn_framework' ),
						"id"          => "sc_ec_vime",
						"std"         => "",
						"type"        => "text"
					),
					array (
						"name"        => __( "Video Description", 'zn_framework' ),
						"description" => __( "Please enter a description for this video that will appear above the video.", 'zn_framework' ),
						"id"          => "sc_ec_vid_desc",
						"std"         => "",
						"type"        => "textarea"
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
				'video'   => 'http://support.hogash.com/kallyas-videos/#RDW958-3Rws',
				'docs'    => 'http://support.hogash.com/documentation/static-content-text-and-video/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
